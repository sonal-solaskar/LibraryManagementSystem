<?php
    include("index.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/prof.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    
    <title>Library Management System</title>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <p>Library Management System</p>
                </div>
                <ul>
                    <div class="button">
                        <i class="fas fa-times close"></i>
                    </div>
                    <li><a href="search.php">Search</a></li>
                    <li><a href="issuebookdetails.php">View Status</a></li>
                    <li><a href="prof.php">Profile</a></li>
                </ul>
                <div class="button">
                    <i class="fas fa-bars menu"></i>
                </div>
                <form method="POST">
                <input type="button" id="logout" onclick="document.location='login.php'" class="primary-btn" value="LogOut">
                </form>
            </nav>
            
        </div>
    </header>

    <main>
        <div class="slide-container swiper" >
            <div class="slide-content swiper-wrapper">
                <div class="overlay swiper-slide">
                    <img src="./img/dbms2.jpg" alt="">
                    <div class="img-overlay">
                        <div class="profcontent">
                        <?php
                                    echo "<h1>Hello, Admin";
                            ?>
                            <br>
                        <input type="button" id="edit" onclick="document.location='pubdetails.php'" class="primary-btn" value="Publishers">
                        <input type="button" id="edit" onclick="document.location='authordetails.php'" class="primary-btn" value="Authors">
                        <br><input type="button" id="edit" onclick="document.location='memberdetails.php'" class="primary-btn" value="Members">
                        <input type="button" id="edit" onclick="document.location='bookdetails.php'" class="primary-btn" value="Books">
                        <br><input type="button" id="edit" onclick="document.location='issuebookdetails.php'" class="primary-btn" value="Book Status">
                        <input type="button" id="edit" onclick="document.location='genredetails.php'" class="primary-btn" value="Genre">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="js/swiper.js"></script> 
    <script src="js/index.js"></script>
</body>
</html>


