<!DOCTYPE html>
<html lang="en">

<head>
    <?php include VIEWPATH . 'includes_site/header_frontend.php'; ?>
</head>

<style type="text/css">
    /*.truncate {
  max-width:60%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

 .trclass {

      height:20px;

      font-weight:bold;

  }
  */
    .dt-body-nowrap {
        white-space: nowrap;
    }
</style>

<body>



    <!-- <?php //include VIEWPATH.'includes_site/menu_frontend.php'; 
            ?> -->


    <!-- dashboard inner -->
    <div class="midde_cont">
        <div class="container-fluid">
            <div class="row column_title">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid d-flex align-items-center">

                            <!-- Logo -->
                            <a class="navbar-brand me-4" href="<?= base_url() ?>">
                                <img src="<?= base_url() ?>logo/png_logo.png" width="100" alt="Logo">
                            </a>

                            <!-- Liens de navigation -->
                            <div class="d-flex align-items-center" style="font-family: 'Segoe UI', sans-serif; font-size: 16px; color: #333;">
                                <a class="nav-link me-3 <?php if (in_array($this->router->method, ['index'])) echo 'active'; ?>"
                                    href="<?= base_url() ?>Perso/index" style="font-weight: 500;">
                                    <i class="fa fa-calendar-o"></i> Mes demandes
                                </a>

                                <a class="nav-link me-3 <?php if (in_array($this->router->method, ['message'])) echo 'active'; ?>"
                                    href="<?= base_url() ?>Perso/paiement_demande" style="font-weight: 500;">
                                    <i class="fa fa-envelope"></i> Paiements
                                </a>

                                <a class="nav-link text-danger" href="<?= base_url('Login_Front/do_logout') ?>" style="font-weight: 500;">
                                    <i class="fa fa-sign-out"></i> Déconnexion
                                </a>
                            </div>

                        </div>
                    </nav>
                </div>
                <!-- row -->
                <div class="row mr-lg-5 ml-lg-5">
                    <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                                <div class="heading1 margin_0">
                                    <h2><?= lang('title_demande') ?></h2>
                                </div>
                            </div>
                            <div class="full price_table padding_infor_info">

                                <div class="row">

                                    <!-- profile -->
                                    <?php include 'menu_profil.php'; ?>

                                    <!-- end profile -->
                                    <div class="col-lg-9">
                                        <a class="btn btn-primary" href="<?=base_url('Perso/Faire_paiement')?>">Ajoute </a>

                                        <div class="tab-content">

                                            <div class="row">

                                                <!--    <div class="col-lg-12 table-responsive">
              
                 <table id='mytable' class="table table-bordered table-striped table-hover" style="width: 100%;">
                  <thead class="font-weight-bold text-nowrap"> -->



                                                <div class="table-responsive-sm">
                                                    <table id='mytable' class="table table-bordered table-hover table-striped" data-toggle="table" data-search="true" data-show-columns="true" data-pagination="true" style="width:100%">
                                                        <thead class="font-weight-bold text-nowrap">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>LOCATAIRE</th>
                                                                <th>MEUBLE</th>
                                                                <th>EMAIL</th>
                                                                <th>MONTANT</th>
                                                                <th>MODE</th>
                                                                <th>STATUT</th>
                                                                <th>PHOTO MEUBLE</th>
                                                                <!-- <th>ACTION</th> -->

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                    <!-- </div> -->
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>

                <?php include VIEWPATH . 'includes_site/footer_frontend.php'; ?>

</body>

</html>



