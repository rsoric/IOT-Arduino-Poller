<?php include "dashboard_header.php"; ?>

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

<script type="text/javascript">
    // add row
    $("#addQuestion").click(function() {
        var html = '';
        html += '<div id="inputQuestionRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="title[]" class="form-control m-input" placeholder="Question text" autocomplete="off" maxlength="16">';
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