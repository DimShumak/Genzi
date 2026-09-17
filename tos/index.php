<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Пользовательское соглашение");
?>

<?$APPLICATION->IncludeComponent(
	"kvokka:page",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"ELEMENT_ID" => "7",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "content",
		"PROPERTY_CODE" => "EDITOR"
	)
);?>

<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>