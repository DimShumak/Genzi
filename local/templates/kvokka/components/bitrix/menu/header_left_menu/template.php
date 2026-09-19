<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Kvokka\Tools\Service\App;

?>

<button class="header__select-btn f-row g-8 align-center text-l weight-xxl">
            <span class="header__select-btn-text"><?
            if(App::getInstance()->getActiveTypeName() == 'Спорт' || App::getInstance()->getActiveTypeName()=='Экстрим' || App::getInstance()->getActiveTypeName() == '') {
                echo 'ВЫБРАТЬ СПОРТ';
            }
            else{
                echo App::getInstance()->getActiveTypeName();
            }
            ?></span>
            <svg class="header__select-btn-img" width="20" height="20">
              <use href="#icon-menu"></use>
            </svg>
          </button>
          <aside aria-label="Главное меню" class="left-menu left-menu--props" data-scroll-lock-scrollable id="leftMenu">
            <nav aria-label="Выпадающее меню" class="left-menu__nav">
              <ul class="left-menu__ul f-col g-4">
                <?
                $previousLevel = 1; 
                $isFirstItem = true;
            
            foreach ($arResult as $item) {
                $currentLevel = $item['DEPTH_LEVEL'];
                
                if ($currentLevel == 1) {
                    continue;
                }
                
                $hasChildren = $item['IS_PARENT'];
                $icon = !empty($item['PARAMS']['UF_USE_ICON']) ? $item['PARAMS']['UF_USE_ICON'] : '';
                
                if ($currentLevel < $previousLevel) {
                    echo str_repeat('</ul></li>', $previousLevel - $currentLevel);
                }
                
                if ($currentLevel > $previousLevel && $previousLevel > 1) {
                    echo '<ul class="';
                    switch ($currentLevel) {
                        case 3: echo 'left-menu__secondary-list f-col g-4'; break;
                        case 4: echo 'left-menu__tertiary-list f-col g-4'; break;
                        default: echo 'left-menu__sub-list f-col g-4';
                    }
                    echo '">';
                }
                ?>
                
                <li class="
                    <?
                    switch ($currentLevel) {
                        case 2: echo 'left-menu__option-holder f-col g-4 align-center'; break;
                        case 3: echo 'left-menu__secondary-option-holder f-col g-8 align-center'; break;
                        case 4: echo 'left-menu__tertiary-option-holder f-row align-center'; break;
                        default: echo 'left-menu__option-holder f-row align-center';
                    }
                    ?>
                ">
                    <div class="left-menu__list-content-holder f-row g-12">
                        <div class="f-row <? echo $currentLevel == 2 ? 'g-12' : ''; ?> align-center" data-section-id="<? echo trim($item['LINK'], '/'); ?>">
                            <? if (!empty($icon) && $currentLevel == 2): ?>
                                <svg class="left-menu__options-svg" width="20" height="20">
                                    <use href="<?echo $icon; ?>"></use>
                                </svg>
                            <? endif; ?>
                            
                            <span class="
                                <? 
                                switch ($currentLevel) {
                                    case 2: echo 'weight-l text-sm'; break;
                                    case 3: echo 'weight-l text-xsm'; break;
                                    default: echo 'text-xsm';
                                }
                                ?>
                            ">
                                <? echo $item['TEXT']; ?>
                            </span>
                        </div>
                        
                        <? if ($hasChildren): ?>
                            <button class="left-menu__expand-primary-list-btn">
                                <svg class="left-menu__expand-svg" width="20" height="20">
                                    <use href="#icon-arrow-down"></use>
                                </svg>
                            </button>
                        <? endif; ?>
                    </div>
                    
                    <? if (!$hasChildren): ?>
                        </li>
                    <? endif; ?>
                
                <?
                $previousLevel = $currentLevel;
                $isFirstItem = false;
            }
            
            if ($previousLevel > 2) {
                echo str_repeat('</ul></li>', $previousLevel - 2);
            } elseif ($previousLevel == 2) {
                echo '</li>';
            }
            ?>
              </ul>
            </nav>
          </aside>

