<?
use Kvokka\Tools\Service\Util;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */

$arResult['DETAIL_PICTURE']['webp_src'] = Util::getInstance()->makeWebp($arResult['DETAIL_PICTURE']['SRC']);
$arResult['PROPERTIES']['NUMBER_COMPANY']['VALUE'] = preg_replace('/[^0-9]/', '', $arResult['PROPERTIES']['NUMBER_COMPANY']['VALUE']);

