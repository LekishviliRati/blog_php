<?php
session_start();
$user_id = $_SESSION['id'];

require('model/frontend.php');

$db = dbConnect();

    $get_id = intval($user_id);
    $req_user = $db->prepare('SELECT * FROM user WHERE id=?');
    $req_user->execute(array($get_id));
    $user_info = $req_user->fetch();


require_once('view/profile_view.php');