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

// Insert message with prepared request
$req = $db->prepare('INSERT INTO comment (author, content) VALUES(?, ?)');
$req->execute(array($_POST['author'], $_POST['content']));

// Visitor redirection to comments
header('Location: comments.php');
?>