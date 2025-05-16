 
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
                                          <h2><?=$title?></h2>
                                       </div>
                                    </div>

                                    <div class="col-lg-6">
                                       <?php include('menu_user.php') ?>
                                    </div>
                              </div>
               
                              <div class="full price_table padding_infor_info">
                              
                                  
                                  
                                  <div class="row">
                                    <div class="col-lg-12">
                                       <div class="table-responsive-sm">
                                           <?=$this->table->generate()?>   
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



         <div class="modal" id="detail_menu" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">


        <div style="padding-left: 1em;padding-top: 1em">
          <left>
            <h3>Liste des provinces selon les roles <i style="color:green;" id="titre_menu"></i> </h3>
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
                <th>ROLE</th>
              <th>PROVINCE</th>
              <th>ACTION</th>
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




         <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header  d-flex justify-content-center">
        <h5 class="modal-title text-center text-white">Détail de l'utilisateur selon les bureaux</h5>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-12">
              <table id="mytable_detail" class="table table-striped dt-responsive nowrap w-100">
                <thead>
                  <tr>
                    <th>Bureau</th>
                    <th>Téléphone</th>
                    <th>Date d'affectation</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>

        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
       
        </div>
        </div>
        </div>
        </div>

<script>
   $(document).ready(function () {
      $('#tableau').DataTable();
      $('.dataTables_length').addClass('bs-select');
   });
</script>
       
   <script>

  function show_modal_bureau(id)
  {
    $('#detail-modal').modal('show');

    $(document).ready(function() {
     var row_count ="1000000";   
     table=$("#mytable_detail").DataTable({
      "processing":true,
      "serverSide":true,
      "destroy":true,
      "order":[],
      "ajax":{
        url:"<?=base_url('matrice/Users/detail_bureau/')?>"+id,
        type:"POST"
      },
      lengthMenu: [[5,10,50, 100, row_count], [5,10,50, 100, "All"]],
      pageLength: 5,
      "columnDefs": [
      { 
        "targets": [ -1 ],
        "orderable": false,
      },
      { 
        "targets": [-1], 
        "orderable": false, 
      },
      ]

      ,

      dom: 'Bfrtlip',
      buttons: [
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdfHtml5',
      'print'
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
   });
  }
</script>
       
   <script type="text/javascript">
  $('#message').delay('slow').fadeOut(3000);
</script>


<script>
  function get_role(USER_ID) {
    // $("#titre_menu").html(MODULE)
    $("#detail_menu").modal("show");
  //alert()
    var row_count = "1000000";
    table = $("#mytable_menu").DataTable({
      "processing": true,
      "destroy": true,
      "serverSide": true,
      "oreder": [[0, 'desc']],
      "ajax": {
        url: "<?= base_url() ?>matrice/Users/detail_role/" + USER_ID,
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
