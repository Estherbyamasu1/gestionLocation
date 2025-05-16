<!DOCTYPE html>
<html lang="en">    

<head>

	<?php include VIEWPATH.'includes/header.php'; ?>

</head>

<body>
	<?php include VIEWPATH.'includes/loadpage.php'; ?>  
	<div id="main-wrapper">
		<?php include VIEWPATH.'includes/navybar.php'; ?> 
		<?= include VIEWPATH.'includes/menu.php'; ?> 

		<div class="content-body">
			<div class="container-fluid">
				<div class="row page-titles mx-0">
					<div class="col-sm-6 p-md-0">
						<div class="welcome-text">
							<h4 style='color:#007bac'>Listes de ménages</h4>

						</div>
					</div>

				</div>

				<div class="row">
					<div class="container-fluid" style="padding:30px;">
						<center><span id="message_retour"></span></center>
						<div class="col-xl-12 col-xxl-12">
							<table id='mytable' class="table table-bordered table-striped table-hover table-condensed" style="width: 100%;">
								<thead>
									<tr>
										<th>#</th>
										<th>PROPRIETAIRE</th>
										<th>ZONE</th>
										<th>AVENUE</th>
										<th>QUARTIER</th>
										<th>Numero menage</th>
										<th>Nombre membre</th>
										<th>Action</th>	
									</tr>
								</thead>
								<tbody id="table">

								</tbody>
							</table>


						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<?= include VIEWPATH.'includes/scripts_js.php'; ?>

</body>

<?= include VIEWPATH.'includes/legende.php' ?> 


<script>
	$(document).ready(function(){

		liste();
	});

	function liste()
	{

		var row_count ="1000000";
		table=$("#mytable").DataTable({
			"processing":true,
			"destroy" : true,
			"serverSide":true,
			"oreder":[[ 0, 'desc' ]],
			"ajax":{
				url:"<?=base_url()?>ihm/Menage/listing/",
				type:"POST"
			},
			lengthMenu: [[5,10,50, 100, row_count], [5,10,50, 100, "All"]],
			pageLength: 10,
			"columnDefs":[{
				"targets":[],
				"orderable":false
			}],

			dom: 'Bfrtlip',
			buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
			],
			language: {
				"sProcessing":     "Traitement en cours...",
				"sSearch":         "Rechercher&nbsp;:",
				"sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
				"sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
				"sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
				"sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
				"sInfoPostFix":    "",
				"sLoadingRecords": "Chargement en cours...",
				"sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
				"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
				"oPaginate": {
					"sFirst":      "Premier",
					"sPrevious":   "Pr&eacute;c&eacute;dent",
					"sNext":       "Suivant",
					"sLast":       "Dernier"
				},
				"oAria": {
					"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
					"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
				}
			}
		});
	}

</script>

<div class="modal fade bd-example-modal-lg" id="intrant_detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="statut">Membres du ménage</h4>
					<button type="button"  class="close btn btn-outline-danger btn-sm" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="container-fluid" style="padding: 20px;">
					<center><span id="message_retour"></span></center>
					<div class="col-md-12">
						<table id='mydetail' class="table table-bordered table-striped table-hover table-condensed table-responsive" style="width: 100%;">
							<thead>
								<tr>
									<th>Membre</th>
									<th>Age</th>
									<th>Sexe</th>
									<th>Origine</th> 
									<th>Etat civil</th>
									<th>Email</th>
								</tr>
							</thead>

						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--------------- Fonction Details---------------------------------> 
<script>
	function detail(id=$ID)
	{
		$("#detail").modal("show");

		$(document).ready(function(){
			var row_count ="1000000";
			$("#mdetail").DataTable({
				"processing":true,
				"destroy" : true,
				"serverSide":true,
				"oreder":[[ 0, 'desc' ]],
				"ajax":{
					url:"<?=base_url()?>ihm/Menage/get_Detail/"+id,
					type:"POST"
				},
				lengthMenu: [[10,50, 100, row_count], [10,50, 100, "All"]],
				pageLength: 10,
				"columnDefs":[{
					"targets":[],
					"orderable":false
				}],

				dom: 'Bfrtlip',
				buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
				],
				language: {
					"sProcessing":     "Traitement en cours...",
					"sSearch":         "Rechercher&nbsp;:",
					"sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
					"sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
					"sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
					"sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
					"sInfoPostFix":    "",
					"sLoadingRecords": "Chargement en cours...",
					"sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
					"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
					"oPaginate": {
						"sFirst":      "Premier",
						"sPrevious":   "Pr&eacute;c&eacute;dent",
						"sNext":       "Suivant",
						"sLast":       "Dernier"
					},
					"oAria": {
						"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
						"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
					}
				}

			});
		})
	}
</script>

<script>
	function detail_menage(id=$ID)
	{
		$("#intrant_detail").modal("show");
		$(document).ready(function(){
			var row_count ="1000000";
			$("#mydetail").DataTable({
				"processing":true,
				"destroy" : true,
				"serverSide":true,
				"oreder":[[ 0, 'desc' ]],
				"ajax":{
					url:"<?=base_url()?>ihm/Menage/get_detail_menage/"+id,
					type:"POST"
				},
				lengthMenu: [[5,10,50, 100, row_count], [5,10,50, 100, "All"]],
				pageLength: 10,
				"columnDefs":[{
					"targets":[],
					"orderable":false
				}],

				dom: 'Bfrtlip',
				buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
				],
				language: {
					"sProcessing":     "Traitement en cours...",
					"sSearch":         "Rechercher&nbsp;:",
					"sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
					"sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
					"sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
					"sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
					"sInfoPostFix":    "",
					"sLoadingRecords": "Chargement en cours...",
					"sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
					"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
					"oPaginate": {
						"sFirst":      "Premier",
						"sPrevious":   "Pr&eacute;c&eacute;dent",
						"sNext":       "Suivant",
						"sLast":       "Dernier"
					},
					"oAria": {
						"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
						"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
					}
				}

			});
		})
	}
</script>
<!------------------------Modaal details------->
<div class="modal fade bd-example-modal-lg" id="detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="statut">Autres informations du ménage</h4>
					<button type="button"  class="close btn btn-outline-danger btn-sm" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="container-fluid" style="padding:30px;">
					<center><span id="message_retour"></span></center>
					<div class="col-md-12">
						<table id='mdetail' class="table table-bordered table-striped table-hover table-condensed  table-responsive" style="width: 100%;">
							<thead>
								<tr>
									
									<th>Code d'habitation</th>
									<th>Enfant de moins de 18 ans</th>
									<th>Nombre de décès</th>
									<th>Nouveau-né</th>
									<th>Nombre d'hommes</th>
									<th>Nombre de femmes</th>
									<th>Nombre de ménages</th>
									<th>Montant payé par mois</th>

								</tr>
							</thead>

						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</html>