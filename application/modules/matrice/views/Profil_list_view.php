
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
                                <div class="heading1 mt-4 ml-5">
                                    <h2><?=$title; ?></h2>
                                </div>
                            </div>

                            <div class="col-lg-6">

                              <ul class="nav nav-pills nav-fill justify-content-around rounded shadow m-4">
                              <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['ajouter'])) echo 'active';?>"  href="<?=base_url('matrice/Profil/ajouter/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
                              <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('matrice/Profil/')?>"><i class="fa fa-list"></i>Liste</a></li>
                          </ul>
                            </div>
                        </div>

            <div class="row">

              <div class="col-lg-12 table-responsive">
               <!-- <div style="overflow-x:auto;"> -->
                 <table id='mytable' class="table table-bordered table-striped table-hover" style="width: 100%;">
                  <thead class="font-weight-bold text-nowrap">
                    <tr>
                        <th  style="width: 5px;">#</th>
                                    <th >Profil</th>
                                    <th >Code Profil</th>
                                    <th >Module</th>
                                    <th >Statut</th>
                                    <th >Options</th>

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






<!-- ================modal pour detail===================================== -->



<div class="modal" id="detail" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div style="padding-left: 1em;padding-top: 1em">
          <left>
            Liste des modules du profil <i style="color:green;" id="titre"></i>
            
          </left>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id='mytable2'
            class="table table-bordered table-striped table-hover table-condensed "
            style="width: 100%;">
            <thead>
              <tr>
                <th>#</th>
                <th>Module</th>
                <th>Menu</th>
                <th>Statut</th>
              </tr>
            </thead>
            <tbody id="table2">

            </tbody>

          </table>

        </div>
        <div class="modal-footer">
          <button class="btn mb-1 btn-primary" class="close"
            data-dismiss="modal">Quitter</button>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- modal des menus -->

<div class="modal" id="detail_menu" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div style="padding-left: 1em;padding-top: 1em">
          <left>
            <h3>Liste des menus du module <i style="color:green;" id="titre_menu"></i>
            </h3>
          </left>

        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id='mytable_menu'
            class="table table-bordered table-striped table-hover table-condensed "
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
          <button class="btn mb-1 btn-primary" class="close"
            data-dismiss="modal">Quitter</button>
        </div>

      </div>
    </div>
  </div>
</div>



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
        url: "<?= base_url() ?>matrice/Profil/listing/",
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
  function get_module(id, DESCRIPTION) {
    $('#titre').html(DESCRIPTION)

    $("#detail").modal("show");
    var row_count = "1000000";
    table = $("#mytable2").DataTable({
      "processing": true,
      "destroy": true,
      "serverSide": true,
      "oreder": [[0, 'desc']],
      "ajax": {
        url: "<?= base_url() ?>matrice/Profil/detail/" + id,
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

  function affect(id) {
    $('#ID_PROFIL').val(id)
    $('#affect_module').modal('show');
  }

  function affectation() {
    ID_MODULE = $('#ID_MODULE').val()

    var statut = 1
    if (ID_MODULE == '') {
      statut = 0;
      $('#module_error').html('Le champ est obligatoire');
      $('#affect_module').modal('show');

    } else {
      statut = 1;
      $('#module_error').html('');
      $('#affect_module').modal('hide');

    }

    if (statut == 1) {
      myform.submit()
    }
  }
</script>

<!-- détail des menus par module et profil -->
<script>
  function get_menu(ID_MODULE, ID_PROFIL, MODULE) {
    $("#titre_menu").html(MODULE)
    $("#detail_menu").modal("show");

    var row_count = "1000000";
    table = $("#mytable_menu").DataTable({
      "processing": true,
      "destroy": true,
      "serverSide": true,
      "oreder": [[0, 'desc']],
      "ajax": {
        url: "<?= base_url() ?>matrice/Profil/detail_menu/" + ID_MODULE + '/' + ID_PROFIL,
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


<div class="modal fade" data-backdrop="static" id="affect_module">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <form method="POST" action="<?= base_url('matrice/Profil/affecter') ?>" id="myform">
          <div class="row">
            <input type="hidden" name="ID_PROFIL" id="ID_PROFIL">
            <div class="col-md-12">
              <label>Module</label>
              <select name="ID_MODULE" id="ID_MODULE" class="form-control">

                <option value="">sélectionner</option>
                <?php

                  $module = $this->Model->getRequete("SELECT `ID_MODULE`, `DESCRIPTION`, `STATUT` FROM `module` WHERE STATUT=1 ORDER BY `DESCRIPTION` ASC ");

                  foreach ($module as $value) {
                    if (set_value('ID_MODULE') == $value['ID_MODULE']) {
                      echo "<option value=" . $value['ID_MODULE'] . " >" . $value['DESCRIPTION'] . "</option>";
                    } else {
                      echo "<option value=" . $value['ID_MODULE'] . ">" . $value['DESCRIPTION'] . " </option>";
                    }
                  }

                  ?>
              </select>
              <span class="text-danger" id="module_error"></span>
            </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-info" type="button" onclick="affectation()" id="btnSave">Affecter</button>
      <button class='btn btn-secondary' data-dismiss='modal'>
        Quitter
      </button>
    </div>
  </div>
</div>
</div>