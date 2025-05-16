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
                    <div class="col-xl-12 col-xxl-12">
                                     <div style="padding-top: 5px;" class="col-md-14">
                <table id='mytable' class="table table-bordered table-striped table-hover table-condensed  table-responsive" style="width: 100%;">
                  <thead>
                   <tr>
                       <th>#</th>
                       <th>LOCALITE </th>
                       <th>NUMERO SEQUENTIEL DU MENAGE</th>
                       <th>NUMERO DE VAGUE</th>
                       <th>REPONDANT</th>
                       <th>DESCRIPTION </th>
                       <th>DATE D'ENTRETIEN</th>
                      <!--  <th>TRAVAIL PENDANT 7 JOURS</th>
                       <th>ACTIVITE</th>
                       <th>EMPLOI DU CHEF DE MENAGE</th>
                       <th>MOTIF</th> -->
                       <th>MEMBRES DE MENAGES</th>
                       <th>TYPE DE LOGEMENT</th>
                       
                       <th>PIECES DE LOGEMENT</th>


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
        url:"<?=base_url()?>ihm/Menage_ajax/listing/",
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

  function detail_intra(id=$ID)
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
        url:"<?=base_url()?>ihm/Menage_ajax/get_Detail_intrant/"+id,
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


<div class="modal fade bd-example-modal-lg" id="intrant_detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="statut">Membres de la localité</h4>
          <button type="button"  class="close btn btn-outline-danger btn-sm" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="container-fluid" style="padding: 20px;">
          <center><span id="message_retour"></span></center>
          <div class="col-md-12">
           <table id='mydetail' class="table table-bordered table-striped table-hover table-condensed" style="width: 100%;">
            <thead>
              <tr>
                <th>Nom et Prenom</th>
                <th>Travailleur dans une exploitation agricole</th>
                
              </tr>
            </thead>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
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
        url:"<?=base_url()?>ihm/Menage_ajax/get_Detail/"+id,
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


<div class="modal fade bd-example-modal-lg" id="detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="statut">Details</h4>
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
                 <th>TRAVAIL PENDANT 7 JOURS</th>
                      <th>ACTIVITE</th>
                      <th>EMPLOI DU CHEF DE MENAGE</th>
                      <th>MOTIF</th>
                      <th>SOURCE D'ECLAIRAGE</th>
                      <th>SOURCE D'ENERGIE</th>
                      <th>CONSTITUANTS D'UN MUR</th>
                      <th>CONSTITUANTS DE TOIT</th>
                      <th>CONSTITUANTS DU SOL</th>
                      <th>TYPE DE LATRINES</th> 
                      <th>TELEVISION</th>
                      <th>RADIO</th>
                      <th>FER A REPASSER</th>
                      <th>GROUPE ELECTROGENE</th>
                      <th>MOTO</th>
                      <th>VOITURE</th>
                      <th>ANES</th>
                      <th>MERE</th>
                      <th>PERE</th>
                      <th>EXTRAIT DU MERE</th>
                      <th>EXTRAIT DU PERE</th>
                      <th>DATE D'NSERTION</th>
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
