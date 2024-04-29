<?php
session_start();
include("index.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure pubid is properly initialized
    if(isset($_POST['genreid'])){
        $genreid = mysqli_real_escape_string($conn, $_POST['genreid']);
        $genre = mysqli_real_escape_string($conn, $_POST["genre"]);

        $sql = "UPDATE genre SET genre = '$genre' WHERE id = '$genreid'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: genredetails.php");
            exit();
        } 
        else{
            echo "Error: " . mysqli_error($conn); // Debugging message
        }
    }
    else{
        echo "Genre ID not provided!";
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
                                $genreid = mysqli_real_escape_string($conn, $_GET['id']);
                                $query = "SELECT * FROM genre WHERE id = $genreid";
                                $query_run = mysqli_query($conn, $query);

                                if(mysqli_num_rows($query_run) > 0){
                                    $genre = mysqli_fetch_array($query_run);
                                    ?>
                            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="updateform">                             
                            <h1>Edit Genre</h1><br>
                                <label for="genreid">Id:</label>
                                <input type="number" id="genreid" name="genreid" value="<?=$genre['id'];?>" readonly required><br><br>

                                <label for="genre">Genre:</label>
                                <input type="text" id="genre" name="genre" value="<?=$genre['genre'];?>" required><br><br>

                            <input type="submit" id="btn" class="primary-btn" value="Edit Genre">      
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



