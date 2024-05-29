$(document).ready(() => {
    const form = $('#cart');
    let items = 0;
    let total = 0;

    retrieveCartData();

    // Submit cart form
    form.on('keydown', e => {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });

    // Retrieve cart data
    function retrieveCartData() {
        $.ajax({
            type: 'get',
            url: bookstore_cart.ajaxurl, // This is the URL for the WordPress AJAX endpoint from Register_Script_Style class
            datatype: 'json',
            data: {
                action: 'get_cart_data'
            },
            success: res => {
                // Get the data from the response
                const resData = res.data;

                // Preset the cart template
                let cartTemplate = ''; 

                // Check if the cart is empty
                if (resData.length === 0) {
                    cartTemplate = `
                        <h2 class="not-found-display">Your cart is empty</h2>
                    `
                } else {
                    // If the cart is not empty, display all item using for loop
                    for (let i = 0; i < resData.length; i++) {
                        const id = resData[i]['id'];
                        const qty = resData[i]['qty'];
                        const title = resData[i]['title'];
                        const permalink = resData[i]['permalink'];
                        const image = resData[i]['image'];
                        const price = resData[i]['price'];
                        const inStock = resData[i]['in_stock'];
                        const subtotal = resData[i]['subtotal'];

                        // Total
                        items = resData[i]['items'];
                        total += resData[i]['subtotal'];

                        cartTemplate += `
                        <div class="item" data-value="${id}">
                        <div class="item-heading">
                            <i class="trash bi bi-trash-fill"></i>
                            <img class="cart-image" src="${image}" alt="">
                        </div>
                        <div class="item-body">
                            <h4 class="item-title"><a href="${permalink}">${title}</a></h4>
                            <div class="btn-group">
                                <i class="qty-btn minus bi bi-dash-square-fill"></i>
                                <input class="item-qty" type="text" name="qty" value="${qty}">
                                <i class="qty-btn plug bi bi-plus-square-fill"></i>
                            </div>
                            <p class="item-stock ${inStock}">${inStock.split('-').join(' ')}</p>
                            <p class="item-unit-price">Unit Price: $${price}</p>
                        </div>
                        <p class="item-total">Item Total: <span  class="item-price">$${subtotal}</span></p>
                        </div>
                        `
                    }
                }

                $('.items').html(cartTemplate);

                // Acumulator
                accumulator(items, total);

                // Remove cart item
                $('.trash').click(function(e) {
                    e.preventDefault();
                    
                    // Get the item ID
                    const id = $(this).closest('.item').attr('data-value');
                    removeCartItem(id);
                });

                // Change the QTY
                $('.qty-btn').click(function(e) {
                    e.preventDefault();

                    // Get the item ID and current qty
                    const id = $(this).closest('.item').attr('data-value');
                    let qty = form.find('[name="qty"]').val();

                    changeQty($(this), id, qty);
                });
            },
            error: err => {
                console.log(err);
            }
        });
    };

    // Remove cart item
    function removeCartItem(id) {
        $.ajax({
            type: 'post',
            url: bookstore_cart.ajaxurl, // This is the URL for the WordPress AJAX endpoint from Register_Script_Style class,
            datatype: 'json',
            data: {
                action: 'remove_cart_item',
                data: id
            },
            success: () => {
                // Reset the total to 0 and accumulate again
                total = 0

                // Everytime remove an item from the cart, retrieve all books again
                retrieveCartData();
            },
            error: err => {
                console.log(err);
            }
        });
    };

    // Count the numbers of item and accumulate the total
    function accumulator(items, total) {
        $('.total').html(`
            <p>Item(s): ${items}</p>
            <p>Subtotal: $${total}</p>
        `);
    };

    // Change qty
    function changeQty(btn, id, qty) {

        if (btn.hasClass('minus')) {
            qty--;
        } else if (btn.hasClass('plug')) {
            qty++;
        }
        
        $.ajax({
            type: 'post',
            url: bookstore_cart.ajaxurl, // This is the URL for the WordPress AJAX endpoint from Register_Script_Style class
            datatype: 'json',
            data: {
                action: 'change_item_qty',
                data: {id, qty}
            },
            success: res => {
                console.log(res);
            },
            error: err => {
                console.log(err);
            }
        });
    };
});