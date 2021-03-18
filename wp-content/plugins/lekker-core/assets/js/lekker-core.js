(function ($) {
	"use strict";
	
	window.qodefCore = {};
	qodefCore.shortcodes = {};
	qodefCore.listShortcodesScripts = {
		qodefSwiper: qodef.qodefSwiper,
		qodefPagination: qodef.qodefPagination,
		qodefFilter: qodef.qodefFilter,
		qodefMasonryLayout: qodef.qodefMasonryLayout,
		qodefJustifiedGallery: qodef.qodefJustifiedGallery,
	};
	
	qodefCore.body = $('body');
	qodefCore.html = $('html');
	qodefCore.windowWidth = $(window).width();
	qodefCore.windowHeight = $(window).height();
	qodefCore.scroll = 0;
	
	$(document).ready(function () {
		qodefCore.scroll = $(window).scrollTop();
		qodefInlinePageStyle.init();
	});
	
	$(window).resize(function () {
		qodefCore.windowWidth = $(window).width();
		qodefCore.windowHeight = $(window).height();
	});
	
	$(window).scroll(function () {
		qodefCore.scroll = $(window).scrollTop();
	});
	
	var qodefScroll = {
		disable: function () {
			if (window.addEventListener) {
				window.addEventListener('wheel', qodefScroll.preventDefaultValue, {passive: false});
			}
			
			// window.onmousewheel = document.onmousewheel = qodefScroll.preventDefaultValue;
			document.onkeydown = qodefScroll.keyDown;
		},
		enable: function () {
			if (window.removeEventListener) {
				window.removeEventListener('wheel', qodefScroll.preventDefaultValue, {passive: false});
			}
			window.onmousewheel = document.onmousewheel = document.onkeydown = null;
		},
		preventDefaultValue: function (e) {
			e = e || window.event;
			if (e.preventDefault) {
				e.preventDefault();
			}
			e.returnValue = false;
		},
		keyDown: function (e) {
			var keys = [37, 38, 39, 40];
			for (var i = keys.length; i--;) {
				if (e.keyCode === keys[i]) {
					qodefScroll.preventDefaultValue(e);
					return;
				}
			}
		}
	};
	
	qodefCore.qodefScroll = qodefScroll;
	
	var qodefPerfectScrollbar = {
		init: function ($holder) {
			if ($holder.length) {
				qodefPerfectScrollbar.qodefInitScroll($holder);
			}
		},
		qodefInitScroll: function ($holder) {
			var $defaultParams = {
				wheelSpeed: 0.6,
				suppressScrollX: true
			};
			
			var $ps = new PerfectScrollbar($holder.selector, $defaultParams);
			$(window).resize(function () {
				$ps.update();
			});
		}
	};
	
	qodefCore.qodefPerfectScrollbar = qodefPerfectScrollbar;
	
	var qodefInlinePageStyle = {
		init: function () {
			this.holder = $('#lekker-core-page-inline-style');
			
			if (this.holder.length) {
				var style = this.holder.data('style');
				
				if (style.length) {
					$('head').append('<style type="text/css">' + style + '</style>');
				}
			}
		}
	};
	
})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefBackToTop.init();
    });

    var qodefBackToTop = {
        init: function () {
            this.holder = $('#qodef-back-to-top');

            if (this.holder.length) {
                // Scroll To Top
                this.holder.on('click', function (e) {
                    e.preventDefault();
                    qodefBackToTop.animateScrollToTop();
                });

                qodefBackToTop.showHideBackToTop();
            }
        },
        animateScrollToTop: function () {
            var startPos = qodef.scroll,
                newPos = qodef.scroll,
                step = .85,
                animationFrameId;

            var startAnimation = function () {
                if (newPos === 0) return;
                newPos < 0.0001 ? newPos = 0 : null;
                var ease = qodefBackToTop.easingFunction((startPos - newPos) / startPos);
                qodef.htmlAndBody.scrollTop(startPos - (startPos - newPos) * ease);
                newPos = newPos * step;

                animationFrameId = requestAnimationFrame(startAnimation)
            }
            startAnimation();
            qodef.htmlAndBody.one('wheel touchstart', function () {
                cancelAnimationFrame(animationFrameId);
            });
        },
        easingFunction: function (n) {
            return 0 == n ? 0 : Math.pow(1024, n - 1);
        },
        showHideBackToTop: function () {
            $(window).scroll(function () {
                var $thisItem = $(this),
                    content = $('#qodef-page-wrapper').height(),
                    b = $thisItem.scrollTop(),
                    contentSpace = content - 820,
                    c = $thisItem.height(),
                    d;

                if (b > 0) {
                    d = b + c / 2;
                } else {
                    d = 1;
                }

                if (d < 1e3) {
                    qodefBackToTop.addClass('off');
                } else {
                    qodefBackToTop.addClass('on');
                }
                if (d > contentSpace) {
                    qodefBackToTop.changeColor('down');
                } else {
                    qodefBackToTop.changeColor('up');
                }
            });
        },
        addClass: function (a) {
            this.holder.removeClass('qodef--off qodef--on');

            if (a === 'on') {
                this.holder.addClass('qodef--on');
            } else {
                this.holder.addClass('qodef--off');
            }
        },
        changeColor: function (a) {
            var b = $("#qodef-back-to-top .qodef-btn-background");
            b.removeClass('up down');
            if (a === 'up') {
                b.addClass('up');
            } else {
                b.addClass('down');
            }
        }
    };

})(jQuery);

(function ($) {
	"use strict";
	
	$(window).on( 'load', function () {
		qodefUncoverFooter.init();
	});
	
	var qodefUncoverFooter = {
		holder: '',
		init: function () {
			this.holder = $('#qodef-page-footer.qodef--uncover');
			
			if (this.holder.length && !qodefCore.html.hasClass('touchevents')) {
				qodefUncoverFooter.addClass();
				qodefUncoverFooter.setHeight(this.holder);
				
				$(window).resize(function () {
                    qodefUncoverFooter.setHeight(qodefUncoverFooter.holder);
				});
			}
		},
        setHeight: function ($holder) {
	        $holder.css('height', 'auto');
	        
            var footerHeight = $holder.outerHeight();
            
            if (footerHeight > 0) {
                $('#qodef-page-outer').css({'margin-bottom': footerHeight, 'background-color': qodefCore.body.css('backgroundColor')});
                $holder.css('height', footerHeight);
            }
        },
		addClass: function () {
			qodefCore.body.addClass('qodef-page-footer--uncover');
		}
	};
	
})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefFullscreenMenu.init();
	});
	
	var qodefFullscreenMenu = {
		init: function () {
			var $fullscreenMenuOpener = $('a.qodef-fullscreen-menu-opener'),
				$menuItems = $('#qodef-fullscreen-area nav ul li a');
			
			// Open popup menu
			$fullscreenMenuOpener.on('click', function (e) {
				e.preventDefault();
				
				if (!qodefCore.body.hasClass('qodef-fullscreen-menu--opened')) {
					qodefFullscreenMenu.openFullscreen();
					$(document).keyup(function (e) {
						if (e.keyCode === 27) {
							qodefFullscreenMenu.closeFullscreen();
						}
					});
				} else {
					qodefFullscreenMenu.closeFullscreen();
				}
			});
			
			//open dropdowns
			$menuItems.on('tap click', function (e) {
				var $thisItem = $(this);
				if ($thisItem.parent().hasClass('menu-item-has-children')) {
					e.preventDefault();
					qodefFullscreenMenu.clickItemWithChild($thisItem);
				} else if (($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")) {
					qodefFullscreenMenu.closeFullscreen();
				}
			});
		},
		openFullscreen: function () {
			qodefCore.body.removeClass('qodef-fullscreen-menu-animate--out').addClass('qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in');
			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function () {
			qodefCore.body.removeClass('qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in').addClass('qodef-fullscreen-menu-animate--out');
			qodefCore.qodefScroll.enable();
			$("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200);
		},
		clickItemWithChild: function (thisItem) {
			var $thisItemParent = thisItem.parent(),
				$thisItemSubMenu = $thisItemParent.find('.sub-menu').first();
			
			if ($thisItemSubMenu.is(':visible')) {
				$thisItemSubMenu.slideUp(300);
			} else {
				$thisItemSubMenu.slideDown(300);
				$thisItemParent.siblings().find('.sub-menu').slideUp(400);
			}
		}
	};
	
})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefHeaderScrollAppearance.init();
	});
	
	var qodefHeaderScrollAppearance = {
		appearanceType: function () {
			return qodefCore.body.attr('class').indexOf('qodef-header-appearance--') !== -1 ? qodefCore.body.attr('class').match(/qodef-header-appearance--([\w]+)/)[1] : '';
		},
		init: function () {
			var appearanceType = this.appearanceType();
			
			if (appearanceType !== '' && appearanceType !== 'none') {
                qodefCore[appearanceType + "HeaderAppearance"]();
			}
		}
	};
	
})(jQuery);

