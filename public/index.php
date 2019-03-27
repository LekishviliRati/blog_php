<?php

var_dump($_GET);

$url = '';
if(isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);
}

var_dump($url);

if($url == '') {
    require '../homepage.php';

}   elseif ($url[0] == 'sign_in.php') {
    require '../sign_in.php';
}

#require_once ('../homepage.php');