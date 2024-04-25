<!DOCTYPE html>
<html lang="hu">

<head>
    <title>SportMatch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex">
    <link rel="shortcut icon" href="imgs/faviconn.png">
    <link rel="stylesheet" href="assets/css/roompage-style.css">
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
            <li><a href="logout.php?logout=1" class="menu-right">Kijelentkezés</a></li>
            <li class="menu_li"><a href="profil.php?userid=<?= $_COOKIE['felhasznalonev'] ?>" class="menu-right">Profilom</a></li>
            <li><a href="index.php?userid=<?= $_COOKIE["felhasznalonev"] ?>" class="menu-right">Főoldal</a></li>
        </ul>
    </nav>

    <div id="szobak">
        <div class="newroom">
            <div>
                <a href="addroom.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">
                    <div class="room-card pop-out-card with-transform" onclick="openNewRoom()">
                            <div class="about-room">
                                <p class="ujszoba">Új szoba létrehozása</p>
                            </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="inner-box">
        <h2 style="text-align: center; color: white;">Szobák</h2>


            <div class="rooms-box">
            <?php
            $loggedInUserEmail = $_COOKIE['email'];

            $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'id';
            $allowedOrderBy = ['id', 'name', 'sport'];

            if (!in_array($orderBy, $allowedOrderBy)) {
                $orderBy = 'id';
            }

            $lekerdezes = "SELECT * FROM rooms ORDER BY 
                CASE 
                    WHEN sport = (SELECT sport1 FROM users WHERE email = '$loggedInUserEmail') 
                        OR sport = (SELECT sport2 FROM users WHERE email = '$loggedInUserEmail') 
                        OR sport = (SELECT sport3 FROM users WHERE email = '$loggedInUserEmail')
                    THEN 0 
                    ELSE 1 
                END, sport, $orderBy";

            $talalt_szoba = $conn->query($lekerdezes);

            while ($szoba = $talalt_szoba->fetch_assoc()) {
                ?>
                    <div class="room-frame">
                            <div class="room-card pop-out-card with-transform" onclick="openRoom(<?= $szoba['id']; ?>)">
                                <div class="about-room">
                                    <p class="room-name"><?= $szoba['name']; ?></p>
                                    <p class="room-location">Helyszín: <?= $szoba['hely']; ?></p>
                                    <p class="room-location">Típus: <?= $szoba['type']; ?></p>
                                    <p class="room-location" >Sportág: <?= $szoba['sport']; ?></p>
                                </div>
                            </div>
                    </div>
            <?php } ?>
        </div>

        </div>
    </div>

    <nav id="mobile-menu">
        <ul>
            <li><a href="index.php?userid=<?= $_COOKIE["felhasznalonev"] ?>">Főoldal</a></li>
            <li class="menu_li"><a href="profil.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">Profilom</a></li>
            <li><a href="logout.php?logout=1">Kijelentkezés</a></li>
        </ul>
    </nav>

    <div class="footer"><span>SportMatch©</span></div>
</body>
<script>
    $(document).ready(function () {
        $('.room-frame').each(function (index) {
            $(this).delay(300 * index).fadeIn(800);
        });
    });
	function openRoom(roomId) {
    var roomUrl = 'room.php?roomid=' + roomId;
    window.location.href = roomUrl;
}
function openNewRoom() {
        var userId = "<?php echo $_COOKIE['felhasznalonev']; ?>";
        window.location.href = "addroom.php?userid=" + userId;
    }

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
