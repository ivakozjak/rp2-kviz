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
        <li><a href="ebuy.php?rt=products">My products</a></li>
        <li><a href="ebuy.php?rt=products/add">Add a new product</a></li>
        <li><a href="ebuy.php?rt=products/bought">Shopping history</a></li>
        <li><a href="ebuy.php?rt=products/search">Search</a></li>
        <li><a href="ebuy.php?rt=users/logout">Logout</a></li>
    </ul>

    <h2><?php if (isset($title)) echo $title; ?></h2>