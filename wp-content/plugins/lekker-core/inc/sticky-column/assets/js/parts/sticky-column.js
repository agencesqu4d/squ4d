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