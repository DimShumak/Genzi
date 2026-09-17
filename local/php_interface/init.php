<?
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/local/vendor/autoload.php')) {
    require($_SERVER['DOCUMENT_ROOT'] . '/local/vendor/autoload.php');
}

use \Bitrix\Main\Loader;

Loader::includeModule("kvokka.tools");

if (!function_exists("dd")) {

    function dd($data)
    {
        global $USER;
        if ($USER->IsAuthorized() && $USER->GetID() == 1) {
            echo "<pre>";
            print_r($data);
            echo "</pre>";
        }
    }
}
