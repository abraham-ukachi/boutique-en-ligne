import { MAIN_PART, ASIDE_PART, FULL_PART } from "../app.js";
import { SUCCESS_TOAST, GOOD_TOAST, BAD_TOAST, ERROR_TOAST } from "../app.js";

let deliveryBtn = document.getElementById('delivery');
let addressBtn = document.getElementById('address');
let cardBtn = document.getElementById('card');

let addressReturnBtn =  document.getElementById('addressReturn');
let cardReturnBtn = document.getElementById('cardReturn');

let validateBtn = document.getElementById('validateCheckout');

// Inputs second form

let address = document.getElementById('addressValue');
let complement = document.getElementById('addressComplementValue');
let city = document.getElementById('cityValue');
let postalCode = document.getElementById('postalCodeValue');
let country = document.getElementById('countryValue');

// Inputs third form
let nbCard = document.getElementById('nbCardValue');
let expiration = document.getElementById('expirationValue');
let cvv = document.getElementById('cvvValue');

/** ERRORS GESTION **/

address.addEventListener('blur', (ev) => {
    let element = ev.target;
    if(element.validity.valueMissing){
        mbApp.showInputError(element, "Veuillez renseigner votre prénom ! ")
    }
})

/*
    Tag delivery form then listening it for stock value of radio input
 */

let deliveryForm = document.getElementById('deliveryForm');
deliveryForm.addEventListener('input', (ev) => {
    let deliveryCost = ev.target.value;
});

let addressForm = document.getElementById('addressForm');
addressForm.addEventListener('input', (ev) => {
    address.value;
    complement.value;
    city.value;
    postalCode.value;
    country.value;
})

let cardForm = document.getElementById('cardForm');
cardForm.addEventListener('input', (ev) => {
    nbCard.value;
    expiration.value;
    cvv.value;
})



/**
 * Listening click on "delivery" next button.
 * Hide delivery form and show address form
 */
deliveryBtn.addEventListener('click', () =>{
    document.querySelector('.deliveryDiv').hidden = true;
    document.querySelector('.addressDiv').hidden = false;
})

/**
 * Listening click on "address" next button.
 * Hide address form and show card form
 */
addressBtn.addEventListener('click', () => {
    document.querySelector('.addressDiv').hidden = true;
    document.querySelector('.cardDiv').hidden = false;

})

/**
 * Listening click on "address" return button.
 * Hide address form and show delivery form
 */

addressReturnBtn.addEventListener('click', () => {
    document.querySelector('.addressDiv').hidden = true;
    document.querySelector('.deliveryDiv').hidden = false;

})

/**
 * Listening click on "card" return button.
 * Hide card form and show address form
 */
cardReturnBtn.addEventListener('click', () => {
    document.querySelector('.cardDiv').hidden = true;
    document.querySelector('.addressDiv').hidden = false;
})

/**
 * Listening click on "validate" button
 * Prevent default submit
 */
validateBtn.addEventListener('click', async (ev) => {
    ev.preventDefault();

    let form1 = new FormData(deliveryForm);
    let form2 = new FormData(addressForm);
    let form3 = new FormData(cardForm);

    let completeForm = new FormData();

    for (let part1 of form1.entries()) {
        completeForm.append(part1[0], part1[1]);
    }
    for(let part2 of form2.entries()){
        completeForm.append(part2[0], part2[1]);
    }

    for(let part3 of form3.entries()){
        completeForm.append(part3[0], part3[1]);
    }

    let url = 'checkout';
    let request = new Request(url, {method: 'POST', body: completeForm})
    let response = await fetch(request);
    let responseData = await response.json();
    if(responseData.success){
        mbApp.showToast({message: "Vos informations ont été enregitrées!", type: SUCCESS_TOAST},  3);

    }
})

