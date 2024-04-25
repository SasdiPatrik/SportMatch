<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex">
    <link rel="shortcut icon" href="imgs/faviconn.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <link rel="stylesheet" href="assets/css/room-style.css">
    <title>SportMatch</title>
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
    </nav><br><br><br><br>

    <div class="container">

    <?php
    require "config.php";

    if (isset($_GET['roomid'])) {
        $roomid = $_GET['roomid'];

        $lekerdezes_szoba = "SELECT * FROM rooms WHERE id = $roomid";
        $talalt_szoba = $conn->query($lekerdezes_szoba);

        if ($talalt_szoba->num_rows > 0) {
            $szoba = $talalt_szoba->fetch_assoc();

            echo "<h1>{$szoba['name']}</h1>";
            echo "<h2>Helyszín: {$szoba['hely']}</h2>";

            $creator_email = $szoba['creator'];
            $lekerdezes_creator = "SELECT * FROM users WHERE email = '$creator_email'";
            $talalt_creator = $conn->query($lekerdezes_creator);

            if ($talalt_creator->num_rows > 0) {
                $creator = $talalt_creator->fetch_assoc();
                echo "<div class='row'>";
                echo "<div class='col-md-3 tagok'>";
                echo "<p>Tagok:</p>";
                echo "<p>Létrehozó: <a href='profile.php?userid={$creator['id']}'>{$creator['lastname']} {$creator['firstname']}</a></p>";

                $user_email = $_COOKIE["email"];
                $is_in_room_query = "SELECT * FROM users_in_room WHERE user_id = (SELECT id FROM users WHERE email = '$user_email') AND room_id = '$roomid'";
                $is_in_room_result = $conn->query($is_in_room_query);

                if ($szoba['type'] === 'Privát' && $is_in_room_result->num_rows === 0 && $szoba['creator'] != $user_email) {
                    echo "<div class='tagok'>";
                    echo "<ul>";
                    echo "Ez a szoba privát!<br>Csak csatlakozás után láthatod a tagokat.";
                    echo "</ul>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    $lekerdezes_felhasznalok = "
                    SELECT u.id, u.firstname, u.lastname
                    FROM users_in_room uir
                    JOIN users u ON uir.user_id = u.id
                    WHERE uir.room_id = $roomid";

                    $talalt_felhasznalok = $conn->query($lekerdezes_felhasznalok);

                    if ($talalt_felhasznalok->num_rows > 0) {
                        echo "<div class='tagok'>";
                        echo "<ul>";
                        while ($felhasznalo = $talalt_felhasznalok->fetch_assoc()) {
                            echo "<li><a href='profile.php?userid={$felhasznalo['id']}'>{$felhasznalo['lastname']} {$felhasznalo['firstname']}</a></li>";

                            if ($szoba['creator'] == $user_email) {
                                echo "<form method='post' action='room.php?roomid={$roomid}'>";
                                echo "<input type='hidden' name='kick_user_id' value='{$felhasznalo['id']}'>";
                                echo "<button type='submit' class='kick-btn' name='kick_user'>Kirúgás</button>";
                                echo "</form>";
                            }
                        }
                        echo "</ul>";
                        echo "</div>";
                        echo "</div>";
                    } else {
                        echo "<p>Nincsenek csatlakozott tagok.</p>";
                        echo "</div>";
                    }
                }
            }
        } else {
            echo "Nincs ilyen szoba!";
        }
    } else {
        echo "Hibás vagy hiányzó paraméter az URL-ben!";
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_COOKIE["email"])) {
            if (isset($_POST['join_room'])) {
            $room_id = $_POST["room_id"];
            $user_email = $_COOKIE["email"];

            $check_query = "SELECT * FROM users_in_room WHERE user_id = (SELECT id FROM users WHERE email = '$user_email') AND room_id = $room_id";
            $check_result = $conn->query($check_query);
    
            if ($check_result->num_rows == 0) {
                $insert_query = "INSERT INTO users_in_room (user_id, room_id, room_creator_email) VALUES ((SELECT id FROM users WHERE email = '$user_email'), $room_id, (SELECT creator FROM rooms WHERE id = $room_id))";
                    if ($szoba['type'] === 'Privát' && $is_in_room_result->num_rows === 0 && $szoba['creator'] != $user_email) {
                        $user_firstname = $_COOKIE['felhasznalonev'];
                        $user_lastname = $_COOKIE['vezeteknev'];
                        $creator_id = $creator['id'];

                        $send_request_query = "
                            INSERT INTO room_requests (room_id, room_name, room_location, creator_email, user_email, user_firstname, user_lastname)
                            SELECT r.id, r.name, r.hely, r.creator, ?, ?, ?
                            FROM rooms r
                            WHERE r.id = ?";

                        $stmt = $conn->prepare($send_request_query);
                        $stmt->bind_param("sssi", $user_email, $user_firstname, $user_lastname, $room_id);


                        if ($stmt->execute()) {
                            echo "<script>alert('Kérés elküldve a szoba létrehozójának')</script>";
                        } else {
                            echo "<script>alert('Hiba a kérés elküldésekor: " . $stmt->error . "')</script>";
                        }

                        $stmt->close();
                        } else if ($conn->query($insert_query)) {
                            if (isset($_GET['roomid'])){
                                header("Location: room.php?roomid=".$_GET['roomid']);
                            }else{
                                header("Location: room.php");
                            }
                        } else {
                            echo "<script>alert('Hiba a szobához való csatlakozás közben ')</script>" . $conn->error;
                        }
            }
        }
        } else {
            echo "<script>alert('Hibás kérés')</script>";
        }
    

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["room_id"]) && isset($_COOKIE["email"])) {
                if (isset($_POST['leave_room']) && $_POST['leave_room'] === 'true') {
                    $delete_query = "DELETE FROM users_in_room WHERE user_id = (SELECT id FROM users WHERE email = '$user_email') AND room_id = $szoba[id]";
            if ($conn->query($delete_query)) {
                if (isset($_GET['roomid'])){
                    header("Location: room.php?roomid=".$_GET['roomid']);
                }else{
                    header("Location: room.php");
                }
            } else {
                echo "<script>alert('Hiba a kilépés közben ')</script>" . $conn->error;
            }
                }
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
            if (isset($_POST["kick_user"])) {
                $user_to_kick_id = $_POST["kick_user_id"];

                $is_creator_query = "SELECT creator FROM rooms WHERE id = $roomid AND creator = '$user_email'";
                $is_creator_result = $conn->query($is_creator_query);
        
                if ($is_creator_result->num_rows > 0) {
                    $delete_user_query = "DELETE FROM users_in_room WHERE user_id = $user_to_kick_id AND room_id = $roomid";
        
                    if ($conn->query($delete_user_query)) {
                        echo "<script>alert('Felhasználó sikeresen kirúgva a szobából')</script>";
                    } else {
                        echo "<script>alert('Hiba a felhasználó kirúgása közben')</script>" . $conn->error;
                    }
                } else {
                    echo "<script>alert('Nincs jogosultságod a kirúgásra')</script>";
                }
            }
        
        }
    

    }

    if (isset($_POST["save_description"])) {
        $new_description = $_POST["description"];
        if ($new_description == substr($new_description, 0, 200)) {
            $update_query = "UPDATE rooms SET description = '$new_description' WHERE id = $szoba[id]";
            if ($conn->query($update_query)) {
                if (isset($_GET['roomid'])){
                    header("Location: room.php?roomid=".$_GET['roomid']);
                }else{
                    header("Location: room.php");
                }
            } else {
                echo "<script>alert('Hiba a leírás frissítésekor')</script>" . $conn->error;
            }
        } else {
            echo "<script>alert('A leírás maximum 150 karakter hosszú lehet')</script>";
        }
    }

    ?>

