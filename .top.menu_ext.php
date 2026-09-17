<?

use Kvokka\Tools\Service\Element;
$sectionId = \Kvokka\Tools\Service\App::getInstance()->getRootTypeCode();
$aMenuLinks = Array(
	Array(
		"НОВОСТИ", 
		Element::getInstance()->makeUrlPrefix("/"), 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		$sectionId == 'extreme' ? "ОБУЧЕНИЕ" : "СЕКЦИИ", 
		Element::getInstance()->makeUrlPrefix("/sections/"), 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"ЛОКАЦИИ", 
		Element::getInstance()->makeUrlPrefix("/locations/"), 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"ЭКИПИРОВКА И СЕРВИСЫ", 
		Element::getInstance()->makeUrlPrefix("/shops/"), 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"СОБЫТИЯ", 
		Element::getInstance()->makeUrlPrefix("/events/"), 
		Array(), 
		Array("HIDE" => "Y"), 
		"" 
	),
	Array(
		"ПУТЕШЕСТВИЯ", 
		Element::getInstance()->makeUrlPrefix("/travels/"), 
		Array(), 
		Array("HIDE" => "Y"), 
		"" 
	)
);
?>