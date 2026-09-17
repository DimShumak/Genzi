<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
//dd($arResult);?>
<?if($arResult['PROPERTIES']['MAIN_PHOTO']['FILE_VALUE']['src']){?>
<div class="travel__images-block-holder">
          <div class="travel__images-block g-4">
            <a class="travel__image-container travel__image-container--first" data-fancybox="gallery" href="<?=$arResult['PROPERTIES']['MAIN_PHOTO']['FILE_VALUE']['src']?>">
              <picture>
                <source srcset="<?=$arResult['PROPERTIES']['MAIN_PHOTO']['FILE_VALUE']['webp_src']?>" type="image/webp">
                <img class="travel__image-container-img" src="<?=$arResult['PROPERTIES']['MAIN_PHOTO']['FILE_VALUE']['src']?>" alt="Картинка <?=$arResult['NAME']?>">
              </picture>
            </a>
            <?if($arResult['PROPERTIES']['PHOTO2']['FILE_VALUE']['src']){?>
            <a class="travel__image-container travel__image-container--second" data-fancybox="gallery" href="<?=$arResult['PROPERTIES']['PHOTO2']['FILE_VALUE']['src']?>">
              <picture>
                <source srcset="<?=$arResult['PROPERTIES']['PHOTO2']['FILE_VALUE']['webp_src']?>" type="image/webp">
                <img class="travel__image-container-img" src="<?=$arResult['PROPERTIES']['PHOTO2']['FILE_VALUE']['src']?>" alt="Картинка <?=$arResult['NAME']?>">
              </picture>
            </a>
            <?}
            if($arResult['PROPERTIES']['PHOTO3']['FILE_VALUE']['src']){?>
            <a class="travel__image-container travel__image-container--third" data-fancybox="gallery" href="<?=$arResult['PROPERTIES']['PHOTO3']['FILE_VALUE']['src']?>">
              <picture>
                <source srcset="<?=$arResult['PROPERTIES']['PHOTO3']['FILE_VALUE']['webp_src']?>" type="image/webp">
                <img class="travel__image-container-img" src="<?=$arResult['PROPERTIES']['PHOTO3']['FILE_VALUE']['src']?>" alt="Картинка <?=$arResult['NAME']?>">
              </picture>
            </a>
            <?}?>
          </div>
        </div>
        <?}?>
        <div class="travel__title-holder f-row j-between align-center">
          <h1 class="travel__title page-title"><?=$arResult['NAME']?></h1>
          <div class="travel__title-labels-holder f-row g-4">
            <?foreach($arResult['DISPLAY_PROPERTIES']['TYPE']['LINK_SECTION_VALUE'] as $arType){?>
            <div class="travel__title-label tag light"><?=$arType['NAME']?></div>
            <?}?>
          </div>
        </div>
        <div class="travel__infoblock f-row j-between">
          <div class="travel__infoblock-travel-info g-8">
            <div class="travel__infoblock-travel-card f-row g-20">
              <svg width="32" height="32">
                <use href="#icon-car-journey"></use>
              </svg>
              <div class="travel__infoblock-card-text-holder f-col g-4">
                <span class="travel__infoblock-card-text-property text-sm color-grey60">Тип путешествия</span>
                <span class="travel__infoblock-card-text text-20-16 weight-l"><?=$arResult['DISPLAY_PROPERTIES']['TYPE_TRAVELS']['DISPLAY_VALUE']?></span>
              </div>
            </div>
            <div class="travel__infoblock-travel-card f-row g-20">
              <svg width="32" height="32">
                <use href="#icon-calendar"></use>
              </svg>
              <div class="travel__infoblock-card-text-holder f-col g-4">
                <span class="travel__infoblock-card-text-property text-sm color-grey60">Продолжительность</span>
                <span class="travel__infoblock-card-text text-20-16 weight-l"><?=$arResult['PROPERTIES']['DURATION']['VALUE']?></span>
              </div>
            </div>
            <div class="travel__infoblock-travel-card f-row g-20">
              <svg width="30" height="30">
                <use href="#icon-house-tree"></use>
              </svg>
              <div class="travel__infoblock-card-text-holder f-col g-4">
                <span class="travel__infoblock-card-text-property text-sm color-grey60">Проживание</span>
                <span class="travel__infoblock-card-text text-20-16 weight-l"><?=$arResult['DISPLAY_PROPERTIES']['HABITATION']['DISPLAY_VALUE']?></span>
              </div>
            </div>
            <?if($arResult['PROPERTIES']['SIZE_GROUP']['VALUE']){?>
            <div class="travel__infoblock-travel-card f-row g-20">
              <svg width="32" height="32">
                <use href="#icon-leader"></use>
              </svg>
              <div class="travel__infoblock-card-text-holder f-col g-4">
                <span class="travel__infoblock-card-text-property text-sm color-grey60">Размер группы</span>
                <span class="travel__infoblock-card-text text-20-16 weight-l"><?=$arResult['PROPERTIES']['SIZE_GROUP']['VALUE']?></span>
              </div>
            </div>
            <?}
            if($arResult['PROPERTIES']['MINIMUM_AGE']['VALUE']){?>
            <div class="travel__infoblock-travel-card f-row g-20">
              <svg width="32" height="32">
                <use href="#icon-no-child"></use>
              </svg>
              <div class="travel__infoblock-card-text-holder f-col g-4">
                <span class="travel__infoblock-card-text-property text-sm color-grey60">Минимальный возраст</span>
                <span class="travel__infoblock-card-text text-20-16 weight-l"><?=$arResult['PROPERTIES']['MINIMUM_AGE']['VALUE']?></span>
              </div>
            </div>
            <?}?>
            <div class="travel__infoblock-travel-card f-row g-20">
              <svg width="30" height="30"></svg>
              <div class="travel__infoblock-card-text-holder f-col g-4">
                <span class="travel__infoblock-card-text-property text-sm color-grey60">Стоимость</span>
                <span class="travel__infoblock-card-text text-20-16 weight-l color-sports100"><?=$arResult['PROPERTIES']['PRICE']['VALUE']?> ₽</span>
              </div>
            </div>
          </div>
          <div class="travel__infoblock-travel-difficulty-holder">
            <button class="travel__infoblock-travel-difficulty f-row align-center g-16">
              <picture>
                <source srcset="<?=$arResult['PROPERTIES']['DIFFICULT']['ICON']['webp_src']?>" type="image/webp">
                <img class="travel__infoblock-difficulty-img" src="<?=$arResult['PROPERTIES']['DIFFICULT']['ICON']['src']?>" alt="Картинка сложности">
              </picture>
              <span class="travel__infoblock-difficulty-text text-20-16 weight-l"><?=$arResult['DISPLAY_PROPERTIES']['DIFFICULT']['DISPLAY_VALUE']?></span>
              <svg width="20" height="20">
                <use href="#icon-info"></use>
              </svg>
            </button>
            <div class="travel__tooltip tooltip">
              <dl class="travel__tooltip-list f-col g-16">
                <div class="travel__tooltip-list-item f-col g-4">
                  <dt class="travel__tooltip-list-dt text-xsm color-grey80">Легкий уровень</dt>
                  <dd class="travel__tooltip-list-dd">
                    Физическая нагрузка минимальна. Подходит для всех, вне зависимости от физической подготовки и возраста.
                  </dd>
                </div>

                <div class="travel__tooltip-list-item f-col g-4">
                  <dt class="travel__tooltip-list-dt text-xsm color-grey80">Средний уровень</dt>
                  <dd class="travel__tooltip-list-dd">Не требует физической подготовки, но предполагает умеренную физическую нагрузку.</dd>
                </div>
                <div class="travel__tooltip-list-item f-col g-4">
                  <dt class="travel__tooltip-list-dt text-xsm color-grey80">Интенсивный уровень</dt>
                  <dd class="travel__tooltip-list-dd">Не требует специальных навыков, но туристы должны быть в хорошей физической форме.</dd>
                </div>
                <div class="travel__tooltip-list-item f-col g-4">
                  <dt class="travel__tooltip-list-dt text-xsm color-grey80">Экстремальный уровень</dt>
                  <dd class="travel__tooltip-list-dd">
                    Только для опытных и физически подготовленных туристов. Нужны специальные навыки и снаряжение.
                  </dd>
                </div>
              </dl>
            </div>
          </div>
        </div>
        <div class="travel__about-block f-row j-between">
          <?if(!empty($arResult['PROPERTIES']['AWAITS']['VALUE']) || $arResult['DETAIL_TEXT']){?>
          <section class="travel__about-section f-col">
            <h2 class="travel__secondary-title text-28-20 weight-l">Что вас ждет</h2>
            <?if(!empty($arResult['PROPERTIES']['AWAITS']['VALUE'])){?>
            <ul class="travel__about-section-list f-col g-16">
              <?foreach($arResult['PROPERTIES']['AWAITS']['VALUE'] as $arItem){?>
              <li>
                <div class="travel__about-section-element f-row g-12 align-center">
                  <svg width="20" height="20">
                    <use href="#icon-star"></use>
                  </svg>
                  <p class="travel__about-section-text text-m"><?=$arItem?></p>
                </div>
              </li>
             <?}?>
            </ul>
            <?}
            if($arResult['DETAIL_TEXT']){?>
            <div class="travel__about-text">
              <p>
                <?=$arResult['DETAIL_TEXT']?>
              </p>
            </div>
            <?}?>
          </section>
          <?}?>
          <section class="travel__contact-section f-col g-20">
            <?if($arResult['PROPERTIES']['NUMBER_COMPANY']['VALUE'] || $arResult['PROPERTIES']['SITE_COMPANY']['VALUE'] || 
                  $arResult['PROPERTIES']['SOCIAL_COMPANY']['VALUE'] || $arResult['PROPERTIES']['NAME_COMPANY']['VALUE']){?>
            <h2 class="travel__secondary-title text-28-20 weight-l">Организатор</h2>
                    <?}?>
            <address class="travel__contacts-holder f-row">
              <div class="travel__contacts-block f-col g-40">
                <?if($arResult['PROPERTIES']['NAME_COMPANY']['VALUE']) {?>
                <strong class="travel__contacts-block-title text-20-16 weight-l"><?=$arResult['PROPERTIES']['NAME_COMPANY']['VALUE']?></strong><?}?>
                <div class="travel__contacts-content g-40 f-col">
                  <?if($arResult['PROPERTIES']['NUMBER_COMPANY']['VALUE'] || $arResult['PROPERTIES']['SITE_COMPANY']['VALUE'] || 
                  $arResult['PROPERTIES']['SOCIAL_COMPANY']['VALUE']){?>
                  <div class="travel__contacts f-col g-24">
                    <?if($arResult['PROPERTIES']['NUMBER_COMPANY']['VALUE']){?>
                    <div class="travel__contact-holder f-row g-20 align-center">
                      <svg class="travel__map-svg" width="20" height="20">
                        <use href="#icon-call"></use>
                      </svg>
                      <div class="travel__contact-block f-col g-8">
                        <div class="travel__contact-phone-holder f-row">
                          <a href="tel:+<?=$arResult['PROPERTIES']['NUMBER_COMPANY']['VALUE']?>"><span class="travel__contact-phone text-xl"><?$tel = $arResult['PROPERTIES']['NUMBER_COMPANY']['VALUE'];
                      echo '+'.$tel[0]." (" . $tel[1].$tel[2].$tel[3].")";?></span>
                          <span class="travel__contact-phone-hidden text-xl color-grey60">ХХХХХХХ</span></a>
                        </div>
                        <button class="travel__contact-phone-btn ghost-button" data-phone="<?=substr($tel, 4)?>">Разблокировать номер</button>
                      </div>
                    </div>
                      <?}
                      if($arResult['PROPERTIES']['SITE_COMPANY']['VALUE']){?>
                    <div class="travel__contact-holder f-row g-20 align-center">
                      <svg class="travel__map-svg" width="20" height="20">
                        <use href="#icon-globe"></use>
                      </svg>
                      <div class="travel__contact-block f-col g-8">
                        <div class="travel__contact-phone-holder f-row">
                          <span class="travel__contact-text text-xl"><?=$arResult['PROPERTIES']['SITE_COMPANY']['VALUE']?></span>
                        </div>
                        <?if ($arResult['PROPERTIES']['SITE_COMPANY']['DESCRIPTION']) {?>
                        <a href="<?=$arResult['PROPERTIES']['SITE_COMPANY']['DESCRIPTION']?>" class="travel__contact-link color-sports100">Перейти на сайт</a>
                        <?} else{?>
                           <a href="<?echo 'https://'.$arResult['PROPERTIES']['SITE_COMPANY']['VALUE']?>" class="travel__contact-link color-sports100">Перейти на сайт</a>
                          <?}?>
                      </div>
                    </div> 
                    <?}
                    if($arResult['PROPERTIES']['SOCIAL_COMPANY']['VALUE']){?>
                    <div class="travel__contact-holder f-row g-20 align-center">
                      <svg class="travel__map-svg" width="24" height="24">
                        <use href="#icon-vk-second"></use>
                      </svg>
                      <div class="travel__contact-block f-col g-8">
                        <div class="travel__contact-phone-holder f-row">
                          <span class="travel__contact-text text-xl"><?=$arResult['PROPERTIES']['SOCIAL_COMPANY']['VALUE']?></span>
                        </div>
                        <a href="<?=$arResult['PROPERTIES']['SOCIAL_COMPANY']['DESCRIPTION']?>" class="travel__contact-link color-sports100">Перейти в группу VK</a>
                      </div>
                    </div>
                    <?}?>
                  </div>
                  <?}?>
                  <div class="travel__contacts-dates-holder g-40 f-row j-between">
                    <div class="travel__contacts-date-holder f-col">
                      <span class="travel__contacts-date-text text-m">Дата&nbsp;выезда</span>
                      <span class="travel__contacts-date text-20-16 weight-l"><?=FormatDate("j F", MakeTimeStamp($arResult['PROPERTIES']['DATE_DEPARTURE']['VALUE']))?></span>
                      <span class="travel__contacts-date-time text-m color-grey60"><?=$arResult['PROPERTIES']['TIME_DEPARTURE']['VALUE']?></span>
                    </div>
                    <div class="travel__contacts-date-holder f-col">
                      <span class="travel__contacts-date-text text-m">Дата&nbsp;возвращения</span>
                      <span class="travel__contacts-date text-20-16 weight-l"><?=FormatDate("j F", MakeTimeStamp($arResult['PROPERTIES']['DATE_RETURN']['VALUE']))?></span>
                      <span class="travel__contacts-date-time text-m color-grey60"><?=$arResult['PROPERTIES']['TIME_RETURN']['VALUE']?></span>
                    </div>
                  </div>
                </div>
              </div>
            </address>
          </section>
        </div>
        <?if($arResult['PROPERTIES']['PROGRAM']['VALUE']) {?>
        <section class="travel__schedule-block f-col">
          <h2 class="travel__secondary-title text-28-20 weight-l">Программа</h2>
          <div class="travel__schedule-holder f-col g-32">
             <?  $APPLICATION->IncludeComponent(
                    "sprint.editor:blocks",
                    "",
                    array(
                        "ELEMENT_ID"    => $arParams['ELEMENT_ID'],
                        "IBLOCK_ID"     => $arParams['IBLOCK_ID'],
                        "PROPERTY_CODE" => "PROGRAM",
                    ),
                    $component,
                    array(
                        'HIDE_ICONS' => 'Y'
                    )
                );
            ?>
          </div>
        </section>
        <?}?>
        <?if($arResult['PROPERTIES']['INSTRUCTORS']['VALUE']) {
                $GLOBALS['arrFilter'] = array(
                    "ID" => $arResult['PROPERTIES']['INSTRUCTORS']['VALUE'], 
                );
                $APPLICATION->IncludeComponent(
                  "bitrix:news.list",
                  "travel",
                  Array(
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
                    "FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE",""),
                    "USE_FILTER" => "Y",
                    "FILTER_NAME" => "arrFilter",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "11",
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
                    "PROPERTY_CODE" => array(""),
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
                );?>
            <?} if($arResult['PROPERTIES']['INCLUDED']['VALUE'] || $arResult['PROPERTIES']['SEPARATELY']['VALUE']){?>
        <div class="travel__price f-row g-24">
          <?if($arResult['PROPERTIES']['INCLUDED']['VALUE']){?>
          <section class="travel__price-included-block f-col">
            <h2 class="travel__secondary-title weight-l text-xl">Включено в стоимость</h2>
            <div class="travel__price-included-content f-col g-20">
                <?foreach($arResult['PROPERTIES']['INCLUDED']['VALUE'] as $arItem){?>
              <div class="travel__price-included-element f-row align-center g-12">
                <svg class="travel__price-included-svg" width="20" height="20">
                  <use href="#icon-star"></use>
                </svg>
                <p><?=$arItem?></p>
              </div>
                  <?}?>
            </div>
          </section> 
          <?}
          if($arResult['PROPERTIES']['SEPARATELY']['VALUE']){?>
          <section class="travel__price-nonincluded-block f-col">
            <h2 class="travel__secondary-title weight-l text-xl">Оплачивается отдельно</h2>
            <div class="travel__price-nonincluded-content f-col g-20">
                  <?foreach($arResult['PROPERTIES']['SEPARATELY']['VALUE'] as $arItem) {?>
              <div class="travel__price-nonincluded-element f-row align-center g-12">
                <svg class="travel__price-nonincluded-svg" width="20" height="20">
                  <use href="#icon-star-off"></use>
                </svg>
                <p><?=$arItem?></p>
              </div>
              <?}?>
            </div>
          </section>
          <?}?>
        </div>
        <?}?>
