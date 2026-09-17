<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)){?>
<nav aria-label="Меню футера" class="footer__nav-options f-row align-center">
          <ul class="f-row g-12">
			<?foreach($arResult as $arItem){?>
            <li>
				<?if($arItem["SELECTED"]){?>
              <a href="<?=$arItem["LINK"]?>" class="footer__nav-link text-l nav-el nav-el--active"><?=$arItem["TEXT"]?></a>
			  <?}
			  else {
				?><a href="<?=$arItem["LINK"]?>" class="footer__nav-link text-l nav-el"><?=$arItem["TEXT"]?></a><?
			  }?>
            </li>
			<?}?>
          </ul>
        </nav>
<?}?>