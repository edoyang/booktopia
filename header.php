<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="/wordpress/wp-content/themes/booktopia/assets/images/favicon" type="image/x-icon">

    <?php 
    wp_head(); 
    ?>

</head>
<body>

    <!-- HEADER -->
    <header>
        <nav>
            <div class="navigation">
                <img src="/wordpress/wp-content/themes/booktopia/assets/images/nav.svg" class="toggle-button" alt="nav" data-target="navigation-list">
                <div class="navigation-list none">

                <div class="logo"><a href="home">Booktopia</a></div>


                    <?php
                    wp_nav_menu(
                        array(
                            'menu' => 'primary',
                            'theme_location' => 'primary',
                            'container' => '',
                            'items_wrap' => '<ul id="" class="">%3$s</ul>'
                        )
                    );
                    ?>
                </div>
            </div>

            <label for="search" class="search">
                <img src="/wordpress/wp-content/themes/booktopia/assets/images/search.svg" width="20px" height="20px" alt="search-button">
                <input autocomplete="off" name="search" id="search" type="text" placeholder="What are you looking for ?">
            </label>
        </nav>

        <div class="user-navigation">
            <div class="user">
                <img src="/wordpress/wp-content/themes/booktopia/assets/images/user.svg" alt="user" class="toggle-button" data-target="user-menu">
                <ul class="user-menu none">
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Settings</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>

            <a href="#"><img src="/wordpress/wp-content/themes/booktopia/assets/images/wishlist.svg" width="22px" height="22px" alt="wishlist"></a>

            <div class="btn-primary cart">
                <img src="/wordpress/wp-content/themes/booktopia/assets/images/cart.svg" alt="cart">
                <span>0</span>

                <div class="cart-menu none">
                    <ul>
                        <li><a href="#">Book 1</a></li>
                        <li><a href="#">Book 2</a></li>
                        <li><a href="#">Book 3</a></li>
                        <li><a href="#">Book 4</a></li>
                        <li><a href="#">Book 5</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>