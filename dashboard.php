<?php include "dashboard_header.php"; ?>

<div class="container-fluid dashboard-content">

    <h1>Greetings, admin!</h1>
    <h2>Welcome to the dashboard.</h2>

    <h3> test </h3>

    <?
    $host = "eu-cdbr-west-02.cleardb.net";
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
    ?>

</div>

<?php include "dashboard_footer.php"; ?>