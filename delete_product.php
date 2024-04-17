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
<?php
    if(isset($_GET['id'])){
        if(empty($_GET['delete'])){
            $get_id = $_GET['id'];
            $delete = "DELETE FROM product WHERE id = '$get_id'";
            $connect -> query($delete);
            echo '<script>document.location.href="index.php"</script>';
        }
        else{
            echo 'Товар не был удален';
        }
    }
    else{
        echo 'Ошибка';
    }
?>