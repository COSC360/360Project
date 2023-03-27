<?php
session_start();
header('Content-Type: application/json');
include 'connection.php';

if (isset($_SESSION['u_id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['u_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $profile_bio = $_POST['bio'];

    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['size'] > 0) {
        $target_dir = "./uploads/profile_pics/";

        if (!file_exists($target_dir)) {
            if (!mkdir($target_dir, 0777, true)) {
                echo json_encode(['success' => false, 'message' => 'Failed to create directory.']);
                exit;
            }
        }
        $file_name = uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $file_name;

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                $stmt = $conn->prepare("UPDATE users SET profile_pic = ? WHERE u_id = ?");
                $stmt->bind_param('si', $target_file, $user_id);
                $stmt->execute();
            } else {
                echo json_encode(['success' => false, 'message' => 'Sorry, there was an error uploading your file.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Sorry, your file was not uploaded.']);
        }
    }

    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, profile_bio = ? WHERE u_id = ?");
    $stmt->bind_param('sssi', $username, $email, $profile_bio, $user_id);
    $result = $stmt->execute();

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
