<?php


/** @var $block array */

use Kvokka\Tools\Service\Util;

 ?>


<?
$text = Sprint\Editor\Blocks\Text::getValue($block['text']);
//$isPromo = @$block['settings']['type'] == 'promo' ? true : false;
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
    <figure class="news-item__img-figure">
            <div class="news-item__img-block">
                <a href="<?= $image['SRC'] ?>" data-fancybox>
                    <picture>
                    <source srcset="<?= Util::getInstance()->makeWebp($image['SRC']) ?>" type="image/webp">
                    <img class="news-item__img" src="<?= $image['SRC'] ?>" alt="<?= htmlspecialchars($image['DESCRIPTION']) ?>">
                    </picture>
                </a>
              </div>

        <? if ($text) : ?>
            <figcaption class="news-item__figure-text text-sm color-grey60"><?= $text ?></figcaption>
        <? endif ?>
    </figure>
<?php } ?>
