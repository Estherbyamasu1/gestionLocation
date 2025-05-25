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
                <h2>Dashboard des reservations</h2>

                <div class="row">
                    <div class="col-lg-6"><div id="statut_chart"></div></div>
                    <div class="col-lg-6"><div id="mois_chart"></div></div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-6"><div id="locataire_chart"></div></div>
                    <div class="col-lg-6"><div id="revenu_chart"></div></div>
                </div>
            </div>
        </div>
    </div>

    <?php include VIEWPATH.'includes/scripts_js.php'; ?>
    <?php include VIEWPATH.'includes/legende.php'; ?>

    <script>
        Highcharts.chart('statut_chart', {
            chart: { type: 'column' },
            title: { text: 'Réservations par Statut' },
            xAxis: { type: 'category' },
            yAxis: { title: { text: 'Nombre de Réservations' } },
            series: <?= $series_reservation_statut ?>
        });

        Highcharts.chart('mois_chart', {
            chart: { type: 'line' },
            title: { text: 'Réservations par Mois' },
            xAxis: {
                categories: <?= $categories_mois ?>,
                title: { text: 'Mois' }
            },
            yAxis: { title: { text: 'Nombre de Réservations' } },
            series: <?= $series_mois ?>
        });

        Highcharts.chart('locataire_chart', {
            chart: { type: 'bar' },
            title: { text: 'Réservations par Locataires' },
            xAxis: {
                categories: <?= $categories_locataire ?>,
                title: { text: 'Locataires' }
            },
            yAxis: { title: { text: 'Réservations' } },
            series: <?= $series_locataire ?>
        });

        Highcharts.chart('revenu_chart', {
            chart: { type: 'column' },
            title: { text: 'Revenus par Meuble' },
            xAxis: {
                categories: <?= $categories_revenus ?>,
                title: { text: 'Meubles' }
            },
            yAxis: { title: { text: 'Montant (Fbu)' } },
            series: <?= $series_revenus ?>
        });
    </script>
</body>
</html>