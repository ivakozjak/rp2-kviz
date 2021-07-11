<?php
session_start();
require_once __DIR__ . '/model/service.class.php';

function validate($us, $pass)
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

function hasRegistered($us)
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

function isAdmin($us)
{
    $service = new Service();
    $userList = $service->getAllUsers();

    foreach ($userList as $person) {
        if ($person->username === $us) {
            if ($person->is_admin == 1)   return true;
            else    return false;
        }
    }
    return false;
}

if (
    isset($_POST['username_admin']) && isset($_POST['password_admin']) && validate($_POST['username_admin'], $_POST['password_admin'])
    && hasRegistered($_POST['username_admin']) && isAdmin($_POST['username_admin'])
) {
    $_SESSION['login'] = $_POST['username_admin'];
} else if (
    isset($_POST['username_admin']) && isset($_POST['password_admin']) && validate($_POST['username_admin'], $_POST['password_admin'])
    && hasRegistered($_POST['username_admin']) && !isAdmin($_POST['username_admin'])
) {
    header('Location: home.php');
}

unset($admin);
if (isset($_SESSION['login'])) {
    $admin = $_SESSION['login'];
}

if (isset($admin)) {
    // Provjeri je li postavljena varijabla rt; kopiraj ju u $route
    if (isset($_GET['rt']))
        $route = $_GET['rt'];
    else
        $route = 'admin';

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
