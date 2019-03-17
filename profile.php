<?php
session_start();
$user_id = $_SESSION['id'];

//Connect to DB
try {
    $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

    $get_id = intval($user_id); // > Secure ID entered by converting it into number (and not letters e.g.)
    $req_user = $db->prepare('SELECT * FROM user WHERE id=?');
    $req_user->execute(array($get_id));
    $user_info = $req_user->fetch();


require_once ('profile_view.php');