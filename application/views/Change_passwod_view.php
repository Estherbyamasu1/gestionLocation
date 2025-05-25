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
                            <h2>Modifier le mot de passe</h2>
                        </div>
                    </div>

                    <div class="container-fluid">
    <div class="row">
        <!-- Colonne menu profil -->
        <div class="col-lg-3">
            <?php include 'perso/menu_profil.php'; ?>
        </div>

        <!-- Colonne contenu principal -->
        <div class="col-lg-9">
            <div class="white_shd full margin_bottom_30">
                
                <div class="full bg-white p-3">
                    <h1>Changer votre mot de passe</h1>
                  
                    <br>
<form method="POST" id="myform" action="<?=base_url('Perso/nouveauPassword')?>" >
                    <?= $this->session->flashdata('message');?>
   
                  <div class="form-row">
                   <div class="col-md-4">
                    <label>Nouveau mot de passe <span style="color: red;">*</span></label>
                    <input type="password" autofocus="" name="NEW_PASSWORD" autocomplete="off" id="NEW_PASSWORD" class="form-control">
                    <span class="help-block"></span>
                  </div>

                  <div class="col-md-4">
                    <label>Confirmer le mot de passe <span style="color: red;"></span></label>
                    <input type="password" name="CONFIRMER_PASSWORD" id="CONFIRMER_PASSWORD"  class="form-control" autocomplete="off">
                    <span class="help-block"></span>
                  </div>

                  <div class="col-md-4">
                    <label>Ancien mot de passe <span style="color: red;"></span></label>
                    <input type="password" name="ANCIEN_PASSWORD" id="ANCIEN_PASSWORD"   class="form-control" autocomplete="off">
                    <span class="help-block"></span>
                  </div>
                </div>
                <br>

                <div class="form-group row">
                  <div class="col-md-12">
                    <button type="submit"  style="float: right;clear: both;" class="btn btn-info" id="btnSave">Appliquer</button>
                  </div>

                </div>


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