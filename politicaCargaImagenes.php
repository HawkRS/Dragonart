<?php
require_once 'doctype.php';
?>

<body>

    <?php
    require_once 'header.php';
    ?>

    <div id="wrapper" class="main-otro">
        <section id="page-content-wrapper">
            <div class="container-fluid">
                <div class="col-md-10">
                    <h1>Política de carga de imágenes</h1>
                    <h2>Punto 1</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos ullam quidem velit fugiat distinctio inventore perspiciatis eaque sed repellat dolorem. Dolore rerum vitae laborum veniam corporis repellendus aliquam accusantium voluptates.
                    </p>
                    <h2>Punto 2</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos ullam quidem velit fugiat distinctio inventore perspiciatis eaque sed repellat dolorem. Dolore rerum vitae laborum veniam corporis repellendus aliquam accusantium voluptates.
                    </p>
                    <h2>Punto 3</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos ullam quidem velit fugiat distinctio inventore perspiciatis eaque sed repellat dolorem. Dolore rerum vitae laborum veniam corporis repellendus aliquam accusantium voluptates.
                    </p>
                    <h2>Punto 4</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos ullam quidem velit fugiat distinctio inventore perspiciatis eaque sed repellat dolorem. Dolore rerum vitae laborum veniam corporis repellendus aliquam accusantium voluptates.
                    </p>
                    <h2>Punto 5</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos ullam quidem velit fugiat distinctio inventore perspiciatis eaque sed repellat dolorem. Dolore rerum vitae laborum veniam corporis repellendus aliquam accusantium voluptates.
                    </p>
                </div>
            </div>
            </div>
        </section>
    </div>
</body>

<?php
require_once 'footer.php';
?>

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</html>