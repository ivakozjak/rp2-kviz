<?php

class Quiz
{
    protected $id, $name, $is_type1, $is_type2, $is_type3;

    function __construct($id, $name, $is_type1, $is_type2, $is_type3)
    {
        $this->id = $id;
        $this->name = $name;
        $this->is_type1 = $is_type1;
        $this->is_type2 = $is_type2;
        $this->is_type3 = $is_type3;
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
