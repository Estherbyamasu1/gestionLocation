<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dropdowns</title>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
    </script>
    <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
    </script>
</head>
<body style="text-align:center;" >
    <div class="container">
        <div class="dropdown">
            <button type="button"
                class="btn btn-success dropdown-toggle "
                data-toggle="dropdown">
            </span> Select CS Subjects
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">
                    Data Structure
                  </a>
                <a class="dropdown-item" href="#">
                    Algorithm
                  </a>
                <a class="dropdown-item" href="#">
                    Operating System
                  </a>
                <a class="dropdown-item" href="#">
                    Computer Networks
                  </a>
            </div> <br>
             <div style="margin-top:10px;">
            <a type="button" href="<?php echo base_url('index.php/Login_Controller/Se_conncter')?>" style="text-decoration: none;" class="btn-success"><i class="fa-sharp fa-solid fa-right-to-bracket"></i>Se connecter</a>
            </div>
                 <div style="margin-top:10px;">
              <a type="button" href="<?php echo base_url('index.php/Acheteur_Controller/list')?>" style="text-decoration: none;" class="btn-success"><i class="fa-sharp fa-solid fa-right-to-bracket"></i><i class="fa-solid fa-list"></i>Liste</a>
            </div>
        </div>
    </div>
</body>
</html>