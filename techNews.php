<?php
 include("login/connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech News</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/update.css">
</head>

<body>
    <nav class="navbar">
        <div class="navbar__container">
            <a href="/" id="navbar__logo"><img src="images/logo.png"
                    alt="Next Tech Logo"> NEXT TECH</a>
            <div class="navbar__toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="navbar__menu">
                <li class="navbar__item">
                <?php if(isset($user_data) && !empty($user_data)): ?>
                        <li class="navbar__item">
                            <a href="../index.php" class="navbar__links">Home</a>
                        </li>
                    <?php else: ?>
                        <li class="navbar__item">
                            <a href="login/index2.php" class="navbar__links">Home</a>
                        </li>
                    <?php endif; ?>
            </li>
            <li class="navbar__item">
                <a href="/updates.php"
                    class="navbar__links">Updates</a>
            </li>
            <li class="navbar__item" id="navbar__dropdown">
                <a href="#" class="navbar__links">Categories</a>
                <ul class="dropdown-content">
                    <li><a href="javascript:void(0)"
                            onclick="getNews('ai')">AI</a></li>
                    <li><a href="javascript:void(0)"
                            onclick="getNews('machine learning')">Machine
                            Learning</a></li>
                    <li><a href="javascript:void(0)"
                            onclick="getNews('gadgets and devices')">Gadgets
                            and Devices</a></li>
                    <li><a href="javascript:void(0)"
                            onclick="getNews('cybersecurity')">Cybersecurity</a></li>
                    <li><a href="javascript:void(0)"
                            onclick="getNews('games')">Games</a></li>
                </ul>
            </li>
            <li class="navbar__btn">
                <?php
                    if (isset($_SESSION['user_id'])) {
                        echo '<a href="login/logout.php" class="button">Logout</a>';
                    } else {
                        echo '<a href="login/signup.php" class="button">Sign Up</a>';
                    }
                    ?>
            </li>
            </ul>
        </div>
    </nav>

    <!-- news -->
    <?php
        $categoryTitle = 'News';
        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $categoryTitle = ucwords(str_replace('_', ' ', htmlspecialchars($_GET['category'])));
        }
    ?>
    <h1 class="title" id="category-title"><?php echo $categoryTitle; ?></h1>


    <div class="news">
        <?php
        
        $sql = "SELECT id, title, content, image_url FROM news WHERE category = '$categoryTitle' ORDER BY created_at DESC";

        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            echo '<div class="news__card">';
            echo '<img class="news__img" src="images/' . htmlspecialchars($row["image_url"]) . '" alt="' . htmlspecialchars($row["title"]) . '">';
            echo '<h2>' . htmlspecialchars($row["title"]) . '</h2>';
            echo '<p>' . htmlspecialchars($row["content"]) . '</p>';
            echo '<a href="login/news_details.php?id=' . urlencode($row["id"]) . '" class="read-more-btn">Read More</a>';
            echo '</div>';
            }
        } 

        $con->close();
        ?>

        <div class="news__container">
            <div id="news__container"></div>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer" id="footer">
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
                <a href="/" class="footer__logo"><img src="images/logo.png"
                        alt="Next Tech Logo"> NEXT TECH</a>
                <p>Created by Ghyoudh Alotaibi </p>
                <a class="linked_in" href="https://www.linkedin.com/in/ghyoudhalotaibi?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3B94K12bvRRKahxdd8Cim56Q%3D%3D">Linked In</a>

            </div>
        </div>

    </div>


    <script src="app.js"></script>

</body>

</html>