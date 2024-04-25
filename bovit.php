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

if(isset($_POST['confirm']))
{
  $email = $_COOKIE['email'];
  $age = $_POST['age'];
  $sport1 = $_POST['sport1'];
  $sport2 = $_POST['sport2'];
  $sport3 = $_POST['sport3'];

  $lekerdezes = "SELECT * FROM users WHERE email='$email'";
  $talalt_felhasznalo = $conn->query($lekerdezes);
  
  $city = $_POST['telepules'];
  $hely = "SELECT * FROM telepulesek WHERE telepules_name = '$city'";
  $result = $conn->query($hely);
	
	if ($talalt_felhasznalo !== false && $talalt_felhasznalo->num_rows > 0) {
		if ($result->num_rows > 0) {
				$conn->query("UPDATE users SET age='$age', city='$city', sport1='$sport1', sport2='$sport2', sport3='$sport3' WHERE email='$email'");
				header("Location: profil.php?userid=". $_COOKIE['felhasznalonev']);
				exit();
		} else {
			echo "<script>alert('A megadott település nem található az adatbázisban.')</script>";
		}
	} else {
		echo "Hiba a felhasználó adatainak lekérdezésében: " . $conn->error;
	}
}

?>

<div class="regist">
         <div class="title">
            Profil szerkesztése
         </div>
         <form method="post" action="bovit.php">
         <div class="field">
            <input type="text" name="age" pattern="\d+" title="A kor csak szám lehet" required>
            <label>Kor</label>
        </div>
          <div class="field">
              <input type="text" id="telepules" name="telepules" required>
              <label>Település</label>
          </div>
			    <div class="field">
            <label id="sportLabel">Sportág kiválasztása</label>
            <select class="opciok" name="sport1" required>
				        <option value="" disabled selected hidden></option>
                <option value="Asztaltenisz">Asztaltenisz</option>
                <option value="Atlétika">Atlétika</option>
                <option value="Baseball">Baseball</option>
                <option value="Golf">Golf</option>
                <option value="Kerékpározás">Kerékpározás</option>
                <option value="Kézilabda">Kézilabda</option>
                <option value="Kosárlabda">Kosárlabda</option>
                <option value="Krikett">Krikett</option>
                <option value="Labdarúgás">Labdarúgás</option>
                <option value="Röplabda">Röplabda</option>
                <option value="Tenisz">Tenisz</option>
                <option value="Tollaslabda">Tollaslabda</option>
            </select>
        	</div>
          <div class="field">
            <label id="sportLabel2">2. sportág (nem kötelező)</label>
            <select class="opciok2" name="sport2">
				        <option value="" disabled selected hidden></option>
                <option value="Asztaltenisz">Asztaltenisz</option>
                <option value="Atlétika">Atlétika</option>
                <option value="Baseball">Baseball</option>
                <option value="Golf">Golf</option>
                <option value="Kerékpározás">Kerékpározás</option>
                <option value="Kézilabda">Kézilabda</option>
                <option value="Kosárlabda">Kosárlabda</option>
                <option value="Krikett">Krikett</option>
                <option value="Labdarúgás">Labdarúgás</option>
                <option value="Röplabda">Röplabda</option>
                <option value="Tenisz">Tenisz</option>
                <option value="Tollaslabda">Tollaslabda</option>
            </select>
        	</div>
          <div class="field">
            <label id="sportLabel3">3. sportág (nem kötelező)</label>
            <select class="opciok3" name="sport3">
				        <option value="" disabled selected hidden></option>
                <option value="Asztaltenisz">Asztaltenisz</option>
                <option value="Atlétika">Atlétika</option>
                <option value="Baseball">Baseball</option>
                <option value="Golf">Golf</option>
                <option value="Kerékpározás">Kerékpározás</option>
                <option value="Kézilabda">Kézilabda</option>
                <option value="Kosárlabda">Kosárlabda</option>
                <option value="Krikett">Krikett</option>
                <option value="Labdarúgás">Labdarúgás</option>
                <option value="Röplabda">Röplabda</option>
                <option value="Tenisz">Tenisz</option>
                <option value="Tollaslabda">Tollaslabda</option>
            </select>
        	</div>
          <div class="field">
				    <input type="submit" name="confirm" value="Megerősítés">
          </div>
          <div class="signup-link">
				    <a href="index.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">Vissza a főoldalra</a>
          </div>
            
         </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    function handleSportChange(sportLabelId, sportSelectClassName, otherSportSelectClassName) {
      const sportLabel = document.getElementById(sportLabelId);
      const sportSelect = document.querySelector(`.${sportSelectClassName}`);
      const otherSportSelect = document.querySelector(`.${otherSportSelectClassName}`);

      sportSelect.addEventListener('change', function() {
        if (sportSelect.value) {
          sportLabel.style.display = 'none';
          const otherOptions = otherSportSelect.querySelectorAll('option');
          otherOptions.forEach(function(option) {
            if (option.value === sportSelect.value) {
              option.style.display = 'none';
            } else {
              option.style.display = 'block';
            }
          });
        } else {
          sportLabel.style.display = 'block';
        }
      });
    }

    handleSportChange('sportLabel', 'opciok', 'opciok2');
    handleSportChange('sportLabel2', 'opciok2', 'opciok3');
    handleSportChange('sportLabel3', 'opciok3', 'opciok2');
  });
</script>

</body>
</html>