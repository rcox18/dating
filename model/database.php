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

    public function insertMember()
    {

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
