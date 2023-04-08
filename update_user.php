<?php
session_start();
include 'connection.php';

if (isset($_SESSION['u_id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['u_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $profile_bio = $_POST['bio'];

    $target_dir = "/home/wmeyer/public_html/360Project/uploads/profile_pics";
    $target_file = $target_dir . basename($_FILES["user_images"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["user_images"]["topic_title"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    if ($_FILES["user_images"]["size"] > 100000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["user_images"]["tmp_name"], $target_file)) {
            $userImage = basename($_FILES["user_images"]["name"]);
            chmod($target_file, 0777);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


    if (isset($userImage)) {
    $content_type = $_FILES['user_images']['type'];
    $stmt = $conn->prepare("SELECT * FROM user_images WHERE u_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE user_images SET images = ?, contentType = ? WHERE u_id = ?");
        $stmt->bind_param('ssi', $userImage, $content_type, $user_id);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("INSERT INTO user_images (u_id, images, contentType) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $user_id, $userImage, $content_type);
        $stmt->execute();
    }
        $imagedata = file_get_contents($target_file);
        
        $sql = "UPDATE user_images SET contentType=?, images=? WHERE u_id=?";
        
        $stmt = mysqli_stmt_init($conn); 
        mysqli_stmt_prepare($stmt, $sql);
    
        $null = NULL;

        mysqli_stmt_bind_param($stmt, "sbi", $imageFileType, $null, $user_id);
        mysqli_stmt_send_long_data($stmt, 1, $imagedata);

        $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
        
        mysqli_stmt_close($stmt); 

        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, profile_bio = ? WHERE u_id = ?");
        $stmt->bind_param('sssi', $username, $email, $profile_bio, $user_id);
        $result = $stmt->execute();

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        mysqli_close($conn);
        exit;
    } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
        echo "Invalid request.";
        exit;
    } else {
        echo "Invalid request.";
        mysqli_close($conn);
        exit;
    }
}
?>