<script>
    $(document).ready(function() {

        liste_doc();
    });

    function liste_doc() {

        // alert()
        var row_count = "1000000";

        $("#mytable").DataTable({
            "destroy": true,
            "serverSide": true,
            "oreder": [
                [0, 'desc']
            ],
            "ajax": {
                url: "<?= base_url() ?>Perso/liste_paiement",
                type: "POST"
            },
            lengthMenu: [
                [10, 50, 100, row_count],
                [10, 50, 100, "All"]
            ],
            pageLength: 10,
            "columnDefs": [{
                "targets": [],
                "className": 'dt-body-left',
                "orderable": false
            }],

            dom: 'Bfrtlip',
            buttons: [],
            language: {
                "sProcessing": "<?= lang('datatable_traitement') ?>",
                "sSearch": " <?= lang('datatable_rechercher') ?>",
                "sLengthMenu": "<?= lang('datatable_afficher') ?> _MENU_ <?= lang('datatable_elements') ?>",
                "sInfo": "<?= lang('datatable_affichage_elements') ?> _START_ <?= lang('datatable_a') ?> _END_ <?= lang('datatable_sur') ?> _TOTAL_ <?= lang('datatable_elements') ?>",
                "sInfoEmpty": "<?= lang('datatable_affichage_elements') ?> 0 <?= lang('datatable_a') ?> 0 <?= lang('datatable_sur') ?> 0 <?= lang('datatable_elements') ?>",
                "sInfoFiltered": "(<?= lang('datatable_filtre') ?> _MAX_ <?= lang('datatable_elements_total') ?>)",
                "sInfoPostFix": "",
                "sLoadingRecords": "<?= lang('datatable_loading') ?>",
                "sZeroRecords": "<?= lang('datatable_elements_afficher') ?>",
                "sEmptyTable": "<?= lang('datatable_donne_disponible') ?>",
                "oPaginate": {
                    "sFirst": "<?= lang('datatable_premier') ?>",
                    "sPrevious": "<?= lang('datatable_precedent') ?>",
                    "sNext": "<?= lang('datatable_suivant') ?>",
                    "sLast": "<?= lang('datatable_dernier') ?>"
                },
                "oAria": {
                    "sSortAscending": ": <?= lang('datatable_ordre_croissant') ?>",
                    "sSortDescending": ": <?= lang('datatable_ordre_decroissant') ?>"
                }
            }
        });
    }
</script>

<script type="text/javascript">
    function liste_visa() {
        var row_count = "1000000";
        $("#data_visa").DataTable({
            // "processing":true,
            "destroy": true,
            "serverSide": true,
            "oreder": [
                [0, 'desc']
            ],
            "ajax": {
                url: "<?= base_url() ?>person/Demande_Espace_Person/liste_visa",
                type: "POST"
            },
            lengthMenu: [
                [10, 50, 100, row_count],
                [10, 50, 100, "All"]
            ],
            pageLength: 10,
            "columnDefs": [{
                "targets": [],
                "className": 'dt-body-left',
                "orderable": false
            }],

            dom: 'Bfrtlip',
            buttons: [],
            language: {
                "sProcessing": "<?= lang('datatable_traitement') ?>",
                "sSearch": " <?= lang('datatable_rechercher') ?>",
                "sLengthMenu": "<?= lang('datatable_afficher') ?> _MENU_ <?= lang('datatable_elements') ?>",
                "sInfo": "<?= lang('datatable_affichage_elements') ?> _START_ <?= lang('datatable_a') ?> _END_ <?= lang('datatable_sur') ?> _TOTAL_ <?= lang('datatable_elements') ?>",
                "sInfoEmpty": "<?= lang('datatable_affichage_elements') ?> 0 <?= lang('datatable_a') ?> 0 <?= lang('datatable_sur') ?> 0 <?= lang('datatable_elements') ?>",
                "sInfoFiltered": "(<?= lang('datatable_filtre') ?> _MAX_ <?= lang('datatable_elements_total') ?>)",
                "sInfoPostFix": "",
                "sLoadingRecords": "<?= lang('datatable_loading') ?>",
                "sZeroRecords": "<?= lang('datatable_elements_afficher') ?>",
                "sEmptyTable": "<?= lang('datatable_donne_disponible') ?>",
                "oPaginate": {
                    "sFirst": "<?= lang('datatable_premier') ?>",
                    "sPrevious": "<?= lang('datatable_precedent') ?>",
                    "sNext": "<?= lang('datatable_suivant') ?>",
                    "sLast": "<?= lang('datatable_dernier') ?>"
                },
                "oAria": {
                    "sSortAscending": ": <?= lang('datatable_ordre_croissant') ?>",
                    "sSortDescending": ": <?= lang('datatable_ordre_decroissant') ?>"
                }
            }
        });
    }
</script>



