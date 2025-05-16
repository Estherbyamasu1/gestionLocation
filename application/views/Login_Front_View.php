<!DOCTYPE html>
<html lang="en">
<head>
       <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="E-visa Burundi">

    <meta name="keywords" content="e-visa Burundi, procédure visa Burundi,formulaire visa Burundi, visa Burundi, evisa Burundi, CGM Burundi, commissariat général des migrations Burundi, visa étudiant Burundi ">

    <meta name="author" content="Mediabox Burundi">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="Mediabox Burundi, https://mediabox.bi/">
      <!-- site metas -->
<!--       <title>Connexion | Commissariat Général des Migrations</title> -->
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>logo/png_logo.png">
      <!-- site icon -->
      <!-- <link rel="icon" href="<?=base_url()?>assets/frontend/images/favicon-16x16.png" type="image/png" /> -->
      <!-- bootstrap css -->
      <link rel="stylesheet" href="<?=base_url()?>assets/frontend/css/bootstrap.min.css" />

      <!-- site css -->
      <link rel="stylesheet" href="<?=base_url()?>assets/frontend/login/style.css" />
      <!-- responsive css -->

       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
       <!-- font awesome -->
      <link rel="stylesheet" href="<?=base_url()?>assets/frontend/css/responsive.css" />
      <!-- color css -->
      <link rel="stylesheet" href="<?=base_url()?>assets/frontend/css/colors.css" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="<?=base_url()?>assets/frontend/css/bootstrap-select.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="<?=base_url()?>assets/frontend/css/perfect-scrollbar.css" />
      <!-- custom css -->
      <link rel="stylesheet" href="<?=base_url()?>assets/frontend/css/custom.css" />
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]login-->
   </head>
   <body class="inner_page " style=" background-image: url(<?=base_url()?>logo/maison7.JPG);background-color: #15283c;background-size: cover;background-repeat: no-repeat;">
      <div class="full_container">
         <div class="container">
            <div class="center verticle_center full_height">
               <div class="login_section">
                  <!-- <div class="logo_login"> -->
                    <br>
                     <div class="center">
                        <img width="100" src="<?=base_url()?>logo/png_logo.png" alt="#" />
                     </div>
                  <!-- </div> -->
                  <div class="login_form">

                      <h4 class="text-center">Connexion à l'espace personnel</h4><br>
                      <div class="form-group col-lg-12">
                        <?= $this->session->flashdata('sms') ?>
                      </div>
                      <form action="<?= base_url('Login_Front/do_login')?>" method="post">
                        <fieldset>
                           <div class="form-group col-lg-12">
                                    <label style="font-weight: 900; color:#454545">Adresse e-mail</label>
                                    <input type="text" name="inputUsername" class="form-control" placeholder="Adresse e-mail">
                                    <font color="red" class="help"><?php echo form_error('inputUsername'); ?></font>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label style="font-weight: 900; color:#454545">Mot de passe</label>
                                    <input type="password" id="pwd" name="inputPassword" class="form-control" placeholder="Mot de passe">
                                    <font color="red" class="help"><?php echo form_error('inputPassword'); ?></font>
                                </div>

                                <div class="form-group col-lg-12">
                                  <input type="checkbox" onchange="show_password()" name=""> <font color="black" class="help"> Afficher le mot de passe</font>
                                </div>

                                <div class="form-group col-lg-12 text-center">
                                     <button class="btn btn-primary rounded-pill px-5 py-2">Se connecter</button>
                                </div>

                               <!--  <center>
                                    <a class="forgot" href="<?=base_url('Login_Front/forgot_password')?>">Mot de passe oublié?</a>
                                </center> -->
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="<?=base_url()?>assets/frontend/js/jquery.min.js"></script>
      <script src="<?=base_url()?>assets/frontend/js/popper.min.js"></script>
      <script src="<?=base_url()?>assets/frontend/js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="<?=base_url()?>assets/frontend/js/animate.js"></script>
      <!-- select country -->
      <script src="<?=base_url()?>assets/frontend/js/bootstrap-select.js"></script>
      <!-- nice scrollbar -->
      <script src="<?=base_url()?>assets/frontend/js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>
</html>


<script type="text/javascript">
 function show_password() {
  var x = document.getElementById("pwd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
