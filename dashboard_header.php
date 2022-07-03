<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Poller.com" />
    <title>Poller admin panel</title>
    <link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="CustomCss/style.css" />
    <link rel="stylesheet" href="CustomCss/slick.css" />
</head>

<body>

    <?php 
    if(!isset($_COOKIE['Admin']))
    {
        header("Location: login.php");
    }
?>


    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom">
                <img src="img/server_logo.png" alt="logo" id="sidebar-logo">
            </div>
            <div class="list-group list-group-flush text-center">
                <a href="dashboard.php"
                    class="admin-panel-nav-item list-group-item list-group-item-action list-group-item-light p-3"
                    data-pathname="/dashboard.php">Home</a>
                <a href="dashboard_database.php"
                    class="admin-panel-nav-item list-group-item list-group-item-action list-group-item-light p-3"
                    data-pathname="/dashboard_add_poll.php">Add Poll</a>  
                <a href="dashboard_statistics.php"
                    class="admin-panel-nav-item list-group-item list-group-item-action list-group-item-light p-3"
                    data-pathname="/dashboard_statistics.php">Poll results</a>
                <a href="Backend/logout.php"
                    class="admin-panel-nav-item list-group-item list-group-item-action list-group-item-light p-3"
                    data-pathname="Backend/logout.php">Log Out</a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">