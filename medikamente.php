<?php
function fetchMedicationInfo($searchTerm) {
    // Base URL für die openFDA API
    $base_url = "https://api.fda.gov/drug/label.json";

    // Parameter für die Suchanfrage
    $params = [
        'search' => "openfda.brand_name:\"$searchTerm\"", // Suchbegriff nach Markenname des Medikaments
        'limit' => 5 // Anzahl der Ergebnisse begrenzen
    ];

    // URL für die API-Anfrage zusammenstellen
    $url = $base_url . '?' . http_build_query($params);

    // API-Anfrage durchführen
    $response = file_get_contents($url);

    if ($response === false) {
        // Fehlerbehandlung, falls die Anfrage fehlschlägt
        die('Fehler beim Abrufen der Daten von der API.');
    }

    $data = json_decode($response, true);

    $results = [];
    if (isset($data['results'])) {
        foreach ($data['results'] as $result) {
            $med_name = isset($result['openfda']['brand_name'][0]) ? $result['openfda']['brand_name'][0] : 'Nicht verfügbar';
            $product_type = isset($result['openfda']['product_type'][0]) ? $result['openfda']['product_type'][0] : 'Nicht verfügbar';

            $results[] = [
                'med_name' => $med_name,
                'product_type' => $product_type
            ];
        }
    }
    return $results;
}

// Verarbeite die Suchanfrage, wenn ein Suchbegriff übergeben wurde
if (isset($_GET['searchTerm'])) {
    $search_term = $_GET['searchTerm'];
    if (!empty($search_term)) {
        $medications = fetchMedicationInfo($search_term);
    } else {
        $medications = [];
    }
} else {
    $medications = [];
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedHelp - Medikamente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/medications.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
        <a class="navbar-brand" href="geheim.php">
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
        </div>
    </nav>

    <div class="container mt-4 medication-list">
        <h1 class="mb-4">Meine Medikamente</h1>

        <!-- Formular für die Medikamentensuche -->
        <form method="GET">
            <div class="form-group">
                <label for="searchTerm">Suche nach Medikament</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="searchTerm" name="searchTerm" placeholder="Geben Sie den Medikamentennamen ein">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Suchen</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Anzeige der Suchergebnisse -->
        <div class="mt-4">
            <?php if (!empty($medications)): ?>
                <?php foreach ($medications as $medication): ?>
                    <div class="card mb-3 medication-item">
                        <div class="card-body">
                            <i class="bi bi-capsule medication-icon"></i>
                            <h3 class="card-title medication-info"><?php echo htmlspecialchars($medication['med_name']); ?></h3>
                            <p class="card-text">Produkttyp: <?php echo htmlspecialchars($medication['product_type']); ?></p>
                            <i class="bi bi-pencil-square" style="font-size: 1.5rem; color: gray; float: right"></i>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Keine Ergebnisse gefunden.</p>
            <?php endif; ?>
        </div>

        <!-- Button zum Hinzufügen neuer Medikamente -->
        <button class="btn add-btn position-fixed" style="bottom: 20px; right: 20px">
            <i class="bi bi-clipboard-plus" style="font-size: 1.5rem"></i>
        </button>
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



