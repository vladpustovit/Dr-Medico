<?php
include("include/db_connect.php");
include("functions/functions.php");
session_start();
include("include/auth_cookie.php");


$sorting = $_GET["sort"];
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


    <div id="block-content">
        <center><p id="title-simptom">Пошук ліків за симптомами</p></center>
        <center><img id="simptom-line" src="images/bottom-line.png" alt=""></center>
        <div id="simptom-list">
        <ul>
            <li>
                <a>Жар</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE zhar='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Головний біль</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE golovna_bil='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Зубний біль</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE zubna_bil='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Біль у спині</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE spina_bil='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Біль у м'язах</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE miazi_bil='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Ревматизм</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE revmatizm='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Мігрень</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE migren='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Нежить</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE nezhit='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Закладенність носу</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE zaklad_nosa='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Чхання</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE chhannia='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Біль у горлі</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE gorlo_bil='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Гарячка</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE miazi_bil='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Підвищена температура</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE pidvish_temperature='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Біль у суглобах</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE suglobi_bil='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>
            

            <li>
                <a>Біль внутрішніх органів</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE vnutr_organi_bil='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Спазми шлунку та кишечника</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE spazm_shlunok_kishechnik= AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Ниркові коліки</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE nirki_kolika='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Печінкові коліки</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE pechinka_kolika='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Гіпоксія</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE gipoksia='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Біль у животі</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE zhivit_bil='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Свербіж</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE sverb='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Висипання</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE visip='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Кашель</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE kashel='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Здуття</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE zduttia='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Нудота</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE nudota='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Галюцинації</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE galutsinatsii='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Утруднене дихання</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE zatrud_dihannia='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Сліпота</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE slipota='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Біль у кінцівках</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE kincivki_bil='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a>Невралгія</a>
                <ul class="simptom-section">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM table_products WHERE nevralgia='1' AND visible='1'");
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        do {
                            echo '
                                 <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                             ';
                        }
                        while ($row = mysqli_fetch_array($result));
                    }
                    ?>
                </ul>
            </li>

        </ul>
        </div>
    </div>

    <?php
    include("include/block-footer.php");
    ?>

</div>
</body>
</html>
