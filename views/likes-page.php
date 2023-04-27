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
* @name Likes Page - Maxaboom
* @file likes-page.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> open http://localhost/boutique-en-ligne/likes
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
  <title>Likes - Maxaboom | The #1 online store for all your musical needs</title>


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
  <link rel="stylesheet" href="assets/stylesheets/likes-styles.css">


  <!-- Script -->
  <script>

    // Let's do some stuff when this page loads...
    window.addEventListener('load', (event) => { 
      // ...do something awesome here ;)
    });
    
  </script>
  
  <!-- Some more script for ya! #LOL -->
  <script type="module" src="src/app.js" defer></script>
  <script type="module" src="src/scripts/likes.js" defer></script>
  
</head>
<!-- End of HEAD -->
  
  
<body class="theme <?= $this->theme ?>" fullbleed>

  <!-- Side Bar -->
  <!-- PHP: Include the `sideBar` component -->
  <?php 
    $_GET['sidebar_route'] = 'likes'; 
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

        <!-- App Bar -->
        <div id="appBar" class="app-bar" sticky>

          <!-- Title Wrapper -->
          <div class="title-wrapper vertical flex-layout">
            <!-- Title -->
            <h2 class="app-title"><?= $this->i18n->getString('likes')?></span></h2>
            <h3 class="app-subtitle" <?= $totalLikedProducts === 0 ? 'hidden' : '' ?>>
              <?= $totalLikedProducts . ' ' . $this->i18n->getString('likedProducts') ?>
            </h3>
          </div>

          <span flex></span>

          <!-- Likes Menu Button -->
          <button id="likesMenuButton" class="icon-button">
            <span class="material-icons icons">more_vert</span>
          </button>

        </div>
        <!-- End of App Bar -->

        <!-- Horizontal Divider -->
        <span class="divider horizontal bottom"></span>
      </header>
      <!-- End of Header -->

      <!-- [content] -->
      <div content>

        <!-- PHP (1): If the user is connected ... -->
        <?php if ($this->user->isConnected()): ?>
        <!-- PHP (1): ... then show the following [not-connected] container -->
        
        <!-- [empty] Container -->
        <div class="container vertical flex-layout centered" empty <?= $totalLikedProducts !== 0 ? 'hidden' : '' ?>>
          <span class="likes-doodle doodle" mask></span>
          <h2><?= $this->i18n->getString('emptyList') ?></h2>
          <p><?= $this->i18n->getString('noLikedProductsMessage') ?></p>

        </div>
        <!-- End of [empty] Container -->

        <!-- Container -->
        <div class="container vertical flex-layout" <?= $totalLikedProducts === 0 ? 'hidden' : '' ?>>

          <!-- Liked Products -->
          <ul id="likedProducts">
           <li></li>  
          </ul>
          <!-- End of Liked Products -->

        </div>
        <!-- End of Container -->

        <?php else: ?> <!-- PHP (1): Else, if the user is not connected ... -->
        
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

        <?php endif; ?>
        <!-- PHP (1): End of [not-connected] container -->



      </div>
      <!-- End of [content] -->


    </div>
    <!-- End of App Layout - MAIN -->
    
    <!-- Nav Bar -->
    <!-- PHP: Include the `navBar` component -->
    <?php 
      $_GET['navbar_route'] = 'likes'; 
      $_GET['navbar_init'] = $this->user->getInitials(); 
      $_GET['navbar_connected'] = $this->user->isConnected(); // TRUE if the user is connected
      $_GET['navbar_for_admin'] = $this->user->isAdmin(); // TRUE if the user is an admin 

      require __DIR__ . '/components/nav-bar.php';
    ?>
    <!-- End of Nav Bar -->

    <!-- Backdrop of MAIN -->
    <div class="backdrop" fit hidden></div>
    
    <!-- Menus of MAIN -->
    <div class="menus" fit hidden>

        <!-- Likes Menu -->
        <menu data-id="likesMenu" class="menu vertical flex-layout" hidden>

            <!-- Close Menu + Icon Button -->
            <li role="close-menu">
                <button class="icon-button"><span class="material-icons icon">arrow_back_ios</span></button>
            </li>

            <!-- Add All to Cart -->
            <li title="<?= $this->i18n->getString('addAllToCart') ?>" class="menu-item">
              <button data-action="add-to-cart">
                <span class="material-icons icon">add_shopping_cart</span>
                <span><?= $this->i18n->getString('addAllToCart') ?></span>
              </button>
            </li>


            <!-- Remove All -->
            <li title="<?= $this->i18n->getString('removeAll') ?>" class="menu-item">
              <button data-action="remove-all">
                <span class="material-icons icon">remove_shopping_cart</span>
                <span><?= $this->i18n->getString('removeAll') ?></span>
              </a>
            </li>

        </menu>
        <!-- End of Likes Menu -->


        <!-- Liked Product Menu -->
        <menu data-id="likedProductMenu" class="menu vertical flex-layout" hidden>

            <!-- Close Menu + Icon Button -->
            <li role="close-menu">
                <button class="icon-button"><span class="material-icons icon">arrow_back_ios</span></button>
            </li>

            <!-- See -->
            <li title="<?= $this->i18n->getString('seeDetails') ?>" class="menu-item">
              <button data-action="see">
                <span class="material-icons icon">store</span>
                <span><?= $this->i18n->getString('seeDetails') ?></span>
              </button>
            </li>


            <!-- Buy  -->
            <li title="<?= $this->i18n->getString('buy') ?>" class="menu-item">
              <button data-action="buy">
                <span class="material-icons icon">translate</span>
                <span><?= $this->i18n->getString('buy') ?></span>
              </button>
            </li>


            <!-- Delete  -->
            <li title="<?= $this->i18n->getString('delete') ?>" class="menu-item">
              <button data-action="delete">
                <span class="material-icons icon">translate</span>
                <span><?= $this->i18n->getString('delete') ?></span>
              </button>
            </li>
        </menu>
        <!-- End of Liked Product Menu -->
    </div>
    <!-- End of Menus -->
    
    <!-- Dialogs of MAIN -->
    <div class="dialogs" fit hidden></div>
    
    <!-- Toasts of MAIN -->
    <div class="toasts" fit hidden></div>

  </main>
  <!-- End of MAIN -->

  <!-- ASIDE -->
  <aside class="flex-layout vertical">

    <!-- App-Layout of ASIDE -->
    <div class="app-layout" fit>

      <!-- [content] -->
      <div content>

        <!-- [empty] Container -->
        <div class="container vertical flex-layout centered" empty>
          <span class="likes-ddd ddd"></span>
        </div>
        <!-- End of [empty] Container -->

      </div>

    </div>
    
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
