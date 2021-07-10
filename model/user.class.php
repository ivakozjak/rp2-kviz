<?php

class User
{
    protected $id, $is_admin, $username, $password_hash, $email, $registration_sequence,
        $has_registered, $score_stem, $score_sport, $score_music, $score_film;

    function __construct(
        $id,
        $is_admin,
        $username,
        $password_hash,
        $email,
        $registration_sequence,
        $has_registered,
        $score_stem,
        $score_sport,
        $score_music,
        $score_film
    ) {
        $this->id = $id;
        $this->is_admin = $is_admin;
        $this->username = $username;
        $this->password_hash = $password_hash;
        $this->email = $email;
        $this->registration_sequence = $registration_sequence;
        $this->has_registered = $has_registered;
        $this->score_stem = $score_stem;
        $this->score_sport = $score_sport;
        $this->score_music = $score_music;
        $this->score_film = $score_film;
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
