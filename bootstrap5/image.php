<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <title>Ajax Image Insert update Delete in mySQL Database using PHP</title>
     

    <script src="https:ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https:maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>




</head>
<body>
    <div class="container" style="width:100;">
    <h3 align="center">Ajax Image Insert Update Delete in Mysql Database using PHP</h3>
    <br/>
    <div align="right">
         <button type="button" name="add"id="add" class="btn-btn-success">Add</button>

    </div>
    <br/>
    <div id="image_data">

    </div>
</div>

</body>
</html>

<div id="imageModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
            <div class="modal-header">
                 <button type="button"class="close" data-dismis="modal">&times;</button>
                 <h4 class="modal-title">Add Image</h4>
            </div>
            <div class="modal-body">
              <form action="" id="image_form" method="post" enctype="multipart/form-data">
  <label for="completematricule" >Matricule</label>
  <input type="text" class="form-control" id="completematricule" placeholder="Entrer la matricule">
</div>

<div class="form-group">
  <label for="completenom" >Nom </label>
  <input type="text" class="form-control" id="completenom" placeholder="Entrer le nom">
</div>

<div class="form-group">
  <label for="completeprenom" >Prenom</label>
  <input type="text" class="form-control" id="completeprenom" placeholder="Entrer le prenom">
</div>

<div class="form-group">
  <label for="completegrade" >Grade</label>
  <input type="text" class="form-control" id="completegrade" placeholder="Entrer le grade">
</div>

<div class="form-group">
  <label for="completepromotion" >Promotion</label>
  <input type="text" class="form-control" id="completepromotion" placeholder="Entrer la promotion">
</div>

<div class="form-group">
  <label for="completedate" >Date</label>
  <input type="date" class="form-control" id="completedate" placeholder="Entrer la date">
</div>


<div class="form-group">
  <label for="completesexe" >Sexe</label>
  <input type="radio" class="form-control" id="completesexe" name="completesexe" value="Masculin" checked>
  <label for="">Masculin</label>
  <input type="radio" class="form-control" id="completesexe" name="completesexe" value="Feminim" checked>
  <label for="">Feminim</label>
</div>
<div class="form-group">
  <label for="completeemail" >Email</label>
  <input type="email" class="form-control" id="completeemail" placeholder="Entrer le mail">
</div>

<div class="form-group">
  <label for="completequartier" >Quartier</label>
  <input type="text" class="form-control" id="completequartier" placeholder="Entrer le quartier">
</div>
<div class="form-group">
  <label for="completetelephone" >Telephone</label>
  <input type="text" class="form-control" id="completephone" placeholder="Entrer telephone">
</div>
         
                <input type="file" name="image" id="image"/></p> <br/>
                <input type="hidden" name="action" id="action" value="Insert"/>
                <input type="hidden" name="image_id" id="image_id"/>
             
            </div>
            <div class="modal-footer">
                 <button type="submit" name="insert" id="insert" value="" class="btn btn-info">Enregistrer</button> -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

            </form>  
    </div>
</div>

<script>
    $(document).ready(function(){

       fetch_data();

       function fetch_data()
       {
        var action = "fetch";
        $.ajax({
            url:"action.php",
            method: "POST",
            data: {action:action},
            success:function(data)
            {
             $('#image_data').html(data);  
            }
        });
       } 
      $('#add').click(function(){
          $('#imageModal').modal('show');
          $('#image_form')[0].reset();
          $('.modal-title').text("Add Image");
          $('#image_id').val('');
         $('#action').val('insert');
        $('#insert').val("Insert");
      });
      $('#image_form').submit(function(event) {
          event.preventDefault();
          var image_name = $('#image').val();
          var completematricule = $('#completematricule').val();
          var completenom = $('#completenom').val();
          var completeprenom = $('#completeprenom').val();
          var completegrade = $('#completegrade').val();
          var completepromotion = $('#completepromotion').val();
          var completedate = $('#compledate').val();
          var completesexe = $('#completesexe').val();
          var completeemail = $('#completeemail').val();
          var completequartier = $('#completequartier').val();
          var completephone = $('#completephone').val();
          if(image_name == '' ||completenom =='' ||completeprenom =='' ||completegrade =='' ||completepromotion =='' ||completedate ==''
          ||completeemail =='' ||completephone =='' ||completequartier =='') {
               alert("Veuillez complete tous les champs");
               return false;
          }
          else
          {
             var extension = $('#image').val().split('.').pop().toLowerCase();
             if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
             {
                  alert("Invalide Image File");
                  $('#image').val('');
                  return false;
             }
             else
             {
                $.ajax({
                   url:"action.php",
                   method:"POST",
                   data: new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data)
                    {
                        alert(data);
                        fetch_data();
                        $('#image_form')[0].reset();
                        $('#imageModal').modal('hide');
                    }
                });
             }
          }
      });
    });
</script>