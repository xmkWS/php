<?php

include('connect.php')

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
    <script src="./assets/js/main.js" defer></script>
    <title>name</title>
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

    <!-- slider start -->

    <div class="main">
        <div class="slider">
            <div class="slides">
                <div class="slide active">
                    <img src="./assets/img/slider/1.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="./assets/img/slider/2.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="./assets/img/slider/3.jpg" alt="">
                </div>
            </div>
            <div class="dots">
                <div class="dot active"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
    </div>

    <!-- slider end -->

    <!-- catalog start -->

    <div class="catalog">
        <div class="container">
            <div class="catalog-content">
                <h1 class="title">
                    Популярные товары
                </h1>
                <div class="catalog-cards">
                    <?php 
                        $sql = "SELECT * FROM product";
                        $result = $connect -> query($sql);
                        while($products = $result -> fetch_assoc()){
                    ?>
                    <div class="catalog-card">
                        <img src="<?=$products['image']?>" alt="" class="card-img">
                        <p class="card-info">Название: <?=$products['name']?></p>
                        <p class="card-info">Описание: <?=$products['description']?></p>
                        <p class="card-info">Цена: <?=$products['price']?> руб.</p>
                        <a href="card.php?id=<?=$products['id']?>" class="header-link">Подробнее</a>
                    </div>
                    <?}?>
                </div>
            </div>
        </div>
    </div>

    <!-- catalog end -->

    <!-- faq start -->

    <div class="faq">
        <div class="container">
            <div class="faq-content">
                <h1 class="title">FAQ</h1>
                <div class="faq-lines">
                    <div class="faq-line">
                        <div class="faq-question">
                            <h1>Вопрос 1</h1>
                            <button class="accordion-button">></button>
                        </div>
                        <div class="accordion">Ответ 1</div>
                    </div>
                    <div class="faq-line">
                        <div class="faq-question">
                            <h1>Вопрос 2</h1>
                            <button class="accordion-button">></button>
                        </div>
                        <div class="accordion">Ответ 2</div>
                    </div>
                    <div class="faq-line">
                        <div class="faq-question">
                            <h1>Вопрос 3</h1>
                            <button class="accordion-button">></button>
                        </div>
                        <div class="accordion">Ответ 3</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- faq end -->

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