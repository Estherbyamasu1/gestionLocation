
<link rel="stylesheet" href="<?=base_url()?>assets/backend/css/choices.min.css">
<script src="<?=base_url()?>assets/backend/js/choices.min.js"></script>



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
          <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('matrice/Users/')?>"><i class="fa fa-list"></i>Liste</a></li>
        </ul>
      </div>
    </div>


    <div class="full price_table padding_infor_info">

      <div class="row">
        <div class="col-lg-12">
          <div class="table">
          <?= $this->session->flashdata('message');?>
          
          <form method="POST" action="<?php echo base_url('matrice/Users/nouveauPassword') ?>"
            class="form-horizontal">

            <div class="row">
             <input type="hidden" name="id" id="id" value="<?= $id?>">
         <div class="form-group col-lg-6">
          <label style="font-weight: 900; color:#454545"><?=lang('ancien_mot_passe')?></label>
          <input type="password" id="password" name="password" autocomplete="off" class="form-control" placeholder="<?=lang('ancien_mot_passe')?>"  max="10">
          <font color="red" class="help"><?php echo form_error('password'); ?></font>
        </div>

        <div class="form-group col-lg-6">
          <label style="font-weight: 900; color:#454545"><?=lang('Nouveau_mot_passe')?></label>
          <input type="password" id="npassword" name="npassword" autocomplete="off" class="form-control" placeholder="<?=lang('Nouveau_mot_passe')?>" max="10">
          <font color="red" class="help"><?php echo form_error('npassword'); ?></font>
        </div>


        <div class="form-group col-lg-6">
          <label style="font-weight: 900; color:#454545"><?=lang('Confirmer_passe')?></label>
          <input type="password" id="cnfpassword" name="cnfpassword" autocomplete="off" class="form-control" placeholder="<?=lang('Nouveau_mot_passe')?>" max="10">
          <font color="red" class="help"><?php echo form_error('cnfpassword'); ?></font>
        </div>

        <div class="form-group col-lg-12">
          <input type="checkbox" onchange="show_password()" name=""> <font color="black" class="help"> Afficher le mot de passe</font>
        </div>

        <div class="form-group col-lg-12 text-center">
          <button  class="btn btn-dark"  style="float:right;" >Changer</button>
        </div>
<!-- 
        <center>
          <a class="forgot" href="<?=base_url('Login/forgetpassword')?>">Mot de passe oublié?</a>
        </center> -->
             
              
            </div>

           <!-- 
            <div style="padding-top: 10px;">

              <button type="submit" class="btn btn-dark" style="float:right;">Affecter</button>
            </div> -->


          </form>

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



<script type="text/javascript">
  $('#message').delay('slow').fadeOut(3000);
</script>

<style>
  #message {
    font-size: 20px;
    font-weight: bold;
    border-radius: 10px;
    color: white;
  }
</style>

<script type="text/javascript">
 function show_password() {
  var x = document.getElementById("cnfpassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>



