
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
          
          <form method="POST" action="<?php echo base_url('matrice/Users/affecter_province') ?>"
            class="form-horizontal">

            <div class="row">
              <input type="hidden" name="role_id" value="<?=$role_id; ?>">
              <input type="hidden" name="mbr_id" value="<?=$mbr_id; ?>">
              <div class="col-md-6">
                <label>Roles</label>
                <input type="text" readonly="" class="form-control" name="Role" value="<?=$role['rol_description']?>">
              </div>
              <div class="col-md-6">
                <label for=""> Province</label>
                <div class="card">
                  <div class="card-body">
                    <?php 
                      foreach ($province as $key) { ?>
                       <div class="col-md-6">
                         <input type="checkbox" name="province_id[]" value="<?=$key['province_id'] ?>"> <?=$key['province_name'] ?>
                       </div>
                    <?php  }

                    ?>
                  </div>
                </div>
              </div>
              
            </div>

           
            <div style="padding-top: 10px;">

              <button type="submit" class="btn btn-dark" style="float:right;">Affecter</button>
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

