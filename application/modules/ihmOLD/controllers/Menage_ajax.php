<?php
/**
* 
*/
class Menage_ajax extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()     
	{ 
		
	
		
		$this->load->view('Menage_ajax_view');   
	}

  

	function listing()
	{
		$query_principal='SELECT menages.ID_MENAGE,provinces.PROVINCE_NAME ,
communes.COMMUNE_NAME,zones.ZONE_NAME,collines.COLLINE_NAME,menages.NUMERO_SEQUENTIEL_MENAGE,
menages.NUMERO_VAGUE,menages.NOM_REPONDANT,menages.PRENOM_REPONDANT,lien_avec_chef_menage.DESCRIPTION
,menages.DATE_ENTRETIEN,if(menages.TRAVAIL_CHEF_MENAGE=1,"Oui","Non") as TRAVAIL_CHEF_MENAGE, activites_fait_par_chef_menage.ACTIVITE_DESCR,
 if(menages.EMPLOI_CHEF_MENAGE=1,"Oui","Non") as EMPLOI_CHEF_MENAGE,menages.MOTIF,menages.NBRE_MEMBRES_MENAGES,type_logement.TYPE_LOGEMENT_DESCR,
 menages.AUTRE_LOGEMENT,menages.NBRE_PIECES_LOGEMENT,source_eclairage.SOURCE_ECLAIRAGE,menages.AUTRE_SOURCE_ECLAIRAGE,
source_energie.SOURCE_ENERGIE,menages.AUTRE_SOURCE_ENERGIE,materiaux_murs.MATERIEL_MUR_DESCR,menages.AUTRE_MATERIEL_MUR,
materiaux_toits.MATERIEL_TOIT_DESCR,menages.AUTRE_MATERIEL_TOIT,materiaux_sol.MATERIEL_SOL_DESCR,menages.AUTRE_MATERIEL_SOL,
type_lieu_d_aisance.LIEU_DESCR,menages.AUTRE_TYPE_LIEU_D_AISANCE,IF(menages.HAVE_TV=1,"Oui","Non") as HAVE_TV,if(menages.HAVE_RADIO=1,"Oui","Non") as HAVE_RADIO,if(menages.HAVE_FER_A_REPASSER=1,"Oui","Non") as HAVE_FER_A_REPASSER,
if(menages.HAVE_GROUPE_ELECTROGENE=1,"Oui","Non") as HAVE_GROUPE_ELECTROGENE,if(menages.HAVE_MOTO=1,"Oui","Non") as HAVE_MOTO,if(menages.HAVE_VOITURE=1,"Oui","Non") as HAVE_VOITURE, if(menages.HAVE_PARIE_D_ANES=1,"Oui","Non") as HAVE_PARIE_D_ANES,menages.CNI_MERE,menages.CNI_PERE,
menages.EXTRAIT_MERE,menages.EXTRAIT_PERE,menages.ID_JSON,menages.DEVICEID,menages.DATE_INSERTION

FROM `menages` 

left JOIN provinces ON provinces.PROVINCE_ID=menages.ID_PROVINCE
left JOIN communes ON communes.COMMUNE_ID=menages.ID_COMMUNE
left JOIN zones ON zones.ZONE_ID=menages.ID_ZONE
left JOIN collines ON collines.COLLINE_ID=menages.ID_COLLINE
left JOIN lien_avec_chef_menage on lien_avec_chef_menage.ID_LIEN_AVEC_CHEF_MENAGE=menages.ID_LIEN_AVEC_CHEF_MENAGE
left JOIN activites_fait_par_chef_menage on activites_fait_par_chef_menage.ID_ACTIVITE=menages.ID_ACTIVITE
left JOIN type_logement ON type_logement.ID_TYPE_LOGEMENT=menages.ID_TYPE_LOGEMENT
left JOIN source_eclairage on source_eclairage.ID_SOURCE_ECLAIRAGE=menages.ID_SOURCE_ECLAIRAGE
left join source_energie on source_energie.ID_SOURCE_ENERGIE=menages.ID_SOURCE_ENERGIE
left join materiaux_murs ON materiaux_murs.ID_MATERIEL_MUR=menages.ID_MATERIEL_MUR
LEFT JOIN materiaux_toits ON materiaux_toits.ID_MATERIEL_TOIT=menages.ID_MATERIEL_TOIT
LEFT JOIN materiaux_sol ON materiaux_sol.ID_MATERIEL_SOL=menages.ID_MATERIEL_SOL
LEFT JOIN type_lieu_d_aisance ON type_lieu_d_aisance.ID_TYPE_LIEU_D_AISANCE=menages.ID_TYPE_LIEU_D_AISANCE
WHERE 1



';

		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';


		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}
		$order_by='';



		$order_column='';

		

		if (!empty($order_by)) {
			
			$order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY NOM   DESC';
		}


		$search = !empty($_POST['search']['value']) ?  (" AND (provinces.PROVINCE_NAME LIKE '%$var_search%' OR communes.COMMUNE_NAME LIKE '%$var_search%' OR zones.ZONE_NAME LIKE '%$var_search%' OR collines.COLLINE_NAME LIKE '%$var_search%' OR menages.NOM_REPONDANT LIKE '%$var_search%' OR menages.PRENOM_REPONDANT LIKE '%$var_search%' OR lien_avec_chef_menage.DESCRIPTION LIKE '%$var_search%' OR type_logement.TYPE_LOGEMENT_DESCR LIKE '%$var_search%')") :'';   

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


