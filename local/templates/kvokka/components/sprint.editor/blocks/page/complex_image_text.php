<?php


/** @var $block array */ ?>


<?
$text = Sprint\Editor\Blocks\Text::getValue($block['text']);
$isPromo = @$block['settings']['type'] == 'promo' ? true : false;
$image = Sprint\Editor\Blocks\Image::getImage(
    $block['image'],
    [
        'width'  => 1000,
        'height' => 1000,
        'exact'  => 0,
    ]
);

?>
<?php if ($image) { ?>
    <figure class="pictire<?= $isPromo ? " pictire-promo" : "" ?>">
        <a href="<?= $image['ORIGIN_SRC'] ?>" data-fancybox data-caption="<?= htmlspecialchars($text) ?>">
            <img alt="<?= htmlspecialchars($image['DESCRIPTION']) ?>" src="<?= $image['SRC'] ?>">
        </a>
        <? if ($text) : ?>
            <figcaption><?= $text ?></figcaption>
        <? endif ?>
    </figure>

    <script>
        Fancybox.bind("[data-fancybox]", {});
    </script>
<?php } ?>
