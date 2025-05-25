<!DOCTYPE html>
<html lang="en">

<head>
   <?php include VIEWPATH . 'includes_site/header_frontend.php'; ?>
</head>

<body>



 <!-- <?php// include VIEWPATH.'includes_site/menu_frontend.php'; ?> -->



 <!-- dashboard inner -->
 <div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
                    <div class="col-md-12">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid d-flex align-items-center">

      <!-- Logo -->
      <a class="navbar-brand me-4" href="<?=base_url()?>">
        <img src="<?=base_url()?>logo/png_logo.png" width="100" alt="Logo">
      </a>

      <!-- Liens de navigation -->
      <div class="d-flex align-items-center" style="font-family: 'Segoe UI', sans-serif; font-size: 16px; color: #333;">
        <a class="nav-link me-3 <?php if(in_array($this->router->method, ['index'])) echo 'active'; ?>" 
           href="<?=base_url()?>Perso/index" style="font-weight: 500;">
          <i class="fa fa-calendar-o"></i> Mes demandes
        </a>

        <a class="nav-link me-3 <?php if(in_array($this->router->method, ['message'])) echo 'active'; ?>" 
           href="<?=base_url()?>Perso/paiement_demande" style="font-weight: 500;">
          <i class="fa fa-envelope"></i> Paiements
        </a>

        <a class="nav-link text-danger" href="<?=base_url('Login_Front/do_logout')?>" style="font-weight: 500;">
          <i class="fa fa-sign-out"></i> Déconnexion
        </a>
      </div>

    </div>
  </nav>
</div>
        </div>
        <!-- row -->
        <div class="row mr-lg-5 ml-lg-5">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>Demande bien</h2>
                        </div>
                    </div>
                    <div class="full price_table padding_infor_info">

                        <div class="row">

                            
                            <?php include 'menu_profil.php'; ?>
                          






                            <div class="col-lg-9">

                                <div class="row">

                                     <form action="<?=base_url('Perso/Add_paiement') ?>" method="POST" enctype="multipart/form-data" >
                                
                                    
                                    <?php if (isset($mesresvations)): ?>
                                        <div class="card" style="width: 100%;">
                                       
                                    <div class="card-body">
                                        <h5 class="card-title"><?=$mesresvations->NOM_MEUBLE?></h5>
                                        <p class="card-text">Adress<hr/>
                                        <?=$mesresvations->ADRESSE?></p>
                                             <input type="hidden" class="form-control" name="ID_RESERVATION" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="<?=$mesresvations->RESERVATION_ID?>">
                                    </div>
                                    </div>
                                    <?php endif; ?>
                                               <?php if (isset($mesresvationsdata)): ?>
                                    <div class="form-group">
                                    <label for="exampleInputPassword1">Mes reservation </label>
                                    <select class="form-control" aria-label="Default select example" name="ID_RESERVATION">
                                         <option selected> Selectionner mes reservation</option>
                                     
                                            <?php foreach ($mesresvationsdata as $key): ?>
                                                <option value=" <?= $key->RESERVATION_ID ?>"> <?= $key->NOM_MEUBLE  ?></option>
                                            <?php endforeach; ?>
                                       
                                    </select>
                                </div>
                                 <?php endif; ?>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Montant</label>
                                    <input type="number" class="form-control" name="MONTANT" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter Montant" require>
                                   
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">code de paiement</label>
                                    <input type="text" class="form-control" name="CODE_PAIEMENT" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter code de paiement " require>
                                   
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mode de paiement </label>
                                    <select class="form-control" aria-label="Default select example" name="MODE_PAIEMENT">
                                           <option selected> Sele tionner mode de paiement</option>
                                        <?php if (isset($liste)): ?>
                                            <?php foreach ($liste as $key): ?>
                                             
                                                 <option value=" <?= $key->ID_TYPE_PAIEMENT ?>"> <?= $key->DESC_TYPE_PAIEMENT  ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                       

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">image du paiement </label>
                                    <input type="file" class="form-control"
                                        id="exampleInputPassword1"  name="IMAGE_RECU" require>
                                </div>


                                <button type="submit" class="btn btn-primary">Payer</button>
                            </form>
                                    

                                </div>
                                
                                

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>



    <?php include VIEWPATH.'includes_site/footer_frontend.php'; ?>

</body>

</html>





