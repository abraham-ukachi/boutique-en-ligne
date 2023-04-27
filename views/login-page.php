<?php
?>

<!doctype html>
<html lang="fr">
<!-- HEAD -->
<head>
    <!-- Our 4 VIP metas -->
    <meta charset='utf-8'>
    <meta http-equiv='x-ua-compatible' content='IE=edge,chrome=1'>
    <meta name='viewport' content='width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=yes'>
    <meta name='description'
          content='Maxaboom is a fun and dynamic online store that offers a wide variety of musical instruments. From guitars and drums to keyboards, microphones and trumpets.'>

    <!-- Title -->
    <title>Welcome to maxaboom | The #1 online store for all your musical needs</title>

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
    <!-- <link rel='stylesheet' href='assets/animations/slide-from-down-animation.css'> -->

    <!-- Stylesheet -->
    <link rel='stylesheet' href='assets/stylesheets/login-styles.css'>


    <!-- Script -->
    <script>

        // Let's do some stuff when this page loads...
        window.addEventListener('load', (event) => {
            // ...do something awesome here ;)
        });

    </script>

    <!-- Some more script for ya! #LOL -->
    <script type='module' src='src/app.js' defer></script>
    <script src='https://kit.fontawesome.com/75738720bb.js' crossorigin='anonymous'></script>
    <script type='module' src='src/scripts/login.js' defer></script>


</head>
<!-- End of HEAD -->
<body class='theme light' fullbleed>

<!-- Side Bar -->
<nav id='sideBar'>
    <!-- PHP: Include the `sideBar` component -->
    <?php
    $_GET['sidebar_route'] = 'home';
    $_GET['sidebar_init'] = 'au';
    $_GET['sidebar_connected'] = false; // TRUE if the user is connected
    $_GET['sidebar_for_admin'] = false; // TRUE if the user is an admin

    require __DIR__ . '/components/side-bar.php';
    ?>
    <!-- End of Side Bar --></nav>

<!-- Main part -->
<main class='flex-layout vertical'>

    <!-- App-Layout of MAIN -->
    <div class='app-layout' fit>
        <!-- Header -->
        <header>
            <div class='app-layout' fit>
                <!-- Header -->
                <header>
                    <!-- App Bar -->
                    <!-- TIP: Add a [sticky] property to the app-bar, to fall in love ;) -->
                    <div class='app-bar'>
                        <!-- Title Wrapper -->
                        <div class='title-wrapper'>
                            <!-- Title -->
                            <h2 class='app-title'>Login</h2>
                        </div>
                    </div>
                    <!-- End of App Bar -->
                    <!-- Horizontal Divider -->
                    <span class='divider horizontal bottom'></span>
                </header>
            </div>
        </header>

        <!-- [content] -->
        <div content>
            <div class='container'>
                <form id='connectionForm' method='POST'>
                    <!-- Input Wrapper -->
                    <div class='input-wrapper vertical flex-layout'>
                        <!-- Label -->
                        <label for='mail'>Email</label>
                        <!-- Input -->
                        <input type='text' id='mail' name='mail' minlength="3" pattern="^[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$" required>
                        <!-- Indicator -->
                        <span class='input-indicator'><span bar></span><span val></span></span>

                        <!-- Input Message -->
                        <!-- NOTE: Add `error` class, to make this `.input-message` an error message -->
                        <p class='input-message fade-in error' hidden>Incorrect password</p>
                        <!-- End of Input Message -->
                    </div>
                    <!-- End of Input Wrapper -->

                    <!--
                    <div class='input-wrapper'>
                        <label for='mail' raised>mail</label>
                        <input id='mail' class='connect login-connect' name='mail' type='email' value=''>
                        <i class='fas fa-check-circle'></i>
                        <i class='fas fa-exclamation-circle'></i>
                        <small>Erreur</small>
                        <span class='input-indicator'><span bar></span><span val></span></span>
                    </div>
                    -->

                    <!-- Input-Wrapper -->
                    <!-- TIP: Add `[has-error]` attribute / property to `.input-wrapper`, to increase the error input message height -->
                    <div class='input-wrapper vertical flex-layout'>
                        <!-- Label -->
                        <label for='password'>Mot de passe</label>

                        <!-- Horizontal Flex-Layout -->
                        <div class='horizontal flex-layout'>

                            <!-- Input -->
                            <!-- <input type='password' id='password' name='password' minlength="8" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" required> -->

                            <input type='password' id='password' name='password' required>

                            <!-- Toggle Password - Icon Button -->
                            <button type='button' tabindex='-1' class='icon-button'
                                    onclick="mbApp.togglePasswordInputById('password')">
                                <span class='material-icons'>visibility</span>
                            </button>

                            <!-- Indicator -->
                            <!-- TIP: Use the `[no-effect]` attribute / property on `.input-indicator`, to remove the auto-hide / cool effect ;) -->
                            <span class='input-indicator'><span bar></span><span val></span></span>
                        </div>
                        <!-- End of Horizontal Flex-Layout -->

                        <!-- Input Message -->
                        <!-- NOTE: Add `error` class, to make this `.input-message` an error message -->
                        <p class='input-message fade-in error' hidden>Incorrect password</p>
                        <!-- End of Input Message -->

                    </div>
                    <!--
                    <div class='input-wrapper'>
                        <label for='password' raised>Mot de passe</label>
                        <input id='password' class='connect password-connect' name='password' type='password' value=''>
                        <i class='fas fa-check-circle'></i>
                        <i class='fas fa-exclamation-circle'></i>
                        <small>Erreur</small>
                        <span class='input-indicator'><span bar></span><span val></span></span>
                    </div>
                    -->
                    <button type='submit' class='connection_form_button' id='envoie' name='envoie' contained>Se
                        connecter
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- End of App-Layout of MAIN -->


    <!-- Nav Bar -->
    <!-- PHP: Include the `navBar` component -->
    <?php
    $_GET['navbar_route'] = 'home';
    $_GET['navbar_init'] = 'au';
    $_GET['navbar_connected'] = false; // TRUE if the user is connected
    $_GET['navbar_for_admin'] = false; // TRUE if the user is an admin

    require __DIR__ . '/components/nav-bar.php';
    ?>
    <!-- End of Nav Bar -->


    <!-- Backdrop of MAIN -->
    <div class='backdrop' fit hidden></div>

    <!-- Menus of MAIN -->
    <div class='menus' fit hidden></div>

    <!-- Dialogs of MAIN -->
    <div class='dialogs' fit hidden></div>

    <!-- Toasts of MAIN -->
    <div class='toasts' fit hidden></div>

</main>

<!-- Aside part -->
<aside class='flex-layout vertical' hidden>

    <!-- App-Layout of ASIDE -->
    <div class='app-layout' fit>...</div>

    <!-- Backdrop of ASIDE -->
    <div class='backdrop' fit hidden></div>

    <!-- Menus of ASIDE -->s
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
