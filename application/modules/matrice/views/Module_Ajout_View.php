




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
                  <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['nouveau'])) echo 'active';?>"  href="<?=base_url('matrice/Module/ajouter/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
                  <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('matrice/Module/')?>"><i class="fa fa-list"></i>Liste</a></li>
                </ul>
              </div>
              
            </div>
            <div class="full price_table padding_infor_info">
            <form id="form_new" method="post" action="<?=base_url('matrice/Module/add')?>">
              


                <input type="hidden" name="id" >
                <div class="row">

                  <div class="col-md-6">
                    <span class="label-input100"><b>Module</b><font color="red" >*</font></span>
                    <input type="text" name="DESCRIPTION" id="DESCRIPTION"  value="<?=set_value('DESCRIPTION');?>" class="form-control">
                    <span class="text-danger"><?php echo form_error("DESCRIPTION");?></span>
                    <?php
                    if ($this->session->has_userdata('dash')) {
                      echo '<div class="' . $this->session->dash['class'] . '" role="alert">' . $this->session->dash['message'] . '</div>';
                    }
                    ?>
                  </div>
                  <div class="col-md-6">
                    <span class="label-input100"><b>Mot clé</b><font color="red" >*</font></span>
                    <input type="text" name="MOTCLE" id="MOTCLE"  value="<?=set_value('MOTCLE');?>" class="form-control">
                    <span class="text-danger"><?php echo form_error("MOTCLE");?></span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <span class="label-input100"><b>Icone</b><font color="red" >*</font></span>
                    <input type="text" name="ICONE" id="ICONE"  value="<?=set_value('ICONE');?>" class="form-control">
                    <span class="text-danger"><?php echo form_error("ICONE");?></span>
                  </div>
                  <div class="col-md-6">
                    <span class="label-input100"><b>Controller</b></span>
                    <input type="text" name="CONTROLLER" id="CONTROLLER"  value="<?=set_value('ICONE');?>" class="form-control">
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









