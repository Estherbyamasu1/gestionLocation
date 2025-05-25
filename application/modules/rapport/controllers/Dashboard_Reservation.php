<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Reservation extends CI_Controller {

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

    public function index() {
        // Réservations par statut
        $reservations_statut = $this->Model->getRequete("
            SELECT COUNT(*) AS NBR,
                CASE 
                    WHEN r.STATUT_RESERVATION = 1 THEN 'Confirmée'
                    WHEN r.STATUT_RESERVATION = 2 THEN 'En attente'
                    WHEN r.STATUT_RESERVATION = 3 THEN 'Annulée'
                    ELSE 'En attente de paiement'
                END AS STATUT
            FROM reservation r
            GROUP BY STATUT
        ");

        $statut_data = [];
        $total_reserv = 0;

        foreach ($reservations_statut as $row) {
            $statut_data[] = [
                'y' => (int)$row['NBR'],
                'name' => $row['STATUT'],
            ];
            $total_reserv += $row['NBR'];
        }

        $data['series_reservation_statut'] = json_encode([[
            'name' => "Réservations par statut ($total_reserv)",
            'data' => $statut_data
        ]]);

        // Réservations par mois
        $reservations_mois = $this->Model->getRequete("
            SELECT COUNT(*) AS NBR, 
                   DATE_FORMAT(DATE_DEBUT, '%Y-%m') AS MOIS
            FROM reservation
            GROUP BY MOIS
            ORDER BY MOIS ASC
        ");

        $categories_mois = [];
        $data_mois = [];
        $total_mensuel = 0;

        foreach ($reservations_mois as $row) {
            $categories_mois[] = $row['MOIS'];
            $data_mois[] = (int)$row['NBR'];
            $total_mensuel += $row['NBR'];
        }

        $data['categories_mois'] = json_encode($categories_mois);
        $data['series_mois'] = json_encode([[
            'name' => "Réservations mensuelles ($total_mensuel)",
            'data' => $data_mois,
        ]]);

        // Réservations par locataire
        $reservations_locataires = $this->Model->getRequete("
            SELECT COUNT(*) AS NBR, u.NOM_LOCATAIRE
            FROM reservation r
            JOIN locataire u ON r.ID_LOCATAIRE = u.ID_LOCATAIRE
            GROUP BY r.ID_LOCATAIRE
            ORDER BY NBR DESC
            LIMIT 10
        ");

        $categories_locataire = [];
        $data_locataire = [];

        foreach ($reservations_locataires as $row) {
            $categories_locataire[] = $row['NOM_LOCATAIRE'];
            $data_locataire[] = (int)$row['NBR'];
        }

        $data['categories_locataire'] = json_encode($categories_locataire);
        $data['series_locataire'] = json_encode([[
            'name' => 'Réservations par locataire',
            'data' => $data_locataire,
        ]]);

        // Revenus par meuble
        $revenus_meuble = $this->Model->getRequete("
            SELECT m.NOM_MEUBLE, SUM(m.MONTANT) AS TOTAL FROM reservation r JOIN meuble m ON r.MEUBLE_ID = m.ID_MEUBLE WHERE r.STATUT_RESERVATION = 1 GROUP BY r.MEUBLE_ID ORDER BY TOTAL DESC
        ");

        $categories_revenus = [];
        $data_revenus = [];

        foreach ($revenus_meuble as $row) {
            $categories_revenus[] = $row['NOM_MEUBLE'];
            $data_revenus[] = (int)$row['TOTAL'];
        }

        $data['categories_revenus'] = json_encode($categories_revenus);
        $data['series_revenus'] = json_encode([[
            'name' => 'Revenus par meuble',
            'data' => $data_revenus,
        ]]);

        $this->load->view('Dashboard_Reservation_View', $data);
    }
}