<?php

require_once __DIR__ . '/../model/service.class.php';

class QuizzesController
{
    public function index()
    {
        $service = new Service();

        $title = 'Quiz list';
        $quizList = $service->getAllQuizzes();

        require_once __DIR__ . '/../view/quizzes_index.php';
    }
};
