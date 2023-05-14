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
* @name Account - Controller 
* @file AccountController.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1+|> //
*    -|> 
*/


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: We'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/


// declare a namespace
namespace Maxaboom\Controllers;


// use the `User` model
use Maxaboom\Models\User;
// use the `Controller` & `ResponseHandler` helper classes
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;


// Declare a class that represents the `Account` controller,
// which is a child of the `Controller` class
class AccountController extends Controller {
  // Using some traists (a.k.a. step parents) in this class
  use ResponseHandler;

  // declare some constants...

  // actions
  const ACTION_LOGOUT = 'logout'; 
  const ACTION_DELETE = 'delete';

  // pages
  const PAGE_INFO = 'info';
  const PAGE_ADDRESSES = 'addresses';
  const PAGE_ORDERS = 'orders';
  const PAGE_WALLET = 'wallet';
  const PAGE_LANGUAGE = 'language';
  const PAGE_THEME = 'theme';
  const PAGE_CONTACT = 'contact';
  const PAGE_ABOUT = 'about';

  // views
  const VIEW_INFO_IDENTITY = 'identity';
  const VIEW_INFO_EMAIL = 'email';
  const VIEW_INFO_PASSWORD = 'password';
  const VIEW_WALLET_BANK_CARD = 'bank-card';
  const VIEW_WALLET_PAYPAL = 'paypal';
  const VIEW_WALLET_APPLEPAY = 'apple-pay';
  const VIEW_WALLET_STRIPE = 'stripe';



  // declare some properties...

  // public properites
  public array $listData;

  // private properties
  private User $user;

  
  
  /**
   * Constructor of the class
   * This method is executed automatically whenever this class is instantiated
   *
   * @param ?string $theme : the theme to use
   * @param ?string $lang : the language to use
   * @param bool $useDefaultBrowserLang : whether or not to use the default browser language
   */
  public function __construct(?string $theme = null, ?string $lang = null, bool $useDefaultBrowserLang = true) {
    // call the parent's constructor
    parent::__construct($theme, $lang, $useDefaultBrowserLang);

    // TODO: write something awesome code here ;)
    
    // initialize the `user` property by creating a new `User` object
    $this->user = new User();
    

    // initialize the `listData` property
    $this->listData = $this->getOverviewListData();
   
  }


  // PUBLIC SETTERS
  // PUBLIC GETTERS

  /**
   * Returns the user's full name
   *
   * @param bool $reversed - if TRUE, the name will be reversed (i.e. "Lastname Firstname")
   *
   * @return string - the user's full name
   */
  public function getFullname(bool $reversed = false): string {
    return ($this->user->isConnected()) ? $this->user->firstname . ' ' . $this->user->lastname : '';
  }


  // PUBLIC METHODS

  /**
   * Updates the theme with the given `themeId`
   *
   * @param string $themeId - the id of the theme to update (eg. 'light', 'dark')
   */
  public function updateTheme(string $themeId):void {
    // Get the old theme as `oldTheme`
    $oldTheme = $this->getCurrentTheme();

    // set the given `themeId` as the current theme
    $this->setCurrentTheme($themeId);

    
    // Initialize the `success` variable to TRUE
    $success = true;

    // Create a response message as `message`
    $message = sprintf($this->i18n->getString('themeChangedTo'), $this->i18n->getString($themeId));

    // Create a data with the old and new themes
    $data = ['old' => $oldTheme, 'theme' => $themeId];

    // update the response
    $this->updateResponse($success, self::$STATUS_SUCCESS_OK, $message, $data);
  }





  /**
   * Updates the lang with the given `languageId`
   *
   * @param string $languageId - the id of the language to update (eg. 'en', 'fr', 'ru', 'es')
   */
  public function updateLanguage(string $languageId):void {
    // Get the old language as `oldLanguage`
    $oldLanguage = $this->getCurrentLang();

    // set the given `languageId` as the current theme
    $this->setCurrentLang($languageId);

    
    // Initialize the `success` variable to TRUE
    $success = true;

    // Create a response message as `message`
    $message = sprintf($this->i18n->getString('langChangedTo'), $this->i18n->getString($languageId));

    // Create a data with the old and new languages 
    $data = ['old' => $oldLanguage, 'lang' => $languageId];

    // update the response
    $this->updateResponse($success, self::$STATUS_SUCCESS_OK, $message, $data);
  }





