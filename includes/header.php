<header id="header">
    <div class="header__top">
    <div class="container">
        <div class="header__top__logo">
        <h1><a href="/" class="logo"><?php echo $config['title']; ?></a></h1>
        </div>
        <nav class="header__top__menu">
        <ul>
            <li><a href="/">Главная</a></li>
            <li><a href="/pages/about_me.php">Обо мне</a></li>
            <li><a href="<?php echo $config['vk_url']; ?>" target="_blank">Я Вконтакте</a></li>
        </ul>
        </nav>
    </div>
    </div>

    <?php
        $categories_q = mysqli_query( $connection, "SELECT * FROM `articles_categories`" );
        $categories = array();
        while( $cat = mysqli_fetch_assoc($categories_q) ) {
            $categories[] = $cat;
        }
    ?>
    <div class="header__bottom">
    <div class="container">
        <nav>
            <ul>
                <?php 
                    foreach( $categories as $cat ) {
                        ?>
                        <li><a href="/article_categories.php?categorie=<?php echo $cat['id'] ?>"><?php echo $cat['title']; ?></a></li>
                        <?php
                    }
                ?>
            </ul>
        </nav>
    </div>
    </div>
</header>
