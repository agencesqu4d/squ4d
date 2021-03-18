(function ($) {
	"use strict";

	$(window).on( 'load', function () {
		qodefInfoFollow.init();
	});

	$(document).on('lekker_trigger_get_new_posts', function () {
		qodefInfoFollow.init();
	});

	var qodefInfoFollow = {
		init: function () {
			var $gallery = $('.qodef-item-layout--info-follow');

			if ($gallery.length) {
				if (!$('.qodef-follow-info-holder').length) {
					qodefCore.body.append('<div class="qodef-follow-info-holder"><div class="qodef-follow-info-inner"><span class="qodef-follow-info-role"></span><br/><span class="qodef-follow-info-title"></span></div></div>');
				}

				var $followInfoHolder = $('.qodef-follow-info-holder'),
					$followInfoCategory = $followInfoHolder.find('.qodef-follow-info-role'),
					$followInfoTitle = $followInfoHolder.find('.qodef-follow-info-title');

				$gallery.each(function () {
					$gallery.find('.qodef-e-inner').each(function () {
						var $thisItem = $(this);

						//info element position
						$thisItem.on('mousemove', function (e) {
							if (e.clientX + 20 + $followInfoHolder.width() > qodefCore.windowWidth) {
								$followInfoHolder.addClass('qodef-right');
							} else {
								$followInfoHolder.removeClass('qodef-right');
							}

							$followInfoHolder.css({
								top: e.clientY + 20,
								left: e.clientX + 20
							});
						});

						//show/hide info element
						$thisItem.on('mouseenter', function () {
							var $thisItemTitle = $(this).find('.qodef-e-title'),
								$thisItemCategory = $(this).find('.qodef-e-role');

							if ($thisItemTitle.length) {
								$followInfoTitle.html($thisItemTitle.clone());
							}

							if ($thisItemCategory.length) {
								$followInfoCategory.html($thisItemCategory.html());
							}

							if (!$followInfoHolder.hasClass('qodef-is-active')) {
								$followInfoHolder.addClass('qodef-is-active');
							}
						}).on('mouseleave', function () {
							if ($followInfoHolder.hasClass('qodef-is-active')) {
								$followInfoHolder.removeClass('qodef-is-active');
							}
						});

						if (qodef.windowWidth < 1025) {
							$(window).on('scroll', function () {
								if ($followInfoHolder.hasClass('qodef-is-active')) {
									$followInfoHolder.removeClass('qodef-is-active');
								}
							});
						}
					});

				});
			}
		}
	};

	qodefCore.shortcodes.lekker_core_team_list.qodefInfoFollow = qodefInfoFollow;

})(jQuery);