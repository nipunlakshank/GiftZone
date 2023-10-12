

async function addToCart(id) {
    const res = await request(`${ROOT}/cart/add`, { productId: id }, "post")
    console.log(res)

    const cartIcon = document.querySelector(`#product-item-${id} .product_item_cart_icon`)
    if (res.success)
        cartIcon.classList.add('active')

    setCartCount(res.count)
    setCartTotal(res.total)
}

async function removeFromCart(id) {
    const res = await request(`${ROOT}/cart/remove`, { productId: id }, "post")
    console.log(res)
    const cartIcon = document.querySelector(`#product-item-${id} .product_item_cart_icon`)
    cartIcon.classList.remove('active')
    setCartCount(res.count)
    setCartTotal(res.total)
}

function setCartTotal(total) {
    const cartTotals = document.querySelectorAll('.shoping__checkout .cart_total')

    for (const cartTotal of cartTotals) {
        cartTotal.innerText = `Rs. ${total}`
    }
}

function setCartCount(count) {
    const cartCounts = document.querySelectorAll('.cart_count')

    cartCounts.forEach(cartCount => {
        cartCount.innerText = count
    });
}


const productItems = document.querySelectorAll('.product__item')

// Adding event listeners for cart icons
productItems.forEach(item => {
    const idText = item.id
    const productId = idText.replace(/\D/g, '')
    const cartIcon = document.querySelector(`#product-item-${productId} .product_item_cart_icon`)

    cartIcon.addEventListener('click', () => {
        if (cartIcon.classList.contains('active')) {
            removeFromCart(productId)
            cartIcon.classList.remove('active')
            return
        }
        addToCart(productId)
        cartIcon.classList.add('active')
    })
});

