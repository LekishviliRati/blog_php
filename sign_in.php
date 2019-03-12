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

// TEST PASSWORD HASH

$test = password_hash("toto", PASSWORD_DEFAULT);
var_dump($test);

$hash = "$2y$10$OM.ohKL7IrOa4/8pR6FzVOdHissVeF8q3g0Ruc4STD4oAsmnnwTWO";

var_dump(password_verify("toto", $hash));

// TEST PASSWORD HASH

if(isset($_POST['sign_in_form']))
{
    //$hash = '$2y$10$iE7AaTg7DHo.hx0UyvT4Kutvt1N4d/P6OoFR5/2ARqLQZSMXZTmxK';
    //         $2y$10$iE7AaTg7DHo.hx0UyvT4Kutvt1N4d/P6OoFR5/2ARqLQZSMXZTmxK
    $mail_connect = htmlspecialchars($_POST['mail_connect']);
    $pass_connect = htmlspecialchars($_POST['pass_connect']);
    //$pass_connect = sodium_crypto_pwhash_str_verify($_POST['pass_connect']);

    //$pass_connect = sha1($_POST['pass_connect']);

        if(!empty($mail_connect) AND !empty($pass_connect)) {
            $req_user = $db->prepare("SELECT * FROM user WHERE mail = ?");
            $req_user->execute(array($mail_connect));
            $user_exist = $req_user->rowCount();
            if ($user_exist == 1)
            {
                //$hash = $db->query("SELECT 'password' FROM user WHERE mail = $mail_connect");
                $req_hash = $db->quote("SELECT 'password' FROM user");
                $hash = $req_hash->fetch();
                echo"$hash['password']";

                var_dump($hash);

                $req_hash->closeCursor();
                if (password_verify($pass_connect, $hash)){
                    $user_info = $req_user->fetch();
                    $_SESSION['id'] = $user_info['id'];
                    $_SESSION['pseudo'] = $user_info['pseudo'];
                    $_SESSION['mail'] = $user_info['mail'];
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
?>

<html>
<head>
    <title> </title>
    <meta charset="utf-8">
</head>

<body>
<div align="center">
    <h2>Sign_in</h2>
    <br /><br />
    <form method="POST" action="">
        <table>
            <tr>
                <td align="right">
                    <label for="mail_connect">Mail to connect :</label>
                </td>
                <td>
                    <input type="text" name="mail_connect" placeholder="Mail..." />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="pass_connect">Password :</label>
                </td>
                <td>
                    <input type="password" name="pass_connect" placeholder="Password ..." />
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input type="submit" name="sign_in_form" value="Sign In" />
                </td>
            </tr>
            <tr>
                <td>
                <br />
                You are not registered yet ?
                </td>
                <td>
                <br />
                <a href="sign_up.php">Create Account</a>
                </td>
            </tr>
            <tr>
                <td>
                    <br />
                </td>
                <td>
                    <br />
                    <a href="forgot_password.php">Forgot your password ?</a>
                </td>
            </tr>
        </table>
    </form>
    <!--  Display error message  -->
    <?php
    if(isset($error))
    {
        echo '<font color="red">'.$error. "</font>";
    }
    ?>
</div>
</body>
</html>
