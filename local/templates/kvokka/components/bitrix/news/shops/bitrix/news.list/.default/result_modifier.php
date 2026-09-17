<?

use Kvokka\Tools\Service\Util;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */


foreach ($arResult['ITEMS'] as &$arItem) {
    $arItem['DETAIL_PAGE_URL'] = \Kvokka\Tools\Service\Element::getInstance()->makeUrlToElement(
        $arItem,
        $arResult['DETAIL_PAGE_URL']
    );

    $arItem['PREVIEW_PICTURE'] = \CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 800, 'height' => 800), BX_RESIZE_IMAGE_EXACT, true);
    $arItem['PREVIEW_PICTURE']['webp_src'] = Util::getInstance()->makeWebp($arItem['PREVIEW_PICTURE']['src']);
}

$arResult['FILTER_SET'] = [];

$entity          = \Kvokka\Tools\Service\Util::getInstance()->getHlEntity(4);
$entityDataClass = $entity->getDataClass();


$arResult['FILTER_SET']['TYPE_SERVICE'] = [
    "NAME" => "Вид услуг",
    "LIST" => array_map(function ($item) {
        $checked = filter_input(INPUT_GET, 'TYPE_SERVICE', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?: [];

        return [
            'VALUE' => $item['UF_XML_ID'],
            'LABEL' => $item['UF_NAME'],
            'IS_CHECKED' => in_array($item['UF_XML_ID'], $checked)
        ];
    }, $entityDataClass::getList(['select' => ['UF_XML_ID', 'UF_NAME']])->fetchAll())
];