<?php
session_start();

require_once "mysql.php"; // Stelle sicher, dass mysql.php eingebunden ist

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

// Termin löschen
if (isset($_POST['delete_reminder'])) {
    $id = intval($_POST['delete_reminder']);
    $stmt = $mysql->prepare("DELETE FROM termine WHERE id = :id");
    $stmt->execute([':id' => $id]);
    header("Location: erinnerungen.php");
    exit;
}

// Funktion zum Hinzufügen eines neuen Termins
if (isset($_POST['add_reminder'])) {
    $typ = $_POST['typ'];
    $name = $_POST['name'];
    $zeitpunkt = $_POST['zeitpunkt'];

    // SQL-Statement zum Einfügen des neuen Termins in die Tabelle
    $sql = "INSERT INTO termine (typ, name, zeitpunkt) VALUES (:typ, :name, :zeitpunkt)";
    $stmt = $mysql->prepare($sql);
    $stmt->bindParam(':typ', $typ, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':zeitpunkt', $zeitpunkt, PDO::PARAM_STR);
    $stmt->execute();

    // Nach dem Hinzufügen zur aktuellen Seite umleiten, um die Änderung zu sehen
    header("Location: erinnerungen.php");
    exit;
}

// Abfrage der Termine aus der Datenbank
$sql = "SELECT id, typ, name, zeitpunkt FROM termine";
$stmt = $mysql->prepare($sql);
$stmt->execute();
$termine = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MedHelp Erinnerungen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/home.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="geheim.php">
            <img src="../img/icon-128.png" width="30" height="30" class="d-inline-block align-top" alt="MedHelp logo">
            MedHelp
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="medikamente.php">Medikamente</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="erinnerungen.php">Erinnerungen</a>
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
            <h1>Erinnerungen</h1>
        </div>

        <div class="mt-4">
            <h2>Neue Erinnerung hinzufügen</h2>
            <form method="POST" action="erinnerungen.php">
                <div class="form-group">
                    
                    <label for="typ">Typ</label>
                    <select class="form-control" id="typ" name="typ">
                        <option value="Medikament">Medikament</option>
                        <option value="Arzttermin">Arzttermin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="zeitpunkt">Zeitpunkt</label>
                    <input type="datetime-local" class="form-control" id="zeitpunkt" name="zeitpunkt" required>
                </div>
                <button type="submit" name="add_reminder" class="btn btn-primary">Hinzufügen</button>
            </form>
        </div>

        <div class="mt-4">
            <h2>Erinnerungen</h2>
            <div class="clearfix"></div>

            <?php foreach ($termine as $termin): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($termin['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($termin['typ']); ?>: <?php echo htmlspecialchars($termin['zeitpunkt']); ?></p>
                        <form method="POST" action="erinnerungen.php" onsubmit="return confirm('Sind Sie sicher, dass Sie diesen Termin löschen möchten?');">
                            <input type="hidden" name="delete_reminder" value="<?php echo $termin['id']; ?>">
                            <button type="submit" class="btn btn-outline-danger">Löschen</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">© 2024 MedHelp App. Alle Rechte vorbehalten.</span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
    function validateDate() {
    const dateInput = document.getElementById('zeitpunkt').value;
    const year = dateInput.split('-')[0];
    if (year.length !== 4 || isNaN(year)) {
        alert('Das Jahr muss genau vier Ziffern haben.');
        return false;
    }
    return true;
}
        </script>
</body>
</html>


