<?php

require_once "D:/apps/xampp/php/PEAR/Mail.php";

function sendMail($to, $subject, $body) {
    $from = "Dont Get Kicked <dontgetkicked@sapo.pt>";
    //$to = "<fabiocatalao@gmail.com>";
    //$subject = "Olá!";
    //$body = "Hi,\n\nHow are you?";

    $host = "ssl://smtp.sapo.pt";
    $port = "465";
    $username = "dontgetkicked@sapo.pt";
    $password = "dontgetkicked123";

    $headers = array('From' => $from, 'To' => $to, 'Subject' => $subject);
    $smtp = Mail::factory('smtp', array('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));

    $mail = $smtp->send($to, $headers, $body);

    if (PEAR::isError($mail)) {
        echo("<p>" . $mail->getMessage() . "</p>");
    } else {
        //echo("<p>Message successfully sent!</p>");
    }
}

?>