<?php

/**
 * @var array $arResult
 * @var array $arParams
 */
//
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// \Bitrix\Main\Page\Asset::getInstance()->addJs($componentPath . "/assets/fancybox/fancybox.umd.js");
// \Bitrix\Main\Page\Asset::getInstance()->addCss($componentPath . "/assets/fancybox/fancybox.css");

// \Bitrix\Main\Page\Asset::getInstance()->addJs($componentPath . "/assets/swiper/swiper-bundle.min.js");
// \Bitrix\Main\Page\Asset::getInstance()->addCss($componentPath .  "/assets/swiper/swiper-bundle.min.css");


if ($arParams['ELEMENT_ID'] && $arParams['IBLOCK_ID'] && $arParams['PROPERTY_CODE']) {

    $APPLICATION->IncludeComponent(
        "sprint.editor:blocks",
        "page",
        array(
            "ELEMENT_ID"    => $arParams['ELEMENT_ID'],
            "IBLOCK_ID"     => $arParams['IBLOCK_ID'],
            "PROPERTY_CODE" => $arParams['PROPERTY_CODE'],
        ),
        $component,
        array(
            'HIDE_ICONS' => 'Y'
        )
    );
}

$APPLICATION->SetPageProperty("root-class", "tos f-row");
$APPLICATION->SetPageProperty("content-class", "tos__content content-block f-row");
$APPLICATION->SetPageProperty("main-class", "tos__main content-padding f-col flex-1");