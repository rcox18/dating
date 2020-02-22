<?php

/**
 * Class DatingController
 */
class DatingController {

    private $_f3;
    private $_validator;

    /**
     * DatingController constructor.
     */
    public function __construct()
    {
        $this->_f3 = Base::instance();;
        $this->_validator = new Validator();

        $this->_f3->set('DEBUG', 3);

        //set arrays for sticky and validation
        $this->_f3->set('genders',
            array('female'=>'Female', 'male'=>'Male', 'other'=>'Other'));
        $this->_f3->set('states',
            array("AK","AL","AR","AZ","CA","CO","CT","DC","DE","FL","GA",
            "GU","HI","IA","ID","IL","IN","KS","KY","LA","MA","MD",
            "ME","MH","MI","MN","MO","MS","MT","NC","ND","NE","NH",
            "NJ","NM","NV","NY","OH","OK","OR","PA","PR","PW","RI",
            "SC","SD","TN","TX","UT","VA","VI","VT","WA","WI","WV",
            "WY"));
        $this->_f3->set('indoor',
            array("tv"=>"TV", "movies"=>"Movies", "cooking"=>"Cooking",
            "board-games"=>"Board games", "puzzles"=>"Puzzles",
            "reading"=>"Reading", "playing-cards"=>"Playing cards",
            "video-games"=>"Video games"));
        $this->_f3->set('outdoor',
            array("hiking"=>"Hiking", "biking"=>"Biking",
            "swimming"=>"Swimming", "collecting"=>"Collecting",
            "walking"=>"Walking", "climbing"=>"Climbing",
            "chasing"=>"Chasing", "stalking"=>"Stalking"));
        $this->_f3->set("indoorInterests",  array());
        $this->_f3->set("outdoorInterests",  array());
    }

    /**
     *
     */
    public function home() {
        $_SESSION["page"] = "Monster Finder";
        unset($_SESSION["profileImage"]);
        $view = new Template();
        echo $view->render("views/home.html");
    }

    /**
     *
     */
    public function personalForm() {
        $_SESSION["page"] = "Personal";
        unset($_SESSION["profileImage"]);
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
                in_array($_POST["gender"],
                    array_keys($this->_f3->get("genders")))) {

                $_SESSION["gender"] = $_POST["gender"];
            } else if (isset($_POST["gender"]) AND
                !in_array($_POST["gender"],
                    array_keys($this->_f3->get("genders")))) {

                $this->_f3->set("errors['gender']",
                    "Please enter a valid gender.");
                $isValid = false;
            }

            $this->_f3->set("phone", $_POST["phone"]);
            if ($this->_validator->validPhone($_POST["phone"])) {
                $_SESSION["phone"] = $_POST["phone"];
            } else {
                $this->_f3->set("errors['phone']",
                    "Please enter a phone number.");
                $isValid = false;
            }

            //check premium membership
            $this->_f3->set("premium",
                ((isset($_POST["premium"])? "checked": "")));
            $_SESSION["premium"] = (isset($_POST["premium"])? "1" : "0");

