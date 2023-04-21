import { MAIN_PART, ASIDE_PART, FULL_PART } from "../app.js";
import { SUCCESS_TOAST, GOOD_TOAST, BAD_TOAST, ERROR_TOAST } from "../app.js";

//déclarer le formulaire pour y associer une fonction quand on soumet
let formRegister = document.getElementById('registerForm');

//fonction que va lancer la fonction login() 
//avec valeurs retournées par le formulaire de connexion
async function handleFormSubmit(event) {
    event.preventDefault();

    let form = new FormData(event.currentTarget);
    let url = "register";
    let request = new Request(url, {method: 'POST', body: form});
    let response = await fetch(request);
    let responseData = await response.json();
    console.log(responseData)
    if(responseData.success){
        mbApp.showToast({message: "L'inscription a réussi !", type: SUCCESS_TOAST},  3);

        setTimeout(() => {
            location.replace("login", 3000);
        })
    }
};

//appel de la fonction handleFormSubmit quand on click sur submit
formRegister.addEventListener('submit', (event) => handleFormSubmit(event));




