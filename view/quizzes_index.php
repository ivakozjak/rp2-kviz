<?php require_once __DIR__ . '/_header.php';
?>
<div class="grid-container" id="main_container">
  <?php
  foreach ($quizList as $quiz) {
    $name = strtolower($quiz->name); //tako je spremljeno u mapi app
    $path = dirname($_SERVER['PHP_SELF']);
  ?>
    <div class="maincontainer">
      <div class="kartica" onclick="flip(event)">
        <div class="kartica-front">
          <?php
          if (file_exists('app/' . $name . '.jpg'))
            echo '<img src="' . $path . '/app/' . $name . '.jpg" width="240" height="80" class="image_quiz">' . '<p>' . $quiz->name . '</p>';
          else echo '<br><br><br><br><br><br><p>' . $quiz->name . '</p>';
          ?>
        </div>
        <div class="kartica-back">Tipovi pitanja:

          <?php
          if ($quiz->is_type1 === '1') {
            echo "Tocno/Netocno";
            echo "<br>";
          }
          if ($quiz->is_type2 === '1') {
            echo "Odaberi";
            echo "<br>";
          }
          if ($quiz->is_type3 === '1') {
            echo "Popuni";
            echo "<br>";
          }
          ?>
          <button class="start_quiz" type="submit" name="submit" value="<?php echo $quiz->id; ?>">Odaberi</button>
        </div>
      </div>
    </div>
  <?php
  }
  ?>

</div>
<script src="JS/flip.js"></script>
<script>
  var questions = [];
  var answers = [];

  $(document).ready(function() {
<<<<<<< Updated upstream
    $(".start_quiz").on("click", startQuiz);
=======
    $("#btn_start").on("click", startQuiz);
>>>>>>> Stashed changes
  });

  startQuiz = function() {

<<<<<<< Updated upstream
    let quizId = parseInt($(this).val());
=======
    let quizId = parseInt($("#btn_start").val());
>>>>>>> Stashed changes
    console.log(quizId);
    $.ajax({
      url: "home.php?rt=quizzes/open",
      data: {
        id: quizId
      },
      method: 'POST',
      success: function(data) {
        questions = data.questions;
        answers = data.answers;
        console.log(questions, answers);
        showQuestions(questions);

      },
      error: function(xhr, status, errorThrown) {
        alert("Nešto je pošlo po zlu!");
      }
    });

    let showQuestions = function(arr) {
      $("#main_container").remove();
      $("body").append("<p>" + arr + "<p>");
    }
  }
</script>
</body>

</html>
<?php

require_once  __DIR__ . '/_footer.php';