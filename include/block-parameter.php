<script type="text/javascript">
    $(document).ready(function(){
        $('#blocktrackbar').trackbar({
            onMove : function () {
                document.getElementById("start-price").value = this.leftValue;
                document.getElementById("end-price").value = this.rightValue;
            },
            width: 160,
            leftLimit : 0,
            leftValue : <?php
                if ((int)$_GET["start_price"] >=0 AND (int)$_GET["start_price"] <= 1000)
                {
                    echo (int)$_GET["start_price"];
                }
                else
                {
                    echo "0";
                }
            ?>,
            rightLimit : 1000,
            rightValue : <?php
            if ((int)$_GET["end_price"] >=0 AND (int)$_GET["end_price"] <= 1000)
            {
                echo (int)$_GET["end_price"];
            }
            else
            {
                echo "1000";
            }
            ?>,
            roundUp : 1
        });
    });
</script>


<div id="block-parameter">
    <p class="header-title">Просунутий пошук</p>

    <p class="title-filter">Вартість</p>
    <form method="GET" action="search_filter.php">

    <div id="block-input-price">
        <ul>
            <li>від</li>
            <li><input type="text" id="start-price" name="start_price" value="0"></li>
            <li>до</li>
            <li><input type="text" id="end-price" name="end_price" value="1000"></li>
            <li>грн</li>
        </ul>
    </div>

    <div id="blocktrackbar">

    </div>

    <p class="title-filter">Підкатегорії</p>
    <ul class="checkbox-brand">

        <?php
        $result = mysqli_query($link, "SELECT * FROM category WHERE type='Знеболюючі засоби'");

        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_array($result);

            do
            {
                $checked_brand = "";
                if ($_GET["brand"])
                {
                    if (in_array($row["id"],$_GET["brand"]))
                    {
                        $checked_brand = "checked";
                    }
                }
                echo '
                    <li><input '.$checked_brand.' type="checkbox"name="brand[]" value="'.$row["id"].'" id="checkbrand'.$row["id"].'"><label for="checkbrand'.$row["id"].'">'.$row["brand"].'</label></li>
                    ';
            }
            while ($row = mysqli_fetch_array($result));
        }

        $result = mysqli_query($link, "SELECT * FROM category WHERE type='Препарати від застуди'");

        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_array($result);

            do
            {
                $checked_brand = "";
                if ($_GET["brand"])
                {
                    if (in_array($row["id"],$_GET["brand"]))
                    {
                        $checked_brand = "checked";
                    }
                }
                echo '
                    <li><input '.$checked_brand.' type="checkbox"name="brand[]" value="'.$row["id"].'" id="checkbrand'.$row["id"].'"><label for="checkbrand'.$row["id"].'">'.$row["brand"].'</label></li>
                    ';
            }
            while ($row = mysqli_fetch_array($result));
        }
        ?>

    </ul>

        <center><input type="submit" name="submit" id="button-param-search" value=" "/></center>

    </form>
</div>