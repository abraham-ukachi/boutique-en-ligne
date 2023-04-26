let deliveryBtn = document.getElementById('delivery');
let addressBtn = document.getElementById('address');
let cardBtn = document.getElementById('card');

let addressReturnBtn =  document.getElementById('addressReturn');
let cardReturnBtn = document.getElementById('cardReturn');

let validateBtn = document.getElementById('validateCheckout');

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
validateBtn.addEventListener('click', (ev) => {
    ev.preventDefault();
    console.log('data envoyées');
})
