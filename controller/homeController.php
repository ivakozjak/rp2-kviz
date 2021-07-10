<?php

class homeController
{
    public function index()
    {
        // Samo preusmjeri na podstranicu za odabir kvizova.
        header('Location: home.php?rt=quizzes');
    }
};
