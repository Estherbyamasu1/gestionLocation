<!DOCTYPE html>
<html lang="en">

<head>
  <?php include VIEWPATH . 'includes/header.php'; ?>

</head>

<body>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <div class="wrapper">

    <?php include VIEWPATH . 'includes/navybar_menu.php'; ?>
    <div class="main">
      <?php include VIEWPATH . 'includes/navybar_topbar.php'; ?>
      <main class="content">
        <div class="container-fluid">

          <div class="header">
            <h1 class="header-title">
               Modification des sous menu
            </h1>
          </div>
          <?= $this->session->flashdata('message'); ?>
          <div class="container">
            <div class="col-lg-14">
              <div class="card">
                <div class="card-body" style="overflow-x: auto;">

                  <div class="col-sm-6" style="float:right;">
                    <a type="button" class="btn btn-dark float-right"
                      href="<?= base_url('matrice/Sous_menu/index') ?>"><i class="fa-solid fa-list-ol"></i> Liste</a>
                  </div>
                  <br><br><br>
                  <div style="padding-top: 5px;" class="col-md-14">
                    <div class="container">
                      <div class="row">
                        <div class="col-xl-12 col-xxl-12">

                          <form method="POST" action="<?php echo base_url('matrice/Sous_menu/update') ?>"
                            class="form-horizontal">

                            <div class="row">
                              <div class="col-md-6">
                              <input type="hidden" value="<?= $row['ID_SOUS_MENU'] ?>" class="form-control" name="id">

                                <label for=""> Sous menu</label>
                                <input type="text" class="form-control" name="description"
                                  value="<?= $row['DESCRIPTION'] ?>">
                                <?php echo form_error('description', '<div class="text-danger">', '</div>'); ?>
                              </div>
                              <div class="col-md-6">

                                <label for="">Menu</label>
                                <select name="menu" class="form-control">
                                  <option value="">Sélectioner menu</option>
                                  <?php
                                          $menu = $this->Model->getRequete("SELECT ID_MENU,DESCRIPTION,STATUT FROM `MENU`   WHERE 1 AND STATUT=1 ORDER BY DESCRIPTION ASC");
                                          foreach ($menu as $key) {
                                            if ($key['ID_MENU'] == $row['ID_MENU']) {
                                          ?>
                                  <option value="<?= $key['ID_MENU'] ?>" selected=''><?= $key['DESCRIPTION'] ?></option>
                                  <?php
                                            } else { ?>
                                  <option value="<?= $key['ID_MENU'] ?>"><?= $key['DESCRIPTION'] ?></option>
                                  <?php
                                            }
                                          }
                                              ?>
                                </select>
                                <?php echo form_error('menu', '<div class="text-danger">', '</div>'); ?>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6">
                                <label for="Ftype">Profil</label>
                                <select class=" form-control select2" name="profile[]" multiple>
                                  <?php
                                  foreach ($profile as $value) {
                                    if (in_array($value['ID_PROFIL'], $array)) { ?>
                                  <option value="<?= $value['ID_PROFIL'] ?>" selected><?= $value['DESCRIPTION'] ?>
                                  </option>';
                                  <?php } else { ?>
                                  <option value="<?= $value['ID_PROFIL'] ?>"><?= $value['DESCRIPTION'] ?></option>';
                                  <?php }
                                  }
                                    ?>
                                </select>
                                 <?php echo form_error('profile[]', '<div class="text-danger">', '</div>'); ?>
                              </div>
                              <div class="col-md-6">
                                <label>Contrôlleur</label>
                                <input type="text" name="controlleur" class="form-control"
                                  value="<?= $row['CONTROLLER'] ?>">
                                <?php echo form_error('controlleur', '<div class="text-danger">', '</div>'); ?>
                              </div>

                            </div>


                            <div style="padding-top: 10px;">

                              <button type="submit" class="btn btn-dark" style="float:right;">Modifier</button>
                            </div>


                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <?php include VIEWPATH . 'includes/scripts_js.php'; ?>
            </div>
          </div>
      </main>
    </div>
  </div>
</body>

</html>

<script type="text/javascript">
  $('#message').delay('slow').fadeOut(3000);
</script>

<style>
  #message {
    font-size: 20px;
    font-weight: bold;
    border-radius: 10px;
    color: white;
  }
</style>

<script>
  function get_profil() {
    var ID_MENU = $('#menu').val();
    $.ajax({
      url: "<?php echo base_url('matrice/Sous_menu/get_profil/'); ?>" + ID_MENU,
      data: {},
      processData: false,
      contentType: false,
      success: function (data) {
        $('#profil').html(data);

      },
    });

  }
</script>