<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head lang="en">
   <meta charset="utf-8">
   <title>COSC 360 Project</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
   <script>
      $(document).ready(function() {
         $("#search-button").click(function() {
            var keyword = $("#search-input").val();
            $.ajax({
               url: "search-posts.php",
               method: "POST",
               data: { keyword: keyword },
               success: function(data) {
                  $("#posts-container").html(data);
               }
            });
         });
      });
   </script>

 <style>
html{
    font-family:Tahoma, Helvetica, sans-serif;
    margin-left: 5em;
    margin-top: 2em;
    margin-right: 5em;
}

h1{
    font-size: 1.8em;
}


p, body{
    font-size: 0.9em;
}



#center{
    float: right;
    height: 600px;
    width: 90%;
    overflow: scroll;
}

article{
    margin-bottom: 2em;
    
}

#masthead{
   height: 45px;
    flex-direction: column;
    display: flex;
    align-content: space-between;
    flex-wrap: wrap;
    justify-content: center;
    margin-bottom: 30px;
}

.footer-section{
    float:right;
    height: 20%;
    width: 100%;
}   

.entry{
    border-top: #00eeff solid 1px;
}


.entry div{
    clear: left;
    width: 80%;
}


footer div{
    background-color: #474747;
    color: lightgray;
}

.right {
   padding: 0.5em;
    color: white;
    display: flex;
    /* align-self: flex-end; */
    /* float: right; */
    justify-content: space-around;
    flex-direction: row;

}
.right a{
   color: white;
    text-decoration: none;
}
.right .btn{
   margin-right: 10px;
   background-color: #1DA1F2;
}
.left a{
    float: right;
    clear: left;
    display: flex;
    
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    padding: 0.5em;
    color: #1DA1F2;
    text-decoration:none;
    margin-bottom: 30px;
  
    
}

.left{
   display: flex;
   flex-direction: column;
  align-items: center;
  flex-wrap:nowrap;

}

.left img{
  display:flex;
 
  height: 50px;
 
  
}

.profile-header {
    display: flex;
    align-items: center;
}

.profile-picture {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
}

.username {
    margin-bottom: 10px;
}

.bio {
    margin-bottom: 20px;
}

#main{
   display: flex;
   flex-direction: row;
}
   #main .center{
      background-color: grey;
   }
#masthead img{
   display:flex;
   justify-content: cent
}
   </style>
</head>
<body>
   <header id="masthead">
   <a href="index.php" class="linkbutton"><img src="images/PromptHublogo.png" alt="logo" height="70"></a>
   <div class="right ">
      <?php if (isset($_SESSION['u_id'])): ?>
         <button class="btn btn-primary"><a href="profile.php" >My Profile</a></button>
         <button class="btn btn-primary"><a href="logout.php">Logout</a></button>
      <?php else: ?>
         <a href="login-signup.php" class="linkbutton">Login / Signup</a>
      <?php endif; ?>
   </div>
   </header>
   <div id="main">
      <article id="right-sidebar">
         <div class="left">
            <a href="index.php" class="linkbutton"><img src="images/house.png" alt="house" height="70">Home</a>
         
         <?php if (isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == 1): ?>
        
            <a href="admin.php" class="linkbutton"><img src="images/gear.png" alt="gear" height="70">Admin</a>
       
         <?php endif; ?>
        
            <a href="topics.php" class="linkbutton"><img src="images/topics.png" alt="topics" height="70">Topics</a>
        
      
            <a href="mytopics.php" class="linkbutton"><img src="images/star.png" alt="my topics" height="70">My Topics</a>
         </div>
      </article>
      <article id="center" class="col-md-9">
         <h1>Trending Posts</h1>
         <div class="input-group mb-4">
            <input type="text" id="search-input" class="form-control" placeholder="Search posts by title...">
            <button class="btn btn-primary" id="search-button">Search</button>
         </div>
         <div id="posts-container">
    <?php include 'trending.php'; echo fetch_recent_posts($conn); ?>
</div>

      </article>
   </div>
   <footer>
      </div>
      <div class="footer-section">
         <a href="#" class="linkbutton">Contact Us</a>
         <a href="#" class="linkbutton">FAQ</a>
         <p>&copy; Copyright 2023 COSC 360 Prompt Hub Group
      </div>
   </footer>
</body>
</html>
