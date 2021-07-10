<?php

class User
{
    protected $id, $is_admin, $username, $password_hash, $email, $registration_sequence, $has_registered;

    function __construct($id, $is_admin, $username, $password_hash, $email, $registration_sequence, $has_registered)
    {
        $this->id = $id;
        $this->is_admin = $is_admin;
        $this->username = $username;
        $this->password_hash = $password_hash;
        $this->email = $email;
        $this->registration_sequence = $registration_sequence;
        $this->has_registered = $has_registered;
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
