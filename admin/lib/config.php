<?php
    $rf = str_replace('www.', '', $_SERVER["SERVER_NAME"]);
    $config['database']['refix'] = "db_";
    $config['database']['servername'] = 'localhost';
    $config['database']['username'] = 'root';
    $config['database']['password'] = '';
    $config['database']['database'] = 'db_safe';

    define("URLPATH","http://".$_SERVER["SERVER_NAME"]."/safe/");
    define("urladmin","http://".$_SERVER["SERVER_NAME"]."/safe/admin/");

?>