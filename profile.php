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
    require "config.php";
    
    $userId = isset($_GET['userid']) ? strval($_GET['userid']) : "0";

    if (!is_numeric($userId) && !empty($userId)) {
        echo "Érvényes felhasználó azonosító.";
    } else {
        echo "Érvénytelen felhasználó azonosító.";
    }

    $query = "SELECT * FROM users WHERE id = '$userId' OR firstname = '$userId'";
    $result = $conn->query($query);

    if (!empty($result) && $result->num_rows > 0) {
        $userData = $result->fetch_assoc();
    } else {
        echo "Nincs ilyen felhasználó.";
    }
    ?>
    <br><br><br>
<section>
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
    <div class="row"  id="sportbg">
        <div class="col-lg-4 paddingtop">
            <div class="card mb-4">
                <div class="card-body text-center">
                <?php if ($userData['nem'] === 'Férfi'): ?> 
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                        alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    <?php else: ?>
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava4.webp"
                        alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    <?php endif; ?>
                    <h5 class="my-3"><?= $userData['lastname'] ?> <?= $userData['firstname'] ?></h5>
                    <p class="text-muted mb-1"><?= $userData['age'] != 0 ? $userData['age'] : "Nincs megadva kor" ?></p>
                    <p class="text-muted mb-4"><?= $userData['city'] ?></p>
                </div>
            </div>
            <div class="card mb-4 mb-lg-0">
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush rounded-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <p class="mb-0">Kedvenc sportok:</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <p class="mb-0"><?= $userData['sport1'] ?></p>
                            <p class="mb-0"><?= $userData['sport2'] ?></p>
                            <p class="mb-0"><?= $userData['sport3'] ?></p>
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
                            <p class="text-muted mb-0"><?= $userData['lastname'] ?></p>
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
                            <p class="text-muted mb-0"><?= $userData['firstname'] ?></p>
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
                            <p class="text-muted mb-0"><?= $userData['city'] ?></p>
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
                            <p class="text-muted mb-0"><?= $userData['nem'] ?></p>
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
                            <?php if ($userData['age'] != 0): ?>
                                <p class="text-muted mb-0"><?= $userData['age'] ?></p>
                            <?php else: ?>
                                <p class="text-muted mb-0">Nincs megadva kor</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br>
        </div>
    </div>
</section>

<nav id="mobile-menu">
    <ul>
        <li><a href="index.php?userid=<?= $_COOKIE["felhasznalonev"] ?>">Főoldal</a></li>
        <li class="menu_li"><a href="rooms.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">Szobák</a></li>
        <li><a href="logout.php?logout=1">Kijelentkezés</a></li>
    </ul>
</nav>

<div class="footer"><span>SportMatch©</span></div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


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

</body>
</html>
