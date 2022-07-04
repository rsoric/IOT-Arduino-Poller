<?php
include "dashboard_header.php";
include_once "Backend/polls.php";
?>

<div class="container-fluid dashboard-content">
    <h1>Edit Poll</h1>

    <br>

    <h3>Select poll:</h3>

    <form action="Backend/selectPollToEdit.php" method="POST">

        <div class="row">
            <div class="col-6">
                <div class="input-group">
                    <select class="custom-select" id="currentPollId" name="selectedPollToEdit">
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
                <button class="btn btn-primary" type="submit" name="select">Edit</button>
            </div>
        </div>

    </form>

    <?php
    if (isset($_GET['PollID'])) {
        $id =  $_GET['PollID'];
        $pollName = "";
        $polls = $_polls->getPollToEdit($id);
        while ($poll = $polls->fetch()) {
            $pollName = $poll['pollName'];
        }
    ?>

        <br>

        <h3>Editing <?= $pollName ?></h3>

        <form method="POST" action="Backend/polls_edit.php">
            <div class="row">
                <div class="col-10">
                    <label for="pollName">Poll Name</label>
                    <input type="text" class="form-control" id="pollName" name="pollName" value="<?= $pollName ?>"   aria-describedby="Poll Name">
                </div>
            </div>
            <br>
            <br>
            <div id="questions">
            <?php $polls = $_polls->getPollQuestions($id);
            while ($poll = $polls->fetch()) : ?>
            <div class="row">
                <div class="col-10">
                    <div id="inputQuestionRow"> 
                        <div class="input-group mb-3">
                            <input type="text" name="questions[]" class="form-control m-input" value="<?= $poll['questionText'] ?>" autocomplete="off" maxlength="16">
                            <div class="input-group-append">
                                <button id="removeQuestion" type="button" class="btn btn-danger">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            </div>
            <br>
            <button id="addQuestion" type="button" class="btn btn-secondary">Add question</button>
            <div class="row justify-content-end">
                <div class="col-3">
                    <button class="btn btn-primary" type="submit" name="update">Submit</button>
                </div>
            </div>
        </form>

    <?php
    }

    ?>

    <!--

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

                        -->

</div>

<script type="text/javascript">
    // add row
    $("#addQuestion").click(function() {
        var html = '';
        html += '<div class="row">';
        html += '<div class="col-10">';
        html += '<div id="inputQuestionRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="questions[]" class="form-control m-input" placeholder="Question text" autocomplete="off" maxlength="16">';
        html += '<div class="input-group-append">';
        html += '<button id="removeQuestion" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('#questions').last().append(html);
    });

    // remove row
    $(document).on('click', '#removeQuestion', function() {
        $(this).closest('#inputQuestionRow').remove();
    });
</script>

<?php include "dashboard_footer.php"; ?>