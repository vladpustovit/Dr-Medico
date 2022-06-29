<?php
include("include/db_connect.php");
include("functions/functions.php");
session_start();
include("include/auth_cookie.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="trackbar/trackbar.css">

    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="js/jcarousellite_1.0.1.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="js/medico-script.js"></script>
    <script type="text/javascript" src="trackbar/jquery.trackbar.js"></script>

    <script type="text/javascript" src="js/jquery.form.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/TextChange.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#form_reg').validate(
                {
                    // Правила для перевірки
                    rules:{
                        "reg_login":{
                            required:true,
                            minlength:5,
                            maxlength:15,
                            remote: {
                                type: "post",
                                url: "/reg/check_login.php"
                            }
                        },
                        "reg_pass":{
                            required:true,
                            minlength:7,
                            maxlength:15
                        },
                        "reg_surname":{
                            required:true,
                            minlength:3,
                            maxlength:20
                        },
                        "reg_name":{
                            required:true,
                            minlength:3,
                            maxlength:15
                        },
                        "reg_patronymic":{
                            required:true,
                            minlength:3,
                            maxlength:25
                        },
                        "reg_email":{
                            required:true,
                            email:true
                        },
                        "reg_phone":{
                            required:true
                        },
                        "reg_address":{
                            required:true
                        }

                    },

                    // Повідомлення, виведені при порушенні відповідних правил
                    messages:{
                        "reg_login":{
                            required:"Вкажіть логін!",
                            minlength:"Від 5 до 15 символів!",
                            maxlength:"Від 5 до 15 символів!",
                            remote: "Логін зайнятий"
                        },
                        "reg_pass":{
                            required:"Вкажіть пароль!",
                            minlength:"Від 7 до 15 символів!",
                            maxlength:"Від 7 до 15 символів!"
                        },
                        "reg_surname":{
                            required:"Вкажіть ваше прізвище!",
                            minlength:"Від 3 до 20 символів!",
                            maxlength:"Від 3 до 20 символів!"
                        },
                        "reg_name":{
                            required:"Вкажіть ваше ім'я!",
                            minlength:"Від 3 до 15 символів!",
                            maxlength:"Від 3 до 15 символів!"
                        },
                        "reg_patronymic":{
                            required:"Вкажіть ваше ім'я по батькові!",
                            minlength:"Від 3 до 25 символів!",
                            maxlength:"Від 3 до 25 символів!"
                        },
                        "reg_email":{
                            required:"Вкажіть свій e-mail",
                            email:"Некоректний e-mail"
                        },
                        "reg_phone":{
                            required:"Вкажіть номер телефону!"
                        },
                        "reg_address":{
                            required:"Необхідно вказати адресу доставки!"
                        },

                    },

                    submitHandler: function(form){
                        $(form).ajaxSubmit({
                            success: function(data) {

                                if (data == 'true')
                                {
                                    $("#block-form-registration").fadeOut(300,function() {

                                        $("#reg_message").addClass("reg_message_good").fadeIn(400).html("Ви успішно зареєструвалися!");
                                        $("#form_submit").hide();

                                    });

                                }
                                else
                                {
                                    $("#reg_message").addClass("reg_message_error").fadeIn(400).html(data);
                                }
                            }
                        });
                    }
                });
        });

    </script>
    <title>Реєстрація</title>
</head>
<body>
<div id="block-body">

    <?php
    include("include/block-header.php");
    ?>

    <div id="block-right">
        <?php
        include("include/block-categories.php");
        include("include/block-parameter.php");
        include("include/block-news.php");
        ?>
    </div>

    <div id="block-content">
        <h2 class="h2-title">Реєстрація</h2>
        <form method="post" id="form_reg" action="/reg/handler_reg.php">
            <p id="reg_message"></p>
            <div id="block-form-registration">
                <ul id="form-registration">
                    <li>
                        <label for="">Логін</label>
                        <span class="star">*</span>
                        <input type="text" name="reg_login" id="reg_login"/>
                    </li>

                    <li>
                        <label for="">Пароль</label>
                        <span class="star">*</span>
                        <input type="text" name="reg_pass" id="reg_pass"/>
                        <span id="genpass">Сгенерувати</span>
                    </li>

                    <li>
                        <label for="">Прізвище</label>
                        <span class="star">*</span>
                        <input type="text" name="reg_surname" id="reg_surname"/>
                    </li>

                    <li>
                        <label for="">Ім'я</label>
                        <span class="star">*</span>
                        <input type="text" name="reg_name" id="reg_name"/>
                    </li>

                    <li>
                        <label for="">По батькові</label>
                        <span class="star">*</span>
                        <input type="text" name="reg_patronymic" id="reg_patronymic"/>
                    </li>

                    <li>
                        <label for="">E-mail</label>
                        <span class="star">*</span>
                        <input type="text" name="reg_email" id="reg_email"/>
                    </li>

                    <li>
                        <label for="">Мобільний телефон</label>
                        <span class="star">*</span>
                        <input type="text" name="reg_phone" id="reg_phone"/>
                    </li>

                    <li>
                        <label for="">Адреса доставки</label>
                        <span class="star">*</span>
                        <input type="text" name="reg_address" id="reg_address"/>
                    </li>

                </ul>

            </div>

<p align="right"><input type="submit" name="reg_submit" id="form_submit" value="Реєстрація"></p>
        </form>

    </div>

    <?php
    include("include/block-footer.php");
    ?>

</div>
</body>
</html>