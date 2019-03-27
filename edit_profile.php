<?php
session_start();
$user_id = $_SESSION['id'];

require('model/frontend.php');

if (isset($user_id)){

    $db = dbConnect();

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
    if (isset($_POST['new_mail']) AND !empty($_POST['new_mail']) AND $_POST['new_mail'] != $user['mail']) {

        if(filter_var($new_mail, FILTER_VALIDATE_EMAIL)) {

            $reqmail = $db->prepare("SELECT * FROM user WHERE mail = ?");
            $reqmail->execute(array($new_mail));
            $mailexist = $reqmail->rowCount();

            if ($mailexist == 0) {
                $new_mail = htmlspecialchars($_POST['new_mail']);
                $insert_mail = $db->prepare("UPDATE user SET mail = ? WHERE id = ?");
                $insert_mail->execute(array($new_mail, $user_id));
                header('Location: profile.php?id='.$user_id);
            }
            else {
                $message = "Mail already registered";
            }
        }
        else {
            $message = "Mail not valid";
        }
    }

    // Update Password
    if (isset($_POST['new_password']) AND !empty($_POST['new_password']) AND ($_POST['new_password2']) AND !empty($_POST['new_password2']))
    {
        $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $password2 = password_hash($_POST['new_password2'], PASSWORD_DEFAULT);

        if ($password == $password2) {
            $insert_password = $db->prepare("UPDATE user SET password = ? WHERE id = ?");
            $insert_password->execute(array($password, $_SESSION['id']));
            header('Location: profile.php?id='.$_SESSION['id']);
        }

        else {
            $message = "Passwords not similar !";
        }

    }

    if (isset($_POST['new_pseudo']) AND $_POST['new_pseudo'] == $user['pseudo'])
    {
        header('Location: profile.php?id='.$_SESSION['id']);
    }


} else {
    echo "Access Denied ! ";
    ?>
    <a href="sign_in.php" > Log In !</a>
    <?php
}

require_once('view/edit_profile_view.php');


