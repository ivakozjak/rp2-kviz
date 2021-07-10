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
        $service = new Service();
        $response = $service->addQuiz();
        if ($response) {
            require_once __DIR__ . '/../view/create_quiz_succes.php';
        } else {
            require_once __DIR__ . '/../view/create_quiz_fail.php';
        }
    }
};
