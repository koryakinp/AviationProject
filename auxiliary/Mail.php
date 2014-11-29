<?php

require 'auxiliary/class.phpmailer.php';

class Mail {

    static function sendActivationMail($to, $activation) {
        try {
            
            $xml = simplexml_load_file(dirname(__FILE__) . "/config.xml") or die("Error: Cannot create object");
            $address = $xml->email->address . '';
            $password = $xml->email->password . '';
            $appName = $xml->appName.'';

            $link = 'http://'.$_SERVER['HTTP_HOST'] . '/' . $appName . '/registration.php?activation=' . $activation;
            $body = '<html>'
                    . '<head>'
                    . '</head>'
                    . '<body>'
                    . '<div>'
                    . '<p>We need to make sure you are human.</p>'
                    . '<p>Please verify your email and get started using your Website account.</p>'
                    . '<br/>'
                    . '<a href="'.$link.'">link</a>'
                    . '</div>'
                    . '</body>'
                    . '</html>';
            
      

            $from = $address;
            $mail = new PHPMailer();          
            $mail->IsSMTP(true); // use SMTP
            $mail->IsHTML(true);
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Host = "smtp.gmail.com"; // SMTP host
            $mail->Port = 587; // set the SMTP port
            $mail->Username = $address; // SMTP username
            $mail->Password = $password; // SMTP password
            $mail->SetFrom($from, 'Registration Robot');
            $mail->AddReplyTo($from, 'Registration Robot');
            $mail->Subject = 'Confirmation of Registration';
            $mail->MsgHTML($body);
            $address = $to;
            $mail->AddAddress($address, $to);
            $mail->Send();
        } catch (Exception $ex) {
            $m = $ex->getMessage();
        }
    }

    static function sendContactMail($message) {
        $xml = simplexml_load_file(dirname(__FILE__) . "/config.xml") or die("Error: Cannot create object");
        $address = $xml->email->address . '';
        $password = $xml->email->password . '';
        $addressTo = $xml->messageEmail->email . '';
        $body = $message;
        $from = $address;
        $mail = new PHPMailer();
        $mail->IsSMTP(true); // use SMTP
        $mail->IsHTML(true);
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = "smtp.gmail.com"; // SMTP host
        $mail->Port = 587; // set the SMTP port
        $mail->Username = $address; // SMTP username
        $mail->Password = $password; // SMTP password
        $mail->SetFrom($from, 'Registration Robot');
        $mail->AddReplyTo($from, 'Registration Robot');
        $mail->Subject = 'User has Problem';
        $mail->MsgHTML($body);
        $mail->AddAddress($addressTo);
        $mail->Send();
    }

}

?>