document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");
    const switchLink = document.getElementById("switch-link");

    switchLink.addEventListener("click", function(event) {
        event.preventDefault();

        // Toggle visibility of login and register forms
        loginForm.classList.toggle("hidden");
        registerForm.classList.toggle("hidden");
        
        // Change text of switch link based on current visible form
        if (loginForm.classList.contains("hidden")) {
            switchLink.textContent = "Heb je al een account? Login hier.";
        } else {
            switchLink.textContent = "Nog geen account? Registreer hier.";
        }
    });

    // Handle login form submission
    loginForm.addEventListener("submit", function(event) {
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        if (email === '' || password === '') {
            event.preventDefault();
            document.getElementById('login-error').textContent = 'Please fill in both fields.';
        }
    });

    // Handle register form submission
    registerForm.addEventListener("submit", function(event) {
        const email = document.getElementById("reg-email").value;
        const password = document.getElementById("reg-password").value;

        if (email === '' || password === '') {
            event.preventDefault();
            document.getElementById('register-error').textContent = 'Please fill in both fields.';
        }
    });
});
