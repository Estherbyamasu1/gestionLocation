<script>
  $(document).ready(function()
  {

     // var id_child=$('#id_child').val();
     // alert(id_child);

     $("input").change(function(){
      $(this).parent().parent().removeClass('has-error');
      $(this).next().empty();
    });
   })
 </script>

 <script>


  function show_modal_new_folder()
  {

    $('#folder_form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty(); 
    $('#new_folder_modal').modal('show');
    $('.modal-title').text('Nouveau dossier');

  }


  function show_modal_new_file()
  {

    $('#file_form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty(); 
    $('#new_file_modal').modal('show');
    $('.modal-title').text('Nouveau fichier');

  }

  // function new_folder()
  // {


  // }


  function new_folder()
  {

    $('#btnNew').html('Chargement....');
    $('#btnNew').attr("disabled",true);

    var url;
    url="<?php echo base_url('archive/Archivages_new/new_folder')?>";


    var formData = new FormData($('#folder_form')[0]);

    $.ajax({

      url:url,
      type:"POST",
      data:formData,
      contentType:false,
      processData:false,
      dataType:"JSON",
      success: function(data)
      {
       if(data.status) 
       {
        $('#new_folder_modal').modal('hide');
      // actualiser_table();
      window.location.reload();
    }
    else
    {
      for (var i = 0; i < data.inputerror.length; i++) 
      {
        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
      }
    }

    $('#btnNew').text('Enregistrer');
    $('#btnNew').attr('disabled',false); 


  },
  error: function (jqXHR, textStatus, errorThrown)
  {
    alert('Erreur s\'est produite');
    $('#btnNew').text('Enregistrer');
    $('#btnNew').attr('disabled',false);

  }


});



  }




  // window.start_load = function(){
  //   $('body').prepend('')
  // }

  // function refresh () {
  //   $.ajax({
  //     url: '<?php echo base_url('archive/Archivages_new/open_folder/')?>',
  //     success: function(data) {
  //       $('.torefreshdiv').html(data);
  //     }
  //   });
  // }



  function new_file()
  {

    $('#btnNew_File').html('Chargement....');
    $('#btnNew_File').attr("disabled",true);
    var url1;
    url1="<?php echo base_url('archive/Archivages_new/write_file')?>";
    var formData1 = new FormData($('#file_form')[0]);
    $.ajax({

      url:url1,
      type:"POST",
      data:formData1,
      contentType:false,
      processData:false,
      dataType:"JSON",
      success: function(data)
      {
       if(data.status) 
       {
        $('#new_file_modal').modal('hide');
      window.location.reload();
    }


    $('#btnNew_File').text('Enregistrer');
    $('#btnNew_File').attr('disabled',false); 


  },
  error: function (jqXHR, textStatus, errorThrown)
  {
    alert('Erreur s\'est produite');
    $('#btnNew_File').text('Enregistrer');
    $('#btnNew_File').attr('disabled',false);

  }


});



  }


</script>


<script>

  $(document).ready(function()
  {
      // document.getElementById('FOLDER_ID').value=id;
      var id=$('#PARENT_ID').val();
      document.getElementById('PARENT_ID').value=id;

    })

  function test(id)
  {

    location.href="<?=base_url('archive/Archivages_new/open_folder/')?>"+id;
    
  }
</script>

<!-- file upload -->
<script>
  function add_cart_file()
  {

    var file=new FormData();
    var NAME_FILE=$('#NAME_FILE').val();
    var FILE_PATH=$('#FILE_PATH')[0].files[0];
    var ID_PROJET=$('#ID_PROJET').val();
    file.append('FILE_PATH',FILE_PATH);
    file.append('NAME_FILE',NAME_FILE);
    file.append('ID_PROJET',ID_PROJET);

    if (NAME_FILE!="" && FILE_PATH!="" && ID_PROJET!="") 
    {
      $.ajax({
        url:"<?=base_url('archive/Archivages_new/add_cart_file')?>",
        data:file,
        type:'POST',
        contentType:false,
        processData:false,
        success:function(response)
        {
          if (response) 
          {
            $('#CART_FILE').html(response);
            CART_FILE.innerHTML=response;
            $('#SHOW_FOOTER').show();
            $('#NAME_FILE').val('');
            $('#FILE_PATH').val('');
            $('#NAME_FILE').css('border-color','#4169E1');
            $('#FILE_PATH').css('border-color','#4169E1');
          }else{
            $('#SHOW_FOOTER').hide();
          }

        }

      });
    }else{
      var valid=true;
      if(!$('#NAME_FILE').val())
      {
        $('#NAME_FILE').css('border-color','red');
        valid=false;
      }else{
        $('#NAME_FILE').css('border-color','#4169E1');
        valid=true;
      }

      if(!$('#FILE_PATH').val())
      {
        $('#FILE_PATH').css('border-color','red');
        valid=false;
      }else{
        $('#FILE_PATH').css('border-color','#4169E1');
        valid=true;
      }

      if(!$('#ID_PROJET').val())
      {
        $('#ID_PROJET').css('border-color','red');
        valid=false;
      }else{
        $('#ID_PROJET').css('border-color','#4169E1');
        valid=true;
      }

      return valid;
    }

    // if (NAME_FILE!="" && FILE_PATH!="" && ID_PROJET!="") 
    // {
    //   $.post('<?=base_url('archive/Archivages_new/add_cart_file')?>',
    //   {
    //     NAME_FILE:NAME_FILE,
    //     FILE_PATH:FILE_PATH,
    //     ID_PROJET:ID_PROJET
    //   },function(data)
    //   {

    //     if (data) 
    //     {
    //       $('#CART_FILE').html(data);
    //       CART_FILE.innerHTML=data;
    //       $('#SHOW_FOOTER').show();
          // $('#NAME_FILE').val('');
          // $('#FILE_PATH').val('');
          // $('#NAME_FILE').css('border-color','#4169E1');
          // $('#FILE_PATH').css('border-color','#4169E1');
    //     }else{
    //       $('#SHOW_FOOTER').hide();
    //     }

    //   })
    // }else{

      // var valid=true;
      // if(!$('#NAME_FILE').val())
      // {
      //   $('#NAME_FILE').css('border-color','red');
      //   valid=false;
      // }else{
      //   $('#NAME_FILE').css('border-color','#4169E1');
      //   valid=true;
      // }

      // if(!$('#FILE_PATH').val())
      // {
      //   $('#FILE_PATH').css('border-color','red');
      //   valid=false;
      // }else{
      //   $('#FILE_PATH').css('border-color','#4169E1');
      //   valid=true;
      // }

      // if(!$('#ID_PROJET').val())
      // {
      //   $('#ID_PROJET').css('border-color','red');
      //   valid=false;
      // }else{
      //   $('#ID_PROJET').css('border-color','#4169E1');
      //   valid=true;
      // }

      // return valid;
    // }
  }


  function remove_ct(id)
  {

    var rowid=$('#rowid'+id).val();
    $.post('<?=base_url('archive/Archivages_new/remove_ct')?>',
    {
      rowid:rowid
    },function(data)
    {
      if (data) 
      {
        CART_FILE.innerHTML=data;
        $('#CART_FILE').html(data);
        $('#SHOW_FOOTER').show();
      }
      else
      {
        $('#SHOW_FOOTER').hide();
      }
      

    })
  }
</script>
<!-- end -->





<div class="modal fade" data-backdrop="static" id="new_folder_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <form id="folder_form" method="POST">
            <input type="hidden" name="PARENT_ID" value="<?=$PARENT_ID?>" id="PARENT_ID">
            <div class="form-group">
              <label>Nouveau dossier</label>
              <input type="text" autofocus="" autocomplete="off" id="NAME_FOLDER" name="NAME_FOLDER" class="form-control">
              <span class="help-block"></span>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-danger" data-dismiss="modal">Fermer</button>
        <button type="button" id="btnNew" onclick="new_folder()" class="btn btn-primary">Enregistrer</button>
      </div>
    </div>
  </div>
</div>







<div class="modal fade" data-backdrop="static" id="new_file_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-12">
            <form id="file_form" method="POST">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                   <input type="hidden" name="PARENT_ID" value="<?=$PARENT_ID?>" id="PARENT_ID">
                   <input type="hidden" name="FILE_ID" id="FILE_ID">

                   <div class="form-group">
                    <label>Projet</label>
                    <select class="form-control" name="ID_PROJET" id="ID_PROJET">
                      <option value="">Sélectionner</option>
                      <?php
                      foreach ($projet as $key) 
                      {
                        echo "<option value=".$key['ID_PROJET'].">".$key['DESCRIPTION']."</option>";
                      }
                      ?>
                    </select>
                    <span class="help-block"></span>
                  </div>

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nom du fichier <span style="color: red">*</span></label>
                    <input type="text" autocomplete="off" name="NAME_FILE" id="NAME_FILE" class="form-control">

                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Document <span style="color: red">*</span></label>
                    <input type="file" autocomplete="off" name="FILE_PATH" id="FILE_PATH" class="form-control">
                  </div>
                </div>
                <div class="col-md-12">
                  <button type="button" style="float: right;clear: both;" onclick="add_cart_file()" class="btn btn-success"><span class="fa fa-plus"></span></button>
                </div>
              </div>
            </div>
          </form>

          <div class="col-md-12" id="CART_FILE">

          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer" id="SHOW_FOOTER" style="display: none;">
      <button type="button"  class="btn btn-danger" data-dismiss="modal">Fermer</button>
      <button type="button" id="btnNew_File" onclick="new_file()" class="btn btn-primary">Enregistrer</button>
    </div>
  </div>
</div>
</div>












