<?php

/**
 * @var $block array
 * @var $this  SprintEditorBlocksComponent
 */

use Kvokka\Tools\Service\Util;

?>

<?php


$images = Sprint\Editor\Blocks\Gallery::getImages(
    $block,
    [
        'width'  => 120,
        'height' => 120,
        'exact'  => 1,
    ],
    [
        'width'  => 900,
        'height' => 500,
        'exact'  => 1,
    ]
);

$id = md5(serialize($images));

?>

<?php if (!empty($images)) { ?>
    <div class="gallery">
        <div class="gallery__wrapper swiper" id="s_<?= $id ?>">
            <div class="gallery__inner swiper-wrapper">
                <?php foreach ($images as $image) { ?>
                    <div class="gallery__item swiper-slide">
                        <a data-fancybox="g_<?= $id ?>" href="<?= Util::makeWebp($image['ORIGIN_SRC']) ?>">
                            <img alt="<?= $image['DESCRIPTION'] ?>" src="<?= Util::makeWebp($image['DETAIL_SRC']) ?>">
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="swiper-button-prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <mask id="mask0_126_3521" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="40" height="40">
                        <rect width="40" height="40" fill="#D9D9D9" />
                    </mask>
                    <g mask="url(#mask0_126_3521)">
                        <path d="M27.1303 37.2945L9.81201 19.9998L27.1303 2.70508L30.3 5.90254L16.2028 19.9998L30.3 34.097L27.1303 37.2945Z" fill="#6600FF" />
                    </g>
                </svg>
            </div>
            <div class="swiper-button-next">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <mask id="mask0_126_3518" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="40" height="40">
                        <rect width="40" height="40" fill="#D9D9D9" />
                    </mask>
                    <g mask="url(#mask0_126_3518)">
                        <path d="M12.9026 37.2388L9.73291 34.0413L23.8302 19.9441L9.73291 5.84687L12.9026 2.64941L30.1973 19.9441L12.9026 37.2388Z" fill="#6600FF" />
                    </g>
                </svg>
            </div>
        </div>

        <div class="gallery__nav swiper" id="n_<?= $id ?>">
            <div class="gallery__inner swiper-wrapper">
                <?php foreach ($images as $arIndex => $image) { ?>
                    <div class="gallery__item swiper-slide" data-index="<?= $arIndex ?>">
                        <img alt="<?= $image['DESCRIPTION'] ?>" src="<?= Util::makeWebp($image['SRC']) ?>">
                    </div>
                <?php } ?>
            </div>
            <div class="swiper-button-prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <mask id="mask0_126_3521" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="40" height="40">
                        <rect width="40" height="40" fill="#D9D9D9" />
                    </mask>
                    <g mask="url(#mask0_126_3521)">
                        <path d="M27.1303 37.2945L9.81201 19.9998L27.1303 2.70508L30.3 5.90254L16.2028 19.9998L30.3 34.097L27.1303 37.2945Z" fill="#6600FF" />
                    </g>
                </svg>
            </div>
            <div class="swiper-button-next">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <mask id="mask0_126_3518" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="40" height="40">
                        <rect width="40" height="40" fill="#D9D9D9" />
                    </mask>
                    <g mask="url(#mask0_126_3518)">
                        <path d="M12.9026 37.2388L9.73291 34.0413L23.8302 19.9441L9.73291 5.84687L12.9026 2.64941L30.1973 19.9441L12.9026 37.2388Z" fill="#6600FF" />
                    </g>
                </svg>
            </div>
        </div>
    </div>


    <script>
        $(function() {
            const slider = new Swiper('#s_<?= $id ?>', {
                loop: false,
                navigation: {
                    nextEl: '#s_<?= $id ?> .swiper-button-next',
                    prevEl: '#s_<?= $id ?> .swiper-button-prev',
                }
            });

            const thumbnail = new Swiper('#n_<?= $id ?>', {
                loop: false,
                navigation: {
                    nextEl: '#n_<?= $id ?> .swiper-button-next',
                    prevEl: '#n_<?= $id ?> .swiper-button-prev',
                },
                spaceBetween: 10,
                breakpoints: {
                    768: {
                        slidesPerView: 8,

                    },
                    1024: {
                        slidesPerView: 10,
                    },
                },
            });

            slider.on("slideChange", function(swiper) {
                $("#n_<?= $id ?> .swiper-slide.active").removeClass("active");
                $("#n_<?= $id ?> .swiper-slide").eq(slider.realIndex).addClass("active");

                thumbnail.slideTo(slider.realIndex);
            });

            $("body").on("click", "#n_<?= $id ?> .swiper-slide", function() {
                slider.slideTo($(this).attr("data-index"));
            });

            slider.slideTo(1);
            slider.slideTo(0);

            if (window.Fancybox) {
                Fancybox.bind("[data-fancybox]", {});
            }
        })
    </script>
<?php } ?>
