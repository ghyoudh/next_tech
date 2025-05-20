<?php 
session_start(); // Start the session

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // save to database
        $user_id = random_num(10);
        $query = "INSERT INTO user (user_id, user_name, password) VALUES ('$user_id', '$user_name', '$password')";

        mysqli_query($con, $query);

        header("Location: login.php");
        die;
    } else {
        echo "Please enter valid information!";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../style/signup.css">
</head>
<body>
    <div class="box">
        <form method="post">
            <h1>SignUp</h1>
            <div class="textbox">
                <label>User Name</label>
                <input type="text" placeholder="User_name" name="user_name" required>
            </div>
            <div class="textbox">
                <label>Password</label>
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <button type="submit" class="btn">SignUp</button>
            <p class="register">You have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>