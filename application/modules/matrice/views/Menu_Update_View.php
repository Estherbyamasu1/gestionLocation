

<link rel="stylesheet" href="<?=base_url()?>assets/backend/css/choices.min.css">
<script src="<?=base_url()?>assets/backend/js/choices.min.js"></script>




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
                    

                    <form method="POST" action="<?php echo base_url('matrice/Menu/update')?>" class="form-horizontal">
                      <div class="row">
                        <input type="hidden" name="ID_MENU" id="ID_MENU" class="form-control" value="<?php echo $men['ID_MENU']?>">
                        <div class="col-md-6">
                          <label>Menu</label>
                          <input type="text" name="MENU" id="MENU" class="form-control" value="<?php echo $men['DESCRIPTION']?>">
                          <?php echo form_error('MENU', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <div class="col-md-6" >
                          <label>Module</label>
                          
                          <select class="form-control" name="ID_MODULE" id="ID_MODULE">
                            <option value="">---Sélectionner---</option>
                            <?php
                            foreach ($module as $key)
                            {
                              if ($key['ID_MODULE'] == $men['ID_MODULE'])
                              {
                                echo "<option value='".$key['ID_MODULE']."' selected=''>".$key['DESCRIPTION']."</option>";
                              }
                              else
                              {
                                echo "<option value='".$key['ID_MODULE']."'>".$key['DESCRIPTION']."</option>";
                              }
                            }
                            ?>
                          </select>
                          <?php echo form_error('ID_MODULE', '<div class="text-danger">', '</div>'); ?>
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

                          <?php 
                          if ($men['HAVE_SOUS_MENU'] == 0) { ?>
                          <div class="col-md-6">
                            <label>Url</label>
                            <input type="text" name="controlleur" id="URL" class="form-control" value="<?php echo $men['URL']?>">
                            <!-- <?php echo form_error('controlleur', '<div class="text-danger">', '</div>'); ?> -->
                          </div>
                          <?php 
                        }
                        ?>
                        
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


      </div>
    </div>



  </div>



  <?= include VIEWPATH.'includes/scripts_js.php'; ?>

</body>

<?= include VIEWPATH.'includes/legende.php' ?> 





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
            

            <form method="POST" action="<?php echo base_url('matrice/Menu/update')?>" class="form-horizontal">
              <div class="row">
                <input type="hidden" name="ID_MENU" id="ID_MENU" class="form-control" value="<?php echo $men['ID_MENU']?>">
                <div class="col-md-6">
                  <label>Menu</label>
                  <input type="text" name="MENU" id="MENU" class="form-control" value="<?php echo $men['DESCRIPTION']?>">
                  <?php echo form_error('MENU', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="col-md-6" >
                  <label>Module</label>
                  
                  <select class="form-control" name="ID_MODULE" id="ID_MODULE">
                    <option value="">---Sélectionner---</option>
                    <?php
                    foreach ($module as $key)
                    {
                      if ($key['ID_MODULE'] == $men['ID_MODULE'])
                      {
                        echo "<option value='".$key['ID_MODULE']."' selected=''>".$key['DESCRIPTION']."</option>";
                      }
                      else
                      {
                        echo "<option value='".$key['ID_MODULE']."'>".$key['DESCRIPTION']."</option>";
                      }
                    }
                    ?>
                  </select>
                  <?php echo form_error('ID_MODULE', '<div class="text-danger">', '</div>'); ?>
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

                  <?php 
                  if ($men['HAVE_SOUS_MENU'] == 0) { ?>
                  <div class="col-md-6">
                    <label>Url</label>
                    <input type="text" name="controlleur" id="URL" class="form-control" value="<?php echo $men['URL']?>">
                    <!-- <?php echo form_error('controlleur', '<div class="text-danger">', '</div>'); ?> -->
                  </div>
                  <?php 
                }
                ?>
                
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


