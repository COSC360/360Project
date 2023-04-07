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
        
        //store the contents of the files in memory in preparation for upload
        $sql = "UPDATE user_images SET contentType=?, images=? WHERE u_id=?";
        // create a new statement to update the image in the table. Recall
        // that the ? is a placeholder to variable data.
        $stmt = mysqli_stmt_init($conn); //init prepared statement object
    
        mysqli_stmt_prepare($stmt, $sql); // register the query
    
        $null = NULL;
        mysqli_stmt_bind_param($stmt, "sbi", $imageFileType, $null, $user_id);
        // bind the variable data into the prepared statement. You could replace
        // $null with $data here and it also works. You can review the details
        // of this function on php.net. The second argument defines the type of
        // data being bound followed by the variable list. In the case of the
        // blob, you cannot bind it directly so NULL is used as a placeholder.
        // Notice that the parametner $imageFileType (which you created previously)
        // is also stored in the table. This is important as the file type is
        // needed when the file is retrieved from the database.
    
        mysqli_stmt_send_long_data($stmt, 1, $imagedata);
    // This sends the binary data to the third variable location in the
    // prepared statement (starting from 0).
    $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
    // run the statement

    mysqli_stmt_close($stmt); // and dispose of the statement.

    

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
