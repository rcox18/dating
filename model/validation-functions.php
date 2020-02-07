<?php
/*PLACEHOLDER*/

function validName($string) {
    //checks to see that a string is all alphabetic
    return ctype_alpha($string);
}

function validAge($num) {
    //checks to see that an age is numeric and between18and 118
    return is_numeric($num) AND $num>17 AND $num<119;
}

function validPhone($phoneNum){
    //checks to see that a phone number is valid (you can decide what
    // constitutes a “valid” phone number)
    $digitsOnly = "/^[0-9]{10}+$/";
    $withDashes = "/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/";
    $internationalFormat = "/^\+[0-9]{1,2}-[0-9]{3}-[0-9]{3}-[0-9]{4}$/";
    return preg_match($digitsOnly, $phoneNum) OR
           preg_match($withDashes, $phoneNum) OR
           preg_match($internationalFormat, $phoneNum);
}

function validEmail($email){
    //checks to see that an email address is valid
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validOutdoor(){
    //checks each selected outdoor interest against a list of valid options
}

function validIndoor(){
    //checks each selected indoor interest against a list of valid options
}

/*Makename, age, phone, and email requiredfields. Gender, bio, and interests
are optional.In your controller, require the validation file. When each form
is submitted, validate the data in that form using the appropriate functions.
If there are no errors, then store the data in session variables and display
the next form.*/