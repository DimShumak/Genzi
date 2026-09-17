<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

if ($_REQUEST['AJAX'] === 'Y') {
    $APPLICATION->RestartBuffer();

    $currentDateOnly = (new DateTime())->format('Y-m-d');
    $selectedDate = $_GET['date'] ?? '';

    foreach($arResult['ITEMS'] as $arItem){
        $dateEvents = new DateTime($arItem['PROPERTIES']['DATE']['VALUE']);
        $dateEventsOnly = $dateEvents->format('Y-m-d');
        if($dateEventsOnly < $currentDateOnly) {
            continue;
        }
        if($selectedDate && $dateEventsOnly !== $selectedDate) {
            continue;
        }
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="events__block f-col g-16" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
          <div class="events__img-holder">
            <picture>
              <source srcset="<?=$arItem['PREVIEW_PICTURE']['webp_src']?>" type="image/webp">
              <img src="<?=$arItem['PREVIEW_PICTURE']['src']?>" alt="<?=$arItem['NAME']?>" loading="lazy">
            </picture>
          </div>
          <div class="events__content-holder f-col g-12">
            <h2 class="events__title text-xl weight-xl"><?=$arItem['NAME']?></h2>
            <div class="events__tags f-row g-8">
            <?if($arItem['PROPERTIES']['TIME']['VALUE']) {?>
              <span class="events__tag tag light"><?=FormatDate("j F Y", MakeTimeStamp($arItem['PROPERTIES']['DATE']['VALUE']))?> • <?=$arItem['PROPERTIES']['TIME']['VALUE']?></span>
            <?} else { ?>
              <span class="events__tag tag light"><?=FormatDate("j F Y", MakeTimeStamp($arItem['PROPERTIES']['DATE']['VALUE']))?></span>
            <?}?>
              <span class="events__tag tag light"><?$firstItem = reset($arItem['DISPLAY_PROPERTIES']['TYPE']['LINK_SECTION_VALUE']);
            echo $firstItem['NAME'];?></span>
            </div>
          </div>
        </a>
    <?}
    die();
}

