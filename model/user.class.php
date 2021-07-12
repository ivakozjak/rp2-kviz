<?php

class User
{
    protected $id, $is_admin, $username, $password_hash, $email, $registration_sequence,
        $has_registered,$kviz1,$kviz2,$kviz3,$kviz4,$kviz5,$kviz6,$kviz7,$kviz8,$kviz9,$kviz10,$kviz11,$kviz12,$kviz13,$kviz14,$kviz15;

    function __construct(
        $id,
        $is_admin,
        $username,
        $password_hash,
        $email,
        $registration_sequence,
        $has_registered,
        $kviz1,
        $kviz2,
        $kviz3,
        $kviz4,
        $kviz5,
        $kviz6,
        $kviz7,
        $kviz8,
        $kviz9,
        $kviz10,
        $kviz11,
        $kviz12,
        $kviz13,
        $kviz14,
        $kviz15
    ) {
        $this->id = $id;
        $this->is_admin = $is_admin;
        $this->username = $username;
        $this->password_hash = $password_hash;
        $this->email = $email;
        $this->registration_sequence = $registration_sequence;
        $this->has_registered = $has_registered;
        $this->kviz1 = $kviz1;
        $this->kviz2 = $kviz2;
        $this->kviz3 = $kviz3;
        $this->kviz4 = $kviz4;
        $this->kviz5 = $kviz5;
        $this->kviz6 = $kviz6;
        $this->kviz7 = $kviz7;
        $this->kviz8 = $kviz8;
        $this->kviz9 = $kviz9;
        $this->kviz10 = $kviz10;
        $this->kviz11 = $kviz11;
        $this->kviz12 = $kviz12;
        $this->kviz13 = $kviz13;
        $this->kviz14= $kviz14;
        $this->kviz15 = $kviz15;
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
