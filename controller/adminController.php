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
};

function sendJSONandExit($message)
{
    // Kao izlaz skripte pošalji $message u JSON formatu i prekini izvođenje.
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($message);
    flush();
    exit(0);
}
