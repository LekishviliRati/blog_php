<?php
session_start();
$user_id = $_SESSION['id'];

require('model/frontend.php');

if (isset($user_id)) {

    $db = dbConnect();

//Get posts list
    $posts = [];
    $req = $db->prepare('SELECT id, title, content, standfirst,  DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM post WHERE user_id = ? ORDER BY creation_date desc ');
    $req->execute(array($user_id));
    while ($data = $req->fetch()) {
    $posts[] = $data;

    }
    $req->closeCursor();

} else {
    echo "Access Denied ! "; ?>
<a href="sign_in.php" > Log In !</a>
<?php
}

require_once('view/posts_list_admin_view.php');


