<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<div class="news__pagination pagination f-row g-32 j-between">
	<?// Кнопка "Назад" ?>
	<?if($arResult["NavPageNomer"] > 1):?>
		<a class="pagination__btn-prev secondary-button" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
			<svg class="pagination__btn-svg" width="20" height="20">
				<use href="#icon-arrow-left"></use>
			</svg>
		</a>
	<?else:?>
		<button class="pagination__btn-prev secondary-button" disabled>
			<svg class="pagination__btn-svg" width="20" height="20">
				<use href="#icon-arrow-left"></use>
			</svg>
		</button>
	<?endif?>

	<div class="pagination__pages-holder f-row g-8 align-center">
		<?// Мобильная индикация текущей страницы ?>
		<span class="pagination__page mobile-page inactive"><?=$arResult["NavPageNomer"]?>/<?=$arResult["NavPageCount"]?></span>
		
		<?
		$showStartEllipsis = false;
		$showEndEllipsis = false;
		
		if ($arResult["NavPageCount"] > 6) {
			$showStartEllipsis = ($arResult["NavPageNomer"] > 3);
			$showEndEllipsis = ($arResult["NavPageNomer"] < $arResult["NavPageCount"] - 2);
		}
		?>
		
		<?if ($arResult["NavPageNomer"] == 1):?>
			<span class="pagination__page active">1</span>
		<?else:?>
			<a class="pagination__page" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a>
		<?endif;?>
		
		<?if ($showStartEllipsis):?>
			<span class="pagination__page inactive">...</span>
		<?endif;?>
		
	
		<?
		
		$startPage = max(2, $arResult["NavPageNomer"] - 1);
		$endPage = min($arResult["NavPageCount"] - 1, $arResult["NavPageNomer"] + 2);
		
		
		if ($arResult["NavPageCount"] <= 6) {
		
			$startPage = 2;
			$endPage = $arResult["NavPageCount"] - 1;
		} else {
			
			if ($arResult["NavPageNomer"] <= 3) {
				$startPage = 2;
				$endPage = 5; 
			}
	
			elseif ($arResult["NavPageNomer"] >= $arResult["NavPageCount"] - 2) {
				$startPage = $arResult["NavPageCount"] - 4;
				$endPage = $arResult["NavPageCount"] - 1;
			}
	
			else {
				$startPage = $arResult["NavPageNomer"] - 1;
				$endPage = $arResult["NavPageNomer"] + 2;
			}
		}
		
		for ($i = $startPage; $i <= $endPage; $i++):
			if ($arResult["NavPageNomer"] == $i):?>
				<span class="pagination__page active"><?=$i?></span>
			<?else:?>
				<a class="pagination__page" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$i?>"><?=$i?></a>
			<?endif;
		endfor;
		?>
		
		<?if ($showEndEllipsis):?>
			<span class="pagination__page inactive">...</span>
		<?endif;?>
		
		<?if ($arResult["NavPageCount"] > 1):?>
			<?if ($arResult["NavPageNomer"] == $arResult["NavPageCount"]):?>
				<span class="pagination__page active"><?=$arResult["NavPageCount"]?></span>
			<?else:?>
				<a class="pagination__page" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=$arResult["NavPageCount"]?></a>
			<?endif;?>
		<?endif;?>
	</div>

	<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<a class="pagination__btn-next secondary-button" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
			<svg class="pagination__btn-svg" width="20" height="20">
				<use href="#icon-arrow-right"></use>
			</svg>
		</a>
	<?else:?>
		<button class="pagination__btn-next secondary-button" disabled>
			<svg class="pagination__btn-svg" width="20" height="20">
				<use href="#icon-arrow-right"></use>
			</svg>
		</button>
	<?endif?>
</div>