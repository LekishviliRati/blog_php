<?php
session_start();
$user_id = $_SESSION['id'];

if (isset($user_id) == 14) {

//Connect to DB
    try {
        $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }


    if (isset($_POST['delete_comment'])){
        $delete_comment = $db->prepare("DELETE FROM comment WHERE id = ?");
        $delete_comment->execute(array($_POST['comment_id']));
    }

    header("Location: comments_super_user.php");


} else {
    echo "Access Denied ! "; ?>
    <a href="sign_in.php" > Log In !</a>
    <?php
}
?>


