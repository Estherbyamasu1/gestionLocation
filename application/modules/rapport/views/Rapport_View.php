






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
              <div class="col-lg-12">
                <!-- <div class="heading1 mt-4 ml-5"> -->
                  <h2>Dashboard des appartements</h2>
                <!-- </div> -->
              </div>

              
            </div>
            <div class="full price_table padding_infor_info">
              <?= $this->session->flashdata('message');?>
            

<div class="row">

	<div class="col-lg-6">
		<div id="container" style="width: 80%; height: 500px; margin: 0 auto;"></div>
	</div>
<div class="col-lg-6">
		<div id="container1" style="width: 80%; height: 500px; margin: 0 auto;"></div>
	</div>

	

</div>
<div class="row">
	<!-- <div id="chart_reservation_statut"></div> -->
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



















    <script type="text/javascript">
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Appartement par statut'
            },
            xAxis: {
                type: 'category',
                title: {
                    text: ''
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Nombre de meubles'
                }
            },
            legend: {
                enabled: true
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat:
                    '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            series: [<?= $series ?>] // injecte le contenu PHP brut ici
        });
    </script>

<script type="text/javascript">
        Highcharts.chart('container1', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Appartement par categorie'
            },
            xAxis: {
                type: 'category',
                title: {
                    text: ''
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Nombre de meubles'
                }
            },
            legend: {
                enabled: true
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat:
                    '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            series: [<?= $series1 ?>] // injecte le contenu PHP brut ici
        });
    </script>


<script type="text/javascript">
Highcharts.chart('chart_reservation_statut', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Réservations par statut'
    },
    xAxis: {
        type: 'category',
        title: {
            text: ''
        }
    },
    yAxis: {
        title: {
            text: 'Nombre de Réservations'
        }
    },
    series: [<?= $reservation_series ?>]
});
</script>
