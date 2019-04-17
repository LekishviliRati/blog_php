<?php

/*spl_autoload_register('example');

function example($classname)
{
    require "../model/" . $classname . ".php";
}

$toto = new SystemPrenom();
$couou = new Coucou();

die();*/

require "../controller/homePage.php";
require "../controller/contact.php";
require "../controller/articles.php";
require "../controller/signIn.php";


require "../services/url/url.php";
require "../services/router/router.php";
require "../services/execute_controller/execute_controller.php";



$url = recupUrl();
$controller_name = identifyController($url);
executeController($controller_name);
