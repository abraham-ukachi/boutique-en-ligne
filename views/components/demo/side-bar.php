<?php
/**
* @license
* ddd / module-connexion
* Copyright (c) 2022 Abraham Ukachi
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
* @project module-connexion
* @name Nav Bar - PHP Component Demo
* @file nav-bar.php
* @demo components/demo/nav-bar.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> open http://localhost/module-connexion/components/demo/nav-bar.php
* 
*/


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: I'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/

// Define some constant variables
// Types
define('TYPE_VERTICAL', 'vertical');
define('TYPE_HORIZONTAL', 'horizontal');
// Pages
define('PAGE_HOME', 'home');
define('PAGE_DDD', 'ddd');
define('PAGE_PROFILE', 'profil');
define('PAGE_SETTINGS', 'settings');
define('PAGE_ADMIN', 'admin');
// Routes
define('ROUTE_USERS', 'users');
define('ROUTE_DASHBOARD', 'dashboard');
// toggles
define('ACTIVE', 'active');

// get the value of `type` parameter from PHP's global variable - GET
$type = isset($_GET['type']) ?  $_GET['type'] : '';

// get the value of `page` parameter from PHP's global variable - GET
$page = isset($_GET['page']) ?  $_GET['page'] : '';

// get the value of `route` parameter from PHP's global variable - GET
$route = isset($_GET['route']) ?  $_GET['route'] : '';

// get the value of `connected` parameter from PHP's global variable - GET
$connected = isset($_GET['connected']) ?  $_GET['connected'] : 'false';

// get the value of `init` (initials) parameter from PHP's global variable - GET
$init = isset($_GET['init']) ?  $_GET['init'] : 'ab';

// set `navbarResponsive` variable to 'false'
// because we are in DEMO mode ;) #LOL
$navbarResponsive = 'false';

?><!DOCTYPE html>

