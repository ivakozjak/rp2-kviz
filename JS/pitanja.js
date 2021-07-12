var questions = [];
var answers = [];

$(document).ready(function() {
  $(".start_quiz").on("click", startQuiz);
});

startQuiz = function() {

  let quizId = parseInt($(this).val());
  console.log(quizId);
  $.ajax({
    url: "home.php?rt=quizzes/open",
    data: {
      id: quizId
    },
    method: 'POST',
    success: function(data) {
      questions = data.questions;
      answers = data.answers;
      console.log(questions, answers);
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
        let t = $('<button id="gumbb">');
        let n = $('<button id="gumbb">');
        t.html("Točno").val("T");
        n.html("Netočno").val("N");

      
      $(pom_id).append(t).append($('<br>')).append(n).append($('<br>'));
      

    }
    if(q_tip == 2){
        $(pom_id).append($('<br>'));
        $(pom_id).append($('<br>'));
        for (let j = 0; j < a.length; j++) {
            if(q_id == a[j][1]){

                let btn = $('<button id="gumbb">');

                btn.html(a[j][3]);
                $(pom_id).append(btn).append($('<br>'));
                }
              }
    
      
    }
    if(q_tip == 3){
        $(pom_id).append($('<br>'));
        $(pom_id).append($('<br>'));
      $(pom_id).append('<input type="text" id="upisi" class="odg">').append($('<br>'));
      let btn = $('<button id="gumbb">');

      //btn.html("Provjeri");
      //$(pom_id).append(btn).append($('<br>'));
    }

    if(i == q.length-1){
    
      let btn = $('<button id="zavrsava">');

      btn.html("Završi kviz").val('next');
      $(pom_id).append(btn);
    }
    else{
      
      let btn = $('<button id="next">');
        if(q_tip == 3) btn = $('<button id="next">');
      btn.html("Pohrani odgovor").val('next');
      $(pom_id).append(btn);
      $(pom_id).append($('<br>'));
      $(pom_id).append($('<br>'));
    }

  }



}

