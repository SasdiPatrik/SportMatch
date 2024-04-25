<?php
require 'config.php';

if (isset($_COOKIE['email'])) {
    $email = $conn->real_escape_string($_COOKIE['email']);

    $user_query = "SELECT * FROM users WHERE email = '$email'";
    $user_result = $conn->query($user_query);

    if ($user_result->num_rows > 0) {
        $user = $user_result->fetch_assoc();

        if (isset($_POST["message"]) && isset($_POST["roomid"])) {
            $messageText = $conn->real_escape_string($_POST["message"]);
            $roomid = $conn->real_escape_string($_POST["roomid"]);
            $userId = $user["id"];

            $insert_query = "INSERT INTO room_messages (sender_id, room_id, content) VALUES ('$userId', '$roomid', '$messageText')";

            if ($conn->query($insert_query)) {
                echo "success";
            } else {
                echo "error: " . $conn->error;
            }
        }
    }
}
?>
