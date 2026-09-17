<?php /** @var $block array */
?>

<? if ($block['settings']['type'] == 'blockquote') : ?>
    <blockquote class="news-item__quote-block quote-block f-row j-between">
		<span class="quote-block__quote-text text-m">
<? endif ?>

<? if ($block['settings']['type'] == 'preview') : ?>
    <div class="preview">
<? endif ?>

<?= Sprint\Editor\Blocks\Text::getValue($block) ?>

<? if ($block['settings']['type'] == 'preview') : ?>
    </div>
<? endif ?>

<? if ($block['settings']['type'] == 'blockquote') : ?>
		</span>
		<svg class="quote-block__svg">
			<use href="#icon-quote"></use>
		</svg>
	</blockquote>
<? endif ?>
