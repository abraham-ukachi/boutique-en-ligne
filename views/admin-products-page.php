<?php
?>
<!DOCTYPE html>
<html lang="en">
    <!-- HEAD -->
<head>
  <!-- Our 4 VIP metas -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=yes">
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
  <!-- <link rel="stylesheet" href="assets/stylesheets/home-styles.css"> -->

  <!-- Script -->
  <script>

    // Let's do some stuff when this page loads...
    window.addEventListener('load', (event) => { 
      // ...do something awesome here ;)
    });
    
  </script>
  
  <!-- Some more script for ya! #LOL -->
  <script type="module" src="src/app.js" defer></script>
  <script type="module" src="src/scripts/admin-product.js" defer></script>
  
</head>
<!-- End of HEAD -->
<body class="theme light" fullbleed>

  <!-- Side Bar -->
    <!-- PHP: Include the `sideBar` component -->
    <?php 
    $_GET['sidebar_route'] = 'home'; 
    $_GET['sidebar_init'] = 'au'; 
    $_GET['sidebar_connected'] = false; // TRUE if the user is connected
    $_GET['sidebar_for_admin'] = false; // TRUE if the user is an admin 

    require __DIR__ . '/components/side-bar.php';
    ?>
    <!-- End of Side Bar -->


  <!-- Main part -->
  <main class="flex-layout vertical">

    <!-- App-Layout of MAIN -->
    <div class="app-layout" fit>
        <!-- Header -->
        <header>
            <!-- App Bar -->
            <div class="app-bar">
                <span flex></span>

                <!-- Account - Icon Button -->
                <a href="account" role="icon-button" tabindex="0" title="Settings">
                <span class="material-icons icon">settings</span>
                </a>
            </div>
            <!-- End of App Bar -->
            <!-- App Bar -->
            <!-- TIP: Add a [sticky] property to the app-bar, to fall in love ;) -->
            <div class="app-bar" sticky>
            <!-- Title Wrapper -->
            <div class="title-wrapper">
                <!-- Title -->
                <h2 class="app-title">Admin</h2>
                <!-- Subtitle -->
                <h3 class="app-subtitle">Products</h3>
            </div>
            </div>
            <!-- End of App Bar -->
            <!-- Horizontal Divider -->
            <span class="divider horizontal bottom"></span>
        </header>

        <!-- [content] -->
        <div content>
            <div class='container'>
            <h1>Gestion des produits</h1>
<?php
//var_dump($products);
//echo $products[0]['name'];

for ($i = 0; $i <count($products); $i++) {
    echo "<div id=".$products[$i]['id']." data-product-id=".$products[$i]['id']." class='update-product'>".$products[$i]['id']." ".$products[$i]['name']." Prix : ".($products[$i]['price']/100)." € Stock : ".$products[$i]['stock'].
    "<a href='admin/product/".$products[$i]['id']."'>Modifier</a> <button id='".$products[$i]['id']."' class='deleteproduct'>Supprimer</button></div><br>";
}


?>
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

    <!-- Fab -->
    <a href="admin/product/create">
          <button class="fab vertical flex-layout centered" contained expands shrinks>
        <span class="material-icons icon">add</span>
    </button>
    </a>

    <!-- End of Fab -->
    
    <!-- Backdrop of MAIN -->
    <div class="backdrop" fit hidden></div>
    
    <!-- Menus of MAIN -->
    <div class="menus" fit hidden></div>
    
    <!-- Dialogs of MAIN -->
    <div class="dialogs" fit hidden></div>
    
    <!-- Toasts of MAIN -->
    <div class="toasts" fit hidden></div>

  </main>

  <aside class="flex-layout vertical" hidden >

    <!-- App-Layout of ASIDE -->
    <div class="app-layout" fit>...</div>

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

  <!-- Default Backdrop -->
  <div id="backdrop" fit hidden></div>

  <!-- Default Menus -->
  <div id="menus" fit hidden>
    <!-- Menu -->
    <menu data-id="supermenu" class="menu vertical flex-layout" hidden>

    <!-- Close Menu + Icon Button -->
    <li role="close-menu">
        <button class="icon-button"><span class="material-icons icon">arrow_back_ios</span></button>
    </li>
        
    <!-- MenuItem 1 -->
    <li title="{{menuItem1Title}}" class="menu-item">
    <button>
        <span class="material-icons icon">post_add</span>
        <span>{{menuItem1Name}}</span>
    </button>
    </li>

    <!-- MenuItem 2 -->
    <li title="{{menuItem2Title}}" class="menu-item">
    <button>
        <span class="material-icons icon">lock</span>
        <span>{{menuItem2Name}}</span>
    </button>
    </li>
    </menu>
    <!-- End of Menu -->
  </div>

  <!-- Default Dialogs -->
  <div id="dialogs" fit hidden></div>

  <!-- Default Toasts -->
  <div id="toasts" fit hidden></div>

</body>
</html>