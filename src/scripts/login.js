import { MAIN_PART, ASIDE_PART, FULL_PART } from "../app.js";
import { SUCCESS_TOAST, GOOD_TOAST, BAD_TOAST, ERROR_TOAST } from "../app.js";

//déclarer le formulaire pour y associer une fonction quand on soumet
let formConnect = document.getElementById('connectionForm');

async function handleFormSubmit(event){
    event.preventDefault();
    let form = new FormData(event.currentTarget);
    let url = "login";
    let request = new Request(url, {method: "POST", body: form});
    let response = await fetch(request);
    let responseData = await response.json();
    if(responseData.success){
        mbApp.showToast({message: "La connexion a réussi !", type: SUCCESS_TOAST},  2);

        setTimeout(() => {
            location.replace("shop");
        }, 2000);
    }
};

formConnect.addEventListener('submit', handleFormSubmit);


//formRegister.addEventListener('submit', registerFormSubmit);
// formulaires connexion en javascript template literal
/*
let connexionForm = (mail = 'jean@gmail.com', password = 'azerty') => {
    return `
    <form  id='connectionForm' action='' method='post'>
    <div class="input-form-container">
        <div class="form-control">
            <label for="mail">mail</label>
            <input id="mail" class="connect" name="mail" type="email" value=${mail}>
            <small>Erreur</small>
        </div>

        <div class="form-control">
            <label for="password">Mot de passe</label>
            <input id="password" class="connect" name="password" type="password" value="${password}">
            <small>Erreur</small>
        </div>
        <button type="submit" class="connection_form_button" id="envoie" name="envoie">Se connecter</button>
    </div>
    </form>
   `
};
*/


/*la fonction login() va fetch l'url
où il y a mon controler qui va lancer
la method PHP avec les paramètres*/


/*
//fonction que va lancer la fonction login() 
//avec valeurs retournées par le formulaire de connexion
function handleFormSubmit(event) {
    event.preventDefault();
    console.log(event);
    let mail = event.target[0].value;
    let password = event.target[1].value;
    console.log(mail, password);
    login(mail, password);
}
/*
 */





