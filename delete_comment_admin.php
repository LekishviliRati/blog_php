<?php
session_start();
$user_id = $_SESSION['id'];
require('model/frontend.php');

if (isset($user_id)) {

    $db = dbConnect();

    if (isset($_POST['delete_comment'])){
        $delete_comment = $db->prepare("DELETE FROM comment WHERE id = ?");
        $delete_comment->execute(array($_POST['comment_id']));
    }

    header("Location: comments_admin.php");


} else {
    echo "Access Denied ! "; ?>
    <a href="sign_in.php" > Log In !</a>
    <?php
}
?>


