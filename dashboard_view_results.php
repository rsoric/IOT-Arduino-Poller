<?php include "dashboard_header.php"; ?>

<script src="https://d3js.org/d3.v4.js"></script>

<div class="container-fluid dashboard-content">
    <h1>Poll results:</h1>

    <br>
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
    <div class="row">
        <div class="col-6">
            <form>
                <div class="input-group">
                    <select class="custom-select" id="inputGroupSelect04">
                        <option value="1">Poll 1</option>
                        <option value="2">Poll 2</option>
                        <option value="3">Poll 3</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Create a div where the graph will take place -->
<div id="my_dataviz"></div>

<?php

$servername = "eu-cdbr-west-02.cleardb.net";
$username = "b8100c5581c24b";
$password = "2ab80845";
$dbname = "heroku_526e4c652212ab8";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

$sql = "
SELECT  * FROM  question_replies
INNER JOIN poll_instances
ON question_replies.pollInstanceId = poll_instances.pollInstanceId
WHERE poll_instances.pollId = 341;
";

error_reporting(E_ALL);
ini_set('display_errors', 'on');

$result = $conn->query($sql);
$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}

 $conn->close();
?>

<script>
    const jsonObj = JSON.parse('<?php print json_encode($rows); ?>');
    console.log(jsonObj);


// set the dimensions and margins of the graph
var margin = {top: 30, right: 30, bottom: 70, left: 60},
    width = 460 - margin.left - margin.right,
    height = 400 - margin.top - margin.bottom;

// append the svg object to the body of the page
var svg = d3.select("#my_dataviz")
  .append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform",
          "translate(" + margin.left + "," + margin.top + ")");




// X axis
var x = d3.scaleBand()
  .range([ 0, width ])
  .domain(jsonObj.map(function(d){ return d.questionId; }))
  .padding(0.2);
svg.append("g")
  .attr("transform", "translate(0," + height + ")")
  .call(d3.axisBottom(x))
  .selectAll("text")
    .attr("transform", "translate(-10,0)rotate(-45)")
    .style("text-anchor", "end");

// Add Y axis
var y = d3.scaleLinear()
  .domain([0, 5])
  .range([ height, 0]);
svg.append("g")
  .call(d3.axisLeft(y));

// Bars
svg.selectAll("mybar")
  .enter()
  .append("rect")
    .attr("x", function(d) { return x(d.questionId); })
    .attr("y", function(d) { return y(d.value); })
    .attr("width", x.bandwidth())
    .attr("height", function(d) { return height - y(d.Value); })
    .attr("fill", "#69b3a2")



        
    
</script>
 

<?php include "dashboard_footer.php"; ?>