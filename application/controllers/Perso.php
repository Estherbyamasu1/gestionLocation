<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Perso extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    $this->load->helper('form');
    $this->load->library('table');
    $this->load->library('form_validation');
    $this->is_auth();
  }

  public function is_auth()
  {
    if (empty($this->session->userdata('LOCATAIRE_ID'))) {
      redirect(base_url('Login_Front'));
    }
  }

  public function index($visa = '')
  {


    $this->load->view('perso/Liste_Demande_View');
  }

  function paiement_demande()
  {

    $this->load->view('perso/Paiement_Demande_View');
  }

  function liste_paiement()
  {


    $user = $this->session->userdata('LOCATAIRE_ID');
    $user_email = $this->session->userdata('LOCATAIRE_EMAIL');

    // print_r($user_email);die();

    $query_principal = "SELECT paiement.ID_PAIEMENT,paiement.MONTANT as montant_paye,paiement.MODE_PAIEMENT,paiement.RESERVATION_ID,paiement.STATUT_PAIEMENT,paiement.DATE_PAIEMENT,reservation.MEUBLE_ID,reservation.ID_LOCATAIRE,meuble.NOM_MEUBLE,meuble.NUMERO_MEUBLE,locataire.NOM_LOCATAIRE,locataire.PRENOM_LOCATAIRE,locataire.TELEPHONE,locataire.EMAIL as locat_email,locataire.EMAIL,paiement.IMAGE_RECU FROM `paiement` JOIN reservation ON reservation.RESERVATION_ID=paiement.RESERVATION_ID LEFT JOIN meuble ON reservation.MEUBLE_ID=meuble.ID_MEUBLE LEFT JOIN locataire ON locataire.ID_LOCATAIRE=reservation.ID_LOCATAIRE WHERE locataire.EMAIL='" . $user_email . "'";

    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $limit = 'LIMIT 0,10';
    if ($_POST['length'] != -1) {
      $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
    }


    $order_column = '';

    $order_column = array('paiement.ID_PAIEMENT', 'paiement.MONTANT', 'meuble.ID_MEUBLE', 'meuble.NOM_MEUBLE', 'meuble.NUMERO_MEUBLE', 'locataire.NOM_LOCATAIRE', 'locataire.PRENOM_LOCATAIRE');

    $search = !empty($_POST['search']['value']) ?  (" AND (meuble.NOM_MEUBLE LIKE '%$var_search%' OR meuble.NUMERO_MEUBLE LIKE '%$var_search%' OR locataire.NOM_LOCATAIRE LIKE '%$var_search%' OR locataire.PRENOM_LOCATAIRE LIKE '%$var_search%' OR  paiement.MONTANT LIKE '%$var_search%')") : '';

    $critaire = '';

    $order_by = ' ORDER BY paiement.ID_PAIEMENT ASC';
    $query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $order_by . '   ' . $limit;

    $query_filter = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $order_by;

    $fetch_cov_frais = $this->Model->datatable($query_secondaire);
    $data = array();
    $u = 1;
    foreach ($fetch_cov_frais as $info) {
      $statut = "";
      if ($info->STATUT_PAIEMENT == 1) {

        $statut = "Payé";
      } elseif ($info->STATUT_PAIEMENT == 2) {

        $statut = "Non payé";
        # code...
      }


      $mode = '';

      if ($info->MODE_PAIEMENT == 1) {
        $mode = '';
      } elseif ($info->MODE_PAIEMENT == 2) {
        $mode = '';
      } else {
        $mode = '';
      }

      $post = array();
      $post[] = $u++;
      $post[] = $info->NOM_LOCATAIRE . ' ' . $info->PRENOM_LOCATAIRE;
      $post[] = $info->NOM_MEUBLE . '(' . $info->NUMERO_MEUBLE . ')';
      $post[] = $info->locat_email . '(' . $info->TELEPHONE . ')';
      $post[] = $info->montant_paye;
      $post[] = $mode;
      $post[] = $statut;
      // $post[]='<div class="col-md-12"><embed src="' . base_url('uploads/doc_meuble/' . $info->IMAGE_MEUBLE) . '" type="application/pdf"   scrolling="auto" height="30px" width="20%"></div>';

     

      $post[] = '<a  data-toggle="modal" data-target="#path_document' . $info->ID_PAIEMENT . '" class="btn btn-default btn-sm"><span style="font-size:20px;" class="fa ' . (strtolower(substr($info->IMAGE_RECU, -4)) === '.pdf' ? "fa-file-pdf-o" : "fa-image") . '"></span></a>

   <div class="modal fade" id="path_document' . $info->ID_PAIEMENT  . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
   <div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel"><b></b></h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
   </div>
   <div class="modal-body">
   <div class="col-md-12"><embed src="' . base_url('uploads/doc_meuble/' . $info->IMAGE_RECU) . '" type="application/pdf"   scrolling="auto" height="400px" width="100%"></div>

   </div>

   </div>
   </div>
   </div>';

      // $post[] = '
      //                   <div class="dropdown">
      //                   <button class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cog">
      //                   </i><span class=' . "caret" . '> Actions</span>
      //                   </button>
      //                   <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">

      //                   <a href="' . base_url('appartement/Appartement/getOne/' . $info->ID_PAIEMENT) . '" >Modifier</i></a><br>
      //                   <a style="color:red" data-toggle="modal" href="#" data-target="#staticBackdrop' . $info->ID_PAIEMENT . '">Supprimer</a>
      //                   </div>
      //                   </div>
      //                   <div class="modal fade" data-backdrop="static" id="staticBackdrop' . $info->ID_PAIEMENT . '">
      //                   <div class="modal-dialog">
      //                   <div class="modal-content">
      //                   <div class="modal-body">
      //                   <center>
      //                   <h5><strong>Voulez-vous supprimer ?<i style="color:green;"></i></strong><br> <b style="background-color:prink"></b>
      //                   </h5>

      //                   </center>
      //                   </div>
      //                   <div class="modal-footer">

      //                   <a  style="color:red" href="' . base_url('appartement/Appartement/delete/' . $info->ID_PAIEMENT) . '">supprimer</a>
      //                   <button class="btn btn-secondary" data-dismiss="modal">
      //                   Quitter
      //                   </button>
      //                   </div>
      //                   </div>
      //                   </div>
      //                   </div>';


      $data[] = $post;
    }

    $output = array(
      "draw" => intval($_POST['draw']),
      "recordsTotal" => $this->Model->all_data($query_principal),
      "recordsFiltered" => $this->Model->filtrer($query_filter),
      "data" => $data
    );
    echo json_encode($output);
  }


  function mesdemande()
  {


    $this->load->view('perso/MesDemande_View');
  }


  function liste_mesdemande()
  {


    $user = $this->session->userdata('LOCATAIRE_ID');
    $user_email = $this->session->userdata('LOCATAIRE_EMAIL');

    // print_r($user_email);die();

    $query_principal = "SELECT reservation.*,locataire.*,users.*,meuble.*, locataire.EMAIL as locat_email,locataire.TELEPHONE AS loc_tel FROM `reservation` JOIN meuble ON meuble.ID_MEUBLE=reservation.MEUBLE_ID LEFT JOIN users ON users.ID_USER=reservation.USER_ID JOIN locataire ON locataire.ID_LOCATAIRE=reservation.ID_LOCATAIRE WHERE locataire.EMAIL='" . $user_email . "'";

    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $limit = 'LIMIT 0,10';
    if ($_POST['length'] != -1) {
      $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
    }


    $order_column = '';

    $order_column = array('reservation.RESERVATION_ID', 'reservation.DATE_DEBUT', 'reservation.DATE_FIN', 'meuble.ID_MEUBLE', 'meuble.NOM_MEUBLE', 'meuble.NUMERO_MEUBLE', 'locataire.NOM_LOCATAIRE', 'locataire.PRENOM_LOCATAIRE');

    $search = !empty($_POST['search']['value']) ?  (" AND (meuble.NOM_MEUBLE LIKE '%$var_search%' OR meuble.NUMERO_MEUBLE LIKE '%$var_search%' OR locataire.NOM_LOCATAIRE LIKE '%$var_search%' OR locataire.PRENOM_LOCATAIRE LIKE '%$var_search%' OR  reservation.DATE_DEBUT LIKE '%$var_search%' OR  reservation.DATE_FIN LIKE '%$var_search%')") : '';

    $critaire = '';

    $order_by = ' ORDER BY reservation.RESERVATION_ID ASC';
    $query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $order_by . '   ' . $limit;

    $query_filter = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $order_by;

    $fetch_cov_frais = $this->Model->datatable($query_secondaire);
    $data = array();
    $u = 1;
    foreach ($fetch_cov_frais as $info) {
      $statut = "";
      if ($info->STATUT_RESERVATION == 1) {

        $statut = "En attente";
      } elseif ($info->STATUT_RESERVATION == 2) {

        $statut = "Validé";
        # code...
      } else {

        $statut = "Refusé";
        # code...
      }



      $post = array();
      $post[] = $u++;
      $post[] = $info->NOM_LOCATAIRE . ' ' . $info->PRENOM_LOCATAIRE;
      $post[] = $info->NOM_MEUBLE . '(' . $info->NUMERO_MEUBLE . ')';
      $post[] = $info->locat_email . '(' . $info->loc_tel . ')';
      $post[] = $statut;

      if($statut==4){

        $post[] = '
        
        <div class="dropdown">
        <button class="btn btn-dark btn-sm " > <i class="fa fa-cog">
        </i><span class=' . "caret" . '><a href="' . base_url('Perso/Faire_paiement?ID_RESERVATION=' . $info->RESERVATION_ID) . '" >Payer</i></a><br></span>
        </button>
        
        </div>';


      }else{
        $post[] = '---';
        
      }
      


      $data[] = $post;
    }

    $output = array(
      "draw" => intval($_POST['draw']),
      "recordsTotal" => $this->Model->all_data($query_principal),
      "recordsFiltered" => $this->Model->filtrer($query_filter),
      "data" => $data
    );
    echo json_encode($output);
  }
  function Faire_paiement()
  {

    $ID_RESERVATION = trim(htmlspecialchars($this->input->get('ID_RESERVATION')));

    if (isset($ID_RESERVATION) and $ID_RESERVATION != "") {
      $getReservation = $this->Model->datatable('SELECT * FROM `reservation` JOIN meuble as meu ON meu.ID_MEUBLE=`MEUBLE_ID`AND `RESERVATION_ID`=' . $ID_RESERVATION . '');
      $data['mesresvations'] = $getReservation[0];
    } else {
      $user = $this->session->userdata('LOCATAIRE_ID');
      $getReservation = $this->Model->datatable('SELECT * FROM `reservation` JOIN meuble as meu ON meu.ID_MEUBLE=MEUBLE_ID AND USER_ID=' . $user . '');
      $data['mesresvationsdata'] = $getReservation;
    }


    $gettype = $this->Model->datatable("SELECT `ID_TYPE_PAIEMENT`,`DESC_TYPE_PAIEMENT` FROM `type_paiement`");

    if (isset($gettype)) {
      $data['liste'] = $gettype;
    }

    $this->load->view('perso/Faire_demande', $data);
  }
  function uploadFiledata($myfile)
  {

    $imageFile =$myfile;
    $imageName = null;

    if (isset($imageFile) && $imageFile['error'] === UPLOAD_ERR_OK) {
      $fileExtension = pathinfo($imageFile['name'], PATHINFO_EXTENSION);
      $newName = uniqid('image_', true) . '.' . $fileExtension;
      $uploadPath = './uploads/doc_meuble/';
      if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
      }
      if (move_uploaded_file($imageFile['tmp_name'], $uploadPath . $newName)) {
        $imageName = base_url() . 'uploads/doc_meuble/' . $newName;
      } else {
       return "Error moving uploaded file.";
     }
   } else {
      // Handle upload errors
    switch ($imageFile['error']) {
      case UPLOAD_ERR_INI_SIZE:
      case UPLOAD_ERR_FORM_SIZE:
      echo "Uploaded file exceeds maximum file size.";
      break;
      case UPLOAD_ERR_PARTIAL:
      echo "File was only partially uploaded.";
      break;
      case UPLOAD_ERR_NO_FILE:
      echo "No file was uploaded.";
      break;
      case UPLOAD_ERR_NO_TMP_DIR:
      echo "Missing a temporary folder.";
      break;
      case UPLOAD_ERR_CANT_WRITE:
      echo "Failed to write file to disk.";
      break;
      case UPLOAD_ERR_EXTENSION:
      echo "A PHP extension stopped the file upload.";
      break;
      default:
      echo "Unknown upload error.";
      break;
    }
  }

  if ($imageName) {
    return $imageName;
  }else{
    return 'vide';
  }
}
function Add_paiement()
{

  $ID_RESERVATION = trim(htmlspecialchars($this->input->post('ID_RESERVATION')));
  $MONTANT = trim(htmlspecialchars($this->input->post('MONTANT')));
  $MODE_PAIEMENT = trim(htmlspecialchars($this->input->post('MODE_PAIEMENT')));
  $CODE_PAIEMENT = trim(htmlspecialchars($this->input->post('CODE_PAIEMENT')));
  $TELEPHONE=trim(htmlspecialchars($this->input->post('TELEPHONE')));

  // $IMAGE_RECU =$this->uploadFiledata($_FILES['IMAGE_RECU']);


$photoreperatoire =FCPATH.'/uploads/doc_meuble';
 $photo_avatar="DOC-".date('Ymdi').uniqid();
         // print_r($_FILES);die();
 $IMAGE_RECU= $_FILES['IMAGE_RECU']['name'];

 $config['upload_path'] ='./uploads/doc_meuble/';
 $config['allowed_types'] = '*';
 $test = explode('.', $IMAGE_RECU);
 $ext = end($test);
 $name = $photo_avatar.'.'.$ext;
 $config['file_name'] =$name;
        if(!is_dir($photoreperatoire)) //create the folder if it does not already exists   
        {
          mkdir($photoreperatoire,0777,TRUE);

        } 

        $this->upload->initialize($config);
        $this->upload->do_upload('IMAGE_RECU');

        if (!empty($_FILES['IMAGE_RECU']['name'])) {
          # code...
          $IMAGE_RECU=$config['file_name'];
          $data_image=$this->upload->data();
        }else{

          $IMAGE_RECU=NULL;
        }




// $IMAGE_RECU_ESCAPED = $this->db->escape($IMAGE_RECU); // This adds quotes and escapes special characters

$entre = 'INSERT INTO `paiement`(`MONTANT`, `ID_TYPE_PAIEMENT`, `RESERVATION_ID`, `IMAGE_RECU`, `TELEPHONE`) VALUES ('
. $MONTANT . ','
. $MODE_PAIEMENT . ','
. $ID_RESERVATION . ','
. $TELEPHONE . ','
    . $IMAGE_RECU . // <--- THIS IS THE FIX: VALUE IS QUOTED AND ESCAPED
    ')';

// $gettype = $this->Model->datatable($entre);
    $gettype = $this->Model->create('paiement', array(
      'MONTANT' => $MONTANT,
      'ID_TYPE_PAIEMENT' => $MODE_PAIEMENT,
      'RESERVATION_ID' => $ID_RESERVATION,
      'CODE_PAIEMENT'=>$CODE_PAIEMENT,
      'TELEPHONE'=>$TELEPHONE,
      'IMAGE_RECU' => $IMAGE_RECU,'STATUT_PAIEMENT'=>1));

    if (isset($gettype)) {
      return redirect(base_url('Perso/paiement_demande'));
    }
  }


  function Faire_reservation(){


    $data['meuble'] = $this->Model->getRequete('SELECT * FROM `meuble` WHERE `STATUT`=1 order BY NOM_MEUBLE ASC');

    $this->load->view('perso/Faire_Reservation',$data);

  }

  function Add_reservation(){

    $locataire = $this->session->userdata('LOCATAIRE_ID');
    $user_email = $this->session->userdata('LOCATAIRE_EMAIL');

    $ID_MEUBLE = $this->input->post('ID_MEUBLE');
    $DATE_DEBUT = $this->input->post('DATE_DEBUT');
    $DATE_FIN = $this->input->post('DATE_FIN');

    $this->form_validation->set_rules('ID_MEUBLE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
    $this->form_validation->set_rules('DATE_DEBUT', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
    $this->form_validation->set_rules('DATE_FIN', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

    if ($this->form_validation->run() == FALSE) {
      $this->Faire_reservation();
    } else {
      
      $check=$this->Model->getOne('meuble',array('STATUT'=>1));
      

      if(!empty($check)){

       $this->Model->create('reservation', array('ID_LOCATAIRE' => $locataire,'MEUBLE_ID' => $ID_MEUBLE,'DATE_DEBUT' => $DATE_DEBUT,'DATE_FIN' => $DATE_FIN,'STATUT_RESERVATION' => 1));

       $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Enregistrement effectuée avec succès!!" . '</div>';
       $this->session->set_flashdata($data);
       redirect(base_url('Perso'));

     }else{
       $data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Aucune appartement n'est disponible!!" . '</div>';
       $this->session->set_flashdata($data);
       redirect(base_url('Perso/Faire_reservation'));
     }

   }



 }


 public function changePasswod($value = '')
 {
  $this->load->view('Change_passwod_view');
}



public function nouveauPassword($value = '')
{
  $password = $this->input->post('ANCIEN_PASSWORD');
  $locataire = $this->session->userdata('LOCATAIRE_ID');
    // print_r($password);die();

  $verification = $this->Model->getOne('locataire', array('ID_LOCATAIRE'=>$locataire,'PASSWORD' => md5($password)));


  $password = $this->input->post('ANCIEN_PASSWORD');
  $npassword = $this->input->post('NEW_PASSWORD');
  $cnfpassword = $this->input->post('CONFIRMER_PASSWORD');

  if (!empty($verification)) {

    if ($verification['PASSWORD'] == md5($password)) {
      //  if ($verification['password'] == $password) {

      if ($npassword == $cnfpassword) {
        $sql = $this->Model->update('locataire', array('ID_LOCATAIRE' => $verification['ID_LOCATAIRE']), array('PASSWORD' => md5($cnfpassword)));

        $to = $adresse_email;
          // $to='njeanprosper@gmail.com';
        $subject = 'Changement  de mot de passe';
        $message = 'Bonjour<br>Votre  mot de passe a été faite avec succès.<br>Votre nouveau mot de passe
        <strong style="color:red;">'
        . $cnfpassword . ' </strong><br>Merci cordialement<br>';

          // $this->mbx_library->send_mail($to, $subject, $cc_emails = NULL, $message, $attach = NULL);

        $data['message'] = "<div class='alert alert-danger text-center'> Consultez votre adresse e-mail !.</div>";
        session_destroy();

        $this->session->unset_userdata($session);
        $this->session->set_flashdata($data);
        redirect(base_url('Login_Front'));
      } else {

        $data['message'] = "<div style='float:inherit;' class='col-md-8 alert alert-danger text-center'>Les mot de passe ne sont pas identiques</div>";
        $this->session->set_flashdata($data);
        redirect(base_url('Perso/changePasswod'));
      }
    } else {

      $data['message'] = "<div style='float:inherit;' class='col-md-8 alert alert-danger text-center'>l'ancien mot de passe est incorrect/div>";
      $this->session->set_flashdata($data);
      redirect(base_url('Perso/changePasswod'));
    }
  } else {

    $data['message'] = "<div style='float:inherit;' class='col-md-8 alert alert-danger text-center'>l'ancien mot de passe est n'existe pas.</div>";
    $this->session->set_flashdata($data);
    redirect(base_url('Perso/changePasswod'));
  }
}


}
