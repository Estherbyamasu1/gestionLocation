<?php

/**
 * @author Jules@mediabox.bi
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Front extends CI_Controller
{
  
  // function __construct()
  // {
  //  # code...
 //        parent::__construct();
 //        $this->load->model("Model");
  // }
    //acceuil information
  public function index($value='')
  {
    # code...
    // $data=array('title'=>"Page d'acceuil - Commissariat Général des Migrations");
    // $data=array('title'=>"".$this->lang->line('ctl_home')." - ".$this->lang->line('apply_ctl_cgm')."");
    // $this->load->view('Home_View', $data);
    $data['appart']=$this->Model->getRequete('SELECT meuble.ID_MEUBLE,meuble.NOM_MEUBLE,meuble.NUMERO_MEUBLE,meuble.MONTANT,categorie_meuble.NOM_CATEGORIE,meuble.ADRESSE,meuble.IMAGE_MEUBLE,meuble.STATUT FROM `meuble` JOIN categorie_meuble ON categorie_meuble.ID_CATEGORIE=meuble.ID_CATEGORIE WHERE meuble.STATUT=1 order BY meuble.NUMERO_MEUBLE ASC');

    $this->load->view('Login_Front_View',$data);
  }



    public function do_login(){

    $this->form_validation->set_rules('inputUsername', '', 'required',array("required"=>"<font color='red'>L'adresse e-mail est obligatoire</font>"));
    $this->form_validation->set_rules('inputPassword', '', 'required',array("required"=>"<font color='red'>Le mot de passe est obligatoire</font>"));

    if ($this->form_validation->run() == FALSE) {
     $this->load->view('Login_Front_View');
   }else{

    $username=$this->input->post('inputUsername');
    $password=$this->input->post('inputPassword');
    // print_r($password);die();

    $user=$this->Model->getOne('locataire',array('EMAIL'=>$username));


   if (!empty($user)) {
    if ($user['PASSWORD']==md5($password)) {
      // if ($user['password']==$password) {
      if ($user['STATUT']==2) {

        $session=array(
         'LOCATAIRE_ID'=>$user['ID_LOCATAIRE'],
         'LOCATAIRE_NOM'=>$user['NOM_LOCATAIRE'],
         'LOCATAIRE_TELEPHONE'=>$user['TELEPHONE'],
         'LOCATAIRE_PRENOM'=>$user['PRENOM_LOCATAIRE'],
         'LOCATAIRE_EMAIL'=>$user['EMAIL']  
       );
            //print_r($session);die();
        $this->session->set_userdata($session);
        redirect(base_url('Perso'));

      }else {
        $sms['sms']='<div class="alert alert-danger"><center><strong> Oup! </strong> Votre compte à été désactivé<br>Veillez contacter l\'administration ! .</center></div>' ;
        $this->session->set_flashdata($sms) ;
        redirect(base_url('Login_Front'));
      }

    }else {
      $sms['sms']='<div class="alert alert-danger"><center><strong> Oup! </strong> Mot de pass incorrect ! .</center></div>' ;
      $this->session->set_flashdata($sms) ;
      redirect(base_url('Login_Front'));
    }

  } else {
    $sms['sms']='<div class="alert alert-danger"><center><strong> Oup! </strong> Email incorrect ! .</center></div>' ;
    $this->session->set_flashdata($sms) ;
    redirect(base_url('Login_Front'));
  }
}
}

 public function do_logout(){

  session_destroy();

    // $this->session->unset_userdata($session);
    
    redirect(base_url("Login_Front"));
 }



  }
  
  

    ?>