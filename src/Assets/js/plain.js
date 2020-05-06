// ---------------------------------
// Login / Reset Form Animation
// ---------------------------------

$('.fg-toggle').on('click', function() {
    $('.login-screen').toggleClass('active');
    return false;
});

setTimeout(function() {
    $('.status').addClass('fadeOutDown');
}, 6000);

$('.status .close').on('click', function() {
    $('.status').addClass('fadeOutDown');
});
