<?php

/**
 * Auteur:Esther byamasu Furaha
 * CRUD du MENU
 * esther@mediabox.bi
 * 20/03/2024
 * 
 
 */

class Menu extends CI_Controller
{

  function __construct()
  {  
    
    parent::__construct(); 
    $this->is_auth(); 
  }
  public function is_auth()
  {
    if (empty($this->session->userdata('USER_ID'))) {
      redirect(base_url('Login'));
    }
  }

  function index()
  {

    $data['title'] = 'Liste des menus';
    // $this->page = 'Menu_Liste_View';
    // $this->layout($data);
    $this->load->view('Menu_Liste_View',$data);
  } 
  //fonction pour la liste des menus
  function listing()
  {

    $query_principal = 'SELECT menu.ID_MENU,menu.CONTROLLER, menu.DESCRIPTION AS DESCR_MENU, module.DESCRIPTION AS DESCR_MODULE,menu.HAVE_SOUS_MENU, menu.URL, menu.STATUT FROM `menu` JOIN module on menu.ID_MODULE=module.ID_MODULE WHERE 1';

    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $limit = 'LIMIT 0,10';


    $draw = isset($_POST['draw']);
    $start = isset($postData['start']);

    if (isset($_POST["length"]) && $_POST["length"] != -1) {
      $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
    }
    $order_by = '';



    $order_column = '';
    $order_column = array('menu.DESCRIPTION', 'module.DESCRIPTION', 'URL', 'menu.STATUT', 'menu_profil.ID_MENU', 'menu_profil.ID_PROFIL');

    $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ';


    $search = !empty($_POST['search']['value']) ? (" AND (menu.DESCRIPTION LIKE '%$var_search%' OR module.DESCRIPTION LIKE '%$var_search%' OR menu.URL LIKE '%$var_search%')") : '';

    $critaire = '';


    $query_secondaire = $query_principal . ' ' . $search . ' ' . $critaire . ' ' . $order_by . '   ' . $limit;

    $query_filter = $query_principal . ' ' . $search . ' ' . $critaire;



    $fetch_cov_frais = $this->Model->datatable($query_secondaire);
    $data = array();
    $u = 1;
    foreach ($fetch_cov_frais as $info) {

      $nombre = $this->Model->getRequeteOne('select COUNT(ID_MENU) as nombre FROM menu_profil WHERE ID_MENU=' . $info->ID_MENU . '');
      $nbr_sous_menu = $this->Model->getRequeteOne('select COUNT(ID_MENU) as nbr FROM sous_menu WHERE ID_MENU=' . $info->ID_MENU . '');

     

      $post = array();
      $post[] = $u++;
      $post[] = $info->DESCR_MENU;
      $post[] = $info->DESCR_MODULE;
      $post[] = $info->CONTROLLER;
      $point = '';
      $point = "<center><a href='javascript:;'  class='btn btn-dark btn-md' onclick='get_profil(" . $info->ID_MENU . ",\"" . $info->DESCR_MENU . "\")'>
               " . $nombre['nombre'] . "

               </a></center>";

      $post[] = $point;
      $point_sm = '';
      $point_sm = "<center><a href='javascript:;'  class='btn btn-dark btn-md' onclick='get_sous_menu(" . $info->ID_MENU . ",\"" . $info->DESCR_MENU . "\")'>
               " . $nbr_sous_menu['nbr'] . "

               </a></center>";


      $post[] = $point_sm;

    

      // $act = '';
      // if ($nbr_sous_menu['nbr'] != 0) {
      //   $act = "<span style='color:blue'>N/A</span>";
      // } else {
      //   $act = '<span>' . $point_act . '</span>';
      // }

      // $post[] = $act;

      $url = "";
      if (empty($info->URL)) {
        $url = "<span style='color:blue'>N/A</span>";
      } else {
        $url = $info->URL;
      }

      $post[] = $url;
     

      $val = '';$icon = '';$stt = '';

      if ($info->STATUT == 1) {
        $post[] = '<span class="btn-outline-info fa fa-check"></div></span>';
        $icon = 'fa-close';
        $stt = 'Désactiver';
      } else {
        $post[] = '<span class="btn-outline-danger fa fa-remove"></div></span>';
        $icon = 'fa-check';
        $stt = 'Activer';

      }
      ///////////////////////

      $statut=''; $statut_sm='';
      // if ($info->HAVE_SOUS_MENU == 0) {
      //     $statut_sm = '<span class="actionCust" title="Affecter"><a href="' . base_url('matrice/Menu/ajouter/' . $info->ID_MENU) . '"><i class="fa fa-plus"></i></a></span>';

      // }else{
      //   $statut_sm='';
      // }

      $statut.='<div class="row"><span class="actionCust" title="Modifier"><a href="'.base_url('matrice/Menu/getOne/'.$info->ID_MENU).'"><i class="fa fa-pencil"></i></a></span>
          

            <span data-toggle="modal" data-target="#myModal'.$info->ID_MENU.'" title="'.$stt.'" class="actionCust"><a href="#"><i class="fa fa-trash"></i></a></span>

            <div class="modal fade" id="myModal'.$info->ID_MENU.'" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      
                      <div class="modal-body">
                              <div class="row">
                                  <div class="col-lg-12 mb-4">
                                      <center>
                  <h5><strong>Voulez-vous  '.$stt.' le menu  <i style="color:green;">'.$info->DESCR_MENU.'</i></strong><br> <b style:"background-color:prink";></b>
                  </h5>
                  </center>
                                  </div>

                              </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                          <a class="btn btn-danger" href="' . base_url('matrice/Menu/Change/' . $info->ID_MENU.'/'.$info->STATUT) . '">'.$stt.'</a>
                      </div>
                  </div>
              </div>
          </div
          </div>';

      ///////////////////////

       //Les boutons de modification et d'activer et desactiver
      $post[] = $statut;
      $data[] = $post;
    }

    $output = array(
      "draw" => intval($_POST['draw']),
      "recordsTotal" => $this->Model->all_data($query_principal),
      "recordsFiltered" => $this->Model->filtrer($query_filter),
      "data" => $data
    );
    echo json_encode($output);
  } 

