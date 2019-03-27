<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit_comment'])){
//Load Composer's autoloader
    require 'vendor/autoload.php';
    require('model/frontend.php');

    $db = dbConnect();

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

        $body = "<p> Your received a new comment </p>";

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'New Comment !';
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body); // will send 1 with HTML and 1 without HTML

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}



// ADD COMMENT TO DATABASE
$req = $db->prepare('INSERT INTO comment(author, user_id, content, post_id, creation_date) VALUES(?, ?, ?, ?, NOW())');
$req->execute(array($_POST['author'], $_POST['user_id'], $_POST['content'], $_POST['post_id']));

// Visitor redirection to comments
header('Location: article_page.php?post='.$_POST['post_id']);
