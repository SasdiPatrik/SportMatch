<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex">
    <link rel="shortcut icon" href="imgs/faviconn.png">
    <link rel="stylesheet" href="assets/css/regist-style.css">
    <title>Szoba létrehozása</title>
</head>
<body>

<?php

require "config.php";

if (!isset($_COOKIE['felhasznalonev'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['save-btn'])) {
    $creator = $_COOKIE['email'];
    $name = $_POST['szoba-name'];
    $type = $_POST['tipus'];
    $sport = $_POST['sport'];

    $telepules = $_POST['telepules'];
    $hely = "SELECT * FROM telepulesek WHERE telepules_name = '$telepules'";
    $result = $conn->query($hely);

    if ($result->num_rows > 0) {
        if (strlen($name) < 3 || strlen($name) > 19) {
        echo "A név mezőjének minimum 3 és maximum 19 karakter hosszúnak kell lennie.";
    } else  {
        $conn->query("INSERT INTO rooms VALUES(id, '$name', '$type', '$telepules', '$sport', '$creator', '')");
                header("Location: rooms.php?userid=". $_COOKIE['felhasznalonev']);
                exit();
        }
        } else {
            echo "<script>alert('A megadott település nem található az adatbázisban.')</script>";
        }
}

?>

    <div class="regist">
         <div class="title">
            Szoba létrehozása
         </div>
         <form method="post" action="addroom.php">
            <div class="field">
                <input type="text" name="szoba-name" required minlength="3" maxlength="19">
                <label>Név</label>
            </div>
            <div class="field">
               <label id="typelabel">Típus</label>
                <select class="opciok" name="tipus" required>
                        <option value="" disabled selected hidden></option>
                    <option value="Nyílt">Nyílt</option>
                    <option value="Privát">Privát</option>
                </select>
            </div>
            <div class="field">
                <input type="text" id="telepules" name="telepules" required>
                <label>Helyszín</label>
            </div>
            <div class="field">
            <label id="sportLabel">Sportág kiválasztása</label>
            <select class="opciok" name="sport" required>
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
                <input type="submit" name="save-btn" value="Létrehozás">
            </div>
            <div class="signup-link">
                <a href="rooms.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">Vissza a főoldalra</a>            
            </div>
         </form>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var nemSelect = document.querySelector('select[name="tipus"]');
        var nemLabel = document.getElementById('typelabel');

        nemSelect.addEventListener('change', function () {
            nemLabel.style.display = nemSelect.value ? 'none' : 'block';
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
    var sportSelect = document.querySelector('select[name="sport"]');
    var sportLabel = document.getElementById('sportLabel');

    sportSelect.addEventListener('change', function () {
        sportLabel.style.display = sportSelect.value ? 'none' : 'block';
    });
});
</script>

</body>
</html>