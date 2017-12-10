<?php

//Ensure this page is only accessed by staff members
include('../protect/login_protection.php');


//If invalid credentials
if (isset($_SESSION["session_user"])) {
    $user = unserialize($_SESSION["session_user"]);
    if ($user->getIsStaff() != 1) {
        header('Location: ../mainmenu.php');
        session_end();
        exit();
    }
}
?>