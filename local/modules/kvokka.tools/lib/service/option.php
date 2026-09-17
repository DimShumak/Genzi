<?

namespace Kvokka\Tools\Service;

class Option
{
    public const MODULE_NAME = 'kvokka.tools';

    public static function get(string $name, string $default = "", string $siteId = ""): string
    {
        $moduleId = self::MODULE_NAME;
        $name = $name . '_' . (!empty($siteId) ? $siteId : \Bitrix\Main\Context::getCurrent()->getSite());

        $siteId = $siteId ? $siteId : \Bitrix\Main\Context::getCurrent()->getSite();

        return \Bitrix\Main\Config\Option::get($moduleId, $name, $default, $siteId);
    }

    public static function getRealValue(string $name, string $siteId = ""): string
    {
        $moduleId = self::MODULE_NAME;
        $name = $name . '_' . (!empty($siteId) ? $siteId : \Bitrix\Main\Context::getCurrent()->getSite());
        $siteId = $siteId ? $siteId : \Bitrix\Main\Context::getCurrent()->getSite();

        return \Bitrix\Main\Config\Option::getRealValue($moduleId, $name, $siteId);
    }

    public static function set(string $name, string $value = "", string $siteId = "")
    {
        $moduleId = self::MODULE_NAME;
        $siteId = $siteId ? $siteId : \Bitrix\Main\Context::getCurrent()->getSite();

        return \Bitrix\Main\Config\Option::set($moduleId, $name, $value, $siteId);
    }
}
