<?php

class correoCtl{

    function __construct(){

    }

    function mandarCorreoContacto($nombre,$correo,$descripcion){
        require_once('app/phpmailer/PHPMailerAutoload.php');
        $contenido = file_get_contents('app/vistas/correoContacto.html');

        $diccionario = array(
            '%usuario%' => $nombre,
            '%correo%' => $correo,
            '%descripcion%' => $descripcion
        );
        
        $contenido = strtr($contenido,$diccionario);

        $correo = new PHPMailer();
        $correo->IsSMTP();
        $correo->SMTPAuth = true;

        $correo->SMTPSecure = 'tls';
        $correo->Host = "smtp.gmail.com";
        $correo->Port = 587;

        $correo->Username = "dragonart.dd@gmail.com";
        $correo->Password = "20962123";

        $correo->SetFrom($correo,$nombre);
        $correo->AddAddress("dragonart.dd@gmail.com", "DragonArt");

        $correo->Subject = "Contacto DragonArt";
        $correo->MsgHTML($contenido);

        if(!$correo->Send()) {
            echo "Hubo un error: " . $correo->ErrorInfo;
        } else {
            echo "Mensaje enviado con exito.";
        }
    }
}
?>