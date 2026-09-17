<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Error;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Errorable;
use Bitrix\Main\Engine\JsonPayload;

class CustumComponent extends CBitrixComponent implements Controllerable, Errorable
{
    /** @var ErrorCollection */
    protected $errorCollection;

    protected function listKeysSignedParameters()
    {
        return [
            "IBLOCK_ID",
            "IBLOCK_TYPE",
        ];
    }

    public function onPrepareComponentParams($arParams)
    {
        $this->errorCollection = new ErrorCollection();

        $arParams['ROOT_ID'] = 'app_' . md5(serialize($arParams));

        return $arParams;
    }

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

    public function configureActions()
    {
        return [
            'add' => [
                'prefilters' => [],
            ],
            'save' => [
                'prefilters' => [],
            ],
        ];
    }

    public function addAction($id)
    {
        if (!$id) {
            $this->errorCollection[] = new Error('Empty id');
        }

        return [
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID']
        ];
    }

    public function saveAction(JsonPayload $payload)
    {
        return $payload->getData();
    }
}
