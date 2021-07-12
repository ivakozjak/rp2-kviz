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
    $(".start_quiz").on("click", startQuiz);
  });

  startQuiz = function() {

    let quizId = parseInt($(this).val());
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
        showQuestions(questions,answers);

      },
      error: function(xhr, status, errorThrown) {
        alert("Nešto je pošlo po zlu!");
      }
    });
  }
    let showQuestions = function(q,a) {
      $("#main_container").remove();
      
      
      $("body").append('<div class = "divPitanja">');

     // $('.div').hide();
      
      for (let i = 0; i < q.length; i++) {
        $(".divPitanja").append("<p class='pom' id = 'pom" + q[i][0] + "'>" + q[i][3] + "</p>");
        
        let q_id  = q[i][0];
        let q_tip = q[i][2];
        let pom_id = "#pom" + q_id;
      if(q_tip == 1){
        
        
        let t = $('<button>');
        let n = $('<button>');
        t.html("Tocno").val("T");
        n.html("Netocno").val("N");

        
        $(pom_id).append(t).append(n);
        

      }
      if(q_tip == 2){
          for (let j = 0; j < a.length; j++) {
              if(q_id == a[j][1]){

                  let btn = $('<button>');

                  btn.html(a[j][3]);
                  $(pom_id).append(btn);
                  }
                }
      
        
      }
      if(q_tip == 3){
       
        $(pom_id).append('<input type="text" class="odg">');
        let btn = $('<button>');

        btn.html("Provjeri");
        $(pom_id).append(btn);
      }

      if(i == q.length-1){
      
        let btn = $('<button>');

        btn.html("End quiz").val('next');
        $(pom_id).append(btn);
      }
      else{
        
        let btn = $('<button>');

        btn.html("Next").val('next');
        $(pom_id).append(btn);
      }

     
    }

  

  }

  

  
</script>
</body>

</html>
<?php

require_once  __DIR__ . '/_footer.php';