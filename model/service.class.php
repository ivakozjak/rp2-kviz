<?php

require_once __DIR__ . '/../app/database/db.class.php';
require_once __DIR__ . '/user.class.php';
require_once __DIR__ . '/quiz.class.php';

class Service
{
    function getUserById($user_id)
    {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT * FROM kviz_korisnici WHERE id=:x');
            $st->execute(array('x' => $user_id));
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        $row = $st->fetch();
        if ($row === false)
            return null;
        else
            return new User(
                $row['id'],
                $row['is_admin'],
                $row['username'],
                $row['password_hash'],
                $row['email'],
                $row['registration_sequence'],
                $row['has_registered'],
                $row['score_stem'],
                $row['score_sport'],
                $row['score_music'],
                $row['score_film']
            );
    }


    function getAllUsers()
    {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT * FROM kviz_korisnici ORDER BY username');
            $st->execute();
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        $arr = array();
        while ($row = $st->fetch()) {
            $arr[] = new User(
                $row['id'],
                $row['is_admin'],
                $row['username'],
                $row['password_hash'],
                $row['email'],
                $row['registration_sequence'],
                $row['has_registered'],
                $row['score_stem'],
                $row['score_sport'],
                $row['score_music'],
                $row['score_film']
            );
        }

        return $arr;
    }

    function getAllQuizzes()
    {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT * FROM kviz_kvizovi');
            $st->execute();
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        $arr = array();
        while ($row = $st->fetch()) {
            $arr[] = new Quiz($row['id'], $row['name'],  $row['is_type1'], $row['is_type1'], $row['is_type2'], $row['is_type3']);
        }

        return $arr;
    }

    function addQuiz()
    {
    }
};
