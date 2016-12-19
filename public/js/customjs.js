jQuery(document).ready(function () {

    var $color_switcher = jQuery('.blue-homepage'),
            $body = jQuery('body'),
            $html = jQuery('html');

    $color_switcher.children('a').click(function (e) {
        var $this = jQuery(this),
                this_color = $this.attr('data-site-color');
        
        localStorage.setItem("porish_template", this_color);
        
    });
    
    $(".dark-landing-page").hide();
    $("#light-page-btn").click(function(){
       $(".light-landing-page").show();
       $(".dark-landing-page").hide();
       $(".light-color-section-btn").addClass("hover-color-btn");
       $(".dark-color-section-btn").removeClass("hover-color-btn");
    });
    $("#dark-page-btn").click(function(){
       $(".dark-landing-page").show();
       $(".light-landing-page").hide();
       $(".light-color-section-btn").removeClass("hover-color-btn");
       $(".dark-color-section-btn").addClass("hover-color-btn");
    });
    
    if (typeof Waves !== 'undefined') {
        Waves.init();
        Waves.attach('.site-menu-item > a', ['waves-classic']);
        Waves.attach(".site-navbar .navbar-toolbar [data-toggle='menubar']", ["waves-light", "waves-round"]);
        Waves.attach(".page-header-actions .btn:not(.btn-inverse)", ["waves-light", "waves-round"]);
        Waves.attach(".page-header-actions .btn-inverse", ["waves-classic", "waves-round"]);
        Waves.attach('.page > div:not(.page-header) .btn:not(.ladda-button):not(.btn-round):not(.btn-pure):not(.btn-floating):not(.btn-flat)', ['waves-light']);
        Waves.attach('.page > div:not(.page-header) .btn-pure:not(.ladda-button):not(.btn-round):not(.btn-floating):not(.btn-flat):not(.icon)', ['waves-classic']);
    }

});
