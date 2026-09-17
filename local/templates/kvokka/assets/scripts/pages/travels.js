function changeTheme() {
  const body = document.body;
  body.classList.add('green-theme');
}
function getCssVar(name) {
  // prettier-ignore
  return parseInt(getComputedStyle(document.documentElement).getPropertyValue(name).trim(), 10);
}

// function initTravelsSwiper() {
//   const md = getCssVar('--md');
//   const xl = getCssVar('--xl');

//   new Swiper('.travels__swiper .swiper', {
//     slidesPerView: 1,
//     grid: {
//       rows: 2,
//       fill: 'row'
//     },
//     spaceBetween: 32,
//     breakpoints: {
//       [md]: {
//         slidesPerView: 2,
//         grid: {
//           rows: 2,
//           fill: 'row'
//         }
//       },
//       [xl]: {
//         slidesPerView: 3,
//         spaceBetween: 20,
//         grid: {
//           rows: 1,
//           fill: 'row'
//         }
//       }
//     }
//   });
// }

// initTravelsSwiper();
changeTheme();
