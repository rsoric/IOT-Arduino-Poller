<?php 

    if (isset($_COOKIE['Admin'])) 
    {
        unset($_COOKIE['Admin']);
        setcookie('Admin', '', time() - 3600, '/');
    }

    header("Location: ../login.php");
