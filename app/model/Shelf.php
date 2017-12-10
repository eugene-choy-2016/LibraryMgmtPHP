<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Entity class for Shelf
 *
 * =
 */
class Shelf {
    //put your code here
    private $shelf_id;
    private $shelf_name;
    
    public function __constructor($shelf_id,$shelf_name){
        $this->shelf_id = $shelf_id;
        $this->shelf_name = $shelf_name;
    }
}
