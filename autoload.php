<?php
function autoload($class)
{
    $file = $class . '.php';
    if (file_exists($file)) :
        require_once($class . '.php');
    else :
        require_once('Class/' . $class . '.php');
    endif;
}
spl_autoload_register('autoload');
