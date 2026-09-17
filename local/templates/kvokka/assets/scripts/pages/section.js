function getCssVar(name) {
  // prettier-ignore
  return parseInt(getComputedStyle(document.documentElement).getPropertyValue(name).trim(), 10);
}

function initGallerySwiper() {
  const md = getCssVar('--md');
  const xl = getCssVar('--xl');

  new Swiper('.section__gallery .swiper', {
    slidesPerView: 'auto',
    spaceBetween: 10,
    navigation: {
      nextEl: '.section__gallery .swiper-button-next',
      prevEl: '.section__gallery .swiper-button-prev'
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

  new Swiper('.section__trainers .swiper', {
    slidesPerView: 'auto',
    spaceBetween: 10,
    loop: true,
    navigation: {
      nextEl: '.section__trainers .swiper-button-next',
      prevEl: '.section__trainers .swiper-button-prev'
    },
    breakpoints: {
      [md]: {
        loop: true,
        slidesPerView: 1
      },
      [xl]: {
        loop: false,
        slidesPerView: 3
      }
    }
  });

  new Swiper('.section__schedule .swiper', {
    slidesPerView: 'auto',
    spaceBetween: 10,
    navigation: {
      nextEl: '.section__schedule .swiper-button-next',
      prevEl: '.section__schedule .swiper-button-prev'
    },
    autoHeight: true,
    breakpoints: {
      [md]: {
        slidesPerView: 'auto'
      },
      [xl]: {
        slidesPerView: 3
      }
    }
  });


  const gallery = document.querySelectorAll('.section__swiper-img-holder')
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
  const buttons = document.querySelectorAll('.section__contact-phone-btn');

  if (!buttons.length) return;

  buttons.forEach(btn => {
    const phoneSpan = btn.closest('.section__contact-block').querySelector('.section__contact-phone-hidden');

    if (!phoneSpan) return;

    const phoneNumber = btn.dataset.phone;

    btn.addEventListener('click', () => {
      if (phoneNumber) {
        phoneSpan.textContent = phoneNumber;
        phoneSpan.classList.remove('color-grey60');
      }
    });
  });
}
function initHideableGrid() {
  const container = document.querySelector('.section__hideable-block-content');
  const btn = document.querySelector('.section__hideable-block-btn');
  if (!container || !btn) return;

  // находим первый элемент карточки
  const firstCard = container.querySelector('.section__price-card');
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
  const mapElement = document.querySelector('.section__map');
  if (!mapElement) return;

  let point = mapElement.getAttribute('data-point');
  if (!point) return;

  point = point.split(',').map((f) => parseFloat(f));
  let pointText;
  try {
    const mapText = document.querySelector('.section__map-info-text');
    pointText = mapText.textContent;
  }

  catch {
    const mapText = document.querySelector('.section__title.page-title');
    pointText = mapText.textContent;
  }

  ymaps.ready(() => {
    const map = new ymaps.Map('section__map', {
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
    // Регистрируем новый тип карты на основе скелетного слоя Яндекса
    var skeletonType = new ymaps.MapType('skeleton', ['yandex#skeleton']);
    ymaps.mapType.storage.add('skeleton#map', skeletonType);
    // Устанавливаем его для карты
    myMap.setType('skeleton#map');
  });
}
initMap();
initHideableGrid();
showNumberBtn();
initGallerySwiper();
