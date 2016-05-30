<?php

class correoCtl{

    function __construct(){
        
    }

    function mandarCorreoContacto($nombre,$correo,$descripcion){
        require_once('datosGMAIL.inc');
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

        $correo->Username = $gmail;
        $correo->Password = $passG;

        $correo->SetFrom($gmail,$nombre);
        $correo->AddAddress($gmail, "DragonArt");

        $correo->Subject = "Contacto DragonArt";
        $correo->MsgHTML($contenido);

        if(!$correo->Send()) {
            return 'No se pudo enviar el correo: '.$correo->ErrorInfo;
        } else {
            return true;
        }
    }
    
    function mandarCorreoRecuperacion($nombre,$email,$link){
        require_once('datosGMAIL.inc');
        require_once('app/phpmailer/PHPMailerAutoload.php');
        $contenido = file_get_contents('app/vistas/correoRecuperacion.html');

        $diccionario = array(
            '%usuario%' => $nombre,
            '%correo%' => $email,
            '%link%' => $link
        );
        
        $contenido = strtr($contenido,$diccionario);

        $correo = new PHPMailer();
        $correo->IsSMTP();
        $correo->SMTPAuth = true;

        $correo->SMTPSecure = 'tls';
        $correo->Host = "smtp.gmail.com";
        $correo->Port = 587;

        $correo->Username = $gmail;
        $correo->Password = $passG;

        $correo->SetFrom($gmail,"DragonArt");
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
        require_once('datosGMAIL.inc');
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

        $correo->Username = $gmail;
        $correo->Password = $passG;

        $correo->SetFrom($gmail,"DragonArt");
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