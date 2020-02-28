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
session_start();

$datingController = new DatingController();

//define routes for the site
$datingController->getF3()->route("GET /", function (){
    global $datingController;
    $datingController->home();
});

//personal form
$datingController->getF3()->route("GET|POST /personal-form", function () {
    global $datingController;
    $datingController->personalForm();
});

//profile form
$datingController->getF3()->route("GET|POST /profile-form", function () {
    global $datingController;
    $datingController->profileForm();
});

//interests form
$datingController->getF3()->route("GET|POST /interests-form", function () {
    global $datingController;
    $datingController->interestsForm();
});

//profile image upload form
$datingController->getF3()->route("GET|POST /profile-image", function () {
    global $datingController;
    $datingController->profileImage();
});

//profile page
$datingController->getF3()->route("GET|POST /profile-summary", function () {
    global $datingController;
    $datingController->profileSummary();
});

//admin (members table) page
$datingController->getF3()->route("GET|POST /admin", function () {
    global $datingController;
    $datingController->admin();
});

//show the clicked member
$datingController->getF3()->route("GET|POST /@item",
    function ($datingController, $params) {
    global $datingController;
    $datingController->showMember($params["item"]);
});

//run fat free
$datingController->getF3()->run();