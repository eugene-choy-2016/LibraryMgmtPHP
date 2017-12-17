<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add New Book</title>
        <?php
        //Ensure only staff can access this page
        require "../model/User.php";
        include('../protect/staff_protection.php');
        
        require '../model/Book.php';
        require '../model/ShelfDAO.php';
        
        ?>
        
        <script>
            function validateForm(){
                var bookName = document.forms["bookCreation"]["book_name"].value;
                var bookAuthor = document.forms["bookCreation"]["book_description"].value;
                var tags = document.forms["bookCreation"]["tags"].value;
                
                if(bookName == "" || bookAuthor== "" || tags == ""){
                    alert("All field must be filled out.");
                    return false;
                }
                
                return true;
            }
        </script>

    </head>
    <body>
        <form action="../mainmenu.php">
            <input type="submit" value="Back to Main Menu">
        </form>
        <h1>Add New Book</h1>
        <form name="bookCreation" action="book_creation_request.php" method="post" onsubmit="return validateForm()">
            Book Name <input type="text" size="50" name="book_name"/><br/><br/>
            Book Description <br/>  <textarea rows="5" cols="50" style="overflow:auto;resize:none" name="book_description" maxlength="100"></textarea><br/><br/>
            Author <input type="text" size=50 name="author"><br/><br/>
            Tags <input type="text" size="50" placeholder="Add tag separated by comma (,)" name="tags"><br/><br/>
            Location of Book <select name="selectShelf">
                <?php
                $shelfs = ShelfDAO::retrieveAll();
                foreach ($shelfs as $shelf) {
                    $shelf_id = $shelf["shelf_id"];
                    $shelf_name = $shelf["shelf_name"];
                    ?>
                    <option value="<?php echo $shelf_id; ?>"><?php echo $shelf_name ?></option>
                    <?php
                }
                ?>
            </select><br/><br/>
            <input type="submit" value="Add Book"/>
        </form><br/>
        <?php
            if(isset($_GET["status"])){
                $status = $_GET["status"];
                if($status){
        ?>
        <font color="green">Book added successfully!</font>
        <?php
                }else{
        ?>
        <font color="red">Book failed to add!</font>
        <?php
                }
            }
        ?>
    </body>
</html>
