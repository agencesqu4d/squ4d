(function ($) {
	"use strict";

	$(document).ready(function () {
		qodefPortfolioDividedLayoutAnimations.init();
	});

	$(document).on('lekker_trigger_get_new_posts', function () {
		qodefPortfolioDividedLayoutAnimations.init();
	});

	var qodefPortfolioDividedLayoutAnimations = {
		init: function () {
			var $items = $('.qodef-portfolio-list.qodef-item-layout--info-image-divided .qodef-e-inner');

			if ($items.length) {
				$items.each(function () {
					var $thisItem = $(this),
						$thisHoverTargets = $thisItem.find('.qodef-e-title, .qodef-e-media-image, .qodef-button'),
						thisItemTop = $thisItem.offset().top,
						thisItemHeight = $thisItem.outerHeight(),
						thisItemBottom = thisItemTop + thisItemHeight,
						progressVal = 0,
						scrollOffsetY = -1 * qodef.windowHeight * .9,
						scaleVal = 1.3;

					$thisHoverTargets.length && qodefPortfolioDividedLayoutAnimations.hoverClass($thisItem, $thisHoverTargets);

					$(window).on('scroll', function () {
						if (qodef.scroll > thisItemTop + scrollOffsetY && qodef.scroll < thisItemBottom + scrollOffsetY) {
							progressVal = Math.abs(qodef.scroll - thisItemTop - scrollOffsetY) / thisItemHeight;
							$thisItem.find('img').css('transform', 'scale(' + (1 + (1 - (progressVal * 1) * 1) * Math.abs(1 - scaleVal)) + ')');
						}
					});
				});
			}
		},
		hoverClass: function ($holder, $target) {
			$target.on('mouseenter', function () {
				$holder.addClass('qodef-e--isHovered');
			}).on('mouseleave', function () {
				$holder.removeClass('qodef-e--isHovered');
			});
		}
	}

	qodefCore.shortcodes.lekker_core_portfolio_list.qodefPortfolioDividedLayoutAnimations = qodefPortfolioDividedLayoutAnimations;

})(jQuery);