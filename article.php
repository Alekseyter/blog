<?php
  require 'includes/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $config['title']; ?></title>

  <!-- Bootstrap Grid -->
  <link rel="stylesheet" type="text/css" href="/css/grid12.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>

  <div id="wrapper">

  <?php include 'includes/header.php' ?>

  <div id="content">
    <div class="container">
      <div class="row">
        <section class="content__left col-md-8">

          <?php
            $article = mysqli_query( $connection, "SELECT * FROM `articles` WHERE `id` = " . (int) $_GET['id'] );
            if( mysqli_num_rows($article) <= 0 ) {
              ?>
              <div id="content">
                <div class="container">
                  <div class="row">
                    <section class="content__left col-md-8">
                      <div class="block">
                        <div class="block__content">
                          <div class="full-text">
                            <h1>Статья не найдена!</h1>
                            <p>Запрашиваемая Вами статья не найдена, попробуйте другой запрос.</p>
                          </div>
                        </div>
                      </div>
                    </section>
                    <section class="content__right col-md-4">
                      <?php include 'includes/sidebar.php' ?>
                    </section>
                  </div>
                </div>
              </div>
              <?php
            } else {
            $art = mysqli_fetch_assoc( $article );
            mysqli_query( $connection, "UPDATE `articles` SET `views` = `views` + 1 WHERE `id` = " . (int) $art['id'] );
            ?>
            <div class="block">
              <a><?php echo $art['views']; ?> просмотров</a>
              <h3><?php echo $art['title']; ?></h3>
              <div class="block__content">
                <img src="/image/<?php echo $art['image']; ?>">
                <div class="full-text">
                  <h1><?php echo $art['title']; ?></h1>
                  <p><?php echo $art['text']; ?></p>
                </div>
              </div>
            </div>

            <div class="block" id="comments-block">
              <a href="#comment-add-form">Добавить свой</a>
              <h3>Комментарии к статье</h3>
              <div class="block__content">
                <div class="articles articles__vertical">

                <?php
                  $comments = mysqli_query( $connection, "SELECT * FROM `comments` WHERE `articles_id` = " . (int) $art['id'] . " ORDER BY `id` DESC " );
                  if( mysqli_num_rows($comments) <= 0 ) {
                    echo 'Без комментариев!';
                  }
                  while( $comment = mysqli_fetch_assoc($comments) ) {
                      ?>
                      <article class="article">
                      <div class="article__image" style="background-image: url(https://www.gravatar.com/avatar/<?php echo $comment['email']; ?>);"></div>
                      <div class="article__info">
                          <a href="/article.php?id=<?php echo $comment['articles_id']; ?>"><?php echo $comment['autor'] . ' (' . $comment['nickname'] . ')'; ?></a>
                          <div class="article__info__meta">
                            <small><?php echo $comment['pubdate']; ?></small>
                          </div>
                          <div class="article__info__preview"><?php echo $comment['text']; ?></div>
                      </div>
                      </article>
                      <?php
                  }
                ?>

                </div>
              </div>
            </div>

            <div class="block" id="comment-add-form">
              <h3>Добавить комментарий</h3>
              <div class="block__content">
                <form action="/add.php" method="POST" class="form">
                  <input type="hidden" name="art_id" value="<?php echo $art['id']; ?>">
                  <div class="form__group">
                    <div class="row">
                      <div class="col-md-6">
                        <input type="text" class="form__control" required="" name="autor" placeholder="Имя">
                      </div>
                      <div class="col-md-6">
                        <input type="text" class="form__control" required="" name="nickname" placeholder="Никнейм">
                      </div>
                    </div>
                  </div>
                  <div class="form__group">
                    <input type="text" class="form__control" required="" name="email" placeholder="E-mail (Не будет показан)">
                  </div>
                  <div class="form__group">
                    <textarea name="text" required="" class="form__control" placeholder="Текст комментария ..."></textarea>
                  </div>
                  <div class="form__group">
                    <input type="submit" class="form__control" name="do_post" value="Добавить комментарий">
                  </div>
                </form>
              </div>
            </div>
            <?php
            }
          ?>

        </section>
        <section class="content__right col-md-4">
          <?php include 'includes/sidebar.php' ?>
        </section>
      </div>
    </div>
  </div>

    
            
          

    <?php include 'includes/footer.php' ?>

  </div>

</body>
</html>