<?php
session_start();
include 'db.php';  // Verbinding met de database

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Haal de film op uit de database
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM films WHERE id = ?");
    $stmt->execute([$id]);
    $film = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$film) {
        echo "Film niet gevonden!";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];
    $director = $_POST['director'];
    $poster_url = $_POST['poster_url'];

    $stmt = $pdo->prepare("UPDATE films SET title = ?, description = ?, release_year = ?, genre = ?, director = ?, poster_url = ? WHERE id = ?");
    $stmt->execute([$title, $description, $release_year, $genre, $director, $poster_url, $id]);
    
    echo "Film succesvol bijgewerkt!";
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Film Bewerken</title>
</head>
<body>
    <h1>Film Bewerken</h1>
    <form method="POST">
        <input type="text" name="title" value="<?php echo htmlspecialchars($film['title'], ENT_QUOTES, 'UTF-8'); ?>" required><br>
        <textarea name="description" required><?php echo htmlspecialchars($film['description'], ENT_QUOTES, 'UTF-8'); ?></textarea><br>
        <input type="number" name="release_year" value="<?php echo $film['release_year']; ?>" required><br>
        <input type="text" name="genre" value="<?php echo htmlspecialchars($film['genre'], ENT_QUOTES, 'UTF-8'); ?>" required><br>
        <input type="text" name="director" value="<?php echo htmlspecialchars($film['director'], ENT_QUOTES, 'UTF-8'); ?>" required><br>
        <input type="text" name="poster_url" value="<?php echo htmlspecialchars($film['poster_url'], ENT_QUOTES, 'UTF-8'); ?>" required><br>
        <button type="submit">Film Bijwerken</button>
    </form>
</body>
</html>
