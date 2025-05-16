<!DOCTYPE html>
<html lang="en" class="h-100">

<head>

  <?php include VIEWPATH.'includes/header.php'; ?>

</head>

<body class="h-100">

  <div class="authincation h-100">
    <div class="container-fluid h-100">
      <div class="row justify-content-center h-100 align-items-center">
        <div class="col-md-6">
          <div class="authincation-content">
            <div class="row no-gutters">
              <div class="col-xl-12">
                <div class="auth-form">
                  <h4 class="text-center mb-4">Récuperer le mot de passe</h4>
                  <p id="message_success"></p>
                  <form id="form_recover" method="POST">
                    <div class="form-group">
                      <label><strong>Email</strong></label>
                      <input type="text" autocomplete="off" autofocus="" class="form-control" name="EMAIL" id="EMAIL">
                      <span class="help-block"></span>
                    </div>
                    <div class="text-center">
                      <button type="button" id="btnRecu" onclick="recove_pwd()" class="btn btn-primary btn-block">Récuperer</button>
                    </div>
                  </form>
                  <div class="new-account mt-3">
                    <p><a class="text-primary" href="<?=base_url('Login')?>">Retour</a></p>
                  </div>
                </div>
                <!-- <p><a href="<?=base_url('Login')?>">Retour</a></p> -->
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<?php include VIEWPATH.'includes/scripts_js.php'; ?>


</html>



<script>

  function recove_pwd()
  {

   $('#btnRecu').html('Chargement....');
   $('#btnRecu').attr("disabled",true);
   $('#message_success').html('');

   var url;
   url="<?php echo base_url('Recover_pwd/recover')?>";
   var formData = new FormData($('#form_recover')[0]);
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
      $('#message_success').html(data.message_success);
      window.location="<?=base_url('Login')?>";
    }
    else
    {
      for (var i = 0; i < data.inputerror.length; i++) 
      {
        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
      }
    }

    $('#btnRecu').text('Récuperer');
    $('#btnRecu').attr('disabled',false); 


  },
  error: function (jqXHR, textStatus, errorThrown)
  {
    alert('Erreur s\'est produite');
    $('#btnRecu').text('Récuperer');
    $('#btnRecu').attr('disabled',false);

  }


});



 }


</script>






