<?php 
include('connect.php');
?>
<?php 
    session_start();
    if(isset($_SESSION['uid'])){
        $session_uid = $_SESSION['uid'];
        $sql = "SELECT * FROM user WHERE id = '$session_uid'";
        $result = $connect -> query($sql);
        $us = $result -> fetch_assoc();
        $userid = $us['id'];
    }

    if($_GET['do'] == 'exit'){
        session_unset();
        echo '<script>document.location.href="index.php"</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>name - card page</title>
</head>
<body>

    <!-- header start -->
    
    <div class="header">
        <div class="container">
            <div class="header-content">
                    <li>
                        <a href="index.php" class="header-link">
                            logo
                        </a>
                    </li>
                <ul class="header-menu">
                    <li>
                        <a href="index.php" class="header-link">
                            главная
                        </a>
                    </li>
                    <li>
                        <a href="index.php" class="header-link">
                            каталог
                        </a>
                    </li>
                </ul>
                <ul class="header-menu">
                        <?php
                        if(isset($_SESSION['uid'])){?>
                    <li>
                        <a href="?do=exit" class="header-link">
                            выход
                        </a>
                    </li>
                    <li>
                        <a href="profile.php" class="header-link">
                            личный кабинет
                        </a>
                    </li>
                    <?}
                    else{?> 
                    <li>
                        <a href="auth.php" class="header-link">
                            вход
                        </a>
                    </li>
                    <li>
                        <a href="reg.php" class="header-link">
                            регистрация
                        </a>
                    </li>
                    <?}
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- header end -->

    <!-- catalog start -->

    <div class="catalog">
        <div class="container">
            <div class="catalog-content">
                <h1 class="title">
                    Карточка товара
                </h1>
                <div class="catalog-cards">
                    <?
                        if(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $sql = "SELECT * FROM product WHERE id = $id";
                            $result = $connect -> query($sql);
                            $products = $result -> fetch_assoc();
                        }
                    ?>
                    <div class="catalog-card">
                        <img src="<?=$products['image']?>" alt="" class="card-img">
                        <p class="card-info">Название: <?=$products['name']?></p>
                        <p class="card-info">Описание: <?=$products['description']?></p>
                        <p class="card-info">Цена: <?=$products['price']?> руб.</p>
                        <a href="card.php?id=<?=$products['id']?>" class="header-link">Подробнее</a>
                        <?if($us['role'] == 2){?>
                            <a href="edit_product.php?id=<?=$products['id']?>" class="header-link"><li>Редактировать товар</li></a>
                            <a href="delete_product.php?id=<?=$products['id']?>" class="header-link"><li>Удалить товар</li></a>
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- catalog end -->

    <!-- footer start -->
    
    <div class="header">
        <div class="container">
            <div class="header-content">
                    <li>
                        <a href="index.php" class="header-link">
                            logo
                        </a>
                    </li>
                <ul class="header-menu">
                    <li>
                        <a href="index.php" class="header-link">
                            главная
                        </a>
                    </li>
                    <li>
                        <a href="index.php" class="header-link">
                            каталог
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- footer end -->
    
</body>
</html>