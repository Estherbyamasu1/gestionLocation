<?php
// Auteur:MANIRATUNGA Eric
// Tâche: CRUD des profil sur Patareb
// Email:maniratunga.eric@mediabox.bi
// Date:le 28/11/2022
class Profil extends CI_Controller
{

	function __construct()
	{  
		
		parent::__construct(); 
    $this->is_auth(); 
	}
	public function is_auth()
  {
    if (empty($this->session->userdata('USER_ID'))) {
      redirect(base_url('Login'));
    }
  }


	function index($ID_PROFIL = 0)
	{
		$data['profil_desc'] = $this->Model->getRequete('SELECT `rol_id`,`rol_description` FROM `roles` WHERE 1 AND `rol_id`=' . $ID_PROFIL);
		$data['ID_PROFIL'] = $ID_PROFIL;

		$data["module"] = $this->Model->getRequete("SELECT `ID_MODULE`, `DESCRIPTION`, `STATUT` FROM `module` WHERE STATUT=1 ORDER BY `DESCRIPTION` ASC ");

		// $this->load->view('Profil_list_view', $data);
		$data['title'] = 'Liste des profils';
		// $this->page = 'Profil_list_view';
  //  		$this->layout($data);
   		 $this->load->view('Profil_list_view',$data);
	}

