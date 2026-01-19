<?php
session_start(); // 🔥 THIS WAS MISSING

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
    $db_select = mysqli_select_db($conn, 'cards-order') or die(mysqli_error());

    $sql = "DELETE FROM tbl_admin WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    if($res == true){
        $_SESSION['delete'] = "<span style='color:red;'>Admin deleted successfully</span>";
    } else {
        $_SESSION['delete'] = "Failed to Delete Admin. Try Again Later";
    }

    header("Location: manage-admin.php");
    exit;
}
?>
