<?php
    include "connect.php";
    
    /* Avoid multiple sessions warning
    Check if session is set before starting a new one. */
    if(!isset($_SESSION)) {
        session_start();
    }

    $uname = mysqli_real_escape_string($conn, $_POST["cust_uname"]);
    $pwd = mysqli_real_escape_string($conn, $_POST["cust_psw"]);
	
    $sql0 =  "SELECT * FROM musteri WHERE kullanici_adi='".$uname."' AND sifre='".$pwd."'";
    $result = $conn->query($sql0);
    $row = $result->fetch_assoc();
	//$ip= $_SERVER['REMOTE_ADDR'];
	
    

    if (($result->num_rows) > 0) {
        $_SESSION['loggedIn_cust_id'] = $row["musteri_id"];
        $_SESSION['isCustValid'] = true;
        $_SESSION['LAST_ACTIVITY'] = time();
		
		
		//$row1 = $result1->fetch_assoc();
        header("location:customer_home.php");
		$sql1 =  "UPDATE musteri SET son_giris = CURRENT_TIMESTAMP() WHERE musteri_id =".$_SESSION['loggedIn_cust_id'];
		$result1 = $conn->query($sql1);
    }
    else {
        session_destroy();
        die(header("location:home.php?loginFailed=true"));
    }
?>
