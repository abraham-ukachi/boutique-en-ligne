<?php
?>
<!doctype html>
<html lang="en">
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
    <script type='module' src='src/scripts/checkout.js' defer></script>

</head>
<!-- End of HEAD -->
<body class='theme light' fullbleed>

<!-- Side Bar -->
<nav id='sideBar'>
    <!-- Side Bar -->
    <!-- PHP: Include the `sideBar` component -->
    <?php
    $_GET['sidebar_route'] = 'home';
    $_GET['sidebar_init'] = $this->user->getInitials();
    $_GET['sidebar_connected'] = $this->user->isConnected();
    $_GET['sidebar_for_admin'] = false; // TRUE if the user is an admin

    require __DIR__ . '/components/side-bar.php';
    ?>
    <!-- End of Side Bar -->
</nav>

<!-- Main part -->
<main class='flex-layout vertical'>

    <div class='app-layout' fit>
        <!-- Header -->
        <header> <!-- App Bar -->
            <!-- TIP: Add a [sticky] property to the app-bar, to fall in love ;) -->
            <div class='app-bar'>
                <!-- Title Wrapper -->
                <div class='title-wrapper'>
                    <!-- Title -->
                    <h2 class='app-title'>Checkout</h2>
                    <span class='divider horizontal bottom'></span>

                </div>
            </div>
            <!-- End of App Bar -->

            <!-- Horizontal Divider -->
            <span class='divider horizontal bottom'></span></header>
        <div content="">
            <div class='container vertical flex-layout deliveryDiv'>

                <form id="deliveryForm" class="vertical flex-layout">
                    <h4>1 / 3</h4>
                    <div class="input-wrapper vertical flex-layout">
                        <label for='standard'><h3>Standard</h3></label>
                        <input id='standard' name='deliveryChoice' type='radio' value='standard'>
                        <p>Livraison entre 3 et <br> 5 jours ouvrés</p>
                        <small>Prix : Gratuit</small>
                    </div>

                    <div class='input-wrapper vertical flex-layout'>
                        <label for='express'><h3>Express</h3></label>
                        <input id='express' name='deliveryChoice' type='radio' value='express'>
                        <p>Livraison en 1 jour <br> ouvré</p>
                        <small>Prix : 18€</small>
                    </div>

                    <div class='input-wrapper vertical flex-layout'>
                        <label for='business'><h3>Business</h3></label>
                        <input id='business' name='deliveryChoice' type='radio' value='business' checked>
                        <p>Livraison en 1 semaine<br> (jours non ouvrés)</p>
                        <small>Prix : 30€</small>
                    </div>

                    <div class='buttons vertical flex-layout'>
                        <button id='delivery' type='button' contained=''>
                            <span>Suivant</span>
                        </button>
                    </div>

                </form>
            </div>

            <div class='container vertical flex-layout addressDiv' hidden>
                <form id='addressForm' class='vertical flex-layout'>
                    <h4>2 / 3</h4>
                    <input type="number" name="id_address" hidden>
                    <div class='input-wrapper vertical flex-layout'>
                        <label for='title' raised=''>Title</label>
                        <input name='title' id='titleInput' type='text' required>
                        <span class='input-indicator'><span bar=''></span><span val=''></span></span>
                        <!-- Input Message -->
                        <!-- NOTE: Add `error` class, to make this `.input-message` an error message -->
                        <p class='input-message fade-in error' hidden></p>
                        <!-- End of Input Message -->
                    </div>

                    <div class='input-wrapper vertical flex-layout'>
                        <label for='address' raised=''>Adresse</label>
                        <input name='address' id='addressValue' type='text' required>
                        <span class='input-indicator'><span bar=''></span><span val=''></span></span>
                        <!-- Input Message -->
                        <!-- NOTE: Add `error` class, to make this `.input-message` an error message -->
                        <p class='input-message fade-in error' hidden></p>
                        <!-- End of Input Message -->
                    </div>

                    <div class='input-wrapper vertical flex-layout'>
                        <label for="addressComplement" raised="">Complément d'adresse</label>
                        <input name="addressComplement" id='addressComplementValue' type='text'>
                        <span class='input-indicator'><span bar=''></span><span val=''></span></span>
                    </div>

                    <div class='input-wrapper vertical flex-layout'>
                        <label for="city" raised>Ville</label>
                        <input name="city" id='cityValue' type='text' pattern="^[A-Za-z\s]*$" minlength="1" required>
                        <span class='input-indicator'><span bar=''></span><span val=''></span></span>
                        <!-- Input Message -->
                        <!-- NOTE: Add `error` class, to make this `.input-message` an error message -->
                        <p class='input-message fade-in error' hidden></p>
                        <!-- End of Input Message -->
                    </div>

                    <div class='input-wrapper vertical flex-layout'>
                        <label for="postalCode" raised="">Code postal</label>
                        <input name="postalCode" id='postalCodeValue' type="text" minlength="5" maxlength="5" pattern="^[0-9]*$" required>
                        <span class='input-indicator'><span bar=''></span><span val=''></span></span>
                        <!-- Input Message -->
                        <!-- NOTE: Add `error` class, to make this `.input-message` an error message -->
                        <p class='input-message fade-in error' hidden></p>
                        <!-- End of Input Message -->
                    </div>

                    <div class='input-wrapper vertical flex-layout'>
                        <label for="country" raised=''>Pays</label>
                        <input name="country" id='countryValue' type='text' pattern="^[A-Za-z\s]*$" minlength="4" required>
                        <span class='input-indicator'><span bar=''></span><span val=''></span></span>
                        <!-- Input Message -->
                        <!-- NOTE: Add `error` class, to make this `.input-message` an error message -->
                        <p class='input-message fade-in error' hidden></p>
                        <!-- End of Input Message -->
                    </div>
                    <div class="buttons vertical flex-layout">
                        <button id='address' type="button" contained="">
                            <span>Suivant</span>
                        </button>
                    </div>
                    <div class='buttons vertical flex-layout'>
                        <button id='addressReturn' type='button' outlined="">
                            <span>Retour</span>
                        </button>
                    </div>
                </form>
                <div class='address-list'>
                    <h3>Toutes vos adresses enregistrées</h3>
                    <ul>
                        <?php foreach ($addresses as $address) : ?>
                            <li class='input-wrapper vertical flex-layout'>

                                <button data-id="<?= $address['id'] ?>">
                                    <?= $address['title'] ?>
                                </button>
                            </li>

                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class='container vertical flex-layout cardDiv' hidden>
                <form id='cardForm' class='vertical flex-layout'>
                    <h4>3 / 3</h4>
                    <div class='input-wrapper vertical flex-layout'>
                        <input type="number" name="id_card" hidden>
                        <label for='nbCard' raised="">Numéro de la carte</label>
                        <input id='nbCardValue' name='nbCard' type='text' inputmode='numeric'
                               placeholder="6200 0000 0000 0005" pattern='^[\d\s]+$' minlength="19" maxlength="19" required>
                        <span class='input-indicator'><span bar=''></span><span val=''></span></span>
                        <!-- Input Message -->
                        <!-- NOTE: Add `error` class, to make this `.input-message` an error message -->
                        <p class='input-message fade-in error' hidden>Incorrect password</p>
                        <!-- End of Input Message -->
                    </div>

                    <div class='input-wrapper vertical flex-layout'>
                        <label for='expiration' raised="">Date d'expiration</label>
                        <input id='expirationValue' name="expiration" type="text" pattern='^[0-9\.\-\/]+$' minlength="5" maxlength="5" inputmode='numeric' placeholder="11/22" required>
                        <span class='input-indicator'><span bar=''></span><span val=''></span></span>
                        <!-- Input Message -->
                        <!-- NOTE: Add `error` class, to make this `.input-message` an error message -->
                        <p class='input-message fade-in error' hidden></p>
                        <!-- End of Input Message -->
                    </div>

                    <div class='input-wrapper vertical flex-layout'>
                        <label for='cvv' raised=''>CVV</label>
                        <input id='cvvValue' name="cvv" type='text' pattern='[0-9]*'  minlength="3" maxlength="3" inputmode="numeric" placeholder="000" required>
                        <span class='input-indicator'><span bar=''></span><span val=''></span></span>
                        <!-- Input Message -->
                        <!-- NOTE: Add `error` class, to make this `.input-message` an error message -->
                        <p class='input-message fade-in error' hidden></p>
                        <!-- End of Input Message -->
                    </div>

                    <div class='buttons vertical flex-layout'>
                        <button id='validateCheckout' type='submit' contained=''>
                            <span>Valider</span>
                        </button>
                    </div>

                    <div class='buttons vertical flex-layout'>
                        <button id="cardReturn" type='button' outlined="">
                            <span>Retour</span>
                        </button>
                    </div>

                </form>

                <div class='card-list'>
                    <h3>Toutes vos cartes</h3>
                    <ul>
                        <?php foreach ($cards  as $card) : ?>
                            <li class='input-wrapper vertical flex-layout'>

                                <button data-id="<?= $card['id'] ?>">
                                    <span><?= $card['type'] ?></span>
                                    <span>
                                    <?= str_pad(substr(strval($card['card_no']), 12, 16), 16, "x", STR_PAD_LEFT)  ?></span>
                                </button>
                            </li>

                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- Nav Bar -->
    <nav id='navBar'>
        <!-- Nav Bar -->
        <!-- PHP: Include the `navBar` component -->
        <?php
        $_GET['navbar_route'] = 'home';
        $_GET['sidebar_init'] = $this->user->getInitials();
        $_GET['sidebar_connected'] = $this->user->isConnected();
        $_GET['navbar_for_admin'] = false; // TRUE if the user is an admin

        require __DIR__ . '/components/nav-bar.php';
        ?>
        <!-- End of Nav Bar -->
    </nav

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
    <div class='app-layout' fit>
        <!-- Header -->
        <header>...</header>

        <!-- [content] -->
        <div content>...</div>
    </div>

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
