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

?>

<html>
    <head>
        <title> </title>
        <meta charset="utf-8">
    </head>

    <body>
        <div align="center">
            <h2>Sign_up</h2>
            <br /><br />
            <form method="POST" action="">
                <table>
                    <tr>
                        <td align="right">
                            <label for="pseudo">Pseudo :</label>
                        </td>
                        <td>
                            <input type="text" placeholder="My pseudo ..." id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="mail">Mail :</label>
                        </td>
                        <td>
                            <input type="email" placeholder="example@mail.com" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="password">Password :</label>
                        </td>
                        <td>
                            <input type="password" placeholder="My password ..." id="password" name="password" />
                        </td>
                    </tr>

                    <tr>
                        <td align="right">
                            <label for="password2">Password confirmation :</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Confirmation ..." id="password2" name="password2" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <br />
                            <input type="submit" name="sign_up_form" value="Submit">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br />
                            Already registered ?
                        </td>
                        <td>
                            <br />
                            <a href="sign_in.php">Sign In</a>
                        </td>
                    </tr>
                </table>
            </form>

            <!--  Display error message  -->
            <?php
            if(isset($message))
            {
                echo '<font color="red">'.$message. "</font>";
            }
            ?>
        </div>
    </body>
</html>