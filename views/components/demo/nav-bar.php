<?php
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
* @name Nav Bar - PHP Component Demo
* @file nav-bar.php
* @demo components/demo/nav-bar.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> open http://localhost/boutique-en-ligne/component/demo/nav-bar 
*/


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: I'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/

// Define some constant variables
// Pages
define('ROUTE_HOME', 'home');
define('ROUTE_LIKES', 'likes');
define('ROUTE_CART', 'cart');
define('ROUTE_ACCOUNT', 'account');

define('ROUTE_DASHBOARD', 'dashboard');
define('ROUTE_USERS', 'users');
define('ROUTE_PRODUCTS', 'products');

// toggles
define('ACTIVE', 'active');



// get the value of `route` parameter from PHP's global variable - GET
$route = $_GET['route'] ?? '';


// get the value of `init` parameter from PHP's global variable - GET
$init = $_GET['init'] ?? '';

// get the value of `connected` parameter from PHP's global variable - GET
$connected = isset($_GET['connected']) ? filter_var($_GET['connected'], FILTER_VALIDATE_BOOLEAN) : false;

// get the value of `forAdmin` parameter from PHP's global variable - GET
$forAdmin = isset($_GET['for_admin']) ? filter_var($_GET['for_admin'], FILTER_VALIDATE_BOOLEAN) : false;

// get the value of `cartTotal` parameter from PHP's global variable - GET
$cartTotal = isset($_GET['cart_total']) ? intval($_GET['cart_total']) : 0;

// DEBUG [4dbsmaster]: tell me about it ;)
// echo "route: $route" . PHP_EOL;
// echo "connected: " . json_encode($connected) . PHP_EOL;

?><!DOCTYPE html>

