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
    private $borrowed;
    
    //Constructor for book
    public function __constructor(  $book_id,$book_name,
                                    $book_description,$book_author,
                                    $tags,$shelf_id,$borrowed){
        $this->book_id = $book_id;
        $this->book_name = $book_name;
        $this->book_description = $book_description;
        $this->book_author = $book_author;
    }
}
