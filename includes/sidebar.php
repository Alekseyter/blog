<!-- <div class="block">
    <h3>Мы_знаем</h3>
    <div class="block__content">
    <script type="text/javascript" src="//rf.revolvermaps.com/0/0/6.js?i=5z5zec3a5dt&amp;m=7&amp;c=e63100&amp;cr1=ffffff&amp;f=arial&amp;l=0&amp;bv=90&amp;lx=-420&amp;ly=420&amp;hi=20&amp;he=7&amp;hc=a8ddff&amp;rs=80" async="async"></script>
    </div>
</div> -->

<div class="block">
    <h3>Топ читаемых статей</h3>
    <div class="block__content">
        <div class="articles articles__vertical">

        <?php
            $articles = mysqli_query( $connection, "SELECT * FROM `articles` ORDER BY `views` DESC LIMIT 5" );
            while( $art = mysqli_fetch_assoc($articles) ) {
                ?>
                <article class="article">
                <div class="article__image" style="background-image: url(/image/<?php echo $art['image']; ?>);"></div>
                <div class="article__info">
                    <a href="/article.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
                    <div class="article__info__meta">
                    <?php
                        $art_cat;
                        foreach( $categories as $cat ) {
                        if( $cat['id'] == $art['categorie_id'] ) {
                            $art_cat = $cat;
                            break;
                        }
                        }
                    ?>
                    <small>Категория: <a href="/article_categories.php?categorie=<?php echo $art_cat['id']; ?>"><?php echo $art_cat['title']; ?></a></small>
                    </div>
                    <div class="article__info__preview"><?php echo mb_substr(strip_tags($art['text']), 0, 80, 'UTF-8') . ' ...'; ?></div>
                </div>
                </article>
                <?php
            }
        ?>

        </div>
    </div>
</div>

<div class="block">
    <h3>Комментарии</h3>
    <div class="block__content">
        <div class="articles articles__vertical">

        <?php
            $comments = mysqli_query( $connection, "SELECT * FROM `comments` ORDER BY `id` DESC LIMIT 5" );
            while( $comment = mysqli_fetch_assoc($comments) ) {
                ?>
                <article class="article">
                <div class="article__image" style="background-image: url(https://www.gravatar.com/avatar/<?php echo $comment['email']; ?>);"></div>
                <div class="article__info">
                    <a href="/article.php?id=<?php echo $comment['articles_id']; ?>"><?php echo $comment['autor']; ?></a>
                    <div class="article__info__meta">
                    <?php
                        $art_name;
                        foreach( $articles as $art ) {
                        if( $art['id'] == $comment['articles_id'] ) {
                            $art_name = $art;
                            break;
                        }
                        }
                    ?>
                    <small>Статья: <a href="/article.php?id=<?php echo $comment['articles_id']; ?>"><?php echo $art_name['title']; ?></a></small>
                    </div>
                    <div class="article__info__preview"><?php echo mb_substr(strip_tags($comment['text']), 0, 80, 'UTF-8') . ' ...'; ?></div>
                </div>
                </article>
                <?php
            }
        ?>

        </div>
    </div>
</div>