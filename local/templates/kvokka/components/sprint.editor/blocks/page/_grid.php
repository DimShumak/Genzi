<?php


/**
 * @var $this   SprintEditorBlocksComponent
 * @var $layout array
 *
 * Если сетка состоит из 1 колонки без оформления, выводим простой список блоков
 * Иначе выводим нормальный шаблон сетки
 * Переделайте этот шаблон на свое усмотрение
 */

//$isSimpleGrid = (count($layout['columns']) == 1 && empty($layout['columns'][0]['css']));

?>
<?//if ($isSimpleGrid) { 
global $APPLICATION;?>
    <div class="tos__page f-col g-20">
        <h1 class="tos__title page-title"><?=$APPLICATION->ShowTitle()?></h1>
        <section class="tos__section">
                <?php foreach ($layout['columns'] as $column) { ?>
                    <?php foreach ($column['blocks'] as $block) { ?>
                        <?php $this->includeBlock($block) ?>
                    <?php } ?>
                <?php } ?>
        </section>
    </div>

