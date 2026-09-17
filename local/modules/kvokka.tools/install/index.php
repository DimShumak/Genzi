<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class kvokka_tools extends CModule
{
    public $MODULE_ID = "kvokka.tools";
    public $PARTNER_NAME = 'kvokka';
    public $PARTNER_URI;
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;

    public function __construct()
    {
        $this->PARTNER_URI = Loc::getMessage("KVOKKA_TOOLS_NAME_URL");
        $this->MODULE_NAME = Loc::getMessage("KVOKKA_TOOLS_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("KVOKKA_TOOLS_DESCRIPTION");

        /** @var array $arModuleVersion */
        include __DIR__ . "/version.php";

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }
    }

    public function DoInstall()
    {
        global $APPLICATION, $step;

        if ($this->checkDependencies()) {
            ModuleManager::registerModule($this->MODULE_ID);
            Loader::includeModule($this->MODULE_ID);

            $this->InstallFiles();
            $this->InstallDB();
            $this->InstallEvents();
            $this->InstallAgents();
        }
    }

    public function DoUninstall()
    {
        global $APPLICATION, $step;

        Loader::includeModule($this->MODULE_ID);

        $step = intval($step);

        if ($step < 2) {
            $APPLICATION->IncludeAdminFile(GetMessage('ESTATE_UNINSTALL_TITLE'), __DIR__ . '/uninstall/step1.php');
        } elseif ($step == 2) {
            $this->UnInstallDB(["delete_tables" => $_REQUEST["delete_tables"]]);
            $this->UnInstallFiles();
            $this->UnInstallEvents();
            $this->UnInstallAgents();

            ModuleManager::unRegisterModule($this->MODULE_ID);
        }
    }

    public function InstallAgents()
    {
        $dateTime = new DateTime();
        $dateTimeFormat = $dateTime->format("d.m.y 23:59:59");

        CAgent::AddAgent(
            "\Kvokka\Tools\Service\MonitorSite::getInstance()->checkAgent();",
            $this->MODULE_ID,
            "N",
            "86400",
            $dateTimeFormat,
            "Y",
            $dateTimeFormat
        );
    }

    public function UnInstallAgents()
    {
        CAgent::RemoveAgent('\Kvokka\Tools\Service\MonitorSite::getInstance()->checkAgent();');
    }

    public function InstallDB()
    {
        return true;
    }

    public function UnInstallDB($arParams = [])
    {
        if ($arParams['delete_tables'] == 'Y') {
            // Delete tables
        }

        return true;
    }

    public function InstallFiles()
    {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . "/local/modules/" . $this->MODULE_ID . "/install/components", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components", true, true);
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . "/local/modules/" . $this->MODULE_ID . "/install/install/gadgets", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/gadgets", true, true);

        return true;
    }

    public function UnInstallFiles()
    {
        DeleteDirFilesEx($_SERVER["DOCUMENT_ROOT"] . "/bitrix/components/" . $this->MODULE_ID);
        DeleteDirFilesEx($_SERVER["DOCUMENT_ROOT"] . "/bitrix/gadgets/" . $this->MODULE_ID);

        return true;
    }

    public function InstallEvents()
    {
        // $eventManager = \Bitrix\Main\EventManager::getInstance();
        // $eventManager->registerEventHandlerCompatible($this->MODULE_ID, "OnGroupDelete", "iblock", "CIBlock", "OnGroupDelete");

        return true;
    }

    public function UnInstallEvents()
    {
        // $eventManager = \Bitrix\Main\EventManager::getInstance();
        // $eventManager->unRegisterEventHandler("main", "OnGroupDelete", "iblock", "CIBlock", "OnGroupDelete");

        return true;
    }

    protected function checkDependencies()
    {
        $result = [];
        $requiredModules = include __DIR__ . "/require.php";

        foreach ($requiredModules as $module) {
            if (!Loader::includeModule($module)) {
                $result[] = $module;
            }
        }

        if (!empty($result)) {
            $this->showError(__DIR__ . "/install/modules_not_installed.php", ["modules" => $result]);
        }

        return true;
    }

    protected function showError($file, $arVariables, $strTitle = "")
    {
        $keys = array_keys($GLOBALS);
        $keys_count = count($keys);

        for ($i = 0; $i < $keys_count; $i++) {
            if ($keys[$i] != "i" && $keys[$i] != "GLOBALS" && $keys[$i] != "strTitle" && $keys[$i] != "filepath") {
                global ${$keys[$i]};
            }
        }

        $APPLICATION->SetTitle($strTitle);

        include $_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/prolog_admin_after.php";
        include $file;
        include $_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_admin.php";

        die();
    }
}
