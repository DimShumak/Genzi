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
//dd($arResult['ITEMS']);
use \Kvokka\Tools\Service\App;
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;?>
	<div class="sections__page f-col">
    <?$sectionId = App::getInstance()->getTypeId();
    if($sectionId == 1) {?>
      <h1 class="sections__title page-title">Секции</h1><?
      $APPLICATION->SetPageProperty("title", "Секции");
      $APPLICATION->AddChainItem("Секции", $APPLICATION->GetCurPage()); 
    }
    elseif ($sectionId == 2){
      ?><h1 class="sections__title page-title">Обучение</h1><?
      $APPLICATION->SetPageProperty("title", "Обучение");
      $APPLICATION->AddChainItem("Обучение", $APPLICATION->GetCurPage()); 
    }
    elseif($sectionId != 1 && \Kvokka\Tools\Service\App::getInstance()->getRootTypeCode() == 'sport') {
      $arSection = CIBlockSection::GetByID($sectionId)->Fetch();?>
      <h1 class="locations__title page-title">Секции - <?=$arSection['NAME']?></h1>
    <?$nameTitle = 'Секции - '.$arSection['NAME'];
    $APPLICATION->SetPageProperty("title", $nameTitle);
    $APPLICATION->AddChainItem("Секции", $APPLICATION->GetCurPage()); 
    }
    else{
      $arSection = CIBlockSection::GetByID($sectionId)->Fetch();?>
      <h1 class="locations__title page-title">Обучение - <?=$arSection['NAME']?></h1><?
      $nameTitle = 'Обучение - '.$arSection['NAME'];
      $APPLICATION->SetPageProperty("title", $nameTitle);
      $APPLICATION->AddChainItem("Обучение", $APPLICATION->GetCurPage());
    }
    //dd($arResult['ITEMS'])?>
          <div class="sections__main f-col">
            <div class="sections__form-holder f-row">
              <form id="ageFilterForm" method="GET" class="sections__form f-row g-2">
                <?foreach ($arResult['FILTER_SET'] as $arKey => $arFilter){?>
                <div class="sections__form-dropdown-holder dropdown-holder">
                  <button type="button" class="sections__form-label-button dropdown-open-button dropdown-button f-row align-center">
                    <span class="sections__form-btn-text"><?= $arFilter['NAME'] ?></span>
                    <svg class="sections__form-svg" width="20" height="20">
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
                          <input id="<?=$arItem['VALUE']?>" type="checkbox" name="<?= $arKey ?>[]" value="<?= $arItem['VALUE'] ?>" class="dropdown__custom-checkbox--input"
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
                <?} 
                foreach($arResult['FILTER_BOOL'] as $arFilter){?>
                 <button type="button" onclick="toggleFilter('<?=$arFilter['CODE']?>', this)" class="sections__form-label-button dropdown-button f-row align-center
                 <?=$arFilter['IS_CHECKED'] ? 'active' : ''?>">
                  <span class="sections__form-btn-text"><?=$arFilter['NAME']?></span>
                </button>
                <?}?>
              </form>
            </div>

            <? if ($arResult['ITEMS']){
            foreach($arResult['ITEMS'] as $arItem){
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
              <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="sections__section-item f-row" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

                <div class="card-hide-desktop">
                  <p class="sections__info-title text-xl weight-xl"><?=$arItem['NAME']?></p>
                  <p class="sections__info-text text-m"><?=$arItem['PREVIEW_TEXT']?></p>
                  <?if ($arItem['PROPERTIES']['ADDRESS']['VALUE']) {?>
                  <address class="sections__contacts-holder f-col g-8">
                    <div class="sections__contact f-row g-8 align-center">
                      <svg class="sections__contact-svg" width="20" height="20">
                        <use href="#icon-location"></use>
                      </svg>
                      <span class="sections__contact-text"><?=$arItem['PROPERTIES']['ADDRESS']['VALUE']?></span>
                    </div>
                  </address>
                  <?}?>
                </div>

                <div class="sections__section-item-img-holder">
                  <picture>
                    <source srcset="<?=$arItem['PREVIEW_PICTURE']['webp_src']?>" type="image/webp">
                    <img class="sections__section-item-img" src="<?=$arItem['PREVIEW_PICTURE']['src']?>" alt="<?=$arItem['NAME']?>">
                  </picture>
                </div>

                <div class="sections__info-holder f-col">
                  <div class="locations__type">
                    <div class="sections__info-labels-holder f-row g-4">
                      <!-- <?//if(is_array($arItem['DISPLAY_PROPERTIES']['AGE']['DISPLAY_VALUE'])) {
                        //foreach($arItem['DISPLAY_PROPERTIES']['AGE']['DISPLAY_VALUE'] as $arAge){?>
                          <div class="sections__info-label tag light"><?//=$arAge?></div>
                        <?//}
                     // }
                     // else {?>
                        <div class="sections__info-label tag light"><?//=$arItem['DISPLAY_PROPERTIES']['AGE']['DISPLAY_VALUE']?></div>
                      <?//}?> -->
                      <?if($arItem['PROPERTIES']['TRIAL']['VALUE_XML_ID']== 'Y'){?>
                        <div class="sections__info-label tag light">Пробное занятие</div>
                        <?}?>
                        <?if($arItem['PROPERTIES']['ONE_TIME']['VALUE_XML_ID']== 'Y'){?>
                        <div class="sections__info-label tag light">Разовое занятие</div>
                        <?}?>
                        <?if($arItem['PROPERTIES']['CERTIFICATE']['VALUE_XML_ID']== 'Y' && App::getInstance()->getRootTypeCode() != 'sport'){?>
                        <div class="sections__info-label tag light">Подарочный сертификат</div>
                        <?}?>
                      <?foreach($arItem['DISPLAY_PROPERTIES']['TYPE']['LINK_SECTION_VALUE'] as $arType){?>
                          <div class="sections__info-label tag light"><?=$arType['NAME']?></div>
                       <?}?>
                  </div>
                  </div>
                  <div class="sections__info-text-holder f-col j-center card-hide-phone">
                    <h2 class="sections__info-title text-xl weight-xl"><?=$arItem['NAME']?></h2>
                    <p class="sections__info-text text-m"><?=$arItem['PREVIEW_TEXT']?></p>
                    <?if ($arItem['PROPERTIES']['ADDRESS']['VALUE']) {?>
                    <address class="sections__contacts-holder f-col g-8">
                      <div class="sections__contact f-row g-8 align-center">
                        <svg class="sections__contact-svg" width="20" height="20">
                          <use href="#icon-location"></use>
                        </svg>
                        <span class="sections__contact-text"><?=$arItem['PROPERTIES']['ADDRESS']['VALUE']?></span>
                      </div>
                    </address>
                    <?}?>
                  </div>
                </div>
              </a>
            <?}?>
            <?}
              else {
                ?><p class="sections__section-item f-row">Секций нет</p><?
              }
              ?>
          </div>
        </div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

