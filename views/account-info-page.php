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
* @name Account Info Page - Maxaboom
* @file account-info-page.php
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
* -  
*
* ~~~~~~~~ (English) ~~~~~~~~~
* 
* - 
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
    <title>Info - Account - Maxaboom</title>


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
    <link rel="stylesheet" href="assets/stylesheets/account-styles.css">
    <link rel="stylesheet" href="assets/stylesheets/account-info-styles.css">


    <!-- Script -->
    <script>

      // Let's do some stuff when this page loads...
      window.addEventListener('load', (event) => { 
        // ...do something awesome here ;)
      });
      
    </script>
    
    <!-- Some more script for ya! #LOL -->
    <script src="src/app.js" type="module" defer></script>
    <script src="src/scripts/account.js" type="module" defer></script>
    <script src="src/scripts/account-info.js" type="module" defer></script>
    
  </head>
  <!-- End of HEAD -->
  
  
  <!-- BODY | Default Theme: light -->
  <body class="theme <?= $this->theme ?>" fullbleed>

    <!-- Side Bar -->
    <!-- PHP: Include the `sideBar` component -->
    <?php
      $_GET['sidebar_route'] = 'account';
      $_GET['sidebar_init'] = $this->user->getInitials();
      $_GET['sidebar_connected'] = $this->user->isConnected(); // TRUE if the user is connected
      $_GET['sidebar_for_admin'] = $this->user->isAdmin(); // TRUE if the user is an admin

      require __DIR__ . '/components/side-bar.php';
    ?>
    <!-- End of Side Bar -->

    <!-- MAIN -->
    <main class="flex-layout vertical">

      <!-- App-Layout of MAIN -->
      <div class="app-layout">
        <!-- Header -->
        <header>

          <!-- App Bar -->
          <div class="app-bar">

            <!-- Title Wrapper -->
            <div class="title-wrapper">
              <!-- Title -->
              <h2 class="app-title">My Account</h2>
            </div>

            <!-- Like - Icon Button -->
            <button id="likeIconButton" class="icon-button" title="Like Product" onclick="mbApp.showMenuById('accountMenu', 0.5, mbApp.getPartByName('main'))">
              <span class="material-icons icon">more_vert</span>
            </button>
          </div>
          <!-- End of App Bar -->

          <!-- Horizontal Divider -->
          <span class="divider horizontal bottom" hidden></span>
        </header>

        <!-- [content] -->
        <div content>

          <!-- Container -->
          <div class="container vertical flex-layout">

            <!-- PHP (1): If the user is connected... -->
            <?php if ($this->user->isConnected()): ?>
            <!-- ...PHP (1): Show the user's initials and fullname -->

            <!-- Initials & Fullname -->
            <div class="init-fullname">
              <span init><?= $this->user->getInitials() ?></span>
              <span fullname><?= $this->getFullname() ?></span>
            </div>
            <!-- End of Initials & Fullname -->

            <?php endif; ?>
            <!-- End of PHP (1) -->

            <!-- Account List / Links -->
            <ul id="accountList" naked>


              <?php foreach ($this->listData as $listItemId => $listItemData): ?>
              <li class="label"><?= $listItemData['title'] ?></li>

              <ul class="list-items links <?= $listItemId ?>" naked>

                <?php foreach ($listItemData['items'] as $accountListItemId => $accountListItemData): ?>

                <li id="<?= $accountListItemId?>" class="account-list-item link-item" 
                  <?= ($accountListItemId === $this::PAGE_INFO) ? 'active' : ''?>>
                  <a href="<?= $accountListItemData['link']?>" 
                     role="button" 
                     tabindex="0" 
                     class="horizontal flex-layout center" naked>
                    <!-- Text Wrapper -->
                    <div class="text-wrapper flex-layout vertical">
                      <h3><?= $accountListItemData['title'] ?></h3>
                      <h4><?= $accountListItemData['description'] ?></h4>
                    </div>
                    <span class="material-icons arrow icon">chevron_right</span>
                  </a>
                </li>

                <?php if ($accountListItemId === 'info'): ?>
                <li class="divider-wrapper"><span class="divider horizontal"></span></li>
                <?php endif;?>


                <?php endforeach; ?>

              </ul>

              <?php endforeach; ?>

            </ul>
            <!-- End of Account List -->

            <!-- PHP (2): If the user is connected... -->
            <?php if ($this->user->isConnected()): ?>
            <!-- ...PHP (2): Show the log out and delete account buttons -->

            <!-- Log Out - Button -->
            <button id="logoutButton" outlined><?= $this->i18n->getString("log_out") ?></button>
            <!-- Delete Account - Button -->
            <button id="deleteAccountButton" naked><?= $this->i18n->getString("deleteYourAccount") ?></button>

            <?php endif; ?>
            <!-- End of PHP (2) -->

          </div>
          <!-- End of Container -->


        </div>
        <!-- End of [content] -->

      </div>
      <!-- End of App-Layout -->

      <!-- Nav Bar -->
      <!-- PHP: Include the `navBar` component -->
      <?php
        $_GET['navbar_route'] = 'account';
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
        <!-- Menu -->
        <menu data-id="accountMenu" class="menu vertical flex-layout" hidden>

            <!-- Close Menu + Icon Button -->
            <li role="close-menu">
                <button class="icon-button"><span class="material-icons icon">arrow_back_ios</span></button>
            </li>
                
            <!-- MenuItem 1 -->
            <li title="Edit your profile information" class="menu-item">
              <a role="button" tabindex="0" href="account/info">
                <span class="material-icons icon">edit</span>
                <span>Edit profile</span>
              </a>
            </li>

            <!-- MenuItem 2 -->
            <li title="View all your orders" class="menu-item">
              <a role="button" tabindex="0" href="account/orders">
                <span class="material-icons icon">music_video</span>
                <span>View Orders</span>
              </a>
            </li>

            <!-- MenuItem 3 -->
            <li title="See more about Maxaboom" class="menu-item">
              <a role="button" tabindex="0" href="account/about">
                <span class="material-icons icon">info</span>
                <span>About Maxaboom</span>
              </a>
            </li>
        </menu>
          <!-- End of Menu -->
      </div>

      <!-- Dialogs of MAIN -->
      <div class="dialogs" fit hidden></div>

      <!-- Toasts of MAIN -->
      <div class="toasts" fit hidden></div>


    </main>
    <!-- End of MAIN -->

    

    <!-- ASIDE -->
    <aside class="flex-layout vertical" opened>
      <!-- App Layout - ASIDE -->
      <div class="app-layout" fit>

        <!-- Header -->
        <header>
          <!-- App Bar -->
          <div class="app-bar fade-in">
            <!-- Back Icon Button -->
            <a href="account" role="icon-button" tabindex="0" class="icon-button" narrow-and-tablet-only>
              <span class="material-icons icon">arrow_back_ios</span>
            </a>

            <!-- Title Wrapper -->
            <div class="title-wrapper">
              <h2 class="app-title"><?= $this->i18n->getString('yourInformation') ?></h2>
            </div>
          </div>
          <!-- End of App Bar -->
        </header>
        <!-- End of Header -->

        <!-- [content] -->
        <div content>
          <!-- PHP (3): If the user is connected... -->
          <?php if ($this->user->isConnected()): ?>
          <!-- ...PHP (3): Show the [connected] container -->

          <!-- [connected] Container -->
          <div class="container vertical flex-layout" connected>
            <!-- Bigger Initials -->
            <span class="bigger" init ><?= $this->user->getInitials() ?></span>

            <!-- Account Info - Links -->
            <ul id="accountInfo" class="links list-items account-info" naked>

              <?php foreach ($this->getInfoLinks() as $infoLinkId => $infoLinkData): ?>

              <li id="<?= $infoLinkId ?>" class="link-item" 
                <?= ($infoLinkId === $view) ? 'active' : ''?>>
                <a href="<?= $infoLinkData['link']?>" 
                   role="button" 
                   tabindex="0" 
                   class="horizontal flex-layout center" naked>
                  <!-- Text Wrapper -->
                  <div class="text-wrapper flex-layout vertical">
                    <h3><?= $infoLinkData['title'] ?></h3>
                    <h4><?= $infoLinkData['description'] ?></h4>
                  </div>
                  <span class="material-icons arrow icon">chevron_right</span>
                </a>
              </li>

              <?php endforeach; ?>

            </ul>
            <!-- End of Account Info - Links -->

          </div>
          <!-- End of [connected] Container -->


          <?php else: ?><!-- PHP (4|else): If the user is not connected... -->
          <!-- ...PHP (4): Show the [not-connected] container -->
          
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
          <!-- End of PHP (4) -->

        </div>

      </div>
      <!-- End of App Layout - ASIDE -->


      <!-- PHP (5): If the info view is 'identity'... -->
      <?php if ($view === self::VIEW_INFO_IDENTITY): ?>
      <!-- ...PHP (5): Show the corresponding app-layout view -->
      
      <!--  Info Identity - App-Layout - View -->
      <div class="info-identity view app-layout slide-from-down" fit>
        <!-- Identity - Header -->
        <header>
          <div class="app-bar">
            <div class="title-wrapper">
              <h2 class="app-title"><?= $this->i18n->getString('identity') ?></h2>
              <h3 class="app-subtitle">*&nbsp;<?= $this->i18n->getString('mandatoryField') ?></h3>
            </div>
          </div>

          <span class="divider horizontal bottom"></span>
        </header>
        <!-- End of Identity - Header -->

        <!-- Identity - [content] -->
        <div content>
          <div class="container vertical flex-layout">
            <!-- Identity Form -->
            <form id="identityForm" class="vertical flex-layout flex" novalidate>

              <!-- First Name - Input-Wrapper -->
              <div class="input-wrapper vertical flex-layout">
                <label for="firstNameInput"><?= $this->i18n->getString('firstName') ?>*</label>
                <input id="firstNameInput" type="text" required
                  name="firstName" 
                  value="<?= $this->user->getFirstName() ?>"
                  minlength="2" maxlength="30"
                  pattern="^[a-zA-Z\u00C0-\u017F]{2,30}$"
                  >
                <span class="input-indicator"><span bar></span><span val></span></span>

                <!-- Input Message  -->
                <p class="input-message fade-in error" hidden>Incorrect first name</p>
              </div>


              <!-- Last Name - Input-Wrapper -->
              <div class="input-wrapper vertical flex-layout">
                <label for="lastNameInput"><?= $this->i18n->getString('lastName') ?>*</label>
                <input type="text" id="lastNameInput" required
                  name="lastName" 
                  value="<?= $this->user->getLastName() ?>"
                  minlength="2" maxlength="30"
                  pattern="^[a-zA-Z\u00C0-\u017F]{2,30}$"
                  >

                <span class="input-indicator"><span bar></span><span val></span></span>

                <!-- Input Message  -->
                <p class="input-message fade-in error" hidden>Incorrect last name</p>
              </div>


              <!-- Date of Birth - Input-Wrapper -->
              <div class="input-wrapper vertical flex-layout">
                <label for="dateOfBirthInput"><?= $this->i18n->getString('dateOfBirth') . " (" . $this->i18n->getString('dobFormat') . ")" ?></label>
                <input type="text" pattern="[0-9/]*" id="dateOfBirthInput" name="dateOfBirth" value="<?= $this->user->getDateOfBirth() ?>">

                <span class="input-indicator"><span bar></span><span val></span></span>
                
                <!-- Input Message  -->
                <p class="input-message fade-in error" hidden>Incorrect last name</p>

              </div>

              <span flex></span>
            
              <div class="buttons vertical flex-layout">

                <!-- Save Identity - Button -->
                <button type="submit" id="saveIdentityButton" confirm contained>
                  <span><?= $this->i18n->getString('save') ?></span>
                </button>

                <!-- Cancel Identity - Button -->
                <button type="button" id="cancelIdentityButton" class="cancel-btn" cancel outlined>
                  <span><?= $this->i18n->getString('cancel') ?></span>
                </button>
              </div>

            </form>
            <!-- End of Identity Form -->

          </div> 
        </div>
        <!-- End of Identity - [content] -->

      </div>
      <!-- End of Info Identity - App-Layout - View -->

      <?php endif; ?>
      <!-- End of PHP(5) -->



      <!-- PHP (6): If the info view is 'email'... -->
      <?php if ($view === self::VIEW_INFO_EMAIL): ?>
      <!-- ...PHP (6): Show the corresponding app-layout view -->


      <!--  Info Email - App-Layout - View -->
      <div class="info-email view app-layout slide-from-down" fit>
        <!-- Email - Header -->
        <header>
          <div class="app-bar">
            <div class="title-wrapper">
              <h2 class="app-title"><?= $this->i18n->getString('email') ?></h2>
              <h3 class="app-subtitle">*&nbsp;<?= $this->i18n->getString('mandatoryField') ?></h3>
            </div>
          </div>

          <span class="divider horizontal bottom"></span>
        </header>
        <!-- End of Email - Header -->

        <!-- Email - [content] -->
        <div content>
          <div class="container vertical flex-layout">
            <!-- Email Form -->
            <form id="emailForm" class="vertical flex-layout flex">

              <!-- New Email - Input-Wrapper -->
              <div class="input-wrapper vertical flex-layout">
                <label for="newEmailInput" raised><?= $this->i18n->getString('newEmail') ?>*</label>
                <input type="email" id="newEmailInput" name="newEmail" placeholder="<?= $this->i18n->getString("exampleEmail") ?>" required>
                <span class="input-indicator"><span bar></span><span val></span></span>


                <!-- Input Message  -->
                <p class="input-message fade-in error" hidden>Incorrect email</p>
              </div>

              <!-- Confirm New Email - Input-Wrapper -->
              <div class="input-wrapper vertical flex-layout">
                <label for="confirmNewEmailInput" raised><?= $this->i18n->getString('confirmNewEmail') ?>*</label>
                <input type="email" id="confirmNewEmailInput" name="confirmNewEmail" placeholder="<?= $this->i18n->getString("exampleEmail") ?>" required>
                <span class="input-indicator"><span bar></span><span val></span></span>
                
                <!-- Input Message  -->
                <p class="input-message fade-in error" hidden>Incorrect confirm email</p>
              </div>


              <span flex></span>
            
              <div class="buttons vertical flex-layout">

                <!-- Change Email - Button -->
                <button type="submit" id="changeEmailButton" confirm contained>
                  <span><?= $this->i18n->getString('changeEmail') ?></span>
                </button>

                <!-- Cancel Email - Button -->
                <button type="button" id="cancelEmailButton" class="cancel-btn" cancel outlined>
                  <span><?= $this->i18n->getString('cancel') ?></span>
                </button>
              </div>

            </form>
            <!-- End of Email Form -->
          </div> 
        </div>
        <!-- End of Email - [content] -->

      </div>
      <!-- End of Info Email - App-Layout - View -->

      <?php endif; ?>
      <!-- End of PHP(6) -->




      <!-- PHP (6): If the info view is 'password'... -->
      <?php if ($view === self::VIEW_INFO_PASSWORD): ?>
      <!-- ...PHP (6): Show the corresponding app-layout view -->


      <!--  Info Password - App-Layout - View -->
      <div class="info-password view app-layout slide-from-down" fit>
        <!-- Password - Header -->
        <header>
          <div class="app-bar">
            <div class="title-wrapper">
              <h2 class="app-title"><?= $this->i18n->getString('password') ?></h2>
              <h3 class="app-subtitle">*&nbsp;<?= $this->i18n->getString('mandatoryField') ?></h3>
            </div>
          </div>
          <span class="divider horizontal bottom"></span>
        </header>
        <!-- End of Password - Header -->

        <!-- Password - [content] -->
        <div content>
          <div class="container vertical flex-layout">
            <!-- Password Form -->
            <form id="passwordForm" class="vertical flex-layout flex">

              <!-- Old Password - Input-Wrapper -->
              <div class="input-wrapper vertical flex-layout">
                <label for="oldPasswordInput"><?= $this->i18n->getString('oldPassword') ?>*</label>

                <div class="horizontal flex-layout">

                  <!-- Old Password - Input -->
                  <input type="password" id="oldPasswordInput" name="oldPassword" required>
                  <!-- Toggle Password - Icon Button -->
                  <button type="button" tabindex="-1" class="icon-button" onclick="mbApp.togglePasswordInputById('oldPasswordInput')">
                    <span class="material-icons">visibility</span>
                  </button>
    
                  <span class="input-indicator"><span bar></span><span val></span></span>
                </div>


                <!-- Input Message  -->
                <p class="input-message fade-in error" hidden>Incorrect password</p>

              </div>
              <!-- End of Old Password - Input-Wrapper -->




              <!-- New Password - Input-Wrapper -->
              <div class="input-wrapper vertical flex-layout">
                <!-- Label -->
                <label for="newPasswordInput"><?= $this->i18n->getString('newPassword') ?>*</label>

                <div class="horizontal flex-layout">

                  <!-- New Password - Input -->
                  <input type="password" id="newPasswordInput" name="newPassword" required>

                  <!-- Toggle Password - Icon Button -->
                  <button type="button" tabindex="-1" class="icon-button" onclick="mbApp.togglePasswordInputById('newPasswordInput')">
                    <span class="material-icons">visibility</span>
                  </button>

                  <!-- Indicator -->
                  <span class="input-indicator"><span bar></span><span val></span></span>
                </div>

                <!-- Input Message  -->
                <p class="input-message fade-in error" hidden>Incorrect password</p>

              </div>
              <!-- End of New Password - Input-Wrapper -->



              <!-- Confirm New Password - Input-Wrapper -->
              <div class="input-wrapper vertical flex-layout">
                <!-- Label -->
                <label for="confirmNewPasswordInput"><?= $this->i18n->getString('confirmNewPassword') ?>*</label>

                <div class="horizontal flex-layout">

                  <!-- Confirm New Password - Input -->
                  <input type="password" id="confirmNewPasswordInput" name="confirmNewPassword" required>

                  <!-- Toggle Password - Icon Button -->
                  <button type="button" tabindex="-1" class="icon-button" onclick="mbApp.togglePasswordInputById('confirmNewPasswordInput')">
                    <span class="material-icons">visibility</span>
                  </button>

                  <!-- Indicator -->
                  <span class="input-indicator"><span bar></span><span val></span></span>
                </div>


                <!-- Input Message  -->
                <p class="input-message fade-in error" hidden>Incorrect password</p>

              </div>
              <!-- End of Confirm New Password - Input-Wrapper -->



              <span flex></span>


              <div class="buttons vertical flex-layout">
                <!-- Change Password - Button -->
                <button type="submit" id="changePasswordButton" confirm contained>
                  <span><?= $this->i18n->getString('changePassword') ?></span>
                </button>

                <!-- Cancel Change Password - Button -->
                <button type="button" id="cancelChangePasswordButton" class="cancel-btn" cancel outlined>
                  <span><?= $this->i18n->getString('cancel') ?></span>
                </button>

              </div>

            </form>
            <!-- End of Password Form -->
            
          </div> 
          <!-- End of Container -->

        </div>
        <!-- End of Password - [content] -->

      </div>
      <!-- End of Info Password - App-Layout - View -->

      <?php endif; ?>
      <!-- End of PHP(6) -->


      <!-- Backdrop of MAIN -->
      <div class="backdrop" fit hidden></div>

      <!-- Menus of MAIN -->
      <div class="menus" fit hidden></div>

      <!-- Dialogs of MAIN -->
      <div class="dialogs" fit hidden></div>

      <!-- Toasts of MAIN -->
      <div class="toasts" fit hidden></div>


      <!-- Vertical Left - DIVIDER -->
      <span class="divider vertical left"></span>
    </aside>
    <!-- End of ASIDE -->
    

    <!-- Backdrop -->
    <div id="backdrop" fit hidden></div>


    <!-- Menus  -->
    <div id="menus" fit hidden></div>
    <!-- End of Menus  -->

    <!-- Dialogs  -->
    <div id="dialogs" fit hidden></div>
    <!-- End of Dialogs  -->

    <!-- Toasts -->
    <div id="toasts" fit hidden></div>
    <!-- End of Toasts -->

  </body>
  <!-- End of BODY -->

</html>
<!-- End of HTML -->