$sqli="SELECT * FROM membres_menage WHERE ID_MENAGE=".$info->ID_MENAGE ;


    $intrants=$this->Model->getRequete($sqli);
        ///requete

         
        //nombre

			$post[]=$u++; 
			$post[]=$info->PROVINCE_NAME."<br>".$info->COMMUNE_NAME."<br>".$info->ZONE_NAME."<br>".$info->COLLINE_NAME;
			$post[]=$info->NUMERO_SEQUENTIEL_MENAGE;
			$post[]=$info->NUMERO_VAGUE;
			$post[]=$info->NOM_REPONDANT." ".$info->PRENOM_REPONDANT;
			$post[]=$info->DESCRIPTION;
			$post[]=$info->DATE_ENTRETIEN;
			$post[] = "<center><a href='#' onclick='detail_intra(".$info->ID_MENAGE.");' style='cursor:pointer;' class='btn btn-primary'>".sizeof($intrants)."</a></center>";
			$logement=$info->TYPE_LOGEMENT_DESCR;
			if (empty($info->TYPE_LOGEMENT_DESCR)) {
				$logement=$info->AUTRE_LOGEMENT;
			}
			$post[]=$logement;
			$post[]=$info->NBRE_PIECES_LOGEMENT;
			 $post[] = "<center><a href='#' onclick='detail(".$info->ID_MENAGE.");' style='cursor:pointer;' class='btn btn-primary'>Détail</a></center>";
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

//==========================pour Details_membre_menage//==========================
	

      function get_Detail_intrant($id)
   {


    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $var_search=str_replace("'", "\'", $var_search);  
    $query_principal='SELECT NOM, PRENOM, IF(membres_menage.MEMBRE_TRAVAILLANT_DANS_UNE_EXPLOITATION_AGRICOLE=1,"Oui","Non") as MEMBRE_TRAVAILLANT_DANS_UNE_EXPLOITATION_AGRICOLE FROM membres_menage WHERE 1';

    $group="";
    $critaire=" AND ID_MENAGE=".$id;

    $limit='LIMIT 0,10';
    if($_POST['length'] != -1){
      $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
    }
    $order_by='';
    if($_POST['order']['0']['column']!=0){
      $order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY intr_intrant.DESCRIPTION ASC';
    }

    $search = !empty($_POST['search']['value']) ? (" AND (PRENOM LIKE '%$var_search%' or NOM LIKE '%$var_search%')") : '';



    $query_secondaire=$query_principal.'  '.$critaire.' '.$search.' '.$group.' '.$order_by.'   '.$limit;
    $query_filter=$query_principal.'  '.$critaire.' '.$search.' '.$group;

    $fetch_data = $this->Model->datatable($query_secondaire);
    $u=0;
    $data = array();

    foreach ($fetch_data as $row) {


      $u++;
      $sub_array = array();
      $sub_array[]=$row->NOM."  ".$row->PRENOM;
      $sub_array[]=$row->MEMBRE_TRAVAILLANT_DANS_UNE_EXPLOITATION_AGRICOLE;
      
      
      $data[] = $sub_array;

    }
    $output = array(
      "draw" => intval($_POST['draw']),
      "recordsTotal" =>$this->Model->all_data($query_principal.' '.$group),
      "recordsFiltered" => $this->Model->filtrer($query_filter),
      "data" => $data
    );
    echo json_encode($output);

  }
  //fonction list
