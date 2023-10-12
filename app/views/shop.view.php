<!-- header -->
<?php $this->view('includes/header') ?>

<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Categories</span>
                    </div>
                    <ul>
                        <?php if (!empty($categories)) : ?>
                            <?php foreach ($categories as $id => $name) : ?>
                                <li><a href="<?= ROOT ?>/shop/category/<?= $id ?>"><?= $name ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
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
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="<?= ROOT ?>/assets/img/bg/breadcrumb.jpg">
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

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item filter__category">
                        <h4>Category</h4>
                        <ul>
                            <li><a href="<?= ROOT ?>/shop/category/0" <?php if ($cat_id == 0) : ?> class="active" <?php endif; ?>>All</a></li>
                            <?php foreach ($categories as $id => $name) : ?>
                                <li><a href="<?= ROOT ?>/shop/category/<?= $id ?>" <?php if ($id == $cat_id) : ?> class="active" <?php endif; ?>><?= $name ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">

                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sort By</span>
                                <select>
                                    <option value="0">Default</option>
                                    <option value="0">Default</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span><?= $total_items ?></span> Products found</h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php if (!empty($filtered_items)) : ?>
                        <?php foreach ($filtered_items as $item) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item" id="product-item-<?= $item->id ?>">
                                    <div class="product__item__pic set-bg" data-setbg="<?= ROOT ?>/assets/img/products/<?= str_replace(" ", "_", strtolower($categories[$item->categories_id])) ?>/<?= $item->img ?>">
                                        <ul class="product__item__pic__hover">
                                            <li class="product_item_heart_icon"><a><i class="fa fa-heart"></i></a></li>
                                            <li class="product_item_cart_icon<?= CartData::hasProduct($item->id) ? ' active' : '' ?>"><a><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#"><?= $item->name ?></a></h6>
                                        <h5>Rs. <?= $item->price ?></h5>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Pagination Start -->
                <div class="product__pagination">
                    <?php if ($pagination['show_prev']) : ?>
                        <a href="<?= ROOT ?>/shop/category/<?= $cat_id ?>/<?= $pagination['active'] - 1 ?>"><i class="fa fa-long-arrow-left"></i></a>
                    <?php endif; ?>
                    <?php for ($i = $pagination['start']; $i <= $pagination['end']; $i++) : ?>
                        <a <?php if ($i != $pagination['active']) : ?>href="<?= ROOT ?>/shop/category/<?= $cat_id ?>/<?= $i ?>" <?php else : ?>class="active" <?php endif; ?>><?= $i ?></a>
                    <?php endfor; ?>
                    <?php if ($pagination['show_next']) : ?>
                        <a href="<?= ROOT ?>/shop/category/<?= $cat_id ?>/<?= $pagination['active'] + 1 ?>"><i class="fa fa-long-arrow-right"></i></a>
                    <?php endif; ?>
                </div>
                <!-- Pagination End -->

            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- footer -->
<?php $this->view('includes/footer') ?>