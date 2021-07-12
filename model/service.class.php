<?php

require_once __DIR__ . '/../app/database/db.class.php';
require_once __DIR__ . '/user.class.php';
require_once __DIR__ . '/quiz.class.php';
require_once __DIR__ . '/question.class.php';
require_once __DIR__ . '/answer.class.php';


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
                $row['kviz1'],
                $row['kviz2'],
                $row['kviz3'],
                $row['kviz4'],
                $row['kviz5'],
                $row['kviz6'],
                $row['kviz7'],
                $row['kviz8'],
                $row['kviz9'],
                $row['kviz10'],
                $row['kviz11'],
                $row['kviz12'],
                $row['kviz13'],
                $row['kviz14'],
                $row['kviz15']
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
                $row['kviz1'],
                $row['kviz2'],
                $row['kviz3'],
                $row['kviz4'],
                $row['kviz5'],
                $row['kviz6'],
                $row['kviz7'],
                $row['kviz8'],
                $row['kviz9'],
                $row['kviz10'],
                $row['kviz11'],
                $row['kviz12'],
                $row['kviz13'],
                $row['kviz14'],
                $row['kviz15']
            );
        }

        return $arr;
    }

    function getUserId($username)
    {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT id FROM kviz_korisnici WHERE username=:x');
            $st->execute(array('x' => $username));
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        $row = $st->fetch();
        if ($row === false)
            return null;
        else
            return $row['id'];
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
        return true;
    }
    function getAllQuestions($q_id)
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
            $arr[] = [$row['id'], $row['id_quiz'],  $row['id_type'], $row['question']];
        }

        return $arr;
    }

    function getAllAnswers()
    {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT * FROM kviz_odgovori');
            $st->execute();
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        $arr = array();
        while ($row = $st->fetch()) {
            $arr[] = [$row['id'], $row['id_question'], $row['is_true'], $row['answer']];
        }

        return $arr;
    }

    function getAnswers($q_id)
    {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT answer FROM kviz_odgovori WHERE id_question=:x');
            $st->execute(array('x' => $q_id));
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        $arr = array();
        while ($row = $st->fetch())
            $arr[] = $row['answer'];


        return $arr;
    }

    function getScores($username)
    {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT * FROM kviz_korisnici WHERE username=:x');
            $st->execute(array('x' => $username));
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        $row = $st->fetch();
        $score = [
            $row['kviz1'],
            $row['kviz2'],
            $row['kviz3'],
            $row['kviz4'],
            $row['kviz5'],
            $row['kviz6'],
            $row['kviz7'],
            $row['kviz8'],
            $row['kviz9'],
            $row['kviz10'],
            $row['kviz11'],
            $row['kviz12'],
            $row['kviz13'],
            $row['kviz14'],
            $row['kviz15']
        ];

        return $score;
    }

    function getQuizById($id)
    {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT * FROM kviz_korisnici WHERE id=:x');
            $st->execute(array('x' => $id));
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        $row = $st->fetch();
        if ($row === false)
            return null;
        else
            return new Quiz($row['id'], $row['name'], $row['is_type1'], $row['is_type2'], $row['is_type3']);
    }

    function getQuizId($name)
    {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT id FROM kviz_kvizovi WHERE name=:x');
            $st->execute(array('x' => $name));
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        $row = $st->fetch();
        if ($row === false)
            return null;
        else
            return $row['id'];
    }

    function getLastQuestionId()
    {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT count(*) broj FROM kviz_pitanja');
            $st->execute();
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }

        $row = $st->fetch();

        return $row['broj'];
    }

    function addQuestion($id_quiz, $id_type, $question)
    {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('INSERT INTO kviz_pitanja(id_quiz, id_type, question) VALUES(?,?,?)');
            $st->bindParam(1, $id_quiz, PDO::PARAM_INT);
            $st->bindParam(2, $id_type, PDO::PARAM_INT);
            $st->bindParam(3, $question, PDO::PARAM_STR);
            $st->execute();
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }
        return true;
    }

    function addAnswers1($ans1, $ans2, $id_question)
    {
        try {
            $db = DB::getConnection();
            $st1 = $db->prepare('INSERT INTO kviz_odgovori(id_question, is_true, answer) VALUES(?,1,?)');
            $st1->bindParam(1, $id_question, PDO::PARAM_INT);
            $st1->bindParam(2, $ans1, PDO::PARAM_STR);
            $st1->execute();

            $st2 = $db->prepare('INSERT INTO kviz_odgovori(id_question, is_true, answer) VALUES(?,0,?)');
            $st2->bindParam(1, $id_question, PDO::PARAM_INT);
            $st2->bindParam(2, $ans2, PDO::PARAM_STR);
            $st2->execute();
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }
        return true;
    }

    function addAnswers2(
        $id_question,
        $is_true1,
        $answer1,
        $is_true2,
        $answer2,
        $is_true3,
        $answer3,
        $is_true4,
        $answer4
    ) {
        try {
            $db = DB::getConnection();
            $st1 = $db->prepare('INSERT INTO kviz_odgovori(id_question, is_true, answer) VALUES(?,?,?)');
            $st1->bindParam(1, $id_question, PDO::PARAM_INT);
            $st1->bindParam(2, $is_true1, PDO::PARAM_INT);
            $st1->bindParam(3, $answer1, PDO::PARAM_STR);
            $st1->execute();

            $st2 = $db->prepare('INSERT INTO kviz_odgovori(id_question, is_true, answer) VALUES(?,?,?)');
            $st2->bindParam(1, $id_question, PDO::PARAM_INT);
            $st2->bindParam(2, $is_true2, PDO::PARAM_INT);
            $st2->bindParam(3, $answer2, PDO::PARAM_STR);
            $st2->execute();

            $st3 = $db->prepare('INSERT INTO kviz_odgovori(id_question, is_true, answer) VALUES(?,?,?)');
            $st3->bindParam(1, $id_question, PDO::PARAM_INT);
            $st3->bindParam(2, $is_true3, PDO::PARAM_INT);
            $st3->bindParam(3, $answer3, PDO::PARAM_STR);
            $st3->execute();

            $st4 = $db->prepare('INSERT INTO kviz_odgovori(id_question, is_true, answer) VALUES(?,?,?)');
            $st4->bindParam(1, $id_question, PDO::PARAM_INT);
            $st4->bindParam(2, $is_true4, PDO::PARAM_INT);
            $st4->bindParam(3, $answer4, PDO::PARAM_STR);
            $st4->execute();
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }
        return true;
    }

    function addAnswers3($id_question, $answer)
    {
        try {
            $db = DB::getConnection();
            $st1 = $db->prepare('INSERT INTO kviz_odgovori(id_question, is_true, answer) VALUES(?,1,?)');
            $st1->bindParam(1, $id_question, PDO::PARAM_INT);
            $st1->bindParam(2, $answer, PDO::PARAM_STR);
            $st1->execute();
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }
        return true;
    }


    function addScore($k, $username, $result)
    {
        if ($k === 'kviz1') {
            try {
                $db = DB::getConnection();
                $st = $db->prepare('UPDATE kviz_korisnici SET kviz1=? WHERE username=? ');
                $st->bindParam(1, $result, PDO::PARAM_INT);
                $st->bindParam(2, $username, PDO::PARAM_STR);
                $st->execute();
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }
            return true;
        }

        if ($k === 'kviz2') {
            try {
                $db = DB::getConnection();
                $st = $db->prepare('UPDATE kviz_korisnici SET kviz2=? WHERE username=? ');
                $st->bindParam(1, $result, PDO::PARAM_INT);
                $st->bindParam(2, $username, PDO::PARAM_STR);
                $st->execute();
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }
            return true;
        }
        if ($k === 'kviz3') {
            try {
                $db = DB::getConnection();
                $st = $db->prepare('UPDATE kviz_korisnici SET kviz3=? WHERE username=? ');
                $st->bindParam(1, $result, PDO::PARAM_INT);
                $st->bindParam(2, $username, PDO::PARAM_STR);
                $st->execute();
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }
            return true;
        }
        if ($k === 'kviz4') {
            try {
                $db = DB::getConnection();
                $st = $db->prepare('UPDATE kviz_korisnici SET kviz4=? WHERE username=? ');
                $st->bindParam(1, $result, PDO::PARAM_INT);
                $st->bindParam(2, $username, PDO::PARAM_STR);
                $st->execute();
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }
            return true;
        }
        if ($k === 'kviz5') {
            try {
                $db = DB::getConnection();
                $st = $db->prepare('UPDATE kviz_korisnici SET kviz5=? WHERE username=? ');
                $st->bindParam(1, $result, PDO::PARAM_INT);
                $st->bindParam(2, $username, PDO::PARAM_STR);
                $st->execute();
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }
            return true;
        }
        if ($k === 'kviz6') {
            try {
                $db = DB::getConnection();
                $st = $db->prepare('UPDATE kviz_korisnici SET kviz6=? WHERE username=? ');
                $st->bindParam(1, $result, PDO::PARAM_INT);
                $st->bindParam(2, $username, PDO::PARAM_STR);
                $st->execute();
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }
            return true;
        }
        if ($k === 'kviz7') {
            try {
                $db = DB::getConnection();
                $st = $db->prepare('UPDATE kviz_korisnici SET kviz7=? WHERE username=? ');
                $st->bindParam(1, $result, PDO::PARAM_INT);
                $st->bindParam(2, $username, PDO::PARAM_STR);
                $st->execute();
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }
            return true;
        }
        if ($k === 'kviz8') {
            try {
                $db = DB::getConnection();
                $st = $db->prepare('UPDATE kviz_korisnici SET kviz8=? WHERE username=? ');
                $st->bindParam(1, $result, PDO::PARAM_INT);
                $st->bindParam(2, $username, PDO::PARAM_STR);
                $st->execute();
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }
            return true;
        }
        if ($k === 'kviz9') {
            try {
                $db = DB::getConnection();
                $st = $db->prepare('UPDATE kviz_korisnici SET kviz9=? WHERE username=? ');
                $st->bindParam(1, $result, PDO::PARAM_INT);
                $st->bindParam(2, $username, PDO::PARAM_STR);
                $st->execute();
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }
            return true;
        }
        if ($k === 'kviz10') {
            try {
                $db = DB::getConnection();
                $st = $db->prepare('UPDATE kviz_korisnici SET kviz10=? WHERE username=? ');
                $st->bindParam(1, $result, PDO::PARAM_INT);
                $st->bindParam(2, $username, PDO::PARAM_STR);
                $st->execute();
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }
            return true;
        }
        if ($k === 'kviz11') {
            try {
                $db = DB::getConnection();
                $st = $db->prepare('UPDATE kviz_korisnici SET kviz11=? WHERE username=? ');
                $st->bindParam(1, $result, PDO::PARAM_INT);
                $st->bindParam(2, $username, PDO::PARAM_STR);
                $st->execute();
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }
            return true;
        }
        if ($k === 'kviz12') {
            try {
                $db = DB::getConnection();
                $st = $db->prepare('UPDATE kviz_korisnici SET kviz12=? WHERE username=? ');
                $st->bindParam(1, $result, PDO::PARAM_INT);
                $st->bindParam(2, $username, PDO::PARAM_STR);
                $st->execute();
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }
            return true;
        }
        if ($k === 'kviz13') {
            try {
                $db = DB::getConnection();
                $st = $db->prepare('UPDATE kviz_korisnici SET kviz13=? WHERE username=? ');
                $st->bindParam(1, $result, PDO::PARAM_INT);
                $st->bindParam(2, $username, PDO::PARAM_STR);
                $st->execute();
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }
            return true;
        }
        if ($k === 'kviz14') {
            try {
                $db = DB::getConnection();
                $st = $db->prepare('UPDATE kviz_korisnici SET kviz14=? WHERE username=? ');
                $st->bindParam(1, $result, PDO::PARAM_INT);
                $st->bindParam(2, $username, PDO::PARAM_STR);
                $st->execute();
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }
            return true;
        }
        if ($k === 'kviz15') {
            try {
                $db = DB::getConnection();
                $st = $db->prepare('UPDATE kviz_korisnici SET kviz15=? WHERE username=? ');
                $st->bindParam(1, $result, PDO::PARAM_INT);
                $st->bindParam(2, $username, PDO::PARAM_STR);
                $st->execute();
            } catch (PDOException $e) {
                exit('PDO error ' . $e->getMessage());
            }
            return true;
        }
    }
};
