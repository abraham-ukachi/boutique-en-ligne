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
* @name: Media Watcher
* @type: helper
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
*
* A basic media-query watcher that calls two separate callbacks (narrow & wide) whenever the screen changes 
* relative to the specified *breakpoint*.
*
* Example usage:
*
*   1-|> import { installMediaQueryWatcher } from './src/helpers/mediawatcher.js';
*    -|>
*    -|> installMediaQueryWatcher(460, 
*    -|>   (firstNarrowQuery) => this._handleNarrowLayout(firstNarrowQuery),
*    -|>   (firstWideQuery) => this._handleWideLayout(firstWideQuery)
*    -|> );
*    -|>
*/

"use strict"; 
// ^^^^^^^^^ This keeps us on our toes, as it forces us to use all pre-defined variables, among other things 😅


// defining some constant variables...



/**
 * Method used to handle the media query `matches`
 *
 * @param { Boolean } matches
 * @param { Function } narrowLayoutCallback
 * @param { Function } wideLayoutCallback
 * @param { Boolean } firstQuery
 */
const handleMediaMatches = (matches, narrowLayoutCallback, wideLayoutCallback, firstQuery) => {
  // if the data matches (ie. width is more than the breakpoint)...
  if (matches) {
   
    // if theres a wide layout callback or function...
    if (typeof(wideLayoutCallback) == 'function') {
      // run the wide layout callback function w/ the query data
      wideLayoutCallback(firstQuery);
    }
    
    // DEBUG [4dbsmaster]: tell me about it :)
    // console.log(`\x1b[35m[_handleMediaMatches](1):\x1b[0m \
     // typeof(wideLayoutCallback) => ${typeof(wideLayoutCallback)}`);

  } else {
    // if theres a narrow layout callback or function...
    if (typeof(narrowLayoutCallback) == 'function') {
      // run the narrow layout callback function w/ the query data
      narrowLayoutCallback(firstQuery);
    }

    // DEBUG [4dbsmaster]: tell me about it :)
    // console.log(`\x1b[35m[_handleMediaMatches](2):\x1b[0m \
    // typeof(narrowLayoutCallback) => ${typeof(narrowLayoutCallback)}`);

  }
  
  // DEBUG [4dbsmaster]: tell me about it :)
  // console.log(`\x1b[35m[_handleMediaMatches](3):\x1b[0m firstQuery => ${firstQuery}`);

}; // <- end of `handleMediaMatches()`







/**
 * `installMediaQueryWatcher`
 *
 * Example usage:
 *  (See above examples)
 *
 * @param { Number } breakpoint 
 * @param { Function } narrowLayoutCallback
 * @param { Function } wideLayoutCallback
 */
export const installMediaQueryWatcher = (breakpoint, narrowLayoutCallback, wideLayoutCallback) => {

    // Create a width media query with the given `breakpoint` as `widthMediaQuery`
    let widthMediaQuery = window.matchMedia(`(min-width: ${breakpoint}px)`);
    
    // Handle the media query matches
    handleMediaMatches(widthMediaQuery.matches, narrowLayoutCallback, wideLayoutCallback,  true);

    
    // Add a listener to `widthMediaQuery`
    widthMediaQuery.addListener((data) => {
      handleMediaMatches(data.matches, narrowLayoutCallback, wideLayoutCallback, false);

      // DEBUG [4dbsmaster]: tell me about it :)
      // console.log(`\x1b[34m[installMediaQueryWatcher](2):\x1b[0m data => `, data);
    });


    // DEBUG [4dbsmaster]: tell me about it :)
    // console.log(`\x1b[34m[installMediaQueryWatcher](1):\x1b[0m widthMediaQuery => `, widthMediaQuery);

};
