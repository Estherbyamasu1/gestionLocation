<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bibliotheque</title>
</head>
<body>
  <center>
   <?php 
   require "parties/header.php";
   ?> </center>
   <!-- Modal -->
   <div class="modal fade" id="comnpleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#007FFF;">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Nouveau abonné</h5><p id="erreur1" style="color:red;"></p>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formidentite">
            <div class="modal-body">

              <div class="form-group row col-md-12">
                <div class="form-group col-md-6">
                  <label for="completematricule" >Matricule</label>
                  <input type="text" class="form-control" id="completematricule" name="completematricule" placeholder="Entrer matricule">
                  <span id="errorMATRICULE" class="text-danger"></span>
                </div>

                <div class="form-group col-md-6">
                  <label for="completenom" >Nom</label>
                  <input type="text" class="form-control" id="completenom"name="completenom" placeholder="Entrer votre nom">
                  <span id="errorNOM" class="text-danger"></span>
                </div>
              </div>

              <div class="form-group row col-md-12">
                <div class="form-group col-md-6">
                  <label for="completeprenom" >Prenom</label>
                  <input type="text" class="form-control" id="completeprenom" name="completeprenom" placeholder="Entrer votre prenom">
                  <span id="errorPRENOM" class="text-danger"></span>
                </div>

                <div class="form-group col-md-6">
                  <label for="completegrade" >Genre</label>
                  <select class="form-select form-select-lg" name="completegenre" id="completegenre" >
                    <option valu="">Select</option>
                    <option>Masculin</option>
                    <option>Femin</option>
                  </select>
                  <span id="errorGENRE" class="text-danger"></span>
                </div>
              </div>

              <div class="form-group row col-md-12">
                <div class="form-group col-md-6">
                  <label for="completepromotion" >Categorie</label>
                  <select class="form-select form-select-lg "id="completecategorie" name="completecategorie">
                    <option value="">Select</option>
                    <?php foreach ($Categorie as $keycategorie) {
    // code...
                      ?>
                      <option value="<?=$keycategorie['ID_CATEGORIE']?>"><?=$keycategorie['CATEGORIE']?></option>
                    <?php }?>
                  </select>
                  <span id="errorCATEGORIE" class="text-danger"></span>
                </div>

                <div class="form-group col-md-6">
                  <br>
                  <label for="completepromotion" >Grade</label>
                  <select class="form-select form-select-lg "id="completegrade" name="completegrade">
                    <option value="">Select</option>
                    <?php foreach ($grade as $keygrade) {
    // code...
                      ?>
                      <option value="<?=$keygrade['ID_GRADE']?>"><?=$keygrade['GRADE']?></option>
                    <?php }?>
                  </select>
                  <span id="errorGRADE" class="text-danger"></span>

                </div>
              </div>

              <div class="form-group row col-md-12">
                <div class="form-group col-md-6">
                  <label for="completedate" >Faculte</label>
                  <select class="form-select form-select-lg "id="completefaculte" name="completefaculte">
                    <option value="">Select</option>
                    <?php foreach ($faculte as $keyfaculte) {
    // code...
                      ?>
                      <option value="<?=$keyfaculte['ID_FACULTE']?>"><?=$keyfaculte['FACULTE']?></option>
                    <?php }?>
                  </select>
                  <span id="errorFACULTE" class="text-danger"></span>
                </div>

                <div class="form-group col-md-6">
                 <label for="completefaculte" >Email</label>
                 <input type="text" name="completeemail" id="completeemail" class="form-control">
                 <span id="errorEMAIL" class="text-danger"></span>
               </div>
             </div>
             <div class="form-group row col-md-12">
              <div class="form-group col-md-6">
                <label for="completeemail" >Telephone</label>
                <input  name="completephone" type="text" class="form-control" id="completephone" placeholder="Entrer votre Telephone" name="completephone">
                <span id="errorPHONE" class="text-danger"></span>
              </div>
              <div class="form-group col-md-6">
                <label for="completephone" >Mot de passe</label>
                <input type="password" class="form-control" id="completepassword" name="completepassword" placeholder="Entrer votre Téléphone">
                <span id="errorPASSWORD" class="text-danger"></span>
              </div>

            </div>
            <div class="form-group col-md-12">
              <label for="completephone" >Photo de profil</label>
              <input type="file" class="form-control" id="completefile">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="addData()"><i class="fa fa-save"></i> Enregistrer</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

<!-- <h1 class="text-center bg-danger text-white" style="width:100%;">Enregistrement des abonnés</h1> -->
<button type="button" class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#comnpleteModal">
  <i class="fa fa-plus"></i>Ajouter un nouveau abonne
</button>


       <section style="float:right;">
        <div class="container">
          <div class="row">
            <div class="col-12">
     <center> <h4  class="bg-danger text-white">LISTE DES DES ACHETEURS INSCRITS</h4> </center>
      <table id="etudiant_table" class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">MATRICULE</th>
            <th scope="col">NOM</th>
            <th scope="col">PRENOM</th>
            <th scope="col">GENRE</th>
            <th scope="col">CATEGORIE</th>
            <th scope="col">GRADE</th>
            <th scope="col">FACULTE</th>
            <th scope="col">EMAIL</th>
            <th scope="col">TELEPHONE</th>
         <!--    <th scope="col">PASSWORD</th>
            <th scope="col">PHOTO</th> -->
            <th scope="col"><i class="fa-solid fa-option"></i>OPTIONS</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- <?php// include VIEWPATH.'includes/scripts_js.php';?>
 -->
</section>

<div  class="bg-primary">
  <?php  require "parties/footer.php"?>;
</div>
<script type="text/javascript">
  $('#message').delay('slow').fadeOut(3000);
</script>
<script>
  $(document).ready(function()
  {
    liste();
  });
  function liste()
  {

    var row_count ="1000000";

    table=$("#mytable").DataTable({
      "processing":true,
      "destroy" : true,
      "serverSide":true,
      "oreder":[[ 1, 'desc' ]],
      "ajax":
      {
        url:"<?=base_url()?>index.php/etudiant/Etudiants/listing/",
        type:"POST"
      },
      lengthMenu: [[10,50, 100, row_count], [10,50, 100, "All"]],
      pageLength: 10,
      "columnDefs":[{
        "targets":[],
        "orderable":false
      }],

      dom: 'Bfrtlip',
      buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
      ],
      language: {
        "sProcessing":     "Traitement en cours...",
        "sSearch":         "Rechercher&nbsp;:",
        "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
        "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
        "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        "sInfoPostFix":    "",
        "sLoadingRecords": "Chargement en cours...",
        "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
        "oPaginate": {
          "sFirst":      "Premier",
          "sPrevious":   "Pr&eacute;c&eacute;dent",
          "sNext":       "Suivant",
          "sLast":       "Dernier"
        },
        "oAria": {
          "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
          "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
        }
      }

    });
  }
</script>

</body>
</html>