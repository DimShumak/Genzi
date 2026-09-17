<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Page\Asset;

    Asset::getInstance()->addJs("/local/js/jquery.mask.min.js");

    Asset::getInstance()->addJs('script.js');
?>
