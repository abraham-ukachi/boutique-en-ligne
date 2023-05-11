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
* @name Cart Page - Maxaboom
* @file cart-page.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> open http://localhost/boutique-en-ligne/cart
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
  <title>Cart - Maxaboom | The #1 online store for all your musical needs</title>


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
  <link rel="stylesheet" href="assets/stylesheets/cart-styles.css">


  <!-- Script -->
  <script>

    // Let's do some stuff when this page loads...
    window.addEventListener('load', (event) => { 
      // ...do something awesome here ;)
    });
    
  </script>
  
  <!-- Some more script for ya! #LOL -->
  <script type="module" src="src/app.js" defer></script>
  <script type="module" src="src/scripts/cart.js" defer></script>
  
</head>
<!-- End of HEAD -->
  
  
<body class="theme <?= $this->theme ?>" fullbleed>

  <!-- Side Bar -->
  <!-- PHP: Include the `sideBar` component -->
  <?php 
    $_GET['sidebar_route'] = 'cart'; 
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
            <h2 class="app-title"><?= $this->i18n->getString('cart')?></span></h2>
            <h3 class="app-subtitle products-count" <?= $totalProducts === 0 ? 'hidden' : '' ?>>
              <?= $totalProducts . ' ' . $this->i18n->getString('products') ?>
            </h3>
          </div>

          <span flex hidden></span>

          <div class="title-wrapper total-price vertical flex-layout">
            <!-- Title -->
            <h2 class="app-title" <?= $totalProducts === 0 ? 'hidden' : '' ?>>
              <?= number_format($totalPrice / 100, 2) . ' €' ?>
            </h2>
          </div>

          <!-- Cart Menu Button -->
          <button id="cartMenuButton" class="icon-button" <?= $totalProducts === 0 ? 'hidden' : '' ?>>
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
        
        <!-- [empty] Container -->
        <div class="container vertical flex-layout centered" empty <?= $totalProducts !== 0 ? 'hidden' : '' ?>>
          <span class="cart-doodle doodle" mask></span>
          <h2><?= $this->i18n->getString('cartEmpty') ?></h2>
          <p><?= $this->i18n->getString('cartEmptyMessage') ?></p>
          <!-- Start Shopping Button -->
          <a href="shop" role="button" tabindex="0" contained><?= $this->i18n->getString('startShopping') ?></a>
        </div>
        <!-- End of [empty] Container -->

        <!-- [list] Container -->
        <div class="container vertical flex-layout" list <?= $totalProducts === 0 ? 'hidden' : '' ?>>

          <!-- Products -->
          <ul id="products" class="vertical flex-layout" data-total="<?= $totalProducts ?>" naked>

            <?php foreach ($products as $product): ?>

            <li tabindex="0" role="product" class="product horizontal flex-layout center" data-id="<?= $product['id'] ?>">

              <div class="product-actions-wrapper horizontal flex-layout center">
                <!-- Delete - Icon Button -->
                <button class="product-action-button delete-btn icon-button">
                  <span class="material-icons icons">delete</span>
                </button>
              </div>

              <div class="product-image-wrapper">
                <img class="product-image" src="assets/images/products/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
              </div>

              <div class="product-info-wrapper vertical flex-layout flex">
                <h3 class="product-name"><?= (strlen($product['name']) > 30) ? substr($product['name'], 0, 30) . '...' : $product['name'] ?></h3>
                <p class="product-price"><?= number_format($product['price'] / 100, 2) ?> €</p>
                <span class="product-quantity txt caption"><?= $this->i18n->getString('qty') . ' : '. $product['quantity'] ?></span>
              </div>

              <div class="product-actions-wrapper horizontal flex-layout center">
                <!-- Quantity - Controls -->
                <div class="product-action-button quantity-controls vertical flex-layout center">
                  <!-- Increase Quantity - Icon Button -->
                  <button class="increase-qty icon-button"
                    data-product-id="<?= $product['id'] ?>">
                    <span class="material-icons icons">add</span>
                  </button>
                  
                  <span class="qty-value"><?= $product['quantity'] ?></span>

                  <!-- Decrease/Reduce Quantity - Icon Button -->
                  <button class="decrease-qty icon-button"
                    data-product-id="<?= $product['id'] ?>">
                    <span class="material-icons icons">remove</span>
                  </button>
                </div>
                <!-- End of Quantity - Controls -->

              </div>
            </li>

            <?php endforeach; ?>

            <!-- Spinner Wrapper -->
            <li class="spinner-wrapper horizontal flex-layout centered">
                <span class="spinner dots-3"></span>
            </li>
            
          </ul>
          <!-- End of Liked Products -->
           
           
        </div>
        <!-- End of [list] Container -->



      </div>
      <!-- End of [content] -->

      
    
    </div>
    <!-- End of App Layout - MAIN -->

    <?php if ($totalProducts > 0): ?> 
    
    <div class="checkout-btn-wrapper vertical flex-layout centered">
      <button id="checkoutButton" contained><?= $this->i18n->getString('checkout') ?></button>
      
      <span class="divider horizontal top"></span>
    </div>

    <?php endif; ?>

    <!-- Nav Bar -->
    <!-- PHP: Include the `navBar` component -->
    <?php 
      $_GET['navbar_route'] = 'cart'; 
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

        <!-- Cart Menu -->
        <menu data-id="cartMenu" class="menu vertical flex-layout" hidden>

            <!-- Close Menu + Icon Button -->
            <li role="close-menu">
                <button class="icon-button"><span class="material-icons icon">arrow_back_ios</span></button>
            </li>

            <!-- Add All to Cart -->
            <li title="<?= $this->i18n->getString('checkoutProducts') ?>" class="menu-item">
              <button data-action="checkout">
                <span class="material-icons icon">shopping_cart_checkout</span>
                <span><?= $this->i18n->getString('checkoutProducts') ?></span>
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
        <!-- End of Cart Menu -->


        <!-- Cart Product Menu -->
        <menu data-id="cartProductMenu" data-product-id="-1" class="menu vertical flex-layout" hidden>

            <!-- Close Menu + Icon Button -->
            <li role="close-menu">
                <button class="icon-button"><span class="material-icons icon">arrow_back_ios</span></button>
            </li>

            <!-- See -->
            <li title="<?= $this->i18n->getString('seeDetails') ?>" class="menu-item">
              <button data-action="see">
                <span class="material-icons icon">info</span>
                <span><?= $this->i18n->getString('seeDetails') ?></span>
              </button>
            </li>
            
            
            <!-- Buy  -->
            <li title="<?= $this->i18n->getString('buy') ?>" class="menu-item">
              <button data-action="buy">
                <span class="material-icons icon">payments</span>
                <span><?= $this->i18n->getString('buy') ?></span>
              </button>
            </li>
            
            <!-- Delete  -->
            <li title="<?= $this->i18n->getString('delete') ?>" class="menu-item">
              <button data-action="delete">
                <span class="material-icons icon">delete_outline</span>
                <span><?= $this->i18n->getString('delete') ?></span>
              </button>
            </li>
        </menu>
        <!-- End of Cart Product Menu -->
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
          <span class="cart-ddd ddd"></span>
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
