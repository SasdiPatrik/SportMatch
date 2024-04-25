<!DOCTYPE html>
<html lang="hu">

<head>
    <title>SportMatch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex">
    <link rel="shortcut icon" href="imgs/faviconn.png">
    <link rel="stylesheet" href="assets/css/rolunk.css">
    <script src="https://code.jquery.com/jquery-latest.js"></script>
</head>

<body>
	
	<?php
		require "config.php";
    ?>

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
	
	
<h1>Rólunk</h1>

<div class="container">
	<div class="card">
		<img src="imgs/nimrod1_profil.jpg" alt="Profilkép">
		<h3>Tóth Nimród</h3>
		<p class="rolunk_szoveg">Tóth Nimród vagyok, lelkes informatikus diák. Már gyermekkoromban felfedeztem az informatika izgalmas világát, és azóta is szenvedéllyel követem ezt a szakterületet. Bár még nem találtam meg azt, amit igazán csinálni szeretnék, de mindig örömmel fogadom az új kihívásokat bármilyen témában és mindig nyitott vagyok az új technológiák és fejlesztési módszerek felfedezésére. Örömmel veszek részt közösségi projektekben és igyekszem másokkal közösen elérni a céljaim.</p>
	</div>
	<div class="card">
		<img src="imgs/akos1_profil.jpg" alt="Profilkép">
		<h3>Tóth Ákos</h3>
		<p class="rolunk_szoveg">Tóth Ákos vagyok. A frontend fejlesztést jobban kedvelem, de a backend programozás és az adatbázis-kezelés terén is jártas vagyok. Szeretem az új technológiákat felfedezni, és szívesen tanulok új dolgokat. Amikor éppen nem a kódolással foglalkozom, gyakran sportolok. Az oldalunk célja, hogy támogassuk a sportot és az egészséges életmódot, így elősegítve a hatékony és aktív életvitel kialakítását.</p>
	</div>
	<div class="card">
		<img src="imgs/patrik1_profil.jpg" alt="Profilkép">
		<h3>Sásdi Patrik</h3>
		<p class="rolunk_szoveg">Sásdi Patrik vagyok, informatikus tanuló. Gyerekkoromban csöppentem bele az informatika világába, ami végigkísért tanulmányaim során. Pontosan még nem találtam meg mit szeretnék csinálni, de nyitott vagyok az új kihívásokra, technológiákra és tudom hogy megtalálom a számomra legmegfelelőbb területet. A sport mindig része volt az életemnek és úgy gondolom az ott tanultakat, tapasztaltakat kamatoztatni tudom az informatika területén is. Boldogan kezdek bele új projektekbe és igyekszem mindezt csapatban tenni.</p>
	</div>
</div>
	

	<nav id="mobile-menu">
        <ul>
			<?php if(isset($_COOKIE["felhasznalonev"])): ?>
				<li><a href="logout.php?logout=1">Kijelentkezés</a></li>
				<li class="menu_li"><a href="profil.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">Profilom</a></li>
			<?php endif; ?>
			<li><a href="index.php">Főoldal</a></li>
        </ul>
    </nav>
	
	
<div id="footer" class="footer"><span>SportMatch©</span></div>
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
	
const footer = document.getElementById('footer');
const windowHeight = window.innerHeight;
const documentHeight = document.body.clientHeight;

window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop + windowHeight >= documentHeight) {
        footer.style.display = 'block';
    } else {
        footer.style.display = 'none';
    }
}, false);
</script>
</html>
