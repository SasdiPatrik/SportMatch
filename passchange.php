<!DOCTYPE html>
<html lang="hu">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex">
	<link rel="shortcut icon" href="imgs/faviconn.png">
	<link rel="stylesheet" href="assets/css/regist-style.css">
	<title>Profil</title>
</head>
<body>
<?php
require "config.php";

if (isset($_POST['change'])) {
    if ($_POST['oldpass'] == $_COOKIE['jelszo']) {
        $email = $_COOKIE['email'];
        $newPassword = $_POST['newpassword'];
        $newPasswordRepeat = $_POST['newpass'];

        if ($newPassword == $newPasswordRepeat) {
            setcookie('jelszo', $newPassword, time() + (86400 * 30), "/");

            $conn->query("UPDATE users SET password='$newPassword' WHERE email='$email'");
            header("Location: profil.php?userid=". $_COOKIE['felhasznalonev']);
            exit();
        } else {
            echo "<script>alert('AZ új jelszavak nem egyeznek')</script>";
        }
    } else {
        echo "<script>alert('A régi jelszó nem megfelelő')</script>";
    }
}
?>

<div class="regist">
         <div class="title">
            Jelszó megváltoztatása
         </div>
         <form method="post" action="passchange.php">
            <div class="field">
			<input type="password" name="oldpass" required>
               <label>Régi jelszó</label>
            </div>
            <div class="field">
			<input type="password" name="newpassword" required>
               <label>Új jelszó</label>
            </div>
            <div class="field">
			<input type="password" name="newpass" required>
               <label>Új jelszó ismét</label>
            </div>
            <div class="field">
				<input type="submit" name="change" value="Módosítás">
            </div>
            <div class="signup-link">
				<a href="index.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">Vissza a főoldalra</a>
          </div>
         </form>
</div>
</body>
</html>