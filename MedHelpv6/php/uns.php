<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Über uns - MedHelp</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <style>
        body {
            background-color: #d4edda; /* Grün gefärbter Hintergrund */
            font-family: 'Arial', sans-serif; /* Moderner Schriftzug */
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Höhe des Bildschirms */
        }
        .team-card {
            text-align: center;
            margin-bottom: 20px;
            border: none;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .team-card .card-body {
            padding: 20px;
        }
        .team-card h5 {
            margin-bottom: 10px;
            font-size: 1.25rem;
            color: #343a40;
        }
        .team-card p {
            margin-bottom: 0;
            font-size: 1rem;
            color: #6c757d;
        }
        .description p {
            margin-bottom: 1.5rem;
            font-size: 1rem;
            color: #343a40;
        }
        .footer {
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
            <li class="nav-item active">
                    
                
                

            
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
        <h1 class="text-center">Über uns</h1>
        <div class="description mt-4">
            <p>Die Web-App "MedHelp" ist ein benutzerfreundliches Werkzeug für alle, die ihre Medikamentenverwaltung optimieren möchten. Mit MedHelp können Nutzer Medikamente suchen, Informationen zu deren Dosierung und Anwendung erhalten und sie in ihrem persönlichen Profil speichern.</p>
            <p>Das Kernfeature von MedHelp ist die Möglichkeit, individuelle Einnahmepläne zu erstellen und an bevorstehende Termine für die Einnahme von Tabletten zu erinnern. Durch benutzerdefinierte Einstellungen können Nutzer Erinnerungen für spezifische Medikamente und Dosierungen einrichten, um sicherzustellen, dass sie ihre Therapie nicht vergessen.</p>
            <p>Darüber hinaus bietet MedHelp ein persönliches Profil für jeden Nutzer, welches ermöglicht seine medizinische Geschichte, Allergien und andere wichtige Informationen zu hinterlegen. Dies ermöglicht es Ihnen, ihre Medikamentennutzung effektiver zu verwalten und einen Überblick über ihre Gesundheit zu behalten.</p>
            <p>MedHelp strebt danach, die Medikamentenverwaltung so einfach und bequem wie möglich zu gestalten, damit Nutzer ihre Gesundheit im Griff haben und sich auf das Wesentliche konzentrieren können: ihr Wohlbefinden.</p>
        </div>
        
        <h2 class="mt-5">Unser Team</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card team-card">
                    <div class="card-body">
                        <h5 class="card-title">Mikail Sen</h5>
                        <p class="card-text">Student</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card team-card">
                    <div class="card-body">
                        <h5 class="card-title">Mohammad Chalati</h5>
                        <p class="card-text">Student</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card team-card">
                    <div class="card-body">
                        <h5 class="card-title">Luca Bilinsky</h5>
                        <p class="card-text">Student</p>
                    </div>
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


