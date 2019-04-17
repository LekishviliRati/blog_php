<?php
/**
 * Created by PhpStorm.
 * User: lekishvili
 * Date: 2019-04-10
 * Time: 23:27
 */

function getPost() {
    // Get post
    $db = dbConnect();
    $posts = [];
    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, user_id FROM post WHERE id = ?');
    $req->execute(array($_GET['post']));
    $Data = $req->fetch();

    $posts[] = $Data;

    return $posts;

}