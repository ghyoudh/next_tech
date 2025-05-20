<?php
session_start(); // Start the session

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // Read from the database
        $query = "SELECT * FROM user WHERE user_name = '$user_name' LIMIT 1";

        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if ($user_data['password'] === $password) {
                $_SESSION['user_id'] = $user_data['id']; // Store user ID in session
                header("Location: index2.php"); // Redirect to index page
                die;
            }
        }
        echo "Wrong username or password!";
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
    <title>Document</title>
    <link rel="stylesheet" href="../style/signup.css">
</head>

<body>
    <div class="box">
        <form method="post">
            <h1>Login</h1>
            <div class="textbox">
                <label>User Name</label>
                <input type="text" placeholder="User Name" name="user_name" required>
            </div>
            <div class="textbox">
                <label>Password</label>
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
            <p class="register">Don't have an account? <a href="signup.php">SignUp</a></p>
        </form>
    </div>
</body>

</html>