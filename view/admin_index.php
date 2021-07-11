<?php require_once __DIR__ . '/header_admin.php'; ?>
<script src="JS/flip.js"></script>
<div class="grid-container">
  <div class="maincontainer">
    <div class="kartica" onclick="flip(event)">
      <div class="kartica-front">
        <img src="app/novi_kviz.jpg" width="240" height="80" class="image_quiz">
      </div>
      <div class="kartica-back">
        <br><br><br><br><br><br>
        <form class="forma" method="post" action="admin.php?rt=admin/createQuiz">
          <label><button class="dodaj" type="submit">Kreiraj novi kviz</button></label>
        </form>
      </div>
    </div>
  </div>
  <div class="maincontainer">
    <div class="kartica" onclick="flip(event)">
      <div class="kartica-front">
        <img src="app/novo_pitanje.jpg" width="240" height="80" class="image_quiz">
      </div>
      <div class="kartica-back">
        <br><br><br><br><br><br>
        <form class="forma" method="post" action="admin.php?rt=admin/addQuestion">
          <label><button class="dodaj" type="submit">Dodaj nova pitanja u postojeći kviz</button></label>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/_footer.php'; ?>