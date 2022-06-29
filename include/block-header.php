<!-- Головний верхній блок. -->
<div id="header-background">
<div id="block-header">
    <!-- Верхній блок з навігацією -->
    <div id="header-top-block">
        <!-- Список с навігацією -->
        <ul id="header-top-menu">
            <li>Ваше місто - <span>Харків</span></li>
            <li><a href="about.php">Про сервіс</a></li>
            <li><a href="contacts.php">Контакти</a></li>

        </ul>

        <!-- Вхід та реєстрація -->
        <?php
        if ($_SESSION['auth'] == 'yes_auth')
        {
            echo '<p id="auth-user-info" align="right"><img src="/images/user.png" alt="">Вітаємо, '.$_SESSION['auth_name'].'!<p/>';
        }else
        {
            echo '<p id="reg-auth-title" align="right"><a class="top-auth">Вхід</a><a href="registration.php">Реєстрація</a></p>
            ';
        }
        ?>

        <div id="block-top-auth">
            <div class="corner">

            </div>
            <form method="post">
            <ul id="input-email-pass">
                <h3>Вхід</h3>
                <p id="message-auth">Невірний логін та(або) пароль</p>
                <li><center><input type="text" id="auth_login" placeholder="Логін або E-mail"></center></li>
                <li><center><input type="password" id="auth_pass" placeholder="Пароль"><span id="button-pass-show-hide" class="pass-show"></span></center></li>
                <ul id="list-auth">
                    <li><input type="checkbox" name="rememberme" id="rememberme"><label for="rememberme">Запам'ятати мене</label></li>
                </ul>
                <p align="right" id="button-auth"><a>Вхід</a></p>
                <p align="right" class="auth-loading"><img src="/images/loading.gif" alt=""></p>
            </ul>
            </form>
        </div>
    </div>
    <!-- Лінія - розділювач -->
    <div id="top-line"></div>

    <div id="block-user">
        <div class="corner2"></div>
        <ul>
            <li><img src="/images/user_info.png" alt=""><a href="profile.php">Профіль</a></li>
            <li><img src="/images/logout.png" alt=""><a id="logout">Вихід</a></li>
        </ul>

    </div>

    <!-- Лого -->
    <img id="img-logo" src="/images/logo.png" alt="logo"/>
    <!-- Інформаційний блок -->
    <div id="personal-info">
        <p align="right">Пустовіт В.О. КІТ-М120д</p>
        <h3 align="right">+380954795052</h3>
        <img src="/images/phone-icon1.png" alt=""/>
        <p align="right">Режим роботи:</p>
        <p align="right">Будні дні: с 9:00 по 18:00</p>
        <p align="right">Субота, Неділя - вихідні</p>
        <img src="/images/time-icon1.png" alt=""/>
    </div>
    <!-- Блок пошуку -->
    <div id="block-search">

        <form method="GET" action="search.php?q=">
        <span></span>
        <input type="text" id="input-search" name="q" placeholder="Пошук товарів" value="<?php echo $search; ?>"/>
        <input type="submit" id="button-search" value="Пошук"/>
        </form>

        <ul id="result-search">

        </ul>

    </div>
</div>

<div id="top-menu">
    <ul>
        <li><a href="index.php">Головна</a></li>
        <li><a href="simptom.php">Пошук за симптомами</a></li>
    </ul>

    <p align="right" id="block-basket"><img src="/images/cart-icon1.png" alt=""><a href="/cart.php?action=oneclick">Кошик порожній</a></p>
</div>
</div>