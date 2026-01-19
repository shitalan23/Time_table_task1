<?php

session_start(); 

if(isset($_GET['id']) AND isset($_GET['image']) ){
    echo "get value ";
    $id = $_GET['id'];
    $image = $_GET['image'];
    if($image != ""){
        $path = "assets/cards/" . $image;
        $remove = unlink($path);
        if($remove==false){
            $_SESSION['remove'] = "<span style='color:red;'>Failed to remove</span>";
            header("Location: add-card.php");
            exit;
            die();
            
        }

    }

    $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
    $db_select = mysqli_select_db($conn, 'cards-order') or die(mysqli_error());

    $sql = "DELETE FROM tbl_cards WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    if($res == true){
        $_SESSION['delete'] = "<span style='color:red;'>Card deleted successfully</span>";
    } else {
        $_SESSION['delete'] = "Failed to Delete Card. Try Again Later";
    }

    header("Location: add-card.php");
    exit;
}
else{
    header("Location: add-card.php");
    exit;

}
?>
