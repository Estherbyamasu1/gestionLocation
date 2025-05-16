<?php

/**NTAHIMPERA M.L.K
**LISTE DES MENAGES-->MUKAZA
**/
class Menage extends CI_Controller
{

	function index()
	{
		$data['title']='Liste des Menages';
		$this->load->view('Liste_menage_view',$data);
	}

	function listing()
	{
		if ($this->session->userdata('MUKAZA_PROFIL_ID') == 10) {
			
			$query_principal='SELECT `MUKAZA_MENAGE_ID`,`NOMBRE_MEMBRE`,zo.ZONE_NAME as ZONE,qua.QUARTIER_DESC as QUARTIER,AVENUE ,`CODE_HABITATION`, `NUMERO_MENAGE`, `ENFANT_MOINS_18ANS`, `NBR_DECES_MOIS`, `NBR_NOUVEAU_NE_MOIS`, `PROPRIETAIRE`, `NBR_HOMME_PAR_PARCELLE`, `NBR_FEMME_PAR_PARCELLE`, `NBR_MENAGE_PAR_PARCELLE`, `MONTANT_PAYE_PAR_MOIS` FROM mukaza_menage mn LEFT JOIN syst_zones zo on mn.ZONE_ID=zo.ZONE_ID LEFT JOIN quartier qua on mn.QUARTIER_ID=qua.QUARTIER_ID LEFT JOIN enqueteurs ON enqueteurs.DEVICE_ID=mn.DEVICE_ID WHERE enqueteurs.USER_ID='.$this->session->userdata('MUKAZA_USER_ID');
		}else{

			$query_principal='SELECT `MUKAZA_MENAGE_ID`,`NOMBRE_MEMBRE`,zo.ZONE_NAME as ZONE,qua.QUARTIER_DESC as QUARTIER,AVENUE ,`CODE_HABITATION`, `NUMERO_MENAGE`, `ENFANT_MOINS_18ANS`, `NBR_DECES_MOIS`, `NBR_NOUVEAU_NE_MOIS`, `PROPRIETAIRE`, `NBR_HOMME_PAR_PARCELLE`, `NBR_FEMME_PAR_PARCELLE`, `NBR_MENAGE_PAR_PARCELLE`, `MONTANT_PAYE_PAR_MOIS` FROM mukaza_menage mn LEFT JOIN syst_zones zo on mn.ZONE_ID=zo.ZONE_ID LEFT JOIN quartier qua on mn.QUARTIER_ID=qua.QUARTIER_ID WHERE 1';
		}

		


		$var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
		$limit='LIMIT 0,10';
		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}
		$order_by='';
		$order_column='';

		if (!empty($order_by)) {
			
			$order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY PROPRIETAIRE ASC';
		}

		$search = !empty($_POST['search']['value']) ?  (" AND (zo.ZONE_NAME LIKE '%$var_search%' OR qua.QUARTIER_DESC LIKE '%$var_search%' OR NOMBRE_MEMBRE LIKE '%$var_search%' OR NUMERO_MENAGE LIKE '%$var_search%' OR PROPRIETAIRE LIKE '%$var_search%' OR MONTANT_PAYE_PAR_MOIS LIKE '%$var_search%' OR CODE_HABITATION LIKE '%$var_search%')") :''; 

		$critaire = '';
		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
		$query_filter = $query_principal.' '.$critaire.' '.$search;

		$menage = $this->Model->datatable($query_secondaire);
		$data = array();
		$u=1;
		foreach ($menage as $info) 
		{
			$post=array();

			$sqli="SELECT * FROM `membre_menage` WHERE MUKAZA_MENAGE_ID=".$info->MUKAZA_MENAGE_ID;

			$intrant=$this->Model->getRequete($sqli);
			$post[]=$u++;
			$post[]=$info->PROPRIETAIRE;
			$post[]=$info->ZONE;
			$post[]=$info->AVENUE;
			$post[]=$info->QUARTIER;
			$post[]=$info->NUMERO_MENAGE;
			$post[]="<center><a href='#' onclick='detail_menage(".$info->MUKAZA_MENAGE_ID.");' style='cursor:pointer;' class='btn btn-primary'>".sizeof($intrant)."</a></center>";

			$post[] = "<center><a href='#' onclick='detail(".$info->MUKAZA_MENAGE_ID.");' style='cursor:pointer;' class='btn btn-primary'>Détail</a></center>";
			$data[] = $post;

		}

		$output=array(
			"draw" => intval($_POST['draw']),
			"recordsTotal" =>$this->Model->all_data($query_principal),
			"recordsFiltered" => $this->Model->filtrer($query_filter),
			"data" => $data
		);

		echo json_encode($output);

	}

