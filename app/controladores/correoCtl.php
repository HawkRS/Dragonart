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
    
    function mandarCorreoRecuperacion($nombre,$email,$pass){
        require_once('app/phpmailer/PHPMailerAutoload.php');
        $contenido = file_get_contents('app/vistas/correoRecuperacion.html');

        $diccionario = array(
            '%usuario%' => $nombre,
            '%correo%' => $email,
            '%link%' => "dragonart.silverdragon.xyz/index.php?controlador=sesion&accion=recuperarcontrasena&w=$pass"
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

        $correo->SetFrom("dragonart.dd@gmail.com","DragonArt");
        $correo->AddAddress($email,$nombre);
        $correo->Subject = "Recuperar contraseña de tu cuenta DragonArt";
        $correo->MsgHTML($contenido);

        if(!$correo->Send()) {
            return 'No se pudo enviar el correo: '.$correo->ErrorInfo;
        } else {
            return true;
        }
    }
    
    function mandarCorreoConfirmacion($nombre,$email){
        require_once('app/phpmailer/PHPMailerAutoload.php');
        $contenido = file_get_contents('app/vistas/correoConfirmacion.html');

        $diccionario = array(
            '%usuario%' => $nombre,
            '%correo%' => $email
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

        $correo->SetFrom("dragonart.dd@gmail.com","DragonArt");
        $correo->AddAddress($email,$nombre);
        $correo->Subject = "Se restableció la contraseña de tu cuenta DragonArt";
        $correo->MsgHTML($contenido);

        if(!$correo->Send()) {
            return false;
        } else {
            return true;
        }
    }
}
?>