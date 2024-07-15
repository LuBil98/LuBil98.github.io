<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedHelp Apotheken</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        /* Stil für die Leaflet Karte */
        #map {
            height: 400px;
        }
    </style>
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
                    <li class="nav-item">
                        <a class="nav-link" href="medikamente.php">Medikamente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="erinnerungen.php">Erinnerungen</a>
                    </li>
                    <li class="nav-item active">
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

    <div class="container mt-4">
        <div class="text-center">
            <h1>Apothekensuche</h1>
        </div>

        <div class="mt-4">
            <form class="form-inline my-2 my-lg-0" method="GET" action="">
                <input class="form-control mr-sm-2" type="text" placeholder="Apotheke oder Adresse eingeben" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Suchen</button>
            </form>
        </div>

        <!-- Platz für Kartenansicht -->
        <div id="map" class="mt-4"></div>

        <!-- Platz für Apothekenliste -->
        <div class="mt-4" id="apotheken-liste">
            <?php
        
            // Funktion zur Geocodierung mit Nominatim
            function geocodeAddress($address) {
                $base_url = 'https://nominatim.openstreetmap.org/search';
                $params = [
                    'q' => urlencode($address),
                    'format' => 'json',
                    'addressdetails' => 1,
                    'limit' => 1
                ];
                $url = $base_url . '?' . http_build_query($params);
            
                // Benutzeragenteninformation hinzufügen
                $opts = [
                    'http' => [
                        'header' => "User-Agent: MedHelpApp/1.0\r\n"
                    ]
                ];
                $context = stream_context_create($opts);
                $response = file_get_contents($url, false, $context);
            
                if ($response === false) {
                    die('Fehler beim Abrufen der Daten von der API.');
                }
            
                $data = json_decode($response, true);
            
                if (empty($data)) {
                    return null;
                }
            
                $result = $data[0];
                $lat = $result['lat'];
                $lon = $result['lon'];
            
                return ['lat' => $lat, 'lon' => $lon];
            }
            
            
            
            // Wenn eine Suchanfrage gestellt wurde
            if (isset($_GET['search'])) {
                $search_term = $_GET['search'];
            
                // Adresse in Koordinaten umwandeln
                $coordinates = geocodeAddress($search_term);
            
                // Wenn Koordinaten gefunden wurden
                if ($coordinates) {
                    $lat = $coordinates['lat'];
                    $lon = $coordinates['lon'];
            
                    // Hier könntest du eine API für die Apothekensuche aufrufen
                    // Für dieses Beispiel verwenden wir statische Apotheken
                    // Array mit statischen Apotheken (Beispiel)
                    $apotheken = [
                        ['name' => 'Apotheke A', 'adresse' => 'Musterstraße 1, 12345 Stadt', 'oeffnungszeiten' => 'Mo-Fr 8:00 - 18:00, Sa 9:00 - 13:00'],
                        ['name' => 'Apotheke B', 'adresse' => 'Beispielweg 2, 54321 Ort', 'oeffnungszeiten' => 'Mo-Fr 9:00 - 17:00'],
                        ['name' => 'Apotheke C', 'adresse' => 'Testgasse 3, 67890 Stadt', 'oeffnungszeiten' => 'Mo-Fr 8:30 - 19:00, Sa 10:00 - 14:00']
                    ];
            
                    // Durch alle gefundenen Apotheken iterieren und anzeigen
                    foreach ($apotheken as $apotheke) {
                        echo '<div class="card mb-3">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . htmlspecialchars($apotheke['name']) . '</h5>';
                        echo '<p class="card-text">Adresse: ' . htmlspecialchars($apotheke['adresse']) . '</p>';
                        echo '<p class="card-text">Öffnungszeiten: ' . htmlspecialchars($apotheke['oeffnungszeiten']) . '</p>';
                        echo '<a href="#" class="btn btn-primary">Details</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Keine Koordinaten für die eingegebene Adresse gefunden.</p>';
                }
            } else {
                echo '<p>Bitte geben Sie eine Adresse oder Stadt ein, um nach Apotheken zu suchen.</p>';
            }
            ?>
            

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


