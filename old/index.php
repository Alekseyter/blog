<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo 'HElloooo<br>';
        echo 'HElloooo<br>';
        echo date('d.m.Y (A)h:i:s') . '<br>';

        $a = [
            'name'      => 'Alex',
            'surname'   => 'Tereh',
            'city'      => [
                'grad1' => 'nel',
                'grad2' => 'tver',
                'grad3' => [
                    'moskov',
                    'msk',
                    'maskva',
                ],
            ],
        ];

        echo $a['city']['grad3'][0] . '<br>';

        include('includes/db_connect.php');

        $result = mysqli_query($connection, 'SELECT * FROM `articles_categories`');
        
        print_r($result);
        
        ?>
        <ul>
            <?php
            while( $cat = mysqli_fetch_assoc($result) ) {
                $cat_count = mysqli_query($connection, 'SELECT COUNT(`id`) AS `total_count` FROM `articles` WHERE `categorie_id` = ' . $cat['id']);
                $cat_count_result = mysqli_fetch_assoc($cat_count);
                echo '<li>' . $cat['title'] . ' (' . $cat_count_result['total_count'] . ')</li>';
            }
            ?>
        </ul>

        <form action="/reg.php" method="POST">
            <input type="text" name="login" placeholder="Логин">
            <input type="text" name="password" placeholder="Пароль">
            <input type="submit" value="Войти">
        </form>
        <?php
        
        

    ?>
</body>
</html>

