<?php
session_start();
$user_id = $_SESSION['id'];

require('model/frontend.php');


if (isset($user_id) == 14) {

    $db = dbConnect();
    //Get users
    $posts = [];
    $req = $db->query('SELECT id, pseudo, mail, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%imin%ss\') AS registration_date_fr FROM user ORDER BY registration_date DESC ');
    while ($data = $req->fetch()) {

       $posts[] = $data;

    }
    $req->closeCursor();
 // mask all content of the page to visitors because it's dedicated to connected users
} else {
    echo "Access Denied ! "; ?>
    <a href="sign_in.php" > Log In !</a>
    <?php
}

require_once('view/users_super_user_view.php');


