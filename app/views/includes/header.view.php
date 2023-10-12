<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Gift Zone">
    <meta name="keywords" content="giftzone, gift zone, gift, zone">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= App::$page ?> | <?= APP_NAME ?></title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/vendor/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/vendor/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/vendor/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/vendor/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/vendor/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/vendor/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/vendor/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/vendor/css/style.css" type="text/css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/main.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/<?= strtolower(App::$page) ?>.css">

    <!-- Js Plugins -->
    <script defer src="<?= ROOT ?>/assets/vendor/js/jquery-3.3.1.min.js"></script>
    <script defer src="<?= ROOT ?>/assets/vendor/js/bootstrap.min.js"></script>
    <script defer src="<?= ROOT ?>/assets/vendor/js/jquery.nice-select.min.js"></script>
    <script defer src="<?= ROOT ?>/assets/vendor/js/jquery-ui.min.js"></script>
    <script defer src="<?= ROOT ?>/assets/vendor/js/jquery.slicknav.js"></script>
    <script defer src="<?= ROOT ?>/assets/vendor/js/mixitup.min.js"></script>
    <script defer src="<?= ROOT ?>/assets/vendor/js/owl.carousel.min.js"></script>
    <script defer src="<?= ROOT ?>/assets/vendor/js/main.js"></script>
    <script defer src="<?= ROOT ?>/assets/js/main.js"></script>
    <script defer src="<?= ROOT ?>/assets/js/<?= strtolower(App::$page) ?>.js"></script>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php $this->view('includes/humberger') ?>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> <?= APP_EMAIL ?></li>
                                <li>Free Shipping for all Order of $99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="<?= ROOT ?>/#"><i class="fa fa-facebook"></i></a>
                                <a href="<?= ROOT ?>/#"><i class="fa fa-twitter"></i></a>
                                <a href="<?= ROOT ?>/#"><i class="fa fa-linkedin"></i></a>
                                <a href="<?= ROOT ?>/#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__user">
                                <?php if (Auth::logged_in()) : ?>
                                    <span><?= Auth::getFname() ?? 'Account' ?></span>
                                    <span class="arrow_carrot-down"></span>
                                    <ul>
                                        <?php if (Auth::logged_in() && Auth::is_admin()) : ?>
                                            <li><a href="<?= ROOT ?>/admin">Dashboard</a></li>
                                        <?php endif; ?>
                                        <li><a href="<?= ROOT ?>/profile">Profile</a></li>
                                        <li><a href="<?= ROOT ?>/cart">Cart</a></li>
                                        <li><a href="<?= ROOT ?>/wishlist">Wishlist</a></li>
                                        <li><a href="<?= ROOT ?>/logout">Logout</a></li>
                                    </ul>
                                <?php else : ?>
                                    <span>Guest</span>
                                <?php endif; ?>
                            </div>
                            <div class="header__top__right__auth">
                                <?php if (Auth::logged_in()) : ?>
                                    <a href="<?= ROOT ?>/logout"><i class="fa fa-user"></i> Logout</a>
                                <?php else : ?>
                                    <a href="<?= ROOT ?>/login"><i class="fa fa-user"></i> Login</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="<?= ROOT ?>"><img src="<?=ROOT?>/assets/img/logo/<?= APP_LOGO ?>" alt="<?= APP_NAME ?>"></a> <!-- Provided logo is not suitable here -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li <?= strtolower(App::$page) == 'home' ? 'class="active"' : '' ?>><a href="<?= ROOT ?>">Home</a></li>
                            <li <?= strtolower(App::$page) == 'shop' ? 'class="active"' : '' ?>><a href="<?= ROOT ?>/shop">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="<?= ROOT ?>/shop-details">Shop Details</a></li>
                                    <li><a href="<?= ROOT ?>/cart">Shoping Cart</a></li>
                                    <li><a href="<?= ROOT ?>/checkout">Check Out</a></li>
                                    <li><a href="<?= ROOT ?>/blog-details">Blog Details</a></li>
                                </ul>
                            </li>
                            <li <?= strtolower(App::$page) == 'blog' ? 'class="active"' : '' ?>><a href="<?= ROOT ?>/blog">Blog</a></li>
                            <li <?= strtolower(App::$page) == 'contact' ? 'class="active"' : '' ?>><a href="<?= ROOT ?>/contact">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="<?= ROOT ?>/wishlist"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="<?= ROOT ?>/cart"><i class="fa fa-shopping-bag"></i> <span class="cart_count"><?= count(CartData::getItems() ?? []) ?></span></a></li>
                        </ul>
                        <div class="header__cart__price">total: <span>Rs. <?= str_replace('.00', '', number_format(CartData::getTotal(), 2)) ?></span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->