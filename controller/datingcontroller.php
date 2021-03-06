<?php
/**
 *  Controller object for Monster Date.
 *
 * @link       http://rcox.greenriverdev.com/IT328/dating
 * @since      2/22/2020
 * @author     Robert Cox
 * @version    1.0.0
 */

/**
 * Class DatingController
 */
class DatingController {

    private $_f3;
    private $_validator;
    private $_db;

    /**
     * DatingController constructor.
     */
    public function __construct()
    {
        $this->_f3 = Base::instance();;
        $this->_validator = new Validator();
        $this->_db = new Database();

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
     * renders the home view
     */
    public function home() {
        $_SESSION["page"] = "Monster Finder";
        $view = new Template();
        echo $view->render("views/home.html");
    }

    /**
     * renders the personal form and uses validator to determine rerouting
     */
    public function personalForm() {
        $_SESSION["page"] = "Personal";

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $isValid = true;

            $this->_f3->set("firstName", $_POST["first-name"]);
            if (!$this->_validator->validName($_POST["first-name"])) {
                $this->_f3->set("errors['fName']", "Please enter a name.");
                $isValid = false;
            }

            $this->_f3->set("lastName", $_POST["last-name"]);
            if (!$this->_validator->validName($_POST["last-name"])) {
                $this->_f3->set("errors['lName']", "Please enter a name.");
                $isValid = false;
            }

            $this->_f3->set("age", $_POST["age"]);
            if (!$this->_validator->validAge($_POST["age"])) {
                $this->_f3->set("errors['age']", "Must be 18-118 years old.");
                $isValid = false;
            }

            $this->_f3->set("gender", $_POST["gender"]);
             if (isset($_POST["gender"]) AND
                !in_array($_POST["gender"],
                    array_keys($this->_f3->get("genders")))) {

                $this->_f3->set("errors['gender']",
                    "Please enter a valid gender.");
                $isValid = false;
            }

            $this->_f3->set("phone", $_POST["phone"]);
            if (!$this->_validator->validPhone($_POST["phone"])) {
                $this->_f3->set("errors['phone']",
                    "Please enter a phone number.");
                $isValid = false;
            }

            //check premium membership and make it sticky
            $this->_f3->set("premium",
                ((isset($_POST["premium"])? "checked": "")));

            //all inputs valid, go to next page
            if ($isValid) {

                if (isset($_POST["premium"])){
                    $_SESSION["user"] = new PremiumMember($_POST["first-name"],
                        $_POST["last-name"], $_POST["age"],
                        $_POST["gender"], $_POST["phone"]);
                } else {
                    $_SESSION["user"] = new Member($_POST["first-name"],
                        $_POST["last-name"], $_POST["age"],
                        $_POST["gender"], $_POST["phone"]);
                }

                $this->_f3->reroute('/profile-form');
            }
        }

        //not rerouted so stay on page
        $view = new Template();
        echo $view->render("views/personal-form.html");
    }

    /**
     * renders the profile form and uses validator to determine rerouting
     */
    public function profileForm() {
        $_SESSION["page"] = "Profile";
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $isValid = true;

            $this->_f3->set("email", $_POST["email"]);
            if (!$this->_validator->validEmail( $_POST["email"])) {
                $this->_f3->set("errors['email']", "Please enter an email.");
                $isValid = false;
            }

            $this->_f3->set("state", $_POST["state"]);
            if (!in_array($_POST["state"],  $this->_f3->get("states")) AND
                $_POST["state"]!=="none") {
                $this->_f3->set("errors['state']", "Are you sure?");
                $isValid = false;
            }

            $this->_f3->set("seeking", $_POST["seeking"]);
            if (isset($_POST["seeking"]) AND
                !in_array($_POST["seeking"],
                    array_keys($this->_f3->get("genders")))) {

                $this->_f3->set("errors['seeking']", "Is that a gender?");
                $isValid = false;
            }

            $this->_f3->set("bio", $_POST["bio"]);

            if ($isValid) {

                $_SESSION["user"]->setEmail($_POST["email"]);
                $_SESSION["user"]->setState(($_POST["state"] === "none") ? "" : $_POST["state"]);
                $_SESSION["user"]->setSeeking( (isset($_POST["seeking"])) ? $_POST["seeking"] : "");
                $_SESSION["user"]->setBio((isset($_POST["bio"])) ? $_POST["bio"] : "");

                if (is_a($_SESSION["user"], "PremiumMember")) {
                    $this->_f3->reroute('/interests-form');
                } else {
                    $_SESSION["user"]->setId($this->_db->insertMember($_SESSION["user"]));
                    if ($_SESSION["user"]->getId() !== null) {
                        $this->_f3->reroute('/profile-summary');
                    }
                    $this->_f3->set("errors['addUser']",
                        "Sorry, there was an error adding you to the database");
                }
            }
        }