<div class="col-md-6 chat">
            <div class="chat">
                <div class="card" id="chat1" style="border-radius: 15px;">
                    <div class="card-header d-flex justify-content-between align-items-center p-3 bg-info text-white border-bottom-0" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <i class="fas fa-angle-left"></i>
                        <p class="mb-0 fw-bold" style="color: white">Chat</p>
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="card-body">

                    <?php
                        $loggedInUsername = isset($_COOKIE['felhasznalonev']) ? $_COOKIE['felhasznalonev'] : '';

                        $query = "SELECT rm.*, u.lastname, u.firstname FROM room_messages rm 
                                LEFT JOIN users u ON rm.sender_id = u.id
                                WHERE room_id = $roomid ORDER BY timestamp ASC";

                        $result = $conn->query($query);

                        $user_email = $_COOKIE["email"];
                        $is_creator_query = "SELECT creator FROM rooms WHERE id = $roomid AND creator = '$user_email'";
                        $is_creator_result = $conn->query($is_creator_query);

                        $is_in_room_query = "SELECT * FROM users_in_room WHERE user_id = (SELECT id FROM users WHERE email = '$user_email') AND room_id = '$roomid'";
                        $is_in_room_result = $conn->query($is_in_room_query);

                        if ($is_creator_result->num_rows > 0 || $is_in_room_result->num_rows > 0) {

                        echo '<ul id="messageList">';

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $isCurrentUser = ($row['sender_id'] == $_COOKIE['felhasznalonev']);

                                echo "<div class='d-flex flex-row justify-content-" . ($isCurrentUser ? 'start' : 'end') . " mb-4'>";
                                
                                echo "<div class='p-3 " . ($isCurrentUser ? 'ms-3' : 'me-3') . " border' style='border-radius: 15px; background-color: " . ($isCurrentUser ? 'rgba(57, 192, 237,.2)' : '#fbfbfb') . ";'>";
                                echo "<p class='small mb-0'><strong>{$row['firstname']} {$row['lastname']}:</strong> {$row['content']}</p>";
                                echo "</div>";
                                
                                echo "</div>";
                            }
                            
                        } else {
                            echo "Nincsenek üzenetek";
                        }

                        echo '</ul>';
                        echo '<div class="form-outline">
                                <textarea class="form-control" id="messageInput" rows="4"></textarea>
                                <label class="form-label" for="messageInput"></label>
                            </div>
                            <button type="button" onclick="sendMessage()">Küldés</button>';
                        } else {
                            echo "A Chat üzeneteit csatlakozás után fogod látni";
                            echo '<div class="form-outline">
                                    <textarea class="form-control" id="messageInput" rows="4" disabled></textarea>
                                    <label class="form-label" for="messageInput"></label>
                                </div>';
                        }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-3 info">
            <div class="informacio">
                <?php
                if ($szoba['creator'] === $user_email) {
                    echo "<p>Szoba leírása:<br><br> {$szoba['description']}</p>";
                    echo "<form method='post' action='room.php?roomid={$szoba['id']}'>";
                    echo "<textarea name='description' placeholder='Leírás'></textarea>";
                    echo "<input type='hidden' name='room_id' value='{$szoba['id']}'>"; // Új sor a room_id átviteléhez
                    echo "<button type='submit' class='descbtn' name='save_description'>Mentés</button>";
                    echo "</form>";
                } else {
                    echo "$szoba[description]";
                    if ($szoba['description'] === "") {
                        echo "Nincs elérhető leírás a szobáról";
                    }
                }
                ?>
            </div>
        </div>

