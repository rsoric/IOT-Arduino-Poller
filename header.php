<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Štrafasti risevi - Robert Sorić, David Hodak, Damir Stipančić">
    <meta name="generator" content="Hugo 0.88.1">
    <title>ARDUINO POLLER</title>

    <!-- Bootstrap core CSS -->
    <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="Bootstrap/js/bootstrap.min.js"></script>

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>


    <!-- Custom styles for this template -->
    <link href="CustomCss/style.css" rel="stylesheet">

    <?php 
    $activePage = basename($_SERVER['PHP_SELF'], ".php");
    ?>

</head>

<body class="d-flex h-100 text-center">

    <div class="cover-container d-flex w-100 h-100 p-4 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link <?= ($activePage == 'index') ? 'nav-current':''; ?>" href="index.php">Home</a>
                    <a class="nav-link <?= ($activePage == 'about') ? 'nav-current':''; ?>" href="about.php">About</a>
                    <a class="nav-link <?= ($activePage == 'login') ? 'nav-current':''; ?>" href="login.php">Login</a>
                </nav>
            </div>
        </header>