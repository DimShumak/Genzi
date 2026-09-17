function initMap() {
  const mapElement = document.querySelector('.event__map');
  if (!mapElement) return;

  let point = mapElement.getAttribute('data-point');
  if (!point) return;

  point = point.split(',').map((f) => parseFloat(f));
  const mapText = document.querySelector('.event__map-info-text');
  const pointText = mapText.textContent;

  ymaps.ready(() => {
    const map = new ymaps.Map('event__map', {
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
function showNumberBtn() {
  const btn = document.querySelector('.event__contact-phone-btn');
  const phoneSpan = document.querySelector('.event__contact-phone-hidden');

  if (!btn || !phoneSpan) return;

  const phoneNumber = btn.dataset.phone;

  btn.addEventListener('click', () => {
    if (phoneNumber) {
      phoneSpan.textContent = phoneNumber;
      phoneSpan.classList.remove('color-grey60');
    }
  });
}
showNumberBtn();
initMap();
