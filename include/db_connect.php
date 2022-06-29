<?php

    $db_host = 'localhost';
    $db_user = 'admin';
    $db_pass = 'pustovit';
    $db_database = 'db_medico';

    //$link = mysqli_connect($db_host,$db_user,$db_pass);

    //mysqli_connect_db($db_database,$link) or die("Немає зв'язку з БД ".mysqli_error());
    //mysqli_querry("SET names UTF-8");

$link = mysqli_connect("127.0.0.1", "$db_user", "$db_pass", "$db_database");

if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

?>