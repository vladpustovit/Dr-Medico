<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include("db_connect.php");
    include("../functions/functions.php");

    $search = strtolower(clear_string($_POST['text']));

    $result = mysqli_query($link,"SELECT * FROM table_products WHERE title LIKE '%$search%' AND visible = '1'");

    If (mysqli_num_rows($result) > 0)
    {
        $result = mysqli_query($link,"SELECT * FROM table_products WHERE title LIKE '%$search%'  AND visible = '1' LIMIT 10");
        $row = mysqli_fetch_array($result);
        do
        {
            echo '
<li><a href="search.php?q='.$row["title"].'">'.$row["title"].'</a></li>
';
        }
        while ($row = mysqli_fetch_array($result));

    }
}



?>