<?php
require_once __DIR__ . '/../model/service.class.php';

class UsersController
{
    public function index()
    {
        $service = new Service();

        $title = 'Popis svih korisnika';
        $userList = $service->getAllUsers();

        require_once __DIR__ . '/../view/users_index.php';
    }

    public function scores()
    {
        echo "tu ćemo imat statistiku";
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        unset($user);
        header('Location: home.php');
    }

    public function signUp()
    {
        if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['email'])) {
            echo 'Unesi ime, lozinku i email.';
            exit();
        }
        if (!preg_match('/^[A-Za-z]{3,10}$/', $_POST['username'])) {
            echo 'Ime bi trebalo biti duljine 3 do 10 znakova.';
            exit();
        }
        if (strlen($_POST['password']) < 3) {
            echo 'Lozinka mora biti duga najmanje 3 znaka.';
            exit();
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo 'Email adresa nije valjana.';
            exit();
        } else {
            // Provjeri jel već postoji taj korisnik u bazi
            $db = DB::getConnection();

            try {
                $st = $db->prepare('SELECT * FROM kviz_korisnici WHERE username=:x');
                $st->execute(array('x' => $_POST['username']));
            } catch (PDOException $e) {
                exit('Database error: ' . $e->getMessage());
            }

            if ($st->rowCount() !== 0) {
                // Taj user u bazi već postoji
                echo 'Korisnik s tim imenom već postoji.';
                exit();
            }

            // Dakle sad je napokon sve ok.
            // Dodaj novog korisnika u bazu. Prvo mu generiraj random string od 10 znakova za registracijski link.
            $reg_seq = '';
            for ($i = 0; $i < 20; ++$i)
                $reg_seq .= chr(rand(0, 25) + ord('a')); // Zalijepi slučajno odabrano slovo

            try {
                $st = $db->prepare('INSERT INTO kviz_korisnici (username, password_hash, email, registration_sequence, has_registered) VALUES (:username, :password, :email, :reg_seq, 0)');

                $st->execute(array(
                    'username' => $_POST['username'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'email' => $_POST['email'],
                    'reg_seq'  => $reg_seq
                ));
            } catch (PDOException $e) {
                exit('Database error: ' . $e->getMessage());
            }

            // Sad mu još pošalji mail
            $to       = $_POST['email'];
            $subject  = 'Registracijski mail';
            $message  = 'Poštovani ' . $_POST['username'] . "!\nKliknite na ovaj link kako biste dovršili registraciju: ";
            $message .= 'http://' . $_SERVER['SERVER_NAME'] . htmlentities(dirname($_SERVER['PHP_SELF'])) . '/register.php?niz=' . $reg_seq . "\n";
            $headers  = 'From: rp2@studenti.math.hr' . "\r\n" .
                'Reply-To: rp2@studenti.math.hr' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            $isOK = mail($to, $subject, $message, $headers);

            if (!$isOK)
                exit('Error: couldn\'t send email. (Run on rp2 server.)');

            // Zahvali mu na prijavi.
            require_once __DIR__ . '/../view/register_confirmation.php';
            exit();
        }
    }
};
