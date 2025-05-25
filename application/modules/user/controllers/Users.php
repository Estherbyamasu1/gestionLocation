<?php

class Users extends CI_Controller  
{
	
	function __construct()
	{  
		
		parent::__construct(); 
        $this->is_auth(); 
	}
	function index()
	{

		$this->load->view('Liste_User_View');
	}





		//fonction liste
	function listing()
	{
		$query_principal="SELECT users.*,roles.*,sexe.* FROM `users` JOIN roles ON roles.rol_id = users.ROLE_ID JOIN sexe ON sexe.ID_SEXE=users.SEXE_ID WHERE 1";

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';
		if($_POST['length'] != -1)
		{
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}

		
		$order_column='';

		$order_column = array('users.ID_USER ','users.NOM_USER','users.PRENOM_USER');

		$search = !empty($_POST['search']['value']) ?  (" AND (users.NOM_USER LIKE '%$var_search%' OR users.PRENOM_USER LIKE '%$var_search%' OR users.TELEPHONE LIKE '%$var_search%' OR  users.EMAIL LIKE '%$var_search%')") :'';  

		$critaire = '';

		$order_by=' ORDER BY NOM_USER ASC';
		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;

		$query_filter = $query_principal.' '.$critaire.' '.$search.' '.$order_by;

		$fetch_cov_frais = $this->Model->datatable($query_secondaire);
		$data = array();
		$u=1;
		foreach($fetch_cov_frais as $info)
		{
			$post=array();
			$post[]=$u++;
			$post[]=$info->NOM_USER.' '.$info->PRENOM_USER;
			$post[]=$info->TELEPHONE;
			$post[]=$info->EMAIL;
			$post[]=$info->DESC_SEXE;
			$post[]=$info->rol_description;
			
			$post[]= '
			<div class="dropdown">
			<button class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cog">
			</i><span class='."caret".'> Actions</span>
			</button>
			<div class="dropdown-menu " aria-labelledby="dropdownMenuButton">

			<a href="'.base_url('matrice/Users/getOne/'.$info->ID_USER).'" >Modifier</i></a><br>
			<a style="color:red" data-toggle="modal" href="#" data-target="#staticBackdrop'.$info->ID_USER.'">Supprimer</a>
			</div>
			</div>
			<div class="modal fade" data-backdrop="static" id="staticBackdrop'.$info->ID_USER.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-body">
			<center>
			<h5><strong>Voulez-vous supprimer ?<i style="color:green;"></i></strong><br> <b style="background-color:prink"></b>
			</h5>

			</center>
			</div>
			<div class="modal-footer">

			<a  style="color:red" href="'.base_url('matrice/Users/delete/'.$info->ID_USER).'">supprimer</a>
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

	$this->load->view('Add_User_View');

}





}
