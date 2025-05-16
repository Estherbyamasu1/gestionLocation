<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {


  public function __construct()
  {
    parent::__construct();         
    include APPPATH.'third_party/fpdf/fpdf.php'; 
    $this->is_auth();    
}

public function is_auth()
{
    if(empty($this->session->userdata('backend_member'))){     
      redirect(base_url('backend'));   
  }

    /*if (!$this->backend_auth_library->permission('Users/index')) {
      redirect(base_url()."home/Home");   
  }*/
}

public function index()
{
    $sql = "SELECT mbr.*, pr.bureau_descr, rl.rol_description,mbr.commune_id, concat(`province_name`,' ', `commune_name`, ' ', `ZONE_NAME`, ' ',`colline`) as localite FROM members as mbr 
    LEFT JOIN doc_bureaux AS pr ON pr.bureau_id = mbr.bureau_id
    LEFT JOIN roles AS rl ON rl.rol_id = mbr.rol_id
    LEFT join provinces on provinces.province_id=mbr.province_id
    LEFT join communes on communes.commune_id=mbr.commune_id
    LEFT join zones on zones.ZONE_ID=mbr.zone_id
    LEFT join collines on collines.colline_id=mbr.colline_id
    ";

    $users = $this->My_model->getRequete($sql);
    $mbr='';
    foreach ($users as $user) {
        if (!empty($user['creer_par'])) {
            $utilisateur=$this->My_model->getRequeteOne('SELECT mbr.mbr_fname,mbr.mbr_lname FROM members AS mbr WHERE `mbr_id`='.$user['creer_par']);

            $mbr=$utilisateur['mbr_fname'].' '.$utilisateur['mbr_lname'];
        }else{
            $mbr='N/A';
        }

        $bureau_user=$this->Model->getRequete("SELECT * FROM `affectation_bureau_user` WHERE USER_ID=".$user['mbr_id']);
        // print_r($user['creer_par']);die();
        $date = new DateTime($user['mbr_datecreated']);
        $state = $this->My_model->dropdown_etat_member($user['mbr_authorized']);
        $state_oppose = ($user['mbr_authorized'] == 1)? $this->My_model->dropdown_etat_member(2):$this->My_model->dropdown_etat_member(1);
        $id_oppose = ($user['mbr_authorized'] == 1)? 2:1;

        $etat = ($user['mbr_authorized'] == 1)?'<span class="mode mode_on">'.$state.'</span>':'<span class="mode mode_off">'.$state.'</span>';
        $provinces = $this->Model->getRequete('SELECT * FROM `role_province` WHERE `USER_ID`=' . $user['mbr_id']);
        $sub_array = [];
        $sub_array[] = $user['mbr_id'];
        $sub_array[] = $user['mbr_fname']." ".$user['mbr_lname'];
        $sub_array[] = $user['mbr_description'];
        $sub_array[] = $user['mbr_email'];
        $sub_array[] = $user['mbr_telephone'];
        //$sub_array[] = $user['proince_id']." ".$user['commune_id']." ".$user['ZONE_ID']." ".$user['colline_id']." ".;
        $sub_array[] = $user['localite'];
        $sub_array[] = "<center><a class='btn btn-sm btn-dark' onclick='show_modal_bureau(".$user['mbr_id'].")' style='cursor:pointer;'>".sizeof($bureau_user)."</a></center>";
        $sub_array[] = "<center><a href='#' class='btn btn-dark' onclick='get_role(". $user['mbr_id'] .")' style='cursor:pointer; color:white'>" . sizeof($provinces) . "</a></center>";
        $sub_array[] = $user['rol_description'];
        $sub_array[] = $mbr;
        $sub_array[] = $etat;
        $sub_array[] = $date->format('d/m/Y');

    //if ($this->backend_auth_library->permission('Users/detail')) {
        $sub_array[] = '
        
        <span class="actionCust" title="Changer mot de passe"><a href="'.base_url('matrice/Users/changer_mot_de_passe/'.$user['mbr_id']).'"><i class="fa fa-edit"></i></a></span>
        <span class="actionCust"><a href="'.base_url('matrice/Users/affectation_province/'.$user['mbr_id']).'" title="Affectation aux provinces"><i class="fa fa-bank"></i></a></span>
        <span class="actionCust"><a href="'.base_url('matrice/Users/affectation_bureau/'.$user['mbr_id']).'" title="Affectation"><i class="fa fa-bank"></i></a></span>
        <span class="actionCust" title="Modifier"><a href="'.base_url('matrice/Users/nouveau/'.$user['mbr_id']).'"><i class="fa fa-pencil"></i></a></span>
        <span data-toggle="modal" data-target="#myModal'.$user['mbr_id'].'" title="Fichier PDF" class="actionCust"><a href="#"><i class="fa fa-trash"></i></a></span>
        
        <div class="modal fade" id="myModal'.$user['mbr_id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header  d-flex justify-content-center">
        <h5 class="modal-title text-center text-white">Changement du statut d\'un comptre d\'utilisateur</h5>
        </div>
        <div class="modal-body">
        <div class="row">
        <div class="col-lg-6 mb-4">
        <div class="input-group">
        Voullez vous le changer le statut de l\'utilisateur <b>'.$user['mbr_fname'].' '.$user['mbr_lname'].'</b> vers <b>'.$state_oppose.'</b>?.
        </div>
        </div>

        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <a href="'.base_url('matrice/Users/desactiver/'.$user['mbr_id'].'/'.$id_oppose).'" type="button" class="btn main_bt">'.$state_oppose.'</a>
        </div>
        </div>
        </div>
        </div>

        <!-- Modal End -->

        ';
    //}

        $this->table->add_row($sub_array);
    }

    $template = $this->mbx_library->table_head();
    $this->table->set_template($template);
    $this->table->set_heading('#', 'UTILISATEUR', 'DESCRIPTION','EMAIL','TELEPHONE', 'LOCALITE','BUREAU','PROVINCE','ROLE','STATUT','ENREGISTRE','CREER LE','OPTION');

        //Data
    $data['title'] = "Utilisateurs";

    $this->page = 'users/Users_Liste_View';

    $this->layout($data);    
}

public function nouveau(){

    $mbr_id = !empty($this->uri->segment(4))?$this->uri->segment(4):$this->input->post('mbr_id');

    if($mbr_id > 0){
        $user = $this->My_model->getOne('members',['mbr_id'=>$mbr_id]);
    }else{
        $user = $this->My_model->emptyOne('members');
    }

    $this->form_validation->set_rules('mbr_fname', 'Prenom', 'required');
    $this->form_validation->set_rules('mbr_lname', 'Prenom', 'required');
    $this->form_validation->set_rules('bureau_id', 'Bureau', 'required');
    $this->form_validation->set_rules('rol_id', 'Role', 'required');
    $this->form_validation->set_rules('province_id', 'Province', 'required');
    $this->form_validation->set_rules('commune_id', 'Commune', 'required');
    $this->form_validation->set_rules('ZONE_ID', 'Zone', 'required');
    $this->form_validation->set_rules('colline_id', 'Colline', 'required');
    $this->form_validation->set_rules('mbr_authorized', 'Etat', 'required');
   // $this->form_validation->set_rules('compagnie_id', 'compagnie', 'required');
    

    if($mbr_id > 0){
        $this->form_validation->set_rules('mbr_email', 'Email', 'required');  
        $this->form_validation->set_rules('mbr_telephone', 'Telephone', 'required');
    }else{
        $this->form_validation->set_rules('mbr_telephone', 'Telephone', 'required|is_unique[members.mbr_telephone]');
        $this->form_validation->set_rules('mbr_email', 'Email', 'required|is_unique[members.mbr_email]');  
    }

    if ($this->form_validation->run() == FALSE) {
        $data['title'] = $mbr_id > 0?"Mis a jour des information de ".$user['mbr_fname']." ".$user['mbr_lname']:"Nouveau utilisateur";
        $data['user'] = $user;
        $this->page = 'users/Users_New_View';
        $this->layout($data);   
    }else{
        $this->db->set('mbr_fname', $this->input->post('mbr_fname'));
        $this->db->set('mbr_lname', $this->input->post('mbr_lname'));
        $this->db->set('mbr_telephone', $this->input->post('mbr_telephone'));
        $this->db->set('mbr_email', $this->input->post('mbr_email'));
        $this->db->set('mbr_description', $this->input->post('mbr_description'));
        $this->db->set('bureau_id', $this->input->post('bureau_id'));
        $this->db->set('rol_id', $this->input->post('rol_id'));
        $this->db->set('province_id', $this->input->post('province_id'));
        $this->db->set('commune_id', $this->input->post('commune_id'));
        $this->db->set('zone_id', $this->input->post('ZONE_ID'));
        $this->db->set('colline_id', $this->input->post('colline_id'));
        $this->db->set('mbr_authorized', $this->input->post('mbr_authorized'));            
        $this->db->set('is_urgence_visa', $this->input->post('flexRadioDefault'));            
        $this->db->set('creer_par', $this->backend_member->mbr_id);  
        $this->db->set('compagnie_id', $this->input->post('compagnie_id'));

        // $user_id=$this->backend_member->mbr_id;

        //print_r($user_id);die();                      

        if($mbr_id > 0){
            $this->db->where('mbr_id',$mbr_id); 
            $this->db->update('members');
        }else{
            $password = $this->mbx_library->generate_string(8);

            $this->db->set('mbr_datecreated',date('Y-m-d H:i:s'));
            $this->db->set('mbr_password',md5($password));
            $mbr_id = $this->db->insert('members');

            $subject = "CGM - Vos identifiants.";
            $message = "Bonjour, <br>".$this->input->post('mbr_fname')." ".$this->input->post('mbr_fname')." Vos identifiants pour se connecter la plateforme CGM <a href='".base_url('Backend')."'> Application </a>. <br> Nom d'utilisateur : <b>".$this->input->post('mbr_email')."</b> <br> Mot de passe <b>".$password."</b> <br>. Pour plus, veuillez contacter votre service informatique.";
            $this->mbx_library->send_mail($this->input->post('mbr_email'), $subject, [], $message, []);

        }

        redirect(base_url('matrice/Users/index'));

    }

}
        //fonction pour afficher les communes
        function get_communes($province_id=0)
        {
            $communes=$this->Model->getRequete('SELECT commune_id,commune_name FROM communes WHERE province_id='.$province_id.' ORDER BY commune_name ASC');
            $html='<option value="">-</option>';
            foreach ($communes as $key)
            {
                $html.='<option value="'.$key['commune_id'].'">'.$key['commune_name'].'</option>';
            }
            echo json_encode($html);
        }
        //fonction pour afficher le zones
        function get_zones($commune_id=0)
        {
            $zones=$this->Model->getRequete('SELECT ZONE_ID,ZONE_NAME FROM zones WHERE commune_id='.$commune_id.' ORDER BY ZONE_NAME ASC');

            $html='<option value="">-</option>';
            foreach ($zones as $key)
            {
                $html.='<option value="'.$key['ZONE_ID'].'">'.$key['ZONE_NAME'].'</option>';
            }
            echo json_encode($html);
        }
        //fonction pour afficher les collines
        function get_collines($ZONE_ID=0)
        {
            $collines=$this->Model->getRequete('SELECT colline_id,colline FROM collines WHERE zone_id='.$ZONE_ID.' ORDER BY colline ASC');
            $html='<option value="">-</option>';
            foreach ($collines as $key)
            {
                $html.='<option value="'.$key['colline_id'].'">'.$key['colline'].'</option>';
            }
            echo json_encode($html);
        }



public function changer_mot_de_passe($id)
{
 $data['title'] ="Changement de mot de passe";
 $data['id'] =$id;
 $this->page = 'users/Changer_Mot_Passe_View';
 $this->layout($data);

}


public function nouveauPassword($value='')
{
 $password=$this->input->post('password');
 $id=$this->input->post('id');
 
 $npassword=$this->input->post('npassword');
 $cnfpassword=$this->input->post('cnfpassword');   
 // print_r($password);
 // print_r($npassword);die();

 $verification=$this->My_model->getOne('members',array('mbr_password'=>md5($password), 'mbr_id'=>$id)); 

 //print_r($verification);die();

 if(!empty($verification)){
   
  if ($verification['mbr_password']==md5($password)){

   if ($npassword==$cnfpassword) {  

    $sql= $this->My_model->update('members',array('mbr_id'=>$verification['mbr_id']),array('mbr_password'=>md5($cnfpassword))); 

   // print_r($sql);die();

     $to=$verification['mbr_email'];
     $subject='Changement  de mot de passe';
     $message='Bonjour<br>Votre  mot de passe a été faite avec succès.<br>Votre nouveau mot de passe
     <strong style="color:red;">'
     .$cnfpassword.' </strong><br>Merci cordialement<br>';

     $this->mbx_library->send_mail($to,$subject,$cc_emails=array(),$message,$attach=array());

     $data['message'] = "<div class='alert alert-danger text-center'> Consultez votre adresse e-mail !.</div>";

     $data['message'] = "<div class='alert alert-danger text-center'> Votre mot de passe à été modifié avec succes !.</div>";
     $this->session->set_flashdata($data);
     redirect(base_url('matrice/Users/index'));

   }else{

     $data['message'] = "<div style='float:inherit;' class=' alert alert-danger text-center'>".$this->lang->line('mot_asse_identiques').".</div>";
     $this->session->set_flashdata($data);
     redirect(base_url('matrice/Users/changer_mot_de_passe/'.$id));

   }

 }else{

  $data['message'] = "<div style='float:inherit;' class=' alert alert-danger text-center'>".$this->lang->line('ancien_mot_passe_incorrect')."</div>";
  $this->session->set_flashdata($data);
  redirect(base_url('matrice/Users/changer_mot_de_passe/'.$id));

}


}else{

 $data['message'] = "<div style='float:inherit;' class='alert alert-danger text-center'>l'ancien mot de passe est n'existe pas.</div>";
 $this->session->set_flashdata($data); 
 redirect(base_url('matrice/Users/changer_mot_de_passe/'.$id));             

}

}




public function desactiver(){
   $mbr_authorized = $this->uri->segment(5);
   $mbr_id = $this->uri->segment(4);
   $user = $this->My_model->getOne('members',['mbr_id'=>$mbr_id]);

   if(!empty($user)){
    $this->db->set('mbr_authorized',$mbr_authorized);
    $this->db->where('mbr_id',$mbr_id);
    $this->db->update('members');
}

redirect(base_url('matrice/Users/index'));     
}

//affectation des utilisateurs aux bureaux
function affectation_bureau($mbr_id)
{
    $data['user'] = $this->Model->getRequeteOne("SELECT `mbr_fname`,`mbr_lname` FROM `members` WHERE `mbr_id`=".$mbr_id);
    $data['bureaux'] = $this->Model->getRequete("SELECT `bureau_id`,`bureau_descr` FROM `doc_bureaux` WHERE `bureau_active`=1");
    $data['mbr_id'] = $mbr_id;

   $data['title'] = "Affectation des utilisateurs aux bureaux";

    $this->page = 'users/Affectation_Bureau_User_View';

    $this->layout($data); 


}

//function pour inserer les affectations dans la base
function affecter()
{
    $mbr_id=$this->input->post('mbr_id');
    $bureau_id=$this->input->post('bureau_id[]');

    foreach ($bureau_id as $value) {
       
        $array_affect=array('BUREAU_ID'=>$value,'USER_ID'=>$mbr_id);

        $this->Model->create('affectation_bureau_user',$array_affect);

    }

    $data['message'] = '<div style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em"  class=" btn btn-success" id="message">' . "L'affectation des bureaux a été faite avec succès" . '</div>';
    $this->session->set_flashdata($data);

    redirect(base_url('matrice/Users'));
}


function detail_bureau($id){

    $query_principal = 'SELECT affectation_bureau_user.ID_AFFECTATION,affectation_bureau_user.DATE_AFFECTATION,doc_bureaux.bureau_id,doc_bureaux.bureau_descr,doc_bureaux.bureau_telephone FROM `affectation_bureau_user` LEFT JOIN doc_bureaux ON doc_bureaux.bureau_id = affectation_bureau_user.BUREAU_ID LEFT JOIN members ON members.mbr_id =affectation_bureau_user.USER_ID WHERE affectation_bureau_user.USER_ID='.$id;

            $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

            $limit = 'LIMIT 0,10';


            if ($_POST['length'] != -1) {
                $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
            }
            $order_by = '';

            $order_column = array( 'bureau_descr');

            $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY bureau_descr ASC';

            $search = !empty($_POST['search']['value']) ? (" AND ( bureau_descr LIKE '%$var_search%') ") : '';

            $critaire = '';

            $query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $order_by . '   ' . $limit;
            $query_filter = $query_principal . ' ' . $critaire . ' ' . $search;


            $fetch_gerant = $this->Model->datatable($query_secondaire);
            $data = array();

            foreach ($fetch_gerant as $row) {


                $sub_array = array();
                $sub_array[] = $row->bureau_descr;
                $sub_array[] = $row->bureau_telephone ;
                $sub_array[] = $row->DATE_AFFECTATION;
                $sub_array[] = '<span ><a href="'.base_url('matrice/Users/delete_affectation/'.$row->ID_AFFECTATION).'" class="btn btn-danger btn-xs">X</a></span>';
                $data[] = $sub_array;
            }

            $output = array(
                "draw" => intval($_POST['draw']),
                "recordsTotal" => $this->Model->all_data($query_principal),
                "recordsFiltered" => $this->Model->filtrer($query_filter),
                "data" => $data
            );
            echo json_encode($output);

}
  
  //suppression de l'affectation (Esther)

    function delete_affectation($id){

            $table="affectation_bureau_user";
            $this->Model->delete($table,array('ID_AFFECTATION'=>$id));

             redirect(base_url('matrice/Users'));
        }


            //affectation des roles aux province
            function affectation_province($mbr_id)
            {
            
                $data['user'] = $this->Model->getRequeteOne("SELECT `mbr_fname`,`mbr_lname`,rol_id FROM `members` WHERE `mbr_id`=".$mbr_id);
                $data['role'] = $this->Model->getRequeteOne("SELECT `rol_id`,`rol_description` FROM `roles` WHERE `rol_id`=".$data['user']['rol_id']);
                $data['province'] = $this->Model->getRequete("SELECT `province_id`,`province_name` FROM `provinces` WHERE 1");
                $data['role_id'] = $data['role']['rol_id'];
                $data['mbr_id'] = $mbr_id;
            
               $data['title'] = "Affectation des roles aux provinces ".$data['user']['mbr_fname']."";
            
                $this->page = 'matrice/users/Affectation_Role_Province_View';
            
                $this->layout($data); 
            
            
            }
            
            
            //function pour inserer les affectations dans la base
            function affecter_province()
            {
                $role_id=$this->input->post('role_id');
                $mbr_id=$this->input->post('mbr_id');
                $province_id=$this->input->post('province_id[]');
            
                foreach ($province_id as $value) {
                   
                    $array_affect=array('PROVINCE_ID'=>$value,'ROLE_ID'=>$role_id,'USER_ID'=>$mbr_id);
            
                    $this->Model->create('role_province',$array_affect);
            
                }
            
                $data['message'] = '<div style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em"  class=" btn btn-success" id="message">' . "L'affectation des bureaux a été faite avec succès" . '</div>';
                $this->session->set_flashdata($data);
            
                redirect(base_url('matrice/Users/index'));
            }
            
            
            //liste des menus appartenant au module quelconque
                function detail_role($USER_ID = 0)
                {
            
                    $query_principal = 'SELECT role_province.USER_ID,role_province.ID_ROLE_PROVINCE,role_province.`PROVINCE_ID`,role_province.`ROLE_ID`,roles.rol_description,provinces.province_name FROM `role_province` JOIN provinces ON provinces.province_id=role_province.PROVINCE_ID JOIN roles ON roles.rol_id=role_province.ROLE_ID WHERE 1 AND role_province.`USER_ID`=' . $USER_ID;
            
                    $var_search = !empty($_POST["search"]["value"]) ? $_POST["search"]["value"] : null;
                    $limit = 'LIMIT 0,10';
                    $draw = isset($_POST['draw']);
                    $start = isset($postData['start']);
            
                    if (isset($_POST["length"]) && $_POST["length"] != -1) {
                        $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
                    }
            
            
            
                    $order_by = '';
                    $order_column = '';
            
                    $order_column = array('role_province.ID_ROLE_PROVINCE','provinces.province_name');
            
                    $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY  provinces.province_name ASC';
            
                    $search = !empty($_POST['search']['value']) ? ("AND provinces.province_name LIKE '%$var_search%' ") : '';
            
            
                    $critaire = '';
                    $order_by = 'ORDER BY provinces.province_name ASC';
                    $query_secondaire = $query_principal . ' ' . $search.' '.$order_by. ' ' . $critaire . ' ' . $limit;
            
                    $query_filter = $query_principal . '  ' . $search . ' ' . $critaire;
            
            
            
                    $fetch_cov_frais = $this->Model->datatable($query_secondaire);
                    $data = array();
                    $u = 1;
                    $statut = '';
                    $url = '';
                    foreach ($fetch_cov_frais as $info) {
                       
            
                        $post = array();
                        $post[] = $u++;
                        $post[] = $info->rol_description;
                        $post[] = $info->province_name;
                        $post[] = '<span ><a href="'.base_url('matrice/Users/delete_affectation_province/'.$row->ID_ROLE_PROVINCE).'" class="btn btn-danger btn-xs">X</a></span>';
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
            


                function delete_affectation_province($id){

                    $table="role_province";
                    $this->Model->delete($table,array('ID_ROLE_PROVINCE'=>$id));
        
                     redirect(base_url('matrice/Users'));
                }

                public function supprimer(){
                    //$id_grade = $this->uri->segment(4);
                    $mbr_id = $this->uri->segment(4);
                    $user = $this->My_model->getOne('members',['mbr_id'=>$mbr_id]);
                       $this->db->where('mbr_id',$mbr_id);
                       $this->db->delete('members');
                    //}
               
                    redirect(base_url('matrice/Users/index'));     
                   }




}