(function () {
    var $sidebar = $('.sidebar');

    function showSidebar() {
        $sidebar.show();
        setTimeout(function () {
            $sidebar.addClass('active');
        }, 100);
    }

    function hideSidebar() {
        $sidebar.removeClass('active');
        setTimeout(function () {
            if (!$sidebar.hasClass('active')) {
                $sidebar.hide();
            }
        }, 500);
    }

    $('.header-right').click(function () {
        showSidebar();
    });
    $('.sidebar-bg').click(function () {
        hideSidebar();
    });
    $(document).pjax('a[data-pjax]', '.main');
    $(document).on('pjax:clicked', function () {
        hideSidebar();
    });

    function lazyload() {
        $('img[data-original]').lazyload();
    }

    $(document).on('pjax:end', lazyload);
    lazyload();

    $("body").swipe({
        swipeLeft: function () {
            if (!$('.sidebar').hasClass('active')) {
                showSidebar();
            }
        },
        swipeRight: function () {
            if ($('.sidebar').hasClass('active')) {
                hideSidebar();
            }
        },
        allowPageScroll: "vertical",
        threshold: 100,
        fingers: 'all'
    });

    /* only for index */
    (function () {
        var isHideHelp = false;
        var listener = function () {
            if ($('.main-content-index').length) {
                if (isHideHelp) {
                    $('.main-content-index-help').hide();
                } else {
                    $('.main-content-index-help').click(function () {
                        $(this).hide();
                        isHideHelp = true;
                    });
                }
                $('.main-content-index-swiper').height(window.innerHeight - $('.header').height());
                var swiper = new Swiper('.main-content-index-swiper', {
                    pagination: '.main-content-index-swiper .swiper-pagination',
                    paginationClickable: true,
                    direction: 'vertical'
                });
                $('.footer').hide();
            } else {
                $('.footer').show();
            }
        };
        $(document).on('pjax:end', listener);
        listener();
    })();
})();
