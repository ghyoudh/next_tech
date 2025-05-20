<?php 

session_start(); // Start the session
include("connection.php"); // Include the database connection file
include("functions.php"); // Include the functions file

$user_data = checkLogin($con, $_SESSION['user_id']); // Check if user is logged in

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/signup.css">
</head>
<body>
<nav class="navbar">
            <div class="navbar__container">
                <a href="/" id="navbar__logo"><img src="../images/logo.png"
                        alt="Next Tech Logo"> NEXT TECH</a>
                <div class="navbar__toggle" id="mobile-menu">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
                <ul class="navbar__menu">
                    <?php if(isset($user_data) && !empty($user_data)): ?>
                        <li class="navbar__item">
                            <a href="index2.php" class="navbar__links">Home</a>
                        </li>
                    <?php else: ?>
                        <li class="navbar__item">
                            <a href="../index.php" class="navbar__links">Home</a>
                        </li>
                    <?php endif; ?>
                    <li class="navbar__item">
                        <a href="../updates.php"
                            class="navbar__links">Updates</a>
                    </li>
                    <li class="navbar__item" id="navbar__dropdown">
                        <a href="#" class="navbar__links">Categories</a>
                        <ul class="dropdown-content">
                            <li><a href="../techNews.php?category=ai">AI</a></li>
                            <li><a href="../techNews.php?category=machine%20learning">Machine Learning</a></li>
                            <li><a href="../techNews.php?category=gadgets%20and%20devices">Gadgets and Devices</a></li>
                            <li><a href="../techNews.php?category=cybersecurity">Cybersecurity</a></li>
                            <li><a href="../techNews.php?category=games">Games</a></li>
                        </ul>
                    </li>
                    <li class="navbar__btn">
                        <a href="http://localhost/next_tech/login/logout.php" class="button">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

    <div class="manage_container">
        <h1>Welcome <?php echo $user_data['user_name'] ?></h1>
        <p>click here you can manage the news</p>
        <form action="manage_news.php" method="POST">
            
            <button type="open">manage News</button>
    </div>

    <!-- news -->
    <div class="news">
        <div class="news__container">

            <?php
            // Database connection
            $conn = new mysqli("localhost", "root", "", "next_tech_database");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch the first 4 news from the database, ordered by date (newest first)
            $sql = "SELECT id, title, content, image_url, created_at FROM news ORDER BY created_at DESC LIMIT 4";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                // Output each news item
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="news__card">
                        <img class="news__img" src="../images/<?= htmlspecialchars($row['image_url']); ?>" width="150">
                        <h2><?= htmlspecialchars($row['title']); ?></h2>
                        <button><a href="login/news_details.php?id=<?= $row['id']; ?>">Read more</a></button>
                    </div>
            <?php
                }
            } else {
                echo "<p>No news available.</p>";
            }

            $conn->close();
            ?>

        </div>
    </div>

    <div class="footer">
            <div class="footer__container">
                <div class="footer__link--wrapper">
                    <div class="footer__about">
                        <h2>About Us</h2>
                        <p> <strong>Next Tech</strong> is your trusted source for the latest news in technology, innovation, and digital trends. 
                            Our mission is to keep tech enthusiasts, professionals, and curious minds informed with accurate, up-to-date, and engaging content.</p>
                            <p>Whether it's breakthroughs in AI, futuristic gadgets, cybersecurity updates, or space tech, we cover stories that shape tomorrow's world—today.</p>
                    </div>
                    <div class="footer__links">
                        <h2>Explore</h2>
                        <a href="techNews.html?category=ai">AI</a>
                        <a
                            href="techNews.html?category=machine%20learning">Machine
                            Learning</a>
                        <a
                            href="techNews.html?category=gadgets%20and%20devices">Gadgets
                            and Devices</a>
                        <a
                            href="techNews.html?category=cybersecurity">Cybersecurity</a>
                        <a href="techNews.html?category=games">Games</a>
                    </div>
                </div>
                <div class="footer__bottom">
                    <a href="/" class="footer__logo"><img src="../images/logo.png"
                            alt="Next Tech Logo"> NEXT TECH</a>
                    <p>Created by Ghyoudh Alotaibi </p>
                    <a class="linked_in" href="https://www.linkedin.com/in/ghyoudhalotaibi?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3B94K12bvRRKahxdd8Cim56Q%3D%3D">Linked In</a>

                </div>
            </div>
           
        </div>
    <script src="../app.js"></script>
</body>
</html>