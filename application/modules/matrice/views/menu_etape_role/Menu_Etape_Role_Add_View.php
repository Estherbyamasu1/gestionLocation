
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
          <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['insert'])) echo 'active';?>"  href="<?=base_url('matrice/Menu_Etape_Profil/insert/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
          <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('matrice/Menu_Etape_Profil/')?>"><i class="fa fa-list"></i>Liste</a></li>
        </ul>
      </div>
    </div>


    <div class="full price_table padding_infor_info">

      <div class="row">
        <div class="col-lg-12">
          <div class="table">
            <?= $this->session->flashdata('message');?>


            <form method="POST" action="<?php echo base_url('matrice/Menu_Etape_Profil/add')?>" class="form-horizontal">
              <div class="row">

                <div class="col-md-6" >
                    <label>Menu</label>
                    <select name="ID_MENU" id="ID_MENU" onchange="get_profil();etape()" class="form-control">

                      <option value="">Sélectionner</option>
                      <?php
                      foreach ($mod as $value)
                      {
                        ?>
                        <!-- <option value="<?=$value['ID_MENU']?>"><?=$value['DESCRIPTION']?></option> -->

                        <option value="<?=$value['ID_MENU']?>"><?=$value['DESCR_MEN'].'('.$value['DESCR_MOD'].')'?></option>
                        <?php
                      }
                      ?>
                    </select>
                    <?php echo form_error('ID_MENU', '<div class="text-danger">', '</div>'); ?>
                  </div>

                  <div class="col-md-6" id="divmultiple1" style="display: none;">
                <label >Etape</label>
                <select  class="form-control" name="ETAPE_ID" id="ETAPE_ID" >
                   <option value="">Sélectionner</option>
                      <?php
                      foreach ($etape as $value)
                      {
                        ?>
                        <option value="<?=$value['statut_id']?>"><?=$value['statut_descr']?></option>
                        <?php
                      }
                      ?>
                </select>
                <font id="ETAPE_ID" color="red"></font>
              </div>

              <div class="col-md-6" >
                <label>Icône</label>
                <input type="text" name="DESCRIPTION" class="form-control">
                <?php echo form_error('DESCRIPTION', '<div class="text-danger">', '</div>'); ?>
                <?php
                    if ($this->session->has_userdata('dash')) {
                      echo '<div class="' . $this->session->dash['class'] . '" role="alert">' . $this->session->dash['message'] . '</div>';
                    }
                    ?>

                  </div> 
                
                  <div class="col-md-6" id="url-menu" style="display: none;">
                    <label>Lien</label>
                    <input type="text" name="controlleur" class="form-control">
                    <?php echo form_error('controlleur', '<div class="text-danger">', '</div>'); ?> 
                  </div>
                  
                  
               <!--  <div class="row">
 -->

                  <!-- <div class="col-md-6"> -->


                    <div class="col-md-6" id="divmultiple">
                      
                    <!-- </div>               -->

                    <?php echo form_error('profil[]', '<div class="text-danger">', '</div>'); ?>
                  </div>

                 
                 

                <!-- </div> -->




              

          </div><br>
        

            <div style="padding-top: 10px;">

              <button type="submit" class="btn btn-dark" style="float:right;" >Enregistrer</button>
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
   
   $('#divmultiple1').hide();
   $('#url-menu').hide();

 });
</script>

<script type="text/javascript">
  $('#message').delay('slow').fadeOut(3000);
</script>




<script>

 function etape(){

   var ID_MENU=$('#ID_MENU').val();
 
   if(ID_MENU==0){

     $('#divmultiple1').hide();
     $('#url-menu').hide();

   }else{

    $('#divmultiple1').show();
    $('#url-menu').show();

   }

 }

  function get_profil()
  {
    var ID_MENU=$('#ID_MENU').val();
    //alert(ID_MENU)
    $.ajax({
      url: "<?php echo base_url('matrice/Menu_Etape_Profil/get_profil/');?>"+ID_MENU,
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


<script>
  function get_etape()
  {
    var ID_MENU=$('#ID_MENU').val();
  

    $.ajax({
      url: "<?php echo base_url('matrice/Menu_Etape_Profil/get_etape/');?>"+ID_MENU,
      type: "POST",
      data: {},
      processData: false,  
      contentType: false,
      success: function(data){

        $('#divmultiple1').html(data);
      }
    });



}
</script> 

<!-- recupérer les categorie de visa -->


