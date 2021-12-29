<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $nombre;
    public $email;
    public $token;

    public function __construct($nombre, $email, $token)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        // Crear el objeto de email
        $mail = new PHPMailer();

        // Configurar SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'd910a798db45e3';
        $mail->Password = '0909c36e7491be';
        $mail->SMTPSecure = 'tls';
        $mail->Port = '587';

        // Contenido del email
        $mail->setFrom('appsalon@correo.com', 'AppSalon');
        $mail->addAddress($this->email);
        $mail->Subject = 'Confirma tu cuenta';

        // Habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Haz creado tu cuenta en AppSalon, solo debes confirmarla presionando el siguiente enlace </p>";
        $contenido .= "<p>Presiona aquí: <a href='https://appsalon.julio-cervantes.com/auth/confirmar?token=" . $this->token . "'>Confirmar Cuenta </a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviamos el email
        $mail->send();
    }

    public function enviarInstrucciones() {
        // Crear el objeto de email
        $mail = new PHPMailer();

        // Configurar SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'd910a798db45e3';
        $mail->Password = '0909c36e7491be';
        $mail->SMTPSecure = 'tls';
        $mail->Port = '587';

        // Contenido del email
        $mail->setFrom('appsalon@correo.com', 'AppSalon');
        $mail->addAddress($this->email);
        $mail->Subject = 'Reestablece tu password';

        // Habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Haz solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo. </p>";
        $contenido .= "<p>Presiona aquí: <a href='https://appsalon.julio-cervantes.com/auth/recuperar?token=" . $this->token . "'> Reestablecer Password </a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviamos el email
        $mail->send();
    }
}