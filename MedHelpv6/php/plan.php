<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

require_once('mysql.php');

// Plan löschen
if (isset($_GET['delete'])) {
    $plan_id = $_GET['delete'];
    $stmt = $mysql->prepare("DELETE FROM pläne WHERE id = :id AND username = :username");
    $stmt->bindParam(':id', $plan_id);
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();
    header("Location: plan.php");
    exit;
}

// Plan hinzufügen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medikament = $_POST['medikament'];
    $dosierung = $_POST['dosierung'];
    $startdatum = $_POST['startdatum'];
    $intervall = $_POST['intervall'];
    $username = $_SESSION['username'];

    $stmt = $mysql->prepare("INSERT INTO pläne (username, medikament, dosierung, startdatum, intervall) VALUES (:username, :medikament, :dosierung, :startdatum, :intervall)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':medikament', $medikament);
    $stmt->bindParam(':dosierung', $dosierung);
    $stmt->bindParam(':startdatum', $startdatum);
    $stmt->bindParam(':intervall', $intervall);
    $stmt->execute();

    $success = "Ihr Einnahmeplan wurde erfolgreich erstellt.";
}

// Pläne abrufen
$stmt = $mysql->prepare("SELECT * FROM pläne WHERE username = :username");
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$pläne = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Einnahmeplan erstellen - MedHelp</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <style>
        body {
            background-color: #d4edda; /* Grün gefärbter Hintergrund */
            font-family: 'Arial', sans-serif; /* Moderner Schriftzug */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .plan-form {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .content {
            flex: 1;
        }
        .footer {
            background: #343a40;
            color: #ffffff;
            padding: 20px 0;
        }
        footer .text-muted {
            color: #ced4da !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="../img/icon-128.png" width="30" height="30" class="d-inline-block align-top" alt="MedHelp logo">
            MedHelp
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a class="nav-link" href="plan.php">Einnahmepläne</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profil.php">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="uns.php">Über uns</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kontakt.php">Kontakt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Abmelden</a>
                </li>
                
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Einnahmeplan erstellen</h1>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="plan-form">
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php endif; ?>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="medikament">Medikament</label>
                            <input type="text" class="form-control" id="medikament" name="medikament" required>
                        </div>
                        <div class="form-group">
                            <label for="dosierung">Dosierung</label>
                            <input type="text" class="form-control" id="dosierung" name="dosierung" required>
                        </div>
                        <div class="form-group">
                            <label for="startdatum">Startdatum</label>
                            <input type="date" class="form-control" id="startdatum" name="startdatum" required>
                        </div>
                        <div class="form-group">
                            <label for="intervall">Intervall (in Tagen)</label>
                            <input type="number" class="form-control" id="intervall" name="intervall" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Plan erstellen</button>
                    </form>
                </div>
            </div>
        </div>

        <h2 class="text-center mt-5">Bestehende Einnahmepläne</h2>
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Medikament</th>
                            <th>Dosierung</th>
                            <th>Startdatum</th>
                            <th>Intervall (Tage)</th>
                            <th>Aktionen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pläne as $plan): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($plan['medikament']); ?></td>
                                <td><?php echo htmlspecialchars($plan['dosierung']); ?></td>
                                <td><?php echo htmlspecialchars($plan['startdatum']); ?></td>
                                <td><?php echo htmlspecialchars($plan['intervall']); ?></td>
                                <td>
                                    <a href="?delete=<?php echo $plan['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Sind Sie sicher, dass Sie diesen Plan löschen möchten?')">Löschen</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($pläne)): ?>
                            <tr>
                                <td colspan="5" class="text-center">Keine Einnahmepläne vorhanden.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span class="text-muted">© 2024 MedHelp App. Alle Rechte vorbehalten.</span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

