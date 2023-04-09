/**
* @license MIT
* boutique-en-ligne (maxaboom)
* Copyright (c) 2023 Abraham Ukachi, Axel Vair, Morgane Marechal, Catherine Tranchand. The Maxaboom Project Contributors.
* All rights reserved.
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
* @project boutique-en-ligne
* @name I18n (internationalization) - Helper
* @file src/helpers/i18n.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1+|> // import the I18n class
*    -|>
*    -|> import I18n from './helpers/i18n';
*  
*
*
*   2+|> // create an instance of the I18n class
*    -|>
*    -|> let i18n = new I18n('fr'); // <- using the french language (i.e. 'fr')
*
*
*
*   3+|> // get the string value of a given key, say 'hello'
*    -|>
*    -|> let hello = i18n.getString('hello');
*    -|> console.log(hello); // <- 'Bonjour'
*
*
*/

"use strict"; // <- use strict mode

// define some constants
const DEFAULT_LANG = 'en';
const LANGS = ['en', 'fr', 'ru', 'es']; // <- currently supported languages

// paths
const ASSETS_PATH = 'assets/';
const LOCALE_PATH = ASSETS_PATH + 'locale/';
const STRINGS_PATH = LOCALE_PATH + 'strings/';
const NUMBERS_PATH = LOCALE_PATH + 'numbers/';
const ARRAYS_PATH = LOCALE_PATH + 'arrays/';

















// TODO: Handle the case where import fails


/*
 * Define the Internationalization class as `I18n`
 *
 * Example usage:
 *   const i18n = new I18n('fr');
 *   let str = i18n.getString('hello'); // <- 'Bonjour'
 */
class I18n {

  // protected properties
  #strings = [];
  #numbers = [];
  #arrays = [];

  // public properties
  
  // private properties
  _stringsLoaded = false;
  _numbersLoaded = false;
  _arraysLoaded = false;


  /*
   * Constructor of the I18n class
   * This method will be called automatically when an instace of the class is created
   *
   * @param { String } lang - the language to use
   */
  constructor(lang = DEFAULT_LANG) {
    // initialize the `lang` property
    this.lang = lang;

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[30m[__constructor]: I'm in the constructor of the class I18n\x1b[0m`);

    // this._loadData(lang);
  }


  // PUBLIC SETTERS

  /**
   * Sets the language to use
   *
   * @param { String } lang - the language to use
   */
  set lang(value) {
    // check if the language is supported
    if (!LANGS.includes(value)) {
      throw new Error(`The language ${value} is not supported`);
    }

    // set the language
    this._lang = value;

    // load the required / corresponding data (i.e. strings, numbers and arrays)
    this._loadData(value);

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[32m[lang]: lang has been set to ${value}\x1b[0m`);
  }


  // PUBLIC GETTERS

  /**
   * Returns the language currently used
   *
   * @returns { String }
   */
  get lang() {
    return this._lang;
  }

  // PUBLIC METHODS


  /**
   * Handler that is called when the data is loaded
   *
   * @param { Object } data - the data that has been loaded (e.g. { hello: 'Bonjour' })
   */
  dataLoaded(data) {}



  /**
   * Method used to get the string value of the given `key`
   *
   * @param { String } key - the key of the string to get
   * @returns { String } - the string value of the given `key`
   */
  getString(key) {
    return this.#strings[key];
  }


  /**
   * Method used to get the number value of the given `key`
   *
   * @param { String } key - the key of the number to get
   * @returns { String } - the number value of the given `key`
   */
  getNumber(key) {
    return this.#numbers[key];
  }


  /**
   * Method used to get the array value of the given `key`
   *
   * @param { String } key - the key of the array to get
   * @returns { String } - the array value of the given `key`
   */
  getArray(key) {
    return this.#arrays[key];
  }


  /**
   * Returns the list of supported languages 
   * 
   * @returns { Array[Object] } - the list of supported languages and their corresponding names
   */
  getSupportedLanguages() {
    return LANGS.map((lang) => {
      return {lang: lang, name: this.getString(lang)}
    });
  }









  // PRIVATE SETTERS
  // PRIVATE GETTERS
  // PRIVATE METHODS


  /**
   * Method used to load all the string, number and array data for the given `lang`
   *
   * @param { String } lang - the language to use
   * @private
   */
  async _loadData(lang = this.lang) {
    // load the strings data
    let stringsData = await this._loadStringsData(lang);
    // load the numbers data
    let numbersData = await this._loadNumbersData(lang);
    // load the arrays data
    let arraysData = await this._loadArraysData(lang);


    // call the `dataLoaded` method 
    this.dataLoaded({stringsData, numbersData, arraysData});

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(`\x1b[35m[_loadData]: Data has been loaded appName is ${this.getString('appName')}\x1b[0m`);

  }



  /**
   * Method used to load the strings data for the given `lang`
   *
   * @param { String } lang - the language to use
   * @returns { Object } - the strings data
   * @private
   */
  async _loadStringsData(lang = this.lang) {
    // set `_stringsLoaded` to `false`
    this._stringsLoaded = false;

    // dynamically import the corresponding strings data / JSON file
    //let response = await import(STRINGS_PATH + lang + '.json');

    let response = await fetch(STRINGS_PATH + lang + '.json');
    let stringsData = await response.json();

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(stringsData);

    // load the strings data, and update the `#strings` property
    this.#strings = stringsData;

    // set `_stringsLoaded` to `true`
    this._stringsLoaded = true;

    // return the `stringsData`
    return stringsData;
  }


  /**
   * Method used to load the numbers data for the given `lang`
   *
   * @param { String } lang - the language to use
   * @private
   */
  async _loadNumbersData(lang = this.lang) {
    // set `_numbersLoaded` to `false`
    this._numbersLoaded = false;

    // dynamically import the corresponding numbers data / JSON file
    let response = await fetch(NUMBERS_PATH + lang + '.json');
    let numbersData = await response.json();

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(numbersData);

    // load the numbers data, and update the `#numbers` property
    this.#numbers = numbersData;

    // set `_numbersLoaded` to `true`
    this._numbersLoaded = true;

    // return the `numbersData`
    return numbersData;

  }


  /**
   * Method used to load the arrays data for the given `lang`
   *
   * @param { String } lang - the language to use
   * @private
   */
  async _loadArraysData(lang = this.lang) {
    // set `_arraysLoaded` to `false`
    this._arraysLoaded = false;

    // dynamically import the corresponding arrays data / JSON file
    let response = await fetch(ARRAYS_PATH + lang + '.json');
    let arraysData = await response.json();

    // DEBUG [4dbsmaster]: tell me about it ;)
    console.log(arraysData);

    // load the arrays data, and update the `#arrays` property
    this.#arrays = arraysData;

    // set `_arraysLoaded` to `true`
    this._arraysLoaded = true;

    // return the `arraysData`
    return arraysData;
  }


};


// export the I18n class as default
// so that we can import it in other files
export default I18n;
