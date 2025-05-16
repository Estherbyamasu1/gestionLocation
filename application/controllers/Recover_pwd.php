<?php

/**
* @author NSHIMIRIMANA REVERIEN
*/
class Recover_pwd extends CI_Controller
{
	
	function index()
	{
		$data['title']="";
		$this->load->view('Recover_pwd_view',$data);
	}

	function recover()
	{
		$this->_validate();

		$get_info_user=$this->Model->getOne('users',array('EMAIL'=>$this->input->post('EMAIL')));
		$EMAIL=$this->input->post('EMAIL');
		$pwd=$this->notifications->generate_password(8);
		$subject="Mot de passe oublié";
		$message="Cher(ère) <b>".$get_info_user['NOM_USER']." ".$get_info_user['PRENOM_USER']."</b>,<br>votre mot de passe a été réinitialisé.<br>Votre nouveau mot de passe :<b>".$pwd."</b>.<br>Merci";

		$this->Model->update('users',array('ID_USER'=>$get_info_user['ID_USER']),array('PASSWORD'=>md5($pwd)));
		$this->notifications->send_mail($EMAIL,$subject,'',$message,array());

		echo json_encode(array('status'=>true));
	}

	function _validate()
	{
		$data=array();
		$data['error_string']=array();
		$data['inputerror']=array();
		$data['status']=true;
		$data['message_success']="Traitement en cours....";
		$regex_email = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 

		$get_info_user=$this->Model->getOne('admin_users',array('EMAIL'=>$this->input->post('EMAIL')));

		if ($this->input->post('EMAIL')=="") 
		{
			$data['error_string'][]="Le champs est obligatoire";
			$data['inputerror'][]="EMAIL";
			$data['status']=FALSE;
		}

		


		if (!empty($this->input->post('EMAIL'))) 
		{
			if (empty($get_info_user['EMAIL'])) 
			{
				$data['error_string'][]="L'email n'existe pas dans le système";
				$data['inputerror'][]="EMAIL";
				$data['status']=FALSE;
			}

			if (!preg_match($regex_email,$this->input->post('EMAIL'))) {
			$data['inputerror'][]='EMAIL';
			$data['error_string'][]='L\'mail est invalide!';
		 	$data['status']=FALSE;
		}
		}
		
		if ($data['status']==FALSE) 
		{
			echo json_encode($data);
			exit();
		}
	}
}