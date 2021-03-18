(function ($) {

    "use strict";

    $(document).ready(function () {
        qodefSectionTitle.init();
    });

    var qodefSectionTitle = {
        init: function () {
            var $sectionTitle = $('.qodef-section-title.qodef-section-title--animated');

            if ($sectionTitle.length) {

                $sectionTitle.each(function () {
                    var $thisSectionTitle = $(this);
                    $thisSectionTitle.appear(function () {
                        $thisSectionTitle.addClass('qodef--appear');
                    }, { accX: 0, accY: 300 });
                });
            }
        }
    }

})(jQuery);