  public function detail($id)
  {
    $query_principal = 'SELECT roles.rol_description FROM menu_profil LEFT JOIN roles ON menu_profil.ID_PROFIL=roles.rol_id JOIN menu on menu_profil.ID_MENU=menu.ID_MENU WHERE 1 and menu.ID_MENU=' . $id;

    $var_search = !empty($_POST["search"]["value"]) ? $_POST["search"]["value"] : null;
    $limit = 'LIMIT 0,10';

    $draw = isset($_POST['draw']);
    $start = isset($postData['start']);

    if (isset($_POST["length"]) && $_POST["length"] != -1) {
      $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
    }



    $order_by = '';

    $search = !empty($_POST['search']['value']) ? (" AND (rol_description  LIKE '%$var_search%')") : '';

    $order_column = '';

    $order_column = array('menu.DESCRIPTION');

    $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY rol_description ASC';


    $critaire = 'and menu.ID_MENU=' . $id;


    $query_secondaire = $query_principal . ' ' . $search . ' ' . $critaire . ' ' . $order_by . '   ' . $limit;

    $query_filter = $query_principal . ' ' . $critaire . ' ' . $search;



    $fetch_cov_frais = $this->Model->datatable($query_secondaire);
    $data = array();
    $u = 1;
    foreach ($fetch_cov_frais as $info) {
      $post = array();
      $post[] = $u++;
      $post[] = $info->rol_description;

      $data[] = $post;
    }

    $output = array(
      "draw" => intval($_POST['draw']),
      "recordsTotal" => $this->Model->all_data($query_principal),
      "recordsFiltered" => $this->Model->filtrer($query_filter),
      "data" => $data
    );
    echo json_encode($output);

  }
 

