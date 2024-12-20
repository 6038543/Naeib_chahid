<?php
session_start();
include 'db.php';  // Verbinding met de database

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Verwijder de film uit de database
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM films WHERE id = ?");
    $stmt->execute([$id]);
    
    echo "Film succesvol verwijderd!";
    header('Location: dashboard.php');
    exit;
}
?>
