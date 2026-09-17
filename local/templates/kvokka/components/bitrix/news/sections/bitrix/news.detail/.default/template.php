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
//dd($arResult);
$APPLICATION->SetPageProperty("title", $arResult['NAME']);

?>
<div class="section__page f-col">
  <div class="section__title-block align-center">
    <!-- <div class="section__age-label tag light"><? //=$arResult['DISPLAY_PROPERTIES']['AGE']['DISPLAY_VALUE']
                                                    ?></div> -->
    <div class="section__logo-title-container">
      <? if ($arResult['PROPERTIES']['LOGO']['SRC']['src']) { ?>
        <div class="section__logo-holder">
          <picture>
            <source srcset="<?= $arResult['PROPERTIES']['LOGO']['webp_src'] ?>" type="image/webp">
            <img src="<?= $arResult['PROPERTIES']['LOGO']['SRC']['src'] ?>" class="section__logo" alt="Логотип">
          </picture>
        </div>
      <? } else { ?>
        <div class="logo-null"></div>
      <? } ?>
      <h1 class="section__title page-title"><?= $arResult['NAME'] ?></h1>
    </div>
    <div class="section__tag-labels f-row g-4 align-center">
      <? foreach ($arResult['DISPLAY_PROPERTIES']['TYPE']['LINK_SECTION_VALUE'] as $arType) { ?>
        <div class="section__tag-label tag light"><?= $arType['NAME'] ?></div>
      <? } ?>
    </div>
  </div>
  <div class="section__main-content f-col">
    <? if (
      $arResult['PROPERTIES']['MAP_COORDINATES']['VALUE'] || $arResult['PROPERTIES']['ADDRESS']['VALUE'] || $arResult['PROPERTIES']['NUMBER']['VALUE']
      || $arResult['PROPERTIES']['SITE']['VALUE'] || $arResult['PROPERTIES']['SOCIAL']['VALUE']
    ) { ?>
      <section class="section__content-block">
        <h2 class="section__secondary-title weight-l text-xl">Контакты</h2>
        <!-- f-row f-between -->
        <address class="section__address address-grid-block">
          <? if ($arResult['PROPERTIES']['MAP_COORDINATES']['VALUE'] || $arResult['PROPERTIES']['ADDRESS']['VALUE']) { ?>
            <div class="section__map-block f-col g-12">
              <? if ($arResult['PROPERTIES']['MAP_COORDINATES']['VALUE']) { ?>
                <div class="section__map-holder">
                  <div class="section__map" id="section__map" data-point="<?= $arResult['PROPERTIES']['MAP_COORDINATES']['VALUE'] ?>"></div>
                </div>
              <? }
              if ($arResult['PROPERTIES']['ADDRESS']['VALUE']) { ?>
                <div class="section__map-info-holder f-row g-8 align-center">
                  <svg class="section__map-svg" width="20" height="20">
                    <use href="#icon-location"></use>
                  </svg>
                  <span class="section__map-info-text"><?= $arResult['PROPERTIES']['ADDRESS']['VALUE'] ?></span>
                </div>
              <? } ?>
            </div>
          <? } ?>
          <div class="section__contacts-holder f-row">
            <div class="section__contacts-block f-col g-24">
              <? if ($arResult['PROPERTIES']['NUMBER']['VALUE']) {
                foreach ($arResult['PROPERTIES']['NUMBER']['VALUE'] as $arItem) { ?>
                  <div class="section__contact-holder f-row g-20 align-center">
                    <svg class="section__map-svg" width="20" height="20">
                      <use href="#icon-call"></use>
                    </svg>
                    <div class="section__contact-block f-col g-8">
                      <div class="section__contact-phone-holder f-row">
                        <a href="tel:+<?= $arItem ?>"><span class="section__contact-phone text-xl"><? $tel = $arItem;
                                                                                                    echo '+' . $tel[0] . " (" . $tel[1] . $tel[2] . $tel[3] . ")";
                                                                                                    ?></span>
                          <span class="section__contact-phone-hidden text-xl color-grey60">ХХХХХХХ</span></a>
                      </div>
                      <button class="section__contact-phone-btn ghost-button" data-phone="<?= substr($tel, 4) ?>">Разблокировать номер</button>
                    </div>
                  </div>
                <? }
              }
              if ($arResult['PROPERTIES']['SITE']['VALUE']) { ?>
                <div class="section__contact-holder f-row g-20 align-center">
                  <svg class="section__map-svg" width="20" height="20">
                    <use href="#icon-globe"></use>
                  </svg>
                  <div class="section__contact-block f-col g-8">
                    <div class="section__contact-phone-holder f-row">
                      <span class="section__contact-text text-xl"><?= $arResult['PROPERTIES']['SITE']['VALUE'] ?></span>
                    </div>
                    <? if ($arResult['PROPERTIES']['SITE']['DESCRIPTION']) { ?>
                      <a href="<?= $arResult['PROPERTIES']['SITE']['DESCRIPTION'] ?>" class="section__contact-link color-sports100">Перейти на сайт</a>
                    <? } else { ?>
                      <a href="<? echo 'https://' . $arResult['PROPERTIES']['SITE']['VALUE'] . '/'; ?>" class="section__contact-link color-sports100">Перейти на сайт</a>
                    <? } ?>
                  </div>
                </div>
              <? }
              if ($arResult['PROPERTIES']['SOCIAL']['VALUE']) { ?>
                <div class="section__contact-holder f-row g-20 align-center">
                  <svg class="section__map-svg" width="24" height="24">
                    <use href="#icon-vk-second"></use>
                  </svg>
                  <div class="section__contact-block f-col g-8">
                    <div class="section__contact-phone-holder f-row">
                      <span class="section__contact-text text-xl"><?= $arResult['PROPERTIES']['SOCIAL']['VALUE'] ?></span>
                    </div>
                    <? if ($arResult['PROPERTIES']['SOCIAL']['DESCRIPTION']) { ?>
                      <a href="<?= $arResult['PROPERTIES']['SOCIAL']['DESCRIPTION'] ?>" class="section__contact-link color-sports100">Перейти в группу VK</a>
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
    if ($arResult['DETAIL_TEXT'] || $arResult['PROPERTIES']['CONVENIENCES']['ICON']) { ?>
      <section class="section__about-block">
        <h2 class="section__secondary-title weight-l text-xl">О секции</h2>
        <div></div>
        <p class="section__about-p">
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
      <section class="section__gallery">
        <h2 class="section__secondary-title weight-l text-xl">Галерея</h2>
        <div class="section__swiper">
          <div class="swiper">
            <div class="swiper-wrapper">
              <? foreach ($arResult['PROPERTIES']['GALLERY']['FILE_VALUE'] as $arKey => $arItem) { ?>
                <div class="swiper-slide">
                  <div class="section__swiper-img-holder" data-id="<?= $arKey ?>">
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
        <div class="section__swiper">
          <div class="swiper">
            <div class="swiper-wrapper">
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
    <? } ?>

    <? if ($arResult['PROPERTIES']['PRICE']['GENERAL']) { ?>
      <section class="section__price">
        <h2 class="section__secondary-title weight-l text-xl">Стоимость</h2>
        <div class="section__price-holder f-col g-24">
          <div class="section__hideable-block-holder f-col g-12">
            <div class="section__hideable-block-content is-collapsed g-24">
              <? foreach ($arResult['PROPERTIES']['PRICE']['GENERAL'] as $arItem) { ?>
                <div class="section__price-card f-col">
                  <h3 class="section__price-title text-xl weight-xl"><?= $arItem['DESCRIPTION'] ?></h3>
                  <? if ($arItem['VALUE'] == 'Бесплатно') { ?>
                    <p class="section__price-text weight-xl color-sports100"><?= $arItem['VALUE'] ?></p>
                  <? } else { ?>
                    <p class="section__price-text weight-xl color-sports100"><?= $arItem['VALUE'] ?>₽*</p>
                  <? } ?>
                </div>
              <? } ?>
            </div>
            <button class="section__hideable-block-btn color-sports100">Показать ещё</button>
          </div>
          <aside class="section__hideable-block-disclaimer">
            <p>
              *Цены, приведённые на сайте, не окончательные, не являются публичной офертой и носят информационный характер. Администрация
              оставляет за собой право изменять цены
            </p>
          </aside>
        </div>
      </section>
    <? }
    if ($arResult['PROPERTIES']['TRAINERS']['VALUE']) {
      $GLOBALS['arrFilter'] = array(
        "ID" => $arResult['PROPERTIES']['TRAINERS']['VALUE'],
      );
      $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "section",
        array(
          "ACTIVE_DATE_FORMAT" => "d.m.Y",
          "ADD_SECTIONS_CHAIN" => "N",
          "AJAX_MODE" => "N",
          "AJAX_OPTION_ADDITIONAL" => "",
          "AJAX_OPTION_HISTORY" => "N",
          "AJAX_OPTION_JUMP" => "N",
          "AJAX_OPTION_STYLE" => "Y",
          "CACHE_FILTER" => "N",
          "CACHE_GROUPS" => "Y",
          "CACHE_TIME" => "36000000",
          "CACHE_TYPE" => "A",
          "CHECK_DATES" => "Y",
          "DETAIL_URL" => "",
          "DISPLAY_BOTTOM_PAGER" => "N",
          "DISPLAY_DATE" => "N",
          "DISPLAY_NAME" => "N",
          "DISPLAY_PICTURE" => "Y",
          "DISPLAY_PREVIEW_TEXT" => "Y",
          "DISPLAY_TOP_PAGER" => "N",
          "FIELD_CODE" => array("NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", ""),
          "USE_FILTER" => "Y",
          "FILTER_NAME" => "arrFilter",
          "HIDE_LINK_WHEN_NO_DETAIL" => "N",
          "IBLOCK_ID" => "9",
          "IBLOCK_TYPE" => "System",
          "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
          "INCLUDE_SUBSECTIONS" => "Y",
          "MESSAGE_404" => "",
          "NEWS_COUNT" => "20",
          "PAGER_BASE_LINK_ENABLE" => "N",
          "PAGER_DESC_NUMBERING" => "N",
          "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
          "PAGER_SHOW_ALL" => "N",
          "PAGER_SHOW_ALWAYS" => "N",
          "PAGER_TEMPLATE" => ".default",
          "PAGER_TITLE" => "Новости",
          "PARENT_SECTION" => "",
          "PARENT_SECTION_CODE" => "",
          "PREVIEW_TRUNCATE_LEN" => "",
          "PROPERTY_CODE" => array("EXPERIENCE", ""),
          "SET_BROWSER_TITLE" => "N",
          "SET_LAST_MODIFIED" => "N",
          "SET_META_DESCRIPTION" => "N",
          "SET_META_KEYWORDS" => "N",
          "SET_STATUS_404" => "N",
          "SET_TITLE" => "N",
          "SHOW_404" => "N",
          "SORT_BY1" => "ACTIVE_FROM",
          "SORT_BY2" => "SORT",
          "SORT_ORDER1" => "DESC",
          "SORT_ORDER2" => "ASC",
          "STRICT_SECTION_CHECK" => "N"
        )
      ); ?>
    <? } ?>
  </div>
</div>