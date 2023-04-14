console.log("Test lien javascript");
//déclarer le formulaire pour y associer une fonction quand on soumet
let formConnect = document.getElementById('connectionForm');


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
async function login(mail, password) {
    // user/auth/[*:mail]/[*:password]
    // let response = await fetch(`./login/${mail}/${password}`, {method: 'POST'});
    let response = await fetch(`./login`, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({mail, password})
    });
    let resData = await response.json();
    console.log(resData);
}

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

//appel de la fonction handleFormSubmit quand on click sur submit
formConnect.addEventListener('submit', handleFormSubmit);




