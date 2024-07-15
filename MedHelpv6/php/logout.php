<?php
require_once('mysql.php');
?>
<?php
// Starte die Sitzung
session_start();

// Überprüfe, ob eine Sitzung aktiv ist
if(isset($_SESSION['username'])) {
    // Sitzungsvariablen löschen
    session_unset();

    // Sitzung zerstören
    session_destroy();
}

// Weiterleitung zur Login-Seite
header("Location: index.php");
exit;

