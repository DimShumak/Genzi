<?

namespace Kvokka\Tools\Service;

class Storage
{
    private static $storage = [];

    public static function set(string $name, mixed $value)
    {
        self::$storage[$name] = $value;
    }

    public static function get(string $name)
    {
        return self::$storage[$name];
    }
}
