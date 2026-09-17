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
if ($arResult['ITEMS']){?>
	<h1 class="news__title page-title"><?=$arResult['NAME']?></h1>
        <div class="news__images-block-holder">
          <div class="news__images-block g-4">
		<?$countF = 0;
		foreach($arResult["ITEMS"] as $arItem){?>
				<?
				if ($count == 3){
					break;
				}
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				switch($count){
				case 0:
					?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="news__image-container news__image-container--first" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?
					break;
				case 1:
					?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="news__image-container news__image-container--second" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?
					break;
				case 2:
					?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="news__image-container news__image-container--third" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?
					break;
				}?>
					<picture>
						<source srcset="<?=$arItem['PREVIEW_PICTURE']['webp_src']?>" type="image/webp">
						<img class="news__image-container-img" src="<?=$arItem['PREVIEW_PICTURE']['src']?>" alt="<?=$arItem['NAME']?>">
					</picture>
					<div class="news__image-label tag dark">
						<?$firstItem = reset($arItem['DISPLAY_PROPERTIES']['TYPE']['LINK_SECTION_VALUE']);
						echo $firstItem['NAME'];?></div>
					<div class="news__image-gradient">
						<span class="news__image-text weight-xl">
						<?=$arItem['NAME']?>
						</span>
					</div>
				</a>
          <?$count++;
		}?>
          </div>
        </div>

		<?$APPLICATION->IncludeComponent(
          "bitrix:main.include",
          "",
          Array(
            "AREA_FILE_SHOW" => "sect",
            "AREA_FILE_SUFFIX" => "adds_horizontal_top",
            "EDIT_TEMPLATE" => ""
          )
        );?>

		 <?$countS = 0;
		 foreach($arResult['ITEMS'] as $arItem){
			$countS++;
			if($countS < 4) {
				continue;
			}
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
			<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="news__news-item f-row" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="news__news-item-img-holder">
				<picture>
					<source srcset="<?=$arItem['PREVIEW_PICTURE']['webp_src']?>" type="image/webp">
					<img class="news__news-item-img" src="<?=$arItem['PREVIEW_PICTURE']['src']?>" alt="<?=$arItem['NAME']?>">
				</picture>
			</div>

			<div class="news__info-holder f-col">
				<div class="news__info-label tag light">
					<?$firstItem = reset($arItem['DISPLAY_PROPERTIES']['TYPE']['LINK_SECTION_VALUE']);
						echo $firstItem['NAME'];?>
				</div>
				<div class="news__info-text-holder f-col j-center g-12">
				<span class="news__info-timing text-m color-grey50"><?=FormatDate("j F Y", MakeTimeStamp($arItem['DATE_ACTIVE_FROM']))?></span>
				<h2 class="news__info-title text-xl weight-xl"><?=$arItem['NAME']?></h2>
				</div>
			</div>
			</a>
		<?}?>

		<?$APPLICATION->IncludeComponent(
          "bitrix:main.include",
          "",
          Array(
            "AREA_FILE_SHOW" => "sect",
            "AREA_FILE_SUFFIX" => "adds_horizontal_bottom",
            "EDIT_TEMPLATE" => ""
          )
        );?>

		<?

if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<?}
else {
	?><h1>Новостей нет</h1><?
}
?>
