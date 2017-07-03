(function ($) {
    function resize() {
        $('.menu-li a').each(function () {
            var h = $(this).parent().height();
            var fontSize = h * .4;
            $(this).css('font-size', (fontSize > 24 ? 24 : fontSize) + 'px');
            $(this).css('line-height', h + 'px');
        });
    }

    resize();
    $(window).resize(resize);

    $(document).pjax('a[data-pjax]', '.main', {});

    $(document).on('pjax:clicked', function(data) {
        var $a = $(data.target);
        if ($a.closest('.menu-li a').length > 0) {
            $('.menu-li a').removeClass('active');
            $(data.target).addClass('active');
        }
    });
})(jQuery);
