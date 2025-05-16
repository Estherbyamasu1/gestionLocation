<?php
/**
* 
*/
class Enqueteurs extends CI_Controller
{
	

 public function index(){
	 
    $this->load->view('Enqueteurs_View');
 }




  	function listing()
	{
		 	$query_principal='SELECT enqueteurs.`NOM`, `PRENOM`,`TELEPHONE`,`EMAIL`,`DATE_NAISSANCE`, syst_provinces.PROVINCE_NAME ,syst_communes.COMMUNE_NAME,syst_zones.ZONE_NAME ,collines.COLLINE_NAME, niveau_education.DESCRIPTION, sexe.SEXE_DESCRIPTION,etat_civil.DESCRIPTION as CIVIL_DESCRIPTION FROM enqueteurs left join syst_provinces on syst_provinces.PROVINCE_ID=enqueteurs.PROVINCE_ID LEFT join syst_communes on syst_communes.COMMUNE_ID=enqueteurs.COMMUNE_ID LEFT join syst_zones on syst_zones.ZONE_ID=enqueteurs.ZONE_ID LEFT join collines on collines.COLLINE_ID=enqueteurs.COLLINE_ID LEFT JOIN niveau_education ON niveau_education.EDUCATION_ID = enqueteurs.EDUCATION_ID  LEFT JOIN sexe ON sexe.SEXE_ID=enqueteurs.SEXE_ID LEFT JOIN etat_civil ON etat_civil.ETAT_CIVIL_ID=enqueteurs.ETAT_CIVIL_ID where 1  ';
	
		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';

		$draw = isset($_POST['draw']);
		$start = isset($postData['start']);
		if(isset($_POST["length"]) && $_POST["length"] != -1)
		{
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}
		$order_by='';

		$order_column=array('NOM','PRENOM');

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY NOM  ASC';

		$search = !empty($_POST['search']['value']) ? (" AND NOM LIKE '%$var_search%' OR PRENOM LIKE '%$var_search%'OR TELEPHONE LIKE '%$var_search%'OR EMAIL LIKE '%$var_search%'OR DATE_NAISSANCE LIKE '%$var_search%' OR syst_provinces.PROVINCE_NAME LIKE '%$var_search%'OR syst_communes.COMMUNE_NAME LIKE '%$var_search%'OR collines.COLLINE_NAME LIKE '%$var_search%' OR niveau_education.DESCRIPTION LIKE '%$var_search%'OR sexe.SEXE_DESCRIPTION LIKE '%$var_search%'OR CIVIL_DESCRIPTION LIKE '%$var_search%' ") : '';   

		$critaire = '';

		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;

		$query_filter = $query_principal.' '.$critaire.' '.$search;

		$abonne='';

		$fetch_cov_frais = $this->Model->datatable($query_secondaire);
		$data = array();

		$u=1;
	   foreach($fetch_cov_frais as $info)
		{
			$DATE=new DateTime($info->DATE_NAISSANCE);
		  $post=array();
			$post[]=$u++; 
		  $post[]=$info->NOM;
		  $post[]=$info->PRENOM;
		  $post[]=$info->TELEPHONE;
		  $post[]=$info->EMAIL;
		  $post[]=$info->PROVINCE_NAME;
		  $post[]=$info->COMMUNE_NAME;
		  $post[]=$info->ZONE_NAME;
		  $post[]=$info->COLLINE_NAME;
		  $post[]=$info->SEXE_DESCRIPTION;
		  $post[]=$DATE->format('d-m-Y');
		  $post[]=$info->DESCRIPTION;
		  $post[]=$info->CIVIL_DESCRIPTION;
		  

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