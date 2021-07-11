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
        //$service = new Service();

        //$title = 'Quiz list';
        $questions = Service::getAllQuestions($_POST['quizId']);

        require_once __DIR__ . '/../view/quizzes_open.php';
    }
};
