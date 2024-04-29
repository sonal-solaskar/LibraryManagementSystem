<?php

include("index.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aemail = mysqli_real_escape_string($conn, $_POST["aemail"]);
    $fullName = mysqli_real_escape_string($conn, $_POST["fullName"]);
    $mobileNumber = mysqli_real_escape_string($conn, $_POST["mobileNumber"]);

        $sql = "INSERT INTO author (fullName,  aemail, mobileNumber)
            VALUES ('$fullName', '$aemail', '$mobileNumber')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: authordetails.php");
            exit();
        } 
        else{
            echo "Error: " . mysqli_error($conn); // Debugging message
        }
      

    // Close connection
    mysqli_close($conn);
}
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
                    <li><a href="search.php">Search</a></li>
                    <li><a href="status.php">View Status</a></li>
                    <li><a href="viewdetails.php">View Details</a></li>
                    <li><a href="prof.php">Profile</a></li>
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
                    <img src="./img/dbms2.jpg" alt="">
                    <div class="img-overlay">
                        <div class="content">
                            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="registrationForm">
                                <h1>Add Author</h1><br>
                                <label for="fullName">Name:</label>
                                <input type="text" id="fullName" name="fullName" required><br><br>
                                
                                <label for="aemail">Email:</label>
                                <input type="email" id="aemail" name="aemail" required><br><br>
                                
                                <label for="mobileNumber">Mobile Number:</label>
                                <input type="text" id="mobileNumber" name="mobileNumber" required><br><br>

                            <input type="submit" id="btn" class="primary-btn" value="Add Author">                            
                        </form>
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
