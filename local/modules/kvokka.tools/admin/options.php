<?php

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Context;
use \Bitrix\Main\Loader;
use Kvokka\Tools\Service\Option;

Loc::loadMessages(__FILE__);


$request   = Context::getCurrent()->getRequest();
$module_id = htmlspecialchars($request['mid'] != '' ? $request['mid'] : $request['id']);

Loader::includeModule($module_id);

/*
 * Параметры модуля со значениями по умолчанию
 */
$aTabs = include(__DIR__ . '/options_tabs.php');

$tabControl = new CAdminTabControl('tabControl', $aTabs);

$tabControl->begin();
?>
<form action="<?= $APPLICATION->getCurPage(); ?>?mid=<?= $module_id; ?>&lang=<?= LANGUAGE_ID; ?>" method="post">
    <?= bitrix_sessid_post(); ?>
    <?php
    foreach ($aTabs as $aTab) {
        if ($aTab['OPTIONS']) {
            $tabControl->beginNextTab();
            __AdmSettingsDrawList($module_id, $aTab['OPTIONS']);
        }
    }
    $tabControl->buttons();
    ?>
    <input type="submit" name="apply" value="<?= Loc::GetMessage('KVOKKA_TOOLS_OPTIONS_INPUT_APPLY'); ?>" class="adm-btn-save" />
    <input type="submit" name="default" value="<?= Loc::GetMessage('KVOKKA_TOOLS_OPTIONS_INPUT_DEFAULT'); ?>" />
</form>

<?php
$tabControl->end();

/*
 * Обрабатываем данные после отправки формы
 */
if ($request->isPost() && check_bitrix_sessid()) {

    foreach ($aTabs as $aTab) { // цикл по вкладкам
        foreach ($aTab['OPTIONS'] as $arOption) {

            if (!is_array($arOption)) { // если это название секции
                continue;
            }

            if ($arOption['note']) { // если это примечание
                continue;
            }

            if ($request['apply']) { // сохраняем введенные настройки
                $optionValue = $request->getPost($arOption[0]);

                if (!$optionValue) {  // устанавливаем значение по умолчанию
                    $optionValue = $arOption[2];
                }

                Option::set($arOption[0], is_array($optionValue) ? implode(',', $optionValue) : $optionValue);
            } elseif ($request['default']) { // устанавливаем по умолчанию
                Option::set($arOption[0], $arOption[2]);
            }
        }
    }

    LocalRedirect($APPLICATION->getCurPage() . '?mid=' . $module_id . '&lang=' . LANGUAGE_ID);
}
?>
