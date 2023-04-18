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


// Using our lovely null coalescing operator (i.e. ??):

// Get the route of side bar as `navbarRoute`
$navbarRoute = $_GET['navbar_route'] ?? 'home';
// Get the navbar initials as `navbarInit`
$navbarInit = $_GET['navbar_init'] ?? '';

// Check if the side bar is for an administrator
$navbarForAdmin = $_GET['navbar_for_admin'] ?? false;
// Check if the side bar is connected
$navbarIsConnected = $_GET['navbar_connected'] ?? false;

$LogoIsHome = $_GET['logo_is_home'] ?? false;

$cartTotal = $_GET['cart_total'] ?? 0;

// Create a default array of titles for the side bar as `defaultSidebarTitles`
$defaultSidebarTitles = [
  'dashboard' => 'Dashboard',
  'home' => 'Home',
  'account' => 'Account',
  'cart' => 'Cart',
  'likes' => 'Likes'
];

// Get the titles
$navbarTitles = $_GET['navbar_titles'] ?? $defaultSidebarTitles;

// DEBUG [4dbsmaster]: tell me about it :)
// echo "navbarIsConnected ? " . json_encode($navbarIsConnected) . "<br>";
// echo "navbarForAdmin ? " . json_encode($navbarForAdmin) . "<br>";
// echo "navbarRoute = " . $navbarRoute . "<br>";

?>


<!-- PHP (1): If this navBar is for an administrator... -->
<?php if ($navbarForAdmin): ?>
<!-- PHP (1): ...show an admin side-bar -->

<!-- Admin Nav Bar -->
<nav id="navBar" class="admin nav-bar flex-layout horizontal">

  <!-- Dashboard - Nav-Link [disabled] -->
  <a title="Dashboard" href="dashboard" class="nav-link" <?= ($navbarRoute == 'dashboard') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">dashboard</span>
    <span class="nav-label">Dashboard</span>
  </a>
  <!-- End of Dashboard Nav-Link -->

  <!-- Users - Nav-Link -->
  <a title="Users" href="users" class="nav-link" <?= ($navbarRoute == 'users') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">people</span>
    <span class="nav-label">Users</span>
  </a>
  <!-- End of Users Nav-Link -->


  <!-- Products - Nav-Link -->
  <a title="Products" href="products" class="nav-link" <?= ($navbarRoute == 'products') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">shopping_bag</span>
    <span class="nav-label">Products</span>
  </a>
  <!-- End of Products Nav-Link -->

  
  <!-- Account - Nav-Link -->
  <a title="Account" href="account" class="nav-link" <?= ($navbarRoute == 'account') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">settings</span>
    <span class="nav-label">Account</span>
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
<nav id="navBar" class="nav-bar flex-layout horizontal" <?= ($navbarIsConnected) ? 'connected' : '' ?>>

  <!-- Home - Nav-Link -->
  <a title="Home" href="/" class="nav-link" <?= ($navbarRoute == 'home') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">home</span>
    <span class="nav-label">Home</span>
  </a>
  <!-- End of Home Nav-Link -->
  
  <!-- Likes - Nav-Link -->
  <a title="Liked products" href="likes" class="nav-link" <?= ($navbarRoute == 'likes') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">favorite_outline</span>
    <span class="nav-label">Likes</span>
  </a>
  <!-- End of Likes Nav-Link -->


  <!-- Cart - Nav-Link -->
  <a title="Cart" href="cart" class="nav-link" <?= ($navbarRoute == 'cart') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">shopping_cart</span>
    <span class="nav-label">Cart</span>
    <!-- Badge -->
    <span class="badge" <?= (!$cartTotal) ? 'hidden' : ''?>><?= $cartTotal ?></span>
  </a>
  <!-- End of Products Nav-Link -->
 
  
  <!-- Account - Nav-Link -->
  <a title="Account" href="account" class="nav-link" <?= ($navbarRoute == 'account') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">settings</span>
    <span class="nav-label">Account</span>
  </a>
  <!-- End of Account Nav-Link -->


  <!-- Horizontal Divider -->
  <span class="divider horizontal top"></span>
</nav>
<!-- End of Nav Bar -->

<?php endif; ?>
<!-- End of PHP (1) -->
