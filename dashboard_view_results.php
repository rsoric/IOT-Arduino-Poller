<?php 
include "dashboard_header.php"; 
include_once "Backend/polls.php";
?>

<script src="https://d3js.org/d3.v4.js"></script>
<script>
function showReplies(poll) {
  if (poll == "") {
    document.getElementById("repliesListed").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("repliesListed").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","Backend/getReplies.php?q="+poll,true);
    xmlhttp.send();
  }
}
</script>

<div class="container-fluid dashboard-content">
    <h1>Poll results:</h1>

    <br>

    <?php
    if (!isset($_GET['PollID'])) {
    ?>
    <!--
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Poll Name</label>
            <input type="text" class="form-control" id="pollName" aria-describedby="Poll Name">
        </div>
    </div>
</div>-->

    <p>Choose a poll:</p>
    <form>
    <div class="row">
        <div class="col-6">
                <div class="input-group">
                    <select class="custom-select" onchange="showReplies(this.value)">
                        <?php $polls = $_polls->getDBdata();
                        while ($poll = $polls->fetch()) : ?>
                            <option value="<?= htmlspecialchars($poll['pollId']) ?>"><?= htmlspecialchars($poll['pollName']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
        </div>
    </div>
    </form>

    <?php
    }  

    ?>

    <br>

    <div id="repliesListed"><b>Replies info will be listed here</b></div>

</div>

<!-- Create a div where the graph will take place -->

<?php include "dashboard_footer.php"; ?>