<?php
if ($_SESSION['auth'] != 'yes_auth' && $_COOKIE["rememberme"])
{

    $str = $_COOKIE["rememberme"];

    // Уся довжина строки
    $all_len = strlen($str);
    // Довжина логіна
    $login_len = strpos($str,'+');
    // Обрізання строки до плюса та отримання Логіна
    $login = clear_string(substr($str,0,$login_len));

    // Отримання паролю
    $pass = clear_string(substr($str,$login_len+1,$all_len));


    $result = mysqli_query($link, "SELECT * FROM reg_user WHERE (login = '$login' or email = '$login') AND pass = '$pass'");
    If (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_array($result);
        session_start();
        $_SESSION['auth'] = 'yes_auth';
        $_SESSION['auth_pass'] = $row["pass"];
        $_SESSION['auth_login'] = $row["login"];
        $_SESSION['auth_surname'] = $row["surname"];
        $_SESSION['auth_name'] = $row["name"];
        $_SESSION['auth_patronymic'] = $row["patronymic"];
        $_SESSION['auth_address'] = $row["address"];
        $_SESSION['auth_phone'] = $row["phone"];
        $_SESSION['auth_email'] = $row["email"];

    }



}
?>