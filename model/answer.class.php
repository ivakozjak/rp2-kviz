<?php

class Question
{
    protected $id, $id_question, $is_true, $answer;

    function __construct($id, $id_question, $is_true, $answer)
    {
        $this->id = $id;
        $this->id_question = $id_question;
        $this->is_true = $is_true;
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
