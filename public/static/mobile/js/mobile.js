function showSidebar() {
    $('.sidebar').show();
    setTimeout(function () {
        $('.sidebar').addClass('active');
    }, 0);
}
function hideSidebar() {
    $('.sidebar').removeClass('active');
    setTimeout(function () {
        $('.sidebar').hide();
    }, 500);
}
$('.header-right').click(function () {
    showSidebar();
});
$('.sidebar-bg').click(function () {
    hideSidebar();
});
$(document).pjax('a[data-pjax]', '.main', {});
$(document).on('pjax:clicked', function (data) {
    hideSidebar();
});
$container = $('.main');
$(document).on('pjax:click', function () {
    $container.fadeOut();
});
$(document).on('pjax:complete', function () {
    $container.fadeIn();
});
