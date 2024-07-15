<?php
require_once('mysql.php');

session_start();
if(!isset($_SESSION["username"])){
  header("Location: index.php");
  exit;
}
try {
    $stmt = $mysql->query('SELECT * FROM termine');
$termine = $stmt->fetchAll(PDO::FETCH_ASSOC);{
        
    }
} catch (PDOException $e) {
    echo 'Verbindung fehlgeschlagen: ' . $e->getMessage();
}

$username = $_SESSION["username"];
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="manifest" href="/manifest.json" />
    <link rel="apple-touch-icon" href="/img/icon-128.png" />
    <meta name="theme-color" content="#00FE9C" />
    <meta name="apple-mobile-web-app-status-bar" content="#02BC74" />
    <title>MedHelp - Home</title>
    <link
      rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/main.css" />
    <link rel="stylesheet" href="/css/home.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
        <img
                src="../img/icon-128.png"
                width="30"
                height="30"
                class="d-inline-block align-top"
                alt="Salus logo"
            />

            MedHelp
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="medikamente.php">Medikamente</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Erinnerungen.php">Erinnerungen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="apothekensuche.php">Apothekensuche</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profil.php">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Abmelden</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="text-center">
            <h1>Hallo <?php echo $username; ?></h1>
            <p style="font-size: 1.5em; font-weight: bold;">Hier sind die gespeicherten Termine:</p>
        </div>

        <!-- Anzeige der gespeicherten Termine -->
        <div class="mt-4">
            <h2>Medikamentenerinnerungen</h2>
            <!-- PHP-Code, um Medikamentenerinnerungen aus der Datenbank abzurufen und anzuzeigen -->
            <?php
            $sql = "SELECT * FROM termine WHERE typ = 'Medikament' ORDER BY zeitpunkt";
            $stmt = $mysql->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="card mb-3">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>';
                echo '<p class="card-text">Nächste Dosis: ' . date('d.m.Y H:i', strtotime($row['zeitpunkt'])) . '</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>

        <!-- Anzeige der Arztterminerinnerungen -->
        <div class="mt-4">
            <h2>Arztterminerinnerungen</h2>
            <!-- PHP-Code, um Arztterminerinnerungen aus der Datenbank abzurufen und anzuzeigen -->
            <?php
            $sql = "SELECT * FROM termine WHERE typ = 'Arzttermin' ORDER BY zeitpunkt";
            $stmt = $mysql->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="card mb-3">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>';
                echo '<p class="card-text">Nächster Termin: ' . date('d.m.Y H:i', strtotime($row['zeitpunkt'])) . '</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Fußzeile -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">© 2024 MedHelp App. Alle Rechte vorbehalten.</span>
        </div>
    </footer>

    <script src="/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>


