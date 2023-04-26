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

    // install prototype methods
    this._installPrototypeMethods();
  }


  // PUBLIC SETTERS

  /**
   * Sets the current hero product id with the given `heroProductId`
   *
   * @param { Number } heroProductId - The id of the product to set as the current hero product
   */
  set currentHeroProductId(heroProductId) {
    // get all the hero product ids as `heroProductIds`
    const heroProductIds = this.getAllHeroProductIds();

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(heroProductIds);

    // do nothing if the given `heroProductId` is not in the `heroProductIds` array,
    // or if the given `heroProductId` is the same as the current hero product id
    if ((!heroProductIds.includes(heroProductId)) || (heroProductId === this._currentHeroProductId)) { return }
    
    // update the `_currentHeroProductId` property with `heroProductId`
    this._currentHeroProductId = heroProductId;
  }


  // PUBLIC GETTERS

  /**
   * Returns the current hero product id
   *
   * @returns { Number }
   */
  get currentHeroProductId() {
    return this._currentHeroProductId;
  }
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

  
  /**
   * Returns a list of all the `<div class="dot">` elements in `<div class="hero-products-dots">`
   *
   * @returns { NodeList }
   */
  get heroDotEls() {
    return document.querySelectorAll('.hero-products-dots .dot');
  }
  

  /**
   * Returns a list of all the `<div class="product">` elements
   *
   * @returns { NodeList }
   */
  get productEls() {
    return document.querySelectorAll('.product');
  }



  // PUBLIC METHODS


  /**
   * Method used to like the product with the given `productId`
   *
   * @param { Number } productId - The id of the product to like
   * @param { Element } productEl - The product element
   * @param { Element } likeButtonEl - The like button element
   */
  likeProduct(productId, productEl, likeButtonEl) {
    // DEBUT [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[30m[likeProduct] (1): liking the product with the id ${productId}...\x1b[0m`);
    console.log(`\x1b[30m[likeProduct] (2): productEl =>  \x1b[0m`, productEl);
    console.log(`\x1b[30m[likeProduct] (3): likeButtonEl =>  \x1b[0m`, likeButtonEl);
  }

  /**
   * Method used to add the product with the given `productId` to the cart
   *
   * @param { Number } productId - The id of the product to add to the cart
   * @param { Element } productEl - The product element
   * @param { Element } addToCartButtonEl - The add to cart button element
   *
   */
  addProductToCart(productId, productEl, addToCartButtonEl) {
    return new Promise((resolve, reject) => {

      // start loading the cart button
      addToCartButtonEl.startLoading();

      // after 1 second ...
      // Why? Because we want to see the loading animation for at least 1 seconds #LOL
      setTimeout(async() => {

        // Creating a request to add the product to the cart...
        
        const url = `cart/${productId}`;
         
        // create a PUT request to add the product to the cart
        const request = new Request(url, {method: 'PUT'});

        // send the request
        let response = await fetch(request);
        // get the response body
        let responseData = await response.json();

        // DEBUG [4dbsmaster]: tell me about it ;)
        console.log(`\x1b[30m[addProductToCart] (1): responseData =>  \x1b[0m`, responseData);

        // stop loading the cart button
        addToCartButtonEl.stopLoading();

        // if the response is successful
        if (responseData.success) { 
          // ...resolve the promise
          resolve(responseData);
        } else {
          // ...reject the promise
          reject(responseData);
        }

      }, 1000);
      
      
      // DEBUT [4dbsmaster]: tell me about it ;)
      console.log(`\x1b[30m[addProductToCart] (1): adding the product with the id ${productId} to cart...\x1b[0m`);
      console.log(`\x1b[30m[addProductToCart] (2): productEl =>  \x1b[0m`, productEl);
      console.log(`\x1b[30m[addProductToCart] (3): addToCartButtonEl =>  \x1b[0m`, addToCartButtonEl);
    });

  }


  /**
   * Returns a list of all the hero product ids
   *
   * @returns { Array<Number> }
   */
  getAllHeroProductIds() {
    // create an empty array to store the hero product ids
    const heroProductIds = [];

    // loop through all the hero dots elements
    this.heroDotEls.forEach((heroDotEl) => {
      // get the hero product id from the hero dot element
      const heroProductId = heroDotEl.dataset.productId;

      // add the hero product id to the `heroProductIds` array
      heroProductIds.push(heroProductId);
    });

    // return the `heroProductIds` array
    return heroProductIds;
  }

  /**
   * Returns the currently active hero product element with the given
   *
   * @returns { Element }
   */
  getActiveHeroProductEl() {
    return document.querySelector('.hero-product[active]');
  }

  /**
   * Returns the currently active hero dot element with the given
   *
   * @returns { Element }
   */
  getActiveHeroDotEl() {
    return document.querySelector('.hero-products-dots .dot[active]');
  }



  /**
   * Returns the hero product element with the given `heroProductId`
   *
   * @param { Number } heroProductId - The id of the hero product to get
   *
   * @returns { Element }
   */
  getHeroProductById(heroProductId) {
    return document.querySelector(`.hero-product[data-product-id="${heroProductId}"]`);
  }

  /**
   * Returns the hero dot element with the given `heroProductId`
   *
   * @param { Number } heroProductId - The product id of the dot to get
   *
   * @returns { Element }
   */
  getHeroDotById(heroProductId) {
    return document.querySelector(`.hero-products-dots .dot[data-product-id="${heroProductId}"]`);
  }


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

    // looping through all the hero dots...
    this.heroDotEls.forEach((heroDotEl) => {
      // ...listen to the 'click' events on each `heroDotEl`
      heroDotEl.addEventListener('click', this.#_heroDotClickHandler.bind(this));
    });


    // looping through all product elements...
    this.productEls.forEach((productEl) => {
      // ...listen to the 'click' events on each `productEl`
      productEl.addEventListener('click', this.#_productClickHandler.bind(this));
    });

  }

  /**
   * Method used to install prototype methods on the home page
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
  

  /**
   * Handler that is called whenever a product element is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   */
  #_productClickHandler(event) {
    // get the target element as `targetEl`
    let targetEl = event.target;
    // get the current element as `currentEl`
    let currentEl = event.currentTarget;

    // get the productId from `currentEl`
    let productId = currentEl.dataset.productId;

    // check if the target element is a like button
    let isLikeButton = targetEl.classList.contains('like-btn');
    // check if the target element is an `add-to-cart` button
    let isAddToCartButton = targetEl.classList.contains('add-to-cart-btn');

    // If the user tapped on the like button...
    if (isLikeButton) {
      // ...call the `likeProduct` method ,
      // with the `productId` and `currentEl` and `targetEl`
      this.likeProduct(productId, currentEl, targetEl);

    }else if (isAddToCartButton) { // <- else if the user tapped on the add-to-cart button...
      // ...call the `addProductToCart` method ,
      this.addProductToCart(productId, currentEl, targetEl).then((responseData) => {
        // ...toast the message from the response data (for 3 seconds)
        mbApp.showToast({message: responseData.message, type: SUCCESS_TOAST, part: MAIN_PART}, 3, true);
        // update the app's cart count
        mbApp.updateCartCount(responseData.cart_total);
      });

    }else {
      // redirect the user to the product page
      mbApp.navigate(`product/${productId}`);
    }


    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[33m[_productClickHandler] (1): productId => ${productId}  & isLikeButton ? ${isLikeButton} & isAddToCartButton ? ${isAddToCartButton}\x1b[0m`);
    console.log(`\x1b[33m[_productClickHandler] (2): targetEl => \x1b[0m`, targetEl);
    console.log(`\x1b[33m[_productClickHandler] (3): currentEl => \x1b[0m`, currentEl);
  }


  /**
   * Handler that is called whenever a hero dot is clicked
   *
   * @param { PointerEvent } event - The event that triggered the handler
   *
   * @returns { void }
   * @private
   */
  #_heroDotClickHandler(event) {
    // get the dot element from `event` as `dotEl`
    const dotEl = event.target;
    // get the product id from the `dotEl` as `productId`
    const productId = dotEl.dataset.productId;

    // set the current hero product id to `productId`
    this.currentHeroProductId = productId;
    
    // notify the the hero product that a change has been made
    this.#_notifyHeroProductChange();

    console.log(this.currentHeroProductId);
  }


  /**
   * Method used to notify the hero product that a change has been made
   *
   * @param { Number } heroProductId - The id of the hero product that has been changed
   */
  #_notifyHeroProductChange(currentHeroProductId = this.currentHeroProductId) {
    // get the hero product element with the given `currentHeroProductId` as `heroProductEl`
    const heroProductEl = this.getHeroProductById(currentHeroProductId);
    // get the hero dot element with the given `currentHeroProductId` as `heroDotEl`
    const heroDotEl = this.getHeroDotById(currentHeroProductId);


    // get the active hero product element as `activeHeroProductEl` 
    const activeHeroProductEl = this.getActiveHeroProductEl();
    // get the active hero dot element as `activeHeroDotEl` 
    const activeHeroDotEl = this.getActiveHeroDotEl();



    // if the id of the active hero product element is not the same as the given `currentHeroProductId`...
    if (activeHeroProductEl.dataset.productId !== currentHeroProductId) { 
      // ...deactivate the `activeHeroProductEl` by removing its `active` attribute
      activeHeroProductEl.removeAttribute('active');
      // and activate the `heroProductEl` by adding its `active` attribute
      heroProductEl.setAttribute('active', '');
    }
    

    // if the id of the active hero dot element is not the same as the given `currentHeroProductId`...
    if (activeHeroDotEl.dataset.productId !== currentHeroProductId) { 
      // ...deactivate the `activeHeroDotEl` by removing its `active` attribute
      activeHeroDotEl.removeAttribute('active');
      // and activate the `heroDotEl` by adding its `active` attribute
      heroDotEl.setAttribute('active', '');
    }


    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[35m[_notifyHeroProductChange]: currentHeroProductId => ${currentHeroProductId}\x1b[0m`);
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

    // Show the home menu, using the `homeMenu` id
    mbApp.showMenuById('homeMenu', 0.5, MAIN_PART);
  }

}


// Instantiate the class as `homePage`
let homePage = new HomePage();

// Export the `homePage` #JIC, #forNow ;)
export { homePage };
