<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>View books</title>
        <?php
        require "../model/User.php";
        require '../model/BookDAO.php';
        include('../protect/login_protection.php');
        ?>
    </head>
    <body>
        <form action="../mainmenu.php">
            <input type="submit" value="Back to Main Menu">
        </form>
        <h1>View Books</h1>
        <?php
        $books = BookDAO::retrieveAll();
        ?>
        <table border="1">
            <tr>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Book Description</th>
                <th>Book Author</th>
                <th>Location</th>
                <th>Borrowed</th>
                <th>Action</th>
            </tr>

            <?php
            foreach ($books as $book) {
                ?>
                <tr>
                    <td><?php echo $book->getBookID(); ?></td>
                    <td><?php echo $book->getBookName(); ?></td>
                    <td><?php echo $book->getBookDescription(); ?></td>
                    <td><?php echo $book->getBookAuthor(); ?></td>
                    <td><?php echo $book->getShelfName(); ?></td>
                    <td><?php
                        if ($book->getBorrowed()) {
                            ?>
                            <font color="red">Yes</font>
                            <?php
                        } else {
                            ?>
                            <font color="green">No</font>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                            if(!$book->getBorrowed()){
                        ?>
                        <form action="borrow_book_request.php" method="POST">
                            <input type="hidden" value="view_books.php" name="source">
                            <input type="hidden" value="<?php echo $book->getBookID();?>" name="bookID">
                            <input type="submit" value="Borrow">
                        </form>
                        <?php
                            }
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <!--Status msg for borrowing of books-->
        <?php
            if(isset($_GET["borrowStatus"])){
                if($_GET["borrowStatus"] == 1){
                ?>
                    <font color="green">Book successfully borrowed!</font>       
                <?php
                }else{
                ?>
                    <font color="red">Book failed to be borrowed!</font>
                <?php
                }
            }
        ?>
    </body>
</html>
