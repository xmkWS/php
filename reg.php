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
<? 
    if(isset($_POST['reg'])){
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $patronymic = $_POST['patronymic'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        $re_pass = $_POST['re_pass'];
        $pass_md5 = md5($pass);
        $role = 1;

        $file = './assets/img/'.time().$_FILES['photo']['name'];

        if(!copy($_FILES['photo']['tmp_name'],$file)){
            $err .= 'Ошибка загрузки';
        }

        move_uploaded_file($_FILES['photo']['tmp_name'],$file);

        if(empty($name)){
            $err .= 'Заполните поле с именем <br>';
        }
        if(empty($login)){
            $err .= 'Заполните поле с логином <br>';
        }
        if($password != $re_pass){
            $err .= 'Пароли не совпадают <br>';
        }
        $how = iconv_strlen($password);
        if($how < 5){
            $err .= 'Пароль не может быть меньше 5 символов<br>';
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $err .= 'Неверный формат почты<br>';
        }

        if(empty($err)){
            $sql = "INSERT INTO user (name,surname,patronymic,email,login, password, image, role)
            VALUES ('$name','$surname','$patronymic','$email','$login','$pass_md5','$file','$role')";
            $connect -> query($sql);
            $result = $connect -> query($sql);
            echo'<script>document.location.href="index.php"</script>';
        }
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
                        <h2 class="title">Регистрация</h2>
                        <form action="" class="main-form" enctype="multipart/form-data" method="POST" name="reg">
                            <input type="text" placeholder="Ваше имя" name="name" value="<?=$_POST['name']?>">
                            <input type="text" placeholder="Ваша фамилия" name="surname" value="<?=$_POST['surname']?>">
                            <input type="text" placeholder="Ваше отчество" name="patronymic" value="<?=$_POST['patronymic']?>">
                            <input type="email" placeholder="Ваша почта" name="email" value="<?=$_POST['email']?>">
                            <input type="text" placeholder="Придумайте логин" name="login" value="<?=$_POST['login']?>">
                            <input type="password" placeholder="Придумайте пароль" name="password" value="<?=$_POST['password']?>">
                            <input type="password" placeholder="Повторите пароль" name="re_pass">
                            <input type="file" name="photo" id="photo">
                            <input type="submit" value="Зарегистрироваться" name="reg">
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