<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 * Entity object for user
 * 
 */
class User {

    private $username;
    private $isStaff;
    private $password;

    /**
     * Constructor(Magic method) for User object
     * @param String $username
     * @param boolean $isStaff
     */
    public function __construct($username, $isStaff) {
        $this->username = $username;
        $this->isStaff = $isStaff;
    }

    /**
     * Password will not be initialized usually, only a 
     * @param type $password The new password for the current
     * @param User $sessionUser Pass in the Session, to ensure only staff 
     * retrieve the password of a user
     */
    public function setPassword($password, User $sessionUser) {
        if ($sessionUser->getIsStaff() == 1) {
            $this->password = $password;
        }
    }

    /**
     * Return the password of a mentioned user only if the requestor is a staff
     * @param User $sessionUser The user that is in session now
     * @return int or String If non staff user request for this method it will
     * return -1
     */
    public function getPassword(User $sessionUser) {
        if ($sessionUser->getIsStaff() == 1) {
            return $this->password;
        }
        return -1; //If -1 is return means sessionUser is not a staff
    }

    public function getUserName() {
        return $this->username;
    }

    public function getIsStaff() {
        return $this->isStaff;
    }

    public function setStaff($checkStaff) {
        $isStaff = $checkStaff;
    }

}
