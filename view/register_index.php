<!DOCTYPE html>
<html>

<head>
    <meta charset="utf8">
    <title>Kviz</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="logodiv">
        <img src="<?php echo dirname($_SERVER['PHP_SELF']) . '/../app/logo.jpg' ?>" alt="logo" width="600" height="150" class="image">
        <img src="<?php echo dirname($_SERVER['PHP_SELF']) . '/../app/reg.jpg' ?>" alt="reg" width="320" height="45" class="image2">
    </div>
    <div class="log_2">
        <form class="forma" method="post" action="../home.php?rt=users/signUp">
            <label>Odaberi ime <input type="text" name="username"></label>
            <label>Odaberi lozinku <input type="password" name="password"></label>
            <label>Odaberi email <input type="text" name="email"></label>
            <label><input class="ulogirajse_2" type="submit" value="Registriraj se" name="signup"></label>
        </form>
    </div>
<?php require_once __DIR__ . '/_footer.php';?>
