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

<script>
    $(document).ready(function() {
        $("#btn_dodaj").on("click", sendQuizData);
    });

    sendQuizData = function() {
        let marked = []; //označene vrijednosti u checkboxu

        $("input:checked").each(function() { //u polje "marked" ubaci označene tipove
            marked.push($(this).val());
        });

        console.log("kategorija:", $("#category").val());
        console.log("označeno:", marked);

        if ($("#category").val() === "") {
            alert("Kviz treba imati kategoriju(naziv)!");
        } else if (marked.length === 0) {
            alert("Treba biti odabrana barem jedna vrsta pitanja.");
        } else {
            $.ajax({
                url: "admin.php?rt=admin/addQuiz",
                data: { //šaljemo serveru putem posta informacije za popuniti tablicu "kviz_kvizovi"
                    kategorija: $("#category").val(),
                    tipovi: marked
                },
                type: "post",
                dataType: "json",
                success: function(data) {
                    alert("Uspješno dodan kviz u bazu! Sad možete dodavati pitanja.");
                    window.location.replace("admin.php?rt=admin/createQuestion");
                },
                error: function(xhr, status, errorThrown) {
                    alert("Nije uspjelo kreiranje kviza!");
                }
            });
        }
    }
</script>
<?php
require_once __DIR__ . '/_footer.php';
