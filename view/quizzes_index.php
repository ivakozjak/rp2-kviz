<?php require_once __DIR__ . '/_header.php';
?>
<div class="grid-container" id="main_container">
  <?php
  $i = 1;
  foreach ($quizList as $quiz) {
    $name = strtolower($quiz->name); //tako je spremljeno u direktoriju "app"
    $path = dirname($_SERVER['PHP_SELF']);
  ?>
    <div class="maincontainer">
      <div class="kartica" onclick="flip(event)">
        <div class="kartica-front">
          <?php
          if (file_exists('app/' . $name . '.jpg'))
            echo '<img src="' . $path . '/app/' . $name . '.jpg" width="240" height="80" class="image_quiz">' . '<p>' . $quiz->name . '</p>';
          else echo '<br><br><br><br><br><br><p>' . $quiz->name . '</p>';
          echo "Redni broj kviza: $i";
          ?>
        </div>
        <div class="kartica-back"><br><b>Tipovi pitanja:</b><br><br>

          <?php
          if ($quiz->is_type1 === '1') {
            echo "Točno/Netočno";
            echo "<br><br>";
          }
          if ($quiz->is_type2 === '1') {
            echo "Odaberi";
            echo "<br><br>";
          }
          if ($quiz->is_type3 === '1') {
            echo "Popuni";
            echo "<br><br>";
          }
          ?>
          <button class="start_quiz" type="submit" name="submit" value="<?php echo $quiz->id; ?>">Odaberi</button>
        </div>
      </div>
    </div>
  <?php
    $i++;
  }
  ?>
</div>
<script src="JS/flip.js"></script>
<script src="JS/pitanja.js"></script>
<?php

//require_once '_footer.php';
