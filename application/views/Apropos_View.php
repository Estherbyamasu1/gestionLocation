<!--begin Head -->
<?php include VIEWPATH.'includes_site/header.php';?>
<!-- end head -->

<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

<style>
.icon {
  color: blue !important; /* Remplace toute couleur rouge ici */
}


</style>
<body>
  <!--Bootstrap modal -->
    <!-- <div class="modal fade" id="myImgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <img src="<?=base_url()?>assets/img/cgm_flyer.jpg" class="img-fluid">
        </div>
        <div class="modal-footer d-flex justify-content-center">
         <center><button id="closemodal" type="button" class="btn mybtn btn-split"><?=lang('fermer')?> <div class="fab"><i class="fa fa-times"></i></div></button></center>
       </div>
     </div>
   </div>
 </div> -->
 <!-- Modal End -->

 <!-- Modal body with image -->



 <!-- Back to top button -->
 <div class="back-to-top"></div>

 <header>
  <!-- Top Section start -->
  <!-- top banner -->
  <!-- <?php //include VIEWPATH.'includes_site/top_banner.php';?> -->
  <!-- Top Section End -->


  <!-- Navbar start -->
  <!-- menu -->
  <?php include VIEWPATH.'includes_site/menu.php';?>
  <!-- Navbar end -->

  <!--################################################################################################################################################################################################################################################################################################################################################################################################################## -->
</header>



<section>
  <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
      <div style="background-image: url(<?=base_url()?>logo/maison2.JPG); background-repeat:  no-repeat; background-size: cover; height:100vh"
        class="page-section carousel-item active" data-interval="5000">
        <div class="container">
          <div class="text-center wow fadeInUp" data-wow-duration="2s">
            <br>
            <h1 class="section-subtitle-hero text-white">
             Bienvenus sur le site web de Location Express Goma
           </h1>
           <!-- <p class="text-white font-weight-bold text-center text-hero"> -->
            <!-- <?=$this->lang->line('carrousel_process_home_2')?></p> -->
                           <!--  <a style="text-decoration: none" href="<?php echo base_url('Apply')?>"><button
                                class="btn mybtn btn-split"><?=$this->lang->line('carrousel_process_home_3')?> <div
                                class="fab"><i class="fa fa-angle-double-right"></i></div></button></a> -->
                              </div>
                            </div> 
                          </div>




                        </div>


                      </div>
                    </section>



                  





 <section
                        style="background-image: url(<?=base_url()?>logo/maison7.JPG); background-size: cover; background-position: center; background-repeat:no-repeat"
                        id="why-us" class="bg-white page-section why-us">
                        <div class="container">
                            <div class="text-center wow fadeInUp">
                                <center>
                                    <h3 class="section-subtitle">Location Express Goma</h3>
                                </center>
                            </div>
                           <!--  <div class="text-center fadeInUp">
                                <img src="<?=base_url()?>assets/img/uneven_orange_line.svg">
                            </div><br> -->

                            <div class="row mb-4 p-4">
                                <center>
                                    <div class="col-lg-8">
                                        <p>Location Express Goma est une plateforme web moderne dédiée à la gestion rapide et sécurisée de la location d’appartements dans la ville de Goma. Elle permet aux propriétaires de publier facilement leurs biens immobiliers et aux locataires de trouver, réserver et payer leur logement en ligne via des passerelles de paiement locales. Grâce à une interface intuitive et un tableau de bord complet pour les administrateurs, Location Express Goma simplifie tout le processus de location, du catalogue à la transaction, en garantissant transparence, efficacité et accessibilité.</p>

                                        <!-- <p>Le CGM comprend: Le Commissariat Central chargé des Etrangers, le Commissariat Central chargé de la Chancellerie et le Commissariat Central chargé des Frontières.</p> -->
                                    </div>
                                </center>
                            </div>

                            <div class="row">

                                <div class="col-lg-6 d-flex align-items-center">
                                    <div style="box-shadow: none" class="icon-box mt-4 mt-xl-0">
                                        <div class="thumb text-center">
                                            <div class="icon"><i class="fa fa-dot-circle-o" aria-hidden="true"></i></div>
                                        </div>
                                        <h4 class="section-subtitle text-center">Mission et Vision</h4>
                                        <div class="p-4">
                                            <p>Location Express a pour mission:</p>
                                            <ul class="card-list text-left list-dark">
                                                <li>Offrir une plateforme numérique fiable, rapide et sécurisée pour la gestion et la location d’appartements à Goma, en connectant efficacement les propriétaires et les locataires tout en facilitant les paiements en ligne locaux.</li>
                                                <li>Devenir la référence numéro un en matière de gestion locative numérique dans la région des Grands Lacs, en transformant l'expérience de location immobilière grâce à l'innovation technologique et à un service client de qualité.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6 d-flex align-items-center justify-content-center"  ><img
                                   style="width: 550px;height: 450px" src="<?=base_url()?>logo/maison.JPG" class="img-fluid wow slideInRight"
                                    data-wow-offset="10" data-wow-duration="3s"></div>
                                </div>
                            </div>
                        </section>





                  
                              <br>

                              <!-- Contacts start -->
                              <?php
