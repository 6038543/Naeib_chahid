<?php
session_start();
include 'db.php';  // Verbinding met de database

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Filmgegevens ophalen
$stmt = $pdo->prepare("SELECT * FROM films");
$stmt->execute();
$films = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Beheer Films</title>
</head>
<body>
    <h1>Films Beheren</h1>
    <h2>Films</h2>

    <?php foreach ($films as $film): ?>
        <div class="film">
            <h3><?php echo htmlspecialchars($film['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
            <p><?php echo htmlspecialchars($film['description'], ENT_QUOTES, 'UTF-8'); ?></p>
            <a href="edit_film.php?id=<?php echo $film['id']; ?>">Bewerken</a>
            <a href="delete_film.php?id=<?php echo $film['id']; ?>">Verwijderen</a>
        </div>
    <?php endforeach; ?>

    <h2>Film Toevoegen</h2>
    <form method="POST" action="add_film.php">
        <input type="text" name="title" placeholder="Titel" required><br>
        <textarea name="description" placeholder="Beschrijving" required></textarea><br>
        <input type="number" name="release_year" placeholder="Jaar" required><br>
        <input type="text" name="genre" placeholder="Genre" required><br>
        <input type="text" name="director" placeholder="Regisseur" required><br>
        <input type="text" name="poster_url" placeholder="Poster URL" required><br>
        <button type="submit">Film Toevoegen</button>
    </form>
</body>
</html>
