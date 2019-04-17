<?php

function getUserByMail($mail, $db)
{
    $req_user = $db->prepare("SELECT * FROM user WHERE mail = ?");
    $req_user->execute(array($mail));
    return $req_user->fetch(PDO::FETCH_ASSOC);
}
