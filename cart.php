<?php
include("include/db_connect.php");
include("functions/functions.php");
session_start();
include("include/auth_cookie.php");

$id = clear_string($_GET["id"]);
$action = clear_string($_GET["action"]);

switch ($action) {

    case 'clear':
        $clear = mysqli_query($link,"DELETE FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}'");
        break;

    case 'delete':
        $delete = mysqli_query($link,"DELETE FROM cart WHERE cart_id_products = '$id' AND cart_ip = '{$_SERVER['REMOTE_ADDR']}'");
        break;

}

if (isset($_POST["submitdata"]))
{
        $_SESSION["order_delivery"] = $_POST["order_delivery"];
        $_SESSION["order_fio"] = $_POST["order_fio"];
        $_SESSION["order_email"] = $_POST["order_email"];
        $_SESSION["order_phone"] = $_POST["order_phone"];
        $_SESSION["order_address"] = $_POST["order_address"];
        $_SESSION["order_note"] = $_POST["order_note"];

    header("Location: cart.php?action=completion");
}


$result = mysqli_query($link,"SELECT * FROM cart,table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_products");
If (mysqli_num_rows($result) > 0)
{
    $row = mysqli_fetch_array($result);

    do
    {
        $int = $int + ($row["price"] * $row["cart_count"]);
    }
    while ($row = mysqli_fetch_array($result));


    $itogpricecart = $int;
}
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
    <script type="text/javascript" src="js/TextChange.js"></script>

    <title>Кошик замовлень</title>
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
    <?php

    $action = clear_string($_GET["action"]);
    switch ($action) {
        case 'oneclick':

            echo '
            <div id="block-step">
            
            <div id="name-step">
                <ul>
                    <li><a class="active">1. Кошик товарів</a></li>
                    <li><span>&rarr;</span></li>
                    <li><a>2. Контактна інформація</a></li>
                    <li><span>&rarr;</span></li>
                    <li><a>3. Завершення</a></li>
                    <li><span>&rarr;</span></li>
                </ul>
            </div>
            <p>Крок 1 з 3</p>
            <a href="cart.php?action=clear">Очистити</a>
            </div>
            ';


            $result = mysqli_query($link,"SELECT * FROM cart,table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_products");
            If (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                echo '
            
            <div id="header-list-cart">
                <div id="head1">Зображення</div>
                
                <div id="head2">Найменування товару</div>
                
                <div id="head3">Кількість</div>
                
                <div id="head4">Вартість</div>
            </div>
            ';
                do
                {

                    $int = $row["cart_price"] * $row["cart_count"];
                    $all_price = $all_price + $int;

                    if  (strlen($row["image"]) > 0 && file_exists("./uploads_images/".$row["image"]))
                    {
                        $img_path = './uploads_images/'.$row["image"];
                        $max_width = 100;
                        $max_height = 100;
                        list($width, $height) = getimagesize($img_path);
                        $ratioh = $max_height/$height;
                        $ratiow = $max_width/$width;
                        $ratio = min($ratioh, $ratiow);

                        $width = intval($ratio*$width);
                        $height = intval($ratio*$height);
                    }else
                    {
                        $img_path = "/images/noimages.jpeg";
                        $width = 120;
                        $height = 105;
                    }


                    echo '
                    <div class="block-list-cart">
        
                    <div class="img-cart">
                    <p align="center"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/></p>
                    </div>
                    
                    <div class="title-cart">
                    <p><a href="">'.$row["title"].'</a></p>
                    <p class="cart-mini-features">
                    '.$row["mini_features"].'
                    </p>
                    </div>
                    
                    <div class="count-cart">
                    <ul class="input-count-style">
                    
                    <li>
                    <p align="center" iid="'.$row["cart_id"].'" class="count-minus">-</p>
                    </li>
                    
                    <li>
                    <p align="center"><input id="input-id'.$row["cart_id"].'" iid="'.$row["cart_id"].'" class="count-input" maxlength="3" type="text" value="'.$row["cart_count"].'"/></p>
                    </li>
                    
                    <li>
                    <p align="center" iid="'.$row["cart_id"].'" class="count-plus">+</p>
                    </li>
                    
                    </ul>
                    </div>
                    
                    <div id="tovar'.$row["cart_id"].'" class="price-product"><h5><span class="span-count" >'.$row["cart_count"].'</span> x <span>'.$row["cart_price"].'</span></h5><p price="'.$row["cart_price"].'">'.$int.' грн</p></div>
                    <div class="delete-cart"><a  href="cart.php?id='.$row["cart_id_products"].'&action=delete"><img src="/images/bsk_item_del.png" /></a></div>
                    
                    <div id="bottom-cart-line"></div>
                    </div>
                    ';

                }
                while ($row = mysqli_fetch_array($result));

                echo '
                     <h2 class="itog-price" align="right">Разом: <strong>'.$all_price.'</strong> грн</h2>
                     <p align="right" class="button-next" ><a href="cart.php?action=confirm" >Далі</a></p> 
                ';

                }
                else
                {
                    echo '<h3 id="clear-cart" align="center">Кошик порожній</h3>';
                }

        break;

        case 'confirm':

            echo '
            <div id="block-step">
            
            <div id="name-step">
                <ul>
                    <li><a href="cart.php?action=oneclick">1. Кошик товарів</a></li>
                    <li><span>&rarr;</span></li>
                    <li><a class="active">2. Контактна інформація</a></li>
                    <li><span>&rarr;</span></li>
                    <li><a>3. Завершення</a></li>
                    <li><span>&rarr;</span></li>
                </ul>
            </div>
            <p>Крок 2 з 3</p>
            
            </div>
            ';

            if ($_SESSION['order_delivery'] == "Поштою") $chck1 = "checked";
            if ($_SESSION['order_delivery'] == "Кур`єром") $chck2 = "checked";
            if ($_SESSION['order_delivery'] == "Самовивіз") $chck3 = "checked";

            echo '

                <h3 class="title-h3" >Способи доставки:</h3>
                <form method="post">
                <ul id="info-radio">
                <li>
                <input type="radio" name="order_delivery" class="order_delivery" id="order_delivery1" value="Поштою" '.$chck1.'  />
                <label class="label_delivery" for="order_delivery1">Поштою</label>
                </li>
                <li>
                <input type="radio" name="order_delivery" class="order_delivery" id="order_delivery2" value="Кур`єром" '.$chck2.' />
                <label class="label_delivery" for="order_delivery2">Кур`єром</label>
                </li>
                <li>
                <input type="radio" name="order_delivery" class="order_delivery" id="order_delivery3" value="Самовивіз" '.$chck3.' />
                <label class="label_delivery" for="order_delivery3">Самовивіз</label>
                </li>
                </ul>
                <h3 class="title-h3" >Інформація для доставки:</h3>
                <ul id="info-order">
                ';
                            if ( $_SESSION['auth'] != 'yes_auth' )
                            {
                                echo '
                <li><label for="order_fio"><span>*</span>ПІБ</label><input type="text" name="order_fio" id="order_fio" value="'.$_SESSION["order_fio"].'" /><span class="order_span_style" >Напр: Пустовіт Владислав Олексійович</span></li>
                <li><label for="order_email"><span>*</span>E-mail</label><input type="text" name="order_email" id="order_email" value="'.$_SESSION["order_email"].'" /><span class="order_span_style" >Напр: pustovit@gmail.com</span></li>
                <li><label for="order_phone"><span>*</span>Телефон</label><input type="text" name="order_phone" id="order_phone" value="'.$_SESSION["order_phone"].'" /><span class="order_span_style" >Напр: 095 111 11 11</span></li>
                <li><label class="order_label_style" for="order_address"><span>*</span>Адреса<br /> доставки</label><input type="text" name="order_address" id="order_address" value="'.$_SESSION["order_address"].'" /><span>Напр: м. Харків,<br /> вул Пушкінська д 64, к 32</span></li>
                ';
                            }
                            echo '
                <li><label class="order_label_style" for="order_note">Примітка</label><textarea name="order_note"  >'.$_SESSION["order_note"].'</textarea><span>Додайте інформацію про замовлення.</span></li>
                </ul>
                <p align="right" ><input type="submit" name="submitdata" id="confirm-button-next" value="Далі" /></p>
                </form>
                
                
                 ';


            break;

        case 'completion';

            echo '
            <div id="block-step">
            
            <div id="name-step">
                <ul>
                    <li><a href="cart.php?action=oneclick">1. Кошик товарів</a></li>
                    <li><span>&rarr;</span></li>
                    <li><a href="cart.php?action=confirm">2. Контактна інформація</a></li>
                    <li><span>&rarr;</span></li>
                    <li><a class="active">3. Завершення</a></li>
                    <li><span>&rarr;</span></li>
                </ul>
            </div>
            <p>Крок 3 з 3</p>
            
            </div>
            <h3 id="end-cart-info">Кінцева інформація:</h3>
            ';

            if ( $_SESSION['auth'] == 'yes_auth' )
            {
                echo '
                    <ul id="list-info" >
                    <li><strong>Спосіб доставки:</strong>'.$_SESSION['order_delivery'].'</li>
                    <li><strong>Email:</strong>'.$_SESSION['auth_email'].'</li>
                    <li><strong>ПІБ:</strong>'.$_SESSION['auth_surname'].' '.$_SESSION['auth_name'].' '.$_SESSION['auth_patronymic'].'</li>
                    <li><strong>Адреса доставки:</strong>'.$_SESSION['auth_address'].'</li>
                    <li><strong>Телефон:</strong>'.$_SESSION['auth_phone'].'</li>
                    <li><strong>Примітка: </strong>'.$_SESSION['order_note'].'</li>
                    </ul>
                    
                    ';
                                }else
                                {
                                    echo '
                    <ul id="list-info" >
                    <li><strong>Спосіб доставки:</strong>'.$_SESSION['order_delivery'].'</li>
                    <li><strong>Email:</strong>'.$_SESSION['order_email'].'</li>
                    <li><strong>ПІБ:</strong>'.$_SESSION['order_fio'].'</li>
                    <li><strong>Адреса доставки:</strong>'.$_SESSION['order_address'].'</li>
                    <li><strong>Телефон:</strong>'.$_SESSION['order_phone'].'</li>
                    <li><strong>Примітка: </strong>'.$_SESSION['order_note'].'</li>
                    </ul>
                    
                    ';
            }
            echo '
            <h2 class="itog-price" align="right">Разом: <strong>'.$itogpricecart.'</strong> грн</h2>
              <p align="right" class="button-next" ><a href="" >Оплатити</a></p> 
 
            ';



            break;

        default:

            echo '
            <div id="block-step">
            
            <div id="name-step">
                <ul>
                    <li><a class="active">1. Кошик товарів</a></li>
                    <li><span>&rarr;</span></li>
                    <li><a>2. Контактна інформація</a></li>
                    <li><span>&rarr;</span></li>
                    <li><a>3. Завершення</a></li>
                    <li><span>&rarr;</span></li>
                </ul>
            </div>
            <p>Крок 1 з 3</p>
            <a href="cart.php?action=clear">Очистити</a>
            </div>
            ';


            $result = mysqli_query($link,"SELECT * FROM cart,table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_products");
            If (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                echo '
            
            <div id="header-list-cart">
                <div id="head1">Зображення</div>
                
                <div id="head2">Найменування товару</div>
                
                <div id="head3">Кількість</div>
                
                <div id="head4">Вартість</div>
            </div>
            ';
                do
                {

                    $int = $row["cart_price"] * $row["cart_count"];
                    $all_price = $all_price + $int;

                    if  (strlen($row["image"]) > 0 && file_exists("./uploads_images/".$row["image"]))
                    {
                        $img_path = './uploads_images/'.$row["image"];
                        $max_width = 100;
                        $max_height = 100;
                        list($width, $height) = getimagesize($img_path);
                        $ratioh = $max_height/$height;
                        $ratiow = $max_width/$width;
                        $ratio = min($ratioh, $ratiow);

                        $width = intval($ratio*$width);
                        $height = intval($ratio*$height);
                    }else
                    {
                        $img_path = "/images/noimages.jpeg";
                        $width = 120;
                        $height = 105;
                    }


                    echo '
                    <div class="block-list-cart">
        
                    <div class="img-cart">
                    <p align="center"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/></p>
                    </div>
                    
                    <div class="title-cart">
                    <p><a href="">'.$row["title"].'</a></p>
                    <p class="cart-mini-features">
                    '.$row["mini_features"].'
                    </p>
                    </div>
                    
                    <div class="count-cart">
                    <ul class="input-count-style">
                    
                    <li>
                    <p align="center" iid="'.$row["cart_id"].'" class="count-minus">-</p>
                    </li>
                    
                    <li>
                    <p align="center"><input id="input-id'.$row["cart_id"].'" iid="'.$row["cart_id"].'" class="count-input" maxlength="3" type="text" value="'.$row["cart_count"].'"/></p>
                    </li>
                    
                    <li>
                    <p align="center" iid="'.$row["cart_id"].'" class="count-plus">+</p>
                    </li>
                    
                    </ul>
                    </div>
                    
                    <div id="tovar'.$row["cart_id"].'" class="price-product"><h5><span class="span-count" >'.$row["cart_count"].'</span> x <span>'.$row["cart_price"].'</span></h5><p price="'.$row["cart_price"].'">'.$int.' грн</p></div>
                    <div class="delete-cart"><a  href="cart.php?id='.$row["cart_id_products"].'&action=delete"><img src="/images/bsk_item_del.png" /></a></div>
                    
                    <div id="bottom-cart-line"></div>
                    </div>
                    ';

                }
                while ($row = mysqli_fetch_array($result));

                echo '
                     <h2 class="itog-price" align="right">Разом: <strong>'.$all_price.'</strong> грн</h2>
                     <p align="right" class="button-next" ><a href="cart.php?action=confirm" >Далі</a></p> 
                ';

            }
            else
            {
                echo '<h3 id="clear-cart" align="center">Кошик порожній</h3>';
            }

            break;
    }

    ?>
    </div>

    <?php
    include("include/block-footer.php");
    ?>

</div>
</body>
</html>
