<!DOCTYPE html>
<html lang="en">

<head>
    <?php include VIEWPATH . 'includes_site/header_frontend.php'; ?>
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
                            <h2>Liste de mes demandes</h2>
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
                                        <h1>Faire un paiement</h1>
                                        <br>

                                        <form action="<?=base_url('Perso/Add_paiement') ?>" method="POST" enctype="multipart/form-data">



                                            <div class="row">



                                                <?php if (isset($mesresvations)): ?>
                                                    <div class="card" style="width: 100%;">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?=$mesresvations->NOM_MEUBLE?></h5>
                                                            <p class="card-text">Adresse : <b><?=$mesresvations->ADRESSE?></b></p>
                                                            <p class="card-text">Nombre Chambre :<b> <?=$mesresvations->NOMBRE_CHAMBRE ?></b></p>
                                                            <p class="card-text">Numero Appartement:<b> <?=$mesresvations->NUMERO_MEUBLE ?></b></p>
                                                            <input type="hidden" name="ID_RESERVATION" value="<?=$mesresvations->RESERVATION_ID?>">
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (isset($mesresvationsdata)): ?>
                                                    <div class="form-group col-md-6">
                                                        <label>Mes réservations</label>
                                                        <select class="form-control" name="ID_RESERVATION">
                                                            <option selected disabled> Sélectionner une réservation</option>
                                                            <?php foreach ($mesresvationsdata as $key): ?>
                                                                <option value="<?= $key->RESERVATION_ID ?>"> <?= $key->NOM_MEUBLE ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                <?php endif; ?>


                                                <div class="form-group col-md-6">
                                                    <label>Montant</label>
                                                    <input type="number" class="form-control" name="MONTANT" placeholder="Entrez le montant" required>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">

                                               <div class="form-group col-md-6">
                                                <label>Mode de paiement</label>
                                                <select class="form-control" name="MODE_PAIEMENT" id="mode_paiement">
                                                    <option selected disabled> Sélectionner le mode</option>
                                                    <?php if (isset($liste)): ?>
                                                        <?php foreach ($liste as $key): ?>
                                                            <option value="<?= $key->ID_TYPE_PAIEMENT ?>"> <?= $key->DESC_TYPE_PAIEMENT ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>


                                            <div class="form-group col-md-6">
                                              <label>Téléphone</label>
                                              <input type="text" name="TELEPHONE" id="telephone" class="form-control" placeholder="Numéro de téléphone mobile" required>
                                              <small id="prefix-help" class="text-muted">Commencez par sélectionner un mode de paiement.</small>
                                          </div>

                                          
                                      </div>

                                      <div class="row">

                                          <div class="form-group col-md-6">
                                            <label>Code de paiement</label>
                                            <input type="text" class="form-control" name="CODE_PAIEMENT" placeholder="Code de paiement" required>
                                        </div>
                                        

                                        <div class="form-group col-md-6">
                                            <label>Image du paiement</label>
                                            <input type="file" class="form-control" name="IMAGE_RECU" required>
                                        </div>



                                    </div>






                                    <button type="submit" class="btn btn-info">Payer</button>
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



<script src="https://checkout.flutterwave.com/v3.js"></script>


<script>
  const prefixOptions = {
    1: ["+24399"],
    2: ["+24385", "+24389"],
    3: ["+24381", "+24382"]
};

const modePaiement = document.getElementById("mode_paiement");
const telephoneInput = document.getElementById("telephone");

  // Lorsqu'on change le mode de paiement : insère le préfixe
  modePaiement.addEventListener("change", function () {
    const mode = this.value;

    if (prefixOptions[mode]) {
      telephoneInput.value = prefixOptions[mode][0];
      telephoneInput.readOnly = false;
      telephoneInput.focus();
      telephoneInput.setSelectionRange(telephoneInput.value.length, telephoneInput.value.length);
  } else {
      telephoneInput.value = "";
      telephoneInput.readOnly = false;
  }
});

  // Lors de la saisie du numéro, on bloque après 7 chiffres après le préfixe
  telephoneInput.addEventListener("input", function () {
    const mode = modePaiement.value;
    const prefixes = prefixOptions[mode];

    if (!prefixes) return;

    for (let prefix of prefixes) {
      if (telephoneInput.value.startsWith(prefix)) {
        const rest = telephoneInput.value.slice(prefix.length);

        // Ne garder que les chiffres dans la partie après le préfixe
        const numericPart = rest.replace(/\D/g, '');

        if (numericPart.length > 7) {
          // Couper à 7 chiffres max
          telephoneInput.value = prefix + numericPart.slice(0, 7);
      }

        // Bloquer si on a atteint 7 chiffres
        if (numericPart.length === 7) {
          telephoneInput.readOnly = true;
      } else {
          telephoneInput.readOnly = false;
      }

      break;
  }
}
});


  document.getElementById("mode_paiement").addEventListener("change", function () {
      const mode = this.value;
      const help = document.getElementById("prefix-help");
      const prefixes = prefixOptions[mode];

      if (prefixes) {
        help.textContent = "Préfixes autorisés : " + prefixes.join(" ou ") + " suivis de 7 chiffres.";
    } else {
        help.textContent = "Commencez par sélectionner un mode de paiement.";
    }
});
</script>

<!-- <script>
  const prefixOptions = {
    1: ["+24399"],
    2: ["+24385", "+24389"],
    3: ["+24381", "+24382"]
  };

  document.getElementById("mode_paiement").addEventListener("change", function () {
    const mode = this.value;
    const telephoneInput = document.getElementById("telephone");

    if (prefixOptions[mode]) {
      telephoneInput.value = prefixOptions[mode][0]; // Prend le premier préfixe par défaut
      telephoneInput.focus();
      telephoneInput.setSelectionRange(telephoneInput.value.length, telephoneInput.value.length);
    } else {
      telephoneInput.value = "";
    }
  });
</script>

<script>
  document.getElementById("formPaiement").addEventListener("submit", function (e) {
    const mode = document.getElementById("mode_paiement").value;
    const montant = document.getElementById("montant").value;
    const telephone = document.getElementById("telephone").value.trim();

    const prefixes = prefixOptions[mode];
    let isValid = false;

    if (prefixes && prefixes.length > 0) {
      for (let prefix of prefixes) {
        if (telephone.startsWith(prefix)) {
          isValid = true;
          break;
        }
      }
    }

    if (!isValid) {
      e.preventDefault();
      alert("Le numéro de téléphone ne correspond pas aux préfixes autorisés pour ce mode de paiement.");
      return;
    }

    // Si Flutterwave, ne rien faire ici, sinon continuer normalement
  });
</script> -->