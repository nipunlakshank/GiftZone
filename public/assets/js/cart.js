
async function decQty(id) {
    const qty = document.querySelector(`#cart-item-${id} input.cart_item_qty`)

    if (!qty) return
    const oldVal = Number(qty.value)
    if (oldVal < 1) {
        qty.value = 0
        return
    }
    const newVal = oldVal - 1
    const res = await request(`${ROOT}/cart/edit`, { itemId: id, qty: newVal }, "post")
    udpateCart(res)
}


async function incQty(id) {
    const qty = document.querySelector(`#cart-item-${id} input.cart_item_qty`)
    const oldVal = Number(qty.value)
    const newVal = oldVal + 1

    const res = await request(`${ROOT}/cart/edit`, { itemId: id, qty: newVal }, "post")
    udpateCart(res)
}

async function removeCartItem(id){
    const res = await request(`${ROOT}/cart/remove`, { itemId: id }, "post")
    const item = document.getElementById(`cart-item-${id}`)
    item.remove()
    setCartTotal(res.total)
    setCartCount(res.count)
}

function udpateCart(data){
    const item = data.item
    const total = data.total

    const qty = document.querySelector(`#cart-item-${item.id} input.cart_item_qty`)
    const itemPrice = document.querySelector(`#cart-item-${item.id} .shoping__cart__item__price > span`)
    const itemTotal = document.querySelector(`#cart-item-${item.id} .shoping__cart__item__total > span`)

    qty.value = item.qty
    itemPrice.innerText = item.price
    itemTotal.innerText = item.total
    setCartTotal(total)

}

function setCartTotal(total){
    const cartTotals = document.querySelectorAll('.shoping__checkout .cart_total')

    for (const cartTotal of cartTotals) {
        cartTotal.innerText = `Rs. ${total}`
    }
}

function setCartCount(count){
    const cartCounts = document.querySelectorAll('.cart_count')

    cartCounts.forEach(cartCount => {
        cartCount.innerText = count
    });
}


