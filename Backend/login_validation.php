<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

    include_once 'admins.php';
    include_once 'sanitization.php';

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $adminUsername = sanitizeInput($_POST['adminUsername']);
        $adminPassword = md5(sanitizeInput($_POST['adminPassword']));
        $admins = $_admins->getDBdata();

        while ($admin = $admins->fetch())
        {
            echo "<h1>" .  $admin['adminUsername'] . "</h1>";
            if($admin['adminUsername'] == $adminUsername && $admin['adminPassword'] == $adminPassword) 
            {
                setcookie("Admin", $adminUsername, time()+600, '/');
                header("Location: ../dashboard.php");
            }
            else 
            {
                header("Location:../login.php?error=wrongcredentials"); 
            }
        }
    }