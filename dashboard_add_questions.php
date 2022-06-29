<?php include "dashboard_header.php"; ?>

<div class="container-fluid dashboard-content">

    <div class="row">
        <div class="col">
            <h2>Add question:</h2>
        </div>
        <div class="col-2">
            <form action="dashboard_database.php">
                <input type="submit" id="back-button" value="Go back">
            </form>
        </div>
    </div>

    <div class="new-question-input">
        <form id="edit-question-form" action="Backend/questions_add.php" method="post">
            <div class="row justify-content-left">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="questionText">Question:</label>
                        <input class="form-control form-control-lg" type="text" name= "questionText" maxlength="16" required>
                    </div>
                </div>
            </div>
            <div class="d-flex p-2 justify-content-left">
                <input type="submit" name="addQuestion" class="btn btn-primary add-question-button" value="Save">   
            </div>
        </form>
    </div>

</div>

<?php include "dashboard_footer.php"; ?>