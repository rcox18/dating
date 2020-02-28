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

    public function insertMemberInterests($newMember) {

        $id = $newMember->getID();
        $indoorInterests = $newMember->getIndoorInterests();
        $outdoorInterests = $newMember->getOutdoorInterests();
        if (!empty($indoorInterests)) {
            foreach ($indoorInterests AS $interest ) {
                $this->insertInterest($interest, $id);
            }
        }

        if (!empty($outdoorInterests)) {
            foreach ($outdoorInterests AS $interest ) {
                $this->insertInterest($interest, $id);
            }
        }
    }

    public function insertInterest($interest, $id) {

        $sql = "SELECT interestID FROM interest WHERE interest = '$interest'";
        $statement = $this->_cnxn->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $interestID = $result['interestID'];

        $sql2 = "INSERT INTO memberInterest (memberID, interestID) VALUES ('$id', '$interestID')";
        $statement2 = $this->_cnxn->prepare($sql2);
        $statement2->execute();
        $result2 = $statement2->fetch(PDO::FETCH_ASSOC);
    }

    public function getMembers()
    {
        $sql = "SELECT memberID AS ID, CONCAT(fname, ' ', lname) as Name, 
            age AS Age, phone AS Phone, email AS Email, state AS State, 
            gender AS Gender, seeking AS Seeking, premium AS Premium
            FROM member 
            ORDER BY lname";
        $statement = $this->_cnxn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getMember($id)
    {
        $sql = "SELECT *
            FROM member 
            WHERE memberID = '$id'";
        $statement = $this->_cnxn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getInterests($memberID)
    {
        $sql = "SELECT interestID  FROM memberInterest WHERE memberID = '$memberID'";
        $statement = $this->_cnxn->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $interest = "";
        foreach ($results AS $row) {
            $intID = $row["interestID"];
            $sql2 = "SELECT interest  FROM interest WHERE interestID = '$intID'";
            $statement = $this->_cnxn->prepare($sql2);
            $statement->execute();
            $interest .= $statement->fetch()["interest"].", ";
        }
        return substr($interest, 0, strlen($interest)-2);
    }
}
