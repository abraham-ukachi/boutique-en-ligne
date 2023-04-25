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
* @name: Home Page
* @codename: homePage 
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


"use strict"; 
// ^^^^^^^^^ This keeps us on our toes, as it forces us to use all pre-defined variables, among other things 😅


/**
 * Class representing the home page
 */
export class HomePage {

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
   * Returns the `<button id="shopNowButton">` button element
   *
   * @returns { Element } 
   */
  get shopNowButtonEl() {
    return document.getElementById('shopNowButton');
  }


  /**
   * Returns the `<button id="exploreMoreButton">` element
   *
   * @returns { Element } 
   */
  get exploreMoreButtonEl() {
    return document.getElementById('exploreMoreButton');
  }


  /**
   * Returns the `<button id="moreIconButton">` element
   *
   * @returns { Element }
   */
  get moreIconButtonEl() {
    return document.getElementById('moreIconButton');
  }

  // PUBLIC METHODS




  // PRIVATE SETTERS
  // PRIVATE GETTERS
  // PRIVATE METHODS


  /**
   * Method used to install event listeners on the account page
   */
  _installEventListeners() {

    // If there are shopNow and exploreMore buttons on the page...
    if (this.shopNowButtonEl && this.exploreMoreButtonEl) {
      // ...install click event listener on them,
      // using / binding `this` to preserve our PointerEvent ;)
      this.shopNowButtonEl.addEventListener('click', this.#_shopNowButtonClickHandler.bind(this));
      this.exploreMoreButtonEl.addEventListener('click', this.#_exploreMoreButtonClickHandler.bind(this));
    }


    // If there is a moreIconButton on the page...
    if (this.moreIconButtonEl) {
      // ...install click event listener on it,
      // using / binding `this` to preserve our PointerEvent ;)
      this.moreIconButtonEl.addEventListener('click', this.#_moreIconButtonClickHandler.bind(this));
    }

  }

  /**
   * Handler that is called whenever the shop-now button is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   *
   * @returns { void }
   * @private
   */
  #_shopNowButtonClickHandler(event) {
    // TODO: Do something awesome here before navigating to the shop page ;)

    // navigate to the shop page
    mbApp.navigate('shop');
  }


  /**
   * Handler that is called whenever the explore-more button is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   *
   * @returns { void }
   * @private
   */
  #_exploreMoreButtonClickHandler(event) {
    // TODO: Do something awesome here before navigating to the search page ;)

    // navigate to the search page
    mbApp.navigate('search');
  }

  /**
   * Handler that is called whenever the more-icon button is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   *
   * @returns { void }
   * @private
   */
  #_moreIconButtonClickHandler(event) {
    // TODO: Do something awesome here before opening the home menu ;)

    // Open the home menu, using the `homeMenu` id
    mbApp.openMenuById('homeMenu');
  }

}


// Instantiate the class as `homePage`
let homePage = new HomePage();

// Export the `homePage` #JIC, #forNow ;)
export { homePage };