(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefMobileHeaderAppearance.init();
    });

    /*
     **	Init mobile header functionality
     */
    var qodefMobileHeaderAppearance = {
        init: function () {
            if (qodefCore.body.hasClass('qodef-mobile-header-appearance--sticky')) {

                var docYScroll1 = qodefCore.scroll,
                    displayAmount = qodefGlobal.vars.mobileHeaderHeight + qodefGlobal.vars.adminBarHeight,
                    $pageOuter = $('#qodef-page-outer');

                qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                $(window).scroll(function () {
                    qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                    docYScroll1 = qodefCore.scroll;
                });

                $(window).resize(function () {
                    $pageOuter.css('padding-top', 0);
                    qodefMobileHeaderAppearance.showHideMobileHeader(docYScroll1, displayAmount, $pageOuter);
                });
            }
        },
        showHideMobileHeader: function(docYScroll1, displayAmount,$pageOuter){
            if(qodefCore.windowWidth <= 1024) {
                if (qodefCore.scroll > displayAmount * 2) {
                    //set header to be fixed
                    qodefCore.body.addClass('qodef-mobile-header--sticky');

                    //add transition to it
                    setTimeout(function () {
                        qodefCore.body.addClass('qodef-mobile-header--sticky-animation');
                    }, 300); //300 is duration of sticky header animation

                    //add padding to content so there is no 'jumping'
                    $pageOuter.css('padding-top', qodefGlobal.vars.mobileHeaderHeight);
                } else {
                    //unset fixed header
                    qodefCore.body.removeClass('qodef-mobile-header--sticky');

                    //remove transition
                    setTimeout(function () {
                        qodefCore.body.removeClass('qodef-mobile-header--sticky-animation');
                    }, 300); //300 is duration of sticky header animation

                    //remove padding from content since header is not fixed anymore
                    $pageOuter.css('padding-top', 0);
                }

                if ((qodefCore.scroll > docYScroll1 && qodefCore.scroll > displayAmount) || (qodefCore.scroll < displayAmount * 3)) {
                    //show sticky header
                    qodefCore.body.removeClass('qodef-mobile-header--sticky-display');
                } else {
                    //hide sticky header
                    qodefCore.body.addClass('qodef-mobile-header--sticky-display');
                }
            }
        }
    };

})(jQuery);
(function ($) {
	"use strict";

	$(document).ready(function () {
		qodefNavMenu.init();
	});

	var qodefNavMenu = {
		init: function () {
			qodefNavMenu.dropdownBehavior();
			qodefNavMenu.wideDropdownPosition();
			qodefNavMenu.dropdownPosition();
		},
		dropdownBehavior: function () {
			var $menuItems = $('.qodef-header-navigation > ul > li');

			$menuItems.each(function () {
				var $thisItem = $(this);

				if ($thisItem.find('.qodef-drop-down-second').length) {
					$thisItem.waitForImages(function () {
						var $dropdownHolder = $thisItem.find('.qodef-drop-down-second'),
							$dropdownMenuItem = $dropdownHolder.find('.qodef-drop-down-second-inner ul'),
							dropDownHolderHeight = $dropdownMenuItem.outerHeight();

						if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
							$thisItem.on("touchstart mouseenter", function () {
								$dropdownHolder.css({
									'height': dropDownHolderHeight,
									'overflow': 'visible',
									'visibility': 'visible',
									'opacity': '1'
								});
							}).on("mouseleave", function () {
								$dropdownHolder.css({
									'height': '0px',
									'overflow': 'hidden',
									'visibility': 'hidden',
									'opacity': '0'
								});
							});
						} else {
							if (qodefCore.body.hasClass('qodef-drop-down-second--animate-height')) {
								var animateConfig = {
									interval: 0,
									over: function () {
										setTimeout(function () {
											$dropdownHolder.addClass('qodef-drop-down--start').css({
												'visibility': 'visible',
												'height': '0',
												'opacity': '1'
											});
											$dropdownHolder.stop().animate({
												'height': dropDownHolderHeight
											}, 400, 'easeInOutQuint', function () {
												$dropdownHolder.css('overflow', 'visible');
											});
										}, 50);
									},
									timeout: 100,
									out: function () {
										$dropdownHolder.stop().animate({
											'height': '0',
											'opacity': 0
										}, 100, function () {
											$dropdownHolder.css({
												'overflow': 'hidden',
												'visibility': 'hidden'
											});
										});

										$dropdownHolder.removeClass('qodef-drop-down--start');
									}
								};

								$thisItem.hoverIntent(animateConfig);
							} else {
								var config = {
									interval: 0,
									over: function () {
										setTimeout(function () {
											$dropdownHolder.addClass('qodef-drop-down--start').stop().css({ 'height': dropDownHolderHeight });
										}, 150);
									},
									timeout: 150,
									out: function () {
										$dropdownHolder.stop().css({ 'height': '0' }).removeClass('qodef-drop-down--start');
									}
								};

								$thisItem.hoverIntent(config);
							}
						}
					});
				}
			});
		},
		wideDropdownPosition: function () {
			var $menuItems = $(".qodef-header-navigation > ul > li.qodef-menu-item--wide");

			if ($menuItems.length) {
				$menuItems.each(function () {
					var $menuItem = $(this);
					var $menuItemSubMenu = $menuItem.find('.qodef-drop-down-second');

					if ($menuItemSubMenu.length) {
						$menuItemSubMenu.css('left', 0);

						var leftPosition = $menuItemSubMenu.offset().left;

						if (qodefCore.body.hasClass('qodef--boxed')) {
							//boxed layout case
							var boxedWidth = $('.qodef--boxed #qodef-page-wrapper').outerWidth();
							leftPosition = leftPosition - (qodefCore.windowWidth - boxedWidth) / 2;
							$menuItemSubMenu.css({ 'left': -leftPosition, 'width': boxedWidth });

						} else if (qodefCore.body.hasClass('qodef-drop-down-second--full-width')) {
							//wide dropdown full width case
							$menuItemSubMenu.css({ 'left': -leftPosition });
						}
						else {
							//wide dropdown in grid case
							$menuItemSubMenu.css({ 'left': -leftPosition + (qodefCore.windowWidth - $menuItemSubMenu.width()) / 2 });
						}
					}
				});
			}
		},
		dropdownPosition: function () {
			var $menuItems = $('.qodef-header-navigation > ul > li.qodef-menu-item--narrow.menu-item-has-children');

			if ($menuItems.length) {
				$menuItems.each(function () {
					var $thisItem = $(this),
						menuItemPosition = $thisItem.offset().left,
						$dropdownHolder = $thisItem.find('.qodef-drop-down-second'),
						$dropdownMenuItem = $dropdownHolder.find('.qodef-drop-down-second-inner ul'),
						dropdownMenuWidth = $dropdownMenuItem.outerWidth(),
						menuItemFromLeft = $(window).width() - menuItemPosition;

					if (qodef.body.hasClass('qodef--boxed')) {
						//boxed layout case
						var boxedWidth = $('.qodef--boxed #qodef-page-wrapper').outerWidth();
						menuItemFromLeft = boxedWidth - menuItemPosition;
					}

					var dropDownMenuFromLeft;

					if ($thisItem.find('li.menu-item-has-children').length > 0) {
						dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
					}

					$dropdownHolder.removeClass('qodef-drop-down--right');
					$dropdownMenuItem.removeClass('qodef-drop-down--right');
					if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
						$dropdownHolder.addClass('qodef-drop-down--right');
						$dropdownMenuItem.addClass('qodef-drop-down--right');
					}
				});
			}
		}
	};

})(jQuery);
(function ($) {
    "use strict";

    $(window).on( 'load', function () {
        qodefParallaxBackground.init();
    });

    /**
     * Init global parallax background functionality
     */
    var qodefParallaxBackground = {
        init: function (settings) {
            this.$sections = $('.qodef-parallax');

            // Allow overriding the default config
            $.extend(this.$sections, settings);

            var isSupported = !qodefCore.html.hasClass('touchevents') && !qodefCore.body.hasClass('qodef-browser--edge') && !qodefCore.body.hasClass('qodef-browser--ms-explorer');

            if (this.$sections.length && isSupported) {
                this.$sections.each(function () {
                    qodefParallaxBackground.ready($(this));
                });
            }
        },
        ready: function ($section) {
            $section.$imgHolder = $section.find('.qodef-parallax-img-holder');
            $section.$imgWrapper = $section.find('.qodef-parallax-img-wrapper');
            $section.$img = $section.find('img');

            var h = $section.height(),
                imgWrapperH = $section.$imgWrapper.height();

            $section.movement = 300 * (imgWrapperH - h) / h / 2; //percentage (divided by 2 due to absolute img centering in CSS)

            $section.buffer = window.pageYOffset;
            $section.scrollBuffer = null;


            //calc and init loop
            requestAnimationFrame(function () {
                $section.$imgHolder.animate({ opacity: 1 }, 100);
                qodefParallaxBackground.calc($section);
                qodefParallaxBackground.loop($section);
            });

            //recalc
            $(window).on('resize', function () {
                qodefParallaxBackground.calc($section);
            });
        },
        calc: function ($section) {
            var wH = $section.$imgWrapper.height(),
                wW = $section.$imgWrapper.width();

            if ($section.$img.width() < wW) {
                $section.$img.css({
                    'width': '100%',
                    'height': 'auto'
                });
            }

            if ($section.$img.height() < wH) {
                $section.$img.css({
                    'height': '100%',
                    'width': 'auto',
                    'max-width': 'unset'
                });
            }
        },
        loop: function ($section) {
            if ($section.scrollBuffer === Math.round(window.pageYOffset)) {
                requestAnimationFrame(function () {
                    qodefParallaxBackground.loop($section);
                }); //repeat loop
                return false; //same scroll value, do nothing
            } else {
                $section.scrollBuffer = Math.round(window.pageYOffset);
            }

            var wH = window.outerHeight,
                sTop = $section.offset().top,
                sH = $section.height();

            if ($section.scrollBuffer + wH * 1.2 > sTop && $section.scrollBuffer < sTop + sH) {
                var delta = (Math.abs($section.scrollBuffer + wH - sTop) / (wH + sH)).toFixed(4), //coeff between 0 and 1 based on scroll amount
                    yVal = (delta * $section.movement).toFixed(4);

                if ($section.buffer !== delta) {
                    $section.$imgWrapper.css('transform', 'translate3d(0,' + yVal + '%, 0)');
                }

                $section.buffer = delta;
            }

            requestAnimationFrame(function () {
                qodefParallaxBackground.loop($section);
            }); //repeat loop
        }
    };

    qodefCore.qodefParallaxBackground = qodefParallaxBackground;

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefSideArea.init();
	});
	
	var qodefSideArea = {
		init: function () {
			var $sideAreaOpener = $('a.qodef-side-area-opener'),
				$sideAreaClose = $('#qodef-side-area-close'),
				$sideArea = $('#qodef-side-area');
				qodefSideArea.openerHoverColor($sideAreaOpener);
			// Open Side Area
			$sideAreaOpener.on('click', function (e) {
				e.preventDefault();
				
				if (!qodefCore.body.hasClass('qodef-side-area--opened')) {
					qodefSideArea.openSideArea();
					
					$(document).keyup(function (e) {
						if (e.keyCode === 27) {
							qodefSideArea.closeSideArea();
						}
					});
				} else {
					qodefSideArea.closeSideArea();
				}
			});
			
			$sideAreaClose.on('click', function (e) {
				e.preventDefault();
				qodefSideArea.closeSideArea();
			});
			
			if ($sideArea.length && typeof qodefCore.qodefPerfectScrollbar === 'object') {
				qodefCore.qodefPerfectScrollbar.init($sideArea);
			}
		},
		openSideArea: function () {
			var $wrapper = $('#qodef-page-wrapper');
			var currentScroll = $(window).scrollTop();

			$('.qodef-side-area-cover').remove();
			$wrapper.prepend('<div class="qodef-side-area-cover"/>');
			qodefCore.body.removeClass('qodef-side-area-animate--out').addClass('qodef-side-area--opened qodef-side-area-animate--in');

			$('.qodef-side-area-cover').on('click', function (e) {
				e.preventDefault();
				qodefSideArea.closeSideArea();
			});

			$(window).scroll(function () {
				if (Math.abs(qodefCore.scroll - currentScroll) > 400) {
					qodefSideArea.closeSideArea();
				}
			});

		},
		closeSideArea: function () {
			qodefCore.body.removeClass('qodef-side-area--opened qodef-side-area-animate--in').addClass('qodef-side-area-animate--out');
		},
		openerHoverColor: function ($opener) {
			if (typeof $opener.data('hover-color') !== 'undefined') {
				var hoverColor = $opener.data('hover-color');
				var originalColor = $opener.css('color');
				
				$opener.on('mouseenter', function () {
					$opener.css('color', hoverColor);
				}).on('mouseleave', function () {
					$opener.css('color', originalColor);
				});
			}
		}
	};
	
})(jQuery);

