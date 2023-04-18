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
* @name Nav Bar Component - ddd
* @file nav-bar.php
* @demo demo/nav-bar.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1-|> <?php define('__BASE__', 'components'); ?>
*    -|>
*    -|> <?php 
*    -|>    $_GET['navbar_type'] = 'horizontal'; 
*    -|>    $_GET['navbar_page'] = 'profil';
*    -|>    $_GET['navbar_init'] = 'ab'; 
*    -|>    $_GET['navbar_connected'] = 'true'; 
*    -|>    $_GET['navbar_res'] = 'false'; 
*    -|> ?>
*    -|>
*    -|> <?php include __BASE__ . 'nav-bar.php'; ?>
*
*   2-|> open http://localhost/module-connexion/components/demo/nav-bar.php
* 
*/


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: I'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/


// Let's define some constant variables, shall we ?

// NAVBAR_TYPE 
define('NAVBAR_TYPE', 'navbar_type');
// NAVBAR_TYPE DEFAULT
define('NAVBAR_TYPE_DEFAULT', 'horizontal');



// Using our beloved / basic ternary statment:
 
// Get the type of navbar as `navbarType`,
// but assign the `NAVBAR_TYPE_DEFAULT` value to `navbarType` variable, if there's no `type` parameter
$navbarType = isset($_GET[NAVBAR_TYPE]) ? $_GET[NAVBAR_TYPE] : NAVBAR_TYPE_DEFAULT;

// Check if this navbar is `horizontal`
$isNavbarHorizontal = ($navbarType == 'horizontal') ? true : false;
// Check if navbar is `vertical`
$isNavbarVertical = ($navbarType == 'vertical') ? true : false;


// DEBUG [4dbsmaster]: tell me about it :)
// echo "navbarType => $navbarType <br/> ";
// echo "isNavbarHorizontal ? " . json_encode($isNavbarHorizontal) . "<br>";
// echo "isVertical ? " . json_encode($isNavbarVertical) . "<br>";
?>


<!-- PHP (1): If the nav bar should be vertical... -->
<?php if ($isNavbarVertical) : ?>
<!-- PHP (1): ...show the vertical nav-bar -->

<!-- Vertical Nav Bar -->
<nav class="nav-bar vertical flex-layout" <?php echo ($_GET['navbar_res'] == 'true') ? 'responsive' : '' ?>>
  <!-- Icon-Wrapper -->
  <a title="Home" 
    href="<?php echo ($_GET['navbar_page'] == 'admin') ? 'admin.php' : 'index.php' ?>" 
    class="nav-link icon-wrapper" <?php echo (($_GET['navbar_page'] == 'home') || ($_GET['navbar_page'] == 'admin'))  ? 'active' : '' ?>>
    <!-- App-Logo -->
    <span class="app-logo"></span> <!-- UX: Use `home` material-icon instead ? -->
    <!-- End of App-Logo -->
  </a>
  <!-- End of Icon-Wrapper -->
  
  <span flex></span>


  <!-- PHP (3): If the current page is `admin` ... -->
  <?php if ($_GET['navbar_page'] == 'admin') : ?>
  <!-- PHP (3): ...show the users and dashboard nav-links -->

  <!-- Users - Nav-Link -->
  <a title="Users" href="admin.php?route=users" class="nav-link" <?php echo ($_GET['navbar_route'] == 'users') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">people</span>
  </a>
  <!-- End of Users Nav-Link -->


  <!-- Dashboard - Nav-Link [disabled] -->
  <a title="Dashboard" href="admin.php?route=dashboard" class="nav-link" <?php echo ($_GET['navbar_route'] == 'dashboard') ? 'active' : '' ?> disabled>
    <span class="material-icons nav-icon">dashboard</span>
  </a>
  <!-- End of Dashboard Nav-Link -->

  <!-- PHP (else): Current page *IS NOT* `admin`...  -->
  <?php else : ?> 
  <!-- PHP (else): ...show the DDD Studio - Nav-Link  -->


  <!-- DDD Studio - Nav-Link -->
  <a title="DDD Studio" href="ddd-studio.php" class="nav-link" <?php echo ($_GET['navbar_page'] == 'ddd-studio') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">view_in_ar</span>
  </a>
  <!-- End of DDD Studio Nav-Link -->

  <?php endif; ?>
  <!-- End of PHP (3) -->


  
  <!-- Profile - Nav-Link -->
  <a title="Profile" href="profil.php" class="nav-link" <?php echo ($_GET['navbar_page'] == 'profil') ? 'active' : '' ?>>
    
    <!-- PHP: If the navbar *IS* connected ... -->
    <?php if ($_GET['navbar_connected'] == 'true'): ?>
    <!-- PHP: ...show the initials -->
    
    <!-- Initials -->
    <span class="initials nav-icon"><?php echo $_GET['navbar_init'] ?></span>

    <!-- PHP: If the navbar *IS NOT* connected ... -->
    <?php else: ?>
    <!-- PHP: ...show the `account_circle` icon -->

    <span class="material-icons nav-icon">account_circle</span>

    <?php endif; ?>
    <!-- End of PHP: If the navbar *IS* or *IS NOT* connected -->

  </a>
  <!-- End of Profile Nav-Link -->

  <span class="divider horizontal"></span>

  
  <!-- Settings - Nav-Link -->
  <a title="Settings" href="settings.php" class="nav-link" <?php echo ($_GET['navbar_page'] == 'settings') ? 'active' : '' ?>>
    <span class="material-icons">settings</span>
  </a>
  <!-- End of Settings Nav-Link -->
  

  <span flex></span>


  <!-- PHP: If the nav bar *IS CONNECTED* ...-->
  <?php if ($_GET['navbar_connected'] == 'true'): ?>
  <!-- PHP: ...show the log out nav-link -->

  <!-- LogOut - Nav-Link -->
  <a title="Log out" href="logout.php" class="nav-link">
    <span class="material-icons nav-icon">power_settings_new</span>
  </a>
  <!-- End of Profile Nav-Link -->

  <?php endif; ?>
  <!-- End of PHP: If the nav bar *IS CONNECTED* -->

  <!-- Horizontal Divider -->
  <span class="divider vertical right"></span>
