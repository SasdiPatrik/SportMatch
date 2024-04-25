<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex">
	<link rel="shortcut icon" href="imgs/faviconn.png">
    <link rel="stylesheet" href="assets/css/regist-style.css">
    <title>Regisztráció</title>
</head>
<body>
<?php

require "config.php";

if(isset($_POST['regist']))
{
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $nem = $_POST['nem'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    $lekerdezes = "SELECT * FROM users WHERE email='$email'";
        $talalt_felhasznalo = $conn->query($lekerdezes);

        if(mysqli_num_rows($talalt_felhasznalo) == 0){
            if(isset($_POST['regist'])){
                if($_POST['password'] == $_POST["password2"]){

                    $conn->query("INSERT INTO users VALUES(id, '$lastname', '$firstname', '$nem', '$password', '$email', 0, '', '', '', '')");
                    header("Location: login.php");
                    exit();
                }
                else{
                    echo "<script>alert('A jelszavak nem egyeznek!')</script>";
                }
            }
        }
        else{
            echo "<script>alert('Már regisztrált email!')</script>";
        }
}

?>

<div class="regist">
         <div class="title">
            Regisztráció
         </div>
         <form method="post" action="regist.php">
            <div class="field">
                <input type="text" name="lastname" required maxlength="12">
               <label>Vezetéknév</label>
            </div>
            <div class="field">
                <input type="text" name="firstname" required maxlength="12">
               <label>Keresztnév</label>
            </div>
            <div class="field">
               <label id="nemlabel">Nem</label>
                <select class="opciok" name="nem" required>
                        <option value="" disabled selected hidden></option>
                    <option value="Férfi">Férfi</option>
                    <option value="Nő">Nő</option>
                </select>
            </div>
            <div class="field">
                <input type="email" name="email" required>
               <label>Email</label>
            </div>
            <div class="field">
				<input type="password" name="password" required maxlength="40">
				<label>Jelszó</label>
			</div>
            <div class="field">
                <input type="password" name="password2" required maxlength="40">
                <label>Jelszó újra</label>
            </div>
            <br>
            <p style="font-size:13px;">A „Regisztrálás” gombra kattintva elfogadod a felhasználási feltételeinket.</p>
            <div class="field">
                <input type="submit" name="regist" value="Regisztrálás">
            </div>
            <div class="signup-link">
                <a href="login.php">Bejelentkezés</a><br><br>
                <a href="index.php">Kezdőlap</a>
            </div>
         </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var nemSelect = document.querySelector('select[name="nem"]');
        var nemLabel = document.getElementById('nemlabel');

        nemSelect.addEventListener('change', function () {
            nemLabel.style.display = nemSelect.value ? 'none' : 'block';
        });
    });
</script>

</body>
</html>