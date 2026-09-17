function getCssVar(name) {
  // prettier-ignore
  return parseInt(getComputedStyle(document.documentElement).getPropertyValue(name).trim(), 10);
}

function initGallerySwiper() {
  const md = getCssVar('--md');
  const xl = getCssVar('--xl');

  new Swiper('.shop__swiper .swiper', {
    slidesPerView: 'auto',
    spaceBetween: 10,
    navigation: {
      nextEl: '.shop__swiper .swiper-button-next',
      prevEl: '.shop__swiper .swiper-button-prev'
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
function showNumberBtn() {
  const btn = document.querySelector('.shop__contact-phone-btn');
  const phoneSpan = document.querySelector('.shop__contact-phone-hidden');

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
  const container = document.querySelector('.shop__hideable-block-content');
  const btn = document.querySelector('.shop__hideable-block-btn');
  if (!container || !btn) return;

  // находим первый элемент карточки
  const firstCard = container.querySelector('.shop__price-card');
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
  const mapElement = document.querySelector('.shop__map');
  if (!mapElement) return;

  let point = mapElement.getAttribute('data-point');
  if (!point) return;

  point = point.split(',').map((f) => parseFloat(f));
  let pointText;
  try{
  const mapText = document.querySelector('.shop__map-info-text');
  pointText = mapText.textContent;
  }
  
  catch{
   const mapText = document.querySelector('.shop__title.page-title');
   pointText = mapText.textContent;
  }


  ymaps.ready(() => {
    const map = new ymaps.Map('shop__map', {
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
