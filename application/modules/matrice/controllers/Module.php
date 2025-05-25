<?php
/**
 * christa
 * date: 22/02/2023
 * crud des modules 
 */
class Module extends CI_Controller
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
	//.......................................La fonction index
	function index()
	{

		// $this->load->view('Module_Liste_View');
		$data['title'] = 'Liste des Modules';
		// $this->page = 'Module_Liste_View';
  //  		$this->layout($data);
   		$this->load->view('Module_Liste_View',$data);
	}

	//........................................La fonction listing
	function listing()
	{
		$query_principal = 'SELECT `ID_MODULE`,`DESCRIPTION`,`MOT_CLE`,`ICONE`,`STATUT`,CONTROLLER FROM `module` WHERE 1';

		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit = 'LIMIT 0,10';


		if ($_POST['length'] != -1) {
			$limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
		}
		$order_by = '';



		$order_column = '';

		if (!empty($order_by)) {

			$order_by = isset($_POST['order']) ? ' ORDER BY ' . $_POST['order']['0']['column'] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY DESCRIPTION   DESC';
		}


		$search = !empty($_POST['search']['value']) ? (" AND (DESCRIPTION LIKE '%$var_search%') OR (MOT_CLE LIKE '%$var_search%') OR (ICONE LIKE '%$var_search%') ") : '';

		$critaire = '';

        $order_by ='ORDER BY DESCRIPTION ASC';
		$query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $order_by . '   ' . $limit;

		$query_filter = $query_principal . ' ' . $critaire . ' ' . $search;

		$fetch_cov_frais = $this->Model->datatable($query_secondaire);
		$data = array();
		$u = 1;
		foreach ($fetch_cov_frais as $info) {
			$menus = $this->Model->getRequete('SELECT * FROM `menu` WHERE `ID_MODULE`=' . $info->ID_MODULE);

			$post = array();
			$post[] = $u++;
			$post[] = $info->DESCRIPTION;
			$post[] = $info->MOT_CLE;
			$post[] = $info->CONTROLLER;
			$post[] = $info->ICONE;
			$post[] = "<center><a href='#' class='btn btn-dark' onclick='get_menu(" . $info->ID_MODULE . ",\"" . $info->DESCRIPTION . "\");' style='cursor:pointer; color:white'>" . sizeof($menus) . "</a></center>";

			$icon = '';
			$stt = '';
			if ($info->STATUT == 1) {
				$post[] = '<span class="btn-outline-info fa fa-check"></div></span>';
				$icon = 'fa-close';
				$stt = 'Désactiver';
				$message ='Désactivé';
			} else {
				$post[] = '<span class="btn-outline-danger fa fa-remove"></div></span>';
				$icon = 'fa-check';
				$stt = 'Activer';
				$message ='Activé';

			}

			$options='<span class="actionCust" title="Modifier"><a href="'.base_url('matrice/Module/getOne/'.$info->ID_MODULE).'"><i class="fa fa-pencil"></i></a></span>
        		<span data-toggle="modal" data-target="#myModal'.$info->ID_MODULE.'" title="Désactiver" class="actionCust"><a href="#"><i class="fa fa-trash"></i></a></span>

        		<div class="modal fade" id="myModal'.$info->ID_MODULE.'" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	            <div class="modal-dialog modal-lg" role="document">
	                <div class="modal-content">
	                    
	                    <div class="modal-body">
	                            <div class="row">
	                                <div class="col-lg-6 mb-4">
	                                    <center>
					 				<h5><strong>Voulez-vous  '.$stt.' le Module  <i style="color:green;">'.$info->DESCRIPTION.'</i></strong><br> <b style:"background-color:prink";></b>
					 				</h5>
					 				</center>
	                                </div>

	                            </div>
	                    </div>
	                    <div class="modal-footer">
	                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
	                        <a class="btn btn-danger" href="' . base_url('matrice/Module/actu_valde/') . $info->ID_MODULE . '">'.$stt.'</a>
	                    </div>
	                </div>
	            </div>
	        </div';

		// 	$options = '
		// 	<div class="dropdown show">
		// 	<a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		// 	Options
		// 	</a>
		// 	<div class="dropdown-menu" aria-label ledby="dropdownMenuLink">
		// 	<a class="dropdown-item" href="' . base_url('matrice/Module/getOne/') . $info->ID_MODULE . '" class="btn btn-success " style="margin-left: 0.5em;""><i class="nav-icon"></i></span> Modifier</a>
		// 	<a class="dropdown-item" data-toggle="modal" data-target="#staticBackdrop'.$info->ID_MODULE.'" style="margin-left: 0.5em;color:red"><i class="nav-icon fas  "' . $icon . '"></i> ' . $stt . '</a>

		// 	</div>
		// 	</div>
			
		// 	<div class="modal fade" data-backdrop="static" id="staticBackdrop'.$info->ID_MODULE .'">
		// 	<div class="modal-dialog">
		// 		<div class="modal-content">
		// 			<div class="modal-body">
		// 				<center>
		// 				<h5><strong>Voulez-vous  '.$message.' Module  <i style="color:green;">'.$info->DESCRIPTION.'</i></strong><br> <b style:"background-color:prink";></b>
		// 				</h5>
		// 				</center>
		// 			</div>
		// 			<div class="modal-footer">
		// 			<a class="btn btn-danger" href="' . base_url('matrice/Module/actu_valde/') . $info->ID_MODULE . '">'.$stt.'</a>
		// 				<button class="btn btn-secondary" data-dismiss="modal">
		// 					Quitter
		// 				</button>
		// 			</div>
		// 		</div>
		// 	</div>
		// </div>';
			$post[] = $options;
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


	//......................................La fonction ajouter
	public function ajouter()
	{
		// $this->load->view('Module_Ajout_View');
		$data['title'] = 'Ajout des Modules';
		// $this->page = 'Module_Ajout_View';
  //  		$this->layout($data);
   		$this->load->view('Module_Ajout_View',$data);
	}

	//....................................La fonction add
	public function add()
	{
		$description = $this->input->post('DESCRIPTION');
		$motcle = $this->input->post('MOTCLE');
		$icone = $this->input->post('ICONE');
		$CONTROLLER = $this->input->post('CONTROLLER');

		$this->form_validation->set_rules('DESCRIPTION', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('MOTCLE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('ICONE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		if ($this->form_validation->run() == FALSE) {
			$this->ajouter();
		} else {

			$compteur = $this->Model->getRequete('SELECT COUNT(module.DESCRIPTION) as descr FROM `module` WHERE DESCRIPTION= "' . $description . '"');

			if ($compteur[0]['descr'] > 0) {
				// $data['message'] = '<div style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em"  class=" btn btn-dark" id="message">' . "Module existe déjà" . '</div>';
				// $this->session->set_flashdata($data);
				$data=array(
					'class' => 'text-danger',
					'message' => 'Module existe déjà..!!'
				);
				   $this->session->set_flashdata("dash",$data);
				redirect('matrice/Module/ajouter/' . $description);
			} else {
				$array = array('DESCRIPTION' => $description, 'MOT_CLE' => $motcle, 'ICONE' => $icone, 'STATUT' => 1,'CONTROLLER'=>$CONTROLLER);
				$this->Model->create('module', $array);
			}
			$data['message'] = '<div style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em"  class=" btn btn-success" id="message">' . "L'enregistrement a été fait avec succès" . '</div>';
			$this->session->set_flashdata($data);
			redirect(base_url('matrice/Module'));

		}
	}

	//...........................................La fonction getOne
	function getOne($id)
	{

		$data['data'] = $this->Model->getOne('module', array('ID_MODULE' => $id));
		// $this->load->view('Module_Update_View', $data);

		$data['title'] = 'Modifier les Modules';
		// $this->page = 'Module_Update_View';
  //  		$this->layout($data);

   		$this->load->view('Module_Update_View',$data);
	}
	//..................................................function modifier

	function update()
	{
		$this->load->library('form_validation');
		$DESCRIPTION = $this->input->post('DESCRIPTION');
		$motcle = $this->input->post('MOTCLE');
		$icone = $this->input->post('ICONE');
		$CONTROLLER = $this->input->post('CONTROLLER');

		$id = $this->input->post('id');

		$this->form_validation->set_rules('DESCRIPTION', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('MOTCLE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		$this->form_validation->set_rules('ICONE', '', 'trim|required', array('required' => '<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

		if ($this->form_validation->run() == FALSE) {
			$this->getOne($id);
		} else {
			$formatArrayray = array(

				'DESCRIPTION' => $DESCRIPTION,
				'MOT_CLE' => $motcle,
				'ICONE' => $icone,
				'CONTROLLER' => $CONTROLLER

			);

			$message = $this->Model->update('module', array('ID_MODULE' => $id), $formatArrayray);
			if ($message) {

				// $data['message'] = '<div class="alert alert-success text-center" id="message">' . "Modification a été faite avec success" . '</div>';
				$data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-success">' . "Modification effectuée avec succès!!" . '</div>';
				$this->session->set_flashdata($data);
				redirect(base_url('matrice/Module/'));

			}

		}

	}

	function infor($id)
	{
		$data = $this->Model->getOne('module', array('ID_MODULE' => $id));
		$stt = '';

		if ($data['IS_ACTIF'] != 1) {
			$stut = 'activez';
			$stuts = 'Désactivé';
			$stt = 'Activer';
		} else {
			$stut = 'désactivez';
			$stt = 'Désactiver';
			$stuts = 'Activé';
		}
	}

	//....................................Fonction pour activer ou désactiver
	function actu_valde($id)
	{
		$table = 'module';
		$criteres['ID_MODULE'] = $id;
		$data['rows'] = $this->Model->getOne($table, $criteres);
		$datad;
		if ($data['rows']['STATUT'] == 1) {
			$stuts = 'Désactivé';

			$datad = array('STATUT' => 0);

			$data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-dark">' . "Le module a été désactivé avec succès " . '</div>';
			$this->session->set_flashdata($data);

		} else {
			$stuts = 'Activé';

			$datad = array('STATUT' => 1);


			$data['message'] = '<div  style="height:3em;border-radius:10px;padding-top:0.5em; width:80%;margin-left:5em" id="message" class=" btn btn-dark">' . " Le module a été activé avec success " . '</div>';
			$this->session->set_flashdata($data);

		}
		$this->Model->update($table, $criteres, $datad);
		redirect(base_url('index.php/matrice/Module/'));

	}

	//liste des menus appartenant au module quelconque
	function detail_menu($ID_MODULE = 0)
	{

		$query_principal = 'SELECT menu.`ID_MENU`,menu.`DESCRIPTION`,menu.`URL`,menu.`STATUT` FROM `menu`  WHERE 1 AND menu.ID_MODULE=' . $ID_MODULE;

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
        $order_by = 'ORDER BY menu.`DESCRIPTION` ASC';
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
				$url = "N/A";
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


}

?>