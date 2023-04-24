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
    if (responseData.success) {
        mbApp.showToast({message: "La connexion a réussi !", type: SUCCESS_TOAST}, 2);
        setTimeout(() => {
            location.replace("shop");
        }, 2000);
    }
};

formConnect.addEventListener('submit', handleFormSubmit);
