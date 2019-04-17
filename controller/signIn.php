<?php
session_start();

/**
 * Created by PhpStorm.
 * User: lekishvili
 * Date: 2019-04-10
 * Time: 22:57
 */

function signIn_controller() {

    $db = dbConnect();

    if(isset($_POST['sign_in_form']))
    {
        $mail_connect = htmlspecialchars($_POST['mail_connect']);
        $pass_connect = htmlspecialchars($_POST['pass_connect']);

        if(!empty($mail_connect) AND !empty($pass_connect)) {
            $return = getUserByMail($mail_connect, $db);

            if (is_array($return)) {
                $hash = $return['password'];

                if (password_verify($pass_connect, $hash)){
                    $_SESSION['id'] = $return['id'];
                    $_SESSION['pseudo'] = $return['pseudo'];
                    $_SESSION['mail'] = $return['mail'];
                    header("Location: ../profile.php");
                    if ($mail_connect == "super_user@gmail.com"){
                        header("Location: super_user_profile.php");
                    }
                }else {
                    $error ="Incorrect password";
                }
            }
            else
            {
                $error = "Incorrect mail";
            }
        }

        else
        {
            $error = "please complete fields";
        }
    }

    require_once('../view/sign_in_view.php');

}