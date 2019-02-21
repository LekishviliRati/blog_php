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

if(isset($_POST['sign_in_form']))
{
    $mail_connect = htmlspecialchars($_POST['mail_connect']);
    $pass_connect = sha1($_POST['pass_connect']);
    if(!empty($mail_connect) AND !empty($pass_connect))
    {
        $req_user = $db->prepare("SELECT * FROM user WHERE mail = ? AND password = ?");
        $req_user->execute(array($mail_connect, $pass_connect));
        $user_exist = $req_user->rowCount();
        if ($user_exist == 1)
        {
            $user_info = $req_user->fetch();
            $_SESSION['id'] = $user_info['id'];
            $_SESSION['pseudo'] = $user_info['pseudo'];
            $_SESSION['mail'] = $user_info['mail'];
            header("Location: profile.php");

        }
        else
        {
            $error = "Incorrect mail or Password";
        }
    }

    else
    {

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
