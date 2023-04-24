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
* @name: Account Info Page
* @codename: accountInfoPage 
* @type: Script
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
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
import { accountPage } from './account.js'; // <- account page

"use strict"; 
// ^^^^^^^^^ This keeps us on our toes, as it forces us to use all pre-defined variables, among other things 😅


/**
 * Class representing the account info page
 */
class AccountInfoPage  {

  /**
   * The constructor of the class
   */
  constructor() {

    // install the event listeners
    this._installEventListeners();
  }


  // PUBLIC SETTERS
  // PUBLIC GETTERS




  // PUBLIC METHODS

  /**
   * Validates the first name input element
   *
   * @returns { Boolean } - Returns TRUE, if the first name input element is valid, otherwise returns FALSE
   */
  validateFirstNameInputEl() {
    // Initialize the `isFirstNameValid` variable to FALSE
    let isFirstNameValid = false;

    // If there's a first name input element...
    if (this.firstNameInputEl) {
      // get the first name input element validity as `fnameValidity`
      const fnameValidity = this.firstNameInputEl.validity;

      // Check if the first name input element is valid,

      // If `fnameValidity` is valid...
      if (fnameValidity.valid) {
        // ...update the `isFirstNameValid` variable accordingly
        isFirstNameValid = fnameValidity.valid;

        // clear or remove the input error from `this.firstNameInputEl`
        mbApp.clearInputError(this.firstNameInputEl);

      } else if (fnameValidity.valueMissing){ // <- If the field is missing
        // ...show the following error message for `this.firstNameInputEl`
        mbApp.showInputError(this.firstNameInputEl, mbApp.i18n.getString('firstNameErrorMessageValueMissing'));

      } else if (fnameValidity.tooShort){ // <- The data is too short
        // ...show the following error message for `this.firstNameInputEl`
        mbApp.showInputError(this.firstNameInputEl, mbApp.i18n.getString('firstNameErrorMessageTooShort'));

      } else if (fnameValidity.tooLong){ // <- The data is too long
        // ...show the following error message for `this.firstNameInputEl`
        mbApp.showInputError(this.firstNameInputEl, mbApp.i18n.getString('firstNameErrorMessageTooLong'));

      } else if (fnameValidity.patternMismatch){ // <- The data does not match the pattern
        // ...show the following error message for `this.firstNameInputEl`
        mbApp.showInputError(this.firstNameInputEl, mbApp.i18n.getString('firstNameErrorMessagePatternMismatch'));
      }


      // DEBUG [4dbsmaster]: tell me about this `fnameValidity` variable
      console.log(`\x1b[35m[validateFirstNameInputEl]: fnameValidity => \x1b[0m`, fnameValidity);

    }

    // return the `isFirstNameValid` variable
    return isFirstNameValid;

  }



  /**
   * Validates the last name input element
   *
   * @returns { Boolean } - Returns TRUE, if the last name input element is valid, otherwise returns FALSE
   */
  validateLastNameInputEl() {
    // Initialize the `isLastNameValid` variable to FALSE
    let isLastNameValid = false;

    // If there's a last name input element...
    if (this.lastNameInputEl) {
      // get the last name input element validity as `fnameValidity`
      const fnameValidity = this.lastNameInputEl.validity;

      // Check if the last name input element is valid,

      // If `fnameValidity` is valid...
      if (fnameValidity.valid) {
        // ...update the `isLastNameValid` variable accordingly
        isLastNameValid = fnameValidity.valid;

        // clear or remove the input error from `this.lastNameInputEl`
        mbApp.clearInputError(this.lastNameInputEl);

      } else if (fnameValidity.valueMissing){ // <- If the field is missing
        // ...show the following error message for `this.lastNameInputEl`
        mbApp.showInputError(this.lastNameInputEl, mbApp.i18n.getString('lastNameErrorMessageValueMissing'));

      } else if (fnameValidity.tooShort){ // <- The data is too short
        // ...show the following error message for `this.lastNameInputEl`
        mbApp.showInputError(this.lastNameInputEl, mbApp.i18n.getString('lastNameErrorMessageTooShort'));

      } else if (fnameValidity.tooLong){ // <- The data is too long
        // ...show the following error message for `this.lastNameInputEl`
        mbApp.showInputError(this.lastNameInputEl, mbApp.i18n.getString('lastNameErrorMessageTooLong'));

      } else if (fnameValidity.patternMismatch){ // <- The data does not match the pattern
        // ...show the following error message for `this.lastNameInputEl`
        mbApp.showInputError(this.lastNameInputEl, mbApp.i18n.getString('lastNameErrorMessagePatternMismatch'));
      }


      // DEBUG [4dbsmaster]: tell me about this `fnameValidity` variable
      console.log(`\x1b[35m[validateLastNameInputEl]: fnameValidity => \x1b[0m`, fnameValidity);

    }

    // return the `isLastNameValid` variable
    return isLastNameValid;

  }



  // PRIVATE SETTERS
  // PRIVATE GETTERS


  /**
   * Returns a list of all `.cancel-btn` elements on the page
   * 
   * @returns { NodeList }
   */
  get cancelButtonEls() {
    return document.querySelectorAll('.cancel-btn');
  }




  /* ========= IDENTITY FORM ========= */

  /**
   * Returns the identity form element
   *
   * @returns { Element }
   */
  get identityFormEl() {
    return document.getElementById('identityForm');
  }


