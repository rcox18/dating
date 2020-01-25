<?php
/**
 *  An index controller page for rcox.greenriverdev.com/IT328/dating.
 *
 * @author     Robert Cox
 * @version    1.0.0
 * @link       http://rcox.greenriverdev.com/IT328/dating
 * @since      1/19/2020
 */

// error reporting turned on
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

$f3->route("GET /personal-form", function (){
    $view = new Template();
    echo $view->render("views/personal-form.php");
});

$f3->route("POST /profile-form", function (){
    $view = new Template();
    echo $view->render("views/profile-form.php");
});

$f3->route("POST /interests-form", function (){
    $view = new Template();
    echo $view->render("views/interests-form.php");
});
//run fat free
$f3->run();