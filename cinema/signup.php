<?php include 'assets/header.php'; ?>



<body>
    <section>
        <article>
            <h2>Registratieformulier</h2>
            <form action="/submit-signup" method="POST">
                <label for="username">Gebruikersnaam:</label><br>
                <input type="text" id="username" name="username" required><br><br>

                <label for="email">E-mailadres:</label><br>
                <input type="email" id="email" name="email" required><br><br>

                <label for="password">Wachtwoord:</label><br>
                <input type="password" id="password" name="password" required><br><br>

                <label for="confirm_password">Bevestig wachtwoord:</label><br>
                <input type="password" id="confirm_password" name="confirm_password" required><br><br>

                <button type="submit">Aanmelden</button>
            </form>
        </article>
    </section>
</body>

</html>