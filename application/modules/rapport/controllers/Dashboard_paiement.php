<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_paiement extends CI_Controller {

    

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
        // 1. Paiements par type de paiement
    $paiements_par_type = $this->Model->getRequete("
        SELECT t.DESC_TYPE_PAIEMENT, SUM(p.MONTANT) AS TOTAL FROM paiement p JOIN type_paiement t ON p.ID_TYPE_PAIEMENT = t.ID_TYPE_PAIEMENT WHERE p.STATUT_PAIEMENT = 1 GROUP BY p.ID_TYPE_PAIEMENT
        ");

    $cat_type = [];
    $data_type = [];
    foreach ($paiements_par_type as $row) {
        $cat_type[] = $row['DESC_TYPE_PAIEMENT'];
        $data_type[] = (int)$row['TOTAL'];
    }

    $data['categories_type'] = json_encode($cat_type);
    $data['series_type'] = json_encode([[
        'name' => 'Montant payé',
        'data' => $data_type
    ]]);

        // 2. Paiements par mois
    $paiements_par_mois = $this->Model->getRequete("
        SELECT DATE_FORMAT(DATE_PAIEMENT, '%Y-%m') AS MOIS, SUM(MONTANT) AS TOTAL
        FROM paiement
        WHERE STATUT_PAIEMENT = 1
        GROUP BY MOIS
        ORDER BY MOIS ASC
        ");

    $cat_mois = [];
    $data_mois = [];
    foreach ($paiements_par_mois as $row) {
        $cat_mois[] = $row['MOIS'];
        $data_mois[] = (int)$row['TOTAL'];
    }

    $data['categories_mois'] = json_encode($cat_mois);
    $data['series_mois'] = json_encode([[
        'name' => 'Montant mensuel',
        'data' => $data_mois
    ]]);

        // 3. Paiements par statut
    $paiements_statut = $this->Model->getRequete("
        SELECT STATUT_PAIEMENT,
        CASE 
        WHEN STATUT_PAIEMENT = 0 THEN 'En attente'
        WHEN STATUT_PAIEMENT = 1 THEN 'Validé'
        WHEN STATUT_PAIEMENT = 2 THEN 'Rejeté'
        ELSE 'Inconnu'
        END AS STATUT,
        COUNT(*) AS NBR
        FROM paiement
        GROUP BY STATUT_PAIEMENT
        ");

    $data_statut = [];
    foreach ($paiements_statut as $row) {
        $data_statut[] = [
            'name' => $row['STATUT'],
            'y' => (int)$row['NBR']
        ];
    }
    $data['series_statut'] = json_encode([[
        'name' => 'Nombre de paiements',
        'data' => $data_statut
    ]]);

        // 4. Paiements par numéro de téléphone
    $paiements_tel = $this->Model->getRequete("
        SELECT TELEPHONE, SUM(MONTANT) AS TOTAL
        FROM paiement
        WHERE STATUT_PAIEMENT = 1
        GROUP BY TELEPHONE
        ORDER BY TOTAL DESC
        LIMIT 10
        ");

    $cat_tel = [];
    $data_tel = [];
    foreach ($paiements_tel as $row) {
        $cat_tel[] = $row['TELEPHONE'];
        $data_tel[] = (int)$row['TOTAL'];
    }

    $data['categories_tel'] = json_encode($cat_tel);
    $data['series_tel'] = json_encode([[
        'name' => 'Montant payé',
        'data' => $data_tel
    ]]);

        // 5. Nombre de paiements par jour
    $paiements_jour = $this->Model->getRequete("
        SELECT DATE(DATE_PAIEMENT) AS JOUR, COUNT(*) AS NBR
        FROM paiement
        GROUP BY JOUR
        ORDER BY JOUR DESC
        LIMIT 10
        ");

    $cat_jour = [];
    $data_jour = [];
    foreach ($paiements_jour as $row) {
        $cat_jour[] = $row['JOUR'];
        $data_jour[] = (int)$row['NBR'];
    }

    $data['categories_jour'] = json_encode($cat_jour);
    $data['series_jour'] = json_encode([[
        'name' => 'Paiements par jour',
        'data' => $data_jour
    ]]);

        // 6. Paiements par code paiement
    $paiements_code = $this->Model->getRequete("
        SELECT CODE_PAIEMENT, MONTANT
        FROM paiement
        WHERE STATUT_PAIEMENT = 1
        ORDER BY MONTANT DESC
        LIMIT 10
        ");

    $cat_code = [];
    $data_code = [];
    foreach ($paiements_code as $row) {
        $cat_code[] = $row['CODE_PAIEMENT'];
        $data_code[] = (int)$row['MONTANT'];
    }

    $data['categories_code'] = json_encode($cat_code);
    $data['series_code'] = json_encode([[
        'name' => 'Montant par code',
        'data' => $data_code
    ]]);

    $this->load->view('Dashboard_paiement_View', $data);
}
}