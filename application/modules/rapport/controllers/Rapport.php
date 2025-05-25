<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
 ####tableau de bord pour le paiement
 #### fait par emery@mediabox.bi

class Rapport extends CI_Controller {

   function __construct()
    {  
        
        parent::__construct(); 
        $this->is_auth(); 
        $this->load->model('Model');
    }

    public function is_auth()
    {
        if (empty($this->session->userdata('USER_ID'))) {
          redirect(base_url('Login'));
      }
  }
public function index(){



    ###rapport des documents payes pour demande de visa

 $meuble_statut=$this->Model->getRequete("SELECT COUNT(`STATUT`) as NBRE,(CASE WHEN meuble.STATUT =1 THEN 'Disponible' ELSE 'Reserve' END) stat, meuble.ID_MEUBLE,meuble.NOM_MEUBLE,meuble.MONTANT FROM `meuble`  WHERE 1 GROUP BY stat");

 $meuble_categorie=$this->Model->getRequete("SELECT COUNT(categorie_meuble.`ID_CATEGORIE`) as NBR,meuble.ID_MEUBLE,meuble.NOM_MEUBLE,meuble.MONTANT,categorie_meuble.NOM_CATEGORIE FROM `meuble` JOIN statut_reservation ON statut_reservation.ID_STATUT_RESERVATION=meuble.STATUT JOIN categorie_meuble ON categorie_meuble.ID_CATEGORIE=meuble.ID_CATEGORIE WHERE 1 GROUP BY categorie_meuble.NOM_CATEGORIE");

 $reservation_par_statut = $this->Model->getRequete("
    SELECT COUNT(r.STATUT_RESERVATION) AS NBR, 
           r.STATUT_RESERVATION,
           s.DESC_STATUT_RESERVATION
    FROM reservation r 
    JOIN statut_reservation s ON s.ID_STATUT_RESERVATION = r.STATUT_RESERVATION
    GROUP BY r.STATUT_RESERVATION
");
    
    #### declaration des variables

  $categories="";
  $categorie_paye="";
  $categorie_non_paye="";

  $total_meuble=0;
  $total_cat=0;
 foreach ($meuble_statut as $key) {
    $categories.="'";
    if($key['ID_MEUBLE']==''){
      $name=str_replace("'", "",$key['stat']);
      $categorie_paye.="{y:".$key['NBRE'].",color:'green',name:'".$name."',key2:5,key:".$key['ID_MEUBLE']."},";
     $label1=$key['stat'];
            }else{
        $visa=str_replace("'", "", $key['stat']);
        $visa1=str_replace("\n", "\'", $visa);
        $categories.=$visa1."',";
        $categorie_paye.="{y:".$key['NBRE'].",color:'green',name:'".$visa1."',key2:5,key:".$key['ID_MEUBLE']."},";
              }
         $total_meuble=$total_meuble+$key['NBRE'];

            }
$labe='';
           ####negatif
foreach ($meuble_categorie as $key) {
            ##code...
     $categories.="'";
     $visa=str_replace("'", "", $key['NOM_CATEGORIE']);
     $visa2=str_replace("\n", "\'", $visa);
     $categories.=$visa."',";
     $label=$key['NOM_CATEGORIE'];
     $categorie_non_paye.="{y:".$key['NBR'].",color:'black',name:'".$visa2."',key2:12,key:".$key['ID_MEUBLE']."},";
     $total_cat=$total_cat+$key['NBR'];
         }
   $total_general1 = $total_meuble + $total_cat;

$total_meuble = number_format($total_meuble, 0, ',', ' ');
$total_cat = number_format($total_cat, 0, ',', ' ');
$total_general1 = number_format($total_general1, 0, ',', ' ');


$reservation_statut_data = "";
$total_reservation = 0;

foreach ($reservation_par_statut as $res) {
    $label_statut = str_replace("'", "", $res['DESC_STATUT_RESERVATION']);
    $reservation_statut_data .= "{y: ".$res['NBR'].", name:'".$label_statut."', color:'blue'},";
    $total_reservation += $res['NBR'];
}

$total_reservation_fmt = number_format($total_reservation, 0, ',', ' ');



$series="{
     name: 'Disponible ($total_meuble)',
     color:'green',
     data: [$categorie_paye]
}";

$series1="{
     name: '$label ($total_cat)',
     color:'black',
     data: [$categorie_non_paye]
}";

$reservation_series = "{
    name: 'Réservations par statut ($total_reservation_fmt)',
    color: 'blue',
    data: [$reservation_statut_data]
}";



    $data['series1']=$series1;
         $data['series']=$series;
         $data['reservation_series'] = $reservation_series;

    $this->load->view('Rapport_View',$data);
       ####appel de la vue
     // $this->page = 'Rapport_View';

     // $this->layout($data);
             }


           }

           ?>