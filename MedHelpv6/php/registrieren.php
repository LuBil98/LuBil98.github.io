<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" href="../favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="img/icon-128.png" />
    <meta name="theme-color" content="#00FE9C" />
    <meta name="apple-mobile-web-app-status-bar" content="#02BC74" />
    <title>MedHelp - Registrierung</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/register.css" />
</head>
<body>
<?php
require_once('mysql.php');
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('mysql.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $count = $stmt->rowCount();

        if ($count == 0) {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $mysql->prepare("INSERT INTO accounts (username, password) VALUES (:username, :password)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $hash);
            $stmt->execute();
            echo "<div class='alert alert-success'>Registrierung erfolgreich! Sie können sich jetzt <a href='index.php'>anmelden</a>.</div>";
        } else {
            echo "<div class='alert alert-danger'>Benutzername ist bereits vergeben.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Passwörter stimmen nicht überein.</div>";
    }
}
?>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="geheim.php">
            <img src="../img/icon-128.png" width="30" height="30" class="d-inline-block align-top" alt="MedHelp logo" />
            MedHelp
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Medikamente</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Erinnerungen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Apothekensuche</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Abmelden</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1 class="text-center">Registrierung</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Benutzername:</label>
                <input type="text" name="username" id="username" class="form-control" required />
            </div>
            <div class="form-group">
                <div class="form-group">
                <label for="password">Passwort:</label>
                <input type="password" name="password" id="password" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="confirm_password">Passwort bestätigen:</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required />
            </div>
            <div class="form-group text-center">
                <input type="submit" name="submit" value="Registrieren" class="btn btn-primary" />
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
