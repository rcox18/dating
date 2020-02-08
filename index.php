<?php
session_start();
/**
 *  An index controller page for rcox.greenriverdev.com/IT328/dating.
 *
 * @author     Robert Cox
 * @version    2.0.0
 * @link       http://rcox.greenriverdev.com/IT328/dating
 * @since      2/7 /2020
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

//set arrays for sticky and validation
$f3->set('genders', array('female'=>'Female', 'male'=>'Male', 'other'=>'Other'));
$f3->set('states', array("AK","AL","AR","AZ","CA","CO","CT","DC","DE","FL","GA",
                         "GU","HI","IA","ID","IL","IN","KS","KY","LA","MA","MD",
                         "ME","MH","MI","MN","MO","MS","MT","NC","ND","NE","NH",
                         "NJ","NM","NV","NY","OH","OK","OR","PA","PR","PW","RI",
                         "SC","SD","TN","TX","UT","VA","VI","VT","WA","WI","WV",
                         "WY"));
$f3->set('indoor', array("tv"=>"TV", "movies"=>"Movies", "cooking"=>"Cooking",
                         "board-games"=>"Board games", "puzzles"=>"Puzzles",
                         "reading"=>"Reading", "playing-cards"=>"Playing cards",
                         "video-games"=>"Video games"));
$f3->set('outdoor', array("hiking"=>"Hiking", "biking"=>"Biking",
                          "swimming"=>"Swimming", "collecting"=>"Collecting",
                          "walking"=>"Walking", "climbing"=>"Climbing",
                          "chasing"=>"Chasing", "stalking"=>"Stalking"));
$f3->set("indoorInterests",  array());
$f3->set("outdoorInterests",  array());

//define routes and set the session values
$f3->route("GET /", function (){
    $_SESSION["page"] = "Monster Finder";
    $view = new Template();
    echo $view->render("views/home.html");
});

// so I can open the site from the editor
$f3->route("GET /@item", function ($params){
    if ($params["item"] == "index.php") {
        $_SESSION["page"] = "Monster Finder";
        $view = new Template();
        echo $view->render("views/home.html");
    }
});

//personal form and validation
$f3->route("GET|POST /personal-form", function ($f3){
    $_SESSION["page"] = "Personal";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $isValid = true;

        $f3->set("firstName", $_POST["first-name"]);
        if (validName($_POST["first-name"])) {
            $_SESSION["firstName"] = $_POST["first-name"];
        } else {
            $f3->set("errors['fName']", "Please enter a name.");
            $isValid = false;
        }

        $f3->set("lastName", $_POST["last-name"]);
        if (validName($_POST["last-name"])) {
            $_SESSION["lastName"] = $_POST["last-name"];
        } else {
            $f3->set("errors['lName']", "Please enter a name.");
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
        if (isset($_POST["gender"]) AND
            in_array($_POST["gender"], array_keys($f3->get("genders")))) {
            $_SESSION["gender"] = $_POST["gender"];
        } else if (isset($_POST["gender"]) AND
            !in_array($_POST["gender"], array_keys($f3->get("genders")))) {
            $f3->set("errors['gender']", "Please enter a valid gender.");
            $isValid = false;
        }

        $f3->set("phone", $_POST["phone"]);
        if (validPhone($_POST["phone"])) {
            $_SESSION["phone"] = $_POST["phone"];
        } else {
            $f3->set("errors['phone']", "Please enter a phone number.");
            $isValid = false;
        }

        //all inputs valid, go to next page
        if ($isValid) {
            $f3->reroute('/profile-form');
        }
    }

    //not rerouted so stay on page
    $view = new Template();
    echo $view->render("views/personal-form.php");
});

$f3->route("GET|POST /profile-form", function ($f3){
    $_SESSION["page"] = "Profile";
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $isValid = true;

        $f3->set("email", $_POST["email"]);
        if (validEmail( $_POST["email"])) {
            $_SESSION["email"] = $_POST["email"];
        } else {
            $f3->set("errors['email']", "Please enter an email.");
            $isValid = false;
        }

        $f3->set("state", $_POST["state"]);
        if (in_array($_POST["state"], $f3->get("states")) OR
            $_POST["state"]==="none") {
            $_SESSION["state"] = $_POST["state"];
        } else {
            $f3->set("errors['state']", "Are you sure?");
            $isValid = false;
        }

        $f3->set("seeking", $_POST["seeking"]);
        if (isset($_POST["seeking"]) AND
            in_array($_POST["seeking"], array_keys($f3->get("genders")))) {
            $_SESSION["seeking"] = $_POST["seeking"];
        } else if (isset($_POST["seeking"]) AND
            !in_array($_POST["seeking"], array_keys($f3->get("genders")))) {
            $f3->set("errors['seeking']", "Is that a gender?");
            $isValid = false;
        }

        $f3->set("bio", $_POST["bio"]);
        if (isset($_POST["bio"]) ) {
            $_SESSION["bio"] = $_POST["bio"];
        }

        if ($isValid) {
            $f3->reroute('/interests-form');
        }
    }

    $view = new Template();
    echo $view->render("views/profile-form.php");
});

$f3->route("GET|POST /interests-form", function ($f3){
    $_SESSION["page"] = "Interests";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $isValid = true;

        $f3->set("indoorInterests",  $_POST["indoor-interests"]);
        $f3->set("outdoorInterests",  $_POST["outdoor-interests"]);
        $_SESSION["interests"] ="";

        if(isset($_POST["indoor-interests"])) {

            if (!validIndoor($_POST["indoor-interests"])) {
                $f3->set("errors['indoor']", "Hmmm...Phishy!");
                $isValid = false;
            }


            if ($isValid AND !empty($_POST["indoor-interests"])) {
                $_SESSION["indoorInterests"] = $_POST["indoor-interests"];
                foreach ($_SESSION["indoorInterests"] AS $v) {
                    $_SESSION["interests"] =
                        $_SESSION["interests"]." ".$f3->get("indoor[$v]");
                }
            }
        }

        if(isset($_POST["outdoor-interests"])) {

            if (!validOutdoor($_POST["outdoor-interests"])) {
                $f3->set("errors['outdoor']", "Hmmm...Phishy!");
                $isValid = false;
            }


            if ($isValid AND !empty($_POST["outdoor-interests"])) {
                $_SESSION["outdoorInterests"] = $_POST["outdoor-interests"];
                foreach ($_SESSION["outdoorInterests"] AS $v) {
                    $_SESSION["interests"] =
                        $_SESSION["interests"]." ".$f3->get("outdoor[$v]");
                }
            }
        }

        if ($isValid) {
            $f3->reroute('/profile-summary');
        }
    }

    $view = new Template();
    echo $view->render("views/interests-form.php");
});

$f3->route("GET|POST /profile-summary", function () {
    $_SESSION["page"] = "Summary";

    $view = new Template();
    echo $view->render("views/profile-summary.php");
});

//run fat free
$f3->run();