<?php

require "backend.php"; #for function dbConnect

function getArticles()
{
    $db = dbConnect();
    // Display last 5 posts
    $posts = [];
    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, user_id FROM post ORDER BY creation_date DESC LIMIT 0, 5');
    while ($data = $req->fetch(PDO::FETCH_ASSOC))
    {
        $posts[] = $data;
    }
    return $posts;
}