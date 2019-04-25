<?php
    /* Avoid multiple sessions warning
    Check if session is set before starting a new one. */
    if(!isset($_SESSION)) {
        session_start();
    }
	include "connect.php";
    include "validate_customer.php";
    
    include "session_timeout.php";

    if (isset($_SESSION['auto_delete_benef'])) {
        if ($_SESSION['auto_delete_benef'] === true) {
            header("location:/auto_delete_beneficiary.php");
        }
    }

    if (isset($_SESSION['loggedIn_cust_id'])) {
        $sql0 = "SELECT * FROM musteri_iliskileri WHERE musteri_id=".$_SESSION['loggedIn_cust_id'];
    }

    $result = $conn->query($sql0);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $sql1 = "SELECT * FROM musteri WHERE
                                musteri_id=".$row["musteri_id"]." AND
                                hesap_no='".$row["hesap_no"]."'";

            $result1 = $conn->query($sql1);
            if ($result1->num_rows <= 0) {
                header("location:/delete_beneficiary.php?cust_id=".$row["musteri_id"]."&redirect=true");
            }
        }
    }
?>
