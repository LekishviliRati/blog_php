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

// Display last 5 posts
    $posts = [];
    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, user_id FROM post ORDER BY creation_date DESC LIMIT 0, 5');
    while ($data = $req->fetch(PDO::FETCH_ASSOC))
    {
        $posts[] = $data;
    } // End of the post loop
    $req->closeCursor();


require_once ('index_view.php');