	//Affichage d'une liste des profils
	function listing()
	{
		$query_principal = "SELECT `rol_id`,`rol_code`,`rol_description`,`rol_active` FROM `roles` WHERE 1 ";

		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit = 'LIMIT 0,10';
		if ($_POST['length'] != -1) {
			$limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
		}

		$order_by = '';
		$order_column = '';

		$order_column = array('rol_id', 'rol_code','rol_description','rol_description', 'rol_active', '');

		$order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY rol_description DESC';

		$search = !empty($_POST['search']['value']) ? (" AND (`rol_description` LIKE '%$var_search%' or `rol_code` LIKE '%$var_search%')") : '';

		$critaire = '';

        $order_by='ORDER BY rol_description ASC';
		$query_secondaire = $query_principal . ' ' . $critaire . ' ' .$search. ' '.$order_by . ' ' . $limit;

		$query_filter = $query_principal . ' ' . $critaire . ' '.$search.' '. $order_by;

		// $abonne='';

		$fetch_cov_frais = $this->Model->datatable($query_secondaire);
		$data = array();
		$u = 1;



		foreach ($fetch_cov_frais as $info) {
			$requete = $this->Model->getRequete("SELECT * FROM module_profil WHERE module_profil.ID_PROFIL=" . $info->rol_id);


			$post = array();
			$post[] = $u++;
			$post[] = $info->rol_description;
			$post[] = $info->rol_code;

			$desc = $info->rol_description;


			$post[] = "<center><a href='#' class='btn btn-dark' onclick='get_module(" . $info->rol_id . ",\"" . $desc . "\");' style='cursor:pointer; color:white'>" . sizeof($requete) . "</a></center>";

			
			$val = '';$icon = '';$stt = '';

			if ($info->rol_active == 1) {
				$post[] = '<span class="btn-outline-info fa fa-check"></div></span>';
				$icon = 'fa-close';
				$stt = 'Désactiver';
			} else {
				$post[] = '<span class="btn-outline-danger fa fa-remove"></div></span>';
				$icon = 'fa-check';
				$stt = 'Activer';

			}
			
			$post[]='<span class="actionCust" title="Modifier"><a href="'.base_url('matrice/Profil/getOne/'.$info->rol_id).'"><i class="fa fa-pencil"></i></a></span>

				<span class="actionCust" title="Affecter un module"><a href="#" onclick="affect(' . $info->rol_id . ')"><i class="fa fa-plus"></i></a></span>

        		<span data-toggle="modal" data-target="#myModal'.$info->rol_id.'" title="'.$stt.'" class="actionCust"><a href="#"><i class="fa fa-trash"></i></a></span>

        		<div class="modal fade" id="myModal'.$info->rol_id.'" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	            <div class="modal-dialog" role="document">
	                <div class="modal-content">
	                    
	                    <div class="modal-body">
	                            <div class="row">
	                                <div class="col-lg-12 mb-4">
	                                    <center>
					 				<h5><strong>Voulez-vous  '.$stt.' le profil  <i style="color:green;">'.$info->rol_description.'</i></strong><br> <b style:"background-color:prink";></b>
					 				</h5>
					 				</center>
	                                </div>

	                            </div>
	                    </div>
	                    <div class="modal-footer">
	                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
	                        <a class="btn btn-danger" href="' . base_url('matrice/Profil/change_statut/' . $info->rol_id . '/' . $info->rol_active) . '">'.$stt.'</a>
	                    </div>
	                </div>
	            </div>
	        </div';

			

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

	//fonction pour la redirection vers la page Profil_view
	function ajouter()
	{
		// $this->load->view('Profil_view');

		$data['title'] = 'Ajout du profil';
		// $this->page = 'Profil_view';
  //  		$this->layout($data);

   		 $this->load->view('Profil_view',$data);

	}
	//fonction pour ajouter dans la base de données
	public function ajout()
	{
		$Des = $this->input->post('DESCRIPTION');
		$CODE_PROFIL = $this->input->post('CODE_PROFIL');

		$module = $this->input->post("module[]");

		$this->load->library('form_validation');

		$this->form_validation->set_rules('DESCRIPTION', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
		$this->form_validation->set_rules('CODE_PROFIL', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
		$this->form_validation->set_rules('module[]', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


		if ($this->form_validation->run() == FALSE) {

			$this->ajouter();
		} else {


			$data_profil = array(
				'rol_description' => $Des,
				'rol_code'=>$CODE_PROFIL,
				'rol_active' => 1,
				'rol_datecreated'=>date('Y-m-d H:i:s'));

			$check=$this->Model->getOne('roles',array('rol_description'=>$Des,'rol_code'=>$CODE_PROFIL));

			// $check = $this->Model->getOne('roles', $data_profil);

			if (empty($check)) {

				$message = $this->Model->insert_last_id('roles', $data_profil);

				$count = count($module);

				for ($i = 0; $i < $count; $i++) {

					$this->Model->create('module_profil', array('ID_MODULE' => $module[$i], 'ID_PROFIL' => $message));
				}

				if ($message) {
					$data['message'] = '<div style="background-color:#DC143C; height:3em; border-radius:10px; padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-dark">' . "L'enregistrement du profil '" . $this->input->post('DESCRIPTION') . "' est fait avec succès '" . '</div>';
					$this->session->set_flashdata($data);
					redirect(base_url('/matrice/Profil/liste'));

				} else {
					$data['message'] = '<div style="background-color:#DC143C; height:3em; border-radius:10px; padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-dark">' . "L'enregistrement du profil '" . $this->input->post('DESCRIPTION') . "' a échoué '" . '</div>';

					$this->session->set_flashdata($data);
					$this->ajouter();
				}

			} else {

				$data=array(
					'class' => 'text-danger',
					'message' => 'Le profil ou le code existe déjà..!!'
				);
		    $this->session->set_flashdata("dash",$data); 
			$this->ajouter();



			}
		}
	}
	//fonction pour la redirection vers la page Profil_view
	function liste()
	{
		// $this->load->view('Profil_list_view');

		$data['title'] = 'Liste des profils';
		// $this->page = 'Profil_list_view';
  //  		$this->layout($data);
   		$this->load->view('Profil_list_view',$data);
	}
	//fonction pour la recuperation des informations en provenance de la base de données
	public function getOne($id)
	{

		$Profil = $this->Model->getOne('roles', array('rol_id' => $id));


		$exit = $this->Model->getRequete('SELECT module.ID_MODULE FROM module_profil JOIN module on module_profil.ID_MODULE= module.ID_MODULE WHERE module_profil.ID_PROFIL=' . $Profil['rol_id'] . ' and module.STATUT=1  ');

		$modul = array();

		foreach ($exit as $key) {
			$modul[] = $key['ID_MODULE'];

		}


		$data['modul'] = $modul;

		$data['data_profil'] = $Profil;

		// $this->load->view('Profil_update_view.php', $data);

		$data['title'] = 'Modification du profil';
		// $this->page = 'Profil_update_view';
  //  		$this->layout($data);
   		 $this->load->view('Profil_update_view',$data);
	}
	//fonction pour la modification des données en provenance de la base de données
	public function update()
	{

		$id = $this->input->post('id');
		$PRO = $this->input->post('DESCRIPTION');
		$CODE = $this->input->post('CODE_PROFIL');
		$ID_MODULE = $this->input->post('module');


		$this->form_validation->set_rules('DESCRIPTION', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('CODE_PROFIL', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('module[]', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		if ($this->form_validation->run() == FALSE) {
			$this->getOne($id);
		} else {
			$array = array('rol_description' => $PRO,'rol_code'=>$CODE);

			$message = $this->Model->update('roles', array('rol_id' => $id), $array);

			$this->Model->delete('module_profil', array('ID_PROFIL' => $id));


			foreach ($ID_MODULE as $key => $value) {

				$dataUpdate = array('ID_MODULE' => $value, 'ID_PROFIL' => $id);

				$this->Model->create('module_profil', $dataUpdate);
			}
			if ($message) {

				$data['message'] = '<div style="background-color:#DC143C; height:3em; border-radius:10px; padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-dark">Le profil a été modifié avec succès</div>';
				$this->session->set_flashdata($data);
				redirect(base_url('/matrice/Profil/index'));

			} else {
				$data['message'] = '<div style="background-color:#DC143C; height:3em; border-radius:10px; padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-dark">La modification du profil a echoue</div>';
				$this->session->set_flashdata($data);
				$this->getOne($id);

			}


		}
	} //fonction de modifier


	//fonction pour le changement de statut
	function change_statut($ID_PROFIL, $stat)
	{
		if ($stat == 1) {
			$val = 0;

			$message = $this->Model->update('roles', array('rol_id' => $ID_PROFIL), array('rol_active' => $val));

			if ($message) {

				// $message = array(
				// 	'class' => 'success',
				// 	'message' => '<div style="font-size:1.5em">' . "Le profil a été Désactivé avec succès!" . '</div>'
				// );
				$data['message'] = '<div style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em"  class=" btn btn-dark" id="message">' . "Le profil a été Désactivé avec succès!" . '</div>';

				$this->session->set_flashdata($data);

				redirect(base_url('/matrice/Profil/index'));

			} else {
				$message = array(
					'class' => 'text-danger',
					'message' => 'Echoué!'
				);

				$this->session->set_flashdata("dash", $message);
				redirect(base_url('/matrice/Profil/index'));
			}
		} else {
			$val = 1;
			$message = $this->Model->update('roles', array('rol_id' => $ID_PROFIL), array('rol_active' => $val));

			if ($message) {
				$data['message'] = '<div style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em"  class=" btn btn-dark" id="message">' . "Le profil a été activé avec succès!" . '</div>';
				$this->session->set_flashdata($data);

				redirect(base_url('/matrice/Profil/index'));

			} else {
				$message = array(
					'class' => 'text-danger',
					'message' => 'Echec!'
				);

				$this->session->set_flashdata("dash", $message);

				$data['message'] = '<div style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em"  class=" btn btn-dark" id="message">' . "Le profil a été activé avec succès!" . '</div>';
				$this->session->set_flashdata($data);
				redirect(base_url('/matrice/Profil/index'));
			}
		}
	}


	//fonction pour la redirection vers la page Profil_view
	public function updateProfil()
	{
		$this->load->view('Profil_update_view');
	}


	public function detail($id = 0)
	{
		$query_principal = 'SELECT module_profil.ID_PROFIL,module.ID_MODULE,module.DESCRIPTION,module.STATUT FROM module_profil LEFT JOIN module ON module_profil.ID_MODULE=module.ID_MODULE WHERE 1 and module_profil.ID_PROFIL='. $id;

		$var_search = !empty($_POST["search"]["value"]) ? $_POST["search"]["value"] : null;
		$limit = 'LIMIT 0,10';
		$draw = isset($_POST['draw']);
		$start = isset($postData['start']);

		if (isset($_POST["length"]) && $_POST["length"] != -1) {
			$limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
		}



		$order_by = '';
		$order_column = '';

		$order_column = array('module.ID_MODULE', 'module.DESCRIPTION');

		$order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY  module.DESCRIPTION ASC';

		$search = !empty($_POST['search']['value']) ? ("AND module.DESCRIPTION LIKE '%$var_search%'") : '';


		$critaire = '';
        $order_by = 'ORDER BY module.DESCRIPTION ASC';
		$query_secondaire = $query_principal . ' ' . $search.' '.$order_by. ' ' . $critaire . ' ' . $limit;

		$query_filter = $query_principal . '  ' . $search . ' ' . $critaire;



		$fetch_cov_frais = $this->Model->datatable($query_secondaire);
		$data = array();
		$u = 1;
		$statut = '';
		foreach ($fetch_cov_frais as $info) {
			if ($info->STATUT == 1) {
				$statut = '<span class="btn-outline-info fa fa-check"></span>';
			} else {
				$statut = '<span class="btn-outline-danger fa fa-remove"></span>';
			}

			$menus = $this->Model->getRequete('SELECT * FROM `menu` WHERE `ID_MODULE`=' . $info->ID_MODULE);
			$post = array();
			$post[] = $u++;
			$post[] = $info->DESCRIPTION;
			$post[] = "<center><a href='#' class='btn btn-dark' onclick='get_menu(" . $info->ID_MODULE . "," . $info->ID_PROFIL . ",\"" . $info->DESCRIPTION . "\");' style='cursor:pointer; color:white'>" . sizeof($menus) . "</a></center>";
			$post[] = $statut;

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

	//liste des menus appartenant au profil et module quelconque
	function detail_menu($ID_MODULE = 0, $ID_PROFIL = 0)
	{
		$query_principal = 'SELECT menu.`ID_MENU`,menu.`DESCRIPTION`,menu.`URL`,menu.`STATUT` FROM `menu` LEFT JOIN menu_profil ON menu_profil.ID_MENU=menu.ID_MENU WHERE 1 AND menu.ID_MODULE=' . $ID_MODULE .' AND menu_profil.ID_PROFIL=' . $ID_PROFIL;
		$var_search = !empty($_POST["search"]["value"]) ? $_POST["search"]["value"] : null;
		$limit = 'LIMIT 0,10';
		$draw = isset($_POST['draw']);
		$start = isset($postData['start']);

		if (isset($_POST["length"]) && $_POST["length"] != -1) {
			$limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
		}
		$order_by = '';
		$order_column = '';

		$order_column = array('menu.ID_MENU', 'menu.DESCRIPTION', 'menu.URL', 'menu.STATUT');

		$order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY  menu.DESCRIPTION ASC';

		$search = !empty($_POST['search']['value']) ? ("AND menu.DESCRIPTION LIKE '%$var_search%' OR menu.URL LIKE '%$var_search%' ") : '';


		$critaire = '';
        $order_by ='ORDER BY  menu.DESCRIPTION  ASC';
		$query_secondaire = $query_principal . ' ' . $search.' '.$order_by. ' ' . $critaire . ' ' . $limit;

		$query_filter = $query_principal . '  ' . $search . ' ' . $critaire;



		$fetch_cov_frais = $this->Model->datatable($query_secondaire);
		$data = array();
		$u = 1;
		$statut = '';
		$url = '';
		foreach ($fetch_cov_frais as $info) {
			if ($info->STATUT == 1) {
				$statut = '<span class="btn-outline-info fa fa-check"></span>';
			} else {
				$statut = '<span class="btn-outline-danger fa fa-remove"></span>';
			}

			if (empty($info->URL)) {
				$url = "Le menu a des sous menus";
			} else {
				$url = $info->URL;
			}

			$post = array();
			$post[] = $u++;
			$post[] = $info->DESCRIPTION;
			$post[] = $url;
			$post[] = $statut;

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

	function affecter()
	{
		$ID_PROFIL = $this->input->post('ID_PROFIL');
		$ID_MODULE = $this->input->post('ID_MODULE');

		$data_mod = array('ID_MODULE' => $ID_MODULE, 'ID_PROFIL' => $ID_PROFIL);

		$vide = $this->Model->getOne('module_profil', $data_mod);

		if (empty($vide)) {
			$this->Model->create('module_profil', $data_mod);
			$data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-dark">' . "L'affectation d'un module est faite avec succès" . '</div>';
			$this->session->set_flashdata($data);
			redirect(base_url('/matrice/Profil/index'));
		} else {
			$data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-dark">' . "L'affectation existe déjà"  . '</div>';
			$this->session->set_flashdata($data);
			redirect(base_url('/matrice/Profil/index'));
		}

	}
} 

?>