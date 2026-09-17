<?

namespace Kvokka\Tools\Handler;

use \Bitrix\Main;

use \Kvokka\Tools\Base\Handler;
use \Kvokka\Tools\Service\App;

class Util extends Handler
{
    public function initEventHandler(): void
    {
        $this->eventManager->addEventHandler("main", "OnPageStart", [Util::class, "onPageStart"]);

        // if ($GLOBALS["APPLICATION"]->GetCurPage() == '/bitrix/admin/cache.php') {
        //     $request = Main\Context::getCurrent()->getRequest();

        //     if (
        //         $request->get("cachetype") == "all"
        //         && $request->get("clearcache") == "Y"
        //     ) {
        //         $dir = new IO\Directory(Main\Application::getDocumentRoot() . "/upload/webp/");
        //         if ($dir->isExists()) {
        //             $dir->delete();
        //         }
        //     }
        // }
    }

    /**
     * Create constant id by iblock and highloadblock
     */
    public static function onPageStart(): Main\EventResult
    {
        App::getInstance()->init();

        return new Main\EventResult(Main\EventResult::SUCCESS);
    }
}
