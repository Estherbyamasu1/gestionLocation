<?php

class Appartement extends CI_Controller  
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


  // public function __construct()
  // {
  //   parent::__construct();
  //   $this->load->helper('form');
  //   $this->load->library('table');
  //   $this->load->library('form_validation');
  //   $this->is_auth();
  // }
  function index()
  {

    $this->load->view('Liste_Appartement_View');
  }





		//fonction liste
  function listing()
  {
    $query_principal="SELECT meuble.ID_MEUBLE,meuble.NOM_MEUBLE,meuble.NUMERO_MEUBLE,meuble.MONTANT,categorie_meuble.NOM_CATEGORIE,meuble.ADRESSE,meuble.IMAGE_MEUBLE,meuble.STATUT FROM `meuble` JOIN categorie_meuble ON categorie_meuble.ID_CATEGORIE=meuble.ID_CATEGORIE WHERE 1";

    $var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $limit='LIMIT 0,10';
    if($_POST['length'] != -1)
    {
     $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
   }


   $order_column='';

   $order_column = array('meuble.ID_MEUBLE','meuble.NOM_MEUBLE','meuble.NUMERO_MEUBLE');

   $search = !empty($_POST['search']['value']) ?  (" AND (meuble.NOM_MEUBLE LIKE '%$var_search%' OR meuble.NUMERO_MEUBLE LIKE '%$var_search%' OR meuble.MONTANT LIKE '%$var_search%' OR  categorie_meuble.NOM_CATEGORIE LIKE '%$var_search%')") :'';  

   $critaire = '';

   $order_by=' ORDER BY NOM_MEUBLE ASC';
   $query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;

   $query_filter = $query_principal.' '.$critaire.' '.$search.' '.$order_by;

   $fetch_cov_frais = $this->Model->datatable($query_secondaire);
   $data = array();
   $u=1;
   foreach($fetch_cov_frais as $info)
   {
    $statut="";
    if($info->STATUT==1){

     $statut="Disponible";

   }elseif ($info->STATUT==1) {

     $statut="Réservé";
            	# code...
   }

   $post=array();
   $post[]=$u++;
   $post[]=$info->NOM_MEUBLE;
   $post[]=$info->NUMERO_MEUBLE;
   $post[]=$info->NOM_CATEGORIE;
   $post[]=$info->ADRESSE;
   $post[]=$statut;
			// $post[]='<div class="col-md-12"><embed src="' . base_url('uploads/doc_meuble/' . $info->IMAGE_MEUBLE) . '" type="application/pdf"   scrolling="auto" height="30px" width="20%"></div>';

   $post[] = '<a  data-toggle="modal" data-target="#path_document' . $info->ID_MEUBLE . '" class="btn btn-default btn-sm"><span style="font-size:20px;" class="fa ' . (strtolower(substr($info->IMAGE_MEUBLE, -4)) === '.pdf' ? "fa-file-pdf-o" : "fa-image") . '"></span></a>

   <div class="modal fade" id="path_document' . $info->ID_MEUBLE  . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
   <div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel"><b></b></h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
   </div>
   <div class="modal-body">
   <div class="col-md-12"><embed src="' . base_url('uploads/doc_meuble/' . $info->IMAGE_MEUBLE) . '" type="application/pdf"   scrolling="auto" height="400px" width="100%"></div>

   </div>

   </div>
   </div>
   </div>';

   $post[]= '
   <div class="dropdown">
   <button class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cog">
   </i><span class='."caret".'> Actions</span>
   </button>
   <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">

   <a href="'.base_url('appartement/Appartement/getOne/'.$info->ID_MEUBLE).'" >Modifier</i></a><br>
   <a style="color:red" data-toggle="modal" href="#" data-target="#staticBackdrop'.$info->ID_MEUBLE.'">Supprimer</a>
   </div>
   </div>
   <div class="modal fade" data-backdrop="static" id="staticBackdrop'.$info->ID_MEUBLE.'">
   <div class="modal-dialog">
   <div class="modal-content">
   <div class="modal-body">
   <center>
   <h5><strong>Voulez-vous supprimer ?<i style="color:green;"></i></strong><br> <b style="background-color:prink"></b>
   </h5>

   </center>
   </div>
   <div class="modal-footer">

   <a  style="color:red" href="'.base_url('appartement/Appartement/delete/'.$info->ID_MEUBLE).'">supprimer</a>
   <button class="btn btn-secondary" data-dismiss="modal">
   Quitter
   </button>
   </div>
   </div>
   </div>
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



function Add(){

	$data['cate'] = $this->Model->getRequete('SELECT `ID_CATEGORIE`,`NOM_CATEGORIE` FROM `categorie_meuble` WHERE 1 order BY NOM_CATEGORIE ASC');

	$this->load->view('Add_Appartement_View',$data);

}



function ajouter(){

 $ID_CATEGORIE = $this->input->post('ID_CATEGORIE');
 $IMAGE_MEUBLE = $this->input->post('IMAGE_MEUBLE');
 $NOM_MEUBLE = $this->input->post('NOM_MEUBLE');
 $NUMERO_MEUBLE = $this->input->post('NUMERO_MEUBLE');
 $MONTANT = $this->input->post('MONTANT');
 $ADRESSE = $this->input->post('ADRESSE');
 $NOMBRE_CHAMBRE = $this->input->post('NOMBRE_CHAMBRE');
 $LATITUDE = $this->input->post('LATITUDE');
 $LONGITUDE = $this->input->post('LONGITUDE');
 $ID_USER=$this->session->userdata('USER_ID');
 $quartier_filter = $this->input->post('quartier_filter');
 $avenue_filter = $this->input->post('avenue_filter');


 $this->form_validation->set_rules('NOMBRE_CHAMBRE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

 // print_r($IMAGE_MEUBLE);die();
 $this->form_validation->set_rules('LATITUDE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
 $this->form_validation->set_rules('LONGITUDE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
 $this->form_validation->set_rules('ID_CATEGORIE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
 $this->form_validation->set_rules('NOM_MEUBLE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
 $this->form_validation->set_rules('NUMERO_MEUBLE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
 $this->form_validation->set_rules('MONTANT', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
 $this->form_validation->set_rules('ADRESSE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

 if ($this->form_validation->run() == FALSE) {
  $this->add();
} else {

 $check=$this->Model->getOne('meuble',array('NUMERO_MEUBLE'=>$NUMERO_MEUBLE));

 $photoreperatoire =FCPATH.'/uploads/doc_meuble';
 $photo_avatar="DOC-".date('Ymdi').uniqid();
         // print_r($_FILES);die();
 $IMAGE_MEUBLE= $_FILES['IMAGE_MEUBLE']['name'];

 $config['upload_path'] ='./uploads/doc_meuble/';
 $config['allowed_types'] = '*';
 $test = explode('.', $IMAGE_MEUBLE);
 $ext = end($test);
 $name = $photo_avatar.'.'.$ext;
 $config['file_name'] =$name;
        if(!is_dir($photoreperatoire)) //create the folder if it does not already exists   
        {
          mkdir($photoreperatoire,0777,TRUE);

        } 

        $this->upload->initialize($config);
        $this->upload->do_upload('IMAGE_MEUBLE');

        if (!empty($_FILES['IMAGE_MEUBLE']['name'])) {
          # code...
          $IMAGE_MEUBLE=$config['file_name'];
          $data_image=$this->upload->data();
        }else{

          $IMAGE_MEUBLE=NULL;
        }


        

        if(empty($check)){

          $this->Model->create('meuble', array('ID_CATEGORIE' => $ID_CATEGORIE,'NOM_MEUBLE' => $NOM_MEUBLE,'NUMERO_MEUBLE' => $NUMERO_MEUBLE,'MONTANT' => $MONTANT,'ADRESSE' => $ADRESSE,'IMAGE_MEUBLE'=>$IMAGE_MEUBLE,'STATUT'=>1,'NOMBRE_CHAMBRE'=>$NOMBRE_CHAMBRE,'ID_USER'=>$ID_USER,'LATITUDE'=>$LATITUDE,'LONGITUDE'=>$LONGITUDE,'ID_QUARTIER'=>$quartier_filter,'ID_AVENUE'=>$avenue_filter));

         $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Enregistrement effectuée avec succès!!" . '</div>';
         $this->session->set_flashdata($data);
         redirect(base_url('appartement/Appartement'));

       }else{
         $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "La categorie existe deja!!" . '</div>';
         $this->session->set_flashdata($data);
         redirect(base_url('appartement/Appartement/add'));
       }

     }


   }

   function getOne($id){

     $data['meuble']=$this->Model->getOne('meuble',array('ID_MEUBLE'=>$id));

     $data['cate'] = $this->Model->getRequete('SELECT `ID_CATEGORIE`,`NOM_CATEGORIE` FROM `categorie_meuble` WHERE 1 order BY NOM_CATEGORIE ASC');

     $this->load->view('Update_Appartement_View',$data);

   }

   function update(){

     $ID_CATEGORIE = $this->input->post('ID_CATEGORIE');
     $ID_MEUBLE = $this->input->post('ID_MEUBLE');
     $NOM_MEUBLE = $this->input->post('NOM_MEUBLE');
     $NUMERO_MEUBLE = $this->input->post('NUMERO_MEUBLE');
     $MONTANT = $this->input->post('MONTANT');
     $ADRESSE = $this->input->post('ADRESSE');
     $NOMBRE_CHAMBRE = $this->input->post('NOMBRE_CHAMBRE');


     $this->form_validation->set_rules('NOMBRE_CHAMBRE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

 // print_r($IMAGE_MEUBLE);die();
     $this->form_validation->set_rules('ID_CATEGORIE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
     $this->form_validation->set_rules('NOM_MEUBLE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
     $this->form_validation->set_rules('NUMERO_MEUBLE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
     $this->form_validation->set_rules('MONTANT', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
     $this->form_validation->set_rules('ADRESSE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


     if ($this->form_validation->run() == FALSE) {
      $this->add();
    } else {

    	$check=$this->Model->getOne('meuble',array('NUMERO_MEUBLE'=>$NUMERO_MEUBLE));

    	$photoreperatoire =FCPATH.'/uploads/doc_meuble';
      $photo_avatar="DOC-".date('Ymdi').uniqid();
         // print_r($_FILES);die();
      $IMAGE_MEUBLE= $_FILES['IMAGE_MEUBLE']['name'];

      $config['upload_path'] ='./uploads/doc_meuble/';
      $config['allowed_types'] = '*';
      $test = explode('.', $IMAGE_MEUBLE);
      $ext = end($test);
      $name = $photo_avatar.'.'.$ext;
      $config['file_name'] =$name;
        if(!is_dir($photoreperatoire)) //create the folder if it does not already exists   
        {
          mkdir($photoreperatoire,0777,TRUE);

        } 

        $this->upload->initialize($config);
        $this->upload->do_upload('IMAGE_MEUBLE');

        if (!empty($_FILES['IMAGE_MEUBLE']['name'])) {
          # code...
          $IMAGE_MEUBLE=$config['file_name'];
          $data_image=$this->upload->data();
        }else{

          $IMAGE_MEUBLE=NULL;
        }



        if(empty($check)){

         $this->Model->update('meuble', array('ID_MEUBLE' => $ID_MEUBLE), array('ID_CATEGORIE' => $ID_CATEGORIE,'NOM_MEUBLE' => $NOM_MEUBLE,'NUMERO_MEUBLE' => $NUMERO_MEUBLE,'MONTANT' => $MONTANT,'ADRESSE' => $ADRESSE,'IMAGE_MEUBLE'=>$IMAGE_MEUBLE,'NOMBRE_CHAMBRE'=>$NOMBRE_CHAMBRE));

         $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Modification effectuée avec succès!!" . '</div>';
         $this->session->set_flashdata($data);
         redirect(base_url('appartement/Appartement'));

       }else{
         $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "La categorie existe deja!!" . '</div>';
         $this->session->set_flashdata($data);
         redirect(base_url('appartement/Appartement/getOne/'.$ID_MEUBLE));
       }

     }


   }


   function delete($id){

     $this->Model->delete('meuble', array('ID_MEUBLE' => $id));

     $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Suppression faite avec succès!!" . '</div>';
     $this->session->set_flashdata($data);
     redirect(base_url('appartement/Appartement'));
     
   }

 }
