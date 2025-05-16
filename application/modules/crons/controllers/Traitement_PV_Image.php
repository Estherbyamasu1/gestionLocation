<?php 

/**
 * christa@mediabox.bi
 * traitement des images des PV
 * 25/05/2023
 */
class Traitement_PV_Image extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function traiter_image()
	{
		$fiches=$this->Model->getRequete("SELECT * FROM `json_fiche_pv` WHERE `TRAITER_PHOTO`=0 LIMIT 10");

		foreach ($fiches as $key) {
			
			$DATA_JSON = $key['DATA_JSON'];
			$JSON_ID=$key['ID'];
        	$DATA_JSON = str_replace("/","_", $DATA_JSON);
        	$DATA_JSON = json_decode($DATA_JSON);


        	// echo"<pre>";
			// print_r($DATA_JSON); die();

			$PHOTO_CNI_VERSO = (isset($DATA_JSON->fiche_pv_cni_verso)) ? $DATA_JSON->fiche_pv_cni_verso : NULL ;
        	$PHOTO_CNI_RECTO = (isset($DATA_JSON->fiche_pv_cni_recto)) ? $DATA_JSON->fiche_pv_cni_recto : NULL ;
        	$PHOTO_PASSEPORT = (isset($DATA_JSON->fiche_pv_photo_passport)) ? $DATA_JSON->fiche_pv_photo_passport : NULL ;
        	$PHOTO_RAPPORT_AFFICHE = (isset($DATA_JSON->rapport_suivant_photo_affichage)) ? $DATA_JSON->rapport_suivant_photo_affichage : NULL ;


        	if (isset($DATA_JSON->photo_fiche)) {
        		// code...
        		$images_fiches=$DATA_JSON->photo_fiche;

        		$PHOTO=array();
        		foreach ($images_fiches as  $value) {
        			
        			$PHOTO[] = (isset($value->photo_fiche_photo)) ? $value->photo_fiche_photo : NULL ;

        		}
        	}


        	

        	if (isset($DATA_JSON->_attachments)) {
        		$images=$DATA_JSON->_attachments;

        		foreach ($images as $key) {

        			foreach ($PHOTO as $key_photo) {

        				if($key_photo !=NULL){
					    	$image_url = $key->download_medium_url;
					    	$image_url = str_replace("https:__kc.humanitarianresponse.info_media_medium", "https://kc.humanitarianresponse.info/media/medium", $image_url);
					    	file_put_contents(getcwd().'/uploads/photo_pv/'.$key_photo, file_get_contents($image_url));

					    }

        			}
        			//cni recto

        			if($PHOTO_CNI_RECTO !=NULL){
				    	$image_url = $key->download_medium_url;
				    	$image_url = str_replace("https:__kc.humanitarianresponse.info_media_medium", "https://kc.humanitarianresponse.info/media/medium", $image_url);
				    	file_put_contents(getcwd().'/uploads/photo_pv/'.$PHOTO_CNI_RECTO, file_get_contents($image_url));

				    }

				    if($PHOTO_CNI_VERSO !=NULL){
				    	$image_url = $key->download_medium_url;
				    	$image_url = str_replace("https:__kc.humanitarianresponse.info_media_medium", "https://kc.humanitarianresponse.info/media/medium", $image_url);
				    	file_put_contents(getcwd().'/uploads/photo_pv/'.$PHOTO_CNI_VERSO, file_get_contents($image_url));

				    }

				    if($PHOTO_PASSEPORT !=NULL){
				    	$image_url = $key->download_medium_url;
				    	$image_url = str_replace("https:__kc.humanitarianresponse.info_media_medium", "https://kc.humanitarianresponse.info/media/medium", $image_url);
				    	file_put_contents(getcwd().'/uploads/photo_pv/'.$PHOTO_PASSEPORT, file_get_contents($image_url));

				    }


				    if($PHOTO_RAPPORT_AFFICHE !=NULL){
				    	$image_url = $key->download_medium_url;
				    	$image_url = str_replace("https:__kc.humanitarianresponse.info_media_medium", "https://kc.humanitarianresponse.info/media/medium", $image_url);
				    	file_put_contents(getcwd().'/uploads/photo_pv/'.$PHOTO_RAPPORT_AFFICHE, file_get_contents($image_url));

				    }

        		}

        	}


        	$this->Model->update('json_fiche_pv',array('ID'=>$JSON_ID),array('TRAITER_PHOTO'=>1));

        }

	}
}


?>