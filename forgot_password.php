<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

require('model/frontend.php');
$db = dbConnect();

if (isset($_GET['section'])) {
    $section = htmlspecialchars($_GET['section']);
} else {
    $section = "";
}

// FORM submit : retrieve_mail

if(isset($_POST['retrieve_submit'],$_POST['retrieve_mail'])) {
    if (!empty($_POST['retrieve_mail'])){
        $retrieve_mail = htmlspecialchars($_POST['retrieve_mail']);
        if (filter_var($retrieve_mail,FILTER_VALIDATE_EMAIL)) {
             $mail_exist = $db->prepare("SELECT id, pseudo FROM user WHERE mail = ?");
             $mail_exist->execute(array($retrieve_mail));
             $mail_exist_count = $mail_exist->rowCount();
             if ($mail_exist_count == 1) {
                 $pseudo = $mail_exist->fetch();
                 $pseudo = $pseudo['pseudo'];

                 $_SESSION['retrieve_mail'] = $retrieve_mail;
                 $retrieve_code ="";
                 for ($i=0; $i < 8; $i++) {
                    $retrieve_code .=mt_rand(0,9);
                 }


                 $mail_retrieve_exist = $db->prepare("SELECT id FROM retrieval WHERE mail = ?");
                 $mail_retrieve_exist->execute(array($retrieve_mail));
                 $mail_retrieve_exist = $mail_retrieve_exist->rowCount();

                 //if code already exist, just update code
                 if ($mail_retrieve_exist == 1){
                     $retrieve_insert = $db->prepare("UPDATE retrieval SET code = ? WHERE mail = ?");
                     $retrieve_insert->execute(array($retrieve_code, $retrieve_mail));

                 //if code do not exist, insert code
                 } else{
                     $retrieve_insert = $db->prepare("INSERT INTO retrieval(mail, code) VALUES (?,?)");
                     $retrieve_insert->execute(array($retrieve_mail,$retrieve_code));
                 }

                 // -- MAIL --//

                 $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                 try {
                     //Server settings
                     $mail->SMTPDebug = 1;                                 // Enable verbose debug output
                     $mail->isSMTP();                                      // Set mailer to use SMTP
                     $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                     $mail->SMTPAuth = true;                               // Enable SMTP authentication
                     $mail->Username = 'lotusq328@gmail.com';                 // SMTP username
                     $mail->Password = 'tgauSc_513';                           // SMTP password
                     $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                     $mail->Port = 587;                                    // TCP port to connect to

                     //Recipients
                     $mail->setFrom('lotusq328@gmail.com', 'Mailer');
                     $mail->addAddress('lotusq328@gmail.com');     // Add a recipient
                     //$mail->addReplyTo('info@example.com', 'Information');
                     //$mail->addCC('cc@example.com');
                     //$mail->addBCC('bcc@example.com');

                     //Attachments, to send PDF with mail for example
                     //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                     //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                     $body = "<p> Hello <b>".$pseudo."</b> Here you have the code to reset your password : <b>".$retrieve_code."</b> <br /></p> ";

                     //Content
                     $mail->isHTML(true);                                  // Set email format to HTML
                     $mail->Subject = 'Retrieve password';
                     $mail->Body    = $body;
                     $mail->AltBody = strip_tags($body); // will send 1 with HTML and 1 without HTML

                     $mail->send($retrieve_mail);
                     echo 'Message has been sent';
                 } catch (Exception $e) {
                     echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                 }
                    header('Location:http://localhost:8888/blogphp/forgot_password.php?section=code');

                 // -- MAIL -- //

             }else{
                 $message = "Mail do not exist, sure you submit correct one ?";
             }
        }else {
            $message = "mail not valide";
        }

    }else {
        $message = "Please enter your mail";
    }

}


// FORM submit : check_submit
if (isset($_POST['check_submit'],$_POST['check_code'])){
    if (!empty($_POST['check_code'])) {
        $check_code = htmlspecialchars($_POST['check_code']);
        $check_req = $db->prepare("SELECT id FROM retrieval WHERE mail = ? AND code = ?");
        $check_req->execute(array($_SESSION['retrieve_mail'],$check_code));
        $check_req = $check_req->rowCount();
        if ($check_req == 1) {
            $up_req = $db->prepare("UPDATE retrieval SET confirm = 1 WHERE mail = ?");
            $up_req->execute(array($_SESSION['retrieve_mail']));
            header('Location:http://localhost:8888/blogphp/forgot_password.php?section=changepassword');
        }else {
            $message = "Code not valid";
        }
    }else{
        $message = "Please enter your code to reset you received by mail";
    }
}


// FORM submit : change_password_submit
if (isset($_POST['change_password_submit'])) {
    if (isset($_POST['change_password'], $_POST['change_password_confirmation'])) {
        $check_confirm = $db->prepare("SELECT confirm FROM retrieval WHERE mail = ?");
        $check_confirm->execute(array($_SESSION['retrieve_mail']));
        $check_confirm = $check_confirm->fetch();
        $check_confirm = $check_confirm['confirm'];
        if ($check_confirm == 1) {


            $psw = htmlspecialchars($_POST['change_password']);
            $pswc = htmlspecialchars($_POST['change_password_confirmation']);
            if (!empty($psw) AND !empty($pswc)) {
                if ($psw == $pswc) {
                    $psw = password_hash($psw, PASSWORD_DEFAULT);
                    $ins_psw = $db->prepare("UPDATE user SET password = ? WHERE mail = ?");
                    if ($ins_psw->execute(array($psw, $_SESSION['retrieve_mail']))) {
                        $del_req = $db->prepare('DELETE FROM retrieval WHERE mail = ?');
                        $del_req->execute(array($_SESSION['retrieve_mail']));
                        $message ="You have a new password ! you can connect now. Clic on Back to Sign In" ;
                    } else {
                        $message = "req invalid";
                    }
                } else {
                    $message = "Passwords are not similar";
                }
            } else {
                $message = "Please complete required fields";
            }
        } else {
            $message = "Please confirm your mail with confirmation code you received by mail";
        }
    } else {
        $message = "Please complete required fields";

    }
}

    require_once('view/forgot_password_view.php');