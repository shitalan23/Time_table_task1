<?php
session_start();
$conn = mysqli_connect('localhost','root','','cards-order');

$id = $_POST['id'];
$status = $_POST['status'];

$sql = "UPDATE tbl_order SET status='$status' WHERE id=$id";
$res = mysqli_query($conn,$sql);

if($res){
    $_SESSION['update'] = "<p style='color:green'>Status Updated Successfully</p>";
}else{
    $_SESSION['update'] = "<p style='color:red'>Failed to Update Status</p>";
}

header('location:manage-order.php');
?>
