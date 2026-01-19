<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
$db_select = mysqli_select_db($conn, 'cards-order') or die(mysqli_error());

  session_destroy();
  header("Location: http://localhost/batman_cards_order/login.php");
?>