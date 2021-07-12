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
    var is_it_true2 = 0;
    var is_it_true3 = 0;
    var is_it_true4 = 0;

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
                    'id="btn_dodaj1">Dodaj</button></label></div>');
                $("#btn_dodaj1").on("click", getQuizId);
            } else if (question_type === "id_type2") {
                $("#pitanja").remove();
                $("body").append('<div id="' +
                    'tip2">' +
                    '<label>Odgovor 1 <input type="text" id="answer1" name="answer1"></label>' +
                    '<label>Odgovor 2 <input type="text" id="answer2" name="answer2"></label>' +
                    '<label>Odgovor 3 <input type="text" id="answer3" name="answer3"></label>' +
                    '<label>Odgovor 4 <input type="text" id="answer4" name="answer4"></label>' +
                    '<label>Točan odgovor <input type="text" id="točan_odg" name="točan_odg" placeholder="Upisati broj odgovora"></label>' +
                    '<label><button class="ulogirajse"' + 'type = "submit"' + 'name="submit"' + 'value="Dodaj"' +
                    'id="btn_dodaj2">Dodaj</button></label></div>');
                $("#btn_dodaj2").on("click", getQuizId);
            } else if (question_type === "id_type3") {
                $("#pitanja").remove();
            }
        } else {
            alert("Potrebno je ispuniti sva polja!");
        }
    }

    let pošalji_tip1 = function() {
        $.ajax({
            url: "admin.php?rt=admin/addQuestion",
            data: { //šaljemo serveru putem posta informacije za popuniti tablicu "...koju?"
                id_quiz: quiz_id,
                id_type: question_type,
                question: question,
                id_question: last_question_id + 1
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

    let pošalji_tip2 = function() {
        let točan_odg = parseInt($("#točan_odg").val());
        if (točan_odg === 1) is_it_true1 = 1;
        else if (točan_odg === 2) is_it_true2 = 1;
        else if (točan_odg === 3) is_it_true3 = 1;
        else if (točan_odg === 4) is_it_true4 = 1;

        $.ajax({
            url: "admin.php?rt=admin/addQuestion",
            data: { //šaljemo serveru putem posta informacije za popuniti tablicu "...koju?"
                id_quiz: quiz_id,
                id_type: question_type,
                question: question,
                id_question: last_question_id + 1,
                is_true1: is_it_true1,
                is_true2: is_it_true2,
                is_true3: is_it_true3,
                is_true4: is_it_true4,
                answer1: $("#answer1").val(),
                answer2: $("#answer2").val(),
                answer3: $("#answer3").val(),
                answer4: $("#answer4").val()
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
                if (quiz_id) getLastQuestionId();
                else {
                    alert("Nepostojeća kategorija kviza!");
                    window.location.replace("admin.php?rt=admin/createQuestion");
                }
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
                if (question_type === "id_type1") {
                    question_type = 1;
                    pošalji_tip1();
                } else if (question_type === "id_type2") {
                    question_type = 2;
                    if ($("#answer1").val() == "" || $("#answer2").val() == "" || $("#answer3").val() == "" || $("#answer4").val() == "" ||
                        $("#točan_odg").val() == "") {
                        alert("Sva polja moraju biti popunjena!");
                        window.location.replace("admin.php?rt=admin/createQuestion");
                    } else if (isNaN(parseInt($("#točan_odg").val()))) {
                        alert("Točan odgovor treba biti broj!");
                        window.location.replace("admin.php?rt=admin/createQuestion");
                    } else {
                        pošalji_tip2();
                    }

                } else if (question_type === "id_type3") {
                    question_type = 3;
                    pošalji_tip3();
                }
            },
            error: function(xhr, status, errorThrown) {
                alert("Nije uspjelo dohvaćanje ID-a zadnjeg pitanja!");
            }
        });
    }
</script>
<?php
require_once __DIR__ . '/_footer.php';
