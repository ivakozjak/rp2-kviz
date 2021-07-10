<!DOCTYPE html>
<html>

<head>
    <meta charset="utf8">
    <title>Kviz</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="logodiv">
        <img src="<?php echo dirname($_SERVER['PHP_SELF']) . '/../app/logo.jpg' ?>" alt="logo" width="130" height="80" class="image">
    </div>
    <div class="log_2">
        <form class="forma" method="post" action="../home.php?rt=users/signUp">
            <label>Odaberi ime <input type="text" name="username"></label>
            <label>Odaberi lozinku <input type="password" name="password"></label>
            <label>Odaberi email <input type="text" name="email"></label>
            <label><input class="ulogirajse_2" type="submit" value="Registriraj se" name="signup"></label>
        </form>
    </div>