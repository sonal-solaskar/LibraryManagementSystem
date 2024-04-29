<?php
session_start();
include("index.php");
$query = "SELECT * FROM member";
$result = mysqli_query($conn, $query);
$num_rows = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/flight.css">
    <link rel="stylesheet" href="css/prof.css">
    <link rel="stylesheet" href="css/userbooking.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="css/explore.css">
    <link rel="stylesheet" href="css/responsive.css">
    
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
        <div class="slide-container swiper">
            <div class="slide-content swiper-wrapper">
                <div class="overlay swiper-slide">
                    <img src="./img/dbms3.jpg" alt="">
                    <div class="img-overlay">
                        <div class="profcontent">
                        <?php if($num_rows == 0): ?>
                                <h2>No Members yet!</h2>
                                <br><input type="button" id="edit" onclick="document.location='member.php'" class="primary-btn" value="Add Mumber">
                            <?php else: ?>
                                <table border='1'>
                                    <tr>
                                        <th>Member Id</th>
                                        <th>Member Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Edit Details</th>
                                        <th>Delete Member</th>
                                    </tr>
                                    <?php
                                    // Loop through the result set and display data in table rows
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>{$row['id']}</td>";
                                        echo "<td>{$row['fullName']}</td>";
                                        echo "<td>{$row['memail']}</td>";
                                        echo "<td>{$row['mobileNumber']}</td>";
                                        $id = $row['id'];
                                        echo "<td><a href='editmember.php?id=$id' class='btn'>Edit</a></td>";
                                        echo "<td><a href='delmember.php?id=$id' class='btn'>Delete</a></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </table>
                            <?php endif; ?>
                            <br><br><input type="button" id="btn" class="primary-btn" value="Add Member" onclick="document.location='member.php'">
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

<?php
// Close the database connection
mysqli_close($conn);
?>
