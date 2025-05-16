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
          <div class="col-sm-12 p-md-0">
            <div class="welcome-text">
              <!-- <h4 style='color:#007bac'>Liste des utilisateurs</h4> -->
              
            </div>


            <div class="row">
                            <div class="col-lg-6">
                                <!-- <div class="heading1 mt-4 ml-5"> -->
                                    <h2><?=$title; ?></h2>
                                <!-- </div> -->
                            </div>

                            <div class="col-lg-6">

                              <ul class="nav nav-pills nav-fill justify-content-around rounded shadow m-4">
                              <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['insert'])) echo 'active';?>"  href="<?=base_url('matrice/Menu/insert/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
                              <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('matrice/Menu/')?>"><i class="fa fa-list"></i>Liste</a></li>
                          </ul>
                            </div>
                        </div>

            <div class="row">

              <div class="col-lg-12 table-responsive">
               <!-- <div style="overflow-x:auto;"> -->
                 <table id='mytable' class="table table-bordered table-striped table-hover" style="width: 100%;">
                  <thead class="font-weight-bold text-nowrap">
                    <tr>
                        <th >#</th>
                                        <th >Menu</th>
                                        <th >Module</th>
                                        <th >Contrôlleur</th>
                                        <th >Profil</th>
                                        <th >S.Menu</th>
                                        <th >Lien</th>
                                        <th >Statut</th>
                                        <th >Action</th>

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



  <?= include VIEWPATH.'includes/scripts_js.php'; ?>

</body>

<?= include VIEWPATH.'includes/legende.php' ?> 




</html>

// </tr>
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



</html>











<script>
  var table;
  var table1;

  $('#message').delay('slow').fadeOut(3000);
  $(document).ready(function () {
    liste();
  });

  function liste() {
    var row_count = "1000000";
    table = $("#mytable").DataTable({
      "processing": true,
      "destroy": true,
      "serverSide": true,
      "oreder": [[0, 'desc']],
      "ajax": {
        url: "<?= base_url() ?>matrice/Menu/listing/",
        type: "POST"
      },
      lengthMenu: [[10, 50, 100, row_count], [10, 50, 100, "All"]],
      pageLength: 10,
      "columnDefs": [{
        "targets": [],
        "orderable": false
      }],

      dom: 'Bfrtlip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ],
      language: {
        "sProcessing": "Traitement en cours...",
        "sSearch": "Rechercher&nbsp;:",
        "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
        "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
        "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        "sInfoPostFix": "",
        "sLoadingRecords": "Chargement en cours...",
        "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
        "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
        "oPaginate": {
          "sFirst": "Premier",
          "sPrevious": "Pr&eacute;c&eacute;dent",
          "sNext": "Suivant",
          "sLast": "Dernier"
        },
        "oAria": {
          "sSortAscending": ": activer pour trier la colonne par ordre croissant",
          "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
        }
      }

    });



  }

</script>
       
<script type="text/javascript">
  $('#message').delay('slow').fadeOut(3000);
</script>


<!------------------------ Modal de liste des profil ------------------------>
<div class="modal" id="detail" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Liste des profils du menu <i style="color:green;" id="title1"></i></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        <div class="table-responsive">

          <table id='mytable2' class="table table-bordered table-striped table-hover table-condensed "
            style="width: 100%;">
            <thead>
              <tr>
                <th>#</th>
                <th>Profil</th>
              </tr>
            </thead>

          </table>

        </div>
        <div><br>
          <button class="btn mb-1 btn-dark" style="float: right;" class="close" data-dismiss="modal">Quitter</button>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Script pour afficher le modal de Liste des profils -->

<script>
  function get_profil(id, name) {

    $("#title1").html(name);
    $("#detail").modal("show");



    var row_count = "1000000";
    table = $("#mytable2").DataTable({
      "processing": true,
      "destroy": true,
      "serverSide": true,
      "oreder": [[0, 'desc']],
      "ajax": {
        url: "<?= base_url() ?>matrice/Menu/detail/" + id,
        type: "POST"
      },
      lengthMenu: [[10, 50, 100, row_count], [10, 50, 100, "All"]],
      pageLength: 10,
      "columnDefs": [{
        "targets": [],
        "orderable": false
      }],



      language: {
        "sProcessing": "Traitement en cours...",
        "sSearch": "Rechercher&nbsp;:",
        "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
        "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
        "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        "sInfoPostFix": "",
        "sLoadingRecords": "Chargement en cours...",
        "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
        "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
        "oPaginate": {
          "sFirst": "Premier",
          "sPrevious": "Pr&eacute;c&eacute;dent",
          "sNext": "Suivant",
          "sLast": "Dernier"
        },
        "oAria": {
          "sSortAscending": ": activer pour trier la colonne par ordre croissant",
          "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
        }
      }

    });



  }

</script>

<!-- Script pour afficher le modal de Liste des profils -->

<script>
  function get_action(id, name) {

    $('#title').html(name)

    $("#action").modal("show");



    var row_count = "1000000";
    table = $("#mytable4").DataTable({
      "processing": true,
      "destroy": true,
      "serverSide": true,
      "oreder": [[0, 'desc']],
      "ajax": {
        url: "<?= base_url() ?>matrice/Menu/detail_act/" + id,
        type: "POST"
      },
      lengthMenu: [[10, 50, 100, row_count], [10, 50, 100, "All"]],
      pageLength: 10,
      "columnDefs": [{
        "targets": [],
        "orderable": false
      }],



      language: {
        "sProcessing": "Traitement en cours...",
        "sSearch": "Rechercher&nbsp;:",
        "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
        "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
        "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        "sInfoPostFix": "",
        "sLoadingRecords": "Chargement en cours...",
        "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
        "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
        "oPaginate": {
          "sFirst": "Premier",
          "sPrevious": "Pr&eacute;c&eacute;dent",
          "sNext": "Suivant",
          "sLast": "Dernier"
        },
        "oAria": {
          "sSortAscending": ": activer pour trier la colonne par ordre croissant",
          "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
        }
      }

    });



  }

</script>

<script>
  function get_sous_menu(id, name) {
    $("#title2").html(name);
    $("#sous_menu").modal("show");

    var row_count = "1000000";
    table = $("#mytable3").DataTable({
      "processing": true,
      "destroy": true,
      "serverSide": true,
      "oreder": [[0, 'desc']],
      "ajax": {
        url: "<?= base_url() ?>matrice/Menu/detail_sm/" + id,
        type: "POST"
      },
      lengthMenu: [[10, 50, 100, row_count], [10, 50, 100, "All"]],
      pageLength: 10,
      "columnDefs": [{
        "targets": [],
        "orderable": false
      }],



      language: {
        "sProcessing": "Traitement en cours...",
        "sSearch": "Rechercher&nbsp;:",
        "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
        "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
        "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        "sInfoPostFix": "",
        "sLoadingRecords": "Chargement en cours...",
        "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
        "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
        "oPaginate": {
          "sFirst": "Premier",
          "sPrevious": "Pr&eacute;c&eacute;dent",
          "sNext": "Suivant",
          "sLast": "Dernier"
        },
        "oAria": {
          "sSortAscending": ": activer pour trier la colonne par ordre croissant",
          "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
        }
      }

    });



  }

</script>

<!------------------------ Modal de liste des sous_menus ------------------------>


<div class="modal" id="sous_menu" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Liste des sous-menu du menu <i style="color:green;" id="title2"></i></h3>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id='mytable3' class="table table-bordered table-striped table-hover table-condensed "
            style="width: 100%;">
            <thead>
              <tr>
                <th>#</th>
                <th>Sous-menu</th>
                <th>Statut</th>
              </tr>
            </thead>
            <tbody id="table3">

            </tbody>

          </table>

        </div>
        <div><br>
          <button class="btn mb-1 btn-dark" style="float: right;" class="close" data-dismiss="modal">Quitter</button>
        </div>

      </div>
    </div>
  </div>
</div>


<!--------------- Modal de liste des profils affecter sur ce menu---------------->
<div class="modal" id="action" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-header">
          <h3>Liste des actions du menu <i style="color:green;" id="title"></i></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="table-responsive">
          <table id='mytable4' class="table table-bordered table-striped table-hover table-condensed "
            style="width: 100%;">
            <thead>
              <tr>
                <th>#</th>
                <th>Profil</th>
                <th>Action</th>
                <th>Statut</th>
              </tr>
            </thead>
            <tbody id="table4">

            </tbody>

          </table>

        </div>
        <div>
          <button class="btn mb-1 btn-primary" class="close" data-dismiss="modal">Quitter</button>
        </div>

      </div>
    </div>
  </div>
</div>


<!------------------------ Modal de liste des actions  ------------------------>
<div class="modal" id="actionProfil" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Liste des actions du profil <i style="color:green;" id="title5"></i></h3>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="table-responsive">
          <table id='mytable5' class="table table-bordered table-striped table-hover table-condensed "
            style="width: 100%;">
            <thead>
              <tr>
                <th>#</th>
                <th>Action</th>
                <th>Statut</th>
                <th>Retrait</th>
              </tr>
            </thead>
            <tbody id="table4">

            </tbody>

          </table>

        </div>
        <div>
          <button class="btn mb-1 btn-primary" class="close" data-dismiss="modal">Quitter</button>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  function get_action_profil(id, idmenu, name) {
    $("#title5").html(name)
    $("#actionProfil").modal("show");



    var row_count = "1000000";
    table = $("#mytable5").DataTable({
      "processing": true,
      "destroy": true,
      "serverSide": true,
      "oreder": [[0, 'desc']],
      "ajax": {
        url: "<?= base_url() ?>matrice/Menu/detail_act_profil/" + id + '/' + idmenu,
        type: "POST"
      },
      lengthMenu: [[10, 50, 100, row_count], [10, 50, 100, "All"]],
      pageLength: 10,
      "columnDefs": [{
        "targets": [],
        "orderable": false
      }],



      language: {
        "sProcessing": "Traitement en cours...",
        "sSearch": "Rechercher&nbsp;:",
        "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
        "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
        "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        "sInfoPostFix": "",
        "sLoadingRecords": "Chargement en cours...",
        "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
        "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
        "oPaginate": {
          "sFirst": "Premier",
          "sPrevious": "Pr&eacute;c&eacute;dent",
          "sNext": "Suivant",
          "sLast": "Dernier"
        },
        "oAria": {
          "sSortAscending": ": activer pour trier la colonne par ordre croissant",
          "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
        }
      }

    });



  }

</script>