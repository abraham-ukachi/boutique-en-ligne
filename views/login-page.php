<?php
/**
* @license MIT
* boutique-en-ligne (maxaboom)
* Copyright (c) 2023 Abraham Ukachi, Axel Vair, Morgane Marechal. The Maxaboom Project Contributors.
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
* @name Login Page - Maxaboom
* @file login-page.php
* @author: Axel Vair <axel.vair@laplateforme.io>
* @contributors: Abraham Ukachi <abraham.ukachi@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> open http://localhost/boutique-en-ligne/login
* 
*
* ============================
* IMPORTANT: This is a working progress and subject to major changes ;)
* ============================
*/


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: We'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/


?><!DOCTYPE html>

<html lang="<?= $this->lang ?>">

<!-- HEAD -->
<head>
  <!-- Our 4 VIP metas -->
  <meta charset='utf-8'>
  <meta http-equiv='x-ua-compatible' content='IE=edge,chrome=1'>
  <meta name='viewport' content='width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=no'>
  <meta name='description' content='<?= $this->i18n->getString('appDescription2') ?>'>

    <!-- Title -->
    <title><?= $this->i18n->getString('welcomeMessage') ?></title>

    <!-- Fonts -->
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <!-- Mulish - Font -->
    <link href='https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;700&display=swap' rel='stylesheet'>

    <!-- Material Icons - https://github.com/google/material-design-icons/tree/master/font -->
    <!-- https://material.io/resources/icons/?style=baseline -->
    <link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>

    <!-- Base -->
    <base href='/boutique-en-ligne/'>

    <!-- Logo - Icon -->
    <link rel='icon' href='assets/images/favicon.ico'>

    <!-- See https://goo.gl/OOhYW5 -->
    <link rel='manifest' href='manifest.json'>

    <!-- See https://goo.gl/qRE0vM -->
    <meta name='theme-color' content='#FFDCBA'>

    <!-- Add to homescreen for Chrome on Android. Fallback for manifest.json -->
    <meta name='mobile-web-app-capable' content='yes'>
    <meta name='application-name' content='Maxaboom'>

    <!-- Add to homescreen for Safari on iOS -->
    <meta name='apple-mobile-web-app-capable' content='yes'>
    <meta name='apple-mobile-web-app-status-bar-style' content='default'>
    <meta name='apple-mobile-web-app-title' content='Maxaboom'>

    <!-- Homescreen icons -->
    <link rel='apple-touch-icon' href='assets/images/manifest/icon-48x48.png'>
    <link rel='apple-touch-icon' sizes='72x72' href='assets/images/manifest/icon-72x72.png'>
    <link rel='apple-touch-icon' sizes='96x96' href='assets/images/manifest/icon-96x96.png'>
    <link rel='apple-touch-icon' sizes='144x144' href='assets/images/manifest/icon-144x144.png'>
    <link rel='apple-touch-icon' sizes='192x192' href='assets/images/manifest/icon-192x192.png'>

    <!-- Theme -->
    <link rel='stylesheet' href='assets/theme/color.css'>
    <link rel='stylesheet' href='assets/theme/typography.css'>
    <link rel='stylesheet' href='assets/theme/styles.css'>

    <!-- Animations -->
    <!-- <link rel='stylesheet' href='assets/animations/fade-in-animation.css'> -->
    <!-- <link rel='stylesheet' href='assets/animations/slide-from-down-animation.css'> -->

    <!-- Stylesheet -->
    <link rel='stylesheet' href='assets/stylesheets/login-styles.css'>


    <!-- Script -->
    <script>

        // Let's do some stuff when this page loads...
        window.addEventListener('load', (event) => {
            // ...do something awesome here ;)
        });

    </script>

    <!-- Some more script for ya! #LOL -->
    <script type='module' src='src/app.js' defer></script>
    <!-- <script src='https://kit.fontawesome.com/75738720bb.js' crossorigin='anonymous'></script> -->
    <script type='module' src='src/scripts/login.js' defer></script>


