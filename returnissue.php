<?php
session_start();
include("index.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure retid is properly initialized
    if(isset($_POST['retid'])){

        if(isset($_POST['retid'])){
        $retid = mysqli_real_escape_string($conn, $_POST['retid']);
        $sql = "DELETE FROM issuebook WHERE id = '$retid'";
        $result = mysqli_query($conn, $sql);

        $title = mysqli_real_escape_string($conn, $_POST["title"]);
        $author = mysqli_real_escape_string($conn, $_POST["author"]);
        $member = mysqli_real_escape_string($conn, $_POST["member"]);
        $issue_date = mysqli_real_escape_string($conn, $_POST["issue_date"]);
        $return_date = mysqli_real_escape_string($conn, $_POST["return_date"]);
        $returned = mysqli_real_escape_string($conn, $_POST["returned"]);

        // Convert date format to match MySQL format (YYYY-MM-DD)
        $issue_date_formatted = date("Y-m-d", strtotime($issue_date));
        $return_date_formatted = date("Y-m-d", strtotime($return_date));
        $returned_formatted = date("Y-m-d", strtotime($returned));

        $rsql = "INSERT INTO returnbook (title, member, author, issue_date, return_date, returned) 
            VALUES ('$title', '$member', '$author', '$issue_date_formatted', '$return_date_formatted', '$returned_formatted')";
        $rresult = mysqli_query($conn, $rsql);

        if ($result && $rresult) {
            header("Location: returndetails.php");
            exit();
        } 
        else{
            echo "Error: " . mysqli_error($conn); // Debugging message
        }
    }
    else{
        echo "Issue ID not provided!";
    }
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
                                $retid = mysqli_real_escape_string($conn, $_GET['id']);
                                $query = "SELECT * FROM issuebook WHERE id = $retid";
                                $query_run = mysqli_query($conn, $query);

                                if(mysqli_num_rows($query_run) > 0){
                                    $ret = mysqli_fetch_array($query_run);
                                    ?>
                            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="updateform">                             
    <h1>Return Book</h1><br>
    <label for="retid">Id:</label>
    <input type="number" id="retid" name="retid" value="<?= $ret['id']; ?>" readonly required><br><br>
    
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?= $ret['title']; ?>" readonly required><br><br>    
    
    <label for="author">Author:</label>
    <input name="author" value="<?= $ret['author']; ?>" readonly required><br><br>
    
    <label for="member">Member:</label>
    <input type="text" id="member" name="member" value="<?= $ret['member']; ?>" readonly required><br><br> 

    <label for="issue_date">Issued on:</label>
    <input type="date" id="issue_date" name="issue_date" value="<?= $ret['issue_date']; ?>" readonly required><br><br> 

    <label for="return_date">Original Return date:</label>
    <input type="date" id="return_date" name="return_date" value="<?= $ret['return_date']; ?>" readonly required><br><br> 

    <label for="returned">Returned on:</label>
    <input type="date" id="returned" name="returned" required><br><br> 

    <input type="submit" id="btn" class="primary-btn" value="Return Book">      
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



