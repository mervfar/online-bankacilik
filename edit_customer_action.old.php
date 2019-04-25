<?php
    /* Avoid multiple sessions warning
    Check if session is set before starting a new one. */
    if(!isset($_SESSION)) {
        session_start();
    }

    include "validate_admin.php";
    include "connect.php";
    include "header.php";
    include "user_navbar.php";
    include "admin_sidebar.php";
    include "session_timeout.php";

    if (isset($_GET['cust_id'])) {
        $_SESSION['cust_id'] = $_GET['cust_id'];
    }

    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
    $dob = mysqli_real_escape_string($conn, $_POST["dob"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $phno = mysqli_real_escape_string($conn, $_POST["phno"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $branch = mysqli_real_escape_string($conn, $_POST["branch"]);
    $acno = mysqli_real_escape_string($conn, $_POST["acno"]);
    $pin = mysqli_real_escape_string($conn, $_POST["pin"]);
    $cus_uname = mysqli_real_escape_string($conn, $_POST["cus_uname"]);
    $cus_pwd = mysqli_real_escape_string($conn, $_POST["cus_pwd"]);

    $sql0 = "UPDATE musteri SET adi = '$fname',
                                 soyadi = '$lname',
                                 dogum_tarihi = '$dob',
                                 email = '$email',
                                 telefon_no = '$phno',
                                 adres = '$address',
                                 sube = '$branch',
                                 hesap_no = '$acno',
                                 pin = '$pin',
                                 kullanici_adi = '$cus_uname',
                                 sifre = '$cus_pwd'
                            WHERE musteri_id=".$_SESSION['cust_id'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="action_style.css">
</head>

<body>
    <div class="flex-container">
        <div class="flex-item">
            <?php
                if (($conn->query($sql0) === TRUE)) { ?>
                    <p id="info"><?php echo "Güncelleme Başarılı !"; ?></p>
                <?php
                }
                else { ?>
                    <p id="info"><?php echo "Error: " . $sql0 . "<br>" . $conn->error . "<br>"; ?></p>
                <?php
                }
            ?>
        </div>
        <?php $conn->close(); ?>

        <div class="flex-item">
            <a href="/manage_customers.php" class="button">Geri</a>
        </div>

    </div>

</body>
</html>
