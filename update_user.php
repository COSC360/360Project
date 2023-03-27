<?php
session_start();


header('Content-Type: application/json');
include 'connection.php';

// if (isset($_SESSION['u_id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
//     $user_id = $_SESSION['u_id'];
//     $username = $_POST['username'];
//     $email = $_POST['email'];
//     $profile_bio = $_POST['bio'];

//     // Handle profile picture upload
// if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['size'] > 0) {
//     $target_dir = "./uploads/profile_pics/";
//     if (!file_exists($target_dir)) {
//         if (!mkdir($target_dir, 0777, true)) {
//             echo json_encode(['success' => false, 'message' => 'Failed to create directory.']);
//             exit;
//         }
//     }
    

//     $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
//     $uploadOk = 1;
//     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//     // Check if image file is an actual image
//     $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
//     if ($check !== false) {
//         $uploadOk = 1;
//     } else {
//         $uploadOk = 0;
//     }

//     // Check if $uploadOk is set to 0 by an error
//    // if ($uploadOk == 0) {
//        // echo json_encode(['success' => false, 'message' => 'Sorry, your file was not uploaded.']);
//   //  } else {
//         // If everything is ok, try to upload file
//         if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
//             // Update the profile_pic in the database
//             $stmt = $conn->prepare("UPDATE users SET profile_pic = ? WHERE u_id = ?");
//             $stmt->bind_param('si', $target_file, $user_id);
//             $stmt->execute();
//         } else {
//             echo json_encode(['success' => false, 'message' => 'Sorry, there was an error uploading your file.']);
//         }
//     }
// }


//     // Update user data in the database
//     $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, profile_bio = ? WHERE u_id = ?");
//     $stmt->bind_param('sssi', $username, $email, $profile_bio, $user_id);
//     $result = $stmt->execute();

//     if ($result) {
//         echo json_encode(['success' => true]);
//     } else {
//         echo json_encode(['success' => false]);
//     } 

if (isset($_SESSION['u_id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['u_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $profile_bio = $_POST['bio'];

    // Handle profile picture upload
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['size'] > 0) {
        $target_dir = "./uploads/profile_pics/";

        // Check if the target directory exists, if not, create it
        if (!file_exists($target_dir)) {
            if (!mkdir($target_dir, 0777, true)) {
                echo json_encode(['success' => false, 'message' => 'Failed to create directory.']);
                exit;
            }
        }

        // Generate a unique file name to avoid overwriting existing files
        $file_name = uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $file_name;

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image
        $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // If everything is ok, try to upload the file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                // Update the profile_pic in the database
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

    // Update user data in the database
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, profile_bio = ? WHERE u_id = ?");
    $stmt->bind_param('sssi', $username, $email, $profile_bio, $user_id);
    $result = $stmt->execute();

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}


// CODE TO CHECK WHERE ERRORS OCCUR:
// session_start();

// header('Content-Type: application/json');
// include 'connection.php';

// if (isset($_SESSION['u_id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
//     $user_id = $_SESSION['u_id'];
//     $username = $_POST['username'];
//     $email = $_POST['email'];
//     $bio = $_POST['profile_bio'];

//     if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['size'] > 0) {
//         $target_dir = "uploads/";
//         $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
//         $uploadOk = 1;
//         $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//         // Check if image file is an actual image or fake image
//         $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
//         if ($check !== false) {
//             $uploadOk = 1;
//         } else {
//             $uploadOk = 0;
//         }

//         // Check if file already exists
//         if (file_exists($target_file)) {
//             $uploadOk = 0;
//         }

//         // Check file size
//         if ($_FILES["profile_picture"]["size"] > 500000) {
//             $uploadOk = 0;
//         }

//         // Allow certain file formats
//         if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//             && $imageFileType != "gif") {
//             $uploadOk = 0;
//         }

//         // Check if $uploadOk is set to 0 by an error
//         if ($uploadOk == 1) {
//             if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
//                 // Update user data in the database
//                 $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, profile_bio = ?, profile_pic = ? WHERE u_id = ?");
//                 $stmt->bind_param('ssssi', $username, $email, $bio, $target_file, $user_id);
//                 $result = $stmt->execute();

//                 if ($result) {
//                     echo json_encode(['success' => true]);
//                 } else {
//                     echo json_encode(['success' => false, 'message' => 'Error updating user data']);
//                 }
//             } else {
//                 echo json_encode(['success' => false, 'message' => 'Error uploading file']);
//             }
//         } else {
//             echo json_encode(['success' => false, 'message' => 'Error: Invalid file']);
//         }
//     } else {
//         // Update user data in the database without a profile picture
//         $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, profile_bio = ? WHERE u_id = ?");
//         $stmt->bind_param('sssi', $username, $email, $bio, $user_id);
//         $result = $stmt->execute();

//         if ($result) {
//             echo json_encode(['success' => true]);
//         } else {
//             echo json_encode(['success' => false, 'message' => 'Error updating user data']);
//         }
//     }
// } else {
//     echo json_encode(['success' => false, 'message' => 'Invalid request']);
// }


?>
