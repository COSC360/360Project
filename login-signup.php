<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login/Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <style>
        body {
            background-color: #15202B;
            font-family: 'Helvetica Neue', sans-serif;
        }

        .container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .logo {
            color: #fff;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .btn {
            width: 100%;
        }

        .twitter-btn {
            background-color: #1DA1F2;
            border-color: #1DA1F2;
            color: #fff;
            z-index: 100;
      
            
        }
        .buttons-login{
           
            height: 100vh;
            width: 20% !important;
            display: flex;
            flex-direction: column;
            position: relative;
            align-items: center;
            justify-content: center;
        }
        body{
            background-image: url("images/PHbanner2.png");
            background-position: top;
        }
        .twitter-btn:hover {
            background-color: #1990E6;
            border-color: #1990E6;
        }

        .modal-content {
            border-radius: 1rem;
        }

        .modal-footer {
            justify-content: center;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        function validateSignup() {
            var password = document.getElementById("passw").value;
            var passwordCheck = document.getElementById("passw-check").value;
            var username = document.getElementById("username").value;

            if (password != passwordCheck) {
                alert("Passwords do not match.");
                return false;
            }
            if (password.length < 8) {
                alert("Password must be at least 8 characters.");
                return false;
            }
            if (username.includes(" ")) {
                alert("Username cannot contain spaces.");
                return false;
            }
            if (password.includes(" ")) {
                alert("Password cannot contain spaces.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="buttons-login">
            
            <button type="button" class="btn btn-primary twitter-btn" data-bs-toggle="modal" data-bs-target="#loginModal">
            Log in
        </button>
        <button type="button" class="btn btn-primary twitter-btn mt-2" data-bs-toggle="modal" data-bs-target="#signupModal">
            Sign up
        </button>
        </div>
        
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Log in</h5>
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">x</span>
</button>
</div>
<div class="modal-body">
<form id="login-form" action="login.php" method="post">
<div class="mb-3">
<label for="login-username" class="form-label">Username</label>
<input type="text" class="form-control" id="login-username" name="username" required>
</div>
<div class="mb-3">
<label for="login-password" class="form-label">Password</label>
<input type="password" class="form-control" id="login-password" name="passw" required>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary twitter-btn" id="login-submit">Log in</button>
</div>
</form>
</div>
</div>
</div>
</div>
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">Sign up</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="signup-form" action="signup.php" method="post" onsubmit="return validateSignup()">
                        <div class="mb-3">
                            <label for="signup-username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="signup-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="signup-password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="passw" name="passw" required>
                        </div>
                        <div class="mb-3">
                            <label for="signup-password-check" class="form-label">Re-enter password</label>
                            <input type="password" class="form-control" id="passw-check" name="passw-check" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary twitter-btn" id="signup-submit">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>