</div>

<div class="gomb">
    <form method="post" action="room.php?roomid=<?= $roomid; ?>">
        <input type="hidden" name="room_id" value="<?= $roomid; ?>">
        <?php
        $user_email = $_COOKIE["email"];
        $is_creator_query = "SELECT creator FROM rooms WHERE id = $roomid AND creator = '$user_email'";
        $is_creator_result = $conn->query($is_creator_query);

        $is_in_room_query = "SELECT * FROM users_in_room WHERE user_id = (SELECT id FROM users WHERE email = '$user_email') AND room_id = '$roomid'";
        $is_in_room_result = $conn->query($is_in_room_query);

        $lekerdezes_csatlakozottak_szama = "SELECT COUNT(*) as count FROM users_in_room WHERE room_id = $roomid";
        $talalt_csatlakozottak_szama = $conn->query($lekerdezes_csatlakozottak_szama);
 
        if ($talalt_csatlakozottak_szama->num_rows > 0) {
            $csatlakozottak_szama = $talalt_csatlakozottak_szama->fetch_assoc()['count'];
        
            if ($csatlakozottak_szama <= 30) {
                // Ha a felhasználó még nem csatlakozott a szobához
                if ($szoba['creator'] !== $user_email) {
					
					        // Kilépés a szobából gomb megjelenítése, ha a felhasználó már bent van a szobában
						if ($is_in_room_result->num_rows > 0) {
							echo '
							<form method="post" action="room.php?roomid=' . $szoba['id'] . '">
								<input type="hidden" name="room_id" value="' . $szoba['id'] . '">
								<button type="submit" class="bekibtn" name="leave_room" value="true">Kilépés a szobából</button>
							</form>';
						}else{
						// Ellenőrizze, van-e már elfogadott vagy függőben lévő kérelem a felhasználótól a szobához
						$is_pending_or_accepted_query = "SELECT COUNT(*) as count FROM room_requests WHERE user_email = '$user_email' AND room_id = $roomid AND (status = 'pending')";
						$is_pending_or_accepted_result = $conn->query($is_pending_or_accepted_query);
						$pending_or_accepted_count = $is_pending_or_accepted_result->fetch_assoc()['count'];

						if ($pending_or_accepted_count <= 0) {
							// Ha a felhasználó még nem küldött kérelmet, vagy mindegyik kérelme már elutasításra került
							echo '<button type="submit" class="bekibtn" name="join_room">Belépés a szobába</button>';
						}
					}
                }
            } else {
                echo '<p>A szoba már tele van, nem tudsz csatlakozni.</p>';
            }
        }
        ?>
    </form>
