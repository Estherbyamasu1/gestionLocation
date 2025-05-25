<!DOCTYPE html>
<html lang="en">

<head>
    <?php include VIEWPATH . 'includes_site/header_frontend.php'; ?>

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css"> -->
</head>

<style type="text/css">
    /*.truncate {
  max-width:60%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

 .trclass {

      height:20px;

      font-weight:bold;

  }
  */
  .dt-body-nowrap {
    white-space: nowrap;
}
</style>

<body>



    <!-- <?php //include VIEWPATH.'includes_site/menu_frontend.php'; 
    ?> -->


    <!-- dashboard inner -->
    <div class="midde_cont">
        <div class="container-fluid">
            <div class="row column_title">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid d-flex align-items-center">

                            <!-- Logo -->
                            <a class="navbar-brand me-4" href="<?= base_url() ?>">
                                <img src="<?= base_url() ?>logo/png_logo.png" width="100" alt="Logo">
                            </a>

                            <!-- Liens de navigation -->
                            <div class="d-flex align-items-center" style="font-family: 'Segoe UI', sans-serif; font-size: 16px; color: #333;">
                                <a class="nav-link me-3 <?php if (in_array($this->router->method, ['index'])) echo 'active'; ?>"
                                    href="<?= base_url() ?>Perso/index" style="font-weight: 500;">
                                    <i class="fa fa-calendar-o"></i> Mes demandes
                                </a>

                                <a class="nav-link me-3 <?php if (in_array($this->router->method, ['message'])) echo 'active'; ?>"
                                    href="<?= base_url() ?>Perso/paiement_demande" style="font-weight: 500;">
                                    <i class="fa fa-envelope"></i> Paiements
                                </a>

                                <a class="nav-link text-danger" href="<?= base_url('Login_Front/do_logout') ?>" style="font-weight: 500;">
                                    <i class="fa fa-sign-out"></i> Déconnexion
                                </a>
                            </div>

                        </div>
                    </nav>
                </div>
                <!-- row -->
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>Faire une demande de reservation</h2>
                        </div>
                    </div>

                    <div class="container-fluid">
    <div class="row">
        <!-- Colonne menu profil -->
        <div class="col-lg-3">
            <?php include 'menu_profil.php'; ?>
        </div>

        <!-- Colonne contenu principal -->
        <div class="col-lg-9">
            <div class="white_shd full margin_bottom_30">
                
                <div class="full bg-white p-3">
                    <h1>Faire une reservation</h1>
                    <br>

                    <form action="<?=base_url('Perso/Add_reservation') ?>" method="POST" enctype="multipart/form-data">

                        <div class="row">

   <!--      <div class="form-group col-md-6">
  <label>Appartements <font color="red">*</font></label>
  <select name="ID_MEUBLE" id="ID_MEUBLE" class="selectpicker form-control"
          data-live-search="true" data-style="btn-outline-primary" data-width="100%" data-size="5">
    <option value="">Sélectionner</option>
    <?php foreach ($meuble as $value): ?>
      <?php
        $img_url = !empty($value['IMAGE_MEUBLE'])
          ? base_url('uploads/doc_meuble/' . $value['IMAGE_MEUBLE'])
          : base_url('assets/images/default.png');
        $label = htmlspecialchars($value['NOM_MEUBLE'], ENT_QUOTES, 'UTF-8');
      ?>
      <option 
        data-content="<span><img src='<?= $img_url ?>' width='30' height='30' style='border-radius:3px; margin-right:10px;'> <?= $label ?></span>" 
        value="<?= $value['ID_MEUBLE'] ?>">
      </option>
    <?php endforeach; ?>
  </select>

  <span class="text-danger"><?php echo form_error("ID_MEUBLE"); ?></span>

  <?php if ($this->session->has_userdata('dash')): ?>
    <div class="<?= $this->session->dash['class'] ?>" role="alert">
      <?= $this->session->dash['message'] ?>
    </div>
  <?php endif; ?>
</div> -->




  <!--  <div class="form-group col-md-6">
    <label>Appartements<font color="red">*</font></label>
    <select name="ID_MEUBLE" id="ID_MEUBLE"
            class="form-control selectpicker" 
            data-live-search="true" 
            data-size="5"
            data-style="btn-outline-primary">
        <option value="">Sélectionner</option>
        <?php foreach ($meuble as $value): ?>
            <?php
                $img_url = !empty($value['IMAGE_MEUBLE'])
                    ? base_url('uploads/doc_meuble/' . $value['IMAGE_MEUBLE'])
                    : base_url('assets/images/default.png');
                $nom = htmlspecialchars($value['NOM_MEUBLE'], ENT_QUOTES, 'UTF-8');
            ?>
            <option value="<?= $value['ID_MEUBLE'] ?>"
                    data-content="<span><img src='<?= $img_url ?>' class='rounded-circle' width='30' height='30' style='margin-right:10px;'> <?= $nom ?></span>">
                <?= $nom ?>
            </option>
        <?php endforeach; ?>
    </select>
    <span class="text-danger"><?php echo form_error("ID_MEUBLE"); ?></span>
</div> -->
<!-- <span><img src='<?= $img_url ?>' width='30' height='30' style='border-radius:3px; margin-right:10px;'> <?=base_url('uploads/doc_meuble/' . $value['IMAGE_MEUBLE'])?></span> -->

                   <div class="form-group col-md-6">
                            <label>Appartements<font color="red" >*</font></label>
                            <select name="ID_MEUBLE" id="ID_MEUBLE"  class="form-control ">

                  <option value="">Sélectionner</option>
                  <?php
                  foreach ($meuble as $value)
                  {
                    ?>
                    <option value="<?=$value['ID_MEUBLE']?>">  <?=$value['NOM_MEUBLE']?></option>
                    <?php
                  }
                  ?>
                </select>
                    <span class="text-danger"><?php echo form_error("ID_MEUBLE");?></span>
                    <?php
                    if ($this->session->has_userdata('dash')) {
                      echo '<div class="' . $this->session->dash['class'] . '" role="alert">' . $this->session->dash['message'] . '</div>';
                    }
                    ?>
                        </div>

                        </div>

                        <div class="row">

                              <div class="form-group col-md-6">
                            <label>Date debut<font color="red" >*</font></label>
                            <input type="date" class="form-control" min="<?=date('Y-m-d')?>" name="DATE_DEBUT" placeholder="Entrez la date debut" >
                            <span class="text-danger"><?php echo form_error("DATE_DEBUT");?></span>
                        </div>

                         <div class="form-group col-md-6">
                            <label>Date fin<font color="red" >*</font></label>
                            <input type="date" class="form-control" min="<?=date('Y-m-d')?>" name="DATE_FIN" placeholder="Entrez la date fin" >
                            <span class="text-danger"><?php echo form_error("DATE_FIN");?></span>
                        </div>

                        
                            
                        </div>
                        

                        <button type="submit" class="btn btn-info">Reserver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>






                    </div>

                    <?php include VIEWPATH . 'includes_site/footer_frontend.php'; ?>


                </div>
            </div>
        </div>


                </body>

                </html>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script> -->

<script>
  $(document).ready(function () {
    $('.selectpicker').selectpicker();
  });
</script>