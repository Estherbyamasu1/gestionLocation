
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
          <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['add_sous_menu'])) echo 'active';?>"  href="<?=base_url('matrice/Sous_menu/add_sous_menu/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
          <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('matrice/Sous_menu/')?>"><i class="fa fa-list"></i>Liste</a></li>
        </ul>
      </div>
    </div>


    <div class="full price_table padding_infor_info">

      <div class="row">
        <div class="col-lg-12">
          <div class="table">
          <?= $this->session->flashdata('message');?>
          
          <form method="POST" action="<?php echo base_url('matrice/Sous_menu/insert') ?>"
            class="form-horizontal">

            <div class="row">
              <div class="col-md-6">
                <label for=""> Sous menu</label>
                <input type="text" class="form-control" name="description" onclick="get_profil()">
                <?php echo form_error('description', '<div class="text-danger">', '</div>');
                ?>

                <?php
                    if ($this->session->has_userdata('dash')) {
                      echo '<div class="' . $this->session->dash['class'] . '" role="alert">' . $this->session->dash['message'] . '</div>';
                    }
                    ?>
              </div>
              <div class="col-md-6">

                <label for="">Menu</label>
                <select name="menu" id="menu" class="form-control" onchange="get_profil()">
                  <option value="">Sélectionner</option>
                  <?php
                  //print_r($idmenu);
                  $menu = $this->Model->getRequete("SELECT ID_MENU,DESCRIPTION,STATUT FROM `menu` WHERE  STATUT=1 AND `HAVE_SOUS_MENU`=1 ORDER BY DESCRIPTION ASC");
                    

                  foreach ($menu as $key) {

                    if ($key['ID_MENU'] == $idmenu) { ?>
                  <option value="<?= $key['ID_MENU'] ?>" selected=''><?= $key['DESCRIPTION'] ?></option>
                  <?php
                    } else { ?>
                  <option value="<?= $key['ID_MENU'] ?>"><?= $key['DESCRIPTION'] ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
                <?php echo form_error('menu', '<div class="text-danger">', '</div>'); ?>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <label>Contrôlleur</label>
                <input type="text" name="controlleur" class="form-control">
                <?php echo form_error('controlleur', '<div class="text-danger">', '</div>'); ?>
              </div>

              <div class="col-md-6" id="profil">
                            
                <?php echo form_error('profil[]', '<div class="text-danger">', '</div>'); ?>
              </div>
              
            </div>


            <div style="padding-top: 10px;">

              <button type="submit" class="btn btn-dark" style="float:right;">Enregistrer</button>
            </div>


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

<script>
  function get_profil() {
    var ID_MENU = $('#menu').val();
    $.ajax({
      url: "<?php echo base_url('matrice/Sous_menu/get_profil/'); ?>" + ID_MENU,
      data: {},
      processData: false,
      contentType: false,
      success: function (data) {
        $('#profil').html(data);

      },
    });

  }
</script>