<script type="text/javascript">
    function liste_rdv() {
        var row_count = "1000000";
        $("#data_rdv").DataTable({
            // "processing":true,
            "destroy": true,
            "serverSide": true,
            "oreder": [
                [0, 'desc']
            ],
            "ajax": {
                url: "<?= base_url() ?>person/Demande_Espace_Person/liste_rdv",
                type: "POST"
            },
            lengthMenu: [
                [10, 50, 100, row_count],
                [10, 50, 100, "All"]
            ],
            pageLength: 10,
            "columnDefs": [{
                "targets": [],
                "className": 'dt-body-left',
                "orderable": false
            }],

            dom: 'Bfrtlip',
            buttons: [],
            language: {
                "sProcessing": "<?= lang('datatable_traitement') ?>",
                "sSearch": " <?= lang('datatable_rechercher') ?>",
                "sLengthMenu": "<?= lang('datatable_afficher') ?> _MENU_ <?= lang('datatable_elements') ?>",
                "sInfo": "<?= lang('datatable_affichage_elements') ?> _START_ <?= lang('datatable_a') ?> _END_ <?= lang('datatable_sur') ?> _TOTAL_ <?= lang('datatable_elements') ?>",
                "sInfoEmpty": "<?= lang('datatable_affichage_elements') ?> 0 <?= lang('datatable_a') ?> 0 <?= lang('datatable_sur') ?> 0 <?= lang('datatable_elements') ?>",
                "sInfoFiltered": "(<?= lang('datatable_filtre') ?> _MAX_ <?= lang('datatable_elements_total') ?>)",
                "sInfoPostFix": "",
                "sLoadingRecords": "<?= lang('datatable_loading') ?>",
                "sZeroRecords": "<?= lang('datatable_elements_afficher') ?>",
                "sEmptyTable": "<?= lang('datatable_donne_disponible') ?>",
                "oPaginate": {
                    "sFirst": "<?= lang('datatable_premier') ?>",
                    "sPrevious": "<?= lang('datatable_precedent') ?>",
                    "sNext": "<?= lang('datatable_suivant') ?>",
                    "sLast": "<?= lang('datatable_dernier') ?>"
                },
                "oAria": {
                    "sSortAscending": ": <?= lang('datatable_ordre_croissant') ?>",
                    "sSortDescending": ": <?= lang('datatable_ordre_decroissant') ?>"
                }
            }
        });
    }
</script>




<script>
    function liste_Entree_sortie() {
        var row_count = "1000000";
        $("#data_entre").DataTable({
            "destroy": true,
            "serverSide": true,
            "oreder": [
                [0, 'desc']
            ],
            "ajax": {
                url: "<?= base_url() ?>person/Demande_Espace_Person/liste_Entree_sortie",
                type: "POST"
            },
            lengthMenu: [
                [10, 50, 100, row_count],
                [10, 50, 100, "All"]
            ],
            pageLength: 10,
            "columnDefs": [{
                "targets": [],
                "className": 'dt-body-left',
                "orderable": false
            }],
            dom: 'Bfrtlip',
            buttons: ['excel', 'csv', 'print', 'copy'],
            language: {
                "sProcessing": "<?= lang('datatable_traitement') ?>",
                "sSearch": " <?= lang('datatable_rechercher') ?>",
                "sLengthMenu": "<?= lang('datatable_afficher') ?> _MENU_ <?= lang('datatable_elements') ?>",
                "sInfo": "<?= lang('datatable_affichage_elements') ?> _START_ <?= lang('datatable_a') ?> _END_ <?= lang('datatable_sur') ?> _TOTAL_ <?= lang('datatable_elements') ?>",
                "sInfoEmpty": "<?= lang('datatable_affichage_elements') ?> 0 <?= lang('datatable_a') ?> 0 <?= lang('datatable_sur') ?> 0 <?= lang('datatable_elements') ?>",
                "sInfoFiltered": "(<?= lang('datatable_filtre') ?> _MAX_ <?= lang('datatable_elements_total') ?>)",
                "sInfoPostFix": "",
                "sLoadingRecords": "<?= lang('datatable_loading') ?>",
                "sZeroRecords": "<?= lang('datatable_elements_afficher') ?>",
                "sEmptyTable": "<?= lang('datatable_donne_disponible') ?>",
                "oPaginate": {
                    "sFirst": "<?= lang('datatable_premier') ?>",
                    "sPrevious": "<?= lang('datatable_precedent') ?>",
                    "sNext": "<?= lang('datatable_suivant') ?>",
                    "sLast": "<?= lang('datatable_dernier') ?>"
                },
                "oAria": {
                    "sSortAscending": ": <?= lang('datatable_ordre_croissant') ?>",
                    "sSortDescending": ": <?= lang('datatable_ordre_decroissant') ?>"
                }
            }
        });
    }
</script>


