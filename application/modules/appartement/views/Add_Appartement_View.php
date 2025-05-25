
<!DOCTYPE html>
<html lang="fr">

<head>
  <?php include VIEWPATH.'includes/header.php'; ?>
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <style>
  .quartier-label {
    font-size: 12px;
    font-weight: bold;
    background-color: rgba(255,255,255,0.8);
    padding: 2px 5px;
    border-radius: 4px;
    color: #000;
  }

  .avenue-label {
    font-size: 11px;
    background-color: rgba(255,255,255,0.8);
    padding: 2px 4px;
    border-radius: 3px;
    color: #333;
  }
</style>

</head>

<body>
  <?php include VIEWPATH.'includes/loadpage.php'; ?>  
  <div id="main-wrapper">
    <?php include VIEWPATH.'includes/navybar.php'; ?> 
    <?php include VIEWPATH.'includes/menu.php'; ?> 

    <div class="content-body">
      <div class="container-fluid">
        <div class="row page-titles mx-0">
          <div class="col-sm-12 p-md-0">
            <div class="welcome-text">
              <h2>Enregistrement des appartements</h2>
            </div>

            <div class="row">
              <div class="col-lg-6">
                <ul class="nav nav-pills nav-fill justify-content-around rounded shadow m-4">
                  <li class="nav-item">
                    <a class="nav-link <?php if(in_array($this->router->method,['ajouter'])) echo 'active';?>"  
                      href="<?=base_url('appartement/Appartement/ajouter/')?>"><i class="fa fa-pencil-square-o"></i> Nouveau</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" 
                        href="<?=base_url('appartement/Appartement/')?>"><i class="fa fa-list"></i> Liste</a>
                      </li>
                    </ul>
                  </div>
                </div>

                <!-- Affichage des messages -->
                <?php if($this->session->flashdata('message')): ?>
                  <div class="alert <?= $this->session->flashdata('type'); ?> alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('message'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <?php endif; ?>

                <div class="full price_table padding_infor_info">
                  <form id="form_new" enctype="multipart/form-data" method="post" action="<?=base_url('appartement/Appartement/ajouter')?>" >

                    <div class="row">
                      <div class="col-md-6">
                        <label><b>Catégorie <span style="color:red">*</span></b></label>
                        <select name="ID_CATEGORIE" id="ID_CATEGORIE" class="form-control" required>
                          <option value="">Sélectionner</option>
                          <?php foreach ($cate as $value): ?>
                            <option value="<?=$value['ID_CATEGORIE']?>" <?=set_select('ID_CATEGORIE', $value['ID_CATEGORIE'])?>>
                              <?=$value['NOM_CATEGORIE']?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                        <span class="text-danger"><?php echo form_error("ID_CATEGORIE");?></span>
                      </div>

                      <div class="col-md-6">
                        <label><b>Image appartement <span style="color:red">*</span></b></label>
                        <input type="file" name="IMAGE_MEUBLE" id="IMAGE_MEUBLE" accept="image/*" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("IMAGE_MEUBLE");?></span>
                        <img id="preview_image" src="#" alt="Aperçu de l'image" style="display:none; max-height:150px; margin-top:10px;"/>
                      </div>
                    </div>

                    <div class="row mt-3">
                      <div class="col-md-6">
                        <label><b>Nom Appartement <span style="color:red">*</span></b></label>
                        <input type="text" name="NOM_MEUBLE" value="<?=set_value('NOM_MEUBLE')?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("NOM_MEUBLE");?></span>
                      </div>
                      <div class="col-md-6">
                        <label><b>Numéro appartement <span style="color:red">*</span></b></label>
                        <input type="text" name="NUMERO_MEUBLE" value="<?=set_value('NUMERO_MEUBLE')?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("NUMERO_MEUBLE");?></span>
                      </div>
                    </div>

                    <div class="row mt-3">
                      <div class="col-md-4">
                        <label><b>Montant (Fbu) <span style="color:red">*</span></b></label>
                        <input type="number" name="MONTANT" value="<?=set_value('MONTANT')?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("MONTANT");?></span>
                      </div>
                      <div class="col-md-4">
                        <label><b>Nombre de chambres</b></label>
                        <input type="number" name="NOMBRE_CHAMBRE" value="<?=set_value('NOMBRE_CHAMBRE')?>" class="form-control">
                        <span class="text-danger"><?php echo form_error("NOMBRE_CHAMBRE");?></span>
                      </div>
                      <div class="col-md-4">
                        <label><b>Adresse</b></label>
                        <input type="text" name="ADRESSE" value="<?=set_value('ADRESSE')?>" class="form-control">
                        <span class="text-danger"><?php echo form_error("ADRESSE");?></span>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <label><b>Latitude <span style="color:red">*</span></b></label>
                        <input type="text" name="LATITUDE" id="LATITUDE" class="form-control" value="<?=set_value('LATITUDE')?>" readonly required>
                      </div>
                      <div class="col-md-6">
                        <label><b>Longitude <span style="color:red">*</span></b></label>
                        <input type="text" name="LONGITUDE" id="LONGITUDE" class="form-control" value="<?=set_value('LONGITUDE')?>" readonly required>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-6">
                        <label><b>Filtrer par Quartier</b></label>
                        <select id="quartier_filter" name="quartier_filter" class="form-control">
                          <option value="">-- Tous les quartiers --</option>
                          <?php foreach ($this->db->query("SELECT DISTINCT ID_QUARTIER, DESC_QUARTIER FROM quartier_avenue")->result_array() as $q): ?>
                            <option value="<?= $q['ID_QUARTIER'] ?>"><?= $q['DESC_QUARTIER'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label><b>Filtrer par Avenue</b></label>
                        <select id="avenue_filter" name="avenue_filter" class="form-control">
                          <option value="">-- Toutes les avenues --</option>
                          <?php foreach ($this->db->query("SELECT ID_AVENUE, DESC_AVENUE FROM avenue")->result_array() as $a): ?>
                            <option value="<?= $a['ID_AVENUE'] ?>"><?= $a['DESC_AVENUE'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-12 mt-3">
                      <label><b>Localiser l'appartement</b></label>
                      <div id="map" style="height: 400px; width: 100%; border:1px solid #ddd;"></div>
                    </div>

                    <div class="row mt-4">
                      <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-dark">Enregistrer</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <?php include VIEWPATH.'includes/scripts_js.php'; ?>

      <script>
    // Prévisualisation de l’image uploadée
    document.getElementById("IMAGE_MEUBLE").onchange = function (e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (event) {
          const preview = document.getElementById("preview_image");
          preview.src = event.target.result;
          preview.style.display = "block";
        };
        reader.readAsDataURL(file);
      }
    };
  </script>

  <?php include VIEWPATH.'includes/legende.php'; ?> 
</body>

</html>

<script type="text/javascript">

  document.addEventListener('DOMContentLoaded', function() {
    var defaultLat = <?= set_value('LATITUDE') ? set_value('LATITUDE') : '-1.6789' ?>;
    var defaultLng = <?= set_value('LONGITUDE') ? set_value('LONGITUDE') : '29.2203' ?>;

    var map = L.map('map').setView([defaultLat, defaultLng], 13);

    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap'
    }).addTo(map);

    var satellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
      maxZoom: 19,
      attribution: 'Tiles © Esri'
    });

    var baseMaps = {
      "Carte": osm,
      "Satellite": satellite
    };
    L.control.layers(baseMaps).addTo(map);

    var marker;

    if (defaultLat && defaultLng) {
      marker = L.marker([defaultLat, defaultLng]).addTo(map);
    }

    map.on('click', function(e) {
      var lat = e.latlng.lat.toFixed(6);
      var lng = e.latlng.lng.toFixed(6);

      if (marker) {
        marker.setLatLng(e.latlng);
      } else {
        marker = L.marker(e.latlng).addTo(map);
      }

      document.getElementById('LATITUDE').value = lat;
      document.getElementById('LONGITUDE').value = lng;
    });

    var quartiers = <?= json_encode($this->db->query("SELECT ID_QUARTIER, DESC_QUARTIER, LATITUDE, LONGITUDE FROM quartier_avenue")->result_array()) ?>;
    var avenues = <?= json_encode($this->db->query("SELECT ID_AVENUE, ID_QUARTIER, DESC_AVENUE, LATITUDE, LONGITUDE FROM avenue")->result_array()) ?>;

    var quartierMarkers = L.layerGroup().addTo(map);
    var avenueMarkers = L.layerGroup().addTo(map);

  // Fonction pour afficher quartiers
  function afficherQuartiers(filterId = null) {
    quartierMarkers.clearLayers();
    var toZoom = null;

    quartiers.forEach(function(q) {
      if (!filterId || q.ID_QUARTIER == filterId) {
        if (q.LATITUDE && q.LONGITUDE) {
          var m = L.marker([q.LATITUDE, q.LONGITUDE], {
            icon: L.divIcon({ className: 'quartier-label', html: q.DESC_QUARTIER, iconSize: [100, 20] })
          });
          quartierMarkers.addLayer(m);

          if (!toZoom) toZoom = [q.LATITUDE, q.LONGITUDE];
        }
      }
    });

    if (toZoom) {
      map.setView(toZoom, 15);
    }
  }

  // Fonction pour afficher avenues (optionnellement filtré par quartier)
  function afficherAvenues(filterQuartierId = null, filterAvenueId = null) {
    avenueMarkers.clearLayers();

    var toZoom = null;

    avenues.forEach(function(a) {
      if ((filterQuartierId === null || a.ID_QUARTIER == filterQuartierId) &&
        (filterAvenueId === null || a.ID_AVENUE == filterAvenueId)) {
        if (a.LATITUDE && a.LONGITUDE) {
          var m = L.marker([a.LATITUDE, a.LONGITUDE], {
            icon: L.divIcon({ className: 'avenue-label', html: a.DESC_AVENUE, iconSize: [100, 20] })
          });
          avenueMarkers.addLayer(m);

          if (!toZoom) toZoom = [a.LATITUDE, a.LONGITUDE];
        }
      }
    });

    if (toZoom && filterAvenueId) {
      map.setView(toZoom, 17);  // Zoom fort si avenue spécifique
    }
  }

  // Initial display (tous quartiers et avenues)
  afficherQuartiers();
  afficherAvenues();

  // Met à jour la liste des avenues dans le select selon quartier sélectionné
  function updateAvenueOptions(quartierId) {
    var avenueSelect = document.getElementById('avenue_filter');
    avenueSelect.innerHTML = '<option value="">-- Toutes les avenues --</option>';
    avenues.forEach(function(a) {
      if (!quartierId || a.ID_QUARTIER == quartierId) {
        var opt = document.createElement('option');
        opt.value = a.ID_AVENUE;
        opt.textContent = a.DESC_AVENUE;
        avenueSelect.appendChild(opt);
      }
    });
  }

  // Événement changement quartier
  document.getElementById('quartier_filter').addEventListener('change', function() {
    var quartierId = this.value || null;

    // Reset filtre avenue quand quartier change
    var avenueSelect = document.getElementById('avenue_filter');
    avenueSelect.value = '';

    updateAvenueOptions(quartierId);

    afficherQuartiers(quartierId);
    afficherAvenues(quartierId);
  });

  // Événement changement avenue
  document.getElementById('avenue_filter').addEventListener('change', function() {
    var avenueId = this.value || null;
    var quartierId = document.getElementById('quartier_filter').value || null;

    if (avenueId) {
      afficherAvenues(null, avenueId);
    } else {
      afficherAvenues(quartierId, null);
    }
  });

  // Contrôle visibilité selon zoom (optionnel)
  map.on('zoomend', function() {
    var zoom = map.getZoom();
    if (zoom >= 16) {
      if (!map.hasLayer(quartierMarkers)) map.addLayer(quartierMarkers);
      if (!map.hasLayer(avenueMarkers)) map.addLayer(avenueMarkers);
    } else if (zoom >= 14) {
      if (!map.hasLayer(quartierMarkers)) map.addLayer(quartierMarkers);
      if (map.hasLayer(avenueMarkers)) map.removeLayer(avenueMarkers);
    } else {
      if (map.hasLayer(quartierMarkers)) map.removeLayer(quartierMarkers);
      if (map.hasLayer(avenueMarkers)) map.removeLayer(avenueMarkers);
    }
  });

});


