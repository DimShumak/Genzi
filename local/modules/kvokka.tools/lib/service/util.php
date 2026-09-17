<?

namespace Kvokka\Tools\Service;

use \Bitrix\Highloadblock\HighloadBlockTable;
use \Bitrix\Main\ORM\Entity;
use \Bitrix\Main\Loader;
use \Bitrix\Main\IO;
use \Bitrix\Main\Application;
use \Kvokka\Tools\Base\Singleton;

class Util extends Singleton
{

    /**
     *  $entity = Kvokka\Tools\Service\Util:getInstance()->getHlEntity(1);
     *  $entityDataClass = $entity->getDataClass();
     *  $item = $entityDataClass::getById(1)->fetch();
     */
    public function getHlEntity(int $id): Entity|false
    {
        if (Loader::includeModule("highloadblock")) {
            $hlblock = HighloadBlockTable::getById($id)->fetch();

            if (!$hlblock)
                return false;

            $entity = HighloadBlockTable::compileEntity($hlblock);

            if (!$entity)
                return false;

            return $entity;
        }

        return false;
    }

    public function makeWebp($src, $quality = 95): string
    {
        if (function_exists('imagewebp')) {
            $base = str_replace(array('.jpg', '.jpeg', '.gif', '.png', '.JPG', '.PNG'), '_' . $quality . '.webp', $src);
            $path = str_replace('upload', 'upload/webp', $base);

            $file = new IO\File(Application::getDocumentRoot() . $path);
            $dir = $file->getDirectory();

            if (!$dir->isExists()) {
                $dir->create();
            }

            if (!$file->isExists()) {
                $info = getimagesize(Application::getDocumentRoot() . $src);

                if ($info !== false && ($type = $info[2])) {
                    switch ($type) {
                        case IMAGETYPE_JPEG:
                            $newImg = imagecreatefromjpeg(Application::getDocumentRoot() . $src);
                            break;
                        case IMAGETYPE_GIF:
                            $newImg = imagecreatefromgif(Application::getDocumentRoot() . $src);
                            break;
                        case IMAGETYPE_PNG:
                            $newImg = imagecreatefrompng(Application::getDocumentRoot() . $src);
                            break;
                    }

                    if ($newImg) {
                        imagewebp($newImg, Application::getDocumentRoot() . $path, $quality);
                        imagedestroy($newImg);
                    } else {
                        return $src;
                    }
                }
            }

            return $path;
        }

        return $src;
    }

    public function resizeImagePPI($file, $arSize, $resizeType = BX_RESIZE_IMAGE_PROPORTIONAL, $quality = 95, $arFilters = false, $bImmediate = false): array|bool
    {
        $fileResult = \CFile::ResizeImageGet($file, $arSize, $resizeType, true, $arFilters, $bImmediate, 100);

        if (!$fileResult) {
            return false;
        }

        $fileResult['srcset_row'] = [
            '1x' => $fileResult,
            '2x' => \CFile::ResizeImageGet($file, ['width' => intval($arSize['width']) * 2, 'height' => intval($arSize['height']) * 2], $resizeType, true, $arFilters, $bImmediate, 100),
            '3x' => \CFile::ResizeImageGet($file, ['width' => intval($arSize['width']) * 3, 'height' => intval($arSize['height']) * 3], $resizeType, true, $arFilters, $bImmediate, 100),
        ];

        $fileResult['srcset'] = [];

        foreach ($fileResult['srcset_row'] as $arKey => $arFile) {
            $fileResult['srcset_row'][$arKey]['src'] = $this->makeWebp($arFile['src'], $quality);
            $fileResult['srcset'][] = $fileResult['srcset_row'][$arKey]['src'] . ' ' . $arKey;
        }

        $fileResult['src'] = $fileResult['srcset_row']['1x']['src'];
        $fileResult['origen'] = is_numeric($file) ? \CFile::GetByID($file)->fetch() : $file;

        $fileResult['srcset'] = implode(', ', $fileResult['srcset']);

        return $fileResult;
    }
}
