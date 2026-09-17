<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $APPLICATION;

$currentType = \Kvokka\Tools\Service\App::getInstance()->getRootTypeId();
$typeInfo = \Kvokka\Tools\Service\App::getInstance()->issetType($currentType);

$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "kvokka:menu.sections",
    "",
    array(
        "IS_SEF" => "Y",
        "SEF_BASE_URL" => "/",
        "SECTION_PAGE_URL" =>  "#SECTION_ID#",
        "IBLOCK_TYPE" => "system",
        "IBLOCK_ID" => "2",
        "DEPTH_LEVEL" => "4",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "LEFT_MARGIN" => $typeInfo['LEFT_MARGIN'],
        "RIGHT_MARGIN" => $typeInfo['RIGHT_MARGIN']
    ),
    false
);

$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
