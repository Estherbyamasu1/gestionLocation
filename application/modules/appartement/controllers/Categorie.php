<?php

class Categorie extends CI_Controller  
{
	
	function __construct()
	{  
		
		parent::__construct();  
	}
	function index()
	{

		$this->load->view('Categorie_View');
	}





		//fonction liste
	function listing()
	{
		$query_principal="SELECT `ID_CATEGORIE`,`NOM_CATEGORIE` FROM `categorie_meuble` WHERE 1";

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';
		if($_POST['length'] != -1)
		{
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}

		
		$order_column='';

		$order_column = array('ID_CATEGORIE','NOM_CATEGORIE');

		$search = !empty($_POST['search']['value']) ?  (" AND (NOM_CATEGORIE LIKE '%$var_search%')") :'';  

		$critaire = '';

		$order_by=' ORDER BY NOM_CATEGORIE ASC';
		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;

		$query_filter = $query_principal.' '.$critaire.' '.$search.' '.$order_by;

		$fetch_cov_frais = $this->Model->datatable($query_secondaire);
		$data = array();
		$u=1;
		foreach($fetch_cov_frais as $info)
		{
			$post=array();
			$post[]=$u++;
			$post[]=$info->NOM_CATEGORIE;
			
			$post[]= '
			<div class="dropdown">
			<button class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cog">
			</i><span class='."caret".'> Actions</span>
			</button>
			<div class="dropdown-menu " aria-labelledby="dropdownMenuButton">

			<a href="'.base_url('appartement/Categorie/getOne/'.$info->ID_CATEGORIE).'" >Modifier</i></a><br>
			<a style="color:red" data-toggle="modal" href="#" data-target="#staticBackdrop'.$info->ID_CATEGORIE.'">Supprimer</a>
			</div>
			</div>
			<div class="modal fade" data-backdrop="static" id="staticBackdrop'.$info->ID_CATEGORIE.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-body">
			<center>
			<h5><strong>Voulez-vous supprimer ?<i style="color:green;"></i></strong><br> <b style="background-color:prink"></b>
			</h5>

			</center>
			</div>
			<div class="modal-footer">

			<a  style="color:red" href="'.base_url('appartement/Categorie/delete/'.$info->ID_CATEGORIE).'">supprimer</a>
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

	$this->load->view('Add_categorie_View');

}

function ajouter(){

   $NOM_CATEGORIE = $this->input->post('NOM_CATEGORIE');
// print_r($NOM_CATEGORIE);die();
   $this->form_validation->set_rules('NOM_CATEGORIE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

   if ($this->form_validation->run() == FALSE) {
      $this->add();
    } else {

    	$check=$this->Model->getOne('categorie_meuble',array('NOM_CATEGORIE'=>$NOM_CATEGORIE));

    	if(empty($check)){

             $this->Model->create('categorie_meuble', array('NOM_CATEGORIE' => $NOM_CATEGORIE));

    		 $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Enregistrement effectuée avec succès!!" . '</div>';
           $this->session->set_flashdata($data);
          redirect(base_url('appartement/Categorie'));

    	}else{
             $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "La categorie existe deja!!" . '</div>';
             $this->session->set_flashdata($data);
          redirect(base_url('appartement/Categorie/add'));
    	}

    }


}

function getOne($id){

		$data['categorie']=$this->Model->getOne('categorie_meuble',array('ID_CATEGORIE'=>$id));

		$this->load->view('Update_categorie_View',$data);

}


function update(){

   $ID_CATEGORIE = $this->input->post('ID_CATEGORIE');
   $NOM_CATEGORIE = $this->input->post('NOM_CATEGORIE');
// print_r($NOM_CATEGORIE);die();
   $this->form_validation->set_rules('NOM_CATEGORIE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

   if ($this->form_validation->run() == FALSE) {
      $this->add();
    } else {

    	$check=$this->Model->getOne('categorie_meuble',array('NOM_CATEGORIE'=>$NOM_CATEGORIE));

    	if(empty($check)){

             $this->Model->update('categorie_meuble', array('ID_CATEGORIE' => $ID_CATEGORIE), array('NOM_CATEGORIE' => $NOM_CATEGORIE));

    		 $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Modification effectuée avec succès!!" . '</div>';
           $this->session->set_flashdata($data);
          redirect(base_url('appartement/Categorie'));

    	}else{
             $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "La categorie existe deja!!" . '</div>';
             $this->session->set_flashdata($data);
          redirect(base_url('appartement/Categorie/getOne/'.$ID_CATEGORIE));
    	}

    }


}

function delete($id){

	$this->Model->delete('categorie_meuble', array('ID_CATEGORIE' => $id));

    $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Suppression faite avec succès!!" . '</div>';
     $this->session->set_flashdata($data);
     redirect(base_url('appartement/Categorie'));
     
}




}