</head>
<!-- End of HEAD -->
<body class='theme <?= $this->theme ?>' fullbleed>

  <!-- Side Bar -->
  <!-- PHP: Include the `sideBar` component -->
  <?php 
    $_GET['sidebar_route'] = 'login'; 
    $_GET['sidebar_init'] = $this->user->getInitials(); 
    $_GET['sidebar_connected'] = $this->user->isConnected(); // TRUE if the user is connected
    $_GET['sidebar_for_admin'] = $this->user->isAdmin(); // TRUE if the user is an admin 

    require __DIR__ . '/components/side-bar.php';
  ?>
  <!-- End of Side Bar -->


  <!-- Main part -->
  <main class='flex-layout vertical'>
    
    <!-- App-Layout of MAIN -->
    <div class='app-layout' fit>
      <!-- Header -->
      <header>
        
        <div class="app-bar">

          <!-- Return Button -->
          <button id="returnButton" class="icon-button" invisible narrow-only>
            <span class="material-icons icons">arrow_back_ios</span>
          </button>

          <div class="title-wrapper centered horizontal flex-layout">
            <!-- App Logo -->
            <span class="app-logo" narrow-only></span>
            <!-- App Name -->
            <span class="app-name" tablet-and-desktop-only></span>
          </div>

          <!-- Menu Button -->
          <button id="menuButton" class="icon-button">
            <span class="material-icons icons">more_vert</span>
          </button>

        </div>

        <!-- App Bar -->
        <!-- TIP: Add a [sticky] property to the app-bar, to fall in love ;) -->
        <div class='app-bar'>
         
          <!-- Title Wrapper -->
          <a href="login" class='title-wrapper' active>
            <!-- Title -->
            <h2 class='app-title'><?= $this->i18n->getString('login') ?></h2>
          </a>
          <!-- End of Title Wrapper -->

          <!-- Title Wrapper -->
          <a href="register" class='title-wrapper'>
            <!-- Title -->
            <h2 class='app-title'><?= $this->i18n->getString('register') ?></h2>
          </a>

          <span flex></span>


        </div>
        <!-- End of App Bar --> 

        <!-- Horizontal Divider -->
        <span class="divider horizontal bottom"></span>

      </header>

        <!-- [content] -->
        <div content>
          <!-- Container -->
          <div class='container'>

            <!-- Login Form -->
            <form id='loginForm' class="vertical flex-layout" method='POST'>
              <!-- Input Wrapper -->
              <div class='input-wrapper vertical flex-layout'>
                <!-- Label -->
                <label for='mail'><?= $this->i18n->getString('email') ?></label>
                <!-- Input -->
                <input type='text' id='mail' name='mail' minlength="3" maxlength="60" pattern="^[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$" required>
                <!-- Indicator -->
                <span class='input-indicator'><span bar></span><span val></span></span>

                <!-- Input Message -->
                <!-- NOTE: Add `error` class, to make this `.input-message` an error message -->
                <p class='input-message fade-in error' hidden></p>
                <!-- End of Input Message -->
              </div>
              <!-- End of Input Wrapper -->

              <!-- Input-Wrapper -->
              <!-- TIP: Add `[has-error]` attribute / property to `.input-wrapper`, to increase the error input message height -->
              <div class='input-wrapper vertical flex-layout'>
                  <!-- Label -->
                  <label for='password'><?= $this->i18n->getString('password') ?></label>

                  <!-- Horizontal Flex-Layout -->
                  <div class='horizontal flex-layout'>
                      <!-- Input -->
                      <!-- <input type='password' id='password' name='password' minlength="8" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" required> -->
                      <input type='password' id='password' name='password' required>
                      <!-- Toggle Password - Icon Button -->
                      <button type='button' tabindex='-1' class='icon-button' onclick="mbApp.togglePasswordInputById('password')">
                        <span class='material-icons'>visibility</span>
                      </button>

                      <!-- Indicator -->
                      <!-- TIP: Use the `[no-effect]` attribute / property on `.input-indicator`, to remove the auto-hide / cool effect ;) -->
                      <span class='input-indicator'><span bar></span><span val></span></span>
                  </div>
                  <!-- End of Horizontal Flex-Layout -->

                  <!-- Input Message -->
                  <!-- NOTE: Add `error` class, to make this `.input-message` an error message -->
                  <p class='input-message fade-in error' hidden></p>
                  <!-- End of Input Message -->
              </div>
              
              <!-- Login - Submit Button -->
              <button type="submit" id='loginButton' contained>
                <span class="spinner dots-3"></span>
                <span><?= $this->i18n->getString('login') ?></span>
              </button>
            
            </form>
            <!-- End of Connection Form -->

          </div>
          <!-- End of Container -->

        </div>
        <!-- End of [content] -->

    </div>
    <!-- End of App-Layout of MAIN -->


    <!-- Nav Bar -->
    <!-- PHP: Include the `navBar` component -->
    <?php 
      $_GET['navbar_route'] = 'login'; 
      $_GET['navbar_init'] = $this->user->getInitials(); 
      $_GET['navbar_connected'] = $this->user->isConnected(); // TRUE if the user is connected
      $_GET['navbar_for_admin'] = $this->user->isAdmin(); // TRUE if the user is an admin 

      require __DIR__ . '/components/nav-bar.php';
    ?>
    <!-- End of Nav Bar -->


    <!-- Backdrop of MAIN -->
    <div class='backdrop' fit hidden></div>

    <!-- Menus of MAIN -->
    <div class='menus' fit hidden>

      <!-- Login Menu -->
      <menu data-id="loginMenu" class="menu vertical flex-layout" hidden>

        <!-- Close Menu + Icon Button -->
        <li role="close-menu">
          <button class="icon-button"><span class="material-icons icon">arrow_back_ios</span></button>
        </li>

        <!-- Register - Menu Item -->
        <li title="<?= $this->i18n->getString('register') ?>" class="menu-item">
          <button id="registerMenuItem" data-action="register">
            <span class="material-icons icon">person_add</span>
            <span><?= $this->i18n->getString('register') ?></span>
          </button>
        </li>
        

        <!-- Clear Form - Menu Item -->
        <li title="<?= $this->i18n->getString('clearForm') ?>" class="menu-item">
          <button id="clearFormMenuItem" data-action="clear-form">
            <span class="material-icons icon">clear</span>
            <span><?= $this->i18n->getString('clearForm') ?></span>
          </a>
        </li>

      </menu>
      <!-- End of Likes Menu -->

    </div>
    <!-- End of Menus of MAIN --> 

    <!-- Dialogs of MAIN -->
    <div class='dialogs' fit hidden></div>

    <!-- Toasts of MAIN -->
    <div class='toasts' fit hidden></div>

  </main>
  <!-- End of MAIN -->

  <!-- Aside part -->
  <aside class='flex-layout vertical'>

    <!-- App-Layout of ASIDE -->
    <div class='app-layout' fit>
      <!-- [content] -->
      <div content>

        <!-- [empty] Container -->
        <div class="container vertical flex-layout centered" empty>
          <span class="login-doodle doodle"></span>
        </div>
        <!-- End of [empty] Container -->

      </div>

    </div>

    <!-- Backdrop of ASIDE -->
    <div class='backdrop' fit hidden></div>

    <!-- Menus of ASIDE -->
    <div class='menus' fit hidden></div>

    <!-- Dialogs of ASIDE -->
    <div class='dialogs' fit hidden></div>

    <!-- Toasts of ASIDE -->
    <div class='toasts' fit hidden></div>

    <!-- Vertical Divider -->
    <span class='divider vertical left'></span>

  </aside>

  <!-- Default Backdrop -->
  <div id='backdrop' fit hidden></div>

  <!-- Default Menus -->
  <div id='menus' fit hidden></div>

  <!-- Default Dialogs -->
  <div id='dialogs' fit hidden></div>

  <!-- Default Toasts -->
  <div id='toasts' fit hidden></div>

</body>

</html>
<!-- End of HTML -->
