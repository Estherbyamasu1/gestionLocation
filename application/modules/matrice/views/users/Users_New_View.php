 
              <!-- dashboard inner -->
              <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <?php // include('menu_document.php') ?>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row column1">
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                                <div class="row">
                                    <div class="col-lg-6">
                                       <div class="heading1 mt-4 ml-5">
                                          <h2><?=$title?></h2>
                                       </div>
                                    </div>

                                    <div class="col-lg-6">
                                       <?php include('menu_user.php') ?>
                                    </div>
                              </div>
                    
                              <div class="full price_table padding_infor_info">                            
                                  <div class="row">
                                    <div class="col-lg-12">
                                    <?php $hiddens = ['mbr_id'=>$user['mbr_id']] ?>
                                    <?php echo form_open('matrice/Users/nouveau',null, $hiddens); ?>
                                        <div class="row mb-4">
                                            <div class="form-group col-md-6">
                                                <?php echo form_label('Nom', 'mbr_fname',['style'=>"font-weight: 900; color:#454545"]); ?>
                                                <?php 
                                                    $mbr_fname = ['type'=>'text','name'=>'mbr_fname','value' =>set_value('mbr_fname',$user['mbr_fname']),'class' => 'form-control','placeholder' => 'Nom'];
                                                    echo form_input($mbr_fname);
                                                ?> 
                                                <i><?php echo form_error('mbr_fname', '<div class="text-danger">', '</div>'); ?></i>

                                            </div>

                                            <div class="form-group col-md-6">
                                                <?php echo form_label('Prénom', 'mbr_lname',['style'=>"font-weight: 900; color:#454545"]); ?>
                                                <?php 
                                                    $mbr_lname = ['type'=>'text','name'=>'mbr_lname','value' =>set_value('mbr_lname',$user['mbr_lname']),'class' => 'form-control','placeholder' => 'Prenom'];
                                                    echo form_input($mbr_lname);
                                                ?>   
                                                <i><?php echo form_error('mbr_lname', '<div class="text-danger">', '</div>'); ?></i>

                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="form-group col-md-6">
                                                <?php echo form_label('Téléphone', 'mbr_telephone',['style'=>"font-weight: 900; color:#454545"]); ?>
                                                <?php 
                                                    $mbr_telephone = ['type'=>'text','name'=>'mbr_telephone','value' =>set_value('mbr_telephone',$user['mbr_telephone']),'class' => 'form-control','placeholder' => 'Telephone'];
                                                    echo form_input($mbr_telephone);
                                                ?> 
                                                <i><?php echo form_error('mbr_telephone', '<div class="text-danger">', '</div>'); ?></i>

                                            </div>

                                            <div class="form-group col-md-6">
                                                <?php echo form_label('Email', 'mbr_email',['style'=>"font-weight: 900; color:#454545"]); ?>
                                                <?php 
                                                    $mbr_email = ['type'=>'text','name'=>'mbr_email','value' =>set_value('mbr_email',$user['mbr_email']),'class' => 'form-control','placeholder' => 'Email'];
                                                    echo form_input($mbr_email);
                                                ?>   
                                                <i><?php echo form_error('mbr_email', '<div class="text-danger">', '</div>'); ?></i>

                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="form-group col-md-6">
                                                <?php echo form_label('Description', 'mbr_description',['style'=>"font-weight: 900; color:#454545"]); ?>
                                                <?php 
                                                    $mbr_description = ['type'=>'text','name'=>'mbr_description','value' =>set_value('mbr_description',$user['mbr_description']),'class' => 'form-control','placeholder' => 'Description'];
                                                    echo form_input($mbr_description);
                                                ?> 
                                                <i><?php echo form_error('mbr_description', '<div class="text-danger">', '</div>'); ?></i>

                                            </div> 

                                            <div class="form-group col-md-6">
                                                <?php echo form_label('Bureau', 'bureau_id',['style'=>"font-weight: 900; color:#454545"]); ?>
                                                
                                                <?php echo form_dropdown('bureau_id', $this->My_model->dropdown_bureau(), set_value('bureau_id', $user['bureau_id']), 'id="bureau_id" class="form-control required"'); ?>
                                                <i><?php echo form_error('bureau_id', '<div class="text-danger">', '</div>'); ?></i>
                                                                              
                                            </div>
                                        </div>

                                        <div class="row mb-4">

                                            <div class="form-group col-md-6">
                                                <?php echo form_label('Etat', 'mbr_authorized',['style'=>"font-weight: 900; color:#454545"]); ?>
                                                
                                                <?php echo form_dropdown('mbr_authorized', $this->My_model->dropdown_etat_member(), set_value('mbr_authorized', $user['mbr_authorized']), 'id="mbr_authorized" class="form-control required"'); ?>
                                                <i><?php echo form_error('mbr_authorized', '<div class="text-danger">', '</div>'); ?></i>
                                                                              
                                            </div>

                                            <div class="form-group col-md-6">
                                                <?php echo form_label('Role', 'rol_id',['style'=>"font-weight: 900; color:#454545"]); ?>
                                                
                                                <?php echo form_dropdown('rol_id', $this->My_model->dropdown_role(), set_value('rol_id', $user['mbr_authorized']), 'id="rol_id" class="form-control required" onchange="test_compagnie()"'); ?>
                                                <i><?php echo form_error('rol_id', '<div class="text-danger">', '</div>'); ?></i>
                                                                              
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                          

                                          <div class="form-group col-md-6" id="div_compagnie">
                                        <?php echo form_label('Compagnie', 'compagnie_id',['style'=>"font-weight: 900; color:#454545"]); ?> 
                                            <select class="form-control" name="compagnie_id" id="compagnie_id">
                                                <option value="">-</option>
                                                <?php
                                                $compagnies=$this->Model->getRequete("SELECT * FROM `compagnie` WHERE 1");
                                                foreach ($compagnies as $value){
                                                if ($value['ID_COMPAGNIE'] == $user['compagnie_id']){?>
                                                <option value="<?=$value['ID_COMPAGNIE']?>" selected><?=$value['DESC_COMPAGNIE']?></option>
                                                <?php } else{ ?>
                                                <option value="<?=$value['ID_COMPAGNIE']?>"><?=$value['DESC_COMPAGNIE']?></option>
                                                <?php } } ?>        
                                            </select><i><?php echo form_error('compagnie_id', '<div class="text-danger">', '</div>'); ?></i>
                                        </div>
                                        </div>
                                        
                                    <div class="row mb-4">
                                    <div class="form-group col-md-6">
                                      <?php echo form_label('Province', 'province_id',['style'=>"font-weight: 900; color:#454545"]); ?>
                                      <select class="form-control" onchange="get_communes();submit_prov()" name="province_id" id="province_id" <?php set_value('province_id',$user['mbr_authorized']) ?>>
                                        <option value="">-</option>
                                         <?php
                                         $provinces=$this->Model->getRequete("SELECT * FROM provinces WHERE 1");
                                        foreach ($provinces as $value){

                                        if ($value['province_id'] == $user['province_id']){?>
                                        <option value="<?=$value['province_id']?>" selected><?=$value['province_name']?></option>
                                        <?php } else{ ?>
                                        <option value="<?=$value['province_id']?>"><?=$value['province_name']?></option>
                                        <?php } } ?>
                                     </select> 

                                       <i><?php echo form_error('province_id', '<div class="text-danger">', '</div>'); ?></i>
                                    </div> 

                                                
                                    <div class="form-group col-md-6">
                                            <?php echo form_label('Commune', 'commune_id',['style'=>"font-weight: 900; color:#454545"]); ?>   
                                        <!--  <select class="form-control"onchange="get_zones();" name="commune_id" id="commune_id">
                                            <option value="">-</option>
                                            <?php
                                            $communes=$this->Model->getRequete("SELECT * FROM communes WHERE 1");
                                            foreach ($zones as $value){
                                            if ($value['commune_id'] ==$user['commune_id'] ){?>
                                            <option value="<?=$value['commune_id']?>" selected><?=$value['commune_name']?></option>
                                            <?php } else{ ?>
                                            <option value="<?=$value['commune_id']?>"><?=$value['commune_name']?></option>
                                            <?php } } ?> -->


                                            <select class="form-control"onchange="get_zones()" name="commune_id" id="commune_id">
                                                <option value="">-</option>
                                                <?php
                                                $zones=$this->Model->getRequete("SELECT * FROM communes WHERE 1");
                                                foreach ($communes as $value){
                                                if ($value['commune_id'] ==$user['commune_id'] ){?>
                                                <option value="<?=$value['commune_id']?>" selected><?=$value['commune_name']?></option>
                                                <?php } else{ ?>
                                                <option value="<?=$value['commune_id']?>"><?=$value['commune_name']?></option>
                                                <?php } } ?>

                                     </select><i><?php echo form_error('commune_id', '<div class="text-danger">', '</div>'); ?>
                                     </div>
                                    </div>


                                    <div class="row mb-12">

                                        <div class="form-group col-md-12">
                                           
                                           <?php echo form_label('Zone', 'ZONE_ID',['style'=>"font-weight: 900; color:#454545"]); ?>
                                            <select class="form-control"onchange="get_collines()" name="ZONE_ID" id="ZONE_ID">
                                                <option value="">-</option>
                                                <?php
                                                $zones=$this->Model->getRequete("SELECT * FROM zones WHERE 1");
                                                foreach ($zones as $value){
                                                if ($value['ZONE_ID'] ==$user['zone_id'] ){?>
                                                <option value="<?=$value['ZONE_ID']?>" selected><?=$value['ZONE_NAME']?></option>
                                                <?php } else{ ?>
                                                <option value="<?=$value['ZONE_ID']?>"><?=$value['ZONE_NAME']?></option>
                                                <?php } } ?>
                                          </select><i><?php echo form_error('ZONE_ID', '<div class="text-danger">', '</div>'); ?></i>
                                        </div>

                                        <div class="form-group col-md-12">
                                        <?php echo form_label('Colline', 'colline_id',['style'=>"font-weight: 900; color:#454545"]); ?> 
                                            <select class="form-control" name="colline_id" id="colline_id">
                                                <option value="">-</option>
                                                <?php
                                                $zones=$this->Model->getRequete("SELECT * FROM collines WHERE 1");
                                                foreach ($zones as $value){
                                                if ($value['colline_id'] == $user['colline_id']){?>
                                                <option value="<?=$value['colline_id']?>" selected><?=$value['colline']?></option>
                                                <?php } else{ ?>
                                                <option value="<?=$value['colline_id']?>"><?=$value['colline']?></option>
                                                <?php } } ?>        
                                            </select><i><?php echo form_error('colline_id', '<div class="text-danger">', '</div>'); ?></i>
                                        </div>
                                    </div>

                                                  

                                      <?php 

                                        if ($user['mbr_id']) {
                                          if ($user['is_urgence_visa']==1) {
                                            $checked='checked';
                                          }else{
                                            $checked='';
                                          }
                                          if ($user['is_urgence_visa']==0) {
                                            $non_checked='checked';
                                          }else{
                                            $non_checked='';
                                          }
                                        }else{
                                          $non_checked='checked';
                                          $checked='';
                                        }
                                      ?>

                                        <div class="row mb-4">
                                          <div class="form-group col-md-6"><div class="row">
                                          <div class="col-md-6"><label style="font-weight: 900; color:#454545">Urgence</label></div>
                                          <div class="col-md-6">
                                          <div class="form-check">
                                            <input value="0" class="form-check-input" type="radio" value="<?=set_value('is_urgence_visa', $user['is_urgence_visa']) ?>" id="flexRadioDefault1non" name="flexRadioDefault" <?=$non_checked; ?>>
                                              <label class="form-check-label" for="flexRadioDefault1">
                                                  Non
                                              </label>
                                          </div>&nbsp&nbsp
                                          <div class="form-check">
                                            <input value="1" class="form-check-input" type="radio" value="<?=set_value('is_urgence_visa', $user['is_urgence_visa']) ?>" name="flexRadioDefault"  id="flexRadioDefault2oui"  <?=$checked; ?>>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                              Oui
                                            </label>
                                          </div></div>
                                          </div>
                                          </div>
                                        
                                     <!--  </div>

                                        <div class="row mb-4"> -->

                                            <div class="form-group col-md-6">
                                                <?php echo form_label('hidden label', '',['class'=>"label_field hidden"]); ?>
                                                <?php 
                                                $data = array(
                                                                'name'          => 'button',
                                                                'class'         => 'main_bt btn-sm',
                                                                'value'         => 'true',
                                                                'type'          => 'submit',
                                                                'content'       => 'Enregister'
                                                        );
                                                echo form_button($data); 
                                                ?>
                                            </div>                                    
                                            </div>
                                            <?php echo form_close();?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end row -->
                     </div>
                     <!-- footer -->
                     <div class="container-fluid">
                        <div class="row">
                           <div class="footer">
                               <p id="copyright">Copyright &copy; <script> document.write(new Date().getFullYear())</script> - Conçu et développé par <a href="mediabox.bi">Mediabox SA Burundi <img alt="Mediabox Logo" width="30px" src="<?base_url()?>assets/backend/images/mediabox_logo.png"></a></p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end dashboard inner -->
               </div>
             </div>
            </div>
         </div>
       

