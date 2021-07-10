<?php

require_once __DIR__ . '/app/database/db.class.php';

session_start();


// Ova skripta analizira $_GET['niz'] i u bazi postavlja has_registered=1 za onog korisnika koji ima taj niz.
// Jako je mala šansa da dvojica imaju isti.

if (!isset($_GET['niz']) || !preg_match('/^[a-z]{20}$/', $_GET['niz']))
    exit('Something is wrong with the sequence.');

// Nađi korisnika s tim nizom u bazi
$db = DB::getConnection();

try {
    $st = $db->prepare('SELECT * FROM kviz_korisnici WHERE registration_sequence=:x');
    $st->execute(array('x' => $_GET['niz']));
} catch (PDOException $e) {
    exit('Database error: ' . $e->getMessage());
}

$row = $st->fetch();

if ($st->rowCount() !== 1)
    exit('This reqistration sequence has ' . $st->rowCount() . 'users. Required only 1.');
else {
    // Sad znamo da je točno jedan takav. Postavi mu has_registered na 1.
    try {
        $st = $db->prepare('UPDATE kviz_korisnici SET has_registered=1 WHERE registration_sequence=:x');
        $st->execute(array('x' => $_GET['niz']));
    } catch (PDOException $e) {
        exit('Database error: ' . $e->getMessage());
    }

    // Sve je uspjelo, zahvali mu na registraciji.
    require_once __DIR__ . '/view/register_success.php';
    exit();
}
