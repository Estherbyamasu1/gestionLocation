<?php

class Locataire extends CI_Controller  
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

		$this->load->view('Locataire_View');
	}





		//fonction liste
	function listing()
	{
		$query_principal="SELECT locataire.*,locataire.EMAIL AS EMAIL_LOCATAIRE,locataire.TELEPHONE AS TEL_LOCATAIRE,users.* FROM `locataire` LEFT JOIN users ON users.ID_USER=locataire.ID_USER WHERE 1";

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';
		if($_POST['length'] != -1)
		{
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}

		
		$order_column='';

		$order_column = array('locataire.ID_LOCATAIRE','locataire.NOM_LOCATAIRE','locataire.PRENOM_LOCATAIRE','locataire.TELEPHONE');

		$search = !empty($_POST['search']['value']) ?  (" AND (locataire.NOM_LOCATAIRE LIKE '%$var_search%' OR locataire.PRENOM_LOCATAIRE LIKE '%$var_search%' OR locataire.TELEPHONE LIKE '%$var_search%' OR  locataire.EMAIL LIKE '%$var_search%')") :'';  

		$critaire = '';

		$order_by=' ORDER BY NOM_LOCATAIRE ASC';
		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;

		$query_filter = $query_principal.' '.$critaire.' '.$search.' '.$order_by;

		$fetch_cov_frais = $this->Model->datatable($query_secondaire);
		$data = array();
		$u=1;
		foreach($fetch_cov_frais as $info)
		{
         $stat='';

         if($info->STATUT==1){

          $stat='En attente';

         }elseif ($info->STATUT==2) {

          $stat='validé';
           # code...
         }else{

          $stat='Non Validé';

         }

			$post=array();
			$post[]=$u++;
			$post[]=$info->NOM_LOCATAIRE.' '.$info->PRENOM_LOCATAIRE;
			$post[]=$info->EMAIL_LOCATAIRE.' ('.$info->TEL_LOCATAIRE.')';
			$post[]=$info->NOM_USER.' '.$info->PRENOM_USER;
      $post[]=$stat;
			$post[]=$info->DATE_INSERTION;
			
			
			$post[]='
			<div class="dropdown">
			<button class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cog">
			</i><span class='."caret".'> Actions</span>
			</button>
			<div class="dropdown-menu " aria-labelledby="dropdownMenuButton">

      <a style="text-decoration:none;cursor:pointer;color:blue;" class="btn-md" onclick="traiter_ticket('.$info->ID_LOCATAIRE.')"><b>&nbsp;&nbsp;&nbsp;Traiter</b></a>

     <a style="text-decoration:none;cursor:pointer;color:blue;" class="btn-md" onclick="historique_ticket('.$info->ID_LOCATAIRE.')"><b>&nbsp;&nbsp;&nbsp;Historique</b></a>
      

			<a href="'.base_url('locataire/Locataire/getOne/'.$info->ID_LOCATAIRE).'" >Modifier</i></a><br>
			<a style="color:red" data-toggle="modal" href="#" data-target="#staticBackdrop'.$info->ID_LOCATAIRE.'">Supprimer</a>
			</div>
			</div>
			<div class="modal fade" data-backdrop="static" id="staticBackdrop'.$info->ID_LOCATAIRE.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-body">
			<center>
			<h5><strong>Voulez-vous supprimer ?<i style="color:green;"></i></strong><br> <b style="background-color:prink"></b>
			</h5>

			</center>
			</div>
			<div class="modal-footer">

			<a  style="color:red" href="'.base_url('locataire/Locataire/delete/'.$info->ID_LOCATAIRE).'">supprimer</a>
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

	$this->load->view('Add_Locataire_View');

}



 function ajouter(){

   $NOM_LOCATAIRE = $this->input->post('NOM_LOCATAIRE');
   $PRENOM_LOCATAIRE = $this->input->post('PRENOM_LOCATAIRE');
   $TELEPHONE = $this->input->post('TELEPHONE');
   $EMAIL = $this->input->post('EMAIL');
   $ID_USER = $this->session->userdata('USER_ID');
 // print_r($IMAGE_MEUBLE);die();
   $this->form_validation->set_rules('NOM_LOCATAIRE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
   $this->form_validation->set_rules('PRENOM_LOCATAIRE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
   $this->form_validation->set_rules('TELEPHONE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
   $this->form_validation->set_rules('EMAIL', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

   if ($this->form_validation->run() == FALSE) {
      $this->add();
    } else {
      
    	$check=$this->Model->getOne('locataire',array('NOM_LOCATAIRE'=>$NOM_LOCATAIRE,'PRENOM_LOCATAIRE'=>$PRENOM_LOCATAIRE));
    
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

             $this->Model->create('locataire', array('NOM_LOCATAIRE'=>$NOM_LOCATAIRE,'PRENOM_LOCATAIRE'=>$PRENOM_LOCATAIRE,'TELEPHONE' => $TELEPHONE,'EMAIL' => $EMAIL,'ID_USER' => $ID_USER,'STATUT'=>2,'IMAGE_LOCATAIRE'=>$IMAGE_LOCATAIRE));

    		 $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Enregistrement effectuée avec succès!!" . '</div>';
           $this->session->set_flashdata($data);
          redirect(base_url('locataire/Locataire'));

    	}else{
             $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "La categorie existe deja!!" . '</div>';
             $this->session->set_flashdata($data);
          redirect(base_url('locataire/Locataire/add'));
    	}

    }


}

function getOne($id){

	$data['locataire']=$this->Model->getOne('locataire',array('ID_LOCATAIRE'=>$id));

	$this->load->view('Update_Locataire_View',$data);

}

function update(){

   $ID_LOCATAIRE = $this->input->post('ID_LOCATAIRE');
   $NOM_LOCATAIRE = $this->input->post('NOM_LOCATAIRE');
   $PRENOM_LOCATAIRE = $this->input->post('PRENOM_LOCATAIRE');
   $TELEPHONE = $this->input->post('TELEPHONE');
   $EMAIL = $this->input->post('EMAIL');
   $ID_USER = $this->session->userdata('USER_ID');
 // print_r($IMAGE_MEUBLE);die();
   $this->form_validation->set_rules('NOM_LOCATAIRE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
   $this->form_validation->set_rules('PRENOM_LOCATAIRE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
   $this->form_validation->set_rules('TELEPHONE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
   $this->form_validation->set_rules('EMAIL', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


   if ($this->form_validation->run() == FALSE) {
      $this->add();
    } else {

    	$check=$this->Model->getOne('locataire',array('NOM_LOCATAIRE'=>$NOM_LOCATAIRE,'PRENOM_LOCATAIRE'=>$PRENOM_LOCATAIRE));

    	// $photoreperatoire =FCPATH.'/uploads/doc_meuble';
     //    $photo_avatar="DOC-".date('Ymdi').uniqid();
     //     // print_r($_FILES);die();
     //    $IMAGE_MEUBLE= $_FILES['IMAGE_MEUBLE']['name'];
        
     //    $config['upload_path'] ='./uploads/doc_meuble/';
     //    $config['allowed_types'] = '*';
     //    $test = explode('.', $IMAGE_MEUBLE);
     //    $ext = end($test);
     //    $name = $photo_avatar.'.'.$ext;
     //    $config['file_name'] =$name;
     //    if(!is_dir($photoreperatoire)) //create the folder if it does not already exists   
     //    {
     //      mkdir($photoreperatoire,0777,TRUE);

     //    } 
       
     //    $this->upload->initialize($config);
     //    $this->upload->do_upload('IMAGE_MEUBLE');

     //    if (!empty($_FILES['IMAGE_MEUBLE']['name'])) {
     //      # code...
     //      $IMAGE_MEUBLE=$config['file_name'];
     //      $data_image=$this->upload->data();
     //    }else{

     //      $IMAGE_MEUBLE=NULL;
     //    }



    	if(empty($check)){

             $this->Model->update('locataire', array('ID_LOCATAIRE' => $ID_LOCATAIRE), array('NOM_LOCATAIRE'=>$NOM_LOCATAIRE,'PRENOM_LOCATAIRE'=>$PRENOM_LOCATAIRE,'TELEPHONE' => $TELEPHONE,'EMAIL' => $EMAIL));

    		 $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Modification effectuée avec succès!!" . '</div>';
           $this->session->set_flashdata($data);
          redirect(base_url('locataire/Locataire'));

    	}else{
             $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "La categorie existe deja!!" . '</div>';
             $this->session->set_flashdata($data);
          redirect(base_url('locataire/Locataire/getOne/'.$ID_MEUBLE));
    	}

    }


}


function delete($id){

	$this->Model->delete('locataire', array('ID_LOCATAIRE' => $id));

    $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Suppression faite avec succès!!" . '</div>';
     $this->session->set_flashdata($data);
     redirect(base_url('locataire/Locataire'));
     
}

function getOnetraite($id){


  $data = $this->Model->getOne('locataire', array('ID_LOCATAIRE' => $id));

    $data_statut = $this->Model->getRequete("SELECT `ID_STATUT_DEMANDE`, `DESC_DEMANDE` FROM `statut_demande`");
    

$html_statut="";
    foreach ($data_statut as $value) {
      $select = '';

      if ($data["STATUT"] == $value["ID_STATUT_DEMANDE"]) {
        $select = "selected disabled";
      }

      if ($data["STATUT"] == 3) {
        continue;
      }

      $html_statut .= '<option value="' . $value['ID_STATUT_DEMANDE'] . '" ' . $select . '>' . $value['DESC_DEMANDE'] . '</option>';
    }
    
    $output = array('ID_LOCATAIRE' => $data['ID_LOCATAIRE'], 'ID_STATUT_DEMANDE' => $html_statut);

    echo json_encode($output);


}


function traite_ticket()
  {
    $this->_validate();


    $ID_STATUT_DEMANDE=$this->input->post('ID_STATUT_DEMANDE');
    
    $COMMENTAIRE=$this->input->post('COMMENTAIRE');
    $ID_LOCATAIRE=$this->input->post('ID_LOCATAIRE');
    
    $user=$this->session->userdata('USER_ID');

    $demande_email=$this->Model->getOne('locataire', array('ID_LOCATAIRE' =>$ID_LOCATAIRE));
// print_r($ID_LOCATAIRE);die();
   $pass=$this->notifications->generate_password(5);
    $this->Model->create('historique_locataire_demande',array('USER_ID'=>$user,'STATUT_ID'=>$ID_STATUT_DEMANDE,'ID_LOCATAIRE'=>$ID_LOCATAIRE,'COMMENTAIRE'=>$COMMENTAIRE,'DATE_INSERTION'=>date('Y-m-d H:i:s')));

      $this->Model->update('locataire',array('ID_LOCATAIRE'=>$ID_LOCATAIRE),array('STATUT'=>$ID_STATUT_DEMANDE,'PASSWORD'=>$pass));

    
      if($ID_STATUT_DEMANDE==2){

         $to=$demande_email['EMAIL'];
        $subject='Votre demande a été approuve';
        $message = "chère <b>".$demande_email['NOM_LOCATAIRE']."</b>,<br>Voici vos identifiant: <br><br> Email :".$to.",<br>Mot de passe:".$to.",<br><br>  Merci cordialement.
        </b>";
      
       // $this->notifications->send_mail($to, $subject, [], $message, []);
      }
   

  

    echo json_encode(array('status'=>true));
  }


  function _validate()
  {

    
    $data['inputerror']=array();
    $data['error_string']=array();
    $data['status']=TRUE;
    
    
    if ($this->input->post('ID_STATUT_DEMANDE')=="") 
    {
      
      $data['inputerror'][]="ID_STATUT_DEMANDE";
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


    $query_principal="SELECT hld.`ID_HISTORIQUE_DEMANDE`,hld.`ID_LOCATAIRE`,hld.`USER_ID`,hld.`STATUT_ID`,hld.`COMMENTAIRE`,hld.`DATE_INSERTION`,locataire.NOM_LOCATAIRE,locataire.PRENOM_LOCATAIRE,users.NOM_USER,users.PRENOM_USER,users.EMAIL,statut_demande.DESC_DEMANDE FROM `historique_locataire_demande` hld JOIN locataire ON locataire.ID_LOCATAIRE=hld.`ID_LOCATAIRE` LEFT JOIN users ON users.ID_USER=hld.`USER_ID` JOIN statut_demande ON statut_demande.ID_STATUT_DEMANDE=hld.`STATUT_ID` WHERE hld.`ID_LOCATAIRE` = ".$id;
    



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


    $search = !empty($_POST['search']['value']) ? (" AND ( users.NOM_USER LIKE '%$var_search%' OR users.PRENOM_USER LIKE '%$var_search%' OR statut_demande.DESC_DEMANDE LIKE '%$var_search%' OR CONCAT(users.NOM_USER,' ',users.PRENOM_USER) LIKE '%$var_search%' ) ") : '';


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
      $sub_array[]=$row->DESC_DEMANDE;
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
