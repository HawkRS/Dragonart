<?php
require_once ('doctype.php');
?>

<body>

    <?php
    require_once ('header.php');
    ?>

    <div class="container main-pubIndex">
        <div class="panel panel-default">
            <div class="panel-heading postHeader">
                <div class="row">
                    <h1 class="col-md-12">Subir imagen</h1>
                </div>
            </div>
            <div class="panel-body postDesc">
                <form id="subirImagen" class="form-horizontal col-xs-12 col-md-8 col-md-offset-2" enctype="multipart/form-data" action="javascript:alert( 'success!' );" method="post" novalidate>
                    <div id="div-imagen" class="form-group">
                        <label class="control-label" for="imagen">Seleccionar imagen: </label>
                        <div>
                            <input type="file" name="filename" id="imagen" accept="image/gif, image/jpeg, image/png image/jpg" onchange="readURL(this);">                        
                        </div>
                        <span id="err-imagen" class="help-inline text-danger hidden"></span>
                    </div>

                    <div class="form-group">
                        <div>
                            <img class="center-block" id="blah" src="#" alt="Imagen" width="250" height="250" />
                        </div>
                    </div>
					
					<div id="div-titulo" class="form-group">
                        <label class="control-label" for="titulo">Título: </label>
                        <div>
                            <input type="text" class="form-control" id="titulo" placeholder="Título" name="titulo" />
                        </div>
                        <span id="err-titulo" class="help-inline text-danger hidden"></span>
                    </div>

                    <div id="div-descripcion" class="form-group">
                        <label class="control-label" for="descripcion">Descripción: </label>
                        <div>
                            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                        </div>
                        <span id="err-descripcion" class="help-inline text-danger hidden"></span>
                    </div>

                    <div id="div-tags" class="form-group">
                        <label class="control-label" for="tags">Tags: </label>
                        <div>
                            <input type="text" class="form-control" id="tags" placeholder="Tags" name="tags" />
                        </div>
                        <span id="err-tags" class="help-inline text-danger hidden"></span>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-md-4 col-md-offset-4">
                            <button type="submit" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-upload"></span> Subir</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>  
</body>

<?php
require_once ('footer.php');
?>

<script>
    $('#subirImagen').on('submit',function(event){
        var inputs = $('#subirImagen input');
        var txtArea = $('#subirImagen textarea');
        var bandera = true;
        event.preventDefault();
		banderaInput = validarInputs(inputs);
        banderaTxt = validarTextArea(txtArea);
        if(banderaInput && banderaTxt){
            this.submit();
        }  
    });
</script>

</html>