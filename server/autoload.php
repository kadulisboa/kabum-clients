<?php

/**
 * Autoload de Class
 * @param $classes
 */
function autoload($classes)
{
    $dirBase = DIR_APP . DS;
    $classes = $dirBase . 'Classes' . DS . str_replace('\\', DS, $classes) . '.php';
    if (file_exists($classes) && !is_dir($classes)) {
        include $classes;
    }
}

spl_autoload_register('autoload');
