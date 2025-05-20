<?php
session_start();
include("connection.php");

$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM news WHERE id=$id");
$news = mysqli_fetch_assoc($result);

// عند التعديل
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $long_content = $_POST['long_content'];

    // الصورة الجديدة؟ 
    if ($_FILES['image']['name']) {
        $imageName = basename($_FILES['image']['name']);
        $target = "images/" . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $imageName = $news['image_url']; // نفس القديمة
    }

    $query = "UPDATE news SET title=?, image_url=?, content=?, long_content=? WHERE id=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssssi", $title, $imageName, $content, $long_content, $id);
    $stmt->execute();
    header("Location: manage_news.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit News</title>
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
                    <?php
                    if (isset($user_data) && !empty($user_data)): ?>
                <li class="navbar__item">
                    <a href="../index.php" class="navbar__links">Home</a>
                </li>
            <?php else: ?>
                <li class="navbar__item">
                    <a href="../login/index2.php" class="navbar__links">Home</a>
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
                    <li><a href="techNews.php?category=ai">AI</a></li>
                    <li><a href="techNews.php?category=machine%20learning">Machine Learning</a></li>
                    <li><a href="techNews.php?category=gadgets%20and%20devices">Gadgets and Devices</a></li>
                    <li><a href="techNews.php?category=cybersecurity">Cybersecurity</a></li>
                    <li><a href="techNews.php?category=games">Games</a></li>
                </ul>
            </li>
            <li class="navbar__btn">
                <?php

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

<h2 class="header">Edit News</h2>
<form class="add__news" method="POST" enctype="multipart/form-data">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($news['title']); ?>" required><br><br>

    <label>Current Image:</label><br>
    <img src="../images/<?= htmlspecialchars($news['image_url']); ?>" width="150"><br><br>

    <label>Change Image (optional):</label><br>
    <input type="file" name="image"><br><br>

    <label>Content:</label><br>
    <textarea name="content" required rows="5"><?= htmlspecialchars($news['content']); ?></textarea><br><br>

    <label>Long Content:</label><br>
    <textarea name="long_content" required rows="10"><?= htmlspecialchars($news['long_content'] ?? ''); ?></textarea><br><br>

    <button type="submit">Save Changes</button>
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
                <a class="linked_in" href="https://www.linkedin.com/in/ghyoudhalotaibi?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3B94K12bvRRKahxdd8Cim56Q%3D%3D">Linked In</a>

            </div>
        </div>

    </div>
</body>
</html>
