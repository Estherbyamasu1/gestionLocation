<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <button  onclick="show_modal_new_folder()" class="btn btn-primary"><a style="color: white;"><span class="fa fa-folder"></span> Nouveau dossier</a></button>

    <!-- <input type="text" name="" value="<?=$FOLDER_ID?>"> -->
    <?php
    if ($PARENT_ID!=0) {?>

      <button onclick="show_modal_new_file()"  class="btn btn-primary"><span class="fa fa-download"></span> Nouveau fichier</button>
      
      <?php 
    }
    ?>
    
  </div>


  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)"><?=$title?></a></li>
      <li class="breadcrumb-item active"><a href="javascript:void(0)"></a></li>
    </ol>
  </div>
</div>