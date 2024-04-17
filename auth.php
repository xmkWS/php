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
    if(isset($_POST['auth'])){
        $login = $_POST['login'];
        $password = $_POST['password'];
        $pass_md5 = md5($pass);

        if(empty($login)){
            $err .= 'Заполните поле с логином <br>';
        }
        if(empty($password)){
            $err .= 'Заполните поле с паролем <br>';
        }else{
            $sql = "SELECT * FROM user WHERE login = '$login'";
            $result = $connect -> query($sql);
            $num = $result -> num_rows;
            if($num == 0){
                $err .= 'Вы не зарегистрированы <br>';
            }else{
                $sql = "SELECT * FROM user WHERE login = '$login' AND password = '$pass_md5'";
                $result = $connect -> query($sql);
                $num = $result -> num_rows;
                if($num == 0){
                    $err .= 'Неверный логин или пароль';
                }
            }
        }

        if(empty($err)){
            $row = $result -> fetch_assoc();
            $_SESSION['uid'] = $row['id'];
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
                        <h2 class="title">Авторизация</h2>
                        <form action="" class="main-form" method="POST" name="auth">
                            <input type="text" placeholder="Введите логин" name="login" value="<?=$_POST['login']?>">
                            <input type="password" placeholder="Введите пароль" name="password" value="<?=$_POST['password']?>">
                            <input type="submit" value="Войти" name="auth">
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