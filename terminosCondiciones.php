<?php
require_once 'doctype.php';
?>

<body>

    <?php
    require_once 'header.php';
    ?>

    <div id="wrapper" class="main-otro">
        <aside id="sidebar-wrapper">

            <nav>
                <ul class="sidebar-nav">
                    <li class="sidebar-brand"><span>Opciones</span></li>
                    <li><a href="#punto1">Opcion 1</a></li>
                    <li><a href="#punto2">Opcion 2</a></li>
                    <li><a href="#punto3">Opcion 3</a></li>
                    <li><a href="#punto4">Opcion 4</a></li>
                    <li><a href="#punto5">Opcion 5</a></li>
                </ul>
            </nav>
        </aside>

        <section id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Términos y condiciones</h1>
                        <a href="#menu-toggle" class="btn btn-warning" id="menu-toggle"><i class="glyphicon glyphicon-chevron-left"></i></a>
                        <a href="#punto1"><h2>Punto 1</h2></a>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos ullam quidem velit fugiat distinctio inventore perspiciatis eaque sed repellat dolorem. Dolore rerum vitae laborum veniam corporis repellendus aliquam accusantium voluptates.
                        </p>
                        <a href="#punto2"><h2>Punto 2</h2></a>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos ullam quidem velit fugiat distinctio inventore perspiciatis eaque sed repellat dolorem. Dolore rerum vitae laborum veniam corporis repellendus aliquam accusantium voluptates.
                        </p>
                        <a href="#punto3"><h2>Punto 3</h2></a>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos ullam quidem velit fugiat distinctio inventore perspiciatis eaque sed repellat dolorem. Dolore rerum vitae laborum veniam corporis repellendus aliquam accusantium voluptates.
                        </p>
                        <a href="#punto4"><h2>Punto 4</h2></a>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos ullam quidem velit fugiat distinctio inventore perspiciatis eaque sed repellat dolorem. Dolore rerum vitae laborum veniam corporis repellendus aliquam accusantium voluptates.
                        </p>
                        <a href="#punto5"><h2>Punto 5</h2></a>
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