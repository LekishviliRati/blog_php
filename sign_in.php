<?php
session_start();

//Connect to DB
try
{
    $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

// TEST PASSWORD HASH todo : PASSWORD HASH ////////////////////////////////////////////////////////////////////////

//$test = password_hash("toto", PASSWORD_DEFAULT);
//var_dump($test);

//$hash = "$2y$10$OM.ohKL7IrOa4/8pR6FzVOdHissVeF8q3g0Ruc4STD4oAsmnnwTWO";

//var_dump(password_verify("toto", $hash));


if(isset($_POST['sign_in_form']))
{
    //$hash = '$2y$10$iE7AaTg7DHo.hx0UyvT4Kutvt1N4d/P6OoFR5/2ARqLQZSMXZTmxK';//
    //         $2y$10$iE7AaTg7DHo.hx0UyvT4Kutvt1N4d/P6OoFR5/2ARqLQZSMXZTmxK//
    $mail_connect = htmlspecialchars($_POST['mail_connect']);
    $pass_connect = htmlspecialchars($_POST['pass_connect']);
    //$pass_connect = sodium_crypto_pwhash_str_verify($_POST['pass_connect']);//

    //$pass_connect = sha1($_POST['pass_connect']);//

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

/////////////////////////////////////////// TEST PASSWORD HASH /////////////////////////////////////////////////////

/*if(isset($_POST['sign_in_form']))
{
    $mail_connect = htmlspecialchars($_POST['mail_connect']);
    $pass_connect = sha1($_POST['pass_connect']);
    if(!empty($mail_connect) AND !empty($pass_connect))
    {
        $req_user = $db->prepare("SELECT * FROM user WHERE mail = ? AND password = ?");
        $req_user->execute(array($mail_connect, $pass_connect));
        *///$user_exist = $req_user->rowCount();
        //if ($user_exist == 1) {
            //$user_info = $req_user->fetch();
            //$_SESSION['id'] = $user_info['id'];
            //$_SESSION['pseudo'] = $user_info['pseudo'];
            //$_SESSION['mail'] = $user_info['mail'];
            //header("Location: profile.php");
            //if ($mail_connect == "super_user@gmail.com") {
              //  header("Location: super_user_profile.php");
          //  }
        //}
        //else
        //{
           // $error = "Incorrect mail or Password";
      //  }
    //}

    //else
    //{

  //  }
//}


require_once ('sign_in_view.php');
