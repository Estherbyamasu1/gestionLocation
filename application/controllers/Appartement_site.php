<?php

/**
 * @author Jules@mediabox.bi
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Appartement_site extends CI_Controller
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
		// $this->load->view('Home_View', $data);
		$this->load->view('Appartement_site_View',$data);
	}


   function apropos(){
   	$this->load->view('Apropos_View');
   }

		}

		?>