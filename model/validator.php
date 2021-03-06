<?php
/**
 *  Validation functions for Monster Dating Site sign up form .
 *
 * @link       http://rcox.greenriverdev.com/IT328/dating
 * @since      2/7 /2020
 * @author     Robert Cox
 * @version    1.0.0
 */

/**
 * Class Validator
 */
class Validator {

    /**
     * returns true if a string is all alphabetic
     * @param $string
     * @return bool
     */
    function validName($string) {
        return ctype_alpha($string);
    }

    /**
     * returns true if numeric and between 18 and 118
     * @param $num
     * @return bool
     */
    function validAge($num) {
        return is_numeric($num) AND $num>17 AND $num<119;
    }


    /**
     * checks to see that a phone number is valid (you can decide what
     * constitutes a “valid” phone number)
     * @param $phoneNum
     * @return bool
     */
    function validPhone($phoneNum){
        $digitsOnly = "/^[0-9]{10}+$/";
        $withDashes = "/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/";
        $internationalFormat = "/^\+[0-9]{1,2}-[0-9]{3}-[0-9]{3}-[0-9]{4}$/";
        return preg_match($digitsOnly, $phoneNum) OR
            preg_match($withDashes, $phoneNum) OR
            preg_match($internationalFormat, $phoneNum);
    }

    /**
     * checks to see that an email address is valid
     * @param $email
     * @return mixed
     */
    function validEmail($email){

        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * checks each selected outdoor interest against a list of valid options
     * @param $array
     * @param $f3
     * @return bool
     */
    function validOutdoor($array, $f3){

        foreach ($array AS $v) {
            if (!in_array($v, array_values($f3->get("outdoor")))) {
                return false;
            }
        }
        return true;
    }

    /**
     * checks each selected indoor interest against a list of valid options
     * @param $array
     * @param $f3
     * @return bool
     */
    function validIndoor($array, $f3){

        foreach ( $array AS $v) {
            if (!in_array($v, array_values($f3->get("indoor")))) {
                return false;
            }
        }
        return true;
    }
}



