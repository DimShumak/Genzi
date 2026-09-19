<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)){?>
<nav aria-label="Меню в хэдэра" class="header__middle-block f-row align-center">
          <ul class="f-row g-16">
			<?foreach($arResult as $arItem){
				if($arItem["PARAMS"]["HIDE"] == "Y"){
					continue;
				}?>
            <li>
				<?
				if($arItem["SELECTED"]){?>
              <a href="<?=$arItem["LINK"]?>" class="header__middle-block-link text-l nav-el nav-el--active"><?=$arItem["TEXT"]?></a>
			  <?}
			  else {
				?><a href="<?=$arItem["LINK"]?>" class="header__middle-block-link text-l nav-el nav-el"><?=$arItem["TEXT"]?></a><?
			  }?>
            </li>
			<?}?>
          </ul>
        </nav>
<?}?>