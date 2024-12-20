<?php
$host = 'localhost';  // of de host van je database
$dbname = 'film_db';
$username = 'root';  // vervang met je database gebruikersnaam
$password = '';  // vervang met je wachtwoord

try {
    // Maak een PDO connectie
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Zet de foutmodus van PDO op uitzondering
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Als er een fout optreedt, wordt de foutmelding weergegeven
    die("Kan geen verbinding maken met de database: " . $e->getMessage());
}
?>
