<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Search Book</title>
        <?php
        include('../protect/login_protection.php');
        ?>
    </head>
    <body>
        <form action="../mainmenu.php">
            <input type="submit" value="Back to Main Menu">
        </form>
        <h1>Search Book</h1>
        <form action="search_book_request.php" method="GET">
            <input type="text" name="searchValue">
            <input type="submit" value="Search">
        </form><br/>
        <?php
        $rows = 0;
        if (isset($_SESSION["searchResults"])) {
            $rows = unserialize($_SESSION["searchResults"]);
            unset($_SESSION["searchResults"]);

            if ($rows == -1) {
                ?>
                <font color="red">No Book Found</font>
                <?php
            } else {
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
                    foreach ($rows as $book) {
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
                                if (!$book["borrowed"]) {
                                    ?>
                                    <form action="borrow_book_request.php" method="POST">
                                        <input type="hidden" value="search_book.php" name="source">
                                        <input type="hidden" value="<?php echo $book["book_id"]; ?>" name="bookID">
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
            }
        }
        ?>
        <?php
        if (isset($_GET["borrowStatus"])) {
            if ($_GET["borrowStatus"] == 1) {
                ?>
                <font color="green">Book successfully borrowed!</font>       
                <?php
            } else {
                ?>
                <font color="red">Book failed to be borrowed!</font>
                <?php
            }
        }
        ?>

    </body>
</html>
