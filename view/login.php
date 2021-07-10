<!DOCTYPE html>
<html>

<head>
    <meta charset="utf8">
    <title>Kviz</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="logodiv">
        <img src="<?php echo $_SERVER['PHP_SELF'] . '/../app/logo.jpg' ?>" alt="logo" width="600" height="150" class="image">
        <img src="<?php echo $_SERVER['PHP_SELF'] . '/../app/prijava.jpg' ?>" alt="logo" width="250" height="65" class="image2">
    </div>
    <div class="log">
        <form class="forma" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <label>Ime <input type="text" name="username"></label>
            <label>Lozinka <input type="password" name="password"></label>
            <label><input class="ulogirajse" type="submit" value="Prijavi se" name="submit"></label>
        </form>
    </div>
    <div class="signup">
        <p>Nemaš svoj račun?</p>
        <a href="view/register_index.php">Registriraj se</a>
    </div>
    <div class="admin">
        <p><b>Prijavi se kao admin</b></p>
        <form class="forma_admin" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <label>Ime <input type="text" name="username_admin"></label>
            <label>Lozinka <input type="password" name="password_admin"></label>
            <label><input class="ulogirajse" type="submit" value="Prijavi se" name="submit1"></label>
        </form>
    </div>
</body>

</html>