// include VIEWPATH.'includes_site/contact.php';
                              ?>
                              <!-- Contacts end -->


                              <!-- begin Footer  -->
                              <?php include VIEWPATH.'includes_site/footer.php';?>
                              <!-- end footer -->

                              <!-- begin button whatsapp  -->
                              <?php include VIEWPATH.'includes_site/whatsapp.php';?>
                              <!-- end button whatsapp  -->

                              <script>
                                $(document).ready(function() {
                                  $("#myImgModal").modal('show');
                                });
                              </script>


                              <script>
                                $('#closemodal').click(function() {
                                  $('#myImgModal').modal('hide');
                                });
                              </script>

                              <script>
                                function myMap() {
                                  var mapProp = {
                                    center: new google.maps.LatLng(51.508742, -0.120850),
                                    zoom: 5,
                                  };
                                  var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

                                  var marker = new google.maps.Marker({
                                    position: center
                                  });

                                  marker.setMap(map);
                                }
                              </script>

                              <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>

                              <script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>

                              <script src="<?=base_url()?>assets/js/google-maps.js"></script>

                              <script src="<?=base_url()?>assets/vendor/wow/wow.min.js"></script>

                              <script src="<?=base_url()?>assets/js/theme.js"></script>

                              <script async defer
                              src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIA_zqjFMsJM_sxP9-6Pde5vVCTyJmUHM&callback=initMap">
                            </script>

                            <script src="<?=base_url()?>assets/js/bs-stepper.min.js"></script>
                            <script src="<?=base_url()?>assets/js/floating-wpp.js"></script>

                            <script type="text/javascript">
                              $(document).ready(function() {
                                var stepper = new Stepper($('.bs-stepper')[0])
                              })
                            </script>


                            <script>
                              $(document).ready(function() {
                                $("#myImgModal").modal('show');
                              });
                            </script>


                            <script>
                              $('#closemodal').click(function() {
                                $('#myImgModal').modal('hide');
                              });
                            </script>


                            <script>


                              function save() {


                                var id_type_plainte = $('#id_type_plainte').val()
                                var numero_bureau = $('#numero_bureau').val()
                                var email_internaute = $('#email_internaute').val()
                                var telephone_internaute = $('#telephone_internaute').val()
                                var message = $('#message').val()


                                var formm = new FormData();
                                formm.append("id_type_plainte", $('#id_type_plainte').val());
                                formm.append("numero_bureau", $('#numero_bureau').val());
                                formm.append("email_internaute", $('#email_internaute').val());
                                formm.append("telephone_internaute", $('#telephone_internaute').val());
                                formm.append("message", $('#message').val());


                                $.ajax({
                                  url: "<?=base_url()?>Home/add_message_internaute",
                                  type: "POST",
                                  dataType: "JSON",
                                  data: formm,
                                  processData: false,
                                  contentType: false,
                                  success: function(data) {            
                                    if (data.statut == 1) {
                                      $('#myModalMessage').modal('hide')
                                      Swal.fire({
                                        title: 'Confirmation',
                                        text: 'Votre plainte a été déclarée avec succès',
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'OK',
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                      }).then((result) => {
                                        if (result.value) {
                                          let lien = "<?= base_url()?>";
                                          window.location.href =lien ;
                                        }
                                      });

                                    }

                                  }

                                });

                              }


                            </script>


                          </body>

                          </html>