(function ($, Drupal) {
  "use strict";

  Drupal.behaviors.csinitColorbox = {
    attach: function (context, settings) {
      if (!$.isFunction($.colorbox)) {
        return;
      }

      const group = $(".colorbox-group").attr("data-colorbox-gallery");

      var cboxOptions = {
        // width: 'auto',
        // height: 'auto',
        maxWidth: "95%",
        maxHeight: "95%",
        rel: group,
      };

      $(".colorbox").colorbox(cboxOptions);

      var resizeTimer;
      function resizeColorBox() {
        if (resizeTimer) clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
          if (jQuery("#cboxOverlay").is(":visible")) {
            jQuery.colorbox.resize({
              width: "95%",
              maxHeight: "95%",
            });
          }
        }, 300);
      }

      function colorboxClose() {
        jQuery.colorbox.close();
      }
      // Resize Colorbox when resizing window or changing mobile device orientation

      jQuery(window).resize(resizeColorBox);

      window.addEventListener("orientationchange", colorboxClose, false);

      var settings = {
        colorbox: {
          mobiledetect: true,
        },
      };

      if (settings.colorbox.mobiledetect && window.matchMedia) {
        // Disable Colorbox for small screens.
        var mq = window.matchMedia(
          "(max-device-width: " + settings.colorbox.mobiledevicewidth + ")"
        );
        if (mq.matches) {
          return;
        }
      }
      settings.colorbox.rel = function () {
        return $(this).data("colorbox-gallery");
      };

      $(".colorbox", context).once("init-colorbox").colorbox(settings.colorbox);
    },
  };
})(jQuery, Drupal);
