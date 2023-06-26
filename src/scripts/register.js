/* 
* @license MIT
* boutique-en-ligne (maxaboom) 
* Copyright (c) 2023 Abraham Ukachi, Axel Vair, Morgane Marechal, Catherine Tranchand . The Maxaboom Project Contributors.
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in all
* copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*
* @name: Register Page
* @codename: registerPage 
* @type: Script
* @author: Axel Vair <axel.vair@laplateforme.io>, 
* @contributors: Abraham Ukachi <abraham.ukachi@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
*
* Example usage:
*  
*   1-|> // 
*    -|>
*    -|>
*
*/

// Import a couple of important stuff ;)
import { SUCCESS_TOAST, GOOD_TOAST, BAD_TOAST, ERROR_TOAST, NORMAL_TOAST } from '../app.js'; // <- toasts
import { MAIN_PART, ASIDE_PART, FULL_PART } from '../app.js'; // <- parts

"use strict"; 
// ^^^^^^^^^ This keeps us on our toes, as it forces us to use all pre-defined variables, among other things 😅




/**
 * Class representing the register page
 */
class RegisterPage  {

  // Declaring some properties...

  // public properties

  // min lengths
  minFirstNameLength = 2;
  minLastNameLength = 2;
  minEmailLength = 5;
  minPasswordLength = 8;

  // max lengths
  maxFirstNameLength = 30;
  maxLastNameLength = 30;
  maxEmailLength = 50; 
  maxPasswordLength = 64; // <- recommended by NIST (National Institute of Standards and Technology) https://www.nist.gov/itl/tig/projects/special-publication-800-63

  // private properties
  
