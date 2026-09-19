<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
  die();
}

use \Bitrix\Main\Engine\CurrentUser;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Page\Asset;
use \Kvokka\Tools\Service\Storage;
use \Kvokka\Tools\Service\Option;
use \Kvokka\Tools\Service\App;
use \Kvokka\Tools\Service\Element;
use \Bitrix\Main\Context;
use \Bitrix\Main\Application;

Loc::loadMessages(__FILE__);

if (Option::get('jquery_on') == 'Y') {
  CJSCore::Init(["jquery3"]);
}

CJSCore::Init(["ajax"]);

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/styles/main.css');
Asset::getInstance()->addJS(SITE_TEMPLATE_PATH . '/assets/scripts/main.js');
Asset::getInstance()->addJS(SITE_TEMPLATE_PATH . '/assets/libs/swiped-events.min.js');
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/libs/swiper/swiper-bundle.min.css');
Asset::getInstance()->addJS(SITE_TEMPLATE_PATH . '/assets/libs/swiper/swiper-bundle.min.js');
Asset::getInstance()->addJS(SITE_TEMPLATE_PATH . '/assets/libs/viewport-extra.min.js');
Asset::getInstance()->addJS(SITE_TEMPLATE_PATH . '/assets/libs/support-webp.min.js');
Asset::getInstance()->addJS(SITE_TEMPLATE_PATH . '/assets/libs/scroll-lock.min.js');
Asset::getInstance()->addJS(SITE_TEMPLATE_PATH . '/assets/libs/bouncer.min.js');
Asset::getInstance()->addJS(SITE_TEMPLATE_PATH . '/assets/libs/support-webp.min.js');
Asset::getInstance()->addJS(SITE_TEMPLATE_PATH . '/assets/libs/jquery.min.js');
Asset::getInstance()->addJS(SITE_TEMPLATE_PATH . '/assets/libs/jquery.maskedinput.min.js');
Asset::getInstance()->addJS(SITE_TEMPLATE_PATH . '/assets/scripts/fancybox/dist/jquery.fancybox.min.js');
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/scripts/fancybox/dist/jquery.fancybox.min.css');

$request = Context::getCurrent()->getRequest();
$dirLast = end(explode('/', trim($request->getRequestedPageDirectory(), "/")));

$themColorClass = 'green-theme';

if (!in_array($dirLast, ['travels', 'events'])) {
  if (App::getInstance()->getRootTypeCode() == 'sport') {
    $themColorClass = 'blue-theme';
  }

  if (App::getInstance()->getRootTypeCode() == 'extreme') {
    $themColorClass = 'gold-theme';
  }
}

$bodyClass = Storage::get('IS_HOME') ? 'home' : 'no-home';

?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

