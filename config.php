<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 01.05.2020
     * Time: 18:46
     */
    define('DS',"/");
    $sitePath = realpath(dirname(__FILE__) . DS) . DS;
    define ('SITE_PATH', $sitePath); // путь к корневой папке сайта

    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'custommvc');