if ($arResult['ITEMS']){
    $dates = [];
    $currentDate = new DateTime();
    $daysOfWeek = ['ВС', 'ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ'];
    $months = [
        1 => 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
        'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
    ];

    $res = CIBlockElement::GetList(
      array("ACTIVE_FROM" => "DESC"),
      array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y"),
      false,
      false,
      array("ID", "ACTIVE_FROM", "PROPERTY_DATE")
  );
  
  $arFields = [];
  while ($ob = $res->fetch()) {
      $arFields[] = $ob['PROPERTY_DATE_VALUE'];
  }

  for ($i = 0; $i < 32; $i++) {
      $date = clone $currentDate;
      $date->modify("+$i days");
      
      $dayOfWeek = $daysOfWeek[$date->format('w')];
      $dayNumber = $date->format('j');
      $month = $months[$date->format('n')];
      $isToday = ($i === 0);
      $isAvailable = 0;
      foreach ($arFields as $arItem) {
        if ($arItem == $date->format('d.m.Y')) {
          $isAvailable = 1;
          break;
        }
      }

      $dateStr = $date->format('Y-m-d');
      $getDate = filter_input(INPUT_GET, 'date', FILTER_DEFAULT) ?: '';
      $isSelected = $getDate === $dateStr;

      $dates[] = [
          'day_of_week' => $dayOfWeek,
          'day_number' => $dayNumber,
          'month' => $month,
          'is_today' => $isToday,
          'is_available' => $isAvailable,
          'date' => $date->format('Y-m-d'),
          'is_selected' => $isSelected
      ];
  }
  ?>
	<div class="events__page f-col">
          <h1 class="events__title page-title">События</h1>

          <div class="events__main f-col">
            <div class="events__calendar-swiper-holder">
              <div class="events__calendar-swiper f-row">
                <button class="swiper-button-prev secondary-button">
                  <svg width="20" height="20">
                    <use href="#icon-arrow-left"></use>
                  </svg>
                </button>
                <div class="swiper">
                  <div class="swiper-wrapper">
                    <?foreach($dates as $date) {?>
                      <div class="swiper-slide">
                        <div class="events__calendar-card f-col g-4 j-center
                        <?= $date['is_available'] ? 'events__calendar-card--available' : '' ?> <?= $date['is_selected'] ? 'events__calendar-card--selected' : '' ?>"
                        data-date="<?=$date['date']?>"
                        data-month="<?if($date['day_number'] == 1 || $date['is_today']){ echo $date['month'];}?>">
                          <span class="events__calendar-card-text text-sm">
                                <?= $date['day_of_week'] ?>
                          </span>
                              
                          <div class="events__calendar-card-day-holder f-row j-center align-center">
                              <span class="events__calendar-card-day weight-xl">
                                  <?= $date['day_number'] ?>
                              </span>
                          </div>
                        </div>
                      </div><?
                }?>

                  </div>
                </div>

                <button class="swiper-button-next secondary-button">
                  <svg width="20" height="20">
                    <use href="#icon-arrow-right"></use>
                  </svg>
                </button>
              </div>
            </div>

            <div class="events__grid">
					<?$currentDateOnly = $currentDate->format('Y-m-d');
          $selectedDate = $_GET['date'] ?? '';
          foreach($arResult['ITEMS'] as $arItem){
                $dateEvents = new DateTime($arItem['PROPERTIES']['DATE']['VALUE']);
                $dateEventsOnly = $dateEvents->format('Y-m-d');
                if($dateEventsOnly < $currentDateOnly) {
                  continue;
                }
                if($selectedDate && $dateEventsOnly !== $selectedDate) {
                  continue;
                }
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="events__block f-col g-16" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                      <div class="events__img-holder">
					  <picture>
						<source srcset="<?=$arItem['PREVIEW_PICTURE']['webp_src']?>" type="image/webp">
						<img src="<?=$arItem['PREVIEW_PICTURE']['src']?>" 
							 alt="<?=$arItem['NAME']?>" 
							 loading="lazy"
							 width="600"
							 height="400">
					  </picture>
					</div>
                      <div class="events__content-holder f-col g-12">
                        <h2 class="events__title text-xl weight-xl"><?=$arItem['NAME']?></h2>
                        <div class="events__tags f-row g-8">
						<?if($arItem['PROPERTIES']['TIME']['VALUE']) {?>
                          <span class="events__tag tag light"><?=FormatDate("j F Y", MakeTimeStamp($arItem['PROPERTIES']['DATE']['VALUE']))?> • <?=$arItem['PROPERTIES']['TIME']['VALUE']?></span>
						  <?}
						  else {
							?><span class="events__tag tag light"><?=FormatDate("j F Y", MakeTimeStamp($arItem['PROPERTIES']['DATE']['VALUE']))?></span><?
						  }?>
                          <span class="events__tag tag light"><?$firstItem = reset($arItem['DISPLAY_PROPERTIES']['TYPE']['LINK_SECTION_VALUE']);
						echo $firstItem['NAME'];?></span>

                        </div>
                      </div>
                    </a>
				  <?}?>
            </div>
          </div>
        </div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<?}
else {
	?><h1>Событий нет</h1><?
}
?>
<?
use Kvokka\Tools\Service\Util;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */


foreach ($arResult['ITEMS'] as &$arItem) {
    $arItem['DETAIL_PAGE_URL'] = \Kvokka\Tools\Service\Element::getInstance()->makeUrlToElement(
        $arItem,
        $arResult['DETAIL_PAGE_URL']
    );

    $arItem['PREVIEW_PICTURE'] = \CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 800, 'height' => 800), BX_RESIZE_IMAGE_EXACT, true);
    $arItem['PREVIEW_PICTURE']['webp_src'] = Util::getInstance()->makeWebp($arItem['PREVIEW_PICTURE']['src']);
}
?>
<script>
let selectedDate = null;

