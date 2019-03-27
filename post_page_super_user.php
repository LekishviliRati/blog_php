<?php
session_start();
$user_id = $_SESSION['id'];

if(isset($user_id)){

    //Connect to DB
    try {
        $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    // Get post
    if (is_numeric($_GET['post'])) {

        $posts = [];
        $req = $db->prepare('SELECT id, title, standfirst, content, update_date, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM post WHERE id = ?');
        $req->execute(array($_GET['post']));
        $Data = $req->fetch();
        if (is_array($Data)) {

            $posts[] = $Data;

        } else {
        echo "identifiant du post inexistant";
        }

    } else{
    echo "Valeur différent de entier";
    }

        $req->closeCursor(); // Free Fetch();

    // Get comments
    $comments = [];
    $req = $db->prepare('SELECT author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM comment WHERE post_id = ?');
    $req->execute(array($_GET['post']));
    while ($data = $req->fetch()) {

        $comments[] = $data;

    } // End of comments loop
    $req->closeCursor();

} else {
    echo "Access Denied ! ";
    ?>
    <a href="sign_in.php" > Log In !</a>
    <?php
}

require_once('view/post_page_super_user_view.php');