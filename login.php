<!DOCTYPE html>
<html>
<head>
    <title>Login/Register - LC-PMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Login or Register</h1>

    <form method="get" action="index.php">
        <input type="text" placeholder="Username" required><br>
        <input type="password" placeholder="Password" required><br>

        <?php
        if (!isset($_GET["signup"])) {
            echo "<button type='submit'>Login</button>";
            echo "<br><a href='login.php?signup=true'>Register?</a>";
        } else {
            echo "<button type='submit'>Register</button>";
            echo "<br><a href='login.php'>Login?</a>";
        }
        ?>
    </form>

    <br>
    <a href="index.php">Back to Product Search</a>
</body>
</html>
