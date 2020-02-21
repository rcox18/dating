<?php
class DatingController {
    private $_f3;
    private $_validator;

    /**
     * DatingController constructor.
     * @param $_f3
     */
    public function __construct($_f3)
    {
        $this->_f3 = $_f3;
        $this->_validator = new Validator();
    }

    public function home() {
        $_SESSION["page"] = "Monster Finder";
        $view = new Template();
        echo $view->render("views/home.html");
    }

    public function personalForm() {
        $_SESSION["page"] = "Personal";

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $isValid = true;

            $this->_f3->set("firstName", $_POST["first-name"]);
            if ($this->_validator->validName($_POST["first-name"])) {
                $_SESSION["firstName"] = $_POST["first-name"];
            } else {
                $this->_f3->set("errors['fName']", "Please enter a name.");
                $isValid = false;
            }

            $this->_f3->set("lastName", $_POST["last-name"]);
            if ($this->_validator->validName($_POST["last-name"])) {
                $_SESSION["lastName"] = $_POST["last-name"];
            } else {
                $this->_f3->set("errors['lName']", "Please enter a name.");
                $isValid = false;
            }

            $this->_f3->set("age", $_POST["age"]);
            if ($this->_validator->validAge($_POST["age"])) {
                $_SESSION["age"] = $_POST["age"];
            } else {
                $this->_f3->set("errors['age']", "Must be 18-118 years old.");
                $isValid = false;
            }

            $this->_f3->set("gender", $_POST["gender"]);
            if (isset($_POST["gender"]) AND
                in_array($_POST["gender"], array_keys($this->_f3->get("genders")))) {
                $_SESSION["gender"] = $_POST["gender"];
            } else if (isset($_POST["gender"]) AND
                !in_array($_POST["gender"], array_keys($this->_f3->get("genders")))) {
                $this->_f3->set("errors['gender']", "Please enter a valid gender.");
                $isValid = false;
            }

            $this->_f3->set("phone", $_POST["phone"]);
            if ($this->_validator->validPhone($_POST["phone"])) {
                $_SESSION["phone"] = $_POST["phone"];
            } else {
                $this->_f3->set("errors['phone']", "Please enter a phone number.");
                $isValid = false;
            }

            //all inputs valid, go to next page
            if ($isValid) {
                $this->_f3->reroute('/profile-form');
            }
        }

        //not rerouted so stay on page
        $view = new Template();
        echo $view->render("views/personal-form.php");
    }

    public function profileForm() {
        $_SESSION["page"] = "Profile";
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $isValid = true;

            $this->_f3->set("email", $_POST["email"]);
            if ($this->_validator->validEmail( $_POST["email"])) {
                $_SESSION["email"] = $_POST["email"];
            } else {
                $this->_f3->set("errors['email']", "Please enter an email.");
                $isValid = false;
            }

            $this->_f3->set("state", $_POST["state"]);
            if (in_array($_POST["state"],  $this->_f3->get("states")) OR
                $_POST["state"]==="none") {
                $_SESSION["state"] = $_POST["state"];
            } else {
                $this->_f3->set("errors['state']", "Are you sure?");
                $isValid = false;
            }

            $this->_f3->set("seeking", $_POST["seeking"]);
            if (isset($_POST["seeking"]) AND
                in_array($_POST["seeking"], array_keys( $this->_f3->get("genders")))) {
                $_SESSION["seeking"] = $_POST["seeking"];
            } else if (isset($_POST["seeking"]) AND
                !in_array($_POST["seeking"], array_keys( $this->_f3->get("genders")))) {
                $this->_f3->set("errors['seeking']", "Is that a gender?");
                $isValid = false;
            }

            $this->_f3->set("bio", $_POST["bio"]);
            if (isset($_POST["bio"]) ) {
                $_SESSION["bio"] = $_POST["bio"];
            }

            if ($isValid) {
                $this->_f3->reroute('/interests-form');
            }
        }

        $view = new Template();
        echo $view->render("views/profile-form.php");

    }

    public function interestsForm() {
        $_SESSION["page"] = "Interests";

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $isValid = true;

            $this->_f3->set("indoorInterests",  $_POST["indoor-interests"]);
            $this->_f3->set("outdoorInterests",  $_POST["outdoor-interests"]);
            $_SESSION["interests"] ="";

            if(isset($_POST["indoor-interests"])) {

                if (!$this->_validator->validIndoor($_POST["indoor-interests"])) {
                    $this->_f3->set("errors['indoor']", "Hmmm...Phishy!");
                    $isValid = false;
                }


                if ($isValid AND !empty($_POST["indoor-interests"])) {
                    $_SESSION["indoorInterests"] = $_POST["indoor-interests"];
                    foreach ($_SESSION["indoorInterests"] AS $v) {
                        $_SESSION["interests"] =
                            $_SESSION["interests"]." ". $this->_f3->get("indoor[$v]");
                    }
                }
            }

            if(isset($_POST["outdoor-interests"])) {

                if (!$this->_validator->validOutdoor($_POST["outdoor-interests"])) {
                    $this->_f3->set("errors['outdoor']", "Hmmm...Phishy!");
                    $isValid = false;
                }


                if ($isValid AND !empty($_POST["outdoor-interests"])) {
                    $_SESSION["outdoorInterests"] = $_POST["outdoor-interests"];
                    foreach ($_SESSION["outdoorInterests"] AS $v) {
                        $_SESSION["interests"] =
                            $_SESSION["interests"]." ". $this->_f3->get("outdoor[$v]");
                    }
                }
            }

            if ($isValid) {
                $this->_f3->reroute('/profile-summary');
            }
        }

        $view = new Template();
        echo $view->render("views/interests-form.php");

    }

    public function profileSummary() {
        $_SESSION["page"] = "Summary";

        $view = new Template();
        echo $view->render("views/profile-summary.php");

    }
}