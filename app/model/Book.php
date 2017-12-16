<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Book
 *
 * @author i-am-
 */
class Book {

    private $book_id;
    private $book_name;
    private $book_description;
    private $book_author;
    private $tags;
    private $shelf_id;
    private $shelf_name;
    private $borrowed;

    public function __set($prop, $val) {
        $this->$prop = $val;
    }

    public function __get($prop) {
        return $this->$prop;
    }

    public function getBookID() {
        return $this->book_id;
    }

    public function getBookName() {
        return $this->book_name;
    }

    public function getBookDescription() {
        return $this->book_description;
    }

    public function getBookAuthor() {
        return $this->book_author;
    }

    public function getTag() {
        return $this->tags;
    }

    public function getShelfID() {
        return $this->getShelfID();
    }
    
    public function getShelfName(){
        return $this->shelf_name;
    }
    
    public function getBorrowed(){
        return $this->borrowed;
    }
    

}
