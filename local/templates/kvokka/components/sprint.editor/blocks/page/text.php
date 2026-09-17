<?php /** @var $block array */
?>

<? if ($block['settings']['type'] == 'blockquote') : ?>
    <div class="quote">
<? endif ?>

<? if ($block['settings']['type'] == 'preview') : ?>
    <div class="preview">
<? endif ?>

<?= Sprint\Editor\Blocks\Text::getValue($block) ?>

<? if ($block['settings']['type'] == 'preview') : ?>
    </div>
<? endif ?>

<? if ($block['settings']['type'] == 'blockquote') : ?>
    </div>
<? endif ?>
