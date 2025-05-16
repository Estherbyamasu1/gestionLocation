
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
          <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['insert'])) echo 'active';?>"  href="<?=base_url('matrice/Menu/insert/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
          <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('matrice/Menu/')?>"><i class="fa fa-list"></i>Liste</a></li>
        </ul>
      </div>
    </div>


    <div class="full price_table padding_infor_info">

      <div class="row">
        <div class="col-lg-12">
          <div class="table">
            <?= $this->session->flashdata('message');?>

            <form enctype="multipart/form-data" id="file_form" name="file_form" method="post" class="form-horizontal" action="<?= base_url('matrice/Menu/insertion'); ?>">

              <div class="row">
                <input type="hidden" class="form-control" name="ID_MENU" value="<?= $ID_MENU ?>">
              <!-- <input type="text" class="form-control" name="SOUS_MENU" value="<?= $sous_men['ID_MENU'] ?>">
              -->
              <div class="col-md-6" id="profil">
                <label for="Ftype">Profil</label>
                <select class="form-control"  id="profil" name="profil">
                  <option selected>--séléctionner--</option>
                  <?php

                  foreach($prof as $key)
                  { 
                    if ($key['rol_id'] == set_value('profil')) {
                      echo "<option value='".$key['rol_id']."' >".$key['rol_description']."</option>";
                    }else{
                      echo "<option value='".$key['rol_id']."' >".$key['rol_description']."</option>";
                    }
                    
                  } ?>
                </select>

                <?php echo form_error("profil", '<div class="text-danger">', '</div>'); ?>


              </div>

              <!-- <div class="col-md-6" id="action" >
                <label for="Ftype">Actions</label>
                <select class="form-control select2" data-toggle="select2"  id="action[]" name="action[]" multiple >

                  <?php
                  
                  foreach ($action as $key)
                  {

                    echo "<option value='".$key['ID_ACTION']."' >".$key['DESCRIPTION']."</option>";


                  }
                  ?>
                </select>
                <?php echo form_error("action[]", '<div class="text-danger">', '</div>'); ?>
              </div> -->
              <div class="col-md-12" style="margin-top:41px;">
                <button type="submit" id="btnNew_File" style="float: right;" class="btn mb-1 btn-dark"> Enregistrer</button>
              </div> 
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
  $(document).ready(function(){

   var multipleCancelButton = new Choices('#PROFIL_ID', {
    removeItemButton: true

  }); 


 });
</script>

<script type="text/javascript">
  $('#message').delay('slow').fadeOut(3000);
</script>

<script>  
  function view() {    
    if(document.getElementById('flexRadioDefault1non').checked) {   

      document.getElementById('url-menu').style.display = "block";     
    } 
    if(document.getElementById('flexRadioDefault2oui').checked) {   

      document.getElementById('url-menu').style.display = "none";     
    }   

  }   
</script>  


<script>
  function get_profil()
  {
    var ID_MODULE=$('#ID_MODULE').val();
    //alert(ID_MODULE)
    $.ajax({
      url: "<?php echo base_url('matrice/Menu/get_profil/');?>"+ID_MODULE,
      type: "POST",
      data: {},
      processData: false,  
      contentType: false,
      success: function(data){

        $('#divmultiple').html(data);
      }
    });
  }
</script> 

