<?php
/**
 * Created by PhpStorm.
 * User: lekishvili
 * Date: 2019-04-09
 * Time: 21:07
 */

namespace config;

class Autoloader
{
    static function register() {
        spl_autoload_register(array('__CLASS__', 'autoload'));
    }
}