 <!-- Humberger Begin -->
 <div class="humberger__menu__overlay"></div>
 <div class="humberger__menu__wrapper">
     <div class="humberger__menu__logo">
         <a href="#"><img src="<?= ROOT ?>/assets/vendor/img/logo.png" alt=""></a>
     </div>
     <div class="humberger__menu__cart">
         <ul>
             <li><a href="<?= ROOT ?>/wishlist"><i class="fa fa-heart"></i> <span>1</span></a></li>
             <li><a href="<?= ROOT ?>/cart"><i class="fa fa-shopping-bag"></i> <span class="cart_count"><?=count(CartData::getItems() ?? []) ?></span></a></li>
         </ul>
         <div class="header__cart__price">total: <span>Rs. <?= str_replace('.00', '', number_format(CartData::getTotal(), 2)) ?></span></div>
     </div>
     <div class="humberger__menu__widget">
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
     <nav class="humberger__menu__nav mobile-menu">
         <ul>
             <li class="active"><a href="<?= ROOT ?>">Home</a></li>
             <li><a href="<?= ROOT ?>/shop">Shop</a></li>
             <li><a href="#">Pages</a>
                 <ul class="header__menu__dropdown">
                     <li><a href="<?= ROOT ?>/shop-details">Shop Details</a></li>
                     <li><a href="<?= ROOT ?>/cart">Shoping Cart</a></li>
                     <li><a href="<?= ROOT ?>/checkout">Check Out</a></li>
                     <li><a href="<?= ROOT ?>/blog-details">Blog Details</a></li>
                 </ul>
             </li>
             <li><a href="<?= ROOT ?>/blog">Blog</a></li>
             <li><a href="<?= ROOT ?>/contact">Contact</a></li>
         </ul>
     </nav>
     <div id="mobile-menu-wrap"></div>
     <div class="header__top__right__social">
         <a href="#"><i class="fa fa-facebook"></i></a>
         <a href="#"><i class="fa fa-twitter"></i></a>
         <a href="#"><i class="fa fa-linkedin"></i></a>
         <a href="#"><i class="fa fa-pinterest-p"></i></a>
     </div>
     <div class="humberger__menu__contact">
         <ul>
             <li><i class="fa fa-envelope"></i> giftszone@email.com</li>
             <li>Free Shipping for all Order of $99</li>
         </ul>
     </div>
 </div>
 <!-- Humberger End -->