function resetCalendarStyles() {
    document.querySelectorAll('.events__calendar-card--available').forEach(card => {
        card.style.backgroundColor = '';
        card.style.color = '';
    });
}

function highlightSelectedDate(date) {
    resetCalendarStyles(); 
    if (date) {
        const card = document.querySelector(`.events__calendar-card[data-date="${date}"]`);
        if (card) {
            card.style.backgroundColor = '#50c06d';
            card.style.color = 'white';
        }
    }
}

function initSwiper() {
    const swiperContainer = document.querySelector('.events__calendar-swiper .swiper');
    if (!swiperContainer || !window.Swiper) return;

    if (swiperContainer.swiper) {
        swiperContainer.swiper.destroy(true, true);
        swiperContainer.swiper = null;
    }

    const prevButton = document.querySelector('.events__calendar-swiper .swiper-button-prev');
    const nextButton = document.querySelector('.events__calendar-swiper .swiper-button-next');

    if (prevButton) prevButton.style.display = 'none';
    if (nextButton) nextButton.style.display = 'none';

    const swiper = new Swiper(swiperContainer, {
        slidesPerView: 'auto',
        spaceBetween: 8,
        freeMode: true,
        navigation: {
            nextEl: '.events__calendar-swiper .swiper-button-next',
            prevEl: '.events__calendar-swiper .swiper-button-prev',
        },
        on: {
            init: function () {
                updateButtonVisibility(this);
            },
            slideChange: function () {
                updateButtonVisibility(this);
            }
        }
    });

    swiperContainer.swiper = swiper;

    function updateButtonVisibility(swiper) {
        if (prevButton) {
            prevButton.style.display = swiper.isBeginning ? 'none' : 'flex';
        }

        if (nextButton) {
            nextButton.style.display = swiper.isEnd ? 'none' : 'flex';
        }
    }

    if (prevButton) {
        prevButton.onclick = (e) => {
            e.preventDefault();
            swiper.slideTo(0); 
        };
    }

    if (nextButton) {
        nextButton.onclick = (e) => {
            e.preventDefault();
            swiper.slideTo(swiper.slides.length - 1); 
        };
    }
}

function updateEvents(date = null) {
    selectedDate = date;

    const grid = document.querySelector('.events__grid');
    if (!grid) return;

    // Сохраняем текущую позицию скролла страницы
    const scrollY = window.scrollY;

    grid.innerHTML = '<div class="loading">Загрузка...</div>';

    let url = window.location.pathname;
    const urlParams = new URLSearchParams(window.location.search);

    if (date) {
        urlParams.set('date', date);
    } else {
        urlParams.delete('date');
    }

    url += '?' + urlParams.toString() + '&AJAX=Y';

    fetch(url)
        .then(response => response.text())
        .then(html => {
            grid.innerHTML = html;
            highlightSelectedDate(date);
            window.scrollTo(0, scrollY);
            history.replaceState(null, '', urlParams.toString() ? '?' + urlParams.toString() : location.pathname);
        })
        .catch(error => {
            console.error('Ошибка загрузки событий:', error);
            grid.innerHTML = '<p>Ошибка загрузки событий.</p>';
            window.scrollTo(0, scrollY); // на случай ошибки тоже
        });
}

function getCurrentDateFromUrl() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('date');
}

document.addEventListener('click', function(e) {
    const card = e.target.closest('.events__calendar-card--available');
    if (!card) return;

    e.preventDefault(); 

    const clickedDate = card.getAttribute('data-date');
    const currentDate = getCurrentDateFromUrl(); 

    if (currentDate === clickedDate) {
        updateEvents(null);
    } else {
        updateEvents(clickedDate);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const initialDate = getCurrentDateFromUrl();
    selectedDate = initialDate; 
    highlightSelectedDate(initialDate);
    initSwiper();
});

window.addEventListener('pageshow', function() {
    const initialDate = getCurrentDateFromUrl();
    selectedDate = initialDate;
    highlightSelectedDate(initialDate);
    initSwiper();
});
</script>