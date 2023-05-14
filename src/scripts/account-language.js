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
* @name: Account Language Page
* @codename: accountLanguagePage 
* @file: account-language-page.js
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
 * Class representing the account language page
 */
class AccountLanguagePage  {

  /**
   * The constructor of the class
   */
  constructor() {

    // install the event listeners
    this._installEventListeners();
  }


  // PUBLIC SETTERS
  // PUBLIC GETTERS


  /**
   * Returns all the lang elements
   *
   * @returns { NodeList<Element> }
   */
  get langEls() {
    return document.querySelectorAll('li.lang');
  }


  // PUBLIC METHODS


  /**
   * Method used to update the lang with the given `value`
   *
   * @param { String } value
   *
   * @returns { Promise }
   */
  updateLang(value) {
    return new Promise(async(resolve, reject) => {

      // define the logout URL
      const url = `account/language/${value}`; // <- the way it is for now ;)

      // create a POST request object with `url`
      const request = new Request(url, {method: 'PATCH'});

      // send the request and handle the response as `requestResponse`
      const requestResponse = await fetch(request);

      // get the JSON response from the `requestResponse` as `response
      const response = await requestResponse.json();

      // DEBUG [4dbsmaster]: tell me about the response ;)
      console.log(`\x1b[40m;\x1b[33m[updateLang]: response => \x1b[0m`, response);
      
      // If the response or update was successfull...
      if (response.success) {
        // ...resolve the promise with the response
        resolve(response);
      } else {
        // ...reject the promise with the response
        reject(response);
      }


    });
  }

  /**
   * Notifies the lang page of a recent update
   */
  notifyUpdate() {
    // Get the current app lang  as `lang`
    const lang = mbApp.lang;

    // Loop through all the lang elements
    for (let langEl of this.langEls) {
      // get the lang's id from `langEl` as `langId`
      let langId = langEl.dataset.id;

      
      // If the id of this `langEl` is the same as the app's lang...
      if (langId === mbApp.lang) {
        // ...select it
        langEl.setAttribute('selected', '');
        continue; // <- go to the next lang element
      } 

      langEl.removeAttribute('selected');

    }

  }

  // PRIVATE SETTERS
  // PRIVATE GETTERS
  // PRIVATE METHODS


  /**
   * Method used to install event listeners on the account's lang page
   */
  _installEventListeners() {

    // loop through all the lang elements
    for (let langEl of this.langEls) {
      // install a click event listener on each lang element
      langEl.addEventListener('click', this._langClickHandler.bind(this));
    }

  }

  /**
   * Handler that is called wheneve a lang is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   *
   */
  _langClickHandler(event) {
    // Get the lang element from event
    const langEl = event.currentTarget;

    // Check if this lang has been selected
    let selected = langEl.hasAttribute('selected');

    // Do nothing if this lang has already been selected
    if (selected) { return }

    // Get the lang from `langEl`
    let lang = langEl.dataset.id;
    
    // Update the language
    this.updateLang(lang).then((response) => {
      // Set the app's language
      mbApp.updateLanguage(response.lang);
      
      // show a toast for 1 second, with the message
      mbApp.showToast({
        message: response.message, 
        type:  SUCCESS_TOAST, 
        part: ASIDE_PART
      }, 1, true).then(() => mbApp.reload()); // <- then reload the app

      // TODO: ? navigate to the account page instead of reloading the app ?

      // notify the lang page of this update
      this.notifyUpdate();

    });

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[33[_langClickHandler]: lang => %s\x1b[0m`, lang);

  }


}


// Instantiate the class as `accountLanguagePage`
let accountLanguagePage = new AccountLanguagePage();
// Export the `accountLanguagePage`
export { accountLanguagePage };
