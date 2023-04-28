/**
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
* @name Translator - Maxaboom
* @file mb_translator.php
* @type nodejs module
*
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
*
* @description: Maxaboom Web App Translator
* @info: Don't worry about this file ;) It's just a helper, 
* to easily translate our Maxaboom Web App into different languages
* @note: There must be a `en.json` file in the `locales/{{type}}` directory
* 
* 
* Usage:
*   1+|> // translate `strings` to spanish (i.e. 'es')
*    -|>
*    -|> node mb_translator.mjs strings es 
*    -|>
*
*/



/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: We'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/



// Import some modules
import { promises as fs } from 'fs';
import path from 'path';
import { exec } from 'child_process';
import { promisify } from 'util';

// Promisify the `exec` function
const execAsync = promisify(exec);



// Defining some constants...

// directories
const LOCALES_DIR = path.join('assets', 'locale');
const STRINGS_DIR = path.join(LOCALES_DIR, 'strings');
const ARRAYS_DIR = path.join(LOCALES_DIR, 'arrays');
const NUMBERS_DIR = path.join(LOCALES_DIR, 'numbers');





// create a Maxaboom Translator class
export class MaxaboomTranslator {

  /**
   * Static method to get the supported types
   *
   * @returns { Array }
   */
  static get types() {
    return [
      'strings',
      'arrays',
      'numbers',
    ];
  }


  /**
   * Static method to get the supported languages
   *
   * @returns { Object }
   */
  static get languages() {
    return {
      'en': 'english',
      'fr': 'french',
      'es': 'spanish',
      'ru': 'russian'
    };
  }

  /**
   * Constructor of this class
   *
   * @param { String } type - The type of locale to translate (eg. 'numbers', 'arrays', 'strings')
   * @param { String } lang - The language of the locale (eg. 'en', 'fr', 'ru', 'es')
   * @param { String } origLang - The original language of the locale (eg. 'en', 'fr', 'ru', 'es')
   *
   * @return { void }
   */
  constructor(type, lang, origLang = 'en') {

    // Initialize the `type` and `lang` properties
    this.type = type;
    this.lang = lang;
    this.origLang = origLang;

    // show / display the welcome message
    this.displayWelcomeMessage();
  }
  
  
  // PUBLIC SETTERS
  // PUBLIC GETTERS
  
  
  /**
   * Returns the number of keys in the original data
   * 
   * @returns { Number }
   */
  get keysLength() {
    return this.dataKeys.length;
  }
  
  
  /**
   * Returns a list of keys in the `data` property
   *
   * @returns { Array }
   */
  get dataKeys() {
    return Object.keys(this.origData);
  }


  /**
   * Returns TRUE if the `type` is supported, FALSE otherwise
   *
   * @returns { Boolean }
   */
  get isSupportedType() {
    return MaxaboomTranslator.types.includes(this.type);
  }


  /**
   * Returns TRUE if the `lang` is supported, FALSE otherwise
   *
   * @returns { Boolean }
   */
  get isSuportedLanguage() {
    return Object.keys(MaxaboomTranslator.languages).includes(this.lang);
  }



  /**
   * Returns the locale directory using the `type` property value as a reference point 
   *
   * @returns { String|FALSE } - The locale directory or FALSE if the `type` is not supported
   */
  get localeDir() {
    // If the `type` is not supported...
    if (!this.isSupportedType) {
      // ...return FALSE
      return false;
    }

    return this.type === 'strings' ? STRINGS_DIR : this.type === 'arrays' ? ARRAYS_DIR : NUMBERS_DIR;
  }


  /**
   * Returns the path to the output file
   *
   * @returns { String } - e.g. `assets/locales/strings/fr.json` (if the `type` is 'strings')
   */
  get outputPath() {
    return path.join(this.localeDir, `${this.lang}.json`);
  }

  /**
   * Returns TRUE if the `outputPath` , FALSE otherwise
   *
   * @returns { Boolean }
   */
    /*async get outputFileExists() {
    return await fs.this.outputPath
  }*/

