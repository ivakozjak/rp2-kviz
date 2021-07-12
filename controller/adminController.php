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

    public function addQuestion1()
    {

        $service = new Service();
        $id_quiz = $_POST['id_quiz'];
        $id_type = $_POST['id_type'];
        $question = $_POST['question'];
        $id_question = $_POST['id_question'];
        $ans1 = "T";
        $ans2 = "N";

        $response1 = $service->addQuestion1($id_quiz, $id_type, $question);
        $response2 = $service->addAnswers1($ans1, $ans2, $id_question);


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
        sendJSONandExit($response);
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
