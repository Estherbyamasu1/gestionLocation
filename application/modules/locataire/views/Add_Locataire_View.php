




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
                  <h2>Enregistrement des locataires</h2>
                <!-- </div> -->
              </div>

              <div class="col-lg-6">

                <ul class="nav nav-pills nav-fill justify-content-around rounded shadow m-4">
                  <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['nouveau'])) echo 'active';?>"  href="<?=base_url('locataire/Locataire/ajouter/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
                  <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('locataire/Locataire/')?>"><i class="fa fa-list"></i>Liste</a></li>
                </ul>
              </div>
              
            </div>
            <div class="full price_table padding_infor_info">
            <form id="form_new"  enctype="multipart/form-data" method="post" action="<?=base_url('locataire/Locataire/ajouter')?>" >
              


                <input type="hidden" name="id" >

                
                <div class="row">

                  <div class="col-md-6">
                    <span class="label-input100"><b>Nom</b><font color="red" >*</font></span>
                    <input type="text" name="NOM_LOCATAIRE" id="NOM_LOCATAIRE"  value="<?=set_value('NOM_LOCATAIRE');?>" class="form-control">
                    <span class="text-danger"><?php echo form_error("NOM_LOCATAIRE");?></span>
                    <?php
                    if ($this->session->has_userdata('dash')) {
                      echo '<div class="' . $this->session->dash['class'] . '" role="alert">' . $this->session->dash['message'] . '</div>';
                    }
                    ?>
                  </div>
                  <div class="col-md-6">
                    <span class="label-input100"><b>Prenom</b><font color="red" >*</font></span>
                    <input type="text" name="PRENOM_LOCATAIRE" id="PRENOM_LOCATAIRE"  value="<?=set_value('PRENOM_LOCATAIRE');?>" class="form-control">
                    <span class="text-danger"><?php echo form_error("PRENOM_LOCATAIRE");?></span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <span class="label-input100"><b>Telephone</b><font color="red" >*</font></span>
                    <input type="number" name="TELEPHONE" id="TELEPHONE"  value="<?=set_value('TELEPHONE');?>" class="form-control">
                    <span class="text-danger"><?php echo form_error("TELEPHONE");?></span>
                  </div>
                  <div class="col-md-6">
                    <span class="label-input100"><b>Email</b></span>
                    <input type="email" name="EMAIL" id="EMAIL"  value="<?=set_value('EMAIL');?>" class="form-control">
                    <span class="text-danger"><?php echo form_error("EMAIL");?></span>
                  </div>
                </div>
                <div class="row">
                        <div class="col-md-12">
                          <span class="label-input100"><b>Photo passeport</b><font color="red" >*</font></span>
                          <input type="text" name="IMAGE_LOCATAIRE" id="IMAGE_LOCATAIRE"  value="<?=set_value('IMAGE_LOCATAIRE');?>" class="form-control">
                          <span class="text-danger"><?php echo form_error("IMAGE_LOCATAIRE");?></span>
                        </div>
                       
                      </div>
                      
                <div class="row">
                  <div class="col-md-12" style="padding-top: 20px;">

                    <button type="submit" class="btn btn-dark" style="float:right;" >Enregistrer</button>
                  </div>
                </div>



            </form>
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









