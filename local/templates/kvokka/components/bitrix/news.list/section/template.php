<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//dd($arResult['ITEMS'])
?>
<section class="section__trainers">
  <h2 class="section__secondary-title weight-l text-xl">Тренеры</h2>
  <div class="section__swiper">
    <div class="swiper">
      <div class="swiper-wrapper">
        <? foreach ($arResult['ITEMS'] as $arItem) { ?>
          <div class="swiper-slide">
            <div class="section__swiper-trainer-block f-col g-20">
              <div class="section__swiper-trainer-img-holder">
                <a href="<?= $arItem['PREVIEW_PICTURE']['src'] ?>" data-fancybox>
                  <picture>
                    <source srcset="<?= $arItem['PREVIEW_PICTURE']['webp_src'] ?>" type="image/webp">
                    <img src="<?= $arItem['PREVIEW_PICTURE']['src'] ?>" alt="<?= $arItem['NAME'] ?>" loading="lazy">
                  </picture>
                </a>
              </div>
              <div class="section__swiper-trainer-content f-col g-8">
                <h3 class="section__swiper-trainer-title weight-l"><?= $arItem['NAME'] ?></h3>
                <p class="section__swiper-trainer-desc"><?= $arItem['PREVIEW_TEXT'] ?></p>
                <? if ($arItem['PROPERTIES']['EXPERIENCE']['VALUE']) { ?>
                  <p class="section__swiper-trainer-workexp">Стаж <?= $arItem['PROPERTIES']['EXPERIENCE']['VALUE'] ?></p>
                <? } ?>
              </div>
            </div>
          </div>
        <? } ?>
      </div>
    </div>
    <button class="swiper-button-prev secondary-button">
      <svg width="20" height="20">
        <use href="#icon-arrow-left"></use>
      </svg>
    </button>
    <button class="swiper-button-next secondary-button">
      <svg width="20" height="20">
        <use href="#icon-arrow-right"></use>
      </svg>
    </button>
  </div>
</section>