<script type="text/javascript">
    function get_tracking(id) {

        $('#tracking').modal('show');

        var row_count = "1000000";
        $("#data_tracking").DataTable({
            "destroy": true,
            "serverSide": true,
            "oreder": [
                [0, 'desc']
            ],
            "ajax": {
                url: "<?= base_url() ?>person/Demande_Espace_Person/detail_tracking/" + id,
                type: "POST"
            },
            lengthMenu: [
                [10, 50, 100, row_count],
                [10, 50, 100, "All"]
            ],
            pageLength: 10,
            "columnDefs": [{
                "className": "truncate dt-body-left",
                "targets": [0],
                "orderable": false
            }],
            createdRow: function(row) {
                $(row).find(".truncate").each(function() {
                    $(this).attr("title", this.innerText);
                });
            },
            dom: 'Bfrtlip',
            buttons: ['excel', 'csv', 'print', 'copy'],
            language: {
                "sProcessing": "<?= lang('datatable_traitement') ?>",
                "sSearch": " <?= lang('datatable_rechercher') ?>",
                "sLengthMenu": "<?= lang('datatable_afficher') ?> _MENU_ <?= lang('datatable_elements') ?>",
                "sInfo": "<?= lang('datatable_affichage_elements') ?> _START_ <?= lang('datatable_a') ?> _END_ <?= lang('datatable_sur') ?> _TOTAL_ <?= lang('datatable_elements') ?>",
                "sInfoEmpty": "<?= lang('datatable_affichage_elements') ?> 0 <?= lang('datatable_a') ?> 0 <?= lang('datatable_sur') ?> 0 <?= lang('datatable_elements') ?>",
                "sInfoFiltered": "(<?= lang('datatable_filtre') ?> _MAX_ <?= lang('datatable_elements_total') ?>)",
                "sInfoPostFix": "",
                "sLoadingRecords": "<?= lang('datatable_loading') ?>",
                "sZeroRecords": "<?= lang('datatable_elements_afficher') ?>",
                "sEmptyTable": "<?= lang('datatable_donne_disponible') ?>",
                "oPaginate": {
                    "sFirst": "<?= lang('datatable_premier') ?>",
                    "sPrevious": "<?= lang('datatable_precedent') ?>",
                    "sNext": "<?= lang('datatable_suivant') ?>",
                    "sLast": "<?= lang('datatable_dernier') ?>"
                },
                "oAria": {
                    "sSortAscending": ": <?= lang('datatable_ordre_croissant') ?>",
                    "sSortDescending": ": <?= lang('datatable_ordre_decroissant') ?>"
                }
            }
        });
    }
</script>

<script type="text/javascript">
    function get_visa_tracking(id) {

        $('#tracking_visa').modal('show');

        var row_count = "1000000";
        $("#data_tracking_visa").DataTable({
            "destroy": true,
            "serverSide": true,
            "oreder": [
                [0, 'desc']
            ],
            "ajax": {
                url: "<?= base_url() ?>person/Demande_Espace_Person/detail_visa_tracking/" + id,
                type: "POST"
            },
            lengthMenu: [
                [10, 50, 100, row_count],
                [10, 50, 100, "All"]
            ],
            pageLength: 10,
            "columnDefs": [{
                "className": "truncate dt-body-left",
                "targets": [0],
                "orderable": false
            }],
            createdRow: function(row) {
                $(row).find(".truncate").each(function() {
                    $(this).attr("title", this.innerText);
                });
            },
            dom: 'Bfrtlip',
            buttons: ['excel', 'csv', 'print', 'copy'],
            language: {
                "sProcessing": "<?= lang('datatable_traitement') ?>",
                "sSearch": " <?= lang('datatable_rechercher') ?>",
                "sLengthMenu": "<?= lang('datatable_afficher') ?> _MENU_ <?= lang('datatable_elements') ?>",
                "sInfo": "<?= lang('datatable_affichage_elements') ?> _START_ <?= lang('datatable_a') ?> _END_ <?= lang('datatable_sur') ?> _TOTAL_ <?= lang('datatable_elements') ?>",
                "sInfoEmpty": "<?= lang('datatable_affichage_elements') ?> 0 <?= lang('datatable_a') ?> 0 <?= lang('datatable_sur') ?> 0 <?= lang('datatable_elements') ?>",
                "sInfoFiltered": "(<?= lang('datatable_filtre') ?> _MAX_ <?= lang('datatable_elements_total') ?>)",
                "sInfoPostFix": "",
                "sLoadingRecords": "<?= lang('datatable_loading') ?>",
                "sZeroRecords": "<?= lang('datatable_elements_afficher') ?>",
                "sEmptyTable": "<?= lang('datatable_donne_disponible') ?>",
                "oPaginate": {
                    "sFirst": "<?= lang('datatable_premier') ?>",
                    "sPrevious": "<?= lang('datatable_precedent') ?>",
                    "sNext": "<?= lang('datatable_suivant') ?>",
                    "sLast": "<?= lang('datatable_dernier') ?>"
                },
                "oAria": {
                    "sSortAscending": ": <?= lang('datatable_ordre_croissant') ?>",
                    "sSortDescending": ": <?= lang('datatable_ordre_decroissant') ?>"
                }
            }
        });
    }
</script>

