<?php

class Paiements extends CI_Controller  
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

		$this->load->view('flutterwave/Paiement_View');
	}





		//fonction liste
	function listing()
	{
		$query_principal="SELECT paiement.ID_PAIEMENT,paiement.MONTANT as montant_paye,paiement.MODE_PAIEMENT,paiement.RESERVATION_ID,paiement.STATUT_PAIEMENT,paiement.DATE_PAIEMENT,reservation.MEUBLE_ID,reservation.ID_LOCATAIRE,meuble.NOM_MEUBLE,meuble.NUMERO_MEUBLE,locataire.NOM_LOCATAIRE,locataire.PRENOM_LOCATAIRE,locataire.TELEPHONE,locataire.EMAIL as locat_email,paiement.IMAGE_RECU FROM `paiement` JOIN reservation ON reservation.RESERVATION_ID=paiement.RESERVATION_ID LEFT JOIN meuble ON reservation.MEUBLE_ID=meuble.ID_MEUBLE LEFT JOIN locataire ON locataire.ID_LOCATAIRE=reservation.ID_LOCATAIRE WHERE 1";

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';
		if($_POST['length'] != -1)
		{
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}

		
		$order_column='';

		$order_column = array('paiement.ID_PAIEMENT','paiement.MONTANT','meuble.ID_MEUBLE','meuble.NOM_MEUBLE','meuble.NUMERO_MEUBLE','locataire.NOM_LOCATAIRE','locataire.PRENOM_LOCATAIRE');

		$search = !empty($_POST['search']['value']) ?  (" AND (meuble.NOM_MEUBLE LIKE '%$var_search%' OR meuble.NUMERO_MEUBLE LIKE '%$var_search%' OR locataire.NOM_LOCATAIRE LIKE '%$var_search%' OR locataire.PRENOM_LOCATAIRE LIKE '%$var_search%' OR  paiement.MONTANT LIKE '%$var_search%')") :'';  

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
            if($info->STATUT_PAIEMENT==1){
            
               $statut="Payé";

            }elseif ($info->STATUT_PAIEMENT==2) {

            	$statut="Non payé";
            	# code...
            }


            $mode='';

            if($info->MODE_PAIEMENT==1){
              $mode='';
            }elseif($info->MODE_PAIEMENT==2){
            	$mode='';
            }else{
               $mode='';
            }

			$post=array();
			$post[]=$u++;
			$post[]=$info->NOM_LOCATAIRE.' '.$info->PRENOM_LOCATAIRE;
			$post[]=$info->NOM_MEUBLE.'('.$info->NUMERO_MEUBLE.')';
			$post[]=$info->locat_email.'('.$info->TELEPHONE.')';
			$post[]=$info->montant_paye;
			$post[]=$mode;
			$post[]=$statut;
			// $post[]='<div class="col-md-12"><embed src="' . base_url('uploads/doc_meuble/' . $info->IMAGE_MEUBLE) . '" type="application/pdf"   scrolling="auto" height="30px" width="20%"></div>';

			$post[] = '<a  data-toggle="modal" data-target="#path_document' . $info->ID_PAIEMENT . '" class="btn btn-default btn-sm"><span style="font-size:20px;" class="fa ' . (strtolower(substr($info->IMAGE_RECU, -4)) === '.pdf' ? "fa-file-pdf-o" : "fa-image") . '"></span></a>

               <div class="modal fade" id="path_document' . $info->ID_PAIEMENT  . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="col-md-12"><embed src="' . base_url('uploads/doc_meuble/' . $info->IMAGE_RECU) . '" type="application/pdf"   scrolling="auto" height="400px" width="100%"></div>

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

			<a href="'.base_url('appartement/Appartement/getOne/'.$info->ID_PAIEMENT).'" >Modifier</i></a><br>
			<a style="color:red" data-toggle="modal" href="#" data-target="#staticBackdrop'.$info->ID_PAIEMENT.'">Supprimer</a>
			</div>
			</div>
			<div class="modal fade" data-backdrop="static" id="staticBackdrop'.$info->ID_PAIEMENT.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-body">
			<center>
			<h5><strong>Voulez-vous supprimer ?<i style="color:green;"></i></strong><br> <b style="background-color:prink"></b>
			</h5>

			</center>
			</div>
			<div class="modal-footer">

			<a  style="color:red" href="'.base_url('appartement/Appartement/delete/'.$info->ID_PAIEMENT).'">supprimer</a>
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

	$this->load->view('flutterwave/Add_Paiement');

}




