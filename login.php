<?php
    include("index.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/rf.css">
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
                    <li><a href="">Profile</a></li> 
                </ul>
                <div class="button">
                    <i class="fas fa-bars menu"></i>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <div class="slide-container swiper" >
            <div class="slide-content swiper-wrapper">
                <div class="overlay swiper-slide">
                    <img src="./img/dbms1.jpg" alt="">
                    <div class="img-overlay">
                        <div class="content">
                            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" 
                                id="registrationForm" onsubmit="return validateForm()">
                                <h1>Log In</h1><br>
                                <label for="email">Email:</label>
                                <input type="text" id="email" name="email"><br><br>                                
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password"><br><br>
                                <input type="submit" id="btn" name="submit" class="primary-btn" value="Log in">
                        </form>
                        <?php
session_start();
include("index.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    
    if (!empty($email) && !empty($password)) {
            if($email == "admin@gmail.com" && $password == "Admin@123" )

            header("Location: prof.php");
            exit();
        } else {
            echo "Enter Valid Credentials";
        }
    }
    mysqli_close($conn);
?>


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

