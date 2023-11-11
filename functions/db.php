<?php
//Функция для установления соединения с базой данных
$con = mysqli_connect("127.0.0.1", "root", "","affairs");
mysqli_set_charset($con,"utf8");
if (!$con) {
    $error = mysqli_connect_error();
    exit('При выполнении подключения возникли ошибки' . $error);
}



