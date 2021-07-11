<?php

require_once __DIR__ . '/../model/service.class.php';

class QuizzesController
{
    public function index()
    {
        $service = new Service();

        //$title = 'Quiz list';
        $quizList = $service->getAllQuizzes();

        require_once __DIR__ . '/../view/quizzes_index.php';
    }

    public function open()
    {
        //$questions = Service::getAllQuestions($_POST['quizId']);
        $service = new Service();
        $quizId = (int)$_POST['id'];
        $response = [];

        $questions = $service->getAllQuestions($quizId);
        $answers = $service->getAllAnswers();

        $response['questions'] = $questions;
        $response['answers'] = $answers;

        sendJSONandExit($response);
        //require_once __DIR__ . '/../view/quizzes_open.php';
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
