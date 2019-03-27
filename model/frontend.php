<?php

function dbConnect() {
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}

function getPost() {
    // Get post
    $db = dbConnect();
    $posts = [];
    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, user_id FROM post WHERE id = ?');
    $req->execute(array($_GET['post']));
    $Data = $req->fetch();

    $posts[] = $Data;

    return $posts;
    #$req->closeCursor();
}
