(function ($) {

	"use strict";
	qodefCore.shortcodes.lekker_core_blog_list = {};
	qodefCore.shortcodes.lekker_core_blog_list.qodefPagination = qodef.qodefPagination;
	qodefCore.shortcodes.lekker_core_blog_list.qodefFilter = qodef.qodefFilter;
	qodefCore.shortcodes.lekker_core_blog_list.qodefJustifiedGallery = qodef.qodefJustifiedGallery;
	qodefCore.shortcodes.lekker_core_blog_list.qodefMasonryLayout = qodef.qodefMasonryLayout;
	qodefCore.shortcodes.lekker_core_blog_list.qodefSwiper = qodef.qodefSwiper;

	$(document).ready(function () {
		qodefBlogHovers.init();
	});

	var qodefBlogHovers = {
		init: function () {
			var $elements = $('.qodef-blog.qodef-item-layout--simple .qodef-e, .qodef-item-layout--switch-images .qodef-e');

			if ($elements.length) {
				$elements.each(function () {
					var $thisItem = $(this),
						$thisTargets = $thisItem.find('.qodef-e-title, .qodef-e-media-image, .qodef-button');

					$thisTargets.length && qodefBlogHovers.hoverClass($thisItem, $thisTargets);
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

})(jQuery);