  async checkFileExists(filePath = this.outputPath) {
    try {
      await fs.stat(filePath);
      console.log('File exists.');

      return true;

    } catch (err) {
      console.error('File does not exist.');

      // return false;
      return false;
    }
  }

  /**
   * Method used to show a welcome message to console
   */
  displayWelcomeMessage() {
    console.log(`\n\n\
    \x1b[36m
    Welcome to \x1b[0m\x1b[34mMaxaboom Translator\x1b[0m\x1b[36m\n\
    =====================================\n\n\
    \x1b[0mThis tool is used to translate our Maxaboom Web App into different languages.\n\x1b[36m
    -------------------------------------
    Usage:\n\
      1+|> \x1b[2m// translate \`strings\` to spanish (i.e. 'es')\x1b[0m\x1b[36m\n\
       -|> \x1b[33mnode mb_translator.mjs strings es \x1b[0m\x1b[36m\n\
       -|>

    -------------------------------------\n\
    @author: \x1b[0m\x1b[34Abraham Ukachi\x1b[0m\x1b[36m <abraham.ukachi@laplateforme.io>
    =====================================\x1b[0m\n\n\
    `); 
  }

  /**
   * Method used to get the current language
   *
   * @param { String } mode - The mode to use (eg. 'long', 'short')
   * @returns { String } - The current language
   */
  getCurrentLanguage(mode = 'long') {
    return mode === 'long' ? MaxaboomTranslator.languages[this.lang] : this.lang;
  }

  // PUBLIC METHODS


  /**
   * Method used to load the original data.
   * NOTE: This method updated the `origData` property of the class
   *
   * @returns { Promise } 
   */
  loadOrigData(origLang = this.origLang) {
    return new Promise(async (resolve, reject) => {
      try {

        // Try to get the data of the given `lang`
        let data = await fs.readFile(path.join(this._getLocaleDir(type), `${origLang}.json`), 'utf8');

        // Update the `origData` property with the parsed data
        this.origData = JSON.parse(data);

        // Resolve the promise
        resolve(this.origData);

        // DEBUG [4dbsmaster]: tell me about it ;)
        // console.log(`\x1b[32m[loadOrigData]: data => \x1b[0m`, data);

      }catch(err) {
        // reject the promise
        reject(err);

        // DEBUG [4dbsmaster]: tell me about it ;)
        // console.log(`\x1b[31m[loadOrigData]: err => \x1b[0m`, err);
      }
    });


    // Return the data
    return data;
  }



  /**
   * Method used to translate Maxaboom into the given language
   *
   * @param { Object } origData - The original data to translate
   *
   * @returns { Promise } - A promise that resolves to the translated data
   */
  translate(origData = this.origData) {
    return new Promise (async (resolve, reject) => {
      
      // If the given `type` is not supported...
      if (!this.isSupportedType) {
        // ...reject the promise
        return reject(`The given type '${this.type}' is not supported`);
        
      }else if (!this.isSuportedLanguage) { // <- If the given `lang` is not supported...
        // ...reject the promise
        return reject(`The given language '${this.lang}' is not supported`);
      }
      

      // Initialize the `translatedData` object variable
      let translatedData = {};

      
      for (let key of Object.keys(origData)) {

        // get the value
        let value = origData[key];

        // Try to translate the value
        try {
          // print out a message to the console
          console.log(`\x1b[2m[Maxaboom Translator]: (\x1b[35m%s\x1b[0m\x1b[2m)\x1b[0m translating \x1b[33m'%s'...\x1b[0m \x1b[2m(%s)\x1b[0m`, this.lang, key, value);

          // ...and assign the result to a `translatedValue` variable
          let translatedValue = await this._translateValue(value);

          // add the `key` and `translatedValue` to the `translatedData` object
          translatedData[key] = translatedValue;

          // print out the `translatedValue` (in green color) to console
          console.log(`\x1b[32m%s\x1b[0m\n`, translatedValue);


        } catch(err) {
          // if there's an error, reject the promise
          reject(`\x1b[31m[translate]:\x1b[0m ${err}`);
        }

      }
 
      // resolve the promise
      resolve(translatedData);

    });

  }



