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
    <script type="text/javascript" src="Bootstrap/js/rotateImage.js"></script>

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
</head>

<body class="d-flex h-100 text-center">

    <div class="cover-container d-flex w-100 h-100 p-4 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link" href="#">About</a>
                    <a class="nav-link" href="login.php">Login</a>
                </nav>
            </div>
        </header>

        <footer class="mt-auto">
            <p>&copy; Copyright 2021, Štrafasti Ris Web Development Agency</p>
        </footer>
    </div>


    <!-- /* $host = "eu-cdbr-west-02.cleardb.net";
    $user = "b8100c5581c24b";
    $pass = "2ab80845";
    $db_name = "heroku_526e4c652212ab8";

    //create connection
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $connection = mysqli_connect($host, $user, $pass, $db_name);

    //get results from database
    $result = mysqli_query($connection, "SELECT * FROM responses");
    $all_property = array(); //declare an array for saving property

    //showing property
    echo '<table class="data-table">
        <tr class="data-heading">'; //initialize table tag
            while ($property = mysqli_fetch_field($result)) {
            echo '<td>' . $property->name . '</td>'; //get field name for header
            $all_property[] = $property->name; //save those to array
            }
            echo '</tr>'; //end tr tag

        //showing all data
        while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
            foreach ($all_property as $item) {
            echo '<td>' . $row[$item] . '</td>'; //get items using property value
            }
            echo '</tr>';
        }
        echo "
    </table>";
    ?>*/ -->


</body>

</html>