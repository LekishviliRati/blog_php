
<?php
// Connect to Data Base
try
{
    $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}


// Get post
$posts = [];
$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, user_id FROM post WHERE id = ?');
$req->execute(array($_GET['post']));
$Data = $req->fetch();

$posts[] = $Data;

$req->closeCursor();

// Get comments
$comments =[];
$req = $db->prepare('SELECT author, user_id, content, status, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM comment WHERE post_id = ? AND status = 1');
$req->execute(array($_GET['post']));
while ($data = $req->fetch()) {

    $comments[] = $data;

}

$req->closeCursor();

require_once ('comments_view.php');