<script type="text/javascript">
    function get_traitement(id) {

        $('#treatement').modal('show');

        var row_count = "1000000";
        $("#data_treatement").DataTable({
            "processing": true,
            "destroy": true,
            "serverSide": true,
            "order": [
                [0, 'asc']
            ],
            "ajax": {
                url: "<?= base_url() ?>person/Demande_Espace_Person/detail_traitement/" + id,
                type: "POST",
            },
            lengthMenu: [
                [10, 50, 100, row_count],
                [10, 50, 100, "All"]
            ],
            pageLength: 10,
            "columnDefs": [{
                "targets": [0],
                "className": 'dt-body-left',
                "orderable": false
            }],

            dom: 'Bfrtlip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            language: {
                "sProcessing": "<?= lang('datatable_traitement') ?>",
                "sSearch": " <?= lang('datatable_rechercher') ?>",
                "sLengthMenu": "<?= lang('datatable_afficher') ?> _MENU_ <?= lang('datatable_elements') ?>",
                "sInfo": "<?= lang('datatable_affichage_elements') ?> _START_ <?= lang('datatable_a') ?> _END_ <?= lang('datatable_sur') ?> _TOTAL_ <?= lang('datatable_elements') ?>",
                "sInfoEmpty": "<?= lang('datatable_affichage_elements') ?> 0 <?= lang('datatable_a') ?> 0 <?= lang('datatable_sur') ?> 0 <?= lang('datatable_elements') ?>",
                "sInfoFiltered": "(<?= lang('datatable_filtre') ?> _MAX_ <?= lang('datatable_elements_total') ?>)",
                "sInfoPostFix": "",
                "sLoadingRecords": "<?= lang('datatable_loading') ?>",
                "sZeroRecords": "<?= lang('datatable_elements_afficher') ?>",
                "sEmptyTable": "<?= lang('datatable_donne_disponible') ?>",
                "oPaginate": {
                    "sFirst": "<?= lang('datatable_premier') ?>",
                    "sPrevious": "<?= lang('datatable_precedent') ?>",
                    "sNext": "<?= lang('datatable_suivant') ?>",
                    "sLast": "<?= lang('datatable_dernier') ?>"
                },
                "oAria": {
                    "sSortAscending": ": <?= lang('datatable_ordre_croissant') ?>",
                    "sSortDescending": ": <?= lang('datatable_ordre_decroissant') ?>"
                }
            }
        });
    }
</script>

<script type="text/javascript">
    function get_histo_statut(id) {
        $('#hitorique_doc').modal('show');

        var row_count = "1000000";
        $("#data_histo_doc").DataTable({
            "destroy": true,
            "serverSide": true,
            "oreder": [
                [0, 'desc']
            ],
            "ajax": {
                url: "<?= base_url() ?>person/Demande_Espace_Person/detail_histo_traite/" + id,
                type: "POST"
            },
            lengthMenu: [
                [10, 50, 100, row_count],
                [10, 50, 100, "All"]
            ],
            pageLength: 10,
            "columnDefs": [{
                "className": "truncate dt-body-left",
                "targets": [0],
                "orderable": false
            }],
            createdRow: function(row) {
                $(row).find(".truncate").each(function() {
                    $(this).attr("title", this.innerText);
                });
            },
            dom: 'Bfrtlip',
            buttons: ['excel', 'csv', 'print', 'copy'],
            language: {
                "sProcessing": "<?= lang('datatable_traitement') ?>",
                "sSearch": " <?= lang('datatable_rechercher') ?>",
                "sLengthMenu": "<?= lang('datatable_afficher') ?> _MENU_ <?= lang('datatable_elements') ?>",
                "sInfo": "<?= lang('datatable_affichage_elements') ?> _START_ <?= lang('datatable_a') ?> _END_ <?= lang('datatable_sur') ?> _TOTAL_ <?= lang('datatable_elements') ?>",
                "sInfoEmpty": "<?= lang('datatable_affichage_elements') ?> 0 <?= lang('datatable_a') ?> 0 <?= lang('datatable_sur') ?> 0 <?= lang('datatable_elements') ?>",
                "sInfoFiltered": "(<?= lang('datatable_filtre') ?> _MAX_ <?= lang('datatable_elements_total') ?>)",
                "sInfoPostFix": "",
                "sLoadingRecords": "<?= lang('datatable_loading') ?>",
                "sZeroRecords": "<?= lang('datatable_elements_afficher') ?>",
                "sEmptyTable": "<?= lang('datatable_donne_disponible') ?>",
                "oPaginate": {
                    "sFirst": "<?= lang('datatable_premier') ?>",
                    "sPrevious": "<?= lang('datatable_precedent') ?>",
                    "sNext": "<?= lang('datatable_suivant') ?>",
                    "sLast": "<?= lang('datatable_dernier') ?>"
                },
                "oAria": {
                    "sSortAscending": ": <?= lang('datatable_ordre_croissant') ?>",
                    "sSortDescending": ": <?= lang('datatable_ordre_decroissant') ?>"
                }
            }
        });
    }