//-----------------------------Details Membre Menage------------------------//
	function get_detail_menage($id)
	{
		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
		$var_search=str_replace("'", "\'", $var_search);
		$query_principal='SELECT `MEMBRE_MENAGE_ID`, `NOM`, `PRENOM`, `AGE`, se.SEXE_DESCRIPTION as sexe, `NATIONALITE`,sys.PROVINCE_NAME,comm.COMMUNE_NAME, `PAYS_ID`,countries.CommonName,eta.DESCRIPTION as etat_civil, `EMAIL`, `TELEPHONE`, `MUKAZA_MENAGE_ID` FROM membre_menage mn LEFT JOIN sexe se on mn.SEXE_ID=se.SEXE_ID LEFT JOIN etat_civil eta on mn.ETAT_CIVIL_ID=eta.ETAT_CIVIL_ID LEFT JOIN syst_provinces sys on mn.PROVINCE_ID=sys.PROVINCE_ID LEFT JOIN syst_communes comm on mn.COMMUNE_ID=comm.COMMUNE_ID LEFT JOIN countries ON countries.COUNTRY_ID=mn.PAYS_ID WHERE 1';

		$group="";
		$critaire=" AND MUKAZA_MENAGE_ID=".$id;
		$limit='LIMIT 0,10';

		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}

		$order_by='';
		if($_POST['order']['0']['column']!=0){
			$order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY NOM ASC';
		}

		$search = !empty($_POST['search']['value']) ? (" AND (NOM LIKE '%$var_search%' or PRENOM LIKE '%$var_search%')") : '';

		$query_secondaire=$query_principal.'  '.$critaire.' '.$search.' '.$group.' '.$order_by.'   '.$limit;
		$query_filter=$query_principal.'  '.$critaire.' '.$search.' '.$group;
		$fetch_data = $this->Model->datatable($query_secondaire);
		$u=0;
		$data = array();
		$origine='';
		foreach ($fetch_data as $row){
			$u++;

			if ($row->NATIONALITE == 1) {
				$origine=$row->PROVINCE_NAME.' - '.$row->COMMUNE_NAME;
			}elseif ($row->NATIONALITE == 2) {
				$origine=$row->CommonName;
			}
			$sub_array = array();
			$sub_array[]=$row->NOM." ".$row->PRENOM;
			$sub_array[]=$row->AGE." ans";
			$sub_array[]=$row->sexe;
			$sub_array[]=$origine;
			$sub_array[]=$row->etat_civil;
			$sub_array[]=$row->EMAIL;
			$data[] = $sub_array;	
		}

		$output=array(
			"draw" => intval($_POST['draw']),
			"recordsTotal" =>$this->Model->all_data($query_principal.' '.$group),
			"recordsFiltered" => $this->Model->filtrer($query_filter),
			"data" => $data
		);
		echo json_encode($output);

	}
//Function des details---------------------------///

	function get_Detail($id)
	{
		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
		$var_search=str_replace("'", "\'", $var_search);

		$query_principal='SELECT `MUKAZA_MENAGE_ID`,`NOMBRE_MEMBRE`,`CODE_HABITATION`, `NUMERO_MENAGE`, `ENFANT_MOINS_18ANS`, `NBR_DECES_MOIS`, `NBR_NOUVEAU_NE_MOIS`,`NBR_HOMME_PAR_PARCELLE`, `NBR_FEMME_PAR_PARCELLE`, `NBR_MENAGE_PAR_PARCELLE`, `MONTANT_PAYE_PAR_MOIS` FROM `mukaza_menage`WHERE 1';
		$group="";
		$critaire="";
		$limit='LIMIT 0,10';

		if($_POST['length'] != -1){
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}
		$order_by='';
		if($_POST['order']['0']['column']!=0){
			$order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY intr_intrant.DESCRIPTION ASC';
		}

		$search = !empty($_POST['search']['value']) ? (" AND (NOMBRE_MEMBRE LIKE '%$var_search%' OR CODE_HABITATION LIKE '%$var_search%' OR NUMERO_MENAGE LIKE '%$var_search%' OR ENFANT_MOINS_18ANS LIKE '%$var_search%' OR NBR_DECES_MOIS LIKE '%$var_search%' OR NBR_NOUVEAU_NE_MOIS LIKE '%$var_search%' OR NBR_HOMME_PAR_PARCELLE  LIKE '%$var_search%' OR NBR_FEMME_PAR_PARCELLE  LIKE '%$var_search%' OR MONTANT_PAYE_PAR_MOIS  LIKE '%$var_search%')") : '';


		$query_secondaire=$query_principal.'  '.$critaire.' '.$search.' '.$group.' '.$order_by.'   '.$limit;
		$query_filter=$query_principal.'  '.$critaire.' '.$search.' '.$group;

		$fetch_data = $this->Model->datatable($query_secondaire);
		$u=0;
		$data = array();
		foreach ($fetch_data as $row)
		{
			$u++;
			$array=array();
			$array[]=$row->CODE_HABITATION;
			$array[]=$row->ENFANT_MOINS_18ANS;
			$array[]=$row->NBR_DECES_MOIS;
			$array[]=$row->NBR_NOUVEAU_NE_MOIS;
			$array[]=$row->NBR_HOMME_PAR_PARCELLE;
			$array[]=$row->NBR_FEMME_PAR_PARCELLE;
			$array[]=$row->NBR_MENAGE_PAR_PARCELLE;
			$array[]=$row->MONTANT_PAYE_PAR_MOIS;
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