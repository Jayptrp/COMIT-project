<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conplaint adding</title>
    <link rel="stylesheet" href="add.css">
</head>
<body>
    <div class="box">
        <a href="index.php"><button class="exit"></button></a>
        <form action="index.php" method="POST">
            <input name="Cname" class="name" type="text" placeholder="Complaint name" required>
            <textarea name="Cdetail" class="detail" type="text" placeholder="detail.. (optional)"></textarea>
            <div class="btnCenter">
                <button type="submit">submit</button>
            </div>
        </form>
    </div>
</body>
</html>