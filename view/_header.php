<!DOCTYPE html>
<html>

<head>
    <meta charset="utf8">
    <title>Kviz</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="logodiv">
        <img src="<?php echo $_SERVER['PHP_SELF'] . '/../app/logo.jpg' ?>" alt="logo" width="130" height="80" class="image">
        <h1 class="welcome">Bok, <?php echo $_SESSION['login']; ?></h1>
    </div>
    <ul>
        <li><a href="home.php?rt=users/scores">Rezultati</a></li>
        <li><a href="home.php?rt=users/logout">Odjava</a></li>
    </ul>

    <h2>Odaberi kviz za igru</h2>