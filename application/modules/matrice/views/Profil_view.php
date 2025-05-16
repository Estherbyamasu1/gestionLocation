
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
                <!-- <div class="heading1 mt-4 ml-5"> -->
                  <h2><?=$title; ?></h2>
                  <!-- </div> -->
                </div>

                <div class="col-lg-6">

                  <ul class="nav nav-pills nav-fill justify-content-around rounded shadow m-4">
                    <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['ajouter'])) echo 'active';?>"  href="<?=base_url('matrice/Profil/ajouter/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
                    <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('matrice/Profil/')?>"><i class="fa fa-list"></i>Liste</a></li>
                  </ul>
                </div>
              </div>


              <div class="full price_table padding_infor_info">

                <div class="row">
                  <div class="col-lg-12">
                    <div class="table">
                      <?= $this->session->flashdata('message');?>
                      <form method="post" action="<?=base_url('/matrice/Profil/ajout')?>">
                        <div class="row"> 
                          <div class="col-md-6">

                            <div class="form-group">
                              <label><b>Profil</b></label>
                              <input type="text" name="DESCRIPTION" class="form-control"  value="<?=set_value('DESCRIPTION');?>" placeholder="Entrer la description">

                              <span class="text-danger"><?php echo form_error("DESCRIPTION");?></span>
                              <?php
                              if ($this->session->has_userdata('dash')) {
                                echo '<div class="' . $this->session->dash['class'] . '" role="alert">' . $this->session->dash['message'] . '</div>';
                              }
                              ?>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <label>Code du profil</label>
                            <input type="text" name="CODE_PROFIL" class="form-control"  value="<?=set_value('CODE_PROFIL');?>" placeholder="Entrer le code du profil">
                            <span class="text-danger"><?php echo form_error("CODE_PROFIL");?></span>

                          </div>
                          <div class="col-md-12">
                            <label for="Ftype"><b>Module</b></label>
                            <div class="card">
                              <div class="card-body">
                                <div class="row">
                                 <?php
                                 $module=$this->Model->getRequete("SELECT `ID_MODULE`, `DESCRIPTION`, `STATUT` FROM `module`  WHERE 1 and STATUT=1 ORDER BY DESCRIPTION ASC ");  
                                 foreach ($module as $value) {
                                  ?>
                                  <div class='col-md-4'><label><input name='module[]' value='<?=$value['ID_MODULE'] ?>' type='checkbox' > <?=$value['DESCRIPTION'] ?></label></div>
                                  <?php
                                }
                                ?>       
                                <?php echo form_error('module[]', '<div class="text-danger">', '</div>'); ?>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <button type="submit" style="margin-top: 20px;" class="btn btn-dark  float-right">Enregistrer
                          </button>
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





<script type="text/javascript">
  $(document).ready(function(){
    
   var multipleCancelButton = new Choices('#module', {
    removeItemButton: true
  }); 
   
   
 });
</script>