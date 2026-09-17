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
$this->setFrameMode(true); ?>

<div class="location__page f-col">
  <div class="location__title-block align-center">
    <h1 class="location__title page-title"><?= $arResult['NAME'] ?></h1>
    <div class="location__tag-labels f-row g-4 align-center">
      <? foreach ($arResult['DISPLAY_PROPERTIES']['TYPE']['LINK_SECTION_VALUE'] as $arType) { ?>
        <div class="location__tag-label tag light"><?= $arType['NAME'] ?></div>
      <? } ?>
    </div>
  </div>
  <div class="location__main-content f-col">
    <? if (
      $arResult['PROPERTIES']['MAP_COORDINATES']['VALUE'] || $arResult['PROPERTIES']['ADDRESS']['VALUE'] || $arResult['PROPERTIES']['NUMBER']['VALUE']
      || $arResult['PROPERTIES']['SITE']['VALUE'] || $arResult['PROPERTIES']['SOCIAL']['VALUE']
    ) { ?>
      <section class="location__content-block">
        <h2 class="location__secondary-title weight-l text-xl">Контакты</h2>
        <!-- f-row f-between -->
        <address class="location__address address-grid-block">
          <div class="location__map-block f-col g-12">
            <? if ($arResult['PROPERTIES']['MAP_COORDINATES']['VALUE']) { ?>
              <div class="location__map-holder">
                <div class="location__map" id="location__map" data-point="<?= $arResult['PROPERTIES']['MAP_COORDINATES']['VALUE'] ?>"></div>
              </div>
            <? }
            if ($arResult['PROPERTIES']['ADDRESS']['VALUE']) { ?>
              <div class="location__map-info-holder f-row g-8 align-center">
                <svg class="location__map-svg" width="20" height="20">
                  <use href="#icon-location"></use>
                </svg>
                <span class="location__map-info-text"><?= $arResult['PROPERTIES']['ADDRESS']['VALUE'] ?></span>
              </div>
            <? } ?>
          </div>
          <div class="location__contacts-holder f-row">
            <div class="location__contacts-block f-col g-24">
              <? if ($arResult['PROPERTIES']['NUMBER']['VALUE']) { ?>
                <div class="location__contact-holder f-row g-20 align-center">
                  <svg class="location__map-svg" width="20" height="20">
                    <use href="#icon-call"></use>
                  </svg>
                  <div class="location__contact-block f-col g-8">
                    <div class="location__contact-phone-holder f-row">
                      <a href="tel:+<?= $arResult['PROPERTIES']['NUMBER']['VALUE'] ?>"><span class="location__contact-phone text-xl"><? $tel = $arResult['PROPERTIES']['NUMBER']['VALUE'];
                                                                                                                                      echo '+' . $tel[0] . " (" . $tel[1] . $tel[2] . $tel[3] . ")";
                                                                                                                                      ?></span>
                        <span class="location__contact-phone-hidden text-xl color-grey60">ХХХХХХХ</span></a>
                    </div>
                    <button class="location__contact-phone-btn ghost-button" data-phone="<?= substr($tel, 4) ?>">Разблокировать номер</button>
                  </div>
                </div>
              <? }
              if ($arResult['PROPERTIES']['SITE']['VALUE']) { ?>
                <div class="location__contact-holder f-row g-20 align-center">
                  <svg class="location__map-svg" width="20" height="20">
                    <use href="#icon-globe"></use>
                  </svg>
                  <div class="location__contact-block f-col g-8">
                    <div class="location__contact-phone-holder f-row">
                      <span class="location__contact-text text-xl"><?= $arResult['PROPERTIES']['SITE']['VALUE'] ?></span>
                    </div>
                    <? if ($arResult['PROPERTIES']['SITE']['DESCRIPTION']) { ?>
                      <a href="<?= $arResult['PROPERTIES']['SITE']['DESCRIPTION'] ?>" class="location__contact-link color-sports100">Перейти на сайт</a>
                    <? } else { ?>
                      <a href="<? echo 'https://' . $arResult['PROPERTIES']['SITE']['VALUE'] . '/' ?>" class="location__contact-link color-sports100">Перейти на сайт</a>
                    <? } ?>
                  </div>
                </div>
              <? }
              if ($arResult['PROPERTIES']['SOCIAL']['VALUE']) { ?>
                <div class="location__contact-holder f-row g-20 align-center">
                  <svg class="location__map-svg" width="24" height="24">
                    <use href="#icon-vk-second"></use>
                  </svg>
                  <div class="location__contact-block f-col g-8">
                    <div class="location__contact-phone-holder f-row">
                      <span class="location__contact-text text-xl"><?= $arResult['PROPERTIES']['SOCIAL']['VALUE'] ?></span>
                    </div>
                    <? if ($arResult['PROPERTIES']['SOCIAL']['DESCRIPTION']) { ?>
                      <a href="<?= $arResult['PROPERTIES']['SOCIAL']['DESCRIPTION'] ?>" class="location__contact-link color-sports100">Перейти в группу VK</a>
                    <? } ?>
                  </div>
                </div>
              <? } ?>
            </div>
          </div>
          <!-- paste -->
          <? if ($arResult['PROPERTIES']['WEEKDAY']['VALUE'] || $arResult['PROPERTIES']['WEEKENDS']['VALUE']) { ?>
            <div class="infoblock__worktime g-8">
              <? if ($arResult['PROPERTIES']['WEEKDAY']['VALUE']) { ?>
                <div class="infoblock__worktime-card f-row g-8">
                  <svg width="20" height="20">
                    <use href="#icon-clock"></use>
                  </svg>
                  <div class="infoblock__worktime-card-text-holder f-col g-4">
                    <span class="infoblock__worktime-card-text-property text-xsm color-grey100">Будни
                    </span>
                    <span class="infoblock__worktime-card-text text-16 weight-l"><?= $arResult['PROPERTIES']['WEEKDAY']['VALUE'] ?></span>
                  </div>
                </div>
              <? }
              if ($arResult['PROPERTIES']['WEEKENDS']['VALUE']) { ?>
                <div class="infoblock__worktime-travel-card f-row g-8">
                  <svg width="20" height="20">
                    <use href="#icon-clock"></use>
                  </svg>
                  <div class="infoblock__worktime-card-text-holder f-col g-4">
                    <span class="infoblock__worktime-card-text-property text-xsm color-grey100">Выходные
                    </span>
                    <span class="infoblock__worktime-card-text text-16 weight-l"><?= $arResult['PROPERTIES']['WEEKENDS']['VALUE'] ?></span>
                  </div>
                </div>
              <? } ?>
            </div>
          <? } ?>
        </address>
      </section>
    <? }
    if ($arResult['DETAIL_TEXT']) { ?>
      <section class="location__about-block">
        <h2 class="location__secondary-title weight-l text-xl">О локации</h2>
        <div></div>
        <p class="location__about-p">
          <?= $arResult['DETAIL_TEXT'] ?>
        </p>
      </section>
    <? } ?>

    <? if ($arResult['PROPERTIES']['CONVENIENCES']['ICON']) { ?>
      <section class="location__about-block">
        <h2 class="location__secondary-title weight-l text-xl">Удобства</h2>
        <div></div>
        <div class="location__about-top-tags f-row g-12">
          <? foreach ($arResult['PROPERTIES']['CONVENIENCES']['ICON'] as $arItem) { ?>
            <div class="location__about-top-tag-label tag light" title="<?= $arItem['UF_NAME'] ?>">
              <svg class="location__tag-svg" width="20" height="20">
                <use href="<?= $arItem['UF_DESCRIPTION'] ?>"></use>
              </svg>
              <span><?= $arItem['UF_NAME'] ?></span>
            </div>
          <? } ?>
        </div>
      </section>
    <? } ?>

    <? if ($arResult['PROPERTIES']['GALLERY']['FILE_VALUE']) { ?>
      <section class="location__gallery">
        <h2 class="location__secondary-title weight-l text-xl">Галерея</h2>
        <div class="location__swiper">
          <div class="swiper">
            <div class="swiper-wrapper">
              <? foreach ($arResult['PROPERTIES']['GALLERY']['FILE_VALUE'] as $arKey => $arItem) { ?>
                <div class="swiper-slide">
                  <div class="location__swiper-img-holder" data-id="<?= $arKey ?>">
                    <picture>
                      <source srcset="<?= $arItem['webp_src'] ?>" type="image/webp">
                      <img src="<?= $arItem['src'] ?>" alt="Фото свайпера" loading="lazy">
                    </picture>
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
        <? foreach ($arResult['PROPERTIES']['GALLERY']['FILE_VALUE'] as $arKey => $arItem) { ?>
          <a href="<?= $arItem['src'] ?>" data-to="<?= $arKey ?>" data-fancybox="gallery"></a>
        <? } ?>
      </section>
    <? }
    if ($arResult['PROPERTIES']['SCHEDULE']['VALUE']) { ?>
      <section class="section__schedule">
        <h2 class="section__secondary-title weight-l text-xl">Расписание</h2>
        <div class="section__schedule-holder f-row g-24">
          <? $APPLICATION->IncludeComponent(
            "sprint.editor:blocks",
            "",
            array(
              "ELEMENT_ID"    => $arParams['ELEMENT_ID'],
              "IBLOCK_ID"     => $arParams['IBLOCK_ID'],
              "PROPERTY_CODE" => "SCHEDULE",
            ),
            $component,
            array(
              'HIDE_ICONS' => 'Y'
            )
          );
          ?>
        </div>
      </section>
    <? }

    if ($arResult['PROPERTIES']['PRICE']['GENERAL']) { ?>
      <section class="location__price">
        <h2 class="location__secondary-title weight-l text-xl">Аренда</h2>
        <div class="location__price-holder f-col g-24">
          <div class="location__hideable-block-holder f-col g-12">
            <div class="location__hideable-block-content is-collapsed g-24">
              <? foreach ($arResult['PROPERTIES']['PRICE']['GENERAL'] as $arItem) { ?>
                <div class="location__price-card f-col">
                  <h3 class="location__price-title text-xl weight-xl"><?= $arItem['DESCRIPTION'] ?></h3>
                  <? if ($arItem['VALUE'] == 'Бесплатно') { ?>
                    <p class="location__price-text weight-xl color-sports100"><?= $arItem['VALUE'] ?></p>
                  <? } else { ?>
                    <p class="location__price-text weight-xl color-sports100"><?= $arItem['VALUE'] ?>₽*</p>
                  <? } ?>
                </div>
              <? } ?>
            </div>
            <button class="location__hideable-block-btn color-sports100">Показать ещё</button>
          </div>
          <aside class="location__hideable-block-disclaimer">
            <p>
              *Цены, приведённые на сайте, не окончательные, не являются публичной офертой и носят информационный характер. Администрация
              оставляет за собой право изменять цены
            </p>
          </aside>
        </div>
      </section>
    <? } ?>
  </div>
</div>