</nav>
<!-- End of Vertical Nav Bar -->

<?php endif; ?>
<!-- End of PHP (1) -->


<!-- PHP (2): If the nav bar should be horizontal... -->
<?php if ($isNavbarHorizontal) : ?>
<!-- PHP (2): ...show the horizontal nav-bar -->

<!-- Horizontal Nav Bar -->
<nav class="nav-bar horizontal flex-layout center" <?php echo ($_GET['navbar_res'] == 'true') ? 'responsive' : '' ?>>
  <span class="divider horizontal top"></span>

  <!-- PHP (4): If the current page is `admin` ... -->
  <?php if ($_GET['navbar_page'] == 'admin') : ?>
  <!-- PHP (4): ...show the Users Nav-Link -->

  <!-- Users - Nav-Link -->
  <a title="Users" href="admin.php?route=users" class="nav-link" <?php echo ($_GET['navbar_route'] == 'users') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">people</span>
  </a>
  <!-- End of Users Nav-Link -->

  <!-- PHP (else): Current page *IS NOT* `admin`...  -->
  <?php else : ?> 
  <!-- PHP (else): ...show the DDD Studio - Nav-Link  -->

  <!-- DDD Studio - Nav-Link -->
  <a title="DDD Studio" href="ddd-studio.php" class="nav-link" <?php echo ($_GET['navbar_page'] == 'ddd-studio') ? 'active' : '' ?>>
    <span class="material-icons nav-icon">view_in_ar</span>
  </a>
  <!-- End of DDD Studio - Nav-Link -->

  <?php endif; ?>
  <!-- End of PHP (4) -->

  
  <span flex></span> <!-- HACK: Just a temp. fix :) -->

  <!-- Icon-Wrapper -->
  <a title="Home" 
    href="<?php echo ($_GET['navbar_page'] == 'admin') ? 'admin.php' : 'index.php' ?>" 
    class="nav-link icon-wrapper" <?php echo (($_GET['navbar_page'] == 'home') || ($_GET['navbar_page'] == 'admin'))  ? 'active' : '' ?> >
    <!-- App-Logo -->
    <span class="app-logo"></span> <!-- UX: Use `home` material-icon instead ? -->
    <!-- End of App-Logo -->
  </a>
  <!-- End of Icon-Wrapper -->


  <span flex></span> <!-- HACK: Just a temp. fix :) -->
  
  <!-- Profile - Nav-Link -->
  <a title="Profile" href="profil.php" class="nav-link" <?php echo ($_GET['navbar_page'] == 'profil') ? 'active' : '' ?>>
    <!-- PHP: If the navbar *IS* connected ... -->
    <?php if ($_GET['navbar_connected'] == 'true'): ?>
    <!-- PHP: ...show the initials -->
    
    <!-- Initials -->
    <span class="initials"><?php echo $_GET['navbar_init'] ?></span>

    <!-- PHP: If the navbar *IS NOT* connected ... -->
    <?php else: ?>
    <!-- PHP: ...show the `account_circle` icon -->

    <span class="material-icons nav-icon">account_circle</span>

    <?php endif; ?>
    <!-- End of PHP: If the navbar *IS* or *IS NOT* connected -->
  </a>
  <!-- End of Profile Nav-Link -->
  
</nav>
<!-- End of Horizontal Nav Bar -->

<?php endif; ?>
<!-- End of PHP (2) -->
