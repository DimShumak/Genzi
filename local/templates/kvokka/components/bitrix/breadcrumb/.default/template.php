<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Kvokka\Tools\Service\Element;

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if (empty($arResult))
	return "";

$itemSize = count($arResult);

if ($itemSize < 2) {
	return "";
}
$strReturn = '';

$strReturn .= '<nav class="breadcrumbs">
          <ul class="breadcrumbs__list f-row g-12 align-center">';
for ($index = 0; $index < $itemSize; $index++) {
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$link = $arResult[$index]["LINK"];


	if ($index == 0) {
		$strReturn .= '
			<li class="breadcrumbs__item" id="bx_breadcrumb_' . $index . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a href="' . Element::getInstance()->makeMainUrl() . '" title="' . $title . '" itemprop="item" class="breadcrumbs__link">
					<svg class="breadcrumbs__icon" width="20" height="20">
						<use href="#icon-house"></use>
					</svg>
				</a>
			</li>';
	}
	elseif ($index != $itemSize - 1){
		 $strReturn .= '
            <li class="breadcrumbs__item f-row g-12 align-center">
                 <span>/</span>
                 <a href="' . $link . '">' . $title . '</a>
            </li>';
	}
	 else {
		$strReturn .= '
			<li class="breadcrumbs__item f-row g-12 align-center">
				 <span>/</span>
				 <a>' . $title . '</a>
			</li>';
	}
}
$strReturn .= '</ul>
        </nav>';

return $strReturn;
