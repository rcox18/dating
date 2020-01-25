<?php
session_start();
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

//define routes and set the session values
$f3->route("GET /", function (){
    $_SESSION["page"] = "Monster Finder";
    $view = new Template();
    echo $view->render("views/home.html");
});

$f3->route("GET /personal-form", function (){
    $_SESSION["page"] = "Personal";
    $view = new Template();
    echo $view->render("views/personal-form.php");
});

$f3->route("POST /profile-form", function (){
    $_SESSION["page"] = "Profile";
    $_SESSION["firstName"] = $_POST["first-name"];
    $_SESSION["lastName"] = $_POST["last-name"];
    $_SESSION["age"] = $_POST["age"];
    $_SESSION["gender"] = $_POST["gender"];
    $_SESSION["phone"] = $_POST["phone"];
    $view = new Template();
    echo $view->render("views/profile-form.php");
});

$f3->route("POST /interests-form", function (){
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["state"] = $_POST["state"];
    $_SESSION["seeking"] = $_POST["seeking"];
    $_SESSION["bio"] = $_POST["bio"];
    $_SESSION["page"] = "Interests";
    $view = new Template();
    echo $view->render("views/interests-form.php");
});

$f3->route("POST /profile-summary", function (){
    $_SESSION["indoorInterests"] = $_POST["indoor-interests"];
    $_SESSION["outdoorInterests"] = $_POST["outdoor-interests"];
    $_SESSION["interests"] ="";
    $_SESSION["page"] = "Summary";
    foreach ($_SESSION["indoorInterests"] AS $v) {
        $_SESSION["interests"] = $_SESSION["interests"]." $v";
    }
    foreach ($_SESSION["outdoorInterests"] AS $v) {
        $_SESSION["interests"] = $_SESSION["interests"]." $v";
    }
    $view = new Template();
    echo $view->render("views/profile-summary.php");
});
//run fat free
$f3->run();