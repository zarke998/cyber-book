<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/config.php";
    require_once ROOT."/dependencies/composer/vendor/autoload.php";
    use PHPMailer\PHPMailer\PHPMailer;

    function send_mail($to, $subject, $body, &$send_error = ""){
        $mailer = new PHPMailer();

        $mailer->isSMTP();
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPAuth = true;
        $mailer->Username = MAIL_USERNAME;
        $mailer->Password = MAIL_PASSWORD; //Google generated app password
        $mailer->SMTPSecure = 'ssl';
        $mailer->Port = 465;

        $mailer->setFrom('cyber.book123@gmail.com', 'CyberBook');
        $mailer->addReplyTo('cyber.book123@gmail.com', 'CyberBook');
        $mailer->addAddress($to); 

        $mailer->Subject = $subject;

        $mailer->isHTML(true);  
        $mailer->Body = $body;

        try{
            if($mailer->send())
                return true;
            else{
                $send_error = $mailer->ErrorInfo;
                return false;
            }
        }
        catch(Exception $e){
            $send_error = $e->getMessage();
            return false;
        }
    }
?>