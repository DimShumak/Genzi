function getCssVar(name) {
  // prettier-ignore
  return parseInt(getComputedStyle(document.documentElement).getPropertyValue(name).trim(), 10);
}

function initGallerySwiper() {
  const md = getCssVar('--md');
  const xl = getCssVar('--xl');

  new Swiper('.location__swiper .swiper', {
    slidesPerView: 'auto',
    spaceBetween: 10,
    navigation: {
      nextEl: '.location__swiper .swiper-button-next',
      prevEl: '.location__swiper .swiper-button-prev'
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


  const gallery = document.querySelectorAll('.location__swiper-img-holder')
  gallery.forEach(function (el) {
    el.addEventListener("click", function () {
      const img = document.querySelector(`[data-to="${this.dataset.id}"]`)
      if (img) {
        const event = new CustomEvent('click');
        img.click()
      }
    })
  })
}

function showNumberBtn() {
  const btn = document.querySelector('.location__contact-phone-btn');
  const phoneSpan = document.querySelector('.location__contact-phone-hidden');

  if (!btn || !phoneSpan) return;

  const phoneNumber = btn.dataset.phone;

  btn.addEventListener('click', () => {
    if (phoneNumber) {
      phoneSpan.textContent = phoneNumber;
      phoneSpan.classList.remove('color-grey60');
    }
  });
}

function initHideableGrid() {
  const container = document.querySelector('.location__hideable-block-content');
  const btn = document.querySelector('.location__hideable-block-btn');
  if (!container || !btn) return;

  // находим первый элемент карточки
  const firstCard = container.querySelector('.location__price-card');
  // если карточка есть, берём её высоту, иначе fallback на 210px
  const collapsedHeight = firstCard ? firstCard.offsetHeight : 210;

  let isExpanded = false;

  // Устанавливаем начальное значение
  container.style.maxHeight = collapsedHeight + 'px';

  function toggleBlock() {
    if (!isExpanded) {
      // Открытие
      container.style.maxHeight = container.scrollHeight + 'px';
      btn.textContent = 'Скрыть';
    } else {
      // Закрытие
      container.style.maxHeight = collapsedHeight + 'px';
      btn.textContent = 'Показать ещё';
    }
    isExpanded = !isExpanded;
  }

  btn.addEventListener('click', toggleBlock);
}

function initMap() {
  const mapElement = document.querySelector('.location__map');
  if (!mapElement) return;

  let point = mapElement.getAttribute('data-point');
  if (!point) return;

  point = point.split(',').map((f) => parseFloat(f));

  let pointText;
  try {
    const mapText = document.querySelector('.location__map-info-text');
    pointText = mapText.textContent;
  }

  catch {
    const mapText = document.querySelector('.location__title.page-title');
    pointText = mapText.textContent;
  }

  ymaps.ready(() => {
    const map = new ymaps.Map('location__map', {
      center: point,
      zoom: 13,
      controls: []
    });

    const placemark = new ymaps.Placemark(
      point,
      { hintContent: pointText },
      {
        iconLayout: 'default#image',
        iconImageHref: '/local/templates/kvokka/assets/images/global-images/location-icon.png',
        iconImageSize: [40, 40],
        iconImageOffset: [-20, -40]
      }
    );

    map.geoObjects.add(placemark);
  });
}
initMap();
initHideableGrid();
showNumberBtn();
initGallerySwiper();
