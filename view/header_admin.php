<!DOCTYPE html>
<html>

<head>
    <meta charset="utf8">
    <title>Kviz</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
</head>

<body>
    <div class="logodiv">
        <img src="<?php echo $_SERVER['PHP_SELF'] . '/../app/logo.jpg' ?>" alt="logo" width="600" height="150" class="image">
        <h1 class="welcome">Admin: <?php echo $_SESSION['login']; ?></h1>
    </div>
    <ul>
        <li><a href="home.php?rt=users/logout">Odjava</a></li>
    </ul>