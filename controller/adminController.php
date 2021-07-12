<?php
require_once __DIR__ . '/../model/service.class.php';

class AdminController
{
    public function index()
    {
        require_once __DIR__ . '/../view/admin_index.php';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        unset($admin);
        header('Location: home.php');
    }

    public function createQuiz()
    {
        require_once __DIR__ . '/../view/create_quiz.php';
    }

    public function addQuiz()
    {
        $category = strtoupper($_POST['kategorija']);
        $marked = $_POST['tipovi'];

        $service = new Service();
        $response = $service->addQuiz($category, $marked);

        if ($response) {
            $message = "Kviz uspješno dodan u bazu!";
        } else {
            $message = "Greška u bazi podataka...";
        }

        sendJSONandExit($message);
    }

    public function createQuestion()
    {
        require_once __DIR__ . '/../view/create_question.php';
    }

    public function addQuestion()
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

        $response1 = $service->addQuestion($id_quiz, $id_type, $question);

        if ($id_type == 1) {
            $response2 = $service->addAnswers1("T", "N", $id_question);
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

        sendJSONandExit($message);
    }

    public function getQuizId()
    {
        $service = new Service();
        $name = strtoupper($_GET['name']);
        $response = $service->getQuizId($name);
        if ($response)   sendJSONandExit($response);
        else    sendJSONandExit(0);
    }

    public function getLastQuestionId()
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
