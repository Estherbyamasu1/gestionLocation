<?php

class Etudiants extends CI_Controller  
{
	
	function __construct()
	{  
		
		parent::__construct();  
	}
	function index()
	{

		$this->load->view('Etudiants_View');
	}





		//fonction liste
	function listing()
	{
		$query_principal="SELECT etudiant.ID_ET,etudiant.NOM_ET,etudiant.PRENOM_ET,etudiant.EMAIL_ET,etudiant.TELEPHONE_ET,etudiant.PHOTO_ET,etudiant.MATRICULE_ET,etudiant.PHOTO_URL_ET,etudiant.PASSWORD_ET,genre.GENRE,grade.GRADE,categorie.CATEGORIE,faculte.FACULTE,classe.CLASSE,option_et.NOM_OPTION FROM etudiant JOIN genre ON genre.ID_GENRE =etudiant.ID_GENRE JOIN faculte ON faculte.ID_FACULTE=etudiant.ID_FACULTE JOIN grade ON grade.ID_GRADE = etudiant.ID_GRADE JOIN categorie ON categorie.ID_CATEGORIE = etudiant.ID_CATEGORIE JOIN classe ON classe.ID_CLASSE=etudiant.ID_CLASSE JOIN option_et ON option_et.ID_OPT=etudiant.ID_OPT WHERE 1";

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';
		if($_POST['length'] != -1)
		{
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}

		
		$order_column='';

		$order_column = array('etudiant.ID_ET','etudiant.NOM_ET','etudiant.PRENOM_ET');

		$search = !empty($_POST['search']['value']) ?  (" AND (etudiant.MATRICULE_ET LIKE '%$var_search%'etudiant.NOM_ET LIKE '%$var_search%' OR etudiant.PRENOM_ET LIKE '%$var_search%' OR faculte.FACULTE LIKE '%$var_search%' OR etudiant.EMAIL_ET LIKE '%$var_search%')") :'';  

		$critaire = '';

		$order_by=' ORDER BY NOM_ET ASC';
		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;

		$query_filter = $query_principal.' '.$critaire.' '.$search.' '.$order_by;

		$fetch_cov_frais = $this->Model->datatable($query_secondaire);
		$data = array();
		$u=1;
		foreach($fetch_cov_frais as $info)
		{
			$post=array();
			$post[]=$u++;
			$post[]=$info->MATRICULE_ET; 
			$post[]=$info->NOM_ET;
			$post[]=$info->PRENOM_ET;
			$post[]=$info->GENRE;
			$post[]=$info->CATEGORIE;
			$post[]=$info->GRADE;
		    $post[]=$info->CLASSE;
            $post[]=$info->NOM_OPTION;
			$post[]=$info->FACULTE;
	        $post[]=$info->EMAIL_ET;
	        $post[]=$info->PASSWORD_ET;
			$post[]= '
			<div class="dropdown">
			<button class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cog">
			</i><span class='."caret".'> Actions</span>
			</button>
			<div class="dropdown-menu " aria-labelledby="dropdownMenuButton">

			<a href="'.base_url('matrice/Users/getOne/'.$info->ID_ET).'" >Modifier</i></a><br>
			<a style="color:red" data-toggle="modal" href="#" data-target="#staticBackdrop'.$info->ID_ET.'">Supprimer</a>
			</div>
			</div>
			<div class="modal fade" data-backdrop="static" id="staticBackdrop'.$info->ID_ET.'">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-body">
			<center>
			<h5><strong>Voulez-vous supprimer ?<i style="color:green;"></i></strong><br> <b style="background-color:prink"></b>
			</h5>

			</center>
			</div>
			<div class="modal-footer">

			<a  style="color:red" href="'.base_url('matrice/Users/delete/'.$info->ID_ET).'">supprimer</a>
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
