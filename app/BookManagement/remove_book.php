<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Remove Book</title>
        <?php
        //Ensure only staff can access this page
        require "../model/User.php";
        include('../protect/staff_protection.php');

        require '../model/Book.php';
        require '../model/ShelfDAO.php';

        $book = null;
        ?>

        <script>
            function confirmation() {
                return confirm("Removing a book will remove all its entries from borrow record. Do you want to remove the book?");
            }
        </script>

    </head>
    <body>
        <form action="../mainmenu.php">
            <input type="submit" value="Back to Main Menu">
        </form>
        <h1>Remove Book</h1>
        <h2>Retrieval</h2>
        <form action="retrieve_book_request.php" method="GET">
            Book ID <input type="text" name="book_id">
            <input type="submit" value="Search">
        </form>

        <h2>Retrieval Results</h2>

        <?php
        if (isset($_SESSION["retrieved_book"])) {
            if (!$_SESSION["retrieved_book"]) {
        ?>
        <font color="red">No book found!</font>
        <?php
            } else {
                $book = unserialize($_SESSION["retrieved_book"]);
                unset($_SESSION["retrieved_book"]);
            }
        }
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
            if ($book != null) {
                ?>
                <tr>
                    <td><?php echo $book->getBookID(); ?></td>
                    <td><?php echo $book->getBookName(); ?></td>
                    <td><?php echo $book->getBookDescription(); ?></td>
                    <td><?php echo $book->getBookAuthor(); ?></td>
                    <td><?php echo $book->getShelfName(); ?></td>
                    <td>
                        <?php
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
                        if (!$book->getBorrowed()) {
                            ?>
                            <form action="remove_book_request.php" method="POST" onsubmit="return confirmation()">
                                <input type="hidden" value="<?php echo $book->getBookID(); ?>" name="book_id">
                                <input type="submit" value="Remove">
                            </form>
                            <?php
                        } else {
                            ?>
                            <font color="red">Book is borrowed, you cannot remove it.</font>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>

        </table>

        <?php
        if (isset($_GET["delete"])) {
            $status = $_GET["delete"];
            if ($status) {
                ?>
                <font color="green">Book successfully deleted!</font>
                <?php
            } else {
                ?>
                <font color="red">Book unsuccessfully deleted!</font>
                <?php
            }
        }
        ?>

    </body>
</html>
