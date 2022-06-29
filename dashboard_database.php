<?php 
      include_once "dashboard_header.php";
      include_once "Backend/questions.php";
?>

<div class="container-fluid dashboard-content">
  <div class="row">
    <div class="col-3">
      <form action="dashboard_add_questions.php">
        <input style="margin-bottom:20px;" class="product-edit-button" type="submit" value="Add question" id="add-question">
      </form>
    </div>
  </div>
    <div class="row">
        <div class="col-5">
        <table class="table">
          <thead>
            <tr>
              <th>Question</th>
            </tr>
            <tr>
            </tr>
          </thead>
          <tbody>
          <?php $questions = $_questions->getDBdata();
            while($question = $questions->fetch()) :?>
              <tr>
                <form id="edit-form" action="dashboard_edit_question.php" method="post">
                  <th style="display: none;" scope="row">
                    <input type="hidden" name="questionId" value="<?= htmlspecialchars($question['questionId'])?>">
                  </th>
                  <td class="align-left">
                    <input type="hidden" name="questionText" value="<?= htmlspecialchars($question['questionText'])?>">
                    <?= htmlspecialchars($question['questionText']) ?>
                  </td>
                  <td class="align-right">
                    <input class="question-edit-button" type="submit" name="submit" value="Edit" id="question-edit-1">
                  </td>
                </form>
              </tr>
          <?php 
            endwhile; ?>
          </tbody>
        </table>
        
      </div>
      </div>
      
</div>

<?php include "dashboard-footer.php";?>