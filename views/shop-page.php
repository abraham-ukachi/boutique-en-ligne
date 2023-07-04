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
* @name Shop Page - Maxaboom
* @file shop-page.php
* @author: Axel Vair <axel.vair@laplateforme.io>
* @contributors: Abraham Ukachi <abraham.ukachi@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> open http://localhost/boutique-en-ligne/shop
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
    <meta name='viewport' content='width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=yes'>
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
    <link rel='stylesheet' href='assets/animations/slide-from-up-animation.css'>

    <!-- Stylesheet -->
    <link rel='stylesheet' href='assets/stylesheets/shop-styles.css'>

    <!-- Script -->
    <script>

        // Let's do some stuff when this page loads...
        window.addEventListener('load', (event) => {
            // ...do something awesome here ;)
        });

    </script>

    <!-- Some more script for ya! #LOL -->
    <script type='module' src='src/app.js' defer></script>
    <script type='module' src='src/scripts/shop.js' defer></script>

</head>
<!-- End of HEAD -->
<body class='theme <?= $this->theme ?>' fullbleed
      data-category-name="<?= isset($this->categoryName) ? $this->categoryName : '' ?>"
      data-category-id="<?= isset($this->categoryId) ? $this->categoryId : 0 ?>"
      data-sub-category-name="<?= isset($this->subCategoryName) ? $this->subCategoryName : '' ?>"
      data-sub-category-id="<?= isset($this->subCategoryId) ? $this->subCategoryId : 0 ?>">

  <!-- Side Bar -->
  <!-- PHP: Include the `sideBar` component -->
  <?php
    $_GET['sidebar_route'] = 'shop';
    $_GET['sidebar_init'] = $this->user->getInitials();
    $_GET['sidebar_connected'] = $this->user->isConnected(); // TRUE if the user is connected
    $_GET['sidebar_for_admin'] = $this->user->isAdmin(); // TRUE if the user is an admin 

    require __DIR__ . '/components/side-bar.php';
  ?>
  <!-- End of Side Bar -->


  <!-- Main part -->
  <main class='flex-layout vertical'>

    <!-- App-Layout of MAIN -->
    <div id="appLayout" class='app-layout' fit>

        <!-- Wallpaper -->
        <div id="wallpaper" class="wallpaper" <?= !isset($this->categoryName) ? 'hidden' : ''?> fit>
          <div class="overlay" fit></div>
          <img src="<?= isset($this->categoryImage) ? 'assets/images/categories/' . $this->categoryImage : ''?>" alt="" fit/>
        </div>

        <!-- Header -->
        <header>
          <!-- App Bar -->
          <!-- TIP: Add a [sticky] property to the app-bar, to fall in love ;) -->
          <div id="appBar" class='app-bar'>

            <!-- Go Back Button -->
            <button id="goBackButton" class="icon-button" <?= !isset($this->categoryName) ? 'invisible' : ''?>>
              <span class="material-icons icons">close<!-- arrow_back_ios --></span>
            </button>
             
            <!-- Title Wrapper -->
            <div class='title-wrapper centered flex-layout'>
              <!-- Title -->
              <h2 class='app-title'><?= $this->shopTitle ?></h2>
              <!-- Subtitle -->
              <h3 class='app-subtitle fade-in' <?= !isset($this->categoryName) ? 'hidden' : ''?>><?= $this->i18n->getString('discoverBuyYourPerfectInstrument') ?></h3>
            </div>

            <!-- Menu Button -->
            <button id="menuButton" class="icon-button">
              <span class="material-icons icons">more_vert</span>
            </button>

          </div>
          <!-- End of App Bar -->

          <!-- Category Bar -->
          <div id="categoryBar" class='app-bar fade-in' <?= isset($this->categoryName) ? 'hidden' : ''?>>
            <!-- Title Wrapper -->
            <div class='title-wrapper centered flex-layout'>
              <!-- Title -->
              <h1 class='app-title txt capitalize'><?= $this->i18n->getString('ourTopCategories') ?></h1>
              <!-- Subtitle -->
              <p class='app-subtitle'><?= $this->i18n->getString('ourCategoriesMessage') ?></p>
            </div>
          </div>
          <!-- End of Category Bar -->

          <!-- Search Bar -->
          <div id="searchBar" class="app-bar fade-in" busy <?= !isset($this->categoryName) ? 'hidden' : ''?>>
            <!-- Input Wrapper -->
            <div class="input-wrapper horizontal flex-layout center">

              <!-- Search Icon Button -->
              <button id="searchIconButton" class="icon-button" role="icon-button">
                <span class="material-icons icons vertical flex-layout centered">search</span>
              </button>
              
              <!-- Search Dropdown - Button -->
              <button id="searchDropdownButton" class="dropdown-button horizontal flex-layout centered"
                contained shrinks>
                <span class="spinner dots-3"></span>
                <span class="value txt capitalize"><?= $this->categoryNameValue ?></span>
                <span class="material-icons icons">arrow_drop_down</span>
              </button>

              <!-- Search Input -->
              <input id="searchInput" 
                type="search" 
                placeholder="<?= str_replace('%s', $this->categoryName, $this->i18n->getString('searchInX')) ?>" 
                autocomplete="off" 
                autocorrect="off" 
                autocapitalize="off" 
                spellcheck="false" />

              <!-- Search Indicator -->
              <div id="searchIndicator" hidden><span></span></div>

              <!-- Progress Bar -->
              <div id="progressBar" class="progress-bar" hidden>
                <span class="progress-bar-value"></span>
              </div>

            </div>
            <!-- End of Input Wrapper -->
          </div>
          <!-- End of Search Bar -->
          
          
          <!-- Chips Bar -->
          <div id="chipsBar" class="app-bar fade-in center horizontal flex-layout" <?= !isset($this->categoryName) ? 'hidden' : ''?>>
            
            <!-- Filter Button -->
            <button id="filterButton" class="horizontal flex-layout centered" outlined tablet-and-desktop-only>
              <span class="material-icons icons vertical flex-layout centered">filter_list</span>
              <span><?= $this->i18n->getString('filter') ?></span>
            </button>

            <!-- SubCategory Chips | Chips Container -->
            <div id="subCategoryChips" class="chips-container flex-layout flex" scrollpos="start">
              <!-- Left Chip - Icon Button -->
              <button id="leftChipIconBtn" class="icon-button left">
                <span class="material-icons icon">keyboard_arrow_left</span>
              </button>
              
              <!-- Chips -->
              <ul class="chips horizontal flex-layout center flex fade-in" role="tabs" noscrollbars>

                <li data-subcategory-id="-1" data-subcategory-name="all" class="chip" role="tab" tabindex="0" aria-selected="true" selected>
                  <span><?= $this->i18n->getString('all') ?></span>
                </li>

                <?php foreach ($subCategories as $subCategory): ?>
                <li 
                  data-subcategory-id="<?= $subCategory->id ?>" 
                  data-subcategory-name="<?= $subCategory->name ?>" 
                  class="chip slide-from-up" 
                  role="tab" 
                  tabindex="0" 
                  aria-selected="false">

                  <span><?= $this->i18n->getString($subCategory->name) ?></span>

                </li>
                <?php endforeach; ?>
              </ul>
              <!-- End of Chips -->
            
              <!-- Right Chip - Icon Button -->
              <button id="rightChipIconBtn" class="icon-button right">
                <span class="material-icons icon">keyboard_arrow_right</span>
              </button>

              <span class="divider horizontal bottom" hidden></span>
            </div>
            <!-- End of SubCategory Chips | [sticky] App Bar | Chips Container -->
            
            <span flex></span>

            <!-- Sort Button -->
            <button id="sortButton" name="default" class="horizontal flex-layout centered" outlined tablet-and-desktop-only>
              <span class="material-icons icons vertical flex-layout centered">sort</span>
              <span><?= $this->i18n->getString('sort') ?></span>
            </button>
          </div>


          <!-- Horizontal Divider -->
          <span class='divider horizontal bottom' hidden></span>
        </header>

        <!-- [content] -->
        <div content>
          <!-- Preview - Container -->
          <div id="preview" class='container' <?= isset($this->categoryName) ? 'hidden' : ''?>>

            <!-- Top Categories -->
            <ul id="topCategories" class='flex-layout vertical' naked>
              <!-- Top Category -->
              <?php foreach ($topCategories as $category): ?>

              <li class='top-category vertical flex-layout' tabindex="0">
                <!-- Category Button -->
                <button 
                  class='category-btn' expands contained naked fit
                  tabindex="-1" 
                  data-category-id="<?= $category['id'] ?>" 
                  data-category-name="<?= $category['name'] ?>"
                  data-category-image="<?= $category['image'] ?>">
                  <img src='assets/images/categories/<?=$category['image'] ?>' alt='<?=$category['name'] ?>' fit>
                </button>

                <p class='top-category-label txt capitalize'><?= $this->i18n->getString($category['name']) ?></p>
              </li>
              <?php endforeach; ?>
            </ul>
            <!-- End of Top Categories -->

            <!-- See All - Button -->
            <button id="seeAllButton" class='btn flex-layout centered' outlined shrinks>
              <span class="spinner dots-3"></span>
              <span class='txt upper'><?= $this->i18n->getString('seeAll') ?></span>
            </button>
            
          </div>
          <!-- End of Preview - Container -->

          <!-- Filter Panel | Section -->
          <section id="filterPanel">
            <div class="app-layout">
              <header narrow-only>
                <!-- Filter Panel App Bar -->
                <div class="app-bar">
                  <!-- Close Filter Button -->
                  <button id="closeFilterButton" class="icon-button">
                    <span class="material-icons icons">close</span>
                  </button>
             
                 <!-- Title Wrapper -->
                 <div class='title-wrapper centered flex-layout'>
                   <!-- Title -->
                   <h2 class='app-title'><?= $this->i18n->getString('filter') ?></h2>
                 </div>

                </div>
                <!-- End of Filter Panel App Bar -->

              </header>

              <div content>
                <div class="container vertical flex-layout">
                  <!-- Filters -->
                  <ul class="filters list-items links" naked>

                    <!-- Price Filter Item -->
                    <li id="priceFilterItem" class="filter-item link-item">
                      <a href="#" role="button" tabindex="0" class="horizontal flex-layout center" naked>
                        <div class="text-wrapper flex-layout vertical">
                          <h3>Price</h3>
                          <h4>$0 - $100</h4>
                        </div>
                        <span class="material-icons arrow icon">expand_more</span>
                      </a>
                    </li>
                    <!-- End of Price Filter Item -->


                    <!-- Color Filter Item -->
                    <li id="priceFilterItem" class="filter-item link-item">
                      <a href="#" role="button" tabindex="0" class="horizontal flex-layout center" naked>
                        <div class="text-wrapper flex-layout vertical">
                          <h3>Color</h3>
                          <h4>red</h4>
                        </div>
                        <span class="material-icons arrow icon">expand_more</span>
                      </a>
                    </li>
                    <!-- End of Price Filter Item -->
                  </ul>
                  <!-- End of Filters -->

                </div>
              </div>

            </div>
          </section>

          <!-- Products - Container -->
          <div id="products" <?= !isset($this->categoryName) ? 'hidden' : ''?>
            class="container vertical flex-layout">


          </div>
          <!-- End of Products - Container -->


          <!-- Busy Container -->
          <div id="busyContainer" class="container vertical flex-layout centered center" busy fit hidden>
            <span class="spinner dots-12"></span>
          </div>
     </div>
     <!-- End of [content] -->

    </div>
    <!-- End of App-Layout of MAIN -->

    <!-- Nav Bar -->
    <!-- PHP: Include the `navBar` component -->
    <?php 
      $_GET['navbar_route'] = 'shop'; 
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

      <!-- Shop Menu -->
      <menu data-id="shopMenu" class="menu vertical flex-layout" hidden>

        <!-- Close Menu + Icon Button -->
        <li role="close-menu">
          <button class="icon-button"><span class="material-icons icon">arrow_back_ios</span></button>
        </li>
         
        <!-- Search - Menu Item -->
        <li title="<?= $this->i18n->getString('search') ?>" class="menu-item">
          <a tabindex="0" role="button" href="search" id="searchMenuItem" data-action="search">
            <span class="material-icons icon">search</span>
            <span><?= $this->i18n->getString('search') ?></span>
          </a>
        </li>
        
        <!-- Filter - Menu Item -->
        <li title="<?= $this->i18n->getString('filter') ?>" class="menu-item">
          <button id="filterMenuItem" data-action="filter">
            <span class="material-icons icon">filter_list</span>
            <span><?= $this->i18n->getString('filter') ?></span>
          </button>
        </li>
        

        <!-- Sort - Menu Item -->
        <li title="<?= $this->i18n->getString('sort') ?>" class="menu-item">
          <button id="sortMenuItem" data-action="sort">
            <span class="material-icons icon">sort</span>
            <span><?= $this->i18n->getString('sort') ?></span>
          </button>
        </li>

        
        <!-- Help - Menu Item -->
        <li title="<?= $this->i18n->getString('help') ?>" class="menu-item">
          <a tabindex="0" role="button" id="helpMenuItem" href="account/help" data-action="help">
            <span class="material-icons icon">help_outline</span>
            <span><?= $this->i18n->getString('help') ?></span>
          </a>
        </li>
        
        
        <!-- Settings - Menu Item -->
        <li title="<?= $this->i18n->getString('settings') ?>" class="menu-item">
          <a tabindex="0" role="button" id="settingsMenuItem" href="account" data-action="settings">
            <span class="material-icons icon">settings</span>
            <span><?= $this->i18n->getString('settings') ?></span>
          </a>
        </li>

      </menu>
      <!-- End of Shop Menu -->


    </div>

    <!-- Dialogs of MAIN -->
    <div class='dialogs' fit hidden></div>

    <!-- Toasts of MAIN -->
    <div class='toasts' fit hidden></div>

</main>

<!-- Aside part -->
<aside class='flex-layout vertical' hidden>

    <!-- App-Layout of ASIDE -->
    <div class='app-layout' fit></div>


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
