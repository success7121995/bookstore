$(document).ready(() => {

    const animationDurtion = 200;
    
    // Toggle navbar nav in mobile view
    $('.navbar-toggler').click(function(e) {
        e.preventDefault();

        // Only activate the function in mobile view (less then 768)
        if ($(window).width() < 768) {

            // This code snippet toggles the navbar-toggler and extracts the value of the data-target attribute. It then selects the navbar nav element with an id that matches the data target value. Finally, it toggles the targetNav element.
            const dataTarget = $(this).attr('data-target'); 
            const targetNav = $(`[id=${dataTarget}]`);
            targetNav.slideToggle(animationDurtion);
        }
    });

    // Collapse menu while clicking anywhere
    $(document).click((e) => {
        e.stopPropagation();

        // the function will only be toggled in mobile view
        if ($(window).width() < 768) {

            // If navbar nav is expanded, the function is toggled
            if ($('.navbar-nav').is(':visible')) {
                
                //If the clicked element has the class '.navbar-nav', it returns an array. The array's length will be 0 if there is no matching class. This indicates that we are clicking an external element.
                if (!$(e.target).closest('.navbar-nav').length && !$(e.target).is('.navbar-toggler .bi-list')) {
                    
                    $('.navbar-nav').slideUp(animationDurtion);
                }
            }
        }
    });
     
    // Toggle dropdown menu in navbar nav
    $('.dropdown-toggler').click(function(e) {
        e.preventDefault();

        const targetDropdownMenu = $(this).next();
        const dropdownMenu = $('.dropdown-menu');
        
        // This code snippet toggles the dropdown menu that is next to the dropdown toggler.
        targetDropdownMenu.slideToggle(animationDurtion);

        // Only one dropdown menu would expand in a time.
        dropdownMenu.not(targetDropdownMenu).slideUp(animationDurtion);
    });

    // Collapse dropdown menu while clicking anywhere
    $(document).click((e) => {
        e.stopPropagation();

        if ($('.dropdown-menu').is(':visible')) {

            if (!$(e.target).closest('.dropdown-menu').length && !$(e.target).is('.dropdown-toggler')) {
                
                $('.dropdown-menu').slideUp(animationDurtion);
            }
        }
    });

    // Card Slider
    $('.cards .scroll').click(function(e) {
        e.preventDefault();

        sliderAnimationDurtion = 500;
        
        const cardWrapper = $(this).closest('.cards').find('.card-wrapper');

        // console.log(cardWrapper.width());

        // This amount represents the pixal of movement, positve number means slide to the left, in constract means to the right.
        const scrollAmount = 400;
        
        // Next slide button
        if ($(this).hasClass('next-btn')) {
            cardWrapper.animate({
                scrollLeft: cardWrapper.scrollLeft() + scrollAmount
            }, sliderAnimationDurtion, cardSliderBtnVisibility($(this), cardWrapper));
        }
        
        // Previous slide button
        if ($(this).hasClass('prev-btn')) {
            cardWrapper.animate({
                scrollLeft: cardWrapper.scrollLeft() - scrollAmount
            }, sliderAnimationDurtion, cardSliderBtnVisibility($(this), cardWrapper));
        }
    });

    const cardSliderBtnVisibility = (btn, cardWrapper) => {
        // console.log(cardWrapper);
    }
}); 