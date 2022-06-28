<?php include "dashboard_header.php"; ?>

<div class="container-fluid dashboard-content">

    <div class="row">
        <div class="col">
            <h1>Add question:</h1>
        </div>
        <div class="col-3">
            <form action="dashboard-releases.php">
                <input type="submit" id="back-button" value="Go back">
            </form>
        </div>
    </div>

    <div class="new-question-input">
        <form id="edit-question-form" action="Backend/questions_add.php" method="post">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="questionText">Question text:</label>
                        <input class="form-control form-control-lg" type="text" name= "questionText" required>
                    </div>
                </div>
            </div>
            <div class="d-flex p-2 justify-content-around">
                <input type="submit" name="addQuestion" class="btn btn-primary add-question-button" value="Save">   
            </div>
        </form>
    </div>

</div>

<?php include "dashboard_footer.php"; ?>