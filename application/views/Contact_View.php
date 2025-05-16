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
      <h3 class="section-subtitle">Contactez-nous</h3>
    </div>
    <br>

    <form enctype="multipart/form-data" method="post" action="<?=base_url('Contact/ajouter')?>">

       <?= $this->session->flashdata('message');?>

      <div class="row">
        <div class="col-lg-6 mb-4">
          <input type="text" name="NOM_CONTACT" class="form-control" placeholder="nom complet">
          <span class="text-danger"><?php echo form_error("NOM_CONTACT");?></span>
        </div>
        <div class="col-lg-6 mb-4">
          <input type="email" name="EMAIL_CONTACT" class="form-control" placeholder="email"> 
          <span class="text-danger"><?php echo form_error("EMAIL_CONTACT");?></span>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6 mb-4">
          <input type="text" name="SUJET" class="form-control" placeholder="sujet">
          <span class="text-danger"><?php echo form_error("SUJET");?></span>
        </div>
        <div class="col-lg-6 mb-4">
          <textarea class="form-control" placeholder="message" rows="4" name="MESSAGE" id="MESSAGE"></textarea>
          <span class="text-danger"><?php echo form_error("MESSAGE");?></span>
        </div>
      </div>

      <!-- ✅ Bouton centré -->
      <div class="row">
      <div class="col-12 d-flex justify-content-center">
  <button class="btn btn-primary rounded-pill px-5 py-2" type="submit">
    Envoyer <i class="fa fa-paper-plane ms-2"></i>
  </button>
</div>
      </div>

    </form>
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

                      <script type="text/javascript">
  $('#message').delay('slow').fadeOut(3000);
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