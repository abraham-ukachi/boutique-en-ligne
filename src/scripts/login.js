import {MAIN_PART, ASIDE_PART, FULL_PART} from "../app.js";
import {SUCCESS_TOAST, GOOD_TOAST, BAD_TOAST, ERROR_TOAST} from "../app.js";

//déclarer le formulaire pour y associer une fonction quand on soumet
let formConnect = document.getElementById('connectionForm');

/**
 * Function that fetch login page
 * @param event
 * @returns {Promise<void>}
 */
async function handleFormSubmit(event) {
    event.preventDefault();
    let form = new FormData(event.currentTarget);
    let url = "login";
    let request = new Request(url, {method: "POST", body: form});
    let response = await fetch(request);
    let responseData = await response.json();
    checkInputs();
    if (responseData.success) {
        mbApp.showToast({message: "La connexion a réussi !", type: SUCCESS_TOAST}, 2);

        setTimeout(() => {
            location.replace("shop");
        }, 2000);
    }
};

formConnect.addEventListener('submit', handleFormSubmit);

let login = document.querySelector('.login-connect');
let password = document.querySelector('.password-connect');


/**
 * Function that checks inputs value and launch functions for display the errors
 */
function checkInputs() {
    const loginValue = login.value.trim();
    const passwordValue = password.value.trim();

    if (loginValue === '') {
        setErrorFor(login, 'Le login doit faire au moins 3 caractères');
    } else if (loginValue.length >= 3) {
        setSuccessFor(login)
    }
    if (passwordValue === '' || passwordValue.length < 3) {
        setErrorFor(password, 'Le mot de passe doit faire au moins 3 caractères');
    } else if (passwordValue.length >= 3) {
        setSuccessFor(password)
    }
}

function setErrorFor(input, message){
    const inputWrapper = input.parentElement; // .input-wrapper
    const small = formControl.querySelector('small');

    //add error message inside small tag
    small.innerText = message;

    //add error class
    inputWrapper.className = 'input-wrapper error';
}

function setSuccessFor(input, message) {
    const inputWrapper = input.parentElement;
    inputWrapper.className = 'input-wrapper success';
}