<!-- HTML -->
<html lang="en">

  <!-- HEAD -->
  <head>
    <!-- Our 4 VIP metas -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="PHP Component Demo of Nav Bar - Maxaboom">
    
    <!-- Title -->
    <title>Nav Bar - PHP Component Demo | Maxaboom</title>
     
    
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
    <meta name="application-name" content="ddd">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="ddd">

    <!-- Homescreen icons -->
    <link rel="apple-touch-icon" href="assets/images/manifest/icon-48x48.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/images/manifest/icon-72x72.png">
    <link rel="apple-touch-icon" sizes="96x96" href="assets/images/manifest/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/images/manifest/icon-144x144.png">
    <link rel="apple-touch-icon" sizes="192x192" href="assets/images/manifest/icon-192x192.png">



    <!-- Theme -->
    <!-- TODO: Rename `styles.css` to `style.css` -->
    <link rel="stylesheet" href="assets/theme/color.css">
    <link rel="stylesheet" href="assets/theme/typography.css">
    <link rel="stylesheet" href="assets/theme/styles.css">
    
    <!-- Stylesheet -->
    <!-- <link rel="stylesheet" href="assets/stylesheets/profile-styles.css"> -->

    <!-- Demo Styles -->
    <link rel="stylesheet" href="views/components/demo/demo-styles.css">
    


    <!-- Script -->
    <script>

      // Let's do some stuff when this page loads...
      // NOTE: This is again, just a simulation!
      window.addEventListener('load', (event) => { 
        // ...get the document as doc
        let doc = event.target; 
        
      });



      /**
        * Method used to update the browser's URL search parameters with the given `key` and `value` 
        *
        * @param string $key
        * @param string $value
       */
      let updateSearch = (key, value) => {
        // NOTE: Since 2022, the URLSearchParams is now supported by all modern browsers
        //       (https://developer.mozilla.org/en-US/docs/Web/API/URLSearchParams#Browser_compatibility)
        //
        // So, we are gonna be using `URLSearchParams` to update our search
        
        // Create an object of `URLSearchParams` as `searchParams` w/ the current search parameters in `window`
        let searchParams = new URLSearchParams(window.location.search);
        // Setup the key/value data of `searchParams`
        searchParams.set(key, value);
        // Reload / refresh the page with the given `key` & `value` by setting 
        // the stringified `searchParams` to `location.search`
        location.search = searchParams.toString();
      };
      
    </script>
    
    <!-- Double Psych!!! Some more script for ya! #LOL -->
    <!-- <script src="script/app.js"></script> -->
    
  </head>
  <!-- End of HEAD -->
  
  
  <!-- BODY | Default Theme: light -->
  <body class="theme dark" fullbleed>
    <!-- MAIN -->
    <main class="flex-layout vertical">
      
      <!-- App-layout of MAIN -->
      <div class="app-layout">

        <!-- Header of App-Layout -->
        <header>
          <div class="app-bar">
            <!-- App Icon -->
            <a href="" title="Go to Home Page">
              <button id="returnIconButton" class="icon-button">
                <span class="app-logo"></span>
              </button>
            </a>

            
            <!-- Title Wrapper -->
            <div class="title-wrapper">   
              <!-- App Title -->
              <h2 id="appTitle" class="app-title">Nav Bar - Component Demo</h2>
              <!-- App Subtitle -->
              <h3 id="appSubtitle" class="app-subtitle">maxaboom &bull; boutique-en-ligne</h3> 
            </div>
            <!-- End of Title Wrapper -->
            
            <!-- <span flex></span> -->
            
            <!-- Menu - Icon Button -->
            <button id="menuIconButton" class="icon-button">
              <span class="material-icons icon">more_vert</span>
            </button>
            <!-- End of Edit - Icon Button -->
            
            <!-- Horizontal Divider -->
            <span class="divider horizontal bottom"></span>
          </div>
        </header>
        <!-- End of Header of App-Layout -->

        <!-- [content] of App Layout -->
        <div content class="vertical flex-layout centered">

          <!-- PHP: Require / Include the `nav-bar` component here -->
          
          <?php
            
            //define('__BASE__', '/component/');

            $_GET['navbar_route'] = $route;
            $_GET['navbar_init'] = $init;
            $_GET['navbar_connected'] = $connected;
            $_GET['navbar_for_admin'] = $forAdmin;
          ?>
          
          <?php require __DIR__ . "/../nav-bar.php"; ?>
           
        </div>
        <!-- End of Content - App Layout -->

      </div>
      <!-- End of App-Layout of MAIN -->

      
    </main>
    <!-- End of MAIN -->

    <!-- Details Container | ASIDE -->
    <aside id="detailsContainer" class="vertical flex-layout centered">

      <!-- Controls - SECTION -->
      <section class="controls">

        <!-- Routes Controls -->
        <div id="routesControl" class="control">
          <h4>Default Routes</h4>
          <!-- Control Buttons -->
          <div class="control-buttons">
            <!-- Home - Route - Button -->
            <button onclick="updateSearch('route', 'home')" <?= ($route === ROUTE_HOME) ? ACTIVE : '' ; ?>>
              <span>Home</span>
            </button>

            <!-- Likes - Route - Button -->
            <button onclick="updateSearch('route', 'likes')" <?= ($route === ROUTE_LIKES) ? ACTIVE : '' ; ?>>
              <span>Likes</span>
            </button>

            <!-- Cart - Route - Button -->
            <button onclick="updateSearch('route', 'cart')" <?= ($route === ROUTE_CART) ? ACTIVE : '' ; ?>>
              <span>Cart</span>
            </button>

            <!-- Account - Route - Button -->
            <button onclick="updateSearch('route', 'account')" <?= ($route === ROUTE_ACCOUNT) ? ACTIVE : '' ; ?>>
              <span>Account</span>
            </button>
            
          </div>
          <!-- End of Control Buttons -->
        </div>
        <!-- End of Routes Controls -->



        <!-- Admin Routes Controls -->
        <div id="adminRoutesControl" class="control">
          <h4>Admin Routes</h4>
          <!-- Control Buttons -->
          <div class="control-buttons">
            <!-- Dashboard - Route - Button -->
            <button onclick="updateSearch('route', 'dashboard')" <?= ($route === ROUTE_DASHBOARD) ? ACTIVE : '' ; ?>>
              <span>Dashboard</span>
            </button>

            <!-- Users - Route - Button -->
            <button onclick="updateSearch('route', 'users')" <?= ($route === ROUTE_USERS) ? ACTIVE : '' ; ?>>
              <span>Users</span>
            </button>

            <!-- Products - Route - Button -->
            <button onclick="updateSearch('route', 'products')" <?= ($route === ROUTE_PRODUCTS) ? ACTIVE : '' ; ?>>
              <span>Products</span>
            </button>

            <!-- Account - Route - Button -->
            <button onclick="updateSearch('route', 'account')" <?= ($route === ROUTE_ACCOUNT) ? ACTIVE : '' ; ?>>
              <span>Account</span>
            </button>
            
          </div>
          <!-- End of Control Buttons -->
        </div>
        <!-- End of Admin Routes Controls -->



        <!-- Connected Controls -->
        <div id="connectedControl" class="control">
          <h4>Connected</h4>
          <!-- Control Buttons -->
          <div class="control-buttons">
            <!-- Home - Page - Button -->
            <button onclick="updateSearch('connected', true)" <?= ($connected) ? ACTIVE : '' ; ?>>
              <span>TRUE</span>
            </button>

            <!-- Profil - Page - Button -->
            <button onclick="updateSearch('connected', false)" <?= (!$connected) ? ACTIVE : '' ; ?>>
             <span>FALSE</span> 
            </button>


          </div>
          <!-- End of Control Buttons -->
        </div>
        <!-- End of Connected Controls -->



        <!-- For Admin Controls -->
        <div id="forAdminControl" class="control">
          <h4>For Admin</h4>
          <!-- Control Buttons -->
          <div class="control-buttons">
            <!-- Home - Page - Button -->
            <button onclick="updateSearch('for_admin', true)" <?= ($forAdmin) ? ACTIVE : '' ; ?>>
              <span>TRUE</span>
            </button>

            <!-- Profil - Page - Button -->
            <button onclick="updateSearch('for_admin', false)" <?= (!$forAdmin) ? ACTIVE : '' ; ?>>
             <span>FALSE</span> 
            </button>


          </div>
          <!-- End of Control Buttons -->
        </div>
        <!-- End of Connected Controls -->

        <!-- Initials Controls -->
        <div id="initialsControl" class="control">
          <h4>Initials</h4>
          <!-- Control Buttons -->
          <div class="control-buttons">
            <!-- AB - Initials - Button -->
            <button onclick="updateSearch('init', 'ab')" <?= ($init === 'ab') ? ACTIVE : '' ; ?>>
              <span>A&nbsp;B</span>
            </button>

            <!-- AX - Initials - Button -->
            <button onclick="updateSearch('init', 'ax')" <?= ($init === 'ax') ? ACTIVE : '' ; ?>>
             <span>A&nbsp;X</span> 
            </button>

            <!-- MOMO - Initials - Button -->
            <button onclick="updateSearch('init', 'mo')" <?= ($init === 'mo') ? ACTIVE : '' ; ?>>
             <span>M&nbsp;O&nbsp;</span> 
            </button>

            <!-- CAT - Initials - Button -->
            <button onclick="updateSearch('init', 'ct')" <?= ($init === 'ct') ? ACTIVE : '' ; ?>>
             <span>C&nbsp;T&nbsp;</span> 
            </button>
          </div>
          <!-- End of Control Buttons -->
        </div>
        <!-- End of Initials Controls -->


        <!-- Cart Total Controls -->
        <div id="CartTotalControl" class="control">
          <h4>Cart Total</h4>
          <!-- Control Buttons -->
          <div class="control-buttons">
            <!-- 0 -->
            <button onclick="updateSearch('cart_total', '0')" <?= ($cartTotal == 0) ? ACTIVE : '' ; ?>>
              <span>0</span>
            </button>

            <!-- 5 -->
            <button onclick="updateSearch('cart_total', '5')" <?= ($cartTotal == 5) ? ACTIVE : '' ; ?>>
             <span>5</span> 
            </button>

            <!-- 10 -->
            <button onclick="updateSearch('cart_total', '10')" <?= ($cartTotal == 10) ? ACTIVE : '' ; ?>>
             <span>10</span> 
            </button>

            <!-- 15 -->
            <button onclick="updateSearch('cart_total', '15')" <?= ($cartTotal == 15) ? ACTIVE : '' ; ?>>
             <span>15</span> 
            </button>
          </div>
          <!-- End of Control Buttons -->
        </div>
        <!-- End of Cart Total Controls -->


      </section>
      <!-- End of Controls - SECTION -->

      <!-- Divider @ Vertical Left -->
      <span class="divider vertical left"></span>
    </aside>
    <!-- Details Container | ASIDE -->
  

    <!-- Backdrop -->
    <div id="backdrop" hidden></div>


    <!-- Dialogs -->
    <div id="dialogs" hidden></div>
    <!-- End of Dialogs -->


    <!-- Toast -->
    <div id="toast" hidden></div>
    <!-- End of Toast -->

  </body>
  <!-- End of BODY -->

</html>
<!-- End of HTML -->
