<?php
/**
 * Created by PhpStorm.
 * User: lekishvili
 * Date: 2019-04-04
 * Time: 18:40
 */

function recupUrl()
{
    $url = '';
    if(isset($_GET['url'])) {
        $url = explode('/', $_GET['url']);
    }

    return $url;
}