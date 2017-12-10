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
    
    /**
     * Constructor(Magic method) for User object
     * @param String $username
     * @param boolean $isStaff
     */
    public function __construct($username,$isStaff){
        $this->username = $username;
        $this->isStaff = $isStaff;
    }
   
    public function getUserName(){
        return $this->username;
    }
    
    public function getIsStaff(){
        return $isStaff;
    }
    
    public function setStaff($checkStaff){
        $isStaff = $checkStaff;
    }

}
