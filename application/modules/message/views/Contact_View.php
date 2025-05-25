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
                <h2 style='color:#007bac'>Information sur le site</h2>
               </div>
              <div class="col-lg-6">

                <!-- <ul class="nav nav-pills nav-fill justify-content-around rounded shadow m-4">
                  <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['insert'])) echo 'active';?>"  href="<?=base_url('appartement/Categorie/Add/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
                  <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('appartement/Categorie/')?>"><i class="fa fa-list"></i>Liste</a></li>
                </ul> -->
              </div>
              
            </div>

            <div class="row">

              <div class="col-lg-12 table-responsive">
               <!-- <div style="overflow-x:auto;"> -->
                 <table id='mytable' class="table table-bordered table-striped table-hover" style="width: 100%;">
                  <thead class="font-weight-bold text-nowrap">
                    <tr>
                      <th>#</th>
                      <th>NOM COMPLET</th>
                      <th>SUJET</th>
                      <th>EMAIL</th>
                      <th>DESCRIPTION</th>
                      <th>DATE</th>
                      <th>MESSAGE REPONDU</th>
                      <th>ACTION</th>

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
      url:"<?=base_url()?>message/Contact/listing/",
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



$(function() {
  $("body").tooltip({ selector: '[data-toggle=tooltip]' });
})
  
  function traiter_ticket(id)
  {

    // alert(id)
    // get_statut(id);
// Réinitialiser le formulaire
  $('#form_statut')[0].reset(); 
  $('.form-group').removeClass('has-error'); 
  $('.help-block').empty();


    $('#ticket-statut').modal('show');
    // $('.form-group').removeClass('has-error');
    // $('.help-block').empty(); 
    $('#DESCRIPTION').val('');
    $('#btnTraiter').text('Traiter');
    $('#btnTraiter').attr('disabled',false); 

    $.ajax({
      url : "<?php echo site_url('message/Contact/getOne')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {

        $('[name="ID_CONTACT_SITE"]').val(data.ID_CONTACT_SITE);
        
        actualiser_table();

      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Erreur lors de la modification');
      }
    });
  }




  function traitement()
  {

   $('#btnTraiter').html('Chargement....');
   $('#btnTraiter').attr("disabled",true);

   var formData = new FormData($('#form_statut')[0]);

   $.ajax({

    url:"<?php echo base_url('message/Contact/traite_ticket')?>",
    type:"POST",
    data:formData,
    contentType:false,
    processData:false,
    dataType:"JSON",
    success: function(data)
    {
     if(data.status) 
     {
  $('#form_statut')[0].reset();
      $('#ticket-statut').modal('hide');
      actualiser_table();
    }
    else
    {
      for (var i = 0; i < data.inputerror.length; i++) 
      {
        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
      }
    }

    $('#btnTraiter').text('Traiter');
    $('#btnTraiter').attr('disabled',false); 


  },
  error: function (jqXHR, textStatus, errorThrown)
  {
    alert('Erreur s\'est produite');
    $('#btnTraiter').text('Traiter');
    $('#btnTraiter').attr('disabled',false);

  }

});

 }


</script>


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



<div class="modal fade" data-backdrop="static" id="ticket-statut">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title-plainte">Traitement des informations  </b></h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-2">
          </div>
          <div class="col-12">
           <form id="form_statut">
            <div class="form-body">
              <!-- <div class="row"> -->
                <input type="hidden" name="ID_CONTACT_SITE" id="ID_CONTACT_SITE">
               

                <div class="col-md-12">
<!-- id="div_comment" -->
                  <div class="form-group" >
                    <label>Reponse</label>
                    <textarea autofocus class="form-control" name="COMMENTAIRE" id="COMMENTAIRE"></textarea>
                    <span class="help-block"></span>
                  </div>


                </div>

                <!-- </div> -->
              </div>

            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnTraiter" onclick="traitement()" class="btn btn-dark">Traiter</button>
      </div>
    </div>
  </div>
</div>