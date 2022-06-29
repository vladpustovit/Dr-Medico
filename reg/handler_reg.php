<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include("../include/db_connect.php");
    include("../functions/functions.php");

    $error = array();

    $login = strtolower(clear_string($_POST['reg_login']));
    $pass = strtolower(clear_string($_POST['reg_pass']));
    $surname = clear_string($_POST['reg_surname']);

    $name = clear_string($_POST['reg_name']);
    $patronymic = clear_string($_POST['reg_patronymic']);
    $email = clear_string($_POST['reg_email']);

    $phone = clear_string($_POST['reg_phone']);
    $address = clear_string($_POST['reg_address']);


    if (strlen($login) < 5 or strlen($login) > 15)
    {
        $error[] = "Логин должен быть от 5 до 15 символов!";
    }
    else
    {
        $result = mysqli_query($link,"SELECT login FROM reg_user WHERE login = '$login'");
        If (mysqli_num_rows($result) > 0)
        {
            $error[] = "Логін зайнятий!";
        }

    }

    if (strlen($pass) < 7 or strlen($pass) > 15) $error[] = "Вкажіть пароль від 7 до 15 символів!";
    if (strlen($surname) < 3 or strlen($surname) > 40) $error[] = "Вкажіть Прізвище від 3 до 20 символів!";
    if (strlen($name) < 3 or strlen($name) > 20) $error[] = "Вкажіть Ім'я від 3 до 15 символів!";
    if (strlen($patronymic) < 3 or strlen($patronymic) > 25) $error[] = "Вкажіть Ім'я По Батькові від 3 до 25 символів!";
    if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",trim($email))) $error[] = "Вкажіть коректний email!";
    if (!$phone) $error[] = "Вкажіть номер телефону!";
    if (!$address) $error[] = "Необхідно вказати адресу доставки!";

    if (count($error))
    {

        echo implode('<br />',$error);

    }else
    {
        $pass   = md5($pass);
        $pass   = strrev($pass);
        $pass   = "6ga98g7g".$pass."fa89f7a";

        $ip = $_SERVER['REMOTE_ADDR'];

        mysqli_query($link,"	INSERT INTO reg_user(login,pass,surname,name,patronymic,email,phone,address,datetime,ip)
						VALUES(
						
							'".$login."',
							'".$pass."',
							'".$surname."',
							'".$name."',
							'".$patronymic."',
                            '".$email."',
                            '".$phone."',
                            '".$address."',
                            NOW(),
                            '".$ip."'							
						)");

        echo 'true';
    }


}
?>