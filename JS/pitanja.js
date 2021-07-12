var questions = [];
var answers = [];

$(document).ready(function() {
  $(".start_quiz").on("click", startQuiz);
});

var odgovori = [];
startQuiz = function() {

  let quizId = parseInt($(this).val());
  //console.log(quizId);
  $.ajax({
    url: "home.php?rt=quizzes/open",
    data: {
      id: quizId
    },
    method: 'POST',
    success: function(data) {
      questions = data.questions;
      answers = data.answers;
      //console.log(questions, answers);
      showQuestions(questions,answers);

    },
    error: function(xhr, status, errorThrown) {
      alert("Nešto je pošlo po zlu!");
    }
  });
}
  let showQuestions = function(q,a) {
    $("#main_container").remove();
    
    
    $("body").append('<div class = "divPitanja">');

   // $('.div').hide();
    
    for (let i = 0; i < q.length; i++) {
        $(".divPitanja").append("<p class='pom' id = 'pom" + q[i][0] + "'>"+ q[i][3] + "</p>");
      
      let q_id  = q[i][0];
      let q_tip = q[i][2];
      let pom_id = "#pom" + q_id;
    if(q_tip == 1){
      
      $(pom_id).append($('<br>'));
        $(pom_id).append($('<br>'));
        let t = $('<button>');
        let n = $('<button>');
        t.html("Točno").val("T");
        n.html("Netočno").val("N");

        t.click(function() {
          odgovori.push({
          odgovor: $(this).val(),
              broj: q_id,
          });
          //console.log(odgovori);
          t.attr("disabled", true);
          n.attr("disabled", true);
      });
      n.click(function() {
        odgovori.push({
        odgovor: $(this).val(),
            broj: q_id,
        });
        //console.log(odgovori);
        t.attr("disabled", true);
        n.attr("disabled", true);
    });
      $(pom_id).append(t).append($('<br>')).append(n).append($('<br>'));
      
        
     

    }
    if(q_tip == 2){
        $(pom_id).append($('<br>'));
        $(pom_id).append($('<br>'));
        for (let j = 0; j < a.length; j++) {
            if(q_id == a[j][1]){

                let btn = $('<button>');
                btn.click(function() {
                  odgovori.push({
                  odgovor: $(this).html(),
                      broj: q_id,
                  });
                  //console.log(odgovori);
                  $(pom_id + '> button ').attr("disabled", true);
                  
              });
                btn.html(a[j][3]);
                $(pom_id).append(btn).append($('<br>'));
                }
              }
      
    }
    if(q_tip == 3){
        $(pom_id).append($('<br>'));
        $(pom_id).append($('<br>'));
      $(pom_id).append('<input type="text" id="upisi" class="gumbb">').append($('<br>'));
      let btn = $('<button>');
      btn.click(function() {
        odgovori.push({
        odgovor: $(pom_id + '> input').val(),
            broj: q_id,
        });
        //console.log(odgovori);
        btn.attr("disabled", true);

    });
      btn.html("Unesi odgovor");
      $(pom_id).append(btn).append($('<br>'));
    }

    if(i == q.length-1){
    
      let btn = $('<button id="zavrsava">');
      
      btn.click(function() {
        $('.divPitanja').hide();

        console.log($(".welcome").html());
        let rez = 0;
        console.log("kraj");
        
        console.log(q[i][1]);
        for (let i = 0; i < odgovori.length; i++) {
          for (let j = 0; j < a.length; j++) {
            if(odgovori[i]['broj'] === a[j][1]){
              if(odgovori[i]['odgovor'] === a[j][3] && a[j][2] ==='1'){
                  rez++;
            }
          }
          }
        }
        let div = $('<div>');
        div.html("Ukupan rezultat je: " + rez + "/" + q.length);

        let btn = $('<button>');
        btn.html("Pohrani");
        div.append(btn);
        btn.click(function() {
        console.log($(".welcome").html());
  
      });

        $('body').append(div);

        

    });

      btn.html("Završi kviz");
      $(pom_id).append(btn);
    }
    else{
      
      //let btn = $('<button class="provjera1" id="next" onclick="provjeri(event)">');
      //if(q_tip == 3) btn = $('<button').addClass("provjera").click("provjeri(event)");_
     // btn.html("Pohrani odgovor").val('next');
      //$(pom_id).append(btn);
      //$(pom_id).append($('<br>'));
      //$(pom_id).append($('<br>'));
    }
  }

}

function provjeri(event){
    var element = event.currentTarget;
    if (element.className === "provjera" || element.className === "provjera1") {
        element.disabled=true;
  }
};
