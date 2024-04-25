<!DOCTYPE html>
<html lang="hu">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex">
	<link rel="shortcut icon" href="imgs/faviconn.png">
	<link rel="stylesheet" href="assets/css/regist-style.css">
	<title>Bejelentkezés</title>
</head>
<body>
<?php 
require "config.php";

if(isset($_POST['login']))
{
	$email = $_POST['email'];
	$pass = $_POST['password'];
	
	$lekerdezes = "SELECT * FROM users WHERE email='$email'";
	$talalt_felhasznalo = $conn->query($lekerdezes);
	
	if(mysqli_num_rows($talalt_felhasznalo) == 1){
		
		$lekerdezes = "SELECT * FROM users WHERE email='$email' AND password='$pass'";
		$talalt_felhasznalo = $conn->query($lekerdezes);
		
		if(mysqli_num_rows($talalt_felhasznalo) == 1){
			
			$beleptetendo_felhasznalo = $talalt_felhasznalo->fetch_assoc();
			
			setcookie('email', $beleptetendo_felhasznalo['email'], time() + 3600, '/');
			setcookie('felhasznalonev', $beleptetendo_felhasznalo['firstname'], time() + 3600, '/');
			setcookie('vezeteknev', $beleptetendo_felhasznalo['lastname'], time() + 3600, '/');
			setcookie('jelszo', $beleptetendo_felhasznalo['password'], time() + 3600, '/');
			
			header("Location: index.php?userid=". $_COOKIE['felhasznalonev']);
			exit();
		}
		else{
			echo "<script>alert('Helytelen jelszó!')</script>";
		}
		
	}
	else{
		echo "<script>alert('Nincs regisztrálva az email!')</script>";
	}
}

?>

<div class="regist">
         <div class="title">
            Bejelentkezés
         </div>
         <form method="post" action="login.php">
            <div class="field">
			<input type="text" name="email" required>
               <label>Email</label>
            </div>
            <div class="field">
			<input type="password" name="password" required>
               <label>Jelszó</label>
            </div>
            <div class="field">
				<input type="submit" name="login" value="Belépés">
            </div>
            <div class="signup-link">
				<a href="regist.php">Regisztráció</a><br><br>
                <a href="index.php">Kezdőlap</a>
            </div>
         </form>
</div>
</body>
</html>