<?php

/**
 * Auteur:FURAHA BYAMASU ESTHER
 * CRUD du MENU ETAPE
 * estherbyamasufuraha@gmail.com
 * 04/04/2023
 */
//Attribution des menu aux etapes et profil
class Menu_Etape_Profil extends MY_Controller
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

 //la fonction qui affiche le view
  function index()
  {

    $data['title'] = 'Liste des menus';
    $this->page = 'menu_etape_role/Menu_Etape_Role_Liste_View';
    $this->layout($data);
  } 
  //fonction pour la liste des menus
  function listing()
  {

    $query_principal = 'SELECT menu.`ID_MENU_ETAPE_ROLE`, menu.DESCRIPTION AS DESCR_MENU,menu.ROLE_ID,menu.ETAPE_ID,doc_document_statut.`statut_id`,menu.`LINK`,roles.rol_description ,m.DESCRIPTION AS DESCR_MODULE,doc_document_statut.statut_descr FROM `menu_etape_role` menu JOIN menu m on menu.ID_MENU=m.ID_MENU JOIN roles ON roles.rol_id= menu.`ROLE_ID` JOIN doc_document_statut ON doc_document_statut.`statut_id`=menu.`ETAPE_ID` WHERE 1';

    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $limit = 'LIMIT 0,10';


    $draw = isset($_POST['draw']);
    $start = isset($postData['start']);

    if (isset($_POST["length"]) && $_POST["length"] != -1) {
      $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
    }
    $order_by = '';



    $order_column = '';
    $order_column = array('menu.DESCRIPTION', 'LINK', 'doc_document_statut.statut_descr', 'menu.ID_MENU_ETAPE_ROLE');

    $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ';


    $search = !empty($_POST['search']['value']) ? (" AND (doc_document_statut.statut_descr LIKE '%$var_search%' OR roles.rol_description LIKE '%$var_search%' )") : '';

    $critaire = '';


    $query_secondaire = $query_principal . ' ' . $search . ' ' . $critaire . ' ' . $order_by . '   ' . $limit;

    $query_filter = $query_principal . ' ' . $search . ' ' . $critaire;



    $fetch_cov_frais = $this->Model->datatable($query_secondaire);
    $data = array();
    $u = 1;
    foreach ($fetch_cov_frais as $info) {

      $nombre = $this->Model->getRequeteOne('select COUNT(rol_id) as nombre FROM roles WHERE rol_id=' . $info->ROLE_ID . '');

      $post = array();
      $post[] = $u++;
      $post[] = $info->DESCR_MODULE;
      $post[] = $info->statut_descr;
      $point = '';
      $point = "<center><a href='javascript:;'  class='btn btn-dark btn-md' onclick='get_profil(" . $info->ID_MENU_ETAPE_ROLE . ",\"" . $info->DESCR_MODULE . "\")'>
      " . $nombre['nombre'] . "

      </a></center>";
      $post[] = $info->rol_description;
      $post[] = $info->LINK;
      $statut='';
      $statut.="<div class='row'><span class='actionCust' title='Modifier'><a href=".base_url('matrice/Menu_Etape_Profil/getOne/'.$info->ID_MENU_ETAPE_ROLE)."><i class='fa fa-pencil'></i></a></span>


      <span class='actionCust' title='Supprimer'> <a href='#' data-toggle='modal' data-target='#mydelete" . $info->ID_MENU_ETAPE_ROLE . "'>
      <i class='fa fa-trash'></i>
      </a><div class='modal fade' id='mydelete" . $info->ID_MENU_ETAPE_ROLE . "'>
      <div class='modal-dialog'>
      <div class='modal-content'>

      <div class='modal-body'>
      <center>
      <h5><strong>Voulez-vous lui supprimer l'etape de </strong><br> <b style:'background-color:prink';><i style='color:green;'>" . $info->statut_descr . "</i></b><strong>??</strong>
      </h5>
      </center>
      </div>

      <div class='modal-footer'>
      <a class='btn btn-danger btn-md' href='" . base_url('matrice/Menu_Etape_Profil/retrait_action/') . $info->ID_MENU_ETAPE_ROLE . "'>Oui</a></span>
      <button class='btn btn-dark btn-md' data-dismiss='modal'>
      Non
      </button>
      </div>

      </div>
      </div>
      </div>
      </div>
      ";




      $post[] = $statut;

      $point_sm = '';
      $post[] = $point_sm;
    


      ///////////////////////

       //Les boutons de modification et d'activer et desactiver
      // $post[] = $statut;
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

  public function retrait_action($ID_MENU_ETAPE_ROLE)
  {
    $this->Model->delete('menu_etape_role', array('ID_MENU_ETAPE_ROLE' => $ID_MENU_ETAPE_ROLE));
    redirect(base_url('matrice/Menu_Etape_Profil'));
  } //fonction pour le retrait d'une action

  //fonction pour afficher le formulaire d'ajout
  public function insert()
  {

   $data['mod'] = $this->Model->getRequete('SELECT menu.ID_MENU,menu.DESCRIPTION as DESCR_MEN,module.DESCRIPTION AS DESCR_MOD FROM menu JOIN module ON module.ID_MODULE=menu.ID_MODULE where menu.ID_MODULE IN(8,18) ORDER BY menu.DESCRIPTION ASC');
    
    $data['prof'] = $this->Model->getRequete('SELECT `rol_id`,`rol_description` FROM `roles` WHERE 1 ORDER BY rol_description ASC');

    // $data['etape'] = $this->Model->getRequete('SELECT `ETAPE_TRAITEMENT_ID`,`DESC_ACTION` FROM `etape_traitement_new` WHERE 1 ORDER BY DESC_ACTION ASC');
    $data['etape'] = $this->Model->getRequete('SELECT `statut_id`,`statut_descr` FROM `doc_document_statut` WHERE 1 ORDER BY statut_descr ASC');
    

    $data['title'] = 'Ajout des menus';
    $this->page = 'menu_etape_role/Menu_Etape_Role_Add_View';
    $this->layout($data);

  } 

  //founction d'ajouter les menus
  public function add()
  {

    $ID_MENU = $this->input->post('ID_MENU');
    $controlleur = $this->input->post('controlleur');
    $ETAPE_ID = $this->input->post('ETAPE_ID');
    $ID_PROFIL = $this->input->post('profil[]');
    $DESCRIPTION = $this->input->post('DESCRIPTION');

    //print_r($DESCRIPTION);die();

    $this->form_validation->set_rules('ID_MENU', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
    $this->form_validation->set_rules('ETAPE_ID', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
    $this->form_validation->set_rules('profil[]', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
    $this->form_validation->set_rules('controlleur', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
   

    if ($this->form_validation->run() == FALSE) {
      $this->insert();
    } else {

      $count = count($ID_PROFIL);

        for ($i = 0; $i < $count; $i++) {

          $message = $this->Model->create('menu_etape_role', array('ROLE_ID' => $ID_PROFIL[$i], 'ID_MENU' => $ID_MENU,'ETAPE_ID'=>$ETAPE_ID,'DESCRIPTION'=>$DESCRIPTION,'LINK'=>$controlleur));

        }

        if ($message) {

          $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Enregistrement effectuée avec succès!!" . '</div>';

          redirect(base_url('matrice/Menu_Etape_Profil'));
        }


      // $url=$this->Model->getRequeteOne('SELECT `ID_MENU`,`DESCRIPTION`,`URL` FROM `menu` WHERE `ID_MENU`='.$ID_MENU);

      // $array_too = array('ID_MENU' => $ID_MENU, 'LINK' => $controlleur, 'ETAPE_ID' => $ETAPE_ID);

      // $check = $this->Model->getOne("menu_etape_role", $array_too);

      // if (!empty($check)) {
      //   $message = array(
      //     'class' => 'text-danger',
      //     'message' => 'Le menu existé'
      //   );

      //   $this->session->set_flashdata("dash", $message);
      //   $this->insert();
      // } else {

      
      //   $count = count($ID_PROFIL);

      //   for ($i = 0; $i < $count; $i++) {

      //     $message = $this->Model->create('menu_etape_role', array('ROLE_ID' => $ID_PROFIL[$i], 'ID_MENU' => $ID_MENU,'ETAPE_ID'=>$ETAPE_ID,'DESCRIPTION'=>$DESCRIPTION,'LINK'=>$controlleur));

      //   }

      //   if ($message) {

      //     $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Enregistrement effectuée avec succès!!" . '</div>';

      //     redirect(base_url('matrice/Menu_Etape_Profil'));
      //   }

      // }

    }
  } 




  function get_profil($ID_MENU)
  {

    $profils = $this->Model->getRequete("SELECT menu_profil.`ID_PROFIL`,roles.rol_description FROM roles JOIN menu_profil ON menu_profil.ID_PROFIL=roles.rol_id WHERE 1 AND menu_profil.ID_MENU=".$ID_MENU." ORDER BY roles.rol_description ASC");

    $html = '<label for="Ftype">Profil</label> <br>
    <div class="card"><div class="card-body"><div class="row">';

    $exist = array();

    foreach ($profils as $key) {

      $html .= "<div class='col-md-4'><label><input name='profil[]' value='".$key['ID_PROFIL']."' type='checkbox'> " . $key['rol_description'] . "</label></div>";
    }
    $html.= '</div></div></div>';

    echo $html;

  }


  function get_etape($ID_MENU)
  {


    $etape = $this->Model->getRequete("SELECT etap.`ETAPE_TRAITEMENT_ID`,etap.`DESC_ACTION`,etapes_document.DESCRIPTION FROM `etape_traitement_new` etap JOIN etapes_document ON etapes_document.ETAPE_ID = etap.`ETAPE_ID` WHERE 1  ORDER BY etap.`DESC_ACTION` ASC");

    $html='<option value="">---selectionner---</option>';
    foreach ($etape as $key)
    {
      $html.='<option value="'.$key['ETAPE_TRAITEMENT_ID'].'">'.$key['DESC_ACTION'].'</option>';
    }
    echo json_encode($html);
  }


   //fonction pour afficher le formulaire de modificaction en renvoyant id choisi
  public function getOne($ID_MENU_ETAPE_ROLE)
  {
    $men = $this->Model->getOne('menu_etape_role', array('ID_MENU_ETAPE_ROLE' => $ID_MENU_ETAPE_ROLE));
    // $data['menu'] = $this->Model->getRequete('SELECT ID_MENU,DESCRIPTION FROM menu where 1 and STATUT = 1  order BY DESCRIPTION ASC');

      $data['menu'] = $this->Model->getRequete('SELECT menu.ID_MENU,menu.DESCRIPTION as DESCR_MEN,module.DESCRIPTION AS DESCR_MOD FROM menu JOIN module ON module.ID_MODULE=menu.ID_MODULE where menu.ID_MODULE IN(8,18) ORDER BY menu.DESCRIPTION ASC');

    $data['etape'] = $this->Model->getRequete('SELECT statut_id,statut_descr FROM doc_document_statut where 1  order BY statut_descr ASC');

    $exit = $this->Model->getRequete('SELECT roles.rol_id FROM menu_etape_role JOIN roles on menu_etape_role.ROLE_ID= roles.rol_id WHERE roles.rol_id=' . $men['ROLE_ID'] . ' and roles.rol_active=1  ');

    $profil='';

    $prof = array();
    foreach ($exit as $key) {
      $prof[] = $key['rol_id'];

    }


    $data['prof'] = $prof;

    $data['men'] = $men;

    $data['title'] = 'Modification des menus';
    $this->page = 'menu_etape_role/Menu_Etape_Role_Update_View';
    $this->layout($data);
  } 


  //fonction de modifier le menu
  public function update()
  {
    $ID_MENU_ETAPE_ROLE = $this->input->post('ID_MENU_ETAPE_ROLE');
    $ID_MENU = $this->input->post('ID_MENU');
    $LINK = $this->input->post('LINK');
    $DESCRIPTION = $this->input->post('DESCRIPTION');
    $ETAPE_ID = $this->input->post('ETAPE_ID');
    $ID_PROFIL = $this->input->post('profil[]');

    $menu = $this->Model->getOne('menu_etape_role', array('ID_MENU_ETAPE_ROLE' => $ID_MENU_ETAPE_ROLE));


    $this->form_validation->set_rules('LINK', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
    $this->form_validation->set_rules('ID_MENU', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

    $this->form_validation->set_rules('profil[]', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
    // $this->form_validation->set_rules('DESCRIPTION', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
    $this->form_validation->set_rules('ETAPE_ID', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

    if ($this->form_validation->run() == FALSE) {
      $this->getOne($ID_MENU_ETAPE_ROLE);
    } else {

      $array = array('ROLE_ID'=>$ID_PROFIL);

      // $message = $this->Model->update('menu_etape_role', array('ID_MENU_ETAPE_ROLE' => $ID_MENU_ETAPE_ROLE), $array);

      // $this->Model->delete('menu_profil', array('ID_MENU' => $ID_MENU));
     
     if(!empty($array)){

      $this->Model->delete('menu_etape_role', array('ID_MENU_ETAPE_ROLE' => $ID_MENU_ETAPE_ROLE));
      
       foreach ($ID_PROFIL as $key => $value) {

        $dataUpdate = array(
          'ROLE_ID' => $value,
          'ID_MENU' => $ID_MENU,
          'LINK' => $LINK,
          'ETAPE_ID' => $ETAPE_ID,
          'DESCRIPTION' => $DESCRIPTION,
        );

        $message=$this->Model->create('menu_etape_role',$dataUpdate);

     }
   }

      // foreach ($ID_PROFIL as $key => $value) {

      //   $dataUpdate = array(
      //     'ROLE_ID' => $value,
      //     'ID_MENU' => $ID_MENU,
      //     'LINK' => $LINK,
      //     'ETAPE_ID' => $ETAPE_ID,
      //     'DESCRIPTION' => $DESCRIPTION,
      //   );

      //   $message=$this->Model->update('menu_etape_role',array('ID_MENU_ETAPE_ROLE' => $ID_MENU_ETAPE_ROLE), $dataUpdate);
      // }

      if ($message) {
        $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Modification effectuée avec succès!!" . '</div>';
        $this->session->set_flashdata($data);
        redirect(base_url('matrice/Menu_Etape_Profil/'));

      }
      
    }
  } 
  





}


?>