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
* @name Home Page - Maxaboom
* @file home-page.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> open http://localhost/boutique-en-ligne/index.php
* 
*
* ============================
*     >>> DESCRIPTION <<<
* ~~~~~~~~ (French) ~~~~~~~~~
* 
* -  Votre entreprise décide de mettre en place une boutique en ligne (Thème et produits au choix).
*
* ~~~~~~~~ (English) ~~~~~~~~~
* 
* - Your company decides to set up an online shop (Choose your theme and products).
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
    
<!-- HTML -->
<html lang="<?= $this->lang ?>">

<!-- HEAD -->
<head>
  <!-- Our 4 VIP metas -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=no">
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
  <link rel="stylesheet" href="assets/stylesheets/home-styles.css">


  <!-- Script -->
  <script>

    // Let's do some stuff when this page loads...
    window.addEventListener('load', (event) => { 
      // ...do something awesome here ;)
    });
    
  </script>
  
  <!-- Some more script for ya! #LOL -->
  <script type="module" src="src/app.js" defer></script>
  <script type="module" src="src/scripts/home.js" defer></script>
  
</head>
<!-- End of HEAD -->
  
  
<body class="theme <?= $this->theme ?>" fullbleed>

  <!-- Side Bar -->
  <!-- PHP: Include the `sideBar` component -->
  <?php 
    $_GET['sidebar_route'] = 'home'; 
    $_GET['sidebar_init'] = $this->user->getInitials(); 
    $_GET['sidebar_connected'] = $this->user->isConnected(); // TRUE if the user is connected
    $_GET['sidebar_for_admin'] = $this->user->isAdmin(); // TRUE if the user is an admin 

    require __DIR__ . '/components/side-bar.php';
  ?>
  <!-- End of Side Bar -->

  <!-- MAIN -->
  <main class="flex-layout vertical">

    <!-- App-Layout of MAIN -->
    <div class="app-layout" fit>
      <!-- Header -->
      <header>

        <!-- First App Bar -->
        <div class="app-bar">

          <!-- PHP (0): If the user is connected... -->
          <?php if ($this->user->isConnected()): ?>
          <!-- ...display his/her initials / profile icon-button  -->
          <a href="account/info" role="icon-button" tabindex="0" class="icon-button" narrow-only>
            <span class="user-initials"><?= $this->user->getInitials() ?></span>
          </a>
          
          <?php else: ?><!-- Else|PHP (0) : user is not connected -->
           
          <!-- ...show the login icon-button with persion material icon  -->
          <a href="login" role="icon-button" tabindex="0" class="icon-button profile">
            <span class="material-icons icon">person</span>
          </a>
            
          <?php endif; ?>
          <!-- End of PHP (0) -->

          <span flex></span>


          <!-- Search Icon Button -->
          <a href="search" role="icon-button" tabindex="0" class="icon-button">
            <span class="material-icons icon">search</span>
          </a>

          <!-- More Icon Button -->
          <button id="moreIconButton" role="icon-button" class="icon-button">
            <span class="material-icons icon">more_vert</span>
          </button>

        </div>
        <!-- End of First App Bar -->


        <!-- Hello Bar -->
        <div id="helloBar" class="app-bar">

          <!-- Title Wrapper -->
          <div class="title-wrapper vertical flex-layout centered">
            <!-- Title -->
            <h2 class="app-title">
              <span><?= $this->i18n->getString('gm')?></span> 

              <!-- PHP (1): if the user is connected... -->
              <?php if ($this->user->isConnected()): ?>
              <!-- ...PHP (1): display the user's first name -->

              <span>, <?= $this->user->getFirstname() ?></span>

              <?php endif; ?>
              <!-- End of PHP (1) -->

            </h2>
            <h3 class="app-subtitle"><?= $this->i18n->getString('greeting') ?></h3>
          </div>
        </div>
        <!-- End of Hello Bar -->

        <!-- [sticky] Search Bar -->
        <div id="searchBar" class="app-bar" hidden >

          <!-- Input-Wrapper -->
          <div class="input-wrapper horizontal flex-layout flex center">
            <!-- Icon -->
            <span class="material-icons icon">search</span>
            <!-- Search Input -->
            <input id="searchInput" type="text" class="search-input" 
              placeholder="<?= $this->i18n->getString('searchProducts') ?>">
          </div>
          <!-- End of Input-Wrapper -->

        </div>
        <!-- End of Search Bar -->
        <!-- Horizontal Divider -->
        <span class="divider horizontal bottom" hidden></span>
      </header>
      <!-- End of Header -->

      <!-- [content] -->
      <div content>

        <!-- Container -->
        <div class="container vertical flex-layout">

          <!-- Hero - Section -->
          <section hero>

              <!-- Hero Text Container -->
              <div class="hero-text-container">
                <h1 class="hero-title"><?= $this->i18n->getString('heroTitle') ?></h1>
                <p class="hero-subtitle"><?= $this->i18n->getString('heroSubtitle') ?></p>
                
                <!-- Call To Action Buttons -->
                <div class="call-to-action-buttons horizontal flex-layout">
                  <!-- Shop Now - Call To Action Button -->
                  <button id="shopNowButton" class="call-to-action-button" contained>
                    <span><?= $this->i18n->getString('shopNow') ?></span>
                  </button>
                  
                  <!-- Explore More - Call To Action Button -->
                  <button id="exploreMoreButton" class="call-to-action-button" outlined>
                    <span><?= $this->i18n->getString('exploreMore') ?></span>
                  </button>
                </div>
                <!-- End of Call To Action Buttons -->

              </div>
              <!-- End of Hero Text Container -->

              <!-- Hero Product Container -->
              <div class="hero-product-container">
                <div class="hero-product"></div> 
              </div>
              <!-- End of Hero Product Container -->

          </section>
          <!-- End of Hero - Section -->

          
          <!-- Steps - Section -->
          <section steps></section>
          <!-- End of Steps - Section -->


          <!-- Categories - Section -->
          <section categories></section>
          <!-- End of Categories - Section -->


          <!-- Products - Section -->
          <section products></section>
          <!-- End of Products - Section -->

        </div>
        <!-- End of Container -->

      </div>
    </div>
    
    <!-- Nav Bar -->
    <!-- PHP: Include the `navBar` component -->
    <?php 
      $_GET['navbar_route'] = 'home'; 
      $_GET['navbar_init'] = $this->user->getInitials(); 
      $_GET['navbar_connected'] = $this->user->isConnected(); // TRUE if the user is connected
      $_GET['navbar_for_admin'] = $this->user->isAdmin(); // TRUE if the user is an admin 

      require __DIR__ . '/components/nav-bar.php';
    ?>
    <!-- End of Nav Bar -->

    <!-- Backdrop of MAIN -->
    <div class="backdrop" fit hidden></div>
    
    <!-- Menus of MAIN -->
    <div class="menus" fit hidden></div>
    
    <!-- Dialogs of MAIN -->
    <div class="dialogs" fit hidden></div>
    
    <!-- Toasts of MAIN -->
    <div class="toasts" fit hidden></div>

  </main>
  <!-- End of MAIN -->

  <!-- ASIDE -->
  <aside class="flex-layout vertical" hidden>

    <!-- App-Layout of ASIDE -->
    <div class="app-layout" fit hidden>...</div>
    
    <!-- Backdrop of ASIDE -->
    <div class="backdrop" fit hidden></div>
    
    <!-- Menus of ASIDE -->
    <div class="menus" fit hidden></div>
    
    <!-- Dialogs of ASIDE -->
    <div class="dialogs" fit hidden></div>
    
    <!-- Toasts of ASIDE -->
    <div class="toasts" fit hidden></div>

    <!-- Vertical Divider -->
    <span class="divider vertical left"></span>
  </aside>
  <!-- End of ASIDE -->


  <!-- Default Backdrop -->
  <div id="backdrop" fit hidden></div>

  <!-- Default Menus -->
  <div id="menus" fit hidden></div>

  <!-- Default Dialogs -->
  <div id="dialogs" fit hidden></div>

  <!-- Default Toasts -->
  <div id="toasts" fit hidden></div>

</body>

</html>
<!-- End of HTML -->