            //all inputs valid, go to next page
            if ($isValid) {
                if ($_SESSION["premium"] == "0") {
                    $user = new Member($_SESSION["firstName"],
                        $_SESSION["lastName"], $_SESSION["age"],
                        $_SESSION["gender"], $_SESSION["phone"]);
                } else {
                    $user = new PremiumMember($_SESSION["firstName"],
                        $_SESSION["lastName"], $_SESSION["age"],
                        $_SESSION["gender"], $_SESSION["phone"]);
                }
                $this->_f3->set("user", $user);
                $_SESSION["user"] = $user;
                $this->_f3->reroute('/profile-form');
            }
        }

        //not rerouted so stay on page
        $view = new Template();
        echo $view->render("views/personal-form.html");
    }

    /**
     *
     */
    public function profileForm() {
        $_SESSION["page"] = "Profile";
        unset($_SESSION["profileImage"]);

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
                in_array($_POST["seeking"],
                    array_keys( $this->_f3->get("genders")))) {

                $_SESSION["seeking"] = $_POST["seeking"];

            } else if (isset($_POST["seeking"]) AND
                !in_array($_POST["seeking"],
                    array_keys($this->_f3->get("genders")))) {

                $this->_f3->set("errors['seeking']", "Is that a gender?");
                $isValid = false;
            }

            $this->_f3->set("bio", $_POST["bio"]);
            if (isset($_POST["bio"]) ) {
                $_SESSION["bio"] = $_POST["bio"];
            }

            if ($isValid) {

                $_SESSION["user"]->setEmail($_SESSION["email"]);
                $_SESSION["user"]->setState($_SESSION["state"]);
                $_SESSION["user"]->setSeeking($_SESSION["seeking"]);
                $_SESSION["user"]->setBio($_SESSION["bio"]);

                if (is_a($_SESSION["user"], "PremiumMember")) {
                    $this->_f3->reroute('/interests-form');
                } else {
                    $this->_f3->reroute('/profile-summary');
                }

            }
        }

        $view = new Template();
        echo $view->render("views/profile-form.html");
    }

    /**
     *
     */
    public function interestsForm() {
        $_SESSION["page"] = "Interests";

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $isValid = true;

            $this->_f3->set("indoorInterests",  $_POST["indoor-interests"]);
            $this->_f3->set("outdoorInterests",  $_POST["outdoor-interests"]);
            $_SESSION["interests"] ="";

            if(isset($_POST["indoor-interests"])) {

                if (!$this->_validator->validIndoor($_POST["indoor-interests"],
                    $this->_f3)) {

                    $this->_f3->set("errors['indoor']", "Hmmm...Phishy!");
                    $isValid = false;
                }


                if ($isValid AND !empty($_POST["indoor-interests"])) {

                    $_SESSION["indoorInterests"] = $_POST["indoor-interests"];
                    foreach ($_SESSION["indoorInterests"] AS $v) {

                        $_SESSION["interests"] =
                            $_SESSION["interests"]." ".
                            $this->_f3->get("indoor[$v]");
                    }
                }
            }

            if(isset($_POST["outdoor-interests"])) {

                if (!$this->_validator->validOutdoor($_POST["outdoor-interests"],
                    $this->_f3)) {
                    $this->_f3->set("errors['outdoor']", "Hmmm...Phishy!");
                    $isValid = false;
                }


                if ($isValid AND !empty($_POST["outdoor-interests"])) {
                    $_SESSION["outdoorInterests"] = $_POST["outdoor-interests"];
                    foreach ($_SESSION["outdoorInterests"] AS $v) {
                        $_SESSION["interests"] =
                            $_SESSION["interests"]." ".
                            $this->_f3->get("outdoor[$v]");
                    }
                }
            }

            if ($isValid) {
                $_SESSION["user"]->setIndoorInterests($_POST["indoor-interests"]);
                $_SESSION["user"]->setOutdoorInterests($_POST["outdoor-interests"]);
                $this->_f3->reroute('/profile-image');
            }
        }

        $view = new Template();
        echo $view->render("views/interests-form.html");

    }

    /**
     *
     */
    public function profileImage() {

        $_SESSION["page"] = "Profile Image";
        unset($_SESSION["profileImage"]);

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $target_dir = "uploads/";
            $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);

            $imageFileType = strtolower(pathinfo($target_file,
                PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"]) AND
                !empty($_FILES["fileToUpload"]["tmp_name"])) {

                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                $uploadOk = true;

                if($imageFileType != "jpg" && $imageFileType != "png" &&
                    $imageFileType != "jpeg") {
                    $this->_f3->set("errors['fileFormat']",
                        "Sorry, only JPG, JPEG, PNG files are allowed.");
                    $uploadOk = false;
                } elseif ($check === false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $this->_f3->set("errors['fileExists']",
                        "Not recognized as an image.");
                    $uploadOk = false;
                    // Allow certain file formats
                }

                if ($uploadOk) {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],
                        $target_file)) {

                        $_SESSION["profileImage"] = $target_file;
                        $this->_f3->set("profileImage", $target_file);
                        $this->_f3->reroute('/profile-summary');
                    } else {
                        $this->_f3->set("errors['fileUpload']",
                            "Sorry, there was an error uploading your file.");
                    }
                }
            } else {
                $this->_f3->set("errors['fileExists']", "No file.");
            }
        }


        $view = new Template();
        echo $view->render("views/profile-image.html");
    }

    /**
     *
     */
    public function profileSummary() {
        $_SESSION["page"] = "Summary";

        $view = new Template();
        echo $view->render("views/profile-summary.html");
    }


    /**
    * @return Base
    */
    public function getF3()
    {
        return $this->_f3;
    }
}