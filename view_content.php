<?php
include("include/db_connect.php");
include("functions/functions.php");
session_start();
include("include/auth_cookie.php");


$id = clear_string($_GET["id"]);

If ($id != $_SESSION['countid'])
{
    $querycount = mysqli_query($link,"SELECT views_count FROM table_products WHERE products_id='$id'");
    $resultcount = mysqli_fetch_array($querycount);

    $newcount = $resultcount["views_count"] + 1;

    $update = mysqli_query($link,"UPDATE table_products SET views_count='$newcount' WHERE products_id='$id'");
}

$_SESSION['countid'] = $id;
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

    <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css" />
    <script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>
    <script type="text/javascript" src="js/jTabs.js"></script>

    <title>Dr. Medico</title>
    <script type="text/javascript">
        $(document).ready(function(){
            $("ul.tabs").jTabs({content: ".tabs_content", animate: true, effect:"fade"});
            $(".send-review").fancybox();
        });
    </script>
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


        $result1 = mysqli_query($link,"SELECT * FROM table_products WHERE products_id='$id'");
        if (mysqli_num_rows($result1) > 0)
        {
            $row1 = mysqli_fetch_array($result1);
            do
                {
                if (strlen($row1["image"]) > 0 && file_exists("./uploads_images/" . $row1["image"]))
                {
                    $img_path = './uploads_images/' . $row1["image"];
                    $max_width = 300;
                    $max_height = 300;
                    list($width, $height) = getimagesize($img_path);
                    $ratioh = $max_height / $height;
                    $ratiow = $max_width / $width;
                    $ratio = min($ratioh, $ratiow);

                    $width = intval($ratio * $width);
                    $height = intval($ratio * $height);
                } else
                    {
                    $img_path = "/images/no-image.png";
                    $width = 110;
                    $height = 200;
                }
                    // Кількість відгуків
                    $query_reviews = mysqli_query($link,"SELECT * FROM table_reviews WHERE products_id = '$id'");
                    $count_reviews = mysqli_num_rows($query_reviews);

                echo '
                
                <div id="block-breadcrumbs-and-rating">
                    <p id="nav-breadcrumbs2"><a href="view_cat.php?type='.$row1["product_type"].'">'.$row1["product_type"].'</a> / <span>'.$row1["brand"].'</span></p>
                </div>
                
                <div id="block-content-info">
                    <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" alt="">
                    
                    <div id="block-mini-description">
                        <p id="content-title">'.$row1["title"].'</p>
                        
                        <ul class="reviews-and-counts-content">
                        <li><img src="/images/eye-icon.png" alt=""><p>'.$row1["views_count"].'</p></li>
                        <li><img src="/images/comment-icon.png" alt=""><p>'.$count_reviews.'</p></li>
                        </ul>
                        
                        <p id="style-price">'.$row1["price"].' грн</p>
                        
                        <a class="add-cart" id="add-cart-view" tid="'.$row1["products_id"].'"></a>
                        <p id="content-text">'.$row1["mini_description"].'</p>
                        
                    </div>
                    
                </div>
                
                ';


            }
            while ($row1 = mysqli_fetch_array($result1));

            $result = mysqli_query($link,"SELECT * FROM table_products WHERE products_id='$id'");
            $row = mysqli_fetch_array($result);
            echo '
                <ul class="tabs">
                    <li><a class="active" href="#">Опис продукту</a></li>
                    <li><a href="#">Характеристики</a></li>
                    <li><a href="#">Відгуки</a></li>
                    <li><a href="#">Аналоги</a></li>    
                </ul>            
                <div class="tabs_content">
                    <div>'.$row["description"].'</div>
                    <div>'.$row["features"].'</div>
                    <div>
                        <p id="link-send-review" ><a class="send-review" href="#send-review" >Написати відгук</a></p>
                        
                        ';

                        $query_reviews = mysqli_query($link,"SELECT * FROM table_reviews WHERE products_id='$id' ORDER BY reviews_id DESC");

                        If (mysqli_num_rows($query_reviews) > 0)
                        {
                        $row_reviews = mysqli_fetch_array($query_reviews);
                        do
                        {
                            echo '
                            <div class="block-reviews" >
                                <p class="author-date" ><strong>'.$row_reviews["name"].'</strong>, '.$row_reviews["date"].'</p>
                                <img src="/images/plus-reviews.png" />
                                <p class="textrev" >'.$row_reviews["good_reviews"].'</p>
                                <img src="/images/minus-reviews.png" />
                                <p class="textrev" >'.$row_reviews["bad_reviews"].'</p>
                                
                                <p class="text-comment">'.$row_reviews["comment"].'</p>
                            </div>
                            ';
                        }
                        while ($row_reviews = mysqli_fetch_array($query_reviews));
                        }
                        else
                        {
                            echo '<p class="title-no-info" >Відгуків немає</p>';
                        }
            echo '
                        
                    </div>
                    
                    
                    <div>
                    
                    ';

                    include("include/block_analog.php");

                    echo '
                    </div>

                </div>
                
                <div id="send-review" >
    
                        <p align="right" id="title-review">Ваш відгук</p>
                    
                    <ul>
                    <li><p align="right"><label id="label-name" >Ім`я<span>*</span></label><input maxlength="15" type="text"  id="name_review" /></p></li>
                    <li><p align="right"><label id="label-good" >Плюси<span>*</span></label><textarea id="good_review" ></textarea></p></li>    
                    <li><p align="right"><label id="label-bad" >Мінуси<span>*</span></label><textarea id="bad_review" ></textarea></p></li>     
                    <li><p align="right"><label id="label-comment" >Коментарій</label><textarea id="comment_review" ></textarea></p></li>     
                    </ul>
                    <p id="reload-img"><img src="/images/loading.gif"/></p> <p id="button-send-review" iid="'.$id.'" ></p>
                </div>
                
            ';

        }
        ?>

    </div>

    <?php
    include("include/block-footer.php");
    ?>

</div>
</body>
</html>
