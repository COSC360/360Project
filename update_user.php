<?php
session_start();
include 'connection.php';

if (isset($_SESSION['u_id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['u_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $profile_bio = $_POST['bio'];

    $target_dir = "./uploads/profile_pics/";
    $target_file = $target_dir . basename($_FILES["user_images"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["user_images"]["tmp_name"]);
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
            echo "The file ". htmlspecialchars( basename( $_FILES["user_images"]["name"])). " has been uploaded.";
            $userImage = basename($_FILES["user_images"]["name"]);
            chmod($target_file, 0777);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // check if user has uploaded a new image
    if (isset($userImage)) {
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
