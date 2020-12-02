(function ($, Drupal) {
  Drupal.behaviors.rmebleSwiperConfig = {
    attach: function (context, settings) {
      if ($(".swiper-main-slider").length) {
        $(context)
          .find(".swiper-main-slider")
          .once("rmebleSwiperConfig")
          .each(function () {
            var mySwiper = new Swiper(".swiper-main-slider", {
              loop: true,
              effect: "fade",
              speed: 3000,
              autoplay: {
                delay: 5000,
                disableOnInteraction: false,
              },
              coverflowEffect: {
                rotate: 3,
                slideShadows: true,
              },
              fadeEffect: {
                crossFade: true,
              },
              pagination: {
                el: ".swiper-pagination",
                clickable: true,
              },
              allowTouchMove: false,
              on: {
                init: function () {
                  setTimeout(function () {
                    $(".slider")
                      .find("[data-swiper-slide-index='" + 1 + "']")
                      .find(
                        ".slide-title,  .slide-body , .slide-link-wrapper, .line-under"
                      )
                      .removeClass("aos-init")
                      .removeClass("aos-animate")
                      .removeClass("draw-line");

                    $(".slider")
                      .find("[data-swiper-slide-index='" + 0 + "']")
                      .find(".line-under")
                      .addClass("draw-line");
                  }, 2000);
                },
                slideChangeTransitionStart: function () {
                  AOS.init({
                    once: true,
                  });
                  if (mySwiper) {
                    const activeIndex = mySwiper.activeIndex;
                    $(".slider .swiper-slide").each(function (index, el) {
                      setTimeout(function () {
                        if ($(el)[0] === $(mySwiper.slides[activeIndex])[0]) {
                          return;
                        }
                        $(el)
                          .find(
                            ".slide-title, .slide-body, .slide-link-wrapper, .line-under"
                          )
                          .removeClass("aos-init")
                          .removeClass("aos-animate")
                          .removeClass("draw-line");
                        $(mySwiper.slides[activeIndex])
                          .find(".line-under")
                          .addClass("draw-line");
                      }, 2000);
                    });
                  }
                },
              },
            });
          });
      }
      if ($(".swiper-descriptionfrontpage-images").length) {
        $(context)
          .find(".swiper-descriptionfrontpage-images")
          .once("rmebleSwiperConfig")
          .each(function () {
            var mySwiper = new Swiper(".swiper-descriptionfrontpage-images", {
              loop: true,
              slidesPerView: 1,
              speed: 1000,
              autoplay: {
                delay: 1000,
                disableOnInteraction: false,
              },
              // breakpoints: {
              //   // when window width is <= 499px
              //   577: {
              //     centeredSlides: false,
              //     slidesPerView: 2,
              //     spaceBetweenSlides: 15,
              //   },
              //   992: {
              //     centeredSlides: false,
              //     slidesPerView: 3,
              //     spaceBetweenSlides: 15,
              //   },
              // },
            });
          });
      }

      if ($(".realization-swiper-slider").length) {
        $(context)
          .find(".realization-swiper-slider")
          .once("rmebleSwiperConfig")
          .each(function () {
            var mySwiper = new Swiper(".realization-swiper-slider", {
              loop: false,
              slidesPerView: 1,
              speed: 1500,
              pagination: {
                el: ".swiper-pagination",
                clickable: true,
              },
              autoplay: {
                delay: 1500,
                disableOnInteraction: true,
              },
            });
          });
      }

      if ($(".related-realizations-swiper").length) {
        $(context)
          .find(".related-realizations-swiper")
          .once("rmebleSwiperConfig")
          .each(function () {
            var mySwiper = new Swiper(".related-realizations-swiper", {
              loop: false,
              slidesPerView: 3,
              spaceBetween: 15,
              watchOverflow: true,
              navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
              },
            });
          });
      }

      if ($(".realization-front-swiper").length) {
        $(context)
          .find(".realization-front-swiper")
          .once("rmebleSwiperConfig")
          .each(function () {
            var mySwiper = new Swiper(".realization-front-swiper", {
              loop: false,
              slidesPerView: 1,
              watchOverflow: true,
              speed: 1500,
              autoplay: {
                delay: 6000,
                disableOnInteraction: true,
              },
              pagination: {
                el: ".swiper-pagination-custom",
                clickable: true,
              },
              breakpoints: {
                577: {
                  slidesPerView: 2,
                  spaceBetween: 15,
                },
                992: {
                  slidesPerView: 1,
                },
              },
            });
          });
      }
    },
  };
})(jQuery, Drupal);
