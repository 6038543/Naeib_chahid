// Wacht tot de DOM geladen is
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('signupForm');
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    const submitButton = form.querySelector('button[type="submit"]');

    // Input event voor gebruikersnaam validatie
    username.addEventListener('input', function(e) {
        if (this.value.length < 3) {
            this.style.borderColor = 'red';
            this.setCustomValidity('Gebruikersnaam moet minimaal 3 karakters bevatten');
        } else {
            this.style.borderColor = 'green';
            this.setCustomValidity('');
        }
        this.reportValidity();
    });

    // Input event voor email validatie
    email.addEventListener('input', function(e) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(this.value)) {
            this.style.borderColor = 'red';
            this.setCustomValidity('Voer een geldig e-mailadres in');
        } else {
            this.style.borderColor = 'green';
            this.setCustomValidity('');
        }
        this.reportValidity();
    });

    // Input event voor wachtwoord sterkte
    password.addEventListener('input', function(e) {
        const strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})/;
        
        if (strongRegex.test(this.value)) {
            this.style.borderColor = 'green';
            this.setCustomValidity('');
        } else {
            this.style.borderColor = 'red';
            this.setCustomValidity('Wachtwoord moet minimaal 8 karakters bevatten, met hoofdletters, kleine letters, cijfers en speciale tekens');
        }
        this.reportValidity();
        
        // Check of wachtwoorden matchen als confirm password al is ingevuld
        if (confirmPassword.value) {
            confirmPassword.dispatchEvent(new Event('input'));
        }
    });

    // Input event voor wachtwoord bevestiging
    confirmPassword.addEventListener('input', function(e) {
        if (this.value !== password.value) {
            this.style.borderColor = 'red';
            this.setCustomValidity('Wachtwoorden komen niet overeen');
        } else {
            this.style.borderColor = 'green';
            this.setCustomValidity('');
        }
        this.reportValidity();
    });

    // Focus events voor visuele feedback
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.backgroundColor = '#fff8dc';
        });
        
        input.addEventListener('blur', function() {
            this.style.backgroundColor = '';
        });
    });

    // Submit event voor form verwerking
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Extra validatie voor submitten
        if (!form.checkValidity()) {
            alert('Vul alstublieft alle velden correct in');
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

        // Disable submit button tijdens verwerking
        submitButton.disabled = true;
        submitButton.textContent = 'Bezig met verwerken...';

        // Simuleer een API call (vervang dit met je echte API call)
        setTimeout(() => {
            console.log('Versleutelde form data:', formData);
            alert('Registratie succesvol!');
            form.reset();
            
            // Reset submit button
            submitButton.disabled = false;
            submitButton.textContent = 'Aanmelden';
            
            // Reset alle border colors
            inputs.forEach(input => input.style.borderColor = '');
        }, 1000);
    });

    // Click event voor submit button feedback
    submitButton.addEventListener('mousedown', function() {
        this.style.transform = 'scale(0.98)';
    });

    submitButton.addEventListener('mouseup', function() {
        this.style.transform = 'scale(1)';
    });
});