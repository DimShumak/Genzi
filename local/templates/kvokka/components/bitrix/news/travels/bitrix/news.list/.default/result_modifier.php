<?

use Kvokka\Tools\Service\Util;

if (!CModule::IncludeModule('highloadblock')) {
    return;
}

use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */

$hlblock = HLBT::getById(7)->fetch();
$entity = HLBT::compileEntity($hlblock);
$entityClass = $entity->getDataClass();
$i = 0;
foreach ($arResult['ITEMS'] as &$arItem) {
    $arItem['DETAIL_PAGE_URL'] = \Kvokka\Tools\Service\Element::getInstance()->makeUrlToElement(
        $arItem,
        $arResult['DETAIL_PAGE_URL']
    );

    $arDif = $entityClass::getList([
        'select' => ['UF_FILE', 'UF_LINK'],
        'filter' => ['UF_XML_ID' => $arItem['DISPLAY_PROPERTIES']['DIFFICULT']['VALUE']]
    ])->fetch();
    $file = CFile::GetFileArray($arDif['UF_FILE']);
    $arResult['ITEMS'][$i]['PROPERTIES']['DIFFICULT']['ICON'] = \CFile::ResizeImageGet($file, array('width' => 100, 'height' => 100), BX_RESIZE_IMAGE_EXACT, true);
    $arResult['ITEMS'][$i]['PROPERTIES']['DIFFICULT']['ICON']['webp_src'] = Util::getInstance()->makeWebp($arResult['ITEMS'][$i]['PROPERTIES']['DIFFICULT']['ICON']['src']);
    $arResult['ITEMS'][$i]['PROPERTIES']['DIFFICULT']['LINK'] = $arDif['UF_LINK'];

    $days = $arItem['PROPERTIES']['DURATION']['VALUE'];
    $cases = array(2, 0, 1, 1, 1, 2);
    $titles = array('день', 'дня', 'дней');
    $index = ($days % 100 > 4 && $days % 100 < 20) ?
        2 : $cases[min($days % 10, 5)];

    $arResult['ITEMS'][$i]['PROPERTIES']['DURATION']['VALUE'] = $days . ' ' . $titles[$index];
    $i++;

    $arItem['PREVIEW_PICTURE'] = \CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 800, 'height' => 800), BX_RESIZE_IMAGE_EXACT, true);
    $arItem['PREVIEW_PICTURE']['webp_src'] = Util::getInstance()->makeWebp($arItem['PREVIEW_PICTURE']['src']);
}

$arResult['FILTER_SET'] = [];

$entityType          = \Kvokka\Tools\Service\Util::getInstance()->getHlEntity(6);
$entityDataClassType = $entityType->getDataClass();
$arResult['FILTER_SET']['TYPE_TRAVELS'] = [
    "NAME" => "Тип путешествий",
    "CODE" => "TYPE_TRAVELS",
    "TYPE" => "LIST",
    "LIST" => array_map(function ($item) {
        $checked = filter_input(INPUT_GET, 'TYPE_TRAVELS', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?: [];

        return [
            'VALUE' => $item['UF_XML_ID'],
            'LABEL' => $item['UF_NAME'],
            'IS_CHECKED' => in_array($item['UF_XML_ID'], $checked)
        ];
    }, $entityDataClassType::getList(['select' => ['UF_XML_ID', 'UF_NAME']])->fetchAll())
];

$arResult['FILTER_SET']['PRICE'] = [
    "NAME" => "Стоимость",
    "CODE" => "PRICE",
    "IS_CHECKED_FROM" => filter_input(INPUT_GET, 'PRICE_FROM') ?: '',
    "IS_CHECKED_UP" => filter_input(INPUT_GET, 'PRICE_UP') ?: '',
];

$arResult['FILTER_SET']['DURATION'] = [
    "NAME" => "Длительность",
    "CODE" => "DURATION",
    "IS_CHECKED_FROM" => filter_input(INPUT_GET, 'DURATION_FROM') ?: '',
    "IS_CHECKED_UP" => filter_input(INPUT_GET, 'DURATION_UP') ?: '',
];

$entityType          = \Kvokka\Tools\Service\Util::getInstance()->getHlEntity(7);
$entityDataClassType = $entityType->getDataClass();
$arResult['FILTER_SET']['DIFFICULT'] = [
    "NAME" => "Сложность",
    "CODE" => "DIFFICULT",
    "TYPE" => "LIST",
    "LIST" => array_map(function ($item) {
        $checked = filter_input(INPUT_GET, 'DIFFICULT', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?: [];

        return [
            'VALUE' => $item['UF_XML_ID'],
            'LABEL' => $item['UF_NAME'],
            'IS_CHECKED' => in_array($item['UF_XML_ID'], $checked)
        ];
    }, $entityDataClassType::getList(['select' => ['UF_XML_ID', 'UF_NAME']])->fetchAll())
];

$entityType          = \Kvokka\Tools\Service\Util::getInstance()->getHlEntity(8);
$entityDataClassType = $entityType->getDataClass();
$arResult['FILTER_SET']['HABITATION'] = [
    "NAME" => "Проживание",
    "CODE" => "HABITATION",
    "TYPE" => "LIST",
    "LIST" => array_map(function ($item) {
        $checked = filter_input(INPUT_GET, 'HABITATION', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?: [];

        return [
            'VALUE' => $item['UF_XML_ID'],
            'LABEL' => $item['UF_NAME'],
            'IS_CHECKED' => in_array($item['UF_XML_ID'], $checked)
        ];
    }, $entityDataClassType::getList(['select' => ['UF_XML_ID', 'UF_NAME']])->fetchAll())
];


