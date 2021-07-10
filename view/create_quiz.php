<?php
require_once __DIR__ . '/header_admin.php';
?>

<form class="forma" method="post" action="admin.php?rt=admin/addQuiz">
    <label>Kategorija <input type="text" name="category"></label>
    <label><input class="ulogirajse" type="submit" value="Dodaj" name="submit"></label>
</form>

<?php
require_once __DIR__ . '/_footer.php';
