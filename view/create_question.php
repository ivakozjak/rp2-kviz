<?php
require_once __DIR__ . '/header_admin.php';
?>
<div>
    <label>Tekst pitanja <input type="text" id="pitanje" name="pitanje"></label>
    <label>Odgovor1 <input type="text" id="answer1" name="answer"></label>
    <label>Odgovor2 <input type="text" id="answer2" name="answer"></label>
    <label>Odgovor3 <input type="text" id="answer3" name="answer"></label>
    <label>Odgovor4 <input type="text" id="answer4" name="answer"></label>

    <label><button class="ulogirajse" type="submit" name="submit" value="Dodaj" id="btn_dodaj">Dodaj</button></label>
</div>

<script>
    $(document).ready(function() {
        $("#btn_dodaj").on("click", sendQuestionData);
    });

    sendQuestionData = function() {
        let odgovor = []; 

       /* $("input:checked").each(function() {  
            odgovor.push($(this).val());
        });
        */
        console.log("pitanje:", $("#pitanje").val());

        if ($("#pitanje").val() === "") {
            alert("Pitanje treba imati tekst!");
        } else if (odgovor.length !== 4) {
            alert("Treba biti uneseno 4 odgovora.");
        } else {
            $.ajax({
                url: "admin.php?rt=admin/addQuestion",
                data: { //šaljemo serveru putem posta informacije za popuniti tablicu "kviz_kvizovi"
                    pitanje: $("#pitanje").val(),
                    odgovori: odgovor
                },
                type: "post",
                dataType: "json",
                success: function(data) {
                    alert("Uspješno dodano pitanje u bazu!");
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
