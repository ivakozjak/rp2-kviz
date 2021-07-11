<?php
require_once __DIR__ . '/header_admin.php';
?>
<div>
    <label>Kategorija <input type="text" id="category" name="category"></label>
    <p>Tipovi pitanja </p>
    <input type="checkbox" id="type1" name="types[]" value="is_type1">
    <label for="type1"> Točno/netočno</label><br>
    <input type="checkbox" id="type2" name="types[]" value="is_type2">
    <label for="type2"> Odaberi odgovor</label><br>
    <input type="checkbox" id="type3" name="types[]" value="is_type3">
    <label for="type3"> Upiši odgovor</label><br>
    <label><button class="ulogirajse" type="submit" name="submit" value="Dodaj" id="btn_dodaj">Dodaj</button></label>
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

        $.ajax({
            url: "admin.php?rt=admin/addQuiz",
            data: {
                kategorija: $("#category").val(),
                tipovi: marked
            },
            type: "post",
            dataType: "json",
            success: function(data) {
                alert(data);
            },
            error: function(xhr, status, errorThrown) {
                alert("nije uspjelo!");
            }
        });
    }
</script>
<?php
require_once __DIR__ . '/_footer.php';
