<?php

    include ('../config/constants.php');    

    // 1. destroy the session
    session_destroy(); // unset the user

    //2. redirect to login page
    header('location:'.SETURL.'admin/login.php');
?>