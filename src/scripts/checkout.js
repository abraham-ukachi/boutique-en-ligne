import {MAIN_PART, ASIDE_PART, FULL_PART} from "../app.js";
import {SUCCESS_TOAST, GOOD_TOAST, BAD_TOAST, ERROR_TOAST} from "../app.js";

String.prototype.toCardString = function () {
    let lastChar = this.split('').pop();

    let arr = this.replaceAll(' ', '').split('');
    let list = [];
    let count = 0;

    for (let num of arr) {
        list.push(num);

        count += 1;

        if (count === 4) {
            list.push(' ');
            count = 0;
        }

    }
    return list.join('').trim();

}

String.prototype.toExpirationString = function () {


    let arr = this.replaceAll('/', '').split('');
    let list = [];
    let count = 0;
    for (let num of arr) {
        list.push(num);
        count += 1;
        if (count === 2) {
            list.push('/');
            count = 0;
        }
    }

    let lastChar = list[list.length - 1];


    if (lastChar === '/') {
        list.pop();
    }

    return list.join('').trim();
}
let addressForm = document.getElementById('addressForm');
let cardForm = document.getElementById('cardForm');


let deliveryBtn = document.getElementById('delivery');
let addressBtn = document.getElementById('address');
let cardBtn = document.getElementById('card');

let addressReturnBtn = document.getElementById('addressReturn');
let cardReturnBtn = document.getElementById('cardReturn');

let validateBtn = document.getElementById('validateCheckout');

// Inputs second form
let id_address = addressForm.querySelector('input[name="id_address"]');
let id_card = cardForm.querySelector('input[name="id_card"]');

let title = document.getElementById('titleInput');
let address = document.getElementById('addressValue');
let complement = document.getElementById('addressComplementValue');
let city = document.getElementById('cityValue');
let postalCode = document.getElementById('postalCodeValue');
let country = document.getElementById('countryValue');
console.log(address)

// Inputs third form
let nbCard = document.getElementById('nbCardValue');
let expiration = document.getElementById('expirationValue');
let cvv = document.getElementById('cvvValue');

/** ERRORS GESTION **/

address.addEventListener('blur', (ev) => {
    let element = ev.target;
    if (element.validity.valueMissing) {
        mbApp.showInputError(element, "Veuillez renseigner un titre ! ")
    }
})
address.addEventListener('blur', (ev) => {
    let element = ev.target;
    if (element.validity.valueMissing) {
        mbApp.showInputError(element, "Veuillez renseigner une adresse ! ")
    }
})

address.addEventListener('input', (ev) => {
    let element = ev.target;
    if (element.validity.valid) {
        mbApp.clearInputError(element);
    } else if (element.validity.tooShort) {
        mbApp.showInputError(element, "La ville doit contenir au moins 1 caractère !")
    } else if (element.validity.patternMismatch) {
        mbApp.showInputError(element, "Le nom de  la ville ne peut contenir que des lettres !")
    }
})


city.addEventListener('blur', (ev) => {
    let element = ev.target;
    if (element.validity.valueMissing) {
        mbApp.showInputError(element, "Veuillez renseigner une ville ! ")
    }
})

city.addEventListener('input', (ev) => {
    let element = ev.target;
    if (element.validity.valid) {
        mbApp.clearInputError(element);
    } else if (element.validity.tooShort) {
        mbApp.showInputError(element, "La ville doit contenir au moins 1 caractère !")
    } else if (element.validity.patternMismatch) {
        mbApp.showInputError(element, "Le nom de  la ville ne peut contenir que des lettres !")
    }
})

postalCode.addEventListener('blur', (ev) => {
    let element = ev.target;
    if (element.validity.valueMissing) {
        mbApp.showInputError(element, "Veuillez renseigner un code postal ! ")
    }
})

postalCode.addEventListener('input', (ev) => {
    let element = ev.target;
    if (element.validity.valid) {
        mbApp.clearInputError(element);
    } else if (element.validity.tooShort) {
        mbApp.showInputError(element, "La ville doit contenir 5 chiffres !")
    } else if (element.validity.tooLong) {
        mbApp.showInputError(element, "Le code postal ne peut pas excéder 5 chiffres !")
    } else if (element.validity.patternMismatch) {
        mbApp.showInputError(element, "Le code postal ne peut contenir que des chiffres !")
    }
})


country.addEventListener('blur', (ev) => {
    let element = ev.target;
    if (element.validity.valueMissing) {
        mbApp.showInputError(element, "Veuillez renseigner un pays ! ")
    }
})

country.addEventListener('input', (ev) => {
    let element = ev.target;
    if (element.validity.valid) {
        mbApp.clearInputError(element);
    } else if (element.validity.tooShort) {
        mbApp.showInputError(element, "Le nom du pays doit contenir 4 lettres !")
    } else if (element.validity.patternMismatch) {
        mbApp.showInputError(element, "Le nom du pays ne peut contenir que des lettres !")
    }
})


nbCard.addEventListener('blur', (ev) => {
    let element = ev.target;
    if (element.validity.valueMissing) {
        mbApp.showInputError(element, "Veuillez renseigner un numéro de carte ! ")
    }
})


nbCard.addEventListener('input', (ev) => {
    let element = ev.target;
    element.value = element.value.toCardString();

    if (element.validity.valid) {
        mbApp.clearInputError(element);
    } else if (element.validity.tooShort) {
        mbApp.showInputError(element, "Le numéro de la carte doit contenir 16 chiffres !")
    } else if (element.validity.tooLong) {
        mbApp.showInputError(element, "Le numéro de la carte doit contenir 16 chiffres !")
    } else if (element.validity.patternMismatch) {
        mbApp.showInputError(element, "Le numéro de la carte ne peut contenir que des chiffres !")
    }
})

