<?php

namespace Kvokka\Tools\Service;

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Kvokka\Tools\Base\Singleton;

/**
 * Generates sitemap files with support for the custom #CITY# URL marker.
 */
class SitemapGenerator extends Singleton
{
    private const CITY_IBLOCK_ID = 1;

    private const CONTENT_IBLOCK_IDS = [3, 5, 6, 8];

    private const STATIC_PAGES = [
        '/about-us/',
        '/partnership/',
    ];

    public function generate(string $siteUrl = 'https://genzi.ru'): array
    {
        if (!Loader::includeModule('iblock')) {
            throw new \RuntimeException('The iblock module is not available.');
        }

        $documentRoot = Application::getDocumentRoot();
        $siteUrl = rtrim($siteUrl, '/');
        $cities = $this->loadCities();
        $sitemaps = [];
        $report = [
            'files' => [],
            'skipped' => [],
        ];

        $staticEntries = [];
        foreach (self::STATIC_PAGES as $path) {
            $staticEntries[] = [
                'loc' => $siteUrl . $path,
                'lastmod' => null,
            ];
        }

        $staticFile = 'sitemap-files.xml';
        $this->writeFile($documentRoot . '/' . $staticFile, $this->buildUrlset($staticEntries));
        $sitemaps[] = $staticFile;
        $report['files'][$staticFile] = count($staticEntries);

        foreach (self::CONTENT_IBLOCK_IDS as $iblockId) {
            $listTemplate = (string)\CIBlock::GetArrayByID($iblockId, 'LIST_PAGE_URL');
            $detailTemplate = (string)\CIBlock::GetArrayByID($iblockId, 'DETAIL_PAGE_URL');
            $entries = [];
            $listLastmod = [];

            $elements = \CIBlockElement::GetList(
                ['ID' => 'ASC'],
                [
                    '=IBLOCK_ID' => $iblockId,
                    '=ACTIVE' => 'Y',
                    'ACTIVE_DATE' => 'Y',
                ],
                false,
                false,
                ['ID', 'TIMESTAMP_X', 'PROPERTY_CITY']
            );

            while ($element = $elements->Fetch()) {
                $cityId = (int)($element['PROPERTY_CITY_VALUE'] ?? 0);
                if (!$cityId || !isset($cities[$cityId])) {
                    $report['skipped'][] = sprintf(
                        'IBlock %d, element %d: CITY is empty or inactive',
                        $iblockId,
                        (int)$element['ID']
                    );
                    continue;
                }

                $cityCode = $cities[$cityId];
                $path = $this->resolveTemplate($detailTemplate, $cityCode, (int)$element['ID']);
                if ($path === null) {
                    $report['skipped'][] = sprintf(
                        'IBlock %d, element %d: unresolved URL template %s',
                        $iblockId,
                        (int)$element['ID'],
                        $detailTemplate
                    );
                    continue;
                }

                $lastmod = $this->normalizeDate((string)$element['TIMESTAMP_X']);
                $entries[] = [
                    'loc' => $siteUrl . $path,
                    'lastmod' => $lastmod,
                ];

                if (!isset($listLastmod[$cityCode]) || $lastmod > $listLastmod[$cityCode]) {
                    $listLastmod[$cityCode] = $lastmod;
                }
            }

            foreach ($listLastmod as $cityCode => $lastmod) {
                $path = $this->resolveTemplate($listTemplate, $cityCode);
                if ($path !== null) {
                    array_unshift($entries, [
                        'loc' => $siteUrl . $path,
                        'lastmod' => $lastmod,
                    ]);
                }
            }

            $entries = $this->uniqueEntries($entries);
            $fileName = 'sitemap-iblock-' . $iblockId . '.xml';
            $this->writeFile($documentRoot . '/' . $fileName, $this->buildUrlset($entries));
            $sitemaps[] = $fileName;
            $report['files'][$fileName] = count($entries);
        }

        $this->writeFile(
            $documentRoot . '/sitemap.xml',
            $this->buildSitemapIndex($siteUrl, $sitemaps)
        );
        $report['files']['sitemap.xml'] = count($sitemaps);

        return $report;
    }

    private function loadCities(): array
    {
        $cities = [];
        $result = \CIBlockElement::GetList(
            ['SORT' => 'ASC'],
            [
                '=IBLOCK_ID' => self::CITY_IBLOCK_ID,
                '=ACTIVE' => 'Y',
            ],
            false,
            false,
            ['ID', 'CODE']
        );

        while ($city = $result->Fetch()) {
            $code = trim((string)$city['CODE']);
            if ($code !== '') {
                $cities[(int)$city['ID']] = $code;
            }
        }

        return $cities;
    }

    private function resolveTemplate(string $template, string $cityCode, ?int $elementId = null): ?string
    {
        $path = str_replace(
            ['#SITE_DIR#', '#CITY#', '#ELEMENT_ID#'],
            ['/', $cityCode, $elementId === null ? '' : (string)$elementId],
            $template
        );

        if ($path === '' || preg_match('/#[A-Z0-9_]+#/', $path)) {
            return null;
        }

        return '/' . ltrim($path, '/');
    }

    private function normalizeDate(string $date): ?string
    {
        if ($date === '') {
            return null;
        }

        try {
            return (new \DateTime($date))->format(DATE_W3C);
        } catch (\Exception $exception) {
            return null;
        }
    }

    private function uniqueEntries(array $entries): array
    {
        $unique = [];
        foreach ($entries as $entry) {
            $unique[$entry['loc']] = $entry;
        }

        return array_values($unique);
    }

    private function buildUrlset(array $entries): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($entries as $entry) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>' . $this->escape($entry['loc']) . "</loc>\n";
            if (!empty($entry['lastmod'])) {
                $xml .= '    <lastmod>' . $this->escape($entry['lastmod']) . "</lastmod>\n";
            }
            $xml .= "  </url>\n";
        }

        return $xml . "</urlset>\n";
    }

    private function buildSitemapIndex(string $siteUrl, array $files): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        $lastmod = (new \DateTime())->format(DATE_W3C);

        foreach ($files as $file) {
            $xml .= "  <sitemap>\n";
            $xml .= '    <loc>' . $this->escape($siteUrl . '/' . $file) . "</loc>\n";
            $xml .= '    <lastmod>' . $this->escape($lastmod) . "</lastmod>\n";
            $xml .= "  </sitemap>\n";
        }

        return $xml . "</sitemapindex>\n";
    }

    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }

    private function writeFile(string $path, string $contents): void
    {
        if (file_put_contents($path, $contents, LOCK_EX) === false) {
            throw new \RuntimeException('Cannot write sitemap file: ' . $path);
        }
    }
}
