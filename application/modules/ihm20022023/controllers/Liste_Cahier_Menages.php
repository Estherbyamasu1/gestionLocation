<?php
/**
* 
*/
class Liste_Cahier_Menages extends CI_Controller
{
	

 public function index(){
	 
    $this->load->view('Liste_Cahier_Menages_View');
 }


	function listing()
	{
	 	$query_principal='SELECT `CAHIER_MENAGES_ID`,`CODE_MENAGE`,`CNI`,`NOM`,`PRENOM`,syst_provinces.PROVINCE_NAME AS province,syst_communes.COMMUNE_NAME as commune,syst_zones.ZONE_NAME as zone,`PERE`,`MERE`,`FONCTION`,`EST_VISITEUR` FROM `cahier_menages` join syst_provinces on cahier_menages.PROVINCE_ID=syst_provinces.PROVINCE_ID join syst_communes on cahier_menages.COMMUNE_ID=syst_communes.COMMUNE_ID join syst_zones on cahier_menages.ZONE_ID=syst_zones.ZONE_ID WHERE 1';

	 	$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

	 	$limit='LIMIT 0,10';


	 	if($_POST['length'] != -1){
	 		$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
	 	}

	 	$order_by='';
	 	$order_column=array('NOM','PRENOM','province','commune','zone','PERE','MERE','FONCTION' ,'EST_VISITEUR');
	 	$order_by=isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']].' ' .$_POST['order']['0']['dir'] : ' ORDER BY NOM ASC';

	 	$search=!empty($_POST['search']['value']) ? (" AND (NOM LIKE '%$var_search%' OR PRENOM LIKE '%$var_search%' OR CONCAT(NOM,' ',PRENOM) LIKE '%$var_search%' OR PERE LIKE '%$var_search%' OR MERE LIKE '%$var_search%' OR FONCTION LIKE '%$var_search%' OR EST_VISITEUR LIKE '%$var_search%' OR syst_provinces.PROVINCE_NAME LIKE '%$var_search%' OR syst_communes.COMMUNE_NAME LIKE '%$var_search%' OR syst_zones.ZONE_NAME LIKE '%$var_search%')"):'';
			// $order_by='';
			// $order_column='';
			// if (!empty($order_by)) {

			// 	$order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY NOM   ASC';
			// }
			// $search = !empty($_POST['search']['value']) ?  (" AND `NOM` LIKE '%$var_search%' OR PRENOM LIKE '%$var_search%' OR syst_provinces.PROVINCE_NAME LIKE '%$var_search%' OR syst_communes.COMMUNE_NAME LIKE '%$var_search%' OR syst_zones.ZONE_NAME LIKE '%$var_search%' OR PERE LIKE '%$var_search%' OR MERE LIKE '%$var_search%' OR FONCTION LIKE '%$var_search%' OR EST_VISITEUR LIKE '%$var_search%' ") :'';   

	 	$critaire = '';
	 	$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;

	 	$query_filter = $query_principal.' '.$critaire.' '.$search;

			// $abonne='';

	 	$fetch_cov_frais = $this->Model->datatable($query_secondaire);
	 	$data = array();
	 	$u=1;
	 	foreach($fetch_cov_frais as $info)
	 	{
	 		$post=array();
	 		$post[]=$u++; 
	 		$post[]=$info->CODE_MENAGE;
	 		$post[]=$info->NOM."  ".$info->PRENOM;
	 		$post[]=$info->CNI;
	 		$post[]=$info->FONCTION;
	 		$post[]=$info->PERE;
	 		$post[]=$info->MERE;
	 		if($info->EST_VISITEUR==1)
	 		{
	 			$post[]='Oui';

	 		}else{
	 			$post[]='Non';
	 		}

	 		$post[]=$info->province;
	 		$post[]=$info->commune;
	 		$post[]=$info->zone;

	 		$data[]=$post;  
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