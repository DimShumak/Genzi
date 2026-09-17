<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
use Kvokka\Tools\Service\Util;
foreach ($arResult['ITEMS'] as &$arItem) {
    $arItem['PREVIEW_PICTURE'] = \CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], BX_RESIZE_IMAGE_EXACT, true);
    $arItem['PREVIEW_PICTURE']['webp_src'] = Util::getInstance()->makeWebp($arItem['PREVIEW_PICTURE']['src']);
}
?>