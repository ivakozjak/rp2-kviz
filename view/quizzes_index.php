<?php require_once __DIR__ . '/_header.php';
?>
<div class="grid-container">
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
          <button class="ulogirajse" type="submit" name="submit" value="<?php echo $quiz->id; ?>" id="btn_start">Odaberi</button>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
  <script src="JS/flip.js"></script>
  <script>
    var questions = [];
    var answers = [];

    $(document).ready(function() {
      $("#btn_start").on("click", startQuiz);
    });

    startQuiz = function() {

      let quizId = parseInt($("#btn_start").val());
      console.log(quizId);
      $.ajax({
        url: "home.php?rt=quizzes/open",
        data: {
          id: quizId
        },
        method: 'POST',
        success: function(data) {
          console.log(data);
          questions = data.questions;
          answers = data.answers;
          console.log(questions, answers);
        },
        error: function(xhr, status, errorThrown) {
          alert("Nešto je pošlo po zlu!");
        }
      });

      console.log(questions, answers);
    }
  </script>
</div>
</body>

</html>
<?php

require_once  __DIR__ . '/_footer.php';
