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
        <img src="<?php echo dirname($_SERVER['PHP_SELF']) . '/../app/reg.jpg' ?>" alt="reg" width="320" height="45" class="image2">
    </div>
    <p>
        Provjeri svoj email i klikni na potvrdu registracije. Tada će registracija biti završena.
    </p>

<?php require_once __DIR__ . '/_footer.php';?>
