<?php

use \Bitrix\Main\Loader;
use \Kvokka\Tools\Handler\Util;
use \Kvokka\Tools\Service\Storage;

include(__DIR__ . '/vendor/autoload.php');

$requiredModules = include(__DIR__ . '/install/require.php');
foreach ($requiredModules as $module) {
    \Bitrix\Main\Loader::includeModule($module);
}

CModule::AddAutoloadClasses('kvokka.tools');

if (Loader::includeModule("kvokka.tools")) {
    Util::getInstance()->initEventHandler();

    global $APPLICATION;

    if ($APPLICATION) {
        Storage::set('IS_HOME', ($APPLICATION->GetCurPage(true) == SITE_DIR . 'index.php'));
    }
}
