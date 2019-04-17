<?php

/**
 * Identify the Controller name regarding the url
 *
 * @param $url
 * @return string
 */
function identifyController($url)
{
    if($url == '') {
        $name = 'homepage';

    }   elseif ($url [0]== 'articles') {

        $name = 'articles';

    }   elseif ($url [0]== 'signIn') {

        $name = 'signIn';

    }  elseif ($url [0]== 'contact') {

        $name = 'contact';

    } else {
        $name = 'homepage';
    }

    return $name;
}

