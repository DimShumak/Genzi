<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arCurrentValues */

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    return;
}

$arTypesEx = CIBlockParameters::GetIBlockTypes();

$arIBlocks = [];
$iblockFilter = [
    'ACTIVE' => 'Y'
];

if (!empty($arCurrentValues['IBLOCK_TYPE'])) {
    $iblockFilter['TYPE'] = $arCurrentValues['IBLOCK_TYPE'];
}

if (isset($_REQUEST['site'])) {
    $iblockFilter['SITE_ID'] = $_REQUEST['site'];
}

$dbIblock = CIBlock::GetList(["SORT" => "ASC"], $iblockFilter);
while ($arRes = $dbIblock->Fetch()) {
    $arIBlocks[$arRes["ID"]] = "[" . $arRes["ID"] . "] " . $arRes["NAME"];
}

$iblockExists = (!empty($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID'] > 0);

$arProperty_LNS = array();
$arProperty = [];

if ($iblockExists) {
    $rsProp = CIBlockProperty::GetList(
        [
            "SORT" => "ASC",
            "NAME" => "ASC",
        ],
        [
            "ACTIVE" => "Y",
            "IBLOCK_ID" => $arCurrentValues["IBLOCK_ID"],
        ]
    );

    while ($arr = $rsProp->Fetch()) {
        $arProperty[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];
        if (in_array($arr["PROPERTY_TYPE"], ["L", "N", "S", "E"])) {
            $arProperty_LNS[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];
        }
    }
}

$arElemnts = [];

if ($iblockExists) {
    $rsElement = CIBlockElement::GetList(
        [
            "SORT" => "ASC",
            "NAME" => "ASC",
        ],
        [
            "ACTIVE"    => "Y",
            "IBLOCK_ID" => $arCurrentValues["IBLOCK_ID"],
        ],
        false,
        false,
        $arSelectFields = array("ID", "NAME")
    );

    while ($arr = $rsElement->fetch()) {
        $arElemnts[$arr['ID']] = "[" . $arr["ID"] . "] " . $arr["NAME"];
    }
}

$arComponentParameters = [
    "GROUPS" => [],
    "PARAMETERS" => [
        "IBLOCK_TYPE" => [
            "PARENT" => "BASE",
            "NAME" => 'IBLOCK_TYPE',
            "TYPE" => "LIST",
            "VALUES" => $arTypesEx,
            "REFRESH" => "Y",
        ],
        "IBLOCK_ID" => [
            "PARENT" => "BASE",
            "NAME" => "IBLOCK_ID",
            "TYPE" => "LIST",
            "VALUES" => $arIBlocks,
            "DEFAULT" => '={$_REQUEST["ID"]}',
            "ADDITIONAL_VALUES" => "N",
            "REFRESH" => "Y",
        ],
        "ELEMENT_ID" => [
            "PARENT" => "BASE",
            "NAME" => "ELEMENT_ID",
            "TYPE" => "LIST",
            "VALUES" => $arElemnts,
            "DEFAULT" => '={$_REQUEST["ID"]}',
            "ADDITIONAL_VALUES" => "N",
            "REFRESH" => "Y",
        ],
        "PROPERTY_CODE" => [
            "PARENT" => "BASE",
            "NAME" => "PROPERTY_CODE",
            "TYPE" => "LIST",
            "MULTIPLE" => "N",
            "VALUES" => $arProperty_LNS,
            "ADDITIONAL_VALUES" => "N",
        ],
        "CACHE_TIME"  =>  ["DEFAULT" => 36000000],
    ],
];
