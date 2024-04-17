<?php 

$connect = new mysqli("localhost", "root", "", "exam");
if($connect -> connect_error) {
    echo 'Ошибка подключения';
}

?>