(function ($) {
	"use strict";

	$(document).ready(function () {
		qodefSpinner.init();
	});

	$(window).on('elementor/frontend/init', function () {
		var isEditMode = Boolean(elementorFrontend.isEditMode());
		if (isEditMode) {
			qodefSpinner.init(isEditMode);
		}
	});

	var qodefSpinner = {
		init: function (isEditMode) {
			this.holder = $('#qodef-page-spinner');

			if (this.holder.length) {
				qodefSpinner.animateSpinner(this.holder, isEditMode);
			}
		},
		animateSpinner: function ($holder, isEditMode) {
			$(window).on('load', function () {
				qodefSpinner.fadeOutLoader($holder);
			});

			if (isEditMode) {
				qodefSpinner.fadeOutLoader($holder);
			}
		},
		fadeOutLoader: function ($holder, speed, delay, easing) {
			speed = speed ? speed : 300;
			delay = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			var landingRev = $('#qodef-landing-rev').find('rs-module');
			if (landingRev.length) {
				$holder.hasClass('qodef-layout--lekker') ? delay = 1000 : null;
				setTimeout(function () {
					landingRev.revstart();
				}, 200);
			}

			$holder.delay(delay).fadeOut(speed, easing);

			$(window).on('bind', 'pageshow', function (event) {
				if (event.originalEvent.persisted) {
					$holder.fadeOut(speed, easing);
				}
			});
		}
	}

})(jQuery);
(function ($) {
    "use strict";

    $(window).on( 'load', function () {
        qodefStickyColumn.init('init');
    });

    $(window).resize(function () {
        qodefStickyColumn.init('resize');
    });

    var qodefStickyColumn = {
        pageOffset: '',
        scrollAmount: '',

        init: function (state) {
            var $holder = $('.qodef-sticky-column'),
                editor = $holder.hasClass('wpb_column') ? 'wp_bakery' : 'elementor';

            if ($holder.length) {
                $holder.each(function () {
                    qodefStickyColumn.calculateVars($(this), state, editor);
                });
            }
        },
        calculateVars: function ($column, state, editor) {
            var columnVars = {};

            if ('wp_bakery' === editor) {
                columnVars.$columnInner = $column.find('.vc_column-inner');
            } else {
                columnVars.$columnInner = $column.find('.elementor-column-wrap');
            }

            columnVars.columnTopEdgePosition = $column.offset().top;
            columnVars.columnLeftEdgePosition = $column.offset().left;
            columnVars.columnWidth = $column.outerWidth();
            columnVars.columnHeight = columnVars.$columnInner.outerHeight();

            if ('wp_bakery' === editor) {
                columnVars.$row = $column.closest('.vc_row');
            } else {
                columnVars.$row = $column.closest('.elementor-section');
            }

            columnVars.rowTopEdgePosition = columnVars.$row.offset().top;
            columnVars.rowHeight = columnVars.$row.outerHeight();
            columnVars.rowBottomEdgePosition = columnVars.rowTopEdgePosition + columnVars.rowHeight;

            qodefStickyColumn.scrollAmount = qodef.scroll;

            qodefStickyColumn.checkPosition(columnVars);

            $(window).scroll(function () {
                if ('init' === state) {
                    var scrollDirection = qodefStickyColumn.checkScrollDirection();
                }

                qodefStickyColumn.checkPosition(columnVars, scrollDirection);
            });
        },
        checkPosition: function (columnVars, direction) {
            if (qodef.windowWidth > 1024) {
                qodefStickyColumn.calculateOffset();

                if ((qodef.scroll + qodefStickyColumn.pageOffset) <= columnVars.columnTopEdgePosition) {
                    qodefStickyColumn.setPosition(columnVars, 'relative');
                }
                if ((qodef.scroll + qodefStickyColumn.pageOffset) >= columnVars.columnTopEdgePosition) {
                    qodefStickyColumn.setPosition(columnVars, 'fixed', direction);
                    // console.log(qodef.scroll);
                    // console.log(qodefStickyColumn.pageOffset);
                    // console.log(columnVars.columnTopEdgePosition);
                    // console.log(columnVars.columnHeight);
                    // console.log(columnVars.rowBottomEdgePosition);
                }
                if ((qodef.scroll + qodefStickyColumn.pageOffset + columnVars.columnHeight) + columnVars.columnHeight / 2 >= columnVars.rowBottomEdgePosition) {
                    qodefStickyColumn.setPosition(columnVars, 'absolute');

                }
            } else {
                qodefStickyColumn.setPosition(columnVars, 'relative');
            }
        },
        calculateOffset: function () {
            qodefStickyColumn.pageOffset = 0;

            if ($('body').hasClass('admin-bar')) {
                qodefStickyColumn.pageOffset += 32;
            }

            if ($('body').hasClass('qodef-header--sticky-display')) {
                qodefStickyColumn.pageOffset += parseInt($('.qodef-header-sticky').outerHeight());
            }

            if ($('body').hasClass('qodef-header--fixed-display')) {
                qodefStickyColumn.pageOffset += parseInt($('#qodef-page-header').outerHeight());
                qodefStickyColumn.pageOffset += parseInt($('#qodef-page-header').css('margin-top'));
            }
        },
        checkScrollDirection: function () {
            var scrollDirection = (qodef.scroll > qodefStickyColumn.scrollAmount) ? 'down' : 'up';

            qodefStickyColumn.scrollAmount = qodef.scroll;

            return scrollDirection;
        },
        setPosition: function (columnVars, position, direction) {

            if ('relative' === position) {
                columnVars.$columnInner.css({
                    'bottom': 'auto',
                    'left': 'auto',
                    'position': 'relative',
                    'top': 'auto',
                    'width': columnVars.columnWidth,
                    'transform': 'translateY(0)',
                    'transition': 'none'
                });
            }
            if ('fixed' === position) {
                if ($('body').hasClass('qodef-header--sticky-display')) {
                    var transitionValue = ('up' === direction) ? 'none' : 'transform .5s ease';
                }

                columnVars.$columnInner.css({
                    'bottom': 'auto',
                    'left': columnVars.columnLeftEdgePosition,
                    'position': 'fixed',
                    'top': 0,
                    'width': columnVars.columnWidth,
                    'transform': 'translateY(' + qodefStickyColumn.pageOffset + 'px)',
                    'transition': transitionValue
                });
            }
            if ('absolute' === position) {
                columnVars.$columnInner.css({
                    'top': columnVars.rowHeight / 2,
                    'left': '0',
                    'position': 'absolute',
                    'width': columnVars.columnWidth,
                    'transform': 'translateY(0)',
                    'transition': 'none'
                });
            }
        }
    };
    window.qodefStickyColumn = qodefStickyColumn;
})(jQuery);
(function ($) {
    "use strict";

    $(window).on( 'load', function () {
        qodefSubscribeModal.init();
    });

    var qodefSubscribeModal = {
        init: function () {
            this.holder = $('#qodef-subscribe-popup-modal');

            if (this.holder.length) {
                var $preventHolder = this.holder.find('.qodef-sp-prevent'),
                    $modalClose = $('.qodef-sp-close'),
                    disabledPopup = 'no';

                if ($preventHolder.length) {
                    var isLocalStorage = this.holder.hasClass('qodef-sp-prevent-cookies'),
                        $preventInput = $preventHolder.find('.qodef-sp-prevent-input'),
                        preventValue = $preventInput.data('value');

                    if (isLocalStorage) {
                        disabledPopup = localStorage.getItem('disabledPopup');
                        sessionStorage.removeItem('disabledPopup');
                    } else {
                        disabledPopup = sessionStorage.getItem('disabledPopup');
                        localStorage.removeItem('disabledPopup');
                    }

                    $preventHolder.children().on('click', function (e) {
                        if (preventValue !== 'yes') {
                            preventValue = 'yes';
                            $preventInput.addClass('qodef-sp-prevent-clicked').data('value', 'yes');
                        } else {
                            preventValue = 'no';
                            $preventInput.removeClass('qodef-sp-prevent-clicked').data('value', 'no');
                        }

                        if (preventValue === 'yes') {
                            if (isLocalStorage) {
                                localStorage.setItem('disabledPopup', 'yes');
                            } else {
                                sessionStorage.setItem('disabledPopup', 'yes');
                            }
                        } else {
                            if (isLocalStorage) {
                                localStorage.setItem('disabledPopup', 'no');
                            } else {
                                sessionStorage.setItem('disabledPopup', 'no');
                            }
                        }
                    });
                }

                if (disabledPopup !== 'yes') {
                    if (qodefCore.body.hasClass('qodef-sp-opened')) {
                        qodefSubscribeModal.handleClassAndScroll('remove');
                    } else {
                        qodefSubscribeModal.handleClassAndScroll('add');
                    }

                    $modalClose.on('click', function (e) {
                        e.preventDefault();

                        qodefSubscribeModal.handleClassAndScroll('remove');
                    });

                    // Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) { // KeyCode for ESC button is 27
                            qodefSubscribeModal.handleClassAndScroll('remove');
                        }
                    });
                }
            }
        },

        handleClassAndScroll: function (option) {
            if (option === 'remove') {
                qodefCore.body.removeClass('qodef-sp-opened');
                qodefCore.qodefScroll.enable();
            }
            if (option === 'add') {
                qodefCore.body.addClass('qodef-sp-opened');
                qodefCore.qodefScroll.disable();
            }
        },
    };

})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.lekker_core_accordion = {};

	$(document).ready(function () {
		qodefAccordion.init();
	});
	
	var qodefAccordion = {
		init: function () {
			this.holder = $('.qodef-accordion');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					
					if ($thisHolder.hasClass('qodef-behavior--accordion')) {
						qodefAccordion.initAccordion($thisHolder);
					}
					
					if ($thisHolder.hasClass('qodef-behavior--toggle')) {
						qodefAccordion.initToggle($thisHolder);
					}
					
					$thisHolder.addClass('qodef--init');
				});
			}
		},
		initAccordion: function ($accordion) {
			$accordion.accordion({
				animate: "swing",
				collapsible: true,
				active: 0,
				icons: "",
				heightStyle: "content"
			});
		},
		initToggle: function ($toggle) {
			var $toggleAccordionTitle = $toggle.find('.qodef-accordion-title'),
				$toggleAccordionContent = $toggleAccordionTitle.next();
			
			$toggle.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
			$toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
			$toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();
			
			$toggleAccordionTitle.each(function () {
				var $thisTitle = $(this);
				
				$thisTitle.hover(function () {
					$thisTitle.toggleClass("ui-state-hover");
				});
				
				$thisTitle.on('click', function () {
					$thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
					$thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
				});
			});
		}
	};

	qodefCore.shortcodes.lekker_core_accordion.qodefAccordion = qodefAccordion;

})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.lekker_core_button = {};

	$(document).ready(function () {
		qodefButton.init();
	});
	
	var qodefButton = {
		init: function () {
			this.buttons = $('.qodef-button');
			
			if (this.buttons.length) {
				this.buttons.each(function () {
					var $thisButton = $(this);
					
					qodefButton.buttonHoverColor($thisButton);
					qodefButton.buttonHoverBgColor($thisButton);
					qodefButton.buttonHoverBorderColor($thisButton);
				});
			}
		},
		buttonHoverColor: function ($button) {
			if (typeof $button.data('hover-color') !== 'undefined') {
				var hoverColor = $button.data('hover-color');
				var originalColor = $button.css('color');
				
				$button.on('mouseenter', function () {
					qodefButton.changeColor($button, 'color', hoverColor);
				});
				$button.on('mouseleave', function () {
					qodefButton.changeColor($button, 'color', originalColor);
				});
			}
		},
		buttonHoverBgColor: function ($button) {
			if (typeof $button.data('hover-background-color') !== 'undefined') {
				var hoverBackgroundColor = $button.data('hover-background-color');
				var originalBackgroundColor = $button.css('background-color');
				
				$button.on('mouseenter', function () {
					qodefButton.changeColor($button, 'background-color', hoverBackgroundColor);
				});
				$button.on('mouseleave', function () {
					qodefButton.changeColor($button, 'background-color', originalBackgroundColor);
				});
			}
		},
		buttonHoverBorderColor: function ($button) {
			if (typeof $button.data('hover-border-color') !== 'undefined') {
				var hoverBorderColor = $button.data('hover-border-color');
				var originalBorderColor = $button.css('borderTopColor');
				
				$button.on('mouseenter', function () {
					qodefButton.changeColor($button, 'border-color', hoverBorderColor);
				});
				$button.on('mouseleave', function () {
					qodefButton.changeColor($button, 'border-color', originalBorderColor);
				});
			}
		},
		changeColor: function ($button, cssProperty, color) {
			$button.css(cssProperty, color);
		}
	};

	qodefCore.shortcodes.lekker_core_button.qodefButton = qodefButton;


})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.lekker_core_countdown = {};

	$(document).ready(function () {
		qodefCountdown.init();
	});
	
	var qodefCountdown = {
		init: function () {
			this.countdowns = $('.qodef-countdown');
			
			if (this.countdowns.length) {
				this.countdowns.each(function () {
					var $thisCountdown = $(this),
						$countdownElement = $thisCountdown.find('.qodef-m-date'),
						options = qodefCountdown.generateOptions($thisCountdown);
					
					qodefCountdown.initCountdown($countdownElement, options);
				});
			}
		},
		generateOptions: function($countdown) {
			var options = {};
			options.date = typeof $countdown.data('date') !== 'undefined' ? $countdown.data('date') : null;
			
			options.weekLabel = typeof $countdown.data('week-label') !== 'undefined' ? $countdown.data('week-label') : '';
			options.weekLabelPlural = typeof $countdown.data('week-label-plural') !== 'undefined' ? $countdown.data('week-label-plural') : '';
			
			options.dayLabel = typeof $countdown.data('day-label') !== 'undefined' ? $countdown.data('day-label') : '';
			options.dayLabelPlural = typeof $countdown.data('day-label-plural') !== 'undefined' ? $countdown.data('day-label-plural') : '';
			
			options.hourLabel = typeof $countdown.data('hour-label') !== 'undefined' ? $countdown.data('hour-label') : '';
			options.hourLabelPlural = typeof $countdown.data('hour-label-plural') !== 'undefined' ? $countdown.data('hour-label-plural') : '';
			
			options.minuteLabel = typeof $countdown.data('minute-label') !== 'undefined' ? $countdown.data('minute-label') : '';
			options.minuteLabelPlural = typeof $countdown.data('minute-label-plural') !== 'undefined' ? $countdown.data('minute-label-plural') : '';
			
			options.secondLabel = typeof $countdown.data('second-label') !== 'undefined' ? $countdown.data('second-label') : '';
			options.secondLabelPlural = typeof $countdown.data('second-label-plural') !== 'undefined' ? $countdown.data('second-label-plural') : '';
			
			return options;
		},
		initCountdown: function ($countdownElement, options) {
			var $weekHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%w</span><span class="qodef-label">' + '%!w:' + options.weekLabel + ',' + options.weekLabelPlural + ';</span></span>';
			var $dayHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%d</span><span class="qodef-label">' + '%!d:' + options.dayLabel + ',' + options.dayLabelPlural + ';</span></span>';
			var $hourHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%H</span><span class="qodef-label">' + '%!H:' + options.hourLabel + ',' + options.hourLabelPlural + ';</span></span>';
			var $minuteHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%M</span><span class="qodef-label">' + '%!M:' + options.minuteLabel + ',' + options.minuteLabelPlural + ';</span></span>';
			var $secondHTML = '<span class="qodef-digit-wrapper"><span class="qodef-digit">%S</span><span class="qodef-label">' + '%!S:' + options.secondLabel + ',' + options.secondLabelPlural + ';</span></span>';
			
			$countdownElement.countdown(options.date, function(event) {
				$(this).html(event.strftime($weekHTML + $dayHTML + $hourHTML + $minuteHTML + $secondHTML));
			});
		}
	};

	qodefCore.shortcodes.lekker_core_countdown.qodefCountdown  = qodefCountdown;


})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.lekker_core_counter = {};

	$(document).ready(function () {
		qodefCounter.init();
	});

	var qodefCounter = {
		init: function () {
			this.counters = $('.qodef-counter');

			if (this.counters.length) {
				this.counters.each(function () {
					var $thisCounter = $(this),
						$counterElement = $thisCounter.find('.qodef-m-digit'),
						options = qodefCounter.generateOptions($thisCounter);

					qodefCounter.counterScript($counterElement, options);
				});
			}
		},
		generateOptions: function ($counter) {
			var options = {};
			options.start = typeof $counter.data('start-digit') !== 'undefined' && $counter.data('start-digit') !== '' ? $counter.data('start-digit') : 0;
			options.end = typeof $counter.data('end-digit') !== 'undefined' && $counter.data('end-digit') !== '' ? $counter.data('end-digit') : null;
			options.step = typeof $counter.data('step-digit') !== 'undefined' && $counter.data('step-digit') !== '' ? $counter.data('step-digit') : 1;
			options.delay = typeof $counter.data('step-delay') !== 'undefined' && $counter.data('step-delay') !== '' ? parseInt($counter.data('step-delay'), 10) : 100;
			options.txt = typeof $counter.data('digit-label') !== 'undefined' && $counter.data('digit-label') !== '' ? $counter.data('digit-label') : '';

			return options;
		},
		counterScript: function ($counterElement, options) {
			var defaults = {
				start: 0,
				end: null,
				step: 1,
				delay: 60,
				txt: ""
			};

			var settings = $.extend(defaults, options || {});
			var nb_start = settings.start;
			var nb_end = settings.end;

			$counterElement.text(nb_start + settings.txt);

			var counter = function () {
				// Definition of conditions of arrest
				if (nb_end !== null && nb_start >= nb_end) {
					return;
				}
				// incrementation
				nb_start = nb_start + settings.step;

				if (nb_start >= nb_end) {
					nb_start = nb_end;
				}
				// display
				$counterElement.text(nb_start + settings.txt);
			};

			// Timer
			// Launches every "settings.delay"
			$counterElement.appear(function () {
				setInterval(counter, settings.delay);
			}, { accX: 0, accY: 0 });
		}
	};

	qodefCore.shortcodes.lekker_core_counter.qodefCounter = qodefCounter;

})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.lekker_core_google_map = {};

	$(document).ready(function () {
		qodefGoogleMap.init();
	});
	
	var qodefGoogleMap = {
		init: function () {
			this.holder = $('.qodef-google-map');
			
			if (this.holder.length) {
				this.holder.each(function () {
					if (qodefCore.qodefGoogleMap !== undefined) {
						qodefCore.qodefGoogleMap.initMap($(this).find('.qodef-m-map'));
					}
				});
			}
		}
	};
	qodefCore.shortcodes.lekker_core_google_map.qodefGoogleMap  = qodefGoogleMap;
})(jQuery);
(function ($) {
    "use strict";

	qodefCore.shortcodes.lekker_core_icon = {};

    $(document).ready(function () {
        qodefIcon.init();
    });

    var qodefIcon = {
        init: function () {
            this.icons = $('.qodef-icon-holder');

            if (this.icons.length) {
                this.icons.each(function () {
                    var $thisIcon = $(this);

                    qodefIcon.iconHoverColor($thisIcon);
                    qodefIcon.iconHoverBgColor($thisIcon);
                    qodefIcon.iconHoverBorderColor($thisIcon);
                });
            }
        },
        iconHoverColor: function ($iconHolder) {
            if (typeof $iconHolder.data('hover-color') !== 'undefined') {
                var spanHolder = $iconHolder.find('span');
                var originalColor = spanHolder.css('color');
                var hoverColor = $iconHolder.data('hover-color');

                $iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor(spanHolder, 'color', hoverColor);
                });
                $iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor(spanHolder, 'color', originalColor);
                });
            }
        },
        iconHoverBgColor: function ($iconHolder) {
            if (typeof $iconHolder.data('hover-background-color') !== 'undefined') {
                var hoverBackgroundColor = $iconHolder.data('hover-background-color');
                var originalBackgroundColor = $iconHolder.css('background-color');

                $iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor($iconHolder, 'background-color', hoverBackgroundColor);
                });
                $iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor($iconHolder, 'background-color', originalBackgroundColor);
                });
            }
        },
        iconHoverBorderColor: function ($iconHolder) {
            if (typeof $iconHolder.data('hover-border-color') !== 'undefined') {
                var hoverBorderColor = $iconHolder.data('hover-border-color');
                var originalBorderColor = $iconHolder.css('borderTopColor');

                $iconHolder.on('mouseenter', function () {
                    qodefIcon.changeColor($iconHolder, 'border-color', hoverBorderColor);
                });
                $iconHolder.on('mouseleave', function () {
                    qodefIcon.changeColor($iconHolder, 'border-color', originalBorderColor);
                });
            }
        },
        changeColor: function (iconElement, cssProperty, color) {
            iconElement.css(cssProperty, color);
        }
    };

	qodefCore.shortcodes.lekker_core_icon.qodefIcon = qodefIcon;

})(jQuery);
(function ($) {
    "use strict";
	qodefCore.shortcodes.lekker_core_image_gallery = {};
	qodefCore.shortcodes.lekker_core_image_gallery.qodefSwiper = qodef.qodefSwiper;
	qodefCore.shortcodes.lekker_core_image_gallery.qodefMasonryLayout = qodef.qodefMasonryLayout;

})(jQuery);
(function ($) {
    "use strict";

    qodefCore.shortcodes.lekker_core_image_with_text = {};
    qodefCore.shortcodes.lekker_core_image_with_text.qodefMagnificPopup = qodef.qodefMagnificPopup;

    $(document).ready(function () {
        qodefScrollingImageWithText.init();
    });

    var qodefScrollingImageWithText = {
        init: function () {
            var $holder = $('.qodef-image-with-text.qodef-image-action--scrolling-image');

            if ($holder.length) {
                $holder.each(function () {
                    var $thisHolder = $(this),
                        $imageHolder = $thisHolder.find('.qodef-m-image-inner-holder'),
                        $scrollingImage = $thisHolder.find('.qodef-m-image img'),
                        $scrollingFrame = $thisHolder.find('.qodef-m-iwt-frame'),
                        horizontal = $thisHolder.hasClass('qodef-scrolling-direction--horizontal'),
                        state;

                    var initAnimation = function () {
                        state = qodefScrollingImageWithText.sizing($scrollingImage, $scrollingFrame, horizontal);
                        qodefScrollingImageWithText.scrollAnimation($imageHolder, $scrollingImage, state);
                    }

                    $thisHolder.waitForImages(function () {
                        initAnimation();
                    });

                    $(window).resize(function () {
                        initAnimation();
                    });
                });
            }
        },
        sizing: function ($scrollingImage, $scrollingFrame, horizontal) {
            var scrollingFrameHeight = $scrollingFrame.height(),
                scrollingImageHeight = $scrollingImage.height(),
                scrollingFrameWidth = $scrollingFrame.width(),
                scrollingImageWidth = $scrollingImage.width(),
                delta,
                timing,
                scrollable = false;

            if (horizontal) {
                delta = Math.round(scrollingImageWidth - scrollingFrameWidth);
                timing = Math.round(scrollingImageWidth / scrollingFrameWidth) * 1.8;
            } else {
                delta = Math.round(scrollingImageHeight - scrollingFrameHeight);
                timing = Math.round(scrollingImageHeight / scrollingFrameHeight) * 1.8;
            }

            if (horizontal) {
                if (scrollingImageWidth > scrollingFrameWidth) {
                    scrollable = true;
                }
            } else {
                if (scrollingImageHeight > scrollingFrameHeight) {
                    scrollable = true;
                }
            }

            return {
                delta: delta,
                timing: timing,
                scrollable: scrollable,
                horizontal: horizontal
            }
        },
        scrollAnimation: function ($thisHolder, $scrollingImage, state) {
            //scroll animation on hover
            $thisHolder.mouseenter(function () {
                $scrollingImage.css('transition-duration', state.timing + 's'); //transition duration set in relation to image height
                if (state.horizontal) {
                    $scrollingImage.css('transform', 'translate3d(-' + state.delta + 'px, 0px, 0px)');
                } else {
                    $scrollingImage.css('transform', 'translate3d(0px, -' + state.delta + 'px, 0px)');
                }
            });

            //scroll animation reset
            $thisHolder.mouseleave(function () {
                if (state.scrollable) {
                    $scrollingImage.css('transition-duration', Math.min(state.timing / 3, 3) + 's');
                    $scrollingImage.css('transform', 'translate3d(0px, 0px, 0px)');
                }
            });
        }
    };

})(jQuery);
(function ($) {
    "use strict";

	qodefCore.shortcodes.lekker_core_interactive_link_showcase = {};

})(jQuery);
(function ($) {
	'use strict';

	qodefCore.shortcodes.lekker_core_progress_bar = {};

	$(document).ready(function () {
		qodefProgressBar.init();
	});

	/**
	 * Init progress bar shortcode functionality
	 */
	var qodefProgressBar = {
		init: function () {
			this.holder = $('.qodef-progress-bar');

			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this),
						layout = $thisHolder.data('layout'),
						data = qodefProgressBar.generateBarData($thisHolder, layout),
						container = '#qodef-m-canvas-' + $thisHolder.data('rand-number'),
						number = $thisHolder.data('number') / 100;
					if (!$(container).hasClass('qodef-m-initialized')) {
						$(container).addClass('qodef-m-initialized');
						switch (layout) {
							case 'circle':
								qodefProgressBar.initCircleBar(container, data, number);
								break;
							case 'semi-circle':
								qodefProgressBar.initSemiCircleBar(container, data, number);
								break;
							case 'line':
								number = $thisHolder.data('number');
								container = $thisHolder.find('.qodef-m-canvas');
								data = qodefProgressBar.generateLineData($thisHolder, layout, number);
								qodefProgressBar.initLineBar(container, data);
								break;
							case 'custom':
								container = "#" + $thisHolder.data('custom-shape-id');
								qodefProgressBar.initCustomBar(container, data, number);
								break;
						}
					}
				});
			}
		},
		generateBarData: function (thisBar, layout) {
			var activeWidth = thisBar.data('active-line-width');
			var activeColor = thisBar.data('active-line-color');
			var inactiveWidth = thisBar.data('inactive-line-width');
			var inactiveColor = thisBar.data('inactive-line-color');
			var easing = 'swing';
			var duration = 1400;
			var textColor = thisBar.data('text-color');

			return {
				strokeWidth: activeWidth,
				color: activeColor,
				trailWidth: inactiveWidth,
				trailColor: inactiveColor,
				easing: easing,
				duration: duration,
				svgStyle: {
					width: '100%',
					height: '100%'
				},
				text: {
					style: {
						color: textColor
					},
					autoStyleContainer: false
				},
				from: {
					color: inactiveColor
				},
				to: {
					color: activeColor
				},
				step: function (state, bar) {
					if (layout !== 'custom') {
						bar.setText(Math.round(bar.value() * 100) + '%');
					}
				}
			};
		},
		generateLineData: function (thisBar, layout, number) {
			var height = thisBar.data('active-line-width');
			var activeColor = thisBar.data('active-line-color');
			var inactiveHeight = thisBar.data('inactive-line-width');
			var inactiveColor = thisBar.data('inactive-line-color');
			var duration = 800;
			var textColor = thisBar.data('text-color');

			return {
				percentage: number,
				duration: duration,
				fillBackgroundColor: activeColor,
				backgroundColor: inactiveColor,
				height: height,
				inactiveHeight: inactiveHeight,
				followText: true,
				textColor: textColor
			};
		},
		initCircleBar: function (container, data, number) {
			var bar = new ProgressBar.Circle(container, data);

			$(container).appear(function () {
				bar.animate(number);
			});
		},
		initSemiCircleBar: function (container, data, number) {
			var bar = new ProgressBar.SemiCircle(container, data);

			$(container).appear(function () {
				bar.animate(number);
			});
		},
		initCustomBar: function (container, data, number) {
			var bar = new ProgressBar.Path(container, data);
			bar.set(0);

			$(container).appear(function () {
				bar.animate(number);
			});
		},
		initLineBar: function (container, data) {
			$(container).appear(function () {
				container.LineProgressbar(data);
			});
		}
	};

	qodefCore.shortcodes.lekker_core_progress_bar.qodefProgressBar = qodefProgressBar;

})(jQuery);
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
(function ($) {
	"use strict";

	qodefCore.shortcodes.lekker_core_tabs = {};

	$(document).ready(function () {
		qodefTabs.init();
	});
	
	var qodefTabs = {
		init: function () {
			this.holder = $('.qodef-tabs');
			
			if (this.holder.length) {
				this.holder.each(function () {
					qodefTabs.initTabs($(this));
				});
			}
		},
		initTabs: function ($tabs) {
			$tabs.children('.qodef-tabs-content').each(function (index) {
				index = index + 1;
				
				var $that = $(this),
					link = $that.attr('id'),
					$navItem = $that.parent().find('.qodef-tabs-navigation li:nth-child(' + index + ') a'),
					navLink = $navItem.attr('href');
				
				link = '#' + link;
				
				if (link.indexOf(navLink) > -1) {
					$navItem.attr('href', link);
				}
			});
			
			$tabs.addClass('qodef--init').tabs();
		}
	};

	qodefCore.shortcodes.lekker_core_tabs.qodefTabs = qodefTabs;

})(jQuery);
(function ($) {
	"use strict";

	qodefCore.shortcodes.lekker_core_text_marquee = {};

	$(document).ready(function () {
		qodefTextMarquee.init();
	});
	
	var qodefTextMarquee = {
		init: function () {
			this.holder = $('.qodef-text-marquee');
			
			if (this.holder.length) {
				this.holder.each(function () {
					qodefTextMarquee.initMarquee($(this));
					qodefTextMarquee.initResponsive($(this).find('.qodef-m-content'));
				});
			}
		},
		initResponsive: function (thisMarquee) {
			var fontSize,
				lineHeight,
				coef1 = 1,
				coef2 = 1;
			
			if (qodefCore.windowWidth < 1480) {
				coef1 = 0.8;
			}
			
			if (qodefCore.windowWidth < 1200) {
				coef1 = 0.7;
			}
			
			if (qodefCore.windowWidth < 768) {
				coef1 = 0.55;
				coef2 = 0.65;
			}
			
			if (qodefCore.windowWidth < 600) {
				coef1 = 0.45;
				coef2 = 0.55;
			}
			
			if (qodefCore.windowWidth < 480) {
				coef1 = 0.4;
				coef2 = 0.5;
			}
			
			fontSize = parseInt(thisMarquee.css('font-size'));
			
			if (fontSize > 200) {
				fontSize = Math.round(fontSize * coef1);
			} else if (fontSize > 60) {
				fontSize = Math.round(fontSize * coef2);
			}
			
			thisMarquee.css('font-size', fontSize + 'px');
			
			lineHeight = parseInt(thisMarquee.css('line-height'));
			
			if (lineHeight > 70 && qodefCore.windowWidth < 1440) {
				lineHeight = '1.2em';
			} else if (lineHeight > 35 && qodefCore.windowWidth < 768) {
				lineHeight = '1.2em';
			} else {
				lineHeight += 'px';
			}
			
			thisMarquee.css('line-height', lineHeight);
		},
		initMarquee: function (thisMarquee) {
			var elements = thisMarquee.find('.qodef-m-text'),
				delta = 0.05;
			
			elements.each(function (i) {
				$(this).data('x', 0);
			});
			
			requestAnimationFrame(function () {
				qodefTextMarquee.loop(thisMarquee, elements, delta);
			});
		},
		inRange: function (thisMarquee) {
			if (qodefCore.scroll + qodefCore.windowHeight >= thisMarquee.offset().top && qodefCore.scroll < thisMarquee.offset().top + thisMarquee.height()) {
				return true;
			}
			
			return false;
		},
		loop: function (thisMarquee, elements, delta) {
			if (!qodefTextMarquee.inRange(thisMarquee)) {
				requestAnimationFrame(function () {
					qodefTextMarquee.loop(thisMarquee, elements, delta);
				});
				return false;
			} else {
				elements.each(function (i) {
					var el = $(this);
					el.css('transform', 'translate3d(' + el.data('x') + '%, 0, 0)');
					el.data('x', (el.data('x') - delta).toFixed(2));
					el.offset().left < -el.width() - 25 && el.data('x', 100 * Math.abs(i - 1));
				});
				requestAnimationFrame(function () {
					qodefTextMarquee.loop(thisMarquee, elements, delta);
				});
			}
		}
	};

	qodefCore.shortcodes.lekker_core_text_marquee.qodefTextMarquee = qodefTextMarquee;

})(jQuery);
(function ($) {
    "use strict";

	qodefCore.shortcodes.lekker_core_video_button = {};
    qodefCore.shortcodes.lekker_core_video_button.qodefMagnificPopup = qodef.qodefMagnificPopup;

})(jQuery);
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
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefVerticalNavMenu.init();
	});
	
	/**
	 * Function object that represents vertical menu area.
	 * @returns {{init: Function}}
	 */
	var qodefVerticalNavMenu = {
		initNavigation: function ($verticalMenuObject) {
			var $verticalNavObject = $verticalMenuObject.find('.qodef-header-vertical-navigation');
			
			if ($verticalNavObject.hasClass('qodef-vertical-drop-down--below')) {
				qodefVerticalNavMenu.dropdownClickToggle($verticalNavObject);
			} else if ($verticalNavObject.hasClass('qodef-vertical-drop-down--side')) {
				qodefVerticalNavMenu.dropdownFloat($verticalNavObject);
			}
		},
		dropdownClickToggle: function ($verticalNavObject) {
			var $menuItems = $verticalNavObject.find('ul li.menu-item-has-children');
			
			$menuItems.each(function () {
				var $elementToExpand = $(this).find(' > .qodef-drop-down-second, > ul');
				var menuItem = this;
				var $dropdownOpener = $(this).find('> a');
				var slideUpSpeed = 'fast';
				var slideDownSpeed = 'slow';
				
				$dropdownOpener.on('click tap', function (e) {
					e.preventDefault();
					e.stopPropagation();
					
					if ($elementToExpand.is(':visible')) {
						$(menuItem).removeClass('qodef-menu-item--open');
						$elementToExpand.slideUp(slideUpSpeed);
					} else if ($dropdownOpener.parent().parent().children().hasClass('qodef-menu-item--open') && $dropdownOpener.parent().parent().parent().hasClass('qodef-vertical-menu')) {
						$(this).parent().parent().children().removeClass('qodef-menu-item--open');
						$(this).parent().parent().children().find(' > .qodef-drop-down-second').slideUp(slideUpSpeed);
						
						$(menuItem).addClass('qodef-menu-item--open');
						$elementToExpand.slideDown(slideDownSpeed);
					} else {
						
						if (!$(this).parents('li').hasClass('qodef-menu-item--open')) {
							$menuItems.removeClass('qodef-menu-item--open');
							$menuItems.find(' > .qodef-drop-down-second, > ul').slideUp(slideUpSpeed);
						}
						
						if ($(this).parent().parent().children().hasClass('qodef-menu-item--open')) {
							$(this).parent().parent().children().removeClass('qodef-menu-item--open');
							$(this).parent().parent().children().find(' > .qodef-drop-down-second, > ul').slideUp(slideUpSpeed);
						}
						
						$(menuItem).addClass('qodef-menu-item--open');
						$elementToExpand.slideDown(slideDownSpeed);
					}
				});
			});
		},
		dropdownFloat: function ($verticalNavObject) {
			var $menuItems = $verticalNavObject.find('ul li.menu-item-has-children');
			var $allDropdowns = $menuItems.find(' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul');
			
			$menuItems.each(function () {
				var $elementToExpand = $(this).find(' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul');
				var menuItem = this;
				
				if (Modernizr.touch) {
					var $dropdownOpener = $(this).find('> a');
					
					$dropdownOpener.on('click tap', function (e) {
						e.preventDefault();
						e.stopPropagation();
						
						if ($elementToExpand.hasClass('qodef-float--open')) {
							$elementToExpand.removeClass('qodef-float--open');
							$(menuItem).removeClass('qodef-menu-item--open');
						} else {
							if (!$(this).parents('li').hasClass('qodef-menu-item--open')) {
								$menuItems.removeClass('qodef-menu-item--open');
								$allDropdowns.removeClass('qodef-float--open');
							}
							
							$elementToExpand.addClass('qodef-float--open');
							$(menuItem).addClass('qodef-menu-item--open');
						}
					});
				} else {
					//must use hoverIntent because basic hover effect doesn't catch dropdown
					//it doesn't start from menu item's edge
					$(this).hoverIntent({
						over: function () {
							$elementToExpand.addClass('qodef-float--open');
							$(menuItem).addClass('qodef-menu-item--open');
						},
						out: function () {
							$elementToExpand.removeClass('qodef-float--open');
							$(menuItem).removeClass('qodef-menu-item--open');
						},
						timeout: 300
					});
				}
			});
		},
		verticalAreaScrollable: function ($verticalMenuObject) {
			return $verticalMenuObject.hasClass('qodef-with-scroll');
		},
		initVerticalAreaScroll: function ($verticalMenuObject) {
			if (qodefVerticalNavMenu.verticalAreaScrollable($verticalMenuObject) && typeof qodefCore.qodefPerfectScrollbar === 'object') {
				qodefCore.qodefPerfectScrollbar.init($verticalMenuObject);
			}
		},
		init: function () {
			var $verticalMenuObject = $('.qodef-header--vertical #qodef-page-header');
			
			if ($verticalMenuObject.length) {
				qodefVerticalNavMenu.initNavigation($verticalMenuObject);
				qodefVerticalNavMenu.initVerticalAreaScroll($verticalMenuObject);
			}
		}
	};
	
})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefVerticalSlidingNavMenu.init();
    });

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var qodefVerticalSlidingNavMenu = {
        initNavigation: function ($verticalSlidingMenuObject) {
            var $verticalSlidingNavObject = $verticalSlidingMenuObject.find('.qodef-header-vertical-sliding-navigation');

            if ($verticalSlidingNavObject.hasClass('qodef-vertical-sliding-drop-down--below')) {
                qodefVerticalSlidingNavMenu.dropdownClickToggle($verticalSlidingNavObject);
            } else if ($verticalSlidingNavObject.hasClass('qodef-vertical-sliding-drop-down--side')) {
                qodefVerticalSlidingNavMenu.dropdownFloat($verticalSlidingNavObject);
            }
        },
        dropdownClickToggle: function ($verticalSlidingNavObject) {
            var $menuItems = $verticalSlidingNavObject.find('ul li.menu-item-has-children');

            $menuItems.each(function () {
                var $elementToExpand = $(this).find(' > .qodef-drop-down-second, > ul');
                var menuItem = this;
                var $dropdownOpener = $(this).find('> a');
                var slideUpSpeed = 'fast';
                var slideDownSpeed = 'slow';

                $dropdownOpener.on('click tap', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if ($elementToExpand.is(':visible')) {
                        $(menuItem).removeClass('qodef-menu-item--open');
                        $elementToExpand.slideUp(slideUpSpeed);
                    } else if ($dropdownOpener.parent().parent().children().hasClass('qodef-menu-item--open') && $dropdownOpener.parent().parent().parent().hasClass('qodef-vertical-menu')) {
                        $(this).parent().parent().children().removeClass('qodef-menu-item--open');
                        $(this).parent().parent().children().find(' > .qodef-drop-down-second').slideUp(slideUpSpeed);

                        $(menuItem).addClass('qodef-menu-item--open');
                        $elementToExpand.slideDown(slideDownSpeed);
                    } else {

                        if (!$(this).parents('li').hasClass('qodef-menu-item--open')) {
                            $menuItems.removeClass('qodef-menu-item--open');
                            $menuItems.find(' > .qodef-drop-down-second, > ul').slideUp(slideUpSpeed);
                        }

                        if ($(this).parent().parent().children().hasClass('qodef-menu-item--open')) {
                            $(this).parent().parent().children().removeClass('qodef-menu-item--open');
                            $(this).parent().parent().children().find(' > .qodef-drop-down-second, > ul').slideUp(slideUpSpeed);
                        }

                        $(menuItem).addClass('qodef-menu-item--open');
                        $elementToExpand.slideDown(slideDownSpeed);
                    }
                });
            });
        },
        dropdownFloat: function ($verticalSlidingNavObject) {
            var $menuItems = $verticalSlidingNavObject.find('ul li.menu-item-has-children');
            var $allDropdowns = $menuItems.find(' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul');

            $menuItems.each(function () {
                var $elementToExpand = $(this).find(' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul');
                var menuItem = this;

                if (Modernizr.touch) {
                    var $dropdownOpener = $(this).find('> a');

                    $dropdownOpener.on('click tap', function (e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if ($elementToExpand.hasClass('qodef-float--open')) {
                            $elementToExpand.removeClass('qodef-float--open');
                            $(menuItem).removeClass('qodef-menu-item--open');
                        } else {
                            if (!$(this).parents('li').hasClass('qodef-menu-item--open')) {
                                $menuItems.removeClass('qodef-menu-item--open');
                                $allDropdowns.removeClass('qodef-float--open');
                            }

                            $elementToExpand.addClass('qodef-float--open');
                            $(menuItem).addClass('qodef-menu-item--open');
                        }
                    });
                } else {
                    //must use hoverIntent because basic hover effect doesn't catch dropdown
                    //it doesn't start from menu item's edge
                    $(this).hoverIntent({
                        over: function () {
                            $elementToExpand.addClass('qodef-float--open');
                            $(menuItem).addClass('qodef-menu-item--open');
                        },
                        out: function () {
                            $elementToExpand.removeClass('qodef-float--open');
                            $(menuItem).removeClass('qodef-menu-item--open');
                        },
                        timeout: 300
                    });
                }
            });
        },
        verticalSlidingAreaScrollable: function ($verticalSlidingMenuObject) {
            return $verticalSlidingMenuObject.hasClass('qodef-with-scroll');
        },
        initVerticalSlidingAreaScroll: function ($verticalSlidingMenuObject) {
            if (qodefVerticalSlidingNavMenu.verticalSlidingAreaScrollable($verticalSlidingMenuObject) && typeof qodefCore.qodefPerfectScrollbar === 'object') {
                qodefCore.qodefPerfectScrollbar.init($verticalSlidingMenuObject);
            }
        },
        verticalSlidingAreaShowHide: function ($verticalSlidingMenuObject) {
            var $verticalSlidingMenuOpener = $verticalSlidingMenuObject.find('.qodef-vertical-sliding-menu-opener');

            $verticalSlidingMenuOpener.on('click', function (e) {
                e.preventDefault();

                if (!$verticalSlidingMenuObject.hasClass('qodef-vertical-sliding-menu--opened')) {
                    $verticalSlidingMenuObject.addClass('qodef-vertical-sliding-menu--opened');
                } else {
                    $verticalSlidingMenuObject.removeClass('qodef-vertical-sliding-menu--opened');
                }
            });
        },
        init: function () {
            var $verticalSlidingMenuObject = $('.qodef-header--vertical-sliding #qodef-page-header');

            if ($verticalSlidingMenuObject.length) {
                qodefVerticalSlidingNavMenu.verticalSlidingAreaShowHide($verticalSlidingMenuObject);
                qodefVerticalSlidingNavMenu.initNavigation($verticalSlidingMenuObject);
                qodefVerticalSlidingNavMenu.initVerticalSlidingAreaScroll($verticalSlidingMenuObject);
            }
        }
    };

})(jQuery);
(function ($) {
	"use strict";
	
	var fixedHeaderAppearance = {
		showHideHeader: function ($pageOuter, $header) {
			if (qodefCore.windowWidth > 1024) {
				if (qodefCore.scroll <= 0) {
					qodefCore.body.removeClass('qodef-header--fixed-display');
					$pageOuter.css('padding-top', '0');
					$header.css('margin-top', '0');
				} else {
					qodefCore.body.addClass('qodef-header--fixed-display');
					$pageOuter.css('padding-top', parseInt(qodefGlobal.vars.headerHeight + qodefGlobal.vars.topAreaHeight) + 'px');
					$header.css('margin-top', parseInt(qodefGlobal.vars.topAreaHeight) + 'px');
				}
			}
		},
		init: function () {
            
            if (!qodefCore.body.hasClass('qodef-header--vertical')) {
                var $pageOuter = $('#qodef-page-outer'),
                    $header = $('#qodef-page-header');
                
                fixedHeaderAppearance.showHideHeader($pageOuter, $header);
                
                $(window).scroll(function () {
                    fixedHeaderAppearance.showHideHeader($pageOuter, $header);
                });
                
                $(window).resize(function () {
                    $pageOuter.css('padding-top', '0');
                    fixedHeaderAppearance.showHideHeader($pageOuter, $header);
                });
            }
		}
	};
	
	qodefCore.fixedHeaderAppearance = fixedHeaderAppearance.init;
	
})(jQuery);
(function ($) {
	"use strict";

	var stickyHeaderAppearance = {
		displayAmount: function () {
			if (qodefGlobal.vars.qodefStickyHeaderScrollAmount !== 0) {
				return parseInt(qodefGlobal.vars.qodefStickyHeaderScrollAmount, 10);
			} else {
				return parseInt(qodefGlobal.vars.headerHeight + qodefGlobal.vars.adminBarHeight, 10);
			}
		},
		showHideHeader: function (displayAmount) {

			if (qodefCore.scroll < displayAmount) {
				qodefCore.body.removeClass('qodef-header--sticky-display');
			} else {
				qodefCore.body.addClass('qodef-header--sticky-display');
			}
		},
		init: function () {
			var displayAmount = stickyHeaderAppearance.displayAmount();

			stickyHeaderAppearance.showHideHeader(displayAmount);
			$(window).scroll(function () {
				stickyHeaderAppearance.showHideHeader(displayAmount);
			});
		}
	};

	qodefCore.stickyHeaderAppearance = stickyHeaderAppearance.init;

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefSearchCoversHeader.init();
	});
	
	var qodefSearchCoversHeader = {
		init: function () {
			var $searchOpener = $('a.qodef-search-opener'),
				$searchForm = $('.qodef-search-cover-form'),
				$searchClose = $searchForm.find('.qodef-m-close');
			
			if ($searchOpener.length && $searchForm.length) {
				$searchOpener.on('click', function (e) {
					e.preventDefault();
					qodefSearchCoversHeader.openCoversHeader($searchForm);
					
				});
				$searchClose.on('click', function (e) {
					e.preventDefault();
					qodefSearchCoversHeader.closeCoversHeader($searchForm);
				});
			}
		},
		openCoversHeader: function ($searchForm) {
			qodefCore.body.addClass('qodef-covers-search--opened qodef-covers-search--fadein');
			qodefCore.body.removeClass('qodef-covers-search--fadeout');
			
			setTimeout(function () {
				$searchForm.find('.qodef-m-form-field').focus();
			}, 600);
		},
		closeCoversHeader: function ($searchForm) {
			qodefCore.body.removeClass('qodef-covers-search--opened qodef-covers-search--fadein');
			qodefCore.body.addClass('qodef-covers-search--fadeout');
			
			setTimeout(function () {
				$searchForm.find('.qodef-m-form-field').val('');
				$searchForm.find('.qodef-m-form-field').blur();
				qodefCore.body.removeClass('qodef-covers-search--fadeout');
			}, 300);
		}
	};
	
})(jQuery);

