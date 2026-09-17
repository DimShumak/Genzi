function getCssVar(name) {
  // prettier-ignore
  return parseInt(getComputedStyle(document.documentElement).getPropertyValue(name).trim(), 10);
}

function initInstructorsSwiper() {
  const md = getCssVar('--md');
  const xl = getCssVar('--xl');

  new Swiper('.travel__instructors .swiper', {
    slidesPerView: 'auto',
    spaceBetween: 10,
    navigation: {
      nextEl: '.travel__swiper .swiper-button-next',
      prevEl: '.travel__swiper .swiper-button-prev'
    },
    breakpoints: {
      [md]: {
        slidesPerView: 'auto'
      },
      [xl]: {
        slidesPerView: 3
      }
    }
  });
}
function changeTheme() {
  const body = document.body;
  body.classList.add('green-theme');
}
function showNumberBtn() {
  const btn = document.querySelector('.travel__contact-phone-btn');
  const phoneSpan = document.querySelector('.travel__contact-phone-hidden');

  if (!btn || !phoneSpan) return;

  const phoneNumber = btn.dataset.phone;

  btn.addEventListener('click', () => {
    if (phoneNumber) {
      phoneSpan.textContent = phoneNumber;
      phoneSpan.classList.remove('color-grey60');
    }
  });
}
function initScheduleToggles() {
  const buttons = Array.from(document.querySelectorAll('.travel__schedule-expand-btn'));

  if (!buttons.length) return;

  buttons.forEach((btn) => {
    btn.setAttribute('aria-pressed', 'false');

    const useEl = btn.querySelector('use');

    const toggle = () => {
      const item = btn.closest('.travel__schedule-element');
      if (!item) return;

      const isOpen = item.classList.toggle('open');
      btn.classList.toggle('open', isOpen);
      btn.setAttribute('aria-pressed', String(isOpen));

      if (useEl) {
        useEl.setAttribute('href', isOpen ? '#icon-cancel' : '#icon-plus');
      }
    };

    btn.addEventListener('click', toggle);
  });
}

function showTooltip() {
  const btn = document.querySelector('.travel__infoblock-travel-difficulty');
  const tip = document.querySelector('.travel__tooltip');

  if (btn && tip) {
    // начальные атрибуты для доступности
    btn.setAttribute('aria-expanded', 'false');
    tip.setAttribute('aria-hidden', 'true');

    // один обработчик на кнопку — открытие/закрытие
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();

      const isOpen = tip.classList.toggle('open'); // true если теперь открыт
      btn.setAttribute('aria-expanded', String(isOpen));
      tip.setAttribute('aria-hidden', String(!isOpen));
      if (svg) {
        svg.style.setProperty('--svg-color', isOpen ? 'var(--color-sports-100)' : '');
      }
    });
  }
  document.addEventListener('click', (e) => {
    const isClickInside = btn.contains(e.target) || tip.contains(e.target);
    if (!isClickInside && tip.classList.contains('open')) {
      tip.classList.remove('open');
      btn.setAttribute('aria-expanded', 'false');
      tip.setAttribute('aria-hidden', 'true');

      if (svg) {
        svg.style.setProperty('--svg-color', '');
      }
    }
  });
}
showTooltip();
initScheduleToggles();
initInstructorsSwiper();
showNumberBtn();
changeTheme();
