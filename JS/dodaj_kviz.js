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
            url: "admin.php?rt=admin/addQuiz", //ruta za kontroler
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