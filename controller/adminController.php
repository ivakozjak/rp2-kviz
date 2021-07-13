<?php
require_once __DIR__ . '/../model/service.class.php';

class AdminController
{
    public function index() //prikaz početne stranice
    {
        require_once __DIR__ . '/../view/admin_index.php';
    }

    public function logout() //odjavljivanje admina
    {
        session_unset();
        session_destroy();
        unset($admin);
        header('Location: home.php');
    }

    public function createQuiz() //prikaz viewa za dodavanje kviza
    {
        require_once __DIR__ . '/../view/create_quiz.php';
    }

    public function addQuiz()
    {
        $category = strtoupper($_POST['kategorija']); //pohrani info iz posta, ovdje je to kategorija kviza
        $marked = $_POST['tipovi'];

        $service = new Service();
        $response = $service->addQuiz($category, $marked); //fja iz service.class.php koja ubacuje kviz u bazu

        if ($response) {
            $message = "Kviz uspješno dodan u bazu!";
        } else {
            $message = "Greška u bazi podataka...";
        }

        sendJSONandExit($message);
    }

    public function createQuestion() //prikaz viewa za dodavanje pitanja
    {
        require_once __DIR__ . '/../view/create_question.php';
    }

    public function addQuestion() //pohranjuje podatke iz posta i poziva fje iz service.class.php za pohranu pitanja i odgovora
    {
        $service = new Service();
        if (isset($_POST['id_quiz']))  $id_quiz = $_POST['id_quiz'];
        if (isset($_POST['id_type']))    $id_type = $_POST['id_type'];
        if (isset($_POST['question']))    $question = $_POST['question'];
        if (isset($_POST['id_question']))    $id_question = $_POST['id_question'];
        if (isset($_POST['is_true1']))    $is_true1 = $_POST['is_true1'];
        if (isset($_POST['is_true2']))    $is_true2 = $_POST['is_true2'];
        if (isset($_POST['is_true3']))    $is_true3 = $_POST['is_true3'];
        if (isset($_POST['is_true4']))    $is_true4 = $_POST['is_true4'];
        if (isset($_POST['answer1']))    $answer1 = $_POST['answer1'];
        if (isset($_POST['answer2']))    $answer2 = $_POST['answer2'];
        if (isset($_POST['answer3']))    $answer3 = $_POST['answer3'];
        if (isset($_POST['answer4']))    $answer4 = $_POST['answer4'];
        if (isset($_POST['answer']))    $answer = $_POST['answer'];

        $response1 = $service->addQuestion($id_quiz, $id_type, $question); //poziva fju za dodavanje pitanja u bazu

        if ($id_type == 1) { //ovisno o tipu pitanja, drugačiji su i odgovori koji se spremaju u bazu
            $response2 = $service->addAnswers1("T", "N", $id_question); //poziva fju iz service.class.php za dodavanje odgovora prvog tipa
        } else if ($id_type == 2) {
            $response2 = $service->addAnswers2(
                $id_question,
                $is_true1,
                $answer1,
                $is_true2,
                $answer2,
                $is_true3,
                $answer3,
                $is_true4,
                $answer4
            );
        } else if ($id_type == 3) $response2 = $service->addAnswers3($id_question, $answer);


        if ($response1 && $response2) {
            $message = "Pitanje i odgovori uspješno dodani u bazu!";
        } else {
            $message = "Greška prilikom dodavanja...";
        }

        sendJSONandExit($message); //vraća ajax odgovor u json formatu
    }

    public function getQuizId() //poziva fju iz service.class.php za dobivanje ID kviza (ovisno u nazivu kviza)
    {
        $service = new Service();
        $name = strtoupper($_GET['name']);
        $response = $service->getQuizId($name);
        if ($response)   sendJSONandExit($response);
        else    sendJSONandExit(0);
    }

    public function getLastQuestionId() //poziva fju iz service.class.php za dobivanje ukupnog broja pitanja u bazi (id=1,2,...,n)
    {
        $service = new Service();
        $response = $service->getLastQuestionId();
        sendJSONandExit($response);
    }
};

function sendJSONandExit($message)
{
    // Kao izlaz skripte pošalji $message u JSON formatu i prekini izvođenje.
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($message);
    flush();
    exit(0);
}
