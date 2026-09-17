<?php

/**
 * @var array $arResult
 * @var array $arParams
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

?>

<div id="<?= $arParams['ROOT_ID'] ?>">
    <button class="btn">click</button>
</div>

<script>
    const app = new CustumComponent(<?= \Bitrix\Main\Web\Json::encode($arParams) ?>, '<?= $this->getComponent()->getSignedParameters() ?>');
    app.init();
</script>
