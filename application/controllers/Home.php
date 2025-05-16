<?php

/**
 * @author Jules@mediabox.bi
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	
	// function __construct()
	// {
	// 	# code...
 //        parent::__construct();
 //        $this->load->model("My_model");
	// }
    //acceuil information
	public function index($value='')
	{
		# code...
		// $data=array('title'=>"Page d'acceuil - Commissariat Général des Migrations");
		// $data=array('title'=>"".$this->lang->line('ctl_home')." - ".$this->lang->line('apply_ctl_cgm')."");
		// $this->load->view('Home_View', $data);
		$data['appart']=$this->Model->getRequete('SELECT meuble.ID_MEUBLE,meuble.NOM_MEUBLE,meuble.NUMERO_MEUBLE,meuble.MONTANT,categorie_meuble.NOM_CATEGORIE,meuble.ADRESSE,meuble.IMAGE_MEUBLE,meuble.STATUT FROM `meuble` JOIN categorie_meuble ON categorie_meuble.ID_CATEGORIE=meuble.ID_CATEGORIE WHERE meuble.STATUT=1 order BY meuble.NUMERO_MEUBLE ASC');

		$this->load->view('Home_View',$data);
	}
	
		}

// 	function image_scrop($id, $chmps_image)
// 	{
		
// 		// $id = 184;
// 		//$chmps_image = "path_photo_passport";
		
// 		if (!empty($id) && !empty($chmps_image)) {
            
//             $pathss =$this->Model->getRequeteOne("SELECT ".$chmps_image." as paths,etape_id,categorie_visa FROM `requests` WHERE  `id` =".$id);
           
// 			$data=array();
// 			$data['titre']= 'Editeur image';
// 			$data['id'] = $id;
// 			$data['etape_action'] = $pathss['etape_id'];

// 			$action_by_tasksql='SELECT pa.etape_action_id,pa.etape_suivante,pa.type_action_id,pa.etape_id,ta.desc_type_action,pa.tache FROM process_etape_etape_action pa JOIN type_action ta ON ta.type_action_id=pa.type_action_id JOIN process_etape_etape etap on etap.etape_id=pa.etape_id WHERE 1 AND pa.etape_id='.$pathss['etape_id'].' ORDER BY ta.desc_type_action ASC';

// 			$action_one_task=$this->Model->getRequeteOne($action_by_tasksql);


// 			// if(in_array($pathss['categorie_visa'],array(1))){
// 			// $data['url'] = base_url().'visa_etablissement/Visa_Etablissement/faire_tache/'.$id.'/'.$action_one_task['etape_action_id'];
// 			// }
			
// 			// if(in_array($pathss['categorie_visa'],array(2,3,4,6))){
// 			// 	$data['url'] = base_url().'demande_rdv_Visa/Demande_rdv_Visa/faire_tache/'.$id.'/'.$action_one_task['etape_action_id'];

// 			// }

// 			if(in_array($pathss['categorie_visa'],array(1))){
// 				$data['url'] = base_url().'visa_etablissement/Visa_Etablissement/index/'.$pathss['categorie_visa'];
// 			}
				
// 			if(in_array($pathss['categorie_visa'],array(2,3,4,6))){
// 					$data['url'] = base_url().'demande_rdv_visa/Demande_rdv_Visa/index/'.$pathss['categorie_visa'];
	
// 			}


//             $data['chmps_image_non']='path_photo_passport';
// 			$data['chmps_image']= base_url().'storage/visa_apply_upload/'.$pathss['paths'];
            
//              //print_r($pathss['paths']);
// 			// exit();
// 		    $this->load->view('image_scrole', $data);
// 		}else{
// 			redirect(base_url());
// 		}
		
// 	}


// 	function upload_image($data = array()){

// 		// $flux = file_get_contents('php://input');
// 		// $donne = json_decode($)

// 		$id_requerant = $this->input->post('id_requerant');
//         $uri_data = $this->input->post('uri_data');
//         $chmps_image_non = $this->input->post('chmps_image_non');
        

//         if (!empty($id_requerant)) {
//         	# code...
      
// 	        $year = date('Y');

// 	        $dir = FCPATH.'storage/visa_apply_upload/' . $year . '/'. $id_requerant . '/';
// 			if (!is_dir(FCPATH . 'storage/visa_apply_upload/' . $year . '/'. $id_requerant . '/')) {
// 				mkdir(FCPATH . 'storage/visa_apply_upload/' . $year . '/'. $id_requerant . '/', 0777, TRUE);
// 			}

// 			$photonames = 'New_'.date('ymdHisa').uniqid();
// 			$pathfile =  $year . '/'. $id_requerant . '/' . $photonames .".png";
// 			$pathfilexx = FCPATH . 'storage/visa_apply_upload/' . $year . '/'. $id_requerant . '/' . $photonames .".png";

// 	        $key = $uri_data; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
// 	        $img = str_replace('data:image/png;base64,', '', $uri_data);
// 	        $img = str_replace(' ', '+', $img);
// 	        $img = str_replace('[removed]', '', $img);

// 	        $datas = base64_decode($img);
// 	        $statu = file_put_contents($pathfilexx, $datas);

// 	        $this->Model->update('requests', array('id'=>$id_requerant), array($chmps_image_non=>$pathfile));
        
//             print_r($statu);

//         }


//     }



//              public function add_message_internaute()
// 			{
// 			  $this->db->set('id_type_plainte', $this->input->post('id_type_plainte'));
// 			  $this->db->set('numero_bureau', $this->input->post('numero_bureau'));
// 			  $this->db->set('message', $this->input->post('message'));
// 			  $this->db->set('telephone_internaute', $this->input->post('telephone_internaute'));
// 			  $this->db->set('email_internaute', $this->input->post('email_internaute'));
// 			  $this->db->set('internaute', 'Internaute');   
// 			  $this->db->set('statut', 1); 
		  
		  
// 			  $this->db->insert('plainte');
// 			  $id_plainte = $this->db->insert_id();
// 			  if(!empty($id_plainte)){
// 				$this->db->set('id_plainte', $id_plainte);
// 				$this->db->set('mbr_id',0);
// 				$this->db->set('statut', 1);
// 				$this->db->insert('plainte_historique');

// 				echo json_encode(array('statut'=>1));
// 			  }
		  
// 			//   redirect(base_url('Home'));
// 			}
// 			function image_prise_scrop($id ,$statut_id, $chmps_image,$id_menu)
// 			{
				
// 				// $id = 184;
// 				//$chmps_image = "path_photo_passport";
				
// 				if (!empty($id) && !empty($chmps_image)) {
		
// 					// print($id.'-'.$chmps_image.'-'.$id_menu.'-'.$statut_id); exit();
					
// 					$pathss =$this->Model->getRequeteOne("SELECT ".$chmps_image." as paths,statut_id,type_document_voyage_id FROM `doc_document` WHERE  `id` =".$id);
		
// 					// print("SELECT ".$chmps_image." as paths,statut_id,type_document_voyage_id FROM `doc_document` WHERE  `id` =".$id); exit();
					
				   
// 					$data=array();
// 					$data['titre']= 'Editeur image';
// 					$data['id'] = $id;
// 					$data['statut_id'] = $pathss['statut_id'];
// 					$data['id_menu'] = $id_menu;
		
// 					$data['type_doc'] = $pathss['type_document_voyage_id'];
		
			
// 				   $data['url'] = base_url().'documents/Documents_Last/detail_file_attente/'.$id.'/'.$statut_id.'/'.$pathss['type_document_voyage_id'].'/'.$id_menu;
			
					
		
// 					$data['chmps_image_non']='Image_cpgel';
// 					$data['chmps_image']= base_url().'uploads/cameraImageRequerant/'.$pathss['paths'];
					
					
// 					$this->load->view('image_scrole_prise', $data);
// 				}else{
// 					redirect(base_url());
// 				}
				
// 			}
		
// 			function upload_image_prise($data = array()){
		
// 				// $flux = file_get_contents('php://input');
// 				// $donne = json_decode($)
		
// 				$id_requerant = $this->input->post('id_requerant');
// 				$uri_data = $this->input->post('uri_data');
// 				$chmps_image_non = $this->input->post('chmps_image_non');
// 				$id_menu = $this->input->post('id_menu');
// 				$type_doc = $this->input->post('type_doc');
				
				
		
// 				if (!empty($id_requerant)) {
// 					# code...
			  
// 					$year = date('Y');
		
// 					$dir = FCPATH.'uploads/cameraImageRequerant/';
// 					if (!is_dir(FCPATH . 'uploads/cameraImageRequerant/' )) {
// 						mkdir(FCPATH . '/uploads/cameraImageRequerant/', 0777, TRUE);
// 					}
		
// 					$photonames = 'New_'.date('ymdHisa').uniqid();
// 					$pathfile =   $photonames . ".png";
// 					$pathfilexx = FCPATH . '/uploads/cameraImageRequerant/' . $photonames .".png";
		
// 					$key = $uri_data; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
// 					$img = str_replace('data:image/png;base64,', '', $uri_data);
// 					$img = str_replace(' ', '+', $img);
// 					$img = str_replace('[removed]', '', $img);
		
// 					$datas = base64_decode($img);
// 					$statu = file_put_contents($pathfilexx, $datas);
		
// 					$this->Model->update('doc_document', array('id'=>$id_requerant), array($chmps_image_non=>$pathfile));
				
// 					print_r($statu);
// 					// echo json_encode(['type_doc'=>$type_doc,'id_menu'=>$id_menu]);
		
		
// 				}
		
		
// 			}
		

// }

?>