(function($) {
    "use strict";

    $(document).ready(function(){
        qodefSearchFullscreen.init();
    });

	var qodefSearchFullscreen = {
	    init: function(){
            var $searchOpener = $('a.qodef-search-opener'),
                $searchHolder = $('.qodef-fullscreen-search-holder'),
                $searchClose = $searchHolder.find('.qodef-m-close');

            if ($searchOpener.length && $searchHolder.length) {
                $searchOpener.on('click', function (e) {
                    e.preventDefault();
                    if(qodefCore.body.hasClass('qodef-fullscreen-search--opened')){
                        qodefSearchFullscreen.closeFullscreen($searchHolder);
                    }else{
                        qodefSearchFullscreen.openFullscreen($searchHolder);
                    }
                });
                $searchClose.on('click', function (e) {
                    e.preventDefault();
                    qodefSearchFullscreen.closeFullscreen($searchHolder);
                });

                //Close on escape
                $(document).keyup(function (e) {
                    if (e.keyCode === 27) { //KeyCode for ESC button is 27
                        qodefSearchFullscreen.closeFullscreen($searchHolder);
                    }
                });
            }
        },
        openFullscreen: function($searchHolder){
            qodefCore.body.removeClass('qodef-fullscreen-search--fadeout');
            qodefCore.body.addClass('qodef-fullscreen-search--opened qodef-fullscreen-search--fadein');

            setTimeout(function () {
                $searchHolder.find('.qodef-m-form-field').focus();
            }, 900);

            qodefCore.qodefScroll.disable();
        },
        closeFullscreen: function($searchHolder){
            qodefCore.body.removeClass('qodef-fullscreen-search--opened qodef-fullscreen-search--fadein');
            qodefCore.body.addClass('qodef-fullscreen-search--fadeout');

            setTimeout(function () {
                $searchHolder.find('.qodef-m-form-field').val('');
                $searchHolder.find('.qodef-m-form-field').blur();
                qodefCore.body.removeClass('qodef-fullscreen-search--fadeout');
            }, 300);

            qodefCore.qodefScroll.enable();
        }
    };

})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
        qodefSearch.init();
	});
	
	var qodefSearch = {
		init: function () {
            this.search = $('a.qodef-search-opener');

            if (this.search.length) {
                this.search.each(function () {
                    var $thisSearch = $(this);

                    qodefSearch.searchHoverColor($thisSearch);
                });
            }
        },
		searchHoverColor: function ($searchHolder) {
			if (typeof $searchHolder.data('hover-color') !== 'undefined') {
				var hoverColor = $searchHolder.data('hover-color'),
				    originalColor = $searchHolder.css('color');
				
				$searchHolder.on('mouseenter', function () {
					$searchHolder.css('color', hoverColor);
				}).on('mouseleave', function () {
					$searchHolder.css('color', originalColor);
				});
			}
		}
	};
	
})(jQuery);

