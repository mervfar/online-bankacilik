<?php
    include "validate_admin.php";
    include "connect.php";
    include "header.php";
    include "user_navbar.php";
    include "admin_sidebar.php";
    include "session_timeout.php";
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
            $sql0 = "SELECT sikayet_id, baslik, tarih,sahibi,icerik,is_solved FROM sikayet ORDER BY tarih DESC";
            $result = $conn->query($sql0);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $id = $row["sikayet_id"];
				$is_solved = $row["is_solved"];
				$durum = "Problem Çozülmedi !";
				if ($is_solved==1){$durum = "Problem Çozüldü !";}
	            $sql1 = "SELECT adi,soyadi FROM musteri WHERE musteri_id=$id";
		$result1 = $conn->query($sql1); ?>

                <div class="flex-item">
                    <div class="flex-container-title">
                        <h1 id="title"><?php echo $row["baslik"] . "<br>"."Tarih : " .
                            date("d/m/Y", strtotime($row["tarih"])); ?></h1>
                    </div>
                    <div class="flex-container-title">
                        <p id="date"><?php while($row1 = $result1->fetch_assoc()) {
                            echo $row1["adi"]." ".$row1["soyadi"]." >----------------------> ".$durum;} ?></p>
                    </div>
                    <div class="flex-container-body">
                        <p id="news_body"><?php echo $row["icerik"];  ?></p>
                    </div>
                </div>

            <?php }
            } else {
                echo "Tebrikler! Şikayet kaydı bulunamadı.";
            }
            $conn->close();
        ?>
    </div>

</body>
</html>

