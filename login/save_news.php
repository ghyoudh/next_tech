<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  die;
}

include("connection.php"); // الاتصال بقاعدة البيانات

$title = $_POST['title'];
$content = $_POST['content'];
$long_content = $_POST['long_content']; // Get the long content
$category = $_POST['category'];

// تأكد من رفع الصورة
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
  $imageName = basename($_FILES['image']['name']);
  $targetPath = "../images/" . $imageName;

  // رفع الصورة إلى مجلد uploads
  if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
    // حفظ البيانات في قاعدة البيانات
    $query = "INSERT INTO news (title, category, image_url, content, long_content) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("sssss", $title, $category, $imageName, $content, $long_content);

    if ($stmt->execute()) {
      header("Location: manage_news.php");
      exit;
    } else {
      echo "Database error: " . $con->error;
    }
  } else {
    echo "Failed to upload the image.";
  }
} else {
  echo "No image was uploaded or upload error.";
}
?>