  // patterns
  _firstNamePattern = /^[a-zA-ZÀ-ÿ]+$/;
  _lastNamePattern = /^[a-zA-ZÀ-ÿ]+$/;
  _emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  // password patterns
  _passwordBasePattern = /^[a-zA-Z0-9]+/;
  _passwordUppercasePattern = /^(?=.*[A-Z])/; 
  _passwordLowercasePattern = /^(?=.*[a-z])/;
  _passwordNumberPattern = /^(?=.*\d)/;
  _passwordSpecialCharacterPattern = /^(?=.*[!@#$%^&*()\-_=+{};:,<.>?])/;
  _passwordSpacePattern = /^(?=.*\s)/;







  /**
   * The constructor of the class
   */
  constructor() {

    // mbApp.i18n.dataLoaded = (data) => console.log('I18n has been loaded!!!!');


    // install the event listeners
    this._installEventListeners();

    // install prototype methods
    this._installPrototypeMethods();
    
    // focus on the email input
    this.emailInput.focus();


    // HACK: After 1 seconds...
    setTimeout(() => {
      // update the page title
      mbApp.setTitle(mbApp.i18n.getString('register') + ' - ' + mbApp.i18n.getString('appName'));
    }, 1000);


  }


  /**
   * Method that is called whenever the maxaboom app (mbApp) is ready
   *
   * @params { Object } i18n locale strings data
   */
  ready(data) {

    // initialize the input validation messages
    this._initInputValidationMessages();

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[32m[ready]: data => \x1b[0m`, data);
  }

  // PUBLIC SETTERS

  // PUBLIC GETTERS

  /**
   * Returns the `<button id="menuButton">` element
   *
   * @returns { HTMLButtonElement }
   */
  get menuButton() {
    return document.getElementById('menuButton');
  }


  /**
   * Returns the `<form id="registerForm">` element
   *
   * @returns { HTMLFormElement }
   */
  get registerForm() {
    return document.getElementById('registerForm');
  }

  /**
   * Returns the `<input id="firstname">` element
   *
   * @returns { HTMLInputElement }
   */
  get firstNameInput() {
    return document.getElementById('firstname');
  }

  /**
   * Returns the `<input id="lastname">` element
   *
   * @returns { HTMLInputElement }
   */
  get lastNameInput() {
    return document.getElementById('lastname');
  }

  /**
   * Returns the `<input id="mail">` element
   *
   * @returns { HTMLInputElement }
   */
  get emailInput() {
    return document.querySelector('#mail');
  }


  /**
   * Returns the `<input id="password">` element
   *
   * @returns { HTMLInputElement }
   */
  get passwordInput() {
    return document.querySelector('#password');
  }

  /**
   * Returns the `<input id="confirmPassword">` element
   *
   * @returns { HTMLInputElement }
   */
  get confirmPasswordInput() {
    return document.querySelector('#confirmPassword');
  }

  /**
   * Returns the `<button id="registerButton">` element
   *
   * @returns { HTMLButtonElement }
   */
  get registerButton() {
    return document.querySelector('#registerButton');
  }

  /**
   * Returns the `<span id="passwordSpinner">` element
   *
   * @returns { HTMLSpanElement }
   */
  get passwordSpinner() {
    return document.querySelector('#passwordSpinner');
  }


  /**
   * Returns the `<span id="emailSpinner">` element
   *
   * @returns { HTMLSpanElement }
   */
  get emailSpinner() {
    return document.querySelector('#emailSpinner');
  }


  /**
   * Returns the `<button id="registerMenuItem">` element
   *
   * @returns { HTMLButtonElement }
   */
  get registerMenuItem() {
    return document.getElementById('registerMenuItem');
  }


  /**
   * Returns the `<button id="clearFormMenuItem">` element
   *
   * @returns { HTMLButtonElement }
   */
  get clearFormMenuItem() {
    return document.getElementById('clearFormMenuItem');
  }


  /**
   * Reurns the `<span id="registerDoodle">` element
   *
   * @returns { HTMLSpanElement }
   */
  get registerDoodle() {
    return document.getElementById('registerDoodle');
  }


  // PUBLIC METHODS









  // PRIVATE SETTERS

  // PRIVATE GETTERS

  // PRIVATE METHODS


  /**
   * Method used to install event listeners on the register page
   */
  _installEventListeners() {
  
    // If there's a menu button...
    if (this.menuButton) {
      // add a click event listener to it
      this.menuButton.addEventListener('click', this._menuButtonClickHandler.bind(this));
    }

    // If there's a register form...
    if (this.registerForm) {
      // add a submit event listener to it
      this.registerForm.addEventListener('submit', this._registerFormSubmitHandler.bind(this));
      // add a reset event listener to it
      this.registerForm.addEventListener('reset', this._registerFormResetHandler.bind(this));
    }

    // If there's a first name input...
    if (this.firstNameInput) {
      // add an input event listener to it
      this.firstNameInput.addEventListener('input', this._firstNameInputHandler.bind(this));
      // add a blur event listener to it
      this.firstNameInput.addEventListener('blur', this._firstNameInputBlurHandler.bind(this));
    }

    // If there's a last name input...
    if (this.lastNameInput) {
      // add an input event listener to it
      this.lastNameInput.addEventListener('input', this._lastNameInputHandler.bind(this));
      // add a blur event listener to it
      this.lastNameInput.addEventListener('blur', this._lastNameInputBlurHandler.bind(this));
    }
    
    // If there's an email input...
    if (this.emailInput) {
      // add an input event listener to it
      this.emailInput.addEventListener('input', this._emailInputHandler.bind(this));
      // add a blur event listener to it
      this.emailInput.addEventListener('blur', this._emailInputBlurHandler.bind(this));
    }


    // If there's a password input...
    if (this.passwordInput) {
      // add an input event listener to it
      this.passwordInput.addEventListener('input', this._passwordInputHandler.bind(this));
      // add a blur event listener to it
      this.passwordInput.addEventListener('blur', this._passwordInputBlurHandler.bind(this)); 
    }

    // If there's a confirm password input...
    if (this.confirmPasswordInput) {
      // add an input event listener to it
      this.confirmPasswordInput.addEventListener('input', this._confirmPasswordInputHandler.bind(this));
      // add a blur event listener to it
      this.confirmPasswordInput.addEventListener('blur', this._confirmPasswordInputBlurHandler.bind(this));
    }


    // If there's a register menu item...
    if (this.registerMenuItem) {
      // ...add a click event listener to it
      this.registerMenuItem.addEventListener('click', this._registerMenuItemClickHandler.bind(this));
    }


    // If there's a clear form menu item...
    if (this.clearFormMenuItem) {
      // ...add a click event listener to it
      this.clearFormMenuItem.addEventListener('click', this._clearFormMenuItemClickHandler.bind(this));
    }

  }
  
  
  /**
   * Method used to install prototype methods on the register page
   */
  _installPrototypeMethods() {
    // add the `startLoading` method to the `HTMLButtonElement` prototype
    HTMLButtonElement.prototype.startLoading = function() {
      // add the `loading` class to the button
      this.classList.add('loading');
    }

    // add the `start` method to the `HTMLButtonElement` prototype
    HTMLButtonElement.prototype.stopLoading = function() {
      // remove the `loading` class to the button
      this.classList.remove('loading');
    }


    // add the `start` method to the `HTMLSpanElement` prototype
    HTMLSpanElement.prototype.start = function() {
      // add the `active` attribute to the span element
      this.setAttribute('active', '');
    }

    // add the `start` method to the `HTMLSpanElement` prototype
    HTMLSpanElement.prototype.stop = function() {
      // remove the `active` attribute from the span element
      this.removeAttribute('active');
    }
  }



  /*
   * Handler that is called whenever the menu button is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   */
  _menuButtonClickHandler(event) {
    // show the register menu
    mbApp.showMenuById('registerMenu', 0.5, MAIN_PART);
    
    // DEBUG [4dbsmaster]: tell me about the event ;)
    console.log(`\x1b[40m;\x1b[33m[_menuButtonClickHandler]: event => \x1b[0m`, event);
  }


  /**
   * Handler that is called whenever the register form is submitted
   *
   * @param { SubmitEvent } event - The event that triggered the handler
   */
  _registerFormSubmitHandler(event) {
    // prevent the default behavior of the event
    event.preventDefault();

    // get all the inputs in the register form as `allInputs`
    const allInputs = event.currentTarget.querySelectorAll('input');

    // loop through all the inputs in the register form
    for (let input of allInputs) {
      // clear the input error
      mbApp.clearInputError(input);

      // if the input is invalid...
      if (!input.checkValidity()) {
        // ...show a toast
        mbApp.showToast({message: input.validationMessage, type: ERROR_TOAST, part: MAIN_PART}, 2, true);
        // show the input error
        mbApp.showInputError(input, input.validationMessage);
        // focus the input
        input.focus();
        // ...and break out of the loop
        return;
      }
    }



    let form = new FormData(event.currentTarget);

    // create a 1 second delay
    const delay = 1000;

    // start loading the register button
    this.registerButton.startLoading();

    // TODO: disabled all inputs in the register form

    // SIMULATION: After the above delay...
    setTimeout(() => {
      // ...register with the form data
      this._registerWithFormData(form).then((response) => {
        // stop loading the register button
        this.registerButton.stopLoading();

        // reset the register form
        this.registerForm.reset();

        // show a toast
        mbApp.showToast({message: mbApp.i18n.getString('registerSuccessful'), type: SUCCESS_TOAST}, 2);

        // open the app's dialog too ;)
        mbApp.openDialog({
          title: mbApp.i18n.getString('congratulations'),
          message: mbApp.i18n.getString('registerSuccessMessage'),
          confirmBtnText: mbApp.i18n.getString('login'),
          cancelBtnText: mbApp.i18n.getString('goHome'),
          onConfirm: () => mbApp.closeDialog('dialog', 0.5, MAIN_PART).then(() => mbApp.navigate('login')),
          onCancel: () => mbApp.closeDialog('dialog', 0.5, MAIN_PART).then(() => mbApp.navigate('home')),
          noDivider: false,
          isCancelable: true,
          focusOnConfirm: true 
        }, 0.5, MAIN_PART);
        
        // add success class to the register doodle in aside part 
        this.registerDoodle.classList.add('success');

        // DEBUG [4dbsmaster]: tell me about the response
        console.log(`\x1b[40m;\x1b[33m[_registerFormSubmitHandler]: response => \x1b[0m`, response);

      }).catch((error) => { // <- if the register fails...

        // stop loading the register button
        this.registerButton.stopLoading();

        // open the app's dialog accordingly ;)
        mbApp.openDialog({
          title: mbApp.i18n.getString('oops'),
          message: mbApp.i18n.getString('registerFailedMessage'),
          confirmBtnText: mbApp.i18n.getString('tryAgain'),
          cancelBtnText: mbApp.i18n.getString('cancel'),
          onConfirm: () => mbApp.closeDialog('dialog', 0.5, MAIN_PART).then(() => this.emailInput.focus()),
          onCancel: () => mbApp.closeDialog('dialog', 0.5, MAIN_PART).then(() => mbApp.navigate('home')),
          noDivider: false,
          isCancelable: true
        }, 0.5, MAIN_PART);

        // DEBUG [4dbsmaster]: tell me about the error
        console.log(`\x1b[31m[_registerFormSubmitHandler]: error.message => %s & error => \x1b[0m`, error.message, error);
        
      });

    }, delay); 

  }



  /**
   * Method used to register with the given form data
   *
   * @param { FormData } form - The form data to register with
   * @returns { Promise }
   * @private
   */
  _registerWithFormData(form) {
    return new Promise(async (resolve, reject) => {

      let url = "register";
      let request = new Request(url, {method: "POST", body: form});
      let response = await fetch(request);
      let responseData = await response.json();

      // DEBUG [4dbsmaster]: tell me about the response data
      console.log(`\x1b[40;33m[_registerWithFormData]: responseData => \x1b[0m`, responseData);

      // resolve or reject the promise based on the response data's success property
      (responseData.success) ? resolve(responseData) : reject(responseData);

    });
  }


  /**
   * Checks if the given `password` is common or not
   * NOTE: This method fetches the common passwords from the server, 
   * and checks if the given `password` is in the list of common passwords
   *
   * @param { String } password - The password to check
   *
   * @returns { Promise }
   * @private
   */
  _checkPasswordIsCommon(password) {
    return new Promise(async (resolve) => {
      
      let url = `password/${password}/common`;
      let request = new Request(url);
      let response = await fetch(request);
      let responseData = await response.json();

      // DEBUG [4dbsmaster]: tell me about the response data
      console.log(`\x1b[40;33m[_checkCommonPassword]: responseData => \x1b[0m`, responseData);

      // TEST: After a simulated delay of 1 second...
      // TODO: Remove this simulation for production
      setTimeout(() => {
        // ...resolve the promise with the response data
        resolve(responseData);
      }, 1000);

    });
  }


  /**
   * Checks if the given `email` is already in use
   *
   * @param { String } email - The email to check
   *
   * @returns { Promise }
   * @private
   */
  _checkCustomerEmail(email) {
    return new Promise(async (resolve) => {
      
      let url = `email/${email}/customer-check`;
      let request = new Request(url);
      let response = await fetch(request);
      let responseData = await response.json();

      // DEBUG [4dbsmaster]: tell me about the response data
      console.log(`\x1b[40;33m[_checkCustomerEmail]: responseData => \x1b[0m`, responseData);

      // TEST: After a simulated delay of 1 second...
      // TODO: Remove this simulation for production
      setTimeout(() => {
        // ...resolve the promise with the response data
        resolve(responseData);
      }, 1000);

    });
  }
  /**
   * Handler that is called whenever the register form is reset
   *
   * @param { Event } event - The event that triggered the handler
   */
  _registerFormResetHandler(event) {
    // create a list of inputs to clear
    const inputsToClear = [
      this.firstNameInput, 
      this.lastNameInput, 
      this.emailInput, 
      this.passwordInput, 
      this.confirmPasswordInput
    ];




    setTimeout(() => {
      // Trigger the email & password input events 
      this._triggerInputEvents();

      // loop through each input in the list
      inputsToClear.forEach((input) => {
        // clear the input error
        mbApp.clearInputError(input);
      });

      // reset the password input type
      this.passwordInput.type = 'password';

      // reset the confirm password input type
      this.confirmPasswordInput.type = 'password';

    }, 30); // <- HACK: wait for 30 miliseconds for the form to reset before triggering the input events
    
  }


  /**
   * Handler that is called whenever the input event is triggered
   *
   * @param { InputEvent } event - The event that triggered the handler
   */
  _firstNameInputHandler(event) {
    // get the input element
    let element = event.target;


    // if the input is empty...
    if (element.validity.valueMissing) {
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('pleaseEnterYourFirstName'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('pleaseEnterYourFirstName'));

    } else if (element.validity.tooShort) { // <- if the input is too short...
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('yourFirstNameMin2Chars'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('yourFirstNameMin2Chars'));

    } else if (element.validity.tooLong) { // <- if the input is too long...
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('yourFirstNameTooLong'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('yourFirstNameTooLong'));

    } else if (!this._firstNamePattern.test(element.value)) { // <- if the input doesn't match the first name pattern...
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('pleaseEnterAValidFirstName'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('pleaseEnterAValidFirstName'));

    } else { // <- if the input is valid...
      // ...remove the input error
      mbApp.clearInputError(element);
      // empty the custom validity message of the input
      element.setCustomValidity('');
    }


  }



  /**
   * Handler that is called whenever the `blur` event is triggered on the first name input
   *
   * @param { FocusEvent } event - The event that triggered the handler
   */
  _firstNameInputBlurHandler(event) {
    // get the input element
    let element = event.target;

    // if there's no value...
    if (element.validity.valueMissing) {
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('pleaseEnterYourFirstName'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('pleaseEnterYourFirstName'));
    }
    
  }



  /**
   * Handler that is called whenever the last name input is changed
   *
   * @param { InputEvent } event - The event that triggered the handler
   */
  _lastNameInputHandler(event) {
    // get the input element
    let element = event.target;

    // if the input is empty...
    if (element.validity.valueMissing) {
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('pleaseEnterYourLastName'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('pleaseEnterYourLastName'));

    } else if (element.validity.tooShort) { // <- if the input is too short...
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('yourLastNameMin2Chars'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('yourLastNameMin2Chars'));

    } else if (element.validity.tooLong) { // <- if the input is too long...
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('yourLastNameTooLong'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('yourLastNameTooLong'));

    } else if (!this._lastNamePattern.test(element.value)) { // <- if the input doesn't match the last name pattern...
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('pleaseEnterAValidLastName'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('pleaseEnterAValidLastName'));

    } else { // <- if the input is valid...
      // ...remove the input error
      mbApp.clearInputError(element);
      // empty the custom validity message of the input element
      element.setCustomValidity('');
    }

    
  }


  /**
   * Handler that is called whenever the `blur` event is triggered on the last name input
   *
   * @param { FocusEvent } event - The event that triggered the handler
   */
  _lastNameInputBlurHandler(event) {
    // get the input element
    let element = event.target;

    // if there's no value...
    if (element.validity.valueMissing) {
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('pleaseEnterYourLastName'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('pleaseEnterYourLastName'));
    }
    
  }


  /**
   * Handler that is called whenever the email input is changed
   *
   * @param { InputEvent } event - The event that triggered the handler
   */
  async _emailInputHandler(event) {
    let element = event.target;
    
    // if the input is valid...
    if (element.validity.tooShort) { // < - input is too short...
      // ...show the error
      mbApp.showInputError(element, mbApp.i18n.getString('yourEmailTooShort'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('yourEmailTooShort'));
      
    } else if (!this._emailPattern.test(element.value)) { // < - input doesn't match the pattern...
      // ...show the error
      mbApp.showInputError(element, mbApp.i18n.getString('pleaseEnterAValidEmail'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('pleaseEnterAValidEmail'));
      
    } else { // <- input is valid...
      
      // TODO: Start the email spinner here ;)
      this.emailSpinner.start();

      let customerEmailCheckResponse = await this._checkCustomerEmail(element.value);
      
      // Stop the email spinner
      this.emailSpinner.stop();

      
      // if the customer email already exists...
      if (customerEmailCheckResponse.success) {
        // create the input error message
        let inputErrorMessage = mbApp.i18n.getString('thisEmailIsAlreadyInUse');

        // show the input error
        mbApp.showInputError(element, inputErrorMessage);
        // set the custom validity message of the input too
        element.setCustomValidity(inputErrorMessage);
      
        // DEBUG [4dbsmaster]: tell me about it ;)
        console.log(`\x1b[35m[_emailInputHandler]: customerEmailCheckResponse => ${JSON.stringify(customerEmailCheckResponse)}\x1b[0m`);

        return false;

      }
      

      // ...remove the error
      mbApp.clearInputError(element);
      // empty the custom validity message of the input
      element.setCustomValidity('');
    }

  }


  /**
   * Handler that is called whenever the email input is blurred
   *
   * @param { FocusEvent } event - The event that triggered the handler
   */
  _emailInputBlurHandler(event) {
    let element = event.target;

    if (element.validity.valueMissing) {
      // ...show the error
      mbApp.showInputError(element, mbApp.i18n.getString('pleaseEnterAnEmail'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('pleaseEnterAnEmail'));
    }

  }

  /**
   * Handler that is called whenever the password `input` event is triggered
   *
   * @param { InputEvent } event - The event that triggered the handler
   * @private
   */
  async _passwordInputHandler(event) {
    // get the input element
    let element = event.target;

    // if the input is empty...
    if (element.validity.valueMissing) {
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('pleaseCreateAPassword'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('pleaseCreateAPassword'));

      return false;
      
    } else if (element.validity.tooShort) { // <- if the input is too short...
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('yourPasswordMin8Chars'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('yourPasswordMin8Chars'));

      return false;

    } else if (element.validity.tooLong) { // <- if the input is too long...
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('yourPasswordTooLong'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('yourPasswordTooLong'));

      return false;
    }


    //  IDEA: Let's check if the password is common or not before proceeding ;)


    // TODO: Start the password spinner here ;)
    this.passwordSpinner.start();


    // get the first base password value from `element.value`
    // NOTE: A base password is a password which includes numbers but without special characters
    const basePassword = element.value.match(this._passwordBasePattern)?.[0]; // <- returns eg.: 'pass123 from 'pass123_!';

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[35m[basePassword]: basePassword => ${basePassword}\x1b[0m`);


    let isCommonResponse = await this._checkPasswordIsCommon(basePassword);
    
    // Stop the password spinner
    this.passwordSpinner.stop();

    // if the passwor is common...
    if (isCommonResponse.success) {
      // create the input error message
      let inputErrorMessage = (element.value.length > 8) ? mbApp.i18n.getString('xHasCommonPassword').replace(/%s/g, element.value) : mbApp.i18n.getString('xPasswordIsCommon').replace(/%s/g, element.value);

      // show the input error
      mbApp.showInputError(element, inputErrorMessage);
      // set the custom validity message of the input too
      element.setCustomValidity(inputErrorMessage);
    
      // DEBUG [4dbsmaster]: tell me about it ;)
      console.log(`\x1b[35m[isCommonResponse]: isCommonResponse => ${JSON.stringify(isCommonResponse)}\x1b[0m`);
      return false;

    }
    

    // Now, at this point, password is not common...

    // Proceed Sir !! #lol ;)

    if (!this._passwordUppercasePattern.test(element.value)) { // <- if the password doesn't contain an uppercase letter...
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('passwordNoUppercase'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('passwordNoUppercase'));

    } else if (!this._passwordLowercasePattern.test(element.value)) { // <- if the password doesn't contain a lowercase letter...
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('passwordNoLowercase'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('passwordNoLowercase'));

    } else if (!this._passwordNumberPattern.test(element.value)) { // <- if the password doesn't contain a number...
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('passwordNoNumber'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('passwordNoNumber'));

    } else if (this._passwordSpacePattern.test(element.value)) { // <- if the password contains a space...
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('passwordSpaces'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('passwordSpaces'));

    } else if (!this._passwordSpecialCharacterPattern.test(element.value)) { // <- if the password doesn't contain a special character...
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('passwordNoSpecialCharacter'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('passwordNoSpecialCharacter'));


    } else { // <- if the input is valid...

      // So, remove the input error
      mbApp.clearInputError(element);
      // empty the custom validity message of the input
      element.setCustomValidity('');

    }

  

  }



  /**
   * Handler that is called whenever the password `blur` event is triggered
   *
   * @param { FocusEvent } event - The event that triggered the handler
   * @private
   */
  _passwordInputBlurHandler(event) {
    // get the input element
    let element = event.target;

    // if the input is empty...
    if (element.validity.valueMissing) {
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('passwordRequired'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('passwordRequired'));
    }

  }


  /**
   * Handler that is called whenever the confirm password `input` event is triggered
   *
   * @param { InputEvent } event - The event that triggered the handler
   * @private
   */
  _confirmPasswordInputHandler(event) {
    // get the input element
    let element = event.target;

    // if the input is empty...
    if (element.validity.valueMissing) {
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('pleaseConfirmYourPassword'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('pleaseConfirmYourPassword'));

    } else if (element.value !== this.passwordInput.value) { // <- if the input doesn't match the password
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('passwordsDoNotMatch'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('passwordsDoNotMatch'));

    } else { // <- if the input is valid...
      // ...remove the input error
      mbApp.clearInputError(element);
      // empty the custom validity message of the input
      element.setCustomValidity('');
    }

  }

  /**
   * Handler that is called whenever the confirm password `blur` event is triggered
   *
   * @param { FocusEvent } event - The event that triggered the handler
   * @private
   */
  _confirmPasswordInputBlurHandler(event) {
    // get the input element
    let element = event.target;

    // if the input is empty...
    if (element.validity.valueMissing) {
      // ...show the input error
      mbApp.showInputError(element, mbApp.i18n.getString('confirmPasswordRequired'));
      // set the custom validity message of the input too
      element.setCustomValidity(mbApp.i18n.getString('confirmPasswordRequired'));
    }

  }



  /**
   * Method used to trigger the input events on the email & password inputs
   * @private
   */
  _triggerInputEvents() {
    // create a list of inputs to trigger the input event on
    const inputs = [
      this.firstNameInput,
      this.lastNameInput,
      this.emailInput, 
      this.passwordInput,
      this.confirmPasswordInput
    ];

    // loop through the inputs...
    inputs.forEach((input) => {
      // ...and dispatch an input event on each one
      input.dispatchEvent(new Event('input'));
    });

  }


  /**
   * Method used to initialize the validation 
   * messages of all inputs in the register form
   */
  _initInputValidationMessages() {
    // Setting a custom validity message of each input in the register form...
    
    // first name
    this.firstNameInput.setCustomValidity(mbApp.i18n.getString('passwordRequired'));
    // last name
    this.lastNameInput.setCustomValidity(mbApp.i18n.getString('lastNameRequired'));
    // email
    this.emailInput.setCustomValidity(mbApp.i18n.getString('pleaseEnterAnEmail'));
    // password
    this.passwordInput.setCustomValidity(mbApp.i18n.getString('passwordRequired'));
    // confirm password
    this.confirmPasswordInput.setCustomValidity(mbApp.i18n.getString('confirmPasswordRequired'));
  }
  

  /**
   * Handler that is called whenever the register menu item is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   */
  _registerMenuItemClickHandler(event) {
    // hide or close the register menu
    mbApp.hideMenuById('registerMenu', 0.5, MAIN_PART).then(() => {

      // then, navigate the app to the register page
      mbApp.navigate('register');

    });

  }

  /**
   * Handler that is called whenever the clear form menu item is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   */
  _clearFormMenuItemClickHandler(event) {

    // hide or close the register menu
    mbApp.hideMenuById('registerMenu', 0.5, MAIN_PART);

    // clear the register form
    this.registerForm.reset();

    // DEBUG [4dbsmaster]: tell me about the event ;)
    console.log(`\x1b[40m;\x1b[33m[_clearFormMenuItemClickHandler]: event => \x1b[0m`, event);
  }

}



// Instantiate the class as `registerPage`
let registerPage = new RegisterPage();

// set it as the app's current page
mbApp.setCurrentPage('register', registerPage);

// Export the class as `registerPage`
export { registerPage };
