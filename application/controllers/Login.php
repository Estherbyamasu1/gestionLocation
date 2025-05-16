 <?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index($params = NULL)
	{
		$datas['message'] = $params;
		$this->load->view('Login_view', $datas);
	}

	function check_login()
	{
		$this->_validate();
		$username=$this->input->post('username');
		$password=trim($this->input->post('password'));
		print_r($password);die();
		$get_email=$this->Model->getOne('users',array('EMAIL'=>$username,'PASSWORD'=>md5($password)));
		$user=$this->Model->getOne('users',array('EMAIL'=>$username,'IS_ACTIVE'=>1,'ROLE_ID'=>$get_email['ROLE_ID']));
		
		$output = null;

		if (!empty($user)) 
		{
			if($user['PASSWORD']==md5($password))
			{
				$output=array("status"=>TRUE,'message'=>'<center>Connexion en cours...</center>');
			}
			else
			{
				$output=array("status"=>false,'message'=>'<center>L\'user n\'existe pas dans le système.</center>');
			}
		}

		if($output == null)
		{
			$output = array("status"=>false,'message'=>'<center>Compte inactif ou inéxistant</center>');
		}
		echo json_encode($output);
	}


	public function _validate()
	{
		$data = null;
		$status = true;
		$inputUsername = $this->input->post('username');
		$inputPassword =  $this->input->post('password');
		if($inputUsername == '')
		{
			$data = array('status'=>FALSE,'message'=>'Le nom d\'utilisateur est obligatoire');
			$status = false;
		}

		if($inputPassword == '')
		{
			$data = array('status'=>FALSE,'message'=>'Le mot de passe est obligatoire');
			$status = false;
		}

		if($status === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	public function do_login()
	{
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		 
		
		$get_email=$this->Model->getOne('users',array('EMAIL'=>$username,'PASSWORD'=>md5($password)));
		$user=$this->Model->getOne('users',array('EMAIL'=>$username,'IS_ACTIVE'=>1,'ROLE_ID'=>$get_email['ROLE_ID']));
		$admin_profil=$this->Model->getOne('roles',array('rol_id'=>$user['ROLE_ID']));
		if (!empty($user))
		{
			if ($user['PASSWORD']==md5($password))
			{
				if ($user['IS_ACTIVE']==1)
				{
					
					$session=array('USER_ID'=>$user['ID_USER'],
						'NOM_USER'=>$user['NOM_USER'],
						'PRENOM_USER'=>$user['PRENOM_USER'],
						'EMAIL'=>$user['EMAIL'],
						'IS_ACTIVE'=>$user['IS_ACTIVE'],
						'ROLE_ID'=>$admin_profil['rol_id'],
						'CODE_ROLE'=>$admin_profil['rol_code'],
					    'SEXE_ID'=>$user['SEXE_ID']
						
						
					);

					$this->session->set_userdata($session);
					

					if ($this->session->userdata('CODE_ROLE')=="super_admin") 
					{
						redirect(base_url('appartement/Appartement'));

					}else{
						redirect(base_url('appartement/Appartement'));
					}
					

				}else {
					$sms['sms']='<br><div class="alert alert-danger text-center alert-dismissible fade in col-md-8 col-md-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Oup! </strong> Contacter l\'administration ! .</div><br>' ;
					$this->session->set_flashdata($sms) ;
					redirect(base_url());
				}

			} else {
				$sms['sms']='<br><div class="alert alert-danger text-center alert-dismissible fade in col-md-8 col-md-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Oup! </strong> Mot de pass incorrect ! .</div><br>' ;
				$this->session->set_flashdata($sms) ;
				redirect(base_url());
			}

		} else {
			$sms['sms']='<br><div class="alert alert-danger text-center alert-dismissible fade in col-md-8 col-md-offset-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Oup! </strong> Email incorrect ! .</div><br>' ;
			$this->session->set_flashdata($sms) ;
			redirect(base_url());
		}

		$this->session->set_flashdata($sms) ;
		redirect(base_url());

	}

	public function do_logout()

	{

		$session=array('USER_ID'=>NULL,
		                'NOM_USER'=>NULL,
						'PRENOM_USER'=>NULL,
						'EMAIL'=>NULL,
						'IS_ACTIVE'=>NULL,
						'ROLE_ID'=>NULL,
						'CODE_ROLE'=>NULL,
					    'SEXE_ID'=>NULL
			
		);
		$this->session->unset_userdata($session);
		
		redirect(base_url());
	}

	




	




}