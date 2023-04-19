<?php
?>
<!DOCTYPE html>
<html lang="en">
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
  <!-- <link rel="stylesheet" href="assets/theme/styles.css"> -->
  
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
  <script src="src/app.js" defer></script>
  <script src="src/scripts/admin-product.js" defer></script>
  
</head>
<!-- End of HEAD -->
<body class="theme dark" fullbleed>

  <!-- Main part -->
<h1>Gestion des produits</h1>
<?php
//var_dump($products);
//echo $products[0]['name'];

for ($i = 0; $i <count($products); $i++) {
    echo "<div id=".$products[$i]['id']." data-product-id=".$products[$i]['id']." class='update-product'>".$products[$i]['id']." ".$products[$i]['name']." Prix : ".$products[$i]['price']." Stock : ".$products[$i]['stock'].
    "<a href='admin/product/".$products[$i]['id']."'>Modifier</a> <button id='".$products[$i]['id']."' class='deleteproduct'>Supprimer</button></div><br>";
}


?>
   

   <!-- Aside part -->
  <aside class="flex-layout vertical" hidden>...</aside>

<!-- Default Backdrop -->
<div id="backdrop" hidden></div>

<!-- Default Menus -->
<div id="menus" hidden></div>

<!-- Default Dialogs -->
<div id="dialogs" hidden></div>

<!-- Default Toasts -->
<div id="toasts" hidden></div>

</body>

</html>   