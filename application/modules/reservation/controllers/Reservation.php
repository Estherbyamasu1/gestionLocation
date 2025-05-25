<?php

class Reservation extends CI_Controller  
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

		$this->load->view('Reservation_View');
	}





		//fonction liste
	function listing()
	{
		 // $user=$this->session->userdata('LOCATAIRE_ID');
   // $user_email=$this->session->userdata('LOCATAIRE_EMAIL');

   // print_r($user_email);die();
   
   $query_principal="SELECT reservation.*,locataire.*,users.*,meuble.*, locataire.EMAIL as locat_email,statut_reservation.DESC_STATUT_RESERVATION FROM `reservation` JOIN meuble ON meuble.ID_MEUBLE=reservation.MEUBLE_ID JOIN users ON users.ID_USER=reservation.USER_ID JOIN locataire ON locataire.ID_LOCATAIRE=reservation.ID_LOCATAIRE JOIN statut_reservation ON statut_reservation.ID_STATUT_RESERVATION=reservation.STATUT_RESERVATION WHERE 1";
    $var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $limit='LIMIT 0,10';
    if($_POST['length'] != -1)
    {
      $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
    }

    
    $order_column='';

    $order_column = array('reservation.RESERVATION_ID','reservation.DATE_DEBUT','reservation.DATE_FIN','meuble.ID_MEUBLE','meuble.NOM_MEUBLE','meuble.NUMERO_MEUBLE','locataire.NOM_LOCATAIRE','locataire.PRENOM_LOCATAIRE');

    $search = !empty($_POST['search']['value']) ?  (" AND (meuble.NOM_MEUBLE LIKE '%$var_search%' OR meuble.NUMERO_MEUBLE LIKE '%$var_search%' OR locataire.NOM_LOCATAIRE LIKE '%$var_search%' OR locataire.PRENOM_LOCATAIRE LIKE '%$var_search%' OR  reservation.DATE_DEBUT LIKE '%$var_search%' OR  reservation.DATE_FIN LIKE '%$var_search%')") :'';  

    $critaire = '';

    $order_by=' ORDER BY reservation.RESERVATION_ID ASC';
    $query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;

    $query_filter = $query_principal.' '.$critaire.' '.$search.' '.$order_by;

    $fetch_cov_frais = $this->Model->datatable($query_secondaire);
    $data = array();
    $u=1;
    foreach($fetch_cov_frais as $info)
    {
            $statut="";
            if($info->STATUT_RESERVATION==1){
            
               $statut="En attente";

            }elseif ($info->STATUT_RESERVATION==2) {

              $statut="Validé";
              # code...
            }else{

              $statut="Refusé";
              # code...
            }



      $post=array();
      $post[]=$u++;
      $post[]=$info->NOM_LOCATAIRE.' '.$info->PRENOM_LOCATAIRE;
      $post[]=$info->NOM_MEUBLE.'('.$info->NUMERO_MEUBLE.')';
      $post[]=$info->locat_email.'('.$info->TELEPHONE.')';
      $post[]=$info->DESC_STATUT_RESERVATION;
     
      
      $post[]= '
      <div class="dropdown">
      <button class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cog">
      </i><span class='."caret".'> Actions</span>
      </button>
      <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">

      <a href="#" onclick="traiter_ticket('.$info->RESERVATION_ID.')">Traiter</i></a><br>
      <a style="color:red" data-toggle="modal" href="#" onclick="historique_ticket('.$info->RESERVATION_ID.')">Historique</a>
      </div>
      ';


      $data[] = $post;
    }

    $output = array(
      "draw" => intval($_POST['draw']),
      "recordsTotal" =>$this->Model->all_data($query_principal),
      "recordsFiltered" => $this->Model->filtrer($query_filter),
      "data" => $data
    );
    echo json_encode($output);
	}





// function delete($id){

// 	$this->Model->delete('categorie_meuble', array('ID_CATEGORIE' => $id));

//     $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Suppression faite avec succès!!" . '</div>';
//      $this->session->set_flashdata($data);
//      redirect(base_url('appartement/Categorie'));
     
// }

function getOne($id){


  $data = $this->Model->getOne('reservation', array('RESERVATION_ID' => $id));

    $data_statut = $this->Model->getRequete("SELECT `ID_STATUT_RESERVATION`, `DESC_STATUT_RESERVATION` FROM `statut_reservation`");
    

$html_statut="";
    foreach ($data_statut as $value) {
      $select = '';

      if ($data["STATUT_RESERVATION"] == $value["ID_STATUT_RESERVATION"]) {
        $select = "selected disabled";
      }

      // if ($data["STATUT_RESERVATION"] == 4) {
      //   continue;
      // }

      $html_statut .= '<option value="' . $value['ID_STATUT_RESERVATION'] . '" ' . $select . '>' . $value['DESC_STATUT_RESERVATION'] . '</option>';
    }
    
    $output = array('RESERVATION_ID' => $data['RESERVATION_ID'], 'ID_STATUT_RESERVATION' => $html_statut);

    echo json_encode($output);


}


