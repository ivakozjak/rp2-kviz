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
        <h1 class="welcome">Bok</h1>
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
</body>

</html>