</div>
<br><br><br>
</div>
    <nav id="mobile-menu">
        <ul class="menu_ul">
            <li class="menu_li"><a href="index.php?userid=<?= $_COOKIE["felhasznalonev"] ?>">Főoldal</a></li>
            <li class="menu_li"><a href="rooms.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">Szobák</a></li>
            <li class="menu_li"><a href="profil.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">Profilom</a></li>
            <li class="menu_li"><a href="logout.php?logout=1">Kijelentkezés</a></li>
        </ul>
    </nav>
    
    <div class="footer"><span>SportMatch©</span></div>

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

    function sendMessage() {
    var messageInput = document.getElementById("messageInput");
    var messageList = document.getElementById("messageList");

    var messageText = messageInput.value;

    if (messageText.trim() !== "") {
        var newMessage = document.createElement("div");
        newMessage.className = "d-flex flex-row justify-content-end mb-4";

        var messageContent = document.createElement("div");
        messageContent.className = "p-3 me-3 border";
        messageContent.style.borderRadius = "15px";
        messageContent.style.backgroundColor = "#fbfbfb";
        messageContent.innerHTML = "<p class='small mb-0'>" + messageText + "</p>";

        var avatar = document.createElement("img");

        newMessage.appendChild(messageContent);
        newMessage.appendChild(avatar);

        messageList.appendChild(newMessage);

        messageInput.value = "";

        saveMessageToDatabase(messageText);
    }
    window.location.reload();
}


function saveMessageToDatabase(messageText) {
    $.post("save_message.php", { message: messageText, roomid: <?php echo $roomid; ?> })
        .done(function (data) {
            if (data === "success") {
                console.log("Üzenet sikeresen mentve az adatbázisba");
            } else {
                console.error("Hiba az üzenet mentésekor az adatbázisba");
            }
        })
        .fail(function (error) {
            console.error("AJAX hiba", error);
        });
}
function scrollToBottom() {
    var chatContent = document.querySelector("#messageList");
    chatContent.scrollTop = chatContent.scrollHeight;
}

function appendMessage(message) {
    var messageList = document.getElementById("messageList");
    var newMessage = document.createElement("div");
    newMessage.className = "message";
    newMessage.textContent = message;
    messageList.appendChild(newMessage);
}

window.onload = scrollToBottom;


</script>

</body>
</html>
