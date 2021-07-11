<?php

class Question
{
    protected $id, $id_quiz, $id_type, $question, $answer;

    function __construct($id, $id_quiz, $id_type, $question, $answer)
    {
        $this->id = $id;
        $this->id_quiz = $id_quiz;
        $this->id_type = $id_type;
        $this->question = $question;
        $this->answer = $answer;
    }

    function __get($prop)
    {
        return $this->$prop;
    }
    function __set($prop, $val)
    {
        $this->$prop = $val;
        return $this;
    }
}
