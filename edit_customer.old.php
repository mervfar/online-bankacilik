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

    $sql0 = "SELECT * FROM musteri WHERE musteri_id=".$_SESSION['cust_id'];
    /*$sql1 = "SELECT * FROM hesap_cuzdani WHERE trans_id=(
                    SELECT MAX(trans_id) FROM hesap_cuzdani)";*/

    $result0 = $conn->query($sql0);
   // $result1 = $conn->query($sql1);

    if ($result0->num_rows > 0) {
        // output data of each row
        while($row = $result0->fetch_assoc()) {
            $fname = $row["adi"];
            $lname = $row["soyadi"];
            $gender = $row["cinsiyeti"];
            $dob = $row["dogum_tarihi"];
            $email = $row["email"];
            $phno = $row["telefon_no"];
            $address = $row["adres"];
            $branch = $row["sube"];
            $acno = $row["hesap_no"];
            $pin = $row["pin"];
            $cus_uname = $row["kullanici_adi"];
            $cus_pwd = $row["sifre"];
			$balance = $row["bakiye"];
        }
    }

   /* if ($result1->num_rows > 0) {
        // output data of each row
        while($row = $result1->fetch_assoc()) {
            $balance = $row["bakiye"];
        }
    }*/
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="customer_add_style.css">
</head>

<body>
    <form class="add_customer_form" action="edit_customer_action.php" method="post">
        <div class="flex-container-form_header">
            <h1 id="form_header">Müşteri Bilgilerini Yönet . . .</h1>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Müsteri ID : <label id="info_label"> <?php echo $_SESSION['cust_id'] ?> </label></label>
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Adı :</label><br>
                <input name="fname" size="30" type="text" value="<?php echo $fname ?>" required />
            </div>
            <div  class=container>
                <label>Soyadı :</b></label><br>
                <input name="lname" size="30" type="text" value="<?php echo $lname ?>" required />
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Bakiye (&#8378;) : <label id="info_label"> <?php echo number_format($balance) ?> </label></label>
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Cinsiyet :
                    <label id="info_label">
                    <?php
                        if ($gender == "male") {echo "Erkek";}
                        elseif ($gender == "female") {echo "Kadın";}
                        else {echo "Others";}
                    ?>
                    <label>
                </label>
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Doğum Tarihi :</label><br>
                <input name="dob" size="30" type="text" placeholder="yyyy-mm-dd" value="<?php echo $dob ?>" required />
            </div>
        </div>

        

        <div class="flex-container">
            <div class=container>
                <label>E-Posta :</label><br>
                <input name="email" size="30" type="text" value="<?php echo $email ?>" required />
            </div>
            <div  class=container>
                <label>Telefon No :</b></label><br>
                <input name="phno" size="30" type="text" value="<?php echo $phno ?>" required />
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Adres :</label><br>
                <textarea name="address" required /><?php echo $address ?></textarea>
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Banka Şubesi :</label>
            </div>
            <div  class=container>
                <select name="branch">
                   
					
					<option value="istanbul" <?php if ($branch == 'istanbul') {?> selected="selected" <?php }?>>İstanbul</option>
					<option value="newyork"  <?php if ($branch == 'newyork') {?> selected="selected" <?php }?>>New York</option>
                    <option value="paris"    <?php if ($branch == 'paris') {?> selected="selected" <?php }?>>Paris</option>
                    <option value="rio"      <?php if ($branch == 'rio') {?> selected="selected" <?php }?>>Rio</option>
                    <option value="moscow"   <?php if ($branch == 'moscow') {?> selected="selected" <?php }?>>Moscow</option>
		            <option value="helsinki" <?php if ($branch == 'helsinki') {?> selected="selected" <?php }?>>Helsinki</option>
                    <option value="berlin"   <?php if ($branch == 'berlin') {?> selected="selected" <?php }?>>Berlin</option>
                    <option value="tokyo"    <?php if ($branch == 'tokyo') {?> selected="selected" <?php }?>>Tokyo</option>
                    <option value="denver"   <?php if ($branch == 'denver') {?> selected="selected" <?php }?>>Denver</option>
					<option value="nairobi"  <?php if ($branch == 'nairobi') {?> selected="selected" <?php }?>>Nairobi</option>
					<option value="oslo"     <?php if ($branch == 'oslo') {?> selected="selected" <?php }?>>Oslo</option>
                </select>
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Hesap No :</label><br>
                <input name="acno" size="25" type="text" value="<?php echo $acno ?>" required />
            </div>
        </div>

        <div class="flex-container">
            <div  class=container>
                <label>PIN(4 HANE) :</b></label><br>
                <input name="pin" size="15" type="text" value="<?php echo $pin ?>" required />
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Kullanıcı Adı :</label><br>
                <input name="cus_uname" size="30" type="text" value="<?php echo $cus_uname ?>" required />
            </div>
            <div  class=container>
                <label>Şifre :</b></label><br>
                <input name="cus_pwd" size="30" type="password" value="<?php echo $cus_pwd ?>" required />
            </div>
        </div>

        <div class="flex-container">
            <div class="container">
                <a href="/manage_customers.php" class="button">Geri</a>
            </div>
            <div class="container">
                <button type="submit">Güncelle</button>
            </div>
        </div>

    </form>

</body>
</html>
