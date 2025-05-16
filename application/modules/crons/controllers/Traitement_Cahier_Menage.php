<?php 
/**
 * 
 */
class Traitement_Cahier_Menage extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$flux = file_get_contents('php://input');
        $array_data = array('DATA_JSON'=>$flux);
        $this->Model->insert_last_id('json_cahier_menage',$array_data);
	}

	function traiter()
	{
		$menages=$this->Model->getList('json_cahier_menage',array('TRAITER'=>0));

		foreach ($menages as $key) 
		{
			$DATA_DATA=str_replace('/',"_",$key['DATA_JSON']);
			$JSON=json_decode($DATA_DATA);

			// echo "<pre>";
			// print_r($JSON);die();

			$menages=NULL;
			if (isset($JSON->identification)) 
			{
				$menages=$JSON->identification;

				foreach ($menages as $DATA_JSON) {
					
					$CODE_MENAGE=NULL;
					if (isset($DATA_JSON->identification_code)) 
					{
						$CODE_MENAGE=$DATA_JSON->identification_code;
					}

					$NOM=NULL;
					if (isset($DATA_JSON->identification_nom)) 
					{
						$NOM=$DATA_JSON->identification_nom;
					}

					$PRENOM=NULL;
					if (isset($DATA_JSON->identification_prenom)) 
					{
						$PRENOM=$DATA_JSON->identification_prenom;
					}

					$CNI=NULL;
					if (isset($DATA_JSON->identification_cni)) 
					{
						$CNI=$DATA_JSON->identification_cni;
					}

					$LIEU_DELIVRANCE=NULL;
					if (isset($DATA_JSON->identification_lieu_delivrance)) 
					{
						$LIEU_DELIVRANCE=$DATA_JSON->identification_lieu_delivrance;
					}

					$DATE_DELIVRANCE=NULL;
					if (isset($DATA_JSON->identification_date_delivrance)) 
					{
						$DATE_DELIVRANCE=$DATA_JSON->identification_date_delivrance;
					}

					// $RESIDENCE=NULL;
					// if (isset($DATA_JSON->identification_date_delivrance)) 
					// {
					// 	$RESIDENCE=$DATA_JSON->identification_date_delivrance;
					// }

					$RUE=NULL;
					if (isset($DATA_JSON->identification_rue)) 
					{
						$RUE=$DATA_JSON->identification_rue;
					}

					$ZONE_ID=NULL;
					if (isset($DATA_JSON->identification_zone)) 
					{
						$ZONE_ID=$DATA_JSON->identification_zone;
					}

					$COMMUNE_ID=NULL;
					if (isset($DATA_JSON->identification_commune)) 
					{
						$COMMUNE_ID=$DATA_JSON->identification_commune;
					}

					$PROVINCE_ID=NULL;
					if (isset($DATA_JSON->identification_province)) 
					{
						$PROVINCE_ID=$DATA_JSON->identification_province;
					}

					$LIEU_NAISSANCE=NULL;
					if (isset($DATA_JSON->identification_lieu_naissance)) 
					{
						$LIEU_NAISSANCE=$DATA_JSON->identification_lieu_naissance;
					}

					$DATE_NAISSANCE=NULL;
					if (isset($DATA_JSON->identification_date_naissance)) 
					{
						$DATE_NAISSANCE=$DATA_JSON->identification_date_naissance;
					}

					$PERE=NULL;
					if (isset($DATA_JSON->identification_pere)) 
					{
						$PERE=$DATA_JSON->identification_pere;
					}

					$MERE=NULL;
					if (isset($DATA_JSON->identification_mere)) 
					{
						$MERE=$DATA_JSON->identification_mere;
					}

					$FONCTION=NULL;
					if (isset($DATA_JSON->identification_fonction)) 
					{
						$FONCTION=$DATA_JSON->identification_fonction;
					}

					$TEL=NULL;
					if (isset($DATA_JSON->identification_tel)) 
					{
						$TEL=$DATA_JSON->identification_tel;
					}

					$RELATION_PROPRIETAIRE=NULL;
					if (isset($DATA_JSON->identification_relation_proprietaire)) 
					{
						$RELATION_PROPRIETAIRE=$DATA_JSON->identification_relation_proprietaire;
					}

					$EST_VISITEUR=NULL;
					if (isset($DATA_JSON->identification_visiteur)) 
					{
						$EST_VISITEUR=$DATA_JSON->identification_visiteur;
					}

					$DATE_DEPART=NULL;
					if (isset($DATA_JSON->identification_date_depart)) 
					{
						$DATE_DEPART=$DATA_JSON->identification_date_depart;
					}
					if (isset($DATA_JSON->identification_geopoint)) 
					{
						$geopoint=explode(" ",$DATA_JSON->identification_geopoint);
						$LATITUDE=$geopoint[0];
						$LONGITUDE=$geopoint[1];
					}
					

					$DEVICE_ID=NULL;
					if (isset($DATA_JSON->deviceid)) 
					{
						$devideId=explode(":",$DATA_JSON->deviceid);
						$DEVICE_ID=$devideId[1];
						
					}

					//RESIDENCE,,,LONGITUDE
					$array_data=array('CODE_MENAGE'=>$CODE_MENAGE,'NOM'=>$NOM,'PRENOM'=>$PRENOM,'CNI'=>$CNI,'LIEU_DELIVRANCE'=>$LIEU_DELIVRANCE,'DATE_DELIVRANCE'=>$DATE_DELIVRANCE,'RUE'=>$RUE,'ZONE_ID'=>$ZONE_ID,'COMMUNE_ID'=>$COMMUNE_ID,'PROVINCE_ID'=>$PROVINCE_ID,'LIEU_NAISSANCE'=>$LIEU_NAISSANCE,'DATE_NAISSANCE'=>$DATE_NAISSANCE,'PERE'=>$PERE,'MERE'=>$MERE,'FONCTION'=>$FONCTION,'TEL'=>$TEL,'RELATION_PROPRIETAIRE'=>$RELATION_PROPRIETAIRE,'EST_VISITEUR'=>$EST_VISITEUR,'DATE_DEPART'=>$DATE_DEPART,'ID_JSON'=>$key['ID_JSON'],'LATITUDE'=>$LATITUDE,'LONGITUDE'=>$LONGITUDE,'DEVICE_ID'=>$DEVICE_ID);

					
					$this->Model->create('cahier_menages',$array_data);

				}
			}

			

			$this->Model->update('json_cahier_menage',array('ID_JSON'=>$key['ID_JSON']),array('TRAITER'=>1));

		}

	}

	
}

 ?>