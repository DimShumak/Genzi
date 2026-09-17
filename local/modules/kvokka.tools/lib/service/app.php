<?

namespace Kvokka\Tools\Service;

use \Bitrix\Main\Context;
use \Kvokka\Tools\Base\Singleton;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;

class App extends Singleton
{
    private $rootTypeSectionCode = 'sport';

    private $typeSectionsSet = [];
    private $currentTypeSectionId = null;

    private $citySet = [];
    private $currentCityId = null;

    const IBLOCK_CITY = 1;
    const IBLOCK_TYPE = 2;

    public function init()
    {
        Loader::includeModule("iblock");

        $request = Context::getCurrent()->getRequest();
        $dirPage = $request->getDecodedUri();

        if ($request->isAdminSection()) {
            return false;
        }

        $this->loadData();

        if ($dirPage === '/') {
            $cities = array_values($this->citySet);

            LocalRedirect("/" . $cities[0]['CODE'] . "/", 302);
        }

        $session = Application::getInstance()->getSession();
        $dirLast = end(explode('/', trim($request->getRequestedPageDirectory(), "/")));

        if (in_array($dirLast, ['travels', 'events'])) {
			$session->remove('user_section_id');
			$this->currentTypeSectionId = null;
		}

        if($session->get('user_section_id')){
			$this->currentTypeSectionId = $session->get('user_section_id');
		}


        if ($this->currentTypeSectionId) {
            $navChains = \CIBlockSection::GetNavChain(false, $this->currentTypeSectionId, ['ID', 'DEPTH_LEVEL', 'CODE'], true);
            foreach ($navChains as $chain) {
                if ($chain['DEPTH_LEVEL'] == 1) {
                    $this->rootTypeSectionCode = $chain['CODE'];
                }
            }
        }

        if ($_REQUEST['CITY'] && $this->citySet[$_REQUEST['CITY']]) {
            $this->currentCityId = $this->citySet[$_REQUEST['CITY']]['ID'];
        }
    }

    public function getChildrenTypeSectionsIds($parentId)
    {
        $result = [];

        $curentData = array_filter(array_values($this->typeSectionsSet), fn($item) => $item['ID'] == $parentId);
        $curentData =  count($curentData) > 0 ? end($curentData) : false;

        if ($curentData) {
            foreach ($this->typeSectionsSet as $section) {
                if ($section['LEFT_MARGIN'] >= $curentData['LEFT_MARGIN'] && $section['RIGHT_MARGIN'] <= $curentData['RIGHT_MARGIN']) {
                    $result[] = $section['ID'];
                }
            }
        }

        return $result;
    }

    public function issetType($id)
    {
        $curentData = array_filter(array_values($this->typeSectionsSet), fn($item) => $item['ID'] == $id);
        return  count($curentData) > 0 ? end($curentData) : false;
    }

    public function issetCity($id)
    {
        $curentData = array_filter(array_values($this->citySet), fn($item) => $item['ID'] == $id);
        return  count($curentData) > 0 ? end($curentData) : false;
    }

    public function getCityIdByCode($code)
    {
        return $this->citySet[$code] ? $this->citySet[$code]['ID'] : false;
    }

    public function getCityId()
    {
        return $this->currentCityId;
    }

    public function getTypeId()
    {
        return $this->currentTypeSectionId;
    }

    public function getRootTypeCode()
    {
        return $this->rootTypeSectionCode;
    }

    public function getActiveTypeName()
    {
        $result = array_filter($this->typeSectionsSet, fn($item) => $item['ID'] == $this->getTypeId());

        if ($result) {
            return end($result)['NAME'];
        }

        return "";
    }

    public function getTypeIdByCode($code)
    {
        return $this->typeSectionsSet[$code] ? $this->typeSectionsSet[$code]['ID'] : false;
    }


    public function getRootTypeId()
    {
        if ($this->typeSectionsSet[$this->rootTypeSectionCode]) {
            return $this->typeSectionsSet[$this->rootTypeSectionCode]['ID'];
        }

        return null;
    }

    private function loadData()
    {
        if (!$this->typeSectionsSet) {
            $items = \Bitrix\Iblock\SectionTable::getList([
                'select' => [
                    'ID',
                    'NAME',
                    'CODE',
                    'LEFT_MARGIN',
                    'RIGHT_MARGIN'
                ],
                'filter' => [
                    '=ACTIVE'    => 'Y',
                    '=IBLOCK_ID' => self::IBLOCK_TYPE
                ],
                'order' => [
                    'SORT' => 'ASC'
                ]
                // 'cache' => [
                //     'ttl' => 60,
                //     'cache_joins' => true,
                // ]
            ])->fetchAll();

            foreach ($items as $arItem) {
                $this->typeSectionsSet[$arItem['CODE']] = $arItem;
            }

            $items = array_values($this->typeSectionsSet);
            $this->currentTypeSectionId = $items[0]['ID'];
        }

        if (!$this->citySet) {
            $items = \Bitrix\Iblock\ElementTable::getList([
                'select' => [
                    'ID',
                    'NAME',
                    'CODE'
                ],
                'filter' => [
                    '=ACTIVE'    => 'Y',
                    '=IBLOCK_ID' => self::IBLOCK_CITY
                ],
                'order' => [
                    'SORT' => 'ASC'
                ]
                // 'cache' => [
                //     'ttl' => 60,
                //     'cache_joins' => true,
                // ]
            ])->fetchAll();

            foreach ($items as $arItem) {
                $this->citySet[$arItem['CODE']] = $arItem;
            }

            $items = array_values($this->citySet);
            $this->currentCityId = $items[0]['ID'];
        }
    }
}
