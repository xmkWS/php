<?php include('connect.php')?>
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
<?php 
    if(isset($_POST['add'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $file = './assets/img/'.time().$_FILES['photo']['name'];

        if(!copy($_FILES['photo']['tmp_name'],$file)){
            $err .= 'Ошибка загрузки';
        }

        move_uploaded_file($_FILES['photo']['tmp_name'],$file);
        $insert = "INSERT INTO product (name,description,price,image)
        VALUES ('$name','$description','$price','$file')";
        $connect -> query($insert);
        echo '<script>document.location.href="index.php"</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>name - sign up</title>
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

    <div class="container">
            <section>
                <div class="form">
                    <div class="form-control">
                        <h2 class="title">Добавить новый товар</h2>
                        <form action="" class="main-form" enctype="multipart/form-data" method="POST" name="add">
                            <input type="text" placeholder="Название" name="name" value="<?=$_POST['name']?>">
                            <input type="text" placeholder="Описание" name="description" value="<?=$_POST['description']?>">
                            <input type="text" placeholder="Цена" name="price" value="<?=$_POST['price']?>">
                            <input type="file" name="photo" id="photo">
                            <input type="submit" value="Добавить" name="add">
                            <?php echo $err; ?>
                        </form>
                    </div>
                </div>
            </section>
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