  /**
   * Returns the first name input element
   *
   * @returns { Element }
   */
  get firstNameInputEl() {
    return document.getElementById('firstNameInput');
  }

  /**
   * Returns the first name input element
   *
   * @returns { Element }
   */
  get lastNameInputEl() {
    return document.getElementById('lastNameInput');
  }


  /**
   * Returns the date of birth input element
   *
   * @returns { Element } 
   */
  get dateOfBirthInputEl() {
    return document.getElementById('dateOfBirthInput');
  }


  /* ========= End of IDENTITY FORM ========= */




  // PRIVATE METHODS


  /**
   * Method used to install event listeners on the account page
   */
  _installEventListeners() {

    // for each cancel button...
    this.cancelButtonEls.forEach((cancelButtonEl) => {
      // ...install click event listener on the cancel button,
      cancelButtonEl.addEventListener('click', this._cancelButtonClickHandler.bind(this));
    });


    // ==================================
    // Identity form event listeners
    // ==================================

    // if there's an identity form element...
    if (this.identityFormEl) {
      // ...install submit event listener on the identity form element
      this.identityFormEl.addEventListener('submit', this._identityFormSubmitHandler.bind(this));
    }

    // if there's a first name input element...
    if (this.firstNameInputEl) {
      // ...install input event listener on the first name input element
      this.firstNameInputEl.addEventListener('input', this._firstNameInputHandler.bind(this));
    }


    // if there's a last name input element...
    if (this.lastNameInputEl) {
      // ...install input event listener on the first name input element
      this.lastNameInputEl.addEventListener('input', this._lastNameInputHandler.bind(this));
    }


    // if there's a date of birth input element...
    if (this.dateOfBirthInputEl) {
      // ...install input event listener on the date of birth input element
      this.dateOfBirthInputEl.addEventListener('input', this._dateOfBirthInputHandler.bind(this));
    }

  }



  /**
   * Handler that is called whenever the first name input element is typed in
   *
   * @param { InputEvent } event - The event that triggered the handler
   */
  _firstNameInputHandler(event) {
    // Validate the first name input element, and store the result in `isfirstNameValidated`
    let isfirstNameValidated = this.validateFirstNameInputEl();
    

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[33m[_firstNameInputHandler] (1): event => \x1b[0m`, event);
    console.log(`\x1b[33m[_firstNameInputHandler] (2): isfirstNameValidated ? \x1b[0m`, isfirstNameValidated);
  }



  /**
   * Handler that is called whenever the last name input element is typed in
   *
   * @param { InputEvent } event - The event that triggered the handler
   */
  _lastNameInputHandler(event) {
    // Validate the last name input element, and store the result in `islastNameValidated`
    let islastNameValidated = this.validateLastNameInputEl();
    

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[33m[_lastNameInputHandler] (1): event => \x1b[0m`, event);
    console.log(`\x1b[33m[_lastNameInputHandler] (2): islastNameValidated ? \x1b[0m`, islastNameValidated);
  }

  

  /**
   * Handler that is called whenever the user types in the date of birth input element
   *
   * @param { InputEvent } event - The event that triggered the handler
   */
  _dateOfBirthInputHandler(event) {
    // get the date of birth input element as `input`
    let input = event.target;

    // get the cursor's current position as `cursorPosition`
    const cursorPosition = input.selectionStart - 1;
    // check if the input value has any invalid characters (i.e. characters that are not digits or `/`)
    const hasInvalidCharacters = input.value.match(/[^0-9/]/);


    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[33m[_dateOfBirthInputHandler] (1): %s\x1b[0m`, `cursorPosition: ${cursorPosition}`);
    console.log(`\x1b[33m[_dateOfBirthInputHandler] (2): %s\x1b[0m`, `hasInvalidCharacters: ${hasInvalidCharacters}`);

    /*
      // get the last caracter of the input value as `lastCharacter`
      let lastCharacter = input.value[input.value.length - 1];
      // check if lastCharacter is a number
      let isLastCharacterANumber = typeof parseInt(lastCharacter) === 'number';

      // if the second or fifth character is a number...
      if (input.value.length === 2 && isLastCharacterANumber) {
        // ...append a `/` character to the input value
        input.value += '/';
      }
    */

    // Do nothing if there are no invalid characters
    if (!hasInvalidCharacters) { return }


    // However, if there are invalid characters, remove them:

    // Replace all non-digits:
    input.value = input.value.replace(/[^0-9/]/g, '');

    // Keep cursor position:
    input.setSelectionRange(cursorPosition, cursorPosition);


  }

  /**
   * Handler that is called whenever the identity form is submitted
   *
   * @param { SubmitEvent } event - The event that triggered the handler
   */
  _identityFormSubmitHandler(event) {
    event.preventDefault();

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[33m[_identityFormSubmitHandler] (1): event => \x1b[0m`, event);
  }


  /**
   * Handler that is called whenever the `cancel` button is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   * @private
   */
  _cancelButtonClickHandler(event) {
    // navigate to the `account/info` page, using the object Maxaboom App (i.e. `mbApp`)
    mbApp.navigate('account/info');
  }



}


// Instantiate the class as `account`
let accountInfoPage = new AccountInfoPage();

// Export the class as `accountPage`
export { accountInfoPage };
