<?php
    // Errors

    ini_set('display_errors', true);
    ini_set('display_startup_errors', true);
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_STRICT);

    // Basic Configs

    ob_start();
    session_name('38fcc75eb421ecc5aac0835d396dc28b');
    session_start();
    setlocale(LC_TIME, 'pt_BR.utf-8');
    date_default_timezone_set('America/Sao_Paulo');
    
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");

    header("Cache-Control: no-cache, must-revalidate");

    define('ENV', preg_match('/localhost|local.host|192\.168/', $_SERVER['SERVER_NAME']) != true ?: false);

    define('TYPE', 'mysql');
    define('HOST', ENV ? '' : 'localhost');
    define('DTBS', ENV ? '' : 'kabum');
    define('USER', ENV ? '' : 'root');
    define('PASS', ENV ? '' : '');

    define('DS', DIRECTORY_SEPARATOR);
    define('DIR_APP', __DIR__);
    define('DIR_PROJECT', 'kabum/server');

    if (file_exists('autoload.php')) {
        include 'autoload.php';
    } else {
        echo "Erro no settings.php";
        exit;
    }
