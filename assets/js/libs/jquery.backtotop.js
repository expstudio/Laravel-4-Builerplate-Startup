//PLUGIN JQUERY BACK TO TOP BY DEVELPIXEL 2014.
(function($) {
    $.fn.backToTop = function() {
        var selectz = $(this);
        selectz.hide();
        $(window).scroll(function() {
            if ($(this).scrollTop() > $(window).height()) {
                selectz.fadeIn();
            } else {
                selectz.fadeOut();
            }
        });
    };
}(jQuery));
