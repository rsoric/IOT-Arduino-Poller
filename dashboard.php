<?php
include "dashboard_header.php";
include_once "Backend/polls.php";
include_once "Backend/current_poll.php";
?>

<div class="container-fluid dashboard-content">

    <h5>Greetings, admin!</h5>
    <p>Welcome to the dashboard.</p>

    <br>
    <br>
    <h2>The current active poll is:
        <?php $polls = $_currentPoll->getNameOfCurrentPoll();
        while ($poll = $polls->fetch()) : ?>
            <?= htmlspecialchars($poll['pollName']) ?>
        <?php endwhile; ?>
    </h2>
    <br>

    <p>Change the current active poll:</p>

    <form action="Backend/currentPoll_edit.php" method="POST">

    <div class="row">
        <div class="col-6">
            
                <div class="input-group">
                    <select class="custom-select" id="currentPollId" name="currentPollId">
                        <?php $polls = $_polls->getDBdata();
                        while ($poll = $polls->fetch()) : ?>
                            <option value="<?= htmlspecialchars($poll['pollId']) ?>"><?= htmlspecialchars($poll['pollName']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                
        </div>
        
    </div>


    <div class="row justify-content-end">
            <div class="col-3">
                <button class="btn btn-primary" type="submit" name="update">Submit</button>
            </div>
        </div>

    </form>
</div>



<?php

/*
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
    */
?>

</div>

<?php include "dashboard_footer.php"; ?>