</script>


<script type="text/javascript">
    function get_message(id) {
        $('#message_histo').modal('show');

        var row_count = "1000000";
        $("#message_histo_doc").DataTable({
            "destroy": true,
            "serverSide": true,
            "oreder": [
                [0, 'desc']
            ],
            "ajax": {
                url: "<?= base_url() ?>person/Demande_Espace_Person/detail_message/" + id,
                type: "POST"
            },
            lengthMenu: [
                [2, 10, 50, 100, row_count],
                [2, 10, 50, 100, "All"]
            ],
            pageLength: 2,
            "columnDefs": [{
                "className": "truncate dt-body-left",
                "targets": [0],
                "orderable": false
            }],
            createdRow: function(row) {
                $(row).find(".truncate").each(function() {
                    $(this).attr("title", this.innerText);
                });
            },
            dom: 'Bfrtlip',
            buttons: ['excel', 'csv', 'print', 'copy'],
            language: {
                "sProcessing": "<?= lang('datatable_traitement') ?>",
                "sSearch": " <?= lang('datatable_rechercher') ?>",
                "sLengthMenu": "<?= lang('datatable_afficher') ?> _MENU_ <?= lang('datatable_elements') ?>",
                "sInfo": "<?= lang('datatable_affichage_elements') ?> _START_ <?= lang('datatable_a') ?> _END_ <?= lang('datatable_sur') ?> _TOTAL_ <?= lang('datatable_elements') ?>",
                "sInfoEmpty": "<?= lang('datatable_affichage_elements') ?> 0 <?= lang('datatable_a') ?> 0 <?= lang('datatable_sur') ?> 0 <?= lang('datatable_elements') ?>",
                "sInfoFiltered": "(<?= lang('datatable_filtre') ?> _MAX_ <?= lang('datatable_elements_total') ?>)",
                "sInfoPostFix": "",
                "sLoadingRecords": "<?= lang('datatable_loading') ?>",
                "sZeroRecords": "<?= lang('datatable_elements_afficher') ?>",
                "sEmptyTable": "<?= lang('datatable_donne_disponible') ?>",
                "oPaginate": {
                    "sFirst": "<?= lang('datatable_premier') ?>",
                    "sPrevious": "<?= lang('datatable_precedent') ?>",
                    "sNext": "<?= lang('datatable_suivant') ?>",
                    "sLast": "<?= lang('datatable_dernier') ?>"
                },
                "oAria": {
                    "sSortAscending": ": <?= lang('datatable_ordre_croissant') ?>",
                    "sSortDescending": ": <?= lang('datatable_ordre_decroissant') ?>"
                }
            }
        });
    }
</script>


<script type="text/javascript">
    function get_visa_message(id) {
        // body...
        $('#message_histo_visa').modal('show');

        var row_count = "1000000";
        $("#message_visa").DataTable({
            "destroy": true,
            "serverSide": true,
            "oreder": [
                [0, 'desc']
            ],
            "ajax": {
                url: "<?= base_url() ?>person/Demande_Espace_Person/detail_message_visa/" + id,
                type: "POST"
            },
            lengthMenu: [
                [2, 10, 50, 100, row_count],
                [2, 10, 50, 100, "All"]
            ],
            pageLength: 2,
            "columnDefs": [{
                "className": "truncate dt-body-left",
                "targets": [0],
                //"className": 'dt-body-left',
                "orderable": false
            }],
            createdRow: function(row) {
                $(row).find(".truncate").each(function() {
                    $(this).attr("title", this.innerText);
                });
            },
            dom: 'Bfrtlip',
            buttons: ['excel', 'csv', 'print', 'copy'],
            language: {
                "sProcessing": "<?= lang('datatable_traitement') ?>",
                "sSearch": " <?= lang('datatable_rechercher') ?>",
                "sLengthMenu": "<?= lang('datatable_afficher') ?> _MENU_ <?= lang('datatable_elements') ?>",
                "sInfo": "<?= lang('datatable_affichage_elements') ?> _START_ <?= lang('datatable_a') ?> _END_ <?= lang('datatable_sur') ?> _TOTAL_ <?= lang('datatable_elements') ?>",
                "sInfoEmpty": "<?= lang('datatable_affichage_elements') ?> 0 <?= lang('datatable_a') ?> 0 <?= lang('datatable_sur') ?> 0 <?= lang('datatable_elements') ?>",
                "sInfoFiltered": "(<?= lang('datatable_filtre') ?> _MAX_ <?= lang('datatable_elements_total') ?>)",
                "sInfoPostFix": "",
                "sLoadingRecords": "<?= lang('datatable_loading') ?>",
                "sZeroRecords": "<?= lang('datatable_elements_afficher') ?>",
                "sEmptyTable": "<?= lang('datatable_donne_disponible') ?>",
                "oPaginate": {
                    "sFirst": "<?= lang('datatable_premier') ?>",
                    "sPrevious": "<?= lang('datatable_precedent') ?>",
                    "sNext": "<?= lang('datatable_suivant') ?>",
                    "sLast": "<?= lang('datatable_dernier') ?>"
                },
                "oAria": {
                    "sSortAscending": ": <?= lang('datatable_ordre_croissant') ?>",
                    "sSortDescending": ": <?= lang('datatable_ordre_decroissant') ?>"
                }
            }
        });
    }
