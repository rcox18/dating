<?php
/**
 *  Database connection controller for Monster Date website and database.
 *
 * @link       http://rcox.greenriverdev.com/IT328/dating
 * @since      2/28/2020
 * @author     Robert Cox
 * @version    1.0.0
 *
 * ****************CREATE DATABASE CODE******************
 * CREATE TABLE `member` (
    `memberID` int(11) NOT NULL,
    `fname` varchar(30) NOT NULL,
    `lname` varchar(30) NOT NULL,
    `age` int(11) NOT NULL,
    `gender` varchar(20) NOT NULL,
    `phone` varchar(20) NOT NULL,
    `email` varchar(50) NOT NULL,
    `state` varchar(20) NOT NULL,
    `seeking` varchar(10) NOT NULL,
    `bio` varchar(500) NOT NULL,
    `premium` tinyint(4) NOT NULL,
    `image` varchar(100) NOT NULL
    );
 *
 * ALTER TABLE `member`
    ADD PRIMARY KEY (`memberID`);
 *
 *ALTER TABLE `member`
    MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT;
 *
 ********************************************************
 *
 * CREATE TABLE `memberInterest` (
    `memberID` int(11) NOT NULL,
    `interestID` int(11) NOT NULL
    );
 *
 * ALTER TABLE `memberInterest`
    ADD KEY `memberID` (`memberID`),
    ADD KEY `interestID` (`interestID`);
 *
 * *******************************************************
 *
 * CREATE TABLE `interest` (
    `interestID` int(11) NOT NULL,
    `interest` varchar(20) NOT NULL,
    `type` varchar(20) NOT NULL
    );
 *
 * ALTER TABLE `interest`
    ADD PRIMARY KEY (`interestID`);
 *
 * ALTER TABLE `interest`
    MODIFY `interestID` int(11) NOT NULL AUTO_INCREMENT;
 */

require ("../../../connection.php");

/**
 * Class Database
 */
class Database {

    /**
     * @var $this connection to the database
     */
    private $_cnxn;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * Establishes the connection
     */
    public function connect()
    {
        try {
            //CREATING A NEW PDO CONNECTION
            $this->_cnxn =
                new PDO(DATING_DB_DSN,
                    DB_USERNAME,
                    DB_PASSWORD);
            //if there is an error, print error message
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Inserts the new member Object into the DB.
     * If successful, return the new member id.
     *
     * @param $newMember Member object
     * @return int|null actually
     */
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
        $premium =
            (is_a($newMember, "PremiumMember"))?
                "1" : "0";
        $image =
            (is_a($newMember, "PremiumMember"))?
                $newMember->getImage() : "";

        $sql = "INSERT INTO `member` (fname, lname, age, gender, phone, email, 
                                      state, seeking, bio, premium, image) 
                VALUES (:fname, :lname, :age, :gender, :phone, 
                :email, :state, :seeking, :bio, :premium, :image)";
        $statement = $this->_cnxn->prepare($sql);
        $statement->bindParam(":fname", $fname);
        $statement->bindParam(":lname", $lname);
        $statement->bindParam(":age", $age, PDO::PARAM_INT);
        $statement->bindParam(":gender", $gender);
        $statement->bindParam(":phone", $phone);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":state", $state);
        $statement->bindParam(":seeking", $seeking);
        $statement->bindParam(":bio", $bio);
        $statement->bindParam(":premium", $premium, PDO::PARAM_INT);
        $statement->bindParam(":image", $image);
        if ($statement->execute()) {
            return $this->_cnxn->lastInsertId();
        } else {
            return null;
        }
    }

    /**
     * Adds the new user's interests into the DB.
     *
     * @param $newMember Member object
     */
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

    /**
     * Adds the new user's interests into the DB.
     *
     * @param $interest interest to insert
     * @param $id id of member to attach the interest to
     */
    public function insertInterest($interest, $id) {

        $sql = "SELECT interestID FROM interest WHERE interest = :interest";

        $statement = $this->_cnxn->prepare($sql);
        $statement->bindParam(":interest", $interest);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $interestID = $result['interestID'];

        $sql2 = "INSERT INTO memberInterest (memberID, interestID) 
                 VALUES (:id, :interestID)";

        $statement2 = $this->_cnxn->prepare($sql2);
        $statement2->bindParam(":id", $id,
            PDO::PARAM_INT);
        $statement2->bindParam(":interestID", $interestID,
            PDO::PARAM_INT);
        $statement2->execute();
        $result2 = $statement2->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @return array  all members of the monster DB
     */
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

    /**
     * Get individual members by id from the DB
     *
     * @param $id id of member to get
     * @return array  all member properties
     */
    public function getMember($id)
    {
        $sql = "SELECT *
            FROM member 
            WHERE memberID = :id";

        $statement = $this->_cnxn->prepare($sql);
        $statement->bindParam(":id", $id,
            PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Returns a comma separated string of the member's interests
     *
     * @param $memberID id of member
     * @return bool|string  interests
     */
    public function getInterests($memberID)
    {
        $sql = "SELECT interestID  
                FROM memberInterest 
                WHERE memberID = :memberID";

        $statement = $this->_cnxn->prepare($sql);
        $statement->bindParam(":memberID", $memberID,
            PDO::PARAM_INT);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $interest = "";

        foreach ($results AS $row) {
            $intID = $row["interestID"];
            $sql2 = "SELECT interest  
                     FROM interest 
                     WHERE interestID = :intID";

            $statement = $this->_cnxn->prepare($sql2);
            $statement->bindParam(":intID", $intID,
                PDO::PARAM_INT);
            $statement->execute();
            $interest .= $statement->fetch()["interest"].", ";
        }
        return substr($interest, 0, strlen($interest)-2);
    }
}
