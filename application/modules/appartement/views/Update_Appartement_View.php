




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
                  <h2>Enregistrement des appartements</h2>
                <!-- </div> -->
              </div>

              <div class="col-lg-6">

                <ul class="nav nav-pills nav-fill justify-content-around rounded shadow m-4">
                  <!-- <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['nouveau'])) echo 'active';?>"  href="<?=base_url('appartement/Appartement/ajouter/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li> -->
                  <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('appartement/Appartement/')?>"><i class="fa fa-list"></i>Liste</a></li>
                </ul>
              </div>
              
            </div>
            <div class="full price_table padding_infor_info">
            <form id="form_new"  enctype="multipart/form-data" method="post" action="<?=base_url('appartement/Appartement/update')?>" >
              


                <input type="hidden" name="ID_MEUBLE" id="ID_MEUBLE" class="form-control" value="<?php echo $meuble['ID_MEUBLE']?>" >

                <div class="row">

                  <div class="col-md-6">
                    <span class="label-input100"><b>Categorie</b><font color="red" >*</font></span>
                    <select name="ID_CATEGORIE" id="ID_CATEGORIE"  class="form-control">

                  <option value="">Sélectionner</option>
                  <?php
                  foreach ($cate as $value)
                  {
                    ?>
                    <option value="<?=$value['ID_CATEGORIE']?>"><?=$value['NOM_CATEGORIE']?></option>
                    <?php
                  }
                  ?>
                </select>
                    <span class="text-danger"><?php echo form_error("ID_CATEGORIE");?></span>
                    <?php
                    if ($this->session->has_userdata('dash')) {
                      echo '<div class="' . $this->session->dash['class'] . '" role="alert">' . $this->session->dash['message'] . '</div>';
                    }
                    ?>
                  </div>
                  <div class="col-md-6">
                    <span class="label-input100"><b>Image appartement</b><font color="red" >*</font></span>
                    <input type="file" name="IMAGE_MEUBLE" id="IMAGE_MEUBLE"  value="<?php echo $meuble['IMAGE_MEUBLE']?>" class="form-control">
                    <span class="text-danger"><?php echo form_error("IMAGE_MEUBLE");?></span>
                  </div>
                </div>
                <div class="row">

                  <div class="col-md-6">
                    <span class="label-input100"><b>Nom Appartement</b><font color="red" >*</font></span>
                    <input type="text" name="NOM_MEUBLE" id="NOM_MEUBLE"  value="<?php echo $meuble['NOM_MEUBLE']?>" class="form-control">
                    <span class="text-danger"><?php echo form_error("NOM_MEUBLE");?></span>
                    <?php
                    if ($this->session->has_userdata('dash')) {
                      echo '<div class="' . $this->session->dash['class'] . '" role="alert">' . $this->session->dash['message'] . '</div>';
                    }
                    ?>
                  </div>
                  <div class="col-md-6">
                    <span class="label-input100"><b>Numéro appartement</b><font color="red" >*</font></span>
                    <input type="text" name="NUMERO_MEUBLE" id="NUMERO_MEUBLE"  value="<?php echo $meuble['NUMERO_MEUBLE']?>" class="form-control">
                    <span class="text-danger"><?php echo form_error("NUMERO_MEUBLE");?></span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <span class="label-input100"><b>Montant</b><font color="red" >*</font></span>
                    <input type="number" name="MONTANT" id="MONTANT"  value="<?php echo $meuble['MONTANT']?>" class="form-control">
                    <span class="text-danger"><?php echo form_error("MONTANT");?></span>
                  </div>
                  <div class="col-md-6">
                    <span class="label-input100"><b>Nombre chambre</b></span>
                    <input type="number" name="NOMBRE_CHAMBRE" id="NOMBRE_CHAMBRE"  value="<?php echo $meuble['NOMBRE_CHAMBRE']?>" class="form-control">
                    <span class="text-danger"><?php echo form_error("NOMBRE_CHAMBRE");?></span>
                  </div>
                  <div class="col-md-6">
                    <span class="label-input100"><b>Adresse</b></span>
                    <input type="text" name="ADRESSE" id="ADRESSE"  value="<?php echo $meuble['ADRESSE']?>" class="form-control">
                    <span class="text-danger"><?php echo form_error("ADRESSE");?></span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12" style="padding-top: 20px;">

                    <button type="submit" class="btn btn-dark" style="float:right;" >Modifier</button>
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









