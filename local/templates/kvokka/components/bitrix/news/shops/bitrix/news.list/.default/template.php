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

use Bitrix\Highloadblock\HighloadBlockTable as HLBT;?>
	<div class="shops__page f-col">
    <?$sectionId = \Kvokka\Tools\Service\App::getInstance()->getTypeId();
    if($sectionId == 1 || $sectionId == 2) {?>
      <h1 class="shops__title page-title">Экипировка и сервисы</h1><?
    }
    else {
      $arSection = CIBlockSection::GetByID($sectionId)->Fetch();?>
      <h1 class="locations__title page-title">Экипировка и сервисы - <?=$arSection['NAME']?></h1>
    <?}?>
          <div class="shops__main f-col">
            <div class="shops__form-holder f-row">
              <form id="ageFilterForm" method="GET" class="shops__form f-row g-2">
                <?foreach ($arResult['FILTER_SET'] as $arKey => $arFilter){?>
                <div class="shops__form-dropdown-holder dropdown-holder">
                  <button type="button" class="shops__form-label-button dropdown-open-button dropdown-button f-row align-center">
                    <span class="shops__form-btn-text"><?= $arFilter['NAME'] ?></span>
                    <svg class="shops__form-svg" width="20" height="20">
                      <use href="#icon-arrow-down"></use>
                    </svg>
                  </button>
                  <!-- prettier-ignore -->
                  <div class="dropdown dropdown--props">
                    <div class="dropdown__options-holder f-col g-12">
                      <button type="button" class="dropdown__mob-dragger show-on-mob"></button>
                      <h3 class="dropdown__title show-on-mob"><?= $arFilter['NAME'] ?></h3>

                      <?foreach($arFilter['LIST'] as $arItem) {?>
                      <label class="dropdown__option f-row g-12 j-between align-center" for="<?= $arItem['VALUE'] ?>">
                        <span class="dropdown__options-label"><?= $arItem['LABEL'] ?></span>
                        <label class="dropdown__custom-checkbox">
                          <input id="<?= $arItem['VALUE'] ?>" type="checkbox" name="<?= $arKey ?>[]" value="<?= $arItem['VALUE'] ?>" class="dropdown__custom-checkbox--input"
                           <?= $arItem['IS_CHECKED'] ? 'checked' : '' ?>>
                          <span class="dropdown__custom-checkbox--box">
                            <svg class="dropdown__custom-checkbox--check" width="16" height="16">
                              <use href="#icon-tick"></use>
                            </svg>
                          </span>
                        </label>
                      </label>
                      <?}?>

                      <div class="dropdown__buttons-holder f-col g-8">
                        <button type="submit" name="apply_filter" class="dropdown__btn base-button">ПРИМЕНИТЬ</button>
                        <button type="button" onclick="clearFilter()" class="dropdown__btn secondary-button">ОЧИСТИТЬ</button>
                      </div>
                    </div>
                  </div>

                </div>
                <?}?>
              </form>
            </div>
            <div class="shops__cards-grid"></div>

            <? if ($arResult['ITEMS']){
            foreach($arResult['ITEMS'] as $arItem){
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
              <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="shops__shop-item f-row" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                  <div class="card-hide-desktop">
                    <div class="shops__info-title-holder align-center f-row g-12">
                    <p class="shops__info-title text-xl weight-xl"><?=$arItem['NAME']?></p>
                    <!-- <div class="shops__title-label tag-medium">Закрыто до 22:00</div> -->
                    </div>
                    <p class="shops__info-text text-m"><?=$arItem['PREVIEW_TEXT']?></p>
                    <?if ($arItem['PROPERTIES']['ADDRESS']['VALUE']) {?>
                    <address class="shops__contacts-holder f-col g-8">
                      <div class="shops__contact f-row g-8 align-center">
                        <svg class="shops__contact-svg" width="20" height="20">
                          <use href="#icon-location"></use>
                        </svg>
                        <span class="shops__contact-text"><?=$arItem['PROPERTIES']['ADDRESS']['VALUE']?></span>
                      </div>
                    </address>
                    <?}?>
                  </div>
              
                <div class="shops__shop-item-img-holder">
                  <picture>
                    <source srcset="<?=$arItem['PREVIEW_PICTURE']['webp_src']?>" type="image/webp">
                    <img class="shops__shop-item-img" src="<?=$arItem['PREVIEW_PICTURE']['src']?>" alt="<?=$arItem['NAME']?>">
                  </picture>
                </div>

                <div class="shops__info-holder f-col">
                  <div class="locations__type">
                  <?foreach($arItem['DISPLAY_PROPERTIES']['TYPE']['LINK_SECTION_VALUE'] as $arType){?>
                  <div class="shops__info-labels-holder f-row g-4">
                    <div class="shops__info-label tag light"><?=$arType['NAME']?></div>
                  </div>
                  <?}?>
                  </div>
                  <div class="shops__info-text-holder f-col j-center card-hide-phone">
                    <div class="shops__info-title-holder align-center f-row g-12">
                    <h2 class="shops__info-title text-xl weight-xl"><?=$arItem['NAME']?></h2>
                    <!-- <div class="shops__title-label tag-medium">Закрыто до 22:00</div> -->
                    </div>
                    <p class="shops__info-text text-m"><?=$arItem['PREVIEW_TEXT']?></p>
                    <?if ($arItem['PROPERTIES']['ADDRESS']['VALUE']) {?>
                    <address class="shops__contacts-holder f-col g-8">
                      <div class="shops__contact f-row g-8 align-center">
                        <svg class="shops__contact-svg" width="20" height="20">
                          <use href="#icon-location"></use>
                        </svg>
                        <span class="shops__contact-text"><?=$arItem['PROPERTIES']['ADDRESS']['VALUE']?></span>
                      </div>
                    </address>
                    <?}?>
                  </div>
                </div>
              </a>
            <?}?>
            <?}
              else {
                ?><p class="shops__shop-item f-row">Информации пока нет</p><?
              }
              ?>
          </div>
        </div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

