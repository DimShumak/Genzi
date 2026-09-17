<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
  die();

use Kvokka\Tools\Service\Element;

?>
</div>
<? if (!defined('ERROR_404') || ERROR_404 !== 'Y') { ?>
  <aside class="vertical-adds vertical-adds--props f-col gap-24">
    <? $APPLICATION->IncludeComponent(
      "bitrix:main.include",
      ".default",
      [
        "AREA_FILE_SHOW" => "sect",
        "AREA_FILE_SUFFIX" => "adds_aside",
        "EDIT_TEMPLATE" => "",
        "COMPONENT_TEMPLATE" => ".default",
        "AREA_FILE_RECURSIVE" => "Y"
      ],
      false
    ); ?>
  </aside>
<? } ?>
</div>
</main>

<footer class="footer footer--props">
  <? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "header_menu",
    [
      "ALLOW_MULTI_SELECT" => "N",
      "CHILD_MENU_TYPE" => "",
      "DELAY" => "N",
      "MENU_CACHE_GET_VARS" => [],
      "MENU_CACHE_TIME" => "360000",
      "MENU_CACHE_TYPE" => "N",
      "MENU_CACHE_USE_GROUPS" => "N",
      "ROOT_MENU_TYPE" => "top",
      "USE_EXT" => "Y",
      "COMPONENT_TEMPLATE" => "header_menu",
      "MAX_LEVEL" => "1"
    ],
    false
  ); ?>

  <div class="footer__top-block-holder">
    <div class="footer__top-block content-block">
      <div class="footer__logo-holder">
        <a href="<?= Element::getInstance()->makeMainUrl() ?>">
          <picture>
            <source srcset="<?= SITE_TEMPLATE_PATH ?>/assets/images/footer/black-logo.webp" type="image/webp">
            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/footer/black-logo.png" alt="Logo" class="footer__logo">
          </picture>
        </a>
      </div>
      <? $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "bottom_menu",
        [
          "ALLOW_MULTI_SELECT" => "N",
          "CHILD_MENU_TYPE" => "",
          "DELAY" => "Y",
          "MENU_CACHE_GET_VARS" => [],
          "MENU_CACHE_TIME" => "360000",
          "MENU_CACHE_TYPE" => "N",
          "MENU_CACHE_USE_GROUPS" => "N",
          "ROOT_MENU_TYPE" => "bottom",
          "USE_EXT" => "N",
          "COMPONENT_TEMPLATE" => "bottom_menu",
          "MAX_LEVEL" => "1"
        ],
        false
      ); ?>
      <div class="footer__feedback-holder">
        <!-- <button data-modal-open="modal-feedback" class="footer__feedback-btn base-button g-8">
          <svg class="footer__feedback-button-svg" width="20" height="20">
            <use href="#icon-comment"></use>
          </svg>
          <span>ЗАДАТЬ ВОПРОС</span>
        </button> -->
        <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/footer/footer_social.php', [], ['MODE' => 'php']); ?>

        <address class="footer__contacts-holder f-col g-8">
          <p class="footer__contact text-l"><? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/footer/footer_mail.php', [], ['MODE' => 'php']); ?></p>
          <!-- <p class="footer__contact text-l"><? // $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/footer/footer_number.php', [], ['MODE'=>'php']);
                                                  ?></p> -->
        </address>
      </div>
    </div>
  </div>

  <div class="footer__bottom-block-holder">
    <div class="footer__bottom-block content-block f-row">
      <nav class="footer__bottom-nav f-row">
        <ul class="footer__bottom-nav-right f-row g-24">
          <li>
            <a href="/tos/" class="footer__bottom-nav-link text-m">Пользовательское соглашение</a>
          </li>
          <li>
            <a href="/privacy/" class="footer__bottom-nav-link text-m">Политика конфиденциальности</a>
          </li>

          <li>
            <button data-modal-open="modal-cookies" data-modal-scroll-lock="false" class="footer__bottom-nav-link text-m open-cookie">
              Разрешения куки
            </button>
          </li>
          <!-- <li>
              <button data-modal-open="modal-feedback-thx" data-modal-scroll-lock="true" class="footer__bottom-nav-link text-m open-cookie">
                фидбэк thx
              </button>
            </li> -->
        </ul>
        <a href="https://tretyakov.agency/" target="_blank" class="footer__bottom-nav-link"> Сайт создан <span class="footer__bottom-nav-link--kvokka">Агентством Третьякова</span></a>
      </nav>
    </div>
  </div>
</footer>

<? $APPLICATION->IncludeComponent(
  "kvokka:form",
  "feedback",
  array(
    "CACHE_TIME" => "3600",
    "AJAX_MODE" => "Y",
    "AJAX_OPTION_SHADOW" => "N",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N",
    "CACHE_TYPE" => "A",
    "IGNORE_CUSTOM_TEMPLATE" => "N",
    "USE_EXTENDED_ERRORS" => "N",
    "VARIABLE_ALIASES_RESULT_ID" => "RESULT_ID",
    "VARIABLE_ALIASES_WEB_FORM_ID" => "WEB_FORM_ID",
    "WEB_FORM_ID" => "1"
  )
); ?>


<div class="modal" data-modal-id="modal-cookies">
  <div class="modal__overlay" data-modal-close="modal-cookies"></div>

  <div class="modal__inner" data-scroll-lock-scrollable="">
    <button class="modal__exit-btn" data-modal-close="modal-cookies">
      <svg data-modal-close="modal-cookies" class="modal__exit-svg" width="20" height="20">
        <use href="#icon-cancel"></use>
      </svg>
    </button>

    <div class="modal__body">
      <div class="modal__holder f-col g-16">
        <h1 class="modal__cookies-title weight-xl text-20-16">Использование Cookie</h1>
        <p class="modal__cookies-text">
          Мы используем cookie для улучшения работы сайта, персонализации контента и аналитики.
          <br>
          Продолжая пользоваться сайтом, вы соглашаетесь с нашей
          <a href="/" class="underline">Политикой конфиденциальности</a>
          и
          <a class="underline">использованием cookie.</a>
        </p>
        <div class="modal__cookies-buttons-holder f-row g-12">
          <!-- <button class="modal__cookies-info-btn secondary-button">ПОДРОБНЕЕ</button> -->
          <button class="modal__cookies-accept-btn base-button">ПРИНЯТЬ</button>
        </div>
      </div>

      <script async="">
        document.addEventListener('DOMContentLoaded', function() {
          const cookieConsent = localStorage.getItem('cookieConsent');
          const modal = document.querySelector('.modal[data-modal-id="modal-cookies"]');
          const exit = modal.querySelector('.modal__exit-btn');
          const acceptBtn = modal.querySelector('.modal__cookies-accept-btn');

          const overlay = modal.querySelector('.modal__overlay');
          const inner = modal.querySelector('.modal__inner');

          modal.style.top = 'auto';
          modal.style.paddingBottom = '10px';
          overlay.style.display = 'none';
          inner.style.padding = '20px';
          if (!cookieConsent) {
            if (modal) {
              modal.dataset.active = 'true';
            }
          }

          acceptBtn.addEventListener('click', function() {
            localStorage.setItem('cookieConsent', 'true');
            exit.click();
          });
        });
      </script>
    </div>
  </div>
</div>

<button class="upp-page base-button g-8">
  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none">
    <path d="M12 6V18M12 6L7 11M12 6L17 11" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
  </svg>
</button>


