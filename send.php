<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_get["Name"]));
    $email = filter_var(trim($_POST["E-Mail"]), FILTER_SANITIZE_EMAIL);
    $betrieb = strip_tags(trim($_POST["Betrieb"]));
    $nachricht = strip_tags(trim($_POST["Nachricht"]));

    $empfaenger = "info@stubbedesign.de";
    $betreff = "Neue Kontaktanfrage von: $name";

    $inhalt = "Name: $name\n";
    $inhalt .= "E-Mail: $email\n";
    $inhalt .= "Betrieb/Gewerk: $betrieb\n\n";
    $inhalt .= "Nachricht:\n$nachricht\n";

    $header = "From: $email\r\n" .
              "Reply-To: $email\r\n" .
              "X-Mailer: PHP/" . phpversion();

    if (mail($empfaenger, $betreff, $inhalt, $header)) {
        // Weiterleitung nach Erfolg (z.B. zurück zur Kontaktseite mit Erfolgshinweis)
        header("Location: kontakt.html?status=success");
    } else {
        header("Location: kontakt.html?status=error");
    }
} else {
    header("Location: kontakt.html");
}
?>