expiration.addEventListener('blur', (ev) => {
    let element = ev.target;
    if (element.validity.valueMissing) {
        mbApp.showInputError(element, "Veuillez renseigner une date d'expiration ! ")
    }
})

expiration.addEventListener('input', (ev) => {
    let element = ev.target;

    let expValue = element.value.toExpirationString();

    console.log(expValue);
    element.value = expValue;

    let date = element.value.split('/');
    let month = Number(date[0]);
    let year = Number(date[1]);

    let currentYear = Number((new Date()).getFullYear().toString().substring(2));
    let dateInvalid = (month > 12) || (year < currentYear) || (year > currentYear + 5);
    console.log('dateInvalid ? ',dateInvalid)
    if (dateInvalid) {
        mbApp.showInputError(element, "La date est invalide !")
    } else if (element.validity.valid) {
        mbApp.clearInputError(element);
    } else if (element.validity.tooShort) {
        mbApp.showInputError(element, "La date d'expiration doit contenir au minimum 4 chiffres!")
    } else if (element.validity.tooLong) {
        mbApp.showInputError(element, "La date d'expiration doit contenir au maximum 4 chiffres!")
    } else if (element.validity.patternMismatch) {
        mbApp.showInputError(element, "Le numéro de la carte ne peut contenir que des chiffres !")
    }
})


cvv.addEventListener('blur', (ev) => {
    let element = ev.target;
    if (element.validity.valueMissing) {
        mbApp.showInputError(element, "Veuillez renseigner un CVV ! ")
    }
})

cvv.addEventListener('input', (ev) => {
    let element = ev.target;
    if (element.validity.valid) {
        mbApp.clearInputError(element);
    } else if (element.validity.tooShort) {
        mbApp.showInputError(element, "Le CVV doit contenir 3 chiffres!")
    } else if (element.validity.tooLong) {
        mbApp.showInputError(element, "Le CVV doit contenir 3 chiffres!")
    } else if (element.validity.patternMismatch) {
        mbApp.showInputError(element, "Le CVV ne peut contenir que des chiffres !")
    }
})


/*
    Tag delivery form then listening it for stock value of radio input
 */

let deliveryForm = document.getElementById('deliveryForm');
deliveryForm.addEventListener('input', (ev) => {
    let deliveryCost = ev.target.value;
});

addressForm.addEventListener('input', (ev) => {
    address.value;
    complement.value;
    city.value;
    postalCode.value;
    country.value;
})


cardForm.addEventListener('input', (ev) => {
    nbCard.value;
    expiration.value;
    cvv.value;
})


/**
 * Listening click on "delivery" next button.
 * Hide delivery form and show address form
 */
deliveryBtn.addEventListener('click', () => {
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
    if (!address.validity.valid ||
        !city.validity.valid ||
        !country.validity.valid ||
        !postalCode.validity.valid ||
        !nbCard.validity.valid ||
        !expiration.validity.valid ||
        !cvv.validity.valid) {
        mbApp.showToast({message: "Tous les champs doivent être remplis !", type: ERROR_TOAST});
        return;
    }

    let form1 = new FormData(deliveryForm);
    let form2 = new FormData(addressForm);
    let form3 = new FormData(cardForm);

    let cardNumber = parseInt(form3.get('nbCard').replaceAll(' ', ''));
    form3.set('nbCard', cardNumber);

    let completeForm = new FormData();

    for (let part1 of form1.entries()) {
        completeForm.append(part1[0], part1[1]);
    }
    for (let part2 of form2.entries()) {
        completeForm.append(part2[0], part2[1]);
    }

    for (let part3 of form3.entries()) {
        completeForm.append(part3[0], part3[1]);
    }

    let url = 'checkout';
    let request = new Request(url, {method: 'POST', body: completeForm})
    let response = await fetch(request);
    let responseData = await response.json();
    if (responseData.success) {
        mbApp.showToast({message: "Vos informations ont été enregitrées!", type: SUCCESS_TOAST}, 3);

    }
})

let addressBtnEls = document.querySelectorAll('.address-list button');
addressBtnEls.forEach(btnEl => {
    btnEl.addEventListener('click', async (ev) => {
        let addressId = ev.currentTarget.dataset.id;
        let url = `address/${addressId}`;
        let headers = new Headers();
        headers.append('Creator', 'axel');

        let request = new Request(url, {method: 'GET', headers: headers});
        let response = await fetch(request);
        let responseData =  await response.json();

        console.log(responseData);
        id_address.value = responseData.id;
        title.value = responseData.title;
        address.value = responseData.address;
        complement.value = responseData.address_complement;
        city.value = responseData.city;
        postalCode.value = responseData.postal_code;
        country.value = responseData.country;


    })
});

let cardBtnEls = document.querySelectorAll('.card-list button');
cardBtnEls.forEach(btnEl => {
    btnEl.addEventListener('click', async (ev) => {
        let cardId = ev.currentTarget.dataset.id;
        let url = `cards/${cardId}`;
        let headers = new Headers();
        headers.append('Creator', 'axel');

        let request = new Request(url, {method: 'GET', headers: headers});
        let response = await fetch(request);
        let responseData =  await response.json();

        console.log(responseData)

        id_card.value = responseData.id;
        nbCard.value = responseData.card_no;
        expiration.value = `${responseData.expiry_month}/${responseData.expiry_year}`;
        cvv.value = responseData.CVV;

        nbCard.dispatchEvent(new CustomEvent('input'));

    })
});
