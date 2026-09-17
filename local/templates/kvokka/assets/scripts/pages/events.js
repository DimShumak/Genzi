/*function getCssVar(name) {
  // prettier-ignore
  return parseInt(getComputedStyle(document.documentElement).getPropertyValue(name).trim(), 10);
}

function initEventsSwiper() {
  
  new Swiper('.events__calendar-swiper .swiper', {
    slidesPerView: 'auto',
    slidesPerGroup: 1,
    spaceBetween: 6,
    navigation: {
      nextEl: '.events__calendar-swiper .swiper-button-next',
      prevEl: '.events__calendar-swiper .swiper-button-prev'
    }
  });
}

initEventsSwiper();

const currentUrl = window.location.href;
const buttons = document.querySelectorAll('.events__calendar-card');
const urlParams = new URLSearchParams(window.location.search);
const dateFilter = urlParams.get('date');
const selectedDates = dateFilter ? dateFilter.split(',') : [];

buttons.forEach(button => {
    const buttonDate = button.getAttribute('data-date'); 
   
    if (selectedDates.includes(buttonDate)) {
        button.classList.remove('events__calendar-card--available');
        button.classList.add('events__calendar-card--active');
    }
});
*/