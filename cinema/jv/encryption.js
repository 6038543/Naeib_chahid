class SimpleEncryption {
    // Genereer een basic salt
    static generateSalt(length = 8) {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let salt = '';
        for (let i = 0; i < length; i++) {
            salt += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return salt;
    }

    // Basic hash functie
    static hash(str) {
        let hash = 0;
        for (let i = 0; i < str.length; i++) {
            const char = str.charCodeAt(i);
            hash = ((hash << 5) - hash) + char;
            hash = hash & hash; // Convert to 32-bit integer
        }
        return Math.abs(hash).toString(16);
    }

    // Hash een wachtwoord
    static hashPassword(password) {
        const salt = this.generateSalt();
        const hash = this.hash(password + salt);
        return {
            hash: hash,
            salt: salt
        };
    }

    // Verifieer een wachtwoord
    static verifyPassword(password, storedHash, storedSalt) {
        const hash = this.hash(password + storedSalt);
        return hash === storedHash;
    }
}