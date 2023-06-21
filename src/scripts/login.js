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
* @name: Login Page
* @codename: loginPage 
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
 * Class representing the login page
 */
class LoginPage  {
  
  /**
   * The constructor of the class
   */
  constructor() {

    // install the event listeners
    this._installEventListeners();

    // install prototype methods
    this._installPrototypeMethods();
    
    // focus on the email input
    this.emailInput.focus();


    // HACK: After 1 seconds...
    setTimeout(() => {
      // update the page title
      mbApp.setTitle(mbApp.i18n.getString('login') + ' - ' + mbApp.i18n.getString('appName'));
    }, 1000);


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
   * Returns the `<form id="loginForm">` element
   *
   * @returns { HTMLFormElement }
   */
  get loginForm() {
    return document.getElementById('loginForm');
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
   * Returns the `<button id="loginButton">` element
   *
   * @returns { HTMLButtonElement }
   */
  get loginButton() {
    return document.querySelector('#loginButton');
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


  // PUBLIC METHODS









  // PRIVATE SETTERS

  // PRIVATE GETTERS

  // PRIVATE METHODS


  /**
   * Method used to install event listeners on the login page
   */
  _installEventListeners() {
  
    // If there's a menu button...
    if (this.menuButton) {
      // add a click event listener to it
      this.menuButton.addEventListener('click', this._menuButtonClickHandler.bind(this));
    }

    // If there's a login form...
    if (this.loginForm) {
      // add a submit event listener to it
      this.loginForm.addEventListener('submit', this._loginFormSubmitHandler.bind(this));
      // add a reset event listener to it
      this.loginForm.addEventListener('reset', this._loginFormResetHandler.bind(this));
    }

    // If there's an email input...
    if (this.emailInput) {
      // add an input event listener to it
      this.emailInput.addEventListener('input', this._emailInputInputHandler.bind(this));
      // add a blur event listener to it
      this.emailInput.addEventListener('blur', this._emailInputBlurHandler.bind(this));
    }


    // If there's a password input...
    if (this.passwordInput) {
      // ...TODO: do something awesome with it
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
   * Method used to install prototype methods on the login page
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
  }


  /*
   * Handler that is called whenever the menu button is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   */
  _menuButtonClickHandler(event) {
    // show the login menu
    mbApp.showMenuById('loginMenu', 0.5, MAIN_PART);
    
    // DEBUG [4dbsmaster]: tell me about the event ;)
    console.log(`\x1b[40m;\x1b[33m[_menuButtonClickHandler]: event => \x1b[0m`, event);
  }


  /**
   * Handler that is called whenever the login form is submitted
   *
   * @param { SubmitEvent } event - The event that triggered the handler
   */
  _loginFormSubmitHandler(event) {
    // prevent the default behavior of the event
    event.preventDefault();
    
    let form = new FormData(event.currentTarget);

    // create a 1 second delay
    const delay = 1000;

    // start loading the login button
    this.loginButton.startLoading();

    // TODO: disabled all inputs in the login form

    // SIMULATION: After the above delay...
    setTimeout(() => {
      // ...login with the form data
      this._loginWithFormData(form).then((response) => {
        // stop loading the login button
        this.loginButton.stopLoading();
        
        // show a toast
        mbApp.showToast({message: mbApp.i18n.getString('loginSuccessful'), type: SUCCESS_TOAST}, 2)
          .then(() => mbApp.navigate('shop')); // <- if the toast is shown, navigate to the shop page

        // DEBUG [4dbsmaster]: tell me about the response
        console.log(`\x1b[40m;\x1b[33m[_loginFormSubmitHandler]: response => \x1b[0m`, response);

      }).catch((error) => { // <- if the login fails...

        // stop loading the login button
        this.loginButton.stopLoading();

        // open the app's dialog accordingly ;)
        mbApp.openDialog({
          title: mbApp.i18n.getString('loginFailed'),
          message: mbApp.i18n.getString('loginFailedMessage'),
          confirmBtnText: mbApp.i18n.getString('tryAgain'),
          cancelBtnText: mbApp.i18n.getString('cancel'),
          onConfirm: () => mbApp.closeDialog('dialog', 0.5, MAIN_PART).then(() => this.emailInput.focus()),
          onCancel: () => mbApp.closeDialog('dialog', 0.5, MAIN_PART).then(() => mbApp.navigate('home')),
          noDivider: false,
          isCancelable: true
        }, 0.5, MAIN_PART);

        // DEBUG [4dbsmaster]: tell me about the error
        console.log(`\x1b[31m[_loginFormSubmitHandler]: error.message => %s ann error => \x1b[0m`, error.message, error);
        
      });

    }, delay); 

  }



  /**
   * Method used to login with the given form data
   *
   * @param { FormData } form - The form data to login with
   * @returns { Promise }
   * @private
   */
  _loginWithFormData(form) {
    return new Promise(async (resolve, reject) => {

      let url = "login";
      let request = new Request(url, {method: "POST", body: form});
      let response = await fetch(request);
      let responseData = await response.json();

      // DEBUG [4dbsmaster]: tell me about the response data
      console.log(`\x1b[40;33m[_loginWithFormData]: responseData => \x1b[0m`, responseData);

      // resolve or reject the promise based on the response data's success property
      (responseData.success) ? resolve(responseData) : reject(responseData);

    });
  }


  /**
   * Handler that is called whenever the login form is reset
   *
   * @param { Event } event - The event that triggered the handler
   */
  _loginFormResetHandler(event) {
    // remove the email input error
    mbApp.clearInputError(this.emailInput);
    // remove the password input error
    mbApp.clearInputError(this.passwordInput);

    // reset the password input type
    this.passwordInput.type = 'password';

    setTimeout(() => {
      // Trigger the email & password input events 
      this._triggerInputEvents();
    }, 30); // <- HACK: wait for 30 miliseconds for the form to reset before triggering the input events
    
  }


  /**
   * Handler that is called whenever the email input is changed
   *
   * @param { InputEvent } event - The event that triggered the handler
   */
  _emailInputInputHandler(event) {
    let element = event.target;

    // if the input is valid...
    if (element.validity.valid) {
      // ...remove the error
      mbApp.clearInputError(element);

    } else if (element.validity.tooShort) { // < - input is too short...

      mbApp.showInputError(element, mbApp.i18n.getString('yourEmailTooShort'));

    } else if (element.validity.patternMismatch) { // < - input doesn't match the pattern...

      mbApp.showInputError(element, mbApp.i18n.getString('pleaseEnterAValidEmail'));
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
      mbApp.showInputError(element, mbApp.i18n.getString('pleaseEnterAnEmail'));
    }

  }

  /**
   * Method used to trigger the input events on the email & password inputs
   * @private
   */
  _triggerInputEvents() {
    // HACK: dispatch an input event on the email input, to lower the label
    this.emailInput.dispatchEvent(new Event('input'));
    // HACK: dispatch an input event on the password input, to lower the label
    this.passwordInput.dispatchEvent(new Event('input'));
  }



  /**
   * Handler that is called whenever the register menu item is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   */
  _registerMenuItemClickHandler(event) {
    // hide or close the login menu
    mbApp.hideMenuById('loginMenu', 0.5, MAIN_PART).then(() => {

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

    // hide or close the login menu
    mbApp.hideMenuById('loginMenu', 0.5, MAIN_PART);

    // clear the login form
    this.loginForm.reset();

    // DEBUG [4dbsmaster]: tell me about the event ;)
    console.log(`\x1b[40m;\x1b[33m[_clearFormMenuItemClickHandler]: event => \x1b[0m`, event);
  }

}



// Instantiate the class as `loginPage`
let loginPage = new LoginPage();
// Export the class as `loginPage`
export { loginPage };