public function paiement_local()
{
  $json = json_decode(file_get_contents('php://input'), true);
  $mode = $json['mode_paiement'];
  $montant = $json['montant'];
  $locataire_id = $this->session->userdata('LOCATAIRE_ID');

  // Traitement simulé du paiement local (Airtel ou Mvola)
  // Tu peux intégrer ici l’API d’opérateurs mobiles si tu en as une

  // Exemple de sauvegarde dans la base
  $data = [
    'MONTANT' => $montant,
    'MODE_PAIEMENT' => $mode == 'mvola' ? 1 : 2,
    'STATUT_PAIEMENT' => 1, // payé
    'DATE_PAIEMENT' => date('Y-m-d H:i:s'),
    'RESERVATION_ID' => 0, // À adapter si tu as une réservation spécifique
    'ID_LOCATAIRE' => $locataire_id
  ];

  $this->Model->create('paiement', $data);

  echo json_encode(['status' => 'success', 'message' => 'Paiement local effectué avec succès.']);
}


public function confirmation_flutterwave()
{
  $transaction_id = $this->input->get('ref');
  
  // Appelle l'API de Flutterwave pour confirmer le paiement
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/$transaction_id/verify",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer FLWSECK_TEST-XXXXXXXXX"
    ),
  ));

  $response = curl_exec($curl);
  curl_close($curl);
  $response = json_decode($response);

  if ($response && $response->status == 'success') {
    // Sauvegarde dans ta base
    $data = [
      'MONTANT' => $response->data->amount,
      'MODE_PAIEMENT' => 3, // Flutterwave
      'STATUT_PAIEMENT' => 1,
      'DATE_PAIEMENT' => date('Y-m-d H:i:s'),
      'RESERVATION_ID' => 0,
      'ID_LOCATAIRE' => $this->session->userdata('LOCATAIRE_ID')
    ];
    $this->Model->create('paiement', $data);

    redirect('perso'); // rediriger vers la liste des paiements
  } else {
    echo "Paiement non vérifié.";
  }
}



 function ajouter(){

   $ID_CATEGORIE = $this->input->post('ID_CATEGORIE');
   $IMAGE_MEUBLE = $this->input->post('IMAGE_MEUBLE');
   $NOM_MEUBLE = $this->input->post('NOM_MEUBLE');
   $NUMERO_MEUBLE = $this->input->post('NUMERO_MEUBLE');
   $MONTANT = $this->input->post('MONTANT');
   $ADRESSE = $this->input->post('ADRESSE');
    
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

             $this->Model->create('meuble', array('ID_CATEGORIE' => $ID_CATEGORIE,'NOM_MEUBLE' => $NOM_MEUBLE,'NUMERO_MEUBLE' => $NUMERO_MEUBLE,'MONTANT' => $MONTANT,'ADRESSE' => $ADRESSE,'IMAGE_MEUBLE'=>$IMAGE_MEUBLE,'STATUT'=>1));

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

	$data['meuble']=$this->Model->getOne('meuble',array('ID_PAIEMENT'=>$id));

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

             $this->Model->update('meuble', array('ID_MEUBLE' => $ID_MEUBLE), array('ID_CATEGORIE' => $ID_CATEGORIE,'NOM_MEUBLE' => $NOM_MEUBLE,'NUMERO_MEUBLE' => $NUMERO_MEUBLE,'MONTANT' => $MONTANT,'ADRESSE' => $ADRESSE,'IMAGE_MEUBLE'=>$IMAGE_MEUBLE));

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