<script>
function get_communes()
    {
      var province_id=$('#province_id').val();
      //alert(province_id)
      if(province_id=='')
      {
        $('#commune_id').html('<option value="">---selectionner---</option>');
        $('#ZONE_ID').html('<option value="">---selectionner---</option>');
        $('#colline_id').html('<option value="">---selectionner---</option>');
      }
      else
      {
        $('#ZONE_ID').html('<option value="">---selectionner---</option>');
        $('#colline_id').html('<option value="">---selectionner---</option>');
        $.ajax(
        {
          url:"<?=base_url()?>matrice/Users/get_communes/"+province_id,
          type:"GET",
          dataType:"JSON",
          success: function(data)
          {
            $('#commune_id').html(data);
          }
        });

      }
    }

    function get_zones()
    {
      var commune_id=$('#commune_id').val();
      if(commune_id=='')
      {
        $('#ZONE_ID').html('<option value="">-</option>');
        $('#colline_id').html('<option value="">-</option>');
      }
      else
      {
        $('#colline_id').html('<option value="">-</option>');
        $.ajax(
        {
          url:"<?=base_url()?>matrice/Users/get_zones/"+commune_id,
          type:"GET",
          dataType:"JSON",
          success: function(data)
          {
            $('#ZONE_ID').html(data);
          }
        });

      }
    }

    function get_collines()
    {
      var ZONE_ID=$('#ZONE_ID').val();

      if(ZONE_ID=='')
      {
        $('#colline_id').html('<option value="">-</option>');
      }
      else
      {
        $.ajax(
        {
          url:"<?=base_url()?>matrice/Users/get_collines/"+ZONE_ID,
          type:"GET",
          dataType:"JSON",
          success: function(data)
          {
            $('#colline_id').html(data);
          }
        });

      }
    }
  </script>


  <script type="text/javascript">
  $(document).ready(function(){

   
   $('#div_compagnie').hide();

 });
</script>
  <script type="text/javascript">
    function test_compagnie(){
   //alert()
    var rol=$('#rol_id').val();

    if(rol==24){
      $('#div_compagnie').show();
    }else{
    $('#div_compagnie').hide();
    }

    }
  </script>

       
   