<?php

require_once __DIR__ . '/../app/database/db.class.php';
require_once __DIR__ . '/user.class.php';
require_once __DIR__ . '/quiz.class.php';
require_once __DIR__ . '/question.class.php';

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
            $arr[] = new Quiz($row['id'], $row['name'], $row['is_type1'], $row['is_type2'], $row['is_type3']);
        }

        return $arr;
    }

    function addQuiz($category, $marked)
    {
        $is_type1 = 0;
        $is_type2 = 0;
        $is_type3 = 0;
        foreach ($marked as $mark) {
            if ($mark === "is_type1")    $is_type1 = 1;
            elseif ($mark === "is_type2")    $is_type2 = 1;
            elseif ($mark === "is_type3")    $is_type3 = 1;
        }
        try {
            $db = DB::getConnection();
            $st = $db->prepare('INSERT INTO kviz_kvizovi(name, is_type1, is_type2, is_type3) VALUES(?,?,?,?)');
            $st->bindParam(1, $category, PDO::PARAM_STR);
            $st->bindParam(2, $is_type1, PDO::PARAM_INT);
            $st->bindParam(3, $is_type2, PDO::PARAM_INT);
            $st->bindParam(4, $is_type3, PDO::PARAM_INT);
            $st->execute();
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        /*$arr = array();
		while ($row = $st->fetch()) {
			$arr[] = new Product($row['id'], $row['id_user'], $row['name'], $row['description'], $row['price']);
		}*/
        return true;
        //return $arr;
    }
    static function getAllQuestions($q_id)
    {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT * FROM kviz_pitanja WHERE id_quiz=:x');
            $st->execute(array('x' => $q_id));
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        $arr = array();
        while ($row = $st->fetch()) {
            
            try {
                $db = DB::getConnection();
                $st1 = $db->prepare('SELECT answer FROM kviz_odgovori WHERE id_question=:x AND is_true = 1');
                $st1->execute(array('x' => $row['id']));
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }

            $row1 = $st1->fetch();

            $arr[] = new Question($row['id'], $row['id_quiz'],  $row['id_type'], $row['question'], $row1['answer']);
        }

        return $arr;
    }



    static function getAllQuestions($q_id)
    {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT * FROM kviz_pitanja WHERE id_quiz=:x');
            $st->execute(array('x' => $q_id));
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        $arr = array();
        while ($row = $st->fetch()) {
            
            try {
                $db = DB::getConnection();
                $st1 = $db->prepare('SELECT answer FROM kviz_odgovori WHERE id_question=:x AND is_true = 1');
                $st1->execute(array('x' => $row['id']));
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }

            $row1 = $st1->fetch();

            $arr[] = new Question($row['id'], $row['id_quiz'],  $row['id_type'], $row['question'], $row1['answer']);
        }

        return $arr;
    }
};
