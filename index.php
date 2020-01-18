<?php
/*
 * @author     Robert Cox
 * @version    1.0.0
 * @link       http://rcox.greenriverdev.com/IT328/chicken
 * @since      1/15/2020
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

//require autoload.php
require ("vendor/autoload.php");

//instantiate fat-free
$f3 = Base::instance();

//define default route
$f3->route("GET /", function (){
    $view = new Template();
    echo $view->render("views/home.html");
});

//run fat free
$f3->run();