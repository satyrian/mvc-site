<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $newsItem['title']; ?></title>
    <!--styles-->
    <link rel="stylesheet" href="/template/stylesheet/default.css">
    <link rel="stylesheet" href="/template/stylesheet/fonts.css">
    <link rel="stylesheet" href="/template/stylesheet/scrollBar.css">
    <link rel="stylesheet" href="/template/stylesheet/menuCSS.css">
    <link rel="stylesheet" href="/template/stylesheet/mobilMenu.css">
    <link rel="stylesheet" href="/template/stylesheet/all.css">
    <link rel="stylesheet" href="/template/stylesheet/footer.css">
    <link rel="stylesheet" href="/template/stylesheet/new.css">
    <link rel="stylesheet" href="/template/stylesheet/media.css">
    <link rel="stylesheet" href="/template/stylesheet/nprogress.css">
    <!--scripts-->
    <script src="/template/scripts/jq.min.js"></script>
    <script src="/template/scripts/nprogress.js"></script>
</head>
<body>
<header id="header">
    <div class="nav-container f-nav">
        <div class="nav">
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="/news/">Новости</a></li>
                <li><a href="/tickets/">Касса</a></li>
                <li><a href="/collection/">Произведения</a></li>
                <li><a href="/jobs/">Вакансии</a></li>
                <li><a href="/contacts/">Контакты</a></li>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="user-menu">
            <div class="user-avatar" id="close__" onclick="openUserProfil()" >
                <img src="<?php echo User::getImage($idUser); ?>" alt="user-avatar">
                <p><i class="fas fa-angle-down"></i></p>
            </div>
            <div class="menu-wrap">
                <div class="menu">
                    <ul class="user-menu-items">
                        <?php if (User::isGuest()): ?>
                            <li><a href="/cart/">Моя корзина (<span id="cart-count"><?php echo Cart::countItems(); ?></span>)</a></li>
                            <li><a href="#">Помощь</a></li>
                            <li><a href="/user/register/">Регистрация</a></li>
                            <li><a href="/user/login/">Вход</a></li>
                        <?php elseif (User::checkRole($idUser)): ?>
                            <li><a href="/admin/">Админпанель</a></li>
                            <li><a href="/cart/">Моя корзина (<span id="cart-count"><?php echo Cart::countItems(); ?></span>)</a></li>
                            <li><a href="/cabinet/">Профиль</a></li>
                            <li><a href="/cabinet/edit/">Настройки</a></li>
                            <li><a href="#">Помощь</a></li>
                            <li><a href="/user/logout/">Выход</a></li>
                        <?php else: ?>
                            <li><a href="/cart/">Моя корзина (<span id="cart-count"><?php echo Cart::countItems(); ?></span>)</a></li>
                            <li><a href="/cabinet/">Профиль</a></li>
                            <li><a href="/cabinet/edit/">Настройки</a></li>
                            <li><a href="#">Помощь</a></li>
                            <li><a href="/user/logout/">Выход</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="mobil_menu">
        <div class="wrap-menu">
            <div class="nav-menu">
                <ul>
                    <li><a href="/">Главная</a></li>
                    <li><a href="/news/">Новости</a></li>
                    <li><a href="/tickets/">Касса</a></li>
                    <li><a href="/collection/">Произведения</a></li>
                    <li><a href="/jobs/">Вакансии</a></li>
                    <li><a href="/contacts/">Контакты</a></li>
                </ul>
            </div>
            <button class="open-the-menu" id="close" onclick="tranformation_btn()">
                <div class="line line1"></div>
                <div class="line line2"></div>
                <div class="line line3"></div>
            </button>
        </div>
    </div>
</header>
<section id="new">
    <div class="main-container-two">
        <div class="header-text">
            <h3>Новость <?php echo $newsItem['id']; ?></h3>
            <hr class="long">
            <hr class="medium">
            <hr class="short">
        </div>
        <div class="new-title">
            <div class="text-information">
                <h2><?php echo $newsItem['title']; ?></h2>
                <div class="image-new">
                    <img src="/template/museums_pictures/slider1.jpg" alt="">
                </div>
                <p><?php echo $newsItem['content']; ?></p>
                <div class="price">
                    <h3></h3>
                </div>
                <div class="share">
                    <h2>Поделится</h2>
                    <ul>
                        <li><a href=""><i class="fab fa-vk"></i></a></li>
                        <li><a href=""><i class="fab fa-instagram"></i></a></li>
                        <li><a href=""><i class="fab fa-twitter"></i></a></li>
                        <li><a href=""><i class="fab fa-pinterest"></i></a></li>
                        <li><a href=""><i class="fas fa-rss"></i></a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
<footer id="footer">
    <div class="main-container-two">
        <div class="last-information-about-museum">
            <ul class="navs">
                <li><a href="">Help</a></li>
                <li><a href="">Contact</a></li>
                <li><a href="">Gift Cards</a></li>
                <li><a href="">Dealers</a></li>
                <li><a href="">Foundation</a></li>
            </ul>
        </div>
        <div class="last-social-network">
            <ul class="navs">
                <li><a href=""><i class="fab fa-vk vk"></i></a></li>
                <li><a href=""><i class="fab fa-instagram inst"></i></a></li>
                <li><a href=""><i class="fab fa-twitter twit"></i></a></li>
                <li><a href=""><i class="fas fa-rss rss"></i></a></li>
                <li><a href=""><i class="fab fa-twitch twitch"></i></a></li>
            </ul>
        </div>
        <div class="last-polity">
            <ul class="navs">
                <li><a href="">social compliance</a></li>
                <li><a href="">terms</a></li>
                <li><a href="">privacy policy</a></li>
            </ul>
        </div>
        <div class="info-about-creature">
            <p>Site by Chopper & Condecrom</p>
        </div>
    </div>
</footer>
<!--scripts-->
<script src="/template/scripts/animationMobilMenu.js"></script>
<script src="/template/scripts/loader.js"></script>
<script src="/template/scripts/slider.js"></script>
</body>
</html>
