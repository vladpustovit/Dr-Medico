<?php
$result = mysqli_query($link, "SELECT * FROM table_products WHERE brand='{$row["brand"]}'");

if (mysqli_num_rows($result) > 0)
{
    $row = mysqli_fetch_array($result);

    do
    {
        echo '
                    <p class="style-title-list"><a href="view_content.php?id='.$row["products_id"].'">'.$row["title"].'</a></p>
                    ';
    }
    while ($row = mysqli_fetch_array($result));
}
?>