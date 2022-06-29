<div id="block-categories">
    <p class="header-title">Категорії препаратів</p>

    <ul>
        <li><a id="index1">Препарати від застуди</a>
            <ul class="categories-section">
                <li>
                    <a href="view_cat.php?type=Препарати від застуди"><strong>Усі</strong></a>
                </li>
            <?php
                $result = mysqli_query($link, "SELECT * FROM category WHERE type='Препарати від застуди'");

                if (mysqli_num_rows($result) > 0)
                {
                $row = mysqli_fetch_array($result);

                do
                {
                    echo '
                    <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
                    ';
                }
                while ($row = mysqli_fetch_array($result));
}
                ?>
            </ul>
        </li>

        <li><a id="index2">Противірусні препарати</a>
            <ul class="categories-section">
                <li>
                    <a href="view_cat.php?type=Противірусні препарати"><strong>Усі</strong></a>
                </li>
                <?php
                $result = mysqli_query($link, "SELECT * FROM category WHERE type='Противірусні препарати'");

                if (mysqli_num_rows($result) > 0)
                {
                    $row = mysqli_fetch_array($result);

                    do
                    {
                        echo '
                    <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
                    ';
                    }
                    while ($row = mysqli_fetch_array($result));
                }
                ?>

            </ul>
        </li>

        <li><a id="index3">Знеболюючі засоби</a>
            <ul class="categories-section">
                <li>
                    <a href="view_cat.php?type=Знеболюючі засоби"><strong>Усі</strong></a>
                </li>
                <?php
                $result = mysqli_query($link, "SELECT * FROM category WHERE type='Знеболюючі засоби'");

                if (mysqli_num_rows($result) > 0)
                {
                    $row = mysqli_fetch_array($result);

                    do
                    {
                        echo '
                    <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
                    ';
                    }
                    while ($row = mysqli_fetch_array($result));
                }
                ?>
            </ul>
        </li>

        <li><a id="index4">Дерматологічні препарати</a>
            <ul class="categories-section">
                <li>
                    <a href="view_cat.php?type=Дерматологічні препарати"><strong>Усі</strong></a>
                </li>
                <?php
                $result = mysqli_query($link, "SELECT * FROM category WHERE type='Дерматологічні препарати'");

                if (mysqli_num_rows($result) > 0)
                {
                    $row = mysqli_fetch_array($result);

                    do
                    {
                        echo '
                    <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
                    ';
                    }
                    while ($row = mysqli_fetch_array($result));
                }
                ?>
            </ul>
        </li>

        <li><a id="index5">Препарати для серцево-судинної системи</a>
            <ul class="categories-section">
                <li>
                    <a href="view_cat.php?type=Препарати для серцево-судинної системи"><strong>Усі</strong></a>
                </li>
                <?php
                $result = mysqli_query($link, "SELECT * FROM category WHERE type='Препарати для серцево-судинної системи'");

                if (mysqli_num_rows($result) > 0)
                {
                    $row = mysqli_fetch_array($result);

                    do
                    {
                        echo '
                    <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
                    ';
                    }
                    while ($row = mysqli_fetch_array($result));
                }
                ?>
            </ul>
        </li>

        <li><a id="index6">Препарати для шлунково-кишкового тракту</a>
            <ul class="categories-section">
                <li>
                    <a href="view_cat.php?type=Препарати для шлунково-кишкового тракту"><strong>Усі</strong></a>
                </li>
                <?php
                $result = mysqli_query($link, "SELECT * FROM category WHERE type='Препарати для шлунково-кишкового тракту'");

                if (mysqli_num_rows($result) > 0)
                {
                    $row = mysqli_fetch_array($result);

                    do
                    {
                        echo '
                    <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
                    ';
                    }
                    while ($row = mysqli_fetch_array($result));
                }
                ?>
            </ul>
        </li>

        <li><a id="index7">Препарати для лікування хвороб опорно-рухового апарату</a>
            <ul class="categories-section">
                <li>
                    <a href="view_cat.php?type=Препарати для лікування хвороб опорно-рухового апарату"><strong>Усі</strong></a>
                </li>
                <?php
                $result = mysqli_query($link, "SELECT * FROM category WHERE type='Препарати для лікування хвороб опорно-рухового апарату'");

                if (mysqli_num_rows($result) > 0)
                {
                    $row = mysqli_fetch_array($result);

                    do
                    {
                        echo '
                    <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
                    ';
                    }
                    while ($row = mysqli_fetch_array($result));
                }
                ?>
            </ul>
        </li>

        <li><a id="index8">Препарати для нервової системи</a>
            <ul class="categories-section">
                <li>
                    <a href="view_cat.php?type=Препарати для нервової системи"><strong>Усі</strong></a>
                </li>
                <?php
                $result = mysqli_query($link, "SELECT * FROM category WHERE type='Препарати для нервової системи'");

                if (mysqli_num_rows($result) > 0)
                {
                    $row = mysqli_fetch_array($result);

                    do
                    {
                        echo '
                    <li><a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'">'.$row["brand"].'</a></li>
                    ';
                    }
                    while ($row = mysqli_fetch_array($result));
                }
                ?>
            </ul>
        </li>
    </ul>
</div>