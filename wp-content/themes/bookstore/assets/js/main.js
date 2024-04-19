$(document).ready(() => {
    
    // Toggle navbar nav in mobile view
    $('.navbar-toggler').click(function(e) {
        e.preventDefault();

        // Only activate the function in mobile view (less then 768)
        if ($(window).width() < 768) {

            // This code snippet toggles the navbar-toggler and extracts the value of the data-target attribute. It then selects the navbar nav element with an id that matches the data target value. Finally, it toggles the targetNav element.
            const dataTarget = $(this).attr('data-target'); 
            const targetNav = $(`[id=${dataTarget}]`);
            targetNav.slideToggle(200);
        }
    });

     
    // Toggle dropdown menu in navbar nav in mobile view
    $('.dropdown-toggler').click(function(e) {
        e.preventDefault();

        // this code snippet toggles the next sibling that must be a dropdown menu.
        const dropdownMenu = $(this).next();

        $(window).width() > 767?
            dropdownMenu.slideToggle(200).css({ display: 'grid' }):
            dropdownMenu.slideToggle().css({ display: 'block'});
    });
});