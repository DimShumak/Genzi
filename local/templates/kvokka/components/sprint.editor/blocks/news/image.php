<?php /** @var $block array */ ?><?php
use Kvokka\Tools\Service\Util;

$image = Sprint\Editor\Blocks\Image::getImage(
    $block, [
        'width'  => 1024,
        'height' => 768,
        'exact'  => 0,
        //'jpg_quality' => 75
    ]
);
?><?php if ($image) { ?>
    <div class="news-item__img-block">
        <a href="<?= $image['SRC'] ?>" data-fancybox>
            <picture>
                <source srcset="<?= Util::getInstance()->makeWebp($image['SRC']) ?>" type="image/webp">
                <img class="news-item__img" alt="<?= $image['DESCRIPTION'] ?>" src="<?= $image['SRC'] ?>">
            </picture>
        </a>
    </div>
<?php } ?>
