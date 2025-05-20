<?php
session_start();
include("connection.php");

$id = $_GET['id'];
$query = "DELETE FROM news WHERE id=?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: manage_news.php");
exit;
?>
