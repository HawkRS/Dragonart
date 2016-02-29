<?php
include ('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
       <form class="form-horizontal">
         
          <div class="form-group">
               <label for="correo" class="control-label col-md-2">Correo: </label>
               <div class="col-md-10">
                   <input type="email" class="form-control" id="correo" placeholder="Correo" />
               </div>
           </div>
           
           <div class="form-group">
               <label for="password" class="control-label col-md-2">Contraseña: </label>
               <div class="col-md-10">
                   <input type="password" class="form-control" id="password" placeholder="Contreseña" />
               </div>
           </div>
           
           <div class="form-group">
               <div class="col-md-2 col-md-offset-2">
                   <button class="btn btn-primary">Iniciar sesión</button>
               </div>
           </div>
       </form>
    </div>    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>


<?php
include ('footer.php');
?>