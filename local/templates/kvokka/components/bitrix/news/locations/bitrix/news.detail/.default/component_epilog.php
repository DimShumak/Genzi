<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/assets/scripts/pages/location.js');
    Asset::getInstance()->addJS('https://api-maps.yandex.ru/2.1/?lang=ru_RU');
?>