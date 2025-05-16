<?php
/**
* 
*/
class Liste_Enqueteurs extends CI_Controller
{
	

 public function index(){
	 
    $this->load->view('Liste_Enqueteurs_View');
 }




  	function listing()
	      {
		$query_principal='SELECT  enqueteurs.`NOM`, `PRENOM`,`TELEPHONE`,`EMAIL`,`DATE_NAISSANCE`,`DATE_INSERTION`, provinces.PROVINCE_NAME ,communes.COMMUNE_NAME,zones.ZONE_NAME ,collines.COLLINE_NAME, niveau_etude.DESCRIPTION, sexe.SEXE_DESCR FROM `enqueteurs` left join provinces on provinces.PROVINCE_ID=enqueteurs.PROVINCE_ID LEFT join communes on communes.COMMUNE_ID=enqueteurs.COMMUNE_ID LEFT join zones on zones.ZONE_ID=enqueteurs.ZONE_ID LEFT join collines on collines.COLLINE_ID=enqueteurs.COLLINE_ID LEFT JOIN niveau_etude ON niveau_etude.ID_NIVEAU_ETUDE= enqueteurs.ID_NIVEAU_ETUDE LEFT JOIN sexe ON sexe.ID_SEXE=enqueteurs.SEXE_ID where 1';
		

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';


		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}
		$order_by='';



		$order_column='';

		

		if (!empty($order_by)) {
			
			$order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY NOM   ASC';
		}


		$search = !empty($_POST['search']['value']) ?  (" AND (enqueteurs.`NOM` LIKE '%$var_search%' OR PRENOM LIKE '%$var_search%' OR `TELEPHONE` LIKE '%$var_search%'  OR EMAIL LIKE '%$var_search%' OR DATE_NAISSANCE LIKE '%$var_search%' OR DATE_INSERTION LIKE '%$var_search%'  OR provinces.PROVINCE_NAME LIKE '%$var_search%' OR communes.COMMUNE_NAME LIKE '%$var_search%' OR zones.ZONE_NAME LIKE '%$var_search%' OR collines.COLLINE_NAME LIKE '%$var_search%'OR niveau_etude.DESCRIPTION LIKE '%$var_search%'OR sexe.SEXE_DESCR LIKE '%$var_search%' )") :'';   

		$critaire = 'ORDER BY NOM';

  
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
		  $post[]=$info->NOM;
		  $post[]=$info->PRENOM;
		  $post[]=$info->TELEPHONE;
		  $post[]=$info->EMAIL;
		  $post[]=$info->PROVINCE_NAME;
		  $post[]=$info->COMMUNE_NAME;
		  $post[]=$info->ZONE_NAME;
		  $post[]=$info->COLLINE_NAME;
		  $post[]=$info->SEXE_DESCR;
		  $post[]=$info->DATE_NAISSANCE;
		  $post[]=$info->DESCRIPTION;
		  $post[]=$info->DATE_INSERTION;

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