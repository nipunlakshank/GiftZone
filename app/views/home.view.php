<?php $this->view('includes/header') ?>

<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Categories</span>
                    </div>
                    <ul>
                        <?php foreach ($categories as $id => $name) : ?>
                            <li><a href="<?= ROOT ?>/shop/category/<?= $id ?>"><?= $name ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="<?= ROOT ?>/shop/search" method="post">
                            <select name="cat_id" class="search_form_category">
                                <option value="0">All Categories</option>
                                <?php if (!empty($categories)) : ?>
                                    <?php foreach ($categories as $id => $name) : ?>
                                        <option value="<?= $id ?>"><?= $name ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <input list="search-list" value="<?= $keyword ?? '' ?>" placeholder="What do yo u need?" dir="ltr" class="search__field" name="keyword" />
                            <datalist id="search-list">
                                <?php if (!empty($products)) : ?>
                                    <?php foreach ($products as $product) : ?>
                                        <option value="<?= $product->name ?>"></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </datalist>

                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5><?= APP_TEL ?></h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
                <div class="hero__item set-bg" data-setbg="<?= ROOT ?>/assets/img/bg/banner.png">
                    <div class="hero__text">
                        <span><?= APP_NAME ?></span>
                        <h2>Best Gifts <br />50% Discounts</h2>
                        <p>Free Pickup and Delivery Available</p>
                        <a href="#" class="primary-btn">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php if (!empty($categories)) : ?>
                    <?php foreach ($categories as $id => $name) : ?>
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" id="categories-item-<?= $id ?>" data-setbg="<?= ROOT ?>/assets/img/categories/cat-<?= $id ?>.jpg">
                                <h5><a href="<?= ROOT ?>/shop/category/<?= $id ?>"><?= $name ?></a></h5>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<?php $this->view('includes/footer') ?>