let formSpaceRegister = document.getElementById("formD");
let formSpaceConnection = document.getElementById("formC");
//let br = document.createElement("br");
//let displayFormROk = true;
//let displayFormCOk = true;

/*function displayFormRegister() {
    if (displayFormROk === true) {
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "");
        form.setAttribute("id", "register-form");

        // Create an input element for firstname
        var firstname = document.createElement("input");
        firstname.setAttribute("type", "text");
        firstname.setAttribute("name", "firstname");
        firstname.setAttribute("placeholder", "Prénom");

        // Create an input element for lastname
        var lastname = document.createElement("input");
        lastname.setAttribute("type", "text");
        lastname.setAttribute("name", "lastname");
        lastname.setAttribute("placeholder", "Nom");

        // Create an input element for date of birth
        var DOB = document.createElement("input");
        DOB.setAttribute("type", "text");
        DOB.setAttribute("name", "dob");
        DOB.setAttribute("placeholder", "Date de naissance");

        // Create an input element for emailID
        var mail = document.createElement("input");
        mail.setAttribute("type", "text");
        mail.setAttribute("name", "emailID");
        mail.setAttribute("placeholder", "E-Mail");

        // Create an input element for password
        var PWD = document.createElement("input");
        PWD.setAttribute("type", "password");
        PWD.setAttribute("name", "password");
        PWD.setAttribute("placeholder", "password");

        // Create an input element for retype-password
        var RPWD = document.createElement("input");
        RPWD.setAttribute("type", "password");
        RPWD.setAttribute("name", "reTypePassword");
        RPWD.setAttribute("placeholder", "Confirmer le password");

        // create a submit button
        var submit = document.createElement("input");
        submit.setAttribute("type", "submit");
        submit.setAttribute("value", "Submit");

        // Append the firstname input to the form
        form.appendChild(firstname);

        // Inserting a line break
        form.appendChild(br.cloneNode());

        // Append the lastname to the form
        form.appendChild(lastname);
        form.appendChild(br.cloneNode());

        // Append the DOB to the form
        form.appendChild(DOB);
        form.appendChild(br.cloneNode());

        // Append the emailID to the form
        form.appendChild(mail);
        form.appendChild(br.cloneNode());

        // Append the Password to the form
        form.appendChild(PWD);
        form.appendChild(br.cloneNode());

        // Append the ReEnterPassword to the form
        form.appendChild(RPWD);
        form.appendChild(br.cloneNode());

        // Append the submit button to the form
        form.appendChild(submit);

        document.getElementById("formD")
            .appendChild(form);
        displayFormROk = false;
    }
}*/

// formulaires register en javascript template literal

let registerForm = () => {
    return `
    <form  id='registerForm' action='' method='post'>
    <div class="input-form-container">
        <div class="form-control">
            <label for="firstname">Prénom</label>
            <input id="firstname" class="connect" name="firstname" type="text" value="">
        </div>
        <div class="form-control">
            <label for="lastname">Nom</label>
            <input id="lastname" class="connect" name="lastname" type="text" value="">
        </div>

        <div class="form-control">
            <label for="mail">mail</label>
            <input id="mail" class="connect" name="mail" type="email" value="">
        </div>

        <div class="form-control">
            <label for="password">Mot de passe</label>
            <input id="password" class="connect" name="password" type="password" value="">
        </div>
        <div class="form-control">
            <label for="password">Vérification du mot de passe</label>
            <input id="check-password" class="connect" name="check-password" type="password" value="">
        </div>
        <button type="submit" class="register_form_button" id="envoie" name="envoie">S'enregistrer</button>
    </div>
    </form>
   `
};

// div où on affiche le formulaire en appelant la fonction qui crée le formulaire
formSpaceRegister.innerHTML = registerForm();

//déclarer le formulaire pour y associer une fonction quand on soumet
let formRegister = document.getElementById('registerForm');

/*la fonction register() va fetch l'url
où il y a mon controler qui va lancer
la method PHP avec les paramètres*/
async function register(regFirstname, regLastname, regMail, regPassword, regCheckpassword) {
    let response = await fetch(`../auth.php?regfirstname=${regFirstname}&reglastname=${regLastname}&regmail=${regMail}&regpassword=${regPassword}$regcheckpassword=${regCheckpassword}`);
    let resData = await response.json();
    console.log(resData);
}

//fonction que va lancer la fonction register() 
//avec valeurs retournées par le formulaire d'enregistrement
function registerFormSubmit(event) {
    event.preventDefault();
    console.log(event);
    let regFirstname = event.target[0].value;
    let regLastname = event.target[1].value;
    let regMail = event.target[2].value;
    let regPassword = event.target[3].value;
    let regCheckpassword = event.target[4].value;
    console.log(regFirstname, regLastname, regMail, regPassword, regCheckpassword);
    register(regFirstname, regLastname, regMail, regPassword, regCheckpassword);
}

formRegister.addEventListener('submit', registerFormSubmit);
// formulaires connexion en javascript template literal

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



// div où on affiche le formulaire en appelant la fonction qui crée le formulaire
formSpaceConnection.innerHTML = connexionForm();

//déclarer le formulaire pour y associer une fonction quand on soumet
let formConnect = document.getElementById('connectionForm');

/*la fonction login() va fetch l'url
où il y a mon controler qui va lancer
la method PHP avec les paramètres*/
async function login(mail, password) {
    let response = await fetch(`../auth.php?mail=${mail}&password=${password}`);
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


