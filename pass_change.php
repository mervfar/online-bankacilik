<?php
    include "validate_customer.php";
    include "header.php";
    include "customer_navbar.php";
    include "customer_sidebar.php";
    include "session_timeout.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="customer_add_style.css">
</head>

<body>
    <form class="add_customer_form" action="pass_change_action.php" method="post">
        <div class="flex-container-form_header">
            <h1 id="form_header">Şifre/PIN Değiştir</h1>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Neyi Değiştirmek İstiyorsunuz ?</label>
            </div>
            <div class="flex-container-radio">
                <div class="container">
                    <input type="radio" name="type" value="password" id="password-radio" checked>
                    <label id="radio-label" for="password-radio"><span class="radio" >Şifre</span></label>
                </div>
                <div class="container">
                    <input type="radio" name="type" value="pin" id="pin-radio">
                    <label id="radio-label" for="pin-radio"><span class="radio">PIN</span></label>
                </div>
            </div>
        </div>

        <div class="flex-container">
            <div  class=container>
                <label>Mevcut Değer :</b></label><br>
                <input name="old_pwd" size="30" type="password" required />
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Yeni Değer :</label><br>
                <input name="new_pwd" size="30" type="password" required />
            </div>
            <div  class=container>
                <label>Tekrar Yeni Değer :</b></label><br>
                <input name="check_pwd" size="30" type="password" required />
            </div>
        </div>

        <div class="flex-container">
            <div class="container">
                <a href="/customer_profile.php" class="button">Geri Git</a>
            </div>
            <div class="container">
                <button type="submit">Kaydet</button>
            </div>

            <div class="container">
                <button type="reset" class="reset" onclick="return confirmReset();">Reset</button>
            </div>
        </div>

    </form>

    <script>
    function confirmReset() {
        return confirm('Do you really want to reset?')
    }
    </script>

</body>
</html>
