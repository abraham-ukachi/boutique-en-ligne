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
* @name: Shop Page
* @codename: shopPage 
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
import { 
  html,
  SUCCESS_TOAST, GOOD_TOAST, BAD_TOAST, ERROR_TOAST, NORMAL_TOAST,
  MAIN_PART, ASIDE_PART, FULL_PART
} from '../app.js';

"use strict"; 
// ^^^^^^^^^ This keeps us on our toes, as it forces us to use all pre-defined variables, among other things 😅

// Define some constants ;)

// currency symbols
const CURRENCY_SYMBOL_DOLLARS = '$';
const CURRENCY_SYMBOL_EUROS = '€';
const CURRENCY_SYMBOL_DEFAULT = CURRENCY_SYMBOL_EUROS; // <- we are in france afterall #LOL ;)

/**
 * Class representing the shop page
 */
class ShopPage  {

  // Declaring some properties...

  // public properties
  
  allCategories = [];
  subCategories = [];

  categoryId = -1;
  subCategoryId = -1;

  categoryName = '';
  subCategoryName = '';
  wallpaperImage = ''; // <- eg.: 'dj.jpg'

  minPrice = 0;
  maxPrice = 100;

  colorId = 0;
  colorName = '';
  colorHex = '';

  selectedColors = ['green', 'yellow'];

  prices = [];
  colors = [];



  /**
   * Current supported sorting options
   *
   * @type { Array }
   */
  sortOptions = [
    'default',
    'names_az',
    'names_za',
    'newest',
    'oldest',
    'cheapest',
    'most_expensive',
    'popular'
  ];


  // private properties
  _productImageDir = 'assets/images/products';
  _categoryImageDir = 'assets/images/categories';
  _menuDuration = 0.5;
  _dialogDuration = 0.5;
  _filterDuration = 300;

  _page = 1;
  _search = ''; // <- eg.: 'pia'
  _query = ''; // <- eg.: 'category=pianos&sub_category=grand-piano...'

  



  /**
   * The constructor of the class
   */
  constructor() {

    // mbApp.i18n.dataLoaded = (data) => console.log('I18n has been loaded!!!!');


    // install the event listeners
    this._installEventListeners();

    // install prototype methods
    this._installPrototypeMethods();
    

    // HACK: After 1 seconds...
    setTimeout(() => {
      // update the page title
      mbApp.setTitle(mbApp.i18n.getString('shop') + ' - ' + mbApp.i18n.getString('appName'));
    }, 1000);
    
    
  }


