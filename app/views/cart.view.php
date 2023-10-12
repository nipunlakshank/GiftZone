<?php $this->view('includes/header') ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="<?= ROOT ?>/assets/img/bg/breadcrumb.png">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2><?= APP_NAME ?></h2>
                    <div class="breadcrumb__option">
                        <span><?= ucfirst(App::$page) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price (Rs.)</th>
                                <th>Quantity</th>
                                <th>Total (Rs.)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $cartItems = CartData::getItems() ?? [] ?>
                            <?php if (!empty($cartItems)) : ?>
                                <?php foreach ($cartItems as $item) : ?>
                                    <tr class="cart_item" id="cart-item-<?= $item->id ?>">
                                        <td class="shoping__cart__product">
                                            <img class="cart_item_img" src="<?= ROOT ?>/assets/img/products/<?= str_replace(" ", "_", strtolower($categories[$item->cat_id])) ?>/<?= $item->img ?>" alt="<?= $item->name ?>" />
                                            <h5><?= $item->name ?></h5>
                                        </td>
                                        <td class="shoping__cart__item__price">
                                            <span><?= str_replace('.00', '', number_format($item->price, 2)) ?></span>
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <span class="dec qtybtn" onclick="decQty(<?= $item->id ?>)">-</span>
                                                    <input type="text" class="cart_item_qty" value="<?= $item->qty ?>">
                                                    <span class="inc qtybtn" onclick="incQty(<?= $item->id ?>)">+</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__item__total">
                                            <span><?= str_replace('.00', '', number_format($item->total, 2)) ?></span>
                                        </td>
                                        <td class="shoping__cart__product__close">
                                            <span class="icon_close" onclick="removeCartItem(<?= $item->id ?>)"></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                        Upadate Cart</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Subtotal <span class="cart_total" id="cart-subtotal">Rs. <?= str_replace('.00', '', number_format(CartData::getTotal(), 2)) ?></span></li>
                        <li>Total <span class="cart_total" id="cart-total">Rs. <?= str_replace('.00', '', number_format(CartData::getTotal(), 2)) ?></span></li>
                    </ul>
                    <a href="<?= ROOT ?>/checkout" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->

<?php $this->view("includes/footer") ?>