<?
use Kvokka\Tools\Service\Util;
if (!CModule::IncludeModule('highloadblock')) {
    return; 
}
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */

$arResult['PROPERTIES']['NUMBER']['VALUE'] = preg_replace('/[^0-9]/', '', $arResult['PROPERTIES']['NUMBER']['VALUE']);

$hlblock = HLBT::getById(3)->fetch();
$entity = HLBT::compileEntity($hlblock);
$entityClass = $entity->getDataClass();
$arAge = $entityClass::getList([
    'select' => ['UF_DESCRIPTION', 'UF_NAME'],
    'filter' => ['UF_XML_ID' => $arResult['DISPLAY_PROPERTIES']['CONVENIENCES']['VALUE']]
])->fetchAll();
$arResult['PROPERTIES']['CONVENIENCES']['ICON'] = $arAge;

if($arResult['DISPLAY_PROPERTIES']['GALLERY']['VALUE']){
    $i = 0;
    
        if(count($arResult['DISPLAY_PROPERTIES']['GALLERY']['VALUE']) != 1) {
            foreach($arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'] as $arItem){
                $arResult['PROPERTIES']['GALLERY']['FILE_VALUE'][$i] = \CFile::ResizeImageGet($arItem, BX_RESIZE_IMAGE_EXACT, true);
                $arResult['PROPERTIES']['GALLERY']['FILE_VALUE'][$i]['webp_src'] = Util::getInstance()->makeWebp($arResult['PROPERTIES']['GALLERY']['FILE_VALUE'][$i]['src']);
                $i++;
            }
        }
        else{
            $arResult['PROPERTIES']['GALLERY']['FILE_VALUE'][0] = \CFile::ResizeImageGet($arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'], BX_RESIZE_IMAGE_EXACT, true);
            $arResult['PROPERTIES']['GALLERY']['FILE_VALUE'][0]['webp_src'] = Util::getInstance()->makeWebp($arResult['PROPERTIES']['GALLERY']['FILE_VALUE'][0]['src']);
        }
} 

$i = 0;
foreach($arResult['PROPERTIES']['PRICE']['VALUE'] as $arItem){
   $arResult['PROPERTIES']['PRICE']['GENERAL'][$i]['VALUE'] = $arItem;
    $i++;
}
$i = 0;
foreach($arResult['PROPERTIES']['PRICE']['DESCRIPTION'] as $arItem){
   $arResult['PROPERTIES']['PRICE']['GENERAL'][$i]['DESCRIPTION'] = $arItem;
    $i++;
}


