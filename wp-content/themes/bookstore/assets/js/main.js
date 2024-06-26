$(document).ready(() => {
    const animationDurtion = 200;

    // Logout
    $('#logout').click(e => {
        e.preventDefault();

        // Fire off the request to the /admin-ajax.php
        $.ajax({
            type: 'get',
            url: bookstore_ajax.ajaxurl, // This is the URL for the WordPress AJAX endpoint from Register_Script_Style class
            data: {
                action: 'logout',
                data: ''
            },
            success: () => {
                // Redirect to home page
                window.location.href = '/bookstore';
            },
            error: err => {
                console.log(err);
            }
        });
    });

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
            }, sliderAnimationDurtion);
        }
        
        // Previous slide button
        if ($(this).hasClass('prev-btn')) {
            cardWrapper.animate({
                scrollLeft: cardWrapper.scrollLeft() - scrollAmount
            }, sliderAnimationDurtion);
        }
    });

    // Hidden Password
    $('.eye').click(function(e) {
        e.preventDefault();

        // Get the current password display type
        const password = $(this).closest('.password').find('input');

        // Check if the password is hidden
        if (password.is('[type="password"]')){
            
            // Change the input type to text to display the password
            $(this).removeClass('bi-eye-slash').addClass('bi-eye');
            password.attr('type', 'text');
            
        } else if (password.is('[type="text"')) {
        
            // Change the input type to text to hide the password
            $(this).removeClass('bi-eye').addClass('bi-eye-slash');
            password.attr('type', 'password');
        }
    });

    // Add to cart
    $('.add-to-cart').click(function(e) {
        e.preventDefault();

        const addToCartBtn = $(this);
        const id = $(this).attr('data-value');

        // Fire off the request to the /admin-ajax.php
        $.ajax({
            type: 'post',
            url: bookstore_ajax.ajaxurl, // This is the URL for the WordPress AJAX endpoint from Register_Script_Style class
            datatype: 'json',
            data: {
                action: 'add_to_cart',
                data: id
            },
            success: () => {
                // Appear a tick message with changing to green background while it is successfully processed 
                addToCartBtn.addClass('added');
                addToCartBtn.text('');

                // Resume normal appearance after 3 seconds
                setTimeout(function() {
                    addToCartBtn.removeClass('added');
                    addToCartBtn.text('Add to Cart');
                }, 2000);

            },
            error: err => {
                const error = err.responseJSON.data; 

                // If user has not logged in, redirect the user to login page
                if (error === 'not_authenticated') {
                    window.location.href = '/bookstore/login';
                }
            }
        });      
    });
});