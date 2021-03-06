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