<svg xmlns="http://www.w3.org/2000/svg" style="display: none">
  <defs>
    <symbol id="icon-arrow-down-round" viewBox="0 0 24 24">
      <path d="M12 15L6 9L18 9L12 15Z" fill="var(--svg-color)"></path>
    </symbol>

    <symbol id="icon-comment" viewBox="0 0 20 20" fill="none">
      <path d="M6.66 10.41L13.33 10.41M6.66 6.25L9.99 6.25" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M18.33 1.66L18.33 15L9.16 15L5 18.33L5 15L1.66 15L1.66 1.66L18.33 1.66Z" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
    </symbol>

    <symbol id="icon-menu" viewBox="0 0 20 20">
      <path d="M3.33 4.16L16.66 4.16" stroke="var(--svg-color)" stroke-width="1.5" stroke-linejoin="round"></path>
      <path d="M3.33 10L16.66 10" stroke="var(--svg-color)" stroke-width="1.5" stroke-linejoin="round"></path>
      <path d="M3.33 15.83L16.66 15.83" stroke="var(--svg-color)" stroke-width="1.5" stroke-linejoin="round"></path>
    </symbol>

    <symbol id="icon-location" viewBox="0 0 20 20" fill="none">
      <path d="M10 9.58C8.84 9.58 7.91 8.65 7.91 7.5C7.91 6.34 8.84 5.41 10 5.41C11.15 5.41 12.08 6.34 12.08 7.5C12.08 8.65 11.15 9.58 10 9.58Z" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M10 15C10 15 4.16 12.33 4.16 7.66C4.16 4.35 6.77 1.66 10 1.66C13.22 1.66 15.83 4.35 15.83 7.66C15.83 12.33 10 15 10 15Z" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M15 15.83C15 17.21 12.76 18.33 10 18.33C7.23 18.33 5 17.21 5 15.83" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
    </symbol>

    <symbol id="icon-copy" viewBox="0 0 20 20" fill="none">
      <path d="M7.5 18.33L18.33 18.33L18.33 7.5L7.5 7.5L7.5 18.33Z" stroke="var(--svg-color)" stroke-width="1.5" stroke-linejoin="round"></path>
      <path d="M14.16 7.5L14.16 1.67L1.66 1.66L1.66 14.16L7.5 14.16" stroke="var(--svg-color)" stroke-width="1.5" stroke-linejoin="round"></path>
    </symbol>

    <symbol id="icon-arrow-left" viewBox="0 0 20 20" fill="none">
      <path d="M12.5 15L7.5 10L12.5 5" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
    </symbol>

    <symbol id="icon-arrow-right" viewBox="0 0 20 20" fill="none">
      <path d="M7.5 5L12.5 10L7.5 15" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
    </symbol>

    <symbol id="icon-arrow-down" viewBox="0 0 20 20" fill="none">
      <path d="M15 7.5L10 12.5L5 7.5" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
    </symbol>

    <symbol id="icon-arrow-up" viewBox="0 0 20 20" fill="none">
      <path d="M5 12.5L10 7.5L15 12.5" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
    </symbol>

    <symbol id="icon-cancel" viewBox="0 0 20 20" fill="none">
      <path d="M15.83 4.16L4.16 15.83M4.16 4.16L15.83 15.83" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
    </symbol>

    <symbol id="icon-plus" viewBox="0 0 20 20" fill="none">
      <path d="M0 0L13.334 0" stroke="var(--svg-color)" stroke-linejoin="round" stroke-width="1.5" transform="matrix(0,1,-1,0,10,3.33398)"></path>
      <path d="M3.33203 10L16.6641 10" stroke="var(--svg-color)" stroke-linejoin="round" stroke-width="1.5"></path>
    </symbol>

    <symbol id="icon-call" viewBox="0 0 20 20" fill="none">
      <path d="M3.14 9.95L6.66 6.66L4.16 1.66C2.86 2.71 1.3 4.16 1.74 6.3C1.96 7.44 2.35 8.57 3.14 9.95C3.94 11.34 4.97 12.67 6.14 13.84C7.32 15.02 8.65 16.05 10.04 16.85C11.42 17.64 12.54 18.02 13.68 18.25C15.83 18.69 17.28 17.12 18.33 15.83L13.33 13.33L10.04 16.85" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M11.66 5.69C12.85 6.19 13.8 7.14 14.3 8.33M12.21 1.66C15.15 2.51 17.48 4.83 18.33 7.78" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
    </symbol>

    <symbol id="icon-globe" viewBox="0 0 20 20" fill="none">
      <circle cx="10.000000" cy="10.000000" r="9.083333" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></circle>
      <ellipse cx="10.000000" cy="10.000000" rx="4.083333" ry="9.083333" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></ellipse>
      <path d="M1.66 6.66L18.33 6.66" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M1.66 13.33L18.33 13.33" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
    </symbol>

    <symbol id="icon-clock" viewBox="0 0 20 20" fill="none">
      <circle cx="10.000000" cy="10.000000" r="8.333333" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></circle>
      <path d="M10 5.83L10 9.99L12.08 12.08" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
    </symbol>

    <symbol id="icon-tick" viewBox="0 0 20 20" fill="none">
      <path d="M15.83 5.41L7.08 14.58L4.16 11.66" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
    </symbol>
    <symbol id="icon-vk" viewBox="0 0 20 20" fill="none">
      <rect width="20.000000" height="20.000000" fill="var(--svg-color)" fill-opacity="0"></rect>
      <path d="M2.89 4L0.73 4C0.12 4 0 4.31 0 4.66C0 5.29 0.73 8.39 3.4 12.5C5.18 15.3 7.68 16.82 9.97 16.82C11.34 16.82 11.5 16.49 11.5 15.91L11.5 13.79C11.5 13.11 11.64 12.98 12.07 12.98C12.39 12.98 12.94 13.15 14.21 14.5C15.67 16.1 15.91 16.82 16.74 16.82L18.89 16.82C19.51 16.82 19.82 16.49 19.64 15.82C19.44 15.16 18.75 14.19 17.82 13.05C17.32 12.4 16.57 11.7 16.34 11.35C16.02 10.9 16.11 10.7 16.34 10.3C16.34 10.3 18.96 6.24 19.24 4.86C19.37 4.36 19.24 4 18.58 4L16.43 4C15.88 4 15.63 4.31 15.49 4.66C15.49 4.66 14.4 7.59 12.84 9.5C12.34 10.05 12.11 10.22 11.84 10.22C11.7 10.22 11.51 10.05 11.51 9.55L11.51 4.86C11.51 4.26 11.35 4 10.89 4L7.5 4C7.16 4 6.96 4.27 6.96 4.54C6.96 5.11 7.73 5.24 7.81 6.84L7.81 10.32C7.81 11.08 7.69 11.22 7.41 11.22C6.68 11.22 4.91 8.28 3.85 4.91C3.65 4.26 3.44 4 2.89 4Z" fill="var(--svg-color)" fill-opacity="1.000000" fill-rule="evenodd"></path>
    </symbol>

    <symbol id="icon-vk-second" viewBox="0 0 24 24" fill="none">
      <path d="M19.3754 17.1235L17.6317 17.1235C16.9715 17.1235 16.7674 16.5986 15.5815 15.3966C14.5484 14.3963 14.0914 14.2619 13.8377 14.2619C13.4816 14.2619 13.38 14.3635 13.38 14.8549L13.38 16.4297C13.38 16.8539 13.2448 17.1075 12.1268 17.1075C9.87176 16.9563 7.93358 15.7263 6.80844 13.9338C5.50245 12.3117 4.52295 10.3287 4.04681 8.19046L4.02921 8.09683C4.02921 7.84315 4.13084 7.60548 4.62218 7.60548L6.36591 7.60548C6.80604 7.60548 6.97569 7.80874 7.14614 8.28249C8.0088 10.7728 9.44923 12.9575 10.0422 12.9575C10.2623 12.9575 10.3639 12.8559 10.3639 12.2973L10.3639 9.72132C10.2959 8.53536 9.6693 8.43453 9.6693 8.0112C9.6765 7.78473 9.86216 7.60388 10.0894 7.60388L12.8535 7.60468C13.2264 7.60468 13.3616 7.80794 13.3616 8.24807L13.3616 11.7211C13.3616 12.0932 13.5313 12.2293 13.6329 12.2293C13.853 12.2293 14.0402 12.0932 14.4459 11.6875C15.2894 10.6576 16.0104 9.47964 16.5602 8.20966L16.597 8.11363C16.713 7.82315 16.9915 7.62149 17.3172 7.62149L19.1033 7.62309C19.6283 7.62309 19.7475 7.89277 19.6283 8.26648C18.9289 9.80694 18.143 11.1305 17.2324 12.3565C17.0467 12.6614 17.0203 12.7374 17.274 13.0775C17.4596 13.3312 18.0702 13.8562 18.4767 14.3307C19.0649 14.9125 19.5579 15.5895 19.93 16.3369C20.0996 16.8266 19.8668 17.1235 19.3754 17.1235ZM15.6839 0L8.31609 0C1.59168 0 0 1.59168 0 8.31609L0 15.6839C0 22.4083 1.59168 24 8.31609 24L15.6839 24C22.4083 24 24 22.4083 24 15.6839L24 8.3161C24 1.59168 22.3907 0 15.6839 0Z" fill="var(--svg-color)" fill-rule="nonzero"></path>
    </symbol>

    <symbol id="icon-tg" viewBox="0 0 20 20" fill="none">
      <rect width="20.000000" height="20.000000" fill="var(--svg-color)" fill-opacity="0"></rect>
      <path d="M1.38 8.87C6.74 6.52 10.32 5 12.13 4.26C17.23 2.14 18.29 1.77 18.98 1.74C19.12 1.74 19.47 1.77 19.7 1.94C19.87 2.08 19.93 2.28 19.95 2.42C19.98 2.57 20.01 2.88 19.98 3.14C19.7 6.04 18.52 13.12 17.89 16.36C17.63 17.73 17.12 18.19 16.63 18.25C15.57 18.33 14.74 17.53 13.7 16.87C12.1 15.81 11.18 15.15 9.6 14.12C7.8 12.92 8.97 12.26 10.01 11.2C10.26 10.91 15 6.64 15.08 6.24C15.08 6.18 15.11 6.01 15 5.92C14.88 5.84 14.74 5.86 14.62 5.89C14.45 5.92 11.87 7.64 6.85 11.02C6.11 11.54 5.45 11.77 4.85 11.77C4.19 11.77 2.92 11.4 1.98 11.08C0.83 10.71 -0.09 10.51 0 9.88C0.06 9.56 0.52 9.22 1.38 8.87Z" fill="var(--svg-color)" fill-opacity="1.000000" fill-rule="evenodd"></path>
    </symbol>

    <symbol id="icon-football" viewBox="0 0 20 20" fill="none">
      <path d="M10 18.33C5.39 18.33 1.66 14.6 1.66 10C1.66 5.39 5.39 1.66 10 1.66C14.6 1.66 18.33 5.39 18.33 10C18.33 14.6 14.6 18.33 10 18.33Z" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M12.12 9.21C12.26 9.32 12.32 9.51 12.27 9.69L11.55 11.99C11.5 12.16 11.33 12.29 11.16 12.29L8.83 12.29C8.66 12.29 8.5 12.16 8.44 11.99L7.72 9.69C7.67 9.51 7.73 9.32 7.87 9.21L9.75 7.78C9.9 7.67 10.09 7.67 10.24 7.78L12.12 9.21Z" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M10 7.5L10 4.16M12.5 9.16L15.83 7.91M11.66 12.5L13.33 15M8.33 12.08L6.66 14.16M7.5 9.58L4.16 8.75" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M7.5 2.08L10.01 3.85L12.5 2.08M1.66 10.66L4.33 8.69L2.96 5.59M16.22 15.7L13.01 15.12L11.88 18.33M16.69 5.16L15.66 7.82L18.33 9.79M6.67 17.83L6.7 14.3L3.33 14.33" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
    </symbol>
    <symbol id="icon-volleyball" viewBox="0 0 20 20" fill="none">
      <path d="M10 18.33C5.39 18.33 1.66 14.6 1.66 10C1.66 5.39 5.39 1.66 10 1.66C14.6 1.66 18.33 5.39 18.33 10C18.33 14.6 14.6 18.33 10 18.33Z" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M6.76 2.5C6.39 3.84 6.47 7.15 9.74 9.58C10.21 13.49 7.39 15.95 5.83 16.66M18.33 10.29C16.77 8.87 13.85 8.47 9.74 9.58" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M7.5 6.66C9.23 5.09 13.6 4.27 17.08 5.84" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M14.07 9.16C14.56 11.58 13.09 15.99 10 18.33" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M8.33 14.16C6.14 13.11 3.46 9.13 3.33 5" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
    </symbol>
    <symbol id="icon-swimming" viewBox="0 0 20 20" fill="none">
      <path d="M8.25 4.11L3.03 3.34C2.31 3.23 1.66 3.8 1.66 4.54C1.66 5.13 2.08 5.64 2.65 5.74L6.17 6.38L7.08 8.7L4.02 10.9C4.64 10.74 6.75 10.61 8.25 11.39C10.14 12.36 10.69 13.33 12.5 13.33L8.25 4.11Z" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <circle cx="15.833984" cy="8.332031" r="2.500000" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></circle>
      <path d="M1.66 15.06C2.54 12.12 6.47 13.47 9.58 15.06C12.69 16.66 15.83 17.67 17.5 15.06" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
    </symbol>
    <symbol id="icon-tennis" viewBox="0 0 20 20" fill="none">
      <path d="M10 18.33C5.39 18.33 1.66 14.6 1.66 10C1.66 5.39 5.39 1.66 10 1.66C14.6 1.66 18.33 5.39 18.33 10C18.33 14.6 14.6 18.33 10 18.33Z" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M4.16 4.16C7.49 7.1 7.5 12.88 4.16 15.83" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M15.83 15.83C12.49 12.88 12.5 7.1 15.83 4.16" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
    </symbol>
    <symbol id="icon-basketball" viewBox="0 0 20 20" fill="none">
      <path d="M10 18.33C5.39 18.33 1.66 14.6 1.66 10C1.66 5.39 5.39 1.66 10 1.66C14.6 1.66 18.33 5.39 18.33 10C18.33 14.6 14.6 18.33 10 18.33Z" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M10.79 1.66C11.29 6.76 6.78 11.3 1.66 10.79" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M9.2 18.33C8.7 13.21 13.23 8.7 18.33 9.2" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M3.33 5.83C9.31 5.83 14.16 10.68 14.16 16.66" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
    </symbol>

    <symbol id="icon-run" viewBox="0 0 20 20" fill="none">
      <path d="M12.91 5C12.22 5 11.66 4.43 11.66 3.75C11.66 3.06 12.22 2.5 12.91 2.5C13.6 2.5 14.16 3.06 14.16 3.75C14.16 4.43 13.6 5 12.91 5Z" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M10 6.66L8.94 8.3C8.36 9.19 8.07 9.64 8.05 10.11C8.05 10.32 8.08 10.53 8.16 10.73C8.32 11.17 8.74 11.5 9.58 12.16L10.85 13.41C11.38 13.94 11.76 14.59 11.94 15.32L12.5 17.5M5 9.29C5.83 7.65 7.11 6.7 10 6.66L11.66 6.66C11.66 6.66 11.96 7.33 12.5 7.73C13.46 8.45 14.96 8.74 16.66 6.83M12.5 7.73L9.58 12.16" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M3.33 14.77L3.89 14.9C5.33 15.25 6.83 14.59 7.5 13.33" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
    </symbol>

    <symbol id="icon-box" viewBox="0 0 20 20" fill="none">
      <path d="M13.05 8.36C13.31 7.36 13.73 6.3 13.81 5.27C13.93 3.58 12.7 2.08 10.95 1.78C9.97 1.61 8.77 1.63 7.79 1.79C5.74 2.12 4.22 3.79 4.16 5.77C4.14 6.86 4.27 7.98 4.46 9.09C4.8 11.13 4.97 12.15 5.67 12.74C6.37 13.33 7.43 13.33 9.54 13.33L10.4 13.33C11.26 13.33 12.11 13.35 12.83 12.84C13.16 12.6 13.41 12.27 13.91 11.61C14.42 10.92 15.07 10.23 15.45 9.45C16.28 7.7 15.76 5.04 13.82 5.04" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M5.83 12.91L5.83 18.33L13.33 18.33L13.33 12.5" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M5.83 15.83L9.16 15.83" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
    </symbol>

    <symbol id="icon-gymnastic" viewBox="0 0 20 20" fill="none">
      <path d="M14.58 8.33C16.74 8.89 18.33 10.88 18.33 13.25C18.33 16.05 16.09 18.33 13.33 18.33C12.75 18.33 12.18 18.23 11.66 18.04M8.8 15.41C8.5 14.75 8.33 14.02 8.33 13.25C8.33 12.52 8.48 11.84 8.75 11.21" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M12.78 9.1C11.49 8.74 12.16 5.83 13.33 5.83C14.51 5.83 15.16 8.74 13.87 9.1C13.56 9.18 13.09 9.18 12.78 9.1Z" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M13.33 1.66L13.33 5.83" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M7.91 8.33C10.07 8.89 11.66 10.88 11.66 13.25C11.66 16.05 9.42 18.33 6.66 18.33C3.9 18.33 1.66 16.05 1.66 13.25C1.66 10.88 3.25 8.89 5.41 8.33" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M6.12 9.1C4.82 8.74 5.49 5.83 6.66 5.83C7.84 5.83 8.5 8.74 7.2 9.1C6.89 9.18 6.43 9.18 6.12 9.1Z" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M6.66 1.66L6.66 5.83" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
    </symbol>

    <symbol id="icon-muscle" viewBox="0 0 20 20" fill="none">
      <path d="M6.83 12.24C7.49 11.4 8.23 10.92 8.96 10.69C10.53 10.18 12.08 10.77 12.86 11.3C12.48 10.9 12.3 10.28 12.23 9.69L11.95 7.46L10.41 5.41L9.05 5.61C8.23 5.75 6.5 5.5 6.33 4.47C6.24 3.98 6.56 3.64 7.19 2.95C7.87 2.21 8.38 1.42 9.5 1.73L12.47 2.5L17.13 10.26C18.29 12.5 18.58 13.47 18.11 14.67C17.63 15.86 14.58 16.87 14.58 16.87C12.53 17.55 10.59 17.82 8.48 17C6.74 18.8 3.36 18.77 1.66 16.92M8.96 10.69C7.09 8.91 3.48 8.94 1.66 10.77" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
    </symbol>

    <symbol id="icon-hockey" viewBox="0 0 20 20" fill="none">
      <path d="M12.08 14.16L18.33 2.5M9.83 16.25C8.07 16.66 3.92 17.01 2.53 16.02C1.28 15.14 1.4 10.84 2.78 10.2C4.17 9.55 7.5 10.83 9.58 12.08L14.62 2.5" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M5 10.83L6.66 10.83" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M15.66 14.16C16.21 14.16 16.66 14.61 16.66 15.16L16.66 16.5C16.66 17.05 16.21 17.5 15.66 17.5L11 17.5C10.44 17.5 10 17.05 10 16.5L10 15.16C10 14.61 10.44 14.16 11 14.16L15.66 14.16Z" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
    </symbol>

    <symbol id="icon-ski" viewBox="0 0 20 20" fill="none">
      <path d="M11.5 6C10.67 6 10 5.32 10 4.5C10 3.67 10.67 3 11.5 3C12.32 3 13 3.67 13 4.5C13 5.32 12.32 6 11.5 6Z" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M17 7L14 8.5L11.83 8.28L9 8L7 13L10.5 16.5L10.5 21M11.83 8.28L9.18 15.18" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M15.5 12.4L14 12.4L11.5 10" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
      <path d="M4 21L16.58 21C17.49 21 18.35 20.64 19 20" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M15.5 11.67L15.5 13L12 21" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M16.54 6.38L21.75 15.41" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M19.44 14.83L22.37 13.16" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.000000"></path>
    </symbol>

    <symbol id="icon-chess" viewBox="0 0 20 20" fill="none">
      <path d="M8.35 8.33C8.92 8.9 9.47 9.11 9.93 9.14C10.28 9.16 11.25 8.75 11.25 8.75L12.5 10L14.16 8.33L11.76 5.83C11.76 5 10.94 4.16 9.93 4.16C10.17 3.33 10.2 1.95 9.74 1.66C8.33 1.66 7.47 3.04 7.47 4.49C5.14 5.69 3.91 8.79 6.25 11.98L6.66 12.5L6.66 15.83L5.41 18.33L14.98 18.33L13.75 15.83L13.75 13.75L11.27 11.64C10.36 10.88 9.93 9.81 9.93 9.14" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M6.66 15.83L13.33 15.83" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linecap="round"></path>
    </symbol>

    <symbol id="icon-streching" viewBox="0 0 20 20" fill="none">
      <path d="M12.08 5.83C11.39 5.83 10.83 5.27 10.83 4.58C10.83 3.89 11.39 3.33 12.08 3.33C12.77 3.33 13.33 3.89 13.33 4.58C13.33 5.27 12.77 5.83 12.08 5.83Z" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M8.93 6.84C6.85 8.92 5.83 14.69 5.83 17.5M8.12 2.5C7.04 3.91 7.39 5.8 8.93 6.84L11.14 8.33L14.16 10.41L11.96 12.5M11.14 8.33C10.47 9.19 10.01 10.01 9.66 10.74C9.3 11.51 9.12 11.9 9.15 12.34C9.18 12.78 9.47 13.2 10.04 14.04C10.85 15.25 11.68 16.55 12.5 17.5M9.15 12.34L6.66 11.66" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
    </symbol>

    <symbol id="icon-fencing" viewBox="0 0 20 20" fill="none">
      <path d="M7.52 11.64C8.5 12.63 8.6 14.13 7.74 15L4.16 11.42C5.03 10.55 6.53 10.65 7.52 11.64ZM6.13 13.39L3.49 17.16C2.66 18.2 0.93 16.55 2 15.68L5.73 12.98M7.52 11.64L16.66 2.5" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M12.47 11.64C11.49 12.63 11.39 14.13 12.25 15L15.83 11.42C14.96 10.55 13.46 10.65 12.47 11.64ZM13.86 13.39L16.5 17.16C17.33 18.2 19.06 16.55 17.99 15.68L14.26 12.98M12.47 11.64L3.33 2.5" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
    </symbol>

    <symbol id="icon-rugby" viewBox="0 0 20 20" fill="none">
      <path d="M18.23 3.79C18.23 2.67 17.32 1.76 16.21 1.76C8.23 1.76 1.76 8.23 1.76 16.21C1.76 17.32 2.67 18.23 3.79 18.23C11.76 18.23 18.23 11.76 18.23 3.79ZM3.3 16.41C3.28 16.34 3.26 16.28 3.26 16.21C3.26 15.22 3.37 14.26 3.58 13.33C3.75 12.59 3.98 11.87 4.28 11.17C4.58 10.45 4.95 9.77 5.37 9.12C5.85 8.38 6.42 7.69 7.06 7.06C7.69 6.42 8.38 5.85 9.12 5.37C9.77 4.95 10.45 4.58 11.17 4.28C11.87 3.98 12.59 3.75 13.33 3.58C14.26 3.37 15.22 3.26 16.21 3.26C16.28 3.26 16.34 3.28 16.41 3.3C16.47 3.33 16.52 3.37 16.58 3.42C16.63 3.47 16.66 3.52 16.69 3.59C16.71 3.65 16.73 3.71 16.73 3.79C16.73 4.77 16.62 5.73 16.41 6.66C16.24 7.4 16.01 8.12 15.71 8.82C15.41 9.54 15.04 10.23 14.62 10.87C14.14 11.61 13.58 12.3 12.94 12.94C12.3 13.58 11.61 14.14 10.87 14.62C10.23 15.04 9.54 15.41 8.82 15.71C8.12 16.01 7.4 16.24 6.66 16.41C5.73 16.62 4.77 16.73 3.79 16.73C3.71 16.73 3.65 16.71 3.59 16.69C3.52 16.66 3.47 16.63 3.42 16.58C3.37 16.52 3.33 16.47 3.3 16.41Z" fill="var(--svg-color)" fill-opacity="1.000000" fill-rule="evenodd"></path>
      <path d="M6.28 13.64L14.22 5.66" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M6.35 10.62L9.33 13.36" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M8.43 8.5L11.41 11.24" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M10.53 6.44L13.51 9.18" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
    </symbol>

    <symbol id="icon-house" viewBox="0 0 20 20" fill="none">
      <path d="M7.5 18.33L7.5 13.33L12.5 13.33L12.5 18.33" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000"></path>
      <path d="M16.25 18.33L3.75 18.33L1.66 7.5L10 1.66L18.33 7.5L16.25 18.33Z" stroke="var(--svg-color)" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round"></path>
    </symbol>

    <symbol id="icon-quote" viewBox="0 0 72 26" fill="none">
      <path d="M61.45 26.91L72.11 0L43.07 0L35.89 17.94L55.38 17.94L51.8 26.91L61.45 26.91ZM25.53 26.91L36.19 0L7.18 0L0 17.94L19.46 17.94L15.88 26.91L25.53 26.91Z" fill="var(--svg-color)" fill-opacity="1.000000" fill-rule="nonzero"></path>
    </symbol>

    <symbol id="icon-p" viewBox="0 0 20 20" fill="none">
      <rect width="18.500000" height="18.500000" x="0.750000" y="0.750000" stroke="var(--svg-color)" stroke-width="1.5"></rect>
      <path d="M6.57812 15.7988L8.33594 15.7988L8.33594 11.709L10.7227 11.709C13.4219 11.709 14.7539 10.0762 14.7539 7.92773C14.7539 5.78711 13.4297 4.16211 10.7266 4.16211L6.57812 4.16211L6.57812 15.7988ZM8.33594 10.2207L8.33594 5.66992L10.5391 5.66992C12.2773 5.66992 12.9883 6.61133 12.9883 7.92773C12.9883 9.24805 12.2773 10.2207 10.5625 10.2207L8.33594 10.2207Z" fill="var(--svg-color)" fill-rule="nonzero"></path>
    </symbol>

    <symbol id="icon-cabinet" viewBox="0 0 24 24" fill="none">
      <path d="M6 18L5 21M18 18L19 21" stroke="var(--svg-color)" stroke-linejoin="round" stroke-width="1.5"></path>
      <path d="M2 18L22 18L22 3L2 3L2 18Z" stroke="var(--svg-color)" stroke-linejoin="round" stroke-width="1.5"></path>
      <path d="M0 0L19 0" stroke="var(--svg-color)" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="matrix(1,0,0,-1,2.5,14)"></path>
      <path d="M0 0L11 0" stroke="var(--svg-color)" stroke-width="1.5" transform="matrix(0,1,-1,-0,12,3)"></path>
      <path d="M9 9.5L9 7.5M15 9.5L15 7.5" stroke="var(--svg-color)" stroke-linejoin="round" stroke-width="1.5"></path>
    </symbol>
    <symbol id="icon-frige" viewBox="0 0 24 24" fill="none">
      <rect width="24.000000" height="24.000000" x="0.000000" y="0.000000" fill="var(--svg-color)" fill-opacity="0"></rect>
      <rect width="24.000000" height="24.000000" x="0.000000" y="0.000000"></rect>
      <path d="M6.60156 13.9134L6.60156 7.69744C6.60156 6.35944 7.68156 5.27344 9.01956 5.27344C10.0936 5.27344 11.0416 5.98144 11.3476 7.01344L11.4016 7.19944" stroke="var(--svg-color)" stroke-linecap="round" stroke-width="1.5"></path>
      <path d="M0 0L2.83823 0" stroke="var(--svg-color)" stroke-linecap="round" stroke-width="1.5" transform="matrix(0.845047,-0.534692,0.534692,0.845047,10.4375,8.16016)"></path>
      <path d="M7.19766 2.40039L17.5117 2.40039C17.8477 2.40039 18.1117 2.66439 18.1117 3.00039L18.1117 21.0004C18.1117 21.3304 17.8477 21.6004 17.5117 21.6004L7.19766 21.6004C6.86166 21.6004 6.59766 21.3304 6.59766 21.0004L6.59766 3.00039C6.59766 2.66439 6.86166 2.40039 7.19766 2.40039Z" fill-rule="nonzero" stroke="var(--svg-color)" stroke-width="1.5"></path>
      <path d="M6.60156 14.875L18.1172 14.875" stroke="var(--svg-color)" stroke-width="1.5"></path>
    </symbol>

    <symbol id="icon-info" viewBox="0 0 20 20" fill="none">
      <rect width="20.000000" height="20.000000" x="0.000000" y="0.000000"></rect>
      <path d="M0 10C0 4.47715 4.47715 0 10 0C15.5228 0 20 4.47715 20 10C20 15.5228 15.5228 20 10 20C4.47715 20 0 15.5228 0 10ZM11.1953 3.91016L11.1953 5.37109L9.69531 5.37109L9.69531 3.91016L11.1953 3.91016ZM11.1953 7.25L8.44531 7.25L8.44531 8.75L9.69531 8.75L9.69531 15L11.1953 15L11.1953 7.25Z" fill="var(--svg-color)" fill-rule="evenodd"></path>
    </symbol>
    <symbol id="icon-car-journey" viewBox="0 0 32 32" fill="none">
      <rect width="32.000000" height="32.000000" x="0.000000" y="0.000000"></rect>
      <path d="M23.7791 9.31379L29.2691 6.00602L23.8791 2.66602L22.6669 2.66602L22.6669 13.7771L23.778 13.7771L23.7791 9.31379ZM23.7791 3.91046L27.138 5.99268L23.7791 8.01602L23.7791 3.91046ZM29.3346 23.2216C29.3346 25.366 27.5902 27.1105 25.4457 27.1105L18.2235 27.1105L18.2235 25.9993L25.4457 25.9993C26.978 25.9993 28.2235 24.7527 28.2235 23.2216C28.2235 21.6905 26.978 20.4438 25.4457 20.4438L16.5569 20.4438C14.4124 20.4438 12.668 18.6994 12.668 16.5549C12.668 14.4105 14.4124 12.666 16.5569 12.666L20.4457 12.666L20.4457 13.7771L16.5569 13.7771C15.0257 13.7771 13.7791 15.0238 13.7791 16.5549C13.7791 18.086 15.0257 19.3327 16.5569 19.3327L25.4457 19.3327C27.5902 19.3327 29.3346 21.0771 29.3346 23.2216ZM13.7791 22.666L12.7457 22.666L11.1835 20.3227C10.7702 19.7027 10.0791 19.3327 9.33463 19.3327L4.89019 19.3327C3.66464 19.3327 2.66797 20.3294 2.66797 21.5549L2.66797 27.1105L3.82797 27.1105C3.81352 27.2038 3.77908 27.2927 3.77908 27.3882C3.77908 28.4605 4.6513 29.3327 5.72352 29.3327C6.79575 29.3327 7.66797 28.4605 7.66797 27.3882C7.66797 27.2927 7.63464 27.2038 7.61908 27.1105L9.93908 27.1105C9.92463 27.2038 9.89019 27.2927 9.89019 27.3882C9.89019 28.4605 10.7624 29.3327 11.8346 29.3327C12.9069 29.3327 13.7791 28.4605 13.7791 27.3882C13.7791 27.2927 13.7457 27.2038 13.7302 27.1105L16.0013 27.1105L16.0013 24.8882C16.0013 23.6627 15.0046 22.666 13.7791 22.666ZM3.77908 21.5549C3.77908 20.9427 4.27797 20.4438 4.89019 20.4438L9.33464 20.4438C9.70686 20.4438 10.0524 20.6293 10.2591 20.9382L11.4102 22.666L3.77908 22.666L3.77908 21.5549ZM6.55686 27.3882C6.55686 27.8482 6.18352 28.2216 5.72352 28.2216C5.26352 28.2216 4.89019 27.8482 4.89019 27.3882C4.89019 27.2949 4.91019 27.2027 4.95019 27.1105L6.49686 27.1105C6.53686 27.2027 6.55686 27.2949 6.55686 27.3882ZM12.668 27.3882C12.668 27.8482 12.2946 28.2216 11.8346 28.2216C11.3746 28.2216 11.0013 27.8482 11.0013 27.3882C11.0013 27.2949 11.0213 27.2027 11.0613 27.1105L12.608 27.1105C12.648 27.2027 12.668 27.2949 12.668 27.3882ZM14.8902 25.9993L3.77908 25.9993L3.77908 23.7771L13.7791 23.7771C14.3913 23.7771 14.8902 24.276 14.8902 24.8882L14.8902 25.9993Z" fill="var(--svg-color)" fill-rule="nonzero"></path>
      <path d="M29.2691 6.00602L23.8791 2.66602L22.6669 2.66602L22.6669 13.7771L23.778 13.7771L23.7791 9.31379L29.2691 6.00602ZM27.138 5.99268L23.7791 8.01602L23.7791 3.91046L27.138 5.99268ZM25.4457 27.1105L18.2235 27.1105L18.2235 25.9993L25.4457 25.9993C26.978 25.9993 28.2235 24.7527 28.2235 23.2216C28.2235 21.6905 26.978 20.4438 25.4457 20.4438L16.5569 20.4438C14.4124 20.4438 12.668 18.6994 12.668 16.5549C12.668 14.4105 14.4124 12.666 16.5569 12.666L20.4457 12.666L20.4457 13.7771L16.5569 13.7771C15.0257 13.7771 13.7791 15.0238 13.7791 16.5549C13.7791 18.086 15.0257 19.3327 16.5569 19.3327L25.4457 19.3327C27.5902 19.3327 29.3346 21.0771 29.3346 23.2216C29.3346 25.366 27.5902 27.1105 25.4457 27.1105ZM12.7457 22.666L11.1835 20.3227C10.7702 19.7027 10.0791 19.3327 9.33463 19.3327L4.89019 19.3327C3.66464 19.3327 2.66797 20.3294 2.66797 21.5549L2.66797 27.1105L3.82797 27.1105C3.81352 27.2038 3.77908 27.2927 3.77908 27.3882C3.77908 28.4605 4.6513 29.3327 5.72352 29.3327C6.79575 29.3327 7.66797 28.4605 7.66797 27.3882C7.66797 27.2927 7.63464 27.2038 7.61908 27.1105L9.93908 27.1105C9.92463 27.2038 9.89019 27.2927 9.89019 27.3882C9.89019 28.4605 10.7624 29.3327 11.8346 29.3327C12.9069 29.3327 13.7791 28.4605 13.7791 27.3882C13.7791 27.2927 13.7457 27.2038 13.7302 27.1105L16.0013 27.1105L16.0013 24.8882C16.0013 23.6627 15.0046 22.666 13.7791 22.666L12.7457 22.666ZM4.89019 20.4438L9.33464 20.4438C9.70686 20.4438 10.0524 20.6293 10.2591 20.9382L11.4102 22.666L3.77908 22.666L3.77908 21.5549C3.77908 20.9427 4.27797 20.4438 4.89019 20.4438ZM5.72352 28.2216C5.26352 28.2216 4.89019 27.8482 4.89019 27.3882C4.89019 27.2949 4.91019 27.2027 4.95019 27.1105L6.49686 27.1105C6.53686 27.2027 6.55686 27.2949 6.55686 27.3882C6.55686 27.8482 6.18352 28.2216 5.72352 28.2216ZM11.8346 28.2216C11.3746 28.2216 11.0013 27.8482 11.0013 27.3882C11.0013 27.2949 11.0213 27.2027 11.0613 27.1105L12.608 27.1105C12.648 27.2027 12.668 27.2949 12.668 27.3882C12.668 27.8482 12.2946 28.2216 11.8346 28.2216ZM3.77908 25.9993L3.77908 23.7771L13.7791 23.7771C14.3913 23.7771 14.8902 24.276 14.8902 24.8882L14.8902 25.9993L3.77908 25.9993Z" fill-rule="nonzero" stroke="var(--svg-color)" stroke-width="0.5"></path>
    </symbol>
    <symbol id="icon-calendar" viewBox="0 0 32 32" fill="none">
      <path d="M15.9914 18L16.0034 18M15.9914 23.3333L16.0034 23.3333M21.3188 18L21.3307 18M10.6641 18L10.676 18M10.6641 23.3333L10.676 23.3333" fill-rule="evenodd" stroke="var(--svg-color)" stroke-linecap="square" stroke-linejoin="round" stroke-width="2"></path>
      <path d="M23.3346 2.66602L23.3346 7.99935M8.66797 2.66602L8.66797 7.99935" stroke="var(--svg-color)" stroke-linejoin="round" stroke-width="1.5"></path>
      <path d="M28 5.33398L28 29.334L4 29.334L4 5.33398L28 5.33398Z" stroke="var(--svg-color)" stroke-linejoin="round" stroke-width="1.5"></path>
      <path d="M4 12L28 12" stroke="var(--svg-color)" stroke-width="1.5"></path>
    </symbol>
    <symbol id="icon-house-tree" viewBox="0 0 30 30" fill="none">
      <rect width="30.000000" height="30.000000" x="0.000000" y="0.000000"></rect>
      <path d="M21.8557 19.1504L26.1831 27.313L26.4945 27.9004L22.8986 27.9004L22.8995 29.6004L29.32 29.6004L24.6825 20.8504L27.4933 20.8504L22.9021 13.3504L26.0799 13.3504L19.7981 1.54878C19.6759 1.37612 19.5377 1.22149 19.3835 1.08488C19.2194 0.93943 19.0371 0.814415 18.8368 0.70983C18.6375 0.605805 18.4318 0.527993 18.2197 0.476423C18.0113 0.425735 17.7967 0.400391 17.5759 0.400391C17.3581 0.400391 17.1462 0.425092 16.9402 0.474496L16.9396 0.474628C16.7316 0.524568 16.5296 0.5997 16.3337 0.700024C16.1362 0.80118 15.9557 0.922365 15.7926 1.06338C15.6424 1.19329 15.5068 1.3401 15.3858 1.50383L13.831 4.75189L12.4423 7.65658C12.8469 7.84396 13.2127 8.06605 13.5399 8.32284L13.8811 8.58975L16.8107 2.44359C16.8724 2.37345 16.941 2.31379 17.0164 2.2646C17.0812 2.22232 17.1511 2.18777 17.226 2.16096C17.2779 2.14242 17.3307 2.1281 17.3841 2.11807C17.4469 2.10628 17.5109 2.10039 17.5759 2.10039C17.6499 2.10039 17.7223 2.10793 17.7931 2.123C17.8422 2.13345 17.8905 2.14752 17.938 2.16521C18.0102 2.19208 18.0776 2.2262 18.1402 2.26757L18.1404 2.26775C18.2231 2.32241 18.323 2.42085 18.389 2.50079L23.2515 11.6504L19.8673 11.6504L24.4586 19.1504L21.8557 19.1504ZM19.5984 29.6004L19.5984 18.8866C19.5984 18.5908 19.562 18.3046 19.4892 18.028C19.4342 17.8193 19.3586 17.6161 19.2622 17.4183C19.1659 17.2207 19.0525 17.036 18.9221 16.8643L18.9217 16.8637C18.7488 16.6361 18.5459 16.4313 18.3132 16.2492L11.5029 10.9189C11.378 10.821 11.2461 10.7365 11.1074 10.6655C11.0034 10.6123 10.8956 10.5666 10.7838 10.5285C10.6603 10.4864 10.5349 10.4545 10.4079 10.4328C10.2736 10.41 10.1373 10.3985 9.99906 10.3985C9.86083 10.3985 9.72448 10.41 9.59014 10.4329L9.58989 10.4329C9.46294 10.4546 9.33774 10.4864 9.21428 10.5285C9.10252 10.5666 8.99463 10.6123 8.89062 10.6655C8.75193 10.7365 8.62014 10.821 8.49523 10.9189L1.68366 16.2479C1.4524 16.4292 1.25063 16.633 1.07842 16.8592C0.946549 17.0325 0.831996 17.2189 0.734759 17.4185C0.636624 17.62 0.559938 17.8271 0.504755 18.0397C0.433877 18.3128 0.398438 18.5951 0.398438 18.8866L0.398438 29.6004L19.5984 29.6004ZM2.09844 18.8866L2.09844 27.9004L17.8984 27.9004L17.8984 18.8866C17.8984 18.7486 17.8822 18.6145 17.8497 18.4845C17.8222 18.3747 17.7831 18.2677 17.7324 18.1637C17.679 18.0542 17.6153 17.953 17.5411 17.86C17.4612 17.7597 17.3691 17.669 17.265 17.5879L10.452 12.2544C10.3854 12.2032 10.3144 12.1648 10.2391 12.1392L10.239 12.1391C10.1632 12.1133 10.083 12.1004 9.99844 12.1004C9.91981 12.1004 9.84475 12.1117 9.77328 12.1344C9.69145 12.1603 9.61433 12.201 9.5419 12.2566L2.73188 17.5867C2.62103 17.6734 2.52391 17.7708 2.44053 17.8788C2.37278 17.9666 2.31411 18.0613 2.2645 18.1631C2.21468 18.2653 2.17605 18.3704 2.14865 18.4783C2.11518 18.6102 2.09844 18.7463 2.09844 18.8866ZM12.0984 19.1504L12.0984 23.3504L7.89844 23.3504L7.89844 19.1504L12.0984 19.1504Z" fill="var(--svg-color)" fill-rule="evenodd"></path>
    </symbol>
    <symbol id="icon-leader" viewBox="0 0 32 32" fill="none">
      <rect width="32.000000" height="32.000000" x="0.000000" y="0.000000"></rect>
      <path d="M17.6232 8.41681C19.1159 8.41681 20.3314 7.20236 20.3314 5.7084C20.3314 4.21445 19.1159 3 17.6232 3C16.1304 3 14.915 4.21445 14.915 5.7084C14.915 7.20236 16.1304 8.41681 17.6232 8.41681ZM17.6232 4.08336C18.5191 4.08336 19.2481 4.81246 19.2481 5.7084C19.2481 6.60434 18.5191 7.33344 17.6232 7.33344C16.7273 7.33344 15.9983 6.60434 15.9983 5.7084C15.9983 4.81246 16.7273 4.08336 17.6232 4.08336ZM6.79039 13.8336C8.28315 13.8336 9.49859 12.6192 9.49859 11.1252C9.49859 9.63125 8.28315 8.41681 6.79039 8.41681C5.29763 8.41681 4.0822 9.63125 4.0822 11.1252C4.0822 12.6192 5.29763 13.8336 6.79039 13.8336ZM6.79039 9.50017C7.68627 9.50017 8.41531 10.2293 8.41531 11.1252C8.41531 12.0211 7.68627 12.7502 6.79039 12.7502C5.89452 12.7502 5.16547 12.0211 5.16547 11.1252C5.16547 10.2293 5.89452 9.50017 6.79039 9.50017ZM22.4979 21.2091L22.4979 17.0837L20.3314 17.0837L20.3314 10.5835L24.6645 10.5835L24.6645 8.47747L28.9478 5.77665L24.6656 3L23.5812 3L23.5812 9.50016L17.6232 9.50016C16.8302 9.50016 16.1218 9.849 15.6256 10.395L12.0291 13.8748L5.79703 15.1055C4.756 15.5171 4.08328 16.5063 4.08328 17.6254L4.08328 25.9965L3 29.0007L4.13528 29.0007L5.16656 26.2392L5.16656 23.5839L10.583 23.5839L10.583 29.0007L13.172 29.0007L28.9987 18.0175L28.9987 16.698L22.4979 21.2091ZM24.6645 4.29137L26.9372 5.76474L24.6645 7.19694L24.6645 4.29137ZM21.4168 21.9599L15.9983 25.7202L15.9983 18.1681L21.4147 18.1681L21.4168 21.9599ZM17.6232 10.5846L19.2481 10.5846L19.2481 17.0848L15.9983 17.0848L15.9983 12.2096C15.9983 11.3137 16.7273 10.5846 17.6232 10.5846ZM5.16547 17.6254C5.16547 16.9537 5.56954 16.36 6.09926 16.1401L8.41531 15.6862L8.41531 22.5005L5.16547 22.5005L5.16547 17.6254ZM11.6651 28.7255L11.6651 22.5005L9.49859 22.5005L9.49859 15.4738L12.5524 14.8758L14.915 12.5845L14.915 26.471L11.6651 28.7255Z" fill="var(--svg-color)" fill-rule="nonzero"></path>
      <path d="M20.3314 5.7084C20.3314 4.21445 19.1159 3 17.6232 3C16.1304 3 14.915 4.21445 14.915 5.7084C14.915 7.20236 16.1304 8.41681 17.6232 8.41681C19.1159 8.41681 20.3314 7.20236 20.3314 5.7084ZM19.2481 5.7084C19.2481 6.60434 18.5191 7.33344 17.6232 7.33344C16.7273 7.33344 15.9983 6.60434 15.9983 5.7084C15.9983 4.81246 16.7273 4.08336 17.6232 4.08336C18.5191 4.08336 19.2481 4.81246 19.2481 5.7084ZM9.49859 11.1252C9.49859 9.63125 8.28315 8.41681 6.79039 8.41681C5.29763 8.41681 4.0822 9.63125 4.0822 11.1252C4.0822 12.6192 5.29763 13.8336 6.79039 13.8336C8.28315 13.8336 9.49859 12.6192 9.49859 11.1252ZM8.41531 11.1252C8.41531 12.0211 7.68627 12.7502 6.79039 12.7502C5.89452 12.7502 5.16547 12.0211 5.16547 11.1252C5.16547 10.2293 5.89452 9.50017 6.79039 9.50017C7.68627 9.50017 8.41531 10.2293 8.41531 11.1252ZM22.4979 17.0837L20.3314 17.0837L20.3314 10.5835L24.6645 10.5835L24.6645 8.47747L28.9478 5.77665L24.6656 3L23.5812 3L23.5812 9.50016L17.6232 9.50016C16.8302 9.50016 16.1218 9.849 15.6256 10.395L12.0291 13.8748L5.79703 15.1055C4.756 15.5171 4.08328 16.5063 4.08328 17.6254L4.08328 25.9965L3 29.0007L4.13528 29.0007L5.16656 26.2392L5.16656 23.5839L10.583 23.5839L10.583 29.0007L13.172 29.0007L28.9987 18.0175L28.9987 16.698L22.4979 21.2091L22.4979 17.0837ZM26.9372 5.76474L24.6645 7.19694L24.6645 4.29137L26.9372 5.76474ZM15.9983 25.7202L15.9983 18.1681L21.4147 18.1681L21.4168 21.9599L15.9983 25.7202ZM19.2481 10.5846L19.2481 17.0848L15.9983 17.0848L15.9983 12.2096C15.9983 11.3137 16.7273 10.5846 17.6232 10.5846L19.2481 10.5846ZM6.09926 16.1401L8.41531 15.6862L8.41531 22.5005L5.16547 22.5005L5.16547 17.6254C5.16547 16.9537 5.56954 16.36 6.09926 16.1401ZM11.6651 22.5005L9.49859 22.5005L9.49859 15.4738L12.5524 14.8758L14.915 12.5845L14.915 26.471L11.6651 28.7255L11.6651 22.5005Z" fill-rule="nonzero" stroke="var(--svg-color)" stroke-width="0.5"></path>
    </symbol>
    <symbol id="icon-no-child" viewBox="0 0 32 32" fill="none">
      <rect width="32.000000" height="32.000000" x="0.000000" y="0.000000"></rect>
      <path d="M16.0013 2.66602C8.64908 2.66602 2.66797 8.64713 2.66797 15.9993C2.66797 23.3516 8.64908 29.3327 16.0013 29.3327C23.3535 29.3327 29.3346 23.3516 29.3346 15.9993C29.3346 8.64713 23.3535 2.66602 16.0013 2.66602ZM3.77908 15.9993C3.77908 12.8293 5.00241 9.94713 6.98908 7.77268L24.228 25.0116C22.0535 26.9982 19.1713 28.2216 16.0013 28.2216C9.26241 28.2216 3.77908 22.7382 3.77908 15.9993ZM16.0013 12.666C16.6313 12.666 17.2346 12.396 17.6569 11.926L16.8302 11.1838C16.6157 11.4227 16.3213 11.5549 16.0013 11.5549C15.388 11.5549 14.8902 11.056 14.8902 10.4438C14.8902 9.83157 15.388 9.33268 16.0013 9.33268C19.308 9.33268 22.0746 11.7049 22.5802 14.9727L22.6524 15.4438L23.7791 15.4438C24.3924 15.4438 24.8902 15.9427 24.8902 16.5549C24.8902 17.1671 24.3924 17.666 23.7791 17.666L22.468 17.666C22.1924 18.6238 21.7357 19.5338 21.0824 20.2949L18.8146 18.0271C19.1202 17.8293 19.3346 17.5016 19.3346 17.1105C19.3346 16.4971 18.8369 15.9994 18.2235 15.9994C17.8324 15.9994 17.5046 16.2138 17.3069 16.5194L11.718 10.9305C12.3735 10.3738 13.1157 9.95824 13.9191 9.69268C13.8335 9.92824 13.7791 10.1782 13.7791 10.4438C13.7791 11.6694 14.7757 12.666 16.0013 12.666ZM25.0135 24.226L21.8702 21.0827C22.4613 20.3993 22.9413 19.6182 23.2646 18.7771L23.7791 18.7771C25.0046 18.7771 26.0013 17.7805 26.0013 16.5549C26.0013 15.3293 25.0046 14.3327 23.7791 14.3327L23.5913 14.3327C22.8191 10.7638 19.6991 8.22157 16.0013 8.22157C14.1169 8.22157 12.3291 8.90157 10.918 10.1305L7.77463 6.98713C9.94908 5.00046 12.8313 3.77713 16.0013 3.77713C22.7402 3.77713 28.2235 9.26046 28.2235 15.9993C28.2235 19.1693 27.0002 22.0516 25.0135 24.226ZM12.668 17.1105C12.668 16.4971 13.1657 15.9993 13.7791 15.9993C14.3924 15.9993 14.8902 16.4971 14.8902 17.1105C14.8902 17.7238 14.3924 18.2216 13.7791 18.2216C13.1657 18.2216 12.668 17.7238 12.668 17.1105ZM19.1735 23.0993C18.1891 23.5405 17.1157 23.7771 16.0013 23.7771C12.7546 23.7771 9.88464 21.7838 8.73797 18.7771L8.22352 18.7771C6.99797 18.7771 6.0013 17.7805 6.0013 16.5549C5.99575 15.2527 7.12464 14.2416 8.41241 14.3327C8.52575 13.8193 8.70797 13.3271 8.92241 12.8482L9.7713 13.6971C9.55464 14.2482 9.42797 14.856 9.35019 15.4449L8.22352 15.4449C7.61019 15.4449 7.11241 15.9438 7.11241 16.556C7.11241 17.1682 7.61019 17.6671 8.22352 17.6671L9.53464 17.6671C10.3235 20.6005 12.9513 22.6793 16.0013 22.6671C16.808 22.6671 17.588 22.5182 18.3191 22.2471L19.1735 23.0993Z" fill="var(--svg-color)" fill-rule="nonzero"></path>
      <path d="M2.66797 15.9993C2.66797 23.3516 8.64908 29.3327 16.0013 29.3327C23.3535 29.3327 29.3346 23.3516 29.3346 15.9993C29.3346 8.64713 23.3535 2.66602 16.0013 2.66602C8.64908 2.66602 2.66797 8.64713 2.66797 15.9993ZM6.98908 7.77268L24.228 25.0116C22.0535 26.9982 19.1713 28.2216 16.0013 28.2216C9.26241 28.2216 3.77908 22.7382 3.77908 15.9993C3.77908 12.8293 5.00241 9.94713 6.98908 7.77268ZM17.6569 11.926L16.8302 11.1838C16.6157 11.4227 16.3213 11.5549 16.0013 11.5549C15.388 11.5549 14.8902 11.056 14.8902 10.4438C14.8902 9.83157 15.388 9.33268 16.0013 9.33268C19.308 9.33268 22.0746 11.7049 22.5802 14.9727L22.6524 15.4438L23.7791 15.4438C24.3924 15.4438 24.8902 15.9427 24.8902 16.5549C24.8902 17.1671 24.3924 17.666 23.7791 17.666L22.468 17.666C22.1924 18.6238 21.7357 19.5338 21.0824 20.2949L18.8146 18.0271C19.1202 17.8293 19.3346 17.5016 19.3346 17.1105C19.3346 16.4971 18.8369 15.9994 18.2235 15.9994C17.8324 15.9994 17.5046 16.2138 17.3069 16.5194L11.718 10.9305C12.3735 10.3738 13.1157 9.95824 13.9191 9.69268C13.8335 9.92824 13.7791 10.1782 13.7791 10.4438C13.7791 11.6694 14.7757 12.666 16.0013 12.666C16.6313 12.666 17.2346 12.396 17.6569 11.926ZM21.8702 21.0827C22.4613 20.3993 22.9413 19.6182 23.2646 18.7771L23.7791 18.7771C25.0046 18.7771 26.0013 17.7805 26.0013 16.5549C26.0013 15.3293 25.0046 14.3327 23.7791 14.3327L23.5913 14.3327C22.8191 10.7638 19.6991 8.22157 16.0013 8.22157C14.1169 8.22157 12.3291 8.90157 10.918 10.1305L7.77463 6.98713C9.94908 5.00046 12.8313 3.77713 16.0013 3.77713C22.7402 3.77713 28.2235 9.26046 28.2235 15.9993C28.2235 19.1693 27.0002 22.0516 25.0135 24.226L21.8702 21.0827ZM13.7791 15.9993C14.3924 15.9993 14.8902 16.4971 14.8902 17.1105C14.8902 17.7238 14.3924 18.2216 13.7791 18.2216C13.1657 18.2216 12.668 17.7238 12.668 17.1105C12.668 16.4971 13.1657 15.9993 13.7791 15.9993ZM16.0013 23.7771C12.7546 23.7771 9.88464 21.7838 8.73797 18.7771L8.22352 18.7771C6.99797 18.7771 6.0013 17.7805 6.0013 16.5549C5.99575 15.2527 7.12464 14.2416 8.41241 14.3327C8.52575 13.8193 8.70797 13.3271 8.92241 12.8482L9.7713 13.6971C9.55464 14.2482 9.42797 14.856 9.35019 15.4449L8.22352 15.4449C7.61019 15.4449 7.11241 15.9438 7.11241 16.556C7.11241 17.1682 7.61019 17.6671 8.22352 17.6671L9.53464 17.6671C10.3235 20.6005 12.9513 22.6793 16.0013 22.6671C16.808 22.6671 17.588 22.5182 18.3191 22.2471L19.1735 23.0993C18.1891 23.5405 17.1157 23.7771 16.0013 23.7771Z" fill-rule="nonzero" stroke="var(--svg-color)" stroke-width="0.5"></path>
    </symbol>

    <symbol id="icon-star" viewBox="0 0 20 20" fill="none">
      <path d="M10.0013 1.66406L12.918 6.66406L18.3346 8.03016L14.5846 12.0807L15.9849 18.3307L10.0013 15.8307L4.01769 18.3307L5.41797 12.0807L1.66797 8.03016L7.08463 6.66406L10.0013 1.66406Z" fill="var(--svg-color)" fill-rule="evenodd"></path>
      <path d="M12.918 6.66406L18.3346 8.03016L14.5846 12.0807L15.9849 18.3307L10.0013 15.8307L4.01769 18.3307L5.41797 12.0807L1.66797 8.03016L7.08463 6.66406L10.0013 1.66406L12.918 6.66406Z" fill-rule="evenodd" stroke="var(--svg-color)" stroke-width="1.5"></path>
    </symbol>

    <symbol id="icon-star-off" viewBox="0 0 20 20" fill="none">
      <path d="M0 0L22.6274 0" stroke="var(--svg-color)" stroke-linecap="square" stroke-width="1.25" transform="matrix(0.707107,0.707107,-0.707107,0.707107,2,2)"></path>
      <path d="M7.90414 5.2564L9.99739 1.66797L12.9141 6.66797L18.3307 8.03407L14.6536 12.0059M15.3026 15.3065L15.981 18.3346L9.99739 15.8346L4.01378 18.3346L5.41406 12.0846L1.66406 8.03407L6.74798 6.75189" stroke="var(--svg-color)" stroke-width="1.25"></path>
    </symbol>

    <symbol id="icon-big-check" viewBox="0 0 80 80" fill="none">
      <path d="M38.2335 4.89825C39.2098 3.92194 40.7928 3.92194 41.7691 4.89825L51.0368 14.166L63.3346 14.166C64.7153 14.166 65.8346 15.2853 65.8346 16.666L65.8346 28.9638L75.1024 38.2316C76.0787 39.2079 76.0787 40.7908 75.1024 41.7671L65.8346 51.0349L65.8346 63.3327C65.8346 64.7134 64.7153 65.8327 63.3346 65.8327L51.0368 65.8327L41.7691 75.1004C40.7928 76.0768 39.2098 76.0768 38.2335 75.1004L28.9658 65.8327L16.668 65.8327C15.2873 65.8327 14.168 64.7134 14.168 63.3327L14.168 51.0349L4.9002 41.7671C3.92389 40.7908 3.92389 39.2079 4.9002 38.2316L14.168 28.9638L14.168 16.666C14.168 15.2853 15.2873 14.166 16.668 14.166L28.9658 14.166L38.2335 4.89825ZM48.0869 30.0579L35.7225 44.7774L29.9749 39.7794L26.694 43.5524L36.2797 51.8878L51.9154 33.2739L48.0869 30.0579Z" fill="var(--svg-color)" fill-rule="evenodd"></path>
    </symbol>
    <symbol id="icon-triatlon" viewBox="0 0 20 20" fill="none">
      <ellipse cx="4.99935" cy="13.3333" rx="3.33333" ry="3.33333" stroke="var(--svg-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
      <ellipse cx="14.9993" cy="13.3333" rx="3.33333" ry="3.33333" stroke="var(--svg-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
      <path d="M5 13.3332H8.64213C8.94185 13.3332 9.21848 13.1722 9.36659 12.9117L12.9167 6.6665" stroke="var(--svg-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
      <path d="M9.99935 10.8335L5.83268 5.8335M5.83268 5.8335H4.16602M5.83268 5.8335H7.49935" stroke="var(--svg-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
      <path d="M12.5426 4.08869L11.8172 4.27928L11.8182 4.28294L12.5426 4.08869ZM14.2972 13.5277C14.4044 13.9278 14.8157 14.1652 15.2158 14.0579C15.6159 13.9506 15.8533 13.5393 15.746 13.1392L15.0216 13.3335L14.2972 13.5277ZM15.9448 5.38931C16.0572 5.78798 16.4715 6.02006 16.8702 5.90767C17.2688 5.79529 17.5009 5.38099 17.3885 4.98231L16.6667 5.18581L15.9448 5.38931ZM12.5426 4.08869L11.8182 4.28294L14.2972 13.5277L15.0216 13.3335L15.746 13.1392L13.267 3.89444L12.5426 4.08869ZM13.1622 3.3335V2.5835C12.8647 2.5835 12.3835 2.62634 12.0477 2.99362C11.6768 3.39928 11.7223 3.91832 11.8172 4.27927L12.5426 4.08869L13.2679 3.8981C13.2448 3.81 13.2518 3.78891 13.2493 3.81259C13.2477 3.82722 13.2427 3.85641 13.2269 3.8937C13.2107 3.93211 13.1865 3.97099 13.1547 4.00583C13.1233 4.04012 13.0918 4.06264 13.0676 4.07633C13.0444 4.08948 13.0297 4.09361 13.0296 4.09363C13.0293 4.09371 13.0319 4.09298 13.0377 4.09188C13.0435 4.09078 13.052 4.08942 13.0635 4.08813C13.087 4.0855 13.1194 4.0835 13.1622 4.0835V3.3335ZM16.6667 5.18581L17.3885 4.98231C17.0843 3.90324 16.3921 3.27252 15.5653 2.94029C14.787 2.62751 13.903 2.5835 13.1622 2.5835V3.3335V4.0835C13.8801 4.0835 14.5139 4.13437 15.006 4.33211C15.4497 4.5104 15.7803 4.80584 15.9448 5.38931L16.6667 5.18581Z" fill="var(--svg-color)" />
    </symbol>
    <symbol id="icon-shower" viewBox="0 0 24 24" fill="none">
      <rect id="icon" width="24.000000" height="24.000000" x="0.000000" y="0.000000" fill="rgb(255,255,255)" fill-opacity="0" />
      <g id="Group 17">
        <path id="Vector 7540" d="M5.00144 18.2273L5 6.424C5 5.086 6.08 4 7.418 4C8.492 4 9.44 4.708 9.746 5.74L9.8 5.926" stroke="rgb(30,30,30)" stroke-linecap="round" stroke-width="1.5" />
        <path id="Vector 7541" d="M0 0L2.83823 0" stroke="rgb(30,30,30)" stroke-linecap="round" stroke-width="1.5" transform="matrix(0.845047,-0.534692,0.534692,0.845047,8.83594,6.88672)" />
        <path id="Vector 7550" d="M9.39844 10.2268L9.39918 18.2263M11.8992 9.72635L14.8974 17.2261M13.8977 8.22656L19.3962 14.2257" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-dasharray="1 2 " stroke-width="1.5" />
      </g>
    </symbol>
    <symbol viewBox="0 0 20 20" id="icon-aviasport" fill="none">
      <rect id="aviasport" width="20.000000" height="20.000000" x="0.000000" y="0.000000" />
      <g id="Group 156">
        <g id="Group 157">
          <path id="Vector 8739" d="M10 10C9.4486 10 9 10.4486 9 11C9 11.5514 9.4486 12 10 12C10.5514 12 11 11.5514 11 11C11 10.4486 10.5514 10 10 10Z" fill="rgb(0,0,0)" fill-rule="nonzero" />
        </g>
      </g>
      <g id="Group 158">
        <g id="Group 159">
          <path id="Vector 8740" d="M16 9.05261C16 7.68716 15.3654 6.40865 14.2131 5.45254C13.0842 4.51583 11.588 4 10 4C8.41202 4 6.91579 4.51585 5.78688 5.45254C4.63459 6.40865 4 7.68718 4 9.05261C4 9.71929 4.33581 10.3062 4.84176 10.644L4.8411 10.6451L8.48411 13.0522C8.61388 13.1388 8.75296 13.207 8.89795 13.2559L8.89795 14.2509C8.89795 14.5891 9.17205 14.8632 9.51018 14.8632L9.66678 14.8632C9.71555 14.8632 9.75508 14.9027 9.75508 14.9515L9.75508 15.6327C9.75508 15.8355 9.91955 16 10.1224 16C10.3253 16 10.4898 15.8355 10.4898 15.6327L10.4898 14.8632L11.1362 14.8632C11.1849 14.8632 11.2245 14.9027 11.2245 14.9515L11.2245 15.6327C11.2245 15.8355 11.3889 16 11.5918 16C11.7947 16 11.9592 15.8355 11.9592 15.6327L11.9592 14.4615C11.9592 14.2648 11.7997 14.1053 11.6029 14.1053L11.102 14.1053L11.102 13.256C11.2467 13.2071 11.3854 13.1393 11.5145 13.0531L15.1589 10.6451L15.1582 10.644C15.6642 10.3062 16 9.71929 16 9.05261ZM4.7347 9.05261C4.7347 6.68449 7.0967 4.75787 10 4.75787C11.3994 4.75787 12.673 5.20542 13.6169 5.93431C12.9647 5.66103 12.2307 5.51577 11.4694 5.51577C10.2796 5.51577 9.15684 5.8704 8.30791 6.51435C7.42499 7.18402 6.93878 8.08546 6.93878 9.05261C6.93878 9.67947 6.44441 10.1894 5.83675 10.1894C5.22909 10.1894 4.7347 9.67947 4.7347 9.05261ZM6.47927 10.8275C6.82169 10.6951 7.11564 10.4601 7.32637 10.1591L7.93684 11.7906L6.47927 10.8275ZM10.3673 14.1053L9.63264 14.1053L9.63264 13.3474L10.3673 13.3474L10.3673 14.1053ZM11.0206 12.4721C10.874 12.5487 10.7122 12.5894 10.5462 12.5894L9.45377 12.5894C9.28806 12.5894 9.12648 12.5488 8.97932 12.472L7.67458 8.98501C7.69757 8.28998 8.07496 7.63174 8.74312 7.12493C9.10701 6.8489 9.53275 6.63533 9.99756 6.49109C11.3665 6.91514 12.2885 7.90258 12.3252 8.9854L11.0206 12.4721ZM12.0632 11.7906L12.6737 10.1591C12.8844 10.4601 13.1783 10.6951 13.5208 10.8274L12.0632 11.7906ZM14.1633 10.1895C13.5556 10.1895 13.0612 9.67949 13.0612 9.05264C13.0612 8.29859 12.7643 7.58012 12.2026 6.97493C11.9563 6.70956 11.6666 6.47516 11.3426 6.27538C11.3848 6.27436 11.427 6.27369 11.4694 6.27369C12.5037 6.27369 13.4719 6.576 14.1956 7.12496C14.8854 7.64818 15.2653 8.33277 15.2653 9.05264C15.2653 9.67947 14.7709 10.1895 14.1633 10.1895Z" fill="rgb(0,0,0)" fill-rule="nonzero" />
        </g>
      </g>
      <g id="Group 160" />
      <g id="Group 161" />
      <g id="Group 162" />
      <g id="Group 163" />
      <g id="Group 164" />
      <g id="Group 165" />
      <g id="Group 166" />
      <g id="Group 167" />
      <g id="Group 168" />
      <g id="Group 169" />
      <g id="Group 170" />
      <g id="Group 171" />
      <g id="Group 172" />
      <g id="Group 173" />
      <g id="Group 174" />
    </symbol>
    <symbol viewBox="0 0 20 20" id="icon-avto" fill="none">
      <rect id="авто" width="20.000000" height="20.000000" x="0.000000" y="0.000000" />
      <g id="Group 135">
        <g id="Group 136">
          <path id="Vector 8736" d="M13.9502 10.2422C13.3778 10.2422 12.9121 10.7079 12.9121 11.2803C12.9121 11.8528 13.3778 12.3184 13.9502 12.3184C14.5226 12.3184 14.9883 11.8527 14.9883 11.2803C14.9883 10.7079 14.5226 10.2422 13.9502 10.2422ZM13.9502 11.7324C13.7009 11.7324 13.498 11.5296 13.498 11.2803C13.498 11.031 13.7009 10.8281 13.9502 10.8281C14.1995 10.8281 14.4023 11.0309 14.4023 11.2803C14.4023 11.5296 14.1995 11.7324 13.9502 11.7324Z" fill="rgb(0,0,0)" fill-rule="nonzero" />
        </g>
      </g>
      <g id="Group 137">
        <g id="Group 138">
          <path id="Vector 8737" d="M19.9483 11.736L19.671 11.1022C19.4834 10.6734 19.0598 10.3963 18.5917 10.3963L18.2714 10.3963C17.329 9.61942 16.1992 9.09754 14.9959 8.88629C14.9916 8.88555 14.9873 8.88488 14.9829 8.88434L11.5714 8.44164C11.2228 8.38508 10.9012 8.64305 10.8816 8.99606L8.38582 8.99606L8.38582 7.80707C8.38582 7.52781 8.1875 7.29402 7.9243 7.23902L7.9243 7.01953C7.9243 6.85773 7.79313 6.72656 7.63133 6.72656C7.46953 6.72656 7.33836 6.85773 7.33836 7.01953L7.33836 7.26039C6.85379 7.33031 6.39148 7.50867 5.98121 7.78687L3.6918 9.33926C3.54457 9.3041 3.39121 9.28492 3.23344 9.28453C3.23344 9.1157 3.23344 7.80098 3.23344 7.64094C3.23344 7.41254 3.04762 7.22672 2.81918 7.22672L0.414219 7.22672C0.18582 7.22672 0 7.41258 0 7.64098C0 8.2211 0 8.80153 0 9.38578C0 9.51227 0.0566406 9.63016 0.155508 9.7093L1.33461 10.6523C1.26895 10.8499 1.23285 11.0608 1.23285 11.2802C1.23285 12.3806 2.12813 13.2759 3.22859 13.2759C3.92551 13.2759 4.53977 12.9166 4.8968 12.3738L8.20641 12.3738C8.3682 12.3738 8.49938 12.2426 8.49938 12.0808C8.49938 11.919 8.3682 11.7879 8.20641 11.7879L5.15867 11.7879C5.25473 11.4229 5.24883 11.0151 5.11391 10.6247C5.58902 10.5194 6.0459 10.3296 6.45332 10.0664C6.94398 9.74961 7.51207 9.58211 8.09617 9.58211L10.9379 9.58211C11.2294 9.58211 11.4666 9.34496 11.4666 9.05344C11.4666 9.04625 11.4647 9.02656 11.4699 9.02219C11.4746 9.01836 11.4833 9.02117 11.4905 9.02211L13.6661 9.30442C13.2458 9.36418 12.8385 9.56067 12.5198 9.88731C12.1704 10.2455 11.9791 10.7074 11.9555 11.1787C11.2732 11.2746 10.767 11.7438 9.56363 11.785C9.40191 11.7906 9.27531 11.9262 9.28086 12.0879C9.28641 12.2496 9.42281 12.3761 9.58367 12.3706C10.8604 12.3268 11.4795 11.8462 12.0123 11.763C12.2288 12.6309 13.0147 13.276 13.9487 13.276C15.0435 13.276 15.935 12.3897 15.944 11.297L16.0028 11.297L16.0028 11.9826C16.0028 12.3176 16.2754 12.5902 16.6104 12.5902L19.3896 12.5902C19.8294 12.5901 20.1243 12.1384 19.9483 11.736ZM0.585977 7.8127L2.6475 7.8127L2.6475 8.43395L0.585977 8.43395L0.585977 7.8127ZM1.60566 10.1187L0.585977 9.30324L0.585977 9.01989L2.6475 9.01989L2.6475 9.37094C2.3084 9.4709 1.89895 9.70926 1.60566 10.1187ZM3.22863 12.69C2.45129 12.69 1.81887 12.0575 1.81887 11.2802C1.81887 10.4997 2.45543 9.87043 3.22863 9.87043C4.0123 9.87043 4.6384 10.5104 4.6384 11.2802C4.6384 12.0554 4.00719 12.69 3.22863 12.69ZM7.79984 9.00871C6.31695 9.13004 6.16656 9.85196 4.8273 10.0838C4.69082 9.90141 4.52352 9.74188 4.33004 9.61449L6.31004 8.27188C6.75152 7.9725 7.26652 7.81375 7.7998 7.81266L7.7998 9.00871L7.79984 9.00871ZM13.9488 12.69C13.1997 12.69 12.5784 12.1007 12.5408 11.3504C12.5035 10.593 13.081 9.88535 13.9525 9.87051C14.7322 9.8725 15.3586 10.5089 15.3586 11.2802C15.3586 12.0575 14.7262 12.69 13.9488 12.69ZM16.0783 10.7109L15.8621 10.7109C15.6988 10.1558 15.2935 9.68051 14.7329 9.44281C15.557 9.54969 16.4748 9.87848 17.2806 10.3964L16.6105 10.3964C16.3843 10.3964 16.1823 10.5229 16.0783 10.7109ZM19.4095 11.9934C19.4025 12.0041 19.3939 12.0041 19.3897 12.0041L16.6104 12.0041C16.5991 12.0041 16.5888 11.9938 16.5888 11.9825L16.5888 11.0039C16.5888 10.9927 16.5991 10.9824 16.6104 10.9824C17.0179 10.9824 18.2002 10.9824 18.5917 10.9824C18.827 10.9824 19.0399 11.1216 19.1342 11.3372L19.4115 11.9709C19.4131 11.9747 19.4166 11.9826 19.4095 11.9934Z" fill="rgb(0,0,0)" fill-rule="nonzero" />
        </g>
      </g>
      <g id="Group 139">
        <g id="Group 140">
          <path id="Vector 8738" d="M3.23047 10.2422C2.65805 10.2422 2.19238 10.7079 2.19238 11.2803C2.19238 11.8528 2.65809 12.3184 3.23047 12.3184C3.80289 12.3184 4.26855 11.8527 4.26855 11.2803C4.26855 10.7079 3.80289 10.2422 3.23047 10.2422ZM3.23047 11.7324C2.98117 11.7324 2.77832 11.5296 2.77832 11.2803C2.77832 11.031 2.98113 10.8281 3.23047 10.8281C3.4798 10.8281 3.68262 11.0309 3.68262 11.2803C3.68266 11.5296 3.47977 11.7324 3.23047 11.7324Z" fill="rgb(0,0,0)" fill-rule="nonzero" />
        </g>
      </g>
      <g id="Group 141" />
      <g id="Group 142" />
      <g id="Group 143" />
      <g id="Group 144" />
      <g id="Group 145" />
      <g id="Group 146" />
      <g id="Group 147" />
      <g id="Group 148" />
      <g id="Group 149" />
      <g id="Group 150" />
      <g id="Group 151" />
      <g id="Group 152" />
      <g id="Group 153" />
      <g id="Group 154" />
      <g id="Group 155" />
      <rect id="Rectangle 2423" width="1.484375" height="0.585938" x="8.125000" y="11.796875" fill="rgb(0,0,0)" />
    </symbol>
    <symbol viewBox="0 0 20 20" id="icon-alpinizm" fill="none">
      <rect id="alpinizm" width="20.000000" height="20.000000" x="0.000000" y="0.000000" />
      <path id="Vector 8741" d="M16.2225 9.38263C16.1561 8.31623 16.2069 6.79279 15.8006 6.67169C15.7303 6.63654 15.5076 6.52326 15.2069 6.37091C15.824 6.15607 16.2498 5.47247 16.2225 4.83576C16.1873 3.81622 15.5467 3.58576 14.9256 3.49591C14.2069 3.39044 13.7537 3.81622 13.5701 4.76154C13.5154 5.04669 13.4842 5.29669 13.4998 5.51544C13.1326 5.33185 12.7967 5.15997 12.5037 5.01154C12.4061 4.88654 12.117 4.51154 11.7928 4.12872C11.3748 3.64044 11.1053 3.38654 10.9178 3.25763C11.1873 2.91779 11.4569 2.59747 11.6873 2.32404C11.7694 2.22638 11.7576 2.07794 11.66 1.99201C11.5623 1.90997 11.4139 1.92169 11.3279 2.01935C10.9022 2.51935 8.77717 5.0506 8.68732 5.83576C8.60529 6.56622 7.90217 7.07404 7.60529 7.26154C7.12873 7.55841 6.32795 8.26935 6.2967 8.3006C6.25373 8.33966 6.22248 8.39435 6.21857 8.45685C6.21857 8.46466 6.13264 9.43732 6.01935 9.97248C5.91389 10.4725 6.14435 11.0272 6.25373 11.2537C6.1131 11.6092 5.71076 12.6053 5.66389 13.0194C5.64045 13.3006 5.76935 13.7654 5.94904 14.3904C6.02717 14.66 6.13264 15.0233 6.13264 15.1131C6.10139 15.3904 6.10139 17.0233 6.10139 17.2069C6.1131 17.5154 6.55842 17.5194 6.57014 17.2069C6.57014 16.4842 6.57795 15.3436 6.59748 15.16C6.62482 15.035 6.50373 14.6092 6.37482 14.1756C6.65217 14.4451 7.0467 14.7889 7.39435 14.5779C7.87873 14.242 9.5506 12.8045 9.90998 12.6561C10.3319 12.5506 11.8944 12.4256 12.3553 12.3397C12.324 12.6834 12.3006 13.242 12.3944 13.699C12.4959 14.1561 12.7772 14.2029 12.9412 14.2108C13.285 14.2108 13.7733 13.8826 13.9529 13.3826C14.1209 12.9842 13.6795 12.4764 13.1834 12.1326C13.2342 12.1092 13.2733 12.0819 13.3045 12.0545C13.4881 11.8904 13.8944 11.3397 14.2459 10.8436C14.1248 11.8826 13.9022 12.6717 14.8514 12.6678C15.5701 12.7342 16.2889 9.71466 16.2225 9.38263L16.2225 9.38263ZM14.035 4.84748C14.1756 4.10529 14.4373 3.94513 14.7186 3.94513C15.3123 3.9881 15.7498 4.15607 15.7576 4.85138C15.7694 5.42169 15.2967 6.08185 14.6092 5.96076C14.1756 5.87872 14.0662 5.76154 14.0194 5.66779C13.9451 5.52716 13.9529 5.28107 14.035 4.84747L14.035 4.84748ZM13.5115 13.2225C13.4061 13.5194 13.0858 13.7498 12.9373 13.7381C12.9217 13.7381 12.8826 13.7342 12.8553 13.6053C12.7811 13.2342 12.7967 12.7694 12.8201 12.449C13.2264 12.7303 13.5662 13.0701 13.5115 13.2225ZM12.1639 5.33576C12.2381 5.42169 12.2381 5.39435 12.3826 5.47248L12.0272 6.08576C11.5975 5.72248 11.2615 5.35138 11.0506 4.90607C10.6678 4.19123 10.5154 3.87872 10.6365 3.63263C10.9256 3.81232 11.6209 4.6131 12.1639 5.33576ZM7.85529 7.65998C8.2967 7.38263 9.05061 6.78888 9.15607 5.89044C9.18732 5.62482 9.64045 4.93732 10.199 4.19123C10.285 4.46076 10.449 4.76154 10.6444 5.12873C11.1131 6.16388 12.5076 7.05451 13.1092 7.44513C13.1561 7.58966 12.9803 8.12873 12.7225 8.64826C12.0233 8.48419 10.4529 8.14044 10.0662 8.22248C9.70295 8.28888 8.14826 9.03498 7.76545 9.12091C7.52326 9.12873 6.83967 9.01154 6.63264 9.03107C6.65217 8.84748 6.66779 8.68732 6.67951 8.59357C6.88264 8.41388 7.48811 7.89044 7.85529 7.65998L7.85529 7.65998ZM12.9373 11.7342C12.4803 11.8826 11.91 11.9256 11.3826 11.992L11.0858 10.7694C11.3592 10.6561 11.6248 10.5467 11.8631 10.449C11.9569 10.41 12.0154 10.3123 12.0076 10.2108C11.9998 10.1092 11.9217 10.0233 11.8201 10.0037C11.7498 9.9881 11.449 9.9256 11.1014 9.85529L11.3748 8.83966C11.7967 8.92169 12.2733 9.02326 12.7264 9.12873C13.1365 9.58966 13.2108 10.4647 12.9373 11.7342L12.9373 11.7342ZM9.8592 9.6131C9.77717 9.49591 7.94514 10.3983 7.55842 10.5076C7.47639 10.4569 7.28889 10.2498 6.86701 9.50763C7.15607 9.53107 7.59748 9.60529 7.81232 9.58576C8.06623 9.58576 9.80061 8.75763 10.1639 8.67951C10.2576 8.65998 10.535 8.69123 10.91 8.75373L10.6405 9.76154C10.2772 9.68732 9.94904 9.62482 9.8592 9.6131L9.8592 9.6131ZM6.72639 11.3279C6.75373 11.2615 6.74983 11.1873 6.71467 11.1248C6.71076 11.117 6.38264 10.5272 6.48029 10.0701C6.49592 9.99982 6.50764 9.9256 6.52326 9.84748C7.02717 10.7186 7.30451 11.0115 7.58186 10.9842C7.75373 11.0115 9.48029 10.16 9.82014 10.0819C9.94123 10.1014 10.6209 10.2381 10.9764 10.3084C10.242 10.6131 9.19514 11.0506 9.01545 11.1522C8.78108 11.2733 7.47248 12.5389 7.12483 12.7928C6.71076 12.6912 6.42951 12.6522 6.23811 12.6522C6.37483 12.2108 6.61701 11.5936 6.72639 11.3279L6.72639 11.3279ZM9.74592 12.2147C9.5467 12.2186 7.72248 13.7459 7.15608 14.1717C6.89826 14.1209 6.28498 13.4217 6.15998 13.1209C6.26154 13.1092 6.58186 13.1326 7.08967 13.2694C7.23029 13.3045 7.33186 13.2381 7.66779 12.949C8.03889 12.6365 8.96467 11.7498 9.23811 11.5623C9.35139 11.4998 9.96467 11.2381 10.6444 10.9529L10.91 12.0467C10.2811 12.1131 9.90998 12.1561 9.74592 12.2147L9.74592 12.2147ZM14.4647 9.69513C14.199 10.0897 13.8358 10.617 13.5272 11.035C13.6405 10.0623 13.5076 9.34748 13.1248 8.87873C13.3123 8.46076 13.867 7.40607 13.3787 7.06623C13.0975 6.87873 12.8123 6.70294 12.3944 6.38654L12.8006 5.68732C13.6639 6.12091 15.2576 6.9256 15.5584 7.07795C15.6365 7.21857 15.6795 7.74201 15.699 8.20295C15.4256 8.25763 15.1522 8.30451 15.0233 8.32404C14.9608 7.97638 14.8787 7.66388 14.8631 7.60529C14.7733 7.30841 14.3397 7.4217 14.41 7.72638C14.4842 8.00763 14.6678 8.8006 14.6248 9.12091C14.6053 9.26935 14.5584 9.44904 14.5037 9.65216C14.492 9.65998 14.4803 9.6756 14.4647 9.69513L14.4647 9.69513ZM15.4217 10.9022C15.16 11.7069 14.9295 12.1092 14.8358 12.199C14.7186 12.1912 14.6522 12.1834 14.6326 12.1678C14.5584 12.0779 14.6444 11.41 14.6795 11.1248C14.7498 10.5779 14.8631 10.1522 14.953 9.80841C15.0545 9.40998 15.1365 9.17951 15.0936 8.78498C15.2576 8.76154 15.5155 8.71466 15.7225 8.6756C15.7303 8.94904 15.7381 9.2967 15.7576 9.43732C15.7733 9.57013 15.6639 10.1522 15.4217 10.9022Z" fill="rgb(0,0,0)" fill-rule="nonzero" />
      <path id="Vector 8741" d="M15.7554 6.7609L14.9518 6.35381L15.174 6.27647C15.4571 6.17793 15.6899 5.98812 15.8725 5.70706C15.9583 5.57501 16.0228 5.43468 16.0661 5.28607C16.11 5.1352 16.1289 4.98652 16.1226 4.84005C16.1077 4.40959 15.9771 4.09454 15.7308 3.89489C15.5491 3.74763 15.2759 3.64763 14.9113 3.59488C14.5839 3.54683 14.3186 3.61778 14.1155 3.80772C13.9051 4.00446 13.7561 4.32875 13.6683 4.7806C13.6097 5.08635 13.5868 5.32892 13.5996 5.50832L13.6121 5.68433L12.4387 5.09069L12.4249 5.0731C12.4183 5.06463 12.4066 5.04956 12.3897 5.0279C12.1344 4.70002 11.91 4.42183 11.7165 4.19335C11.3486 3.76359 11.0635 3.47915 10.8611 3.34003L10.7729 3.27938L10.8394 3.19549C11.0245 2.96213 11.2817 2.65017 11.6109 2.25959C11.6342 2.23176 11.6444 2.19914 11.6414 2.16173C11.6383 2.12375 11.6225 2.0922 11.5939 2.06708L11.66 1.99201L11.5957 2.06858C11.5677 2.04513 11.5351 2.03492 11.4977 2.03797C11.4597 2.04105 11.4281 2.05687 11.403 2.08541C10.8759 2.70442 10.3954 3.30283 9.96163 3.88066C9.21446 4.87586 8.82281 5.53135 8.78667 5.84712C8.74864 6.18579 8.58653 6.51011 8.30035 6.82009C8.12211 7.01316 7.90822 7.18849 7.65869 7.34609C7.46146 7.46895 7.19118 7.6728 6.84785 7.95764C6.58657 8.17441 6.42642 8.3123 6.36741 8.37131L6.36573 8.37299L6.36397 8.37459C6.33565 8.40033 6.32046 8.42983 6.31838 8.46309L6.21857 8.45685L6.31857 8.45685C6.31857 8.50169 6.29931 8.69217 6.26079 9.02829C6.21307 9.44472 6.1652 9.76635 6.11719 9.99318C6.07447 10.1957 6.08638 10.4283 6.15292 10.6911C6.19685 10.8646 6.26048 11.0377 6.34378 11.2102L6.36285 11.2497L6.34672 11.2905C6.34132 11.3042 6.33249 11.3264 6.32024 11.3573C5.97739 12.2213 5.79172 12.7791 5.76325 13.0306L5.66389 13.0194L5.76354 13.0277C5.75375 13.1451 5.77519 13.3205 5.82784 13.554C5.8648 13.7178 5.93723 13.9875 6.04515 14.3628L6.04546 14.3639L6.04584 14.3652L6.04622 14.3665L6.04659 14.3678C6.17062 14.7957 6.23264 15.0441 6.23264 15.1131L6.23264 15.1187L6.23201 15.1243C6.21159 15.3055 6.20139 15.9997 6.20139 17.2069L6.20139 17.2069L6.10139 17.2069L6.20131 17.2031C6.20301 17.2478 6.2174 17.2822 6.2445 17.3064C6.26928 17.3285 6.29984 17.3396 6.33619 17.3398C6.37236 17.3399 6.40268 17.3291 6.42714 17.3074C6.45414 17.2833 6.4685 17.2486 6.47021 17.2031L6.57014 17.2069L6.47014 17.2069C6.47014 16.0101 6.47944 15.3243 6.49804 15.1494L6.49862 15.144L6.49979 15.1386C6.5159 15.065 6.44229 14.7535 6.27897 14.2041L6.44452 14.1039C6.62719 14.2814 6.78064 14.403 6.90489 14.4685C7.075 14.5583 7.22086 14.5662 7.34248 14.4924L7.39435 14.5779L7.33736 14.4958C7.45935 14.4112 7.77122 14.1664 8.27298 13.7615C8.7101 13.4087 9.02455 13.1586 9.21633 13.0111C9.54725 12.7566 9.76574 12.6075 9.8718 12.5636L9.8786 12.5608L9.88573 12.5591C10.0487 12.5183 10.5196 12.4553 11.2984 12.3702C11.8592 12.3088 12.2054 12.2659 12.337 12.2414L12.4668 12.2171L12.4549 12.3487C12.4067 12.8789 12.4192 13.3223 12.4923 13.6789C12.5309 13.8524 12.6002 13.9729 12.7003 14.0405C12.7627 14.0826 12.8446 14.106 12.946 14.1109L12.9412 14.2108L12.9412 14.1108C13.0147 14.1108 13.095 14.0934 13.1821 14.0588C13.273 14.0226 13.3615 13.9713 13.4476 13.905C13.6425 13.7547 13.7796 13.5693 13.8588 13.3488L13.8598 13.3463L13.8608 13.3438C13.9248 13.192 13.8828 13.0086 13.7349 12.7939C13.5965 12.593 13.3937 12.4 13.1265 12.2148L12.9826 12.1152L13.1415 12.0418C13.1777 12.0252 13.21 12.0043 13.2387 11.9792C13.3839 11.8495 13.6924 11.4516 14.1643 10.7857L14.3452 10.8551C14.3362 10.933 14.3219 11.0462 14.3025 11.1947C14.2662 11.4712 14.2447 11.6683 14.2379 11.7861C14.2272 11.9714 14.2362 12.1178 14.2651 12.2253C14.2956 12.3386 14.3516 12.422 14.4332 12.4753C14.5286 12.5377 14.6678 12.5685 14.851 12.5678L14.8558 12.5678L14.8606 12.5682C14.9853 12.5797 15.1293 12.4496 15.2924 12.1777C15.4429 11.927 15.5909 11.5821 15.7364 11.1432C15.8597 10.7713 15.9607 10.3985 16.0395 10.0247C16.1111 9.68479 16.1394 9.4773 16.1244 9.40224L16.1231 9.3956L16.1227 9.38885C16.1134 9.23982 16.1029 9.00241 16.0911 8.67661C16.0685 8.05222 16.0398 7.61779 16.0048 7.37333C15.9775 7.18266 15.9426 7.03552 15.9 6.93192C15.8606 6.83601 15.818 6.78122 15.772 6.76753L15.7634 6.76496L15.7554 6.7609ZM15.8458 6.58249L15.8006 6.67169L15.8292 6.57586C15.9361 6.60774 16.0214 6.7011 16.085 6.85591C16.1339 6.97487 16.1732 7.13791 16.2028 7.34502C16.2388 7.59647 16.2681 8.03793 16.291 8.66939C16.3027 8.99344 16.3131 9.22911 16.3223 9.37642L16.2225 9.38263L16.3205 9.36302C16.3409 9.46492 16.3125 9.69924 16.2352 10.066C16.1549 10.4471 16.0519 10.8271 15.9263 11.2061C15.7761 11.6591 15.622 12.0173 15.4639 12.2807C15.2576 12.6244 15.0504 12.7866 14.8422 12.7674L14.8514 12.6678L14.8518 12.7678C14.4203 12.7696 14.1603 12.606 14.072 12.2772C14.0375 12.1489 14.0263 11.9814 14.0382 11.7745C14.0453 11.6519 14.0673 11.45 14.1042 11.1687C14.1235 11.0211 14.1376 10.9089 14.1466 10.832L14.2459 10.8436L14.3275 10.9014C13.8469 11.5796 13.5279 11.989 13.3704 12.1298C13.3273 12.1675 13.2789 12.1987 13.2253 12.2234L13.1834 12.1326L13.2404 12.0504C13.5276 12.2495 13.7474 12.4595 13.8996 12.6804C14.089 12.9553 14.1375 13.2024 14.0451 13.4215L13.9529 13.3826L14.0471 13.4165C13.9546 13.6737 13.7955 13.8893 13.5697 14.0634C13.4689 14.1411 13.3643 14.2015 13.256 14.2446C13.1452 14.2887 13.0403 14.3108 12.9412 14.3108L12.9389 14.3108L12.9365 14.3106C12.5938 14.2943 12.3804 14.0972 12.2964 13.7191C12.2193 13.3432 12.2057 12.8804 12.2557 12.3306L12.3553 12.3397L12.3736 12.438C12.2371 12.4634 11.8859 12.5071 11.3202 12.569C10.5504 12.6532 10.0884 12.7145 9.93423 12.7531L9.90998 12.6561L9.94815 12.7485C9.85844 12.7856 9.65514 12.9259 9.33825 13.1696C9.14772 13.3161 8.8345 13.5653 8.39858 13.9171C7.89305 14.3251 7.57731 14.5728 7.45134 14.6601L7.44883 14.6619L7.44623 14.6634C7.26003 14.7764 7.04847 14.7704 6.81156 14.6454C6.67036 14.5709 6.50155 14.4382 6.30513 14.2473L6.37482 14.1756L6.47068 14.1471C6.55162 14.4194 6.60869 14.6236 6.6419 14.7598C6.69301 14.9695 6.71077 15.11 6.69517 15.1813L6.59748 15.16L6.69692 15.1706C6.67906 15.3384 6.67014 16.0172 6.67014 17.2069L6.67014 17.2087L6.67006 17.2106C6.66623 17.3129 6.62956 17.395 6.56005 17.4568C6.49745 17.5125 6.42254 17.5401 6.33533 17.5398C6.24848 17.5394 6.17382 17.5113 6.11135 17.4556C6.04194 17.3937 6.00531 17.312 6.00146 17.2106L6.00139 17.2087L6.00139 17.2069L6.00139 17.2069C6.00139 15.9922 6.01201 15.2905 6.03326 15.1019L6.13264 15.1131L6.03264 15.1131C6.03264 15.0631 5.97326 14.8332 5.8545 14.4235L5.85412 14.4222L5.85375 14.4209L5.85337 14.4196L5.85293 14.4181C5.74395 14.039 5.67055 13.7656 5.63274 13.598C5.57558 13.3445 5.55274 13.1489 5.56423 13.011L5.56435 13.0096L5.56452 13.0081C5.59499 12.7389 5.78493 12.1641 6.13434 11.2835C6.14668 11.2524 6.15548 11.2302 6.16074 11.2169L6.25373 11.2537L6.16367 11.2972C6.0745 11.1125 6.00629 10.9268 5.95903 10.7402C5.88491 10.4474 5.87241 10.1846 5.92152 9.95177C5.96823 9.7311 6.01509 9.41568 6.06209 9.00552C6.09975 8.67697 6.11857 8.49408 6.11857 8.45685L6.11857 8.45373L6.11877 8.45061C6.12422 8.36339 6.16111 8.28872 6.22943 8.22661L6.2967 8.3006L6.22599 8.22989C6.28938 8.1665 6.4541 8.02444 6.72015 7.80372C7.07045 7.5131 7.34769 7.30419 7.55189 7.17699C7.78657 7.02877 7.98707 6.86458 8.1534 6.68443C8.40993 6.40656 8.55479 6.11988 8.58797 5.82439C8.62822 5.47266 9.03279 4.78472 9.80169 3.76058C10.238 3.17948 10.7217 2.57705 11.2529 1.95329C11.3136 1.8843 11.3898 1.84608 11.4815 1.83862C11.5735 1.83114 11.6544 1.85675 11.7243 1.91544L11.7252 1.91618L11.726 1.91693C11.795 1.97764 11.8333 2.05384 11.8407 2.14552C11.8482 2.23754 11.8225 2.31853 11.7638 2.38848C11.4359 2.77755 11.18 3.08798 10.9961 3.31977L10.9178 3.25763L10.9744 3.17523C11.1912 3.32424 11.4894 3.62053 11.8691 4.0641C12.0644 4.29467 12.2905 4.57498 12.5475 4.90502C12.5643 4.92665 12.576 4.94163 12.5825 4.94997L12.5037 5.01154L12.5489 4.92231L13.545 5.42621L13.4998 5.51544L13.4001 5.52257C13.386 5.32574 13.41 5.0657 13.472 4.74247C13.568 4.24819 13.7369 3.88791 13.9789 3.66164C14.2289 3.42785 14.5492 3.33961 14.9399 3.39694C15.3409 3.45495 15.6465 3.56914 15.8567 3.73951C16.1503 3.97742 16.3055 4.3414 16.3224 4.83146C16.3296 4.99987 16.3082 5.17004 16.2581 5.34199C16.2094 5.50947 16.1367 5.66748 16.0402 5.81602C15.9424 5.96663 15.8268 6.09698 15.6934 6.20706C15.5533 6.32275 15.4021 6.40885 15.2397 6.46535L15.2069 6.37091L15.252 6.28171L15.8458 6.58249ZM14.7258 3.84539C15.0799 3.87102 15.3435 3.94681 15.5167 4.07276C15.74 4.23523 15.8536 4.49439 15.8576 4.85026C15.8608 5.006 15.8327 5.1619 15.7733 5.31795C15.7134 5.4752 15.6287 5.61351 15.5194 5.7329C15.4018 5.86127 15.2673 5.95435 15.116 6.01212C14.9494 6.07574 14.7747 6.09145 14.5919 6.05924C14.3851 6.02013 14.2274 5.96869 14.1187 5.90492C14.0314 5.85371 13.9684 5.78958 13.9299 5.71251C13.8858 5.62893 13.8653 5.5132 13.8686 5.3653C13.8715 5.2323 13.8942 5.0535 13.9367 4.82889C14.0051 4.46803 14.1093 4.20891 14.2493 4.05151C14.3717 3.91392 14.5282 3.84513 14.7186 3.84513L14.7222 3.84513L14.7258 3.84539ZM14.7114 4.04487L14.7186 3.94513L14.7186 4.04513C14.588 4.04513 14.4814 4.09157 14.3988 4.18445C14.2832 4.31429 14.1947 4.54149 14.1332 4.86606C14.0587 5.26026 14.0505 5.5126 14.1088 5.62307C14.1608 5.72707 14.3334 5.8068 14.6265 5.86227C14.7731 5.88809 14.9125 5.87576 15.0447 5.82528C15.1665 5.77875 15.2756 5.70292 15.3719 5.5978C15.464 5.4972 15.5355 5.38019 15.5864 5.24675C15.6366 5.11495 15.6603 4.98354 15.6576 4.8525C15.6544 4.56358 15.5682 4.35757 15.399 4.23449C15.2567 4.13095 15.0275 4.06775 14.7114 4.04487ZM12.9373 13.8381C12.8474 13.8381 12.7875 13.7674 12.7575 13.626C12.6971 13.3241 12.6847 12.9294 12.7204 12.4417L12.7332 12.2672L12.8771 12.3668C13.0978 12.5197 13.2761 12.6694 13.4121 12.8161C13.581 12.9985 13.6455 13.1452 13.6057 13.2563C13.55 13.413 13.4496 13.5518 13.3046 13.6728C13.1625 13.7913 13.0375 13.8463 12.9295 13.8378L12.9373 13.7381L12.9373 13.8381ZM12.9373 13.6381L12.9413 13.6381L12.9452 13.6384C12.9648 13.64 12.9939 13.6317 13.0324 13.6137C13.0793 13.5917 13.1273 13.5603 13.1765 13.5192C13.2935 13.4216 13.3738 13.3115 13.4174 13.1887C13.4207 13.1795 13.4134 13.1578 13.3953 13.1237C13.3696 13.075 13.3263 13.0178 13.2653 12.9521C13.1393 12.816 12.972 12.6758 12.7632 12.5313L12.8201 12.449L12.9199 12.4563C12.8855 12.9259 12.8966 13.3019 12.9531 13.5845C12.9613 13.623 12.9688 13.646 12.9756 13.6537C12.9663 13.6433 12.9536 13.6381 12.9373 13.6381ZM12.4692 5.52262L12.0538 6.23922L11.9626 6.16212C11.7307 5.96606 11.5367 5.77577 11.3805 5.59128C11.2049 5.38376 11.0648 5.16963 10.9602 4.94888L11.0506 4.90607L10.9625 4.95328C10.7483 4.55342 10.6143 4.27806 10.5604 4.1272C10.4823 3.90841 10.4778 3.72883 10.5468 3.58848L10.5956 3.48941L10.6893 3.5477C10.8363 3.63907 11.0665 3.86124 11.3798 4.21419C11.6684 4.53938 11.9565 4.89321 12.2438 5.27569L12.1639 5.33576L12.2396 5.27039C12.2571 5.29074 12.2703 5.30404 12.279 5.31028C12.2843 5.31404 12.297 5.32039 12.3172 5.32933C12.3575 5.34715 12.3951 5.36555 12.4302 5.3845L12.5208 5.43349L12.4692 5.52262ZM12.2961 5.42233L12.3826 5.47248L12.3351 5.56045C12.3046 5.54398 12.2717 5.52789 12.2362 5.51219C12.2036 5.49776 12.1792 5.48472 12.1629 5.47309C12.1411 5.45756 12.1162 5.43357 12.0882 5.40112L12.086 5.39854L12.0839 5.39583C11.7998 5.0177 11.5153 4.66808 11.2302 4.34697C10.9298 4.0085 10.7143 3.7987 10.5837 3.71756L10.6365 3.63263L10.7263 3.67678C10.6821 3.76653 10.6896 3.89425 10.7488 4.05994C10.7993 4.20144 10.9293 4.46775 11.1388 4.85886L11.1399 4.86103L11.141 4.86326C11.2381 5.06826 11.3688 5.26786 11.5332 5.46207C11.6821 5.63807 11.8683 5.82051 12.0917 6.00939L12.0272 6.08576L11.9407 6.03561L12.2961 5.42233ZM9.05676 5.87876C9.08735 5.61878 9.44142 5.03629 10.119 4.13129L10.2353 3.97589L10.2943 4.16085C10.3289 4.26944 10.383 4.39938 10.4565 4.55066C10.5024 4.64531 10.5823 4.79954 10.6962 5.01333C10.7122 5.04336 10.7243 5.06617 10.7326 5.08176L10.7341 5.08457L10.7355 5.08747C10.9279 5.51248 11.3039 5.95962 11.8635 6.42889C12.0676 6.6 12.2981 6.77542 12.5549 6.95513C12.7012 7.05748 12.8923 7.18519 13.1282 7.33826C13.1437 7.34829 13.1555 7.35595 13.1637 7.36126L13.1934 7.38057L13.2043 7.41428C13.2343 7.50662 13.2079 7.68079 13.1253 7.93679C13.0484 8.17486 12.944 8.42683 12.8121 8.69271L12.7768 8.76372L12.6996 8.74561C12.1683 8.62093 11.6881 8.51955 11.2593 8.44146C10.6338 8.32759 10.243 8.2872 10.087 8.3203L10.0856 8.32059L10.0842 8.32085C10.0074 8.33489 9.85388 8.38791 9.62374 8.47989C9.48292 8.53617 9.2462 8.63527 8.91358 8.77718C8.60383 8.90933 8.38332 9.00184 8.25205 9.05472C8.02979 9.14425 7.87489 9.19884 7.78735 9.21848L7.77813 9.22056L7.76867 9.22086C7.68704 9.22349 7.50014 9.20813 7.20798 9.17477C6.89616 9.13916 6.70751 9.12445 6.64203 9.13063L6.52026 9.14211L6.5332 9.02049C6.5375 8.98007 6.54353 8.92248 6.55128 8.8477C6.5653 8.71252 6.57497 8.62367 6.58029 8.58117L6.58497 8.54369L6.61326 8.51867C6.78625 8.36563 6.96269 8.21555 7.14257 8.06841C7.41982 7.84162 7.63968 7.67724 7.80213 7.57528L7.85529 7.65998L7.81816 7.75282L7.63571 7.67984L7.80209 7.5753C8.10174 7.38703 8.35311 7.1761 8.55619 6.94251C8.84575 6.60946 9.01261 6.25489 9.05676 5.87878L9.05676 5.87876ZM9.25539 5.9021C9.20644 6.31908 9.02369 6.70962 8.70713 7.07373C8.49108 7.32223 8.22487 7.54586 7.90849 7.74465L7.85529 7.65998L7.89243 7.56713L8.07499 7.64015L7.90846 7.74467C7.75307 7.8422 7.53998 8.00172 7.26919 8.22322C7.09132 8.36872 6.91685 8.51713 6.74577 8.66847L6.67951 8.59357L6.77874 8.60597C6.7736 8.64709 6.76409 8.73454 6.75022 8.86833C6.74244 8.9433 6.73639 9.00107 6.73208 9.04165L6.63264 9.03107L6.62325 8.93151C6.70256 8.92403 6.90504 8.93888 7.23067 8.97606C7.51315 9.00832 7.69033 9.02328 7.76223 9.02097L7.76545 9.12091L7.74355 9.02334C7.8609 8.997 8.22475 8.85362 8.83509 8.59322C9.16912 8.45071 9.40726 8.35103 9.54952 8.29417C9.79205 8.19724 9.95829 8.14055 10.0483 8.12411L10.0662 8.22248L10.0455 8.12465C10.2272 8.0861 10.6438 8.12611 11.2951 8.2447C11.7273 8.32339 12.2107 8.42545 12.7453 8.5509L12.7225 8.64826L12.6329 8.6038C12.7604 8.3468 12.8611 8.10398 12.9349 7.87534C12.9695 7.76843 12.9932 7.67788 13.0063 7.60368C13.0179 7.53819 13.0204 7.49562 13.0141 7.47598L13.1092 7.44513L13.0547 7.529C13.048 7.5246 13.0362 7.51694 13.0194 7.50603C12.7815 7.3517 12.5885 7.22269 12.4403 7.11901C12.1786 6.93595 11.9435 6.757 11.735 6.58214C11.1522 6.09336 10.7582 5.62264 10.5533 5.16998L10.6444 5.12873L10.5561 5.17569C10.5478 5.16015 10.5357 5.13737 10.5197 5.10735C10.4046 4.89136 10.3236 4.73492 10.2765 4.63803C10.1989 4.47813 10.1413 4.33932 10.1038 4.2216L10.199 4.19123L10.2791 4.25116C9.97875 4.65231 9.74057 4.9933 9.56454 5.27412C9.37146 5.58214 9.26841 5.79148 9.25539 5.90213L9.25539 5.9021ZM11.2855 12.0156L10.9683 10.7096L11.825 10.3566C11.8514 10.3456 11.8724 10.3272 11.8879 10.3016C11.9035 10.2757 11.9102 10.248 11.9079 10.2184C11.9058 10.1904 11.8948 10.1655 11.875 10.1436C11.8548 10.1214 11.8302 10.1075 11.8013 10.1019L10.9772 9.93176L11.3025 8.72372L11.3939 8.7415C11.8392 8.82809 12.2909 8.9247 12.7491 9.03133L12.78 9.03853L12.8011 9.06225C13.238 9.55327 13.316 10.4509 13.0351 11.7552L13.0181 11.8342L12.9373 11.8342L12.9373 11.7342L12.9682 11.8293C12.7996 11.8841 12.5952 11.9308 12.3552 11.9695C12.213 11.9924 11.9958 12.0208 11.7036 12.0545C11.5655 12.0705 11.4627 12.0827 11.3951 12.0912L11.3065 12.1024L11.2855 12.0156ZM11.4798 11.9684L11.3826 11.992L11.3701 11.8928C11.4384 11.8842 11.5419 11.8719 11.6806 11.8559C11.9699 11.8224 12.1841 11.7945 12.3233 11.7721C12.5532 11.735 12.7476 11.6907 12.9064 11.6391L12.9215 11.6342L12.9373 11.6342L12.9373 11.7342L12.8396 11.7131C12.9739 11.0894 13.0236 10.5639 12.9885 10.1364C12.9547 9.72327 12.8424 9.40954 12.6517 9.1952L12.7264 9.12873L12.7037 9.22612C12.248 9.12005 11.7987 9.02395 11.3557 8.93783L11.3748 8.83966L11.4714 8.86566L11.198 9.88129L11.1014 9.85529L11.1216 9.75735L11.839 9.90553C11.9117 9.9195 11.9731 9.9541 12.0231 10.0093C12.0736 10.065 12.1017 10.1296 12.1073 10.2031C12.1129 10.2753 12.0968 10.3426 12.059 10.4051C12.021 10.468 11.9683 10.5135 11.9012 10.5415L11.1239 10.8618L11.0858 10.7694L11.1829 10.7458L11.4798 11.9684ZM7.50578 10.5927C7.36482 10.5054 7.12292 10.1602 6.78008 9.55705L6.68664 9.39268L6.87509 9.40796C6.93963 9.41319 7.04779 9.42479 7.19957 9.44275C7.51281 9.4798 7.71405 9.49428 7.80327 9.48617L7.80779 9.48576L7.81232 9.48576C7.8609 9.48576 8.00783 9.43752 8.25314 9.34104C8.40585 9.28097 8.6683 9.17182 9.04051 9.01358C9.34957 8.88218 9.56842 8.7906 9.69707 8.73883C9.91484 8.65118 10.0634 8.59882 10.1429 8.58174C10.2446 8.56054 10.5058 8.58499 10.9264 8.65509L11.035 8.67319L10.7127 9.87837L10.6204 9.85951C10.2028 9.77419 9.94472 9.7251 9.84627 9.71226L9.80256 9.70656L9.77728 9.67045C9.78957 9.688 9.80477 9.69856 9.82291 9.70213C9.82454 9.70245 9.82561 9.70262 9.82612 9.70263C9.8245 9.70259 9.82228 9.7027 9.81945 9.70294C9.80098 9.70453 9.77332 9.71051 9.73649 9.72087C9.66216 9.74179 9.55614 9.77944 9.41843 9.83385C9.24468 9.90249 8.94178 10.0318 8.50971 10.2219C7.9977 10.4471 7.68968 10.5744 7.58563 10.6039L7.54324 10.6158L7.50578 10.5927ZM7.61105 10.4226L7.55842 10.5076L7.5312 10.4114C7.62633 10.3845 7.92566 10.2603 8.42918 10.0388C8.86359 9.84774 9.16884 9.71741 9.34494 9.64784C9.48898 9.59093 9.60144 9.55111 9.68232 9.52835C9.73129 9.51458 9.77127 9.50635 9.80229 9.50368C9.86666 9.49814 9.91294 9.5155 9.94112 9.55575L9.8592 9.6131L9.87213 9.51394C9.97534 9.5274 10.2381 9.57728 10.6605 9.66356L10.6405 9.76154L10.5438 9.7357L10.8134 8.72789L10.91 8.75373L10.8935 8.85237C10.4976 8.78637 10.2614 8.76134 10.1849 8.77727C10.0805 8.79973 9.72511 8.93985 9.11876 9.19764C8.74487 9.3566 8.48073 9.46644 8.32634 9.52716C8.05751 9.63289 7.88618 9.68576 7.81232 9.68576L7.81232 9.58576L7.82138 9.68535C7.71826 9.69472 7.50316 9.68006 7.17607 9.64136C7.02672 9.62369 6.92101 9.61234 6.85893 9.60731L6.86701 9.50763L6.95395 9.45822C7.14123 9.7877 7.29692 10.0376 7.421 10.208C7.50664 10.3257 7.57 10.3972 7.61105 10.4226ZM6.62523 11.1695L6.62551 11.1701C6.56096 11.0504 6.50528 10.9202 6.45846 10.7796C6.36424 10.4966 6.33893 10.2532 6.3825 10.0492C6.38851 10.0222 6.39674 9.98018 6.40718 9.9232C6.41484 9.88143 6.42085 9.84966 6.4252 9.82786L6.47716 9.56808L6.60982 9.7974C6.857 10.2247 7.05725 10.5204 7.21059 10.6845C7.34511 10.8284 7.4656 10.8952 7.57205 10.8847L7.58485 10.8834L7.59757 10.8854C7.64049 10.8923 8.01796 10.7379 8.72996 10.4225C9.33238 10.1556 9.6883 10.0095 9.79773 9.98439L9.81677 9.98001L9.83606 9.98313C9.89886 9.99325 10.1866 10.0494 10.6994 10.1514C10.8396 10.1793 10.9384 10.199 10.9958 10.2103L11.3195 10.2743L11.0147 10.4008C9.84491 10.8861 9.19489 11.1656 9.06466 11.2392L9.06302 11.2401L9.06135 11.241C8.98339 11.2813 8.65052 11.5687 8.06274 12.1032C7.58425 12.5383 7.29127 12.7951 7.1838 12.8735L7.14621 12.901L7.101 12.8899C6.72661 12.7981 6.43898 12.7522 6.23811 12.7522L6.10245 12.7522L6.14258 12.6226C6.2588 12.2474 6.42258 11.8031 6.63392 11.2899L6.72639 11.3279L6.81119 11.3809L6.81119 11.3809L6.63392 11.2899C6.6505 11.2496 6.64837 11.2109 6.62751 11.1738L6.62632 11.1717L6.62523 11.1695ZM6.80411 11.0801L6.71467 11.1248L6.80183 11.0758C6.85438 11.1692 6.86006 11.266 6.81886 11.366L6.72639 11.3279L6.64159 11.2749L6.64159 11.2749L6.81886 11.366C6.60981 11.8737 6.44806 12.3123 6.33363 12.6817L6.23811 12.6522L6.23811 12.5522C6.45509 12.5522 6.75861 12.6 7.14865 12.6957L7.12483 12.7928L7.06585 12.712C7.16754 12.6378 7.45499 12.3855 7.92819 11.9552C8.22367 11.6865 8.43297 11.4983 8.5561 11.3905C8.76744 11.2056 8.90526 11.0965 8.96955 11.0633L9.01545 11.1522L8.96625 11.0651C9.10352 10.9875 9.76079 10.7045 10.9381 10.216L10.9764 10.3084L10.957 10.4065C10.9 10.3952 10.8011 10.3756 10.6603 10.3476C10.15 10.246 9.86462 10.1903 9.80421 10.1806L9.82014 10.0819L9.84254 10.1793C9.74556 10.2016 9.40171 10.3436 8.81098 10.6053C8.44746 10.7664 8.19264 10.8769 8.04653 10.937C7.78631 11.0438 7.62618 11.0925 7.56614 11.083L7.58186 10.9842L7.59167 11.0837C7.41968 11.1007 7.24394 11.0131 7.06446 10.821C6.90074 10.6458 6.69149 10.338 6.4367 9.89755L6.52326 9.84748L6.62132 9.86709C6.61717 9.88783 6.61137 9.91856 6.6039 9.95926C6.59301 10.0187 6.5844 10.0626 6.57809 10.091C6.5421 10.2594 6.56548 10.4679 6.64822 10.7164C6.69139 10.8461 6.7425 10.9657 6.80157 11.0753C6.80273 11.0774 6.80358 11.079 6.80411 11.0801ZM7.13675 14.2698C6.99248 14.2414 6.79177 14.0874 6.53462 13.8077C6.42941 13.6933 6.33496 13.5787 6.25126 13.4637C6.16256 13.3419 6.10135 13.2404 6.06764 13.1593L6.01672 13.0368L6.14852 13.0216C6.22126 13.0132 6.33379 13.0195 6.4861 13.0404C6.67391 13.0662 6.88376 13.1104 7.11567 13.1728C7.15715 13.1831 7.20394 13.1735 7.25604 13.1439C7.31906 13.108 7.43457 13.0178 7.60257 12.8732C7.69982 12.7913 7.90746 12.6051 8.2255 12.3144C8.74878 11.8363 9.06746 11.5581 9.18155 11.4798L9.18556 11.4771L9.1898 11.4748C9.29071 11.4191 9.76267 11.2144 10.6057 10.8607L10.7138 10.8153L11.0341 12.1341L10.9205 12.1461C10.565 12.1837 10.3139 12.2125 10.1672 12.2327C9.97822 12.2587 9.84899 12.284 9.77955 12.3088L9.74592 12.2147L9.82592 12.1547L9.94304 12.3108L9.74788 12.3146C9.67728 12.316 9.08887 12.7598 7.98266 13.646C7.58482 13.9647 7.32932 14.1666 7.21616 14.2516L7.18051 14.2784L7.13675 14.2698ZM7.1754 14.0736L7.15608 14.1717L7.09599 14.0918C7.20752 14.0079 7.4614 13.8073 7.85762 13.4899C8.38741 13.0655 8.76791 12.7652 8.9991 12.5892C9.18752 12.4457 9.33798 12.3361 9.45048 12.2604C9.59343 12.1643 9.69126 12.1157 9.74396 12.1147L9.74592 12.2147L9.66592 12.2747L9.58451 12.1661L9.71228 12.1205C9.79473 12.091 9.93731 12.0624 10.14 12.0345C10.2888 12.0141 10.5419 11.985 10.8995 11.9472L10.91 12.0467L10.8128 12.0703L10.5472 10.9765L10.6444 10.9529L10.683 11.0452C9.84662 11.3961 9.38108 11.5976 9.28641 11.6499L9.23811 11.5623L9.29466 11.6448C9.18824 11.7178 8.87683 11.9902 8.36042 12.4621C8.04037 12.7545 7.83124 12.9421 7.73302 13.0248C7.55523 13.1778 7.4292 13.2754 7.35494 13.3177C7.2564 13.3738 7.15931 13.3898 7.06367 13.3659C6.83991 13.3057 6.63831 13.2632 6.45886 13.2385C6.32324 13.2199 6.22743 13.2138 6.17144 13.2203L6.15998 13.1209L6.25232 13.0825C6.27998 13.1491 6.33352 13.2369 6.41294 13.346C6.49216 13.4548 6.58178 13.5636 6.68183 13.6724C6.7859 13.7855 6.88267 13.8783 6.97213 13.9506C7.06249 14.0237 7.13025 14.0647 7.1754 14.0736ZM13.4278 11.0234C13.5376 10.0808 13.4108 9.38699 13.0474 8.94198L13.0083 8.89415L13.0336 8.8378C13.0452 8.8119 13.0652 8.7683 13.0937 8.70699C13.1748 8.53241 13.236 8.39391 13.2776 8.29148C13.3491 8.11502 13.4011 7.95858 13.4334 7.82216C13.5142 7.48103 13.4769 7.25641 13.3216 7.1483C13.2834 7.12286 13.2243 7.08391 13.1444 7.03147C12.8259 6.82253 12.5557 6.63413 12.334 6.46627L12.2634 6.41284L12.7615 5.55565L13.972 6.16507L15.6309 7.00252L15.6458 7.02938C15.7206 7.16393 15.7716 7.55371 15.799 8.19871L15.8026 8.28422L15.7187 8.301C15.4599 8.35275 15.2331 8.39338 15.0382 8.42291L14.9421 8.43748L14.9248 8.34173C14.8819 8.1027 14.8291 7.86581 14.7665 7.63106L14.8631 7.60529L14.7674 7.63425C14.7544 7.59133 14.7317 7.56171 14.6994 7.54537C14.6698 7.53041 14.6373 7.5276 14.602 7.53693C14.5668 7.54624 14.5401 7.56466 14.522 7.59219C14.5021 7.62243 14.4972 7.65967 14.5074 7.7039L14.41 7.72638L14.5067 7.70087C14.5655 7.92384 14.6165 8.15391 14.6597 8.39108C14.7227 8.73653 14.7441 8.98424 14.7239 9.13421C14.7094 9.24465 14.6682 9.42596 14.6003 9.67816L14.5905 9.71449L14.5592 9.73537C14.5612 9.73404 14.5628 9.73281 14.564 9.73167C14.5638 9.73189 14.5632 9.73248 14.5624 9.73345C14.56 9.73616 14.5552 9.74196 14.5481 9.75086C14.5457 9.75389 14.5439 9.75614 14.5428 9.7576L14.3647 9.98021L14.3647 9.69513L14.4647 9.69513L14.5476 9.75098C14.1899 10.2823 13.8766 10.7301 13.6076 11.0944L13.4278 11.0234ZM13.6265 11.0465L13.5272 11.035L13.4467 10.9756C13.714 10.6136 14.0256 10.1682 14.3817 9.63928L14.5647 9.36755L14.5647 9.69513L14.4647 9.69513L14.3866 9.63266C14.3877 9.63128 14.3894 9.62918 14.3916 9.62637C14.4138 9.59851 14.4326 9.57937 14.4483 9.56896L14.5037 9.65216L14.4072 9.62617C14.4728 9.3825 14.5123 9.20965 14.5257 9.10762C14.543 8.97854 14.5221 8.75164 14.463 8.42692C14.4207 8.19486 14.3708 7.96986 14.3133 7.7519L14.3129 7.75041L14.3125 7.74887C14.2895 7.649 14.3036 7.56009 14.355 7.48216C14.4011 7.4121 14.4665 7.3659 14.5509 7.34357C14.6352 7.32129 14.7148 7.32906 14.7896 7.36687C14.8729 7.40894 14.9293 7.47876 14.9588 7.57632L14.9593 7.57793L14.9597 7.57952C15.0238 7.81961 15.0777 8.06188 15.1217 8.30634L15.0233 8.32404L15.0083 8.22517C15.2001 8.19611 15.4238 8.15602 15.6794 8.10489L15.699 8.20295L15.5991 8.20718C15.5879 7.94196 15.572 7.7167 15.5513 7.5314C15.5271 7.31433 15.5004 7.17937 15.471 7.12651L15.5584 7.07795L15.5134 7.16722L13.8821 6.34372L12.7556 5.77664L12.8006 5.68732L12.8871 5.73756L12.4808 6.43678L12.3944 6.38654L12.4547 6.30681C12.6729 6.47195 12.9393 6.65776 13.2541 6.86424C13.3345 6.91695 13.395 6.95692 13.4359 6.98415C13.6657 7.1441 13.7297 7.43881 13.628 7.86827C13.5933 8.0146 13.5383 8.18072 13.4629 8.36663C13.4202 8.47211 13.3575 8.61364 13.2751 8.79121C13.247 8.85174 13.2273 8.89456 13.2161 8.91966L13.1248 8.87873L13.2023 8.81547C13.6014 9.30419 13.7428 10.0479 13.6265 11.0465ZM14.8291 12.2988C14.7641 12.2945 14.7155 12.29 14.6832 12.2853C14.6313 12.2778 14.5936 12.2646 14.5702 12.2459L14.5621 12.2394L14.5555 12.2315C14.5243 12.1936 14.5071 12.1227 14.504 12.0188C14.5018 11.9465 14.505 11.8522 14.5135 11.7359C14.5236 11.5983 14.5445 11.4015 14.5762 11.1458C14.5779 11.1315 14.5793 11.1205 14.5803 11.1126C14.6109 10.8746 14.6533 10.6324 14.7075 10.386C14.7391 10.2424 14.7863 10.0504 14.8492 9.81004C14.8525 9.79745 14.8548 9.78848 14.8562 9.78313C14.8648 9.74942 14.8774 9.70101 14.894 9.63789C14.944 9.44753 14.9754 9.30845 14.9883 9.22066C15.0082 9.08435 15.0102 8.94273 14.9942 8.7958L14.9837 8.69966L15.0794 8.68598C15.2131 8.66689 15.4212 8.63068 15.7039 8.57734L15.8191 8.55561L15.8224 8.67275C15.823 8.69159 15.8238 8.72122 15.8249 8.76162C15.835 9.1227 15.8455 9.34335 15.8567 9.42356C15.867 9.511 15.8428 9.68966 15.7841 9.95956C15.7192 10.2576 15.6302 10.5821 15.5169 10.9329C15.3976 11.2997 15.2772 11.6094 15.1559 11.862C15.0557 12.0705 14.972 12.2069 14.905 12.2712L14.8731 12.3018L14.8291 12.2988ZM14.8424 12.0993L14.8358 12.199L14.7666 12.1268C14.8162 12.0793 14.8859 11.9621 14.9756 11.7754C15.0931 11.5308 15.2101 11.2295 15.3265 10.8714C15.4378 10.5268 15.5252 10.2087 15.5886 9.91704C15.6426 9.66893 15.6659 9.51361 15.6586 9.45108C15.6464 9.36358 15.6352 9.13561 15.625 8.76718C15.6239 8.72738 15.6231 8.69781 15.6225 8.67846L15.7225 8.6756L15.741 8.77387C15.4554 8.82776 15.2443 8.86446 15.1077 8.88397L15.0936 8.78498L15.193 8.77415C15.2108 8.93799 15.2086 9.09647 15.1862 9.2496C15.1722 9.34477 15.1393 9.49114 15.0874 9.68872C15.071 9.75124 15.0584 9.79957 15.0497 9.8337C15.0488 9.83727 15.0464 9.84625 15.0427 9.86064C14.9805 10.0985 14.9338 10.2879 14.9028 10.4289C14.8499 10.6695 14.8085 10.9056 14.7788 11.1371C14.7779 11.1437 14.7766 11.1548 14.7746 11.1704C14.702 11.7573 14.6804 12.0686 14.7097 12.1041L14.6326 12.1678L14.6951 12.0897C14.6907 12.0862 14.6865 12.0836 14.6825 12.0818L14.6833 12.0819C14.6896 12.0837 14.6992 12.0855 14.7119 12.0874C14.739 12.0913 14.7825 12.0953 14.8424 12.0993Z" fill="rgb(0,0,0)" fill-rule="nonzero" />
    </symbol>
    <symbol viewBox="0 0 20 20" id="icon-vodniy" fill="none">
      <rect id="vodniy" width="20.000000" height="20.000000" x="0.000000" y="0.000000" />
      <path id="Vector 8722" d="M15.9889 4.88209C16.0297 4.62369 15.9568 4.37914 15.7888 4.21116C15.6209 4.04323 15.3763 3.97031 15.1181 4.01107C12.5803 4.41153 10.1133 5.76683 8.14097 7.65262L7.59444 7.10609C7.90246 6.58448 7.83264 5.89981 7.38495 5.45215L6.2488 4.31597C5.88284 3.95001 5.28735 3.95006 4.92143 4.31597L4.31598 4.9214C4.1387 5.09868 4.04108 5.33437 4.04108 5.58509C4.04108 5.8358 4.13872 6.07152 4.31598 6.24876L5.45214 7.38493C5.70909 7.64191 6.05072 7.7834 6.41411 7.7834C6.65716 7.7834 6.8903 7.71981 7.095 7.60105L7.64397 8.15001C5.76272 10.1207 4.41098 12.584 4.01108 15.1179C3.9703 15.3763 4.04324 15.6208 4.21119 15.7888C4.34856 15.9262 4.53712 16 4.74265 16C4.78835 16 4.83492 15.9963 4.88189 15.9889C7.4158 15.5891 9.87918 14.2373 11.85 12.356L12.3992 12.9052C12.0988 13.4254 12.1706 14.1034 12.615 14.5478L13.7512 15.684C13.9342 15.867 14.1746 15.9585 14.4149 15.9585C14.6553 15.9585 14.8956 15.867 15.0786 15.684L15.684 15.0786C16.05 14.7126 16.05 14.1172 15.684 13.7512L14.5478 12.615C14.1001 12.1673 13.4155 12.0975 12.8939 12.4055L12.3473 11.859C14.2331 9.88674 15.5884 7.41981 15.9889 4.88209L15.9889 4.88209ZM15.2277 4.70558C15.2398 4.70368 15.2501 4.703 15.2587 4.703C15.2789 4.703 15.2895 4.70689 15.2912 4.70783C15.2935 4.71111 15.3008 4.73165 15.2944 4.77245C15.1674 5.57707 14.937 6.38416 14.6069 7.18388C14.4395 6.79706 14.2069 6.45084 13.9152 6.15922C13.5911 5.83508 13.2016 5.58448 12.7635 5.41502C13.5805 5.07316 14.4054 4.83536 15.2277 4.70558L15.2277 4.70558ZM11.5983 5.9762C11.6534 5.9461 11.7086 5.91667 11.7639 5.88753C12.4232 5.96795 12.9948 6.23317 13.4181 6.65641C13.8095 7.0478 14.0593 7.54724 14.162 8.14132C14.117 8.22828 14.071 8.31511 14.0237 8.40178C13.4454 9.46092 12.7145 10.4548 11.8493 11.3609L11.2367 10.7483L11.9074 10.0776C12.1705 9.81453 12.3154 9.46364 12.3154 9.08957C12.3154 8.71553 12.1705 8.36461 11.9074 8.10152L11.8982 8.09234C11.6351 7.82922 11.2842 7.68433 10.9102 7.68433C10.5361 7.68433 10.1852 7.82925 9.92212 8.09234L9.25142 8.76303L8.63907 8.1507C9.54521 7.28546 10.5391 6.55455 11.5983 5.9762L11.5983 5.9762ZM9.74858 9.26022L10.4193 8.58952C10.5546 8.45419 10.7324 8.38653 10.9102 8.38653C11.0879 8.38653 11.2657 8.45419 11.401 8.58952L11.4102 8.59871C11.6809 8.86939 11.6809 9.30979 11.4102 9.58048L10.7395 10.2512L9.74858 9.26022ZM10.2423 10.7484L9.58062 11.4101C9.30996 11.6808 8.86954 11.6807 8.59871 11.4099L8.58967 11.4009C8.31901 11.1302 8.31901 10.6898 8.58967 10.4191L9.25139 9.75741L10.2423 10.7484ZM6.41413 7.08026C6.23856 7.08026 6.07351 7.01189 5.94935 6.88774L4.81317 5.75154C4.76871 5.70711 4.74422 5.64797 4.74422 5.58507C4.74422 5.52218 4.76871 5.46305 4.81317 5.41856L5.4186 4.81314C5.46306 4.76868 5.5222 4.74418 5.5851 4.74418C5.64801 4.74418 5.70715 4.76868 5.75161 4.81314L6.88779 5.94931C7.14406 6.20561 7.14406 6.62259 6.88795 6.8787L6.8789 6.88772C6.75475 7.01189 6.5897 7.08026 6.41413 7.08026L6.41413 7.08026ZM4.77232 15.2944C4.73163 15.3008 4.71117 15.2935 4.70885 15.2921C4.70653 15.2888 4.69917 15.2683 4.70562 15.2274C4.83235 14.4245 5.06204 13.619 5.39108 12.8209C5.55815 13.2026 5.78885 13.5446 6.07714 13.8328C6.40468 14.1604 6.79903 14.4128 7.24276 14.5823C6.42374 14.9256 5.59673 15.1643 4.77232 15.2944L4.77232 15.2944ZM8.40167 14.0238C8.35004 14.052 8.29833 14.0796 8.24658 14.1069C7.57954 14.0292 7.00144 13.7628 6.57433 13.3357C6.1868 12.9482 5.93803 12.4543 5.83341 11.8676C5.87984 11.7776 5.92737 11.6878 5.97631 11.5982C6.55274 10.5425 7.28068 9.55179 8.14209 8.64814L8.7542 9.26025L8.09248 9.92197C7.82936 10.1851 7.68447 10.536 7.68447 10.91C7.68447 11.2841 7.82938 11.635 8.09264 11.8983L8.10169 11.9073C8.3648 12.1704 8.71569 12.3153 9.08976 12.3153C9.46381 12.3153 9.81472 12.1704 10.0778 11.9073L10.7395 11.2456L11.3519 11.8579C10.4482 12.7193 9.45737 13.4473 8.40167 14.0238L8.40167 14.0238ZM13.5859 12.92C13.7542 12.92 13.9225 12.9841 14.0507 13.1122L15.1868 14.2484C15.2786 14.3402 15.2786 14.4896 15.1869 14.5814L14.5814 15.1868C14.4896 15.2786 14.3403 15.2786 14.2484 15.1868L13.1122 14.0506C12.856 13.7943 12.856 13.3773 13.1122 13.1211L13.1211 13.1122C13.2493 12.9841 13.4175 12.92 13.5859 12.92L13.5859 12.92Z" fill="rgb(0,0,0)" fill-rule="nonzero" />
    </symbol>
    <symbol viewBox="0 0 20 20" id="icon-motosport" fill="none">
      <rect id="motosport" width="20.000000" height="20.000000" x="0.000000" y="0.000000" />
      <g id="Group 175">
        <path id="Vector 8742" d="M2 15.5432C2 15.7955 2.20988 16 2.46875 16C2.51672 16 13.5245 16 17.5312 16C17.7901 16 18 15.7955 18 15.5432C18 15.2909 17.7901 15.0864 17.5312 15.0864L6.96225 15.0864C7.06194 14.9562 7.14856 14.8151 7.21934 14.6637C7.479 14.1086 7.50125 13.4881 7.28206 12.9166C7.26494 12.872 7.24606 12.8284 7.22634 12.7852L8.22441 12.085C8.73059 12.4942 9.43072 12.6287 10.0806 12.392C11.0513 12.0384 11.5433 10.9866 11.1804 10.0406C11.005 9.58337 11.0228 9.087 11.2306 8.64289C11.6148 7.82132 12.3822 7.66729 12.459 7.62401L13.6522 8.70011C13.605 8.77625 13.5615 8.85515 13.523 8.93735C13.2634 9.4925 13.2411 10.113 13.4603 10.6844C13.9129 11.8644 15.261 12.4669 16.4764 12.0241C17.6869 11.5831 18.3036 10.2646 17.8511 9.08487C17.3986 7.90513 16.0454 7.30418 14.835 7.74516C14.638 7.81694 14.455 7.9129 14.2884 8.02908L13.4421 7.26584L14.4755 6.88936C14.718 6.80101 14.8411 6.53783 14.7505 6.30154C14.6598 6.06521 14.3897 5.94525 14.1473 6.0336L12.6718 6.57112L10.2292 4.36821C9.83675 4.01232 9.28103 3.90485 8.77884 4.08779L7.56531 4.52992C7.32281 4.61827 7.19972 4.88145 7.29038 5.11778C7.38103 5.3541 7.65106 5.47403 7.89359 5.38572L9.10716 4.94361C9.27456 4.88264 9.45978 4.91846 9.59153 5.03793L10.148 5.53981L8.22181 6.24151C8.15366 6.26633 8.09234 6.30629 8.04278 6.35821L6.69016 7.77488C6.67047 7.78207 2.58619 9.26994 2.40303 9.33666C2.16059 9.42498 2.0375 9.68817 2.12816 9.92449C2.21891 10.1611 2.48909 10.2807 2.73138 10.1924L4.30581 9.61885L6.54197 10.6121C6.65509 10.6624 6.78406 10.6668 6.90053 10.6244L7.57588 10.3783C7.52256 10.6849 7.54831 11.0085 7.66784 11.3202C7.67081 11.3279 7.67422 11.3354 7.67728 11.3431L6.68134 12.0419C5.50363 10.9788 3.61413 11.3578 2.95406 12.7691C2.58734 13.5532 2.71116 14.4349 3.21056 15.0864L2.46875 15.0864C2.20988 15.0864 2 15.2909 2 15.5432L2 15.5432ZM15.1633 8.60098C15.8941 8.33484 16.7031 8.70124 16.973 9.40482C17.2445 10.1126 16.8745 10.9038 16.1482 11.1684C15.4202 11.4336 14.6107 11.0741 14.3385 10.3646C14.2104 10.0307 14.2202 9.66898 14.3646 9.34266L15.3373 10.22C15.5273 10.3913 15.8239 10.3801 15.9997 10.195C16.1756 10.0098 16.1641 9.72075 15.9741 9.54942L15.0012 8.67197C15.0533 8.64535 15.1073 8.62139 15.1633 8.60098L15.1633 8.60098ZM6.75409 9.70233L5.54769 9.16646L7.12212 8.59291C7.19028 8.56809 7.25159 8.52814 7.30116 8.47621L8.65381 7.05957L10.9184 6.2346L11.6996 6.93916C11.1148 7.21702 10.6509 7.67962 10.3775 8.26404C10.2668 8.50082 10.1927 8.74756 10.1542 8.99798C9.71075 8.81489 9.2205 8.80387 8.76759 8.96887L6.75409 9.70233ZM10.3022 10.3605C10.4837 10.8335 10.2378 11.3593 9.75237 11.5362C9.26706 11.713 8.72741 11.4733 8.54597 11.0003C8.36497 10.5284 8.61166 10.001 9.09587 9.8246C9.58222 9.64742 10.1212 9.88837 10.3022 10.3605ZM3.80709 13.148C4.16925 12.3736 5.16581 12.099 5.894 12.5943L4.81281 13.3528C4.60272 13.5002 4.555 13.7857 4.70628 13.9905C4.858 14.1958 5.15106 14.2413 5.36059 14.0943L6.43806 13.3383C6.53106 13.6522 6.50684 13.9844 6.36631 14.2848C6.21053 14.6179 5.93097 14.8719 5.57912 15.0001C4.40938 15.4262 3.28834 14.2572 3.80709 13.148Z" fill="rgb(0,0,0)" fill-rule="nonzero" />
      </g>
    </symbol>
    <symbol viewBox="0 0 20 20" id="icon-snowboard" fill="none">
      <rect id="snowboard" width="20.000000" height="20.000000" x="0.000000" y="0.000000" />
      <line id="Line 3" x1="0" x2="2.89951754" y1="0" y2="0" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.699999988" transform="matrix(-0.707107,0.707107,-0.707107,-0.707107,8.64746,7.42969)" />
      <path id="Vector 8744" d="M15.5995 7.40723C16.0065 6.93053 16.2488 6.30893 16.2383 5.63056C16.2162 4.19533 15.0433 3.02248 13.6081 3.00033C12.5851 2.98454 11.6913 3.54356 11.2286 4.37539C10.9017 4.96323 10.5309 5.52433 10.124 6.05853" fill-rule="nonzero" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.699999988" />
      <path id="Vector 8745" d="M13.5 8.99905C14.0138 8.60821 14.1311 8.48521 14.6946 8.16797" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.699999988" />
      <path id="Line 4" d="M0 0.00848977L2.74342 0" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.699999988" transform="matrix(0.707107,-0.707107,0.707107,0.707107,9.49414,12.4961)" />
      <path id="Vector 8746" d="M2.01348 14.1875C2.00321 14.29 1.99871 14.3942 2.00032 14.4998C2.02248 15.935 3.19536 17.1079 4.63058 17.13C5.65358 17.1459 6.54736 16.5868 7.01004 15.755C7.33485 15.171 7.59663 14.7194 8.00029 14.1884" fill-rule="nonzero" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.699999988" />
      <path id="Vector 8747" d="M4.74275 11.125C4.21097 11.5294 3.65256 11.8981 3.06769 12.2235C2.61458 12.4755 2.24241 12.8554 2 13.3145" fill-rule="nonzero" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.699999988" />
      <path id="Line 5" d="M0 0L4.59289 0.06439" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.699999988" transform="matrix(-0.989091,-0.147307,0.147307,-0.989091,16.0332,5.21875)" />
      <path id="Line 6" d="M0 0.0136882L5.08462 0" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.699999988" transform="matrix(-0.146569,-0.9892,0.9892,-0.146569,4.20215,17.0352)" />
      <path id="Vector 8748" d="M5.2977 11.6453L7.62445 13.972C8.08125 14.4288 8.82191 14.4288 9.27871 13.972C9.73551 13.5152 9.73551 12.7746 9.27871 12.3178L6.95196 9.99104C6.49513 9.53424 5.7545 9.53424 5.2977 9.99104C4.84087 10.4479 4.84087 11.1885 5.2977 11.6453Z" fill-rule="nonzero" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.699999988" />
      <path id="Vector 8749" d="M7.42551 11.4192C7.68909 11.1556 8.11649 11.1556 8.38007 11.4192L7.54533 10.5844C7.28172 10.3208 6.85435 10.3208 6.59076 10.5844L5.89107 11.2841C5.62746 11.5477 5.62746 11.9751 5.89107 12.2387L6.72581 13.0734C6.4622 12.8099 6.4622 12.3825 6.72581 12.1189L7.42551 11.4192Z" fill-rule="nonzero" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.699999988" />
      <path id="Vector 8750" d="M8.99006 7.95389L11.3168 10.2806C11.7736 10.7374 12.5142 10.7374 12.9711 10.2806C13.4279 9.82384 13.4279 9.08321 12.9711 8.62638L10.6443 6.29963C10.1875 5.84283 9.44689 5.84283 8.99006 6.29963C8.53326 6.75646 8.53326 7.49706 8.99006 7.95389Z" fill-rule="nonzero" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.699999988" />
      <path id="Vector 8751" d="M11.1189 7.72775C11.3825 7.46416 11.8099 7.46416 12.0734 7.72775L11.2387 6.893C10.9751 6.62942 10.5477 6.62942 10.2841 6.893L9.58443 7.59269C9.32082 7.85631 9.32082 8.28368 9.58443 8.54726L10.4192 9.38201C10.1556 9.11842 10.1556 8.69105 10.4192 8.42744L11.1189 7.72775Z" fill-rule="nonzero" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.699999988" />
    </symbol>
    <symbol viewBox="0 0 20 20" id="icon-strelkoviy" fill="none">
      <rect id="strelkoviy" width="20.000000" height="20.000000" x="0.000000" y="0.000000" />
      <g id="g2772">
        <g id="g2776">
          <g id="g2782">
            <path id="path2784" d="M5.90673 2.95337C5.90673 4.58002 4.58002 5.90673 2.95337 5.90673C1.32671 5.90673 0 4.58002 0 2.95337C0 1.32671 1.32671 0 2.95337 0C4.58002 0 5.90673 1.32671 5.90673 2.95337Z" fill-rule="evenodd" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.663212478" transform="matrix(1,0,0,-1,7.04688,12.9531)" />
          </g>
          <g id="g2786">
            <path id="path2788" d="M10 4.99997C10 7.75388 7.75391 9.99997 5 9.99997C2.24609 9.99997 0 7.75388 0 4.99997C0 2.24606 2.24609 0 5 0C7.75391 0 10 2.24606 10 4.99997Z" fill-rule="evenodd" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.663212478" transform="matrix(1,0,0,-1,5,15)" />
          </g>
          <g id="g2790">
            <path id="path2792" d="M0 0L0 4.81865" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.663212478" transform="matrix(1,0,0,-1,10,8.57812)" />
          </g>
          <g id="g2794">
            <path id="path2796" d="M11.4248 10L16.2435 10" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.663212478" />
          </g>
          <g id="g2798">
            <path id="path2800" d="M0 4.81865L0 0" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.663212478" transform="matrix(1,0,0,-1,10,16.2461)" />
          </g>
          <g id="g2802">
            <path id="path2804" d="M8.57549 10L3.75684 10" stroke="rgb(0,0,0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.663212478" />
          </g>
        </g>
      </g>
    </symbol>

  </defs>
</svg>

</body>

</html>