//==============================detail=============================================
  function get_Detail($id)
   {


    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $var_search=str_replace("'", "\'", $var_search);  
    $query_principal='SELECT if(menages.TRAVAIL_CHEF_MENAGE=1,"Oui","Non") as TRAVAIL_CHEF_MENAGE, activites_fait_par_chef_menage.ACTIVITE_DESCR,
 if(menages.EMPLOI_CHEF_MENAGE=1,"Oui","Non") as EMPLOI_CHEF_MENAGE,menages.MOTIF,source_eclairage.SOURCE_ECLAIRAGE,menages.AUTRE_SOURCE_ECLAIRAGE,
source_energie.SOURCE_ENERGIE,menages.AUTRE_SOURCE_ENERGIE,materiaux_murs.MATERIEL_MUR_DESCR,menages.AUTRE_MATERIEL_MUR,
materiaux_toits.MATERIEL_TOIT_DESCR,menages.AUTRE_MATERIEL_TOIT,materiaux_sol.MATERIEL_SOL_DESCR,menages.AUTRE_MATERIEL_SOL,
type_lieu_d_aisance.LIEU_DESCR,menages.AUTRE_TYPE_LIEU_D_AISANCE,IF(menages.HAVE_TV=1,"Oui","Non") as HAVE_TV,if(menages.HAVE_RADIO=1,"Oui","Non") as HAVE_RADIO,if(menages.HAVE_FER_A_REPASSER=1,"Oui","Non") as HAVE_FER_A_REPASSER,
if(menages.HAVE_GROUPE_ELECTROGENE=1,"Oui","Non") as HAVE_GROUPE_ELECTROGENE,if(menages.HAVE_MOTO=1,"Oui","Non") as HAVE_MOTO,if(menages.HAVE_VOITURE=1,"Oui","Non") as HAVE_VOITURE, if(menages.HAVE_PARIE_D_ANES=1,"Oui","Non") as HAVE_PARIE_D_ANES,menages.CNI_MERE,menages.CNI_PERE,
menages.EXTRAIT_MERE,menages.EXTRAIT_PERE,menages.ID_JSON,menages.DEVICEID,menages.DATE_INSERTION

FROM `menages` 

left JOIN lien_avec_chef_menage on lien_avec_chef_menage.ID_LIEN_AVEC_CHEF_MENAGE=menages.ID_LIEN_AVEC_CHEF_MENAGE
left JOIN activites_fait_par_chef_menage on activites_fait_par_chef_menage.ID_ACTIVITE=menages.ID_ACTIVITE
left JOIN source_eclairage on source_eclairage.ID_SOURCE_ECLAIRAGE=menages.ID_SOURCE_ECLAIRAGE
left join source_energie on source_energie.ID_SOURCE_ENERGIE=menages.ID_SOURCE_ENERGIE
left join materiaux_murs ON materiaux_murs.ID_MATERIEL_MUR=menages.ID_MATERIEL_MUR
LEFT JOIN materiaux_toits ON materiaux_toits.ID_MATERIEL_TOIT=menages.ID_MATERIEL_TOIT
LEFT JOIN materiaux_sol ON materiaux_sol.ID_MATERIEL_SOL=menages.ID_MATERIEL_SOL
LEFT JOIN type_lieu_d_aisance ON type_lieu_d_aisance.ID_TYPE_LIEU_D_AISANCE=menages.ID_TYPE_LIEU_D_AISANCE
WHERE 1';

    $group="";
    $critaire=" AND ID_MENAGE=".$id;

    $limit='LIMIT 0,10';
    if($_POST['length'] != -1){
      $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
    }
    $order_by='';
    if($_POST['order']['0']['column']!=0){
      $order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY intr_intrant.DESCRIPTION ASC';
    }

   
     $search = !empty($_POST['search']['value']) ? (" AND (TRAVAIL_CHEF_MENAGE LIKE '%$var_search%' or source_eclairage.SOURCE_ECLAIRAGE LIKE '%$var_search%' or source_energie.SOURCE_ENERGIE LIKE '%$var_search%' or materiaux_murs.MATERIEL_MUR_DESCR LIKE '%$var_search%' or materiaux_toits.MATERIEL_TOIT_DESCR LIKE '%$var_search%' or materiaux_sol.MATERIEL_SOL_DESCR LIKE '%$var_search%' or type_lieu_d_aisance.LIEU_DESCR  LIKE '%$var_search%' or menages.AUTRE_TYPE_LIEU_D_AISANCE  LIKE '%$var_search%')") : '';


    $query_secondaire=$query_principal.'  '.$critaire.' '.$search.' '.$group.' '.$order_by.'   '.$limit;
    $query_filter=$query_principal.'  '.$critaire.' '.$search.' '.$group;

    $fetch_data = $this->Model->datatable($query_secondaire);
    $u=0;
    $data = array();

    foreach ($fetch_data as $row) {


      $u++;
      $array=array();
      
      		$array[]=$row->TRAVAIL_CHEF_MENAGE;
      		$array[]=$row->ACTIVITE_DESCR;
			
			$array[]=$row->EMPLOI_CHEF_MENAGE;
			$array[]=$row->MOTIF;
      		$eclairage=$row->SOURCE_ECLAIRAGE;
			if (empty($row->SOURCE_ECLAIRAGE)) {
				$eclairage=$row->AUTRE_SOURCE_ECLAIRAGE;
			}
			$array[]=$eclairage;
			$energie=$row->SOURCE_ENERGIE;
			if (empty($row->SOURCE_ENERGIE)) {
				$energie=$row->AUTRE_SOURCE_ENERGIE;
			}
			$array[]=$energie;
			$mur=$row->MATERIEL_MUR_DESCR;
			if (empty($row->MATERIEL_MUR_DESCR)) {
				$mur=$row->AUTRE_MATERIEL_MUR;
			}
			$array[]=$mur;

			$toit=$row->MATERIEL_TOIT_DESCR;
			if (empty($row->MATERIEL_TOIT_DESCR)) {
				$toit=$row->AUTRE_MATERIEL_TOIT;
				
			}
			$array[]=$toit;
			$sol=$row->MATERIEL_SOL_DESCR;
			if (empty($row->MATERIEL_SOL_DESCR)) {
				$sol=$row->AUTRE_MATERIEL_SOL;
			}
			$array[]=$sol;
			$latrines=$row->LIEU_DESCR;
			if (empty($row->LIEU_DESCR)) {
				$latrines=$row->AUTRE_TYPE_LIEU_D_AISANCE;
			}
			$array[]=$latrines;
			$array[]=$row->HAVE_TV;
			$array[]=$row->HAVE_RADIO;
			$array[]=$row->HAVE_FER_A_REPASSER;
			$array[]=$row->HAVE_GROUPE_ELECTROGENE;
			$array[]=$row->HAVE_MOTO;
			$array[]=$row->HAVE_VOITURE;
			$array[]=$row->HAVE_PARIE_D_ANES;
			$array[]=$row->CNI_MERE;
			$array[]=$row->CNI_PERE;
			$array[]=$row->EXTRAIT_MERE;
			$array[]=$row->EXTRAIT_PERE;
			$array[]=$row->DATE_INSERTION;
      
      $data[] = $array;

    }
    $output = array(
      "draw" => intval($_POST['draw']),
      "recordsTotal" =>$this->Model->all_data($query_principal.' '.$group),
      "recordsFiltered" => $this->Model->filtrer($query_filter),
      "data" => $data
    );
    echo json_encode($output);

  }
}
?>

















































