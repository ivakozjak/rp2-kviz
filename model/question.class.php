<?php

class Question
{
    protected $id, $id_quiz, $id_type, $question;

    function __construct($id, $id_quiz, $id_type, $question)
    {
        $this->id = $id;
        $this->id_quiz = $id_quiz;
        $this->id_type = $id_type;
        $this->question = $question;
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
