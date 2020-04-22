<?php


namespace Alcatraz\Utils;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    static function email($assunto, $msg, $destino, $nomeDestino,$nomeRemetente = MAIL_NAME, $remetente = MAIL_USER){
        $mail = new PHPMailer();

        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = MAIL_HOST;
        $mail->Username = MAIL_USER;
        $mail->Password = MAIL_PASS;
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";
        $mail->From = $remetente; //remetente
        $mail->FromName = utf8_decode($nomeRemetente); //remetente nome
        $mail->AddReplyTo($remetente, utf8_decode($nomeRemetente));
        $mail->IsHTML(true);

        $mail->Subject = utf8_decode($assunto); //assunto
        $mail->Body = utf8_decode($msg); //mensagem
        $mail->AddAddress($destino, utf8_decode($nomeDestino)); //email e nome destino

        return $mail->Send();
    }

}