<?php
session_start();
$user_id = $_SESSION['id'];

// check with 'id'if user is connected or not.
if (isset($user_id)){

    //Connect to DB
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

   //
    $req_user = $db->prepare("SELECT * FROM user WHERE id=?");
    $req_user->execute(array($user_id));
    $user = $req_user->fetch();

    // Update pseudo
    if (isset($_POST['new_pseudo']) AND !empty($_POST['new_pseudo']) AND $_POST['new_pseudo'] != $user['pseudo'])
    {
        $new_pseudo = htmlspecialchars($_POST['new_pseudo']);
        $insert_pseudo = $db->prepare("UPDATE user SET pseudo = ? WHERE id = ?");
        $insert_pseudo->execute(array($new_pseudo, $user_id));
        header('Location: profile.php?id='.$user_id);
    }

    // Update mail (!! Todo : Insert EMAIL if not exist yet !!)
    if (isset($_POST['new_mail']) AND !empty($_POST['new_mail']) AND $_POST['new_mail'] != $user['mail'])
    {
        if(filter_var($new_mail, FILTER_VALIDATE_EMAIL))
        {
            $reqmail = $db->prepare("SELECT * FROM user WHERE mail = ?");
            $reqmail->execute(array($new_mail));
            $mailexist = $reqmail->rowCount();
            if ($mailexist == 0)
            {
                $new_mail = htmlspecialchars($_POST['new_mail']);
                $insert_mail = $db->prepare("UPDATE user SET mail = ? WHERE id = ?");
                $insert_mail->execute(array($new_mail, $user_id));
                header('Location: profile.php?id='.$user_id);
            }
            else
            {
                $message = "Mail already registered";
            }
        }
        else
        {
            $message = "Mail not valid";
        }
    }

    // Update Password
    if (isset($_POST['new_password']) AND !empty($_POST['new_password']) AND ($_POST['new_password2']) AND !empty($_POST['new_password2']))
    {
        $password = sha1($_POST['new_password']);
        $password2 = sha1($_POST['new_password2']);

        if ($password == $password2)
        {
            $insert_password = $db->prepare("UPDATE user SET password = ? WHERE id = ?");
            $insert_password->execute(array($password, $_SESSION['id']));
            header('Location: profile.php?id='.$_SESSION['id']);
        }

        else
        {
            $message = "Passwords not similar !";
        }

    }

    if (isset($_POST['new_pseudo']) AND $_POST['new_pseudo'] == $user['pseudo'])
    {
        header('Location: profile.php?id='.$_SESSION['id']);
    }

?>

    <html>
    <head>
        <title> </title>
        <meta charset="utf-8">
    </head>

    <body>
    <div align="center">
        <h2>Edit my profile</h2>
        <form method="POST" action="">
            <table> <br />
                <tr>
                    <td align="right">
                        <label for="pseudo" >Pseudo :</label>
                        <input type="text" name="new_pseudo" id="pseudo" placeholder="Pseudo" value="<?= $user['pseudo']?>"/><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail" >Mail :</label>
                        <input type="text" name="new_mail" id="mail" placeholder="Mail" value="<?= $user['mail']?>"/><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="password" >New password :</label>
                        <input type="password" name="new_password" id="password" placeholder="Password" /><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="password2" >Confirm new password :</label>
                        <input type="password" name="new_password2" id="password2" placeholder="Confirm Passwword" /><br /><br />
                    </td>
                </tr>
                <tr>
                    <td align="right"><br />
                        <input type="submit" value="Update my profile">
                    </td>
                </tr>
            </table>
        </form>
        <?php if(isset($message)){echo $message;} ?>
    </div>
    </body>
    </html>

    <?php // mask all content of the page to visitors because it's dedicated to connected users
} else {
    echo "Access Denied ! ";
    ?>
    <a href="sign_in.php" > Log In !</a>
    <?php
}
?>


