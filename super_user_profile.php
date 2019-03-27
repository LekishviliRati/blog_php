<?php
session_start();
$user_id = $_SESSION['id'];

require('model/frontend.php');

if (isset($user_id)) {

    $db = dbConnect();

    // > Secure ID entered by converting it into number (and not letters e.g.)
    $get_id = intval($user_id);
    $req_user = $db->prepare('SELECT * FROM user WHERE id=?');
    $req_user->execute(array($get_id));
    $user_info = $req_user->fetch();

    // calculate total of posts
    $total_posts = $db->query("SELECT * FROM post");
    $number_of_posts = $total_posts->rowCount();

    // calculate total of users
    $total_users = $db->query("SELECT * FROM user");
    $number_of_users = $total_users->rowCount();

    // calculate total of comments
    $total_comments = $db->query("SELECT * FROM comment");
    $number_of_comments = $total_comments->rowCount();

}else {
    echo "Access Denied ! ";
    ?>
    <a href="sign_in.php" > Log In !</a>
    <?php
}

require_once('view/super_user_profile_view.php');