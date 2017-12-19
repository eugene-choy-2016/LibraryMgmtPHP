<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require "/model/User.php";
include('/protect/login_protection.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Main Menu</h1>
        <?php
        
        $user = unserialize($_SESSION["session_user"]);
        $permission = $user->getIsStaff();

        //Only staff can see these buttons
        if ($permission == 1) {
            ?>

            <form>
                <button formaction="UserManagement/add_user.php">Add User</button>
            </form><br/>

            <form>
                <button formaction="BookManagement/add_book.php">Add Book</button>
            </form><br/>

            <form>
                <button formaction="BookManagement/remove_book.php">Remove Book</button>
            </form><br/>

            <form>
                <button formaction="UserManagement/update_user_details.php">Update User Details</button>
            </form><br/>

            <?php
        }
        ?>

        <form >
            <button formaction="BookManagement/view_books.php">View Books</button>
        </form><br/>

        <form>
            <button formaction="BookManagement/search_book.php">Search Book</button>
        </form><br/>
        
        <form>
            <button formaction="BookManagement/return_book.php">Search Book</button>
        </form><br/>

        <form>
            <button formaction="logout.php">Log Out</button>
        </form>

    </body>
</html>
