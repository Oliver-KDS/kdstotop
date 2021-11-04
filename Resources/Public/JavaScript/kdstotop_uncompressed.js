function flight(symbol, speed, position, space, title, xs, sm, md, lg, xl, xxl, show, pulse) {
    speed = parseInt(speed);
    show = parseInt(show);
    let effect = '';
    if (pulse === '1') {
        effect = 'kdstotop-pulse';
    }
    jQuery('body').append('<div id="flight" style="' + position + ':' + space + 'px;bottom:' + space + 'px"></div>');

    jQuery('#flight').append('<a title="' + title + '" class="' + xs + ' ' + sm + ' ' + md + ' ' + lg + ' ' + xl + ' ' + xxl + ' ' + effect + '">' + symbol + '</a>');

    flight = jQuery("#flight");

    jQuery(window).scroll(function () {
        if (document.body.scrollTop > show || document.documentElement.scrollTop > show) {
            jQuery('#flight ').fadeIn(500);

        } else {
            jQuery('#flight ').fadeOut(500);
        }
    });

    $(flight).click(function () {
        jQuery("html,body").animate({scrollTop:0}, speed, "swing");
    })
}