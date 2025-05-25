<?php

class Contact extends CI_Controller  
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

		$this->load->view('Contact_View');
	}





		//fonction liste
	function listing()
	{
		$query_principal="SELECT `ID_CONTACT_SITE`,`NOM_CONTACT`,`EMAIL_CONTACT`,`SUJET`,`MESSAGE`,`MESSAGE_REPONDU`,`DATE_INSERTION` FROM `contact_site` WHERE 1";

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';
		if($_POST['length'] != -1)
		{
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}

		
		$order_column='';

		$order_column = array('ID_CONTACT_SITE','NOM_CONTACT');

		$search = !empty($_POST['search']['value']) ?  (" AND (NOM_CONTACT LIKE '%$var_search%' OR EMAIL_CONTACT LIKE '%$var_search%')") :'';  

		$critaire = '';

		$order_by=' ORDER BY NOM_CONTACT ASC';
		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;

		$query_filter = $query_principal.' '.$critaire.' '.$search.' '.$order_by;

		$fetch_cov_frais = $this->Model->datatable($query_secondaire);
		$data = array();
		$u=1;
		foreach($fetch_cov_frais as $info)
		{

           $mess='';
           if(!empty($info->MESSAGE_REPONDU)){

           	$mess=$info->MESSAGE_REPONDU;
           }else{
           	$mess='--';
           }

			$post=array();
			$post[]=$u++;
			$post[]=$info->NOM_CONTACT;
			$post[]=$info->SUJET;
			$post[]=$info->EMAIL_CONTACT;
			$post[]=$info->MESSAGE;
			$post[]=$info->DATE_INSERTION;
			$post[]=$mess;
			
			
			$post[]= '
			<div class="dropdown">
			<button class="btn btn-dark btn-sm" onclick="traiter_ticket('.$info->ID_CONTACT_SITE.')"> <i class="fa fa-cog">
			</i><span class='."caret".'> Repondre</span>
			</button>
			
			</div>';


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


function getOne($id){


  $data = $this->Model->getOne('contact_site', array('ID_CONTACT_SITE' => $id));

  
    
    $output = array('ID_CONTACT_SITE' => $data['ID_CONTACT_SITE']);

    echo json_encode($output);


}


function traite_ticket()
  {
    $this->_validate();


    $ID_CONTACT_SITE=$this->input->post('ID_CONTACT_SITE');
    
    $COMMENTAIRE=$this->input->post('COMMENTAIRE');
    
    $user=$this->session->userdata('USER_ID');

    $demande_email=$this->Model->getOne('contact_site', array('ID_CONTACT_SITE' =>$ID_CONTACT_SITE));
// print_r($demande_email);die();

      $this->Model->update('contact_site',array('ID_CONTACT_SITE'=>$ID_CONTACT_SITE),array('MESSAGE_REPONDU'=>$COMMENTAIRE));


         $to=$demande_email['EMAIL_CONTACT'];
        $subject='Votre demande a été approuve';
        // $message = "chère <b>".$demande_email['NOM_CONTACT']."</b>,<br>Voici vos identifiant: <br><br> Email :".$to.",<br>Mot de passe:".$to.",<br><br>  Merci cordialement.
        // </b>";
      
       // $this->notifications->send_mail($to, $subject, [], $message, []);
   
   

  

    echo json_encode(array('status'=>true));
  }


function _validate()
  {

    
    $data['inputerror']=array();
    $data['error_string']=array();
    $data['status']=TRUE;
    
    
   
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

}
