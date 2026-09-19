<?php

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

define('NO_KEEP_STATISTIC', true);
define('NO_AGENT_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);

$_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__DIR__, 2));
$_SERVER['REQUEST_URI'] = '/local/cli/generate_sitemap.php';

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use Bitrix\Main\Loader;
use Kvokka\Tools\Service\SitemapGenerator;

if (!Loader::includeModule('kvokka.tools')) {
    fwrite(STDERR, "Cannot load kvokka.tools module.\n");
    exit(1);
}

try {
    $report = SitemapGenerator::getInstance()->generate('https://genzi.ru');

    foreach ($report['files'] as $file => $count) {
        fwrite(STDOUT, sprintf("%-28s %d URLs\n", $file, $count));
    }

    foreach ($report['skipped'] as $message) {
        fwrite(STDERR, "Skipped: " . $message . "\n");
    }
} catch (Throwable $exception) {
    fwrite(STDERR, $exception->getMessage() . "\n");
    exit(1);
}
