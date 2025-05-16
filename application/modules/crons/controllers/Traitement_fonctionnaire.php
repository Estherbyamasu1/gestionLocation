<?php 

/**
 * christa
 * traitement du formulaire d'identification des des fonctionnaires 
 * du mineduc
 * date: le 08/05/2023
 * christa@mediabox.bi
 */
class Traitement_fonctionnaire extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	
	function traiter()
	{
		$fxaires=$this->Model->getList("json_fonctionnaire_test",array('TRAITER'=>0));

		foreach ($fxaires as $key) {
			
			$DATA_JSON = $key['DATA_JSON'];
			$JSON_ID=$key['ID'];
        	$DATA_JSON = str_replace("/","_", $DATA_JSON);
        	$DATA_JSON = json_decode($DATA_JSON);

			echo"<pre>";
			print_r($DATA_JSON); die();

			$NOM=NULL;
        	if (isset($DATA_JSON->identification_nom)) {
        		# code...
        		$NOM=$DATA_JSON->identification_nom;
        	}
        	$PRENOM=NULL;
        	if (isset($DATA_JSON->identification_prenom)) {
        		# code...
        		$PRENOM=$DATA_JSON->identification_prenom;
        	}
        	$SEXE_ID=NULL;
        	if (isset($DATA_JSON->identification_sexe)) {
        		# code...
        		$SEXE_ID=$DATA_JSON->identification_sexe;
        	}


        	$PHOTO_PASSEPORT=NULL;
        	if (isset($DATA_JSON->identification_photo_passport)) {
        		# code...
        		$PHOTO_PASSEPORT=$DATA_JSON->identification_photo_passport;
        	}

        	$DATE_NAISSANCE = (isset($DATA_JSON->identification_date_naissance)) ? $DATA_JSON->identification_date_naissance : 0 ;

        	$TROISIEME_MATRICULE = (isset($DATA_JSON->contrat_troisieme_matricule)) ? $DATA_JSON->contrat_troisieme_matricule : 0 ;
        	$PATH_PHOTO = (isset($DATA_JSON->identification_photo)) ? $DATA_JSON->identification_photo : NULL ;
        	$TYPE_DOCUMENT_ID = (isset($DATA_JSON->identification_document)) ? $DATA_JSON->identification_document : NULL ;
        	$NUMERO_DOCUMENT = (isset($DATA_JSON->identification_numero_cni_passport)) ? $DATA_JSON->identification_numero_cni_passport : NULL ;
        	
        	$IS_DIPLICATA = (isset($DATA_JSON->identification_original)) ? $DATA_JSON->identification_original : NULL ;

        	$PHOTO_DOCUMENT_RECTO = (isset($DATA_JSON->identification_cni_recto)) ? $DATA_JSON->identification_cni_recto : NULL ;
        	$PHOTO_DOCUMENT_VERSO = (isset($DATA_JSON->identification_cni_verso)) ? $DATA_JSON->identification_cni_verso : NULL ;
        	$HAVE_PHONE = (isset($DATA_JSON->identification_telephone)) ? $DATA_JSON->identification_telephone : NULL ;
        	$TELEPHONE = (isset($DATA_JSON->identification_num_tel)) ? $DATA_JSON->identification_num_tel : NULL ;
        	$TELEPHONE_AUTRE = (isset($DATA_JSON->identification_autre_num_tel)) ? $DATA_JSON->identification_autre_num_tel : NULL ;
        	
        	$HAVE_EMAIL_PRO = (isset($DATA_JSON->identification_adresse_mail)) ? $DATA_JSON->identification_adresse_mail : NULL ;
        	$EMAIL_PRO = (isset($DATA_JSON->identification_email)) ? $DATA_JSON->identification_email : NULL ;
        	$HAVE_EMAIL_PERSO = (isset($DATA_JSON->identification_have_mail_perso)) ? $DATA_JSON->identification_have_mail_perso : NULL ;
        	$EMAIL_PERSO = (isset($DATA_JSON->identification_email_perso)) ? $DATA_JSON->identification_email_perso : NULL ;
        	$NATIONALITE_ID = (isset($DATA_JSON->identification_nationalite)) ? $DATA_JSON->identification_nationalite : NULL ;
        	$NUMERO_PERMIS_TRAVAIL = (isset($DATA_JSON->identification_num_permis)) ? $DATA_JSON->identification_num_permis : NULL ;
        	$IS_BORN_IN_BRD = (isset($DATA_JSON->localite_natis_bdi)) ? $DATA_JSON->localite_natis_bdi : NULL ;
        	$PROVINCE_NAISSANCE_ID = (isset($DATA_JSON->localite_province)) ? $DATA_JSON->localite_province : NULL ;
        	$COMMUNE_NAISSANCE_ID = (isset($DATA_JSON->localite_commune)) ? $DATA_JSON->localite_commune : NULL ;
        	$ZONE_NAISSANCE_ID = (isset($DATA_JSON->localite_zone)) ? $DATA_JSON->localite_zone : NULL ;
        	$COLLINE_NAISSANCE_ID = (isset($DATA_JSON->localite_colline)) ? $DATA_JSON->localite_colline : NULL ;
        	
        	
        	$PAYS_NAISSANCE_ID = (isset($DATA_JSON->localite_pays)) ? $DATA_JSON->localite_pays : NULL ;
        	$LIFE_IN_BRD = (isset($DATA_JSON->localite_reside_bdi)) ? $DATA_JSON->localite_reside_bdi : NULL ;

        	$PROVINCE_RESIDENCE_ID = (isset($DATA_JSON->localite_province_residence)) ? $DATA_JSON->localite_province_residence : NULL ;
        	$COMMUNE_RESIDENCE_ID = (isset($DATA_JSON->localite_commune_residence)) ? $DATA_JSON->localite_commune_residence : NULL ;
        	$ZONE_RESIDENCE_ID = (isset($DATA_JSON->localite_zone_residence)) ? $DATA_JSON->localite_zone_residence : NULL ;
        	$COLLINE_RESIDENCE_ID = (isset($DATA_JSON->localite_colline_residence)) ? $DATA_JSON->localite_colline_residence : NULL ;
        	

        	$PAYS_RESIDENCE_ID = (isset($DATA_JSON->localite_pays_residence)) ? $DATA_JSON->localite_pays_residence : NULL ;
        	$VILLE_RESIDENCE = (isset($DATA_JSON->localite_ville)) ? $DATA_JSON->localite_ville : NULL ;
        	$CONFESSION_ID = (isset($DATA_JSON->localite_confession_religeiuse)) ? $DATA_JSON->localite_confession_religeiuse : NULL ;
        	$AUTRE_CONFESSION = (isset($DATA_JSON->localite_autre_confession)) ? $DATA_JSON->localite_autre_confession : NULL ;
        	$STATUT_MATRIMONIAL_ID = (isset($DATA_JSON->localite_statut_matrimonial)) ? $DATA_JSON->localite_statut_matrimonial : NULL ;
        	$HAVE_ENFANT = (isset($DATA_JSON->localite_enfants)) ? $DATA_JSON->localite_enfants : NULL ;
        	$NOMBRE_ENFANT = (isset($DATA_JSON->localite_combien_enfant)) ? $DATA_JSON->localite_combien_enfant : NULL ;


        	$NOM_CONJOINT = (isset($DATA_JSON->marie_nom_conjoint)) ? $DATA_JSON->marie_nom_conjoint : NULL ;
        	$PRENOM_CONJOINT = (isset($DATA_JSON->marie_prenom_conjoint)) ? $DATA_JSON->marie_prenom_conjoint : NULL ;
        	$NAISSANCE_CONJOINT = (isset($DATA_JSON->marie_date_naissance_conjoint)) ? $DATA_JSON->marie_date_naissance_conjoint : NULL ;

        	$anne_naissance=explode("-",$NAISSANCE_CONJOINT);
        	$ANNEE_NAISSANCE_CONJOINT=$anne_naissance[0];

        	$REVENU_CONJOINT_ID = (isset($DATA_JSON->marie_revenu_conjoint)) ? $DATA_JSON->marie_revenu_conjoint : NULL ;
        	$PERE_IS_VIVANT = (isset($DATA_JSON->identification2_pere_vivant)) ? $DATA_JSON->identification2_pere_vivant : NULL ;
        	$NOM_PERE = (isset($DATA_JSON->identification2_nom_pere)) ? $DATA_JSON->identification2_nom_pere : NULL ;
        	$PRENOM_PERE = (isset($DATA_JSON->identification2_prenom_pere)) ? $DATA_JSON->identification2_prenom_pere : NULL ;
        	$MERE_IS_VIVANT = (isset($DATA_JSON->identification2_mere_vivant)) ? $DATA_JSON->identification2_mere_vivant : NULL ;
        	$NOM_MERE = (isset($DATA_JSON->identification2_nom_mere)) ? $DATA_JSON->identification2_nom_mere : NULL ;
        	$PRENOM_MERE = (isset($DATA_JSON->identification2_prenom_mere)) ? $DATA_JSON->identification2_prenom_mere : NULL ;
        	$HAVE_SITUATION_HANDICAP = (isset($DATA_JSON->identification2_est_handicap)) ? $DATA_JSON->identification2_est_handicap : NULL ;
        	$TYPE_HANDICAP_ID = (isset($DATA_JSON->identification2_type_handicap)) ? $DATA_JSON->identification2_type_handicap : NULL ;
        	$AUTRE_TYPE_HANDICAP = (isset($DATA_JSON->identification2_autre_handicap)) ? $DATA_JSON->identification2_autre_handicap : NULL ;

        	$LIEU_TRAVAIL_PROVINCE_ID = (isset($DATA_JSON->localite_travail_province_travail)) ? $DATA_JSON->localite_travail_province_travail : NULL ;
        	$LIEU_COMMUNE_TRAVAIL_ID = (isset($DATA_JSON->localite_travail_commune_travail)) ? $DATA_JSON->localite_travail_commune_travail : NULL ;
        	$LIEU_ZONE_TRAVAIL_ID = (isset($DATA_JSON->localite_travail_zone_travail)) ? $DATA_JSON->localite_travail_zone_travail : NULL ;
        	$LIEU_COLLINE_TRAVAIL_ID = (isset($DATA_JSON->localite_travail_colline_travail)) ? $DATA_JSON->localite_travail_colline_travail : NULL ;
     

        	$LIFE_WITH_FAMILY = (isset($DATA_JSON->localite_famille_habiter_ens_famille)) ? $DATA_JSON->localite_famille_habiter_ens_famille : 0 ;
        	$FAMILY_LIFE_IN_BRD = (isset($DATA_JSON->localite_famille_famille_bdi)) ? $DATA_JSON->localite_famille_famille_bdi : 0 ;
        	$PROVINCE_RESIDENCE_FAMILLE_ID	 = (isset($DATA_JSON->localite_famille_province_flle)) ? $DATA_JSON->localite_famille_province_flle : NULL ;
        	$COMMUNE_RESIDENCE_FAMILLE_ID = (isset($DATA_JSON->localite_famille_commune_flle)) ? $DATA_JSON->localite_famille_commune_flle : NULL ;
        	$ZONE_RESIDENCE_FAMILLE_ID = (isset($DATA_JSON->localite_famille_zone_flle)) ? $DATA_JSON->localite_famille_zone_flle : NULL ;
        	$COLLINE_RESIDENCE_FAMILLE_ID = (isset($DATA_JSON->localite_famille_colline_flle)) ? $DATA_JSON->localite_famille_colline_flle : NULL ;
        	
        	$PAYS_RESIDENCE_FAMILLE_ID = (isset($DATA_JSON->localite_famille_pays_famille)) ? $DATA_JSON->localite_famille_pays_famille : NULL ;

        	$NIVEAU_ADMINISTRATIF_ID = (isset($DATA_JSON->localite_famille_niveau_admin)) ? $DATA_JSON->localite_famille_niveau_admin : NULL ;
        	
        	$QUALIFICATION_ID = (isset($DATA_JSON->contrat_niveau_formation)) ? $DATA_JSON->contrat_niveau_formation : NULL ;
        	$ENGAGEMENT_CATEGORIE_ID = (isset($DATA_JSON->contrat_categorie)) ? $DATA_JSON->contrat_categorie : NULL ;
        	$NUMERO_MATRICULE = (isset($DATA_JSON->contrat_matricule)) ? $DATA_JSON->contrat_matricule : 0 ;
        	$AUTRE_NUMERO_MATRICULE = (isset($DATA_JSON->contrat_deuxieme_matricule)) ? $DATA_JSON->contrat_deuxieme_matricule : 0 ;
        	$HAVE_OTHER_UNIQUE_ID = (isset($DATA_JSON->contrat_identifiant_unique)) ? $DATA_JSON->contrat_identifiant_unique : 0 ;
        	$UNIQUE_ID = (isset($DATA_JSON->contrat_id_unique)) ? $DATA_JSON->contrat_id_unique : 0 ;
        	$HAVE_AFFILIE_MFP = (isset($DATA_JSON->contrat_affilie_mutuelle)) ? $DATA_JSON->contrat_affilie_mutuelle : 0 ;
        	$HAVE_CARTE_MFP = (isset($DATA_JSON->contrat_carte_mfp)) ? $DATA_JSON->contrat_carte_mfp : 0 ;
        	$NUMERO_CARTE_MFP = (isset($DATA_JSON->contrat_num_carte_mfp)) ? $DATA_JSON->contrat_num_carte_mfp : 0 ;
        	$PHOTO_CARTE_MFP = (isset($DATA_JSON->contrat_photo_mfp)) ? $DATA_JSON->contrat_photo_mfp : 0 ;
        	$HAVE_NUMERO_AFFILIATION_INSS = (isset($DATA_JSON->contrat_affiliation_inss)) ? $DATA_JSON->contrat_affiliation_inss : 0 ;
        	$NUMERO_AFFILIATION_INSS = (isset($DATA_JSON->contrat_num_inss)) ? $DATA_JSON->contrat_num_inss : 0 ;
        	$HAVE_NUMERO_AFFILIATION_ONPR = (isset($DATA_JSON->contrat_affiliation_onpr)) ? $DATA_JSON->contrat_affiliation_onpr : 0 ;
        	$NUMERO_AFFILIATION_ONPR = (isset($DATA_JSON->contrat_num_onpr)) ? $DATA_JSON->contrat_num_onpr : 0 ;
        	$HAVE_AFFILIE_FSTE = (isset($DATA_JSON->contrat_affilie_fste)) ? $DATA_JSON->contrat_affilie_fste : 0 ;
        	$HAVE_AFFILIE_FLE = (isset($DATA_JSON->contrat_affilie_fle)) ? $DATA_JSON->contrat_affilie_fle : 0 ;


        	$ANNE = (isset($DATA_JSON->contrat_affilie_fste)) ? $DATA_JSON->contrat_affilie_fste : 0 ;
        	$FIRST_RECRUTEMENT = (isset($DATA_JSON->recrutement_anne_1er_recrutement)) ? $DATA_JSON->recrutement_anne_1er_recrutement : 0 ;

        	

        	$ANNE = explode("-", $FIRST_RECRUTEMENT);
        	$ANNEE_FIRST_RECRUTEMENT=$ANNE[0];

        	
        	$ANNE_ETRE_MINEDUC = (isset($DATA_JSON->recrutement_depuis_quand)) ? $DATA_JSON->recrutement_depuis_quand : NULL ;
        	$HAVE_MISE_DISPOSITION = (isset($DATA_JSON->recrutement_mise_dispo)) ? $DATA_JSON->recrutement_mise_dispo : NULL ;
        	$TEMPS_HAVE_MISE_DISPOSITION = (isset($DATA_JSON->recrutement_combien_temps)) ? $DATA_JSON->recrutement_combien_temps : 0 ;
        	$HAVE_REINTEGRE = (isset($DATA_JSON->recrutement_est_reintegre)) ? $DATA_JSON->recrutement_est_reintegre : NULL ;
        	$SECTEUR_PROVINANCE_ID = (isset($DATA_JSON->recrutement_secteur_provenance)) ? $DATA_JSON->recrutement_secteur_provenance : NULL ;
        	$HAVE_DETACHE = (isset($DATA_JSON->recrutement_est_detache)) ? $DATA_JSON->recrutement_est_detache : 0 ;
        	$TYPE_DETACHEMENT_ID = (isset($DATA_JSON->recrutement_type_detachement)) ? $DATA_JSON->recrutement_type_detachement : NULL ;
        	$HAVE_MATRICULE_DETACHEMENT = (isset($DATA_JSON->recrutement_avez_matricule)) ? $DATA_JSON->recrutement_avez_matricule : 0 ;
        	$MATRICULE_DETACHEMENT = (isset($DATA_JSON->recrutement_matricule_avant_det)) ? $DATA_JSON->recrutement_matricule_avant_det : 0 ;
        	$PERIODE_DETACHEMENT = (isset($DATA_JSON->recrutement_temps_detach)) ? $DATA_JSON->recrutement_temps_detach : 0 ;
        	$NB_FORMATION_PLUS_3MOIS = (isset($DATA_JSON->recrutement_combien_formation)) ? $DATA_JSON->recrutement_combien_formation : 0 ;
        	$HAVE_SUIVI_FORMATION_ONLINE = (isset($DATA_JSON->recrutement_suivi_formation_en_ligne)) ? $DATA_JSON->recrutement_suivi_formation_en_ligne : NULL ;
        	$I_SUIVRE_FORMATION_ONLINE = (isset($DATA_JSON->recrutement_formation_en_ligne)) ? $DATA_JSON->recrutement_formation_en_ligne : 0 ;
        	$HAVE_INTEGRE_MANDAT_POLITIQUE = (isset($DATA_JSON->mandat_integre_mandat)) ? $DATA_JSON->mandat_integre_mandat : 0 ;
        	$HAVE_REINTEGRE_MANDAT_POLITIQUE = (isset($DATA_JSON->mandat_reintegre_mandat)) ? $DATA_JSON->mandat_reintegre_mandat : 0 ;
        	$HAVE_TRANSFERE_DEPLOYE = (isset($DATA_JSON->mandat_est_transfere)) ? $DATA_JSON->mandat_est_transfere : 0 ;
        	$NB_FOIS_TRANSFERE_DEPLOYE = (isset($DATA_JSON->mandat_nbre_fois_transfere)) ? $DATA_JSON->mandat_nbre_fois_transfere : 0 ;
        	$MODE_RECRUTEMENT_ID = (isset($DATA_JSON->mandat_mode_recrut)) ? $DATA_JSON->mandat_mode_recrut : NULL ;
        	$TYPE_CONTRAT_ID = (isset($DATA_JSON->mandat_type_contrat)) ? $DATA_JSON->mandat_type_contrat : NULL ;
        	$NIVEAU_SATISFACTION_ID = (isset($DATA_JSON->mandat_satisfait)) ? $DATA_JSON->mandat_satisfait : NULL ;
        	$HAVE_AFFILIE_SYNDICAT = (isset($DATA_JSON->mandat_affilie_syndicat)) ? $DATA_JSON->mandat_affilie_syndicat : 0 ;
        	$SYNDICAT_ID = (isset($DATA_JSON->mandat_quel_syndicat)) ? $DATA_JSON->mandat_quel_syndicat : NULL;
        	$CHOIX_ADHESION_SYNDICAT_ID = (isset($DATA_JSON->mandat_adhesion_syndicat)) ? $DATA_JSON->mandat_adhesion_syndicat : NULL ;
        	// $SALAIRE_INSTITUTION_ID = (isset($DATA_JSON->revenu_salaire_brut)) ? $DATA_JSON->revenu_salaire_brut : 0 ;
        	$SALAIRE_VERSE_MENSUELLEMENT = (isset($DATA_JSON->revenu_verse_mensuellement)) ? $DATA_JSON->revenu_verse_mensuellement : 0 ;
        	$MOYEN_VERSEMENT_SALAIRE_ID = (isset($DATA_JSON->revenu_moyen_versement)) ? $DATA_JSON->revenu_moyen_versement : NULL ;
        	$BANQUE_IMF_ID=NULL;
        	if ($MOYEN_VERSEMENT_SALAIRE_ID==1) {
        		$BANQUE_IMF_ID = (isset($DATA_JSON->revenu_banque)) ? $DATA_JSON->revenu_banque : NULL ;
        	}elseif($MOYEN_VERSEMENT_SALAIRE_ID==2){
        		$BANQUE_IMF_ID = (isset($DATA_JSON->revenu_imf)) ? $DATA_JSON->revenu_imf : NULL ;
        	}

        	$AUTRE_ACTIVITE = (isset($DATA_JSON->revenu_autre_activite)) ? $DATA_JSON->revenu_autre_activite : NULL;

        	$AUTRE_CATEGORIE = (isset($DATA_JSON->contrat_autre_categorie)) ? $DATA_JSON->contrat_autre_categorie : NULL;
        	
        	

// 7777777

        	$NUMERO_COMPTE = (isset($DATA_JSON->revenu_num_compte)) ? $DATA_JSON->revenu_num_compte : 0 ;
        	$HAVE_POSSIBILITE_RETIRE_SALAIRE_VIA_PHONE = (isset($DATA_JSON->revenu_possibilite_retrait)) ? $DATA_JSON->revenu_possibilite_retrait : 0 ;
        	$EST_SATISFAIT_SALAIRE = (isset($DATA_JSON->revenu_satisfait_salaire)) ? $DATA_JSON->revenu_satisfait_salaire : 0 ;
        	$HABITE_PROPRE_MAISON = (isset($DATA_JSON->revenu_propre_maison)) ? $DATA_JSON->revenu_propre_maison : 0 ;
        	$I_PAYE_LOYER = (isset($DATA_JSON->revenu_payer_loyer)) ? $DATA_JSON->revenu_payer_loyer : 0 ;
        	$I_HEBERGE_FAMILY_OR_AMI = (isset($DATA_JSON->revenu_est_heberge)) ? $DATA_JSON->revenu_est_heberge : 0 ;
        	$PERSONNE_HEBERGEMENT_ID = (isset($DATA_JSON->revenu_heberge_par_qui)) ? $DATA_JSON->revenu_heberge_par_qui : null ;
        	$HAVE_IMPLIQUE_ACTIVITE_ENCADREMENT = (isset($DATA_JSON->revenu_est_implique_activite)) ? $DATA_JSON->revenu_est_implique_activite : 0 ;
        	$ACTIVITE_ENCADREMENT_ID = (isset($DATA_JSON->revenu_quel_activite)) ? $DATA_JSON->revenu_quel_activite : null ;
        	$HAVE_PHONE_SERVICE = (isset($DATA_JSON->revenu_tel_service)) ? $DATA_JSON->revenu_tel_service : 0 ;
        	$NUMERO_TEL_SERVICE = (isset($DATA_JSON->revenu_num_tel_service)) ? $DATA_JSON->revenu_num_tel_service : 0 ;
        	$HAVE_ACCES_INTERNET = (isset($DATA_JSON->revenu_connexion_internet)) ? $DATA_JSON->revenu_connexion_internet : 0 ;
        	$MOYEN_DEPLACEMENT_ID = (isset($DATA_JSON->revenu_moyen_deplacement)) ? $DATA_JSON->revenu_moyen_deplacement : NULL ;
        	$HAVE_PERMIS_CONDUIRE = (isset($DATA_JSON->revenu_have_permis)) ? $DATA_JSON->revenu_have_permis : 0 ;
        	$DISTANCE_KM_TRAVAIL_HOME = (isset($DATA_JSON->revenu_distance)) ? $DATA_JSON->revenu_distance : 0 ;
        	$ETHNIE_ID = (isset($DATA_JSON->revenu_ethnie)) ? $DATA_JSON->revenu_ethnie : NULL ;
        	$ETHNIE_AUTRE = (isset($DATA_JSON->revenu_autre_ethnie)) ? $DATA_JSON->revenu_autre_ethnie : 0 ;

        	$PAYS_ID = (isset($DATA_JSON->identification_autre_pays)) ? $DATA_JSON->identification_autre_pays : NULL ;

        	$DEVICE_ID=NULL;
        	if (isset($DATA_JSON->deviceid)) {
        		# code...
        		$device=explode(":", $DATA_JSON->deviceid);
        		$DEVICE_ID=$device[1];
        	}
        	$DATE_COLLECTE=NULL;
        	if (isset($DATA_JSON->end)) {
        		$DATE_COLLECTE=$DATA_JSON->end;
        	}

        	$LATITUDE=0;
        	$LONGITUDE=0;

        	
        	if (isset($DATA_JSON->geolocation)) 
			{
				$geopoint=explode(" ",$DATA_JSON->geolocation);
				$LATITUDE=$geopoint[0];
				$LONGITUDE=$geopoint[1];
			}

        	// TRAITEMENT ORGANIGRAMME


        	$POSTE=0;
        	$HIERARCHIE=0;

        	
        	if (isset($DATA_JSON->ministere_cabinet)) {
        		$HIERARCHIE=$DATA_JSON->ministere_cabinet;
        	}

        	if (isset($DATA_JSON->ministere_niveau0)) {
        		$HIERARCHIE=$DATA_JSON->ministere_niveau0;
        	}
        	if (isset($DATA_JSON->group_niveau1_niveau1)) {
        		$HIERARCHIE=$DATA_JSON->group_niveau1_niveau1;
        	}
        	if (isset($DATA_JSON->group_niveau2_niveau2)) {
        		$HIERARCHIE=$DATA_JSON->group_niveau2_niveau2;
        	}

        	// POSTE
        	if (isset($DATA_JSON->ministere_poste_niveau)) {
        		$POSTE=$DATA_JSON->ministere_poste_niveau;
        	}
        	if (isset($DATA_JSON->ministere_poste_niveau0)) {
        		$POSTE=$DATA_JSON->ministere_poste_niveau0;
        	}
        	if (isset($DATA_JSON->group_niveau1_poste_niveau1)) {
        		$POSTE=$DATA_JSON->group_niveau1_poste_niveau1;
        	}

        	if (isset($DATA_JSON->group_niveau2_poste_niveau2)) {
        		$POSTE=$DATA_JSON->group_niveau2_poste_niveau2;
        	}

        	

        	// traitement dpe,dce,ecole,bpi,bci
        	if ($HIERARCHIE == 70000) {
        		if (isset($DATA_JSON->ecole_dpe)) {
	        		$HIERARCHIE=$DATA_JSON->ecole_dpe;
	        	}

	        	if (isset($DATA_JSON->ecole_dce)) {
	        		$HIERARCHIE=$DATA_JSON->ecole_dce;
	        	}

	        	if (isset($DATA_JSON->ecole_dce)) {
	        		$HIERARCHIE=$DATA_JSON->ecole_dce;
	        	}
	        	if (isset($DATA_JSON->ecole_ecole_001)) {
	        		$HIERARCHIE=$DATA_JSON->ecole_ecole_001;
	        	}

	        	if (isset($DATA_JSON->ecole_bpi)) {
	        		$HIERARCHIE=$DATA_JSON->ecole_bpi;
	        	}
	        	if (isset($DATA_JSON->ecole_bci)) {
	        		$HIERARCHIE=$DATA_JSON->ecole_bci;
	        	}

	        	// poste
	        	if (isset($DATA_JSON->ecole_poste_dpe)) {
	        		$POSTE=$DATA_JSON->ecole_poste_dpe;
	        	}
	        	if (isset($DATA_JSON->ecole_poste_dce)) {
	        		$POSTE=$DATA_JSON->ecole_poste_dce;
	        	}
	        	if (isset($DATA_JSON->ecole_poste_ecole)) {
	        		$POSTE=$DATA_JSON->ecole_poste_ecole;
	        	}
	        	if (isset($DATA_JSON->ecole_poste_bpi)) {
	        		$POSTE=$DATA_JSON->ecole_poste_bpi;
	        	}
	        	if (isset($DATA_JSON->ecole_poste_bci)) {
	        		$POSTE=$DATA_JSON->ecole_poste_bci;
	        	}
	        	// fin

        	}else{
        		
	        	if (isset($DATA_JSON->group_niveau3_niveau3)) {
	        		$HIERARCHIE=$DATA_JSON->group_niveau3_niveau3;
	        	}
	        	if (isset($DATA_JSON->group_niveau4_niveau4)) {
	        		$HIERARCHIE=$DATA_JSON->group_niveau4_niveau4;
	        	}
	        	if (isset($DATA_JSON->group_niveau5_niveau5)) {
	        		$HIERARCHIE=$DATA_JSON->group_niveau5_niveau5;
	        	}
	        	if (isset($DATA_JSON->group_niveau6_niveau6)) {
	        		$HIERARCHIE=$DATA_JSON->group_niveau6_niveau6;
	        	}
	        	if (isset($DATA_JSON->group_niveau7_niveau7)) {
	        		$HIERARCHIE=$DATA_JSON->group_niveau7_niveau7;
	        	}
	        	if (isset($DATA_JSON->group_niveau8_niveau8)) {
	        		$HIERARCHIE=$DATA_JSON->group_niveau8_niveau8;
	        	}


	        	// poste
	        	
	        	if (isset($DATA_JSON->group_niveau3_poste_niveau3)) {
	        		$POSTE=$DATA_JSON->group_niveau3_poste_niveau3;
	        	}
	        	if (isset($DATA_JSON->group_niveau4_poste_niveau4)) {
	        		$POSTE=$DATA_JSON->group_niveau4_poste_niveau4;
	        	}
	        	if (isset($DATA_JSON->group_niveau5_poste_niveau5)) {
	        		$POSTE=$DATA_JSON->group_niveau5_poste_niveau5;
	        	}
	        	if (isset($DATA_JSON->group_niveau6_poste_niveau6)) {
	        		$POSTE=$DATA_JSON->group_niveau6_poste_niveau6;
	        	}
	        	if (isset($DATA_JSON->group_niveau7_poste_niveau7)) {
	        		$POSTE=$DATA_JSON->group_niveau7_poste_niveau7;
	        	}
	        	if (isset($DATA_JSON->group_niveau8_poste_niveau8)) {
	        		$POSTE=$DATA_JSON->group_niveau8_poste_niveau8;
	        	}
	        	// fin
        	}

        	// print_r($POSTE); die();

        	$HIERARCHIE_POSTE=$this->Model->getRequeteOne('SELECT `HIERARCHIE_POSTE_ID` FROM `org_hierarchie_poste` WHERE `POSTE_ID`='.$POSTE.' AND `HIERARCHIE_ID`='.$HIERARCHIE);


        	
			$HAVE_MATRICULE=NULL;
        	if (isset($DATA_JSON->contrat_have_matricule)) {
        		$HAVE_MATRICULE=$DATA_JSON->contrat_have_matricule;
        	}
        	$MATRICULE_ATTENTE=NULL;
        	if (isset($DATA_JSON->contrat_matricule_attente)) {
        		$MATRICULE_ATTENTE=$DATA_JSON->contrat_matricule_attente;
        	}

        	$data_doublons='';
        	if ($HAVE_MATRICULE==1) {
        		$data_doublons=array('NUMERO_MATRICULE'=>$NUMERO_MATRICULE);

        	}elseif ($HAVE_MATRICULE==0) {
        		$data_doublons=array('NOM'=>$NOM,'PRENOM'=>$PRENOM,'TELEPHONE'=>$TELEPHONE,'SEXE_ID'=>$SEXE_ID,'DATE_NAISSANCE'=>$DATE_NAISSANCE);
        	}

        	$doublons=$this->Model->getOne('mineduc_fonctionnaires',$data_doublons);

        	if (empty($doublons)) {
        		$IS_DOUBLON=0;
        	}else{
        		$IS_DOUBLON=1;
        	}



        	$data_fonctionnaires=array(
        								'NOM'=>$NOM,
        								'PRENOM'=>$PRENOM,
        								'SEXE_ID'=>$SEXE_ID,
        								'DATE_NAISSANCE'=>$DATE_NAISSANCE,
        								'PATH_PHOTO'=>$PATH_PHOTO,
        								'HAVE_MATRICULE'=>$HAVE_MATRICULE,
        								'MATRICULE_ATTENTE'=>trim($MATRICULE_ATTENTE),
        								'TYPE_DOCUMENT_ID'=>$TYPE_DOCUMENT_ID,
        								'PHOTO_PASSEPORT'=>$PHOTO_PASSEPORT,
        								'NUMERO_DOCUMENT'=>trim($NUMERO_DOCUMENT),
        								'IS_DIPLICATA'=>$IS_DIPLICATA,
        								'PHOTO_DOCUMENT_RECTO'=>$PHOTO_DOCUMENT_RECTO,
        								'PHOTO_DOCUMENT_VERSO'=>$PHOTO_DOCUMENT_VERSO,
        								'HAVE_PHONE'=>$HAVE_PHONE,
        								'TELEPHONE'=>trim($TELEPHONE),
        								'TELEPHONE_AUTRE'=>trim($TELEPHONE_AUTRE),
        								'HAVE_EMAIL_PRO'=>$HAVE_EMAIL_PRO,
        								'EMAIL_PRO'=>trim($EMAIL_PRO),
        								'HAVE_EMAIL_PERSO'=>$HAVE_EMAIL_PERSO,
        								'EMAIL_PERSO'=>trim($EMAIL_PERSO),
        								'NATIONALITE_ID'=>$NATIONALITE_ID,
        								'NUMERO_PERMIS_TRAVAIL'=>trim($NUMERO_PERMIS_TRAVAIL),
        								'IS_BORN_IN_BRD'=>$IS_BORN_IN_BRD,
        								'PROVINCE_NAISSANCE_ID'=>$PROVINCE_NAISSANCE_ID,
        								'COMMUNE_NAISSANCE_ID'=>$COMMUNE_NAISSANCE_ID,
        								'ZONE_NAISSANCE_ID'=>$ZONE_NAISSANCE_ID,
        								'COLLINE_NAISSANCE_ID'=>$COLLINE_NAISSANCE_ID,
        								'PAYS_NAISSANCE_ID'=>$PAYS_NAISSANCE_ID,
        								'LIFE_IN_BRD'=>$LIFE_IN_BRD,
        								'PROVINCE_RESIDENCE_ID'=>$PROVINCE_RESIDENCE_ID,
        								'COMMUNE_RESIDENCE_ID'=>$COMMUNE_RESIDENCE_ID,
        								'ZONE_RESIDENCE_ID'=>$ZONE_RESIDENCE_ID,
        								'COLLINE_RESIDENCE_ID'=>$COLLINE_RESIDENCE_ID,
        								'AUTRE_CATEGORIE'=>$AUTRE_CATEGORIE,
        								'PAYS_RESIDENCE_ID'=>$PAYS_RESIDENCE_ID,
        								'VILLE_RESIDENCE'=>$VILLE_RESIDENCE,
        								'CONFESSION_ID'=>$CONFESSION_ID,
        								'AUTRE_CONFESSION'=>$AUTRE_CONFESSION,
        								'STATUT_MATRIMONIAL_ID'=>$STATUT_MATRIMONIAL_ID,
        								'HAVE_ENFANT'=>$HAVE_ENFANT,
        								'NOMBRE_ENFANT'=>$NOMBRE_ENFANT,
        								'NOM_CONJOINT'=>$NOM_CONJOINT,
        								'PRENOM_CONJOINT'=>$PRENOM_CONJOINT,
        								'ANNEE_NAISSANCE_CONJOINT'=>$ANNEE_NAISSANCE_CONJOINT,
        								'REVENU_CONJOINT_ID'=>$REVENU_CONJOINT_ID,
        								'PERE_IS_VIVANT'=>$PERE_IS_VIVANT,
        								'NOM_PERE'=>trim($NOM_PERE),
        								'PRENOM_PERE'=>trim($PRENOM_PERE),
        								'MERE_IS_VIVANT'=>$MERE_IS_VIVANT,
        								'NOM_MERE'=>trim($NOM_MERE),
        								'PRENOM_MERE'=>trim($PRENOM_MERE),
        								'HAVE_SITUATION_HANDICAP'=>$HAVE_SITUATION_HANDICAP,
        								'TYPE_HANDICAP_ID'=>$TYPE_HANDICAP_ID,
        								'AUTRE_TYPE_HANDICAP'=>$AUTRE_TYPE_HANDICAP,
        								'LIEU_TRAVAIL_PROVINCE_ID'=>$LIEU_TRAVAIL_PROVINCE_ID,
        								'LIEU_COMMUNE_TRAVAIL_ID'=>$LIEU_COMMUNE_TRAVAIL_ID,
        								'LIEU_ZONE_TRAVAIL_ID'=>$LIEU_ZONE_TRAVAIL_ID,
        								'LIEU_COLLINE_TRAVAIL_ID'=>$LIEU_COLLINE_TRAVAIL_ID,
        								'LIFE_WITH_FAMILY'=>$LIFE_WITH_FAMILY,
        								'FAMILY_LIFE_IN_BRD'=>$FAMILY_LIFE_IN_BRD,
        								'PROVINCE_RESIDENCE_FAMILLE_ID'=>$PROVINCE_RESIDENCE_FAMILLE_ID,
        								'COMMUNE_RESIDENCE_FAMILLE_ID'=>$COMMUNE_RESIDENCE_FAMILLE_ID,
        								'ZONE_RESIDENCE_FAMILLE_ID'=>$ZONE_RESIDENCE_FAMILLE_ID,
        								'COLLINE_RESIDENCE_FAMILLE_ID'=>$COLLINE_RESIDENCE_FAMILLE_ID,
        								'PAYS_RESIDENCE_FAMILLE_ID'=>$PAYS_RESIDENCE_FAMILLE_ID,
        								'HIERARCHIE_ID'=>$HIERARCHIE,
        								'POSTE_ID'=>$POSTE,
        								'QUALIFICATION_ID'=>$QUALIFICATION_ID,
        								'ENGAGEMENT_CATEGORIE_ID'=>$ENGAGEMENT_CATEGORIE_ID,
        								'NUMERO_MATRICULE'=>trim($NUMERO_MATRICULE),
        								'AUTRE_NUMERO_MATRICULE'=>trim($AUTRE_NUMERO_MATRICULE),
        								'TROISIEME_MATRICULE'=>trim($TROISIEME_MATRICULE),
        								'HAVE_OTHER_UNIQUE_ID'=>$HAVE_OTHER_UNIQUE_ID,
        								'UNIQUE_ID'=>trim($UNIQUE_ID),
        								'HAVE_AFFILIE_MFP'=>$HAVE_AFFILIE_MFP,
        								'HAVE_CARTE_MFP'=>$HAVE_CARTE_MFP,
        								'NUMERO_CARTE_MFP'=>trim($NUMERO_CARTE_MFP),
        								'PHOTO_CARTE_MFP'=>$PHOTO_CARTE_MFP,
        								'HAVE_NUMERO_AFFILIATION_INSS'=>$HAVE_NUMERO_AFFILIATION_INSS,
        								'NUMERO_AFFILIATION_INSS'=>trim($NUMERO_AFFILIATION_INSS),
        								'HAVE_NUMERO_AFFILIATION_ONPR'=>$HAVE_NUMERO_AFFILIATION_ONPR,
        								'NUMERO_AFFILIATION_ONPR'=>trim($NUMERO_AFFILIATION_ONPR),
        								'HAVE_AFFILIE_FSTE'=>$HAVE_AFFILIE_FSTE,
        								'HAVE_AFFILIE_FLE'=>$HAVE_AFFILIE_FLE,
        								'ANNEE_FIRST_RECRUTEMENT'=>$ANNEE_FIRST_RECRUTEMENT,
        								'ANNE_ETRE_MINEDUC'=>$ANNE_ETRE_MINEDUC,
        								'HAVE_MISE_DISPOSITION'=>$HAVE_MISE_DISPOSITION,
        								'TEMPS_HAVE_MISE_DISPOSITION'=>$TEMPS_HAVE_MISE_DISPOSITION,
        								'HAVE_REINTEGRE'=>$HAVE_REINTEGRE,
        								'SECTEUR_PROVINANCE_ID'=>$SECTEUR_PROVINANCE_ID,
        								'HAVE_DETACHE'=>$HAVE_DETACHE,
        								'TYPE_DETACHEMENT_ID'=>$TYPE_DETACHEMENT_ID,
        								'HAVE_MATRICULE_DETACHEMENT'=>$HAVE_MATRICULE_DETACHEMENT,
        								'MATRICULE_DETACHEMENT'=>trim($MATRICULE_DETACHEMENT),
        								'PERIODE_DETACHEMENT'=>$PERIODE_DETACHEMENT,
        								'NB_FORMATION_PLUS_3MOIS'=>$NB_FORMATION_PLUS_3MOIS,
        								'HAVE_SUIVI_FORMATION_ONLINE'=>$HAVE_SUIVI_FORMATION_ONLINE,
        								'I_SUIVRE_FORMATION_ONLINE'=>$I_SUIVRE_FORMATION_ONLINE,
        								'HAVE_INTEGRE_MANDAT_POLITIQUE'=>$HAVE_INTEGRE_MANDAT_POLITIQUE,
        								'HAVE_REINTEGRE_MANDAT_POLITIQUE'=>$HAVE_REINTEGRE_MANDAT_POLITIQUE,
        								'HAVE_TRANSFERE_DEPLOYE'=>$HAVE_TRANSFERE_DEPLOYE,
        								'NB_FOIS_TRANSFERE_DEPLOYE'=>$NB_FOIS_TRANSFERE_DEPLOYE,
        								'MODE_RECRUTEMENT_ID'=>$MODE_RECRUTEMENT_ID,
        								'TYPE_CONTRAT_ID'=>$TYPE_CONTRAT_ID,
        								'NIVEAU_SATISFACTION_ID'=>$NIVEAU_SATISFACTION_ID,
        								'HAVE_AFFILIE_SYNDICAT'=>$HAVE_AFFILIE_SYNDICAT,
        								'SYNDICAT_ID'=>$SYNDICAT_ID,
        								'CHOIX_ADHESION_SYNDICAT_ID'=>$CHOIX_ADHESION_SYNDICAT_ID,
        								'SALAIRE_VERSE_MENSUELLEMENT'=>$SALAIRE_VERSE_MENSUELLEMENT,
        								'MOYEN_VERSEMENT_SALAIRE_ID'=>$MOYEN_VERSEMENT_SALAIRE_ID,
        								'BANQUE_IMF_ID'=>$BANQUE_IMF_ID,
        								'NUMERO_COMPTE'=>trim($NUMERO_COMPTE),
        								'HAVE_POSSIBILITE_RETIRE_SALAIRE_VIA_PHONE'=>$HAVE_POSSIBILITE_RETIRE_SALAIRE_VIA_PHONE,
        								'EST_SATISFAIT_SALAIRE'=>$EST_SATISFAIT_SALAIRE,
        								'HABITE_PROPRE_MAISON'=>$HABITE_PROPRE_MAISON,
        								'I_PAYE_LOYER'=>$I_PAYE_LOYER,
        								'I_HEBERGE_FAMILY_OR_AMI'=>$I_HEBERGE_FAMILY_OR_AMI,
        								'PERSONNE_HEBERGEMENT_ID'=>$PERSONNE_HEBERGEMENT_ID,
        								'HAVE_IMPLIQUE_ACTIVITE_ENCADREMENT'=>$HAVE_IMPLIQUE_ACTIVITE_ENCADREMENT,
        								'ACTIVITE_ENCADREMENT_ID'=>$ACTIVITE_ENCADREMENT_ID,
        								'AUTRE_ACTIVITE'=>$AUTRE_ACTIVITE,
        								'HAVE_PHONE_SERVICE'=>$HAVE_PHONE_SERVICE,
        								'NUMERO_TEL_SERVICE'=>trim($NUMERO_TEL_SERVICE),
        								'HAVE_ACCES_INTERNET'=>$HAVE_ACCES_INTERNET,
        								'MOYEN_DEPLACEMENT_ID'=>$MOYEN_DEPLACEMENT_ID,
        								'HAVE_PERMIS_CONDUIRE'=>$HAVE_PERMIS_CONDUIRE,
        								'DISTANCE_KM_TRAVAIL_HOME'=>$DISTANCE_KM_TRAVAIL_HOME,
        								'ETHNIE_ID'=>$ETHNIE_ID,
        								'ETHNIE_AUTRE'=>$ETHNIE_AUTRE,
        								'ID_JSON'=>$JSON_ID,
        								'DEVICEID'=>$DEVICE_ID,
        								'DATE_COLLECTE'=>$DATE_COLLECTE,
        								'LATITUDE'=>$LATITUDE,
        								'LONGITUDE'=>$LONGITUDE,
        								'IS_DOUBLON'=>$IS_DOUBLON,
        								);



			$FONCTIONNAIRE_ID=$this->Model->insert_last_id('mineduc_fonctionnaires',$data_fonctionnaires);

			
		    


        	// TREMENT REPEAT POUR ENFANT
        	$enfants=NULL;
        	if (isset($DATA_JSON->enfant_repeat)) {
        		# code...
        		$enfants=$DATA_JSON->enfant_repeat;

        		foreach ($enfants as $key_enfant) {
        			$DATE_NAISSANCE_ENFANT = (isset($key_enfant->enfant_repeat_date_naissance_enfant)) ? $key_enfant->enfant_repeat_date_naissance_enfant : NULL ;

        			$data_enfants=array(
        				'DATE_NAISSANCE'=>$DATE_NAISSANCE_ENFANT,
        				'FONCTIONNAIRE_ID'=>$FONCTIONNAIRE_ID);

        			$this->Model->create('mineduc_fonctionnaires_enfants',$data_enfants);
        		}
        	}
        	// FIN REPEAT
    	



        	// TRAITEMENT DES LANGUES

        	$KIRUNDI=NULL;
        	if (isset($DATA_JSON->lang_parle_repeat_niveau_expression_kir)) {
        		$KIRUNDI=$DATA_JSON->lang_parle_repeat_niveau_expression_kir;
        	}
        	$FRANCAIS=NULL;
        	if (isset($DATA_JSON->lang_parle_repeat_niveau_expression_fr)) {
        		$FRANCAIS=$DATA_JSON->lang_parle_repeat_niveau_expression_fr;
        	}
        	$ANGLAIS=NULL;
        	if (isset($DATA_JSON->lang_parle_repeat_niveau_expression_en)) {
        		$ANGLAIS=$DATA_JSON->lang_parle_repeat_niveau_expression_en;
        	}
        	$SWAHILI=NULL;
        	if (isset($DATA_JSON->lang_parle_repeat_niveau_expression_kisw)) {
        		$SWAHILI=$DATA_JSON->lang_parle_repeat_niveau_expression_kisw;
        	}
        	$AUTRE_LANGUE=NULL;
        	if (isset($DATA_JSON->lang_parle_repeat_autre_lang)) {
        		$AUTRE_LANGUE=$DATA_JSON->lang_parle_repeat_autre_lang;
        	}
        	$AUTRE_NIVEAU_LANGUE=NULL;
        	if (isset($DATA_JSON->lang_parle_repeat_niveau_expression_autre)) {
        		$AUTRE_NIVEAU_LANGUE=$DATA_JSON->lang_parle_repeat_niveau_expression_autre;
        	}

        	$langues=NULL;
        	if (isset($DATA_JSON->lang_parle_repeat_lang_parle)) {

        		$langues=explode(" ", $DATA_JSON->lang_parle_repeat_lang_parle);

        		foreach ($langues as $key => $value) {
        			
        			if ($value == 1) {
        				$array_lang=array('LANGUE_ID'=>$value,'FONCTIONNAIRE_ID'=>$FONCTIONNAIRE_ID,'NIVEAU_ID'=>$KIRUNDI);
        			}elseif ($value == 2) {
        				$array_lang=array('LANGUE_ID'=>$value,'FONCTIONNAIRE_ID'=>$FONCTIONNAIRE_ID,'NIVEAU_ID'=>$FRANCAIS);
        			}elseif ($value == 3) {
        				$array_lang=array('LANGUE_ID'=>$value,'FONCTIONNAIRE_ID'=>$FONCTIONNAIRE_ID,'NIVEAU_ID'=>$ANGLAIS);
        			}elseif ($value == 4) {
        				$array_lang=array('LANGUE_ID'=>$value,'FONCTIONNAIRE_ID'=>$FONCTIONNAIRE_ID,'NIVEAU_ID'=>$SWAHILI);
        			}elseif ($value == 0) {
        				$array_lang=array('LANGUE_ID'=>$value,'FONCTIONNAIRE_ID'=>$FONCTIONNAIRE_ID,'AUTRE_LANGUE'=>$AUTRE_LANGUE,'NIVEAU_ID'=>$AUTRE_NIVEAU_LANGUE);
        			}

        			$this->Model->create('mineduc_fonctionnaires_langues',$array_lang);

        		}
        	}

        	//TRAITEMENT MODELE HAVE_PHONE

        	
        	$MODELE_PHONE=NULL;
        	if (isset($DATA_JSON->identification_modele_tel)) {
        		$MODELE_PHONE=explode(" ", $DATA_JSON->identification_modele_tel);

        		foreach ($MODELE_PHONE as $key => $value) {
        			
        			$array_model=array('FONCTIONNAIRE_ID'=>$FONCTIONNAIRE_ID,'MODELE_TEL_ID'=>$value);

        			$this->Model->create('mineduc_modele_phone',$array_model);
        			
        		}
        	}
        	// FIN TRAITEMENT

        	$this->Model->update('json_fonctionnaire',array('ID'=>$JSON_ID),array('TRAITER'=>1));

		}
	}
}

?>