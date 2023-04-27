import {MAIN_PART, ASIDE_PART, FULL_PART} from "../app.js";
import {SUCCESS_TOAST, GOOD_TOAST, BAD_TOAST, ERROR_TOAST} from "../app.js";

//déclarer le formulaire pour y associer une fonction quand on soumet
let formConnect = document.getElementById('connectionForm');
let inputMail = document.querySelector('#mail');
let inputPass = document.querySelector('#password');

/**
 * Function that fetch login page
 * @param event
 * @returns {Promise<void>}
 */
async function handleFormSubmit(event) {
    event.preventDefault();
    /*
    if (!inputMail.validity.valid ||
        !inputPass.validity.valid) {
        return;
    }*/
    let form = new FormData(event.currentTarget);
    let url = "login";
    let request = new Request(url, {method: "POST", body: form});
    let response = await fetch(request);
    let responseData = await response.json();
    if (responseData.success) {
        mbApp.showToast({message: "La connexion a réussi !", type: SUCCESS_TOAST}, 2);
        setTimeout(() => {
            location.replace("shop");
        }, 2000);
    }
};

formConnect.addEventListener('submit', handleFormSubmit);


/**
 * Event lister for display the error of inputs
 */
inputMail.addEventListener('input', (ev) => {
    let element = ev.target;
    if (element.validity.valid) {
        mbApp.clearInputError(element);
    } else if (element.validity.tooShort) {
        mbApp.showInputError(element, "Votre email est trop court !")
    } else if (element.validity.patternMismatch) {
        mbApp.showInputError(element, "Votre email n'est pas valide")
    }
})

inputMail.addEventListener('blur', (ev) => {
    let element = ev.target;
    if (element.validity.valueMissing) {
        mbApp.showInputError(element, "Veuillez entrer une adresse email !")
    }
})

  /*
inputPass.addEventListener('input', (ev) => {
    let element = ev.target;
    if (element.validity.valid) {
        mbApp.clearInputError(element);
    } else if (element.validity.tooShort) {
        mbApp.showInputError(element, "Le mot de passe doit avoir au moins 8 caractères !")
    } else if (element.validity.patternMismatch) {
        mbApp.showInputError(element, "Votre mot de passe doit contenir au moins 1 chiffre et 1 majuscule")
    }
})

inputPass.addEventListener('blur', (ev) => {
    let element = ev.target;
    if (element.validity.valueMissing) {
        mbApp.showInputError(element, "Veuillez entrer un mot de passe valide (8 caractères minium, 1 majuscule et 1 chiffre)")
    }
})*/

