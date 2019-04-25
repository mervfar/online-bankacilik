<?php
    include "navbar.php";
    include "connect.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="news_style.css">
</head>

<body>
    <div class="flex-container">
        <?php
            $sql0 = "SELECT haber_id, baslik, tarih FROM haberler ORDER BY tarih DESC";
            $result = $conn->query($sql0);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $id = $row["haber_id"];
                $sql1 = "SELECT icerik FROM haber_icerik WHERE haber_id=$id";
                $result1 = $conn->query($sql1); ?>

                <div class="flex-item">
                    <div class="flex-container-title">
                        <h1 id="title"><?php echo $row["baslik"] . "<br>"; ?></h1>
                    </div>
                    <div class="flex-container-title">
                        <p id="date"><?php echo "Tarih : " .
                            date("d/m/Y", strtotime($row["tarih"])); ?></p>
                    </div>
                    <div class="flex-container-body">
                        <p id="news_body"><?php while($row1 = $result1->fetch_assoc()) {
                            echo $row1["icerik"]; } ?></p>
                    </div>
                </div>

            <?php }
            } else {
                echo "Hiç haber bulunamadı! Yönetici ile iletişime geçiniz..";
            }
            $conn->close();
        ?>
    </div>

</body>
</html>
