<?php
session_start();
$user_id = $_SESSION['id'];

if (isset($user_id)) {

//Connect to DB
    try {
        $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    //todo : Validate comment, switch status 0 to 1 (...stand by..)
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