  /**
   * Method that is called whenever the maxaboom app (mbApp) is ready
   *
   * @params { Object } i18n locale strings data
   */
  ready(data) {

    // TODO: Do something awesome here... 🤔 

    // call the `onSelectedColorsChange()` method
    this.onSelectedColorsChange();

    // this.showAllSubcategories(this.categoryId, this.categoryName, this.subCategoryName);
    
    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[32m[ready]: data => \x1b[0m`, data);
  }




  // PUBLIC SETTERS

  
  /**
   * Updates the current wallpaper image element with the given `value`
   *
   * @param { String } value
   */
  set currentWallpaperImage(value) {
    this.wallpaperImageEl.src = value;
  }


  /**
   * Updates the current sort name
   * NOTE: This setter updates the name of the sort 
   * button element with the specified value
   *
   * @type { String } value
   */
  set currentSortName(value) {
    this.sortButtonEl.name = value;
    // get the span in sort button element as `sortSpanEl`
    let sortSpanEl = this.sortButtonEl.querySelector('span:not(.material-icons)');

    // create a sort html based on the value
    let sortHTML = (value !== 'default') ? mbApp.i18n.getString('sortBy') + ' : ' + `<b>${mbApp.i18n.getString(value)}</b>` : mbApp.i18n.getString('sort');

    // update the inner HTML of `sortSpanEl` with `sortHTML`
    sortSpanEl.innerHTML = sortHTML;
  }


  /**
   * Sets the category id
   *
   * @type { Number } value
   */
  set categoryId(value) {
    document.body.dataset.categoryId = value ?? -1;
  }


  /**
   * Sets the category name
   *
   * @type { String } value
   */
  set categoryName(value) {
    document.body.dataset.categoryName = value ?? '';
  }

  /**
   * Sets the sub-category name.
   *
   * @type { String } value
   */
  set subCategoryName(value) {
    document.body.dataset.subCategoryName = value ?? '';
  }

  /**
   * Sets the sub-category id
   *
   * @type { Number } value
   */
  set subCategoryId(value) {
    document.body.dataset.subCategoryId = value ?? -1;
  }
  

  // PUBLIC GETTERS
  


  /**
   * Returns the current image source/path of the wallpaper
   *
   * @returns { String }
   */
  get currentWallpaperImage() {
    return this.wallpaperImageEl.src;
  }


  /**
   * Returns the current sort name
   *
   * @returns { String }
   */
  get currentSortName() {
    return this.sortButtonEl.name;
  }


  /**
   * Returns the `<div id="wallpaper">` element
   *
   * @returns { Element }
   */
  get wallpaperEl() {
    return document.getElementById('wallpaper');
  }


  /**
   * Returns the `<img>` of `wallpaperEl`
   *
   * @returns { Element }
   */
  get wallpaperImageEl() {
    return this.wallpaperEl.querySelector('img');
  }


  /**
   * Returns the `<div id="progressBar">` element
   *
   * @returns { Element } 
   */
  get progressBarEl() {
    return document.getElementById('progressBar');
  }

  /**
   * Returns the `<div id="searchBar" class="app-bar">` element
   *
   * @returns { Element }
   */
  get searchBarEl() {
    return document.getElementById('searchBar');
  }

  /**
   * Returns the `<div class="input-wrapper">` element in `searchBarEl`
   *
   * @returns { Element }
   */
  get searchBarInputWrapperEl() {
    return this.searchBarEl.querySelector('.input-wrapper');
  }

  /**
   * Returns the `<button id="searchIconButton" class="icon-button">` element in `searchBarEl`
   *
   * @returns { HTMLButtonElement }
   */
  get searchIconButtonEl() {
    return this.searchBarEl.querySelector('#searchIconButton');
  }


  /**
   * Returns the `<button id="searchDropdownButton" class="dropdown-button">` element in `searchBarEl`
   *
   * @returns { HTMLButtonElement }
   */
  get searchDropdownButtonEl() {
    return this.searchBarEl.querySelector('#searchDropdownButton');
  }

  /**
   * Returns the `<span class="value">` element in `searchDropdownButtonEl`
   *
   * @returns { HTMLSpanElement }
   */
  get searchDropdownValueEl() {
    return this.searchDropdownButtonEl.querySelector('.value');
  }



  /**
   * Returns the `<input id="searchInput">` element in `searchBarEl`
   *
   * @returns { HTMLInputElement }
   */
  get searchInputEl() {
    return this.searchBarEl.querySelector('#searchInput');
  }


  /**
   * Returns the `<div id="searchIndicator">` element in `searchBarEl`
   *
   * @returns { HTMLDivElement }
   */
  get searchIndicatorEl() {
    return this.searchBarEl.querySelector('#searchIndicator');
  }

  /**
   * Return the `<button id="goBackButton">`
   *
   * @returns { HTMLButtonElement }
   */
  get goBackButtonEl() {
    return document.getElementById('goBackButton');
  }
 
   
  
  /**
   * Returns the `<div id="preview" class="container">` element
   *
   * @returns { Element }
   */
  get previewContainerEl() {
    return document.querySelector('#preview.container');
  }


  /**
   * Returns the `<div id="products" class="container">` element
   *
   * @returns { Element }
   */
  get productsContainerEl() {
    return document.querySelector('#products.container');
  }



  /**
   * Returns the category id
   *
   * @returns { Number }
   */
  get categoryId() {
    return document.body.dataset.categoryId;
  }


  /**
   * Returns the category name
   *
   * @returns { String }
   */
  get categoryName() {
    return document.body.dataset.categoryName;
  }

  /**
   * Returns the sub-category name.
   *
   * @returns { String }
   */
  get subCategoryName() {
    return document.body.dataset.subCategoryName;
  }

  /**
   * Returns the sub-category id
   *
   * @returns { Number }
   */
  get subCategoryId() {
    return document.body.dataset.subCategoryId;
  }

  /**
   * Returns the `<section id="filterPanel">` element
   *
   * @returns { Element }
   */
  get filterPanelEl() {
    return document.getElementById('filterPanel');
  }


  /**
   * Returns the `<button id="filterToggleButton">` element
   *
   * @returns { Element }
   */
  get filterToggleButtonEl() {
    return document.getElementById('filterToggleButton');
  }


  /**
   * Returns the `<div id="productsWrapper">` element
   *
   * @returns { Element }
   */
  get productsWrapperEl() {
    return document.getElementById('productsWrapper');
  }

  /**
   * returns the `<nav id="subcategorieslist">` element
   *
   * @returns { htmlelement }
   */
  get subCatListEl() {
    return document.getElementById('subCategoriesList');
  }


  /**
   * returns the `<ul id="productslist">` element
   *
   * @returns { htmlelement }
   */
  get productsListEl() {
    return document.getElementById('productsList');
  }


  /**
   * returns the `<button class="category-btn">` elements 
   *
   * @returns { nodelist }
   */
  get categoryButtons() {
    return document.querySelectorAll('.category-btn');
  }


  /**
   * Returns the `<div id="appBar" class="app-bar">` element
   *
   * @returns { Element }
   */
  get appBarEl() {
    return document.getElementById('appBar');
  }


  /**
   * Returns the `<h2 class="app-title">` in `appBarEl`
   *
   * @returns { Element }
   */
  get appTitleEl() {
    return this.appBarEl.querySelector('h2.app-title');
  }


  /**
   * Returns the `<h3 class="app-subtitle">` element of the app bar element (i.e. `appBarEl`)
   *
   * @returns { Element }
   */
  get appBarSubtitleEl() {
    return this.appBarEl.querySelector('.app-subtitle');
  }


  /**
   * Returns the `<div id="categoryBar" class="app-bar">` element
   *
   * @returns { Element }
   */
  get categoryBarEl() {
    return document.getElementById('categoryBar');
  }


  /**
   * Returns the `<button id="seeAllButton"> element
   *
   * @returns { HTMLButtonElement }
   */
  get seeAllButtonEl() {
    return document.getElementById('seeAllButton');
  }


  /**
   * Returns the `<button id="menuButton">` element
   *
   * @returns { HTMLButtonElement }
   * @readonly
   */
  get menuButtonEl() {
    return document.getElementById('menuButton');
  }

  /**
   * Returns the `<button id="sortButton">` element
   *
   * @returns { HTMLButtonElement }
   * @readonly
   */
  get sortButtonEl() {
    return document.getElementById('sortButton');
  }
  

  /**
   * Returns the `<button id="closeFilterButton">` element
   *
   * @returns { HTMLButtonElement }
   * @readonly
   */
  get closeFilterButtonEl() {
    return document.getElementById('closeFilterButton');
  }

  /**
   * Returns the `<li><button id="sortMenuItem">...</button></li>` element
   *
   * @returns { HTMLButtonElement }
   * @readonly
   */
  get sortMenuItemEl() {
    return document.getElementById('sortMenuItem');
  }

  /**
   * Returns the `<li><button id="filterMenuItem">...</button></li>` element
   *
   * @returns { HTMLButtonElement }
   * @readonly
   */
  get filterMenuItemEl() {
    return document.getElementById('filterMenuItem');
  }

  /**
   * Returns the `<button id="leftChipIconBtn" class="icon-button">` element
   *
   * @returns { HTMLButtonElement }
   * @readonly
   */
  get leftChipIconBtn() {
    return document.getElementById('leftChipIconBtn');
  }


  /**
   * Returns the `<button id="rightChipIconBtn" class="icon-button">` element
   *
   * @returns { HTMLButtonElement }
   * @readonly
   */
  get rightChipIconBtn() {
    return document.getElementById('rightChipIconBtn');
  }


  /**
   * Returns the `<div id="chipsBar" class="app-bar">` element
   *
   * @returns { Element }
   * @readonly
   */
  get chipsBarEl() {
    return document.getElementById('chipsBar');
  }


  /**
   * Returns the `<div id="subCategoryChips" class="chips-container" ...>` element
   *
   * @returns { HTMLDivElement }
   * @readonly
   */
  get subCategoryChipsEl() {
    return document.getElementById('subCategoryChips');
  }

  /**
   * Returns the `<ul class="chips" role="tabs">` element in the `subCategoryChipsEl`
   *
   * @retusn { HTMLUListElement }
   * @readonly
   */
  get subCategoryChipsTabsEl() {
    return this.subCategoryChipsEl.querySelector('.chips');
  }
  
  
  /**
   * Returns the `<ul class="chips ...">` element inside the `subCategoryChipsEl`
   *
   * @returns { HTMLUListElement }
   * @readonly
   */
  get subCategoryChipsScrollTargetEl() {
    return this.subCategoryChipsEl.querySelector('ul.chips');
  }



  /**
   * Returns all the `<li class="chip ...">` elements inside the `subCategoryChipsScrollTargetEl`
   *
   * @returns { Array[HTMLLIElement] }
   * @readonly
   */
  get allSubCategoryChips() {
    return this.subCategoryChipsScrollTargetEl.querySelectorAll('li.chip');
  }


  /**
   * Returns the `<div id="busyContainer" class="container">` element
   *
   * @returns { HTMLDivElement }
   * @readonly
   */
  get busyContainerEl() {
    return document.getElementById('busyContainer');
  } 


  /**
   * Returns the `<ul id="filters" class="filters">` element
   *
   * @returns { Element }
   * @readonly
   */
  get filtersEl() {
    return document.getElementById('filters');
  }


  /**
   * Returns a list of `<li class="filter-item">` elements in `filtersEl`
   *
   * @returns { Element }
   * @readonly
   */
  get filterItemEls() {
    return this.filtersEl.querySelectorAll('.filter-item');
  }

  /**
   * Returns the `<li id="colorFilterItem">` element
   * 
   * @returns { Element }
   * @readonly
   */
  get colorFilterItemEl() {
    return document.getElementById('colorFilterItem');
  }


  /**
   * Returns the `<span class="spinner">` element in `colorFilterItemEl`
   * 
   * @returns { HTMLSpanElement }
   * @readonly
   */
  get colorSpinnerEl() {
    return this.colorFilterItemEl.querySelector('.spinner');
  }


  /**
   * Returns the `<li id="priceFilterItem">` element
   * 
   * @returns { Element }
   * @readonly
   */
  get priceFilterItemEl() {
    return document.getElementById('priceFilterItem');
  }


  /**
   * Returns the `<span class="spinner">` element in `priceFilterItemEl`
   * 
   * @returns { HTMLSpanElement }
   * @readonly
   */
  get priceSpinnerEl() {
    return this.priceFilterItemEl.querySelector('.spinner');
  }


  
  /**
   * Returns the `<h3 class="app-title">` element of the `filterPanelEl`
   *
   * @returns { Element }
   * @readonly
   */
  get filterPanelTitleEl() {
    return this.filterPanelEl.querySelector('.app-bar .app-title');
  }

  
  /**
   * Returns the `<h4 class="app-subtitle">` element of the `filterPanelEl`
   *
   * @returns { Element }
   * @readonly
   */
  get filterPanelSubtitleEl() {
    return this.filterPanelEl.querySelector('.app-bar .app-subtitle');
  }


  // PUBLIC METHODS


  /**
   * Shows the app's progress bar.
   *
   * @param { Boolean } intermediate - Whether the progress should be intermediate or not
   */
  showProgressBar(intermediate = false) {
    // If intermediate is TRUE
    if (intermediate) {
      // add an `intermediate` key to the class list
      this.progressBarEl.classList.add('intermediate');
    }

    // Set the `hidden` property of `progressBarEl` to FALSE
    this.progressBarEl.hidden = false;
    
    // disabled the search bar's input wrapper element
    this.searchBarInputWrapperEl.disabled = true;
    
    // hide the chips bar element
    this.chipsBarEl.hidden = true;

    // disable the go-back button
    this.disableGoBackButton();
  }


  /**
   * Hides the app's progress bar.
   */
  hideProgressBar() {
    // Remove any `intermediate` key from the class list of `progressBarEl`
    this.progressBarEl.classList.remove('intermediate');

    // Set the `hidden` property of `progressBarEl` to TRUE
    this.progressBarEl.hidden = true;

    // enable the search bar's input wrapper element
    this.searchBarInputWrapperEl.disabled = false;
    
    // show the chips bar element
    this.chipsBarEl.hidden = false;

    // enable the go-back button
    this.enableGoBackButton();
  }

  


  // function for empty the div that contains sub categories
  emptySubCategories() {
    this.subCatListEl.innerHTML = "";
  }
  
  
  // function for empty the div that contains sub categories
  emptyProducts() {
    this.productsListEl.innerHTML = "";
  }
   
    
  /**
   * Fetch api/sub_categories
   *
   * @param { Number } categoryId
   * @param { String } categoryName
   * @param { String } subCategoryName
   *
   * @returns { promise<void> }
   */
  async showAllSubcategories(categoryId, categoryName, subCategoryName) {
    this.subCatListEl.innerhtml = "";

    let response = await fetch(`api/sub_categories/${categoryId}`); // fetch on api/sub_categories/categorIdd
    let subcategories = await response.json(); // json response
    
    subcategories.forEach(subCategory => { // loop on response subcategories
      let subcatid = subCategory.id; // storage subCategory.id
      let subcatname = subCategory.name.replaceall(' ', '-'); // replace some characters
      let linktemplate = `<li><button class="sub-category-link" onclick="handlesubCategorylinkclick(this)" data-category-name="${categoryName} " data-category-id="${categoryId}" data-sub-category-name="${subcatname}"data-sub-category-id="${subcatid}" link="shop/${categoryName}/${subcatname}" ${(subCategoryName == subCategory.name) ? 'active' : ''}>${subCategory.name}</button></li>`; // display category and subCategory names
      subCatListEl.insertadjacenthtml("beforeend", linktemplate);
    });
    
  }


  /**
   * function that show products filter by category.
   * @param categoryId
   * @returns {promise<void>}
   */
  async showProductsByCategory(categoryId) {
      this.productsListEl.innerHTML = "";

      let response = await fetch(`api/products/${categoryId}`);
      let productsByCategory = await response.json();
       
      productsByCategory.forEach(product => {
        let productId = product.id;
        let productName = product.name;
        let productPrice = product.price;
        let productImage = product.image;
        let productDescription = product.description;
        let productTemplate = `<li>${this.getProductTemplate(productId, productImage, productName, productDescription, productPrice)}</li>`;

        this.productsListEl.insertadjacenthtml("beforeend", productTemplate);
      })
  }


  /**
   * This function is a template for display our products
   *
   * @param { Number } productId 
   * @param { String } productNtImage
   * @param { String } productName
   * @param { String } productDescription
   * @param { Number } productPrice
   *
   * @returns { String }
   */
  getProductTemplate(productId, productImage, productName, productDescription, productPrice) {
    return `
    <div class="product" data-id="${productId}">
        <img src="${this._productImageDir}/${productImage}" width="300" height="300"/>
        <h3>${productName}</h3>
        <p> ${productDescription} P</p>
       <div><span>prix : ${productPrice}</span><button><a href="/boutique-en-ligne/product/${productId}">voir le produit</a></button></div>
    </div>
    `;
  }


  /**
   * Updates the wallpaper with the given `image`
   *
   * @param { String } image - eg.: 'dj.jpg'
   */
  updateWallpaper(image) {
    this.currentWallpaperImage = this._categoryImageDir + '/' + image;
  }


  /**
   * Shows the wallpaper
   */
  showWallpaper() {
    this.wallpaperEl.hidden = false;
  }


  /**
   * Hides the wallpaper
   */
  hideWallpaper() {
    this.wallpaperEl.hidden = true;
  }




  /**
   * This function show our products filtered by sub category
   *
   * @param { Number } categoryId
   * @param { Number } subCategoryId
   *
   * @returns { Promise<void> }
   */
  async showProductsBySubcategory(categoryId, subCategoryId) {
    productsListEl.innerHTML = "";
    
    let response = await fetch(`api/products/${categoryId}/${subCategoryId}`);
    let productsbysubCategory = await response.json();
    
    productsbysubCategory.forEach(product => {
        let productId = product.id;
        let productName = product.name;
        let productPrice = product.price;
        let productImage = product.image;
        let productDescription = product.description;
        let productTemplate = `<li>${this.getProductTemplate(productId, productImage, productName, productDescription, productPrice)}</li>`;
        productsListEl.insertadjacenthtml("beforeend", productTemplate);
    });
    
  
  }




  /**
   * Handler that is called whenever a category button is clicked
   *
   * @param { PointerEvent } event - The click event
   */
  _handleCategoryBtnClick(event) {
    // get the current target / category button element as `el` 
    let el = event.currentTarget;
    // retrieve the category id and name from its dataset
    let categoryId = el.dataset.categoryId;
    let categoryName = el.dataset.categoryName;
    let categoryImage = el.dataset.categoryImage;

    // navigate to this category
    this.navigateTo(categoryId, categoryName);

    // update the wallpaper
    this.updateWallpaper(categoryImage);

    // show the wallpaper
    this.showWallpaper();

    // show the filter panel
    this.showFilterPanel();

    // show the products wrapper
    this.showProductsWrapper();

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[handleCategoryBtnClick]: categoryId => ${categoryId} & categoryName => ${categoryName}  & categoryImage => ${categoryImage} & event => \x1b[0m`, event);

  }


  /**
   * Loades the sub categories using the given `categoryId`
   *
   * @param { Number } categoryId - The category id
   *
   * @returns { Promise<void> }
   * @private
   */
  _loadSubCategories(categoryId = this.categoryId) {
    return new Promise((resolve, reject) => {
      // fetch the sub-categories of the specified `categoryId` from our server
      mbApp.fetchCategories(categoryId).then((subCategories) => {
        // update the `subCategories` property
        this.subCategories = subCategories;
        
        // TEST / SIM: wait for 1 second before resolving the promise
        setTimeout(() => resolve(subCategories), 1000);

      }).catch(error => reject(error));

    });
  }



  /**
   * @param el
   */
  handleSubcategoryLinkClick(el) {
      let subCategoryId = el.dataset.subCategoryId;
      let subCategoryName = el.dataset.subCategoryName;
      let categoryId = el.dataset.categoryId;
      let categoryName = el.dataset.categoryName.replace(' ', '');
      this.showProductsBySubcategory(categoryId, subCategoryId);
      let path = location.pathname.split('/');
      window.history.pushState({}, '', 'shop/' + `${categoryName}` + '/' + `${subCategoryName}`);
      this.notifySubcategoryLinks(subCategoryId);

  }


  /**
   * This function allow us to set attribute on our category active for show it in red
   * @param categoryId
   */
  notifyCategoryLinks(categoryId) {
    this.categoryLinkEl.forEach(catLinkEl => {
      if (catLinkEl.dataset.categoryId == categoryId) {
          catLinkEl.setAttribute('active', '');
      } else {
          catLinkEl.removeAttribute('active');
      }
    })
  }

  /**
   * This function allow us to set attribute on our sub category active for show it in red
   * @param subCategoryId
   */
  notifySubcategoryLinks(subCategoryId) {
    let subCategoryLinkEl = document.querySelectorAll('.sub-category-link');
    subCategoryLinkEl.forEach(subcatLinkEl => {
      if (subcatLinkEl.dataset.subCategoryId == subCategoryId) {
          subcatLinkEl.setAttribute('active', '');
      } else {
          subcatLinkEl.removeAttribute('active');
      }
    });
  }

  
  /**
   * Method used to select a subCategory chip element, using the specified `subCategoryId`
   *
   * @param { Number } subCategoryId
   */
  selectSubCategoryById(subCategoryId) {
    // TODO: Create a private `_selectSubCategory({type: 'id', value: subCategoryValue})` method,
    //       that will be used to select a subCategory chip element` using the specified `subCategoryId` or `subCategoryName`

    // loop through all subCategory chips
    this.allSubCategoryChips.forEach((subCategoryChipEl) => {
      // get the subCategory id of the current subCategory chip
      const subCategoryChipId = subCategoryChipEl.dataset.subcategoryId;

      // if the current subCategory chip id is equal to the given `subCategoryId`...
      if (subCategoryChipId === subCategoryId) {
        // ...select the current subCategory chip
        subCategoryChipEl.setAttribute('aria-selected', 'true');
        // create a `selected` property on the current subCategory chip
        subCategoryChipEl.setAttribute('selected', '');
        // focus the current subCategory chip
        subCategoryChipEl.focus();
      } else {
        // deselect the current subCategory chip
        subCategoryChipEl.setAttribute('aria-selected', 'false');
        // remove the `selected` property from the current subCategory chip
        subCategoryChipEl.removeAttribute('selected');
      }
    });

  }


  /**
   * Method used to select a subCategory chip element, using the specified `subCategoryName`
   *
   * @param { String } subCategoryName
   */
  selectSubCategoryByName(subCategoryName) {
    // loop through all subCategory chips
    this.allSubCategoryChips.forEach((subCategoryChipEl) => {
      // get the subCategory name of the current subCategory chip
      const subCategoryChipName = subCategoryChipEl.dataset.subcategoryName;

      // if the current subCategory chip name is equal to the given `subCategoryName`...
      if (subCategoryChipName === subCategoryName) {
        // ...select the current subCategory chip
        subCategoryChipEl.setAttribute('aria-selected', 'true');
        // create a `selected` property on the current subCategory chip
        subCategoryChipEl.setAttribute('selected', '');
        // focus the current subCategory chip
        subCategoryChipEl.focus();
      } else {
        // deselect the current subCategory chip
        subCategoryChipEl.setAttribute('aria-selected', 'false');
        // remove the `selected` property from the current subCategory chip
        subCategoryChipEl.removeAttribute('selected');
      }
    });

  }

 

 /**
  * Handler that is called whenever the price range changes
  *
  * @param { Number } minPrice
  * @param { Number } maxPrice
  */
 onPriceChange(minPrice = this.minPrice, maxPrice = this.maxPrice) {
   // get the emoji of this price range
   let emoji = this._getPriceRangeEmoji(minPrice, maxPrice);
   // get the computed price range text
   let priceRangeText = this._getComputedPriceRange(minPrice, maxPrice);

   // update the filter item subtitle of the price filter-item element 
   this.updateFilterItemSubtitleOf(this.priceFilterItemEl, emoji + ' ' + priceRangeText);
 }


 /**
  * Handler that is called whenever the color changes
  *
  * @param { Number } colorId
  * @param { String } colorName
  * @param { String } colorHex
  *
  */
 onColorChange(colorId = this.colorId, colorName = this.colorName, colorHex = this.colorHex) {}

  /**
   * Handler that is called whenever the colors have been selected
   *
   * @param { Array } selectedColors
   *
   */
  onSelectedColorsChange(selectedColors = this.selectedColors) {
    // create a subtitle,
    // using the `selectedColors`
    let subtitle = (!selectedColors.length) ? mbApp.i18n.getString('pickOneOrMoreColors') : selectedColors.join(', ');

    // update the filter item subtitle of the price filter-item element 
    this.updateFilterItemSubtitleOf(this.colorFilterItemEl, subtitle);
  }


  /**
   * Method used to update the subtitle of the given `filterItemEl` 
   * with the specified `value`
   *
   * @param { Eleemnt } filterItemEl
   * @param { String } value
   */
   updateFilterItemSubtitleOf(filterItemEl, value) {
     // get the subtitle element of the `filterSubtitleEl`
     let filterSubtitleEl = filterItemEl.querySelector('.filter-subtitle');

     // update it's inner html with the given `value`
     filterSubtitleEl.innerHTML = value;

    // DEBUG [4dbsmaster]: tell me about all the price filter items ;)
     console.log(`\x1b[41;34m[updateFilterItemSubtitleOf]: (1) value => ${value} & filterSubtitleEl => \x1b[0m`, filterSubtitleEl);
     console.log(`\x1b[41;34m[updateFilterItemSubtitleOf]: (2) filterItemEl => \x1b[0m`, filterItemEl);
   }



  /**
   * Updates the shop url
   * NOTE: This method pushes a new state to the current browser's history API, using the specified `url`
   *
   * @param { String } url
   */
  updateUrl(url) {
    window.history.pushState({}, '', url ? `shop/${url}` : 'shop');
  }

  /**
   * Updates the category properties 
   *
   * @param { Object } props - eg.: { categoryId: 2, categoryName: 'guitars', subCategoryId: 1, subCategoryName: 'electric' }
   */
  updateCategoryProps(props) {
    this.categoryId = props.categoryId ?? -1;
    this.categoryName = props.categoryName ?? '';
    this.subCategoryId = props.subCategoryId ?? -1;
    this.subCategoryName = props.subCategoryName ?? '';
  }


  /**
   * Updates the shop title
   *
   * @param { String } shopTitle
   */
  updateShopTitle(shopTitle) {
    this.appTitleEl.textContent = mbApp.i18n.getString('x@Maxaboom').replace('%s', shopTitle);
  }


  /**
   * Method used to notify the color filter item of a recent update
   *
   * @param { Array } selectedColors
   */
  notifySelectedColorsFilterUpdate(selectedColors = this.selectedColors) {
    // get all the color filter elements as `allColorFilterEls`
    let allColorFilterItems = this.colorFilterItemEl.querySelectorAll('.color-filter');
    
    // loop through all the color filter items
    allColorFilterItems.forEach((colorFilterItem) => {
      // IDEA: Select or deselect the color filter item based on in their id, name and hex
      // attributes match the specified `colorId`, `colorName` and `colorHex`
      
      // get the current color id, name and hex
      let currentColorId = parseInt(colorFilterItem.dataset.id);
      let currentColorName = colorFilterItem.dataset.name;
      let currentColorHex = colorFilterItem.dataset.hex;

      // check if the colors match
      let colorsMatch = selectedColors.indexOf(currentColorName) !== -1;
      
      if (colorsMatch) {
        colorFilterItem.setAttribute('selected', '');
      } else {
        colorFilterItem.removeAttribute('selected');
      }
      
      // DEBUG [4bsmaster]: tell me about the prices
      console.log(`\x1b[30m[notifySelectedColorsFilterUpdate]: (2)
        colorsMatch ? ${colorsMatch} &
        currentColorId => ${currentColorId} & 
        currentColorName => ${currentColorName} & 
        currentColorHex => ${currentColorHex} \x1b[0m
      `);
      
    });

    // DEBUG [4dbsmaster]: tell me about all the price filter items ;)
    console.log(`\x1b[34m[notifySelectedColorsFilterUpdate]: (1) allColorFilterItems => \x1b[0m`, allColorFilterItems);
  }

  /**
   * Method used to notify the price filter item of a recent min + max price update
   *
   * @param { Number } minPrice
   * @param { Number } maxPrice
   */
  notifyPriceFilterUpdate(minPrice = this.minPrice, maxPrice = this.maxPrice) {
    // get all the price filter elements as `allPriceFilterEls`
    let allPriceFilterItems = this.priceFilterItemEl.querySelectorAll('.price-filter');

    // loop through all the price filter items
    allPriceFilterItems.forEach((priceFilterItem) => {
      // IDEA: Select or deselect the price filter item based on in their min and 
      // max attributes match the specified `minPrice` and `maxPrice`

      // get the current min & max prices
      let currentMinPrice = parseInt(priceFilterItem.dataset.min);
      let currentMaxPrice = parseInt(priceFilterItem.dataset.max);

      // check if the prices match
      let pricesMatch = currentMinPrice === minPrice && currentMaxPrice === maxPrice;

      if (pricesMatch) {
        priceFilterItem.setAttribute('selected', '');
      } else {
        priceFilterItem.removeAttribute('selected');
      }

      // DEBUG [4bsmaster]: tell me about the prices
      console.log(`\x1b[30m[notifyPriceFilterUpdate]: (2)
        pricesMatch ? ${pricesMatch} &
        currentMinPrice => ${currentMinPrice} & 
        currentMaxPrice => ${currentMaxPrice} \x1b[0m
      `);

    });

    // DEBUG [4dbsmaster]: tell me about all the price filter items ;)
    console.log(`\x1b[34m[notifyPriceFilterUpdate]: (1) allPriceFilterItems => \x1b[0m`, allPriceFilterItems);
    
  }

  /**
   * Method used to notify the search bar of a recent update and update it accordingly
   * 
   * @param { String } ?categoryName - the category's name to search for (eg.: 'guitars')
   */
  notifySearchBar(categoryName = this.categoryName) {
    // do nothing if there's no category name
    if (!categoryName.length) { return }

    // update the search dropdown value's textContent & input's placeholder
    this.searchDropdownValueEl.textContent = mbApp.i18n.getString(categoryName);
    this.searchInputEl.placeholder = mbApp.i18n.getString('searchInX').replace('%s', categoryName);

  }

  /**
   * Notifies the wallpaper image of any recent update
   *
   * @param { String } wallpaperImage 
   */
  notifyWallpaperUpdate(wallpaperImage = this.wallpaperImage) {
    // update the wallpaper
    this.updateWallpaper(wallpaperImage);
    
    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[30m[notifyWallpaperUpdate]: wallpaperImage => ${wallpaperImage} \x1b[0m`);
  }



  /**
   * Notifies the categories of a recent update
   *
   * @param { Number } categoryId
   * @param { String } categoryName
   */
  notifyCategoriesUpdate(categoryId = this.categoryId, categoryName = this.categoryName) {

    // scroll to top, after 100 milliseconds
    setTimeout(() => mbApp.mainAppLayout.scrollTop = 0, 100);

    // start loading subcategories...

    // show the progress bar
    this.showProgressBar(true);
    
     
    // load the subcategories
    this._loadSubCategories(categoryId).then((subCategories) => {

      // hide the progress bar
      this.hideProgressBar();

      // update the subcategory chips
      this.updateSubCategoryChips(subCategories);

      // DEBUG [4dbsmaster]: tell me about it ;)
      console.log(`\x1b[_loadSubCategories]: subCategories => \x1b[0m`, subCategories);

    });

  }



  /**
   * Shows the busy container element
   *
   * @param { Boolean } ?spinnerCentered - whether to center the spinner or not
   * @returns { Void }
   */
  showBusyContainer(spinnerCentered = false) {
    // center the spinner if specified
    this.busyContainerEl.classList.toggle('centered', spinnerCentered);
    
    // show the busy container
    this.busyContainerEl.hidden = false;
    
    // hide the chips bar
    this.chipsBarEl.hidden = true;

    // disable the go-back button
    this.disableGoBackButton();
  }


  /**
   * Hides the busy container element
   *
   * @return { Void }
   */
  hideBusyContainer() {
    this.busyContainerEl.hidden = true;

    // show the chips bar
    this.chipsBarEl.hidden = false;


    // enable the go-back button
    this.enableGoBackButton();
  }


  /**
   * Toggles the busy container element
   *
   * @param { Boolean } ?spinnerCentered - whether to center the spinner or not
   * @return { Void }
   */
  toggleBusyContainer(spinnerCentered = false) {
    // if the busy container is hidden...
    if (this.busyContainerEl.hidden) {
      // ...show the busy container
      this.showBusyContainer(spinnerCentered);
    } else {
      // hide the busy container
      this.hideBusyContainer();
    }
  }

  /**
   * Method used to update the subCategory chips
   *
   * @param { Array } ?subCategories - the sub-categories to update the chips with
   *
   * @return { Void }
   */
  updateSubCategoryChips(subCategories = this.subCategories) {

    // get the subCategory chips html template with the specified subCategories as `subCategoryChipsHTML`
    const subCategoryChipsHTML = this._getSubCategoryChipsTemplate(subCategories);

    // set the subCategories html template to `subCategoryChipsHTML`
    this.subCategoryChipsTabsEl.innerHTML = subCategoryChipsHTML;
    
    // For each subCategory chip...
    this.allSubCategoryChips.forEach((subCategoryChipEl) => {
      // ...listen for `click` events
      subCategoryChipEl.addEventListener('click', this._onSubCategoryChipClick.bind(this));
    });

    // scroll all chips to the left
    this.subCategoryChipsScrollTargetEl.scrollTo(0, 0);

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[40;37m[updateSubCategoryChips]: subCategoryChipsHTML => ${subCategoryChipsHTML} \x1b[0m`, subCategories);

  }


  /**
   * Method used to navigate in the shop
   *
   * @param { Number } ?categoryId - the category's id to navigate to (eg.: 2)
   * @param { String } ?categoryName - the category's name to navigate to (eg.: 'guitars')
   * @param { Number } ?subCategoryId - the sub-category's id to navigate to (eg.: ?)
   * @param { String } ?subCategoryName - the sub-category's name to navigate to (eg.: ?)
   */
  navigateTo(categoryId = -1, categoryName = '', subCategoryId = -1, subCategoryName = '') {
    
    // create the navigation url with the specified category & sub-category names
    const navUrl = this._createNavUrl(categoryName, subCategoryName);
  

    // check if there's neither a category nor a sub-category...
    if (categoryId === -1 && subCategoryId === -1) {
      // ...show the preview container
      this.showPreviewContainer();
      // hide the products container
      this.hideProductsContainer();
      // hide the go-back button
      this.hideGoBackButton();
      
      // update the url
      this.updateUrl(navUrl);

      // update category properties
      this.updateCategoryProps({ categoryId, categoryName, subCategoryId, subCategoryName });

      // update the shop title
      this.updateShopTitle(mbApp.i18n.getString('shop'));

      return; // <- interrupt the code here ;)
    }


    // show the products container
    this.showProductsContainer();   
    // hide the preview container
    this.hidePreviewContainer();
    // show the go-back button
    this.showGoBackButton();

    // update the url
    this.updateUrl(navUrl);
    
    // update category properties
    this.updateCategoryProps({ categoryId, categoryName, subCategoryId, subCategoryName });
    
    // update the shop title
    this.updateShopTitle(mbApp.i18n.getString(categoryName));

    // notify the search bar
    this.notifySearchBar(categoryName);


    // If there's no subcategory id and/or name...
    if (subCategoryId === -1 || subCategoryName === '') {
      // ...notify the category that it has been updated
      this.notifyCategoriesUpdate(categoryId, categoryName);

      // notify the wallpaper of any update
      this.notifyWallpaperUpdate();
    }


    
    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[33m[navigateTo] (1): navUrl => ${navUrl} & categoryId => ${categoryId} & categoryName => ${categoryName} \x1b[0m`);
    console.log(`\x1b[33m[navigateTo] (2): subCategoryIdyId => ${subCategoryId} & subCategoryName => ${subCategoryName} \x1b[0m`);
  }


  /**
   * Enables the go-back button
   */
  enableGoBackButton() {
    this.goBackButtonEl.disabled = false;
  }


  /**
   * Disables the go-back button
   */
  disableGoBackButton() {
    this.goBackButtonEl.disabled = true;
  }


  /**
   * Shows the preview container
   * NOTE: This method also shows the category bar element and hides the app-subtitle element
   */
  showPreviewContainer() {
    this.previewContainerEl.hidden = false;
    this.categoryBarEl.hidden = false;
    this.appBarSubtitleEl.hidden = true;
    this.searchBarEl.hidden = true;
    this.chipsBarEl.hidden = true;
  }

  /**
   * Hides the preview container
   * NOTE: This method also hides the category bar element and shows the app-subtitle element
   */
  hidePreviewContainer() {
    this.previewContainerEl.hidden = true;
    this.categoryBarEl.hidden = true;
    this.appBarSubtitleEl.hidden = false; 
    this.searchBarEl.hidden = false;
    // this.subCategoryChipsEl.hidden = true;
  }

  
  /**
   * Toggles the preview container
   */
  togglePreviewContainer() {
    if (this.previewContainerEl.hidden) { 
      this.showPreviewContainer();
    } else { 
      this.hidePreviewContainer();
    }
    
  }


  /**
   * Shows the filter panel
   */
  showFilterPanel() {
    this.filterPanelEl.hidden = false;
  }


  /**
   * Hides the filter panel
   */
  hideFilterPanel() {
    this.filterPanelEl.hidden = true;
  }


  /**
   * Shows the products wrapper
   */
  showProductsWrapper() {
    this.productsWrapperEl.hidden = false;
  }


  /**
   * Hides the products wrapper
   */
  hideProductsWrapper() {
    this.productsWrapperEl.hidden = true;
  }



  /**
   * Closes the filter panel in the specified duration
   *
   * @param { Number } duration - in milliseconds
   *
   * @returns { Promise }
   */
  closeFilterPanel(duration = this._filterDuration) {
    return new Promise((resolve) => {
      // add the `closing` class to the filter panel elememnt
      this.filterPanelEl.classList.add('closing');
      // remove any `opened` property from it too ;)
      this.filterPanelEl.removeAttribute('opened');

      // update the animation duration
      this.filterPanelEl.style.animationDuration = duration + 'ms';
      this.productsWrapperEl.style.animationDuration = duration + 'ms';

      // clear any active `closeFilterPanelTimer`
      clearTimeout(this._closeFilterPanelTimer);

      this._closeFilterPanelTimer = setTimeout(() => {
        // add the `closed` property to `filterPanelEl`
        this.filterPanelEl.setAttribute('closed', '');

        // remove the `closing` class
        this.filterPanelEl.classList.remove('closing');
      
        // notify the filter menu value
        this._notifyFilterMenuValue();

        // resolve the promise
        resolve({isOpened: false, isClosed: true, element: this.filterPanelEl, duration});
      }, duration);
      
    });
  }


  /**
   * Opens the filter panel in the specified duration
   *
   * @param { Number } duration - in milliseconds
   *
   * @returns { Promise }
   */
  openFilterPanel(duration = this._filterDuration) {
    return new Promise((resolve) => {
      // update the filter subtitle with the current 
      this.filterPanelSubtitleEl.textContent = mbApp.i18n.getString(this.categoryName);

      // add the `opening` class to the filter panel elememnt
      this.filterPanelEl.classList.add('opening');
      this.filterPanelEl.classList.remove('slide-from-left'); // <- HACK
      // remove any `closed` property from it too ;)
      this.filterPanelEl.removeAttribute('closed');

      // update the animation duration
      this.filterPanelEl.style.animationDuration = duration + 'ms';
      this.productsWrapperEl.style.animationDuration = duration + 'ms';

      // clear any active `openFilterPanelTimer`
      clearTimeout(this._openFilterPanelTimer);

      this._openFilterPanelTimer = setTimeout(() => {
        // add the `opened` property to `filterPanelEl`
        this.filterPanelEl.setAttribute('opened', '');

        // remove the `opening` class
        this.filterPanelEl.classList.remove('opening');

        // notify the filter menu value
        this._notifyFilterMenuValue();

        // resolve the promise
        resolve({isOpened: true, isClosed: false, element: this.filterPanelEl, duration});
      }, duration);

    });
  }



  /**
   * Toggles the filter panel
   * NOTE: This method opens or closes the `filterPanelEl` with a transition
   *
   * @param { Number } duration
   *
   * @returns { Promise }
   */
  toggleFilterPanel(duration = this._filterDuration) {
    // if the filter panel is open...
    if (this.filterPanelEl.hasAttribute('opened')) {
      // ...close it accordingly ;)
      return this.closeFilterPanel(duration);
    }else { // <- filter panel is close
      // So, open it #LOL
      return this.openFilterPanel(duration);
    }
  }





  /**
   * Shows the products container
   * NOTE: This method also shows the app-subtitle element and hides the category bar element
   */
  showProductsContainer() {
    this.productsContainerEl.hidden = false;
    this.appBarSubtitleEl.hidden = false; 
    this.categoryBarEl.hidden = true;
  }


  /**
   * Hides the products container
   * NOTE: This method also hides the app-subtitle element and shows the category bar element
   */
  hideProductsContainer() {
    this.productsContainerEl.hidden = true;
    this.appBarSubtitleEl.hidden = true; 
    this.categoryBarEl.hidden = false;
  }


  /**
   * Toggles the products container
   */
  toggleProductsContainer() {
    if (this.productsContainerEl.hidden) { 
      this.showProductsContainer();
    } else { 
      this.hideProductsContainer();
    }
  }


  /**
   * Shows the go-back button element
   * NOTE: This method removes the [invisible] attribute from the `goBackButtonEl`
   */
  showGoBackButton() {
    this.goBackButtonEl.removeAttribute('invisible');
  }


  /**
   * Hides the go-back button element
   * NOTE: This method adds or sets an [invisible] attribute to the `goBackButtonEl`
   */
  hideGoBackButton() {
    this.goBackButtonEl.setAttribute('invisible', '');
  }


  /**
   * Opens the sort dialog
   */
  openSortDialog() {
    
    // create a sort list with the supported sort options as `sortList`
    const sortList = this.sortOptions.map((sortOption, index) => {
      return {
        id: index + 1, 
        name: sortOption,
        value: mbApp.i18n.getString(sortOption)
      }
    });

    
    // open a dialog with a list of all the available sort options 
    mbApp.openDialog({
      title: mbApp.i18n.getString('sortBy'),
      message: '',
      list: sortList,
      selectedId: '',
      selectedName: this.currentSortName,
      
      onListItemClick: this._onSortDialogListItemClickHandler.bind(this),
      noButtons: true,
      noDivider: true,
      isCancelable: true

    }, this._dialogDuration, MAIN_PART);

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[30m[openSortDialog]: sortList => \x1b[0m`, this.sortList);
  }

  /**
   * Opens the sort dialog
   *
   * @param { ?Number } duration
   * @param { ?String } part
   *
   * @returns { Promise }
   */
  closeSortDialog(duration = this._dialogDuration, part = MAIN_PART) {
    // close the dialog
   return mbApp.closeDialog('dialog', duration, part);
  }


 /**
  * Clears the sort by setting the current sort name to 'default'
  */
  clearSort() {
    this.currentSortName = 'default';
  }

  /**
   * Method used to collapse the given `filterElement`
   *
   * @param { Element } filterElement
   */
  collapseFilterElement(filterElement) {
    return new Promise((resolve) => {
      // set the `collapsed` property of `filterElement`
      filterElement.setAttribute('collapsed', '');
      
      // reset the maxHeight 'style' of `filterElement`
      filterElement.style.maxHeight = '';

      // resolve this promise after 200 milliseconds
      setTimeout(() => resolve(filterElement), 200);
    });
  }

  /**
   * Method used to expand the given `filterElement`
   *
   * @param [ Element } filterElement
   *
   * @returns { Promise }
   */
  expandFilterElement(filterElement) {
    return new Promise((resolve) => {
      // get the filter content element as `filterContentEl`
      const filterContentEl = this._getFilterContentOf(filterElement);
      // get the heights
      const filterHeight = filterElement.offsetHeight;
      const contentHeight = filterContentEl.offsetHeight;
      
      // remove the `collapsed` attribute from `filterElement`
      filterElement.removeAttribute('collapsed');

      // update the style height of the `filterElement`
      filterElement.style.maxHeight = `${filterHeight + contentHeight}px`;

      // resolve this promise after 200 milliseconds
      setTimeout(() => resolve(filterElement, filterHeight, contentHeight), 200);
    });
  }


  /**
   * Toggles the given `filterElement`
   *
   * @param { Element } filterElement
   *
   * @returns { Promise }
   */
  toggleFilterElement(filterElement) {
    // collapse or uncollapse the `filterElement`
    if (filterElement.hasAttribute('collapsed')) {
      return this.expandFilterElement(filterElement);
    } else {
      return this.collapseFilterElement(filterElement);
    }
  }


  /**
   * Shows the price spinner
   */
  showPriceSpinner() {
    this.priceSpinnerEl.hidden = false;
  }

  /**
   * Hides the price spinner
   */
  hidePriceSpinner() {
    this.priceSpinnerEl.hidden = true;
  }


  /**
   * Shows the color spinner
   */
  showColorSpinner() {
    this.colorSpinnerEl.hidden = false;
  }

  /**
   * Hides the color spinner
   */
  hideColorSpinner() {
    this.colorSpinnerEl.hidden = true;
  }

  /**
   * Shows the prices
   * NOTE: This method creates a prices html template inside the priceFilterItemEl's content
   */
   showPrices(prices) {
     // get the content element of `priceFilterItemEl` as `priceFilterContentEl`
     const priceFilterContentEl = this._getFilterContentOf(this.priceFilterItemEl);

     // If there's no `prices`
     if (typeof prices === 'undefined') {
       // show the `priceFilterContentEl`
       priceFilterContentEl.hidden = false;
       return; 
     }

     // get the prices html template as `pricesHTML`
     const pricesHTML = this._getPricesTemplate(prices);

     // insert this `pricesHTML` inside the `priceFilterContentEl`
     priceFilterContentEl.insertAdjacentHTML('beforeend', pricesHTML);
   }


  /**
   * Shows the colors 
   * NOTE: This method creates a colors html template inside the colorFilterItemEl's content
   */
   showColors(colors) {
     // get the content element of `colorFilterItemEl` as `colorFilterContentEl`
     const colorFilterContentEl = this._getFilterContentOf(this.colorFilterItemEl);

     // If there's no `colors`
     if (typeof colors === 'undefined') {
       // show the `colorFilterContentEl`
       colorFilterContentEl.hidden = false;
       return; 
     }

     // get the colors html template as `colorsHTML`
     const colorsHTML = this._getColorsTemplate(colors);

     // insert this `colorsHTML` inside the `colorFilterContentEl`
     colorFilterContentEl.insertAdjacentHTML('beforeend', colorsHTML);
   }

  // PRIVATE SETTERS

  // PRIVATE GETTERS

  /**
   * Returns the computed search query using the `search`, `category`, `subCategory`, etc..
   *
   * @param { String } search - (eg.: "pian")
   * @param { String } category - (eg.: 'violins')
   * @param { String } subCategory - (eg.: 'violin-accessory')
   * @param { String } sortBy - eg.: ('cheapest')
   * @param { Object } filterParams - (eg.: { priceRange: [min: Number, max: Number], colors: Array })
   * @param { Number } page - (eg.: 1)
   *
   * @returns { String } - Returns eg.: '?search=pian&page=1&category=violins&sub_category=violin-accessory&sort_by=cheapest&filter_price_range=0,50&filter_colors=red,green'
   */
  _getComputedSearchQuery(search, category, subCategory, sortBy, filterParams, page = 1) {
    // Initialize the `result` variable 
    // by setting it by just the search and page values
    let result = `search=${search}&page=${page}`;
    
    // If there's a category...
    if (category?.length) {
      // ...append the `category` key to the result
      result += `&category=${category}`;
    }

    // If there's a sub category...
    if (subCategory?.length) {
      // ...append the `sub_category` key to the result
      result += `&sub_category=${category}`;
    }


    // If there's a `sortBy` value...
    if (sortBy?.length) {
      // ...append the `sort_by` key to the result
      result += `&sort_by=${sortBy}`;
    }
    
    // If there are filter params...
    if (Object.keys(filterParams).length) {
      // TODO: Loop throught the filterParams instead #cleanCode ;)

      // ...append the `filter_price_range` key to the result (if it exists)
      result += (filterParams.priceRange) ? `&filter_price_range=${filterParams.priceRange}` : '';

      // append the `filter_colors` key to the result (if it exists)
      result += (filterParams.colors) ? `&filter_colors=${filterParams.colors}` : '';
    }

      /*
    // if there's a search...
    if (search?.length) {
      // ...append it to `result`
      result += `&${search}`;
    }*/

    // return the `result`
    return result;

  }


  /**
   * Returns the content of the given `filterElement`
   *
   * @param { Element } filterElement
   *
   * @returns { Element }
   * @private
   */
  _getFilterContentOf(filterElement) {
    return filterElement.querySelector('.content');
  }
  

   /**
    * Returns the prices html template
    *
    * @param { Array[Object] } prices
    * @param { Number } minPrice
    * @param { Number } maxPrice
    *
    * @returns { String } 
    * @private
    */
  _getPricesTemplate(prices = this.prices, minPrice = this.minPrice, maxPrice = this.maxPrice) {
    return html`
      <ul id="prices" class="vertical flex-layout dialog-list" naked noscrollbars>

        ${prices.map((price, index) => html`
          <li shrinks 
            title="${mbApp.i18n.getString(price.label)}"
            tabindex="${index + 1}" 
            class="price-range price-filter filter-list-item dialog-list-item horizontal flex-layout center" 
            data-min="${price.min}" 
            data-max="${price.max}"
            ${(price.min === minPrice && price.max === maxPrice) ? 'selected' : ''}>
              <span class="radio"></span>
              <span class="value" flex>${this._getComputedPriceRange(price.min, price.max)}</span>
              <span class="emoji">${price.emoji}</span>
            </li>
        `)}
            
      </ul>
    `;
  }

   /**
    * Returns the price emoji using the `min` and `max` values
    *
    * @param { Number } min
    * @param { Number } max
    *
    * @returns { String|Emoji }
    */
  _getPriceRangeEmoji(min, max) {
     // find the emoji in `prices`
     let emoji = this.prices.find((price) => price.min === min && price.max === max)?.emoji;

     // return the emoji
     return emoji ?? '';
  }  

  /**
   * Returns the computed price range of the given `min` and `max` price values
   *
   * @param { Number } min - (eg.: 100.00)
   * @param { Number ] max - (eg.: 2500.25)
   * @param { String } currentSymbol
   *
   * @return { String } - (eg.: "100,00 EUR - 2 500,25 EUR")
   */
  _getComputedPriceRange(min, max, currencySymbol = CURRENCY_SYMBOL_DEFAULT) {
    // get the minumum and maximum price values as `minPriceVal` and `maxPriceVal` respectively
    let minPriceVal = min.toLocaleString(mbApp.lang) + currencySymbol;
    let maxPriceVal = max.toLocaleString(mbApp.lang) + currencySymbol;

    // intitialize the `result` variable
    let result = minPriceVal + ' +'; // <- returns eg: `5,000.00 +`
    
    // if the max is not -1...
    if (max !== -1) {
      // ...update it accordingly ;)
      result = minPriceVal + ' - ' + maxPriceVal; // <- returns eg.: `0€ - 100€`
    }

    // return the `result`
    return result;
  }
   

   /**
    * Returns the colors html template
    *
    * @param { Array[Object] } colors
    * @param { Array } selectedColors
    *
    * @returns { String } 
    * @private
    */
  _getColorsTemplate(colors = this.colors, selectedColors = this.selectedColors) {
    return html`
      <ul id="colors" class="vertical flex-layout dialog-list" naked noscrollbars>

        ${colors.map((color, index) => html`
          <li shrinks 
            tabindex="${index + 1}"

            data-id="${color.id}" 
            data-name="${color.name}"
            data-hex="${color.hex}"

            class="color-filter filter-list-item dialog-list-item horizontal flex-layout center" 
            ${(selectedColors.indexOf(color.name) !== -1) ? 'selected' : ''}>
              <span class="checkbox"></span>
              <span class="value txt capitalize" flex>${color.original_name}</span>
              <span class="color" style="background: #${color.hex};"></span>
            </li>
        `)}
            
      </ul>
    `;
  }


  /**
   * Returns the sub-category chips html template using the given `subCategories`
   *
   * @param { Array } subCategories
   *
   * @returns { HTMLTemplate }
   * @private
   */
  _getSubCategoryChipsTemplate(subCategories) {
    return html`
      <li 
        data-subcategory-id="-1" 
        data-subcategory-name="all" 
        class="chip" 
        role="tab" 
        tabindex="0" 
        aria-selected="true" 
        selected>
        <span>${mbApp.i18n.getString('all')}</span>
      </li>

      ${subCategories.map((subCategory) => html`
         <li 
           data-subcategory-id="${subCategory.id}" 
           data-subcategory-name="${subCategory.name}" 
           class="chip" 
           role="tab" 
           tabindex="0" 
           aria-selected="false">

           <span>${mbApp.i18n.getString(subCategory.name)}</span>

         </li>
      `)}
    `;
  }


  // PRIVATE METHODS

  /**
   * Method used to create a navigation url with the given `categoryName` and `subCategoryName`
   *
   * @param { String } ?categoryName - eg ('pianos')
   * @param { String } ?subCategoryName - eg ('grand-piano')
   *
   * @returns { String } navUrl - eg. ('pianos/grand-piano')
   * @private
   */
  _createNavUrl(categoryName = '', subCategoryName = '') {
    // create the navigation url as `navUrl`
    let navUrl = (categoryName.length && subCategoryName) ? `${categoryName}/${subCategoryName}` : (categoryName.length ? `${categoryName}` : '');

    // return `navUrl`
    return navUrl;
  }



  /**
   * method used to install event listeners on the shop page
   */
  _installEventListeners() {


    // Get the current press event as `press`
    const press = mbApp.isTouchDevice ? 'touchstart' : 'mousedown';
    // Get the current release event as `release`
    const release = mbApp.isTouchDevice ? 'touchend' : 'mouseup';

    // Listen for `press` events on the `leftChipIconBtn`
    this.leftChipIconBtn.addEventListener(press, this._onLeftChipIconBtnPress.bind(this));
    // Listen for `release` events on the `leftChipIconBtn`
    this.leftChipIconBtn.addEventListener(release, this._onLeftChipIconBtnRelease.bind(this));
    // Listen for `click` events on the `leftChipIconBtn`
    this.leftChipIconBtn.addEventListener('click', this._onLeftChipIconBtnClick.bind(this));


    // Listen for `press` events on the `rightChipIconBtn`
    this.rightChipIconBtn.addEventListener(press, this._onRightChipIconBtnPress.bind(this));
    // Listen for `release` events on the `rightChipIconBtn`
    this.rightChipIconBtn.addEventListener(release, this._onRightChipIconBtnRelease.bind(this));
    // Listen for `click` events on the `rightChipIconBtn`
    this.rightChipIconBtn.addEventListener('click', this._onRightChipIconBtnClick.bind(this));


    // Listen for `scroll` events on the `subCategoryChipsScrollTargetEl`
    this.subCategoryChipsScrollTargetEl.addEventListener('scroll', this._onSubCategoryChipsScroll.bind(this));


    // For each subCategory chip...
    this.allSubCategoryChips.forEach((subCategoryChipEl) => {
      // ...listen for `click` events
      subCategoryChipEl.addEventListener('click', this._onSubCategoryChipClick.bind(this));
    });

    // listen to the `popstate` event
    window.addEventListener('popstate', this._onPopState.bind(this));

    // if there's a `categoryButtons` element, install a click event listener on it
    this.categoryButtons?.forEach(categoryBtn => categoryBtn.addEventListener('click', this._handleCategoryBtnClick?.bind(this)));

    // If there's a `seeAllButtonEl` element...
    // ...install a click event listener on it 
    this.seeAllButtonEl?.addEventListener('click', this._handleSeeAllBtnClick?.bind(this));

    // If there's a `searchDropdownButtonEl` element...
    // ...install a click event listener on it 
    this.searchDropdownButtonEl?.addEventListener('click', this._handleSearchDropdownBtnClick?.bind(this));

    // If there's a `goBackButtonEl` element...
    // ...install a click event listener on it
    this.goBackButtonEl?.addEventListener('click', this._handleGoBackBtnClick?.bind(this));

    // if there's a `menuButtonEl` element...
    // ...install a click event listener on it
    this.menuButtonEl?.addEventListener('click', this._handleMenuBtnClick?.bind(this));

    // Install a click event listener on the `sortButtonEl`
    this.sortButtonEl?.addEventListener('click', this._handleSortButtonClick?.bind(this));

    // Install a click event listener on the `closeFilterButtonEl`
    this.closeFilterButtonEl?.addEventListener('click', this._handleCloseFilterButtonClick?.bind(this));

    // Install a click event listener on the `filterMenuItemEl`
    this.filterMenuItemEl?.addEventListener('click', this._handleFilterMenuItemButton?.bind(this));
    
    // Install a click event listener on the `sortMenuItemEl`
    this.sortMenuItemEl?.addEventListener('click', this._handleSortMenuItemButton?.bind(this));



    // Install a click event listener on all `filterItemEls` elements
    this.filterItemEls?.forEach(filterItemEl => filterItemEl.addEventListener('click', this._handleFilterItemClick?.bind(this)));


    // Install a click event on the `filterToggleButtonEl` element
    this.filterToggleButtonEl?.addEventListener('click', this._handleFilterToggleBtnClick?.bind(this));


    // Install a click event listener on the `searchInputEl` element
    this.searchInputEl?.addEventListener('input', this._handleSearchInput?.bind(this));

    // Listen to `click` events of the search icon-button element
    this.searchIconButtonEl?.addEventListener('click', this._handleSearchIconButtonClick?.bind(this));
  }

  /**
   * Handler that is called whenever the search icon-button element is clicked
   *
   * @param { Event } - the event that triggered this handler
   */
  _handleSearchIconButtonClick(event) {
    // get the search value from the search input element as `searchValue`
    let searchValue = this.searchInputEl.value;

    // TODO: escape any special character or validate `searchValue` here before proceeding
    
    // update the `_search` property with `searchValue`
    
    this._search = searchValue;

    // notify the search of this recent update
    this.notifySearchUpdate();

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[33m[_handleSearchIconButtonClick]: searchValue => ${searchValue} event => \x1b[0m`, event);
  }


  /**
   * Handler that is called whenever the input event is fired or 
   * content of search input element changes
   *
   * @param { SearchEvent } event - the input event that triggered this handler
   * @private
   */
  async _handleSearchInput(event) {
    // get the search value from event's current target as `value`
    const value = event.currentTarget.value;
    
    // update the private `_search` property with `value`
    this._search = value;

    // TODO: Fetch the search history

    // notify the search of this update
    // this.notifySearchUpdate();
    
    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[30m[_handleSearchInput]: value => ${value} event => \x1b[0m`, event);
  }

    /**
     * Notifies the shop of the recent search update
     * NOTE: This method is called whenever the `_search`, `categoryName`, 
     * `subCategoryName`, `sortBy` and `filterParams` change or get updated
     *
     * @param { String } search 
     * @param { String } category
     * @param { String } subCategory
     * @param { String } sortBy
     * @param { Object } filterParams
     */
  notifySearchUpdate(search = this._search, category = this.categoryName, subCategory = this.subCategoryName, sortBy = this.sortBy, filterParams = this.filterParams) {
    
    // compute the discover search search as `discoverSearchQuery`
    let discoverSearchQuery = this._getComputedSearchQuery(search, category, subCategory, sortBy, filterParams);

    // fetch / discover related products
    mbApp.fetchProducts(discoverSearchQuery).then((allProducts, productsResponse) => {
      
      // DEBUG [4dbsmaster]: tell me about all the products
      console.log(`\x1b[30m[notifySearchUpdate] (fetchProducts|1): allProducts => \x1b[0m`, allProducts);
      console.log(`\x1b[30m[notifySearchUpdate] (fetchProducts|2): productsResponse => \x1b[0m`, productsResponse);
        
    }).catch((error) => console.log(error));


    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[30m[notifySearchUpdate]: discoveryQuery =>  value => ${value} event => \x1b[0m`, event);

  }



  /**
   * Handler that is called whenever the close filter button is clicked
   *
   * @param { PointerEvent } event - the click event that triggered this handler
   * @private
   */
  _handleCloseFilterButtonClick(event) {
    // close the filter panel
    this.closeFilterPanel(this._filterDuration).then(() => this.filterToggleButtonEl.removeAttribute('active'));
  }


  /**
   * Handler that is called whenever a filter toggle button is clicked
   *
   * @param { PointerEvent } event - the click event that triggered this handler
   * @private
   */
  _handleFilterToggleBtnClick(event) {
    
    if (this.filterToggleButtonEl.hasAttribute('active')) {
      // close the filter panel
      this.closeFilterPanel(this._filterDuration).then(() => this.filterToggleButtonEl.removeAttribute('active'));

    } else { 
      // open the filter panel
      this.openFilterPanel(this._filterDuration).then(() => this.filterToggleButtonEl.setAttribute('active', ''));
    }

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[40;33m[_handleFilterToggleBtnClick]: event => \x1b[0m`, event);
  }



  /**
   * Handler that is called whenever a filter item is clicked
   *
   * @param { PointerEvent } event - the click event that triggered this handler
   * @private
   */
  _handleFilterItemClick(event) {
    // get the current target as `filterElement`
    const filterElement = event.currentTarget;
    
    // check if the part clicked is a button, using our beloved ternary statement 
    const isButton = (event.target.tagName.toLowerCase() === 'button') ? true : false;
    const isPriceFilter = (event.target.classList.contains('price-filter')) ? true : false;
    const isColorFilter = (event.target.classList.contains('color-filter')) ? true : false;

    // If the button was clicked...
    if (isButton) {
      // ...handle it accordingly
      this._filterButtonClickHandler(event, filterElement);
    }

    // if it is a price filter ...
    if (isPriceFilter) {
      // ...handle it accordingly
      this._priceFilterClickHandler(event, event.target);
    }

    // if it is a color filter ...
    if (isColorFilter) {
      // ...handle it accordingly
      this._colorFilterClickHandler(event, event.target);
    }

    
    
    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[40;33m[_handleFilterItemClick]: (1) 
      isButton ? ${isButton} + 
      isPriceFilter ? ${isPriceFilter} +
      isColorFilter ? ${isColorFilter} => \x1b[0m`);
    console.log(`\x1b[40;33m[_handleFilterItemClick]: (2) filterElement => \x1b[0m`, filterElement);

  }


  /**
   * Handler that is called whenever a filter button is clicked from inside a filter item.
   * 
   * @param { Event } event
   * @param { Element } filterEl
   */
  _filterButtonClickHandler(event, filterEl) {
    // ...toggle the filter element
    this.toggleFilterElement(filterEl).then((el) => {
      // do nothing if the `filterElement` has just been collapsed ;)
      if (el.hasAttribute('collapsed')) { return }


      // if this is a price filter item...
      if (el.id === 'priceFilterItem' && !this.prices.length) { 
        // ...show the price spinner
        this.showPriceSpinner();

        // loading the prices
        this._loadPrices().then((prices) => {
          // hide the price spinner
          this.hidePriceSpinner();

          // show the prices
          this.showPrices(prices);

        });
      }

      // if this is a color filter item 
      if (el.id === 'colorFilterItem' && !this.colors.length) {
        // ...show the color spinner
        this.showColorSpinner();

        // loading the colors
        this._loadColors().then((colors) => {
          // hide the color spinner
          this.hideColorSpinner();

          // show the colors
          this.showColors(colors);

        });
      }
      
    });
  }
  

  /**
   * Handler that is called whenever the price filter is clicked from inside a filter item.
   * 
   * @param { Event } event
   * @param { Element } priceFilterEl
   */
  _priceFilterClickHandler(event, priceFilterEl) {
    // get the min and max price range from `priceFilterEl`
    let minPrice = parseInt(priceFilterEl.dataset.min);
    let maxPrice = parseInt(priceFilterEl.dataset.max);

    // do nothing if the price range has not changed or are the same ;)
    if (this.minPrice === minPrice && this.maxPrice === maxPrice) { return }

    // update the `minPrice` & `maxPrice` properties
    this.minPrice = minPrice;
    this.maxPrice = maxPrice;
      
    // notify the price filter of this update
    this.notifyPriceFilterUpdate(minPrice, maxPrice);

    // call the `onPriceChange()` method
    this.onPriceChange(minPrice, maxPrice);

    // create a toast message as `toastMessage`
    let toastMessage = mbApp.i18n.getString('priceRangeChangedToX')
      .replace('%s', this._getComputedPriceRange(minPrice, maxPrice)) + 
      ' ' + this._getPriceRangeEmoji(minPrice, maxPrice);

    // show the `toastMessage` in 3 seconds (i.e. as a success toast in the main part of the page)
    mbApp.showToast({message: toastMessage, type: SUCCESS_TOAST, part: MAIN_PART}, 3, true);

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[40;35m[_priceFilterClickHandler]: minPrice => ${minPrice} & maxPrice => ${maxPrice} priceFilterEl => \x1b[0m`, priceFilterEl);
    
  }
  

  /**
   * Handler that is called whenever the color filter is clicked from inside a filter item.
   * 
   * @param { Event } event
   * @param { Element } colorFilterEl
   */
  _colorFilterClickHandler(event, colorFilterEl) {
    // get the color properties from `colorFilterEl`
    let colorId = parseInt(colorFilterEl.dataset.id);
    let colorName = colorFilterEl.dataset.name;
    let colorHex = colorFilterEl.dataset.hex;

    // do nothing if the color names are the same ;)
    // if (this.colorName === colorName) { return }

    // update the color properties
    this.colorId = colorId;
    this.colorName = colorName;
    this.colorHex = colorHex;

    
    // if this color doesn't exist in the selected colors list
    if (this.selectedColors.indexOf(colorName) === -1) {
      // add it to the list ;)
      this.selectedColors.push(colorName);

      // create a toast message as `toastMessage`
      let toastMessage = mbApp.i18n.getString('filteringInstrumentsByXColor')
        .replace('%s', mbApp.i18n.getString(colorName).toLowerCase());
      
      // show the `toastMessage` in 3 seconds (i.e. as a success toast in the main part of the page)
      mbApp.showToast({message: toastMessage, type: SUCCESS_TOAST, part: MAIN_PART}, 3, true);
      
      


    } else {
      // remove it from the list
      this.selectedColors.splice(this.selectedColors.indexOf(colorName), 1);
    }


    // call the `onColorChange()` method
    this.onColorChange(colorId, colorName, colorHex);

    // call the `onSelectedColorsChange()` method
    this.onSelectedColorsChange();
     
    // notify the selected colors filter of this update
    this.notifySelectedColorsFilterUpdate(this.selectedColors);


    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[40;35m[_colorFilterClickHandler]: colorId => ${colorId} & colorName => ${colorName} colorHex => ${colorHex}\x1b[0m`);
    
  }
  





  /**
   * Handler that is called whenever the `filterMenuItemEl` is clicked
   *
   * @param { PointerEvent } event - the click event that triggered this handler
   * @private
   */
  _handleFilterMenuItemButton(event) {
    // hide/close the shop menu,
    // then open the toggle the filter panel
    mbApp.hideMenuById('shopMenu', this._menuDuration, MAIN_PART).then(() => {

      if (this.filterToggleButtonEl.hasAttribute('active')) {
        this.closeFilterPanel(this._filterDuration)
          .then(() => {
            this.filterToggleButtonEl.removeAttribute('active');
          });

      } else { 
        this.openFilterPanel(this._filterDuration)
          .then(() => {
            this.filterToggleButtonEl.setAttribute('active', '');
          });
      }

    });
    
   }


  /**
   * Notifies the value of the filter menu
   * NOTE: This method updates menuitem element's text-content to "Show filter" or "Hide filter"
   * based of the current state of the filter panel
   */
  _notifyFilterMenuValue() {
    // get the value element of as `valueEl`
    const valueEl = this.filterMenuItemEl.querySelector('.value');
    
    // update the text value accordingly
    valueEl.textContent = this.filterPanelEl.hasAttribute('opened') ? mbApp.i18n.getString('hideFilter') : mbApp.i18n.getString('showFilter');



  }



  /**
   * Handler that is called whenever the `sortMenuItemEl` is clicked
   *
   * @param { PointerEvent } event - the click event that triggered this handler
   * @private
   */
  _handleSortMenuItemButton(event) {
    // hide/close the shop menu,
    // then open the sort dialog
    mbApp.hideMenuById('shopMenu', this._menuDuration, MAIN_PART).then(() => this.openSortDialog());
    
   }

  /**
   * Handler that is called whenever the `sortButtonEl` is clicked
   *
   * @param { PointerEvent } event - the click event that triggered this handler
   * @private
   */
  _handleSortButtonClick(event) {
    // open the sort dialog
    this.openSortDialog();
  }

    
 /**
  * Handler that is called when the a list item in the sort dialog is clicked
  *
  * @param { Event } event
  * @param { Element } listItemEl
  */
 _onSortDialogListItemClickHandler(event, listItemEl) {
   // get the current sort id,name and value
   const selectedSortId = listItemEl.dataset.id;
   const selectedSortName = listItemEl.dataset.name;
   const selectedSortValue = listItemEl.textContent.trim();
   
   // Update the current sort name with `selectedSortName`
   this.currentSortName = selectedSortName;
   
   this.closeSortDialog().then(() => {
     // create a toast message
     let toastMessage = mbApp.i18n.getString('sortingChangedToX').replace('%s', selectedSortValue);

     // show a toast about it
     mbApp.showToast({message: toastMessage, part: MAIN_PART}, 3, true);
   });


   //  DEBUG [4dbsmaster]: tell me about it ;)
   console.log(`\x1b[30m[_onSortDialogListItemClickHandler]: (1) 
    selectedSortId => ${selectedSortId}
    selectedSortName => ${selectedSortName}
    selectedSortValue => ${selectedSortValue}
   \x1b[0m`, listItemEl);

   console.log(`\x1b[30m[_onSortDialogListItemClickHandler]: (2) listItemEl => \x1b[0m`, listItemEl);
 }


  /**
   * Handler that is called whenever the `subCategoryChipsScrollTargetEl` is scrolled
   *
   * @param { ScrollEvent } event - the event that triggered this handler
   * @private
   */
  _onSubCategoryChipsScroll(event) {
    // get the left scroll value of the target as `scrollLeft`
    const scrollLeft = event.target.scrollLeft;
    // Get the maximum scroll left value
    let maxScrollLeft = event.target.scrollWidth - event.target.clientWidth;

    // If the `scrollLeft` of the subCategory scroll target is `0`...
    if (scrollLeft === 0) {
      // ... set the `scrollpos` attribute of the `subCategoryChipsEl` to `start`
      this.subCategoryChipsEl.setAttribute('scrollpos', 'start');

    } else if (scrollLeft >= maxScrollLeft) {
      // ... set the `scrollpos` attribute of the `subCategoryChipsEl` to `end`
      this.subCategoryChipsEl.setAttribute('scrollpos', 'end');
    } else {
      // ... set the `scrollpos` attribute of the `subCategoryChipsEl` to `middle`
      this.subCategoryChipsEl.setAttribute('scrollpos', 'middle');
    }
    
    // DEBUG [4dbsmaster]: tell me about it ;)
    // console.info(`\x1b[37m[_onSubCategoryChipsScroll]: scrollLeft => ${scrollLeft} & maxScrollLeft => ${maxScrollLeft} & event => \x1b[0m`, event);
  }



  /**
   * Handler that is called whenever a subCategory chip is clicked
   *
   * @param { PointerEvent } event - the event that triggered this handler
   */
  _onSubCategoryChipClick(event) {
    // get the subCategory name of the clicked subCategory chip as `subCategoryName`
    const subCategoryName = event.currentTarget.dataset.subcategoryName;
    // get the subCategory id of the clicked subCategory chip as `subCategoryId`
    const subCategoryId = event.currentTarget.dataset.subcategoryId;

    
    // set the `subCategory` property to the clicked subCategory name
    this.subCategory = subCategoryName;
    // set the `subCategoryId` property to the clicked subCategory id
    this.subCategoryId = subCategoryId;

    // select the subcategory chip by id
    this.selectSubCategoryById(subCategoryId);

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.info(`\x1b[36m[_onSubCategoryChipClick]: subCategoryName => ${subCategoryName} & subCategoryId => ${subCategoryId} & event => \x1b[0m`, event);
  }



  /**
   * Handler that is called whenever the `leftChipIconBtn` is pressed
   *
   * @param { MouseEvent|TouchEvent } event - the event that triggered this handler
   * @private
   */
  _onLeftChipIconBtnPress(event) {
    // TODO: do something awesome here ;)

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.info(`\x1b[36m[_onLeftChipIconBtnPress]: event => \x1b[0m`, event);
  }


  /**
   * Handler that is called whenever the `leftChipIconBtn` is released 
   *
   * @param { MouseEvent|TouchEvent } event - the event that triggered this handler
   * @private
   */
  _onLeftChipIconBtnRelease(event) {
    // TODO: do something awesome here ;)

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.info(`\x1b[37m[_onLeftChipIconBtnRelease]: event => \x1b[0m`, event);
  }



  /**
   * Handler that is called whenever the `rightChipIconBtn` is pressed
   *
   * @param { MouseEvent|TouchEvent } event - the event that triggered this handler
   * @private
   */
  _onRightChipIconBtnPress(event) {
    // TODO: do something awesome here ;)

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.info(`\x1b[36m[_onRightChipIconBtnPress]: event => \x1b[0m`, event);
  }


  /**
   * Handler that is called whenever the `rightChipIconBtn` is released 
   *
   * @param { MouseEvent|TouchEvent } event - the event that triggered this handler
   * @private
   */
  _onRightChipIconBtnRelease(event) {
    // TODO: do something awesome here ;)

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.info(`\x1b[37m[_onRightChipIconBtnRelease]: event => \x1b[0m`, event);
  }



  /**
   * Handler that is called whenever the `leftChipIconBtn` is clicked 
   *
   * @param { PointerEvent } event - the event that triggered this handler
   * @private
   */
  _onLeftChipIconBtnClick(event) {
    // get 50 percent of the current target's width as `scrollDistance`
    let scrollDistance = this.subCategoryChipsScrollTargetEl.clientWidth * 0.5;

    // scroll the subCategory chips to the left by `scrollDistance`
    this.subCategoryChipsScrollTargetEl.scrollLeft -= scrollDistance;

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.info(`\x1b[40;36m[_onLeftChipIconBtnClick]: event => \x1b[0m`, event);
  }


  /**
   * Handler that is called whenever the `rightChipIconBtn` is clicked 
   *
   * @param { PointerEvent } event - the event that triggered this handler
   * @private
   */
  _onRightChipIconBtnClick(event) {
    // get the 50 percent of the current target's width as `scrollDistance`
    let scrollDistance = this.subCategoryChipsScrollTargetEl.clientWidth * 0.5;

    // scroll the subCategory chips to the right by `scrollDistance`
    this.subCategoryChipsScrollTargetEl.scrollLeft += scrollDistance;

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.info(`\x1b[40;37m[_onRightChipIconBtnClick]: event => \x1b[0m`, event);
  }



  /**
   * Handler that is called whenever the menu button is clicked
   *
   * @param { PointerEvent } event - The click event
   * @private
   */
  _handleMenuBtnClick(event) {
    // show the shop menu
    mbApp.showMenuById('shopMenu', this._menuDuration, MAIN_PART);
  }


  /**
   * Handler that is called whenever the go-back button element is clicked
   *
   * @param { PointerEvent } event - The click event
   * @private
   */
  _handleGoBackBtnClick(event) {
    // navigate to the preview shop page
    this.navigateTo();
    
    // hide the wallpaper
    this.hideWallpaper();

    // hide the filter panel
    this.hideFilterPanel();

    // hide the products wrapper
    this.hideProductsWrapper();


    this.filterPanelEl.classList.add('slide-from-left'); // <- HACK
  }



  /**
   * Handler that is called whenever the `searchDropdownButtonEl` is clicked
   *
   * @param { PointerEvent } event - The click event
   * @private
   */
  _handleSearchDropdownBtnClick(event) {
    
    // If there `allCategories` list is empty...
    if (!this.allCategories.length) {
      // ...load all the categories

      // Start loading this button
      this.searchDropdownButtonEl.startLoading();
      
      this._loadAllCategories().then((allCategories) => {
        // ...stop loading this buttons
        this.searchDropdownButtonEl.stopLoading();
        
        // Now, show the `allCategories` dialog
        this._showAllCategoriesDialog(allCategories);
        
        // DEBUG [4dbsmaster]: tell me about these categories
        console.log(`\x1b[33m[_handleSearchDropdownBtnClick] (_loadAllCategories): allCategories => \x1b[0m`, allCategories);

      });

    } else { // <- `allCategories` is not empty

      // ...show the `allCategories` dialog
      this._showAllCategoriesDialog();
    }
  
  }


  /**
   * Handler that is called whenever the `seeAllButtonEl` is clicked
   *
   * @param { PointerEvent } event - The click event
   * @private
   */
  _handleSeeAllBtnClick(event) {
    // If there `allCategories` list is empty...
    if (!this.allCategories.length) {
      // ...load all the categories
  
      // But first, start loading this button
      this.seeAllButtonEl.startLoading();

      this._loadAllCategories().then((allCategories) => {
        // ...stop loading this buttons
        this.seeAllButtonEl.stopLoading();

        // Now, show the `allCategories` dialog
        this._showAllCategoriesDialog(allCategories);

        // DEBUG [4dbsmaster]: tell me about these categories
        console.log(`\x1b[33m[_handleSeeAllBtnClick] (_loadAllCategories): allCategories => \x1b[0m`, allCategories);

      });

    } else { // <- `allCategories` is not empty
      
      // ...show the `allCategories` dialog
      this._showAllCategoriesDialog();
    }

  }

  /**
   * Loads all the prices
   *
   * @returns { Promise }
   */
  _loadPrices() {
    return new Promise((resolve) => {
      // TODO: fetch all prices our server

      // get all prices
      const allPrices = this.#_getAllPrices();

      // update the `prices` array property
      this.prices = allPrices;

      // TEST / SIM: wait for 1 second before resolving the promise
      setTimeout(() => resolve(allPrices), 1000);

    });
  }


  /**
   * Loads all the colors.
   * NOTE: This method fetches all the categories from our server / database 
   * and updates the `colors` array property accordingly ;)
   *
   * @returns { Promise }
   */
  _loadColors() {
    return new Promise((resolve, reject) => {
      // fetch all colors our server
      mbApp.fetchColors().then((allColors) => {
        // update the `colors` array property of this ShopPage class
        this.colors = allColors;
        
        // TEST / SIM: wait for 1 second before resolving the promise
        setTimeout(() => resolve(allColors), 1000);
        
      }).catch(error => reject(error));

    });
  }



  /**
   * Loads all the categories.
   * NOTE: This method fetches all the categories from our server / database 
   * and updates the `allCategories` property accordingly ;)
   *
   * @returns { Promise }
   */
  _loadAllCategories() {
    return new Promise((resolve, reject) => {
      // fetch all the categories from our server
      mbApp.fetchCategories().then((allCategories) => {
        // update the `allCategories` property
        this.allCategories = allCategories;

        // TEST / SIM: wait for 1 second before resolving the promise
        setTimeout(() => resolve(allCategories), 1000);

      }).catch(error => reject(error));

    });
  }


  /**
   * Shows the `allCategories` dialog
   *
   * @param { Array } allCategories - The list of all the categories
   */
  _showAllCategoriesDialog(allCategories = this.allCategories) {
    // create a dialog list with `allCategories` which contains only the `id`, `name` and `value`
    const dialogList = allCategories.map((category) => {
      return {
        id: category.id, 
        name: category.name, 
        value: `${mbApp.i18n.getString(category.name)}`
      }
    });
    
    // open a dialog with a list of all the categories
    mbApp.openDialog({
      title: mbApp.i18n.getString('allCategories'),
      message: mbApp.i18n.getString('pickACategoryToStartShopping'),
      list: dialogList,
      selectedId: '',
      selectedName: '',
      confirmBtnText: mbApp.i18n.getString('open'),
      cancelBtnText: mbApp.i18n.getString('cancel'),

      onConfirm: this._onCategoriesDialogConfirm.bind(this),
      onListItemClick: (event, listItemEl) => console.log(event, listItemEl),
      noButtons: false,
      noDivider: true,
      isCancelable: true

    }, this._dialogDuration, MAIN_PART);

    // DEBUG [4dbsmaster]: tell me about the dialogList
    console.log(`\x1b[40;35m[_showAllCategoriesDialog]: dialogList => \x1b[0m`, dialogList);
  }

  /**
   * Handler that is called whenever the confirm button of `allCategoriesDialog` is clicked
   *
   * @param { PointerEvent } event
   */
  _onCategoriesDialogConfirm(event) {
    // get the confirm button element
    const confirmBtnEl = event.currentTarget;

    // get the selected dialog list item element as `selectedEl`
    const selectedEl = mbApp.getSelectedDialogListItem('dialog', MAIN_PART);
    
    // If no element was selected...
    if (!selectedEl) {
      // ..show a toast about it
      mbApp.showToast({message: mbApp.i18n.getString('pleaseSelectACategoryFirst'), type: ERROR_TOAST, part: MAIN_PART}, 5, true);

      return; // <- stop the code process right here ;)
    }

    // get the selected category id & name from its dataset
    let selectedCategoryId = selectedEl.dataset.id;
    let selectedCategoryName = selectedEl.dataset.name;
    
    // get the image by category name
    let selectedCategoryImage = this._getCategoryImageByName(selectedCategoryName);

    // update the wallpaper image with the `selectedCategoryImage`
    this.wallpaperImage = selectedCategoryImage;

    // scroll the main app layout all-the-way to the top ;)
    mbApp.mainAppLayout.scrollTop = 0;
    
    // navigate to the selected category
    this.navigateTo(selectedCategoryId, selectedCategoryName);

    // close the dialog
    mbApp.closeDialog('dialog', this._dialogDuration, MAIN_PART);
     
    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[35m[_onCategoriesDialogConfirm] (1): selectedCategoryId => ${selectedCategoryId} & selectedCategoryName => ${selectedCategoryName}\x1b[0m`);

    console.log(`\x1b[35m[_onCategoriesDialogConfirm] (2): confirmBtnEl => \x1b[0m`, confirmBtnEl);
  }


  /**
   * Returns the image of the given `categoryName`
   *
   * @param { String } categoryName
   *
   * @returns { String } 
   */
  _getCategoryImageByName(categoryName) {
    // Initialize the `result` variable
    let result = '';

    // loop through `allCategories`
    for (let category of this.allCategories) {
      if (category.name === categoryName) {
        result = category.image;
        break;
      }
    }

    // return `result`
    return result;
  }


  /**
   * Hides the `allCategories` dialog
   */
  _hideAllCategoriesDialog() {
    mbApp.closeDialog('dialog', this._dialogDuration, MAIN_PART);
  }



  /**
   * Handler that is called whenever a list item in the `allCategories` dialog is clicked
   *
   * @param { PointerEvent } event - The click event that triggered the handler
   * @private
   */
  _handleAllCategoriesDialogListItemClick(event) {}



  /**
   * method called whenever the user clicks on the back or forward button of the browser
   *
   * @param { event } event
   */
  _onPopState(event) {
    let splitUrl = location.pathname.split('/');
    let categoryName = splitUrl[3];
    let subCategoryName = splitUrl[4];


    // If there's a sub-category name...
    if (subCategoryName) {
      // ...navigate to the sub-category
      this.navigateTo(this.categoryId, categoryName, this.subCategoryId, subCategoryName);
      
    } else if (categoryName) {
      // ...navigate to the category 
      this.navigateTo(this.categoryId, categoryName);

    } else {
      // ...navigate to the shop page
      this.navigateTo();
    }

    // debug [4dbsmaster]: tell us about it ;)
    console.log(`\x1b[33m[_onPopState]: splitUrl => ${splitUrl} & categoryName => ${categoryName} & subCategoryName => ${subCategoryName}\x1b[0m`);
  }

  
  /**
   * method used to install prototype methods on the shop page
   */
  _installPrototypeMethods() {
    // add the `busy` method to the `HTMLDivElement` prototype
    HTMLDivElement.prototype.busy = function() {
      // add the `busy` property to the div
      this.setAttribute('busy', '');
    };


    // add the `free` method to the `HTMLDivElement` prototype
    HTMLDivElement.prototype.free = function() {
      // remove the `busy` property from the div
      this.removeAttribute('busy');
    };


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
    };

    // add the `start` method to the `HTMLSpanElement` prototype
    HTMLSpanElement.prototype.stop = function() {
      // remove the `active` attribute from the span element
      this.removeAttribute('active');
    };

  }


  
  /**
   * Return a complete list of all available / supported price ranges
   *
   * @returns { Array }
   */
  #_getAllPrices() {
    return [
      {min: 0, max: 50, emoji: '🤑', label: 'extra-cheap'},
      {min: 50, max: 100, emoji: '💸', label: 'too-cheap'},
      {min: 100, max: 150, emoji: '💴', label: 'very-cheap'},
      {min: 150, max: 300, emoji: '💵', label: 'cheap'},
      {min: 300, max: 500, emoji: '💳', label: 'affordable'},
      {min: 500, max: 1000, emoji: '💎', label: 'expensive'},
      {min: 1000, max: 2500, emoji: '💰', label: 'very-expensive'},
      {min: 2500, max: 5000, emoji: '👑', label: 'too-expensive'},
      {min: 5000, max: -1, emoji: '✨', label: 'extra-expensive'}
    ];

  }

  
}



// instantiate the class as `shopPage`
let shopPage = new ShopPage();

// set it as the App's current page
mbApp.setCurrentPage('shop', shopPage);

// export the class as `shopPage`
export { shopPage };





