<?php 
include 'assets/header.php'; 
session_start();
include 'db.php';  // Verbinding met de database

// Debugging: Zet een var_dump om te controleren of de data goed wordt verzonden
// var_dump($_POST);  // Dit kan je gebruiken om te controleren of de data in $_POST staat

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Controleer of 'username' en 'password' bestaan in $_POST
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];  // Haal de gebruikersnaam op
        $password = $_POST['password'];  // Haal het wachtwoord op

        // Geparameteriseerde query om SQL-injectie te voorkomen
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Sla gebruikersinformatie op in de sessie
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header('Location: dashboard.php');
            exit;
        } else {
            echo "Onjuiste gebruikersnaam of wachtwoord.";
        }
    } else {
        echo "Vul zowel de gebruikersnaam als het wachtwoord in.";
    }
}
?>

<body>
    <div class="container">
        <h1>LOGIN</h1>
        <form action="#" method="POST" class="login-form">
            <label for="username">Gebruikersnaam:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit" class="login-btn">LOGIN</button>

        </form>
        <footer class="footer-text">
            YOUR VISION. FAST. ON-TIME.<br>
            DELIVERED TO YOUR CREATIVE STANDARDS.
        </footer>
    </div>
</body>
</html>
