(function ($, Drupal) {
  Drupal.behaviors.myCustomMainBehavior = {
    attach: function (context, settings) {
      $(context)
        .find("body")
        .once("myCustomMainBehavior")
        .each(function () {
          AOS.init({
            once: true,
            disable: "mobile",
          });
          const menuMobile = new MobileMenu(
            ".main-menu",
            true,
            ".language-switcher"
          );

          let imageWrapper = document.querySelectorAll(
            ".responsive-img-background"
          );
          if (
            typeof imageWrapper != "undefined" &&
            imageWrapper != null &&
            imageWrapper.length != 0
          ) {
            for (let i = 0; i < imageWrapper.length; i++) {
              new ResponsiveBackgroundImage(imageWrapper[i]);
            }
          }

          if ($(".grid").length) {
            let masonryConfig = {
              columnWidth: ".full-width-node",
              gutter: 0,
            };

            if ($(".small-width-node").length) {
              masonryConfig = {
                columnWidth: ".small-width-node",
                gutter: 30,
              };
            }

            var $grid = $(".grid").isotope({
              itemSelector: ".node--type-realization",
              layoutMode: "masonry",
              masonry: {
                columnWidth: masonryConfig.columnWidth,
                gutter: masonryConfig.gutter,
              },
            });

            // bind filter button click
            $(".vocabulary-realization").on(
              "click",
              ".taxonomy-list-isotope-filtr",
              function (e) {
                var filterValue = $(this).attr("data-filtr-type");
                var filterValueSelector;

                console.log(filterValue);

                if (filterValue == "*") {
                  filterValueSelector = filterValue;
                } else {
                  filterValueSelector = "." + filterValue;
                }

                e.preventDefault();
                $grid.isotope({ filter: filterValueSelector });
              }
            );

            // change is-checked class on buttons
            $(".vocabulary-realization").each(function (i, buttonGroup) {
              var $buttonGroup = $(buttonGroup);
              $buttonGroup.on(
                "click",
                ".taxonomy-list-isotope-filtr",
                function () {
                  $(".vocabulary-realization")
                    .find(".is-checked")
                    .removeClass("is-checked");
                  $(this).addClass("is-checked");
                }
              );
            });
          }

          const buttonTop = document.querySelector(".button-up");
          if (buttonTop) {
            buttonTop.addEventListener("click", function () {
              window.scrollTo({ top: 0, behavior: "smooth" });
            });
          }
          $(window)
            .scroll(function () {
              if ($(this).scrollTop() > 150) {
                $(buttonTop).fadeIn();
              } else {
                $(buttonTop).fadeOut();
              }
            })
            .trigger("scroll");
        });
    },
  };
})(jQuery, Drupal);
