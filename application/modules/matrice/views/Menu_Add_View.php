
<link rel="stylesheet" href="<?=base_url()?>assets/backend/css/choices.min.css">
<script src="<?=base_url()?>assets/backend/js/choices.min.js"></script>









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
      <div class="col-lg-6">
        <div class="heading1 mt-4 ml-5">
          <h2><?=$title; ?></h2>
        </div>
      </div>

      <div class="col-lg-6">

        <ul class="nav nav-pills nav-fill justify-content-around rounded shadow m-4">
          <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['insert'])) echo 'active';?>"  href="<?=base_url('matrice/Menu/insert/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
          <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('matrice/Menu/')?>"><i class="fa fa-list"></i>Liste</a></li>
        </ul>
      </div>
    </div>


    <div class="full price_table padding_infor_info">

      <div class="row">
        <div class="col-lg-12">
          <div class="table">
          <?= $this->session->flashdata('message');?>
          

          <form method="POST" action="<?php echo base_url('matrice/Menu/add')?>" class="form-horizontal">
            <div class="row">
              <div class="col-md-6" >
                <label>Menu</label>
                <input type="text" name="MENU" class="form-control">
                <?php echo form_error('MENU', '<div class="text-danger">', '</div>'); ?>
                <?php
                    if ($this->session->has_userdata('dash')) {
                      echo '<div class="' . $this->session->dash['class'] . '" role="alert">' . $this->session->dash['message'] . '</div>';
                    }
                    ?>

              </div>
              <div class="col-md-6" >
                <label>Module</label>
                <select name="ID_MODULE" id="ID_MODULE" onchange="get_profil();get_categorie()" class="form-control">

                  <option value="">Sélectionner</option>
                  <?php
                  foreach ($mod as $value)
                  {
                    ?>
                    <option value="<?=$value['ID_MODULE']?>"><?=$value['DESCRIPTION']?></option>
                    <?php
                  }
                  ?>
                </select>
                <?php echo form_error('ID_MODULE', '<div class="text-danger">', '</div>'); ?>
              </div>
              
              
            </div>
            <div class="row">


              <div class="col-md-6">
                

                <div id="divmultiple"></div>              

               <?php echo form_error('profil[]', '<div class="text-danger">', '</div>'); ?>
             </div>


            <div class="col-md-6" id="div_categ">
              
                
            </div>

          </div><br>
          <div class="row">
              <div class="col-md-6">
               <h7>Ce Menu a un sous-menu?</h7>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
                <!-- <div class="form-check"> -->
                  <input value="0" class="form-check-input" type="radio" id="flexRadioDefault1non" name="flexRadioDefault" onChange="view()">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Non
                    </label>
                <!-- </div> -->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <!-- <div class="form-check"> -->
                  <input value="1" class="form-check-input" type="radio" name="flexRadioDefault" onChange="view()" id="flexRadioDefault2oui" checked>
                  <label class="form-check-label" for="flexRadioDefault2">
                    OUI
                  </label>
                <!-- </div> -->
              </div>

              <div class="col-md-6" id="url-menu" style="display: none;" >
                <label>Url</label>
                <input type="text" name="controlleur" class="form-control">
                <?php echo form_error('controlleur', '<div class="text-danger">', '</div>'); ?> 
              </div>
            
          </div>

          
          <div style="padding-top: 10px;">

            <button type="submit" class="btn btn-dark" style="float:right;" >Enregistrer</button>
          </div>


        </form>



        </div>
      </div>
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
  $(document).ready(function(){
    
     var multipleCancelButton = new Choices('#PROFIL_ID', {
        removeItemButton: true

      }); 
     
     
  });
</script>

<script type="text/javascript">
  $('#message').delay('slow').fadeOut(3000);
</script>

<script>  
  function view() {    
    if(document.getElementById('flexRadioDefault1non').checked) {   

      document.getElementById('url-menu').style.display = "block";     
    } 
    if(document.getElementById('flexRadioDefault2oui').checked) {   

      document.getElementById('url-menu').style.display = "none";     
    }   

  }   
</script>  


<script>
  function get_profil()
  {
    var ID_MODULE=$('#ID_MODULE').val();
    //alert(ID_MODULE)
    $.ajax({
      url: "<?php echo base_url('matrice/Menu/get_profil/');?>"+ID_MODULE,
      type: "POST",
      data: {},
      processData: false,  
      contentType: false,
      success: function(data){
        
        $('#divmultiple').html(data);
      }
    });
  }
</script> 

<!-- recupérer les categorie de visa -->
<script>
  function get_categorie()
  {
    var ID_MODULE=$('#ID_MODULE').val();
    
    if (ID_MODULE == 9 || ID_MODULE == 8) 
    {
      $.ajax({
        url: "<?php echo base_url('matrice/Menu/get_categorie/');?>"+ID_MODULE,
        type: "POST",
        data: {},
        processData: false,  
        contentType: false,
        success: function(data){
          
          $('#div_categ').html(data);
        }
      });
    }
    
  }
</script> 