</script>

<!-- <script>
  // Quartiers
  var quartiers = <?= json_encode($this->db->query("SELECT ID_QUARTIER, DESC_QUARTIER, LATITUDE, LONGITUDE FROM quartier_avenue")->result_array()) ?>;

  // Avenues
  var avenues = <?= json_encode($this->db->query("SELECT ID_AVENUE, ID_QUARTIER, DESC_AVENUE, LATITUDE, LONGITUDE FROM avenue")->result_array()) ?>;

document.addEventListener('DOMContentLoaded', function() {
  var defaultLat = <?= set_value('LATITUDE') ? set_value('LATITUDE') : '-1.6789' ?>;
  var defaultLng = <?= set_value('LONGITUDE') ? set_value('LONGITUDE') : '29.2203' ?>;

  var map = L.map('map').setView([defaultLat, defaultLng], 13);

  // Fond de carte
  var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
  }).addTo(map);

  var satellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    maxZoom: 19,
    attribution: 'Tiles © Esri'
  });

  var baseMaps = {
    "Carte": osm,
    "Satellite": satellite
  };
  L.control.layers(baseMaps).addTo(map);

  var marker;

  if (defaultLat && defaultLng) {
    marker = L.marker([defaultLat, defaultLng]).addTo(map);
  }

  map.on('click', function(e) {
    var lat = e.latlng.lat.toFixed(6);
    var lng = e.latlng.lng.toFixed(6);

    if (marker) {
      marker.setLatLng(e.latlng);
    } else {
      marker = L.marker(e.latlng).addTo(map);
    }

    document.getElementById('LATITUDE').value = lat;
    document.getElementById('LONGITUDE').value = lng;
  });

  // Groupe de couches pour quartiers/avenues
  var quartierMarkers = L.layerGroup().addTo(map);
  var avenueMarkers = L.layerGroup().addTo(map);

  // Affichage des quartiers
  quartiers.forEach(function(q) {
    if (q.LATITUDE && q.LONGITUDE) {
      var marker = L.marker([q.LATITUDE, q.LONGITUDE], {
        icon: L.divIcon({ className: 'quartier-label', html: q.DESC_QUARTIER, iconSize: [100, 20] })
      });
      quartierMarkers.addLayer(marker);
    }
  });

  // Affichage des avenues
  avenues.forEach(function(a) {
    if (a.LATITUDE && a.LONGITUDE) {
      var marker = L.marker([a.LATITUDE, a.LONGITUDE], {
        icon: L.divIcon({ className: 'avenue-label', html: a.DESC_AVENUE, iconSize: [100, 20] })
      });
      avenueMarkers.addLayer(marker);
    }
  });

  // Fonction pour gérer la visibilité selon zoom
  map.on('zoomend', function() {
    var zoom = map.getZoom();
    if (zoom >= 16) {
      quartierMarkers.addTo(map);
      avenueMarkers.addTo(map);
    } else if (zoom >= 14) {
      quartierMarkers.addTo(map);
      map.removeLayer(avenueMarkers);
    } else {
      map.removeLayer(quartierMarkers);
      map.removeLayer(avenueMarkers);
    }
  });
});



  document.getElementById('quartier_filter').addEventListener('change', function() {
    var selectedQuartierId = this.value;

    quartierMarkers.clearLayers();
    avenueMarkers.clearLayers();

    // Afficher uniquement les quartiers sélectionnés (ou tous si aucun sélectionné)
    quartiers.forEach(function(q) {
      if (!selectedQuartierId || q.ID_QUARTIER == selectedQuartierId) {
        var marker = L.marker([q.LATITUDE, q.LONGITUDE], {
          icon: L.divIcon({ className: 'quartier-label', html: q.DESC_QUARTIER })
        });
        quartierMarkers.addLayer(marker);
        map.setView([q.LATITUDE, q.LONGITUDE], 15);
      }
    });

    // Afficher les avenues associées
    avenues.forEach(function(a) {
      if (!selectedQuartierId || a.ID_QUARTIER == selectedQuartierId) {
        var marker = L.marker([a.LATITUDE, a.LONGITUDE], {
          icon: L.divIcon({ className: 'avenue-label', html: a.DESC_AVENUE })
        });
        avenueMarkers.addLayer(marker);
      }
    });
  });

  // Gérer le filtre avenue
  document.getElementById('avenue_filter').addEventListener('change', function() {
    var selectedAvenueId = this.value;

    if (!selectedAvenueId) return;

    avenueMarkers.clearLayers();

    avenues.forEach(function(a) {
      if (a.ID_AVENUE == selectedAvenueId) {
        var marker = L.marker([a.LATITUDE, a.LONGITUDE], {
          icon: L.divIcon({ className: 'avenue-label', html: a.DESC_AVENUE })
        });
        avenueMarkers.addLayer(marker);
        map.setView([a.LATITUDE, a.LONGITUDE], 17); // Zoom fort sur avenue
      }
    });
  });





