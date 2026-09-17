<?

namespace Kvokka\Tools\Service;

use \Kvokka\Tools\Base\Singleton;

class Element extends Singleton
{
    public function checkElement($elementId, $cityId = false)
    {
        try {
            if (!$cityId) {
                $cityId = App::getInstance()->getCityIdByCode($_REQUEST['CITY']);
            }

            if (!$cityId) {
                throw new \Exception('404');
            }

            if (!App::getInstance()->issetCity($cityId)) {
                throw new \Exception('404');
            }

            $rdb = \CIBlockElement::GetList(
                [
                    'SORT' => 'ASC'
                ],
                [
                    'ID'            => $elementId,
                    'ACTIVE'        => 'Y',
                    'PROPERTY_CITY' => $cityId
                ],
                false,
                false,
                [
                    'ID',
                    'CODE'
                ]
            );

            if (!$rdb->fetch()) {
                throw new \Exception('404');
            }
        } catch (\Exception $e) {
            global $APPLICATION;

            if (!defined("ERROR_404")) {
                define("ERROR_404", "Y");
            }

            \CHTTP::setStatus("404 Not Found");

            if ($APPLICATION->RestartWorkarea()) {
                require(\Bitrix\Main\Application::getDocumentRoot() . "/404.php");
                die();
            }
        }
    }

    public function checkElementList()
    {
        try {
            $cityId = App::getInstance()->getCityIdByCode($_REQUEST['CITY']);

            if (!$cityId) {
                throw new \Exception('404');
            }
        } catch (\Exception $e) {
            global $APPLICATION;

            if (!defined("ERROR_404")) {
                define("ERROR_404", "Y");
            }

            \CHTTP::setStatus("404 Not Found");

            if ($APPLICATION->RestartWorkarea()) {
                require(\Bitrix\Main\Application::getDocumentRoot() . "/404.php");
                die();
            }
        }
    }

    public function makeUrlToElement($item, $pattern)
    {
        try {
            $result = $pattern;

            if ($city = App::getInstance()->issetCity($item['PROPERTIES']['CITY']['VALUE'])) {
                $result = str_replace('#CITY#', $city['CODE'], $result);
            }

            $result = str_replace('#ELEMENT_ID#', $item['ID'], $result);

            return $result;
        } catch (\Error $e) {
            return $pattern;
        }
    }

    public function makeUrlPrefix($url)
    {
        $currentCity = App::getInstance()->getCityId();
        $cityInfo = App::getInstance()->issetCity($currentCity);

        return "/" . $cityInfo['CODE'] . "/" . trim($url, '/') . '/';
    }

    public function makeMainUrl()
    {
        $currentCity = App::getInstance()->getCityId();
        $cityInfo = App::getInstance()->issetCity($currentCity);

        return "/" . $cityInfo['CODE'] . "/";
    }

    public function makeFilter($filtes = [])
    {
        $baseFilter = [];

        if (App::getInstance()->getCityId()) {
            $baseFilter['=PROPERTY_CITY'] = App::getInstance()->getCityId();
        }

        if (App::getInstance()->getTypeId()) {
            $ids = App::getInstance()->getChildrenTypeSectionsIds(
                App::getInstance()->getTypeId()
            );

            if ($ids) {
                $baseFilter['=PROPERTY_TYPE'] = $ids;
            }
        }

        if (is_array($filtes)) {
            return array_merge($baseFilter, $filtes);
        }

        return $baseFilter;
    }

    public function makeFilterEvents($filtes = [])
    {
        $baseFilter = [];

        if (App::getInstance()->getCityId()) {
            $baseFilter['=PROPERTY_CITY'] = App::getInstance()->getCityId();
        }

        if (is_array($filtes)) {
            return array_merge($baseFilter, $filtes);
        }

        return $baseFilter;
    }
}
