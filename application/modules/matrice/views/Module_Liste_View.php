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
              <div class="welcome-text col-lg-6">
                <h2><?=$title; ?></h2>
               </div>
              <div class="col-lg-6">

                              <ul class="nav nav-pills nav-fill justify-content-around rounded shadow m-4">
                              <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['ajouter'])) echo 'active';?>"  href="<?=base_url('matrice/Module/ajouter/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
                              <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('matrice/Module/')?>"><i class="fa fa-list"></i>Liste</a></li>
                          </ul>
                            </div>
              
            </div>

            <div class="row">

              <div class="col-lg-12 table-responsive">
               <!-- <div style="overflow-x:auto;"> -->
                 <table id='mytable' class="table table-bordered table-striped table-hover" style="width: 100%;">
                  <thead class="font-weight-bold text-nowrap">
                    <tr>
                       <th class="th-sm text-white">#</th>
                                    <th class="th-sm text-white">Description</th>
                                    <th class="th-sm text-white">Mot clé</th>
                                    <th class="th-sm text-white">Controller</th>
                                    <th class="th-sm text-white">Icône</th>
                                    <th class="th-sm text-white">Menu</th>
                                    <th class="th-sm text-white">Statut</th>
                                    <th class="th-sm text-white">Actions</th>

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
        url: "<?= base_url() ?>index.php/matrice/Module/listing/",
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
       

<script>
  function get_menu(ID_MODULE, MODULE) {
    $("#titre_menu").html(MODULE)
    $("#detail_menu").modal("show");

    var row_count = "1000000";
    table = $("#mytable_menu").DataTable({
      "processing": true,
      "destroy": true,
      "serverSide": true,
      "oreder": [[0, 'desc']],
      "ajax": {
        url: "<?= base_url() ?>matrice/Module/detail_menu/" + ID_MODULE,
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

<!-- modal des menus -->

<div class="modal" id="detail_menu" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">


        <div style="padding-left: 1em;padding-top: 1em">
          <left>
            <h3>Liste des menus du module <i style="color:green;" id="titre_menu"></i> </h3>
          </left>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id='mytable_menu' class="table table-bordered table-striped table-hover table-condensed "
            style="width: 100%;">
            <thead>
              <tr>
                <th>#</th>
                <th>Menu</th>
                <th>Url</th>
                <th>Statut</th>
              </tr>
            </thead>

          </table>

        </div>
        <div class="modal-footer">
          <button class="btn mb-1 btn-primary" class="close" data-dismiss="modal">Quitter</button>
        </div>

      </div>
    </div>
  </div>
</div>