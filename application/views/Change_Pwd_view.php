<!DOCTYPE html>
<html lang="en">

<head>

  <?php include VIEWPATH.'includes/header.php'; ?>

</head>

<body>

  <?php include VIEWPATH.'includes/loadpage.php'; ?>  
  <div id="main-wrapper">
    <?php include VIEWPATH.'includes/navybar.php'; ?> 
    <?php include VIEWPATH.'includes/menu.php'; ?> 
    <div class="content-body">
      <div class="container-fluid">
        <div class="row page-titles mx-0">
          <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
              <h4 style='color:#007bac'>MODIFIER LE MOT DE PASSE</h4>

            </div>
          </div>
          <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="javascript:void(0)"></a></li>
            </ol>
          </div>
        </div>
        <!-- row -->
        <div class="row">
          <div class="col-xl-12 col-xxl-12">
            <div class="card">
              <div class="card-header">
                <!-- <h4 class="card-title">COMPTE RENDU D'ACTIVITE</h4> -->
              </div>
              <div class="card-body">
                <div class="basic-form">
                 <form method="POST" id="myform" action="#">
                  

                  <div class="form-row">
                   <div class="col-md-4">
                    <label>Nouveau mot de passe <span style="color: red;">*</span></label>
                    <input type="password" autofocus="" name="NEW_PASSWORD" autocomplete="off" id="NEW_PASSWORD" class="form-control">
                    <span class="help-block"></span>
                  </div>

                  <div class="col-md-4">
                    <label>Confirmer le mot de passe <span style="color: red;"></span></label>
                    <input type="password" name="CONFIRMER_PASSWORD" id="CONFIRMER_PASSWORD"  class="form-control" autocomplete="off">
                    <span class="help-block"></span>
                  </div>

                  <div class="col-md-4">
                    <label>Ancien mot de passe <span style="color: red;"></span></label>
                    <input type="password" name="ANCIEN_PASSWORD" id="ANCIEN_PASSWORD"   class="form-control" autocomplete="off">
                    <span class="help-block"></span>
                  </div>
                </div>
                <br>

                <div class="form-group row">
                  <div class="col-md-12">
                    <button type="button" onclick="enr()" style="float: right;clear: both;" class="btn btn-primary" id="btnSave">Appliquer</button>
                  </div>

                </div>


              </form>
            </div>
          </div>
        </div>



      </div>
    </div>
  </div>
</div>



</div>



<?php include VIEWPATH.'includes/scripts_js.php'; ?>

</body>

<?php include VIEWPATH.'includes/legende.php'; ?> 


</html>


<script>
  $(document).ready(function() {
    $("input").change(function(){
      $(this).parent().parent().removeClass('has-error');
      $(this).next().empty();
    });

    
  });
</script>



<script>
  function enr()
  {

    $('#btnSave').text('Enregistrement.....');
    $('#btnSave').attr("disabled",true);

    var url;


    url="<?php echo base_url('Change_Pwd/changer')?>";

    var formData = new FormData($('#myform')[0]);
    $.ajax({

      url:url,
      type:"POST",
      data:formData,
      contentType:false,
      processData:false,
      dataType:"JSON",
      success: function(data)
      {
       if(data.status) 
       {
                  $('#myform')[0].reset();
                  window.location="<?=base_url('Login/do_logout')?>";

                }
                else
                {
                  for (var i = 0; i < data.inputerror.length; i++) 
                  {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                  }
                }

                $('#btnSave').text('Sauvegarder');
                $('#btnSave').attr('disabled',false); 


              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                alert('Erreur s\'est produite');
                $('#btnSave').text('Sauvegarder');
                $('#btnSave').attr('disabled',false);

              }


            });

  }

</script>
