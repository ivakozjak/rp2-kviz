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
          echo '<img src="' . $path . '/app/' . $name . '.jpg" width="240" height="80" class="image_quiz">' . '<p>' . $quiz->name . '</p>';
          ?>
        </div>
        <div class="kartica-back">Tipovi pitanja:
        
        
        <form action="home.php?rt=quizzes/open" method="post">
        <?php
          if($quiz->is_type1 === '1'){
            echo "Tocno/Netocno";
            echo "<br>";}
          if($quiz->is_type2 === '1')
          {
            echo "Odaberi";
            echo "<br>";
          }
          if($quiz->is_type3 === '1')
          {
            echo "Popuni";
            echo "<br>";
          }
          ?> 
        <input type="submit" value="Odaberi">
</form>


        </div>
      </div>
    </div>
  <?php
  }
  ?>
  <script src="JS/flip.js"></script>
</div>
</body>

</html>
<?php

require_once __DIR__ . '/_footer.php';
