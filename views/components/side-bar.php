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
* @name Side Bar - Component
* @file side-bar.php
* @demo demo/side-bar.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> // Use the following code to include the side bar in your page
*    -|>
*    -|> <?php 
*    -|>    $_GET['sidebar_route'] = 'account';
*    -|>    $_GET['sidebar_init'] = 'au'; 
*    -|>    $_GET['sidebar_connected'] = false; 
*    -|>    $_GET['sidebar_for_admin'] = true;
*    -|>    $_GET['cart_total'] = 20; 
*    -|>    
*    -|>    require __DIR__ . 'components/side-bar.php'; 
*    -|> ?>
*    -|>
*
*   2-|> open http://localhost/boutique-en-ligne/components/demo/side-bar
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

// use the home controller 
use Maxaboom\Controllers\HomeController;

// Create a new instance of the home controller as `hc`
$hc = new HomeController();


// Let's define some constant variables, shall we ?


// Using our lovely null coalescing operator (i.e. ??):

// Get the route of side bar as `sidebarRoute`
$sidebarRoute = $_GET['sidebar_route'] ?? 'home';
// Get the sidebar initials as `sidebarInit`
$sidebarInit = $_GET['sidebar_init'] ?? '';

// Check if the side bar is for an administrator
$sidebarForAdmin = $_GET['sidebar_for_admin'] ?? false;
// Check if the side bar is connected
$sidebarIsConnected = $_GET['sidebar_connected'] ?? false;

$LogoIsHome = $_GET['logo_is_home'] ?? false;

$cartTotal = $_GET['cart_total'] ?? $hc->getCartCount() ?? 0;

// Create a default array of titles for the side bar as `defaultSidebarTitles`
$defaultSidebarTitles = [
  'maxaboom' => 'Maxaboom ❤️',
  'profile' => $hc->i18n->getString('profileHint'),
  'auth' => $hc->i18n->getString('authHint'),
  'login' => $hc->i18n->getString('loginHint'),
  'dashboard' => $hc->i18n->getString('dashboardHint'),
  'home' => $hc->i18n->getString('homeHint'),
  'account' => $hc->i18n->getString('accountHint'),
  'cart' => $hc->i18n->getString('cartHint'),
  'likes' => $hc->i18n->getString('likesHint'),
  'users' => $hc->i18n->getString('usersHint'),
  'products' => $hc->i18n->getString('usersHint'),
  'search' => $hc->i18n->getString('searchHint'),
];



