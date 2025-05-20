<?php
include("connection.php");

$result = mysqli_query($con, "SELECT * FROM news ORDER BY created_at DESC");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage News</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/update.css">
</head>

<body>
    <!-- navbar -->
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
                <li class="navbar__item">
                    <a href="index2.php" class="navbar__links">Home</a>
                </li>
                <li class="navbar__item">
                    <a href="../updates.php"
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
                    session_start();

                    if (isset($_SESSION['user_id'])) {
                        echo '<a href="../login/logout.php" class="button">Logout</a>';
                    } else {
                        echo '<a href="../login/signup.php" class="button">Sign Up</a>';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>

    <!-- manage news -->
    <h2 class="header" style="margin: 2%;">Manage News</h2>
    <div class="news">
    <a class="add_news_button" href="add_news.php" style="display: inline-block; margin: 10px 23px; padding: 5px 20px; background-color: #053c5e; color: white; text-decoration: none; border-radius: 5px;">+ Add New</a>
    <div class="news__container">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="news__card">
                    <img class="news__img" src="../images/<?= htmlspecialchars($row['image_url']); ?>" width="150">
                    <h2><?= $row['title']; ?></h2>
                    <p><?= $row['content']; ?></p>
                    <a href="edit_news.php?id=<?= $row['id']; ?>">Edit</a> |
                    <a href="delete_news.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    <button><a href="news_details.php?id=<?= $row['id']; ?>">Read more</a></button>
                </div>
        <?php } ?>
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
                <a href="/" class="footer__logo"><img src="../images/logo.png"
                        alt="Next Tech Logo"> NEXT TECH</a>
                <p>Created by Ghyoudh Alotaibi </p>
                <a class="linked_in" href="https://www.linkedin.com/in/ghyoudhalotaibi?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3B94K12bvRRKahxdd8Cim56Q%3D%3D">Linked In</a>

            </div>
        </div>

    </div>
</body>

</html>