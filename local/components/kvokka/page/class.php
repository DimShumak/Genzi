<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Errorable;

class CustumComponent extends CBitrixComponent implements Errorable
{
    /** @var ErrorCollection */
    protected $errorCollection;

    public function getErrors()
    {
        return $this->errorCollection->toArray();
    }

    public function getErrorByCode($code)
    {
        return $this->errorCollection->getErrorByCode($code);
    }

    public function executeComponent()
    {
        if ($this->startResultCache()) {
            $this->includeComponentTemplate();
        }
    }
}
