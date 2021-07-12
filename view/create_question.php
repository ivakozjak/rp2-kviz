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
    var quiz_id = 0;
    var last_question_id = 0;
    var is_it_true1 = 0;
    var is_it_true2 = 1;
    $(document).ready(function() {
        $("#btn_potvrdi").on("click", potvrdi);
    });

    let potvrdi = function() { //za hendlanje pitanja
        question = $("#pitanje").val();
        question_type = $("#tip_pitanja").val();
        category = $("#kviz").val();

        console.log(question, question_type, category);
        if (question != "" && category != "") {
            if (question_type === "id_type1") {
                $("#pitanja").remove();
                $("body").append('<div id="' +
                    'tip1"' + '><label>Odgovor 1:<p id="odgovor1">T</p></label><label>Odgovor 2:<p id="odgovor2">N</p></label><label><button class="ulogirajse"' + 'type = "submit"' + 'name="submit"' + 'value="Dodaj"' +
                    'id="btn_dodaj">Dodaj</button></label></div>');
                $("#btn_dodaj").on("click", getQuizId);
            } else if (question_type === "id_type2") {
                $("#pitanja").remove();
                pošalji_tip2();
            } else if (question_type === "id_type3") {
                $("#pitanja").remove();
                $("body").append('<div id="' +
                    'tip2"' + '><label>Tekst pitanja <input type="text" id="pitanje" name="pitanje"></label>' +
                    '<label>Odgovor1 <input type="text" id="answer1" name="answer"></label>' +
                    '<label>Odgovor2 <input type="text" id="answer2" name="answer"></label>' +
                    '<label>Odgovor3 <input type="text" id="answer3" name="answer"></label>' +
                    '<label>Odgovor4 <input type="text" id="answer4" name="answer"></label>' +
                    '<label><button class="ulogirajse"' + 'type = "submit"' + 'name="submit"' + 'value="Dodaj"' +
                    'id="btn_dodaj">Dodaj</button></label></div>');
                pošalji_tip3();
            }
        } else {
            alert("Potrebno je ispuniti sva polja!");
        }
    }

    let pošalji_tip1 = function() {
        /*console.log("kategorija: ", category);
        getQuizId(category);
        console.log("quiz_id: ", quiz_id);
        getLastQuestionId();
        console.log("zadnji id: ", last_question_id);*/
        /*console.log("is_true: ", $("#odgovor1").html());
        if ($("#odgovor1").html() === "T") is_it_true1 = 1;
        console.log("is_it_true1: ", is_it_true1);
        if ($("#odgovor2").html() === "N") is_it_true2 = 0;
        console.log("is_it_true2: ", is_it_true2);

        console.log("answer1: ", $("#odgovor1").html());
        console.log("answer2: ", $("#odgovor2").html());*/
        if (question_type === "id_type1") question_type = 1;
        else if (question_type === "id_type2") question_type = 2;
        else if (question_type === "id_type3") question_type = 3;
        $.ajax({
            url: "admin.php?rt=admin/addQuestion1",
            data: { //šaljemo serveru putem posta informacije za popuniti tablicu "...koju?"
                id_quiz: quiz_id,
                id_type: question_type,
                question: question,
                id_question: last_question_id + 1
                /*is_true1: is_it_true1,
                is_true2: is_it_true2,
                answer1: $("#odgovor1").html(),
                answer2: $("#odgovor2").html()*/
            },
            type: "post",
            dataType: "json",
            success: function(data) {
                alert("Uspješno dodano pitanje i odgovori!");
            },
            error: function(xhr, status, errorThrown) {
                alert("Nije uspjelo dodavanje pitanja ili odgovora!");
            }
        });
    }

    let getQuizId = function() {
        $.ajax({
            url: "admin.php?rt=admin/getQuizId",
            data: { //šaljemo serveru putem posta informacije za popuniti tablicu kviz_pitanja i kviz_odgovori
                name: category
            },
            type: "get",
            dataType: "json",
            success: function(data) {
                quiz_id = data;
                console.log("quiz_id: ", quiz_id);
                if (quiz_id) getLastQuestionId();
                else alert("Nepostojoća kategorija kviza!");
            },
            error: function(xhr, status, errorThrown) {
                alert("Nije uspjelo dohvaćanje ID kviza!");
            }
        });
    }

    let getLastQuestionId = function() {
        $.ajax({
            url: "admin.php?rt=admin/getLastQuestionId",
            type: "get",
            dataType: "json",
            success: function(data) {
                last_question_id = parseInt(data);
                console.log("last_question_id: ", last_question_id);
                pošalji_tip1();
            },
            error: function(xhr, status, errorThrown) {
                alert("Nije uspjelo dohvaćanje ID-a zadnjeg pitanja!");
            }
        });
    }
</script>
<?php
require_once __DIR__ . '/_footer.php';
