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
              <div class="welcome-text col-lg-6">
                <h4 style='color:#007bac'>Enregistrement des utilisateurs</h4>
               </div>
              <div class="col-lg-6">

                <ul class="nav nav-pills nav-fill justify-content-around rounded shadow m-4">
                  <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['insert'])) echo 'active';?>"  href="<?=base_url('user/Users/Add/')?>"><i class="fa fa-pencil-square-o"></i>Nouveau</a></li>
                  <li class="nav-item"><a class="nav-link <?php if(in_array($this->router->method,['index'])) echo 'active';?>" href="<?=base_url('user/Users/')?>"><i class="fa fa-list"></i>Liste</a></li>
                </ul>
              </div>
              
            </div>

            <div class="row">

             
             <div class="col-lg-6">
               <label>Nom</label>
               <input type="text" class="form-control" name="nom" id="nom">
             </div>

             <div class="col-lg-6">
               <label>Prenom</label>
                <input type="text" class="form-control" name="nom" id="nom">
             </div>

             <div class="col-lg-6">
               <label>Telephone</label>
                <input type="text" class="form-control" name="telephone" id="telephone">
             </div>

             <div class="col-lg-6">
               <label>Email</label>
                <input type="email" class="form-control" name="email" id="email">
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