</script>


<script type="text/javascript">
    function get_doc_message(id) {
        // body...
        $('#message_histo_document').modal('show');

        var row_count = "1000000";
        $("#message_doc").DataTable({
            "destroy": true,
            "serverSide": true,
            "oreder": [
                [0, 'desc']
            ],
            "ajax": {
                url: "<?= base_url() ?>person/Demande_Espace_Person/detail_message_doc/" + id,
                type: "POST"
            },
            lengthMenu: [
                [2, 10, 50, 100, row_count],
                [2, 10, 50, 100, "All"]
            ],
            pageLength: 2,
            "columnDefs": [{
                "className": "truncate dt-body-left",
                "targets": [0],
                "orderable": false
            }],
            createdRow: function(row) {
                $(row).find(".truncate").each(function() {
                    $(this).attr("title", this.innerText);
                });
            },
            dom: 'Bfrtlip',
            buttons: ['excel', 'csv', 'print', 'copy'],
            language: {
                "sProcessing": "<?= lang('datatable_traitement') ?>",
                "sSearch": " <?= lang('datatable_rechercher') ?>",
                "sLengthMenu": "<?= lang('datatable_afficher') ?> _MENU_ <?= lang('datatable_elements') ?>",
                "sInfo": "<?= lang('datatable_affichage_elements') ?> _START_ <?= lang('datatable_a') ?> _END_ <?= lang('datatable_sur') ?> _TOTAL_ <?= lang('datatable_elements') ?>",
                "sInfoEmpty": "<?= lang('datatable_affichage_elements') ?> 0 <?= lang('datatable_a') ?> 0 <?= lang('datatable_sur') ?> 0 <?= lang('datatable_elements') ?>",
                "sInfoFiltered": "(<?= lang('datatable_filtre') ?> _MAX_ <?= lang('datatable_elements_total') ?>)",
                "sInfoPostFix": "",
                "sLoadingRecords": "<?= lang('datatable_loading') ?>",
                "sZeroRecords": "<?= lang('datatable_elements_afficher') ?>",
                "sEmptyTable": "<?= lang('datatable_donne_disponible') ?>",
                "oPaginate": {
                    "sFirst": "<?= lang('datatable_premier') ?>",
                    "sPrevious": "<?= lang('datatable_precedent') ?>",
                    "sNext": "<?= lang('datatable_suivant') ?>",
                    "sLast": "<?= lang('datatable_dernier') ?>"
                },
                "oAria": {
                    "sSortAscending": ": <?= lang('datatable_ordre_croissant') ?>",
                    "sSortDescending": ": <?= lang('datatable_ordre_decroissant') ?>"
                }
            }
        });
    }
</script>


<!-- Modal  de tracking-->
<div class="modal fade" id="tracking" tabindex="-1" aria-labelledby="recul-rdv" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:white;">Liste de tracking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive-sm">
                    <table id='data_tracking' class="table table-bordered table-striped table-hover table-condensed table-responsive'" style="width:1000wh">
                        <thead style="background: #15283c" class="font-weight-bold text-nowrap">
                            <tr>
                                <!-- <th data-field="code" class="th-sm  text-white">Document </th>
                    <th data-field="code" class="th-sm  text-white">Nom</th> -->
                                <th data-field="code">Statut </th>
                                <th data-field="code">Date</th>

                            </tr>
                        </thead>

                        <tbody class="text-wrap">
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" onclick="confirm_rdv_demande()" id="btnConfirm" class="btn btn-primary">Confirmer</button> -->
            </div>

        </div>
    </div>
</div>



