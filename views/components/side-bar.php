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
*   1-|> <?php define('__BASE__', 'components'); ?>
*    -|>
*    -|> <?php 
*    -|>    $_GET['sidebar_route'] = 'account';
*    -|>    $_GET['sidebar_subroute'] = '';
*    -|>    $_GET['sidebar_init'] = 'au'; 
*    -|>    $_GET['sidebar_connected'] = true; 
*    -|>    $_GET['sidebar_forAdmin'] = true; 
*    -|>    
*    -|>    include __BASE__ . 'side-bar.php'; 
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


// Let's define some constant variables, shall we ?


// Using our lovely null coalescing operator (i.e. ??):

// Get the route of side bar as `sidebarRoute`
$sidebarRoute = $_GET['sidebar-route'] ?? 'home';
// Get the sub-route of side bar as `sidebarSubRoute`
$sidebarSubRoute = $_GET['sidebar-subroute'] ?? '';
// Get the sidebar initials as `sidebarInit`
$sidebarInit = $_GET['sidebar_init'] ?? '';

// Check if the side bar is for an administrator
$sidebarForAdmin = $_GET['sidebar_forAdmin'] ?? false;
// Check if the side bar is connected
$sidebarIsConnected = $_GET['sidebar_connected'] ?? false;


// Create a default array of titles for the side bar as `defaultSidebarTitles`
$defaultSidebarTitles = [
  'dashboard' => 'Dashboard',
  'home' => 'Home',
  'account' => 'Account',
  'cart' => 'Cart',
  'likes' => 'Likes'
];

// Get the titles
$sidebarTitles = $_GET['sidebar_titles'] ?? $defaultSidebarTitles;

// DEBUG [4dbsmaster]: tell me about it :)
echo "sidebarForAdmin? " . json_encode($sidebarForAdmin) . "<br>";
echo "sidebarRoute = " . $sidebarRoute . "<br>";

?>


<!-- PHP (1): If this sideBar is for an administrator... -->
<?php if ($sidebarForAdmin) : ?>
<!-- PHP (1): ...show an admin side-bar -->

<!-- Admin Side Bar -->
<nav id="sideBar" class="admin flex-layout vertical">
  <!-- Icon-Wrapper -->
  <a title="Dashboard" 
    href="admin/dashboard" 
    class="nav-link icon-wrapper" <?= (($sidebarRoute == 'home') || ($sidebarRoute == 'dashboard'))  ? 'active' : '' ?>>

    <!-- App-Logo -->
    <span class="app-logo"></span> <!-- UX: Use `home` material-icon instead ? -->
    <!-- End of App-Logo -->

  </a>
  <!-- End of Icon-Wrapper -->
  
  <span flex></span>

  <!-- Dashboard - Nav-Link [disabled] -->
  <a title="Dashboard" href="dashboard" class="nav-link" <?= ($sidebarRoute == 'dashboard') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">dashboard</span>
    <span class="nav-label">Dashboard</span>
  </a>
  <!-- End of Dashboard Nav-Link -->

  <!-- Users - Nav-Link -->
  <a title="Users" href="users" class="nav-link" <?= ($sidebarRoute == 'users') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">people</span>
    <span class="nav-label">Users</span>
  </a>
  <!-- End of Users Nav-Link -->


  <!-- Products - Nav-Link -->
  <a title="Products" href="products" class="nav-link" <?= ($sidebarRoute == 'products') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">shopping_bag</span>
    <span class="nav-label">Products</span>
  </a>
  <!-- End of Products Nav-Link -->


  <span class="divider horizontal"></span>
  
  
  <!-- Account - Nav-Link -->
  <a title="Account" href="account" class="nav-link" <?= $sidebarRoute == 'account') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">settings</span>
    <span class="nav-label">Account</span>
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
<?php else if (!$sidebarForAdmin): ?>
<!-- + PHP (1): ...show the normal / default side-bar -->



<!-- Default Side Bar -->
<nav id="sideBar" class="flex-layout vertical" <?= ($sidebarIsConnected) ? 'connected' : '' ?>>
  <!-- Icon-Wrapper -->
  <a title="Home" 
    href="home"
    class="nav-link icon-wrapper" <?= ($sidebarRoute == 'home')  ? 'active' : '' ?>>

    <!-- App-Logo -->
    <span class="app-logo"></span> <!-- UX: Use `home` material-icon instead ? -->
    <!-- End of App-Logo -->

  </a>
  <!-- End of Icon-Wrapper -->
  
  <span flex></span>

  <!-- Home - Nav-Link -->
  <a title="Home" href="/" class="nav-link" <?= ($sidebarRoute == 'home') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">home</span>
    <span class="nav-label">Home</span>
  </a>
  <!-- End of Home Nav-Link -->

  <!-- Likes - Nav-Link -->
  <a title="Liked products" href="likes" class="nav-link" <?= ($sidebarRoute == 'likes') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">heart</span>
    <span class="nav-label">Likes</span>
  </a>
  <!-- End of Likes Nav-Link -->


  <!-- Cart - Nav-Link -->
  <a title="Cart" href="cart" class="nav-link" <?= ($sidebarRoute == 'cart') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">shopping_cart</span>
    <span class="nav-label">Cart</span>
  </a>
  <!-- End of Products Nav-Link -->


  <span class="divider horizontal"></span>
  
  
  <!-- Account - Nav-Link -->
  <a title="Account" href="account" class="nav-link" <?= $sidebarRoute == 'account') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">settings</span>
    <span class="nav-label">Account</span>
  </a>
  <!-- End of Account Nav-Link -->


  <span flex></span>



  <!-- PHP(2): If the side bar *IS CONNECTED* ...-->
  <?php if ($sidebarIsConnected): ?>
  <!-- PHP(2): ...show the user initials -->

    <!-- Profile - Nav-Link -->
    <a title="Profile" href="account/profile" class="nav-link profile">
      <span initials><?= $sidebarInit ?></span>
    </a>
    <!-- End of Profile Nav-Link -->

  <!-- + PHP(2): If the side bar *IS NOT CONNECTED* ...-->
  <?php else: ?>
  <!-- + PHP(2): ...show person icon with link to 'auth' page -->

  <a title="Login / Register" href="auth" class="nav-link">
    <span class="material-icons nav-icon">person</span>
  </a>

  <?php endif; ?>
  <!-- End of PHP(2): If the nav bar *IS CONNECTED* -->

  <!-- Horizontal Divider -->
  <span class="divider vertical right"></span>
</nav>
<!-- End of Side Bar -->

<?php endif; ?>
<!-- End of PHP (1) -->
