import { MAIN_PART, ASIDE_PART, FULL_PART } from "../app.js";
import { SUCCESS_TOAST, GOOD_TOAST, BAD_TOAST, ERROR_TOAST } from "../app.js";

//déclarer le formulaire pour y associer une fonction quand on soumet
let formRegister = document.getElementById('registerForm');
let inputFirstname = document.getElementById('firstname');
let inputLastname = document.getElementById('lastname');
let inputMail = document.getElementById('mail')
let inputPassword = document.getElementById('password');
let inputPasswordConfirm = document.getElementById('check-password');

//fonction que va lancer la fonction login() 
//avec valeurs retournées par le formulaire de connexion
async function handleFormSubmit(event) {
    event.preventDefault();
    if(!inputFirstname.validity.valid ||
        !inputLastname.validity.valid ||
        !inputMail.validity.valid ||
        !inputPassword.validity.valid ||
        !inputPasswordConfirm.validity.valid){
        return;
    }

    let form = new FormData(event.currentTarget);
    let url = "register";
    let request = new Request(url, {method: 'POST', body: form});
    let response = await fetch(request);
    let responseData = await response.json();
    if(responseData.success){
        mbApp.showToast({message: "L'inscription a réussi !", type: SUCCESS_TOAST},  2);

        setTimeout(() => {
            location.replace("login");
        }, 2000);
    }
};

//appel de la fonction handleFormSubmit quand on click sur submit
formRegister.addEventListener('submit', (event) => handleFormSubmit(event));


inputFirstname.addEventListener('input', (ev) => {
    let element = ev.target;
    if(element.validity.valid){
        mbApp.clearInputError(element);
    }else if(element.validity.tooShort){
        mbApp.showInputError(element, "Votre prénom doit contenir au moins 1 lettre !")
    }
})

inputFirstname.addEventListener('blur', (ev) => {
    let element = ev.target;
    if(element.validity.valueMissing){
        mbApp.showInputError(element, "Veuillez renseigner votre prénom ! ")
    }
})


inputLastname.addEventListener('input', (ev) => {
    let element = ev.target;
    if(element.validity.valueMissing){
        mbApp.showInputError(element, "Veuillez renseigner votre nom !")
    }
})

inputLastname.addEventListener('blur', (ev) => {
    let element = ev.target;
    if(element.validity.valueMissing){
        mbApp.showInputError(element, "Veuillez renseigner votre nom ! ")
    }
})


inputMail.addEventListener('input', (ev) => {
    let element = ev.target;
    if(element.validity.valid){
        mbApp.clearInputError(element);
    }else if(element.validity.tooShort){
        mbApp.showInputError(element, "Votre email est trop court !")
    }else if(element.validity.patternMismatch) {
        mbApp.showInputError(element, "Votre email n'est pas valide")
    }
})

inputMail.addEventListener('blur', (ev) => {
    let element = ev.target;
    if(element.validity.valueMissing){
        mbApp.showInputError(element, "Veuillez entrer une adresse email !")
    }
})

inputPassword.addEventListener('input', (ev) => {
    let element = ev.target;
    if(element.validity.valid){
        mbApp.clearInputError(element);
    }else if(element.validity.tooShort){
        mbApp.showInputError(element, "Le mot de passe doit avoir au moins 8 caractères !")
    }else if(element.validity.patternMismatch) {
        mbApp.showInputError(element, "Votre mot de passe doit contenir au moins 1 minuscule, 1 majuscule et 1 chiffre")
    }
})

inputPassword.addEventListener('blur', (ev) => {
    let element = ev.target;
    if(element.validity.valueMissing){
        mbApp.showInputError(element, "Veuillez entrer un mot de passe valide (8 caractères minium, 1 majuscule et 1 chiffre)")
    }
})

inputPasswordConfirm.addEventListener('input', (ev) => {
    let element = ev.target;
    if(inputPasswordConfirm.value !== inputPassword.value){
        mbApp.showInputError(element, "Les mots de passe ne correspondent pas");
    }else{
        mbApp.clearInputError(element);
    }
})

