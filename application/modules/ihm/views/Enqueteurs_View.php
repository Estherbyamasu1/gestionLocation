
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
              <h4 style='color:#007bac'></h4>
            </div>
            <h2 class="text-center">LISTE DES ENQUETEURS </h2>

          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-md-12">
          <!-- <div style="padding-top: 5px;" class="col-md-14"> -->
            <table id='mytable' class="table table-bordered table-striped table-hover table-condensed  table-responsive" style="width: 100%;">
              <thead>
               <tr>
                 <th>#</th>
                 <th>NOM </th>
                 <th>PRENOM</th>
                 <th>TELEPHONE</th>
                 <th>EMAIL</th>
                 <th>PROVINCE</th>
                 <th>COMMUNE</th>
                 <th>ZONE</th>
                 <th>COLLINE</th>
                 <th>SEXE</th>
                 <th>DATE DE NAISSANCE</th>
                 <th>NIVEAU D'ETUDE</th>
                 <th>CIVILITE</th>
                 
                 
               </tr>
             </thead>
             <tbody id="table">

             </tbody>
           </table>


           <!-- </div> -->
           
           
           
         </div>
       </div>
     </div>
   </div>
   


 </div>
 
 
 
 <?= include VIEWPATH.'includes/scripts_js.php'; ?>

</body>

<?= include VIEWPATH.'includes/legende.php' ?> 





</html>

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
      url:"<?=base_url()?>ihm/Enqueteurs/listing/",
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



<?= include VIEWPATH.'includes/scripts_js.php'; ?>

</body>

<?= include VIEWPATH.'includes/legende.php' ?> 




</html>
