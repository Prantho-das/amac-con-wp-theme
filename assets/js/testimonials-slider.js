(function($) {
    'use strict';

    function initTestimonialsSlider($scope) {
        var $sliderContainer = $scope.find('.amac-testimonials-slider');
        if (!$sliderContainer.length) return;

        var sliderEl = $sliderContainer[0];
        var config = $sliderContainer.data('swiper-config');
        if (!config) return;

        // Destroy existing instance if present (Elementor editor re-render)
        if (sliderEl.swiper) {
            sliderEl.swiper.destroy(true, true);
        }

        var swiperOptions = {
            slidesPerView: config.mobile_slides || 1,
            spaceBetween: config.space_between || 24,
            speed: config.speed || 600,
            loop: config.loop !== false,
            grabCursor: true,
            breakpoints: {
                640: {
                    slidesPerView: config.tablet_slides || 2,
                    spaceBetween: config.space_between || 24
                },
                1024: {
                    slidesPerView: config.desktop_slides || 3,
                    spaceBetween: config.space_between || 30
                }
            }
        };

        if (config.autoplay) {
            swiperOptions.autoplay = {
                delay: config.autoplay_speed || 4000,
                disableOnInteraction: false,
                pauseOnMouseEnter: config.pause_on_hover !== false
            };
        }

        if (config.show_arrows) {
            var $prevBtn = $scope.find('.amac-swiper-prev');
            var $nextBtn = $scope.find('.amac-swiper-next');
            if ($prevBtn.length && $nextBtn.length) {
                swiperOptions.navigation = {
                    prevEl: $prevBtn[0],
                    nextEl: $nextBtn[0]
                };
            }
        }

        if (config.show_dots) {
            var $pagination = $scope.find('.amac-swiper-pagination');
            if ($pagination.length) {
                swiperOptions.pagination = {
                    el: $pagination[0],
                    clickable: true,
                    dynamicBullets: config.dots_type === 'dynamic'
                };
            }
        }

        if (typeof Swiper !== 'undefined') {
            new Swiper(sliderEl, swiperOptions);
        } else if (window.elementorFrontend && window.elementorFrontend.utils && window.elementorFrontend.utils.swiper) {
            new window.elementorFrontend.utils.swiper(sliderEl, swiperOptions).then(function(newSwiperInstance) {
                sliderEl.swiper = newSwiperInstance;
            });
        }
    }

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/amac_testimonials.default', initTestimonialsSlider);
    });

    $(document).ready(function() {
        if (!window.elementorFrontend || !window.elementorFrontend.isEditMode()) {
            $('.amac-testimonials-slider-wrapper').each(function() {
                initTestimonialsSlider($(this));
            });
        }
    });

})(jQuery);
