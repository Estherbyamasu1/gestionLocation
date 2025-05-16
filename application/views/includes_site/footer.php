


    <!-- footer start -->
    <footer class="page-footer bg-image" style="background-image: url(<?=base_url()?>/logo/maison7.JPG); z-index: -2">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-7 col-md-12 col-sm-12 mb-2">
                    <img alt="Commissariat Général des Migrations Logo" style="margin-bottom: 10px" width='150' src='<?=base_url()?>logo/png_logo.png'>
                    <p class="text-white">Location Express Goma est une plateforme web moderne dédiée à la gestion rapide et sécurisée de la location d’appartements dans la ville de Goma. Elle permet aux propriétaires de publier facilement leurs biens immobiliers et aux locataires de trouver, réserver et payer leur logement en ligne via des passerelles de paiement locales. Grâce à une interface intuitive et un tableau de bord complet pour les administrateurs, Location Express Goma simplifie tout le processus de location, du catalogue à la transaction, en garantissant transparence, efficacité et accessibilité.</p>

                    <div class="social-media-button">
                        <a href="#"><i style="color: #081536" class="fa fa-facebook"></i></a>
                        <a href="#"><i style="color: #081536" class="fa fa-twitter"></i></a>
                        <a href="#"><i style="color: #081536" class="fa fa-linkedin"></i></a>
                    </div><br>
                </div>

<!-- 
                <div class="col-lg-5 col-md-12 col-sm-12 mb-2 d-flex justify-content-center" style="max-width: 320px; height: 200px">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1991.481641639726!2d29.373233183707608!3d-3.35914054312348!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19c1824d0f3cf77f%3A0x6036affb36502190!2sPAFE%20(Immigration%20Authority)!5e0!3m2!1sen!2sbi!4v1640696941362!5m2!1sen!2sbi" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div> -->
            </div><br><br><br><br>
            <div class="col-lg-12 text-center">
                <span class="text-white">Copyright &copy; <script>
                        document.write(new Date().getFullYear())

                    </script> - Développé par <a style="text-decoration: none; color: white" href="mediabox.bi"><b>Esther Byamasu Furaha</b></a></span>
            </div>
        </div>
    </footer>
    <!-- footer end -->










    
<!-- Modal Start -->
    <div class="modal fade" id="myModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  d-flex justify-content-center">
                    <h5 class="modal-title text-center text-white">Déclaration d'une plainte</h5>
                </div>
                    <!-- <form id="myformmessage"  method="post"> -->

                <div class="modal-body">
                        <div class="row">

                            <div class="col-lg-6 mb-4">
                                <label style="font-weight: 900; color:#454545">Type de plainte <span style="color: red">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>

                                    <select id="id_type_plainte" name="id_type_plainte" class="form-control" data-placeholder="Type de message">
                                        <option value="">Sélectionner</option>
                                        <?php 

                                            $this->db->select('id_type_plainte,description,STATUT');
                                            $this->db->from('type_plainte');
                                            $this->db->where('STATUT', 1);
                                            $type_plainte = $this->db->get();

                                            // $type_plainte = $this->My_model->getRequete("SELECT * FROM type_plainte");
                                              foreach ($type_plainte->result_array() as $key) {
                                                ?>
                                                <option value="<?=$key['id_type_plainte']?>"><?=$key['description']?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <font color="red" id="erid_type_plainte" class="help"></font>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label style="font-weight: 900; color:#454545">Numéro bureau</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-desktop"></i></span>

                                    <select id="numero_bureau" name="numero_bureau" class="form-control" data-placeholder="Type de message">
                                        <option value="">Sélectionner</option>
                                        <?php 
                                             
                                        	$this->db->select('bureau_id,bureau_descr,bureau_active');
                                            $this->db->from('doc_bureaux');
                                            $this->db->where('bureau_active', 1);

                                            $bureaux = $this->db->get();
                                            // $type_plainte = $this->My_model->getRequete("SELECT * FROM doc_bureaux WHERE bureau_active=1");
                                              foreach ($bureaux->result_array() as $key) {
                                                ?>
                                                <option value="<?=$key['bureau_id']?>"><?=$key['bureau_descr']?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                <font color="red" id="ernumero_bureau" class="help"></font>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label style="font-weight: 900; color:#454545">E-mail <span style="color: red">*</span></label>
                                <input type="text" name="email_internaute" id="email_internaute" class="form-control">
                                <font color="red" id="eremail_internaute" class="help"></font>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label style="font-weight: 900; color:#454545">Téléphone <span style="color: red">*</span></label>
                                <input type="text" name="telephone_internaute" id="telephone_internaute" class="form-control">
                                <font color="red" id="ertelephone_internaute" class="help"></font>
                            </div>


                            <div class="col-lg-12 mb-4">
                                <label style="font-weight: 900; color:#454545">Message <span style="color: red">*</span></label> <br>
                                <textarea class="form-control" id="message" name="message" maxlength="500" style="width: 100%; height: 100px" placeholder="Message"></textarea>
                                <font color="red" id="ermessage" class="help"></font>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fermer</button>
                    <button type="button" onclick="save()" class="btn btn-info" ><i class="fa fa-paper-plane" aria-hidden="true"></i> Envoyer</button>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>

    <!-- Modal End -->

    <script type="text/javascript">
    function save() {

      var statut = true;


      if ($("#id_type_plainte").val()=='') 
      {
        $('#erid_type_plainte').text('Champ obligatoire');
        $("#id_type_plainte").focus();
        statut = false;
        console.log(statut)
      }

      // if ($("#numero_bureau").val()=='') 
      // {
      //   $('#ernumero_bureau').text('Champ obligatoire');
      //   $("#numero_bureau").focus();
      //   statut = false;
      //   console.log(statut)
      // }
        
      if ($("#email_internaute").val()=='') 
      {
        $('#eremail_internaute').text('Champ obligatoire');
        $("#email_internaute").focus();
        statut = false;
        console.log(statut)
      }

      if ($("#telephone_internaute").val()=='') 
      {
        $('#ertelephone_internaute').text('Champ obligatoire');
        $("#telephone_internaute").focus();
        statut = false;
        console.log(statut)
      }

      if ($("#message").val()=='') 
      {
        $('#ermessage').text('Champ obligatoire');
        $("#message").focus();
        statut = false;
        console.log(statut)
      }

      if (statut==true)
       { 
          myformmessage.submit();
       }
    }
</script>

   
    <script type="text/javascript">
      jQuery(document).ready(function($) {
  var alterClass = function() {
    var ww = document.body.clientWidth;
    if (ww > 440) {
      $('.dropdown-item').removeClass('text-wrap');
    } else if (ww <= 441) {
      $('.dropdown-item').addClass('text-wrap');
    };
  };
  $(window).resize(function(){
    alterClass();
  });
  //Fire it when the page first loads:
  alterClass();
});
    </script>




