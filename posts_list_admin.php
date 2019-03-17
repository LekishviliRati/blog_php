<?php
session_start();
$user_id = $_SESSION['id'];
//Connect to DB
try {
    $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

if (isset($user_id)) {

//Get posts list
    $posts = [];
    $req = $db->prepare('SELECT id, title, content, standfirst,  DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM post WHERE user_id = ? ORDER BY creation_date ');
    $req->execute(array($user_id));
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

require_once ('posts_list_admin_view.php');


