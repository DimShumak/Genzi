<?php

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$options = [

    Loc::getMessage('KVOKKA_TOOLS_OPTIONS_SECTION_LIBS'), // Раздел
    [
        'jquery_on',                                       // имя элемента формы
        Loc::getMessage('KVOKKA_TOOLS_OPTIONS_JQUERY_ON'), // поясняющий текст — «Подключить jQuery»
        'N',                                               // значение по умолчанию «нет»
        ['checkbox']                                       // тип элемента формы — checkbox
    ],
];

$result = [];

$rsSites = CSite::GetList($by = "sort", $order = "desc");

while ($arSite = $rsSites->Fetch()) {

    $optionsPrepare = array_map(function ($option) use ($arSite) {
        $option[0] = $option[0] . '_' . $arSite['LID'];
        return $option;
    }, $options);

    $tab = [
        'DIV'     => 'edit1_' . $arSite['LID'],
        'TAB'     => $arSite['NAME'] . ' (' . $arSite['LID'] . ')',
        'TITLE'   => '',
        'OPTIONS' => $optionsPrepare
    ];

    $result[] = $tab;
}


return $result;
