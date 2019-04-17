<?php
/**
 * Created by PhpStorm.
 * User: lekishvili
 * Date: 2019-04-04
 * Time: 18:04
 */

#include_once(dirname(__FILE__).'/../model/system_prenom.php');

function contact_controller()
{
    $systemPrenom = new SystemPrenom();
    $prenom = $systemPrenom->generatePrenom();

    require_once('../contact.php');
}