<?php

function executeController($name)
{
    #$name_to_execute = $name . '_controller';
    #$name_to_execute();

    call_user_func($name.'_controller');
}