var question = "";
var question_type = ""; //jedan od 3 definirana tipa
var category = "";
var quiz_id = 0;
var last_question_id = 0; //zadnje pitanje u tablici pitanja
var is_it_true1 = 0; //označava da je prvi od 4 odgovora unesenih u formi po defaultu krivi
var is_it_true2 = 0; //analogno
var is_it_true3 = 0; //analogno
var is_it_true4 = 0; //analogno

$(document).ready(function () {
    $("#btn_potvrdi").on("click", potvrdi);
});

let potvrdi = function () { //za hendlanje pitanja
    question = $("#pitanje").val();
    question_type = $("#tip_pitanja").val();
    category = $("#kviz").val();

    console.log(question, question_type, category);
    if (question != "" && category != "") { //dodaj odgovarajuću formu za unos odgovora ovisno o tipu pitanja, ako je uneseno pitanje i kategorija
        if (question_type === "id_type1") {
            $("#pitanja").remove();
            $("body").append('<div id="' +
                'tip1"' + '><label>Unesite "T" ili "N" za točnost/netočnost.<input type="text" id="tocnost" name="tocnost"></label><label><button class="ulogirajse"' + 'type = "submit"' + 'name="submit"' + 'value="Dodaj"' +
                'id="btn_dodaj1">Dodaj</button></label></div>');
            $("#btn_dodaj1").on("click", getQuizId); //prva fja u postupku dodavanja u bazu, prvo daje id kviza
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
            $("body").append('<div id="' +
                'tip3">' +
                '<label>Odgovor <input type="text" id="only_answer" name="only_answer"></label>' +
                '<label><button class="ulogirajse"' + 'type = "submit"' + 'name="submit"' + 'value="Dodaj"' +
                'id="btn_dodaj3">Dodaj</button></label></div>');
            $("#btn_dodaj3").on("click", getQuizId);
        }
    } else {
        alert("Potrebno je ispuniti sva polja!");
    }
}

let pošalji_tip1 = function () {
    $.ajax({
        url: "admin.php?rt=admin/addQuestion", //ruta kontrolera
        data: { //šaljemo serveru putem posta informacije za popuniti tablice kviz_pitanja i kviz_odgovori
            id_quiz: quiz_id,
            id_type: question_type,
            question: question,
            id_question: last_question_id + 1,
            answer: $("#tocnost").val()
        },
        type: "post",
        dataType: "json",
        success: function (data) {
            alert("Uspješno dodano pitanje i odgovori!");
            window.location.replace("admin.php?rt=admin/createQuestion");
        },
        error: function (xhr, status, errorThrown) {
            alert("Nije uspjelo dodavanje pitanja ili odgovora!");
            window.location.replace("admin.php?rt=admin/createQuestion");
        }
    });
}

let pošalji_tip2 = function () {
    let točan_odg = parseInt($("#točan_odg").val());
    if (točan_odg === 1) is_it_true1 = 1;
    else if (točan_odg === 2) is_it_true2 = 1;
    else if (točan_odg === 3) is_it_true3 = 1;
    else if (točan_odg === 4) is_it_true4 = 1;

    $.ajax({
        url: "admin.php?rt=admin/addQuestion", //ruta kontrolera
        data: { //šaljemo serveru putem posta informacije za popuniti tablice kviz_pitanja i kviz_odgovori
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
        success: function (data) {
            alert("Uspješno dodano pitanje i odgovori!");
            window.location.replace("admin.php?rt=admin/createQuestion");
        },
        error: function (xhr, status, errorThrown) {
            alert("Nije uspjelo dodavanje pitanja ili odgovora!");
            window.location.replace("admin.php?rt=admin/createQuestion");
        }
    });
}

let pošalji_tip3 = function () {
    console.log("quiz_id: ", quiz_id);
    console.log("question_type: ", question_type);
    console.log("question: ", question);
    console.log("last_question_id+1: ", last_question_id + 1);
    console.log("answer: ", $("#only_answer").val());
    $.ajax({
        url: "admin.php?rt=admin/addQuestion",
        data: { //šaljemo serveru putem posta informacije za popuniti tablice kviz_pitanja i kviz_odgovori
            id_quiz: quiz_id,
            id_type: question_type,
            question: question,
            id_question: last_question_id + 1,
            answer: $("#only_answer").val()
        },
        type: "post",
        dataType: "json",
        success: function (data) {
            alert("Uspješno dodano pitanje i odgovor!");
            window.location.replace("admin.php?rt=admin/createQuestion");
        },
        error: function (xhr, status, errorThrown) {
            alert("Nije uspjelo dodavanje pitanja ili odgovora!");
            window.location.replace("admin.php?rt=admin/createQuestion");
        }
    });
}

let getQuizId = function () {//prvo dohvati id kviza za kojeg se dodaje pitanje i odgovori
    $.ajax({
        url: "admin.php?rt=admin/getQuizId", //ruta kontrolera
        data: { 
            name: category
        },
        type: "get",
        dataType: "json",
        success: function (data) {
            quiz_id = data;
            if (quiz_id) getLastQuestionId(); //pronađi zadnje pitanje da se mogu dodati odgovori na to zadnje dodano pitanje
            else {
                alert("Nepostojeća kategorija kviza!");
                window.location.replace("admin.php?rt=admin/createQuestion");
            }
        },
        error: function (xhr, status, errorThrown) {
            alert("Nije uspjelo dohvaćanje ID kviza!");
        }
    });
}

let getLastQuestionId = function () {
    $.ajax({
        url: "admin.php?rt=admin/getLastQuestionId",
        type: "get",
        dataType: "json",
        success: function (data) {
            last_question_id = parseInt(data);
            if (question_type === "id_type1") {
                if($("#tocnost").val() == "" || ($("#tocnost").val() != "T" && $("#tocnost").val() != "N")){
                    alert("Neispravan unos!");
                    window.location.replace("admin.php?rt=admin/createQuestion");
                }else{
                    question_type = 1;
                    pošalji_tip1();
                }
            } else if (question_type === "id_type2") {
                question_type = 2;
                if ($("#answer1").val() == "" || $("#answer2").val() == "" || $("#answer3").val() == "" || $("#answer4").val() == "" ||
                    $("#točan_odg").val() == "") {
                    alert("Sva polja moraju biti popunjena!");
                    window.location.replace("admin.php?rt=admin/createQuestion");
                } else if (isNaN(parseInt($("#točan_odg").val()))) {
                    alert("Točan odgovor treba biti broj!");
                    window.location.replace("admin.php?rt=admin/createQuestion");
                } 
                else if (parseInt($("#točan_odg").val()) > 4 || parseInt($("#točan_odg").val()) < 1){
                    alert("Točan odgovor treba biti u rasponu od 1 do 4!");
                    window.location.replace("admin.php?rt=admin/createQuestion");
                }else {
                    pošalji_tip2();
                }

            } else if (question_type === "id_type3") {               
                question_type = 3;              
                if ($("#only_answer").val() == "") {
                    alert("Nije unesen odgovor!");
                    window.location.replace("admin.php?rt=admin/createQuestion");
                } else {
                    pošalji_tip3();
                }
            }
        },
        error: function (xhr, status, errorThrown) {
            alert("Nije uspjelo dohvaćanje ID-a zadnjeg pitanja!");
        }
    });
}