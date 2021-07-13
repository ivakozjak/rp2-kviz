<?php
require_once __DIR__ . '/header_admin.php';
?>
<div id="kvizovi">
    <label>Kategorija <input type="text" id="category" name="category"></label>
    <br>
    <p><b>Tipovi pitanja</b> </p>
    <input type="checkbox" id="type1" name="types[]" value="is_type1">
    <label for="type1"> Točno/netočno</label><br>
    <input type="checkbox" id="type2" name="types[]" value="is_type2">
    <label for="type2"> Odaberi odgovor</label><br>
    <input type="checkbox" id="type3" name="types[]" value="is_type3">
    <label for="type3"> Upiši odgovor</label><br>
    <label><button type="submit" name="submit" value="Dodaj" id="btn_dodaj">Dodaj</button></label>
</div>
<script src="JS/dodaj_kviz.js"></script>
<?php
require_once __DIR__ . '/_footer.php';