// Create a default array of labels for the side bar as `defaultSidebarLabels`
$defaultSidebarLabels = [
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
$sidebarTitles = $_GET['sidebar_titles'] ?? $defaultSidebarTitles;

// Get the labels 
$sidebarLabels = $_GET['sidebar_labels'] ?? $defaultSidebarLabels;


// DEBUG [4dbsmaster]: tell me about it :)
// echo "sidebarIsConnected ? " . json_encode($sidebarIsConnected) . "<br>";
// echo "sidebarForAdmin ? " . json_encode($sidebarForAdmin) . "<br>";
// echo "sidebarRoute = " . $sidebarRoute . "<br>";

?>


<!-- PHP (1): If this sideBar is for an administrator... -->
<?php if ($sidebarForAdmin): ?>
<!-- PHP (1): ...show an admin side-bar -->

<!-- Admin Side Bar -->
<nav id="sideBar" class="admin flex-layout vertical">
  <!-- Icon-Wrapper -->
  <a title="Dashboard" 
    href="admin"
    class="nav-link icon-wrapper" <?= ($LogoIsHome && (($sidebarRoute == 'home') || ($sidebarRoute == 'dashboard')))  ? 'active' : '' ?>>

    <!-- App-Logo -->
    <span class="app-logo"></span> <!-- UX: Use `home` material-icon instead ? -->
    <!-- End of App-Logo -->

  </a>
  <!-- End of Icon-Wrapper -->
  
  <span flex></span>

  <!-- Dashboard - Nav-Link [disabled] -->
  <a title="<?= $sidebarTitles['dashboard'] ?>" href="admin" class="nav-link" <?= ($sidebarRoute == 'dashboard') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">dashboard</span>
    <span class="nav-label"><?= $sidebarLabels['dashboard'] ?></span>
  </a>
  <!-- End of Dashboard Nav-Link -->

  <!-- Users - Nav-Link -->
  <a title="<?= $sidebarTitles['users'] ?>" href="users" class="nav-link" <?= ($sidebarRoute == 'users') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">people</span>
    <span class="nav-label"><?= $sidebarLabels['users'] ?></span>
  </a>
  <!-- End of Users Nav-Link -->


  <!-- Products - Nav-Link -->
  <a title="<?= $sidebarTitles['products'] ?>" href="products" class="nav-link" <?= ($sidebarRoute == 'products') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">shopping_bag</span>
    <span class="nav-label"><?= $sidebarLabels['products'] ?></span>
  </a>
  <!-- End of Products Nav-Link -->


  <span class="divider horizontal"></span>
  
  
  <!-- Account - Nav-Link -->
  <a title="<?= $sidebarTitles['account'] ?>" href="account" class="nav-link" <?= ($sidebarRoute == 'account') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">settings</span>
    <span class="nav-label"><?= $sidebarLabels['account'] ?></span>
  </a>
  <!-- End of Account Nav-Link -->


  <span flex></span>


  <!-- Profile - Nav-Link -->
  <a title="Profile" href="account/profile" class="nav-link profile">
    <span initials><?= $sidebarInit ?></span>
  </a>
  <!-- End of Profile Nav-Link -->


  <!-- Horizontal Divider -->
  <span class="divider vertical right"></span>
</nav>
<!-- End of Side Bar -->


<!-- + PHP (1): If this sideBar *IS NOT FOR ADMIN*... -->
<?php else: ?>
<!-- + PHP (1): ...show the normal / default side-bar -->



<!-- Default Side Bar -->
<nav id="sideBar" class="flex-layout vertical" <?= ($sidebarIsConnected) ? 'connected' : '' ?>>
  <!-- Icon-Wrapper -->
  <a title="<?= $sidebarTitles['maxaboom'] ?>" 
    href="home"
    class="nav-link icon-wrapper" <?= ($sidebarRoute == 'home')  ? 'active' : '' ?>>

    <!-- App-Logo -->
    <span class="app-logo"></span> <!-- UX: Use `home` material-icon instead ? -->
    <!-- End of App-Logo -->

  </a>
  <!-- End of Icon-Wrapper -->
  
  <span flex></span>

  <!-- Home - Nav-Link -->
  <a title="<?= $sidebarTitles['home'] ?>" href="home" class="nav-link" <?= ($sidebarRoute == 'home') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">home</span>
    <span class="nav-label"><?= $sidebarLabels['home'] ?></span>
  </a>
  <!-- End of Home Nav-Link -->

  <!-- Search - Nav-Link -->
  <a title="<?= $sidebarTitles['search'] ?>" href="search" class="nav-link" <?= ($sidebarRoute == 'search') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">search</span>
    <span class="nav-label"><?= $sidebarLabels['search'] ?></span>
  </a>
  <!-- End of Search Nav-Link -->

  <!-- Likes - Nav-Link -->
  <a title="<?= $sidebarTitles['likes'] ?>" href="likes" class="nav-link" <?= ($sidebarRoute == 'likes') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">favorite_outline</span>
    <span class="nav-label"><?= $sidebarLabels['likes'] ?></span>
  </a>
  <!-- End of Likes Nav-Link -->



  <!-- Cart - Nav-Link -->
  <a title="<?= $sidebarTitles['cart'] ?>" href="cart" class="nav-link" <?= ($sidebarRoute == 'cart') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">shopping_cart</span>
    <span class="nav-label"><?= $sidebarLabels['cart'] ?></span>
    <!-- Badge -->
    <span class="badge" <?= (!$cartTotal) ? 'hidden' : ''?>><?= $cartTotal ?></span>
  </a>
  <!-- End of Products Nav-Link -->


  <span class="divider horizontal"></span>
  
  
  <!-- Account - Nav-Link -->
  <a title="<?= $sidebarTitles['account'] ?>" href="account" class="nav-link" <?= ($sidebarRoute == 'account') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">settings</span>
    <span class="nav-label"><?= $sidebarLabels['account'] ?></span>
  </a>
  <!-- End of Account Nav-Link -->


  <span flex></span>



  <!-- PHP(2): If the side bar *IS CONNECTED* ...-->
  <?php if ($sidebarIsConnected): ?>
  <!-- PHP(2): ...show the user initials -->

    <!-- Profile - Nav-Link -->
    <a title="<?= $sidebarTitles['profile'] ?>" href="account/profile" class="nav-link profile initials">
      <span initials><?= $sidebarInit ?></span>
    </a>
    <!-- End of Profile Nav-Link -->

  <!-- + PHP(2): If the side bar *IS NOT CONNECTED* ...-->
  <?php else: ?>
  <!-- + PHP(2): ...show person icon with link to 'login' page -->

  <a title="<?= $sidebarTitles['auth'] ?>" href="login" class="nav-link profile">
    <span class="material-icons nav-icon">person</span>
  </a>

  <?php endif; ?>
  <!-- End of PHP(2): If the side bar *IS CONNECTED* -->

  <!-- Horizontal Divider -->
  <span class="divider vertical right"></span>
</nav>
<!-- End of Side Bar -->

<?php endif; ?>
<!-- End of PHP (1) -->
