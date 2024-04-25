<?php
		require "config.php";
		
		if(isset($_POST['delete-btn'])){		
			$event_id = $_POST['event_id'];

			$conn->query("DELETE FROM events WHERE id = $event_id");
			
		}
		if(isset($_POST['addevent-btn'])){
			
			
			$hely = $_POST['hely'];
			$date = $_POST['date'];
			$sport = $_POST['sport'];
			
			$conn->query("INSERT INTO events VALUES(id, '$hely','$date','$sport')");
		}
?>
<!DOCTYPE html>
<html lang="hu">

<head>
	
	<title>SportMatch</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex">
	<link rel="shortcut icon" href="imgs/faviconn.png">
	<link rel="stylesheet" href="assets/css/roompage-style.css">
	<link rel="stylesheet" href="assets/css/admin.css">
	<script src="https://code.jquery.com/jquery-latest.js"></script>
	
</head>
<body>

	<nav id="nav-box">
        <ul class="menu_ul">
            <li class="menu_li"><img class="menu-left" src="imgs/kepppp.png" alt="logo" width="150" height="70"></li>
            <li class="menu-toggle">
                <a href="#" class="menu-icon">&#9776;</a>
            </li>
            <li class="menu_li"><a href="logout.php?logout=1" class="menu-right">Kijelentkezés</a></li>
            <li class="menu_li"><a href="profil.php?userid=<?= $_COOKIE['felhasznalonev'] ?>" class="menu-right">Profilom</a></li>
            <li class="menu_li"><a href="rooms.php?userid=<?= $_COOKIE['felhasznalonev'] ?>" class="menu-right">Szobák</a></li>
            <li class="menu_li"><a href="index.php?userid=<?= $_COOKIE["felhasznalonev"] ?>" class="menu-right">Főoldal</a></li>
        </ul>
    </nav><br><br><br><br><br>

	<h1 style="color:white">Szabadon látogatható események</h1>
	<table id="customers">
			<tr>
				<th>Helyszín</th>
				<th>Dátum</th>
				<th>Sport</th>
			</tr>
	<?php
            $lekerdezes = "SELECT * FROM events";

            $talalt_event = $conn->query($lekerdezes);

            while ($event = $talalt_event->fetch_assoc()) {
    ?>                       
			<tr>
				<th><?= $event['hely']; ?></th>
				<th><?= $event['date']; ?></th>
				<th><?= $event['sport']; ?></th>
				<th>
					<form action="admin.php" method="post">
						<input type="hidden" name="event_id" value="<?= $event['id'] ?>">
						<input type="submit" name="delete-btn" value="Törlés!">
					</form>
				</th>
			</tr>
							
    <?php } ?>
	</table>
	<br><br>
	<h1 style="color:white">Esemény hozzáadása</h1>
	<form method="post" action="admin.php">
		<input type="text" name="hely" placeholder="Helyszín">
		<input type="date" name="date" placeholder="Dátum">
		<input type="text" name="sport" placeholder="Sport">
		<input type="submit" name="addevent-btn" value="Hozzáad!">
	</form>

	<nav id="mobile-menu">
        <ul class="menu_ul">
            <li class="menu_li"><a href="index.php?userid=<?= $_COOKIE["felhasznalonev"] ?>">Főoldal</a></li>
            <li class="menu_li"><a href="rooms.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">Szobák</a></li>
            <li class="menu_li"><a href="profil.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">Profilom</a></li>
            <li class="menu_li"><a href="logout.php?logout=1">Kijelentkezés</a></li>
        </ul>
    </nav>
	<br><br><br><br>
    
    <div class="footer"><span>SportMatch©</span></div>

</body>

<script>

document.querySelector('.menu-toggle').addEventListener('click', function () {
        this.classList.toggle('active');
        var mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') {
            mobileMenu.style.display = 'block';
        } else {
            mobileMenu.style.display = 'none';
        }
    });

</script>

</html>