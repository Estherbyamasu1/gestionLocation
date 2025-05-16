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
                      <div class="text-center mb-4 wow fadeInUp">
                        <center>
                          <h3 class="section-subtitle text-black">Appartements disponible
                          </h3>
                        </center>
                      </div>
                      <br>
                     <!--  <div class="row">
                        <div class="col-lg-12 d-flex align-items-center">
                          <div class="icon-boxes d-flex flex-column justify-content-center">
 -->
                           <div class="row">

                            <?php
                            foreach ($appart as $key){
                              $path='uploads/doc_meuble/'.$key['IMAGE_MEUBLE'];

                                        // print_r($path);
                              ?>

                              <div class="col-lg-4 mb-4">
                                <div class="card">
                                  <?php if (!empty($key['IMAGE_MEUBLE'])): ?>
                                    <img style="height: 100px; height: 300px" class="img-fluid" src="<?=base_url().$path?>" alt="Image de l'appartement">
                                  <?php else: ?>
                                    <img style="height: 100px; height: 300px" class="card-img-top img-fluid" src="<?=base_url().$path?>" alt="Image non disponible">
                                  <?php endif; ?>
                                  <div class="card-body">
                                    <label class="card-title font-weight-bold">
                                      <?= $key['NOM_MEUBLE'] . ' - adresse : ' . $key['ADRESSE'] ?>
                                    </label>
                                  </div>
                                </div>
                              </div>
                                     <!--   <div class="col-lg-4">

                                         <img class="img-fluid" src="<?=base_url().$path?>" >
                                         <label><?=$key['NOM_MEUBLE'].' '.$key['ADRESSE'] ?></label>
                                        
                                       </div>  -->
                                       <?php
                                     }
                                     ?>

                                   </div>

                                   <!--  <div class="row d-flex justify-content-center mb-4">
                                        <div class="col-lg-6 left-image wow slideInLeft" data-wow-duration="2s">
                                            <img class="img-fluid" src="<?=base_url()?>assets/img/hublot_side_image.png">
                                        </div>

                                        <div class="col-lg-6 d-flex p-2 align-items-stretch">
                                            <div style="border-bottom: none; box-shadow: none"
                                            class="icon-box bg-transparent mt-4 mt-xl-0">
                                            <div class="thumb">
                                                <div class="icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                                            </div>
                                            <h4 class="section-subtitle text-white">
                                                <?=$this->lang->line('administraion_centrale')?></h4>
                                                <p class="text-white"><?=$this->lang->line('administraion_centrale_comprend')?></p>
                                                <ul class="text-left text-white list-white">
                                                    <li><?=$this->lang->line('commissariat_charge_logistique')?></li>
                                                    <li><?=$this->lang->line('commissariat_central_chancellerie')?></li>
                                                    <li><?=$this->lang->line('commissariat_central_etrangers')?></li>
                                                    <li><?=$this->lang->line('commissariat_central_frontieres')?></li>
                                                 
                                                </ul>
                                            </div>
                                        </div>
                                      </div> -->

                                    <!-- <div class="row d-flex justify-content-center mb-4">

                                        <div class="col-lg-6 d-flex p-2 align-items-stretch">
                                            <div style="border-bottom: none; box-shadow: none"
                                            class="icon-box bg-transparent mt-4 mt-xl-0">
                                            <div class="thumb">
                                                <div class="icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                                            </div>
                                            <h4 class="section-subtitle text-white">
                                                <?=$this->lang->line('administration_decentraliser')?></h4>
                                                <p class="text-white">
                                                    <?=$this->lang->line('administration_decentraliser_comprend')?></p>
                                                    <ul class="text-left text-white list-white">
                                                        <li>Goma Quartier Katindo</li>
                                                        <li><?=$this->lang->line('commissariat_portuaire')?></li>
                                                        <li><?=$this->lang->line('commissariat_poste_frontieres')?></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 right-image wow slideInRight" data-wow-duration="2s">
                                                <img class="img-fluid" src="<?=base_url()?>assets/img/hands_side_image.png">
                                            </div>
                                          </div> -->
                                        <!-- </div>
                                      </div>
                                    </div> -->
                                  <!-- </div> -->
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