        $view = new Template();
        echo $view->render("views/profile-form.html");
    }

    /**
     * renders the interests form and uses validator to determine rerouting
     */
    public function interestsForm() {
        $_SESSION["page"] = "Interests";

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $isValid = true;

            $this->_f3->set("indoorInterests",  $_POST["indoor-interests"]);
            $this->_f3->set("outdoorInterests",  $_POST["outdoor-interests"]);

            if(isset($_POST["indoor-interests"])) {

                if (!$this->_validator->validIndoor($_POST["indoor-interests"],
                    $this->_f3)) {

                    $this->_f3->set("errors['indoor']", "Hmmm...Phishy!");
                    $isValid = false;
                }
            }

            if(isset($_POST["outdoor-interests"])) {

                if (!$this->_validator->validOutdoor($_POST["outdoor-interests"],
                    $this->_f3)) {
                    $this->_f3->set("errors['outdoor']", "Hmmm...Phishy!");
                    $isValid = false;
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
     * renders the image upload form and uses validator to determine rerouting
     */
    public function profileImage() {

        $_SESSION["page"] = "Profile Image";
        $_SESSION['user']->setImage(null);

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
                    $this->_f3->set("errors['fileExists']",
                        "Not recognized as an image.");
                    $uploadOk = false;
                }

                if ($uploadOk) {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],
                        $target_file)) {

                        $_SESSION["user"]->setImage($target_file);
                        $this->_f3->set("profileImage", $target_file);

                        $_SESSION["user"]->setId(
                            $this->_db->insertMember($_SESSION["user"]));
                        if ($_SESSION["user"]->getId() !== null) {
                            //add in/outdoor interests into table
                            $this->_db->insertMemberInterests($_SESSION["user"]);
                            $_SESSION["user"]->setInterests(
                                $this->_db->getInterests($_SESSION["user"]->getID()));
                            $this->_f3->reroute('/profile-summary');

                        }

                        $this->_f3->set("errors['addUser']",
                            "Sorry, there was an error adding you to the database");

                    } else {
                        $this->_f3->set("errors['fileUpload']",
                            "Sorry, there was an error uploading your file.");
                    }
                }
            } else {
                $this->_f3->set("errors['fileExists']", "No file.");
            }
            //if skip was pressed
            if (isset($_POST["skip"])) {
                $_SESSION["user"]->setId(
                    $this->_db->insertMember($_SESSION["user"]));
                if ($_SESSION["user"]->getId() !== null) {
                    //add in/outdoor interests into table
                    $this->_db->insertMemberInterests($_SESSION["user"]);
                    $_SESSION["user"]->setInterests(
                        $this->_db->getInterests($_SESSION["user"]->getID()));
                    $this->_f3->reroute('/profile-summary');
                }
            }
        }
        $view = new Template();
        echo $view->render("views/profile-image.html");
    }

    /**
     * renders the profile summary view
     */
    public function profileSummary() {
        $_SESSION["page"] = "Summary";
        $view = new Template();
        echo $view->render("views/profile-summary.html");
    }

    /**
     * renders the admin view (members table)
     */
    public function admin() {
        $_SESSION["page"] = "Members";
        $_SESSION["members"] = $this->_db->getMembers();

        for ($i = 0; $i < sizeof($_SESSION["members"]);  $i++) {
            $_SESSION["members"][$i]["Interests"] =
                $this->_db->getInterests($_SESSION["members"][$i]["ID"]);
        }

        $view = new Template();
        echo $view->render("views/admin.html");
    }

    /**
     * renders clicked member's profile summary view
     */
    public function showMember($id){
        if ($id === "index.php") {
            $this->_f3->reroute('/');
        }

        $member = $this->_db->getMember($id);
        if ($member[0]["premium"] == "0") {
            $_SESSION["user"] = new Member();
        } else {
            $_SESSION["user"] = new PremiumMember();
            $_SESSION["user"]->setInterests($this->_db->getInterests($id));
            $_SESSION["user"]->setImage($member[0]["image"]);
        }

        $_SESSION["user"]->setFname($member[0]["fname"]);
        $_SESSION["user"]->setLname($member[0]["lname"]);
        $_SESSION["user"]->setAge($member[0]["age"]);
        $_SESSION["user"]->setGender($member[0]['gender']);
        $_SESSION["user"]->setPhone($member[0]["phone"]);
        $_SESSION["user"]->setEmail($member[0]["email"]);
        $_SESSION["user"]->setState($member[0]["state"]);
        $_SESSION["user"]->setSeeking($member[0]["seeking"]);
        $_SESSION["user"]->setBio($member[0]['bio']);


        $view = new Template();
        echo $view->render("views/profile-summary.html");
    }

    /**
     * @param Validator $validator
     */
    public function setValidator($validator)
    {
        $this->_validator = $validator;
    }

    /**
     * @return Validator
     */
    public function getValidator()
    {
        return $this->_validator;
    }

    /**
    * @return Base
    */
    public function getF3()
    {
        return $this->_f3;
    }
}