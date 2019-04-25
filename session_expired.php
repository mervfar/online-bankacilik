<?php
    include "header.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="session_expired_style.css">
</head>


<body>
    <div class="flex-container">
        <div class="flex-item">
            <img id="session" src="/images/hourglass.png">
        </div>
        <div class="flex-item-message">
            <h1 id="session">Oturum Sonlandırıldı !</h1>
            <p id="session">
                Güvenlik sebebiyle 5 DK boyunca işem yapılmadığında 
		oturum otomatik olarak sonlanır.
		Lütfen yeniden giriş yapınız!
            </p>
        </div>
        <div class="flex-item">
            <a href="/home.php" class="button">Ana Sayfaya Git</a>
        </div>
    </div>

</body>
</html>
