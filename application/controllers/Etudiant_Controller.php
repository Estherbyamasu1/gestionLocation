<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etudiant_Controller extends CI_Controller {
  
public function index()
  {     //recuperation de genre,faculte,grade,
   //Categories
    $psgetrequete = "CALL `getRequete`(?,?,?,?);";
    $bindparams = $this->getBindParms('`ID_CATEGORIE`, `CATEGORIE`', 'Categorie', '1', '`CATEGORIE` ASC');
    $Categories = $this->ModelPs->getRequete($psgetrequete, $bindparams);
        // $data['collines']=$this->ModelPs->getRequete($psgetrequete, $bindparams);
        // print_r($collines);
        // exit();


              //Grade
    $psgetrequete = "CALL `getRequete`(?,?,?,?);";
    $bindparams = $this->getBindParms('`ID_GRADE`, `GRADE`', 'grade', '1', '`GRADE` ASC');
    $grades = $this->ModelPs->getRequete($psgetrequete, $bindparams);
        // $data['collines']=$this->ModelPs->getRequete($psgetrequete, $bindparams);
        // print_r($collines);
        // exit();



              //faculte
    $psgetrequete = "CALL `getRequete`(?,?,?,?);";
    $bindparams = $this->getBindParms('`ID_FACULTE`, `FACULTE`', 'faculte', '1', '`FACULTE` ASC');
    $facultes = $this->ModelPs->getRequete($psgetrequete, $bindparams);
        // $data['collines']=$this->ModelPs->getRequete($psgetrequete, $bindparams);
        // print_r($collines);
        // exit();

         #####################################################
          //sexes
    $bindparams=$this->getBindParms('*','genre','1','GENRE ASC');
    $sexe = $this->ModelPs->getRequete($psgetrequete, $bindparams);

    $data = array('Categorie' => $Categories, 'grade' => $grades,'genre' => $sexe,'faculte' => $facultes);
    $this->load->view('Etudiant_View',$data);
        ######################################################
  }

    public function getBindParms($columnselect, $table, $where, $orderby)
  {
        // code...
    $bindparams = array(
     'columnselect' => mysqli_real_escape_string($this->db->conn_id,$columnselect),
     'table' => mysqli_real_escape_string($this->db->conn_id,$table) ,
     'where' => str_replace("\'", "'", $where),
     'orderby' => mysqli_real_escape_string($this->db->conn_id,$orderby));
    return $bindparams;
  }


 function listing()
  {
    $query_principal="SELECT etudiant.ID_ET,etudiant.NOM_ET,etudiant.PRENOM_ET,etudiant.EMAIL_ET,etudiant.TELEPHONE_ET,etudiant.PHOTO_ET,etudiant.MATRICULE_ET,etudiant.PHOTO_URL_ET,etudiant.PASSWORD_ET,genre.GENRE,grade.GRADE,categorie.CATEGORIE,faculte.FACULTE FROM etudiant JOIN genre ON genre.ID_GENRE =etudiant.ID_GENRE JOIN faculte ON faculte.ID_FACULTE=etudiant.ID_FACULTE JOIN grade ON grade.ID_GRADE = etudiant.ID_GRADE JOIN categorie ON categorie.ID_CATEGORIE = etudiant.ID_CATEGORIE WHERE 1";

    $var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $limit='LIMIT 0,10';
    if($_POST['length'] != -1)
    {
      $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
    }

    
    $order_column='';

    $order_column = array('etudiant.ID_ET','etudiant.NOM_ET','etudiant.PRENOM_ET');

    $search = !empty($_POST['search']['value']) ?  (" AND (etudiant.NOM_ET LIKE '%$var_search%' OR etudiant.PRENOM_ET LIKE '%$var_search%' OR faculte.FACULTE LIKE '%$var_search%' OR etudiant.EMAIL_ET LIKE '%$var_search%')") :'';  

    $critaire = '';

    $order_by=' ORDER BY NOM_ET ASC';
    $query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;

    $query_filter = $query_principal.' '.$critaire.' '.$search.' '.$order_by;

    $fetch_cov_frais = $this->Model->datatable($query_secondaire);
    $data = array();
    $u=1;
    foreach($fetch_cov_frais as $info)
    {
      $post=array();
      $post[]=$u++; 
      $post[]=$info->NOM_ET;
      $post[]=$info->PRENOM_ET;
      $post[]=$info->TELEPHONE_ET;
      $post[]=$info->EMAIL_ET;
          $post[]=$info->FACULTE;
          $post[]=$info->GENRE;
          $post[]=$info->CATEGORIE;
          $post[]=$info->GRADE;
          $post[]=$info->PHOTO_URL_ET;
      $post[]= '
      <div class="dropdown">
      <button class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cog">
      </i><span class='."caret".'> Actions</span>
      </button>
      <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">

      <a href="'.base_url('matrice/Users/getOne/'.$info->ID_ET).'" >Modifier</i></a><br>
      <a style="color:red" data-toggle="modal" href="#" data-target="#staticBackdrop'.$info->ID_ET.'">Supprimer</a>
      </div>
      </div>
      <div class="modal fade" data-backdrop="static" id="staticBackdrop'.$info->ID_ET.'">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-body">
      <center>
      <h5><strong>Voulez-vous supprimer ?<i style="color:green;"></i></strong><br> <b style="background-color:prink"></b>
      </h5>

      </center>
      </div>
      <div class="modal-footer">

      <a  style="color:red" href="'.base_url('matrice/Users/delete/'.$info->ID_ET).'">supprimer</a>
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