function traite_ticket()
  {
    $this->_validate();


    $ID_STATUT_RESERVATION=$this->input->post('ID_STATUT_RESERVATION');
    
    $COMMENTAIRE=$this->input->post('COMMENTAIRE');
    $RESERVATION_ID=$this->input->post('RESERVATION_ID');
    
    $user=$this->session->userdata('USER_ID');

    $demande_email=$this->Model->getOne('reservation', array('RESERVATION_ID' =>$RESERVATION_ID));
// print_r($RESERVATION_ID);die();
   $pass=$this->notifications->generate_password(5);
    $this->Model->create('historique_reservation_demande',array('USER_ID'=>$user,'STATUT_ID'=>$ID_STATUT_RESERVATION,'ID_RESERVATION'=>$RESERVATION_ID,'COMMENTAIRE'=>$COMMENTAIRE,'DATE_INSERTION'=>date('Y-m-d H:i:s')));

      $this->Model->update('reservation',array('RESERVATION_ID'=>$RESERVATION_ID),array('STATUT_RESERVATION'=>$ID_STATUT_RESERVATION));

      $data = $this->Model->getOne('reservation', array('RESERVATION_ID' => $RESERVATION_ID));

      if($ID_STATUT_RESERVATION==2){

         $this->Model->update('meuble',array('ID_MEUBLE'=>$data['MEUBLE_ID']),array('STATUT'=>2));
      }

    
      // if($ID_STATUT_RESERVATION==2){

      //    $to=$demande_email['EMAIL'];
      //   $subject='Votre demande a été approuve';
      //   $message = "chère <b>".$demande_email['NOM_LOCATAIRE']."</b>,<br>Voici vos identifiant: <br><br> Email :".$to.",<br>Mot de passe:".$to.",<br><br>  Merci cordialement.
      //   </b>";
      
      //  // $this->notifications->send_mail($to, $subject, [], $message, []);
      // }
   

  

    echo json_encode(array('status'=>true));
  }


  function _validate()
  {

    
    $data['inputerror']=array();
    $data['error_string']=array();
    $data['status']=TRUE;
    
    
    if ($this->input->post('ID_STATUT_RESERVATION')=="") 
    {
      
      $data['inputerror'][]="ID_STATUT_RESERVATION";
      $data['error_string'][]="Le champs est obligatoire";
      $data['status']=false;
    }

    if ($this->input->post('COMMENTAIRE')=="") 
    {
      $data['inputerror'][]="COMMENTAIRE";
      $data['error_string'][]="Le champs est obligatoire";
      $data['status']=false;
    }

    

    if ($data['status']==FALSE) 
    {
      echo json_encode($data);
      exit();
    }
  }





function historique($id=0)
  {


    $query_principal="SELECT hld.`ID_HISTORIQUE_DEMANDE`,hld.`ID_RESERVATION`,hld.`USER_ID`,hld.`STATUT_ID`,hld.`COMMENTAIRE`,hld.`DATE_INSERTION`,locataire.NOM_LOCATAIRE,locataire.PRENOM_LOCATAIRE,users.NOM_USER,users.PRENOM_USER,users.EMAIL,statut_reservation.DESC_STATUT_RESERVATION FROM `historique_reservation_demande` hld JOIN reservation ON reservation.RESERVATION_ID=hld.`ID_RESERVATION` LEFT JOIN users ON users.ID_USER=hld.`USER_ID` JOIN statut_reservation ON statut_reservation.ID_STATUT_RESERVATION=hld.`STATUT_ID` LEFT JOIN locataire ON locataire.ID_LOCATAIRE=reservation.ID_LOCATAIRE WHERE hld.`ID_RESERVATION` = ".$id;
    



    $var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $var_search=str_replace("'", " ", $var_search);


    $limit='LIMIT 0,10';


    if($_POST['length'] != -1){
      $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
    }
    $order_by='';



    $order_column=array('COMMENTAIRE');

    if ($order_by) 
    {
      # code...
      $order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY COMMENTAIRE  DESC';
    }


    $search = !empty($_POST['search']['value']) ? (" AND ( users.NOM_USER LIKE '%$var_search%' OR users.PRENOM_USER LIKE '%$var_search%' OR statut_reservation.DESC_STATUT_RESERVATION LIKE '%$var_search%' OR CONCAT(users.NOM_USER,' ',users.PRENOM_USER) LIKE '%$var_search%' ) ") : '';


    $critaire = '';

    $query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
    $query_filter = $query_principal.' '.$critaire.' '.$search;

    $fetch_data = $this->Model->datatable($query_secondaire);
    $data = array();
    $u=0;
    foreach ($fetch_data as $row) {

      
      
      $u++;
      $sub_array=array();
      $sub_array[]=$u;

      $sub_array[]=$row->NOM_LOCATAIRE.' '.$row->PRENOM_LOCATAIRE;
      $sub_array[]=date('d-m-Y H:m',strtotime($row->DATE_INSERTION));
      $sub_array[]=$row->DESC_STATUT_RESERVATION;
      $sub_array[]=$row->NOM_USER.' '.$row->PRENOM_USER;
      $sub_array[]=$row->COMMENTAIRE;

      
      $data[] = $sub_array;
    }
    $output = array(
      "draw" => intval($_POST['draw']),
      "recordsTotal" =>$this->Model->all_data($query_principal),
      "recordsFiltered" => $this->Model->filtrer($query_filter),
      "data" => $data
    );
    echo json_encode($output);
  }




}
