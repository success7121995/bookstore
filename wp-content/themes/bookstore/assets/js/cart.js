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
                const resData = res.data;

                // Preset the cart template
                let cartTemplate = ''; 

                for (let i = 0; i < resData.length; i++) {
                    const id = resData[i]['id'];
                    const qty = resData[i]['qty'];
                    const title = resData[i]['title'];
                    const permalink = resData[i]['permalink'];
                    const image = resData[i]['image'];
                    const price = resData[i]['price'];

                    // Subtotal
                    const subtotal = price * qty;

                    cartTemplate += `
                    <div class="item">
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
                        <p class="item-stock out-of-stock">Out Of Stock</p>
                        <p class="item-unit-price">Unit Price: $${price}</p>
                    </div>
                    <p class="item-total">Item Total: <span  class="item-price">$${subtotal}</span></p>
                    </div>
                    `
                }

                $('.items').html(cartTemplate);
            },
            error: err => {
                console.log(err);
            }
        })
    }
});