(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefProgressBarSpinner.init();
	});
	
	var qodefProgressBarSpinner = {
		percentNumber: 0,
		init: function () {
			this.holder = $('#qodef-page-spinner.qodef-layout--progress-bar');
			
			if (this.holder.length) {
				qodefProgressBarSpinner.animateSpinner(this.holder);
			}
		},
		animateSpinner: function ($holder) {
			
			var $numberHolder = $holder.find('.qodef-m-spinner-number-label'),
				$spinnerLine = $holder.find('.qodef-m-spinner-line-front'),
				numberIntervalFastest,
				windowLoaded = false;
			
			$spinnerLine.animate({'width': '100%'}, 10000, 'linear');
			
			var numberInterval = setInterval(function () {
				qodefProgressBarSpinner.animatePercent($numberHolder, qodefProgressBarSpinner.percentNumber);
			
				if (windowLoaded) {
					clearInterval(numberInterval);
				}
			}, 100);
			
			$(window).on('load', function () {
				windowLoaded = true;
				
				numberIntervalFastest = setInterval(function () {
					if (qodefProgressBarSpinner.percentNumber >= 100) {
						clearInterval(numberIntervalFastest);
						$spinnerLine.stop().animate({'width': '100%'}, 500);
						
						setTimeout(function () {
							$holder.addClass('qodef--finished');
							
							setTimeout(function () {
								qodefProgressBarSpinner.fadeOutLoader($holder);
							}, 1000);
						}, 600);
					} else {
						qodefProgressBarSpinner.animatePercent($numberHolder, qodefProgressBarSpinner.percentNumber);
					}
				}, 6);
			});
		},
		animatePercent: function ($numberHolder, percentNumber) {
			if (percentNumber < 100) {
				percentNumber += 5;
				$numberHolder.text(percentNumber);
				
				qodefProgressBarSpinner.percentNumber = percentNumber;
			}
		},
		fadeOutLoader: function ($holder, speed, delay, easing) {
			speed = speed ? speed : 600;
			delay = delay ? delay : 0;
			easing = easing ? easing : 'swing';
			
			$holder.delay(delay).fadeOut(speed, easing);
			
			$(window).on('bind', 'pageshow', function (event) {
				if (event.originalEvent.persisted) {
					$holder.fadeOut(speed, easing);
				}
			});
		}
	};
	
})(jQuery);
(function ($) {
    "use strict";
	qodefCore.shortcodes.lekker_core_product_categories_list = {};
	qodefCore.shortcodes.lekker_core_product_categories_list.qodefMasonryLayout = qodef.qodefMasonryLayout;

})(jQuery);
(function ($) {
	
    "use strict";
	qodefCore.shortcodes.lekker_core_product_list = {};
	qodefCore.shortcodes.lekker_core_product_list.qodefPagination = qodef.qodefPagination;
	qodefCore.shortcodes.lekker_core_product_list.qodefFilter = qodef.qodefFilter;
	qodefCore.shortcodes.lekker_core_product_list.qodefJustifiedGallery = qodef.qodefJustifiedGallery;
	qodefCore.shortcodes.lekker_core_product_list.qodefMasonryLayout = qodef.qodefMasonryLayout;

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefSideAreaCart.init();
	});
	
	var qodefSideAreaCart = {
		init: function () {
			var $holder = $('.qodef-woo-side-area-cart');
			
			if ($holder.length) {
				$holder.each(function () {
					var $thisHolder = $(this);
					
					if (qodefCore.windowWidth > 680) {
						qodefSideAreaCart.trigger($thisHolder);
						
						qodefCore.body.on('added_to_cart', function () {
							qodefSideAreaCart.trigger($thisHolder);
						});
					}
				});
			}
		},
		trigger: function ($holder) {
			var $opener = $holder.find('.qodef-m-opener'),
				$close = $holder.find('.qodef-m-close'),
				$items = $holder.find('.qodef-m-items');
			
			// Open Side Area
			$opener.on('click', function (e) {
				e.preventDefault();
				
				if (!$holder.hasClass('qodef--opened')) {
					qodefSideAreaCart.openSideArea($holder);
					
					$(document).keyup(function (e) {
						if (e.keyCode === 27) {
							qodefSideAreaCart.closeSideArea($holder);
						}
					});
				} else {
					qodefSideAreaCart.closeSideArea($holder);
				}
			});
			
			$close.on('click', function (e) {
				e.preventDefault();
				
				qodefSideAreaCart.closeSideArea($holder);
			});
			
			if ($items.length && typeof qodefCore.qodefPerfectScrollbar === 'object') {
				qodefCore.qodefPerfectScrollbar.init($items);
			}
		},
		openSideArea: function ($holder) {
			qodefCore.qodefScroll.disable();
			
			$holder.addClass('qodef--opened');
			$('#qodef-page-wrapper').prepend('<div class="qodef-woo-side-area-cart-cover"/>');
			
			$('.qodef-woo-side-area-cart-cover').on('click', function (e) {
				e.preventDefault();
				
				qodefSideAreaCart.closeSideArea($holder);
			});
		},
		closeSideArea: function ($holder) {
			if ($holder.hasClass('qodef--opened')) {
				qodefCore.qodefScroll.enable();
				
				$holder.removeClass('qodef--opened');
				$('.qodef-woo-side-area-cart-cover').remove();
			}
		}
	};
	
})(jQuery);

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
(function ($) {
	
    "use strict";
	qodefCore.shortcodes.lekker_core_team_list = {};
	qodefCore.shortcodes.lekker_core_team_list.qodefPagination = qodef.qodefPagination;
	qodefCore.shortcodes.lekker_core_team_list.qodefFilter = qodef.qodefFilter;
	qodefCore.shortcodes.lekker_core_team_list.qodefJustifiedGallery = qodef.qodefJustifiedGallery;
	qodefCore.shortcodes.lekker_core_team_list.qodefMasonryLayout = qodef.qodefMasonryLayout;

})(jQuery);
(function ($) {
    "use strict";
	qodefCore.shortcodes.lekker_core_testimonials_list = {};
	qodefCore.shortcodes.lekker_core_testimonials_list.qodefSwiper = qodef.qodefSwiper;

})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefInteractiveLinkShowcaseInteractiveList.init();
    });

    var qodefInteractiveLinkShowcaseInteractiveList = {
        init: function () {
            this.holder = $('.qodef-interactive-link-showcase.qodef-layout--interactive-list');

            if (this.holder.length) {
                this.holder.each(function () {
                    var $thisHolder = $(this),
                        $links = $thisHolder.find('.qodef-m-item'),
                        x = 0,
                        y = 0,
                        currentXCPosition = 0,
                        currentYCPosition = 0;
    
                    if ($links.length) {
                        $links.on('mouseenter', function () {
                            $links.removeClass('qodef--active');
                            $(this).addClass('qodef--active');
                        }).on('mousemove', function (event) {
                            var $thisLink = $(this),
                                $followInfoHolder = $thisLink.find('.qodef-e-follow-content'),
                                $followImage = $followInfoHolder.find('.qodef-e-follow-image'),
                                $followImageItem = $followImage.find('img'),
                                followImageWidth = $followImageItem.width(),
                                followImagesCount = parseInt($followImage.data('images-count'), 10),
                                followImagesSrc = $followImage.data('images'),
                                $followTitle = $followInfoHolder.find('.qodef-e-follow-title'),
                                itemWidth = $thisLink.outerWidth(),
                                itemHeight = $thisLink.outerHeight(),
                                itemOffsetTop = $thisLink.offset().top - qodefCore.scroll,
                                itemOffsetLeft = $thisLink.offset().left;
            
                            x = (event.clientX - itemOffsetLeft) >> 0;
                            y = (event.clientY - itemOffsetTop) >> 0;
            
                            if (x > itemWidth) {
                                currentXCPosition = itemWidth;
                            } else if (x < 0) {
                                currentXCPosition = 0;
                            } else {
                                currentXCPosition = x;
                            }
            
                            if (y > itemHeight) {
                                currentYCPosition = itemHeight;
                            } else if (y < 0) {
                                currentYCPosition = 0;
                            } else {
                                currentYCPosition = y;
                            }
            
                            if (followImagesCount > 1) {
                                var imagesUrl = followImagesSrc.split('|'),
                                    itemPartSize = itemWidth / followImagesCount;
                
                                $followImageItem.removeAttr('srcset');
                
                                if (currentXCPosition < itemPartSize) {
                                    $followImageItem.attr('src', imagesUrl[0]);
                                }
                
                                // -2 is constant - to remove first and last item from the loop
                                for (var index = 1; index <= (followImagesCount - 2); index++) {
                                    if (currentXCPosition >= itemPartSize * index && currentXCPosition < itemPartSize * (index + 1)) {
                                        $followImageItem.attr('src', imagesUrl[index]);
                                    }
                                }
                
                                if (currentXCPosition >= itemWidth - itemPartSize) {
                                    $followImageItem.attr('src', imagesUrl[followImagesCount - 1]);
                                }
                            }
            
                            $followImage.css({'top': itemHeight / 2, 'width': followImageWidth});
                            $followTitle.css({'transform': 'translateY(' + -(parseInt(itemHeight, 10) / 2 + currentYCPosition) + 'px)', 'left': -(currentXCPosition - followImageWidth/2)});
                            $followInfoHolder.css({'top': currentYCPosition, 'left': currentXCPosition});
                        }).on('mouseleave', function () {
                            $links.removeClass('qodef--active');
                        });
                    }
                    $thisHolder.addClass('qodef--init');
                });
            }
        }
    };
	qodefCore.shortcodes.lekker_core_interactive_link_showcase.qodefInteractiveLinkShowcaseInteractiveList = qodefInteractiveLinkShowcaseInteractiveList;
})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefInteractiveLinkShowcaseList.init();
    });

    var qodefInteractiveLinkShowcaseList = {
        init: function () {
            this.holder = $('.qodef-interactive-link-showcase.qodef-layout--list');

            if (this.holder.length) {
                this.holder.each(function () {
                    var $thisHolder = $(this),
                        $images = $thisHolder.find('.qodef-m-image'),
                        $links = $thisHolder.find('.qodef-m-item');
    
                    $images.eq(0).addClass('qodef--active');
                    $links.eq(0).addClass('qodef--active');
    
                    $links.on('touchstart mouseenter', function (e) {
                        var $thisLink = $(this);
        
                        if (!qodefCore.html.hasClass('touchevents') || (!$thisLink.hasClass('qodef--active') && qodefCore.windowWidth > 680)) {
                            e.preventDefault();
                            $images.removeClass('qodef--active').eq($thisLink.index()).addClass('qodef--active');
                            $links.removeClass('qodef--active').eq($thisLink.index()).addClass('qodef--active');
                        }
                    }).on('touchend mouseleave', function () {
                        var $thisLink = $(this);
        
                        if (!qodefCore.html.hasClass('touchevents') || (!$thisLink.hasClass('qodef--active') && qodefCore.windowWidth > 680)) {
                            $links.removeClass('qodef--active').eq($thisLink.index()).addClass('qodef--active');
                            $images.removeClass('qodef--active').eq($thisLink.index()).addClass('qodef--active');
                        }
                    });
    
                    $thisHolder.addClass('qodef--init');
                });
            }
        }
    };

	qodefCore.shortcodes.lekker_core_interactive_link_showcase.qodefInteractiveLinkShowcaseList = qodefInteractiveLinkShowcaseList;

})(jQuery);
(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefInteractiveLinkShowcaseSlider.init();
    });

    var qodefInteractiveLinkShowcaseSlider = {
        init: function () {
            this.holder = $('.qodef-interactive-link-showcase.qodef-layout--slider');

            if (this.holder.length) {
                this.holder.each(function () {
                    var $thisHolder = $(this),
                        $images = $thisHolder.find('.qodef-m-image');
    
                    var $swiperSlider = new Swiper($thisHolder.find('.swiper-container'), {
                        loop: true,
                        slidesPerView: 'auto',
                        centeredSlides: true,
                        speed: 1400,
                        mousewheel: true,
                        init: false
                    });
    
                    $thisHolder.waitForImages(function () {
                        $swiperSlider.init();
                    });
    
                    $swiperSlider.on('init', function () {
                        $images.eq(0).addClass('qodef--active');
                        $thisHolder.find('.swiper-slide-active').addClass('qodef--active');
        
                        $swiperSlider.on('slideChangeTransitionStart', function () {
                            var $swiperSlides = $thisHolder.find('.swiper-slide'),
                                $activeSlideItem = $thisHolder.find('.swiper-slide-active');
            
                            $images.removeClass('qodef--active').eq($activeSlideItem.data('swiper-slide-index')).addClass('qodef--active');
                            $swiperSlides.removeClass('qodef--active');
            
                            $activeSlideItem.addClass('qodef--active');
                        });
        
                        $thisHolder.find('.swiper-slide').on('click', function (e) {
                            var $thisSwiperLink = $(this),
                                $activeSlideItem = $thisHolder.find('.swiper-slide-active');
            
                            if (!$thisSwiperLink.hasClass('swiper-slide-active')) {
                                e.preventDefault();
                                e.stopImmediatePropagation();
                
                                if (e.pageX < $activeSlideItem.offset().left) {
                                    $swiperSlider.slidePrev();
                                    return false;
                                }
                
                                if (e.pageX > $activeSlideItem.offset().left + $activeSlideItem.outerWidth()) {
                                    $swiperSlider.slideNext();
                                    return false;
                                }
                            }
                        });
        
                        $thisHolder.addClass('qodef--init');
                    });
                });
            }
        }
    };

	qodefCore.shortcodes.lekker_core_interactive_link_showcase.qodefInteractiveLinkShowcaseSlider = qodefInteractiveLinkShowcaseSlider;

})(jQuery);
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
			var $gallery = $('.qodef-hover-animation--follow');

			if ($gallery.length) {
				if (!$('.qodef-follow-info-holder').length) {
					qodefCore.body.append('<div class="qodef-follow-info-holder"><div class="qodef-follow-info-inner"><span class="qodef-follow-info-category"></span><br/><span class="qodef-follow-info-title"></span></div></div>');
				}

				var $followInfoHolder = $('.qodef-follow-info-holder'),
					$followInfoCategory = $followInfoHolder.find('.qodef-follow-info-category'),
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
					});

				});
			}
		}
	};

	qodefCore.shortcodes.lekker_core_portfolio_list.qodefInfoFollow = qodefInfoFollow;

})(jQuery);
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
			var $gallery = $('.qodef-hover-animation--follow');

			if ($gallery.length) {
				if (!$('.qodef-follow-info-holder').length) {
					qodefCore.body.append('<div class="qodef-follow-info-holder"><div class="qodef-follow-info-inner"><span class="qodef-follow-info-category"></span><br/><span class="qodef-follow-info-title"></span></div></div>');
				}

				var $followInfoHolder = $('.qodef-follow-info-holder'),
					$followInfoCategory = $followInfoHolder.find('.qodef-follow-info-category'),
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
								$thisItemCategory = $(this).find('.qodef-e-info-category');

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
					});
				});
			}
		}
	};

	qodefCore.shortcodes.lekker_core_portfolio_list.qodefInfoFollow = qodefInfoFollow;

})(jQuery);
(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefHoverDir.init();
	});
	
	$(document).on('lekker_trigger_get_new_posts', function () {
		qodefHoverDir.init();
	});
	
	var qodefHoverDir = {
		init: function () {
			var $gallery = $('.qodef-hover-animation--direction-aware');
			
			if ($gallery.length) {
				$gallery.each(function () {
					var $this = $(this);
					$this.find('article').each(function () {
						$(this).hoverdir({
							hoverElem: 'div.qodef-e-content',
							speed: 330,
							hoverDelay: 35,
							easing: 'ease'
						});
					});
				});
			}
		}
	};
	
	qodefCore.shortcodes.lekker_core_portfolio_list.qodefHoverDir = qodefHoverDir;
	
})(jQuery);
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