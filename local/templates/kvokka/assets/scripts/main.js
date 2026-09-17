document.addEventListener('DOMContentLoaded', function () {
  // modal -->
  document.body.addEventListener('click', function (event) {
    // найти ближайший триггер по data-атрибутам (сам элемент или его предок)
    const trigger = event.target.closest('[data-modal-open], [data-modal-close]');
    if (!trigger) return;

    const { dataset = {} } = trigger;
    const idModal = dataset.modalOpen ?? dataset.modalClose;
    const elModal = document.querySelector(`[data-modal-id="${idModal}"]`);

    if (!elModal) return;

    // проверка: открытие
    if (dataset.modalOpen) {
      elModal.dataset.active = 'true';

      // включаем scroll-lock ТОЛЬКО если триггер не запрещает его
      if (scrollLock && dataset.modalScrollLock !== 'false') {
        scrollLock.disablePageScroll();
      }
    }

    // проверка: закрытие
    if (dataset.modalClose) {
      elModal.dataset.active = 'false';

      if (scrollLock) {
        scrollLock.clearQueueScrollLocks();
        scrollLock.enablePageScroll();
      }
    }
  });

  // <-- modal

  // header -->
  function initMobileMenuToggle() {
    const toggleBtn = document.getElementById('menuToggle');
    const bottomBlock = document.querySelector('.header__bottom-block');
    const svgIcon = toggleBtn?.querySelector('.header__options-button-svg use');
    const leftMenu = document.getElementById('leftMenu');
    const leftMenuIcon = document.querySelector('.header__select-btn-img use');

    if (!toggleBtn || !bottomBlock || !svgIcon) return;

    toggleBtn.addEventListener('click', () => {
      const isOpen = bottomBlock.classList.toggle('open');
      svgIcon.setAttribute('href', isOpen ? '#icon-cancel' : '#icon-menu');

      // Если меню закрывается, закрываем левое меню тоже
      if (!isOpen && leftMenu?.classList.contains('open')) {
        leftMenu.classList.remove('open');
        leftMenuIcon?.setAttribute('href', '#icon-menu');
      }
    });
  }

  function initLeftMenuToggle() {
    const toggleHolder = document.querySelector('.header__select-btn-holder');
    const toggleBtn = document.querySelector('.header__select-btn');
    const menu = document.getElementById('leftMenu');
    const svgIcon = document.querySelector('.header__select-btn-img use');

    if (!toggleBtn || !menu || !svgIcon) return;

    toggleBtn.addEventListener('click', () => {
      const isMenuOpen = menu.classList.toggle('open');

      toggleHolder.classList.toggle('open')

      const isMobile = document.documentElement.scrollWidth < 768

      if (isMobile) {
        if (isMenuOpen) {
          scrollLock.disablePageScroll();
        } else {
          scrollLock.clearQueueScrollLocks();
          scrollLock.enablePageScroll();
        }
      }

      svgIcon.setAttribute('href', isMenuOpen ? '#icon-cancel' : '#icon-menu');
    });

    const items = document.querySelectorAll('.left-menu [data-section-id]')
    items.forEach((el) => {
      const id = el.getAttribute('data-section-id')
      el.addEventListener('click', function () {
        BX.ajax.runAction('kvokka:tools.controller.user.section', {
          data: {
            id
          }
        }).then(function (response) {
          window.location.reload();
        }, function (response) {
          console.log(response)
        });
      })
    })

    const logo = document.querySelector('.header__logo-holder');
    if (logo) {
      logo.addEventListener('click', function (e) {
        e.preventDefault();
        BX.ajax.runAction('kvokka:tools.controller.user.section', {
          data: {
            id: 0
          }
        }).then(function (response) {
          window.location.href = '/';
        }, function (response) {
          console.log(response)
        });
      })
    }
  }

  function initLeftMenuDropdowns() {
    document.querySelectorAll('.left-menu__expand-primary-list-btn').forEach((btn) => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        const parentLi = btn.closest('li');
        const dropdown = parentLi && parentLi.querySelector('.left-menu__secondary-list, .left-menu__tertiary-list');
        if (dropdown) {
          const isSecondary = dropdown.classList.contains('left-menu__secondary-list');
          dropdown.classList.toggle('open');
          btn.classList.toggle('active');
          const svgIcon = btn.querySelector('.left-menu__expand-svg');
          if (svgIcon) {
            if (dropdown.classList.contains('open')) {
              svgIcon.classList.add('svg-rotated');
            } else {
              svgIcon.classList.remove('svg-rotated');
            }
          }
          // Добавляем/убираем класс для расширения li при открытии вторичного списка
          if (isSecondary) {
            if (dropdown.classList.contains('open')) {
              parentLi.classList.add('left-menu__option-holder--expanded');
            } else {
              parentLi.classList.remove('left-menu__option-holder--expanded');
            }
          }
        }
      });
    });
  }

  function initScrollPageEvent() {
    let currentScroll = 0
    let safeOffset = 100

    const header = document.querySelector('.header')

    document.addEventListener('scroll', function (e) {
      const scrollTop = window.pageYOffset

      if (scrollTop > safeOffset) {
        if (scrollTop > currentScroll && !header.classList.contains("--header-swip")) {
          header.classList.add('--header-swip')
        }

        if (scrollTop < currentScroll && header.classList.contains("--header-swip")) {
          header.classList.remove('--header-swip')
        }
      }

      currentScroll = scrollTop
    })
  }

  function initNavSection() {
    const items = document.querySelectorAll('[data-root-section-id]')
    items.forEach((el) => {
      const id = el.getAttribute('data-root-section-id')
      const href = el.getAttribute('data-href')

      el.addEventListener('click', function (event) {
        event.preventDefault();
        BX.ajax.runAction('kvokka:tools.controller.user.section', {
          data: {
            id
          }
        }).then(function (response) {
          window.location.href = href
        }, function (response) {
          console.log(response)
        });
      })
    })
  }

  initMobileMenuToggle();
  initLeftMenuToggle();
  initLeftMenuDropdowns();
  initScrollPageEvent();
  initNavSection();

  // <-- header

  // copy-to-clipboard -->
  function enableCopyToClipboardByDataAttr() {
    const elements = document.querySelectorAll('[data-copy]');

    elements.forEach((el) => {
      //el.style.cursor = 'pointer';
      el.title = 'Скопировать';

      el.addEventListener('click', async (e) => {
        e.stopPropagation();
        e.preventDefault();
        try {
          const text = el.textContent.trim();
          await navigator.clipboard.writeText(text);

          const originalFilter = el.style.filter;
          el.style.filter = 'brightness(0.7)';
          setTimeout(() => {
            el.style.filter = originalFilter || '';
          }, 600);
        } catch (err) {
          console.error('Ошибка копирования:', err);
        }
      });
    });
  }
  enableCopyToClipboardByDataAttr();

  // <-- copy-to-clipboard

  // dropdown -->
  function initDropdown() {
    const toggleButtons = document.querySelectorAll('.dropdown-open-button');
    const md = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--md').trim(), 10);

    toggleButtons.forEach((button) => {
      const dropdownHolder = button.closest('.dropdown-holder');
      const dropdown = dropdownHolder.querySelector('.dropdown');
      const svgUse = button.querySelector('svg use');

      const setIcon = (icon) => {
        svgUse?.setAttribute('href', `#${icon}`);
      };

      // механики при мобилке
      if (window.innerWidth <= md) {
        const dragBtn = dropdown.querySelector('.dropdown__mob-dragger');
        dragBtn.addEventListener('swiped-down', () => {
          if (dropdown.classList.contains('dropdown--open')) {
            dropdown.classList.add('dropdown--closing');
            document.body.classList.remove('no-scroll');

            dropdown.addEventListener(
              'transitionend',
              () => {
                dropdown.classList.remove('dropdown--open', 'dropdown--closing');
                setIcon('icon-arrow-down');
                button.classList.remove('active');
              },
              { once: true }
            );
          }
        });
      }

      button.addEventListener('click', () => {
        const isOpen = dropdown.classList.contains('dropdown--open');

        // закрываем все открытые дропдауны и убираем active с их кнопок
        document.querySelectorAll('.dropdown.dropdown--open').forEach((openDropdown) => {
          openDropdown.classList.remove('dropdown--open');
        });
        document.querySelectorAll('.dropdown-open-button.active').forEach((btn) => {
          btn.classList.remove('active');
        });
        document.querySelectorAll('.dropdown-open-button svg use').forEach((use) => use.setAttribute('href', '#icon-arrow-down'));

        if (!isOpen) {
          dropdown.classList.add('dropdown--open');
          button.classList.add('active');
          setIcon('icon-cancel');
          if (window.innerWidth <= md) {
            document.body.classList.add('no-scroll');
          }
        } else {
          button.classList.remove('active');
          setIcon('icon-arrow-down');
          document.body.classList.remove('no-scroll');
        }
      });

      document.addEventListener('click', (event) => {
        if (!dropdown.contains(event.target) && !button.contains(event.target)) {
          if (dropdown.classList.contains('dropdown--open')) {
            dropdown.classList.remove('dropdown--open');
            button.classList.remove('active');
            setIcon('icon-arrow-down');
            document.body.classList.remove('no-scroll');
          }
        }
      });
    });
  }

  initDropdown();

  // <-- dropdown

  // up page -->

  function initToUpPage() {

    const uppPage = document.querySelector('.upp-page')

    document.addEventListener('scroll', function (e) {
      const scrollTop = window.pageYOffset

      if (scrollTop > 200 && !uppPage.classList.contains('upp-page--show')) {
        uppPage.classList.add('upp-page--show')
      }

      if (scrollTop < 200 && uppPage.classList.contains('upp-page--show')) {
        uppPage.classList.remove('upp-page--show')
      }
    })

    document.dispatchEvent(new Event("scroll"));

    uppPage.addEventListener('click', function () {
      window.scrollTo(0, 0)
    })
  }

  initToUpPage()

  // <-- up page
});
