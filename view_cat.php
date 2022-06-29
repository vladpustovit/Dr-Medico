<?php
include("include/db_connect.php");
include("functions/functions.php");
session_start();
include("include/auth_cookie.php");
$cat = clear_string($_GET["cat"]);
$type = clear_string($_GET["type"]);

$sorting = ($_GET["sort"]);
switch ($sorting){
    case 'price-asc';
        $sorting = 'price ASC';
        $sort_name = 'Від дешевих до дорогих';
        break;

    case 'price-desc';
        $sorting = 'price DESC';
        $sort_name = 'Від дорогих до дешевих';
        break;

    case 'popular';
        $sorting = 'views_count DESC';
        $sort_name = 'Популярне';
        break;

    case 'news';
        $sorting = 'datetime DESC';
        $sort_name = 'Новинки';
        break;

    case 'brand';
        $sorting = 'brand';
        $sort_name = 'Від A до Я';
        break;

    default:
        $sorting = 'products_id DESC';
        $sort_name = 'Без сортування';
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
    <title>Dr. Medico</title>
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
            if (!empty($cat) && !empty($type))
            {
                $querycat = "brand='$cat' AND product_type='$type'";
                $catlink = "cat=$cat&";
            }
            else
            {
                if (!empty($type))
                {
                    $querycat = "product_type='$type'";

                }
                else
                {
                    $querycat = "";
                }

                if (!empty($cat))
                {
                    $catlink = "cat=$cat&";
                }
                else
                {
                    $catlink = "";
                }

            }

            $result = mysqli_query($link, "SELECT * FROM table_products WHERE $querycat ORDER BY $sorting");

            if (mysqli_num_rows($result) > 0)
            {
                $row = mysqli_fetch_array($result);

echo '

        <div id="block-sorting">
            <p id="nav-breadcrumbs"><a href="index.php">Головна сторінка</a> \ <span>Усі товари</span></p>

            <ul id="options-list">
                <li>Вид: </li>
                <li><img id="style-grid" src="/images/icon-grid.png" alt=""></li>
                <li><img id="style-list" src="/images/icon-list.png" alt=""></li>

                <li>Cортувати:</li>
                <li><a id="select-sort">'.$sort_name.'</a>
                    <ul id="sorting-list">
                        <li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-asc">Від дешевих до дорогих</a></li>
                        <li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-desc">Від дорогих до дешевих</a></li>
                        <li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=popular">Популярне</a></li>
                        <li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=news">Новинки</a></li>
                        <li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=brand">Від A до Я</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <ul id="block-product-grid">
';
                do {

                    if ($row["image"] != "" && file_exists("./uploads_images/".$row["image"]))
                    {
                        $img_path = './uploads_images/'.$row["image"];
                        $max_width = 200;
                        $max_height = 200;
                        list($width, $height) = getimagesize($img_path);
                        $ratioh = $max_height/$height;
                        $ratiow = $max_width/$width;
                        $ratio = min($ratioh, $ratiow);
                        $width = intval($ratio*$width);
                        $height = intval($ratio*$height);
                    }
                    else
                    {
                        $img_path = "/images/no-image.png";
                        $width = 110;
                        $height = 200;
                    }

                    // Кількість відгуків
                    $query_reviews = mysqli_query($link,"SELECT * FROM table_reviews WHERE products_id = '{$row["products_id"]}'");
                    $count_reviews = mysqli_num_rows($query_reviews);

                    echo '
                                    <li>
                                        <div class="block-images-grid">
                                            <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" alt=""/>
                                        </div>
                                        <p class="style-title-grid"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                                        <ul class="views-and-counts-grid">
                                            <li><img src="/images/eye-icon.png" alt=""><p>'.$row["views_count"].'</p></li>
                                            <li><img src="/images/comment-icon.png" alt=""><p>'.$count_reviews.'</p></li>
                                        </ul>
                                        <a class="add-cart-style-grid" tid="'.$row["products_id"].'"></a>
                                        <p class="style-price-grid"><strong>'.$row["price"].'</strong> грн.</p>
                                        <div class="mini-features">
                                            '.$row["mini_features"].'
                                        </div>
                                    </li>
                                ';
                }
                while ($row = mysqli_fetch_array($result));

            ?>
        </ul>

        <ul id="block-product-list">
            <?php
            $result = mysqli_query($link, "SELECT * FROM table_products WHERE $querycat ORDER BY $sorting");

            if (mysqli_num_rows($result) > 0)
            {
                $row = mysqli_fetch_array($result);

                do {

                    if ($row["image"] != "" && file_exists("./uploads_images/".$row["image"]))
                    {
                        $img_path = './uploads_images/'.$row["image"];
                        $max_width = 150;
                        $max_height = 150;
                        list($width, $height) = getimagesize($img_path);
                        $ratioh = $max_height/$height;
                        $ratiow = $max_width/$width;
                        $ratio = min($ratioh, $ratiow);
                        $width = intval($ratio*$width);
                        $height = intval($ratio*$height);
                    }
                    else
                    {
                        $img_path = "/images/noimages80x70.png";
                        $width = 80;
                        $height = 70;
                    }

                    // Кількість відгуків
                    $query_reviews = mysqli_query($link,"SELECT * FROM table_reviews WHERE products_id = '{$row["products_id"]}'");
                    $count_reviews = mysqli_num_rows($query_reviews);

                    echo '
                                    <li>
                                        <div class="block-images-list">
                                            <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" alt=""/>
                                        </div>
                                        <ul class="views-and-counts-list">
                                            <li><img src="/images/eye-icon.png" alt=""><p>'.$row["views_count"].'</p></li>
                                            <li><img src="/images/comment-icon.png" alt=""><p>'.$count_reviews.'</p></li>
                                        </ul>
                                        <p class="style-title-list"><a href=view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                                        <a class="add-cart-style-list" tid="'.$row["products_id"].'"></a>
                                        <p class="style-price-list"><strong>'.$row["price"].'</strong> грн.</p>
                                        <div class="style-text-list">
                                            '.$row["mini_description"].'
                                        </div>
                                    </li>
                                ';
                }
                while ($row = mysqli_fetch_array($result));
            }
            }else {
                echo '<h3>Категорія недоступна або товар відстуній</h3>';
            }
            ?>
        </ul>

    </div>

    <?php
    include("include/block-footer.php");
    ?>

</div>
</body>
</html>