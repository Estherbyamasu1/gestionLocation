<?php 
/**
 * christa
 */
class Traitement_menages_mukaza extends CI_Controller
{
	
	function __construct()
	{
		// code...
		parent::__construct();
	}

	function index($value='')
	{
		$flux = file_get_contents('php://input');
        $array_test = array('DATA_JSON'=>$flux);
        $this->Model->insert_last_id('json_menage',$array_test);
	}

	function traiter($value='')
	{
		$MENAGES=$this->Model->getList('json_menage',array('TRAITER'=>0));

		foreach ($MENAGES as $key) 
		{
			# code...
			$DATA_DATA=str_replace('/',"_",$key['DATA_JSON']);
			$DATA_JSON=json_decode($DATA_DATA);

			// echo "<pre>";
			// print_r($DATA_JSON);die();

			$ZONE_ID=NULL;
			if (isset($DATA_JSON->identification_zone)) {
				$ZONE_ID=$DATA_JSON->identification_zone;
			}
			$QUARTIER_ID=NULL;
			if (isset($DATA_JSON->identification_quartier)) {
				$QUARTIER_ID=$DATA_JSON->identification_quartier;
			}

			$CODE_HABITATION=NULL;
			if (isset($DATA_JSON->identification_numero_habitation)) {
				$CODE_HABITATION=$DATA_JSON->identification_numero_habitation;
			}
			$NUMERO_MENAGE=NULL;
			if (isset($DATA_JSON->identification_numero_menage)) {
				$NUMERO_MENAGE=$DATA_JSON->identification_numero_menage;
			}
			$AVENUE=NULL;
			if (isset($DATA_JSON->identification_avenue)) {
				$AVENUE=$DATA_JSON->identification_avenue;
			}
			$NOMBRE_MEMBRE=NULL;
			if (isset($DATA_JSON->identification_nombre_membres)) {
				$NOMBRE_MEMBRE=$DATA_JSON->identification_nombre_membres;
			}
			$ENFANT_MOINS_18ANS=NULL;
			if (isset($DATA_JSON->identification_nombre_enfants)) {
				$ENFANT_MOINS_18ANS=$DATA_JSON->identification_nombre_enfants;
			}
			$NBR_DECES_MOIS=NULL;
			if (isset($DATA_JSON->identification_nombre_deces)) {
				$NBR_DECES_MOIS=$DATA_JSON->identification_nombre_deces;
			}
			$NBR_NOUVEAU_NE_MOIS=NULL;
			if (isset($DATA_JSON->identification_nouveau_ne)) {
				$NBR_NOUVEAU_NE_MOIS=$DATA_JSON->identification_nouveau_ne;
			}
			$PROPRIETAIRE=NULL;
			if (isset($DATA_JSON->identification_proprietaire)) {
				$PROPRIETAIRE=$DATA_JSON->identification_proprietaire;
			}
			$NBR_HOMME_PAR_PARCELLE=NULL;
			if (isset($DATA_JSON->identification_nombre_hommes)) {
				$NBR_HOMME_PAR_PARCELLE=$DATA_JSON->identification_nombre_hommes;
			}
			$NBR_FEMME_PAR_PARCELLE=NULL;
			if (isset($DATA_JSON->identification_nombre_femmes)) {
				$NBR_FEMME_PAR_PARCELLE=$DATA_JSON->identification_nombre_femmes;
			}
			$NBR_MENAGE_PAR_PARCELLE=NULL;
			if (isset($DATA_JSON->identification_nombre_menage)) {
				$NBR_MENAGE_PAR_PARCELLE=$DATA_JSON->identification_nombre_menage;
			}
			$MONTANT_PAYE_PAR_MOIS=NULL;
			if (isset($DATA_JSON->identification_montant_locataires)) {
				$MONTANT_PAYE_PAR_MOIS=$DATA_JSON->identification_montant_locataires;
			}
			$DEVICE_ID=NULL;
			if (isset($DATA_JSON->deviceid)) 
			{
				$devideId=explode(":",$DATA_JSON->deviceid);
				$DEVICE_ID=$devideId[1];
			}

			$LATITUDE=NULL;
			$LONGITUDE=NULL;
			if (isset($DATA_JSON->geolocalisation)) 
			{
				$geopoint=explode(" ",$DATA_JSON->geolocalisation);
				$LATITUDE=$geopoint[0];
				$LONGITUDE=$geopoint[1];
			}

			$array_menage=array('ZONE_ID'=>$ZONE_ID,'QUARTIER_ID'=>$QUARTIER_ID,'AVENUE'=>$AVENUE,'CODE_HABITATION'=>$CODE_HABITATION,'NUMERO_MENAGE'=>$NUMERO_MENAGE,'NOMBRE_MEMBRE'=>$NOMBRE_MEMBRE,'ENFANT_MOINS_18ANS'=>$ENFANT_MOINS_18ANS,'NBR_DECES_MOIS'=>$NBR_DECES_MOIS,'NBR_NOUVEAU_NE_MOIS'=>$NBR_NOUVEAU_NE_MOIS,'PROPRIETAIRE'=>$PROPRIETAIRE,'NBR_HOMME_PAR_PARCELLE'=>$NBR_HOMME_PAR_PARCELLE,'NBR_FEMME_PAR_PARCELLE'=>$NBR_FEMME_PAR_PARCELLE,'NBR_MENAGE_PAR_PARCELLE'=>$NBR_MENAGE_PAR_PARCELLE,'MONTANT_PAYE_PAR_MOIS'=>$MONTANT_PAYE_PAR_MOIS,'DEVICE_ID'=>$DEVICE_ID,'LATITUDE'=>$LATITUDE,'LONGITUDE'=>$LONGITUDE,'ID_JSON'=>$key['ID_JSON']);

			$ID_MENAGE=$this->Model->insert_last_id('mukaza_menage',$array_menage);

			//traitement repeat
			$MEMBRES=array();
			if (isset($DATA_JSON->nom_membre)) {
				$MEMBRES=$DATA_JSON->nom_membre;

				foreach ($MEMBRES as $value) {
					
					$NOM=NULL;
					if (isset($value->nom_membre_nom)) {
						$NOM=$value->nom_membre_nom;
					}
					$PRENOM=NULL;
					if (isset($value->nom_membre_prenom)) {
						$PRENOM=$value->nom_membre_prenom;
					}

					$AGE=NULL;
					if (isset($value->nom_membre_age)) {
						$AGE=$value->nom_membre_age;
					}
					$SEXE_ID=NULL;
					if (isset($value->nom_membre_sexe)) {
						$SEXE_ID=$value->nom_membre_sexe;
					}
					$NATIONALITE=NULL;
					if (isset($value->nom_membre_nationalite)) {
						$NATIONALITE=$value->nom_membre_nationalite;
					}
					$PROVINCE_ID=NULL;
					if (isset($value->nom_membre_province)) {
						$PROVINCE_ID=$value->nom_membre_province;
					}
					$COMMUNE_ID=NULL;
					if (isset($value->nom_membre_commune)) {
						$COMMUNE_ID=$value->nom_membre_commune;
					}
					$PAYS_ID=NULL;
					if (isset($value->nom_membre_pays)) {
						$PAYS_ID=$value->nom_membre_pays;
					}

					$ETAT_CIVIL_ID=NULL;
					if (isset($value->nom_membre_statut)) {
						$ETAT_CIVIL_ID=$value->nom_membre_statut;
					}
					$EMAIL=NULL;
					if (isset($value->nom_membre_email)) {
						$EMAIL=$value->nom_membre_email;
					}
					$TELEPHONE=NULL;
					if (isset($value->nom_membre_telephone)) {
						$TELEPHONE=$value->nom_membre_telephone;
					}

					$array_membres=array('NOM'=>$NOM,'PRENOM'=>$PRENOM,'AGE'=>$AGE,'SEXE_ID'=>$SEXE_ID,'NATIONALITE'=>$NATIONALITE,'PROVINCE_ID'=>$PROVINCE_ID,'COMMUNE_ID'=>$COMMUNE_ID,'PAYS_ID'=>$PAYS_ID,'ETAT_CIVIL_ID'=>$ETAT_CIVIL_ID,'EMAIL'=>$EMAIL,'TELEPHONE'=>$TELEPHONE,'MUKAZA_MENAGE_ID'=>$ID_MENAGE);

					$this->Model->create('membre_menage',$array_membres);

				}
			}


			$this->Model->update('json_menage',array('ID_JSON'=>$key['ID_JSON']),array('TRAITER'=>1));

		}
	}
}

 ?>