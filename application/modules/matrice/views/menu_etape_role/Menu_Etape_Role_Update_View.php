
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
          <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['insert'])) echo 'active';?>"  href="<?=base_url('matrice/Menu_Etape_Profil/insert')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
          <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('matrice/Menu_Etape_Profil')?>"><i class="fa fa-list"></i>Liste</a></li>
        </ul>
      </div>
    </div>


    <div class="full price_table padding_infor_info">

      <div class="row">
        <div class="col-lg-12">
          <div class="table">
          <?= $this->session->flashdata('message');?>
          

        <form method="POST" action="<?php echo base_url('matrice/Menu_Etape_Profil/update')?>" class="form-horizontal">
          <div class="row">
            <input type="hidden" name="ID_MENU_ETAPE_ROLE" id="ID_MENU_ETAPE_ROLE" class="form-control" value="<?php echo $men['ID_MENU_ETAPE_ROLE']?>">
            

            <div class="col-md-6" >
              <label>Menu</label>
               
                <select class="form-control" name="ID_MENU" id="ID_MENU">
                  <option value="">---Sélectionner---</option>
                  <?php
                  foreach ($menu as $key)
                  {
                    if ($key['ID_MENU'] == $men['ID_MENU'])
                    {
                      echo "<option value='".$key['ID_MENU']."' selected=''>".$key['DESCR_MEN']."(".$key['DESCR_MOD'].")</option>";
                    }
                    else
                    {
                      echo "<option value='".$key['ID_MENU']."'>".$key['DESCR_MEN']."(".$key['DESCR_MOD'].")</option>";
                    }
                  }
                  ?>
                </select>
                <?php echo form_error('ID_MENU', '<div class="text-danger">', '</div>'); ?>
            </div>  

            <div class="col-md-6">
              <label>Lien</label>
                <input type="text" name="LINK" id="LINK" class="form-control" value="<?php echo $men['LINK']?>">
                  <?php echo form_error('LINK', '<div class="text-danger">', '</div>'); ?>
            </div>
            <div class="col-md-6">
              <label>Description</label>
                <input type="text" name="DESCRIPTION" id="DESCRIPTION" class="form-control" value="<?php echo $men['DESCRIPTION']?>">
                  <?php echo form_error('DESCRIPTION', '<div class="text-danger">', '</div>'); ?>
            </div>                           
            
          </div>
          <div class="row">
            

            <div class="col-md-6">
              <label for="Ftype">Profil</label>
              <div class="card"><div class="card-body">

                <div class="row">
                  <?php
                  $profiles=$this->Model->getRequete('SELECT rol_id, rol_description FROM roles WHERE 1 and rol_active=1 order BY rol_description ASC');
                  foreach ($profiles as $key) {

                    if(in_array($key['rol_id'],$prof)) 
                      {  ?>

                        <div class='col-md-4'><label><input name='profil[]' value='<?=$key['rol_id'] ?>' type='checkbox' checked > <?=$key['rol_description'] ?></label></div>

                        <?php
                      }else{ ?>
                        <div class='col-md-4'><label><input name='profil[]' value='<?=$key['rol_id'] ?>' type='checkbox' > <?=$key['rol_description'] ?></label></div>
                      <?php  }
                    }
                    ?>       

                    <?php echo form_error('profil[]', '<div class="text-danger">', '</div>'); ?>
                </div>
              </div></div>
            </div>


            <div class="col-md-6" >
              <label>Etape</label>
               
                <select class="form-control" name="ETAPE_ID" id="ETAPE_ID">
                  <option value="">---Sélectionner---</option>
                  <?php
                  foreach ($etape as $key)
                  {
                    if ($key['statut_id'] == $men['ETAPE_ID'])
                    {
                      echo "<option value='".$key['statut_id']."' selected=''>".$key['statut_descr']."</option>";
                    }
                    else
                    {
                      echo "<option value='".$key['statut_id']."'>".$key['statut_descr']."</option>";
                    }
                  }
                  ?>
                </select>
                <?php echo form_error('ETAPE_ID', '<div class="text-danger">', '</div>'); ?>
            </div>

           
            
          </div> 
        
          <div style="padding-top: 10px;">
            
            <button type="submit" class="btn btn-dark" style="float:right;" >Modifier</button>
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


