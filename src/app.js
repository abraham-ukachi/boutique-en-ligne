"use strict"; // <- use strict mode

import I18n from './helpers/i18n.js';

// define the user locale as `lang`
const lang = 'en';

const i18n = new I18n(lang);


i18n.dataLoaded = (data) => {

  let hello = i18n.getString('hello');

  // DEBUG [4dbsmaster]: tell me about it ;)
  console.log(`\x1b[2m[dataLoaded]: getString(hello) => ${hello} & data => \x1b[0m`, data);
};

