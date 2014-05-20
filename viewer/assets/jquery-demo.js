
jQuery(document).ready(function() {
/*$(window).scroll(function () {
    if ($(this).scrollTop() > 0) {
        $("#advanced").css({
            position: 'relative'
        });
    } else {
        $("#advanced").css({
            position: 'relative'
        });
    }
});

$("#advanced").css({
    marginTop: '0px'
}).removeClass('closed');

$("#advanced .trigger").toggle(function () {
        $(this).find('em').parent().parent('#advanced').addClass('closed').animate({
            marginTop: '-53px'
        }, "fast", function () {
            calcHeight();
        });
        strCookies2 = $.cookie("panel2", null);
        strCookies = $.cookie("panel", 'boo');
    },
    function () {
        $(this).find('em').parent().parent('#advanced').removeClass('closed').animate({
            marginTop: '0px'
        }, "fast", function () {
            calcHeight();
        })
        strCookies2 = $.cookie("panel2", 'opened');
        strCookies = $.cookie("panel", null);
    });
if ($(window).scrollTop() > 0) {
    $("#advanced").css({
        position: 'relative'
    });
} else {
    $("#advanced").css({
        position: 'relative'
    });
}*/


    jQuery('#advanced .trigger').click(function(){
        if (jQuery('#advanced').hasClass('closed')) {
            console.log('ddddddd');
            jQuery('#advanced').animate({ marginTop: '-53px'}, "fast",
             function() {
                jQuery(this).removeClass('closed');
            }
                );
        }
        else  {
            console.log('nnnn');
            jQuery('#advanced').animate({ marginTop: '0'}, "fast",
            function() {
                jQuery(this).addClass('closed');
            }    
                );

        }
    });














    $(function(){
    // IPad/IPhone
    var viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]'),
    ua = navigator.userAgent,

    gestureStart = function () {
        viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6";
    },

    scaleFix = function () {
        if (viewportmeta && /iPhone|iPad/.test(ua) && !/Opera Mini/.test(ua)) {
        viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
        document.addEventListener("gesturestart", gestureStart, false);
        }
    };
    scaleFix();
    });


    

//          function to fix height of iframe!
            var calcHeight = function() {
            var headerDimensions = $('#headerlivedemo').height();
            var selector = '#iframelive';
               if($('#advanced').hasClass('closed')) {
                   $(selector).height($(window).height());
               } else {
                   $(selector).height($(window).height() - headerDimensions);
               }
            }
            $(document).ready(function() {
            calcHeight();
            });
            $(window).resize(function() {
            calcHeight();
            }).load(function() {
            calcHeight();
            });



});

    $(document).ready(function() {
    if(!(navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/Opera Mini/))) {
        var frame = document.getElementById('frame');
        $('ul#responsivator').show();                
        $('ul#responsivator li.response').click(function () {
            $('ul#responsivator li.response').removeClass('active');
            $(this).addClass('active');
            var device = $(this).attr('id');
            $('#iframelive').removeClass().addClass(device);
            frame.src = frame.src;              
        });
        
        $('ul#responsivator li#qr').unbind('click');
        
        $('.responsive-block').css('left',(($(window).width()/2)-110)+'px').show();
    
    
        $(window).resize(function(){
            $('.responsive-block').css('left',(($(window).width()/2)-110)+'px');
        });
    }
});




jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};
