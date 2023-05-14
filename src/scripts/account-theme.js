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
* @name: Account Theme Page
* @codename: accountThemePage 
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
 * Class representing the account theme page
 */
class AccountThemePage  {

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
   * Returns all the theme elements
   *
   * @returns { NodeList<Element> }
   */
  get themeEls() {
    return document.querySelectorAll('li.theme');
  }


  // PUBLIC METHODS


  /**
   * Method used to update the theme with the given `value`
   *
   * @param { String } value
   *
   * @returns { Promise }
   */
  updateTheme(value) {
    return new Promise(async(resolve, reject) => {

      // define the logout URL
      const url = `account/theme/${value}`; // <- the way it is for now ;)

      // create a POST request object with `url`
      const request = new Request(url, {method: 'PATCH'});

      // send the request and handle the response as `requestResponse`
      const requestResponse = await fetch(request);

      // get the JSON response from the `requestResponse` as `response
      const response = await requestResponse.json();

      // DEBUG [4dbsmaster]: tell me about the response ;)
      console.log(`\x1b[40m;\x1b[33m[updateTheme]: response => \x1b[0m`, response);
      
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
   * Notifies the theme page of a recent update
   */
  notifyUpdate() {
    // Get the current app theme  as `theme`
    const theme = mbApp.theme;

    // Loop through all the theme elements
    for (let themeEl of this.themeEls) {
      // get the theme's id from `themeEl` as `themeId`
      let themeId = themeEl.dataset.id;

      
      // If the id of this `themeEl` is the same as the app's theme...
      if (themeId === mbApp.theme) {
        // ...select it
        themeEl.setAttribute('selected', '');
        continue; // <- go to the next theme element
      } 

      themeEl.removeAttribute('selected');

    }

  }

  // PRIVATE SETTERS
  // PRIVATE GETTERS
  // PRIVATE METHODS


  /**
   * Method used to install event listeners on the account's theme page
   */
  _installEventListeners() {

    // loop through all the theme elements
    for (let themeEl of this.themeEls) {
      // install a click event listener on each theme element
      themeEl.addEventListener('click', this._themeClickHandler.bind(this));
    }

  }

  /**
   * Handler that is called wheneve a theme is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   *
   */
  _themeClickHandler(event) {
    // Get the theme element from event
    const themeEl = event.currentTarget;

    // Check if this theme has been selected
    let selected = themeEl.hasAttribute('selected');

    // Do nothing if this theme has already been selected
    if (selected) { return }

    // Get the theme from `themeEl`
    let theme = themeEl.dataset.id;
    
    // Update the theme 
    this.updateTheme(theme).then((response) => {
      // Set the app 'theme'
      mbApp.updateTheme(response.theme);
      
      // show a toast for 3 seconds, with the message
      mbApp.showToast({
        message: response.message, 
        type:  SUCCESS_TOAST, 
        part: ASIDE_PART
      }, 3, true);
      
      // notify the theme page of this update
      this.notifyUpdate();

    });

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[33[_themeClickHandler]: theme => %s\x1b[0m`, theme);

  }


}


// Instantiate the class as `account`
let accountThemePage = new AccountThemePage();
// Export the `accountThemePage`
export { accountThemePage };
