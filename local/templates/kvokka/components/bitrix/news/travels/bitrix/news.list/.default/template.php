<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//dd($arResult['ITEMS']);
$selectedMonths = filter_input(INPUT_GET, 'months');
$selectedYear = filter_input(INPUT_GET, 'year') ?: date('Y');
$currentMonth = date('n');
$currentYear = date('Y');
$monthsRu = [
  1 => 'Январь',
  2 => 'Февраль',
  3 => 'Март',
  4 => 'Апрель',
  5 => 'Май',
  6 => 'Июнь',
  7 => 'Июль',
  8 => 'Август',
  9 => 'Сентябрь',
  10 => 'Октябрь',
  11 => 'Ноябрь',
  12 => 'Декабрь'
];
$calendar = [];
for ($i = 0; $i < 6; $i++) {
  $monthIndex = ($currentMonth + $i - 1) % 12 + 1;
  $year = $currentYear + floor(($currentMonth + $i - 1) / 12);
  $calendar[] = [
    'month' => $monthsRu[$monthIndex],
    'month_num' => $monthIndex,
    'year' => $year
  ];
}
//dd($calendar);
$count = count($calendar);
?>

<?php if (!defined('NO_LAYOUT')): ?>
  <div class="travels__page f-col">
    <h1 class="travels__title page-title">Путешествия</h1>

    <div class="travels__main f-col">
      <div class="travels__form-holder f-row">
        <form id="filterForm" class="travels__form f-col g-20">
          <div class="travels__form-dates-block f-row g-2">
            <? $isFirst = true;
            $i = 0;
            $currentParams = filter_input_array(INPUT_GET);
            if ($currentParams) {
              unset($currentParams['months']);
            }
            //dd($currentParams);
            foreach ($calendar as $item) {
              $arItem = $item['month'];
              $monthNum = $item['month_num'];
              $buttonYear = $item['year'];
              $monthKey = $buttonYear . '-' . $monthNum;

              $monthKey = $buttonYear . '-' . $monthNum;

              $isActive = $selectedMonths === $monthKey;

              $newSelectedMonthsStr = $isActive ? '' : $monthKey;
              if ($currentParams) {
                $href = "?" . http_build_query($currentParams) . "&months=" . urlencode($newSelectedMonthsStr);
              } else {
                $href = "?months=" . urlencode($newSelectedMonthsStr);
              }

              $activeClass = $isActive ? ' active' : '';

              if ($isFirst) { ?>
                <div class="travels__dates-block f-row align-center">
                  <span class="travels__dates-label color-grey60"><?= $buttonYear ?></span>
                <? $isFirst = false;
              } elseif (!$isFirst && $monthNum == 1) { ?>

                  <div class="travels__dates-block f-row align-center">
                    <span class="travels__dates-label color-grey60"><?= $buttonYear ?></span>
                  <? } ?>

                  <button
                    type="button"
                    class="travels__dates-element color-grey50<?= $activeClass ?>"
                    data-month="<?= $monthNum ?>"
                    data-year="<?= $buttonYear ?>"
                    data-key="<?= $monthKey ?>">
                    <?= $arItem ?>
                  </button>

                  <? if ($i === $count || $monthNum == 12) { ?>
                  </div>
              <? }
                  $i++;
                } ?>
                </div>
          </div>
          <div class="travels__form-properties-block f-row g-2">
            <? foreach ($arResult['FILTER_SET'] as $arKey => $arFilter) {
              if ($arFilter['TYPE'] == 'LIST') { ?>
                <div class="travels__form-dropdown-holder dropdown-holder">
                  <button type="button" class="travels__form-label-button dropdown-open-button dropdown-button f-row align-center">
                    <span class="travels__form-btn-text"><?= $arFilter['NAME'] ?></span>
                    <svg class="travels__form-svg" width="20" height="20">
                      <use href="#icon-arrow-down"></use>
                    </svg>
                  </button>
                  <!-- prettier-ignore -->
                  <div class="dropdown dropdown--props">
                    <div class="dropdown__options-holder f-col g-12">
                      <button type="button" class="dropdown__mob-dragger show-on-mob"></button>
                      <h3 class="dropdown__title show-on-mob"><?= $arFilter['NAME'] ?></h3>
                      <? foreach ($arFilter['LIST'] as $arItem) { ?>
                        <label class="dropdown__option f-row g-12 j-between align-center" for="<?= $arItem['VALUE'] ?>">
                          <span class="dropdown__options-label"><?= $arItem['LABEL'] ?></span>
                          <label class="dropdown__custom-checkbox">
                            <input type="checkbox" id="<?= $arItem['VALUE'] ?>" name="<?= $arKey ?>[]" value="<?= $arItem['VALUE'] ?>" class="dropdown__custom-checkbox--input"
                              <?= $arItem['IS_CHECKED'] ? 'checked' : '' ?>>
                            <span class="dropdown__custom-checkbox--box">
                              <svg class="dropdown__custom-checkbox--check" width="16" height="16">
                                <use href="#icon-tick"></use>
                              </svg>
                            </span>
                          </label>
                        </label>
                      <? } ?>

                      <div class="dropdown__buttons-holder f-col g-8">
                        <button type="submit" name="apply_filter" class="dropdown__btn base-button">ПРИМЕНИТЬ</button>
                        <button type="button" onclick="clearFilter('<?= $arFilter['CODE'] ?>')" class="dropdown__btn secondary-button">ОЧИСТИТЬ</button>
                      </div>
                    </div>
                  </div>
                </div>
              <? } else { ?>
                <div class="travels__form-dropdown-holder dropdown-holder">
                  <button type="button" class="travels__form-label-button dropdown-open-button dropdown-button f-row align-center">
                    <span class="travels__form-btn-text"><?= $arFilter['NAME'] ?></span>
                  </button>
                  <!-- prettier-ignore -->
                  <div class="dropdown dropdown--props">
                    <div class="dropdown__options-holder f-col g-12">
                      <button type="button" class="dropdown__mob-dragger show-on-mob"></button>
                      <h3 class="dropdown__title show-on-mob"><?= $arFilter['NAME'] ?></h3>
                      <div class="input-wrapper">
                        <input placeholder="От" value="<?= $arFilter['IS_CHECKED_FROM'] ? $arFilter['IS_CHECKED_FROM'] : '' ?>" class="<?= $arFilter['IS_CHECKED_FROM'] ? "--active" : '' ?>" type="number" name="<?= $arFilter['CODE'] ?>_FROM">
                      </div>
                      <div class="input-wrapper">
                        <input placeholder="До" value="<?= $arFilter['IS_CHECKED_UP'] ? $arFilter['IS_CHECKED_UP'] : '' ?>" class="<?= $arFilter['IS_CHECKED_UP'] ? "--active" : '' ?>" type="number" name="<?= $arFilter['CODE'] ?>_UP">
                      </div>

                      <div class="dropdown__buttons-holder f-col g-8">
                        <button type="submit" name="apply_filter" class="dropdown__btn base-button">ПРИМЕНИТЬ</button>
                        <button type="button" onclick="clearFilterNotList('<?= $arFilter['CODE'] ?>')" class="dropdown__btn secondary-button">ОЧИСТИТЬ</button>
                      </div>
                    </div>
                  </div>
                </div>
            <?
              }
            } ?>

          </div>
        </form>
      </div>
    <?php endif; ?>

    <? if ($arResult['ITEMS']) { ?>
      <div class="events__grid">
        <? $currentDate = new DateTime();
        $currentDateOnly = $currentDate->format('Y-m-d');
        foreach ($arResult['ITEMS'] as $arItem) {
          $dateEvents = new DateTime($arItem['PROPERTIES']['DATE_DEPARTURE']['VALUE']);
          $dateEventsOnly = $dateEvents->format('Y-m-d');
          if ($dateEventsOnly < $currentDateOnly) {
            continue;
          }
          $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
          $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
          <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="travels__swiper-block f-col g-16" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="travels__swiper-img-holder">
              <picture>
                <source srcset="<?= $arItem['PREVIEW_PICTURE']['webp_src'] ?>" type="image/webp">
                <img src="<?= $arItem['PREVIEW_PICTURE']['src'] ?>"
                  alt="<?= $arItem['NAME'] ?>"
                  loading="lazy"
                  width="600"
                  height="400"
                  decoding="async">
              </picture>
            </div>
            <div class="travels__slide-content-holder f-col g-12">
              <h2 class="travels__slide-title weight-l"><?= $arItem['NAME'] ?></h2>

              <div class="travels__slide-difficulty f-row g-16 align-center">
                <div class="travels__slide-icon-holder">
                  <picture>
                    <source srcset="<?= $arItem['PROPERTIES']['DIFFICULT']['ICON']['webp_src'] ?>" type="image/webp">
                    <img class="travels__slide-icon"
                      src="<?= $arItem['PROPERTIES']['DIFFICULT']['ICON']['src'] ?>"
                      alt="Иконка сложности <?= $arItem['DISPLAY_PROPERTIES']['DIFFICULT']['DISPLAY_VALUE'] ?>"
                      width="16"
                      height="16">
                  </picture>
                </div>
                <span class="travels__slide-difficulty-text color-<?= $arItem['PROPERTIES']['DIFFICULT']['LINK'] ?>">
                  <?= $arItem['DISPLAY_PROPERTIES']['DIFFICULT']['DISPLAY_VALUE'] ?>
                </span>
              </div>

              <? if ($arItem['PROPERTIES']['DATE_DEPARTURE']['VALUE']) { ?>
                <div class="travels__slide-tags f-row g-8">
                  <span class="travels__slide-tag tag light weight-m text-xs">
                    <b><?=FormatDate("j F", MakeTimeStamp($arItem['PROPERTIES']['DATE_DEPARTURE']['VALUE']))?></b>

                  </span>
                </div>
              <? } ?>

              <div class="travels__slide-tags f-row g-8">
                <span class="travels__slide-tag tag light weight-m text-xsm">
                  <?= $arItem['DISPLAY_PROPERTIES']['TYPE_TRAVELS']['DISPLAY_VALUE'] ?>
                </span>
                <span class="travels__slide-tag tag light weight-m text-xsm">
                  <?= $arItem['DISPLAY_PROPERTIES']['HABITATION']['DISPLAY_VALUE'] ?>
                </span>
              </div>

              <div class="travels__slide-price-holder f-row">
                <span class="travels__slide-price weight-l"><?= $arItem['PROPERTIES']['PRICE']['VALUE'] ?> ₽</span>
                <span class="travels__slide-duration color-grey50 text-sm">
                  &nbsp;/ <?= $arItem['PROPERTIES']['DURATION']['VALUE'] ?>
                </span>
              </div>
            </div>
          </a>
        <? } ?>
      </div>
    <? } else { ?>
      <div class="events__grid">
        <div class="travels__no-results">
          <h2>Путешествий не запланировано</h2>
        </div>
      </div>
    <? } ?>

    <?php if (!defined('NO_LAYOUT')): ?>
    </div>
  
  <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
  <? endif; ?>
