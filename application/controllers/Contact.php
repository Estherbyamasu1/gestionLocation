<?php

/**
 * @author Jules@mediabox.bi
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller
{
	
	// function __construct()
	// {
	// 	# code...
 //        parent::__construct();
 //        $this->load->model("My_model");
	// }
    //acceuil information
	public function index($value='')
	{
		# code...
		// $data=array('title'=>"Page d'acceuil - Commissariat Général des Migrations");
		// $data=array('title'=>"".$this->lang->line('ctl_home')." - ".$this->lang->line('apply_ctl_cgm')."");
		$data['appart']=$this->Model->getRequete('SELECT meuble.ID_MEUBLE,meuble.NOM_MEUBLE,meuble.NUMERO_MEUBLE,meuble.MONTANT,categorie_meuble.NOM_CATEGORIE,meuble.ADRESSE,meuble.IMAGE_MEUBLE,meuble.STATUT FROM `meuble` JOIN categorie_meuble ON categorie_meuble.ID_CATEGORIE=meuble.ID_CATEGORIE WHERE meuble.STATUT=1 order BY meuble.NUMERO_MEUBLE ASC');
		// $this->load->view('Home_View', $d_ata);
		$this->load->view('Contact_View');
	}

	function ajouter(){

   $NOM_CONTACT = $this->input->post('NOM_CONTACT');
   $EMAIL_CONTACT = $this->input->post('EMAIL_CONTACT');
   $SUJET = $this->input->post('SUJET');
   $MESSAGE = $this->input->post('MESSAGE');
    
 // print_r($IMAGE_MEUBLE);die();
   $this->form_validation->set_rules('NOM_CONTACT', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
   $this->form_validation->set_rules('EMAIL_CONTACT', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
   $this->form_validation->set_rules('SUJET', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
   $this->form_validation->set_rules('MESSAGE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

    if ($this->form_validation->run() == FALSE) {
      $this->index();
    } else {

    	$this->Model->create('contact_site', array('NOM_CONTACT' => $NOM_CONTACT,'EMAIL_CONTACT' => $EMAIL_CONTACT,'SUJET' => $SUJET,'MESSAGE' => $MESSAGE));

    		 $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Enregistrement effectuée avec succès!!" . '</div>';
           $this->session->set_flashdata($data);
          redirect(base_url('Contact'));


    }
   

	}


   function apropos(){
   	$this->load->view('Apropos_View');
   }

		}

		?>