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
        $delete = mysqli_query($link,"DELETE FROM cart WHERE cart_id = '$id' AND cart_ip = '{$_SERVER['REMOTE_ADDR']}'");
        break;

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
                    <p align="center" class="count-minus">-</p>
                    </li>
                    
                    <li>
                    <p align="center"><input class="count-input" maxlength="3" type="text" value="'.$row["cart_count"].'"/></p>
                    </li>
                    
                    <li>
                    <p align="center" class="count-plus">+</p>
                    </li>
                    
                    </ul>
                    </div>
                    
                    <div class="price-product"><h5><span class="span-count" >1</span> x <span>'.$row["cart_price"].'</span></h5><p>'.$int.'</p></div>
                    <div class="delete-cart"><a  href="cart.php?id='.$row["cart_id"].'&action=delete"><img src="/images/bsk_item_del.png" /></a></div>
                    
                    <div id="bottom-cart-line"></div>
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
                    <li><a>1. Кошик товарів</a></li>
                    <li><span>&rarr;</span></li>
                    <li><a class="active">2. Контактна інформація</a></li>
                    <li><span>&rarr;</span></li>
                    <li><a>3. Завершення</a></li>
                    <li><span>&rarr;</span></li>
                </ul>
            </div>
            <p>Крок 1 з 3</p>
            <a href="cart.php?action=clear">Очистити</a>
            
            </div>
            ';

        break;

        case 'completion';

            echo '
            <div id="block-step">
            
            <div id="name-step">
                <ul>
                    <li><a>1. Кошик товарів</a></li>
                    <li><span>&rarr;</span></li>
                    <li><a>2. Контактна інформація</a></li>
                    <li><span>&rarr;</span></li>
                    <li><a class="active">3. Завершення</a></li>
                    <li><span>&rarr;</span></li>
                </ul>
            </div>
            <p>Крок 1 з 3</p>
            <a href="cart.php?action=clear">Очистити</a>
            
            </div>
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
                    <p align="center" class="count-minus">-</p>
                    </li>
                    
                    <li>
                    <p align="center"><input class="count-input" maxlength="3" type="text" value="'.$row["cart_count"].'"/></p>
                    </li>
                    
                    <li>
                    <p align="center" class="count-plus">+</p>
                    </li>
                    
                    </ul>
                    </div>
                    
                    <div class="price-product"><h5><span class="span-count" >1</span> x <span>'.$row["cart_price"].'</span></h5><p>'.$int.'</p></div>
                    <div class="delete-cart"><a  href="cart.php?id='.$row["cart_id"].'&action=delete"><img src="/images/bsk_item_del.png" /></a></div>
                    
                    <div id="bottom-cart-line"></div>
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
