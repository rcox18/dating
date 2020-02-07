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
require ("model/validation-functions.php");

//instantiate fat-free
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//set arrays
$f3->set('states', array("AK","AL","AR","AZ","CA","CO","CT","DC","DE","FL","GA",
                         "GU","HI","IA","ID","IL","IN","KS","KY","LA","MA","MD",
                         "ME","MH","MI","MN","MO","MS","MT","NC","ND","NE","NH",
                         "NJ","NM","NV","NY","OH","OK","OR","PA","PR","PW","RI",
                         "SC","SD","TN","TX","UT","VA","VI","VT","WA","WI","WV",
                         "WY"));
$f3->set('indoor', array());
$f3->set('outdoor', array());

//define routes and set the session values
$f3->route("GET /", function (){
    $_SESSION["page"] = "Monster Finder";
    $view = new Template();
    echo $view->render("views/home.html");
});

// so I can open the site from the editor
$f3->route("GET /@item", function (
    $params){
    if ($params["item"] == "index.php") {
        $_SESSION["page"] = "Monster Finder";
        $view = new Template();
        echo $view->render("views/home.html");
    }
});

$f3->route("GET|POST /personal-form", function ($f3){
    $_SESSION["page"] = "Personal";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $isValid = true;

        $f3->set("firstName", $_POST["first-name"]);
        if (validName($_POST["first-name"])) {
            $_SESSION["firstName"] = $_POST["first-name"];
        } else {
            $f3->set("errors['fName']", "Please enter a valid name.");
            $isValid = false;
        }

        $f3->set("lastName", $_POST["last-name"]);
        if (validName($_POST["last-name"])) {
            $_SESSION["lastName"] = $_POST["last-name"];
        } else {
            $f3->set("errors['lName']", "Please enter a valid name.");
            $isValid = false;
        }

        $f3->set("age", $_POST["age"]);
        if (validAge($_POST["age"])) {
            $_SESSION["age"] = $_POST["age"];
        } else {
            $f3->set("errors['age']", "Must be 18-118 years old.");
            $isValid = false;
        }

        $f3->set("gender", $_POST["gender"]);
        if (isset($_POST["gender"])) {
            $_SESSION["gender"] = $_POST["gender"];
        }

        $f3->set("phone", $_POST["phone"]);
        if (validPhone($_POST["phone"])) {
            $_SESSION["phone"] = $_POST["phone"];
        } else {
            $f3->set("errors['phone']", "Please enter a valid phone number.");
            $isValid = false;
        }

        if ($isValid) {
            $f3->reroute('/profile-form');
        }
    }

    $view = new Template();
    echo $view->render("views/personal-form.php");
});

$f3->route("GET|POST /profile-form", function ($f3){
    $_SESSION["page"] = "Profile";
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $isValid = true;

        $f3->set("email",  $_POST["email"]);
        if (validEmail( $_POST["email"])) {
            $_SESSION["email"] = $_POST["email"];
        } else {
            $f3->set("errors['email']", "Please enter a valid email.");
            $isValid = false;
        }

        $f3->set("state", $_POST["state"]);
        if (in_array($_POST["state"], $f3->get("states"))) {
            $_SESSION["state"] = $_POST["state"];
        } else {
            $f3->set("errors['state']", "Something went wrong, try again.");
            $isValid = false;
        }

        $f3->set("seeking", $_POST["seeking"]);
        $_SESSION["seeking"] = $_POST["seeking"];
        $f3->set("bio", $_POST["bio"]);
        $_SESSION["bio"] = $_POST["bio"];

        if ($isValid) {
            $f3->reroute('/interests-form');
        }
    }

    $view = new Template();
    echo $view->render("views/profile-form.php");
});

$f3->route("GET|POST /interests-form", function (){

    $_SESSION["page"] = "Interests";
    $view = new Template();
    echo $view->render("views/interests-form.php");
});

$f3->route("POST /profile-summary", function () {
    $_SESSION["page"] = "Summary";
    $_SESSION["interests"] ="";
    if (!empty($_POST["indoor-interests"])) {
        $_SESSION["indoorInterests"] = $_POST["indoor-interests"];
        foreach ($_SESSION["indoorInterests"] AS $v) {
            $_SESSION["interests"] = $_SESSION["interests"] . " $v";
        }
    }

    if (!empty($_POST["outdoor-interests"])) {
        $_SESSION["outdoorInterests"] = $_POST["outdoor-interests"];
        foreach ($_SESSION["outdoorInterests"] AS $v) {
            $_SESSION["interests"] = $_SESSION["interests"] . " $v";
        }
    }
    $view = new Template();
    echo $view->render("views/profile-summary.php");
});

//run fat free
$f3->run();