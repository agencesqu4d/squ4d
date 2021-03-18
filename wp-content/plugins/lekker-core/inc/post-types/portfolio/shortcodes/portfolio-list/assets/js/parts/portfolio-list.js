(function ($) {
	"use strict";

	var shortcode = 'lekker_core_portfolio_list';

	qodefCore.shortcodes[shortcode] = {};

	$(document).ready(function () {
		qodefPortfolioVerticalSplit.init();
		qodefPortfolioPredefinedFilter.init();
		qodefPortfolioSwitchImages.init();
		qodefHorizontalFullSlider.init();
	});

	$(window).on( 'load', function () {
		qodefPortfolioVerticalSplit.hoverClass();
	});

	if (typeof qodefCore.listShortcodesScripts === 'object') {
		$.each(qodefCore.listShortcodesScripts, function (key, value) {
			qodefCore.shortcodes[shortcode][key] = value;
		});
	}

	var qodefPortfolioVerticalSplit = {
		init: function () {
			var headerHeight = $('#qodef-page-header').outerHeight(),
				mobileHeaderHeight = $('#qodef-page-mobile-header').outerHeight(),
				windowHeight = $(window).height(),
				screen_width = window.matchMedia("(max-width: 1024px)");

			if (screen_width.matches) {
				$('.qodef-predefined-sliders--vertical-split .swiper-wrapper').css('height', windowHeight - mobileHeaderHeight);
			} else {
				$('.qodef-predefined-sliders--vertical-split .swiper-wrapper').css('height', windowHeight - headerHeight);
			}
		},
		hoverClass: function () {
			var $holder = $('.qodef-predefined-sliders--vertical-split');

			if ($holder.length) {
				var $items = $holder.find('.qodef-e');

				if ($items.length) {
					$items.each(function () {
						var $thisItem = $(this),
							$thisTargets = $thisItem.find('.qodef-e-title, .qodef-e-media-image, .qodef-button');

						if ($thisTargets.length) {
							$thisTargets.on('mouseenter', function () {
								$thisItem.addClass('qodef-e--isHovered');
							}).on('mouseleave', function () {
								$thisItem.removeClass('qodef-e--isHovered');
							});
						}
					});
				}
			}
		}
	};

	var qodefPortfolioPredefinedFilter = {
		init: function () {
			$('.qodef-predefined-filter--yes').css('min-height', $('.qodef-predefined-filter--yes .qodef-m-filter').outerHeight());
		}
	};

	var qodefPortfolioSwitchImages = {
		init: function () {
			var portfolioList = $('.qodef-item-layout--switch-images');
			if (portfolioList.length) {
				portfolioList.each(function () {
					var thisList = $(this),
						articles = thisList.find('article');

					if (articles.length) {
						articles.each(function () {
							var thisArticle = $(this),
								imagesHolder = thisArticle.find('.qodef-e-media-image'),
								images = imagesHolder.find('img');

							images.eq(0).addClass('active');

							if (images.length) {
								imagesHolder.on('mousemove', function (e) {
									var nbImages = images.length;
									var posX = e.pageY - imagesHolder.offset().top;
									var currentImg = Math.floor(posX / (imagesHolder.height() / nbImages));

									images.removeClass('active');
									images.eq(currentImg).addClass('active');

								});
							}
						});
					}
				});
			}
		}
	};

	var qodefHorizontalFullSlider = {
		init: function () {
			var $holder = $('.qodef-predefined-sliders--horizontal-full');

			if ($holder.length) {
				$holder.each(function () {
					var $thisHolder = $(this);

					qodefHorizontalFullSlider.initStructure($thisHolder);
					qodefHorizontalFullSlider.calcHeight($thisHolder);
				});
			}
		},
		initStructure: function ($holder) {
			var articlesHTML = $holder.find('.swiper-wrapper').html();

			$holder.find('.swiper-wrapper').empty().append('<div class="qodef-slider-section qodef-slider-section--center"><div class="qodef-inner-slider-section"><div class="qodef-slider-content-hidden">' + articlesHTML + '</div></div></div>');

			setTimeout(function () {
				var articleImagesHTML = '',
					$articleImages = $holder.find('article .qodef-e-media-image a');

				$articleImages.each(function () {
					articleImagesHTML += $(this).html();
				});

				$holder.find('.swiper-wrapper').prepend('<div class="qodef-slider-section qodef-slider-section--left"><div class="qodef-inner-slider-section"><div class="qodef-slider-images-holder">' + articleImagesHTML + '</div></div></div>');
				$holder.find('.swiper-wrapper').append('<div class="qodef-slider-section qodef-slider-section--right"><div class="qodef-inner-slider-section"><div class="qodef-slider-images-holder">' + articleImagesHTML + '</div></div></div>');
				// Center Section
				$holder.find('.qodef-slider-section--center .qodef-inner-slider-section').append('<div class="qodef-slider-images-holder"><a class="qodef-slider-center-image-link" href="#">' + articleImagesHTML + '</a></div>');

				var $firstArticle = $holder.find('article').first(),
					titleEl = $firstArticle.find('.qodef-e-content .qodef-e-title').clone(),
					categoryEl = $firstArticle.find('.qodef-e-content .qodef-e-category').clone();

				$holder.find('.qodef-slider-section--center .qodef-inner-slider-section').append('<div class="qodef-inner-slider-info"></div>');
				$holder.find('.qodef-slider-section--center .qodef-inner-slider-section .qodef-inner-slider-info').append(categoryEl);
				$holder.find('.qodef-slider-section--center .qodef-inner-slider-section .qodef-inner-slider-info').append(titleEl);
				$holder.find('.qodef-slider-section--center').append('<div class="swiper-button-next"><span class="qodef-swiper-lines"></span><span class="qodef-swiper-label">Next</span></div><div class="swiper-button-prev"><span class="qodef-swiper-lines"></span><span class="qodef-swiper-label">Prev</span></div>');
				qodefHorizontalFullSlider.initSlider($holder);
			}, 10);
		},
		calcHeight: function ($holder) {
			var headerHeight = $('#qodef-page-header').length ? $('#qodef-page-header').height() : 0;
			if (qodef.windowWidth < 1025) {
				headerHeight = $('#qodef-page-mobile-header').length ? $('#qodef-page-mobile-header').height() : 0;
			}
			$holder.css('height', 'calc(100vh - ' + headerHeight + 'px)');
		},
		initSlider: function ($holder) {
			$holder.css('visibility', 'visible');
			var $imageHolders = $holder.find('.qodef-slider-images-holder'),
				holderData = JSON.parse($holder.attr('data-options'))

			var $centerImageItems = $holder.find('.qodef-slider-section--center .qodef-slider-images-holder img');
			var $rightImageItems = $holder.find('.qodef-slider-section--right .qodef-slider-images-holder img');
			var $leftImageItems = $holder.find('.qodef-slider-section--left .qodef-slider-images-holder img');
			// Init Images
			qodefHorizontalFullSlider.changeClasses($centerImageItems, $centerImageItems.first());
			qodefHorizontalFullSlider.changeClasses($rightImageItems, $rightImageItems.first().next());
			qodefHorizontalFullSlider.changeClasses($leftImageItems, $leftImageItems.last());

			// Init Animation
			qodefHorizontalFullSlider.changeSlide($holder, $imageHolders, 'next');

			if (holderData.autoplay === true) {
				qodefHorizontalFullSlider.autoplaySlider($holder, $imageHolders).init();
			}

			if (holderData.sliderScroll === true) {
				qodefHorizontalFullSlider.scrollSlider($holder, $imageHolders);
			}

			if (qodef.html.hasClass('touchevents') && qodef.windowWidth < 1025) {
				qodefHorizontalFullSlider.dragSlider($holder, $imageHolders);
			}

			// Hover Right and Left Section
			$holder.find('.qodef-slider-section--right .qodef-slider-images-holder').on('mouseenter', function () {
				$holder.find('.swiper-button-next').addClass('qodef--isHovered');
			}).on('mouseleave', function () {
				$holder.find('.swiper-button-next').removeClass('qodef--isHovered');
			}).on('click', function () {
				qodefHorizontalFullSlider.changeSlide($holder, $imageHolders, 'next', true);
			});

			$holder.find('.qodef-slider-section--left .qodef-slider-images-holder').on('mouseenter', function () {
				$holder.find('.swiper-button-prev').addClass('qodef--isHovered');
			}).on('mouseleave', function () {
				$holder.find('.swiper-button-prev').removeClass('qodef--isHovered');
			}).on('click', function () {
				qodefHorizontalFullSlider.changeSlide($holder, $imageHolders, 'prev', true);
			});

			// Center Section Click
			var $centerSection = $holder.find('.qodef-slider-section--center');
			$centerSection.on('click', '.qodef-slider-images-holder, .qodef-e-title-link, .qodef-e-category', function () {
				$centerSection.addClass('qodef--isClicked');
			});

			// Navigation
			$holder.find('.swiper-button-next').on('click', function () {
				qodefHorizontalFullSlider.changeSlide($holder, $imageHolders, 'next', true);
			});
			$holder.find('.swiper-button-prev').on('click', function () {
				qodefHorizontalFullSlider.changeSlide($holder, $imageHolders, 'prev', true);
			});
		},
		changeClasses: function ($items, $newActiveItem) {
			// Change Classes
			var $oldActiveItem = $items.filter('.qodef-img--active');
			$items.removeClass('qodef-img--active qodef-img--next qodef-img--prev qodef-img--last-active');
			$oldActiveItem.addClass('qodef-img--last-active');
			$newActiveItem.addClass('qodef-img--active');
			// Calc next and prev items
			if ($newActiveItem.next().length > 0) {
				$newActiveItem.next().addClass('qodef-img--next');
			} else {
				$items.first().addClass('qodef-img--next');
			}
			if ($newActiveItem.prev().length > 0) {
				$newActiveItem.prev().addClass('qodef-img--prev');
			} else {
				$items.last().addClass('qodef-img--prev');
			}
		},
		changeSlide: function ($holder, $imageHolders, direction, isUser) {
			if (isUser) {
				// Reset Autoplay on user interruption
				qodefHorizontalFullSlider.autoplaySlider($holder, $imageHolders).resetAutoplay();
			}
			if (!$holder.data('isAnimating')) {
				$holder.data('isAnimating', true);
				var newActiveItemIndex = direction === 'next' ?
					$holder.find('.qodef-slider-section--center').find('img').filter('.qodef-img--next').index() :
					$holder.find('.qodef-slider-section--center').find('img').filter('.qodef-img--prev').index();
				qodefHorizontalFullSlider.updateSlideInfo($holder, newActiveItemIndex);

				$imageHolders.each(function () {
					var $thisHolderImages = $(this).find('img'),
						$newActiveItem = direction === 'next' ? $thisHolderImages.filter('.qodef-img--next') : $thisHolderImages.filter('.qodef-img--prev');
					qodefHorizontalFullSlider.changeClasses($thisHolderImages, $newActiveItem);
				});

				setTimeout(function () {
					$holder.data('isAnimating', false);
				}, 1200);
			}
		},
		updateSlideInfo: function ($holder, newActiveItemIndex) {
			var $articlesHolder = $holder.find('.qodef-slider-content-hidden'),
				$categoryCenterInfo = $holder.find('.qodef-slider-section--center .qodef-inner-slider-info .qodef-e-category'),
				$titleCenterInfo = $holder.find('.qodef-slider-section--center .qodef-inner-slider-info .qodef-e-title-link'),
				$imageLink = $holder.find('.qodef-slider-section--center .qodef-slider-center-image-link');

			// Get Active Article Info
			var $activeArticle = $articlesHolder.find('article').eq(newActiveItemIndex);
			var activeArticleInfo = {
				title: {
					text: $activeArticle.find('.qodef-e-title-link').text().trim(),
					href: $activeArticle.find('.qodef-e-title-link').attr('href')
				},
				category: {
					text: $activeArticle.find('.qodef-e-category').text().trim(),
					href: $activeArticle.find('.qodef-e-category').attr('href')
				}
			}
			// Update Center Info
			setTimeout(function () {
				$categoryCenterInfo.text(activeArticleInfo.category.text);
				$categoryCenterInfo.attr('href', activeArticleInfo.category.href);
				$titleCenterInfo.text(activeArticleInfo.title.text);
				$titleCenterInfo.attr('href', activeArticleInfo.title.href);
				$imageLink.attr('href', activeArticleInfo.title.href);
			}, 400);
		},
		scrollSlider: function ($holder, $imageHolders) {
			var scrollStart = false;

			$holder.on('mousewheel', function (e) {
				e.preventDefault();
				if (!scrollStart) {
					scrollStart = true;

					if (e.deltaY < 0) {
						qodefHorizontalFullSlider.changeSlide($holder, $imageHolders, 'next', true);
					} else {
						qodefHorizontalFullSlider.changeSlide($holder, $imageHolders, 'prev', true);
					}

					setTimeout(function () {
						scrollStart = false;
					}, 1200);
				}
			});
		},
		dragSlider: function ($holder, $imageHolders) {
			var $centerImageHolder = $holder.find('.qodef-slider-section--center .qodef-slider-images-holder'),
				mouseDown = false,
				dragEvent = {
					down: 'touchstart',
					up: 'touchend'
				};

			// Check if user is scrolling on touch devices
			var touchScrolling = function (oldEvent, newEvent) {
				var oldY = oldEvent.originalEvent.changedTouches[0].clientY,
					newY = newEvent.originalEvent.changedTouches[0].clientY;

				if (Math.abs(newY - oldY) > 100) { // 100 is drag sensitivity
					return true;
				};
				return false;
			}

			var getXPos = function (e) {
				return e.originalEvent.changedTouches[0].clientX;
			}

			// Drag logic
			$centerImageHolder.on(dragEvent.down, function (e) {
				if (!mouseDown) {
					mouseDown = true;

					var oldEvent = e,
						xPos = getXPos(e);

					$centerImageHolder.one(dragEvent.up, function (e) {
						var xPosNew = getXPos(e);
						if (Math.abs(xPos - xPosNew) > 10 && !touchScrolling(oldEvent, e)) {
							if (xPos > xPosNew) {
								qodefHorizontalFullSlider.changeSlide($holder, $imageHolders, 'next', true);
							} else {
								qodefHorizontalFullSlider.changeSlide($holder, $imageHolders, 'prev', true);
							}
						}
						mouseDown = false;
					});
				}
			});
		},
		autoplaySlider: function ($holder, $imageHolders) {
			var autoplaySpeed = 4000,
				autoplayTimeoutVal = 3000; // time in ms before autoplay restarts after user interruption

			// Autoplay logic
			var autoplayStart = function () {
				qodefHorizontalFullSlider.autoplayState.interval = setInterval(function () {
					qodefHorizontalFullSlider.changeSlide($holder, $imageHolders, 'next');
				}, autoplaySpeed);
			}

			return {
				init: function () {
					setTimeout(function () {
						autoplayStart();
					}, 1000);
				},
				resetAutoplay: function () {
					clearTimeout(qodefHorizontalFullSlider.autoplayState.timeout);
					clearInterval(qodefHorizontalFullSlider.autoplayState.interval);
					qodefHorizontalFullSlider.autoplayState.timeout = setTimeout(function () {
						autoplayStart();
					}, autoplayTimeoutVal);
				}
			}
		},
		autoplayState: {
			interval: null,
			timeout: null
		}
	};

	qodefCore.shortcodes.lekker_core_portfolio_list.qodefSwiper = qodef.qodefSwiper;
	qodefCore.shortcodes.lekker_core_portfolio_list.qodefPortfolioVerticalSplit = qodefPortfolioVerticalSplit;
	qodefCore.shortcodes.lekker_core_portfolio_list.qodefPortfolioPredefinedFilter = qodefPortfolioPredefinedFilter;
	qodefCore.shortcodes.lekker_core_portfolio_list.qodefPortfolioSwitchImages = qodefPortfolioSwitchImages;
	qodefCore.shortcodes.lekker_core_portfolio_list.qodefHorizontalFullSlider = qodefHorizontalFullSlider;

})(jQuery);