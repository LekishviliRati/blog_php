<?php
session_start();

require('model/frontend.php');

$db = dbConnect();

if(isset($_POST['sign_in_form']))
{
    $mail_connect = htmlspecialchars($_POST['mail_connect']);
    $pass_connect = htmlspecialchars($_POST['pass_connect']);

        if(!empty($mail_connect) AND !empty($pass_connect)) {
            $req_user = $db->prepare("SELECT * FROM user WHERE mail = ?");
            $req_user->execute(array($mail_connect));
            $return = $req_user->fetch(PDO::FETCH_ASSOC);
            $user_exist = $req_user->rowCount();
            if ($user_exist == 1) {
                $hash = $return['password'];

                if (password_verify($pass_connect, $hash)){
                    $_SESSION['id'] = $return['id'];
                    $_SESSION['pseudo'] = $return['pseudo'];
                    $_SESSION['mail'] = $return['mail'];
                    header("Location: profile.php");
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

require_once('view/sign_in_view.php');
