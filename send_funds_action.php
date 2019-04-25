<?php
    include "validate_customer.php";
    include "header.php";
    include "customer_navbar.php";
    include "customer_sidebar.php";
    include "session_timeout.php";

    /*  Set appropriate error number if errors are encountered.
        Key (for err_no) :
        -1 = Connection Error.
         0 = Successful Transaction.
         1 = Insufficient Funds.
         2 = Wrong password entered. */
    $err_no = -1;

    if (isset($_GET['cust_id'])) {
        $receiver_id = $_GET['cust_id'];
    }

    $sender_id = $_SESSION['loggedIn_cust_id'];
    $amt = mysqli_real_escape_string($conn, $_POST["amt"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql0 = "SELECT * FROM musteri WHERE musteri_id=".$sender_id." AND sifre='".$password."'";
    $result0 = $conn->query($sql0);
    $row0 = $result0->fetch_assoc();

    $sql5 = "SELECT * FROM musteri WHERE musteri_id=".$receiver_id;
    $result5 = $conn->query($sql5);
    $row5 = $result5->fetch_assoc();

    if (($result0->num_rows) > 0) {
        $sql1 = "SELECT bakiye FROM musteri WHERE musteri_id=".$sender_id;
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        $sender_balance = $row1["bakiye"];

        $updated_sender_balance = $sender_balance - $amt;
        if($updated_sender_balance >= 0) {
            $sql2 = "SELECT bakiye FROM musteri WHERE musteri_id=".$receiver_id;
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $receiver_balance = $row2["bakiye"];

            $updated_receiver_balance = $receiver_balance + $amt;

            $sql3 = "INSERT INTO hesap_cuzdani  VALUES(
                        NULL,
                        NOW(),
                        'Şuraya Gönderildi: ".$row5["adi"]." ".$row5["soyadi"].", Hesap No: ".$row5["hesap_no"]."',
                        '$amt',
                        '0',
                        '$sender_id'
                    )";

            $sql7 = "UPDATE musteri SET bakiye ='$updated_sender_balance' WHERE musteri_id=".$sender_id;
			
			$sql4 = "INSERT INTO hesap_cuzdani VALUES(
                        NULL,
                        NOW(),
                        'Şuradan Geldi: ".$row0["adi"]." ".$row0["soyadi"].", Hesap No: ".$row0["hesap_no"]."',
                        '0',
                        '$amt',
                        '$receiver_id'
                    )";
			$sql6 = "UPDATE musteri SET bakiye ='$updated_receiver_balance' WHERE musteri_id=".$receiver_id;

            if (($conn->query($sql3) === TRUE) && ($conn->query($sql4) === TRUE)&& ($conn->query($sql6) === TRUE)&& ($conn->query($sql7) === TRUE)) {
                $err_no = 0;
            }
        }
        else {
            $err_no = 1;
        }
    }
    else {
        $err_no = 2;
    }
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
            if ($err_no == -1) { ?>
                <p id="info"><?php echo "Connection Error ! Please try again later.\n"; ?></p>
            <?php } ?>

            <?php
            if ($err_no == 0) { ?>
                <p id="info"><?php echo "Gönderim Başarılı!\n"; ?></p>
            <?php } ?>

            <?php
            if ($err_no == 1) { ?>
                <p id="info"><?php echo "Yetersiz Bakiye !\n"; ?></p>
            <?php } ?>

            <?php
            if ($err_no == 2) { ?>
                <p id="info"><?php echo "Yanlış Şifre Girildi !\n"; ?></p>
            <?php } ?>
        </div>

        <div class="flex-item">
            <a href="/beneficiary.php" class="button">Geri</a>
        </div>
    </div>

</body>
</html>
