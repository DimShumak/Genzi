<?php
$arUrlRewrite=array (
  5 => 
  array (
    'CONDITION' => '#^/([^/]+)/travels/(\\?.*)?$#',
    'RULE' => 'CITY=$1',
    'ID' => '',
    'PATH' => '/travels/index_travels.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/([^/]+)/events/(\\?.*)?$#',
    'RULE' => 'CITY=$1',
    'ID' => '',
    'PATH' => '/events/index_events.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/([^/]+)/locations/(\\?.*)?$#',
    'RULE' => 'CITY=$1',
    'ID' => '',
    'PATH' => '/locations/index_locations.php',
    'SORT' => 200,
  ),
  3 => 
  array (
    'CONDITION' => '#^/([^/]+)/sections/(\\?.*)?$#',
    'RULE' => 'CITY=$1',
    'ID' => '',
    'PATH' => '/sections/index_sections.php',
    'SORT' => 200,
  ),
  2 => 
  array (
    'CONDITION' => '#^/([^/]+)/shops/(\\?.*)?$#',
    'RULE' => 'CITY=$1',
    'ID' => '',
    'PATH' => '/shops/index_shops.php',
    'SORT' => 200,
  ),
  4 => 
  array (
    'CONDITION' => '#^/([^/]+)/(\\?.*)?$#',
    'RULE' => 'CITY=$1',
    'ID' => '',
    'PATH' => '/index_news.php',
    'SORT' => 500,
  ),
);
