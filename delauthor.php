<?php
session_start();
include("index.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure authorid is properly initialized
    if(isset($_POST['authorid'])){
        $authorid = mysqli_real_escape_string($conn, $_POST['authorid']);
        $aemail = mysqli_real_escape_string($conn, $_POST["aemail"]);
        $fullName = mysqli_real_escape_string($conn, $_POST["fullName"]);
        $mobileNumber = mysqli_real_escape_string($conn, $_POST["mobileNumber"]);

        $sql = "DELETE FROM author WHERE id = '$authorid'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: authordetails.php");
            exit();
        } 
        else{
            echo "Error: " . mysqli_error($conn); // Debugging message
        }
    }
    else{
        echo "Author ID not provided!";
    }
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
                            <?php
                            if(isset($_GET['id'])){
                                $authorid = mysqli_real_escape_string($conn, $_GET['id']);
                                $query = "SELECT * FROM author WHERE id = $authorid";
                                $query_run = mysqli_query($conn, $query);

                                if(mysqli_num_rows($query_run) > 0){
                                    $author = mysqli_fetch_array($query_run);
                                    ?>
                            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="updateform">                             
                            <h1>Delete Author</h1><br>
                                <label for="authorid">Id:</label>
                                <input type="number" id="authorid" name="authorid" value="<?=$author['id'];?>" readonly required><br><br>

                                <label for="fullName">Name:</label>
                                <input type="text" id="fullName" name="fullName" value="<?=$author['fullName'];?>" readonly required><br><br>
                                
                                <label for="aemail">Email:</label>
                                <input type="email" id="aemail" name="aemail" value="<?=$author['aemail'];?>" readonly required><br><br>
                                
                                <label for="mobileNumber">Mobile Number:</label>
                                <input type="text" id="mobileNumber" name="mobileNumber" value="<?=$author['mobileNumber'];?>" readonly required><br><br>

                            <input type="submit" id="btn" class="primary-btn" value="Delete Author">      
                            </form>
                            <?php
                                }
                                else{
                                    echo "Empty";
                                }
                            }
                            else{
                                echo "null";
                            }                            
                            ?>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    // Close connection
    mysqli_close($conn);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="js/swiper.js"></script> 
    <script src="js/index.js"></script>
</body>
</html>