<?php endif; ?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterForm');
    const eventsGrid = document.querySelector('.events__grid');
    const monthButtons = document.querySelectorAll('.travels__dates-element[data-month]');
    const applyButton = document.querySelector('button[name="apply_filter"]');

    function updateMonthButtons() {
      const currentUrl = new URL(window.location.href);
      const selectedMonthParam = currentUrl.searchParams.get('months');

      monthButtons.forEach(btn => {
        const key = btn.dataset.key;
        if (selectedMonthParam === key) {
          btn.classList.add('active');
        } else {
          btn.classList.remove('active');
        }
      });
    }

    monthButtons.forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();

        const monthKey = this.dataset.key;
        const isActive = this.classList.contains('active');

        monthButtons.forEach(b => b.classList.remove('active'));

        let newMonthKey = '';
        if (!isActive) {
          this.classList.add('active');
          newMonthKey = monthKey;
        }

        const monthsInput = document.querySelector('input[name="months"]');
        if (monthsInput) {
          monthsInput.value = newMonthKey;
        } else {
          let hiddenInput = document.createElement('input');
          hiddenInput.type = 'hidden';
          hiddenInput.name = 'months';
          hiddenInput.value = newMonthKey;
          filterForm.appendChild(hiddenInput);
        }

        const url = new URL(window.location);
        if (newMonthKey) {
          url.searchParams.set('months', newMonthKey);
        } else {
          url.searchParams.delete('months');
        }
        window.history.replaceState(null, '', url);

        submitFilterForm();
      });
    });

    filterForm.addEventListener('submit', function(e) {
      e.preventDefault();

      const formData = new FormData(filterForm);
      const url = new URL(window.location);
      url.search = new URLSearchParams(formData).toString();
      url.searchParams.delete('apply_filter');

      window.history.pushState(null, '', url);

      submitFilterForm();
    });

    function submitFilterForm() {
      const formData = new FormData(filterForm);
      const queryString = new URLSearchParams(formData).toString();

      const url = `${window.location.pathname}?${queryString}`;

      fetch(url, {
          method: 'GET',
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(response => response.text())
        .then(html => {
          const parser = new DOMParser();
          const doc = parser.parseFromString(html, 'text/html');
          const newGrid = doc.querySelector('.events__grid');
          const newPager = doc.querySelector('.bx_pagination');

          if (newGrid) {
            eventsGrid.innerHTML = newGrid.innerHTML;
          }

          const pagerContainer = document.querySelector('.bx_pagination');
          if (pagerContainer && newPager) {
            pagerContainer.innerHTML = newPager.innerHTML;
          } else if (pagerContainer) {
            pagerContainer.innerHTML = '';
          }

          updateMonthButtons();
        })
        .catch(err => console.error('Ошибка фильтрации:', err));
    }

    window.clearFilter = function(code) {
      const checkboxes = document.querySelectorAll(`input[name="${code}[]"]`);
      checkboxes.forEach(chk => chk.checked = false);

      const formData = new FormData(filterForm);
      const url = new URL(window.location);
      url.search = new URLSearchParams(formData).toString();
      url.searchParams.delete('apply_filter');
      window.history.pushState(null, '', url);

      submitFilterForm();
    };

    window.clearFilterNotList = function(code) {
      const from = document.querySelector(`input[name="${code}_FROM"]`);
      const up = document.querySelector(`input[name="${code}_UP"]`);
      if (from) from.value = '';
      if (up) up.value = '';

      const formData = new FormData(filterForm);
      const url = new URL(window.location);
      url.search = new URLSearchParams(formData).toString();
      url.searchParams.delete('apply_filter');
      window.history.pushState(null, '', url);

      submitFilterForm();
    };
  });
</script>