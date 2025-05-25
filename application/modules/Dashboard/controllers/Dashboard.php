<?php

class Dashboard extends CI_Controller
{

  function __construct()
  {

    parent::__construct();
  }
  function index()
  {
       $reservation = $this->Model->datatable("SELECT * FROM `reservation` ");
        $totalpaiement = $this->Model->datatable(" SELECT SUM(`MONTANT`) AS TotalPaiements FROM `paiement` ");
          $totalmeuble = $this->Model->datatable("SELECT * FROM `meuble`");

            $totalmeubledisponible = $this->Model->datatable("SELECT * FROM `meuble` WHERE `STATUT`=1");
              $totalmeubleReservation = $this->Model->datatable("SELECT * FROM `meuble` WHERE `STATUT`=2");

            $totalLocataire = $this->Model->datatable("SELECT * FROM `locataire`");

  if (!empty($totalmeubleReservation) && isset($totalmeubleReservation)) {
   $data['totalmeubleReservation']= count($totalmeubleReservation);
} else {
   $data['totalmeubleReservation']= 0; // Default to 0 if no payments or result is empty
}

  if (!empty($totalmeubledisponible) && isset($totalmeubledisponible)) {
   $data['totalmeubledisponible']= count($totalmeubledisponible);
} else {
   $data['totalmeubledisponible']= 0; // Default to 0 if no payments or result is empty
}
if (!empty($totalLocataire) && isset($totalLocataire)) {
   $data['TotalLocataire']= count($totalLocataire);
} else {
   $data['TotalLocataire']= 0; // Default to 0 if no payments or result is empty
}

if (!empty($totalmeuble) && isset($totalmeuble)) {
   $data['Totalmeuble']= count($totalmeuble);
} else {
   $data['Totalmeuble']= 0; // Default to 0 if no payments or result is empty
}

 if (!empty($reservation) && isset($reservation)) {
   $data['nbrreservation']= count($reservation);
} else {
   $data['nbrreservation']= 0; // Default to 0 if no payments or result is empty
}
if (!empty($totalpaiement) && isset($totalpaiement)) {
    $data['Totalpaiement'] = $totalpaiement[0]->TotalPaiements;
} else {
    $data['Totalpaiement'] = 0; // Default to 0 if no payments or result is empty
}

    $this->load->view('flutterwave/Dashboard', $data);
  }


}