  /**
   * Method used to save the given `data` to the output file.
   * NOTE: This method uses the `fs.writeFil` method to save the data
   *
   * @param { Object } data - The data to save
   *
   * @returns { Promise } - A promise that resolves to TRUE if the data was successfully saved 
   */
  save(data, override = false) {
    return new Promise(async (resolve, reject) => {

      // do nothing if the output file already exists and the `override` flag is not set
      if (this.checkFileExists() && !override) { reject(`The output file '${this.outputPath}' already exists`); }

      // stringify the given `data`
      let dataStr = JSON.stringify(data, null, 2);

      // DEBUG [4dbsmaster]: tell me about it ;)
      console.log(`\x1b[34m[save]: dataStr => \x1b[0m`, dataStr);


      // ...save it to the output file
      fs.writeFile(this.outputPath, dataStr, (err) => {
        // if there's an error...
        if (err) {
          // ...reject the promise
          return reject(err);
        }

        // resolve the promise
        resolve(true);
      });

    });


  }

  // PRIVATE SETTERS
  // PRIVATE GETTERS
  // PRIVATE METHODS



  /**
   * Method used to translate the given `value`,
   * NOTE: In this method, we'll be using the `execAsync` method of the `child_process` module to execute the `trans` command
   *       of the `translate-shell` package
   *
   * @param { String } value - The value to translate
   *
   * @returns { Promise } - A promise that resolves to the translated value
   * 
   * @private
   */
  _translateValue(value) {
    return new Promise(async (resolve, reject) => {
      
      // Define the command
      const command = `trans -b -no-warn ${this.origLang}:${this.lang} "${value}"`; // eg. `trans -b -no-warn en:fr "Hello World!"`
      
      try {
        // Execute the `command`
        const { stdout, stderr } = await execAsync(command);

        // if there's an error...
        if (stderr) {
          // ...reject the promise
          return reject(stderr);
        }

        // Resolve the promise with the translated value (i.e. stdout)
        // NOTE: We're using the `trim` method to remove the trailing newline character
        resolve(stdout.trim());
         
        // DEBUG [4dbsmaster]: tell me about it ;)
        // console.log(`\x1b[2m[_translateValue] (1): command => \x1b[0m`, command);
        // console.log(`\x1b[2m[_translateValue] (2): stdout => \x1b[0m\x1b[33m%s\x1b[0m`, stdout.trim()); 

      } catch(err) { // <- If there's an error...
        // ...reject the promise
        reject(stderr);
      }

    });

  }




  /**
   * Returns the directory where all the locales of the given `type` are stored
   *
   * @param { String } type - The type of locale to translate (eg. 'numbers', 'arrays', 'strings')
   *
   * @returns { String }
   * @private
   */
  _getLocaleDir(type = this.type) {
    return path.join(LOCALES_DIR, type);
  }


}





// Get the arguments passed to the script
let type = process.argv[2]; // <- The type of locale to translate (eg. 'numbers', 'arrays', 'strings')
let lang = process.argv[3]; // <- e.g. 'en'




// Create a new instance of the MaxaboomTranslator class
const mbTranslator = new MaxaboomTranslator(type, lang);




// Load the original data as `origData`
let origData = await mbTranslator.loadOrigData();

// translate the `origData`
let translatedData = await mbTranslator.translate(origData);

// Save the translated data
let saved = await mbTranslator.save(translatedData, true);


// if the data was saved successfully...
if (saved) {
  // ...print out a success message
  console.log(`\x1b[32m[mb_translator] (1): Successfully translated ${mbTranslator.keysLength} keys into ${mbTranslator.getCurrentLanguage()} \x1b[0m`, mbTranslator.outputPath);
}


// DEBUG [4dbsmaster]: tell me about it ;)
console.log(`\x1b[32m[mb_translator]: (2) outputPath => \x1b[35${mbTranslator.outputPath}\x1b[0m`);
