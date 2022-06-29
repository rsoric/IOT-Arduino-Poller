<?php include_once "dashboard_header.php";
      include_once "Backend/questions.php";
      include_once "Backend/functions.php";

    if(isset($_POST['submit']))
    {
        $questionId = sanitizeInput($_POST["questionId"]);
        $questionText = sanitizeInput($_POST["questionText"]);
    }
?>

<div class="container-fluid dashboard-content">
    <div class="row">
        <div class="col">
            <h3>Edit question:</h3>
        </div>
        <div class="col-2">
            <form action="dashboard_database.php">
                <input type="submit" id="back-button" value="Go back" />
            </form>
        </div>
    </div>

    <div class="new-product-input">
        <form id="edit-question-form" action="Backend/questions_edit.php" method="post">
            <div class="row justify-content-left">
                <div class="col-md-3">
                    <div class="form-group">
                        <label hidden for="questionId">Id Number:</label>
                        <input hidden class="form-control form-control-lg" type="text" name="questionId" value="<?php echo $questionId?>">
                        <label for="questionText">Question Text:</label>
                        <input class="form-control form-control-lg" type="text" name="questionText" value="<?php echo $questionText?>" required>
                    </div>
                </div>
            </div>
            <div class="d-flex p-2 justify-content-around">

                    <input type="submit" name="delete" class="btn btn-primary delete-question-button" value="Delete question">


                    <input type="submit" name="update" class="btn btn-primary add-question-button" value="Save">   

            </div>
        </form>
    </div>
</div>

<?php include "dashboard_footer.php";?>