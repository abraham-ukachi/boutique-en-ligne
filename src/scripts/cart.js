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
* @name: Cart Page
* @codename: cartPage 
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
 * Class representing the cart page
 */
class CartPage  {

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
   * Returns the `<button id="cartMenuButton">` element
   *
   * @returns { HTMLButtonElement }
   */
  get cartMenuButton() {
    return document.getElementById('cartMenuButton');
  }


  /**
   * Returns all the product elements
   *
   * @returns { NodeList }
   */
  get productEls() {
    return document.querySelectorAll('.product');
  }


  /**
   * Returns all the delete button elements
   *
   * @returns { NodeList }
   */
  get productDeleteButtons() {
    return document.querySelectorAll('.product .delete-btn');
  }


  /**
   * Returns all the product quantity increase button elements
   *
   * @returns { NodeList }
   */
  get productQtyIncreaseButtons() {
    return document.querySelectorAll('.product button.increase-qty');
  }


  /**
   * Returns all the product quantity decrease button elements
   *
   * @returns { NodeList }
   */
  get productQtyDecreaseButtons() {
    return document.querySelectorAll('.product button.decrease-qty');
  }

  /**
   * Returns the product menu element
   *
   * @returns { HTMLElement }
   */
  get productMenuEl() {
    return document.querySelector('menu[data-id="cartProductMenu"]');
  }


  /**
   * Returns the product using the given `productId`
   *
   * @param { string } productId - The id of the product to get
   *
   * @returns { Element } - The product element
   */
  getProductById(productId) {
    return document.querySelector(`.product[data-id="${productId}"]`);
  }


  /**
   * Returns the product count element
   *
   * @returns { Element }
   */
  get productsCountEl() {
    return document.querySelector(`.products-count.app-subtitle`);
  }


  /**
   * Returns the total price element
   *
   * @returns { Element }
   */
  get totalPriceEl() {
    return document.querySelector(`.total-price h2.app-title`);
  }


  // PUBLIC METHODS


  /**
   * Method used to notify the cart of the recent update of the total price and products count
   *
   * @param { String } totalPrice - The total price of the products in the cart
   * @param { Number } productsCount - The number of products in the cart
   */
  notifyUpdate(totalPrice, productsCount) {
    // update the total price
    this.totalPriceEl.textContent = totalPrice;
    // update the products count
    this.productsCountEl.textContent = productsCount + mbApp.i18n.getString('products');

    console.log(this.productsCountEl, productsCount);

    // update the nav-link count
    mbApp.updateCartCount(productsCount);

  }



  /**
   * Method used to remove a product with the given `productId` from wishlist
   *
   * @param { string } productId - The id of the product to remove
   * @returns { void }
   */
  async removeProductFromCart(productId) {
    // define the  URL
    const url = `cart/${productId}`; // <- the way it is for now ;)

    // create a POST request object with  url`
    const request = new Request(url, {method: 'DELETE'});

    // send the request and handle the response as `requestResponse`
    const requestResponse = await fetch(request);
    
    // get the JSON response from the `requestResponse` as `response
    const response = await requestResponse.json();

    // DEBUG [4dbsmaster]: tell me about the response ;)
    console.log(`\x1b[40m;\x1b[33m[removeProductFromCart]: response => \x1b[0m`, response);
    
    // close the dialog
    mbApp.closeDialog('dialog', 0.5, MAIN_PART);
    
    // show a toast for 3 seconds, with the response message
    mbApp.showToast({
      message: response.message, 
      type: response.success ? SUCCESS_TOAST : ERROR_TOAST
    }, 3, MAIN_PART);

    // if the response was successful...
    if (response.success) {
      // ..get the product element with the given `productId` as `productEl`
      const productEl = this.getProductById(productId);

      // remove the `productEl` from the DOM
      productEl.remove();

      // notify the cart of a recent update
      this.notifyUpdate(response.total_price, response.cart_total);
    }

  }


  // PRIVATE SETTERS
  // PRIVATE GETTERS
  // PRIVATE METHODS


  /**
   * Method used to install event listeners on the account page
   */
  _installEventListeners() {
  
    // If there's a cart menu button...
    if (this.cartMenuButton) {
      // add a click event listener to it
      this.cartMenuButton.addEventListener('click', this._cartMenuButtonClickHandler.bind(this));
    }
    

    // loop through all the product elements...
    for (const productEl of this.productEls) {
      // ...and add a click event listener to each of them
      productEl.addEventListener('click', this._productClickHandler.bind(this));
    }

    // loop through all the product delete button elements...
    for (const productDeleteButton of this.productDeleteButtons) {
      // ...and add a click event listener to each of them
      productDeleteButton.addEventListener('click', this._productDeleteButtonClickHandler.bind(this));
    }

  }

  /**
   * Handler that is called whenever a product delete button is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   */
  _productDeleteButtonClickHandler(event) {
    // get the current target as product delete button element
    const productDeleteButtonEl = event.currentTarget;

    // get the parent element of `productDeleteButtonEl` as product element
    const productEl = productDeleteButtonEl.parentElement.parentElement;
    
    // get the product id from the dataset of `productEl`
    const productId = productEl.dataset.id;
    
    console.log(productEl);


    // show a delete confirmation dialog
    mbApp.openDialog({
        title: mbApp.i18n.getString('deleteCartTitle'),
        message: mbApp.i18n.getString('deleteCartMessage'), 
        confirmBtnText: mbApp.i18n.getString('remove'), 
        cancelBtnText: mbApp.i18n.getString('cancel'),
        onConfirm: () => this.removeProductFromCart(productId), 
        onCancel: () => mbApp.closeDialog('dialog', 0.5, MAIN_PART),
        noDivider: false,
        isCancelable: true
      }, 0.5, MAIN_PART);  
  }


  /**
   * Handler that is called whenever a product element is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   */
  _productClickHandler(event) {
    // do nothing if the current target is not the same as the target
    if (event.currentTarget !== event.target) { return }

    // get the curent target as product element
    const productEl = event.currentTarget;

    // get the id from the dataset of `productEl`
    const productId = productEl.dataset.id;

    // update the product menu id with `productId`
    this.productMenuEl.dataset.productId = productId;

    // show the product menu
    mbApp.showMenuById('cartProductMenu', 0.5, MAIN_PART);
    
    // do nothing if the `productEl` does not have the `product` class
    // if (!productEl.classList.contains('product')) { return }

    // DEBUG [4dbsmaster]: tell me about the event ;)
    console.log(`\x1b[40m;\x1b[33m[_productClickHandler]: event => \x1b[0m`, event);
  }

   

  /*
   * Handler that is called whenever the cart menu button is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   */
  _cartMenuButtonClickHandler(event) {
    // show the cart menu
    mbApp.showMenuById('cartMenu', 0.5, MAIN_PART);

    // DEBUG [4dbsmaster]: tell me about the event ;)
    console.log(`\x1b[40m;\x1b[33m[_cartMenuButtonClickHandler]: event => \x1b[0m`, event);
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


// Instantiate the class as `cart`
let cartPage = new CartPage();
// Export the class as `cartPage`
export { cartPage };
