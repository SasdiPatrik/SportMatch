<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["request_id"])) {
        $request_id = $_GET["request_id"];
        $accept = $_GET["accept"];

        $status = ($accept === 'true') ? 'accepted' : 'rejected';

        $update_request_query = "UPDATE room_requests SET status = '$status' WHERE request_id = $request_id";

        if ($conn->query($update_request_query)) {
            if ($status === 'accepted') 
            {
                $room_query = "SELECT room_id, creator_email FROM room_requests WHERE request_id = $request_id";
                $room_result = $conn->query($room_query);

                if ($room_result && $room_result->num_rows > 0) {
                    $room_data = $room_result->fetch_assoc();
                    $room_id = $room_data['room_id'];
                    $room_creator_email = $room_data['creator_email'];
                    
                    
                    $user_email = substr($_COOKIE['requested_user_email'.$_GET['index']],0,strlen($_COOKIE['requested_user_email'.$_GET['index']])-1);

                    $get_user_id_query = "SELECT id FROM users WHERE email = '$user_email'";
                    
                    $result = $conn->query($get_user_id_query);
                    
                    if ($result !== false && $result->num_rows > 0) {
                        $user_data = $result->fetch_assoc();
                        $user_id = $user_data['id'];
                    
                        $add_user_query = "INSERT INTO users_in_room (user_id, room_id, joined_at, room_creator_email) VALUES ($user_id, $room_id, current_timestamp(), '$room_creator_email')";
                        $conn->query($add_user_query);

                        setcookie('requested_user_email', '', time(), '/');
                        header("Location: profil.php?userid=". $_COOKIE['felhasznalonev']);
                        exit();
                    }

                }
            } else {
                header("Location: profil.php?userid=". $_COOKIE['felhasznalonev']);
            }
        }
         else {
            echo "error";
        }
    } else {
        echo "invalid request";
    }
} else {
    echo "invalid request method";
}
?>
