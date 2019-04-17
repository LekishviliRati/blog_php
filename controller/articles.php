<?php

include(dirname(__FILE__).'/../model/dbConnect.php');
#include_once(dirname(__FILE__).'/../model/system_prenom.php');
include(dirname(__FILE__).'/../model/articles.php');

function articles_controller() {

    #$posts = getArticles(dbConnect());

    $posts = getArticles();

    require_once('../view/articles_view.php');
}