// Wacht tot de DOM geladen is
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('signupForm');
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    const submitButton = form.querySelector('button[type="submit"]');

    // Functie voor het tonen van feedback
    function showFeedback(message, type) {
        // Verwijder bestaande feedback als die er is
        const existingFeedback = document.querySelector('.feedback-message');
        if (existingFeedback) {
            existingFeedback.remove();
        }

        // Maak nieuw feedback element
        const feedback = document.createElement('div');
        feedback.className = `feedback-message ${type}`;
        feedback.textContent = message;
        
        // Voeg feedback toe aan de pagina
        document.body.appendChild(feedback);

        // Verwijder feedback na 3 seconden
        setTimeout(() => {
            feedback.remove();
        }, 3000);
    }

    // Input event voor gebruikersnaam validatie
    username.addEventListener('input', function(e) {
        if (this.value.length < 3) {
            this.style.borderColor = 'red';
            showFeedback('Gebruikersnaam moet minimaal 3 karakters bevatten', 'error');
        } else {
            this.style.borderColor = 'green';
            showFeedback('Gebruikersnaam is geldig', 'success');
        }
    });

    // Input event voor email validatie
    email.addEventListener('input', function(e) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(this.value)) {
            this.style.borderColor = 'red';
            showFeedback('Voer een geldig e-mailadres in', 'error');
        } else {
            this.style.borderColor = 'green';
            showFeedback('E-mailadres is geldig', 'success');
        }
    });

    // Input event voor wachtwoord sterkte
    password.addEventListener('input', function(e) {
        const strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})/;
        
        if (this.value.length === 0) {
            showFeedback('Voer een wachtwoord in', 'warning');
        } else if (strongRegex.test(this.value)) {
            this.style.borderColor = 'green';
            showFeedback('Wachtwoord is sterk', 'success');
        } else {
            this.style.borderColor = 'orange';
            showFeedback('Wachtwoord moet hoofdletters, kleine letters, cijfers en speciale tekens bevatten', 'warning');
        }
    });

    // Input event voor wachtwoord bevestiging
    confirmPassword.addEventListener('input', function(e) {
        if (this.value === '') {
            showFeedback('Bevestig je wachtwoord', 'warning');
        } else if (this.value !== password.value) {
            this.style.borderColor = 'red';
            showFeedback('Wachtwoorden komen niet overeen', 'error');
        } else {
            this.style.borderColor = 'green';
            showFeedback('Wachtwoorden komen overeen', 'success');
        }
    });

    // Submit event voor form verwerking
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validatie checks
        if (username.value.length < 3) {
            showFeedback('Gebruikersnaam is te kort', 'error');
            return;
        }
        
        if (!email.value.includes('@')) {
            showFeedback('Ongeldig e-mailadres', 'error');
            return;
        }

        if (password.value !== confirmPassword.value) {
            showFeedback('Wachtwoorden komen niet overeen', 'error');
            return;
        }

        // Encryptie van wachtwoord
        const encrypted = SimpleEncryption.hashPassword(password.value);
        
        // Verzamel form data
        const formData = {
            username: username.value,
            email: email.value,
            passwordHash: encrypted.hash,
            passwordSalt: encrypted.salt
        };

        // Toon success feedback
        showFeedback('Registratie succesvol! Je wordt doorgestuurd...', 'success');
        
        // Simuleer een API call
        setTimeout(() => {
            console.log('Form data:', formData);
            form.reset();
        }, 2000);
    });
});