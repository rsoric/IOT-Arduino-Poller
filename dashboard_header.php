<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Spacebar.com" />
    <title>Spacebar admin panel</title>
    <link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="CustomCss/style.css" />
    <link rel="stylesheet" href="CustomCss/css/slick.css" />
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
                <a href="index.php"><img src="img/spacebar_logo.png" alt="logo" id="sidebar-logo"></a>
            </div>
            <div class="list-group list-group-flush text-center">
                <a href="dashboard.php"
                    class="admin-panel-nav-item list-group-item list-group-item-action list-group-item-light p-3"
                    data-pathname="/dashboard.php">Dashboard Home</a>
                <a href="dashboard-releases.php"
                    class="admin-panel-nav-item list-group-item list-group-item-action list-group-item-light p-3"
                    data-pathname="/dashboard_statistics.php">Statistics</a>
                <a href="Backend/logout.php"
                    class="admin-panel-nav-item list-group-item list-group-item-action list-group-item-light p-3"
                    data-pathname="Backend/logout.php">Log Out</a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light mobile-admin-navbar">
                <div class="container-fluid">




                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><span
                            class="navbar-toggler-icon"></span></button>




                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0 text-center">
                            <li><a href="dashboard.php"
                                    class="admin-panel-nav-item list-group-item list-group-item-action list-group-item-light p-3"
                                    data-pathname="/dashboard.php">Dashboard Home</a></li>
                            <li><a href="dashboard-releases.php"
                                    class="admin-panel-nav-item list-group-item list-group-item-action list-group-item-light p-3"
                                    data-pathname="/dashboard_statistics.php">Statistics</a></li>
                            <li><a href="Backend/logout.php"
                                    class="admin-panel-nav-item list-group-item list-group-item-action list-group-item-light p-3"
                                    data-pathname="Backend/logout.php">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </nav>