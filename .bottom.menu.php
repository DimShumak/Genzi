<?
use Kvokka\Tools\Service\Element;
$aMenuLinks = Array(
	Array(
		"СОБЫТИЯ", 
		Element::getInstance()->makeUrlPrefix("/events/"), 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"ПУТЕШЕСТВИЯ", 
		Element::getInstance()->makeUrlPrefix("/travels/") , 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"О НАС", 
		"/about-us/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"ПАРТНЕРСТВО", 
		"/partnership/", 
		Array(), 
		Array(), 
		"" 
	)
);
?>