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
* @name Nav Bar - Component
* @file nav-bar.php
* @demo demo/nav-bar.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> // Use the following code to include the side bar in your page
*    -|>
*    -|> <?php 
*    -|>    $_GET['navbar_route'] = 'account';
*    -|>    $_GET['navbar_init'] = 'au'; 
*    -|>    $_GET['navbar_connected'] = false; 
*    -|>    $_GET['navbar_for_admin'] = true; 
*    -|>    $_GET['cart_total'] = 20; 
*    -|>    
*    -|>    require __DIR__ . 'components/nav-bar.php'; 
*    -|> ?>
*    -|>
*
*   2-|> open http://localhost/boutique-en-ligne/components/demo/nav-bar
* 
* 
* 
* ============================
* IMPORTANT: This is a working progress and subject to major changes ;)
* ============================
*
* 
*/


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: I'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/


// Let's define some constant variables, shall we ?


// Using our lovely null coalescing operator (i.e. ??):i

// use the home controller 
use Maxaboom\Controllers\HomeController;

// Create a new instance of the home controller as `hc`
$hc = new HomeController();

// Get the route of side bar as `navbarRoute`
$navbarRoute = $_GET['navbar_route'] ?? 'home';
// Get the navbar initials as `navbarInit`
$navbarInit = $_GET['navbar_init'] ?? '';

// Check if the side bar is for an administrator
$navbarForAdmin = $_GET['navbar_for_admin'] ?? false;
// Check if the side bar is connected
$navbarIsConnected = $_GET['navbar_connected'] ?? false;

$LogoIsHome = $_GET['logo_is_home'] ?? false;

$cartTotal = $_GET['cart_total'] ?? $hc->getCartCount() ?? 0;

// Create a default array of titles for the nav bar as `defaultNavbarTitles`
$defaultNavbarTitles = [
  'dashboard' => $hc->i18n->getString('dashboardHint'),
  'home' => $hc->i18n->getString('homeHint'),
  'account' => $hc->i18n->getString('accountHint'),
  'cart' => $hc->i18n->getString('cartHint'),
  'likes' => $hc->i18n->getString('likesHint'),
  'users' => $hc->i18n->getString('usersHint'),
  'products' => $hc->i18n->getString('usersHint'),
  'search' => $hc->i18n->getString('searchHint'),
];



// Create a default array of labels for the nav bar as `defaultNavbarLabels`
$defaultNavbarLabels = [
  'dashboard' => $hc->i18n->getString("dashboard"),
  'home' => $hc->i18n->getString('home'),
  'account' => $hc->i18n->getString('account'),
  'cart' => $hc->i18n->getString('cart'),
  'likes' => $hc->i18n->getString('likes'),
  'users' => $hc->i18n->getString('users'),
  'products' => $hc->i18n->getString('products'),
  'search' => $hc->i18n->getString('search'),
];

// Get the titles
$navbarTitles = $_GET['navbar_titles'] ?? $defaultNavbarTitles;

// Get the labels 
$navbarLabels = $_GET['navbar_labels'] ?? $defaultNavbarLabels;

// DEBUG [4dbsmaster]: tell me about it :)
// echo "navbarIsConnected ? " . json_encode($navbarIsConnected) . "<br>";
// echo "navbarForAdmin ? " . json_encode($navbarForAdmin) . "<br>";
// echo "navbarRoute = " . $navbarRoute . "<br>";

?>


<!-- PHP (1): If this navBar is for an administrator... -->
<?php if ($navbarForAdmin): ?>
<!-- PHP (1): ...show an admin side-bar -->

<!-- Admin Nav Bar -->
<nav id="navBar" class="admin nav-bar flex-layout horizontal center">

  <!-- Dashboard - Nav-Link [disabled] -->
  <a title="<?= $navbarTitles['dashboard'] ?>" href="admin" class="nav-link" <?= ($navbarRoute == 'dashboard') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">dashboard</span>
    <span class="nav-label"><?= $navbarLabels['dashboard'] ?></span>
  </a>
  <!-- End of Dashboard Nav-Link -->

  <!-- Users - Nav-Link -->
  <a title="<?= $navbarTitles['users'] ?>" href="users" class="nav-link" <?= ($navbarRoute == 'users') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">people</span>
    <span class="nav-label"><?= $navbarLabels['users'] ?></span>
  </a>
  <!-- End of Users Nav-Link -->


  <!-- Products - Nav-Link -->
  <a title="<?= $navbarTitles['products'] ?>" href="products" class="nav-link" <?= ($navbarRoute == 'products') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">shopping_bag</span>
    <span class="nav-label"><?= $navbarLabels['products'] ?></span>
  </a>
  <!-- End of Products Nav-Link -->

  
  <!-- Account - Nav-Link -->
  <a title="<?= $navbarTitles['account'] ?>" href="account" class="nav-link" <?= ($navbarRoute == 'account') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">settings</span>
    <span class="nav-label"><?= $navbarLabels['account'] ?></span>
  </a>
  <!-- End of Account Nav-Link -->


  <!-- Horizontal Divider -->
  <span class="divider horizontal top"></span>
</nav>
<!-- End of Admin Nav Bar -->


<!-- + PHP (1): If this navBar *IS NOT FOR ADMIN*... -->
<?php else: ?>
<!-- + PHP (1): ...show the normal / default side-bar -->



<!-- Default Nav Bar -->
<nav id="navBar" class="nav-bar flex-layout horizontal center" <?= ($navbarIsConnected) ? 'connected' : '' ?>>

  <!-- Home - Nav-Link -->
  <a title="<?= $navbarTitles['home'] ?>" href="home" class="nav-link" <?= ($navbarRoute == 'home') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">home</span>
    <span class="nav-label"><?= $navbarLabels['home'] ?></span>
  </a>
  <!-- End of Home Nav-Link -->
  
 
  <!-- Search - Nav-Link -->
  <a title="<?= $navbarTitles['search'] ?>" href="search" class="nav-link" <?= ($navbarRoute == 'search') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">search</span>
    <span class="nav-label"><?= $navbarLabels['search'] ?></span>
  </a>
  <!-- End of Search Nav-Link -->


  <!-- Likes - Nav-Link -->
  <a title="<?= $navbarTitles['likes'] ?>" href="likes" class="nav-link" <?= ($navbarRoute == 'likes') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">favorite_outline</span>
    <span class="nav-label"><?= $navbarLabels['likes'] ?></span>
  </a>
  <!-- End of Likes Nav-Link -->


  <!-- Cart - Nav-Link -->
  <a title="<?= $navbarTitles['cart'] ?>" href="cart" class="nav-link" <?= ($navbarRoute == 'cart') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">shopping_cart</span>
    <span class="nav-label"><?= $navbarLabels['cart'] ?></span>
    <!-- Badge -->
    <span class="badge" <?= (!$cartTotal) ? 'hidden' : ''?>><?= $cartTotal ?></span>
  </a>
  <!-- End of Products Nav-Link -->
 
  
  <!-- Account - Nav-Link -->
  <a title="<?= $navbarTitles['account'] ?>" href="account" class="nav-link" <?= ($navbarRoute == 'account') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">settings</span>
    <span class="nav-label"><?= $navbarLabels['account'] ?></span>
  </a>
  <!-- End of Account Nav-Link -->


  <!-- Horizontal Divider -->
  <span class="divider horizontal top"></span>
</nav>
<!-- End of Nav Bar -->

<?php endif; ?>
<!-- End of PHP (1) -->
