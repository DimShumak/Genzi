<?
use Kvokka\Tools\Service\Util;
if (!CModule::IncludeModule('highloadblock')) {
    return; 
}
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
if($arResult['PROPERTIES']['NUMBER_COMPANY']['VALUE']){
$arResult['PROPERTIES']['NUMBER_COMPANY']['VALUE'] = preg_replace('/[^0-9]/', '', $arResult['PROPERTIES']['NUMBER_COMPANY']['VALUE'] );
}


$hlblock = HLBT::getById(7)->fetch();
$entity = HLBT::compileEntity($hlblock);
$entityClass = $entity->getDataClass();
$arDif = $entityClass::getList([
        'select' => ['UF_FILE'],
        'filter' => ['UF_XML_ID' => $arResult['DISPLAY_PROPERTIES']['DIFFICULT']['VALUE']]
    ])->fetch();
    $file = CFile::GetFileArray($arDif['UF_FILE']);
    $arResult['PROPERTIES']['DIFFICULT']['ICON'] = \CFile::ResizeImageGet($file, array('width' => 100, 'height' => 100), BX_RESIZE_IMAGE_EXACT, true);
    $arResult['PROPERTIES']['DIFFICULT']['ICON']['webp_src'] = Util::getInstance()->makeWebp($arResult['PROPERTIES']['DIFFICULT']['ICON']['src']);
    $arResult['PROPERTIES']['DIFFICULT']['LINK'] = $arDif['UF_LINK'];

if($arResult['DISPLAY_PROPERTIES']['MAIN_PHOTO']['FILE_VALUE']){
    $arResult['PROPERTIES']['MAIN_PHOTO']['FILE_VALUE'] = \CFile::ResizeImageGet($arResult['DISPLAY_PROPERTIES']['MAIN_PHOTO']['FILE_VALUE'], BX_RESIZE_IMAGE_EXACT, true);
    $arResult['PROPERTIES']['MAIN_PHOTO']['FILE_VALUE']['webp_src'] = Util::getInstance()->makeWebp($arResult['PROPERTIES']['MAIN_PHOTO']['FILE_VALUE']['src']);
}
if($arResult['DISPLAY_PROPERTIES']['PHOTO2']['FILE_VALUE']){
    $arResult['PROPERTIES']['PHOTO2']['FILE_VALUE'] = \CFile::ResizeImageGet($arResult['DISPLAY_PROPERTIES']['PHOTO2']['FILE_VALUE'], BX_RESIZE_IMAGE_EXACT, true);
    $arResult['PROPERTIES']['PHOTO2']['FILE_VALUE']['webp_src'] = Util::getInstance()->makeWebp($arResult['PROPERTIES']['PHOTO2']['FILE_VALUE']['src']);
}
if($arResult['DISPLAY_PROPERTIES']['PHOTO3']['FILE_VALUE']){
    $arResult['PROPERTIES']['PHOTO3']['FILE_VALUE'] = \CFile::ResizeImageGet($arResult['DISPLAY_PROPERTIES']['PHOTO3']['FILE_VALUE'], BX_RESIZE_IMAGE_EXACT, true);
    $arResult['PROPERTIES']['PHOTO3']['FILE_VALUE']['webp_src'] = Util::getInstance()->makeWebp($arResult['PROPERTIES']['PHOTO3']['FILE_VALUE']['src']);
}
  
    $days = $arResult['PROPERTIES']['DURATION']['VALUE'];
    $cases = array(2, 0, 1, 1, 1, 2);
    $titles = array('день', 'дня', 'дней');
    $index = ($days % 100 > 4 && $days % 100 < 20) ? 
        2 : $cases[min($days % 10, 5)];
    
    $arResult['PROPERTIES']['DURATION']['VALUE'] = $days . ' ' . $titles[$index];