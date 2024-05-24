$(document).ready(() => {
    // Change QTY
    $('.qty-btn').click(function(e) {
        e.preventDefault();

        // Get the QTY value
        let qty = $(this).closest('.item-qty').find('input');
        let currentQty = qty.attr('value');

        // Identify whether minus button or plug button is being clicked
        const minusBtn = $(this).hasClass('minus');
        const plugBtn = $(this).hasClass('plug');

        // 
        if (minusBtn) currentQty--;
        else if (plugBtn) currentQty++;
        
        qty.attr('value', currentQty);
    });
});