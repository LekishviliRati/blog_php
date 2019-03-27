<?php
session_start();
$user_id = $_SESSION['id'];

require('model/frontend.php');

if (isset($user_id)) {

    $db = dbConnect();

    if (isset($_POST['accept_comment']) AND $data['status'] == 0){
        $validate_comment = $db->prepare("UPDATE comment SET status = '1' WHERE id = ?");
        $validate_comment->execute([$_POST['comment_id']]);
    }else{
        echo "comment already published";
    }

    header("Location: comments_admin.php");

} else {
    echo "Access Denied ! "; ?>
    <a href="sign_in.php" > Log In !</a>
    <?php
}
?>


