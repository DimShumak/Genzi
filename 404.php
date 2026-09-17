<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');
use Kvokka\Tools\Service\Element;

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetPageProperty("title", "404");
$APPLICATION->SetTitle("404");
$APPLICATION->AddChainItem("404", "");

$APPLICATION->SetPageProperty("root-class", "not-found f-row");
$APPLICATION->SetPageProperty("content-class", "not-found__content content-block f-row");
$APPLICATION->SetPageProperty("main-class", "not-found__main content-padding f-col flex-1");
?>

<div class="not-found__page f-row j-center align-center">
          <div class="not-found__content f-col g-12">
            <div class="not-found__404-block">
              <span class="not-found__404-text">404</span>
              <picture>
                <source srcset="<?= SITE_TEMPLATE_PATH ?>/assets/images/global-images/not-found-ball.webp" type="image/webp">
                <img class="not-found__404-img" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/global-images/not-found-ball.png" alt="Картинка 404">
              </picture>
            </div>
            <div class="not-found__back-block f-col align-center">
              <h1 class="not-found__back-block-title">Упс, мяч оказался вне поля!</h1>
              <p class="not-found__back-block-text color-grey40 weight-xl">К сожалению, мы не нашли такую страницу</p>
              <button onclick="window.location.href='<?= Element::getInstance()->makeMainUrl()?>'" class="not-found__back-button secondary-button">ВЕРНУТЬСЯ НА ГЛАВНУЮ</button>
            </div>
          </div>
        </div>

<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
