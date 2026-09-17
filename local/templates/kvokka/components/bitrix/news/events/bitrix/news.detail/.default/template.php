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
//dd($arResult)
		if($arResult['DETAIL_PICTURE']['SRC']){?>
		<div class="event__image-block-holder">
		  <div class="event__image-block g-4">
			<a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" data-fancybox>
			  <picture>
				<source srcset="<?=$arResult['DETAIL_PICTURE']['webp_src']?>" type="image/webp">
				<img class="event__image-container-img" src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['NAME']?>">
			  </picture>
			</a>
		  </div>
		</div>
        <?}?>
        <div class="event__title-holder f-row j-between align-center">
          <h1 class="event__title page-title"><?=$arResult['NAME']?></h1>
          <div class="event__title-labels-holder f-row g-4">
            <div class="event__title-label tag light"><?$firstItem = reset($arResult['DISPLAY_PROPERTIES']['TYPE']['LINK_SECTION_VALUE']);
						echo $firstItem['NAME'];?></div>
          </div>
        </div>
        <div class="event__infoblock f-row g-24 j-between">
            <?if($arResult['DETAIL_TEXT']){?>
          <section class="event__about-block f-col">
            <h2 class="event__secondary-title weight-l text-28-20">О мероприятии</h2>
            <p>
              <?=$arResult['DETAIL_TEXT']?>
            </p>
          </section>
          <?}?>
          <section class="event__date-block f-col">
            <h2 class="event__secondary-title weight-l text-28-20">Дата проведения</h2>
            <div class="event__date-holder f-col g-8">
              <span class="event__date text-xl weight-xl"><?=FormatDate("j F Y", MakeTimeStamp($arResult['PROPERTIES']['DATE']['VALUE']))?></span>
              <span class="event__date-time text-xl weight-l color-grey60"><?=$arResult['PROPERTIES']['TIME']['VALUE']?></span>
            </div>
          </section>
        </div>
        <?if ($arResult['PROPERTIES']['MAP_COORDINATES']['VALUE'] || $arResult['PROPERTIES']['ADDRESS']['VALUE'] || $arResult['PROPERTIES']['NAME_COMPANY']['VALUE']
        || $arResult['PROPERTIES']['NUMBER_COMPANY']['VALUE'] || $arResult['PROPERTIES']['SITE_COMPANY']['VALUE']|| $arResult['PROPERTIES']['SOCIAL_COMPANY']['VALUE']) {?>
        <section class="event__content-block">
          <h2 class="event__secondary-title weight-l text-xl">Контакты</h2>
          <address class="event__address f-row f-between">
            <div class="event__map-block f-col g-12">
                <?if($arResult['PROPERTIES']['MAP_COORDINATES']['VALUE']){?>
              <div class="event__map-holder">
                <div class="event__map" id="event__map" data-point="<?=$arResult['PROPERTIES']['MAP_COORDINATES']['VALUE']?>"></div>
              </div>
              <?}
              if($arResult['PROPERTIES']['ADDRESS']['VALUE']){?>
              <div class="event__map-info-holder f-row g-8 align-center">
                <svg class="event__map-svg" width="20" height="20">
                  <use href="#icon-location"></use>
                </svg>
                <span class="event__map-info-text"><?=$arResult['PROPERTIES']['ADDRESS']['VALUE']?></span>
              </div>
              <?}?>
            </div>
            <?if($arResult['PROPERTIES']['NAME_COMPANY']['VALUE'] || $arResult['PROPERTIES']['NUMBER_COMPANY']['VALUE'] || 
            $arResult['PROPERTIES']['SITE_COMPANY']['VALUE']|| $arResult['PROPERTIES']['SOCIAL_COMPANY']['VALUE']){?>
            <div class="event__contacts-holder f-row">
              <div class="event__contacts-block f-col g-24" style="width: 360px;">
                <?if($arResult['PROPERTIES']['NAME_COMPANY']['VALUE']) {?>
                  <strong class="event__contacts-title weight-l text-xl"><?=$arResult['PROPERTIES']['NAME_COMPANY']['VALUE']?></strong>
                  <?}?>
                <?if ($arResult['PROPERTIES']['NUMBER_COMPANY']['VALUE']){?>
                <div class="event__contact-holder f-row g-20 align-center">
                  <svg class="event__map-svg" width="20" height="20">
                    <use href="#icon-call"></use>
                  </svg>
                  <div class="event__contact-block f-col g-8">
                    <div class="event__contact-phone-holder f-row">
                      <a href="tel:+<?=$arResult['PROPERTIES']['NUMBER_COMPANY']['VALUE']?>"><span class="event__contact-phone text-xl"><?$tel = $arResult['PROPERTIES']['NUMBER_COMPANY']['VALUE'];
                      echo '+'.$tel[0]." (" . $tel[1].$tel[2].$tel[3].")";
                      ?></span>
                      <span class="event__contact-phone-hidden text-xl color-grey60">ХХХХХХХ</span></a>
                    </div>
                    <button class="event__contact-phone-btn ghost-button" data-phone="<?=substr($tel, 4)?>">Разблокировать номер</button>
                  </div>
                </div>
                <?}
                if($arResult['PROPERTIES']['SITE_COMPANY']['VALUE']){?>
                <div class="event__contact-holder f-row g-20 align-center">
                  <svg class="event__map-svg" width="20" height="20">
                    <use href="#icon-globe"></use>
                  </svg>
                  <div class="event__contact-block f-col g-8">
                    <div class="event__contact-phone-holder f-row">
                      <span class="event__contact-text text-xl"><?=$arResult['PROPERTIES']['SITE_COMPANY']['VALUE']?></span>
                    </div>
                    <?if ($arResult['PROPERTIES']['SITE_COMPANY']['DESCRIPTION']) {?>
                    <a href="<?=$arResult['PROPERTIES']['SITE_COMPANY']['DESCRIPTION']?>" class="event__contact-link color-sports100">Перейти на сайт</a>
                    <?}
                    else {?>
                    <a href="<?echo 'https://'.$arResult['PROPERTIES']['SITE_COMPANY']['VALUE']?>" class="event__contact-link color-sports100">Перейти на сайт</a>
                    <?}?>
                  </div>
                </div>
                <?}
                if($arResult['PROPERTIES']['SOCIAL_COMPANY']['VALUE']){?>
                <div class="event__contact-holder f-row g-20 align-center">
                  <svg class="event__map-svg" width="20" height="20">
                    <use href="#icon-vk-second"></use>
                  </svg>
                  <div class="event__contact-block f-col g-8">
                    <div class="event__contact-phone-holder f-row">
                      <span class="event__contact-text text-xl"><?=$arResult['PROPERTIES']['SOCIAL_COMPANY']['VALUE']?></span>
                    </div>
                    <?if($arResult['PROPERTIES']['SOCIAL_COMPANY']['DESCRIPTION']){?>
                    <a href="<?=$arResult['PROPERTIES']['SOCIAL_COMPANY']['DESCRIPTION']?>" class="event__contact-link color-sports100">Перейти в группу VK</a>
                    <?}?>
                  </div>
                </div>
                <?}?>
              </div>
            </div>
            <?}?>
          </address>
        </section>
        <?}?>