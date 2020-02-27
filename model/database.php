<?php
require ("../../../connection.php");
class Database {

    private $_cnxn;

    public function __construct()
    {
        try {
            //CREATING A NEW PDO CONNECTION
            $this->_cnxn = new PDO(DATING_DB_DSN, DB_USERNAME, DB_PASSWORD);
//            echo "Connected!";
            //if there is an error, print error message
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function connect()
    {

    }

    public function insertMember($newMember)
    {
        $fname = $newMember->getFname();
        $lname = $newMember->getLname();
        $age = $newMember->getAge();
        $gender = $newMember->getGender();
        $phone = $newMember->getPhone();
        $email = $newMember->getEmail();
        $state = $newMember->getState();
        $seeking = $newMember->getSeeking();
        $bio = $newMember->getBio();
        $premium = (is_a($newMember, "PremiumMember"))? "1" : "0";
        $image = (is_a($newMember, "PremiumMember"))? $newMember->getImage() : "";

        $sql = "INSERT INTO `member` (fname, lname, age, gender, phone, email, state, seeking, bio, premium, image) 
            VALUES ('$fname', '$lname', '$age', '$gender', '$phone', '$email', '$state', '$seeking', '$bio', '$premium', '$image')";
        $statement = $this->_cnxn->prepare($sql);


        if ($statement->execute()) {
            return $this->_cnxn->lastInsertId();
        } else {
            return null;
        }
    }

    public function getMembers()
    {

    }

    public function getMember($memberID)
    {

    }

    public function getInterests($memberID)
    {

    }
}
