<?php
include "dashboard_header.php";
include_once "Backend/polls_add.php";
?>

<div class="container-fluid dashboard-content">
    <h1>Add Poll</h1>

    <br>

    <form method="POST" action="Backend/polls_add.php">
        <div class="row">
            <div class="col-10">
                <label for="pollName">Poll Name</label>
                <input type="text" class="form-control" id="pollName" name="pollName" aria-describedby="Poll Name">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-10">
                <div id="inputQuestionRow">
                    <div class="input-group mb-3">
                        <input type="text" name="questions[]" class="form-control m-input" placeholder="Question text" autocomplete="off" maxlength="16">
                        <div class="input-group-append">
                            <button id="removeQuestion" type="button" class="btn btn-danger" disabled>Remove</button>
                        </div>
                    </div>
                </div>
                <div id="newQuestion"></div>
                <button id="addQuestion" type="button" class="btn btn-secondary">Add question</button>
            </div>
        </div>
        <br>
        <div class="row justify-content-end">
            <div class="col-3">
                <button class="btn btn-primary" type="submit" name="update">Submit</button>
            </div>
        </div>
    </form>

</div>

<?php
if (isset($_GET['AddSuccess'])) {

?>
<br>
    <div class="row">
        <div class="col-10">
        <div class="alert alert-success" role="alert">
            Poll created successfully!
        </div>
        </div>

        </row>

    <?php } ?>

    <script type="text/javascript">
        // add row
        $("#addQuestion").click(function() {
            var html = '';
            html += '<div id="inputQuestionRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="questions[]" class="form-control m-input" placeholder="Question text" autocomplete="off" maxlength="16">';
            html += '<div class="input-group-append">';
            html += '<button id="removeQuestion" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#inputQuestionRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeQuestion', function() {
            $(this).closest('#inputQuestionRow').remove();
        });
    </script>

    <?php include "dashboard_footer.php"; ?>