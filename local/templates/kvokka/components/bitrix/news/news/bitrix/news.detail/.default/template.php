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
//dd($arResult)?>
<div class="news-item__page f-col">
          <h1 class="news-item__title page-title"><?=$arResult['NAME']?></h1>
          <div class="news-item__page-metadata f-row g-20 align-center">
            <div class="news-item__page-metadata-label tag light"><?$firstItem = reset($arResult['DISPLAY_PROPERTIES']['TYPE']['LINK_SECTION_VALUE']);
						echo $firstItem['NAME'];?></div>
            <span class="news-item__page-metadata-date"><?=FormatDate("j F Y", MakeTimeStamp($arResult['DISPLAY_ACTIVE_FROM']))?></span>
          </div>

		  <?
			$APPLICATION->IncludeComponent(
			"sprint.editor:blocks",
			"news",
			array(
				"ELEMENT_ID"    => $arParams['ELEMENT_ID'],
				"IBLOCK_ID"     => $arParams['IBLOCK_ID'],
				"PROPERTY_CODE" => 'EDITOR',
			),
			$component,
			array(
				'HIDE_ICONS' => 'Y'
			)
		);
		  ?>
        </div>