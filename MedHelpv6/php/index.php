<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" href="../favicon.ico" type="image/x-icon" />
    <link rel="manifest" href="manifest.json" />
    <link rel="apple-touch-icon" href="img/icon-128.png" />
    <meta name="theme-color" content="#00FE9C" />
    <meta name="apple-mobile-web-app-status-bar" content="#02BC74" />
    <title>MedHelp Anmelden</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/home.css" />
</head>
<body>
<?php
require_once('mysql.php');
session_start();
if (isset($_SESSION['username'])) {
    header("Location: geheim.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('mysql.php');
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $mysql->prepare("SELECT * FROM accounts WHERE username = :username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: geheim.php");
        exit;
    } else {
        $error = "Ungültiger Benutzername oder Passwort.";
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">
        <img src="../img/icon-128.png" width="30" height="30" class="d-inline-block align-top" alt="MedHelp logo" />
        MedHelp
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Über uns</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Kontakt</a>
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-body text-center">
                    <img src="../img/icon-512.png" alt="Logo" width="150" />
                    <h2 class="mt-3">Anmelden</h2>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form class="mt-4" method="post" action="">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Benutzername" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Passwort" required />
                        </div>
                        <div class="form-group">
                            <a href="#">Passwort vergessen?</a>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Anmelden</button>
                    </form>
                    <p class="mt-3">Noch kein Konto? <a href="registrieren.php">Registrieren</a></p>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="#" data-toggle="modal" data-target="#datenschutzModal">Datenschutzerklärung</a> |
                <a href="#" data-toggle="modal" data-target="#nutzungsbedingungenModal">Nutzungsbedingungen</a>
            </div>
        </div>
    </div>
</div>

<!-- Modale für Datenschutzerklärung und Nutzungsbedingungen -->
<div class="modal fade" id="datenschutzModal" tabindex="-1" role="dialog" aria-labelledby="datenschutzModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="datenschutzModalLabel">Datenschutzerklärung</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Schließen">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Datenschutzerklärung Inhalt hier einfügen -->
                <p>Muster für Datenschutzhinweise für Websites nicht-öffentlicher Stellen
Stand: Juli 2019
Für jede Website werden personenbezogene Daten erhoben (siehe unten, I.2., Daten, die für
die Bereitstellung der Website und die Erstellung der Protokolldateien
verarbeitet werden).
Das folgende Muster dient als Beispiel für Datenschutzhinweise für „einfache“ Websites von
nicht-öffentlichen Betreibern.
Jede Datenschutzerklärung ist dabei den individuellen Anforderungen anzupassen.
Die Datenschutzerklärung muss ergänzt werden, sofern zum Beispiel Cookies oder andere
aktive Inhalte wie dynamische Werbeeinblendungen oder Videoplayer eingesetzt werden, ein
Kontaktformular oder Kommentarfunktionen angeboten oder Social-Media-Plugins
verwendet werden. Einige andere Punkte müssen gegebenenfalls gekürzt werden (wenn
zum Beispiel kein Hoster eingeschaltet wird oder kein Datenschutzbeauftragter zu benennen
ist).
Die Hinweise zum Datenschutz müssen den Nutzerinnen und Nutzern zum Zeitpunkt der
Datenerhebung zur Verfügung gestellt werden. Das bedeutet, dass der Link zu den
Datenschutzhinweisen von jeder einzelnen Seite des Webangebotes aus unmittelbar mit
einem Klick erreichbar sein muss
2
LDI NRW – Muster für Datenschutzhinweise für Websites nicht-öffentlicher Stellen
DATENSCHUTZHINWEISE
I. Informationen über die Verarbeitung Ihrer Daten gemäß Art. 13 der
Datenschutz-Grundverordnung (DS-GVO)
1. Verantwortlicher und Datenschutzbeauftragter
Verantwortlich für diese Website ist
[Name, Postadresse, E-Mail-Adresse des Verantwortlichen].
Den Datenschutzbeauftragten erreichen Sie per E-Mail unter
[E-Mail-Adresse des Datenschutzbeauftragten]
oder über die Adresse
[ggf. auch die Postadresse des Datenschutzbeauftragten].
2. Daten, die für die Bereitstellung der Website und die Erstellung der
Protokolldateien verarbeitet werden
a. Welche Daten werden für welchen Zweck verarbeitet?
Bei jedem Zugriff auf Inhalte der Website werden vorübergehend Daten gespeichert, die
möglicherweise eine Identifizierung zulassen. Die folgenden Daten werden hierbei
erhoben:
- Datum und Uhrzeit des Zugriffs
- IP-Adresse
- Hostname des zugreifenden Rechners
- Website, von der aus die Website aufgerufen wurde
- Websites, die über die Website aufgerufen werden
- Besuchte Seite auf unserer Website
- Meldung, ob der Abruf erfolgreich war
- Übertragene Datenmenge
- Informationen über den Browsertyp und die verwendete Version
- Betriebssystem
Die vorübergehende Speicherung der Daten ist für den Ablauf eines Websitebesuchs
erforderlich, um eine Auslieferung der Website zu ermöglichen. Eine weitere
Speicherung in Protokolldateien erfolgt, um die Funktionsfähigkeit der Website und die
Sicherheit der informationstechnischen Systeme sicherzustellen. In diesen Zwecken liegt
auch unser berechtigtes Interesse an der Datenverarbeitung.
b. Auf welcher Rechtsgrundlage werden diese Daten verarbeitet?
Die Daten werden auf der Grundlage des Art. 6 Abs. 1 Buchstabe f DS-GVO verarbeitet.
c. [Bei Bedarf] Gibt es neben dem Verantwortlichen weitere Empfänger der
personenbezogenen Daten?
Die Website wird bei [Name, Postadresse, E-Mail-Adresse des Hosters] gehostet. Der
Hoster empfängt die oben genannten Daten als Auftragsverarbeiter.
3
LDI NRW – Muster für Datenschutzhinweise für Websites nicht-öffentlicher Stellen
d. Wie lange werden die Daten gespeichert?
Die Daten werden gelöscht, sobald sie für die Erreichung des Zwecks ihrer Erhebung
nicht mehr erforderlich sind. Bei der Bereitstellung der Website ist dies der Fall, wenn die
jeweilige Sitzung beendet ist. Die Protokolldateien werden […, maximal bis zu 24
Stunden] direkt und ausschließlich für Administratoren zugänglich aufbewahrt. Danach
sind sie nur noch indirekt über die Rekonstruktion von Sicherungsbändern verfügbar und
werden nach […, maximal vier Wochen] endgültig gelöscht.
3. Betroffenenrechte
a. Recht auf Auskunft
Sie können Auskunft nach Art. 15 DS-GVO über Ihre personenbezogenen Daten
verlangen, die wir verarbeiten.
b. Recht auf Widerspruch
Sie haben ein Recht auf Widerspruch aus besonderen Gründen (siehe unter Punkt II).
c. Recht auf Berichtigung
Sollten die Sie betreffenden Angaben nicht (mehr) zutreffend sein, können Sie nach Art.
16 DS-GVO eine Berichtigung verlangen. Sollten Ihre Daten unvollständig sein, können
Sie eine Vervollständigung verlangen.
d. Recht auf Löschung
Sie können nach Art. 17 DS-GVO die Löschung Ihrer personenbezogenen Daten
verlangen.
e. Recht auf Einschränkung der Verarbeitung
Sie haben nach Art. 18 DS-GVO das Recht, eine Einschränkung der Verarbeitung Ihrer
personenbezogenen Daten zu verlangen.
f. Recht auf Beschwerde
Wenn Sie der Ansicht sind, dass die Verarbeitung Ihrer personenbezogenen Daten
gegen Datenschutzrecht verstößt, haben Sie nach Ar. 77 Abs. 1 DS-GVO das Recht,
sich bei einer Datenschutzaufsichtsbehörde eigener Wahl zu beschweren. Hierzu gehört
auch die für den Verantwortlichen zuständige Datenschutzaufsichtsbehörde:
Landesbeauftragte für Datenschutz und Informationsfreiheit Nordrhein-Westfalen,
https://www.ldi.nrw.de/kontakt/ihre-beschwerde.
g. Recht auf Datenübertragbarkeit
Für den Fall, dass die Voraussetzungen des Art. 20 Abs. 1 DS-GVO vorliegen, steht
Ihnen das Recht zu, sich Daten, die wir auf Grundlage Ihrer Einwilligung oder in
Erfüllung eines Vertrags automatisiert verarbeiten, an sich oder an Dritte aushändigen
zu lassen. Die Erfassung der Daten zur Bereitstellung der Website und die Speicherung
der Protokolldateien sind für den Betrieb der Internetseite zwingend erforderlich. Sie
beruhen daher nicht auf einer Einwilligung nach Art. 6 Abs. 1 Buchstabe a DS-GVO oder
auf einem Vertrag nach Art. 6 Abs. 1 Buchstabe b DS-GVO, sondern sind nach Art. 6
Abs. 1 Buchstabe f DS-GVO gerechtfertigt. Die Voraussetzungen des Art. 20 Abs. 1 DSGVO sind demnach insoweit nicht erfüllt.
4
LDI NRW – Muster für Datenschutzhinweise für Websites nicht-öffentlicher Stellen
II. Recht auf Widerspruch gemäß Art. 21 Abs. 1 DS-GVO
Sie haben das Recht, aus Gründen, die sich aus Ihrer besonderen Situation ergeben,
jederzeit gegen die Verarbeitung Ihrer personenbezogenen Daten, die aufgrund von
Artikel 6 Abs. 1 Buchstabe f DS-GVO erfolgt, Widerspruch einzulegen. Der
Verantwortliche verarbeitet die personenbezogenen Daten dann nicht mehr, es sei denn,
er kann zwingende schutzwürdige Gründe für die Verarbeitung nachweisen, die die
Interessen, Rechte und Freiheiten der betroffenen Person überwiegen, oder die
Verarbeitung dient der Geltendmachung, Ausübung oder Verteidigung von
Rechtsansprüchen. Die Erfassung der Daten zur Bereitstellung der Website und die
Speicherung der Protokolldateien sind für den Betrieb der Internetseite zwingend
erforderlich.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="nutzungsbedingungenModal" tabindex="-1" role="dialog" aria-labelledby="nutzungsbedingungenModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nutzungsbedingungenModalLabel">Nutzungsbedingungen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Schließen">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Nutzungsbedingungen Inhalt hier einfügen -->
                <p>Haftungsausschluss


Diese sind Muster-Nutzungsbedingungen (die "Musterbedingungen"). Die Musterbedingungen werden Ihnen von EventMobi als Referenzdokument zur Verfügung gestellt, nur um die Erstellung geeigneter Nutzungsbedingungen für Sie in Verbindung mit Ihren Veranstaltungen zu erleichtern. In Ihrer Organisation können Umstände und Probleme auftreten, die von diesen Musterbedingungen abweichen oder nicht abgedeckt sind. Diese Musterbedingungen werden "ohne Mängelgewähr" ohne jegliche Zusicherungen, Gewährleistungen oder Bedingungen zur Verfügung gestellt, dass die Musterbedingungen den geltenden Gesetzen entsprechen. Wir lehnen ausdrücklich alle anderen Zusicherungen, Gewährleistungen und Bedingungen, ausdrücklich oder stillschweigend, in Bezug auf Ihre Verwendung dieser Musterbedingungen ab. Es wird empfohlen, rechtlichen Rat einzuholen, bevor Sie die Musterbedingungen verwenden. EventMobi haftet nicht für nachteilige Folgen, die sich aus der Verwendung dieser Musterbedingungen ergeben. Das Vertrauen, das Sie diesen Musterbedingungen entgegenbringen, geschieht auf Ihr eigenes Risiko. Sie verstehen und stimmen zu, dass EventMobi Ihnen gegenüber nicht für Verluste oder Schäden haftet, die Ihnen im Zusammenhang mit Ihrer Nutzung der Musterbedingungen entstehen könnten. Wenn Sie Teile dieser Erklärung übernehmen, ersetzen Sie EventMobi mit Ihrem Unternehmensnamen.

 

Allgemeine Geschäftsbedingungen für die Nutzung der auf eventmobi.com angebotenen Dienste und Leistungen

Die EventMobi GmbH (im Folgenden „EventMobi“) stellt über ihre Internetseiten und als Mobile Application (Event-App) in den einschlägigen App Stores einen Onlinedienst zur Verfügung („EventMobi-Plattform“), mit dessen Hilfe Veranstalter (im Folgenden „Veranstalter“) von Kongressen, Messen und anderen Veranstaltungen (im Folgenden zusammen „Events“) das jeweilige Event verwalten, managen und gestalten können und Eventteilnehmer (im Folgenden „Nutzer“ genannt) bestimmte Informationen über das Event erhalten können. Die nachfolgenden Bedingungen regeln vorwiegend die entgeltliche Nutzung der Event App durch den Veranstalter, aber auch die unentgeltliche Nutzung durch die Eventteilnehmer.

Geltungsbereich
1.1  EventMobi stellt über die üblichen Webbrowser oder in den App Stores eine Online-Plattform (“EventMobi-Plattform“) zur Verfügung, die es Veranstaltern ermöglicht, ihre Veranstaltung über die dort zur Verfügung gestellte Event App und dazugehörige Tools (Registrierung, Digital Signage und ähnliche) zu verwalten, zu organisieren und inhaltlich zu gestalten. Den Eventteilnehmern wird ermöglicht, auf die Event-App, die Online-Registrierung und die EventMobi-Plattform über einen Link zuzugreifen, und über die Event-App die Teilnahme zu verwalten und Informationen über die Veranstaltung zu bekommen.  Der Veranstalter kontrolliert selbstständig und eigenverantwortlich die Inhalte der Event-App und der EventMobi-Plattform über ein Verwaltungssystem, welches online abgerufen werden kann (im Folgenden „CMS“)

1.2  Diesen AGB entgegenstehende oder von diesen abweichende Allgemeine Geschäfts- oder Vertragsbedingungen der Veranstalter erkennt EventMobi nicht an, es sei denn der Geltung wird ausdrücklich schriftlich zugestimmt. Die AGB gelten auch dann, wenn EventMobi in Kenntnis entgegenstehender oder von diesen Bedingungen abweichender Bedingungen des Nutzers oder Veranstalters die Dienstleistung gegenüber dem Nutzer oder Veranstalter vorbehaltlos ausführt.

Einverständniserklärung
2.1  Der Veranstalter erklärt sich mit den nachfolgenden AGB, den Allgemeinen Geschäftsbedingungen von EventMobi, abrufbar unter http://go.eventmobi.com/de/agb, sowie den Datenschutzbestimmungen, abrufbar unter http://go.eventmobi.com/de/privacy, bei der Registrierung und Einrichtung des EventMobi-Accounts einverstanden, indem er die Erklärung: „Ich habe die AGB, die Allgemeinen Geschäftsbedingungen und die Datenschutzbestimmungen der EventMobi GmbH gelesen“ durch Klicken auf den Button “Ja“ bei der Registrierung bestätigt.

2.2  Der Nutzer erklärt sich mit Nutzung der EventMobi-Plattform  und der Event- App mit der Geltung der AGB einverstanden.

2.3  EventMobi kann im Rahmen der gesetzlichen Bestimmungen die AGB jederzeit ändern oder ergänzen. Bei Änderungen der AGB erhält der Veranstalter einen Hinweis, der ihn zur Zustimmung auffordert. Im Falle eines Widerspruchs kann von beiden Seiten das Vertragsverhältnis sofort beendet werden.

Registrierung
3.1 Voraussetzung für die Nutzung der EventMobi-Plattform durch die Veranstalter ist eine zunächst für den Veranstalter kostenlose Registrierung auf der Plattform unter http://www.eventmobi.com/de. Der Teilnehmer kann die teilnehmerbezogenen Features der Event-App auch ohne eine Registrierung unter Anerkennung der AGB nutzen.

3.2 Mit der Registrierung und der Einrichtung des EventMobi-Accounts hat der Veranstalter die Möglichkeit die Event App zunächst 14 Tage kostenlos zu testen („Testzugang“) und sämtliche Anwendungen der Software zu nutzen. Der Testzugang wird automatisch beendet. Kurz vor Ablauf der kostenlosen Testphase unterbreitet EventMobi dem Veranstalter ein schriftliches Angebot, dass die weitere nunmehr entgeltliche Nutzung der Event-App zu den in der Preisliste des Angebotes benannten Preisen anbietet. Mit Annahme des Angebotes durch den Veranstalter, kommt es zum Abschluss des Vertrages („Lizenzvertrag“) über die Nutzung der EventApp. Der Testzugang darf dabei nicht bei einer realen Veranstaltung eingesetzt werden.

3.3 Jeder registrierte Veranstalter erhält zeitlich unbefristet einen eigenen EventMobi-Account. Die Nutzung der EventApp richtet sich nach dem unter Ziffer 5 festgelegten Lizenzbedingungen

3.4 Mit der Registrierung und der Einrichtung des Eventmobi-Accounts kann der Veranstaltungsteilnehmer sämtliche teilnehmerbezogenen Anwendungen der Event-App nutzen und erhält, jeweils abhängig von dem Veranstalter, auch die Möglichkeit über die Plattform die Teilnahmegebühr zu entrichten. In diesen Fällen wird die Zahlung der Teilnahmegebühr ausschließlich via Kreditkarte über den Paymentdienstleister Stripe abgewickelt, der im Rahmen der Zahlungsabwicklung Informationen über die Bestellung (Name, Anschrift, Kontonummer, Bankleitzahl, evtl. Kreditkartennummer, Rechnungsbetrag, Währung und Transaktionsnummer) abfragt. EventMobi zieht die Teilnahmegebühr weder auf eigene Rechnung noch auf Rechnung des Veranstalters ein und hat auf den Bezahlvorgang keinen Einfluss.

 

Vertragspflichten
4.1 Mit Abschluss des Lizenzvertrages verpflichtet sich EventMobi für die Dauer des Vertrages den Zugang zur Plattform bereitzustellen und aufrechtzuerhalten.

4.2 EventMobi bietet dem Veranstalter darüber hinaus die Möglichkeit, seine eigenen Inhalte hochzuladen. Dabei kann es sich um Daten aller Art handeln, insbesondere Informationen, Texte, Marken, Kennzeichen bzw. Aufnahmen einschließlich Werbung Dritter, die im Zusammenhang mit der Veranstaltung von oder für den Veranstalter in die Event-App eingestellt werden können oder im Laufe der Veranstaltung eingestellt werden („EventMobi-Content“).

4.3 EventMobi erbringt ausdrücklich keine Programmierleistungen gegenüber dem Veranstalter und stellt dem Veranstalter auch keine eigenen Inhalte zur Verfügung. Der Veranstalter ist allein für den Upload, die Bearbeitung und Verwendung des EventMobi-Contents verantwortlich und entscheidet allein, welche Inhalte in welchem Umfang als EventMobi-Content verwendet werden. EventMobi vermietet oder verkauft keinerlei Hardware.

4.4 Der Veranstalter verpflichtet sich bis spätestens 30 Tage nach Abschluss des Lizenzvertrages die den Kaufpreis für die Nutzung der Event-App zu begleichen. Mit Bereitstellung des Zugangs durch Zusendung des Links ist der Kaufpreis fällig. Alle Preise sind Nettopreise.

 

Rechteeinräumung
5.1 EventMobi räumt dem Veranstalter mit der Registrierung zunächst für die Dauer von 14 Tagen das nicht exklusive, unentgeltliche, widerrufliche und nicht übertragbare Recht ein, die EventApp bis zum Ablauf des Testzuganges zu nutzen. Mit Zustandekommen des Lizenzvertrages kann der Veranstalter die EventApp im Rahmen des Lizenzvertrages weiternutzen. Der Testzugang gemäß Ziffer 3.2 darf nicht für reale Veranstaltungen genutzt werden.

5.2 EventMobi räumt dem Veranstalter im Rahmen des Lizenzvertrages das nicht exklusive, nicht übertragbare und nicht unterlizenzierbare weltweite Recht ein, die Event-App für ein Jahr nach Ende der jeweiligen Veranstaltung ab Abschluss des Lizenzvertrages zu nutzen.

5.3 Der Veranstalter räumt EventMobi hiermit das nicht-ausschließliche, zeitlich, räumlich und inhaltlich unbeschränkte Recht ein, den EventMobi-Content im Rahmen der Dienstleistung umfassend, zu nutzen und zu verwerten. Nach Vertragsbeendigung löscht EventMobi auf Aufforderung des Veranstalters den EventMobi-Content.

 

Nutzungseinschränkungen
6.1 Mit Ausnahme der hier im Rahmen der AGB ausdrücklich eingeräumten Rechte, ist es dem Veranstalter ohne schriftliche Zustimmung von EventMobi nicht erlaubt,

den durch EventMobi zur Verfügung gestellten Zugang zur Event-App, zum Verkauf anzubieten, auf Dritte zu übertragen, Unterlizenzen zu erteilen, zu bearbeiten und zu verändern.
die Event App unter oder im Namen eines Dritten zu benutzen,
die über EventMobi erlangten Daten nicht länger als 1 Jahr zu speichern.
Spätestens nach Ablauf der Veranstaltung sind die über EventMobi erlangten Daten durch den Veranstalter zu löschen.

6.2 Es ist weiter nicht erlaubt die Event-App und/oder den EventMobi-Content im Zusammenhang mit der Benutzung von Produkten, Dienstleistungen oder Materialien zu verwenden, welche Nachfolgendes unterstützen, dafür genutzt werden oder dafür eingerichtet sind:

für Spyware, Adware und/oder andere schädliche Programme oder Codes; nachgemachte Waren; unerwünschte Versendung von Massen-E-Mails („spam“);
Handlungen, die darauf abzielen Suchmaschinen dahingehend irrezuführen, dass bestimmte Seiten höher gelistet werden, als sie üblicherweise gelistet wären („web spam“);
für illegale mehrstufige Vertriebsangebote, illegalen Direktvertrieb und/oder Telefonvertrieb;
Hassinhalte; beleidigende, diffamierende, ausfällige oder anderweitig anzügliche Inhalte;
Prostitution; gestohlene Produkte und/ oder Gegenstände, die im Zusammenhang mit Straftaten genutzt werden; Hacker-, Überwachungs-, Abhörungs-                oder Entschlüsselungseinrichtungen; illegales Glücksspiel;
6.3 Der EventMobi-Content darf in keiner Weise und für keine Zwecke verwendet werden, die gegen geltendes Recht verstoßen.

6.4 Die Event-App und/oder der EventMobi-Content dürfen nur derart verwendet werden, dass dadurch keine Beeinträchtigungen und Störungen an den Internetseiten „eventmobi.com“, dem EventMobi-Server und der EventMobi-Daten entstehen.

 

Gewährleistung
7.1 Dem Nutzer ist bekannt, dass nach dem Stand der Technik Fehler in Softwareprogrammen und in der dazugehörigen Dokumentation nicht ausgeschlossen werden können und dass es nicht möglich ist, Datenverarbeitungsprogramme so zu entwickeln, dass sie für alle Anwendungsbedingungen und alle Anforderungen des Nutzers fehlerfrei sind bzw. fehlerfrei mit allen Programmen und Hardware Dritter zusammenarbeiten.

7.2  Der Veranstalter hatte in der Testphase ausreichend Gelegenheiten die Funktionen der Event-App zu testen. Ungeachtet dessen gewährleistet EventMobi einen Leistungszeitraum der Event-App von 24 Stunden pro Tag und sieben Tage die Woche. Die Software ist einsatzfähig mit einer Verfügbarkeit von 99,9 % im Jahresmittel. Ausgenommen von dieser Zeit sind Ausfallzeiten durch Software-Updates, welche überwiegend in den Abendstunden von 18.00 Uhr bis 24.00 Uhr vorgenommen werden.

7.3  Weiterhin ausgenommen von dieser Zeit sind Zeiten, in denen der Dienst aufgrund von technischen oder sonstigen Problemen, die nicht im Einfluss von EventMobi liegen nicht möglich ist. Dies betrifft zum Beispiel technische Störungen an den Endgeräten, der Internetabdeckung oder höhere Gewalt oder das Verschulden Dritter.

7.4  EventMobi wird auf den gängigsten mobilen Geräten unterstützt. Die genaue Auflistung dieser Geräte erhalten Sie jederzeit von uns. EventMobi kann, zu jedem Zeitpunkt und ohne Ankündigung die Unterstützung von verschiedenen Geräten oder Betriebssystemen einstellen oder erweitern. Existierende Apps werden hiervon nicht berührt.

7.5 Weitere Zusicherungen von bestimmten Eigenschaften oder über die Gebrauchstauglichkeit für die individuell vom Veranstalter geplante Anwendung, werden von EventMobi nicht abgegeben.

7.6 Den Teilnehmer betreffende Dienstleistungen werden dem Teilnehmer von EventMobi unentgeltlich zur Verfügung gestellt. Die Gewährleistung für Sach- und Rechtsmängel im Hinblick auf die unentgeltliche Überlassung von Leistungen werden auf den Fall des arglistigen Verschweigens von Mängeln durch EventMobi beschränkt.

 

Freistellung
8.1 Die Nutzung der Event-App und des EventMobi-Content geschieht auf eigene Gefahr. Der Veranstalter stellt EventMobi von allen Ansprüchen Dritter (einschließlich der anfallenden Rechtsverfolgungskosten) frei, die aus der Nutzung der Event-App und des EventMobi-Content resultieren, sei es durch eigene Nutzung, sei es, dass Dritte das Passwort oder den Account mit oder ohne Kenntnis des Veranstalters verwenden. Die Freistellung gilt insbesondere für Verluste, die EventMobi               oder Dritten aufgrund der nicht vertragsgemäßen Nutzung der Event-App, des Accounts oder Passwortes durch einen Dritten entstehen.

8.2 Es ist dem Nutzer nicht gestattet, den Account eines Dritten ohne dessen Erlaubnis zu nutzen. Der Nutzer verpflichtet sich, EventMobi unverzüglich über jeden nicht-autorisierten, durch Hacking, Password-Mining oder andere Mittel erreichten Zugang zu anderen Accounts, Computersystemen oder Netzwerken, die mit einem EventMobi-Server         verbunden sind, oder zu anderen Diensten, zu informieren.

 

Haftung
9.1 Schadensersatzansprüche gegen EventMobi, durch die oder im Zusammenhang mit der Verwendung der Event-App, des EventMobi-Content (zusammen „Dienste“), der Zurverfügungstellung von oder Ausbleiben  des Zurverfügungtellens von Diensten oder durch über Dienste zugängliche Informationen entstanden sind, insbesondere ein Ersatz von indirekten Schäden, Folgeschäden oder sonstige Schäden, die aus Nutzungsausfall, Verlust           von Daten oder entgangenem Gewinn resultieren, können vom Nutzer nur geltend gemacht werden bei:

(i) grobem Verschulden von EventMobi, ihrer gesetzlichen Vertreter oder Erfüllungsgehilfen;

(ii) der schuldhaften Verletzung wesentlicher Vertragspflichten, soweit die Erreichung des       Vertragszwecks hierdurch gefährdet wird, hinsichtlich des vertragstypischen, voraussehbaren Schadens, in der Schadenshöhe jedoch begrenzt auf die Höhe des

(iii) Schäden aus der Verletzung des Lebens, des Körpers oder der Gesundheit, die auf einer fahrlässigen Pflichtverletzung von EventMobi oder einer vorsätzlichen oder fahrlässigen Pflichtverletzung eines gesetzlichen Vertreters oder Erfüllungsgehilfen EventMobi beruhen oder

(iv) Haftung von EventMobi nach dem Produkthaftungsgesetz für Personenschäden oder Sachschäden an privat genutzten Gegenständen.

9.2 Die vorstehenden Haftungsbeschränkungen und Freistellungen gelten auch für Ansprüche            gegen Angestellte, Arbeitnehmer, Mitarbeiter, Vertreter und Erfüllungsgehilfen von EventMobi.

Beendigung
10.1 Der Veranstalter oder Nutzer kann seinen EventMobi-Account jederzeit kündigen, indem er    dies mit einer Nachricht an info@eventmobi.de fordert. Die Kündigung befreit den     Veranstalter nicht von seiner Zahlungsverpflichtung.

10.2 Der EventMobi-Account des Veranstalters ist durch EventMobi jederzeit aus wichtigem         Grund (u.a. Verstoß gegen die AGB) kündbar. Im Übrigen ist die Vertragslaufzeit auf ein Jahr  begrenzt. Der Teilnehmer-Account kann nach der Veranstaltung von EventMobi jederzeit ohne Angabe von Gründen mit einer Frist von 4 Wochen per E-Mail gekündigt werden.

10.3 Der Nutzer wird ausdrücklich darauf hingewiesen, dass mit Beendigung dieses Vertrages       sämtliche durch EventMobi eingeräumten Lizenzen im Rahmen dieser       Bedingungen   erlöschen.

10.4 Bei Beendigung ist der Nutzer unverzüglich verpflichtet, alle Daten, die er im Zusammenhang mit der Nutzung des Event-App erlangt hat, auf allen mit diesen Daten bearbeiteten Websites, Scripts, Widgets, Applications und anderer Software zu entfernen und diese zu löschen.

Schlussbestimmungen
11.1  Sollte eine Bestimmung nichtig sein oder werden, bleiben die übrigen Bestimmungen gültig. An die Stelle der unwirksamen Bestimmung tritt eine wirksame, wirtschaftlich möglichst   gleichartige Bestimmung.

11.2 Besondere Vereinbarungen und Nebenabreden bedürfen zu ihrer Wirksamkeit der   Schriftform. Von dieser Schriftformklausel kann nur durch schriftliche Vereinbarung    abgewichen werden. Änderungen und Ergänzungen der vorliegenden Bedingungen sind nur wirksam, wenn sie von uns schriftlich bestätigt werden sind.

11.3 Für alle Rechtsbeziehungen zwischen EventMobi und dem Nutzer gilt, auch wenn dieser seinen Sitz im Ausland hat, ausschließlich deutsches Recht unter Ausschluss des UN-Kaufrechts.

11.4 Gerichtsstand ist soweit zulässig Berlin.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