</script> -->

<!-- <script>
  document.addEventListener('DOMContentLoaded', function() {
    var defaultLat = <?= set_value('LATITUDE') ? set_value('LATITUDE') : '-1.6789' ?>;
    var defaultLng = <?= set_value('LONGITUDE') ? set_value('LONGITUDE') : '29.2203' ?>;

    var map = L.map('map').setView([defaultLat, defaultLng], 13);

    // Couche carte classique OpenStreetMap
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap'
    });

    // Couche satellite (ESRI World Imagery)
    var satellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/' +
      'World_Imagery/MapServer/tile/{z}/{y}/{x}', {
      maxZoom: 19,
      attribution: 'Tiles © Esri'
    });

    // Ajouter la couche osm par défaut
    osm.addTo(map);

    // Contrôle pour changer entre cartes
    var baseMaps = {
      "Carte": osm,
      "Satellite": satellite
    };

    L.control.layers(baseMaps).addTo(map);

    var marker;

    if (defaultLat && defaultLng) {
      marker = L.marker([defaultLat, defaultLng]).addTo(map);
    }

    map.on('click', function(e) {
      var lat = e.latlng.lat.toFixed(6);
      var lng = e.latlng.lng.toFixed(6);

      if (marker) {
        marker.setLatLng(e.latlng);
      } else {
        marker = L.marker(e.latlng).addTo(map);
      }

      document.getElementById('LATITUDE').value = lat;
      document.getElementById('LONGITUDE').value = lng;
    });
  });
