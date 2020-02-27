<?php
/**
 *  Premium member object for Monster Date.
 *
 * @link       http://rcox.greenriverdev.com/IT328/dating
 * @since      2/22/2020
 * @author     Robert Cox
 * @version    1.0.0
 */


/**
 * Class PremiumMember extends Member
 */
class PremiumMember extends Member {
    private $_indoorInterests;
    private $_outdoorInterests;
    private $_image;

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->_image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->_image = $image;
    }

    /**
     * PremiumMember constructor calls the parent constructor.
     */
    public function __construct($fname, $lname, $age, $gender, $phone)
    {
        parent::__construct($fname, $lname, $age, $gender, $phone);
    }

    /**
     * getter
     * @return mixed
     */
    public function getIndoorInterests()
    {
        return $this->_indoorInterests;
    }

    /**
     * setter
     * @param mixed $indoorInterests
     */
    public function setIndoorInterests($indoorInterests)
    {
        $this->_indoorInterests = $indoorInterests;
    }

    /**
     * getter
     * @return mixed
     */
    public function getOutdoorInterests()
    {
        return $this->_outdoorInterests;
    }

    /**
     * setter
     * @param mixed $outdoorInterests
     */
    public function setOutdoorInterests($outdoorInterests)
    {
        $this->_outdoorInterests = $outdoorInterests;
    }


}