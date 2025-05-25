<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include VIEWPATH.'includes/header.php'; ?>
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>
    <?php include VIEWPATH.'includes/loadpage.php'; ?>
    <div id="main-wrapper">
        <?php include VIEWPATH.'includes/navybar.php'; ?>
        <?php include VIEWPATH.'includes/menu.php'; ?>

        <div class="content-body">
            <div class="container-fluid">
                <h2>Dashboard des paiements</h2>

                <div class="row">
                    <div class="col-lg-6"><div id="type_paiement_chart"></div></div>
                    <div class="col-lg-6"><div id="paiement_mensuel_chart"></div></div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-6"><div id="statut_paiement_chart"></div></div>
                    <div class="col-lg-6"><div id="top_telephones_chart"></div></div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-6"><div id="paiement_par_jour_chart"></div></div>
                    <div class="col-lg-6"><div id="top_code_paiement_chart"></div></div>
                </div>
            </div>
        </div>
    </div>

    <?php include VIEWPATH.'includes/scripts_js.php'; ?>
    <?php include VIEWPATH.'includes/legende.php'; ?>

    <script>
        Highcharts.chart('type_paiement_chart', {
    chart: { type: 'column' },
    title: { text: 'Montant par Type de Paiement' },
    xAxis: { categories: <?= $categories_type ?> },
    yAxis: { title: { text: 'Montant Total (Fbu)' } },
    series: <?= $series_type ?>
});

Highcharts.chart('paiement_mensuel_chart', {
    chart: { type: 'line' },
    title: { text: 'Montant des Paiements par Mois' },
    xAxis: { categories: <?= $categories_mois ?> },
    yAxis: { title: { text: 'Montant (Fbu)' } },
    series: <?= $series_mois ?>
});

Highcharts.chart('statut_paiement_chart', {
    chart: { type: 'pie' },
    title: { text: 'Répartition par Statut de Paiement' },
    series: <?= $series_statut ?>
});

Highcharts.chart('top_telephones_chart', {
    chart: { type: 'bar' },
    title: { text: 'Montant Payé par téléphone' },
    xAxis: { categories: <?= $categories_tel ?> },
    yAxis: { title: { text: 'Montant (Fbu)' } },
    series: <?= $series_tel ?>
});

Highcharts.chart('paiement_par_jour_chart', {
    chart: { type: 'area' },
    title: { text: 'Nombre de Paiements par jour)' },
    xAxis: { categories: <?= $categories_jour ?> },
    yAxis: { title: { text: 'Nombre de Paiements' } },
    series: <?= $series_jour ?>
});

Highcharts.chart('top_code_paiement_chart', {
    chart: { type: 'column' },
    title: { text: 'Montant par codes de Paiement' },
    xAxis: { categories: <?= $categories_code ?> },
    yAxis: { title: { text: 'Montant (Fbu)' } },
    series: <?= $series_code ?>
});
    </script>
</body>
</html>