jQuery(document).ready(function () {
    var $grid = jQuery('.markup-template');
    $grid.imagesLoaded(function () {
        $grid.isotope({
            itemSelector: '.element-item',
            layoutMode: 'fitRows'
        });
    });


    var filterFns = {};
    jQuery('.color-section-page').on('click', 'a', function (e) {

        $('.color-section-page li a').removeClass('active');
        $(this).addClass('active');

        var filterValue = jQuery(this).attr('data-filter');
        // use filterFn if matches value
        filterValue = filterFns[ filterValue ] || filterValue;
        $grid.isotope({filter: filterValue});

        return false;

    });
});

$(window).load(function () {

    var $grid = jQuery('.markup-template');
    $grid.imagesLoaded(function () {
        $grid.isotope({
            itemSelector: '.element-item',
            layoutMode: 'fitRows',
            filter: '.cyan'
        });
    });

    return false;
});

