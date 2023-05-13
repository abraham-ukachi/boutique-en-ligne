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
          <a href="login" role="icon-button" tabindex="0" class="icon-button profile" narrow-only>
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
              <span><?= $this->getCurrentGreeting()?></span> 

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
              <div class="hero-text-container vertical flex-layout center">
                <h1 class="hero-title"><?= sprintf($this->i18n->getString('discoverYour_s'), "<span>" . $this->i18n->getString('perfectMusicalInstrument') . "</span>") ?></h1>
                <p class="hero-subtitle"><?= $this->i18n->getString('heroSubtitle') ?></p>
                
                <!-- Call To Action Buttons -->
                <div class="call-to-action-buttons">
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

              <!-- Hero Products Container -->
              <div class="hero-products-container vertical flex-layout centered">
                <!-- Hero Products -->
                <div class="hero-products vertical flex-layout" fit>

                  <!-- PHP (2): For each hero product in the randomly generated `$heroProducts` array... -->
                  <?php foreach ($heroProducts as $heroProductIndex => $heroProduct): ?>
                  <!-- ...PHP (2): display the hero product -->

                  <!-- Hero Product --> 
                  <a href="product/<?= $heroProduct['id'] ?>" target="_blank" data-product-id="<?= $heroProduct['id'] ?>" class="hero-product fade-in vertical flex-layout centered" fit <?= $heroProductIndex === 0 ? 'active' : ''?>>
                    <!-- Hero Product Image -->
                    <img class="hero-product-image"
                      src="assets/images/products/<?= $heroProduct['image'] ?>" 
                      alt="Hero Product Image"
                      title="<?= $heroProduct['name'] ?>"
                      >

                    <!-- Price Tag -->
                    <div class="hero-price-tag pop-in horizontal flex-layout">
                      <div details class="vertical flex-layout flex">
                        <span class="hero-product-name"><?= $heroProduct['name'] ?></span>
                        <span class="hero-price-tag-value"><?= number_format($heroProduct['price'] / 100, 2) ?> €</span>
                      </div>

                      <div icon class="vertical flex-layout centered">
                        <span class="divider vertical left"></span>
                        <span class="material-icons icon">shopping_bag</span>
                      </div>

                    </div>
                  </a>
                  <!-- End of Hero Product -->

                  <?php endforeach; ?>
                  <!-- End of PHP (2) -->


                </div>
                <!-- End of Hero Products -->
                
                <!-- Hero Products Dots -->
                <div class="hero-products-dots dots-container horizontal flex-layout centered">

                  <!-- PHP (3): For each hero product in the randomly generated `$heroProducts` array... -->
                  <?php foreach ($heroProducts as $heroProductIndex => $heroProduct): ?>
                  <!-- ...PHP (3): display the corresponding hero dot -->

                  <span data-product-id="<?= $heroProduct['id'] ?>" 
                    class="dot" role="dot" 
                    tabindex="<?= $heroProductIndex ?>" 
                    title="<?= $heroProduct['name'] ?>" <?= ($heroProductIndex === 0) ? 'active' : '' ?>
                    >
                  </span>

                  <?php endforeach; ?>
                  <!-- End of PHP (3) -->

                </div>
                <!-- End of Hero Products Dots -->

              </div>
              <!-- End of Hero Products Container -->

          </section>
          <!-- End of Hero - Section -->

          
          <!-- Steps - Section -->
          <section steps class="vertical flex-layout center">
            <!-- Steps Container -->
            <ul class="steps-container horizontal flex-layout" naked>

              <!-- PHP (4): For each step in `$steps` array... -->
              <?php foreach ($steps as $step): ?>
              <!-- ...PHP (4): display the corresponding step -->
              <li class="step <?= $step['id'] ?> vertical flex-layout">
                <span class="step-icon <?= $step['id'] ?>"></span>
                <h3 class="step-title"><?= $step['title'] ?></h3>
                <p class="step-description"><?= $step['description'] ?></p>
              </li>

              <?php endforeach; ?>
              <!-- End of PHP (4) -->

            </ul>
            <!-- End of Steps Container -->
          </section>
          <!-- End of Steps - Section -->


          <!-- Top-Categories - Section -->
          <section id="topCategories" top-categories>
            <h2><?= $this->i18n->getString('ourTopCategories') ?></h2>

            <div class="top-categories-container horizontal flex-layout">

              <!-- PHP (5): For each topCategory in `$topCategories` array... -->
              <?php foreach ($topCategories as $topCategory): ?>
              <!-- ...PHP (5): display the corresponding category -->
              
              <!-- Top Category -->
              <a href="shop/<?= $topCategory['name'] ?>" target="_blank"
              class="top-category vertical flex-layout centered" 
              title="<?= $this->i18n->getString($topCategory['name'], $topCategory['title']) ?>"
              >
                <!-- Category Icon -->
                <span class="top-category-icon vertical flex-layout centered <?= $topCategory['name'] ?>"></span>
                
                <!-- Category Name -->
                <span class="top-category-name"><?= $this->i18n->getString($topCategory['name'], $topCategory['title']) ?></span>
              </a>
              <!-- End of Category -->

              <?php endforeach; ?>
              <!-- End of PHP (5) -->

            </div>
            <!-- End of Top Categories Container -->

          </section>
          <!-- End of Top-Categories - Section -->


          <!-- Latest Products - Section -->
          <section id="latestProducts" latest-products>
            <h2 class="flex-layout center">
              <span><?= $this->i18n->getString('latestProducts') ?></span>
              <span flex></span>
              <a href="category/latest" role="icon-button" tabindex="0">
                <span class="material-icons icon">arrow_forward</span>
              </a>
            </h2>

            <ul class="products vertical flex-layout" naked>

              <!-- PHP (6): For each product in `$latestProducts` array... -->
              <?php foreach ($latestProducts as $product): ?>
              <!-- ...PHP (6): display the corresponding product -->

              <!-- Product Wrapper -->
              <li class="product-wrapper vertical flex-layout">

                <!-- Product  -->
                <div tabindex="0" class="product vertical flex-layout"
                  data-product-id="<?= $product['id'] ?>"
                  title="<?= $product['name']?>">

                  <!-- Product Image -->
                  <div class="product-image-container vertical flex-layout centered">
                    <img class="product-image" 
                      src="assets/images/products/<?= $product['image'] ?>" 
                      alt="Product Image">

                    <!-- Like Button -->
                    <button class="like-btn vertical flex-layout centered" naked 
                      data-product-id="<?= $product['id'] ?>"
                      title="<?= $this->i18n->getString('addToLikes') ?>"
                      >
                      <span class="material-icons icon">favorite_border</span>
                    </button>
                    <!-- End of Like Button -->
                  </div>
                  <!-- End of Product Image -->


                  <!-- Product Details -->
                  <div class="product-details-container vertical flex-layout">
                    <!-- Rating -->
                    <div class="rating-container horizontal flex-layout center">
                      <span class="material-icons icon">star</span>
                      <span class="rating-count"><?= $product['avg_rating'] ?? $this::DEFAULT_AVG_RATING ?></span>
                      <span class="rating-total">&nbsp;(<?= $product['nb_comments'] ?? $this::DEFAULT_NB_COMMENTS ?>)</span>
                    </div>

                    <!-- Product Name -->
                    <div class="product-name"><?= $product['name'] ?></div>

                    <!-- Product Price -->
                    <div class="product-price"><?= number_format($product['price'] / 100, 2) ?> €</div>

                    <!-- Add to Cart Button -->
                    <button class="add-to-cart-btn horizontal flex-layout centered" contained expands shrinks 
                      data-product-id="<?= $product['id'] ?>"
                      title="<?= $this->i18n->getString('addToCart') ?>"
                      >
                      <span class="material-icons icon">add</span>
                    </button>
                    

                  </div>
                  <!-- End of Product Details -->

                </div>
                <!-- End of Product -->

              </li>
              <!-- End of Product Wrapper -->

              <?php endforeach; ?>
              <!-- End of PHP (6) -->

            </ul>

            <!-- Background of Products Section -->
            <span class="background"></span>

          </section>
          <!-- End of Latest Products - Section -->



          <!-- Popular Products - Section -->
          <section id="popularProducts" popular-products>
            <h2 class="flex-layout center">
              <span><?= $this->i18n->getString('popularProducts') ?></span>
              <span flex></span>
              <a href="category/popular" role="icon-button" tabindex="0">
                <span class="material-icons icon">arrow_forward</span>
              </a>
            </h2>

            <ul class="products vertical flex-layout" naked>

              <!-- PHP (6): For each product in `$popularProducts` array... -->
              <?php foreach ($popularProducts as $product): ?>
              <!-- ...PHP (6): display the corresponding product -->

              <!-- Product Wrapper -->
              <li class="product-wrapper vertical flex-layout">

                <!-- Product  -->
                <div tabindex="0" class="product vertical flex-layout"
                  data-product-id="<?= $product['id'] ?>"
                  title="<?= $product['name']?>">

                  <!-- Product Image -->
                  <div class="product-image-container vertical flex-layout centered">
                    <img class="product-image" 
                      src="assets/images/products/<?= $product['image'] ?>" 
                      alt="Product Image">

                    <!-- Like Button -->
                    <button class="like-btn vertical flex-layout centered" naked 
                      data-product-id="<?= $product['id'] ?>"
                      title="<?= $this->i18n->getString('addToLikes') ?>"
                      >
                      <span class="material-icons icon">favorite_border</span>
                    </button>
                    <!-- End of Like Button -->
                  </div>
                  <!-- End of Product Image -->


                  <!-- Product Details -->
                  <div class="product-details-container vertical flex-layout">
                    <!-- Rating -->
                    <div class="rating-container horizontal flex-layout center">
                      <span class="material-icons icon">star</span>
                      <span class="rating-count"><?= $product['avg_rating'] ?? $this::DEFAULT_AVG_RATING ?></span>
                      <span class="rating-total">&nbsp;(<?= $product['nb_comments'] ?? $this::DEFAULT_NB_COMMENTS ?>)</span>
                    </div>

                    <!-- Product Name -->
                    <div class="product-name"><?= $product['name'] ?></div>

                    <!-- Product Price -->
                    <div class="product-price"><?= number_format($product['price'] / 100, 2) ?> €</div>

                    <!-- Add to Cart Button -->
                    <button class="add-to-cart-btn horizontal flex-layout centered" contained expands shrinks 
                      data-product-id="<?= $product['id'] ?>"
                      title="<?= $this->i18n->getString('addToCart') ?>"
                      >
                      <span class="material-icons icon">add</span>
                    </button>
                    

                  </div>
                  <!-- End of Product Details -->

                </div>
                <!-- End of Product -->

              </li>
              <!-- End of Product Wrapper -->

              <?php endforeach; ?>
              <!-- End of PHP (6) -->

            </ul>

            <!-- Background of Products Section -->
            <span class="background"></span>

          </section>
          <!-- End of Popular Products - Section -->



          <!-- Cheapest Products - Section -->
          <section id="cheapestProducts" cheapest-products>
            <h2 class="flex-layout center">
              <span><?= $this->i18n->getString('cheapestProducts') ?></span>
              <span flex></span>
              <a href="category/cheapest" role="icon-button" tabindex="0">
                <span class="material-icons icon">arrow_forward</span>
              </a>
            </h2>

            <ul class="products vertical flex-layout" naked>

              <!-- PHP (6): For each product in `$cheapestProducts` array... -->
              <?php foreach ($cheapestProducts as $product): ?>
              <!-- ...PHP (6): display the corresponding product -->

              <!-- Product Wrapper -->
              <li class="product-wrapper vertical flex-layout">

                <!-- Product  -->
                <div tabindex="0" class="product vertical flex-layout"
                  data-product-id="<?= $product['id'] ?>"
                  title="<?= $product['name']?>">

                  <!-- Product Image -->
                  <div class="product-image-container vertical flex-layout centered">
                    <img class="product-image" 
                      src="assets/images/products/<?= $product['image'] ?>" 
                      alt="Product Image">

                    <!-- Like Button -->
                    <button class="like-btn vertical flex-layout centered" naked 
                      data-product-id="<?= $product['id'] ?>"
                      title="<?= $this->i18n->getString('addToLikes') ?>"
                      >
                      <span class="material-icons icon">favorite_border</span>
                    </button>
                    <!-- End of Like Button -->
                  </div>
                  <!-- End of Product Image -->


                  <!-- Product Details -->
                  <div class="product-details-container vertical flex-layout">
                    <!-- Rating -->
                    <div class="rating-container horizontal flex-layout center">
                      <span class="material-icons icon">star</span>
                      <span class="rating-count"><?= $product['avg_rating'] ?? $this::DEFAULT_AVG_RATING ?></span>
                      <span class="rating-total" <?= !isset($product['nb_comments']) ? 'hidden' : ''?>>&nbsp;(<?= $product['nb_comment'] ?? $this::DEFAULT_NB_COMMENTS  ?>)</span>
                    </div>

                    <!-- Product Name -->
                    <div class="product-name"><?= $product['name'] ?></div>

                    <!-- Product Price -->
                    <div class="product-price"><?= number_format($product['price'] / 100, 2) ?> €</div>

                    <!-- Add to Cart Button -->
                    <button class="add-to-cart-btn horizontal flex-layout centered" contained expands shrinks 
                      data-product-id="<?= $product['id'] ?>"
                      title="<?= $this->i18n->getString('addToCart') ?>"
                      >
                      <span class="material-icons icon">add</span>
                    </button>
                    

                  </div>
                  <!-- End of Product Details -->

                </div>
                <!-- End of Product -->

              </li>
              <!-- End of Product Wrapper -->

              <?php endforeach; ?>
              <!-- End of PHP (6) -->

            </ul>

            <!-- Background of Products Section -->
            <span class="background"></span>

          </section>
          <!-- End of Cheapest Products - Section -->

        </div>
        <!-- End of Container -->

      </div>
      <!-- End of [content] -->

      <footer>
        <div class="footer-container vertical flex-layout centered">
          <span class="footer-logo"></span>
          <span class="footer-text horizontal flex-layout centered"><?= $this->i18n->getString('madeWithLove') ?>&nbsp; <br> &nbsp;&copy;&nbsp;<?= date('Y') ?>&nbsp;&bull;&nbsp;<?= $this->i18n->getString('copyrightText') ?></span>
      </footer>

    </div>
    <!-- End of App Layout - MAIN -->
    
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
    <div class="menus" fit hidden>

        <!-- Home Menu -->
        <menu data-id="homeMenu" class="menu vertical flex-layout" hidden>

            <!-- Close Menu + Icon Button -->
            <li role="close-menu">
                <button class="icon-button"><span class="material-icons icon">arrow_back_ios</span></button>
            </li>

            <!-- Buy -->
            <li title="<?= $this->i18n->getString('buyAProduct') ?>" class="menu-item">
              <a role="button" tabindex="0" href="shop">
                <span class="material-icons icon">store</span>
                <span><?= $this->i18n->getString('buyAProduct') ?></span>
              </a>
            </li>


            <!-- Change Language -->
            <li title="<?= $this->i18n->getString('changeLanguage') ?>" class="menu-item">
              <a role="button" tabindex="0" href="account/language">
                <span class="material-icons icon">translate</span>
                <span><?= $this->i18n->getString('changeLanguage') ?></span>
              </a>
            </li>

            <!-- Change Theme -->
            <li title="<?= $this->i18n->getString('changeTheme') ?>" class="menu-item">
              <a role="button" tabindex="0" href="account/theme">
                <span class="material-icons icon">palette</span>
                <span><?= $this->i18n->getString('changeTheme') ?></span>
              </a>
            </li>


            <!-- About -->
            <li title="<?= $this->i18n->getString('aboutMaxaboom') ?>" class="menu-item">
              <a role="button" tabindex="0" href="account/about">
                <span class="material-icons icon">info</span>
                <span><?= $this->i18n->getString('aboutMaxaboom') ?></span>
              </a>
            </li>

        </menu>
        <!-- End of Home Menu -->

    </div>
    <!-- End of Menus -->
    
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
