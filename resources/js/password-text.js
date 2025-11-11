let eye_open = document.getElementById("eye-open"),
    eye_close = document.getElementById("eye-close"),

    password = document.getElementById("password"),
    password_confirmation = document.getElementById("password_confirmation");

eye_close.style.display = "none";

eye_open.addEventListener("click", function() {
    eye_open.style.display = "none";
    eye_close.style.display = "block";

    password.type = "text";

    if (password_confirmation) {
        password_confirmation.type = "text";
    }
});

eye_close.addEventListener("click", function() {
    eye_open.style.display = "block";
    eye_close.style.display = "none";

    password.type = "password";

    if (password_confirmation) {
        password_confirmation.type = "password";
    }
});