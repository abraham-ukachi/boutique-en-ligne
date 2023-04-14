console.log("Test lien javascript");
//déclarer le formulaire pour y associer une fonction quand on soumet
let formRegister = document.getElementById('registerForm');




/*la fonction login() va fetch l'url
où il y a mon controler qui va lancer
la method PHP avec les paramètres*/
async function register(firstname, lastname, mail, password, passwordConfirm) {
    // user/auth/[*:mail]/[*:password]
    // let response = await fetch(`./login/${mail}/${password}`, {method: 'POST'});
    let response = await fetch(`./register`, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({firstname, lastname, mail, password, passwordConfirm})
    });
    let resData = await response.json();
    console.log(resData);
}

//fonction que va lancer la fonction login() 
//avec valeurs retournées par le formulaire de connexion
function handleFormSubmit(event) {
    event.preventDefault();
    console.log(event);
    let firstname = event.target[0].value;
    let lastname = event.target[1].value;
    let mail = event.target[2].value;
    let password = event.target[3].value;
    let passwordConfirm = event.target[4].value;
    console.log(firstname, lastname, mail, password, passwordConfirm);
    register(firstname, lastname, mail, password, passwordConfirm);
}

//appel de la fonction handleFormSubmit quand on click sur submit
formRegister.addEventListener('submit', handleFormSubmit);




