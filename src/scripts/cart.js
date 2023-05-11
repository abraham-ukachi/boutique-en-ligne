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

// Import a couple of important stuff from our app ;)
import { SUCCESS_TOAST, GOOD_TOAST, BAD_TOAST, ERROR_TOAST, NORMAL_TOAST } from '../app.js'; // <- toasts
import { MAIN_PART, ASIDE_PART, FULL_PART } from '../app.js'; // <- parts
import { html } from '../app.js'; // <- just our beloved html tagged template literal function


"use strict"; 
// ^^^^^^^^^ This keeps us on our toes, as it forces us to use all pre-defined variables, among other things 😅




// Define some constants

const MAX_QUANTITY = 20; // <- the maximum quantity of a product that can be added to the cart
const MIN_QUANTITY = 1; // <- the minimum quantity of a product that can be added to the cart


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
   * Returns the checkout button element
   *
   * @returns { HTMLButtonElement }
   */
  get checkoutButton() {
    return document.getElementById('checkoutButton');
  }

  /**
   * Returns the checkout button wrapper element
   * 
   * @returns { HTMLDivElement }
   */
  get checkoutButtonWrapperEl() {
    return this.checkoutButton.parentElement;
  }


  /**
   * Returns the empty container element
   *
   * @returns { HTMLElement }
   */
  get emptyContainerEl() {
    return document.querySelector('.container[empty]');
  }


  /**
   * Returns the list container element
   * 
   * @returns { HTMLElement }
   */
  get listContainerEl() {
    return document.querySelector('.container[list]');
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
  get productIncreaseQtyButtons() {
    return document.querySelectorAll('.product button.increase-qty');
  }


  /**
   * Returns all the product quantity decrease button elements
   *
   * @returns { NodeList }
   */
  get productDecreaseQtyButtons() {
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
   * @param { Number } productId - The id of the product to get
   *
   * @returns { Element } - The product element
   */
  getProductById(productId) {
    return document.querySelector(`.product[data-id="${productId}"]`);
  }


  /**
   * Returns the quantity of the product using the given `productId`
   *
   * @param { Number } productId - The id of the product to get the quantity of
   *
   * @returns { Number } - The quantity of the product
   */
  getQuantityByProductId(productId) {
    return parseInt(this.getProductById(productId).querySelector('.qty-value').textContent);
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

  /**
   * Returns TRUE if the products are loading, FALSE otherwise
   *
   * @returns { Boolean }
   */
  get isLoadingProducts() {
    return this.productsEl.classList.contains('loading');
  }


  /**
   * Returns the `<div id="products">` element
   *
   * @returns { HTMLDivElement }
   */
  get productsEl() {
    return document.getElementById('products');
  }


  /**
   * Returns the total number of products in the cart
   *
   * @returns { Number }
   */
  get totalProductsCount() {
    return parseInt(this.productsEl.dataset.total);
  }

  /**
   * Returns the current number of products in list
   *
   * @returns { Number }
   */
  get currentProductsCount() {
    return this.productEls.length ?? 0;
  }


  // PUBLIC METHODS


  /**
   * Handler that is called whenever the bottom of the main app layout is reached
   */
  onMainBottomReached() {
    // compute the difference between the total products count and the current products count
    const diff = this.totalProductsCount - this.currentProductsCount;

    console.log('diff', diff);

    // Do nothing if there's no product in the cart,
    // or if the difference is less than or equal to 0,
    // or if the products are loading
    if (!this.totalProductsCount || diff <= 0 || this.isLoadingProducts) return;

    // show the products loading spinner
    this._showProductsLoadingSpinner();

    // load the next products
    this._loadNextProducts(this.currentProductsCount).then((nextProducts) => {

      // loop through the next products
      nextProducts.forEach((nextProduct) => {
        // get the product template of the next product as `productTemplate`
        let productTemplate = this._getProductTemplate(nextProduct);

        // insert the product template before the end of the products element
        this.productsEl.insertAdjacentHTML('beforeend', productTemplate);

        // get the product element of the next product as `productEl`
        let productEl = this.getProductById(nextProduct.id);

        // install the event listeners on this `productEl`
        this._installProductEventListeners(productEl);

      });

      
      // hide the products loading spinner
      this._hideProductsLoadingSpinner();


      // DEBUG [4dbsmaster]: tell me about it ;)
      console.log(`\x1b[33m[onMainBottomReached]: nextProducts => %o \x1b[0m`, nextProducts);

    });


    // DEBUG [4dbsmaster]: tell me about it ;)
    //console.log(`\x1b[33m[onMainBottomReached]: totalProductsCount => %d & currentProductsCount => %d \x1b[0m`,
    // this.totalProductsCount, this.currentProductsCount);
  }

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
    this.productsCountEl.textContent = `${productsCount} ${mbApp.i18n.getString('products')}`;
    
    // update the total dataset of the products element
    this.productsEl.dataset.total = productsCount;

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(this.productsCountEl, productsCount);
    
    // if there're no products in the cart...
    if (!productsCount) {
      // ...hide some elements 
      this.productsCountEl.hidden = true;
      this.totalPriceEl.hidden = true;
      this.cartMenuButton.hidden = true;
      this.checkoutButtonWrapperEl.hidden = true;
      this.listContainerEl.hidden = true;
      // ...and show the `emptyContainerEl`
      this.emptyContainerEl.hidden = false;

    }else { // else...
      // ...show some elements
      this.productsCountEl.hidden = false;
      this.totalPriceEl.hidden = false;
      this.cartMenuButton.hidden = false;
      this.checkoutButtonWrapperEl.hidden = false;
      this.listContainerEl.hidden = false;
      // ...and hide the `emptyContainerEl`
      this.emptyContainerEl.hidden = true;
    }


    // update the nav-link count
    mbApp.updateCartCount(productsCount);

  }


  /**
   * Method used to notify a specific product of the recent quantity update
   *
   * @param { string } productId - The id of the product to notify
   * @param { number } quantity - The new quantity of the product
   *
   * @returns { void }
   */
  notifyProductQuantity(productId, quantity) {
    // get the product element using the `productId`
    const productEl = this.getProductById(productId);

    // get the product quantity element
    const productQuantityEl = productEl.querySelector('.product-quantity');
    const qtyValueEl = productEl.querySelector('.qty-value');

    // update the `textContent` of the `qtyValueEl` with the given `quantity`
    qtyValueEl.textContent = quantity;

    // create a text with the given `quantity` (e.g. `Qty: 2`)
    let text = `${mbApp.i18n.getString('qty')} : ${quantity}`;

    // update the `textContent` of the `productQuantityEl` with the created text
    productQuantityEl.textContent = text;
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

    // create a DELETE request object with  url`
    const request = new Request(url, {method: 'DELETE'});

    // send the request and handle the response as `requestResponse`
    const requestResponse = await fetch(request);
    
    // get the JSON response from the `requestResponse` as `response
    const response = await requestResponse.json();

    // DEBUG [4dbsmaster]: tell me about the response ;)
    console.log(`\x1b[40m;\x1b[33m[removeProductFromCart]: response => \x1b[0m`, response);
    
    // close the dialog
    mbApp.closeDialog('dialog', 0.5, MAIN_PART);
    

    // if the response was successful...
    if (response.success) {
      // ..get the product element with the given `productId` as `productEl`
      const productEl = this.getProductById(productId);

      // start removing the `productEl`...
      productEl.classList.add('removing');

      // ...after 0.6 seconds...
      setTimeout(() => {
        // ...remove the `productEl` from the DOM
        productEl.remove();

        // notify the cart of a recent update
        this.notifyUpdate(response.total_price, response.cart_total);

        // show a toast for 3 seconds, with the response message
        mbApp.showToast({
          message: response.message, 
          type: response.success ? SUCCESS_TOAST : ERROR_TOAST,
          part: MAIN_PART
        }, 3);

      }, 500);

    }

  }


  /**
   * Method used to increase the quantity of a product with the given `productId` in the cart
   *
   * @param { string } productId - The id of the product to increase the quantity of
   *
   * @returns { Promise }
   */
  increaseProductQuantity(productId) {
    return new Promise(async (resolve, reject) => {
      // define the  URL
      const url = `cart/increase/${productId}`; // <- the way it is for now ;)

      // create a PATCH request object with  url`
      const request = new Request(url, {method: 'PATCH'});

      // send the request and handle the response as `requestResponse`
      const requestResponse = await fetch(request);
      
      // get the JSON response from the `requestResponse` as `response
      const response = await requestResponse.json();

      // DEBUG [4dbsmaster]: tell me about the response ;)
      // console.log(`\x1b[40m\x1b[33m[increaseProductQuantity]: response => \x1b[0m`, response);

      // if the response was successful...
      if (response.success) {
        // ...resolve the promise with the response
        resolve(response);

      }else { // <- response was not successful...
        // ...reject the promise with the response
        reject(response);
      }
    
    });
  }


  /**
   * Method used to decrease the quantity of a product with the given `productId` in the cart
   *
   * @param { string } productId - The id of the product to decrease the quantity of
   *
   * @returns { Promise }
   */
  decreaseProductQuantity(productId) {
    return new Promise(async (resolve, reject) => {
      // define the  URL
      const url = `cart/decrease/${productId}`; // <- the way it is for now ;)

      // create a PATCH request object with  url`
      const request = new Request(url, {method: 'PATCH'});

      // send the request and handle the response as `requestResponse`
      const requestResponse = await fetch(request);
      
      // get the JSON response from the `requestResponse` as `response
      const response = await requestResponse.json();

      // DEBUG [4dbsmaster]: tell me about the response ;)
      console.log(`\x1b[40m\x1b[34m[decreaseProductQuantity]: response => \x1b[0m`, response);

      // if the response was successful...
      if (response.success) {
        // ...resolve the promise with the response
        resolve(response);

      }else { // <- response was not successful...
        // ...reject the promise with the response
        reject(response);
      }
    
    });
  }



  // PRIVATE SETTERS
  // PRIVATE GETTERS
  // PRIVATE METHODS


  /**
   * Method used to load the next products
   *
   * @param { Number } start - The start index of the products to load
   * @param { Number } limit - The number of products to load
   *
   * @private
   */
  _loadNextProducts(start = 0, limit = 10) {
    return new Promise(async (resolve) => {

      // create a url with the given `start` and `limit`
      let url = `cart/products/${start}/${limit}`;

      // create a request
      let request = new Request(url, {method: 'GET'});

      // fetch the request and handle the response as `requestResponse`
      let requestResponse = await fetch(request);

      // get the JSON response from the `requestResponse` as `response`
      let response = await requestResponse.json();

      // DEBUG [4dbsmaster]: tell me about the response ;)
      console.log(`\x1b[40m\x1b[33m[_loadNextProducts]: response => \x1b[0m`, response);

      // resolve the promise with the response, after 1 seconds (for testing purposes)
      setTimeout(() => resolve(response), 1000);

    });

  }


  /**
   * Shows the products loading spinner
   * @private
   */
  _showProductsLoadingSpinner() {
    // show the products loading spinner
    this.productsEl.classList.add('loading');
  }


  /**
   * Hides the products loading spinner
   * @private
   */
  _hideProductsLoadingSpinner() {
    // hide the products loading spinner
    this.productsEl.classList.remove('loading');
  }



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


    // loop through all the product increase quantity button elements...
    for (const productIncreaseQtyButton of this.productIncreaseQtyButtons) {
      // ...and add a click event listener to each of them
      productIncreaseQtyButton.addEventListener('click', this._productIncreaseQtyButtonClickHandler.bind(this));
    }

    // loop through all the product decrease quantity button elements...
    for (const productDecreaseQtyButton of this.productDecreaseQtyButtons) {
      // ...and add a click event listener to each of them
      productDecreaseQtyButton.addEventListener('click', this._productDecreaseQtyButtonClickHandler.bind(this));
    }


    // listen for the `scroll` event on the `mainAppLayout` of `mbApp`
    mbApp.mainAppLayout.addEventListener('scroll', this._mainAppLayoutScrollHandler.bind(this));

  }


  /**
   * Installs event listeners on the given `productEl`
   *
   * @param { HTMLElement } productEl - The product element to install event listeners on
   * @private
   */
  _installProductEventListeners(productEl) {
    // add a click event listener to the product element
    productEl.addEventListener('click', this._productClickHandler.bind(this));

    // get the product delete button element of `productEl`
    const productDeleteButton = productEl.querySelector('button.delete-btn');
    // add a click event listener to the product delete button element
    productDeleteButton.addEventListener('click', this._productDeleteButtonClickHandler.bind(this));

    // get the product increase quantity button element of `productEl`
    const productIncreaseQtyButton = productEl.querySelector('button.increase-qty');
    // add a click event listener to the product increase quantity button element
    productIncreaseQtyButton.addEventListener('click', this._productIncreaseQtyButtonClickHandler.bind(this));

    // get the product decrease quantity button element of `productEl`
    const productDecreaseQtyButton = productEl.querySelector('button.decrease-qty');
    // add a click event listener to the product decrease quantity button element
    productDecreaseQtyButton.addEventListener('click', this._productDecreaseQtyButtonClickHandler.bind(this));
  }



  /**
   * Handler that is called whenever the main app layout gets scrolled
   *
   * @param { Event } event - The event that triggered the handler
   */
  _mainAppLayoutScrollHandler(event) {
    // Get the scroll element as `scrollEl`
    const scrollEl = event.currentTarget;

    // Get the `scrollTop` value of `scrollEl`
    const scrollTop = scrollEl.scrollTop;
    // Get the scroll height of `scrollEl` as `scrollHeight`
    const scrollHeight = scrollEl.scrollHeight;
    // Get the offset height of `scrollEl` as `offsetHeight`
    const offsetHeight = scrollEl.offsetHeight;


    // Check if the user has scrolled to the bottom of the page
    let bottomReached = (scrollTop + offsetHeight) >= scrollHeight;
    
    // If the user has scrolled to the bottom of the page...
    if (bottomReached) {
      // TODO: do something awesome here ;)
      // call the `onMainBottomReached` method
      this.onMainBottomReached();
    }


    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[35m[_mainAppLayoutScrollHandler](1): scrollTop => %d & scrollHeight => %d & offsetHeight => %d\x1b[0m`, scrollTop, scrollHeight, offsetHeight);
    console.log(`\x1b[35m[_mainAppLayoutScrollHandler](2): bottomReached ? %s\x1b[0m`, bottomReached);

  }

  /**
   * Returns a product template with the given `data`
   *
   * @param { Object } product - The product data to use to create the product element
   *
   * @returns { String } - The product template
   *
   * @private
   */
  _getProductTemplate(product) {
    return html`
    <li tabindex="0" role="product" class="product horizontal flex-layout center" data-id="${product.id}">

      <div class="product-actions-wrapper horizontal flex-layout center">
        <!-- Delete - Icon Button -->
        <button class="product-action-button delete-btn icon-button">
          <span class="material-icons icons">delete</span>
        </button>
      </div>

      <div class="product-image-wrapper">
        <img class="product-image" src="assets/images/products/${product.image}" alt="${product.name}">
      </div>

      <div class="product-info-wrapper vertical flex-layout flex">
        <h3 class="product-name">${product.name.length > 30 ? product.name.substr(0, 30) + '...' : product.name}</h3>
        <p class="product-price">${(product.price / 100).toFixed(2)} €</p>
        <span class="product-quantity txt caption">${mbApp.i18n.getString('qty')} : ${product.quantity}</span>
      </div>

      <div class="product-actions-wrapper horizontal flex-layout center">
        <!-- Quantity - Controls -->
        <div class="product-action-button quantity-controls vertical flex-layout center">
          <!-- Increase Quantity - Icon Button -->
          <button class="increase-qty icon-button"
            data-product-id="${product.id}">
            <span class="material-icons icons">add</span>
          </button>
          
          <span class="qty-value">${product.quantity}</span>

          <!-- Decrease/Reduce Quantity - Icon Button -->
          <button class="decrease-qty icon-button"
            data-product-id="${product.id}">
            <span class="material-icons icons">remove</span>
          </button>
        </div>
        <!-- End of Quantity - Controls -->

      </div>
   </li> 
   `;

  }


  /**
   * Handler that is called whenever an increase-quantity icon-button is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   */
  _productIncreaseQtyButtonClickHandler(event) {
    // get the icon button element from event as `iconButtonEl`
    const iconButtonEl = event.currentTarget;

    // get the product id from the dataset of `iconButtonEl`
    const productId = iconButtonEl.dataset.productId;

    // Get the current product quantity of `productId` as `currentQuantity`
    const currentQuantity = this.getQuantityByProductId(productId);

    // If the current quantity is at its maximum...
    if (currentQuantity === MAX_QUANTITY) {
      // ...show a toast for 3 seconds 
      // TODO: (message example) = 'You can\'t add more than 10 items of the same product to your cart'
      mbApp.showToast({
        message: mbApp.i18n.getString('maxQtyReached'), 
        type: ERROR_TOAST,
        part: MAIN_PART
      }, 3, true);

      // stop the execution of this handler
      return;
    }


    // disabled the icon button element
    iconButtonEl.disabled = true;

    // Increase the product quantity of `productId`
    this.increaseProductQuantity(productId).then((response) => {
      // enable the icon button element
      iconButtonEl.disabled = false;

      // notify the product quantity
      this.notifyProductQuantity(productId, response.quantity);

      // notify the cart of a recent update
      this.notifyUpdate(response.total_price, response.cart_total);

      // DEBUG [4dbsmaster]: tell me about it ;)
      console.log(`\x1b[33m[_productIncreaseQtyButtonClickHandler] (2): response => \x1b[0m`, response);
    });
     
    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[33m[_productIncreaseQtyButtonClickHandler] (1): productId => \x1b[0m`, productId);
  }


  /**
   * Handler that is called whenever an decrease-quantity icon-button is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   */
  _productDecreaseQtyButtonClickHandler(event) {
    // get the icon button element from event as `iconButtonEl`
    const iconButtonEl = event.currentTarget;

    // get the product id from the dataset of `iconButtonEl`
    const productId = iconButtonEl.dataset.productId;

    // Get the current product quantity of `productId` as `currentQuantity`
    const currentQuantity = this.getQuantityByProductId(productId);

    // If the current quantity is at its minimum...
    if (currentQuantity === MIN_QUANTITY) {
      // ...show a toast for 3 seconds
      mbApp.showToast({
        message: mbApp.i18n.getString('minQtyReached'), 
        type: ERROR_TOAST,
        part: MAIN_PART
      }, 3, true);

      // stop the execution of this handler
      return;
    }


    // disabled the icon button element
    iconButtonEl.disabled = true;

    // Decrease the product quantity of `productId`
    this.decreaseProductQuantity(productId).then((response) => {
      // enable the icon button element
      iconButtonEl.disabled = false;

      // notify the product quantity
      this.notifyProductQuantity(productId, response.quantity);

      // notify the cart of a recent update
      this.notifyUpdate(response.total_price, response.cart_total);

      // DEBUG [4dbsmaster]: tell me about it ;)
      console.log(`\x1b[34m[_productDecreaseQtyButtonClickHandler] (2): response => \x1b[0m`, response);
    });

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[34m[_productDecreaseQtyButtonClickHandler] (1): productId => \x1b[0m`, productId);
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
      type: response.success ? SUCCESS_TOAST : ERROR_TOAST,
      part: FULL_PART
    }, 3).then(() => {
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
