<?
use Bitrix\Main\Localization\Loc;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$id =  'form_' . md5(serialize($arParams));

Loc::loadMessages(__FILE__);
\Bitrix\Main\UI\Extension::load("ui.alerts");
?>
<?//=$arResult["FORM_HEADER"]?>
          <input type="hidden" name="web_form_submit" value="Y">
    <div class="modal" id="<?= $id ?>" data-modal-id="modal-feedback">
    <div class="modal__overlay" data-modal-close="modal-feedback"></div>

    <div class="modal__inner" data-scroll-lock-scrollable="">
      <button class="modal__exit-btn" data-modal-close="modal-feedback">
        <svg data-modal-close="modal-feedback" class="modal__exit-svg" width="20" height="20">
          <use href="#icon-cancel"></use>
        </svg>
      </button>
      <div class="modal__body">
        <div class="modal__holder f-col">
          <button type="button" class="modal__mob-dragger show-on-mob"></button>

          <h1 class="modal__title weight-xl">Задайте нам вопрос</h1>
          <form class="modal__feedback-form f-col g-20" action="ajax.php" method="post" id="modal-feedback">
            <div class="modal__feedback-form-top-block f-row j-between g-20">
              <div class="modal__input-block f-col g-4">
                <div class="modal__input-wrapper input-wrapper">
                  <input placeholder="<?= $arResult["QUESTIONS"]['NAME']['CAPTION']?>" class="modal__input" type="text" name="form_text_1" id="modal-feedback-name" data-bouncer-target="#modal-feedback-message_name" required>
                </div>
                <div class="modal__error-holder" id="modal-feedback-message_name"></div>
              </div>
              <div class="modal__input-block f-col g-4">
                <div class="modal__input-wrapper input-wrapper">
                  <input placeholder="<?= $arResult["QUESTIONS"]['NUMBER']['CAPTION']?>" class="modal__input" pattern="^\+?[0-9\s\-\(\)]{7,}$" type="tel" name="form_text_2" id="modal-feedback-phone" data-bouncer-target="#modal-feedback-message_phone" required>
                </div>
                <div class="modal__error-holder" id="modal-feedback-message_phone"></div>
              </div>

              <div class="modal__input-block f-col g-4">
                <div class="modal__input-wrapper input-wrapper">
                  <input placeholder="<?= $arResult["QUESTIONS"]['EMAIL']['CAPTION']?>" class="modal__input" type="email" name="form_text_3" id="modal-feedback-email" data-bouncer-target="#modal-feedback-message_email" required>
                </div>
                <div class="modal__error-holder" id="modal-feedback-message_email"></div>
              </div>
            </div>

            <div class="modal__feedback-form-middle-block f-row">
              <div class="modal__input-block f-col g-4">
                <div class="modal__textarea-wrapper input-wrapper f-row">
                  <textarea placeholder="<?= $arResult["QUESTIONS"]['ANSWER']['CAPTION']?>" class="modal__textarea" name="form_text_4" id="modal-feedback-message" data-bouncer-target="#modal-feedback-message_message" required></textarea>
                </div>
                <div class="modal__error-holder" id="modal-feedback-message_message"></div>
              </div>
            </div>
            <div class="modal__feedback-form-bottom-block f-row g-20 j-between">
              <div class="modal__input-block f-col g-4">
                <div class="modal__policy-holder f-row g-12">
                  <label class="dropdown__custom-checkbox">
                    <input id="modal-feedback-policy" type="checkbox" class="dropdown__custom-checkbox--input" data-bouncer-target="#modal-feedback-message_policy" required>
                    <span class="dropdown__custom-checkbox--box">
                      <svg class="dropdown__custom-checkbox--check" width="16" height="16">
                        <use href="#icon-tick"></use>
                      </svg>
                    </span>
                  </label>
                  <span class="modal__checkbox-text color-grey60">
                    Я принимаю условия
                    <a href="/privacy/" target="_blank" class="color-sports100">политики конфиденциальности</a>
                    и даю согласие на обработку моих
                    <a href="/tos/" target="_blank" class="color-sports100">персональных данных</a>
                  </span>
                </div>
                <div class="modal__error-holder" id="modal-feedback-message_policy"></div>
              </div>
              <button type="submit" class="modal__feedback-submit base-button align-center">ОТПРАВИТЬ</button>
            </div>
          </form>
        </div>

        <script async="">
  document.addEventListener('DOMContentLoaded', function () {
    
    $("#modal-feedback-phone").mask("+7(999) 999-9999");
    const modal = document.querySelector('.modal[data-modal-id="modal-feedback"]');
    const overlay = modal.querySelector('.modal__overlay');
    const inner = modal.querySelector('.modal__inner');
    const exit = modal.querySelector('.modal__exit-btn');

    modal.classList.add('feedback--modal');
    overlay.classList.add('feedback--overlay');
    inner.classList.add('feedback--inner');
    exit.classList.add('feedback--exit');

    const dragBtn = modal.querySelector('.modal__mob-dragger');
    // <-- изменённый обработчик: добавляем .closing и ждём transitionend на inner
    dragBtn.addEventListener('swiped-down', () => {
      if (modal.dataset.active === 'true') {
        modal.classList.add('closing');
        document.body.classList.remove('no-scroll');

        inner.addEventListener(
          'transitionend',
          (e) => {
            // фильтруем по transform, чтобы не сработать на лишние transitionend
            if (e.propertyName && e.propertyName.indexOf('transform') === -1) return;
            modal.classList.remove('closing');
            setTimeout(() => {
              modal.dataset.active = 'false';
            }, 300);
          },
          { once: true }
        );

        setTimeout(() => {
          if (modal.classList.contains('closing')) {
            modal.classList.remove('closing');
            modal.dataset.active = 'false';
          }
        }, 300);
      }
    });

    const form = document.querySelector('#modal-feedback');
    if (form) {
      new Bouncer('#modal-feedback', {
        disableSubmit: true,
        messages: {
          missingValue: {
            default: 'Поле обязательно',
            email: 'Введите e-mail',
            tel: 'Введите номер телефона',
            checkbox: 'Необходимо согласиться с условиями'
          },
          patternMismatch: {
            email: 'Введите корректный e-mail',
            tel: 'Введите корректный номер телефона'
          },
          outOfRange: {
            over: 'Значение слишком большое',
            under: 'Значение слишком маленькое'
          },
          wrongLength: {
            over: 'Слишком много символов',
            under: 'Слишком мало символов'
          }
        }
      });

      // <-- изменённый обработчик: при валидном сабмите плавно закрываем модалку
      form.addEventListener(
        'bouncerFormValid',
        function (e) {
         // плавное закрытие без новых функций
          const data = new FormData(form);
  
          fetch('/local/components/kvokka/form/templates/feedback/ajax.php/', {
            method: 'POST',
            credentials: 'include',
            body: data
          })
            .then((response) => {
              return response.text();
            })
            .then((html) => {
              //console.log(html);
              const inputEmail = document.getElementById('modal-feedback-email').value;
              document.getElementById('user-email').textContent = inputEmail;
            });


          modal.classList.add('closing');
          const innerEl = modal.querySelector('.modal__inner');
          if (innerEl) {
            innerEl.addEventListener(
              'transitionend',
              (ev) => {
                if (ev.propertyName && ev.propertyName.indexOf('transform') === -1) return;
                modal.classList.remove('closing');
                modal.dataset.active = 'false';

                const thx_modal = document.querySelector('.modal[data-modal-id="modal-feedback-thx"]');
                if (thx_modal) {
                  thx_modal.dataset.active = 'true';
                  scrollLock.disablePageScroll();
                }
              },
              { once: true }
            );

            setTimeout(() => {
              if (modal.classList.contains('closing')) {
                modal.classList.remove('closing');
                modal.dataset.active = 'false';
                const thx_modal = document.querySelector('.modal[data-modal-id="modal-feedback-thx"]');
                if (thx_modal) {
                  thx_modal.dataset.active = 'true';
                  scrollLock.disablePageScroll();
                }
              }
            }, 450);
          } else {
            modal.classList.remove('closing');
            modal.dataset.active = 'false';
            const thx_modal = document.querySelector('.modal[data-modal-id="modal-feedback-thx"]');
            if (thx_modal) {
              thx_modal.dataset.active = 'true';
              scrollLock.disablePageScroll();
            }
          }
        },
        false
      );

      form.addEventListener(
        'bouncerShowError',
        function (e) {
          //при ошибках
        },
        false
      );
    }
  });
