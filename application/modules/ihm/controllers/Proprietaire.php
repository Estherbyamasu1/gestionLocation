<?php 

/**
 * christa
 */
class Proprietaire extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view('Proprietaire_List_View');
	}

	function listing()
	{
		$query_principal="SELECT proprietaire.PROPRIETAIRE_ID,proprietaire.CODE_MENAGE,proprietaire.NOM,proprietaire.PRENOM,sexe.SEXE_DESCRIPTION,syst_zones.ZONE_NAME,quartier.QUARTIER_DESC,proprietaire.EMAIL,proprietaire.TELEPHONE FROM `proprietaire` JOIN sexe ON sexe.SEXE_ID=proprietaire.SEXE_ID LEFT JOIN syst_zones ON syst_zones.ZONE_ID=proprietaire.ZONE_ID LEFT JOIN quartier ON quartier.QUARTIER_ID=proprietaire.QUARTIER_ID WHERE 1";

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';


		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}
		$order_by='';



		$order_column=array('NOM');

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY NOM  ASC';

		$search = !empty($_POST['search']['value']) ? (" AND CODE_MENAGE LIKE '%$var_search%' or NOM LIKE '%var_search%' or PRENOM LIKE '%var_search%' or SEXE_DESCRIPTION LIKE '%var_search%' or ZONE_NAME LIKE '%var_search%' or QUARTIER_DESC LIKE '%var_search%'  or EMAIL LIKE '%var_search%' ") : '';     

		$critaire = '';

		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
		$query_filter = $query_principal.' '.$critaire.' '.$search;

		$abonne='';
		
		$fetch_marche = $this->Model->datatable($query_secondaire);
		$data = array();
		$u=0;
		foreach ($fetch_marche as $row) {

			$u++;
			$sub_array = array();
			$sub_array[] =  $u;
			$sub_array[]=$row->CODE_MENAGE;
			$sub_array[]=$row->NOM.' '.$row->PRENOM; 
			$sub_array[]=$row->SEXE_DESCRIPTION;  
			$sub_array[]=$row->ZONE_NAME;
			$sub_array[]=$row->QUARTIER_DESC;
			$sub_array[]=$row->EMAIL; 
			$sub_array[]=$row->TELEPHONE;

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

 ?>