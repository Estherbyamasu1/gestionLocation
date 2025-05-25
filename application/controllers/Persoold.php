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

  function paiement_demande(){

    $this->load->view('perso/Paiement_Demande_View');
  }

  function liste_paiement(){


   $user=$this->session->userdata('LOCATAIRE_ID');
   $user_email=$this->session->userdata('LOCATAIRE_EMAIL');

   // print_r($user_email);die();
   
   $query_principal="SELECT paiement.ID_PAIEMENT,paiement.MONTANT as montant_paye,paiement.MODE_PAIEMENT,paiement.RESERVATION_ID,paiement.STATUT_PAIEMENT,paiement.DATE_PAIEMENT,reservation.MEUBLE_ID,reservation.ID_LOCATAIRE,meuble.NOM_MEUBLE,meuble.NUMERO_MEUBLE,locataire.NOM_LOCATAIRE,locataire.PRENOM_LOCATAIRE,locataire.TELEPHONE,locataire.EMAIL as locat_email,locataire.EMAIL,paiement.IMAGE_RECU FROM `paiement` JOIN reservation ON reservation.RESERVATION_ID=paiement.RESERVATION_ID LEFT JOIN meuble ON reservation.MEUBLE_ID=meuble.ID_MEUBLE LEFT JOIN locataire ON locataire.ID_LOCATAIRE=reservation.ID_LOCATAIRE WHERE locataire.EMAIL='".$user_email."'";

    $var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $limit='LIMIT 0,10';
    if($_POST['length'] != -1)
    {
      $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
    }

    
    $order_column='';

    $order_column = array('paiement.ID_PAIEMENT','paiement.MONTANT','meuble.ID_MEUBLE','meuble.NOM_MEUBLE','meuble.NUMERO_MEUBLE','locataire.NOM_LOCATAIRE','locataire.PRENOM_LOCATAIRE');

    $search = !empty($_POST['search']['value']) ?  (" AND (meuble.NOM_MEUBLE LIKE '%$var_search%' OR meuble.NUMERO_MEUBLE LIKE '%$var_search%' OR locataire.NOM_LOCATAIRE LIKE '%$var_search%' OR locataire.PRENOM_LOCATAIRE LIKE '%$var_search%' OR  paiement.MONTANT LIKE '%$var_search%')") :'';  

    $critaire = '';

    $order_by=' ORDER BY paiement.ID_PAIEMENT ASC';
    $query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;

    $query_filter = $query_principal.' '.$critaire.' '.$search.' '.$order_by;

    $fetch_cov_frais = $this->Model->datatable($query_secondaire);
    $data = array();
    $u=1;
    foreach($fetch_cov_frais as $info)
    {
            $statut="";
            if($info->STATUT_PAIEMENT==1){
            
               $statut="Payé";

            }elseif ($info->STATUT_PAIEMENT==2) {

              $statut="Non payé";
              # code...
            }


            $mode='';

            if($info->MODE_PAIEMENT==1){
              $mode='';
            }elseif($info->MODE_PAIEMENT==2){
              $mode='';
            }else{
               $mode='';
            }

      $post=array();
      $post[]=$u++;
      $post[]=$info->NOM_LOCATAIRE.' '.$info->PRENOM_LOCATAIRE;
      $post[]=$info->NOM_MEUBLE.'('.$info->NUMERO_MEUBLE.')';
      $post[]=$info->locat_email.'('.$info->TELEPHONE.')';
      $post[]=$info->montant_paye;
      $post[]=$mode;
      $post[]=$statut;
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
      
      $post[]= '
      <div class="dropdown">
      <button class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cog">
      </i><span class='."caret".'> Actions</span>
      </button>
      <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">

      <a href="'.base_url('appartement/Appartement/getOne/'.$info->ID_PAIEMENT).'" >Modifier</i></a><br>
      <a style="color:red" data-toggle="modal" href="#" data-target="#staticBackdrop'.$info->ID_PAIEMENT.'">Supprimer</a>
      </div>
      </div>
      <div class="modal fade" data-backdrop="static" id="staticBackdrop'.$info->ID_PAIEMENT.'">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-body">
      <center>
      <h5><strong>Voulez-vous supprimer ?<i style="color:green;"></i></strong><br> <b style="background-color:prink"></b>
      </h5>

      </center>
      </div>
      <div class="modal-footer">

      <a  style="color:red" href="'.base_url('appartement/Appartement/delete/'.$info->ID_PAIEMENT).'">supprimer</a>
      <button class="btn btn-secondary" data-dismiss="modal">
      Quitter
      </button>
      </div>
      </div>
      </div>
      </div>';


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


  function mesdemande(){


     $this->load->view('perso/MesDemande_View');
  }


  function liste_mesdemande(){

   
   $user=$this->session->userdata('LOCATAIRE_ID');
   $user_email=$this->session->userdata('LOCATAIRE_EMAIL');

   // print_r($user_email);die();
   
   $query_principal="SELECT reservation.*,locataire.*,users.*,meuble.*, locataire.EMAIL as locat_email FROM `reservation` JOIN meuble ON meuble.ID_MEUBLE=reservation.MEUBLE_ID JOIN users ON users.ID_USER=reservation.USER_ID JOIN locataire ON locataire.ID_LOCATAIRE=reservation.ID_LOCATAIRE WHERE locataire.EMAIL='".$user_email."'";

    $var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $limit='LIMIT 0,10';
    if($_POST['length'] != -1)
    {
      $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
    }

    
    $order_column='';

    $order_column = array('reservation.RESERVATION_ID','reservation.DATE_DEBUT','reservation.DATE_FIN','meuble.ID_MEUBLE','meuble.NOM_MEUBLE','meuble.NUMERO_MEUBLE','locataire.NOM_LOCATAIRE','locataire.PRENOM_LOCATAIRE');

    $search = !empty($_POST['search']['value']) ?  (" AND (meuble.NOM_MEUBLE LIKE '%$var_search%' OR meuble.NUMERO_MEUBLE LIKE '%$var_search%' OR locataire.NOM_LOCATAIRE LIKE '%$var_search%' OR locataire.PRENOM_LOCATAIRE LIKE '%$var_search%' OR  reservation.DATE_DEBUT LIKE '%$var_search%' OR  reservation.DATE_FIN LIKE '%$var_search%')") :'';  

    $critaire = '';

    $order_by=' ORDER BY reservation.RESERVATION_ID ASC';
    $query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;

    $query_filter = $query_principal.' '.$critaire.' '.$search.' '.$order_by;

    $fetch_cov_frais = $this->Model->datatable($query_secondaire);
    $data = array();
    $u=1;
    foreach($fetch_cov_frais as $info)
    {
            $statut="";
            if($info->STATUT_RESERVATION==1){
            
               $statut="En attente";

            }elseif ($info->STATUT_RESERVATION==2) {

              $statut="Validé";
              # code...
            }else{

              $statut="Refusé";
              # code...
            }



      $post=array();
      $post[]=$u++;
      $post[]=$info->NOM_LOCATAIRE.' '.$info->PRENOM_LOCATAIRE;
      $post[]=$info->NOM_MEUBLE.'('.$info->NUMERO_MEUBLE.')';
      $post[]=$info->locat_email.'('.$info->TELEPHONE.')';
      $post[]=$statut;
     
      
      $post[]= '
      <div class="dropdown">
      <button class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cog">
      </i><span class='."caret".'> Actions</span>
      </button>
      <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">

      <a href="'.base_url('appartement/Appartement/getOne/'.$info->RESERVATION_ID).'" >Modifier</i></a><br>
      <a style="color:red" data-toggle="modal" href="#" data-target="#staticBackdrop'.$info->RESERVATION_ID.'">Supprimer</a>
      </div>
      </div>
      <div class="modal fade" data-backdrop="static" id="staticBackdrop'.$info->RESERVATION_ID.'">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-body">
      <center>
      <h5><strong>Voulez-vous supprimer ?<i style="color:green;"></i></strong><br> <b style="background-color:prink"></b>
      </h5>

      </center>
      </div>
      <div class="modal-footer">

      <a  style="color:red" href="'.base_url('appartement/Appartement/delete/'.$info->RESERVATION_ID).'">supprimer</a>
      <button class="btn btn-secondary" data-dismiss="modal">
      Quitter
      </button>
      </div>
      </div>
      </div>
      </div>';


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

}

?>