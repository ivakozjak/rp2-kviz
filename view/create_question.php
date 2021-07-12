<?php
require_once __DIR__ . '/header_admin.php';
?>
<div id="pitanja">
    <label>Pitanje <input type="text" id="pitanje"></label>
    <label>Tip pitanja
        <select name="tip_pitanja" id="tip_pitanja">Tip pitanja
            <option value="id_type1" selected>Točno/netočno</option>
            <option value="id_type2">Odaberi</option>
            <option value="id_type3">Popuni</option>
        </select></label>

    <label>Za kviz(kategorija) <input type="text" id="kviz"></label>
    <label><button class="ulogirajse" type="submit" name="submit" value="Potvrdi" id="btn_potvrdi">Potvrdi</button></label>
</div>
<script>
    var question = "";
    var question_type = "";
    var category = "";
    $(document).ready(function() {
        $("#btn_potvrdi").on("click", potvrdi);
    });

    let potvrdi = function() {
        question = $("#pitanje").val();
        question_type = $("#tip_pitanja").val();
        category = $("#kviz").val();

        console.log(question, question_type, category);

        if (question != "" && category != "") {
            if (question_type === "id_type1") {
                $("#pitanja").remove();
                $("body").append('<div id="' +
                    'tip1"' + '><label>Odgovor 1:<p id="odgovor1">T</p></label><label>Odgovor 2:<p id="odgovor2">N</p></label><label><button class="ulogirajse"' + 'type = "submit"' + 'name="submit"' + 'value="Dodaj"' +
                    'id="btn_dodaj"+onclick="sendQuestionData">Dodaj</button></label></div>');
                    console.log($("#odgovor2").html());

           
        
        } 
            }
            else if (question_type === "id_type2") {
                $("#pitanja").remove();
                $("body").append('<div id="' +
                    'tip2"' + '><label>Tekst pitanja <input type="text" id="pitanje" name="pitanje"></label>'
                    +'<label>Odgovor1 <input type="text" id="answer1" name="answer"></label>'+
                    '<label>Odgovor2 <input type="text" id="answer2" name="answer"></label>'
                    +'<label>Odgovor3 <input type="text" id="answer3" name="answer"></label>'
                    +'<label>Odgovor4 <input type="text" id="answer4" name="answer"></label>'+
                    '<label><button class="ulogirajse"' + 'type = "submit"' + 'name="submit"' + 'value="Dodaj"' +
                    'id="btn_dodaj"+onclick="sendQuestionData">Dodaj</button></label></div>');
            
            
            
            }
            else if (question_type === "id_type3") {
                $("#pitanja").remove();
                $("body").append('<div id="' +
                    'tip2"' + '><label>Tekst pitanja <input type="text" id="pitanje" name="pitanje"></label>'
                    +'<label>Odgovor1 <input type="text" id="answer1" name="answer"></label>'+
                    '<label>Odgovor2 <input type="text" id="answer2" name="answer"></label>'
                    +'<label>Odgovor3 <input type="text" id="answer3" name="answer"></label>'
                    +'<label>Odgovor4 <input type="text" id="answer4" name="answer"></label>'+
                    '<label><button class="ulogirajse"' + 'type = "submit"' + 'name="submit"' + 'value="Dodaj"' +
                    'id="btn_dodaj"+onclick="sendQuestionData">Dodaj</button></label></div>');
            }
            
        else {
            alert("Potrebno je ispuniti sva polja!");
        }

    }

    sendQuestionData = function() {
        question_type = $("#tip_pitanja").val();
        if (question_type === "id_type1")
        
            $.ajax({
                url: "admin.php?rt=admin/addQuestion",
                data: { //šaljemo serveru putem posta informacije za popuniti tablicu "kviz_odgovori"
                    kategorija: $("#kviz").val(),
                    odgovor1: $("#odgovor1").html(),
                    odgovor2: $("#odgovor2").html(),

                },
                type: "post",
                dataType: "json",
                success: function(data) {
                    alert("Uspješno dodano pitanje u kviz!");
                },
                error: function(xhr, status, errorThrown) {
                    alert("Nije uspjelo kreiranje pitanja!");
                }

    })
    
    else if (question_type === "id_type2")
        $.ajax({
                url: "admin.php?rt=admin/addQuestion",
                data: { //šaljemo serveru putem posta informacije za popuniti tablicu "kviz_odgovori"
                    kategorija: $("#kviz").val(),
                    odgovor1: $("#answer1").html(),
                    odgovor2: $("#answer2").html(),
                    odgovor3: $("#answer3").html(),
                    odgovor4: $("#answer4").html(),

                },
                type: "post",
                dataType: "json",
                success: function(data) {
                    alert("Uspješno dodano pitanje u kviz!");
                },
                error: function(xhr, status, errorThrown) {
                    alert("Nije uspjelo kreiranje pitanja!");
                }

    })

   else if (question_type === "id_type3")
    $.ajax({
                url: "admin.php?rt=admin/addQuestion",
                data: { //šaljemo serveru putem posta informacije za popuniti tablicu "kviz_odgovori"
                    kategorija: $("#kviz").val(),
                    odgovor1: $("#answer1").html(),
                    odgovor2: $("#answer2").html(),
                    odgovor3: $("#answer3").html(),
                    odgovor4: $("#answer4").html(),

                },
                type: "post",
                dataType: "json",
                success: function(data) {
                    alert("Uspješno dodano pitanje u kviz!");
                },
                error: function(xhr, status, errorThrown) {
                    alert("Nije uspjelo kreiranje pitanja!");
                }

    })
    }
</script>
<?php
require_once __DIR__ . '/_footer.php';