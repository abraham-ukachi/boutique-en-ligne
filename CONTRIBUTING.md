# Contributing to Maxaboom

👍🎉 First off, with ❤️  from the authors / maintainers ([Abraham](https://github/abraham-ukachi/), [Axel](https://github.com/axel-vair/) and [Morgane](https://github.com/morgane-marechal/)), thanks for taking the time to contribute! 🎉👍


The following is a set of guidelines for contributing to Maxaboom and subsequent packages, which will soon be hosted on [Plesk](https://plesk.com) or [students-laplateforme.io](https://students-laplateforme.io). These are mostly guidelines, not rules. Use your best judgment, and feel free to propose changes to this document in a pull request.

### Table of Contents

1. [Code of Conduct](#code-of-conduct)
2. [Styleguides](#styleguides)
    - [Git Commit Messages](#git-commit-messages)
    - [HTML Styleguide](#html-styleguide)
        - [Head (`<head>`) Template](#head-\<head\>-template)
        - [Body (`<body>`) Template](#body-\<body\>-template)
        - [Main (`<main>`) Template](#main-\<main\>-template)
        - [Aside (`<aside>`) Template](#aside-\<aside\>-template)
        - [App-Layout (`.app-layout`) Template](#app-layout-.app-layout-template)
        - [Header (`<header>`) Template](#header-\<header\>-template)
        - [App-Bar (`.app-bar`) Template](#app-bar-.app-bar-template)
        - [Nav-Bar (`.nav-bar`) Template](#nav-bar-.nav-bar-template)
3. [How to Use Maxaboom ?](#how-to-use-maxaboom-?)
    - [Installation](#installation)
    - [mbApp - JS](#mbApp---js)
        - [Menus](#menus)
        - [Dialogs](#dialogs)
        - [Toasts](#toasts)

## Code of Conduct

This is a school project and as a result, everyone participating in it is expected to uphold a certain code - i.e. make participation in our project and our community a harassment-free experience for everyone, regardless of age, body size, disability, ethnicity, gender identity and expression, level of experience, nationality, personal appearance, race, religion, or sexual identity and orientation.


## Styleguides

### Git Commit Messages

* Use present tense ("Add feature" not "Added feature")
* Limit the first line to 50 characters or less
* Consider starting the commit message with an applicable emoji:
    * 🎨 :art: when improving the format/structure of the code or adding a stylesheet
    * 🐎 :racehorse: when improving performance
    * 🚱 :non-potable_water: when plugging memory leaks
    * 📝 :memo: when writing docs
    * 🐧 :penguin: when fixing something on Linux
    * 🍎 :apple: when fixing something on macOS
    * 🏁 :checkered_flag: when fixing something on Windows
    * 🐛 :bug: when fixing a bug
    * 🔥 :fire: when removing code or files
    * 💚 :green_heart: when fixing the CI build
    * ✅ :white_check_mark: when adding tests
    * 🔒 :lock: when dealing with security
    * ⬆️  :arrow_up: when upgrading dependencies
    * ⬇️  :arrow_down: when downgrading dependencies
    * 👕 :shirt: when removing linter warnings


### HTML Styleguide

Consider using the following default html templates, when creating a new **`.html`** or **`.php`** file:

#### Head (`<head>`) Template

```html
<!-- HEAD -->
<head>
  <!-- Our 4 VIP metas -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=yes">
  <meta name="description" content="Maxaboom is a fun and dynamic online store that offers a wide variety of musical instruments. From guitars and drums to keyboards, microphones and trumpets.">
  
  <!-- Title -->
  <title>Welcome to maxaboom | The #1 online store for all your musical needs</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <!-- Mulish - Font -->
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;700&display=swap" rel="stylesheet">
  
  <!-- Material Icons - https://github.com/google/material-design-icons/tree/master/font -->
  <!-- https://material.io/resources/icons/?style=baseline -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Base -->
  <base href="/boutique-en-ligne/">

  <!-- Logo - Icon -->
  <link rel="icon" href="assets/images/favicon.ico">

  <!-- See https://goo.gl/OOhYW5 -->
  <link rel="manifest" href="manifest.json">

  <!-- See https://goo.gl/qRE0vM -->
  <meta name="theme-color" content="#FFDCBA">

  <!-- Add to homescreen for Chrome on Android. Fallback for manifest.json -->
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="application-name" content="Maxaboom">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta name="apple-mobile-web-app-title" content="Maxaboom">

  <!-- Homescreen icons -->
  <link rel="apple-touch-icon" href="assets/images/manifest/icon-48x48.png">
  <link rel="apple-touch-icon" sizes="72x72" href="assets/images/manifest/icon-72x72.png">
  <link rel="apple-touch-icon" sizes="96x96" href="assets/images/manifest/icon-96x96.png">
  <link rel="apple-touch-icon" sizes="144x144" href="assets/images/manifest/icon-144x144.png">
  <link rel="apple-touch-icon" sizes="192x192" href="assets/images/manifest/icon-192x192.png">

  <!-- Theme -->
  <link rel="stylesheet" href="assets/theme/color.css">
  <link rel="stylesheet" href="assets/theme/typography.css">
  <link rel="stylesheet" href="assets/theme/styles.css">
  
  <!-- Animations -->
  <!-- <link rel="stylesheet" href="assets/animations/fade-in-animation.css"> -->
  <!-- <link rel="stylesheet" href="assets/animations/slide-from-down-animation.css"> -->

  <!-- Stylesheet -->
  <!-- <link rel="stylesheet" href="assets/stylesheets/home-styles.css"> -->

  <!-- Script -->
  <script>

    // Let's do some stuff when this page loads...
    window.addEventListener('load', (event) => { 
      // ...do something awesome here ;)
    });
    
  </script>
  
  <!-- Some more script for ya! #LOL -->
  <script src="src/app.js" defer></script>
  <!-- <script src="src/script/home.js" defer></script> -->
  
</head>
<!-- End of HEAD -->
 ```


#### Body (`<body>`) Template (with a Dark theme)

```html
<body class="theme dark" fullbleed>

  <!-- Main part -->
  <main class="flex-layout vertical">...</main>

  <!-- Aside part -->
  <aside class="flex-layout vertical" hidden>...</aside>

  <!-- Default Backdrop -->
  <div id="backdrop" hidden></div>

  <!-- Default Menus -->
  <div id="menus" hidden></div>

  <!-- Default Dialogs -->
  <div id="dialogs" hidden></div>

  <!-- Default Toasts -->
  <div id="toasts" hidden></div>

</body>
```

#### Main (`<main>`) Template

```html
<main class="flex-layout vertical">

  <!-- App-Layout of MAIN -->
  <div class="app-layout">...</div>
  
  <!-- Nav Bar -->
  <nav class="nav-bar">...</nav>
  
  <!-- Backdrop of MAIN -->
  <div class="backdrop" hidden></div>
  
  <!-- Menus of MAIN -->
  <div class="menus" hidden></div>
  
  <!-- Dialogs of MAIN -->
  <div class="dialogs" hidden></div>
  
  <!-- Toasts of MAIN -->
  <div class="toasts" hidden></div>

</main>
```


#### Aside (`<aside>`) Template

```html
<aside class="flex-layout vertical" hidden>

  <!-- App-Layout of ASIDE -->
  <div class="app-layout">...</div>
  
  <!-- Backdrop of ASIDE -->
  <div class="backdrop" hidden></div>
  
  <!-- Menus of ASIDE -->
  <div class="menus" hidden></div>
  
  <!-- Dialogs of ASIDE -->
  <div class="dialogs" hidden></div>
  
  <!-- Toasts of ASIDE -->
  <div class="toasts" hidden></div>

</aside>
```


#### App Layout (`.app-layout`) Template

```html
<div class="app-layout">
  <!-- Header -->
  <header>...</header>

  <!-- [content] -->
  <div content>...</div>
</div>
```


#### Header (`<header>`) Template

* With one [**App Bar**](#app-bar-.app-bar-template) and a horizontal divider at the bottom:

```html
<header>
  <!-- App Bar -->
  <div class="app-bar">
    <span flex></span>

    <!-- Setting - Icon Button -->
    <a href="settings.php" role="icon-button" tabindex="0" title="Settings">
      <span class="material-icons icon">settings</span>
    </a>
  </div>
  <!-- End of App Bar -->

  <!-- Horizontal Divider -->
  <span class="divider horizontal bottom"></span>
</header>
```
> NOTE: The app bar has an icon button which is pushed to the right side by the `<span flex>` element.


#### App Bar (`.app-bar`) Template

* With a title and subtitle:

```html
<div class="app-bar">
  <!-- Title Wrapper -->
  <div class="title-wrapper">
    <!-- Title -->
    <h2 class="app-title">Title</h2>
    <!-- Subtitle -->
    <h3 class="app-subtitle">Subtitle</h3>
  </div>
</div>
```
> NOTE: Titles should be wrapped with a **.title-wrapper** `<div>` element and enclosed with a `<h2>` (for title) and `<h3>` (for subtitle)


* With left & right icon buttons, and a title in the middle:

```html
<div class="app-bar">
  <!-- Return - Icon Button -->
  <button id="returnIconButton" class="icon-button" title="Go Back">
    <span class="material-icons icon">arrow_back</span>
  </button>

  <!-- Title Wrapper -->
  <div class="title-wrapper">
    <!-- Title -->
    <h2 class="app-title">Profile</h2>
  </div>

  <!-- Like - Icon Button -->
  <button id="likeIconButton" class="icon-button" title="Like Product">
    <span class="material-icons icon">favorite</span>
  </button>
</div>
```

#### Nav Bar (`.nav-bar`) Template

```html
<!-- Nav Bar -->
<!-- PHP: Include the `nav-bar` component -->
<?php 
  $_GET['navbar_orientation'] = 'veritcal'; 
  $_GET['navbar_page'] = 'home'; 
  $_GET['navbar_init'] = 'au'; 
  $_GET['navbar_profile_pic'] = 'iVBORw0K'; // data:image/png;base64,iVBORw0K
  $_GET['navbar_connected'] = 'false'; 
?>

<?php include 'components/nav-bar.php'; ?>
<!-- End of Nav Bar -->
```

## How to use Maxaboom ?

### Installation
> IMPORTANT: Make sure you have [`XAMPP`](https://www.apachefriends.org/) already installed on your computer before proceeding.

1. Clone this project's repository
```sh
git clone https://github.com/abraham-ukachi/boutique-en-ligne.git
```

> NOTE: There's no need to change the current working directory to **boutique-en-ligne**


2. Now, create a symbolic link of **boutique-en-ligne** in the `XAMPP`'s **htdocs** folder:

-   **On Mac**

```sh
ln -s "$(pwd)/boutique-en-ligne" /Applications/XAMPP/htdocs/boutique-en-ligne
```
-   **On Linux**

```sh
ln -s "$(pwd)/boutique-en-ligne" /opt/lampp/htdocs/boutique-en-ligne
```

3. Open the **boutique-en-ligne** folder in your default browser:

```sh
open http://localhost/boutique-en-ligne
```

### mbApp - JS

#### Menus 
> #comingSoon ;)

#### Dialogs
> #comingSoon ;)

#### Toasts

Show a toast message in the [ASIDE](#aside-\<aside\>-template) part, with a **10 seconds** timeout:
```js
mbApp.showToast({message: 'Hello World'}, 'aside', 10);
```
> NOTE:  


