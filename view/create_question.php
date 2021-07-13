<?php
require_once __DIR__ . '/header_admin.php';
?>
<div id="pitanja">
    <label><b>Pitanje</b> <input type="text" id="pitanje"></label>
    <br>
    <label>Tip pitanja
        <select name="tip_pitanja" id="tip_pitanja">Tip pitanja
            <option value="id_type1" selected>Točno/netočno</option>
            <option value="id_type2">Odaberi</option>
            <option value="id_type3">Popuni</option>
        </select></label>
    <br>
    <label>Za kviz(kategorija) <input type="text" id="kviz"></label>
    <br>
    <label><button type="submit" name="submit" value="Potvrdi" id="btn_potvrdi">Potvrdi</button></label>
</div>

<script src="JS/dodaj_pitanje_i_odg.js"></script>

<?php
require_once __DIR__ . '/_footer.php';
