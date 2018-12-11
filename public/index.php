<?php

/**
 * MINI - an extremely simple naked PHP application
 *
 * @package mini
 * @author Panique
 * @link http://www.php-mini.com
 * @link https://github.com/panique/mini/
 * @license http://opensource.org/licenses/MIT MIT License
 */

/**
 * Now MINI work with namespaces + composer's autoloader (PSR-4)
 *
 * @author Joao Vitor Dias <joaodias@noctus.org>
 *
 * For more info about namespaces plase @see http://php.net/manual/en/language.namespaces.importing.php
 */
date_default_timezone_set('America/Bogota');

//Inicializar las sesiones
session_start();

// set a constant that holds the project's folder path, like "/var/www/".
// DIRECTORY_SEPARATOR adds a slash to the end of the path
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// set a constant that holds the project's "application" folder, like "/var/www/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

define('PUBLIC_FOLDER', ROOT . 'public' . DIRECTORY_SEPARATOR);

define('UPLOADS_FOLDER', PUBLIC_FOLDER . 'uploads' . DIRECTORY_SEPARATOR);

define('APP_NAME', 'Variedades y Comunicaciones');
define('MAIL_DRIVER', 'smtp');
define('MAIL_HOST', 'smtp.googlemail.com');
define('MAIL_PORT', '465');
define('MAIL_USERNAME', 'phpminitest@gmail.com');
define('MAIL_PASSWORD', 'sena2018.');
define('MAIL_ENCRYPTION', 'ssl');

define('VENDEDOR', 'VENDEDOR');
define('ADMINISTRADOR', 'ADMINISTRADOR');
define('ROLES', array(VENDEDOR, ADMINISTRADOR));

// This is the auto-loader for Composer-dependencies (to load tools into your project).
require ROOT . 'vendor/autoload.php';

// load application config (error reporting etc.)
require APP . 'config/config.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    'driver' => DB_TYPE,
    'host' => DB_HOST,
    'database' => DB_NAME,
    'username' => DB_USER,
    'password' => DB_PASS,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->bootEloquent();

// load application class
use Mini\Core\Application;

// start the application
$app = new Application();
