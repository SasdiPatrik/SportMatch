<?php
require 'config.php';

if (isset($_GET['roomid'])) {
    $roomId = $_GET['roomid'];

    if (!isset($_COOKIE['email'])) {
        echo "Hiba: Bejelentkezett felhasználó szükséges.";
        header("Location: profil.php");
        exit;
    }

    $loggedInUserEmail = $conn->real_escape_string($_COOKIE['email']);
    $ellenorzes_lekerdezes = "SELECT * FROM rooms WHERE id = $roomId AND creator = '$loggedInUserEmail'";
    $ellenorzes_eredmeny = $conn->query($ellenorzes_lekerdezes);

    if ($ellenorzes_eredmeny->num_rows === 0) {
        echo "Hiba: Nincs jogosultság a szoba törléséhez.";
        header("Location: profil.php");
        exit;
    }

    $deleteQuery = "DELETE FROM rooms WHERE id = $roomId";

    if ($conn->query($deleteQuery) === TRUE) {
        echo "A szoba sikeresen törölve.";
    } else {
        echo "Hiba a szoba törlése során: " . $conn->error;
    }

    header("Location: profil.php?userid=" . $_COOKIE['felhasznalonev']);
    exit;
} else {
    echo "Hiba: Hiányzó vagy érvénytelen roomid paraméter.";
    header("Location: profil.php?userid=" . $_COOKIE['felhasznalonev']);
    exit;
}
?>
