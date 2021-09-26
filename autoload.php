<?php
function autoload($class)
{
    try {
        $file = $class . '.php';

        if (file_exists($file)) :
            require_once($class . '.php');
        else :

            $file = 'Class/' . $class . '.php';

            if (file_exists($file)) :
                require_once($file);

            else :
                $file = '../Class/' . $class . '.php';
                if (file_exists($file)) :
                    require_once($file);
                endif;
            endif;

        endif;
    } catch (Exception $e) {
        echo  $e->getMessage();
    }
}
spl_autoload_register('autoload');
