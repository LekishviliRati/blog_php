<?php

//Connect to DB
try
{
    $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

if(isset($_POST['sign_up_form']))

{ //secure with variables
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);

    if(!empty($_POST['pseudo']) AND ($_POST['mail']) AND ($_POST['password']) AND ($_POST['password2']))
    {
        $pseudolenght = strlen($pseudo);
        if($pseudolenght <= 255 AND $pseudolenght > 2)
        {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL))
            {
                $reqmail = $db->prepare("SELECT * FROM user WHERE mail = ?");
                $reqmail->execute(array($mail));
                $mailexist = $reqmail->rowCount();
                if ($mailexist == 0)
                {
                    if($password == $password2)
                    {
                        //temporary with sha1, because can't use password_verify();
                        //$hash_password = sha1($_POST['password']);
                        //$hash_password2 = sha1($_POST['password2']);
                        //$insert_user = $db->prepare("INSERT INTO user(pseudo, mail, password, registration_date) VALUES(?, ?, ?, NOW())");
                        //$insert_user->execute(array($pseudo, $mail, $hash_password));
                        //$message ="Your account was succesfully registered <a href=\"sign_in.php\"> Log In<a/>";

                        // Need use of password_verify ();
                        $hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $hash_password2 = password_hash($_POST['password2'], PASSWORD_DEFAULT);
                        $insert_user = $db->prepare("INSERT INTO user(pseudo, mail, password, registration_date) VALUES(?, ?, ?, NOW())");
                        $insert_user->execute(array($pseudo, $mail, $hash_password));
                        $message ="Your account was succesfully registered <a href=\"sign_in.php\"> Log In<a/>";
                        // Need use of password_verify
                    }
                    else
                    {
                        $message = "Passwords are not similar";
                    }
                }
                else
                {
                    $message = "Email already registered";
                }
            }
            else
            {
                $message = "Email not valid !";
            }
        }
        else
        {
            $message = "max 255 minimum 2 characters for pseudo";
        }
    }
    else
    {
        $message = "Please complete all the required fields";
    }

}

require_once ('sign_up_view.php');