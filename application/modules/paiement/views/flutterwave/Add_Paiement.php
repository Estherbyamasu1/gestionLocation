




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
                  <h2>Enregistrement des categories</h2>
                <!-- </div> -->
              </div>

              <div class="col-lg-6">

                <ul class="nav nav-pills nav-fill justify-content-around rounded shadow m-4">
                  <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['nouveau'])) echo 'active';?>"  href="<?=base_url('appartement/Categorie/ajouter/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
                  <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('appartement/Categorie/')?>"><i class="fa fa-list"></i>Liste</a></li>
                </ul>
              </div>
              
            </div>
            <div class="full price_table padding_infor_info">
              <?= $this->session->flashdata('message');?>
            <!-- <form id="form_new" method="post" action="<?=base_url('appartement/Categorie/ajouter')?>">
              


                <input type="hidden" name="id" >
                <div class="row">

                  <div class="col-md-12">
                    <span class="label-input100"><b>Categorie</b><font color="red" >*</font></span>
                    <input type="text" name="NOM_CATEGORIE" id="NOM_CATEGORIE"  value="<?=set_value('NOM_CATEGORIE');?>" class="form-control">
                    <span class="text-danger"><?php echo form_error("NOM_CATEGORIE");?></span>
                    <?php
                    if ($this->session->has_userdata('dash')) {
                      echo '<div class="' . $this->session->dash['class'] . '" role="alert">' . $this->session->dash['message'] . '</div>';
                    }
                    ?>
                  </div>
                </div>
               
             
                <div class="row">
                  <div class="col-md-12" style="padding-top: 20px;">

                    <button type="submit" class="btn btn-dark" style="float:right;" >Enregistrer</button>
                  </div>
                </div>



            </form> -->

            <div class="container mt-5">
  <h3>Choisissez votre mode de paiement</h3>

  <form id="formPaiement">
    <div class="form-group">
      <label>Montant à payer (en BIF)</label>
      <input type="number" class="form-control" id="montant" name="montant" required value="5000">
    </div>

    <div class="form-group">
      <label>Mode de paiement</label>
      <select class="form-control" id="mode_paiement" name="mode_paiement" required>
        <option value="">-- Sélectionnez --</option>
        <option value="mvola">Mvola</option>
        <option value="airtel">Airtel Money</option>
        <option value="flutterwave">Flutterwave (CB, Mobile Money, etc.)</option>
      </select>
    </div>

    <button type="submit" class="btn btn-success">Payer</button>
  </form>
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
  $('#message').delay('slow').fadeOut(3000);
</script>



<script src="https://checkout.flutterwave.com/v3.js"></script>

<script>
  document.getElementById("formPaiement").addEventListener("submit", function(e){
    e.preventDefault();

    const mode = document.getElementById("mode_paiement").value;
    const montant = document.getElementById("montant").value;

    if (mode === "flutterwave") {
      FlutterwaveCheckout({
        public_key: "FLWPUBK_TEST-XXXXXXXXX",
        tx_ref: "TX_" + Date.now(),
        amount: montant,
        currency: "BIF",
        payment_options: "card,mobilemoneyuganda,mobilemoneyrwanda,ussd",
        customer: {
          email: "<?php echo $this->session->userdata('LOCATAIRE_EMAIL'); ?>",
          phone_number: "<?php echo $this->session->userdata('LOCATAIRE_PHONE'); ?>",
          name: "<?php echo $this->session->userdata('LOCATAIRE_NAME'); ?>",
        },
        callback: function (data) {
          // Rediriger pour traitement backend
          window.location.href = "<?php echo base_url('perso/confirmation_flutterwave'); ?>?ref=" + data.transaction_id;
        },
        onclose: function () {
          alert('Paiement annulé');
        },
        customizations: {
          title: "Paiement Location",
          description: "Paiement réservation logement",
          logo: "<?php echo base_url('assets/logo.png'); ?>"
        }
      });
    } else {
      // Paiement local Mvola ou Airtel
      fetch("<?php echo base_url('perso/paiement_local'); ?>", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ montant: montant, mode_paiement: mode })
      })
      .then(res => res.json())
      .then(data => {
        alert(data.message);
      })
      .catch(err => {
        console.error("Erreur:", err);
        alert("Erreur lors du paiement local.");
      });
    }
  });
</script>