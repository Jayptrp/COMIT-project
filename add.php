<?php
session_start();
include("server.php");

if (!isset($_SESSION["name"])) {
    header("Location: login.php");
    exit();
}
if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// เปิดการแสดงข้อผิดพลาด
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
    // ตรวจสอบว่า session มีค่า emp_id เป็นตัวเลข
    if (!isset($_SESSION['emp_id']) || !is_numeric($_SESSION['emp_id'])) {
        echo "Error: Invalid emp_id in session.";
        exit();
    }

    // รับข้อมูลจากฟอร์มและป้องกัน SQL Injection
    $Cname = mysqli_real_escape_string($conn, $_POST['Cname']);
    $Cdetail = mysqli_real_escape_string($conn, $_POST['Cdetail']);
    $Ctype = mysqli_real_escape_string($conn, $_POST['Ctype']);

    $Cpriority = mysqli_real_escape_string($conn, $_POST['priority']);
    if ($Cpriority == "Normal") {
        $Clevel = 3;
    } elseif ($Cpriority == "Urgent") {
        $Clevel = 2;
    } elseif ($Cpriority == "Emergency") {
        $Clevel = 1;
    } else { exit();}

    $Cstatus = 'Waiting';
    $emp_id = intval($_SESSION['emp_id']);
    $Ctime = date('Y-m-d H:i:s');

    if (isset($_SESSION['dep_code'])) {
        $dep_code = $_SESSION['dep_code'];
    } else {
        echo "Error: Department code is not set in session.";
        exit();
    }

    // สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูลลงในตาราง complaint
    $sql = "INSERT INTO complaint (com_name, com_detail, com_level, com_status, emp_id, dep_code, com_time, com_type)
            VALUES ('$Cname', '$Cdetail', '$Clevel', '$Cstatus', '$emp_id', '$dep_code', '$Ctime', '$Ctype')";

    // รันคำสั่ง SQL และตรวจสอบผลลัพธ์
    if (mysqli_query($conn, $sql)) {
        echo "Record added successfully!";
        header("Refresh: 2; URL=index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
        exit();
    }
}
// Assuming user session contains their ID
$userId = $_SESSION['emp_id'];
$result = $conn->query("SELECT emp_pfp FROM employee WHERE emp_id = $userId");
$userProfilePicUrl = $result->fetch_assoc()['emp_pfp'] ?? 'uploads/profile_pictures/default.avif'; // Use default image if none exists
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Complaint</title>
    <script src="https://kit.fontawesome.com/4b768977d9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="add.css">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
        <div class="space"></div>
        <h3>
            <span style="color: #0da6c2;">N</span>
            <span style="color: #f89e0e;">G</span>
            <span style="color: #ed6dbb;">A</span>
            <span style="color: #ffde59;">E</span>
            <span style="color: #38b6ff;">N</span>
            <span style="color: #c453d1;">G</span>
        </h3>
        <div class="info-btn">i</div>
        <div class="bell-btn"><i class="fa-solid fa-bell"></i></div>
        <div class="profile-icon">
            <img src="<?php echo htmlspecialchars($userProfilePicUrl); ?>" alt="User Profile" id="pfp"> <!-- Replace with the actual image path from the database -->
        </div>
        <div class="profile-popup" id="pfp-popup"> <!-- PFP UPDATE BOI !!! -->
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <label for="profilePic">Choose your profile picture:</label>
                <input type="file" name="profilePic" id="profilePic" accept="image/*" required>
                <button type="submit">Upload</button>
            </form>
        </div>
        <div class="item2"><a href="index.php?logout=1"><button class="logout-btn"><i id="logout-btn" class="fa-solid fa-right-from-bracket"></i></button></a></div>
    </div>

    <div class="flex-box">
        <div class="box">
            <a href="index.php"><button class="exit"><span>Back</span></button></a>
            <p><b>Add Complaint</b></p>
            <form action="add.php" method="POST">
                <div class="inner-box">
                    <input name="Cname" class="name" type="text" placeholder="Your Complaint" required>
                    <span class="type">Type:
                        <select name="Ctype">
                            <option value="Software/Hardware">IT / Computer technical</option>
                            <option value="Electrical">Electrical</option>
                            <option value="Facility">General maintenance</option>
                            <option value="Sanitary">Construction</option>
                            <option value="Other" selected>Other</option>
                        </select>
                    </span>
                    <textarea name="Cdetail" class="detail" placeholder="Detail.. (optional)"></textarea>
                </div>
                <div class="btnCenter">
                    <b>Priority:</b>
                    <select name="priority">
                        <option value="Emergency">Emergency</option>
                        <option value="Urgent">Urgent</option>
                        <option value="Normal">Normal</option>
                    </select>
                    <div>
                        <button type="submit" name="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        const pfp = document.getElementById("pfp");
        pfp.addEventListener("click",togglePopup2);
        function togglePopup2() {
            const popup = document.getElementById('pfp-popup');
            popup.classList.toggle('show');
        }
    </script>
</body>
</html>

