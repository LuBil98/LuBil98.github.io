<?php
require_once('mysql.php');
?>
<?php
session_start();

// Initialisierung der Session-Variablen, falls sie noch nicht gesetzt sind
if (!isset($_SESSION['profileData'])) {
    $_SESSION['profileData'] = array(
        "email" => "",
        "phone" => "",
        "birthdate" => "",
        "gender" => "",
        "medicalConditions" => "",
        "emergencyContact" => ""
    );
}

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

// Benutzername aus der Session holen
$username = $_SESSION["username"];

// Wenn das Formular abgesendet wurde, Daten in der Session speichern
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['profileData']['email'] = $_POST["email"];
    $_SESSION['profileData']['phone'] = $_POST["phone"];
    $_SESSION['profileData']['birthdate'] = $_POST["birthdate"];
    $_SESSION['profileData']['gender'] = $_POST["gender"];
    $_SESSION['profileData']['medicalConditions'] = $_POST["medicalConditions"];
    $_SESSION['profileData']['emergencyContact'] = $_POST["emergencyContact"];
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MedHelp Profil</title>
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
            <img
                src="../img/profilbild.jpg"
                class="rounded-circle"
                alt="Profilbild"
                width="150"
                height="150"
            />
            <h2 class="mt-3"><?php echo $username; ?></h2>
        </div>

        <hr />

        <!-- Formular für die Profildaten -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="name@example.com"
                    value="<?php echo htmlspecialchars($_SESSION['profileData']['email']); ?>"
                />
            </div>
            <div class="form-group">
                <label for="phone">Telefonnummer</label>
                <input
                    type="tel"
                    class="form-control"
                    id="phone"
                    name="phone"
                    placeholder="0123456789"
                    value="<?php echo htmlspecialchars($_SESSION['profileData']['phone']); ?>"
                />
            </div>
            <div class="form-group">
                <label for="birthdate">Geburtsdatum</label>
                <input
                    type="date"
                    class="form-control"
                    id="birthdate"
                    name="birthdate"
                    value="<?php echo htmlspecialchars($_SESSION['profileData']['birthdate']); ?>"
                />
            </div>
            <div class="form-group">
                <label for="gender">Geschlecht</label>
                <select class="form-control" id="gender" name="gender">
                    <option <?php if ($_SESSION['profileData']['gender'] == '') echo 'selected'; ?>>Wählen...</option>
                    <option <?php if ($_SESSION['profileData']['gender'] == 'Männlich') echo 'selected'; ?>>Männlich</option>
                    <option <?php if ($_SESSION['profileData']['gender'] == 'Weiblich') echo 'selected'; ?>>Weiblich</option>
                    <option <?php if ($_SESSION['profileData']['gender'] == 'Andere') echo 'selected'; ?>>Andere</option>
                </select>
            </div>
            <div class="form-group">
                <label for="medicalConditions">Medizinische Bedingungen / Allergien</label>
                <textarea
                    class="form-control"
                    id="medicalConditions"
                    name="medicalConditions"
                    rows="3"
                ><?php echo htmlspecialchars($_SESSION['profileData']['medicalConditions']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="emergencyContact">Notfallkontakt</label>
                <input
                    type="tel"
                    class="form-control"
                    id="emergencyContact"
                    name="emergencyContact"
                    placeholder="0123456789"
                    value="<?php echo htmlspecialchars($_SESSION['profileData']['emergencyContact']); ?>"
                />
            </div>
            <button type="submit" class="btn btn-primary">Änderungen speichern</button>
        </form>

        <hr />

        <!-- Anzeige der gespeicherten Daten (nur für das Beispiel) -->
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <h3>Gespeicherte Daten</h3>
            <ul>
                <li><strong>E-Mail:</strong> <?php echo htmlspecialchars($_SESSION['profileData']['email']); ?></li>
                <li><strong>Telefonnummer:</strong> <?php echo htmlspecialchars($_SESSION['profileData']['phone']); ?></li>
                <li><strong>Geburtsdatum:</strong> <?php echo htmlspecialchars($_SESSION['profileData']['birthdate']); ?></li>
                <li><strong>Geschlecht:</strong> <?php echo htmlspecialchars($_SESSION['profileData']['gender']); ?></li>
                <li><strong>Medizinische Bedingungen / Allergien:</strong> <?php echo htmlspecialchars($_SESSION['profileData']['medicalConditions']); ?></li>
                <li><strong>Notfallkontakt:</strong> <?php echo htmlspecialchars($_SESSION['profileData']['emergencyContact']); ?></li>
            </ul>
        <?php endif; ?>
    </div>

    <!-- Fußzeile -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">© 2024 MedHelp App. Alle Rechte vorbehalten.</span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>



