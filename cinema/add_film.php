<?php
session_start();
include 'db.php';  // Verbinding met de database

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];
    $director = $_POST['director'];
    $poster_url = $_POST['poster_url'];

    $stmt = $pdo->prepare("INSERT INTO films (title, description, release_year, genre, director, poster_url) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $description, $release_year, $genre, $director, $poster_url]);
    
    echo "Film succesvol toegevoegd!";
    header('Location: dashboard.php');
    exit;
}
?>