</script> -->

<!-- <script>
  document.addEventListener('DOMContentLoaded', function() {
    var defaultLat = <?= set_value('LATITUDE') ? set_value('LATITUDE') : '-1.6789' ?>;
    var defaultLng = <?= set_value('LONGITUDE') ? set_value('LONGITUDE') : '29.2203' ?>;

    var map = L.map('map').setView([defaultLat, defaultLng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap'
    }).addTo(map);

    var marker;

    // Si lat/lng déjà renseigné, afficher le marqueur
    if (defaultLat && defaultLng) {
      marker = L.marker([defaultLat, defaultLng]).addTo(map);
    }

    // Au clic sur la carte, placer ou déplacer le marqueur
    map.on('click', function(e) {
      var lat = e.latlng.lat.toFixed(6);
      var lng = e.latlng.lng.toFixed(6);

      if (marker) {
        marker.setLatLng(e.latlng);
      } else {
        marker = L.marker(e.latlng).addTo(map);
      }

      // Mettre à jour les inputs
      document.getElementById('LATITUDE').value = lat;
      document.getElementById('LONGITUDE').value = lng;
    });
  });
</script> -->

<!-- <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Coordonnées par défaut si aucune lat/lng fournie (ex: centre de Goma)
    var defaultLat = <?= set_value('LATITUDE') ? set_value('LATITUDE') : '-1.6789' ?>;
    var defaultLng = <?= set_value('LONGITUDE') ? set_value('LONGITUDE') : '29.2203' ?>;

    // Initialisation carte Leaflet
    var map = L.map('map').setView([defaultLat, defaultLng], 13);

    // Chargement des tuiles OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap'
    }).addTo(map);

    // Création du marqueur draggable sur la carte
    var marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

    // Mise à jour des champs lat/lng lors du déplacement du marqueur
    marker.on('moveend', function(e) {
      var position = marker.getLatLng();
      document.getElementById('LATITUDE').value = position.lat.toFixed(6);
      document.getElementById('LONGITUDE').value = position.lng.toFixed(6);
    });

    // Initialiser les inputs lat/lng au chargement
    document.getElementById('LATITUDE').value = defaultLat.toFixed(6);
    document.getElementById('LONGITUDE').value = defaultLng.toFixed(6);
  });
</script> -->





