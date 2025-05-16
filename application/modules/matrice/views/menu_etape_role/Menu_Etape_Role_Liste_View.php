 <!-- dashboard inner -->
  <div class="midde_cont">
      <div class="container-fluid">
         <div class="row column_title">
            <div class="col-md-12">
               <div class="page_title">
                  <?php // include('menu_document.php') ?>
               </div>
            </div>
         </div>
         <!-- row -->
         <div class="row column1">
            <div class="col-md-12">
               <div class="white_shd full margin_bottom_30">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="heading1 mt-4 ml-5">
                                    <h2><?=$title; ?></h2>
                                </div>
                            </div>

                            <div class="col-lg-6">

                              <ul class="nav nav-pills nav-fill justify-content-around rounded shadow m-4">
                              <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['insert'])) echo 'active';?>"  href="<?=base_url('matrice/Menu_Etape_Profil/insert/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
                              <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('matrice/Menu_Etape_Profil/')?>"><i class="fa fa-list"></i>Liste</a></li>
                          </ul>
                            </div>
                        </div>

                        <div class="full price_table padding_infor_info">
                            <?= $this->session->flashdata('message'); ?>                   
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="table-responsive-sm">
                                  <table id='mytable' class="table table-sm table-bordered table-hover table-striped">
                                    <thead style="background: #15283c" class="font-weight-bold text-nowrap">
                                      <tr>
                                        <th class="th-sm text-white">#</th>
                                        <th class="th-sm text-white">Menu</th>
                                        <!-- <th class="th-sm text-white">Module</th> -->
                                        <th class="th-sm text-white">Contrôlleur</th>
                                        <th class="th-sm text-white">Profil</th>
                                        <th class="th-sm text-white">Lien</th>
                                        <!-- <th class="th-sm text-white">Statut</th> -->
                                        <th class="th-sm text-white">Action</th>
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
            <!-- end row -->
         </div>
         <!-- footer -->
         <div class="container-fluid">
            <div class="row">
               <div class="footer">
                   <p id="copyright">Copyright &copy; <script> document.write(new Date().getFullYear())</script> - Conçu et développé par <a href="mediabox.bi">Mediabox SA Burundi <img alt="Mediabox Logo" width="30px" src="<?base_url()?>assets/backend/images/mediabox_logo.png"></a></p>
               </div>
            </div>
         </div>
      </div>
      <!-- end dashboard inner -->
   </div>
 </div>
</div>
</div>







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
        url: "<?= base_url() ?>matrice/Menu_Etape_Profil/listing/",
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