<?php

/**
 * @author Jules@mediabox.bi
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscription_Locataire extends CI_Controller
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
    $data['sexe']=$this->Model->getRequete('SELECT `ID_SEXE`,`DESC_SEXE` FROM `sexe` WHERE 1');
		// $this->load->view('Home_View', $d_ata);
		$this->load->view('Inscription_view',$data);
	}

function ajouter(){

   $NOM_LOCATAIRE = $this->input->post('NOM_LOCATAIRE');
   $PRENOM_LOCATAIRE = $this->input->post('PRENOM_LOCATAIRE');
   $TELEPHONE = $this->input->post('TELEPHONE');
   $EMAIL = $this->input->post('EMAIL');
   $ID_SEXE = $this->input->post('ID_SEXE');
   $ADRESSE_ACTUELLE = $this->input->post('ADRESSE_ACTUELLE');
  // print_r($ID_SEXE);die();
   $this->form_validation->set_rules('NOM_LOCATAIRE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
   $this->form_validation->set_rules('PRENOM_LOCATAIRE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
   $this->form_validation->set_rules('TELEPHONE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
   $this->form_validation->set_rules('EMAIL', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
   $this->form_validation->set_rules('ID_SEXE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
   $this->form_validation->set_rules('ADRESSE_ACTUELLE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

   if ($this->form_validation->run() == FALSE) {
      $this->index();
    } else {
      
      $check=$this->Model->getOne('locataire',array('NOM_LOCATAIRE'=>$NOM_LOCATAIRE,'PRENOM_LOCATAIRE'=>$PRENOM_LOCATAIRE,));


      $photoreperatoire =FCPATH.'/uploads/doc_meuble';
        $photo_avatar="DOC-".date('Ymdi').uniqid();
         // print_r($_FILES);die();
        $IMAGE_LOCATAIRE= $_FILES['IMAGE_LOCATAIRE']['name'];
        
        $config['upload_path'] ='./uploads/doc_meuble/';
        $config['allowed_types'] = '*';
        $test = explode('.', $IMAGE_LOCATAIRE);
        $ext = end($test);
        $name = $photo_avatar.'.'.$ext;
        $config['file_name'] =$name;
        if(!is_dir($photoreperatoire)) //create the folder if it does not already exists   
        {
          mkdir($photoreperatoire,0777,TRUE);

        } 
       
        $this->upload->initialize($config);
        $this->upload->do_upload('IMAGE_LOCATAIRE');

        if (!empty($_FILES['IMAGE_LOCATAIRE']['name'])) {
          # code...
          $IMAGE_LOCATAIRE=$config['file_name'];
          $data_image=$this->upload->data();
        }else{

          $IMAGE_LOCATAIRE=NULL;
        }
    
   

      if(empty($check)){

             $this->Model->create('locataire', array('NOM_LOCATAIRE'=>$NOM_LOCATAIRE,'PRENOM_LOCATAIRE'=>$PRENOM_LOCATAIRE,'TELEPHONE' => $TELEPHONE,'EMAIL' => $EMAIL,'SEXE_ID'=>$ID_SEXE,'ADRESSE_ACTUELLE'=>$ADRESSE_ACTUELLE,'STATUT'=>1,'IMAGE_LOCATAIRE'=>$IMAGE_LOCATAIRE));

         $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Enregistrement effectuée avec succès!!" . '</div>';
           $this->session->set_flashdata($data);
          redirect(base_url('Inscription_Locataire'));

      }else{
             $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Le client existe deja!!" . '</div>';
             $this->session->set_flashdata($data);
          redirect(base_url('Inscription_Locataire'));
      }

    }


}


   function apropos(){
   	$this->load->view('Apropos_View');
   }

		}

		?>