<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt - MedHelp</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <style>
        body {
            background-color: #d4edda; /* Heller Hintergrund für ein moderneres Aussehen */
            font-family: 'Arial', sans-serif; /* Moderner Schriftzug */
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Höhe des Bildschirms */
        }
        .content {
            flex: 1; /* Füllt den verfügbaren Platz */
        }
        .contact-info {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
        .contact-info h2 {
            color: #343a40;
            font-size: 1.75rem; /* Größerer Titel */
        }
        .contact-info p {
            color: #495057;
            font-size: 1.1rem; /* Größerer und klarerer Text */
            margin-bottom: 15px;
        }
        .contact-info p strong {
            color: #212529;
        }
        footer {
            background: #343a40; /* Dunkler Hintergrund für besseren Kontrast */
            color: #ffffff; /* Heller Text für besseren Kontrast */
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
                <li class="nav-item">
                    <a class="nav-link" href="uns.php">Über uns</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="kontakt.php">Kontakt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Abmelden</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5 content">
        <h1 class="text-center">Kontaktdaten</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="contact-info">
                    
                    <p><strong>Adresse:</strong> Dr.-Arnold-Hueck-Straße 3, 59557 Lippstadt</p>
                    <p><strong>Telefon:</strong> +49 123 456789</p>
                    <p><strong>Email:</strong> mikail.sen@stud.hshl.de, mohamad.chalati@stud.hshl.de, luca.bilinsky@stud.hshl.de</p>
                    <p><strong>Support:</strong> support@medhelp.de</p>
                </div>
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