  /**
   * Shows the default account page
   * 
   * @param string $page - the page to show
   * @param string $view - the view to show
   *
   * @return void
   */
  public function showPage(?string $page = null, ?string $view = null): void {
    
    switch ($page) {
      case self::PAGE_INFO:
        $this->showInfoPage($view);
        break;

      case self::PAGE_ADDRESSES:
        $this->showAddressesPage($view);
        break;

      case self::PAGE_ORDERS:
        $this->showOrdersPage($view);
        break;

      case self::PAGE_WALLET:
        $this->showWalletPage($view);
        break;

      case self::PAGE_LANGUAGE:
        $this->showLanguagePage($view);
        break;

      case self::PAGE_THEME:
        $this->showThemePage($view);
        break;

      case self::PAGE_CONTACT:
        $this->showContactPage($view);
        break;

      case self::PAGE_ABOUT:
        $this->showAboutPage($view);
        break;

      default:
        $this->showOverviewPage();
        break;
    }
  }

  /**
   * Shows the overview page
   */
  public function showOverviewPage(): void {
    // require [once] the `account-page.php` file from `views` folder 
    require_once __DIR__ . '/../views/account-page.php';
  }


  /**
   * Shows the info page
   *
   * @param ?string $view - the view to show
   */
  public function showInfoPage(?string $view = null): void {
    // require [once] the `account-info-page.php` file from `views` folder 
    require_once __DIR__ . '/../views/account-info-page.php';
  }


  /**
   * Shows the addresses page
   * 
   * @param ?string $view - the view to show
   */
  public function showAddressesPage(?string $view = null): void {
    // require [once] the `account-addresses-page.php` file from `views` folder 
    require_once __DIR__ . '/../views/account-addresses-page.php';
  }


  /**
   * Shows the orders page
   *
   * @param ?string $view - the view to show
   */
  public function showOrdersPage(?string $view = null): void {
    // require [once] the `account-orders-page.php` file from `views` folder 
    require_once __DIR__ . '/../views/account-orders-page.php';
  }


  /**
   * Shows the wallet page
   *
   * @param ?string $view - the view to show
   */
  public function showWalletPage(?string $view = null): void {
    // require [once] the `account-wallet-page.php` file from `views` folder 
    require_once __DIR__ . '/../views/account-wallet-page.php';
  }

  /**
   * Shows the language page
   *
   * @param ?string $view - the view to show
   */
  public function showLanguagePage(?string $view = null): void {
    // Get a list of all currently supported languages from i18n as `languages`
    $languages = $this->i18n->getSupportedLanguages();

    // get the current language as `currentLanguage`
    // NOTE: This is the same as `$this->lang` property's value
    $currentLanguage = $this->getCurrentLang();

    // require [once] the `account-language-page.php` file from `views` folder 
    require_once __DIR__ . '/../views/account-language-page.php';
  }

  /**
   * Shows the theme page
   *
   * @param ?string $view - the view to show
   */
  public function showThemePage(?string $view = null): void {
    // Get a list of all currently supported themes from painter as `themes`
    $themes = $this->painter::SUPPORTED_THEMES;
    // get the current theme
    $currentTheme = $this->getCurrentTheme();

    // require [once] the `account-theme-page.php` file from `views` folder 
    require_once __DIR__ . '/../views/account-theme-page.php';
  }

  /**
   * Shows the contact page
   *
   * @param ?string $view - the view to show
   */
  public function showContactPage(?string $view = null): void {
    // require [once] the `account-contact-page.php` file from `views` folder 
    require_once __DIR__ . '/../views/account-contact-page.php';
  }


  /**
   * Shows the about page
   *
   * @param ?string $view - the view to show
   */
  public function showAboutPage(?string $view = null): void {
    // require [once] the `account-about-page.php` file from `views` folder 
    require_once __DIR__ . '/../views/account-about-page.php';
  }



