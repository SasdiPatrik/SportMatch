<?php
		require "config.php";
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
        <ul>
            <li><img class="menu-left" src="imgs/kepppp.png" alt="logo" width="150" height="70"></li>
            <li class="menu-toggle">
                <a href="#" class="menu-icon">&#9776;</a>
            </li>
			<?php
			
				if(isset($_COOKIE["felhasznalonev"])){
			
			?>
				<li><a href="logout.php?logout=1" class="menu-right">Kijelentkezés</a></li>
				<li class="menu_li"><a href="profil.php" class="menu-right">Profilom</a></li>
				
			<?php
			
				}
			
			?>
            <li><a href="index.php" class="menu-right">Főoldal</a></li>
        </ul>
    </nav>

	<h1 class="" style="color:white">Szabadon látogatható események</h1>
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
			</tr>
							
    <?php } ?>
	</table>

	<nav id="mobile-menu">
        <ul>
			<?php if(isset($_COOKIE["felhasznalonev"])): ?>
				<li><a href="logout.php?logout=1">Kijelentkezés</a></li>
				<li class="menu_li"><a href="profil.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">Profilom</a></li>
			<?php endif; ?>
			<li><a href="index.php">Főoldal</a></li>
        </ul>
    </nav>
    
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