<?php
    include "validate_admin.php";
    include "header.php";
    include "user_navbar.php";
    include "admin_sidebar.php";
    include "session_timeout.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="customer_add_style.css">
</head>

<body>
    <form class="add_customer_form" action="customer_add_action.php" method="post">
        <div class="flex-container-form_header">
            <h1 id="form_header">Lütfen gerekli yerleri doldurunuz...!</h1>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Adı :</label><br>
                <input name="fname" size="30" type="text" required />
            </div>
            <div  class=container>
                <label>Soyadı :</b></label><br>
                <input name="lname" size="30" type="text" required />
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Cinsiyet :</label>
            </div>
            <div class="flex-container-radio">
                <div class="container">
                    <input type="radio" name="gender" value="male" id="male-radio" checked>
                    <label id="radio-label" for="male-radio"><span class="radio">Erkek</span></label>
                </div>
                <div class="container">
                    <input type="radio" name="gender" value="female" id="female-radio">
                    <label id="radio-label" for="female-radio"><span class="radio">Kadın</span></label>
                </div>
                <div class="container">
                    <input type="radio" name="gender" value="others" id="other-radio">
                    <label id="radio-label" for="other-radio"><span class="radio">Diğer</span></label>
                </div>
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Doğum Tarihi :</label><br>
                <input name="dob" size="30" type="text" placeholder="yyyy-aa-gg" required />
            </div>
        </div>

       

        <div class="flex-container">
            <div class=container>
                <label>E-Posta :</label><br>
                <input name="email" size="30" type="text" required />
            </div>
            <div  class=container>
                <label>Telefon No:</b></label><br>
                <input name="phno" size="30" type="text" required />
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Adres :</label><br>
                <textarea name="address" required /></textarea>
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Banka Şubesi :</label>
            </div>
            <div  class=container>
                <select name="branch">
                    <option value="istanbul">İstanbul</option>
					<option value="newyork">New York</option>
                    <option value="paris">Paris</option>
                    <option value="rio">Rio</option>
                    <option value="moscow">Moscow</option>
		            <option value="helsinki">Helsinki</option>
                    <option value="berlin">Berlin</option>
                    <option value="tokyo">Tokyo</option>
                    <option value="denver">Denver</option>
					<option value="nairobi">Nairobi</option>
					<option value="oslo">Oslo</option>
                </select>
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Hesap No :</label><br>
                <input name="acno" size="25" type="text" required />
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Başlangıç Bakiyesi :</label><br>
                <input name="o_balance" size="20" type="text" required />
            </div>
            <div  class=container>
                <label>PIN(4 hane) :</b></label><br>
                <input name="pin" size="15" type="text" required />
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Kullanıcı Adı :</label><br>
                <input name="cus_uname" size="30" type="text" required />
            </div>
            <div  class=container>
                <label>Şifre :</b></label><br>
                <input name="cus_pwd" size="30" type="password" required />
            </div>
        </div>

        <div class="flex-container">
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
        return confirm('Girdiler sıfırlanacak, emin misiniz?')
    }
    </script>

</body>
</html>
