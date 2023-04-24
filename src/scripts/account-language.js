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




  // PRIVATE SETTERS
  // PRIVATE GETTERS
  // PRIVATE METHODS


  /**
   * Method used to install event listeners on the account page
   */
  _installEventListeners() {
  
    /*
    // If there are logout and delete account buttons on the page...
    if (this.logoutButton && this.deleteAccountButton) {
      // ...install click event listener on the logout and delete account button,
      // using / binding `this` to preserve our PointerEvent ;)
      this.logoutButton.addEventListener('click', this._logoutButtonClickHandler.bind(this));
      this.deleteAccountButton.addEventListener('click', this._deleteAccountButtonClickHandler.bind(this));
    }

    */

  }

  /**
   * Handler that is called whenever the logout button is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   *
   * @returns { void }
   * @private
   */
  _logoutButtonClickHandler(event) {
    // open  a logout dialog in the main part
    mbApp.openDialog({
      title: mbApp.i18n.getString('log_out'),
      message: mbApp.i18n.getString('logoutConfirmMessage'),
      confirmBtnText: mbApp.i18n.getString('yes'),
      cancelBtnText: mbApp.i18n.getString('no'),
      onConfirm: this._logout.bind(this),
      onCancel: () => { mbApp.closeDialog(); },
      isCancelable: true
    }, 0.5);
  }



  /**
   * Method used to logout the user
   *
   * @param { PointerEvent } event - The event that triggered the handler
   * @returns { void }
   */
  async _logout(event) {
    // define the logout URL
    // const logoutUrl = `${mbApp.config.apiBaseUrl}/logout`; // <- the way it should be
    const logoutUrl = `account/logout`; // <- the way it is for now ;)

    // create a POST request object with `logoutUrl`
    const request = new Request(logoutUrl, {method: 'POST'});

    // send the request and handle the response as `requestResponse`
    const requestResponse = await fetch(request);

    // get the JSON response from the `requestResponse` as `response
    const response = await requestResponse.json();

    // DEBUG [4dbsmaster]: tell me about the response ;)
    console.log(`\x1b[40m;\x1b[33m[_logout]: response => \x1b[0m`, response);
    
    // close the dialog
    mbApp.closeDialog();

    // show a toast for 3 seconds, with the response message
    mbApp.showToast({
      message: response.message, 
      type: response.success ? SUCCESS_TOAST : ERROR_TOAST
    }, 3, FULL_PART)
      .then(() => {
        // if the response was successful, redirect the user to the home page
        if (response.success) {
          location.replace('home');
        }
    });

  }



}


// Instantiate the class as `account`
let accountInfoPage = new AccountInfoPage();
// Export the class as `accountPage`
export { accountInfoPage };