  //fonction pour afficher le formulaire d'ajout
  public function insert()
  {

    $data['mod'] = $this->Model->getRequete('SELECT ID_MODULE,DESCRIPTION,STATUT FROM module where 1 and STATUT = 1 ORDER BY DESCRIPTION ASC');
    $data['prof'] = $this->Model->getRequete('SELECT `rol_id`,`rol_description` FROM `roles` WHERE 1 and rol_active = 1 ORDER BY rol_description ASC');

    $data['title'] = 'Ajout des menus';
    // $this->page = 'Menu_Add_View';
    // $this->layout($data);


     $this->load->view('Menu_Add_View', $data);
  } 

  //founction d'ajouter les menus
  public function add()
  {

    $MENU = $this->input->post('MENU');
    $ID_MODULE = $this->input->post('ID_MODULE');
    $controlleur = $this->input->post('controlleur');
    $ID_PROFIL = $this->input->post('profil[]');
    $categorie_visa_id = $this->input->post('categorie_visa_id');


    $flexRadioDefault = $this->input->post('flexRadioDefault');


    // if (!empty($ID_MODULE)) {
    //   $module = $this->Model->getRequeteOne('SELECT ID_MODULE,MOT_CLE FROM module where  ID_MODULE =' . $ID_MODULE);
    //   $url = $module['MOT_CLE'] . '/' . $controlleur;
    // }
    $this->form_validation->set_rules('MENU', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
    $this->form_validation->set_rules('ID_MODULE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
    $this->form_validation->set_rules('profil[]', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

    if ($this->form_validation->run() == FALSE) {
      $this->insert();
    } else {

      if ($ID_MODULE == 9) {

        $url=$this->Model->getRequeteOne('SELECT `categorie_visa_id`,`categorie_visa_fr`,`categorie_visa_en`,`link` FROM `categorie_visa` WHERE `categorie_visa_id`='.$categorie_visa_id);

        $array = array('DESCRIPTION' => $url['categorie_visa_fr'], 'ID_MODULE' => $ID_MODULE, 'URL' => $url['link'], 'STATUT' => 1, 'HAVE_SOUS_MENU' => $flexRadioDefault,'ID_CATEGORIE_VISA'=>$categorie_visa_id);
      }elseif ($ID_MODULE == 8) {

        $array = array('DESCRIPTION' => $MENU, 'ID_MODULE' => 8, 'URL' => $controlleur, 'STATUT' => 1, 'HAVE_SOUS_MENU' => $flexRadioDefault);
      }
      else{
        $array = array('DESCRIPTION' => $MENU, 'ID_MODULE' => $ID_MODULE, 'URL' => $controlleur, 'STATUT' => 1, 'HAVE_SOUS_MENU' => $flexRadioDefault);
      }
      

      $array_too = array('DESCRIPTION' => $MENU, 'ID_MODULE' => $ID_MODULE, 'URL' => $controlleur, 'HAVE_SOUS_MENU' => $flexRadioDefault);

      $check = $this->Model->getOne("menu", $array_too);

      if (!empty($check)) {
        $message = array(
          'class' => 'text-danger',
          'message' => 'Le menu existé'
        );

        $this->session->set_flashdata("dash", $message);

        // redirect(base_url('matrice/insert'));
        $this->insert();
      } else {
        $into = $this->Model->insert_last_id('menu', $array);

        //print_r($into);die();
        $count = count($ID_PROFIL);
        for ($i = 0; $i < $count; $i++) {
          $message = $this->Model->create('menu_profil', array('ID_PROFIL' => $ID_PROFIL[$i], 'ID_MENU' => $into));
        }

        if ($message) {

          $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Enregistrement effectuée avec succès!!" . '</div>';

          if ($flexRadioDefault == 0) {
            $this->session->set_flashdata($data);
            redirect(base_url('matrice/Menu'));

          } else {

            redirect(base_url('matrice/Sous_menu/add_sous_menu/' . $into));
          }

        }
           	
      }

    }
  } 


  //fonction pour afficher le formulaire de modificaction en renvoyant id choisi
  public function getOne($idmenu)
  {
    $men = $this->Model->getOne('menu', array('ID_MENU' => $idmenu));
    $data['module'] = $this->Model->getRequete('SELECT ID_MODULE,DESCRIPTION,STATUT FROM module where 1 and STATUT = 1  order BY DESCRIPTION ASC');

    $exit = $this->Model->getRequete('SELECT roles.rol_id FROM menu_profil JOIN roles on menu_profil.ID_PROFIL= roles.rol_id WHERE menu_profil.ID_MENU=' . $men['ID_MENU'] . ' and roles.rol_active=1  ');

    $profil='';

    $prof = array();
    foreach ($exit as $key) {
      $prof[] = $key['rol_id'];

    }


    $data['prof'] = $prof;

    $data['men'] = $men;

    $data['title'] = 'Modification des menus';
    // $this->page = 'Menu_Update_View';
    // $this->layout($data);
     $this->load->view('Menu_Update_View', $data);
  } 


  //fonction de modifier le menu
  public function update()
  {

    $ID_MENU = $this->input->post('ID_MENU');
    $MENU = $this->input->post('MENU');
    $ID_MODULE = $this->input->post('ID_MODULE');
    $controlleur = $this->input->post('controlleur');
    $ID_PROFIL = $this->input->post('profil[]');

    // $module = $this->Model->getRequeteOne('SELECT ID_MODULE,DESCRIPTION FROM module where  ID_MODULE =' . $ID_MODULE);
    // $url = $module['DESCRIPTION'] . '/' . $controlleur;

    $menu = $this->Model->getOne('menu', array('ID_MENU' => $ID_MENU));



    /*form validation*/

    // if ($menu['HAVE_SOUS_MENU'] == 0) {
    //   $this->form_validation->set_rules('URL','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
    // }

    $this->form_validation->set_rules('MENU', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
    $this->form_validation->set_rules('ID_MODULE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

    $this->form_validation->set_rules('profil[]', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

    if ($this->form_validation->run() == FALSE) {
      $this->getOne($ID_MENU);
    } else {
      $array = array('DESCRIPTION' => $MENU, 'ID_MODULE' => $ID_MODULE, 'URL' => $controlleur);

      $message = $this->Model->update('menu', array('ID_MENU' => $ID_MENU), $array);

      $this->Model->delete('menu_profil', array('ID_MENU' => $ID_MENU));


      foreach ($ID_PROFIL as $key => $value) {

        $dataUpdate = array(
          'ID_PROFIL' => $value,
          'ID_MENU' => $ID_MENU,
        );

        $this->Model->create('menu_profil', $dataUpdate);
      }

      if ($message) {
        $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Modification effectuée avec succès!!" . '</div>';
        $this->session->set_flashdata($data);
        redirect(base_url('matrice/Menu/'));

      }
      
    }
  } 


  function change($id, $STATUT)
  {

    if ($STATUT == 0) {
      $val = 1;
      $message = $this->Model->update('menu', array('ID_MENU' => $id), array('STATUT' => $val));

      if ($message) {

        $data['message'] = '<div style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em"  class=" btn btn-success" id="message">' . "Le menu a été activé avec succès!" . '</div>';
				$this->session->set_flashdata($data);
        redirect(base_url('matrice/Menu'));

      } else {
        $message = array(
          'class' => 'btn btn-dark',
          'message' => '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" class=" btn btn-success" id="message">' . "L\' activation du menu a echoué" . '</div>'
        );

        $this->session->set_flashdata("dash", $message);
      }
    }

    if ($STATUT == 1) {
      $val = 0;
      $message = $this->Model->update('menu', array('ID_MENU' => $id), array('STATUT' => $val));

      if ($message) {

        $data['message'] = '<div style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em"  class=" btn btn-success" id="message">' . "Le menu a été désactivé avec succès". '</div>';
				$this->session->set_flashdata($data);
        redirect(base_url('matrice/Menu'));

      } else {
        $message = array(
          'class' => 'btn btn-dark',
          'message' => '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" class=" btn btn-success" id="message">' . "La désactivation du menu a echoue" . '</div>'
        );

        $this->session->set_flashdata("dash", $message);
        redirect(base_url('matrice/Menu'));

      }
    }
  } //fonction d'activer ou de desactiver


  function detail_sm($id = 0)
  {
    $query_principal = 'SELECT sous_menu.ID_SOUS_MENU , sous_menu.DESCRIPTION,sous_menu.STATUT FROM sous_menu JOIN menu ON sous_menu.ID_MENU=menu.ID_MENU WHERE 1 and menu.ID_MENU=' . $id;

    $var_search = !empty($_POST["search"]["value"]) ? $_POST["search"]["value"] : null;
    $limit = 'LIMIT 0,10';

    $draw = isset($_POST['draw']);
    $start = isset($postData['start']);

    if (isset($_POST["length"]) && $_POST["length"] != -1) {
      $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
    }



    $order_by = '';

    $search = !empty($_POST['search']['value']) ? (" AND (sous_menu.DESCRIPTION  LIKE '%$var_search%')") : '';

    $order_column = '';

    $order_column = array('sous_menu.ID_SOUS_MENU', 'sous_menu.DESCRIPTION');

    $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY sous_menu.DESCRIPTION ASC';




    $critaire = 'and menu.ID_MENU=' . $id;
    $order_by ='ORDER BY sous_menu.DESCRIPTION ASC';

    $query_secondaire = $query_principal . ' ' . $search . ' ' . $critaire . ' ' . $order_by . '   ' . $limit;

    $query_filter = $query_principal . ' ' . $critaire . ' ' . $search;



    $fetch_cov_frais = $this->Model->datatable($query_secondaire);
    $data = array();
    $u = 1;
    $statut = '';
    foreach ($fetch_cov_frais as $info) {
      if ($info->STATUT == 1) {
        $statut = "<span class='btn-outline-info fa fa-check'></span>";
      } else {
        $statut = "<span class='btn-outline-danger fa fa-remove'></span>";
      }



      $post = array();
      $post[] = $u++;
      $post[] = $info->DESCRIPTION;

      $post[] = $statut;
      $data[] = $post;
    }

    $output = array(
      "draw" => intval($draw),
      "recordsTotal" => $this->Model->all_data($query_principal),
      "recordsFiltered" => $this->Model->filtrer($query_filter),
      "data" => $data
    );
    echo json_encode($output);

  } //fonction pour visualiser les sousmenu 

  function get_profil($ID_MODULE)
  {

    $profils = $this->Model->getRequete("SELECT module_profil.`ID_PROFIL`,roles.rol_description FROM roles JOIN module_profil ON module_profil.ID_PROFIL=roles.rol_id WHERE 1 AND roles.rol_active=1 AND module_profil.ID_MODULE=".$ID_MODULE." ORDER BY roles.rol_description ASC");

    $html = '<label for="Ftype">Profil</label> <br>
            <div class="card"><div class="card-body"><div class="row">';

    $exist = array();

    foreach ($profils as $key) {

        $html .= "<div class='col-md-4'><label><input name='profil[]' value='".$key['ID_PROFIL']."' type='checkbox'> " . $key['rol_description'] . "</label></div>";
    }
    $html.= '</div></div></div>';

    echo $html;

  }


  function get_categorie($id_module)
  {
    $categ=$this->Model->getRequete("SELECT `categorie_visa_id`,`categorie_visa_fr`,`categorie_visa_en`,`link` FROM `categorie_visa` WHERE `id_module`=".$id_module);

    $documents=$this->Model->getRequete("SELECT `type_document_voyage_id`,`document_nom_fr` FROM `type_document_voyage` WHERE 1");
    if ($id_module == 9) {
      $html = '<label>Catégorie visa</label>
              <select class="form-control" name="categorie_visa_id" id="categorie_visa_id">
              <option value=""  selected>Sélectionner</option>';
      foreach ($categ as $value) {
        $html .= '<option value="'.$value['categorie_visa_id'].'">'.$value['categorie_visa_fr'].'</option>';
      }
     $html.='</select>';
    }elseif ($id_module == 8) {
      
      $html = '<label>Documents</label>
              <select class="form-control" name="type_document_voyage_id" id="type_document_voyage_id">
              <option value=""  selected>Sélectionner</option>';
      foreach ($documents as $value) {
        $html .= '<option value="'.$value['type_document_voyage_id'].'">'.$value['document_nom_fr'].'</option>';
      }
     $html.='</select>';

    }

    
   echo $html;

  }


  function detail_act_profil($id = 0, $idmenu = 0)
  {
    // print_r($id,$idmenu);die();
    $query_principal = 'SELECT ID_ACTION_MENU, actions.DESCRIPTION, actions.  STATUT FROM action_menu JOIN actions ON action_menu.ID_ACTION=actions.ID_ACTION JOIN profil on action_menu.ID_PROFIL=profil.ID_PROFIL JOIN menu on menu.ID_MENU=action_menu.ID_MENU WHERE 1 and action_menu.ID_PROFIL=' . $id . ' and menu.ID_MENU=' . $idmenu;

    $var_search = !empty($_POST["search"]["value"]) ? $_POST["search"]["value"] : null;
    $limit = 'LIMIT 0,10';

    $draw = isset($_POST['draw']);
    $start = isset($postData['start']);

    if (isset($_POST["length"]) && $_POST["length"] != -1) {
      $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
    }



    $order_by = '';

    $search = !empty($_POST['search']['value']) ? ("AND (actions.DESCRIPTION  LIKE '%$var_search%')") : '';

    $order_column = '';

    $order_column = array('actions.ID_ACTION', 'actions.DESCRIPTION');

    $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY actions.DESCRIPTION ASC';

    $critaire = 'and profil.ID_PROFIL=' . $id;
   $order_by = 'ORDER BY actions.DESCRIPTION ASC';

    $query_secondaire = $query_principal . ' ' . $search . ' ' . $critaire . ' ' . $order_by . '   ' . $limit;

    $query_filter = $query_principal . ' ' . $critaire . ' ' . $search;



    $fetch_cov_frais = $this->Model->datatable($query_secondaire);
    $data = array();
    $u = 1;
    foreach ($fetch_cov_frais as $info) {
      $post = array();
      $post[] = $u++;
      $post[] = $info->DESCRIPTION;
      $statut = '';
      if ($info->STATUT == 0) {
        $statut = "<span class ='btn-outline-danger fa fa-remove'></span>";
      } else {
        $statut = "<span class ='btn-outline-info fa fa-check'></span>";

      }
      $post[] = $statut;
      $post[] = "<a href='#' data-toggle='modal' data-target='#mydelete" . $info->ID_ACTION_MENU . "'>
                 <label class='text-danger'>&nbsp;&nbsp;Supprimer</label>
                 </a><div class='modal fade' id='mydelete" . $info->ID_ACTION_MENU . "'>
                 <div class='modal-dialog'>
                  <div class='modal-content'>

                  <div class='modal-body'>
                  <center>
                  <h5><strong>Voulez-vous lui retire l'action</strong><br> <b style:'background-color:prink';><i style='color:green;'>" . $info->DESCRIPTION . "</i></b><strong>??</strong>
                  </h5>
                  </center>
                  </div>

                  <div class='modal-footer'>
                  <a class='btn btn-danger btn-md' href='" . base_url('matrice/Menu/retrait_action/') . $info->ID_ACTION_MENU . "'>Oui</a>
                  <button class='btn btn-dark btn-md' data-dismiss='modal'>
                  Non
                  </button>
                  </div>

                  </div>
                  </div>
                  </div>";



      $data[] = $post;
    }

    $output = array(
      "draw" => intval($draw),
      "recordsTotal" => $this->Model->all_data($query_principal),
      "recordsFiltered" => $this->Model->filtrer($query_filter),
      "data" => $data
    );
    echo json_encode($output);

  } //fonction pour visualiser le actions de chaque profil

  public function retrait_action($ID_ACTION_MENU)
  {
    $this->Model->delete('action_menu', array('ID_ACTION_MENU' => $ID_ACTION_MENU));
    redirect(base_url('matrice/Menu'));
  } //fonction pour le retrait d'une action

}
?>