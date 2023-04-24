# Contributing to Maxaboom

👍🎉 First off, with ❤️  from the authors / maintainers ([Abraham](https://github/abraham-ukachi/), [Axel](https://github.com/axel-vair/) and [Morgane](https://github.com/morgane-marechal/)), thanks for taking the time to contribute! 🎉👍


The following is a set of guidelines for contributing to Maxaboom and subsequent packages, which will soon be hosted on [Plesk](https://plesk.com) or [students-laplateforme.io](https://students-laplateforme.io). These are mostly guidelines, not rules. Use your best judgment, and feel free to propose changes to this document in a pull request.

### Table of Contents

1. [Code of Conduct](#code-of-conduct)
2. [Styleguides](#styleguides)
    - [Git Commit Messages](#git-commit-messages)
    - [HTML Styleguide](#html-styleguide)
        - [Head (`<head>`) Template](#head-head-template)
        - [Body (`<body>`) Template (with a Dark theme)](#body-body-template-with-a-dark-theme)
        - [Main (`<main>`) Template](#main-main-template)
        - [Aside (`<aside>`) Template](#aside-aside-template)
        - [App-Layout (`.app-layout`) Template](#app-layout-app-layout-template)
        - [Header (`<header>`) Template](#header-header-template)
        - [App-Bar (`.app-bar`) Template](#app-bar-app-bar-template)
        - [Nav-Bar (`#navBar`) Template](#nav-bar-navbar-template)
        - [Side-Bar (`#sideBar`) Template](#side-bar-sidebar-template)
        - [Empty - Container (`.container[empty]`) Template](#empty-container-containerempty-template)
        - [Not-Connected - Container (`.container[not-connected]`) Template](#not-connected-container-containernot-connected-template)
        - [Floating Action Button (`.fab`) Template](#floating-action-button-fab-template)
        - [Link Item (`.link-item`) Template](#link-item-link-item-template)
        - [Input (`.input-wrapper`) Template](#input-input-wrapper-template)
3. [How to Use Maxaboom ?](#how-to-use-maxaboom-?)
    - [Installation](#installation)
    - [mbApp - JS](#mbApp---js)
        - [Menus](#menus)
        - [Dialogs](#dialogs)
        - [Toasts](#toasts)

## Code of Conduct

This is a school project and as a result, everyone participating in it is expected to uphold a certain code - i.e. make participation in our project and our community a harassment-free experience for everyone, regardless of age, body size, disability, ethnicity, gender identity and expression, level of experience, nationality, personal appearance, race, religion, or sexual identity and orientation. For more information, read our [CODE_OF_CONDUCT.md](https://github.com/abraham-ukachi/boutique-en-ligne/CODE_OF_CONDUCT.md) `markdown` file ;)


## Styleguides

### Git Commit Messages

* Use present tense ("Add feature" not "Added feature")
* Limit the first line to 50 characters or less
* Consider starting the commit message with an applicable emoji:
    * 🎨 `:art:` when improving the format/structure of the code or adding a stylesheet
    * 🐎 `:racehorse:` when improving performance
    * 🚱 `:non-potable_water:` when ignoring folder and/or files 
    * 📝 `:memo:` when writing docs
    * 🐧 `:penguin:` when fixing something on Linux
    * 🍎 `:apple:` when fixing something on macOS
    * 🏁 `:checkered_flag:` when fixing something on Windows
    * 🐛 `:bug:` when fixing a bug
    * 🔥 `:fire:` when removing code or files
    * 💚 `:green_heart:` when creating or adding a new file 
    * ✅ `:white_check_mark:` when adding tests
    * 🔒 `:lock:` when dealing with security
    * ⬆️  `:arrow_up:` when upgrading dependencies
    * ⬇️  `:arrow_down:` when downgrading dependencies
    * 👕 `:shirt:` when removing linter warnings


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
  <script type="module" src="src/app.js" defer></script>
  <!-- <script type="module" src="src/scripts/home.js" defer></script> -->
  
</head>
<!-- End of HEAD -->
```


#### Body (`<body>`) Template (with a Dark theme)

```html
<body class="theme dark" fullbleed>

  <!-- Side Bar -->
  <nav id="sideBar">...</nav>

  <!-- Main part -->
  <main class="flex-layout vertical">...</main>

  <!-- Aside part -->
  <aside class="flex-layout vertical" hidden>...</aside>

  <!-- Default Backdrop -->
  <div id="backdrop" fit hidden></div>

  <!-- Default Menus -->
  <div id="menus" fit hidden></div>

  <!-- Default Dialogs -->
  <div id="dialogs" fit hidden></div>

  <!-- Default Toasts -->
  <div id="toasts" fit hidden></div>

</body>
```

#### Main (`<main>`) Template

```html
<main class="flex-layout vertical">

  <!-- App-Layout of MAIN -->
  <div class="app-layout" fit>...</div>
  
  <!-- Nav Bar -->
  <nav id="navBar">...</nav>
  
  <!-- Backdrop of MAIN -->
  <div class="backdrop" fit hidden></div>
  
  <!-- Menus of MAIN -->
  <div class="menus" fit hidden></div>
  
  <!-- Dialogs of MAIN -->
  <div class="dialogs" fit hidden></div>
  
  <!-- Toasts of MAIN -->
  <div class="toasts" fit hidden></div>

</main>
```


#### Aside (`<aside>`) Template

```html
<aside class="flex-layout vertical" hidden>

  <!-- App-Layout of ASIDE -->
  <div class="app-layout" fit>...</div>
  
  <!-- Backdrop of ASIDE -->
  <div class="backdrop" fit hidden></div>
  
  <!-- Menus of ASIDE -->s
  <div class="menus" fit hidden></div>
  
  <!-- Dialogs of ASIDE -->
  <div class="dialogs" fit hidden></div>
  
  <!-- Toasts of ASIDE -->
  <div class="toasts" fit hidden></div>

  <!-- Vertical Divider -->
  <span class="divider vertical left"></span>
</aside>
```


#### App Layout (`.app-layout`) Template

```html
<div class="app-layout" fit>
  <!-- Header -->
  <header>...</header>

  <!-- [content] -->
  <div content>...</div>
</div>
```


#### Header (`<header>`) Template

* With one [**App Bar**](#app-bar-app-bar-template) and a horizontal divider at the bottom:

```html
<header>
  <!-- App Bar -->
  <div class="app-bar">
    <span flex></span>

    <!-- Account - Icon Button -->
    <a href="account" role="icon-button" tabindex="0" title="Settings">
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
<!-- App Bar -->
<!-- TIP: Add a [sticky] property to the app-bar, to fall in love ;) -->
<div class="app-bar">
  <!-- Title Wrapper -->
  <div class="title-wrapper">
    <!-- Title -->
    <h2 class="app-title">Title</h2>
    <!-- Subtitle -->
    <h3 class="app-subtitle">Subtitle</h3>
  </div>
</div>
<!-- End of App Bar -->
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

#### Nav Bar (`#navBar`) Template

Use the following code to include a nav bar in your `.html` or `.php` page:

```html
<!-- Nav Bar -->
<!-- PHP: Include the `navBar` component -->
<?php 
  $_GET['navbar_route'] = 'home'; 
  $_GET['navbar_init'] = 'au'; 
  $_GET['navbar_connected'] = false; // TRUE if the user is connected
  $_GET['navbar_for_admin'] = false; // TRUE if the user is an admin 

  require __DIR__ . '/components/nav-bar.php';
?>
<!-- End of Nav Bar -->

```

##### Demo - Nav Bar - PHP Component

Run the code below in your terminal, to see a demo of **nav-bar** component
```zsh
open http://localhost/boutique-en-ligne/component/demo/nav-bar
```

#### Side Bar (`#sideBar`) Template

Use the following code to include a side bar in your `.html` or `.php` page:

```html
<!-- Side Bar -->
<!-- PHP: Include the `sideBar` component -->
<?php 
  $_GET['sidebar_route'] = 'home'; 
  $_GET['sidebar_init'] = 'au'; 
  $_GET['sidebar_connected'] = false; // TRUE if the user is connected
  $_GET['sidebar_for_admin'] = false; // TRUE if the user is an admin 

  require __DIR__ . '/components/side-bar.php';
?>
<!-- End of Side Bar -->

```

##### Demo - Side Bar - PHP Component

Run the code below in your terminal, to see a demo of **side-bar** component
```zsh
open http://localhost/boutique-en-ligne/component/demo/side-bar
```


#### Empty Container (`.container[empty]`) Template

Use the following code to include an **empty container** in the `<div content>` element of your `.html` or `.php` page:

```html
<!-- [empty] Container -->
<div class="container vertical flex-layout centered" empty>
    <span class="doodle"></span>
    <h2 title>Empty Cart :(</h2>
    <p info>To add an instrument to your cart, tap <span class="material-icons icon">post_add</span> at the bottom right of your screen</p>
</div>
```
> NOTE: Feel free to change the **title** and/or **description** as you see fit ;)


#### Not-Connected Container (`.container[not-connected]`) Template

Use the following code to include an **not-connected container** in the `<div content>` element of your `.html` or `.php` page:

```php
<!-- [not-connected] Container -->
<div class="container vertical flex-layout centered" not-connected empty>
  <span class="not-connected-doodle doodle"></span>
  <h2 title><?= $this->i18n->getString('youAreNotConnected') ?></h2>
  <p info><?= $this->i18n->getString('youAreNotConnectedMessage') ?></p>

  <a href="login" class="button" tabindex="0" role="button" contained>
    <?= $this->i18n->getString('login') ?>
  </a>
</div>
<!-- End of [not-connected] Container -->
```
> NOTE: Using the `getString()` method from `I18n` class to display texts




#### Floating Action Button (`.fab`) Template
Use the following code to include a **fab** in the `<main>` or `<aside>` of your `.html` or `.php` page:

```html
<!-- Fab -->
<button class="fab vertical flex-layout centered" contained expands shrinks>
    <span class="material-icons icon">post_add</span>
</button>
<!-- End of Fab -->
```


#### Menu (`<menu>`) Template

Use the following code to include a **menu** in your `.html` or `.php` page:


```html
<!-- Menu -->
<menu data-id="{{menuId}}" class="menu vertical flex-layout" hidden>

    <!-- Close Menu + Icon Button -->
    <li role="close-menu">
        <button class="icon-button"><span class="material-icons icon">arrow_back_ios</span></button>
    </li>
        
    <!-- MenuItem 1 -->
    <li title="{{menuItem1Title}}" class="menu-item">
      <button>
        <span class="material-icons icon">post_add</span>
        <span>{{menuItem1Name}}</span>
      </button>
    </li>

    <!-- MenuItem 2 -->
    <li title="{{menuItem2Title}}" class="menu-item">
      <button>
        <span class="material-icons icon">lock</span>
        <span>{{menuItem2Name}}</span>
      </button>
    </li>
</menu>
<!-- End of Menu -->
```

##### Open a menu

Use the `openMenuById()` method of **`mbApp`** to open a menu:

```js
    // open a menu with an id: `productMenu`
    mbApp.openMenuById('productMenu');
```
> NOTE: There are also `openMainMenuById()` and `openAsideMenuById()` methods ;)

##### Close a menu 

Use the `closeMenuById()` method of **`mbApp`** to close a menu:

```js
    // close a menu with an id: `productMenu`
    mbApp.closeMenuById('productMenu');
```

> NOTE: There are also `closeMainMenuById()` and `closeAsideMenuById()` methods ;)



#### Link Item (`.link-item`) Template

Use the following code to include 2 **links** or **list items** in your `.html` or `.php` page:

```html
<!-- Links -->
<ul class="links" naked>

    <!-- Link Item #1 -->
    <li class="link-item">
        <a href="{{path/to/page}}" role="button" tabindex="0" class="horizontal flex-layout center" naked>
            <div class="text-wrapper flex-layout vertical">
                <!-- Title -->
                <h3>{{Title}}</h3>
                <h4>{{Description}}</h4>
            </div>
            <span class="material-icons arrow icon">chevron_right</span>
        </a>
    </li>
    

    <!-- Link Item #2 -->
    <li class="link-item">
        <a href="{{path/to/page}}" role="button" tabindex="0" class="horizontal flex-layout center" naked>
            <div class="text-wrapper flex-layout vertical">
                <!-- Title -->
                <h3>{{Title}}</h3>
                <h4>{{Description}}</h4>
            </div>
            <span class="material-icons arrow icon">chevron_right</span>
        </a>
    </li>
</ul>
<!-- End of Links -->
```


#### Input (`.input-wrapper`) Template

##### Text Input
Use the following code an **text input** in your `.html` or `.php` page:

```html
<!-- Input Wrapper -->
<div class="input-wrapper vertical flex-layout">
  <!-- Label -->
  <label for="firstNameInput">First Name</label>
  <!-- Input -->
  <input type="text" id="firstNameInput" name="firstName" required>
  <!-- Indicator -->
  <span class="input-indicator"><span bar></span><span val></span></span>
</div>
<!-- End of Input Wrapper -->
```

##### Password Input
Use the following code an **password input** in your `.html` or `.php` page:

```html
<!-- Input-Wrapper -->
<!-- TIP: Add `[has-error]` attribute / property to `.input-wrapper`, to increase the error input message height -->
<div class="input-wrapper vertical flex-layout">
  <!-- Label -->
  <label for="passwordInput">Password</label>

  <!-- Horizontal Flex-Layout -->
  <div class="horizontal flex-layout">

    <!-- Input -->
    <input type="password" id="passwordInput" name="password" required>

    <!-- Toggle Password - Icon Button -->
    <button type="button" tabindex="-1" class="icon-button" onclick="mbApp.togglePasswordInputById('passwordInput')">
      <span class="material-icons">visibility</span>
    </button>

    <!-- Indicator -->
    <!-- TIP: Use the `[no-effect]` attribute / property on `.input-indicator`, to remove the auto-hide / cool effect ;) -->
    <span class="input-indicator"><span bar></span><span val></span></span>
  </div>
  <!-- End of Horizontal Flex-Layout -->

  <!-- Input Message -->
  <!-- NOTE: Add `error` class, to make this `.input-message` an error message -->
  <p class="input-message fade-in error" hidden>Incorrect password</p>
  <!-- End of Input Message -->

</div>

```
---

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

Show the menu using a specific `[data-id]` (e.g *"productMenu"*) with a **0.5 seconds** timeout:
```js
mbApp.showMenuById('productMenu', 0.5);
```

> NOTE:  

Show another menu using a specific `[data-id]` (e.g *"detailsMenu"*) with a **1 second** timeout:
```js
import { ASIDE_PART } from 'src/app.js';

mbApp.showMenuById('detailsMenu', 1, ASIDE_PART);
```

> NOTE:  


#### Dialogs

Open a dialog with a **0.5 seconds** timeout (in the [ASIDE](#aside-aside-template) part):
```js
import { ASIDE_PART } from 'src/app.js';

mbApp.openDialog({
    title: 'Delete Account', 
    message: 'Are you sure?', 
    confirmBtnText: 'Yes', 
    cancelBtnText: 'No', 
    onConfirm: () => console.log('confirm button clicked'), 
    onCancel: () => console.log('cancel button clicked'),
    noDivider: false,
    isCancelable: true
}, 0.5, ASIDE_PART);
```

Close a dialog: 
```js
mbApp.closeDialog(); // <- without arguments

mbApp.closeDialog('dialog', 0.5, ASIDE_PART); // <- with arguments
```

#### Toasts

Show a toast message for **5 seconds**:
```js
mbApp.showToast({message: 'Hello World'}, 10);
```
> NOTE:  


Show a toast message in the [ASIDE](#aside-aside-template) part, with a **10 seconds** timeout:
```js
import { ASIDE_PART } from 'src/app.js';

mbApp.showToast({message: 'Hello World', part: ASIDE_PART}, 10);
```
> NOTE:  
