$(document).ready(() => {
    const form = $('#cart');
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
                console.log(resData);

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
                        const inStock = resData[1]['in_stock'];

                        // Subtotal
                        const subtotal = price * qty;

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

                // Remove cart item
                $('.trash').click(function(e) {
                    e.preventDefault();
                    
                    console.log('hi');
                    const id = $(this).closest('.item').attr('data-value');
                    removeCartItem(id);
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
            success: res => {
                retrieveCartData();
                // console.log(res);
            },
            error: err => {
                console.log(err);
            }
        });
    }

});