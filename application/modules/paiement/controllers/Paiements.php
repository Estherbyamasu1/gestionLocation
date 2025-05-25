<?php

class Paiements extends CI_Controller
{

  function __construct()
  {

    parent::__construct();
  }
  function index()
  {

    $this->load->view('flutterwave/Paiement_View');
  }





  //fonction liste
  function listing()
  {
    $query_principal = "SELECT paiement.ID_PAIEMENT,paiement.MONTANT as montant_paye,paiement.MODE_PAIEMENT,paiement.RESERVATION_ID,paiement.STATUT_PAIEMENT,paiement.DATE_PAIEMENT,reservation.MEUBLE_ID,reservation.ID_LOCATAIRE,meuble.NOM_MEUBLE,meuble.NUMERO_MEUBLE,locataire.NOM_LOCATAIRE,locataire.PRENOM_LOCATAIRE,locataire.TELEPHONE,locataire.EMAIL as locat_email,paiement.IMAGE_RECU,type_paiement.DESC_TYPE_PAIEMENT,paiement.ID_TYPE_PAIEMENT FROM `paiement` JOIN reservation ON reservation.RESERVATION_ID=paiement.RESERVATION_ID LEFT JOIN meuble ON reservation.MEUBLE_ID=meuble.ID_MEUBLE LEFT JOIN locataire ON locataire.ID_LOCATAIRE=reservation.ID_LOCATAIRE JOIN type_paiement ON type_paiement.ID_TYPE_PAIEMENT=paiement.ID_TYPE_PAIEMENT WHERE 1";

    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $limit = 'LIMIT 0,10';
    if ($_POST['length'] != -1) {
      $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
    }


    $order_column = '';

    $order_column = array('paiement.ID_PAIEMENT', 'paiement.MONTANT', 'meuble.ID_MEUBLE', 'meuble.NOM_MEUBLE', 'meuble.NUMERO_MEUBLE', 'locataire.NOM_LOCATAIRE', 'locataire.PRENOM_LOCATAIRE');

    $search = !empty($_POST['search']['value']) ?  (" AND (meuble.NOM_MEUBLE LIKE '%$var_search%' OR meuble.NUMERO_MEUBLE LIKE '%$var_search%' OR locataire.NOM_LOCATAIRE LIKE '%$var_search%' OR locataire.PRENOM_LOCATAIRE LIKE '%$var_search%' OR  paiement.MONTANT LIKE '%$var_search%')") : '';

    $critaire = '';

    $order_by = ' ORDER BY NOM_MEUBLE ASC';
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
      $post[] = $info->DESC_TYPE_PAIEMENT;
      $post[] = $statut;

      if(!empty($info->IMAGE_RECU)){


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

      }else{

        $post[] = '-----';
      }
      // $post[]='<div class="col-md-12"><embed src="' . base_url('uploads/doc_meuble/' . $info->IMAGE_MEUBLE) . '" type="application/pdf"   scrolling="auto" height="30px" width="20%"></div>';

      

      $post[] = '
      <div class="dropdown">
      <button class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cog">
      </i><span class=' . "caret" . '> Actions</span>
      </button>
      <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">

      <a href="' . base_url('appartement/Appartement/getOne/' . $info->ID_PAIEMENT) . '" >Modifier</i></a><br>
      <a style="color:red" data-toggle="modal" href="#" data-target="#staticBackdrop' . $info->ID_PAIEMENT . '">Supprimer</a>
      </div>
      </div>
      <div class="modal fade" data-backdrop="static" id="staticBackdrop' . $info->ID_PAIEMENT . '">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-body">
      <center>
      <h5><strong>Voulez-vous supprimer ?<i style="color:green;"></i></strong><br> <b style="background-color:prink"></b>
      </h5>

      </center>
      </div>
      <div class="modal-footer">

      <a  style="color:red" href="' . base_url('appartement/Appartement/delete/' . $info->ID_PAIEMENT) . '">supprimer</a>
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
      "recordsTotal" => $this->Model->all_data($query_principal),
      "recordsFiltered" => $this->Model->filtrer($query_filter),
      "data" => $data
    );
    echo json_encode($output);
  }



  function Add()
  {
   $type=$this->Model->getRequete('SELECT * FROM `type_paiement`');
   
   if(isset($type)){
    $data['typePaiement'] =  $type;
  }
  $messerva= $this->Model->getRequete('SELECT * FROM `reservation` JOIN locataire as locas ON locas.ID_USER=USER_ID LEFT JOIN meuble as meu ON MEUBLE_ID=meu.ID_MEUBLE');

  if(isset($messerva)){
   $data['mesresrvation'] = $messerva;
 }



 $this->load->view('flutterwave/Add_Paiement',$data);
}