</script>
      </div>
    </div>
  </div>
<?//=$arResult["FORM_FOOTER"]?>
  <div class="modal" data-modal-id="modal-feedback-thx">
    <div class="modal__overlay" data-modal-close="modal-feedback-thx"></div>

    <div class="modal__inner" data-scroll-lock-scrollable="">
      <button class="modal__exit-btn" data-modal-close="modal-feedback-thx">
        <svg data-modal-close="modal-feedback-thx" class="modal__exit-svg" width="20" height="20">
          <use href="#icon-cancel"></use>
        </svg>
      </button>

      <div class="modal__body">
        <div class="modal__holder f-col g-16">
          <svg class="modal__top-svg thx__top-svg" width="70" height="70">
            <use href="#icon-big-check"></use>
          </svg>
          <h1 class="modal__title thx__title">Спасибо, мы получили ваш вопрос</h1>
          <p class="modal__thx-text color-grey60">В ближайшее время свяжемся с Вами через электронную почту <span id="user-email"></span></p>
          <button class="modal__thx-exit secondary-button" data-modal-close="modal-feedback-thx">ВЕРНУТЬСЯ</button>
        </div>
        <script async="">
  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.querySelector('.modal[data-modal-id="modal-feedback-thx"]');
    const overlay = modal.querySelector('.modal__overlay');
    const inner = modal.querySelector('.modal__inner');

    modal.classList.add('feedback-thx--modal');
    overlay.classList.add('feedback-thx--overlay');
    inner.classList.add('feedback-thx--inner');
  });
</script>
</script>
      </div>
    </div>
  </div>
  