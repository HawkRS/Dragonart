<?php
include ('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subir imagen</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
       <form class="form-horizontal" enctype="multipart/form-data">
         
          <div class="form-group">
               <label for="imagen" class="control-label col-md-2">Seleccionar imagen: </label>
               <div class="col-md-10">
                   <input type="file" class="form-control" id="imagen"  />
               </div>
           </div>
           
           <div class="form-group">
               <label for="descripcion" class="control-label col-md-2">Descripción: </label>
               <div class="col-md-10">
                   <input type="text" class="form-control" id="descripcion" placeholder="Descripción de la imagen" />
               </div>
           </div>
           
           <div class="form-group">
               <label for="tags" class="control-label col-md-2">Tags: </label>
               <div class="col-md-10">
                   <input type="text" class="form-control" id="tags" placeholder="Tags" />
               </div>
           </div>
           
           <div class="form-group">
               <div class="col-md-2 col-md-offset-2">
                   <button class="btn btn-primary">Subir</button>
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