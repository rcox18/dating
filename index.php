<?php
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
session_start();

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

$datingController = new DatingController($f3);

//define routes and set the session values
$f3->route("GET /", function (){
    global $datingController;
    $datingController->home();
});

//personal form and validation
$f3->route("GET|POST /personal-form", function ($f3){
    global $datingController;
    $datingController->personalForm();
});

$f3->route("GET|POST /profile-form", function ($f3){
    global $datingController;
    $datingController->profileForm();
});

$f3->route("GET|POST /interests-form", function ($f3){
    global $datingController;
    $datingController->interestsForm();
});

$f3->route("GET|POST /profile-summary", function () {
    global $datingController;
    $datingController->profileSummary();
});

//run fat free
$f3->run();