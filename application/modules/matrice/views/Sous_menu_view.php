 
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
                              <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['add_sous_menu'])) echo 'active';?>"  href="<?=base_url('matrice/Sous_menu/add_sous_menu/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
                              <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('matrice/Sous_menu/')?>"><i class="fa fa-list"></i>Liste</a></li>
                          </ul>
                            </div>
                        </div>

        
                  <div class="full price_table padding_infor_info">
                  
                      <div class="row">
                        <div class="col-lg-12">
                           <div class="table-responsive-sm">
                              <table id='mytable' class="table table-sm table-bordered table-hover table-striped table-responsive-sm">
                                <thead style="background: #15283c" class="font-weight-bold text-nowrap">
                                  <tr>
                                    <th class="th-sm text-white" style="width: 5px;">#</th>
                                    <th class="th-sm text-white">Sous.menu</th>
                                    <th class="th-sm text-white">Menu</th>
                                    <th class="th-sm text-white">Url</th>
                                    <th class="th-sm text-white">Contrôlleur</th>
                                    <th class="th-sm text-white">Profil</th>
                                    <th class="th-sm text-white">Statut</th>
                                    <th class="th-sm text-white">Action</th>
                                  </tr>
                                </thead>
                                <tbody id="table">

                                </tbody>
                              </table>  
                           </div>
                        </div>
                     </div>
                      
                      
                      <!-- <div class="row">
                        <div class="col-lg-12">
                           <div class="table-responsive-sm">
                              <table id='mytable' class="table table-sm table-bordered table-hover table-striped">
                                <thead style="background: #15283c" class="font-weight-bold text-nowrap">
                                  <tr>
                                    <th class="th-sm text-white">#</th>
                                    <th class="th-sm text-white">Sous.menu</th>
                                    <th class="th-sm text-white">Menu</th>
                                    <th class="th-sm text-white">Url</th>
                                    <th class="th-sm text-white">Contrôlleur</th>
                                    <th class="th-sm text-white">Profil</th>
                                    <th class="th-sm text-white">Statut</th>
                                    <th class="th-sm text-white">Action</th>
                                  </tr>
                                </thead>
                                <tbody id="table">
                                </tbody>
                              </table>

                           </div>
                        </div>
                     </div> -->
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

<!-- -----------------------------modal pour afficher la detail des profils---------------------- -->
        <div class="modal fade" id="all_profile">
            <div class="modal-dialog">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Liste des profils du sous menu <i style="color:green;" id="title"></i></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped" id="detail" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
<!-- ----------------modal pour afficher la detail des actions-------- -->
<div class="modal fade" id="all_action">
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Liste des actions du sous menu <i style="color:green;" id="title1"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="detail_action" style="width: 100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Profil</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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
        url: "<?= base_url() ?>matrice/Sous_menu/select_all_data/",
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
  

 function get_profil(id,name)
    {
        $("#title").html(name)

    $('#all_profile').modal('show');
    var row_count ="1000000";
    table=$("#detail").DataTable({
    "processing":true,
    "destroy" : true,
    "serverSide":true,
    "oreder":[[ 0, 'desc' ]],
    "ajax":{
    url:"<?=base_url()?>matrice/sous_menu/detail_profil/"+id,
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



    }


    // detail action

    function get_action(id,name)
    {

    $("#title1").html(name)
    $('#all_action').modal('show');
    var row_count ="1000000";
    table=$("#detail_action").DataTable({
    "processing":true,
    "destroy" : true,
    "serverSide":true,
    "oreder":[[ 0, 'desc' ]],
    "ajax":{
    url:"<?=base_url()?>matrice/sous_menu/detail_action/"+id,
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



    }

</script>


<script>
  function get_action_profil(id,idsousmenu,name)
    {
        $("#title2").html(name);
         $("#actionProfil").modal("show");
       var row_count ="1000000";
       table=$("#mytable5").DataTable({
          "processing":true,
          "destroy" : true,
          "serverSide":true,
          "oreder":[[ 0, 'desc' ]],
          "ajax":{
            url:"<?=base_url()?>matrice/sous_menu/detail_act_profil/"+id+'/'+idsousmenu,
            type:"POST"
        },
        lengthMenu: [[10,50, 100, row_count], [10,50, 100, "All"]],
        pageLength: 10,
        "columnDefs":[{
            "targets":[],
            "orderable":false
        }],

        
        
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



<!------------------------ Modal de liste des actions  ------------------------>
<div class="modal" id="actionProfil" role="dialog">
  <div class="modal-dialog modal-lg ">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Listes des actions de <i style="color:green;" id="title2"></i></h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
       <div class="modal-body">
        <div class="table-responsive">
            
          <table id='mytable5' class="table table-bordered table-striped table-hover table-condensed " style="width: 100%;">
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
        <div >      
          <button class="btn mb-1 btn-primary" class="close" data-dismiss="modal">Quitter</button>
        </div>

      </div>
    </div>
  </div>
</div>

</html>