<head>
	<link rel="shortcut icon" href="/favicon.ico"/>
  <meta charset="<?= SITE_CHARSET ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="viewport-extra" content="width=device-width,initial-scale=1,min-width=375" />
  <? $APPLICATION->ShowHead(); ?>
  <title><? $APPLICATION->ShowTitle("title") ?></title>
  <!-- Yandex.Metrika counter -->
  <script type="text/javascript">
    (function(m, e, t, r, i, k, a) {
      m[i] = m[i]

      function() {
        (m[i].a = m[i].a[]).push(arguments)
      };
      m[i].l = 1 * new Date();
      for (var j = 0; j < document.scripts.length; j++) {
        if (document.scripts[j].src === r) {
          return;
        }
      }
      k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
    })(window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js?id=105318990', 'ym');

    ym(105318990, 'init', {
      ssr: true,
      webvisor: true,
      clickmap: true,
      ecommerce: "dataLayer",
      accurateTrackBounce: true,
      trackLinks: true
    });
  </script>
  <noscript>
    <div><img src="https://mc.yandex.ru/watch/105318990" style="position:absolute; left:-9999px;" alt="" /></div>
  </noscript>
  <!-- /Yandex.Metrika counter -->

</head>

<body class="<?= $bodyClass ?> <?= $themColorClass ?>">
  <? if (CurrentUser::get()->isAdmin()) : ?>
    <div id="panel">
      <? $APPLICATION->ShowPanel(); ?>
    </div>
  <? endif; ?>

  <header class="header f-col align-center">
    <div class="header__top-block f-row">
      <div class="header__top-block-content align-center f-row content-block">
        <div class="header__logo-holder">
          <a href="<?= Element::getInstance()->makeMainUrl() ?>">
            <picture>
              <source srcset="<?= SITE_TEMPLATE_PATH ?>/assets/images/header/white-logo.webp" type="image/webp">
              <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/header/white-logo.png" alt="Logo" class="header__logo">
            </picture>
          </a>
        </div>
        <div class="header__top-block-options f-row g-20">
          <a href="<?= Element::getInstance()->makeUrlPrefix("/events/") ?>" class="header__top-block-option text-20-16 weight-xxl color-white italic">СОБЫТИЯ</a>
          <a href="<?= Element::getInstance()->makeUrlPrefix("/travels/") ?>" class="header__top-block-option text-20-16 weight-xxl color-white italic">ПУТЕШЕСТВИЯ</a>
        </div>
        <button class="header__city-button color-white f-row g-4 align-center">
          <span class="header__city-button-text text-sm">КУРСК</span>
          <!-- <svg class="header__city-button-arrow" width="24" height="24">
            <use href="#icon-arrow-down-round"></use>
          </svg> -->
        </button>
        <button class="header__options-button show-on-mob f-row" id="menuToggle">
          <svg class="header__options-button-svg" width="20" height="20">
            <use href="#icon-menu"></use>
          </svg>
        </button>
      </div>
    </div>
    <div class="header__bottom-block f-row">
      <div class="header__bottom-block-content f-row content-block">
        <div class="header__select-btn-holder">
          <? $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "header_left_menu",
            [
              "ALLOW_MULTI_SELECT" => "N",
              "CHILD_MENU_TYPE" => "",
              "DELAY" => "N",
              "MENU_CACHE_GET_VARS" => [],
              "MENU_CACHE_TIME" => "360000",
              "MENU_CACHE_TYPE" => "N",
              "MENU_CACHE_USE_GROUPS" => "N",
              "ROOT_MENU_TYPE" => "left",
              "USE_EXT" => "Y",
              "COMPONENT_TEMPLATE" => "header_left_menu",
              "MAX_LEVEL" => "1"
            ],
            false
          ); ?>

        </div>
        <div class="header__middle-block-placeholder"></div>
        <? $APPLICATION->IncludeComponent(
          "bitrix:menu",
          "header_menu",
          [
            "ALLOW_MULTI_SELECT" => "N",
            "CHILD_MENU_TYPE" => "",
            "DELAY" => "N",
            "MENU_CACHE_GET_VARS" => [],
            "MENU_CACHE_TIME" => "360000",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_USE_GROUPS" => "N",
            "ROOT_MENU_TYPE" => "top",
            "USE_EXT" => "Y",
            "COMPONENT_TEMPLATE" => "header_menu",
            "MAX_LEVEL" => "1"
          ],
          false
        ); ?>
        <div class="header__sports-block <?= $themColorClass == 'blue-theme' ? 'active' : '' ?> f-row align-center" data-href="/" data-root-section-id="1">
          <span class="header__sports-text text-l weight-xxl">СПОРТ</span>
        </div>
        <div class="header__extreme-block <?= $themColorClass == 'gold-theme' ? 'active' : '' ?> f-row align-center" data-href="/" data-root-section-id="2">
          <span class="header__extreme-text text-l weight-xxl">ЭКСТРИМ</span>
        </div>
      </div>
    </div>
  </header>
  <main class="<? $APPLICATION->ShowProperty("root-class", "tos f-row"); ?> ">
    <div class="<? $APPLICATION->ShowProperty("content-class", "tos__content content-block f-row"); ?>">
      <div class="<? $APPLICATION->ShowProperty("main-class", "tos__main content-padding f-col flex-1"); ?> ">
        <? $APPLICATION->IncludeComponent(
          "bitrix:breadcrumb",
          "",
          array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "SITE_ID"
          )
        ); ?>