<!-- HTML -->
<html lang="en">

  <!-- HEAD -->
  <head>
    <!-- Our 4 VIP metas -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="PHP Component Demo of Nav Bar from module-connexion">
    
    <!-- Title -->
    <title>Nav Bar - PHP Component Demo | Abraham Ukachi</title>
     
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Mulish - Font -->
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Material Icons - https://github.com/google/material-design-icons/tree/master/font -->
    <!-- https://material.io/resources/icons/?style=baseline -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
     
    <!-- Base -->
    <base href="../../">

    <!-- Logo - Icon -->
    <link rel="icon" href="assets/images/favicon.ico">

    <!-- See https://goo.gl/OOhYW5 -->
    <link rel="manifest" href="manifest.json">

    <!-- See https://goo.gl/qRE0vM -->
    <meta name="theme-color" content="#A67C52">

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
    <link rel="stylesheet" href="assets/stylesheets/profile-styles.css">

    <!-- Demo Styles -->
    <link rel="stylesheet" href="components/demo/demo-styles.css">
    
    <!-- Animations -->
    <!-- <link rel="stylesheet" href="assets/animations/fade-in-animation.css"> -->
    <!-- <link rel="stylesheet" href="assets/animations/slide-from-down-animation.css"> -->


    <!-- Script -->
    <!-- ^^^^^^ Like previously stated, "A little JS doesn't hurt ;)" -->
    <script>
      /*
       * Once again, I'm well aware that this project doesn't require a script but
       * I couldn't help myself. So.... Bite me twice!! ;)
       */

      // Create `ddd` object variable with a `isReady` key 
      var ddd = { 
        isReady: false,
        onReady: () => {} 
      }; // <- `false` 'cause duh!! We ain't ready yet!! 


      // Let's do some stuff when this page loads...
      // NOTE: This is again, just a simulation!
      window.addEventListener('load', (event) => { 
        // ...get the document as doc
        let doc = event.target;


        // Get the app layout element as `appLayoutEl`
        let appLayoutEl = doc.getElementById('appLayout');


        // if the browser supports it...
        if (typeof(Storage) !== 'undefined') {
          // ...get the theme from local storage as `theme`
          let theme = localStorage.getItem('theme');
          // DEBUG [4dbsmaster]: tell me about it :)
          console.log(`[_progressHandler]: theme => ${theme}`);
         
          // if a theme was found in storage...
          if (typeof(theme) == 'string') {
            // ...remove all the themes in body
            doc.body.classList.remove('classic', 'light', 'dark');
            // update the theme
            doc.body.classList.add(theme);
          }
        
        }


        // ddd is READY!!!
        ddd.isReady = true;

        // call the `onReady` function of `ddd`
        ddd.onReady('demo');
        
        
      });


      /*
       * Toggles the password's visibility of password-input element with the given id.
       *
       * @param { String } id
       */
      let togglePassword = (id) => {
        // get the password input element as `passwordInputEl`
        let passwordInputEl = document.getElementById(id);

        // Do nothing if `passwordInputEl` doesn't exist
        if (!passwordInputEl) { return }
        
        // toggle the `type` of `passwordInputEl` between 'text' and 'password',
        // using our beloved ternary statement :)
        passwordInputEl.type = (passwordInputEl.type == 'password') ? 'text' : 'password';

        // restore the focus of `passwordInputEl`
        passwordInputEl.focus();

        // DEBUG [4dbsmaster]: tell me about it :)
        console.log(`[togglePassword](1): passwordInputEl.type => ${passwordInputEl.type}`);
        console.log(`[togglePassword](2): passwordInputEl => `, passwordInputEl);

      };


      /**
        * Handler that is called whenever the `value` of the given `inputEl` changes 
        * 
        * @param { Element } inputEl
       */
      let handleInputValue = (inputEl) => {
        // Do nothing if there's no inputEl
        if (typeof(inputEl) == 'undefined' || !inputEl) { return }

        // get the value from the input element
        let value = inputEl.value;
        // get the label of this input element using its id
        let labelEl = document.querySelector(`label[for="${inputEl.id}"]`);

        // if the input has some value...
        if (value.length) {
          //...create and attribute named 'has-value'
          // and add it to the given input element (i.e. `inputEl`)
          inputEl.setAttribute('has-value', ''); // <- An empty value should turn our attribute into a 'property'
            
          // HACK: If this input element has an element...
          if (labelEl) {
            // ...set an attribute `raised` to the label element
            labelEl.setAttribute('raised', '');
          }

        } else { // <- no value was found in input
          // So, remove the 'has-value' attribute from `inputEl`
          inputEl.removeAttribute('has-value');

          // HACK: If this input element has an element...
          if (labelEl) {
            // ...remove the attribute `raised` from the label element
            labelEl.removeAttribute('raised');
          }

        }

        // DEBUG [4dbsmaster]: tell me about it :)
        console.log(`[handleInputValue](1): value => ${value}`);
        // console.log(`[handleInputValue](2): inputEl => `, inputEl);

      };


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
    <script src="script/app.js"></script>
    
  </head>
  <!-- End of HEAD -->
  
  
  <!-- BODY | Default Theme: light -->
  <body class="theme light" fullbleed>

    <!-- App Layout -->
    <div id="appLayout" class="flex-layout horizontal" fit>
      

      <!-- PHP: Include the vertical `nav-bar` component here -->
      <?php include 'components/nav-bar.php?type=vertical'; ?>

      <!-- MAIN - App Layout -->
      <main class="flex-layout vertical">

        <!-- App Header -->
        <div id="appHeader">

          <!-- App Bar -->
          <div id="appBar" class="app-bar">

            <!-- App Icon -->
            <a href="" title="Go to Home Page">
              <button id="returnIconButton" class="icon-button">
                <span class="app-logo"></span>
              </button>
            </a>

            
            <!-- Title Wrapper -->
            <div class="title-wrapper">   
              <!-- App Title -->
              <h2 id="appTitle" class="app-title">PHP Component Demo</h2>
              <!-- App Subtitle -->
              <h3 id="appSubtitle" class="app-subtitle">nav-bar &bull; module-connexion</h3> 
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
          <!-- End of App Bar -->



        </div>
        <!-- End of App Header -->

        <!-- Content - App Layout -->
        <div id="content" class="vertical flex-layout centered">

          <!-- PHP: Require / Include the `nav-bar` component here -->
          
          <?php define('__BASE__', '../../'); ?>
          
          <?php
            $_GET['navbar_type'] = $type;
            $_GET['navbar_page'] = $page;
            $_GET['navbar_route'] = $route;
            $_GET['navbar_init'] = $init;
            $_GET['navbar_connected'] = $connected;
            $_GET['navbar_res'] = $navbarResponsive;
          ?>
          
          <?php include __BASE__ . "components/nav-bar.php"; ?>
           
        </div>
        <!-- End of Content - App Layout -->

        
      </main>
      <!-- End of MAIN - App Layout -->

      <!-- Details Container | ASIDE -->
      <aside id="detailsContainer" class="vertical flex-layout centered">

        <!-- Controls - SECTION -->
        <section class="controls">
          <!-- Types Controls -->
          <div id="typesControl" class="control">
            <h4>Types</h4>
            <!-- Control Buttons -->
            <div class="control-buttons">
              <!-- Vertical -->
              <button onclick="updateSearch('type', 'vertical')" <?php echo ($type === TYPE_VERTICAL) ? ACTIVE : '' ; ?>>
                <span>Vertical</span>
              </button>

              <!-- Horizontal -->
              <button onclick="updateSearch('type', 'horizontal')" <?php echo ($type === TYPE_HORIZONTAL) ? ACTIVE : '' ; ?>>
               <span>Horizontal</span> 
              </button>
            </div>
            <!-- End of Control Buttons -->
          </div>
          <!-- End of Types Controls -->

          <!-- Pages Controls -->
          <div id="pagesControl" class="control">
            <h4>Pages</h4>
            <!-- Control Buttons -->
            <div class="control-buttons">
              <!-- Home - Page - Button -->
              <button onclick="updateSearch('page', 'home')" <?php echo ($page === PAGE_HOME) ? ACTIVE : '' ; ?>>
                <span>Home</span>
              </button>


              <!-- DDD - Page - Button -->
              <button onclick="updateSearch('page', 'ddd')" <?php echo ($page === PAGE_DDD) ? ACTIVE : '' ; ?>>
               <span>DDD</span> 
              </button>

              <!-- Profil - Page - Button -->
              <button onclick="updateSearch('page', 'profil')" <?php echo ($page === PAGE_PROFILE) ? ACTIVE : '' ; ?>>
               <span>Profil</span> 
              </button>


              <!-- Settings - Page - Button -->
              <button onclick="updateSearch('page', 'settings')" <?php echo ($page === PAGE_SETTINGS) ? ACTIVE : '' ; ?>>
               <span>Settings</span> 
              </button>


              <!-- Admin - Page - Button -->
              <button onclick="updateSearch('page', 'admin')" <?php echo ($page === PAGE_ADMIN) ? ACTIVE : '' ; ?>>
               <span>Admin</span> 
              </button>

            </div>
            <!-- End of Control Buttons -->
          </div>
          <!-- End of Pages Controls -->

          <!-- Routes Controls -->
          <div id="routesControl" class="control">
            <h4>Routes</h4>
            <!-- Control Buttons -->
            <div class="control-buttons">
              <!-- Users - Route - Button -->
              <button onclick="updateSearch('route', 'users')" <?php echo ($route === ROUTE_USERS) ? ACTIVE : '' ; ?>>
                <span>Users</span>
              </button>


              <!-- Dashboard - Route - Button -->
              <button onclick="updateSearch('route', 'dashboard')" <?php echo ($route === ROUTE_DASHBOARD) ? ACTIVE : '' ; ?>>
               <span>Dashboard</span> 
              </button>

            </div>
            <!-- End of Control Buttons -->
          </div>
          <!-- End of Route Controls -->


          <!-- Connected Controls -->
          <div id="connectedControl" class="control">
            <h4>Connected</h4>
            <!-- Control Buttons -->
            <div class="control-buttons">
              <!-- Home - Page - Button -->
              <button onclick="updateSearch('connected', 'true')" <?php echo ($connected === 'true') ? ACTIVE : '' ; ?>>
                <span>TRUE</span>
              </button>

              <!-- Profil - Page - Button -->
              <button onclick="updateSearch('connected', 'false')" <?php echo ($connected === 'false') ? ACTIVE : '' ; ?>>
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
              <button onclick="updateSearch('init', 'ab')" <?php echo ($init === 'ab') ? ACTIVE : '' ; ?>>
                <span>A&nbsp;B</span>
              </button>

              <!-- RM - Initials - Button -->
              <button onclick="updateSearch('init', 'rm')" <?php echo ($init === 'rm') ? ACTIVE : '' ; ?>>
               <span>R&nbsp;M</span> 
              </button>

            </div>
            <!-- End of Control Buttons -->
          </div>
          <!-- End of Pages Controls -->

        </section>
        <!-- End of Controls - SECTION -->

        <!-- Divider @ Vertical Left -->
        <span class="divider vertical left"></span>
      </aside>
      <!-- Details Container | ASIDE -->

    </div>
    <!-- End of App Layout -->


    <!-- Backdrop -->
    <div id="backdrop" hidden></div>


    <!-- Dialogs Container -->
    <div id="dialogsContainer" hidden></div>
    <!-- End of Dialogs Container -->


    <!-- Toast -->
    <div id="toast" hidden></div>
    <!-- End of Toast -->

  </body>
  <!-- End of BODY -->

</html>
<!-- End of HTML -->
