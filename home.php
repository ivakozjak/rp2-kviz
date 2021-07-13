<?php
define('__SITE_URL', dirname($_SERVER['PHP_SELF']));

session_start();
require_once __DIR__ . '/model/service.class.php';

function validate($us, $pass) //provjera unesenih podataka kod ulogiranja
{
    $service = new Service();
    $userList = $service->getAllUsers();

    foreach ($userList as $person) {
        if (($person->username === $us) && password_verify($pass, $person->password_hash)) {
            $_SESSION['user_id'] = $person->id;
            return true;
        }
    }
    return false;
}

function hasRegistered($us) //provjerava je li korisnik registriran
{
    $service = new Service();
    $userList = $service->getAllUsers();

    foreach ($userList as $person) {
        if ($person->username === $us) {
            if ($person->has_registered == 1)   return true;
            else    return false;
        }
    }
    return false;
}

if (isset($_POST['username']) && isset($_POST['password']) && validate($_POST['username'], $_POST['password']) && !hasRegistered($_POST['username'])) {
    require_once __DIR__ . '/view/register_confirmation.php';
    exit();
}

if (isset($_POST['username']) && isset($_POST['password']) && validate($_POST['username'], $_POST['password']) && hasRegistered($_POST['username'])) {
    $_SESSION['login'] = $_POST['username'];
}

unset($user);
if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
}

if (isset($user)) {
    // Provjeri je li postavljena varijabla rt; kopiraj ju u $route
    if (isset($_GET['rt']))
        $route = $_GET['rt'];
    else
        $route = 'home';

    // Ako je $route == 'con/act', onda rastavi na $controllerName='con', $action='act'
    $parts = explode('/', $route);

    $controllerName = $parts[0] . 'Controller';
    if (isset($parts[1]))
        $action = $parts[1];
    else
        $action = 'index';

    // Controller $controllerName se nalazi poddirektoriju controller
    $controllerFileName = 'controller/' . $controllerName . '.php';

    // Includeaj tu datoteku
    require_once $controllerFileName;

    // Stvori pripadni kontroler
    $con = new $controllerName;

    // Pozovi odgovarajuću akciju
    $con->$action();
} else if (isset($_GET['rt'])) {
    $route = $_GET['rt'];

    $parts = explode('/', $route);

    $controllerName = $parts[0] . 'Controller';
    if (isset($parts[1]))
        $action = $parts[1];

    $controllerFileName = 'controller/' . $controllerName . '.php';

    // Includeaj tu datoteku
    require_once $controllerFileName;

    // Stvori pripadni kontroler
    $con = new $controllerName;

    // Pozovi odgovarajuću akciju
    $con->$action();
} else {
    require_once __DIR__ . '/view/login.php';
}
