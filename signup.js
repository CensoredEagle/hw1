const formStatus = {
    name: false,
    surname: false,
    username: false,
    email: false,
    password: false,
    confirm_password: false,
    allow: false,
};

function toggleError(container, valid) {
    if (valid) {
        container.classList.remove('errorj');
    } else {
        container.classList.add('errorj');
    }
}

function checkName(event) {
    const input = event.currentTarget;
    formStatus.name = input.value.trim().length > 0;
    toggleError(input.parentNode, formStatus.name);
}

function checkSurname(event) {
    const input = event.currentTarget;
    formStatus.surname = input.value.trim().length > 0;
    toggleError(input.parentNode, formStatus.surname);
}

function jsonCheckUsername(json) {
    formStatus.username = !json.exists;
    const container = document.querySelector('.username');
    const span = container.querySelector('span');
    if (formStatus.username) {
        toggleError(container, true);
        span.textContent = "";
    } else {
        span.textContent = "Nome utente già utilizzato";
        toggleError(container, false);
    }
}

function jsonCheckEmail(json) {
    formStatus.email = !json.exists;
    const container = document.querySelector('.email');
    const span = container.querySelector('span');
    if (formStatus.email) {
        toggleError(container, true);
        span.textContent = "";
    } else {
        span.textContent = "Email già utilizzata";
        toggleError(container, false);
    }
}

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function checkUsername(event) {
    const input = event.currentTarget;
    const value = input.value.trim();
    const container = input.parentNode;
    const span = container.querySelector('span');

    if (!/^[a-zA-Z0-9_]{1,15}$/.test(value)) {
        span.textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        toggleError(container, false);
        formStatus.username = false;
    } else {
        span.textContent = "Verifico disponibilità...";
        fetch("check_username.php?q=" + encodeURIComponent(value))
            .then(fetchResponse)
            .then(jsonCheckUsername)
            .catch(() => {
                span.textContent = "Errore nella verifica username";
                toggleError(container, false);
                formStatus.username = false;
            });
    }
}

function checkEmail(event) {
    const input = event.currentTarget;
    const value = input.value.trim().toLowerCase();
    const container = input.parentNode;
    const span = container.querySelector('span');

    const emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!emailRegex.test(value)) {
        span.textContent = "Email non valida";
        toggleError(container, false);
        formStatus.email = false;
    } else {
        span.textContent = "Verifico disponibilità...";
        fetch("check_email.php?q=" + encodeURIComponent(value))
            .then(fetchResponse)
            .then(jsonCheckEmail)
            .catch(() => {
                span.textContent = "Errore nella verifica email";
                toggleError(container, false);
                formStatus.email = false;
            });
    }
}

function checkPassword(event) {
    const input = event.currentTarget;
    formStatus.password = input.value.length >= 8;
    toggleError(input.parentNode, formStatus.password);

    checkConfirmPassword();
}

function checkConfirmPassword(event) {
    const passwordInput = document.querySelector('.password input');
    const confirmInput = document.querySelector('.confirm_password input');

    formStatus.confirm_password = confirmInput.value === passwordInput.value && confirmInput.value.length > 0;
    toggleError(confirmInput.parentNode, formStatus.confirm_password);
}

function checkAllow(event) {
    const checkbox = event.currentTarget;
    formStatus.allow = checkbox.checked;
    toggleError(checkbox.parentNode, formStatus.allow);
}

function checkSignup(event) {
    const checkbox = document.querySelector('.allow input');
    formStatus.allow = checkbox.checked;
    toggleError(checkbox.parentNode, formStatus.allow);

    console.log("Stato del form:", formStatus);

    if (Object.values(formStatus).includes(false)) {
        event.preventDefault();
        alert("Compila correttamente tutti i campi e accetta i termini.");
        return false;
    }
}

document.querySelector('.name input').addEventListener('blur', checkName);
document.querySelector('.surname input').addEventListener('blur', checkSurname);
document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('input', checkPassword);
document.querySelector('.confirm_password input').addEventListener('input', checkConfirmPassword);
document.querySelector('.allow input').addEventListener('change', checkAllow);
document.querySelector('form').addEventListener('submit', checkSignup);
