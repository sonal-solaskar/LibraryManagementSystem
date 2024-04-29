<?php

include("index.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $genre = mysqli_real_escape_string($conn, $_POST["genre"]);
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $author = mysqli_real_escape_string($conn, $_POST["author"]);
    $publisher = mysqli_real_escape_string($conn, $_POST["publisher"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);

        $sql = "INSERT INTO book (title, genre, author, publisher, price)
            VALUES ('$title','$genre', '$author','$publisher', '$price')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: bookdetails.php");
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
                                <h1>Add Book</h1><br>
                                <?php
                                $queryp = "SELECT * FROM publisher";
                                $result1 = mysqli_query($conn, $queryp);

                                $querya = "SELECT * FROM author";
                                $result2 = mysqli_query($conn, $querya);

                                $queryg = "SELECT * FROM genre";
                                $result3 = mysqli_query($conn, $queryg);
                                ?>
                                <label for="title">Title:</label>
                                <input type="text" id="title" name="title" required><br><br>    
                                
                                <label for="author">Author:</label>
                                <select name="author" required>
                                <?php while($row1 = mysqli_fetch_array($result2)):; ?>
                                <option><?php echo $row1[1];?></option>
                                <?php endwhile; ?>
                                </select><br><br>

                                <label for="publisher">Publisher:</label>
                                <select name="publisher" required>
                                <?php while($row1 = mysqli_fetch_array($result1)):; ?>
                                <option><?php echo $row1[1];?></option>
                                <?php endwhile; ?>
                                </select><br><br>

                                <label for="genre">Genre:</label>
                                <select name="genre" required>
                                <?php while($row1 = mysqli_fetch_array($result3)):; ?>
                                <option><?php echo $row1[1];?></option>
                                <?php endwhile; ?>
                                </select><br><br> 
                                
                                <label for="price">Price:</label>
                                <input type="number" id="price" name="price" required><br><br>  

                            <input type="submit" id="btn" class="primary-btn" value="Add Book">
                            
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
