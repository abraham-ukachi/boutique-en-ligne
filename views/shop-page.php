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
    <!-- <link rel='stylesheet' href='assets/stylesheets/home-styles.css'> -->

    <!-- Script -->
    <script>

        // Let's do some stuff when this page loads...
        window.addEventListener('load', (event) => {
            // ...do something awesome here ;)
        });

    </script>

    <!-- Some more script for ya! #LOL -->
    <script type='module' src='src/app.js' defer></script>
    <script src='src/scripts/shop.js' defer></script>

</head>
<!-- End of HEAD -->
<body class='theme light' fullbleed
      data-category-name="<?= $this->categoryName?>"
      data-category-id="<?= $this->categoryId?>"
      data-sub-category-name="<?= $this->subCategoryName?>"
      data-sub-category-id="<?= $this->subCategoryId ?>";
>

<!-- Side Bar -->
<!-- PHP: Include the `sideBar` component -->
<?php
$_GET['sidebar_route'] = 'home';
$_GET['sidebar_init'] = $this->user->getInitials();
$_GET['sidebar_connected'] = $this->user->isConnected(); // TRUE if the user is connected
$_GET['sidebar_for_admin'] = false; // TRUE if the user is an admin

require __DIR__ . '/components/side-bar.php';
?>
<!-- End of Side Bar -->

<!-- Main part -->
<main class='flex-layout vertical'>

    <!-- App-Layout of MAIN -->
    <div class='app-layout' fit>
        <!-- Header -->
        <header>
            <!-- App Bar -->
            <!-- TIP: Add a [sticky] property to the app-bar, to fall in love ;) -->
            <div class='app-bar'>
                <!-- Title Wrapper -->
                <div class='title-wrapper'>
                    <!-- Title -->
                    <h2 class='app-title'>Shop</h2>
                    <!-- Subtitle -->
                    <h3 class='app-subtitle'>Maxaboom, la référence des instruments de musique !</h3>
                </div>
            </div>
            <!-- End of App Bar -->

            <!-- Horizontal Divider -->
            <span class='divider horizontal bottom'></span>
        </header>

        <!-- [content] -->
        <div content>
            <div class='app-layout'>
                <h1>Shop @ Maxaboom!</h1>
                <p>welcome to the shop page of <b>Maxaboom</b> 🛍</p>
                <a href='home'>Go back to <b>home page</b></a>
            </div>
        </div>
    </div>

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

    <ul style='overflow:scroll'>
        <!--  CATEGORIES LIST HERE -->
        <?php foreach ($categories as $category): ?>
            <li>
                <button class="category-link" onclick="handleCategoryLinkClick(this)" data-category-id="<?=$category['id'] ?>" data-category-name="<?=$category['name']?>" <?= ($category['name'] === $this->categoryName) ? 'active': '' ?>> <?=$category['name'] ?></button>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- SUBCATEGORY LIST HERE -->
    <nav id="subCategoriesList"></nav>

    <!-- PRODUCT LIST HERE -->
    <ul id="productsList" style='overflow:scroll'></ul>

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