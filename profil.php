<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex">
    <link rel="shortcut icon" href="imgs/faviconn.png">
    <title>Profil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/profil.css">
</head>

<body>
    <?php
    require 'config.php';

    if (isset($_COOKIE['email'])) {
        $email = $conn->real_escape_string($_COOKIE['email']);

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
    ?>

    <nav id="nav-box">
        <ul>
            <li><img class="menu-left" src="imgs/kepppp.png" alt="logo" width="150" height="70"></li>
            <li class="menu-toggle">
                <a href="#" class="menu-icon">&#9776;</a>
            </li>
            <li><a href="logout.php?logout=1" class="menu-right">Kijelentkezés</a></li>
            <li class="menu_li"><a href="rooms.php?userid=<?= $_COOKIE['felhasznalonev'] ?>" class="menu-right">Szobák</a></li>
            <li><a href="index.php?userid=<?= $_COOKIE["felhasznalonev"] ?>" class="menu-right">Főoldal</a></li>
        </ul>
    </nav><br><br>
            <section class>
            <div class="row">
                        
                <div class="container py-5">
                <?php
                $user_email = $_COOKIE['email'];

                $pending_requests_query = "SELECT * FROM room_requests WHERE creator_email = '$user_email' AND status = 'pending'";
                $pending_requests_result = $conn->query($pending_requests_query);

                if ($pending_requests_result !== false) {
                    if ($pending_requests_result->num_rows > 0) {
                        echo '<h3 style="color: white;">Értesítés</h3>';
                        echo '<ul>';
                        $index = 0;
                        while ($request = $pending_requests_result->fetch_assoc()) {
                            $index++;
                            echo '<li>';
                            echo "<a href='profile.php?userid={$request['user_firstname']}'>{$request['user_lastname']}  {$request['user_firstname']}</a> szeretne csatlakozni a(z) {$request['room_name']} szobához ({$request['room_location']}) ";

                            setcookie('requested_user_email'.$index, $request['user_email'].$index , time() + 3600, '/');

                            echo '<button onclick="room_request(' . $request['request_id'] . ', true, '.$index.')">Elfogad</button>';

                            echo '<button onclick="room_request(' . $request['request_id'] . ', false,'.$index.')">Elutasít</button>';
                            
                            echo '</li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '';
                    }
                } else {

                    echo "Hiba a lekérdezés során: " . $conn->error;
                }
                ?>
                    <div class="row"  id="sportbg">
                        <div class="col-lg-4 paddingtop">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                <?php if ($user['nem'] === 'Férfi'): ?> 
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                        alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                <?php else: ?>
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava4.webp"
                                        alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                <?php endif; ?>
                                    <h5 class="my-3"><?= $user['lastname'] ?> <?= $user['firstname'] ?></h5>
                                    <p class="text-muted mb-1"><?= $user['age'] != 0 ? $user['age'] : "Nincs megadva kor" ?></p>
                                    <p class="text-muted mb-4"><?= $user['city'] ?></p>
                                    <div class="d-flex justify-content-center mb-2">
                                        <a href="bovit.php?userid=<?= $_COOKIE['felhasznalonev'] ?>"><button type="button" class="btn btn-purple">Profil szerkesztése</button></a>
                                    </div>
                                    <div class="d-flex justify-content-center mb-1">
                                        <a href="passchange.php?userid=<?= $_COOKIE['felhasznalonev'] ?>"><button type="button" class="btn btn-purple">Jelszó megváltoztatása</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4 mb-lg-0">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush rounded-3">
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <p class="mb-0">Kedvenc sportok:</p>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <p class="mb-0"><?= $user['sport1'] ?></p>
                                            <p class="mb-0"><?= $user['sport2'] ?></p>
                                            <p class="mb-0"><?= $user['sport3'] ?></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 paddingtop">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Vezetéknév</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?= $user['lastname'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Keresztnév</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?= $user['firstname'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?= $user['email'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="card mb-4">
								<div class="card-body">
									<div class="row">
										<div class="col-sm-3">
											<p class="mb-0">Város</p>
										</div>
										<div class="col-sm-9">
											<p class="text-muted mb-0"><?= $user['city'] ?></p>
										</div>
									</div>
								</div>
							</div>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Nem</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?= $user['nem'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Kor</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <?php if ($user['age'] != 0): ?>
                                                <p class="text-muted mb-0"><?= $user['age'] ?></p>
                                            <?php else: ?>
                                                <p class="text-muted mb-0">Nincs megadva kor</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="inner-box">
    <?php
    $bejelentkezett_email = $conn->real_escape_string($_COOKIE['email']);
    
    $ellenorzes_lekerdezes = "SELECT COUNT(*) as count FROM rooms WHERE creator = '$bejelentkezett_email'";
    $ellenorzes_talalat = $conn->query($ellenorzes_lekerdezes);
    $row = $ellenorzes_talalat->fetch_assoc();
    $letrehozott_szobak_szama = $row['count'];

    if ($letrehozott_szobak_szama > 0) {
    ?>
        <h2 style="text-align: center">Létrehozott szobák</h2>
        <div class="items-box">
            <?php
            $lekerdezes = "SELECT * FROM rooms WHERE creator = '$bejelentkezett_email'";
            $talalt_szoba = $conn->query($lekerdezes);

            while($szoba = $talalt_szoba->fetch_assoc()){
            ?>
                <div class="item-frame">
                    <div class="item-card">
                        <div class="about-item">
                            <a class="item-name"><?= $szoba['name']; ?></a><br>
                            <a class="item-sizes">Helyszín: <?= $szoba['hely']; ?></a><br><br>
							<button type="button" class="btn btn-link" onclick="seeRoom('<?= $szoba['id']; ?>')">Szoba megtekintése</button>
                            <button type="button" class="btn btn-link" onclick="confirmDelete('<?= $szoba['id']; ?>')">Szoba törlése</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
    <?php } ?>
</div>
    <div class="inner-box">
        <?php
        $bejelentkezett_email = $conn->real_escape_string($_COOKIE['email']);
        
        $ellenorzes_lekerdezes = "SELECT COUNT(*) as count FROM users_in_room WHERE user_id = (SELECT id FROM users WHERE email = '$bejelentkezett_email')";
        $ellenorzes_talalat = $conn->query($ellenorzes_lekerdezes);
        $row = $ellenorzes_talalat->fetch_assoc();
        $csatlakozott_szobak_szama = $row['count'];
        if ($csatlakozott_szobak_szama > 0) {
        ?>
            <h2 style="text-align: center">Csatlakozott szobák</h2>
            <div class="items-box">
                <?php
                $lekerdezes = "SELECT r.* FROM rooms r
                            JOIN users_in_room uir ON r.id = uir.room_id
                            WHERE uir.user_id = (SELECT id FROM users WHERE email = '$bejelentkezett_email')";
                $talalt_szoba = $conn->query($lekerdezes);
                while($szoba = $talalt_szoba->fetch_assoc()){
                ?>
                    <div class="item-frame">
                        <div class="item-card">
                            <div class="about-item">
                                <a class="item-name"><?= $szoba['name']; ?></a><br>
                                <a class="item-sizes">Helyszín: <?= $szoba['hely']; ?></a><br><br>
								<button type="button" class="btn btn-link" onclick="seeRoom('<?= $szoba['id']; ?>')">Szoba megtekintése</button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
        <?php } ?>
    </div>
        <br><br>
    </section>
    <?php
        } else {
            echo "Hiba: Felhasználó nem található.";
        }
    } else {
        echo "Hiba: Hiányzó e-mail cím a cookie-ban.";
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <nav id="mobile-menu">
        <ul>
            <li><a href="index.php?userid=<?= $_COOKIE["felhasznalonev"] ?>">Főoldal</a></li>
            <li class="menu_li"><a href="rooms.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">Szobák</a></li>
            <li><a href="logout.php?logout=1">Kijelentkezés</a></li>
        </ul>
    </nav>

    <div class="footer"><span>SportMatch©</span></div>
    
    <script>
    document.querySelector('.menu-toggle').addEventListener('click', function () {
        this.classList.toggle('active');
        var dropdownMenu = document.getElementById('dropdownMenu');

        if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
            dropdownMenu.style.display = 'block';
        } else {
            dropdownMenu.style.display = 'none';
        }
    });
	
	function seeRoom(roomId) {
            window.location.href = "room.php?roomid=" + roomId;
    }

    function confirmDelete(roomId) {
        var result = confirm("Biztosan törölni szeretnéd a szobát?");
        if (result) {
            window.location.href = "delete_room.php?roomid=" + roomId;
        }
    }


    function room_request(requestId, accept, index) {
        window.location.href = 'room_request.php?request_id=' + requestId + '&accept=' + accept + '&index='+index;
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

</body>
</html>
