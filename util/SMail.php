<?php

class SMail {

    private $mail;
    private static $instance = null;

    private function __construct() {
        require 'PHPMailer/PHPMailerAutoload.php';
        date_default_timezone_set('Etc/UTC');
        ignore_user_abort(true);
        $this->autoLoad();
    }

    static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    function sendMail($addressee, $subject, $messaje) {
        try {
            $this->mail->Username = "pruebasproyectos.u@gmail.com";
            $this->mail->Password = "pruebasu";

            $this->mail->setFrom('Pruebas', 'Pruebas');
            $this->mail->FromName = 'Soporte Tecnico';
            $this->mail->From = 'Soporte@Pruebas.com';

            $this->mail->Subject = $subject;

            $this->mail->Body = $messaje;
            $this->mail->AltBody = 'La academia informa...';

            $this->mail->addAddress($addressee);
            return $this->mail->send();
        } catch (Exception $exc) {
            return false;
        }
    }

    private function autoLoad() {
        try {
            $this->mail = new PHPMailer;
            $this->mail->isSMTP(); //Indicar que se usará SMTP
            $this->mail->CharSet = 'UTF-8'; //permitir envío de caracteres especiales (tildes y ñ)

            $this->mail->SMTPDebug = 0; //Mensajes de debug; 0 = no mostrar (en producción), 1 = de cliente, 2 = de cliente y servidor
            $this->mail->Debugoutput = 'html'; //Mostrar mensajes (resultados) de depuración(debug) en html

            $this->mail->Host = 'smtp.gmail.com'; //Nombre de host

            $this->mail->Port = 587; //Puerto SMTP, 587 para autenticado TLS
            $this->mail->SMTPSecure = 'tls'; //Sistema de encriptación - ssl (obsoleto) o tls
            $this->mail->SMTPAuth = true; //Usar autenticación SMTP
            $this->mail->SMTPOptions = array(
                'ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true)
            );
        } catch (Exception $exc) {
            return $exc;
        }
    }

}
