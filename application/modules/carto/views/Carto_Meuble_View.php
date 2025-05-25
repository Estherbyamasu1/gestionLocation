<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include VIEWPATH . 'includes/header.php'; ?>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <style>
    #map {
      height: 600px;
      width: 100%;
      background: #ccc;
    }
    .quartier-label {
      color: blue;
      font-weight: bold;
      background: rgba(255, 255, 255, 0.7);
      padding: 2px 6px;
      border-radius: 4px;
      white-space: nowrap;
      font-size: 14px;
    }
    .avenue-label {
      color: green;
      background: rgba(255, 255, 255, 0.7);
      padding: 2px 4px;
      border-radius: 4px;
      white-space: nowrap;
      font-size: 13px;
    }
  </style>
</head>
<body>
  <?php include VIEWPATH . 'includes/loadpage.php'; ?>
  <div id="main-wrapper">
    <?php include VIEWPATH . 'includes/navybar.php'; ?>
    <?php include VIEWPATH . 'includes/menu.php'; ?>

    <div class="content-body">
      <div class="container-fluid">
        <h2>Cartographie des appartements</h2>
        <?= $this->session->flashdata('message'); ?>
        <br>

        <!-- Filtres -->
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="quartier_filter">Quartier </label>
            <select id="quartier_filter" class="form-control">
              <option value="">-- Tous les quartiers --</option>
              <?php 
                $quartiers = $this->db->select('ID_QUARTIER, DESC_QUARTIER')->get('quartier_avenue')->result();
                foreach ($quartiers as $q): ?>
                <option value="<?= $q->ID_QUARTIER ?>"><?= htmlspecialchars($q->DESC_QUARTIER) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-4">
            <label for="avenue_filter">Avenue </label>
            <select id="avenue_filter" class="form-control" disabled>
              <option value="">-- Toutes les avenues --</option>
            </select>
          </div>
        </div>

        <br>

        <!-- Carte -->
        <div id="map" style="height: 700px;"></div>
      </div>
    </div>
  </div>

  <?php include VIEWPATH . 'includes/scripts_js.php'; ?>

<?php
$quartiers_geo = $this->db->select('ID_QUARTIER, DESC_QUARTIER, LATITUDE, LONGITUDE')->get('quartier_avenue')->result_array();
$avenues_geo = $this->db->select('ID_AVENUE, ID_QUARTIER, DESC_AVENUE, LATITUDE, LONGITUDE')->get('avenue')->result_array();
$meubles_geo = $this->db->select('ID_MEUBLE, NOM_MEUBLE, NUMERO_MEUBLE, LATITUDE, LONGITUDE, ID_QUARTIER, ID_AVENUE, MONTANT')->get('meuble')->result_array();
?>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
  const quartiers_geo = <?= json_encode($quartiers_geo); ?>;
  const avenues = <?= json_encode($avenues_geo); ?>;
  const meubles = <?= json_encode($meubles_geo); ?>;

  const map = L.map('map').setView([-1.6789, 29.2203], 13);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
  }).addTo(map);

  const meubleMarkers = L.layerGroup().addTo(map);

  const iconMaisonRouge = L.icon({
    iconUrl: 'https://cdn-icons-png.flaticon.com/512/484/484167.png',
    iconSize: [32, 37],
    iconAnchor: [16, 37],
    popupAnchor: [0, -37]
  });

  function afficherMeubles(filterQuartierId = null, filterAvenueId = null) {
    meubleMarkers.clearLayers();
    let latlngs = [];

    meubles.forEach(m => {
      const matchQuartier = !filterQuartierId || m.ID_QUARTIER == filterQuartierId;
      const matchAvenue = !filterAvenueId || m.ID_AVENUE == filterAvenueId;

      if (matchQuartier && matchAvenue && m.LATITUDE && m.LONGITUDE) {
        const latLng = [parseFloat(m.LATITUDE), parseFloat(m.LONGITUDE)];
        const marker = L.marker(latLng, {icon: iconMaisonRouge});
        marker.bindPopup(
          `<b>Meuble :</b> ${m.NOM_MEUBLE} <br> Numéro : ${m.NUMERO_MEUBLE} <br> Montant : ${m.MONTANT || 'N/A'} FC`
        );
        meubleMarkers.addLayer(marker);
        latlngs.push(latLng);
      }
    });

    if (latlngs.length === 1) {
      map.setView(latlngs[0], 17);
    } else if (latlngs.length > 1) {
      const bounds = L.latLngBounds(latlngs);
      map.fitBounds(bounds.pad(0.2));
    }
  }

  function updateAvenueOptions(quartierId) {
    const avenueSelect = document.getElementById('avenue_filter');
    avenueSelect.innerHTML = '<option value="">-- Toutes les avenues --</option>';
    avenueSelect.disabled = !quartierId;

    if (quartierId) {
      avenues.forEach(a => {
        if (a.ID_QUARTIER == quartierId) {
          const opt = document.createElement('option');
          opt.value = a.ID_AVENUE;
          opt.textContent = a.DESC_AVENUE;
          avenueSelect.appendChild(opt);
        }
      });
    }
  }

  const quartierSelect = document.getElementById('quartier_filter');
  const avenueSelect = document.getElementById('avenue_filter');

  quartierSelect.addEventListener('change', function () {
    const quartierId = this.value || null;

    updateAvenueOptions(quartierId);
    avenueSelect.value = '';

    afficherMeubles(quartierId, null);

    if (quartierId) {
      const quartier = quartiers_geo.find(q => q.ID_QUARTIER == quartierId);
      if (quartier && quartier.LATITUDE && quartier.LONGITUDE) {
        map.setView([parseFloat(quartier.LATITUDE), parseFloat(quartier.LONGITUDE)], 14);
      }
    } else {
      map.setView([-1.6789, 29.2203], 13);
    }
  });

  avenueSelect.addEventListener('change', function () {
    const avenueId = this.value || null;
    const quartierId = quartierSelect.value || null;

    afficherMeubles(quartierId, avenueId);

    if (avenueId) {
      const avenue = avenues.find(a => a.ID_AVENUE == avenueId);
      if (avenue && avenue.LATITUDE && avenue.LONGITUDE) {
        map.setView([parseFloat(avenue.LATITUDE), parseFloat(avenue.LONGITUDE)], 17);
        return;
      }
    }

    if (quartierId) {
      const quartier = quartiers_geo.find(q => q.ID_QUARTIER == quartierId);
      if (quartier && quartier.LATITUDE && quartier.LONGITUDE) {
        map.setView([parseFloat(quartier.LATITUDE), parseFloat(quartier.LONGITUDE)], 14);
      }
    } else {
      map.setView([-1.6789, 29.2203], 13);
    }
  });

  // ===> Affichage des noms des quartiers
  quartiers_geo.forEach(q => {
    if (q.LATITUDE && q.LONGITUDE) {
      L.marker([parseFloat(q.LATITUDE), parseFloat(q.LONGITUDE)], {
        icon: L.divIcon({
          className: 'quartier-label',
          html: q.DESC_QUARTIER
        })
      }).addTo(map);
    }
  });

  // ===> Affichage des noms des avenues
  avenues.forEach(a => {
    if (a.LATITUDE && a.LONGITUDE) {
      L.marker([parseFloat(a.LATITUDE), parseFloat(a.LONGITUDE)], {
        icon: L.divIcon({
          className: 'avenue-label',
          html: a.DESC_AVENUE
        })
      }).addTo(map);
    }
  });

  // Initialisation
  updateAvenueOptions(null);
  afficherMeubles(null, null);
});
</script>

</body>
</html>