// public function Add_paiement()
// {
//     $ID_RESERVATION = $this->input->post('ID_RESERVATION');
//     $MONTANT = $this->input->post('MONTANT');
//     $MODE_PAIEMENT = $this->input->post('MODE_PAIEMENT');
//     $TELEPHONE = $this->input->post('TELEPHONE');

//     // Préparer appel vers Flutterwave (exemple, à adapter selon l'agrégateur choisi)
//     $data = [
//         "tx_ref" => uniqid('trx_'),
//         "amount" => $MONTANT,
//         "currency" => "BIF", // ou CDF, selon le pays
//         "payment_type" => "mobilemoney",
//         "redirect_url" => base_url("paiements/verify_payment"),
//         "customer" => [
//             "email" => "user@example.com",
//             "phonenumber" => $TELEPHONE,
//             "name" => "Locataire"
//         ],
//         "customizations" => [
//             "title" => "Paiement Location",
//             "description" => "Paiement de réservation"
//         ],
//         "meta" => [
//             "reservation_id" => $ID_RESERVATION
//         ]
//     ];
// // $secretKey = $this->config->item('flutterwave_secret_key');
// // $headers = [
// //     "Authorization: Bearer $secretKey",
// //     "Content-Type: application/json"
// // ];
//     $headers = [
//         'Authorization: Bearer FLWPUBK_TEST-32193bba8dab84e3d9c4525c85ea7a12-X',
//         'Content-Type: application/json'
//     ];

//     $ch = curl_init('https://api.flutterwave.com/v3/payments');
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

//     $response = curl_exec($ch);
//     curl_close($ch);

//     $result = json_decode($response, true);

//     if (isset($result['status']) && $result['status'] == 'success') {
//         // Rediriger vers la page de paiement Flutterwave
//         redirect($result['data']['link']);
//     } else {
//         echo "Erreur lors du paiement : " . $result['message'];
//     }
// }



// public function verify_payment()
// {
//     $tx_ref = $this->input->get('tx_ref');
//     $transaction_id = $this->input->get('transaction_id');

//     $curl = curl_init();
//     curl_setopt_array($curl, array(
//         CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/$transaction_id/verify",
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_HTTPHEADER => array(
//             "Content-Type: application/json",
//             "Authorization: Bearer VOTRE_CLE_FLUTTERWAVE"
//         ),
//     ));

//     $response = curl_exec($curl);
//     curl_close($curl);

//     $result = json_decode($response, true);

//     if ($result['status'] == "success") {
//         // Insérer dans DB
//         $meta = $result['data']['meta'];
//         $this->Model->create('paiement', [
//             'MONTANT' => $result['data']['amount'],
//             'ID_TYPE_PAIEMENT' => 2, // à adapter
//             'RESERVATION_ID' => $meta['reservation_id'],
//             'STATUT_PAIEMENT' => 1,
//             'DATE_PAIEMENT' => date('Y-m-d H:i:s'),
//             'MODE_PAIEMENT' => $result['data']['payment_type']
//         ]);

//         redirect('paiement/Paiements');
//     } else {
//         echo "Paiement échoué ou annulé.";
//     }
// }



function Add_paiement(){

 $ID_RESERVATION = trim(htmlspecialchars($this->input->post('ID_RESERVATION')));
 $MONTANT = trim(htmlspecialchars($this->input->post('MONTANT')));
 $MODE_PAIEMENT = trim(htmlspecialchars($this->input->post('MODE_PAIEMENT')));
    // $CODE_PAIEMENT = trim(htmlspecialchars($this->input->post('CODE_PAIEMENT')));
 $TELEPHONE = $this->input->post('TELEPHONE');

 $gettype = $this->Model->create('paiement', array(
  'MONTANT' => $MONTANT,
  'ID_TYPE_PAIEMENT' => $MODE_PAIEMENT,
  'RESERVATION_ID' => $ID_RESERVATION,
  'TELEPHONE' => $TELEPHONE,
  'STATUT_PAIEMENT'=>1
));
 

 if (isset($gettype)) {
  return redirect(base_url('paiement/Paiements'));
}
}


}
