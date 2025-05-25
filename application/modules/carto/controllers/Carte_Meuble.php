<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carte_Meuble extends CI_Controller {

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
        // $data['quartiers'] = $this->Model->getRequete('SELECT `ID_QUARTIER`,`DESC_QUARTIER`,`LATITUDE`,`LONGITUDE` FROM `quartier_avenue` WHERE 1');
        // $data['avenues'] = $this->Model->getRequete('SELECT * FROM `avenue` WHERE 1');

        // $id_quartier = $this->input->get('id_quartier');
        // $id_avenue = $this->input->get('id_avenue');



        // $data['meubles'] = $this->Model->getMeublesFiltered($id_quartier, $id_avenue);

        $this->load->view('carto_Meuble_View');
    }
}