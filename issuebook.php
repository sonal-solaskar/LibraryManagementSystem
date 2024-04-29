<?php
include("index.php");

// Fetch book titles and details from the database
$sql = "SELECT title, author, genre, price FROM book";
$result = mysqli_query($conn, $sql);
$books = mysqli_fetch_all($result, MYSQLI_ASSOC);


$msql = "SELECT fullName FROM member";
$mresult = mysqli_query($conn, $msql);
$members = mysqli_fetch_all($mresult, MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $selected_title = mysqli_real_escape_string($conn, $_POST["title"]);

    // Find the selected book details
    foreach ($books as $book) {
        if ($book['title'] === $selected_title) {
            $selected_book = $book;
            break;
        }
    }

    // Handle form submission
    $selected_member = mysqli_real_escape_string($conn, $_POST["fullName"]);

    // Find the selected book details
    foreach ($members as $member) {
        if ($member['fullName'] === $selected_member) {
            $selected_member = $member;
            break;
        }
    }

    // Calculate return date based on issue date and number of days
    $issue_date = mysqli_real_escape_string($conn, $_POST["issue_date"]);
    $number_of_days = mysqli_real_escape_string($conn, $_POST["number_of_days"]);
    $return_date = date('Y-m-d', strtotime($issue_date . ' + ' . $number_of_days . ' days'));

    // Insert data into the issuebook table
    $sql = "INSERT INTO issuebook (title, member, author, genre, price, issue_date, return_date) 
            VALUES ('$selected_title', '{$selected_member['fullName']}', '{$selected_book['author']}', '{$selected_book['genre']}', '{$selected_book['price']}', '$issue_date', '$return_date')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: bookdetails.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); // Debugging message
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
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="registrationForm">
                            <h1>Issue Book</h1><br>
                            <label for="title">Title:</label>
                            <select name="title" id="title" required>
                                <?php foreach ($books as $book): ?>
                                    <option value="<?php echo $book['title']; ?>"><?php echo $book['title']; ?></option>
                                <?php endforeach; ?>
                            </select><br><br>

                            <label for="fullName">Member:</label>
                            <select name="fullName" id="fullName" required>
                                <?php foreach ($members as $member): ?>
                                    <option value="<?php echo $member['fullName']; ?>"><?php echo $member['fullName']; ?></option>
                                <?php endforeach; ?>
                            </select><br><br>

                            <label for="author">Author:</label>
                            <input type="text" name="author" id="author" readonly><br><br>

                            <label for="genre">Genre:</label>
                            <input type="text" name="genre" id="genre" readonly><br><br>

                            <label for="issue_date">Issue Date:</label>
                            <input type="date" name="issue_date" id="issue_date" required><br><br>

                            <label for="number_of_days">Number of days:</label>
                            <input type="number" name="number_of_days" id="number_of_days" required><br><br>

                            <label for="price">Price:</label>
                            <input type="text" name="price" id="price" readonly><br><br>

                            <input type="submit" id="btn" class="primary-btn" value="Issue Book">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    // JavaScript to update book details when a title is selected
    document.getElementById('title').addEventListener('change', function() {
        var title = this.value;
        updateBookDetails(title);
    });

    function updateBookDetails(title) {
        var books = <?php echo json_encode($books); ?>;
        var selectedBook = books.find(function(book) {
            return book.title === title;
        });
        document.getElementById('author').value = selectedBook.author;
        document.getElementById('genre').value = selectedBook.genre;
        document.getElementById('price').value = selectedBook.price;
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="js/swiper.js"></script> 
<script src="js/index.js"></script>
</body>
</html>
