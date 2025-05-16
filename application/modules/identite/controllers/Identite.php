<?php
class Identite extends CI_Controller  
{
	
	function __construct()
	{  
		
		parent::__construct();  
	}

	//fonction pour affichier le view
	function index()
	{

		$this->load->view('Identite_View');
	}


			//fonction pour afficher la liste des identite
	function listing()
	{
		$query_principal="SELECT identite.IDENTITE_ID,identite.NOM,identite.PRENOM,identite.MATRICULE,identite.PHOTO,identite.DATE_INSERTION,profession.PROF_DESCRIPTION,sexe.DESCRIPTION_SEXE,etat_civil.DESCRIPTION FROM `identite` JOIN profession ON profession.PROFESSION_ID =identite.PROFESSION_ID JOIN sexe ON sexe.SEXE_ID =identite.ID_SEXE JOIN etat_civil ON etat_civil.ETAT_CIVIL = identite.ETAT_CIVIL_ID WHERE 1";


		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';
		if($_POST['length'] != -1)
		{
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}

		
		$order_column='';

		$order_column('');
		$order_column = array('identite.IDENTITE_ID','identite.NOM','identite.PRENOM');

		$search = !empty($_POST['search']['value']) ?  (" AND (identite.NOM LIKE '%$var_search%' OR identite.NOM LIKE '%$var_search%' OR identite.MATRICULE LIKE '%$var_search%' OR profession.PROF_DESCRIPTION LIKE '%$var_search%' OR etat_civil.DESCRIPTION LIKE '%$var_search%')") :'';  

		$critaire = '';

		$order_by=' ORDER BY NOM ASC';
		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;

		$query_filter = $query_principal.' '.$critaire.' '.$search.' '.$order_by;

		$fetch_cov_frais = $this->Model->datatable($query_secondaire);
		$data = array();
		$u=1;
		foreach($fetch_cov_frais as $info)
		{
			$post=array();
			$post[]=$u++;
			$post[]=$info->NOM; 
			$post[]=$info->PRENOM;
			$post[]=$info->SEXE;
			$post[]=$info->PROF_DESCRIPTION;
			$post[]=$info->DESCRIPTION;
			$post[]=$info->MATRICULE;
		    $post[]=$info->PHOTO;
			$post[]= '
			<div class="dropdown">
			<button class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cog">
			</i><span class='."caret".'> Actions</span>
			</button>
			<div class="dropdown-menu " aria-labelledby="dropdownMenuButton">

			<a href="'.base_url('matrice/Users/getOne/'.$info->IDENTITE_ID).'" >Modifier</i></a><br>
			<a style="color:red" data-toggle="modal" href="#" data-target="#staticBackdrop'.$info->IDENTITE_ID.'">Supprimer</a>
			</div>
			</div>
			<div class="modal fade" data-backdrop="static" id="staticBackdrop'.$info->IDENTITE_ID.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-body">
			<center>
			<h5><strong>Voulez-vous supprimer ?<i style="color:green;"></i></strong><br> <b style="background-color:prink"></b>
			</h5>

			</center>
			</div>
			<div class="modal-footer">

			<a  style="color:red" href="'.base_url('matrice/Users/delete/'.$info->IDENTITE_ID).'">supprimer</a>
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
	}