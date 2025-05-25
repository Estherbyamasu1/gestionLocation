<!DOCTYPE html>
<html lang="fr">

<head>
  <?php include VIEWPATH . 'includes/header.php'; ?>
</head>

<body>
  <?php include VIEWPATH . 'includes/loadpage.php'; ?>
  <div id="main-wrapper">
    <?php include VIEWPATH . 'includes/navybar.php'; ?>
    <?php include VIEWPATH . 'includes/menu.php'; ?>

    <div class="content-body">
      <div class="container-fluid">
        <div class="row page-titles mx-0">
          <div class="col-sm-12 p-md-0">
            <div class="welcome-text"></div>

            <div class="row">
              <div class="col-lg-6">
                <h2>Paiement des reservations</h2>
              </div>
              <div class="col-lg-6">
                <ul class="nav nav-pills nav-fill justify-content-around rounded shadow m-4">
                  <!-- <li class="nav-item"><a class="nav-link <?php if ($this->router->method == 'ajouter') echo 'active'; ?>" href="<?= base_url('appartement/Categorie/ajouter/') ?>"><i class="fa fa-pencil-square-o"></i> Nouveau</a></li> -->
                  <li class="nav-item"><a class="nav-link <?php if ($this->router->method == 'index') echo 'active'; ?>" href="<?= base_url('appartement/Categorie/') ?>"><i class="fa fa-list"></i> Liste</a></li>
                </ul>
              </div>
            </div>

            <div class="full price_table padding_infor_info">
              <div class="container mt-5">
               <!--  <h3>Choisissez votre mode de paiement</h3> -->

                <form id="formPaiement" action="<?= base_url('paiement/Paiements/Add_paiement') ?>" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Utilisateurs et réservation</label>
                      <select class="form-control" name="ID_RESERVATION" required>
                        <option value="">-- Sélectionnez --</option>
                        <?php if (isset($mesresrvation)): ?>
                          <?php foreach ($mesresrvation as $key): ?>
                            <option value="<?= $key['RESERVATION_ID'] ?>">
                              <?= $key['NOM_LOCATAIRE'] ?> (<b><?= $key['NOM_MEUBLE'] ?></b>)
                            </option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                    </div>

                    <div class="form-group col-md-6">
                      <label>Montant à payer (en BIF)</label>
                      <input type="number" class="form-control" id="montant" name="MONTANT" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Mode de paiement</label>
                      <select class="form-control" id="mode_paiement" name="MODE_PAIEMENT" required>
                        <option value="">-- Sélectionnez --</option>
                        <?php if (isset($typePaiement)): ?>
                          <?php foreach ($typePaiement as $key): ?>
                            <option value="<?= $key['ID_TYPE_PAIEMENT'] ?>"><?= $key['DESC_TYPE_PAIEMENT'] ?></option>
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

                  <button type="submit" class="btn btn-primary">Payer</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?= include VIEWPATH . 'includes/scripts_js.php'; ?>
  </div>

  <?= include VIEWPATH . 'includes/legende.php'; ?>
</body>

</html>




<script type="text/javascript">
  $('#message').delay('slow').fadeOut(3000);
</script>


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

<!-- <script>
  document.getElementById("formPaiement").addEventListener("submit", function (e) {
    const mode = document.getElementById("mode_paiement").value;
    const montant = document.getElementById("montant").value;
    const telephone = document.getElementById("telephone").value.trim();

    let isValid = false;

    // Vérification du numéro selon le type de paiement
    switch (mode) {
      case "1": // Ex. Mvola
        isValid = /^\+24399/.test(telephone);
        if (!isValid) alert("Le numéro doit commencer par +24399 pour ce mode de paiement.");
        break;
      case "2": // Ex. Airtel
        isValid = /^\+243(85|89)/.test(telephone);
        if (!isValid) alert("Le numéro doit commencer par +24385 ou +24389 pour ce mode de paiement.");
        break;
      case "3": // Ex. Orange
        isValid = /^\+243(81|82)/.test(telephone);
        if (!isValid) alert("Le numéro doit commencer par +24381 ou +24382 pour ce mode de paiement.");
        break;
      default:
        alert("Mode de paiement non reconnu.");
    }

    if (!isValid) {
      e.preventDefault(); // Stop le formulaire si erreur
      return;
    }

    // Paiement avec Flutterwave (si activé)
    if (mode === "flutterwave") {
      e.preventDefault();
      FlutterwaveCheckout({
        public_key: "FLWPUBK_TEST-XXXXXXXXX",
        tx_ref: "TX_" + Date.now(),
        amount: montant,
        currency: "BIF",
        payment_options: "card,mobilemoneyuganda,mobilemoneyrwanda,ussd",
        customer: {
          email: "<?= $this->session->userdata('LOCATAIRE_EMAIL'); ?>",
          phone_number: "<?= $this->session->userdata('LOCATAIRE_PHONE'); ?>",
          name: "<?= $this->session->userdata('LOCATAIRE_NAME'); ?>"
        },
        callback: function (data) {
          window.location.href = "<?= base_url('perso/confirmation_flutterwave'); ?>?ref=" + data.transaction_id;
        },
        onclose: function () {
          alert('Paiement annulé');
        },
        customizations: {
          title: "Paiement Location",
          description: "Paiement réservation logement",
          logo: "<?= base_url('assets/logo.png'); ?>"
        }
      });
    }
  });
</script> -->



<!-- <script src="https://checkout.flutterwave.com/v3.js"></script>

<script>
  document.getElementById("formPaiement").addEventListener("submit", function(e) {
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
        callback: function(data) {
          // Rediriger pour traitement backend
          window.location.href = "<?php echo base_url('perso/confirmation_flutterwave'); ?>?ref=" + data.transaction_id;
        },
        onclose: function() {
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
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            montant: montant,
            mode_paiement: mode
          })
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
</script> -->