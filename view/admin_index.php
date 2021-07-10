<?php require_once __DIR__ . '/header_admin.php'; ?>

<form class="forma" method="post" action="admin.php?rt=admin/createQuiz">
    <label><button class="dodaj" type="submit">Kreiraj novi kviz</button></label>
</form>
<form class="forma" method="post" action="admin.php?rt=admin/addQandA">
    <label><button class="dodaj" type="submit">Dodaj nova pitanja u postojeći kviz</button></label>
</form>

<?php require_once __DIR__ . '/_footer.php'; ?>