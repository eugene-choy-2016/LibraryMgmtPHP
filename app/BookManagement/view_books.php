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
                    <td><?php echo $book["book_id"]; ?></td>
                    <td><?php echo $book["book_name"]; ?></td>
                    <td><?php echo $book["book_description"]; ?></td>
                    <td><?php echo $book["book_author"]; ?></td>
                    <td><?php echo $book["shelf_name"]; ?></td>
                    <td><?php
                        if ($book["borrowed"]) {
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
                            if(!$book["borrowed"]){
                        ?>
                        <form action="borrow_book.php" method="POST">
                            <input type="hidden" value="view_books.php" name="source">
                            <input type="hidden" value="<?php echo $book["book_id"];?>" name="bookID">
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

    </body>
</html>