  /**
   * Gets the data for the overview list
   *
   * @return array
   */
  public function getOverviewListData(): array {
    // Initialize a `overviewListData` variable by setting it to an empty array
    // NOTE: This variable will be returned at the end of this method
    $overviewListData = [];

    // create the `info-addresses` list items in `overviewListData`
    $overviewListData['info-addresses'] = [
      'title' => '',
      'icon' => '',
      'items' => [

        self::PAGE_INFO => [
          'icon' => '',
          'title' => $this->i18n->getString('yourInformation'),
          'description' => $this->i18n->getString('firstName') . ', ' . $this->i18n->getString('lastName') . ', ' . $this->i18n->getString('email'), 
          'link' => 'account/info',
        ],

        self::PAGE_ADDRESSES => [
          'icon' => '',
          'title' => $this->i18n->getString('yourAddresses'),
          'description' => $this->i18n->getString('editRemoveSetAddress'),
          'link' => 'account/addresses',
        ],
      ],
    ];


    // create the `purchases` list items in `overviewListData`
    $overviewListData['purchases'] = [
      'title' => $this->i18n->getString('purchases'),
      'icon' => '',
      'items' => [

        self::PAGE_ORDERS => [
          'icon' => '',
          'title' => $this->i18n->getString('orders'),
          'description' => '',
          'link' => 'account/orders',
        ],

        self::PAGE_WALLET => [
          'icon' => '',
          'title' => $this->i18n->getString('wallet'),
          'description' => '',
          'link' => 'account/wallet',
        ],
      ],
    ];


    // create the `settings` list items in `overviewListData`
    $overviewListData['settings'] = [
      'title' => $this->i18n->getString('settings'),
      'icon' => '',
      'items' => [

        self::PAGE_LANGUAGE => [
          'icon' => '',
          'title' => $this->i18n->getString('language'),
          'description' => $this->i18n->getLanguage(true) . " · " . strtoupper($this->i18n->getLanguage()),
          'link' => 'account/language',
        ],

        self::PAGE_THEME => [
          'icon' => '',
          'title' => $this->i18n->getString('theme'), 
          'description' => $this->i18n->getString($this->painter->getTheme()),
          'link' => 'account/theme',
        ],
      ],
    ];


    // create the `help` list items in `overviewListData`
    $overviewListData['help'] = [
      'title' => $this->i18n->getString('help'),
      'icon' => '',
      'items' => [

        self::PAGE_CONTACT => [
          'icon' => '',
          'title' => $this->i18n->getString('contact'),
          'description' => '',
          'link' => 'account/contact',
        ],

        self::PAGE_ABOUT => [
          'icon' => '',
          'title' => $this->i18n->getString('about'),
          'description' => '',
          'link' => 'account/about',
        ],
      ],
    ];

    return $overviewListData;
  }



  /**
   * Returns the data for the info links
   *
   * @return array
   */
  public function getInfoLinks(): array {
    // Initialize a `infoLinks` variable by setting it to an empty array
    $infoLinks = [];
    
    // create the `identity` link items in `infoLinks`
    $infoLinks['identity'] = [
      'icon' => '',
      'title' => $this->getFullname(),
      'description' => $this->user->getDateOfBirth(true),
      'link' => 'account/info/identity',
    ];

    // create the `email` link item in `infoLinks`
    $infoLinks['email'] = [
      'icon' => '',
      'title' => $this->i18n->getString('changeYourEmailAddress'),
      'description' => $this->user->getEmail(),
      'link' => 'account/info/email',
    ];

    // create the `password` link item in `infoLinks`
    $infoLinks['password'] = [
      'icon' => '',
      'title' => $this->i18n->getString('changePassword'),
      'description' => str_repeat('x', 10),
      'link' => 'account/info/password',
    ];

    // return the `infoLinks` variable
    return $infoLinks;
  }



  /**
   * Method used to log the user out
   *
   * @return void
   */
  public function logout(): void {
    // disconnect user out and assign the result to the `disconnected` variable
    $disconnected = $this->user->disconnect();

    // Creating the `success`, `status`, `message`, and `data` variables...

    $success = $disconnected;
    $status = $disconnected ? self::$STATUS_SUCCESS_OK : self::$STATUS_ERROR_BAD_REQUEST;
    $message = !$disconnected ? $this->i18n->getString('errorLogout') : $this->i18n->getString('successLogout');
    $data = [];

    // update the class response accordingly
    $this->updateResponse($success, $status, $message, $data);

  } 


  /**
   * Method used to delete the user 
   *
   * @return void
   */
  public function delete(): void {
    // Iniitialize the `deleted` boolean variable by setting it to `false`
    $deleted = false;

    // If the user is logged in...
    if ($this->user->isConnected()) {
      // ...get the user's id as `userId`
      $userId = $this->user->id;
      // Now, delete the user with his/her `userId`,
      // and assign the result to the `deletionResult` variable 
      $deletionResult = $this->user->deleteUser($userId);

      // If the user was deleted successfully...
      if ($deletionResult) {
        // ...set the `deleted` boolean variable to `true`
        $deleted = true;
      }

    }


    // Creating the `success`, `status`, `message`, and `data` variables...

    $success = $deleted;
    $status = $deleted ? self::$STATUS_SUCCESS_OK : self::$STATUS_ERROR_BAD_REQUEST;
    $message = !$deleted ? $this->i18n->getString('errorDeleteAccount') : $this->i18n->getString('successDeleteAccount');
    $data = [];

    // update the class response accordingly
    $this->updateResponse($success, $status, $message, $data);

  } 
  
  
  // PRIVATE SETTERS
  // PRIVATE GETTERS
  // PRIVATE METHODS


};





