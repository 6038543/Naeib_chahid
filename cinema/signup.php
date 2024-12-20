<?php include 'assets/header.php'; ?>

<script src="jv/encryption.js" defer></script>
<script src="jv/encryption_event.js" defer></script>
<script src="jv/feedback.js" defer></script>

<body>
    <section class="sign_up_center">
        <article>
            <h2>Registratieformulier</h2>
            <form id="signupForm">
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

    <script>
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                alert('Wachtwoorden komen niet overeen!');
                return;
            }

            const encrypted = SimpleEncryption.hashPassword(password);
            
            const formData = {
                username: document.getElementById('username').value,
                email: document.getElementById('email').value,
                passwordHash: encrypted.hash,
                passwordSalt: encrypted.salt
            };

            console.log('Versleutelde data:', formData);
            
        });
    </script>
</body>>

</html>