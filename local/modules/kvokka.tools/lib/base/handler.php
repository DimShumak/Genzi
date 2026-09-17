<?php

namespace Kvokka\Tools\Base;

use \Bitrix\Main\EventManager;

abstract class Handler extends Singleton
{
    public EventManager $eventManager;

    public static function getInstance()
    {
        $instances = parent::getInstance();

        $instances->eventManager = EventManager::getInstance();

        return $instances;
    }

    abstract public function initEventHandler(): void;
}
