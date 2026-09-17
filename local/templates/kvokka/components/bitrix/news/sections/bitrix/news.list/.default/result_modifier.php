<?

use Kvokka\Tools\Service\App;
use Kvokka\Tools\Service\Util;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */


$i = 0;
foreach ($arResult['ITEMS'] as &$arItem) {
    // $arItem['PROPERTIES']['TYPE']['VALUE'] = [App::getInstance()->getTypeId()];

    $arItem['DETAIL_PAGE_URL'] = \Kvokka\Tools\Service\Element::getInstance()->makeUrlToElement(
        $arItem,
        $arResult['DETAIL_PAGE_URL']
    );

    if(!isset($arItem['DISPLAY_PROPERTIES']['AGE']['DISPLAY_VALUE'])){
        $arResult['ITEMS'][$i]['DISPLAY_PROPERTIES']['AGE']['DISPLAY_VALUE'] = 'Для всех возрастов';
    }

    $arItem['PREVIEW_PICTURE'] = \CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 800, 'height' => 800), BX_RESIZE_IMAGE_EXACT, true);
    $arItem['PREVIEW_PICTURE']['webp_src'] = Util::getInstance()->makeWebp($arItem['PREVIEW_PICTURE']['src']);
    $i++;
}

$arResult['FILTER_SET'] = [];

$entity          = \Kvokka\Tools\Service\Util::getInstance()->getHlEntity(5);
$entityDataClass = $entity->getDataClass();


$arResult['FILTER_SET']['AGE'] = [
    "NAME" => "Возраст",
    "LIST" => array_map(function ($item) {
        $checked = filter_input(INPUT_GET, 'AGE', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?: [];

        return [
            'VALUE' => $item['UF_XML_ID'],
            'LABEL' => $item['UF_NAME'],
            'IS_CHECKED' => in_array($item['UF_XML_ID'], $checked)
        ];
    }, $entityDataClass::getList(['select' => ['UF_XML_ID', 'UF_NAME']])->fetchAll())
];

$arResult['FILTER_BOOL']['TRIAL'] = [
    "NAME" => "Пробное занятие",
    "CODE" => "TRIAL",
    "IS_CHECKED" => filter_input(INPUT_GET, 'TRIAL') ? 'Y' : ''
];
$arResult['FILTER_BOOL']['ONE_TIME'] = [
    "NAME" => "Разовое занятие",
    "CODE" => "ONE_TIME",
    "IS_CHECKED" => filter_input(INPUT_GET, 'ONE_TIME') ? 'Y' : ''
];

if(\Kvokka\Tools\Service\App::getInstance()->getRootTypeCode() != 'sport'){
$arResult['FILTER_BOOL']['CERTIFICATE'] = [
    "NAME" => "Подарочный сертификат",
    "CODE" => "CERTIFICATE",
    "IS_CHECKED" => filter_input(INPUT_GET, 'CERTIFICATE') ? 'Y' : ''
];
}