<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  die;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tech News</title>
  <link rel="stylesheet" href="../style/style.css">
  <link rel="stylesheet" href="../style/signup.css">
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
            <li><a href="../techNews.php?category=ai">AI</a></li>
            <li><a
                href="../techNews.php?category=machine%20learning">Machine
                Learning</a></li>
            <li><a
                href="../techNews.php?category=gadgets%20and%20devices">Gadgets
                and Devices</a></li>
            <li><a
                href="../techNews.php?category=cybersecurity">Cybersecurity</a></li>
            <li><a
                href="../techNews.php?category=games">Games</a></li>
          </ul>
        </li>
        <li class="navbar__btn">
          <a href="logout.php" class="button">Logout</a>
        </li>
      </ul>
    </div>
  </nav>



  <h2 class="header">Add News</h2>
  <form class="add__news" action="save_news.php" method="POST" enctype="multipart/form-data">
    <label>News Title:</label><br>
    <input type="text" name="title" placeholder="News title" required><br><br>

    <label>Upload Image:</label><br>
    <input type="file" name="image" accept="image/*" required><br><br>

    <label>Description:</label><br>
    <textarea name="content" placeholder="Write the news here..." rows="5" required></textarea><br><br>

    <label>Content:</label><br>
    <textarea name="long_content" placeholder="Write the detailed news content here..." rows="10" required></textarea><br><br>

    <label>Category:</label><br>
    <select name="category" required>
      <option value="" disabled selected>Select a category</option>
      <option value="AI">AI</option>
      <option value="Machine Learning">Machine Learning</option>
      <option value="Gadgets and Devices">Gadgets and Devices</option>
      <option value="Cybersecurity">Cybersecurity</option>
      <option value="Games">Games</option>
    </select><br><br>

    <button type="submit">Add News</button>
  </form>

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
                    <a href="techNews.php?category=ai">AI</a>
                    <a
                        href="techNews.php?category=machine%20learning">Machine
                        Learning</a>
                    <a
                        href="techNews.php?category=gadgets%20and%20devices">Gadgets
                        and Devices</a>
                    <a
                        href="techNews.php?category=cybersecurity">Cybersecurity</a>
                    <a href="techNews.php?category=games">Games</a>
                </div>
            </div>
            <div class="footer__bottom">
                <a href="/" class="footer__logo"><img src="../images/logo.png"
                        alt="Next Tech Logo"> NEXT TECH</a>
                <p>Created by Ghyoudh Alotaibi </p>
            </div>
        </div>

    </div>
</body>

</html>