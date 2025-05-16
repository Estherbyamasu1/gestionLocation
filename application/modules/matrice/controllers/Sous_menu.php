<?php
/**
 * @author  ELOGE
 * 
 * email:nirema.eloge@mediabox.bi
 * 
 * 
 * class qui nous aide a traiter les informations du sous menu
 */
class Sous_menu extends MY_Controller 
{

        /**
         * fonction pour afficher la liste des sous menu
         * 
         *  
         */
        public function index(){


            $data['title'] = 'Liste des Sous Menu';
            $this->page = 'Sous_menu_view';
            $this->layout($data);
            // $this->load->View("Sous_menu_view");

        }
          /**
         * fonction qui retourne la liste des sous menu  
         */
    public function select_all_data()
    {
		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
		$var_search=str_replace("'", "\'", $var_search);
		$query_principal= 'SELECT ID_SOUS_MENU,sous_menu.CONTROLLER,sous_menu.DESCRIPTION as SOUS_MENU,sous_menu.STATUT,menu.DESCRIPTION AS MENU,sous_menu.URL AS URL_MENU from sous_menu left join menu on menu.ID_MENU=sous_menu.ID_MENU';

		$limit='LIMIT 0,10';


		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}
		$order_by='';
        if ($_POST["order"][0]['column']!=0) {
    			$order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : 'ORDER BY sous_menu.DESCRIPTION  ASC';
                # code...
        }

	
		$search = !empty($_POST['search']['value']) ?  (" WHERE sous_menu.DESCRIPTION LIKE '%$var_search%' OR sous_menu.URL LIKE '%$var_search%' OR menu.DESCRIPTION LIKE '%$var_search%'") :'';   
		$critaire = '';
        $order_by='ORDER BY sous_menu.DESCRIPTION  ASC';
		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.' '.$limit;
		$query_filter = $query_principal.' '.$critaire.' '.$search;
        $abonne='';
		$fetch_enqt = $this->Model->datatable($query_secondaire);
		$data = array();
		$u=1;
		foreach($fetch_enqt as $info)
		{
            $count_profile=$this->Model->getRequete("SELECT count(ID_PROFIL) as nombre from sous_menu_profil  where sous_menu_profil.ID_SOUS_MENU=".$info->ID_SOUS_MENU."");
           
            // $s_m=str_replace("'", "\'", $info->SOUS_MENU);
            $s_m=$info->SOUS_MENU;



            $var="";
			$post=array();
			$post[]=$u++; 
			$post[]=$info->SOUS_MENU;
			$post[]=$info->MENU;
            $post[]=$info->URL_MENU;
            $post[]=$info->CONTROLLER;

            
            $post[]="<center><a href='#'data-toggle='modal' onclick='get_profil(".$info->ID_SOUS_MENU.")' class='btn btn-dark'>".$count_profile[0]['nombre']."</a></center>"; 
	

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

            $statut='<div class="row"><span class="actionCust" title="Modifier"><a href="'.base_url('matrice/Sous_menu/get_row/'.$info->ID_SOUS_MENU).'"><i class="fa fa-pencil"></i></a></span>
          

                <span data-toggle="modal" data-target="#myModal'.$info->ID_SOUS_MENU.'" title="'.$stt.'" class="actionCust"><a href="#"><i class="fa fa-trash"></i></a></span>

                <div class="modal fade" id="myModal'.$info->ID_SOUS_MENU.'" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          
                          <div class="modal-body">
                                  <div class="row">
                                      <div class="col-lg-12 mb-4">
                                          <center>
                      <h5><strong>Voulez-vous  '.$stt.' le sous menu  <i style="color:green;">'.$info->SOUS_MENU.'</i></strong><br> <b style:"background-color:prink";></b>
                      </h5>
                      </center>
                                      </div>

                                  </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                              <a class="btn btn-danger" href="' . base_url('matrice/Sous_menu/update_row/' . $info->ID_SOUS_MENU.'/'.$info->STATUT) . '">'.$stt.'</a>
                          </div>
                      </div>
                  </div>
                </div
            </div>';

			$post[]=$statut;
			$data[]=$post;  
		}


  
		$output = array(
			"draw" => intval($_POST['draw']),
			"recordsTotal" =>$this->Model->all_data($query_principal),
			"recordsFiltered" => $this->Model->filtrer($query_filter),
			"data" => $data
		);
		echo json_encode($output);


    }

          /**
         * fonction qui retourne la detail des profils 
         * 
         *  
         */
    public function detail_profil($id=0){
        $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
        $var_search=str_replace("'", "\'", $var_search);
        $query_principal= 'SELECT profil.DESCRIPTION from sous_menu_profil LEFT join profil
        on profil.ID_PROFIL=sous_menu_profil.ID_PROFIL left join sous_menu on sous_menu.ID_MENU=sous_menu_profil.ID_SOUS_MENU where sous_menu_profil.ID_SOUS_MENU='.$id;

        $limit='LIMIT 0,10';


        if($_POST['length'] != -1){
            $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
        }
        $order_by='';
        if ($_POST["order"][0]['column']!=0) {
                $order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : 'ORDER BY profil.DESCRIPTION  ASC';
                # code...
        }

    
        $search = !empty($_POST['search']['value']) ?  (" AND profil.DESCRIPTION LIKE '%$var_search%'") :'';   
        $critaire = '';
        $order_by='ORDER BY profil.DESCRIPTION  ASC';
        $query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.' '.$limit;
        $query_filter = $query_principal.' '.$critaire.' '.$search;
        $abonne='';
        $fetch_enqt = $this->Model->datatable($query_secondaire);
        $data = array();
        $u=1;
        foreach($fetch_enqt as $info)
        {
            $post=array();
            $post[]=$u++; 
            $post[]=$info->DESCRIPTION;
            $data[]=$post;  
        }
  
        $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" =>$this->Model->all_data($query_principal),
            "recordsFiltered" => $this->Model->filtrer($query_filter),
            "data" => $data
        );
        echo json_encode($output);


    }

        /**
         * fonction qui retourne la detail des actions 
         * 
         *  
         */

    public function detail_action($id=0){
        $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
        $var_search=str_replace("'", "\'", $var_search);
       
        $query_principal='SELECT DISTINCT action_sous_menu.ID_SOUS_MENU, profil.DESCRIPTION,profil.ID_PROFIL from sous_menu_profil JOIN profil on sous_menu_profil.ID_PROFIL=profil.ID_PROFIL JOIN sous_menu on sous_menu_profil.ID_SOUS_MENU=sous_menu.ID_SOUS_MENU JOIN action_sous_menu ON action_sous_menu.ID_PROFIL=profil.ID_PROFIL where 1 and action_sous_menu.ID_SOUS_MENU='.$id;



        $limit='LIMIT 0,10';


        if($_POST['length'] != -1){
            $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
        }
        $order_by='';
        if ($_POST["order"][0]['column']!=0) {
                $order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : '';
                # code...
        }

    
        $search = !empty($_POST['search']['value']) ?  (" AND profil.DESCRIPTION LIKE '%$var_search%'") :'';   
        $critaire = '';
        $order_by = 'ORDER BY profil.DESCRIPTION  ASC';
        $query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.' '.$limit;
        $query_filter = $query_principal.' '.$critaire.' '.$search;
        $abonne='';
        $fetch_enqt = $this->Model->datatable($query_secondaire);
        $data = array();
        $u=1;
        foreach($fetch_enqt as $info)
        {
            $actions=$this->Model->getRequete('SELECT * FROM `action_sous_menu` WHERE `ID_SOUS_MENU`='.$info->ID_SOUS_MENU.' AND `ID_PROFIL`='.$info->ID_PROFIL);

            $post=array();
            $post[]=$u++; 
            $post[]=$info->DESCRIPTION;
            $post[]="<a href='javascript:;'  class='btn btn-dark btn-md' onclick='get_action_profil(".$info->ID_PROFIL.",".$info->ID_SOUS_MENU.",\"".$info->DESCRIPTION."\")'>".sizeof($actions)."</a>";
            $data[]=$post;  
        }

  
        $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" =>$this->Model->all_data($query_principal),
            "recordsFiltered" => $this->Model->filtrer($query_filter),
            "data" => $data
        );
        echo json_encode($output);


    }

    /**
     * fonction qui retourne le detail des actions pour chaque profil
     * 
     *  
     */
    function detail_act_profil($id=0, $idsousmenu=0)
    {
        
       $query_principal= 'SELECT action_sous_menu.ID_ACTION_SOUS_MENU, actions.DESCRIPTION, actions.STATUT FROM action_sous_menu JOIN actions ON action_sous_menu.ID_ACTION=actions.ID_ACTION JOIN profil on action_sous_menu.ID_PROFIL=profil.ID_PROFIL WHERE 1 and action_sous_menu.ID_PROFIL='.$id.' and action_sous_menu.ID_SOUS_MENU='.$idsousmenu;

       $var_search= !empty($_POST["search"]["value"]) ? $_POST["search"]["value"] : null;
       $limit='LIMIT 0,10';

       $draw = isset($_POST['draw']);
       $start = isset($postData['start']);

       if(isset($_POST["length"]) && $_POST["length"] != -1)
       {
           $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
       }


        
        $order_by='';

        $search = !empty($_POST['search']['value']) ?  (" AND (actions.DESCRIPTION  LIKE '%$var_search%')") :'';  

        $order_column='';

        $order_column = array('actions.ID_ACTION','actions.DESCRIPTION');

        $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY actions.DESCRIPTION ASC';

        $critaire = 'and profil.ID_PROFIL='.$id;

   
        $query_secondaire=$query_principal.' '.$search.' '.$critaire.' '.$order_by.'   '.$limit;
   
        $query_filter = $query_principal.' '.$critaire.' '.$search;
       


        $fetch_cov_frais = $this->Model->datatable($query_secondaire);
        $data = array();
        $u=1;
        foreach($fetch_cov_frais as $info)
        {
           $post=array();
           $post[]=$u++; 
           $post[]=$info->DESCRIPTION;
           $statut = '';
           if($info->STATUT==0){
            $statut="<span class ='text-success fa fa-remove'></span>"; 
           }
           else{
            $statut="<span class ='text-success fa fa-check'></span>";

           }
           $post[]=$statut;
           $post[]="<a href='#' data-toggle='modal' data-target='#mydelete".$info->ID_ACTION_SOUS_MENU."'>
                 <label class='text-danger'>&nbsp;&nbsp;Supprimer</label>
                 </a><div class='modal fade' id='mydelete".$info->ID_ACTION_SOUS_MENU."'>
                 <div class='modal-dialog'>
                  <div class='modal-content'>

                  <div class='modal-body'>
                  <center>
                  <h5><strong>Voulez-vous lui retire l'action</strong><br> <b style:'background-color:prink';><i style='color:green;'>".$info->DESCRIPTION."</i></b><strong>??</strong>
                  </h5>
                  </center>
                  </div>

                  <div class='modal-footer'>
                  <a class='btn btn-danger btn-md' href='" . base_url('matrice/Sous_menuretrait_action/').$info->ID_ACTION_SOUS_MENU . "'>Oui</a>
                  <button class='btn btn-secondary btn-md' data-dismiss='modal'>
                  Non
                  </button>
                  </div>

                  </div>
                  </div>
                  </div>";
      

           
           $data[]=$post;
        }

        $output = array(
          "draw" => intval($draw),
          "recordsTotal" =>$this->Model->all_data($query_principal),
          "recordsFiltered" => $this->Model->filtrer($query_filter),
          "data" => $data
        );
       echo json_encode($output);
  
    }


    

   /**
      * fonction pour afficher la formulaire du sous menu
       * 
         * 
           */
    public function add_sous_menu($idmenu=0){

        $data['menu']=$this->Model->getRequete("SELECT ID_MENU,DESCRIPTION,STATUT FROM `menu` WHERE ID_MENU=".$idmenu." ORDER BY DESCRIPTION ASC");
        // print_r($data['menu']);die();
        $data['idmenu']=$idmenu;

        $data['profil']=$this->Model->getRequete("SELECT rol_id,rol_code,rol_description FROM `roles` ORDER BY `rol_description` ASC"); 

        $data['title'] = 'Ajout des sous menus';
        $this->page = 'Sous_Menu_Add_View';
        $this->layout($data);

        // $this->load->View("Sous_Menu_Add_View",$data);
    }

    /**
     * 
     * fonction qui retourne les profils selon menu selectione
     * 
     * 
     */

    public  function get_profil($id){
        $profils=$this->Model->getRequete("SELECT roles.rol_id,roles.rol_description FROM `menu_profil` 
        left join roles on roles.rol_id=menu_profil.ID_PROFIL WHERE ID_MENU= ".$id." GROUP BY ID_PROFIL ORDER BY rol_description ASC");

        $html="<label for='Ftype'>Profil</label> <div class='card'><div class='card-body'>";
        foreach ($profils as $key) {
            $html.="<div class='col-md-4'><label><input name='profil[]' value='".$key['rol_id']."' type='checkbox'>".$key['rol_description']."</label></div>";
        //$html .= '<option value="'.$menu['ID_PROFIL'].'">'.$menu['DESCRIPTION'].'</option>';
        }
        $html.="</div></div>";
        echo $html;
    }

    /***
     * 
     * fonction qui nous aide a faire l'isnertion dans la table sous menu
     * 
     * 
     */
    public function insert(){
        
            $description=$this->input->post("description");
            $menu=$this->input->post("menu");
            $controlleur=$this->input->post("controlleur");
            $profile=$this->input->post("profil[]");
            
            if(!empty($menu)){
                $module = $this->Model->getRequeteOne('SELECT module.MOT_CLE FROM module 
                left join menu on menu.ID_MODULE=module.ID_MODULE  where menu.ID_MENU='.$menu);
              $url = $module['MOT_CLE'] .'/'. $controlleur;
            }

        
            $statut=1;

            $this->form_validation->set_rules('description', '', 'trim|required',array('required'=>"Champ obligatoire"));
            $this->form_validation->set_rules('menu','','trim|required',array('required'=>"Champ obligatoire"));
            $this->form_validation->set_rules('controlleur','','trim|required',array('required'=>"Champ obligatoire"));
            $this->form_validation->set_rules('profil[]','','trim|required',array('required'=>"Champ obligatoire"));


            if($this->form_validation->run()==FALSE){

                // print_r($profile);die();
                $this->add_sous_menu();
            }
            else{
                $array= array('DESCRIPTION'=>$description,'ID_MENU'=>$menu,'CONTROLLER'=>$controlleur,'URL'=>$url,'STATUT'=>$statut);
                $check=$this->Model->getOne("sous_menu",$array);
                if (empty($check)) {

                    $status=$this->Model->insert_last_id('sous_menu',$array); 
                    $count=count($profile); 
                    for ($i=0; $i <$count ; $i++) { 
                        $this->Model->create('sous_menu_profil',array('ID_PROFIL'=>$profile[$i],'ID_SOUS_MENU'=>$status));       
                        
                      } 
                    if($status==TRUE)
                    {
                      
                        $data['message']='<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-dark">'."Sous menu a étè enregistre avec success..!!!".'</div>';
				        $this->session->set_flashdata($data);
                        redirect('matrice/Sous_menu/index');
                        
                    }
                    else
                    {
                        $data['message']='<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-dark">'."SOUS MENU NON ENREGISTRE..!!".'</div>';
				        $this->session->set_flashdata($data);
                        redirect('matrice/Sous_menu/index');               
                        }
                }else {
                    $data=array(
                        'class' => 'text-danger',
                        'message' => 'Sous menu existé..!!'
                    );
                       $this->session->set_flashdata("dash",$data);
                        redirect('matrice/Sous_menu/add_sous_menu');               
                  
                }
             }
            

            
    }


        /**
         * fonction pour charger  la formulaire
         * 
         */
        public function get_row($id){

            $row= $this->Model->getOne('sous_menu', array('ID_SOUS_MENU'=>$id));
            $profil=$this->Model->getRequete("SELECT roles.rol_id,roles.rol_description from sous_menu_profil LEFT join roles on roles.rol_id=sous_menu_profil.ID_PROFIL where roles.rol_active=1 AND sous_menu_profil.ID_SOUS_MENU=".$row['ID_SOUS_MENU']);

            // print_r($profil);die();
            
            $array=array();

                foreach ($profil as $value) {
                    $array[]=$value['rol_id'];

            }
            $profile=$this->Model->getRequete("SELECT ID_PROFIL,DESCRIPTION,STATUT FROM `profil`   WHERE 1 AND	STATUT=1 ORDER BY DESCRIPTION ASC");
                                                    
            
            $data['array']=$array;
            $data['profil']=$profil;
            $data['profile']=$profile;


            $data['row']=$row;
       
            $data['title'] = 'Modification des sous menus';
            $this->page = 'Sous_Menu_Update_View';
            $this->layout($data);
            // $this->load->view('Sous_Menu_Update_View', $data);             
        }

    /***
     * fonction qui nous aide a faire l'update dans la table sous menu
     * 
     * 
     */
    public function update(){
        $id=$this->input->post("id");       
        $description=$this->input->post("description");
        $menu=$this->input->post("menu");
        $controlleur=$this->input->post("controlleur");
        $profile=$this->input->post("profil");
        
        if(!empty($menu)){
            $module = $this->Model->getRequeteOne('SELECT module.DESCRIPTION FROM module 
            left join menu on menu.ID_MODULE=module.ID_MODULE  where menu.ID_MENU='.$menu);
          $url = $module['DESCRIPTION'] .'/'. $controlleur;
        }
    

        $this->form_validation->set_rules('description', '','trim|required',array('required'=>"Champ obligatoire"));
        $this->form_validation->set_rules('menu', '','trim|required',array('required'=>"Champ obligatoire"));
        $this->form_validation->set_rules('controlleur', '','trim|required',array('required'=>"Champ obligatoire"));
        $this->form_validation->set_rules('profil[]','','trim|required',array('required'=>"Champ obligatoire"));
        if($this->form_validation->run()==FALSE){
            $this->get_row($id);
        }
        else{
            $array= array('ID_SOUS_MENU'=>$id,'DESCRIPTION'=>$description,'ID_MENU'=>$menu,'CONTROLLER'=>$controlleur,'URL'=>$url);

           $status=$this->Model->update('sous_menu',array('ID_SOUS_MENU'=>$id),$array);

           $this->Model->delete('sous_menu_profil',array('ID_SOUS_MENU'=>$id));

           foreach ($profile as $key =>$value) {
               $data=array("ID_SOUS_MENU"=>$id ,"ID_PROFIL"=>$value);

              $this->Model->create('sous_menu_profil',$data);        
           }
            if($status==TRUE)
            {
                $data['message']='<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-dark">'."Modification effectuée avec succès!!".'</div>';
    
                $this->session->set_flashdata($data);
                redirect(base_url('matrice/Sous_menu')); 
                
            }
            else
            {
                
                $data['message']='<div class="alert alert-success text-center" id="message">La modification est echoué</div>';
                $this->session->set_flashdata($data);
                redirect(base_url('matrice/Sous_menu'));               
                }
        }
        

        
    }


    /**
     * function pour modifier statut
     * 
     */
    public function update_row($id){

        $data['rows']= $this->Model->getOne('sous_menu', array('ID_SOUS_MENU'=>$id));
        if ($data['rows']['STATUT']==0) {
            $data= array('ID_SOUS_MENU'=>$id,'STATUT'=>"1");
            $status=$this->Model->update('sous_menu',array('ID_SOUS_MENU'=>$id),$data);
            if($status==TRUE)
            {
                $data=array(
                    'class' => 'success',
                    'message' => 'Sous menu a étè activé avec succès..!!'
                );
    
                $this->session->set_flashdata("dash",$data);
                redirect('matrice/sous_menu/index');
                
            }
            else
            {
                $data=array(
                    'class' => 'danger',
                    'message' => "Echec d'active sous menu..!!"
                );
                $this->session->set_flashdata("dash",$data);
                redirect('matrice/sous_menu/index');               
                }

            redirect('matrice/sous_menu/index');               
            


        } else {
            $data= array('ID_SOUS_MENU'=>$id,'STATUT'=>"0");
            $status=$this->Model->update('sous_menu',array('ID_SOUS_MENU'=>$id),$data);
            if($status==TRUE)
            {
                $data=array(
                    'class' => 'success',
                    'message' => 'Sous menu a étè desactivé avec succès..!!'
                );
    
                $this->session->set_flashdata("dash",$data);
                redirect('matrice/sous_menu/index');
                
            }
            else
            {
                $data=array(
                    'class' => 'danger',
                    'message' => 'desactivation echoué..!!'
                );
                $this->session->set_flashdata("dash",$data);
                redirect('matrice/sous_menu/index');               
                }
            redirect('matrice/sous_menu/index');
        }
    }
          


}




?>

