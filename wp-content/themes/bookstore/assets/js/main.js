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
     
    // Toggle dropdown menu in navbar nav
    $('.dropdown-toggler').click(function(e) {
        e.preventDefault();

        const targetDropdownMenu = $(this).next();
        const dropdownMenu = $('.dropdown-menu');
        
        // This code snippet toggles the dropdown menu that is next to the dropdown toggler.
        targetDropdownMenu.slideToggle(200);

        // Only one dropdown menu would expand in a time.
        dropdownMenu.not(targetDropdownMenu).slideUp(200);
    });

    // Collapse menu while clicking outside
    $(document).on('click', function(e) {
        e.stopPropagation();

        if ($('.dropdown-menu').is(':visible')) {

            if ($(e.target).hasClass('dropdown-menu')) {
                
                $('.dropdown-menu').slideUp(200);
            }
        }

    });

    // Card Slider
    $('.cards .scroll').click(function(e) {
        e.preventDefault();
        
        const cardWrapper = $(this).closest('.cards').find('.card-wrapper');

        // This amount represents the pixal of movement, positve number means slide to the left, in constract means to the right.
        const scrollAmount = 400;
        
        // Next slide button
        if ($(this).hasClass('next-btn')) {
            cardWrapper.animate({
                scrollLeft: cardWrapper.scrollLeft() + scrollAmoun
            }, 500);
        }
        
        // Previous slide button
        if ($(this).hasClass('prev-btn')) {
            cardWrapper.animate({
                scrollLeft: cardWrapper.scrollLeft() - scrollAmount
            }, 500);
        }
    });
}); 