<!-- Modal  de tracking-->
<div class="modal fade" id="tracking_visa" tabindex="-1" aria-labelledby="recul-rdv" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:white;">Liste de tracking visa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive-sm">
                    <table id='data_tracking_visa' class="table table-bordered table-striped table-hover table-condensed table-responsive'" style="width:1000wh">
                        <thead style="background: #15283c" class="font-weight-bold text-nowrap">
                            <tr>
                                <!-- <th data-field="code" class="th-sm  text-white">Description </th>
                    <th data-field="code" class="th-sm  text-white">Nom</th> -->
                                <th data-field="code" class="th-sm  text-white">Statut </th>
                                <th data-field="code" class="th-sm  text-white">Date</th>

                            </tr>
                        </thead>

                        <tbody class="text-wrap">
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" onclick="confirm_rdv_demande()" id="btnConfirm" class="btn btn-primary">Confirmer</button> -->
            </div>

        </div>
    </div>
</div>



<!-- Modal  de tracking-->
<div class="modal fade" id="treatement" tabindex="-1" aria-labelledby="recul-rdv" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:white;">Liste de Traitement sur les documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive-sm">
                    <table id='data_treatement' class="table table-bordered table-striped table-hover" style="width: 100%;">
                        <thead class="font-weight-bold text-nowrap">
                            <tr>
                                <th>Statut </th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" onclick="confirm_rdv_demande()" id="btnConfirm" class="btn btn-primary">Confirmer</button> -->
            </div>

        </div>
    </div>
</div>



<!-- Modal  de historique de traitement sur les documents-->
<div class="modal fade" id="hitorique_doc" tabindex="-1" aria-labelledby="recul-rdv" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:white;">Liste des historiques sur l'avancement du document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive-sm">
                    <table id='data_histo_doc' class="table table-bordered table-striped table-hover table-condensed table-responsive'" style="width:1000wh">
                        <thead class="font-weight-bold text-nowrap">
                            <tr>
                                <th>Description </th>
                                <!-- <th data-field="code" class="th-sm  text-white">Nom</th>
                    <th data-field="code" class="th-sm  text-white">Observation </th> -->
                                <th>Date</th>

                            </tr>
                        </thead>

                        <tbody class="text-wrap">
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" onclick="confirm_rdv_demande()" id="btnConfirm" class="btn btn-primary">Confirmer</button> -->
            </div>

        </div>
    </div>
</div>


<!-- Modal  de historique les messages recus-->
<div class="modal fade" id="message_histo" tabindex="-1" aria-labelledby="recul-rdv" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:white;">Liste de Notifications sur les Entrée/Sortie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive-sm">
                    <table id='message_histo_doc' class="table table-bordered table-striped table-hover" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>MESSAGE </th>
                                <!-- <th >Nom</th>
                    <th >EMAIL </th>
                    <th >Date</th> -->

                            </tr>
                        </thead>

                        <tbody>
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" onclick="confirm_rdv_demande()" id="btnConfirm" class="btn btn-primary">Confirmer</button> -->
            </div>

        </div>
    </div>
</div>



<!-- Modal  de historique les messages recus-->
<div class="modal fade" id="message_histo_visa" tabindex="-1" aria-labelledby="recul-rdv" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:white;">Liste de Notifications sur le visa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive-sm">
                    <table id='message_visa' class="table table-bordered table-striped table-hover" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>MESSAGE </th>
                                <!-- <th data-field="code" class="th-sm  text-white">NOM</th>
                    <th data-field="code" class="th-sm  text-white">EMAIL </th>
                    <th data-field="code" class="th-sm  text-white">DATE</th> -->

                            </tr>
                        </thead>

                        <tbody style="color: black;font-weight: bold;">
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" onclick="confirm_rdv_demande()" id="btnConfirm" class="btn btn-primary">Confirmer</button> -->
            </div>

        </div>
    </div>
</div>



<!-- Modal  de historique les messages recus-->
<div class="modal fade" id="message_histo_document" tabindex="-1" aria-labelledby="recul-rdv" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:white;">Liste de Notifications sur les documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive-sm">
                    <table id='message_doc' class="table table-bordered table-striped  table-condensed table-responsive'" style="width:1000wh">
                        <thead style="background: #15283c" class="font-weight-bold text-nowrap">
                            <tr>
                                <th>MESSAGE </th>
                                <!-- <th data-field="code" class="th-sm  text-white">Nom</th>
                    <th data-field="code" class="th-sm  text-white">EMAIL </th>
                    <th data-field="code" class="th-sm  text-white">Date</th>
                -->
                            </tr>
                        </thead>

                        <tbody class="text-wrap">
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" onclick="confirm_rdv_demande()" id="btnConfirm" class="btn btn-primary">Confirmer</button> -->
            </div>

        </div>
    </div>
</div>