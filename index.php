<?php 
session_start();

if (!isset($_SESSION["name"])) {
    header("Location: login.php");
    exit();
}
if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: login'php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://kit.fontawesome.com/4b768977d9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="header">
        <div class="item1"><b>NGEANG</b></div>
        <div class="item2"><a href="login.php"><button><i id="logout-btn" class="fa-solid fa-right-from-bracket"></i></button></a></div>
    </div>
    <div class="main">
        <div class="btn-area">
            <div class="space"></div>
            <a href="add.php">
                <button class="add-btn"><i class="fa-solid fa-pen-to-square"></i></button>
            </a>
        </div>
        <div class="content">
            <?php
            // SQL query to select all rows from the complaint table
            $sql = "SELECT com_name, com_time, emp_id, com_status FROM complaint";
            $query = mysqli_query($conn, $sql);

            // Check if there are any results
            if (mysqli_num_rows($query) > 0) {
                // Loop through each result and create a div with a 4-grid layout
                while ($result = mysqli_fetch_assoc($query)) {
                    echo '<div class="complaint-grid">';
                    echo '<div class="grid-item">' . htmlspecialchars($result["com_name"]) . '</div>';
                    echo '<div class="grid-item">' . htmlspecialchars($result["com_time"]) . '</div>';
                    echo '<div class="grid-item">' . htmlspecialchars($result["emp_id"]) . '</div>';
                    echo '<div class="grid-item">' . htmlspecialchars($result["com_status"]) . '</div>';
                    echo '</div>';
                }
            } else {
                echo "No complaints found.";
            }
            ?>
        </div>
    </div>
    <div class="footer">
        <b>NGEANG</b>
    </div>
</body>
</html>