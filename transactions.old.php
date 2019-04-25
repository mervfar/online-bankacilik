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
        $kim = $_GET['cust_id'];
    }

    $sql0 = "SELECT * FROM hesap_cuzdani WHERE musteri_id='$kim'";
	$sql2 = "SELECT * FROM musteri WHERE musteri_id='$kim'";
	$result2 = $conn->query($sql2);
	$row2 = $result2->fetch_assoc()

    // Recive sort variables as $_GET
   
    // Sort Queries
    // Sort acts independent of the filter
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="transactions_style.css">
</head>

<body>
    <div class="search-bar-wrapper">
        <div class="search-bar" id="the-search-bar">
            <div class="flex-item-search-bar" id="fi-search-bar">
                

                <div class="flex-item-by">
                    <label style="border-style: groove;"><?php echo $row2["adi"]; ?> - Müşterisinin İşlem Geçmişi <br><hr> Hesap Bakiyesi : <?php echo number_format($row2["bakiye"]); ?> (Türk Lirası)</label>
                </div>

                

            </div>
        </div>
    </div>

   

   

    <div class="flex-container">

        <?php
            $result = $conn->query($sql0);

            if ($result->num_rows > 0) {?>
                <table id="transactions">
                    <tr>
                        <th>İşlem ID</th>
                        <th>Tarih - Saat</th>
                        <th>Açıklaması</th>
                        <th>Giden Para</th>
                        <th>Gelen Para</th>
                        
                    </tr>
        <?php
            // output data of each row
            while($row = $result->fetch_assoc()) {?>
                    <tr>
                        <td><?php echo $row["islem_id"]; ?></td>
                        <td>
                            <?php
                                $time = strtotime($row["islem_tarihi"]);
                                $sanitized_time = date("d/m/Y, g:i A", $time);
                                echo $sanitized_time;
                             ?>
                        </td>
                        <td><?php echo $row["aciklama"]; ?></td>
                        <td><?php echo number_format($row["giden_para"]); ?></td>
                        <td><?php echo number_format($row["gelen_para"]); ?></td>
                       
                    </tr>
            <?php } ?>
            </table>
            <?php
            } else {  ?>
                <p id="none"> No results found :(</p>
            <?php }
            $conn->close(); ?>

    </div>

    <script>
    // Sticky search-bar
    $(document).ready(function() {
        var curr_scroll;

        $(window).scroll(function () {
            curr_scroll = $(window).scrollTop();

            if ($(window).scrollTop() > 120) {
                $("#the-search-bar").addClass('search-bar-fixed');

              if ($(window).width() > 855) {
                  $("#fi-search-bar").addClass('fi-search-bar-fixed');
              }
            }

            if ($(window).scrollTop() < 121) {
                $("#the-search-bar").removeClass('search-bar-fixed');

              if ($(window).width() > 855) {
                  $("#fi-search-bar").removeClass('fi-search-bar-fixed');
              }
            }
        });

        $(window).resize(function () {
            var class_name = $("#fi-search-bar").attr('class');

            if ((class_name == "flex-item-search-bar fi-search-bar-fixed") && ($(window).width() < 856)) {
                $("#fi-search-bar").removeClass('fi-search-bar-fixed');
            }

            if ((class_name == "flex-item-search-bar") && ($(window).width() > 855) && (curr_scroll > 120)) {
                $("#fi-search-bar").addClass('fi-search-bar-fixed');
            }
        });

        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });
    </script>

</body>
</html>
